<?php
namespace ApiRestBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use FOS\UserBundle\Doctrine\UserManager;
use ApiRestBundle\Service\Util\BaseService;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use AppBundle\Entity\Client;
use AppBundle\Entity\Plan;
use AppBundle\Entity\Product;
use AppBundle\Entity\Inscription;

class InscriptionService extends BaseService{

    public function searchAllInscription(){
        $inscription = $this->repository->findAll();

        return $inscription;
    }

    public function createNoSave($request){
        try{
            //integrando com a vindi
            $arguments = array(
                'VINDI_API_KEY' => '5yLnfptrXkt7-Vwn8UY77OS4lk-19Y4xwpsJfd5hfA8',
                'VINDI_API_URI' => 'https://app.vindi.com.br/api/v1/'
            );
            $customerService = new \Vindi\Customer($arguments);

            //captando os dados do cartão
            $cardHolder = $request->request->get('cardHolder');
            $cardNumber = $request->request->get('cardNumber');
            $cardExpiration = $request->request->get('cardExpiration');
            $cardSecurity = $request->request->get('cardSecurity');
            $cardBandeira = $request->request->get('cardBandeira');
            $dayOfPayment = $request->request->get('dayOfPayment');

            if(!$cardHolder or !$cardNumber or !$cardExpiration or !$cardSecurity or !$cardBandeira or !$dayOfPayment){
                $return = array("responseCode" => 500, "data" => "Preencha todos os dados do cartão");
                return $return;
            }

            //captando os dados do usuário
            $email = $request->request->get('email');
            $first = $request->request->get('first_name');
            $last = $request->request->get('last_name');
            $cpf = $request->request->get('cpf');

            if(!$email or !$first or !$last or !$cpf){
                $return = array("responseCode" => 500, "data" => "Preencha todos os dados do usuário");
                return $return;
            }

            //captando usuário e criando o mesmo na vindi, caso não tenha
            $user = $this->em->getRepository("AppBundle:Client")->findOneByEmail($email);

            $aleatorio = mt_rand();
            if(!$user){
                // $user = new Client();
                // $user->setUsername($email);
                // $user->setFirstName($first);
                // $user->setLastName($last);
                // $user->setCpf($cpf);

                // $this->em->persist($user);
                // $this->em->flush();

                $endpoint = 'https://app.vindi.com.br:443/api/v1/customers';

                $params = array(
                    'name'  => $first.' '.$last,
                    'email' => $email,
                    'code'  => $aleatorio,
                );

                $response = $this->exec($endpoint, $params);
                $response = substr($response,18,7);
                if ($response) {
                    $keyvindi = $response;
                }

                // $att = $this->em->getRepository('AppBundle:Client')->findOneByUsername($email);

                $keyUser = $response;

                // $att->setCodexterno($aleatorio);
                // $this->em->flush();
            }

            //captando produto
            $nameProduct = $request->request->get('nameProduct');
            $descriptionProduct = $request->request->get('descriptionProduct');
            $priceProduct = $request->request->get('priceProduct');

            if(!$nameProduct or !$descriptionProduct or !$priceProduct){
                $return = array("responseCode" => 500, "data" => "Preencha todos os dados do produto");
                return $return;
            }

            //captando plan
            $namePlan = $request->request->get('namePlan');
            $descriptionPlan = $request->request->get('descriptionPlan');

            if(!$namePlan or !$descriptionPlan){
                $return = array("responseCode" => 500, "data" => "Preencha todos os dados do plano");
                return $return;
            }

            //verificando se produto existe e criando o mesmo na vindi
            $verifyProduct = $this->em->getRepository("AppBundle:Product")->findOneByName($nameProduct);

            if(!$verifyProduct){
                $aleatorio = mt_rand();

                // $verifyProduct = new Product();
                // $verifyProduct->setName($nameProduct);
                // $verifyProduct->setDescription($descriptionProduct);
                // $verifyProduct->setPrice($priceProduct);

                // $this->em->persist($verifyProduct);
                // $this->em->flush();

                $endpoint = 'https://app.vindi.com.br:443/api/v1/products';

                $params = array(
                    "name" => $nameProduct,
                    "code" => $aleatorio,
                    "unit" => "",
                    "status" => "active",
                    "pricing_schema" => array
                    (
                        "price" => $priceProduct,
                        "minimum_price" => $priceProduct + 1,
                        "schema_type" => "per_unit"
                    ),
                    //"metadata": {}
                );

                $response = $this->exec($endpoint, $params);
                $response = substr($response,17,6);

                $keyProduct = $response;

                // $verifyProduct->setKeyvindi($response);
                // $verifyProduct->setCodexterno($aleatorio);
                // $this->em->flush();
            }

            //verificando se plano existe e criando o mesmo na vindi
            $verifyPlan = $this->em->getRepository("AppBundle:Plan")->findOneByName($namePlan);
            if(!$verifyPlan){
                $aleatorio = mt_rand();

                // $verifyPlan = new Plan();
                // $verifyPlan->setName($namePlan);
                // $verifyPlan->setDescription($descriptionPlan);

                // $this->em->persist($verifyPlan);
                // $this->em->flush();

                $productPlan = new \Vindi\Plan;
                $productsPlan = array(
                    'cycles' => 1,
                    'product_id' => $keyProduct
                );

                $product = $productPlan->create([
                    'name' => $namePlan,
                    'interval' => 'months',
                    'interval_count' => 1,
                    "code" => $aleatorio,
                    'billing_trigger_type' => 'day_of_month',
                    'billing_trigger_day' => 10,
                    'plan_items' => [
                        $productsPlan
                    ]
                ]);
                $keyPlan = $product->id;

                // $verifyPlan->setKeyvindi($product->id);
                // $verifyPlan->setCodexterno($aleatorio);
                // $this->em->flush();
            }

            //verificando data de pagamento
            if($dayOfPayment < 1){
                $dayOfPayment = 1;
            }
            if($dayOfPayment > 31){
                $dayOfPayment = 31;
            }

            //início da assinatura
            $productSubscription = new \Vindi\Subscription;
            $productsPlan = array(
                'product_id' => $keyProduct
            );

            $aleatorio = mt_rand();

            $here = $paymentPlan = array(
                'id' => $aleatorio,
                'holder_name' => $cardHolder,
                'registry_code' => $cpf,
                'card_expiration' => $cardExpiration,
                'card_number' => $cardNumber,
                'card_cvv' => $cardSecurity,
                'payment_method_code' => 'credit_card',
                'payment_company_code' => $cardBandeira
            );


            $paymentProfile = new \Vindi\PaymentProfile;

            $fuck = $paymentProfile->create([
                'holder_name' => $cardHolder,
                'card_expiration' => $cardExpiration,
                'card_number' => $cardNumber,
                'card_cvv' => $cardSecurity,
                'payment_method_code' => "credit_card",
                'payment_company_code' => $cardBandeira,
                'customer_id' => $keyUser
            ]);

            $aleatorio = mt_rand();
            $verifyProduct = $productSubscription->create([
                'plan_id' => $keyProduct,
                'customer_id' => $keyUser,
                'code' => $aleatorio,
                'payment_method_code' => 'credit_card',
                'billing_trigger_day' => $dayOfPayment,
                'product_items' => [
                    $productsPlan
                ],
                'payment_profile' => [
                    $fuck
                ]
            ]);

            $return = array("responseCode" => 200, "verifyProduct" => $verifyProduct);

            return $return;

            //salvando id da transação, caso tudo tenha dado certo
            $user->setTransactionId($verifyProduct->id);

            $this->em->persist($user);
            $this->em->flush();

            $return = array("responseCode" => 200, "data" => "Assinatura efetuado com sucesso");

        }catch(\Exception $e){
            $return = array("responseCode" => 500, "data" => $e);
        }

        return $return;
    }

    public function createAndSave($request){
        try{
            //integrando com a vindi
            $arguments = array(
                'VINDI_API_KEY' => '5yLnfptrXkt7-Vwn8UY77OS4lk-19Y4xwpsJfd5hfA8',
                'VINDI_API_URI' => 'https://app.vindi.com.br/api/v1/'
            );
            $customerService = new \Vindi\Customer($arguments);

            //captando os dados do cartão
            $cardHolder = $request->request->get('cardHolder');
            $cardNumber = $request->request->get('cardNumber');
            $cardExpiration = $request->request->get('cardExpiration');
            $cardSecurity = $request->request->get('cardSecurity');
            $cardBandeira = $request->request->get('cardBandeira');
            $dayOfPayment = $request->request->get('dayOfPayment');

            if(!$cardHolder or !$cardNumber or !$cardExpiration or !$cardSecurity or !$cardBandeira or !$dayOfPayment){
                $return = array("responseCode" => 500, "data" => "Preencha todos os dados do cartão");
                return $return;
            }

            //captando os dados do usuário
            $email = $request->request->get('email');
            $first = $request->request->get('first_name');
            $last = $request->request->get('last_name');
            $cpf = $request->request->get('cpf');

            if(!$email or !$first or !$last or !$cpf){
                $return = array("responseCode" => 500, "data" => "Preencha todos os dados do usuário");
                return $return;
            }

            //captando usuário e criando o mesmo na vindi, caso não tenha
            $user = $this->em->getRepository("AppBundle:Client")->findOneByEmail($email);

            $aleatorio = mt_rand();
            if(!$user){
                $user = new Client();
                $user->setUsername($email);
                $user->setFirstName($first);
                $user->setLastName($last);
                $user->setCpf($cpf);

                $this->em->persist($user);
                $this->em->flush();

                $endpoint = 'https://app.vindi.com.br:443/api/v1/customers';

                $params = array(
                    'name'  => $first.' '.$last,
                    'email' => $email,
                    'code'  => $aleatorio,
                );

                $response = $this->exec($endpoint, $params);
                $response = substr($response,18,7);
                if ($response) {
                    $keyvindi = $response;
                }

                $att = $this->em->getRepository('AppBundle:Client')->findOneByUsername($email);

                $keyUser = $response;

                $att->setCodexterno($aleatorio);
                $this->em->flush();
            }

            //captando produto
            $nameProduct = $request->request->get('nameProduct');
            $descriptionProduct = $request->request->get('descriptionProduct');
            $priceProduct = $request->request->get('priceProduct');

            if(!$nameProduct or !$descriptionProduct or !$priceProduct){
                $return = array("responseCode" => 500, "data" => "Preencha todos os dados do produto");
                return $return;
            }

            //captando plan
            $namePlan = $request->request->get('namePlan');
            $descriptionPlan = $request->request->get('descriptionPlan');

            if(!$namePlan or !$descriptionPlan){
                $return = array("responseCode" => 500, "data" => "Preencha todos os dados do plano");
                return $return;
            }

            //verificando se produto existe e criando o mesmo na vindi
            $verifyProduct = $this->em->getRepository("AppBundle:Product")->findOneByName($nameProduct);

            if(!$verifyProduct){
                $aleatorio = mt_rand();

                $verifyProduct = new Product();
                $verifyProduct->setName($nameProduct);
                $verifyProduct->setDescription($descriptionProduct);
                $verifyProduct->setPrice($priceProduct);

                $this->em->persist($verifyProduct);
                $this->em->flush();

                $endpoint = 'https://app.vindi.com.br:443/api/v1/products';

                $params = array(
                    "name" => $nameProduct,
                    "code" => $aleatorio,
                    "unit" => "",
                    "status" => "active",
                    "pricing_schema" => array
                    (
                        "price" => $priceProduct,
                        "minimum_price" => $priceProduct + 1,
                        "schema_type" => "per_unit"
                    ),
                    //"metadata": {}
                );

                $response = $this->exec($endpoint, $params);
                $response = substr($response,17,6);

                $keyProduct = $response;

                $verifyProduct->setKeyvindi($response);
                $verifyProduct->setCodexterno($aleatorio);
                $this->em->flush();
            }

            //verificando se plano existe e criando o mesmo na vindi
            $verifyPlan = $this->em->getRepository("AppBundle:Plan")->findOneByName($namePlan);
            if(!$verifyPlan){
                $aleatorio = mt_rand();

                $verifyPlan = new Plan();
                $verifyPlan->setName($namePlan);
                $verifyPlan->setDescription($descriptionPlan);

                $this->em->persist($verifyPlan);
                $this->em->flush();

                $productService = new \Vindi\Plan;
                $productsPlan = array(
                    'cycles' => 1,
                    'product_id' => $keyProduct
                );

                $product = $productService->create([
                    'name' => $namePlan,
                    'interval' => 'months',
                    'interval_count' => 1,
                    "code" => $aleatorio,
                    'billing_trigger_type' => 'day_of_month',
                    'billing_trigger_day' => 10,
                    'plan_items' => [
                        $productsPlan
                    ]
                ]);
                $keyPlan = $product->id;


                $verifyPlan->setKeyvindi($product->id);
                $verifyPlan->setCodexterno($aleatorio);
                $this->em->flush();
            }

            //verificando data de pagamento
            if($dayOfPayment < 1){
                $dayOfPayment = 1;
            }
            if($dayOfPayment > 31){
                $dayOfPayment = 31;
            }

            //início da assinatura
            $productService = new \Vindi\Subscription;
            $productsPlan = array(
                'product_id' => $keyProduct
            );

            $aleatorio = mt_rand();

            $paymentPlan = array(
                'id' => $aleatorio,
                'holder_name' => $cardHolder,
                'registry_code' => $cpf,
                'card_expiration' => $cardExpiration,
                'card_number' => $cardNumber,
                'card_cvv' => $cardSecurity,
                'payment_method_code' => 'credit_card',
                'payment_company_code' => $cardBandeira
            );

            $paymentProfile = new \Vindi\PaymentProfile;

            $paymentProfile->create([
                'holder_name' => $cardHolder,
                'card_expiration' => $cardExpiration,
                'card_number' => $cardNumber,
                'card_cvv' => $cardSecurity,
                'payment_method_code' => 'credit_card',
                'payment_company_code' => $cardBandeira,
                'customer_id' => $keyUser
            ]);

            $verifyProduct = $productService->create([
                'plan_id' => $keyProduct,
                'customer_id' => $keyUser,
                'code' => $aleatorio,
                'payment_method_code' => 'credit_card',
                'billing_trigger_day' => $dayOfPayment,
                'product_items' => [
                    $productsPlan
                ],
                'payment_profile' => [
                    $paymentPlan
                ]
            ]);

            //salvando id da transação, caso tudo tenha dado certo
            $user->setTransactionId($verifyProduct->id);

            $this->em->persist($user);
            $this->em->flush();

            $return = array("responseCode" => 200, "data" => "Assinatura efetuado com sucesso");

        }catch(\Exception $e){
            $return = array("responseCode" => 500, "data" => $e);
        }

        return $return;
    }

}
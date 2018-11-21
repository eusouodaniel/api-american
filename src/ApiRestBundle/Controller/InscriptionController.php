<?php

namespace ApiRestBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as FOS;
use AppBundle\Entity\Inscription;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;

class InscriptionController extends Controller
{

    /**
     * @FOS\Get("/list", name="api_rest_inscription", options={"method_prefix" = false, "expose"=true })
     * @FOS\View(statusCode=200, serializerEnableMaxDepthChecks=true, serializerGroups={"listagemUsuario"})
     */
    public function inscriptionAction(Request $request)
    {
        $service = $this->get('api.service.inscription');
        $inscription = $service->searchAllInscription();

        $serializer = SerializerBuilder::create()->build();
        $return = $serializer->serialize($inscription, 'json');
        return new Response($return, 200, array('Content-Type' => 'application/json'));
    }

    /**
     * @FOS\POST("/create/no-save", name="api_rest_inscription_create_no_save", options={"method_prefix" = false, "expose"=true })
     * @FOS\View(statusCode=200, serializerEnableMaxDepthChecks=true, serializerGroups={"listagemUsuario"})
     */
    public function inscriptionNewNoSaveAction(Request $request)
    {
        $service = $this->get('api.service.inscription');


        $inscription = $service->createNoSave($request);

        $serializer = SerializerBuilder::create()->build();
        $return = $serializer->serialize($inscription, 'json');
        return new Response($return, 200, array('Content-Type' => 'application/json'));
    }

    /**
     * @FOS\POST("/create", name="api_rest_inscription_create_save", options={"method_prefix" = false, "expose"=true })
     * @FOS\View(statusCode=200, serializerEnableMaxDepthChecks=true, serializerGroups={"listagemUsuario"})
     */
    public function inscriptionNewSaveAction(Request $request)
    {
        $service = $this->get('api.service.inscription');

        $inscription = $service->createAndSave($request);

        $serializer = SerializerBuilder::create()->build();
        $return = $serializer->serialize($inscription, 'json');
        return new Response($return, 200, array('Content-Type' => 'application/json'));
    }
}
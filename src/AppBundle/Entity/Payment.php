<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Service\UploadService;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class
 *
 * @ORM\Table(name="payment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PaymentRepository")
 */
class Payment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="gateway_code", type="string", length=255, nullable=true)
     */
    private $gatewayCode;

    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var Inscription
     *
     * @ORM\ManyToOne(targetEntity="Inscription", inversedBy="payments")
     * @ORM\JoinColumn(name="inscription_id", referencedColumnName="id", nullable=true)
     */
    private $inscription;

    /**
     *
     * @ORM\ManyToOne(targetEntity="PaymentStatus")
     * @ORM\JoinColumn(name="paymentstatus_id", referencedColumnName="id")
     */
    private $payment_status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_creation", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $dtCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_update", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $dtUpdate;

    /**
     * Set id
     *
     * @param integer $id;
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return Payment
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }


    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set gatewayCode
     *
     * @param string $gatewayCode
     * @return Class
     */
    public function setGatewayCode($gatewayCode)
    {
        $this->gatewayCode = $gatewayCode;

        return $this;
    }

    /**
     * Get gatewayCode
     *
     * @return string
     */
    public function getGatewayCode()
    {
        return $this->gatewayCode;
    }

    /**
     * Set $user
     *
     * @param User $user
     * @return Payment
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set inscription
     *
     * @param Inscription $inscription
     * @return Class
     */
    public function setInscription($inscription = null)
    {
        $this->inscription = $inscription;

        return $this;
    }

    /**
     * Get inscription
     *
     * @return Class
     */
    public function getInscription()
    {
        return $this->inscription;
    }

    /**
     * Set $payment_status
     *
     * @param PaymentStatus $payment_status
     * @return Inscription
     */
    public function setPaymentStatus($payment_status)
    {
        $this->payment_status = $payment_status;

        return $this;
    }

    /**
     * Get payment_status
     *
     * @return PaymentStatus
     */
    public function getPaymentStatus()
    {
        return $this->payment_status;
    }

    /**
     * Set dtCreation
     *
     * @param \DateTime $dtCreation
     *
     * @return Payment
     */
    public function setDtCreation($dtCreation)
    {
        $this->dtCreation = $dtCreation;

        return $this;
    }

    /**
     * Get dtCreation
     *
     * @return \DateTime
     */
    public function getDtCreation()
    {
        return $this->dtCreation;
    }

    /**
     * Set dtUpdate
     *
     * @param \DateTime $dtUpdate
     *
     * @return Payment
     */
    public function setDtUpdate($dtUpdate)
    {
        $this->dtUpdate = $dtUpdate;

        return $this;
    }

    /**
     * Get dtUpdate
     *
     * @return \DateTime
     */
    public function getDtUpdate()
    {
        return $this->dtUpdate;
    }

}

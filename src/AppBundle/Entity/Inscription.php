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
 * @ORM\Table(name="inscription")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InscriptionRepository")
 */
class Inscription
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     */
    private $user;

    /**
     * @var Plan
     *
     * @ORM\ManyToOne(targetEntity="Plan")
     * @ORM\JoinColumn(name="plan_id", referencedColumnName="id", nullable=true)
     */
    private $plan;
    
    /**
     * @var string
     *
     * @ORM\Column(name="link_vindi", type="string", length=755, nullable=true)
     */
    private $linkVindi;
    
    /**
     * @var string
     *
     * @ORM\Column(name="transaction_id", type="string", length=755, nullable=true)
     */
    private $transactionId;
    
    /**
     * @var string
     *
     * @ORM\Column(name="bill_id", type="string", length=755, nullable=true)
     */
    private $billId;
    
    /**
     * @var string
     *
     * @ORM\Column(name="boleto_vindi", type="string", length=755, nullable=true)
     */
    private $boletoVindi;

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
     * @ORM\OneToMany(targetEntity="Payment", mappedBy="inscription", cascade={"all"})
     */
    protected $payments;

    /**
     *
     * @ORM\ManyToOne(targetEntity="InscriptionStatus")
     * @ORM\JoinColumn(name="inscriptionstatus_id", referencedColumnName="id")
     */
    private $inscription_status;

    /**
     * @var \DateTime
     * @ORM\Column(name="dt_begin", type="datetime", nullable=true)
     */
    private $dtBegin;

    /**
     * @var \DateTime
     * @ORM\Column(name="dt_end", type="datetime", nullable=true)
     */
    private $dtEnd;

    public function __toString(){
        return $this->name;
    }

    public function __construct(){
        $this->payments = new ArrayCollection();
    }
    
    /**
     * Set id
     *
     * @param integer $id;
     */
    public function setId($id){
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
     * Set name
     *
     * @param string $name
     * @return Course
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set user
     *
     * @param User $user
     * @return Class
     */
    public function setUser($user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return Class
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set plan
     *
     * @param Plan $plan
     * @return Class
     */
    public function setPlan($plan = null)
    {
        $this->plan = $plan;

        return $this;
    }

    /**
     * Get plan
     *
     * @return Class
     */
    public function getPlan()
    {
        return $this->plan;
    }
    
    /**
     * Set linkVindi
     *
     * @param string $linkVindi
     *
     * @return Inscription
     */
    public function setLinkVindi($linkVindi)
    {
        $this->linkVindi = $linkVindi;

        return $this;
    }

    /**
     * Get linkVindi
     *
     * @return string
     */
    public function getLinkVindi()
    {
        return $this->linkVindi;
    }
    
    /**
     * Set transactionId
     *
     * @param string $transactionId
     *
     * @return Inscription
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    /**
     * Get transactionId
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }
    
    /**
     * Set billId
     *
     * @param string $billId
     *
     * @return Inscription
     */
    public function setBillId($billId)
    {
        $this->billId = $billId;

        return $this;
    }

    /**
     * Get billId
     *
     * @return string
     */
    public function getBillId()
    {
        return $this->billId;
    }
    
    /**
     * Set boletoVindi
     *
     * @param string $boletoVindi
     *
     * @return Inscription
     */
    public function setBoletoVindi($boletoVindi)
    {
        $this->boletoVindi = $boletoVindi;

        return $this;
    }

    /**
     * Get boletoVindi
     *
     * @return string
     */
    public function getBoletoVindi()
    {
        return $this->boletoVindi;
    }

    /**
     * Set dtCreation
     *
     * @param Payments $dtCreation
     * @return Class
     */
    public function setDtCreation($dtCreation = null)
    {
        $this->dtCreation = $dtCreation;

        return $this;
    }

    /**
     * Get dtCreation
     *
     * @return Class
     */
    public function getDtCreation()
    {
        return $this->dtCreation;
    }

    /**
     * Set dtUpdate
     *
     * @param Payments $dtUpdate
     * @return Class
     */
    public function setDtUpdate($dtUpdate = null)
    {
        $this->dtUpdate = $dtUpdate;

        return $this;
    }

    /**
     * Get dtUpdate
     *
     * @return Class
     */
    public function getDtUpdate()
    {
        return $this->dtUpdate;
    }

    /**
     * Set payments
     *
     * @param Payments $payments
     * @return Class
     */
    public function setPayments($payments = null)
    {
        $this->payments = $payments;

        return $this;
    }

    /**
     * Get payments
     *
     * @return Class
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * Set $inscription_status
     *
     * @param InscriptionStatus $inscription_status
     * @return Inscription
     */
    public function setInscriptionStatus($inscription_status)
    {
        $this->inscription_status = $inscription_status;

        return $this;
    }

    /**
     * Get inscription_status
     *
     * @return InscriptionStatus
     */
    public function getInscriptionStatus()
    {
        return $this->inscription_status;
    }

    /**
     * Set dtBegin
     *
     * @param datetime $dtBegin
     * @return Inscription
     */
    public function setDtBegin($dtBegin = null)
    {
        $this->dtBegin = $dtBegin;

        return $this;
    }

    /**
     * Get dtBegin
     *
     * @return Class
     */
    public function getDtBegin()
    {
        return $this->dtBegin;
    }

    /**
     * Set dtEnd
     *
     * @param datetime $dtEnd
     * @return Inscription
     */
    public function setDtEnd($dtEnd = null)
    {
        $this->dtEnd = $dtEnd;

        return $this;
    }

    /**
     * Get dtEnd
     *
     * @return Class
     */
    public function getDtEnd()
    {
        return $this->dtEnd;
    }
}

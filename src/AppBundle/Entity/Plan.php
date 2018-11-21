<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Service\UploadService;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Plan
 *
 * @ORM\Table(name="plan")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlanRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Plan
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
     * @ORM\Column(name="name", type="string", length=64, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="key_vindi", type="string", length=64, nullable=true)
     */
    private $keyvindi;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_externo", type="string", length=64, nullable=true)
     */
    private $codexterno;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

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
     * @var string
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=true)
     */
    private $product;

    public function __toString() {
        return $this->name;
    }

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
     * Set name
     *
     * @param string $name
     * @return Plan
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
     * Set description
     *
     * @param string $description
     * @return Plan
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Plan
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get highlight
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }


    /**
     * Set keyvindi
     *
     * @param string $keyvindi
     *
     * @return Plan
     */
    public function setKeyvindi($keyvindi)
    {
        $this->keyvindi = $keyvindi;

        return $this;
    }

    /**
     * Get keyvindi
     *
     * @return string
     */
    public function getKeyvindi()
    {
        return $this->keyvindi;
    }

    /**
     * Set codexterno
     *
     * @param string $codexterno
     *
     * @return Plan
     */
    public function setCodexterno($codexterno)
    {
        $this->codexterno = $codexterno;

        return $this;
    }

    /**
     * Get codexterno
     *
     * @return string
     */
    public function getCodexterno()
    {
        return $this->codexterno;
    }

    /**
     * Set product
     *
     * @param Product $product
     * @return Product
     */
    public function setProduct($product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}

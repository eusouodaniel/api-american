<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Service\UploadService;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * BannerAdvertising
 *
 * @ORM\Table(name="banner_advertising")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BannerAdvertisingRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class BannerAdvertising
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_creation", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="create")
     */
    private $dtCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_update", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    private $dtUpdate;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Banner
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Banner
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
     * Set url
     *
     * @param string $url
     *
     * @return Banner
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set dtCreation
     *
     * @param \DateTime $dtCreation
     *
     * @return Banner
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
     * @return Banner
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
     * Set image
     *
     * @param string $image
     *
     * @return Banner
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Upload banner
     */
    const UPLOAD_PATH_IMAGE = 'uploads/banneradvertising/';

    /**
     * @Assert\File(
     *     maxSize = "1536k",
     *     maxSizeMessage = "O tamanho do arquivo é muito grande ({{ size }} {{ suffix }}), escolha um arquivo de até {{ limit }} {{ suffix }}",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png"},
     *     mimeTypesMessage = "Formato de arquivo inválido. Formatos permitidos: .gif, .jpeg e .png"
     * )
     */
    private $imageTemp;

    /**
     * Sets imageTemp
     *
     * @param UploadedFile $imageTemp
     */
    public function setImageTemp(UploadedFile $imageTemp = null)
    {
        $this->imageTemp = $imageTemp;
    }

    /**
     * Get imageTemp
     *
     * @return UploadedFile
     */
    public function getImageTemp()
    {
        return $this->imageTemp;
    }

    /**
     * Unlink File
     */
    public function unlinkFiles()
    {
        if ($this->getImage() != null) {
            unlink(BannerAdvertising::UPLOAD_PATH_IMAGE ."/". $this->getImage());
        }
    }

    /**
     * Manages the copying of the file to the relevant place on the server
     */
    public function uploadFile()
    {

        //Upload de image
        if($this->getImageTemp()!=null){
          //Se o diretorio não existir, cria
          if (!file_exists(BannerAdvertising::UPLOAD_PATH_IMAGE)) {
              mkdir(BannerAdvertising::UPLOAD_PATH_IMAGE, 0755, true);
          }
          if(
              ($this->getImageTemp() != $this->getImage())
              && (null !== $this->getImage())
          ){
              unlink(BannerAdvertising::UPLOAD_PATH_IMAGE ."/". $this->getImage());
          }

          // Generate a unique name for the file before saving it
          $fileName = md5(uniqid()).'.'.$this->getImageTemp()->guessExtension();

          UploadService::compress($this->getImageTemp(), BannerAdvertising::UPLOAD_PATH_IMAGE."/".$fileName, 100);

          // set the path property to the filename where you've saved the file
          $this->image = $fileName;

          // clean up the file property as you won't need it anymore
          $this->setImageTemp(null);
        }

    }

    /**
     * Lifecycle callback to upload the file to the server
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function lifecycleFileUpload() {
        $this->uploadFile();
    }

    /**
     * @ORM\PostLoad()
     */
    public function postLoad()
    {
        $this->dtUpdate = new \DateTime();
    }
}

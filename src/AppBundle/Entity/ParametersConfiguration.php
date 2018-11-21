<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Service\UploadService;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ParametersConfiguration
 *
 * @ORM\Table(name="parameters_configuration")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ParametersConfigurationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ParametersConfiguration
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="bg_newsletter", type="string", length=255, nullable=true)
     */
    private $bgNewsletter;

    /**
     * @var string
     *
     * @ORM\Column(name="title_section1", type="string", length=30, nullable=true)
     */
    private $titleSection1;

    /**
     * @var string
     *
     * @ORM\Column(name="title_section2", type="string", length=30, nullable=true)
     */
    private $titleSection2;

    /**
     * @var string
     *
     * @ORM\Column(name="title_menu_course", type="string", length=15, nullable=true)
     */
    private $titleMenuCourse;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_title", type="string", length=60, nullable=true)
     */
    private $seoTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="string", length=160, nullable=true)
     */
    private $seoDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_visible", type="boolean")
     */
    private $seoVisible;

    /**
     * @var string
     *
     * @ORM\Column(name="footer_title", type="string", length=35, nullable=true)
     */
    private $footerTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="footer_bio", type="string", length=300, nullable=true)
     */
    private $footerBio;

    /**
     * @var string
     *
     * @ORM\Column(name="footer_address", type="string", length=80, nullable=true)
     */
    private $footerAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="footer_email", type="string", length=45, nullable=true)
     */
    private $footerEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="footer_phone1", type="string", length=20, nullable=true)
     */
    private $footerPhone1;

    /**
     * @var string
     *
     * @ORM\Column(name="footer_phone2", type="string", length=20, nullable=true)
     */
    private $footerPhone2;

    /**
     * @var string
     *
     * @ORM\Column(name="footer_instagram", type="string", length=100, nullable=true)
     */
    private $footerInstagram;

    /**
     * @var string
     *
     * @ORM\Column(name="footer_twitter", type="string", length=100, nullable=true)
     */
    private $footerTwitter;

    /**
     * @var string
     *
     * @ORM\Column(name="footer_facebook", type="string", length=100, nullable=true)
     */
    private $footerFacebook;

    /**
     * @var string
     *
     * @ORM\Column(name="header_color", type="string", length=255, nullable=true)
     */
    private $headerColor;

    /**
     * @var string
     *
     * @ORM\Column(name="footer_color", type="string", length=255, nullable=true)
     */
    private $footerColor;

    /**
     * @var string
     *
     * @ORM\Column(name="copyright_color", type="string", length=255, nullable=true)
     */
    private $copyrightColor;

    /**
     * @var string
     *
     * @ORM\Column(name="btnprincipalprimary_color", type="string", length=255, nullable=true)
     */
    private $btnPrincipalPrimaryColor;

    /**
     * @var string
     *
     * @ORM\Column(name="btnprincipalsecundary_color", type="string", length=255, nullable=true)
     */
    private $btnPrincipalSecundaryColor;

    /**
     * @var string
     *
     * @ORM\Column(name="btnloginprimary_color", type="string", length=255, nullable=true)
     */
    private $btnLoginPrimaryColor;

    /**
     * @var string
     *
     * @ORM\Column(name="btnloginsecundary_color", type="string", length=255, nullable=true)
     */
    private $btnLoginSecundaryColor;

    /**
     * @var string
     *
     * @ORM\Column(name="menu_color", type="string", length=255, nullable=true)
     */
    private $menuColor;

    /**
     * @var string
     *
     * @ORM\Column(name="menuselected_color", type="string", length=255, nullable=true)
     */
    private $menuSelectedColor;

    /**
     * @var string
     *
     * @ORM\Column(name="footertext_color", type="string", length=255, nullable=true)
     */
    private $footerTextColor;

    /**
     * @var string
     *
     * @ORM\Column(name="footercontacttext_color", type="string", length=255, nullable=true)
     */
    private $footerContactTextColor;

    /**
     * @var string
     *
     * @ORM\Column(name="footertitle_color", type="string", length=255, nullable=true)
     */
    private $footerTitleColor;

    /**
     * @var string
     *
     * @ORM\Column(name="footersubtitle_color", type="string", length=255, nullable=true)
     */
    private $footerSubtitleColor;

    /**
     * @var string
     *
     * @ORM\Column(name="footericon_color", type="string", length=255, nullable=true)
     */
    private $footerIconColor;

    /**
     * @var string
     *
     * @ORM\Column(name="pagetitle_color", type="string", length=255, nullable=true)
     */
    private $pageTitleColor;

    /**
     * @var string
     *
     * @ORM\Column(name="lessonbackground_color", type="string", length=255, nullable=true)
     */
    private $lessonBackgroundColor;

    /**
     * @var string
     *
     * @ORM\Column(name="bannertext_color", type="string", length=255, nullable=true)
     */
    private $bannerTextColor;

    /**
     * @var string
     *
     * @ORM\Column(name="samba_token", type="string", length=255, nullable=true)
     */
    private $sambaToken;

    /**
     * @var string
     *
     * @ORM\Column(name="project_id", type="string", length=255, nullable=true)
     */
    private $projectId;

    /**
     * @var string
     *
     * @ORM\Column(name="player_id", type="string", length=255, nullable=true)
     */
    private $playerId;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_email", type="string", length=255, nullable=true)
     */
    private $contactEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="samba_video_access", type="boolean")
     */
    private $sambaVideoAccess;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return ParametersConfiguration
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set bgNewsletter
     *
     * @param string $bgNewsletter
     *
     * @return ParametersConfiguration
     */
    public function setBgNewsletter($bgNewsletter)
    {
        $this->bgNewsletter = $bgNewsletter;

        return $this;
    }

    /**
     * Get bgNewsletter
     *
     * @return string
     */
    public function getBgNewsletter()
    {
        return $this->bgNewsletter;
    }

    /**
     * Set titleSection1
     *
     * @param string $titleSection1
     *
     * @return ParametersConfiguration
     */
    public function setTitleSection1($titleSection1)
    {
        $this->titleSection1 = $titleSection1;

        return $this;
    }

    /**
     * Get titleSection1
     *
     * @return string
     */
    public function getTitleSection1()
    {
        return $this->titleSection1;
    }

    /**
     * Set titleSection2
     *
     * @param string $titleSection2
     *
     * @return ParametersConfiguration
     */
    public function setTitleSection2($titleSection2)
    {
        $this->titleSection2 = $titleSection2;

        return $this;
    }

    /**
     * Get titleSection2
     *
     * @return string
     */
    public function getTitleSection2()
    {
        return $this->titleSection2;
    }

    /**
     * Set titleMenuCourse
     *
     * @param string $titleMenuCourse
     *
     * @return ParametersConfiguration
     */
    public function setTitleMenuCourse($titleMenuCourse)
    {
        $this->titleMenuCourse = $titleMenuCourse;

        return $this;
    }

    /**
     * Get titleMenuCourse
     *
     * @return string
     */
    public function getTitleMenuCourse()
    {
        return $this->titleMenuCourse;
    }

    /**
     * Set seoTitle
     *
     * @param string $seoTitle
     *
     * @return ParametersConfiguration
     */
    public function setSeoTitle($seoTitle)
    {
        $this->seoTitle = $seoTitle;

        return $this;
    }

    /**
     * Get seoTitle
     *
     * @return string
     */
    public function getSeoTitle()
    {
        return $this->seoTitle;
    }

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     *
     * @return ParametersConfiguration
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    /**
     * Get seoDescription
     *
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }

    /**
     * Set seoVisible
     *
     * @param string $seoVisible
     *
     * @return ParametersConfiguration
     */
    public function setSeoVisible($seoVisible)
    {
        $this->seoVisible = $seoVisible;

        return $this;
    }

    /**
     * Get seoVisible
     *
     * @return string
     */
    public function getSeoVisible()
    {
        return $this->seoVisible;
    }

    /**
     * Set footerTitle
     *
     * @param string $footerTitle
     *
     * @return ParametersConfiguration
     */
    public function setFooterTitle($footerTitle)
    {
        $this->footerTitle = $footerTitle;

        return $this;
    }

    /**
     * Get footerTitle
     *
     * @return string
     */
    public function getFooterTitle()
    {
        return $this->footerTitle;
    }

    /**
     * Set footerBio
     *
     * @param string $footerBio
     *
     * @return ParametersConfiguration
     */
    public function setFooterBio($footerBio)
    {
        $this->footerBio = $footerBio;

        return $this;
    }

    /**
     * Get footerBio
     *
     * @return string
     */
    public function getFooterBio()
    {
        return $this->footerBio;
    }

    /**
     * Set footerAddress
     *
     * @param string $footerAddress
     *
     * @return ParametersConfiguration
     */
    public function setFooterAddress($footerAddress)
    {
        $this->footerAddress = $footerAddress;

        return $this;
    }

    /**
     * Get footerAddress
     *
     * @return string
     */
    public function getFooterAddress()
    {
        return $this->footerAddress;
    }

    /**
     * Set footerEmail
     *
     * @param string $footerEmail
     *
     * @return ParametersConfiguration
     */
    public function setFooterEmail($footerEmail)
    {
        $this->footerEmail = $footerEmail;

        return $this;
    }

    /**
     * Get footerEmail
     *
     * @return string
     */
    public function getFooterEmail()
    {
        return $this->footerEmail;
    }

    /**
     * Set footerPhone1
     *
     * @param string $footerPhone1
     *
     * @return ParametersConfiguration
     */
    public function setFooterPhone1($footerPhone1)
    {
        $this->footerPhone1 = $footerPhone1;

        return $this;
    }

    /**
     * Get footerPhone1
     *
     * @return string
     */
    public function getFooterPhone1()
    {
        return $this->footerPhone1;
    }

    /**
     * Set footerPhone2
     *
     * @param string $footerPhone2
     *
     * @return ParametersConfiguration
     */
    public function setFooterPhone2($footerPhone2)
    {
        $this->footerPhone2 = $footerPhone2;

        return $this;
    }

    /**
     * Get footerPhone2
     *
     * @return string
     */
    public function getFooterPhone2()
    {
        return $this->footerPhone2;
    }

    /**
     * Set footerInstagram
     *
     * @param string $footerInstagram
     *
     * @return ParametersConfiguration
     */
    public function setFooterInstagram($footerInstagram)
    {
        $this->footerInstagram = $footerInstagram;

        return $this;
    }

    /**
     * Get footerInstagram
     *
     * @return string
     */
    public function getFooterInstagram()
    {
        return $this->footerInstagram;
    }

    /**
     * Set footerTwitter
     *
     * @param string $footerTwitter
     *
     * @return ParametersConfiguration
     */
    public function setFooterTwitter($footerTwitter)
    {
        $this->footerTwitter = $footerTwitter;

        return $this;
    }

    /**
     * Get footerTwitter
     *
     * @return string
     */
    public function getFooterTwitter()
    {
        return $this->footerTwitter;
    }

    /**
     * Set footerFacebook
     *
     * @param string $footerFacebook
     *
     * @return ParametersConfiguration
     */
    public function setFooterFacebook($footerFacebook)
    {
        $this->footerFacebook = $footerFacebook;

        return $this;
    }

    /**
     * Get footerFacebook
     *
     * @return string
     */
    public function getFooterFacebook()
    {
        return $this->footerFacebook;
    }

    /**
     * Set headerColor
     *
     * @param string $headerColor
     *
     * @return ParametersConfiguration
     */
    public function setHeaderColor($headerColor)
    {
        $this->headerColor = $headerColor;

        return $this;
    }

    /**
     * Get headerColor
     *
     * @return string
     */
    public function getHeaderColor()
    {
        return $this->headerColor;
    }

    /**
     * Set footerColor
     *
     * @param string $footerColor
     *
     * @return ParametersConfiguration
     */
    public function setFooterColor($footerColor)
    {
        $this->footerColor = $footerColor;

        return $this;
    }

    /**
     * Get footerColor
     *
     * @return string
     */
    public function getFooterColor()
    {
        return $this->footerColor;
    }

    /**
     * Set copyrightColor
     *
     * @param string $copyrightColor
     *
     * @return ParametersConfiguration
     */
    public function setCopyrightColor($copyrightColor)
    {
        $this->copyrightColor = $copyrightColor;

        return $this;
    }

    /**
     * Get copyrightColor
     *
     * @return string
     */
    public function getCopyrightColor()
    {
        return $this->copyrightColor;
    }

    /**
     * Set btnPrincipalPrimaryColor
     *
     * @param string $btnPrincipalPrimaryColor
     *
     * @return ParametersConfiguration
     */
    public function setBtnPrincipalPrimaryColor($btnPrincipalPrimaryColor)
    {
        $this->btnPrincipalPrimaryColor = $btnPrincipalPrimaryColor;

        return $this;
    }

    /**
     * Get btnPrincipalPrimaryColor
     *
     * @return string
     */
    public function getBtnPrincipalPrimaryColor()
    {
        return $this->btnPrincipalPrimaryColor;
    }

    /**
     * Set btnPrincipalSecundaryColor
     *
     * @param string $btnPrincipalSecundaryColor
     *
     * @return ParametersConfiguration
     */
    public function setBtnPrincipalSecundaryColor($btnPrincipalSecundaryColor)
    {
        $this->btnPrincipalSecundaryColor = $btnPrincipalSecundaryColor;

        return $this;
    }

    /**
     * Get btnPrincipalSecundaryColor
     *
     * @return string
     */
    public function getBtnPrincipalSecundaryColor()
    {
        return $this->btnPrincipalSecundaryColor;
    }

    /**
     * Set btnLoginPrimaryColor
     *
     * @param string $btnLoginPrimaryColor
     *
     * @return ParametersConfiguration
     */
    public function setBtnLoginPrimaryColor($btnLoginPrimaryColor)
    {
        $this->btnLoginPrimaryColor = $btnLoginPrimaryColor;

        return $this;
    }

    /**
     * Get btnLoginPrimaryColor
     *
     * @return string
     */
    public function getBtnLoginPrimaryColor()
    {
        return $this->btnLoginPrimaryColor;
    }

    /**
     * Set btnLoginSecundaryColor
     *
     * @param string $btnLoginSecundaryColor
     *
     * @return ParametersConfiguration
     */
    public function setBtnLoginSecundaryColor($btnLoginSecundaryColor)
    {
        $this->btnLoginSecundaryColor = $btnLoginSecundaryColor;

        return $this;
    }

    /**
     * Get btnLoginSecundaryColor
     *
     * @return string
     */
    public function getBtnLoginSecundaryColor()
    {
        return $this->btnLoginSecundaryColor;
    }

    /**
     * Set menuColor
     *
     * @param string $menuColor
     *
     * @return ParametersConfiguration
     */
    public function setMenuColor($menuColor)
    {
        $this->menuColor = $menuColor;

        return $this;
    }

    /**
     * Get menuColor
     *
     * @return string
     */
    public function getMenuColor()
    {
        return $this->menuColor;
    }

    /**
     * Set menuSelectedColor
     *
     * @param string $menuSelectedColor
     *
     * @return ParametersConfiguration
     */
    public function setMenuSelectedColor($menuSelectedColor)
    {
        $this->menuSelectedColor = $menuSelectedColor;

        return $this;
    }

    /**
     * Get menuSelectedColor
     *
     * @return string
     */
    public function getMenuSelectedColor()
    {
        return $this->menuSelectedColor;
    }

    /**
     * Set footerTitleColor
     *
     * @param string $footerTitleColor
     *
     * @return ParametersConfiguration
     */
    public function setFooterTitleColor($footerTitleColor)
    {
        $this->footerTitleColor = $footerTitleColor;

        return $this;
    }

    /**
     * Get footerTitleColor
     *
     * @return string
     */
    public function getFooterTitleColor()
    {
        return $this->footerTitleColor;
    }

    /**
     * Set footerSubtitleColor
     *
     * @param string $footerSubtitleColor
     *
     * @return ParametersConfiguration
     */
    public function setFooterSubtitleColor($footerSubtitleColor)
    {
        $this->footerSubtitleColor = $footerSubtitleColor;

        return $this;
    }

    /**
     * Get footerSubtitleColor
     *
     * @return string
     */
    public function getFooterSubtitleColor()
    {
        return $this->footerSubtitleColor;
    }

    /**
     * Set footerIconColor
     *
     * @param string $footerIconColor
     *
     * @return ParametersConfiguration
     */
    public function setFooterIconColor($footerIconColor)
    {
        $this->footerIconColor = $footerIconColor;

        return $this;
    }

    /**
     * Get footerIconColor
     *
     * @return string
     */
    public function getFooterIconColor()
    {
        return $this->footerIconColor;
    }

    /**
     * Set footerTextColor
     *
     * @param string $footerTextColor
     *
     * @return ParametersConfiguration
     */
    public function setFooterTextColor($footerTextColor)
    {
        $this->footerTextColor = $footerTextColor;

        return $this;
    }

    /**
     * Get footerTextColor
     *
     * @return string
     */
    public function getFooterTextColor()
    {
        return $this->footerTextColor;
    }

    /**
     * Set footerContactTextColor
     *
     * @param string $footerContactTextColor
     *
     * @return ParametersConfiguration
     */
    public function setFooterContactTextColor($footerContactTextColor)
    {
        $this->footerContactTextColor = $footerContactTextColor;

        return $this;
    }

    /**
     * Get footerContactTextColor
     *
     * @return string
     */
    public function getFooterContactTextColor()
    {
        return $this->footerContactTextColor;
    }

    /**
     * Set pageTitleColor
     *
     * @param string $pageTitleColor
     *
     * @return ParametersConfiguration
     */
    public function setPageTitleColor($pageTitleColor)
    {
        $this->pageTitleColor = $pageTitleColor;

        return $this;
    }

    /**
     * Get pageTitleColor
     *
     * @return string
     */
    public function getPageTitleColor()
    {
        return $this->pageTitleColor;
    }

    /**
     * Set lessonBackgroundColor
     *
     * @param string $lessonBackgroundColor
     *
     * @return ParametersConfiguration
     */
    public function setLessonBackgroundColor($lessonBackgroundColor)
    {
        $this->lessonBackgroundColor = $lessonBackgroundColor;

        return $this;
    }

    /**
     * Get lessonBackgroundColor
     *
     * @return string
     */
    public function getLessonBackgroundColor()
    {
        return $this->lessonBackgroundColor;
    }

    /**
     * Set bannerTextColor
     *
     * @param string $bannerTextColor
     *
     * @return ParametersConfiguration
     */
    public function setBannerTextColor($bannerTextColor)
    {
        $this->bannerTextColor = $bannerTextColor;

        return $this;
    }

    /**
     * Get bannerTextColor
     *
     * @return string
     */
    public function getBannerTextColor()
    {
        return $this->bannerTextColor;
    }

    /**
     * Set sambaToken
     *
     * @param string $sambaToken
     *
     * @return ParametersConfiguration
     */
    public function setSambaToken($sambaToken)
    {
        $this->sambaToken = $sambaToken;

        return $this;
    }

    /**
     * Get sambaToken
     *
     * @return string
     */
    public function getSambaToken()
    {
        return $this->sambaToken;
    }

    /**
     * Set projectId
     *
     * @param string $projectId
     *
     * @return ParametersConfiguration
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;

        return $this;
    }

    /**
     * Get projectId
     *
     * @return string
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * Set playerId
     *
     * @param string $playerId
     *
     * @return ParametersConfiguration
     */
    public function setPlayerId($playerId)
    {
        $this->playerId = $playerId;

        return $this;
    }

    /**
     * Get playerId
     *
     * @return string
     */
    public function getPlayerId()
    {
        return $this->playerId;
    }

    /**
     * Set contactEmail
     *
     * @param string $contactEmail
     *
     * @return ParametersConfiguration
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * Get playerId
     *
     * @return string
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * Set sambaVideoAccess
     *
     * @param string $sambaVideoAccess
     *
     * @return ParametersConfiguration
     */
    public function setSambaVideoAccess($sambaVideoAccess)
    {
        $this->sambaVideoAccess = $sambaVideoAccess;

        return $this;
    }

    /**
     * Get sambaVideoAccess
     *
     * @return string
     */
    public function getSambaVideoAccess()
    {
        return $this->sambaVideoAccess;
    }

    /**
     * Set dtCreation
     *
     * @param \DateTime $dtCreation
     *
     * @return ParametersConfiguration
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
     * @return ParametersConfiguration
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
     * Upload logo
     */
    const UPLOAD_PATH = 'uploads/parameters_configuration/';

    /**
     * @Assert\File(
     *     maxSize = "3072k",
     *     maxSizeMessage = "O tamanho do arquivo é muito grande ({{ size }} {{ suffix }}), escolha um arquivo de até {{ limit }} {{ suffix }}",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png"},
     *     mimeTypesMessage = "Formato de arquivo inválido. Formatos permitidos: .gif, .jpeg e .png"
     * )
     */
    private $logoTemp;

    /**
     * @Assert\File(
     *     maxSize = "3072k",
     *     maxSizeMessage = "O tamanho do arquivo é muito grande ({{ size }} {{ suffix }}), escolha um arquivo de até {{ limit }} {{ suffix }}",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png"},
     *     mimeTypesMessage = "Formato de arquivo inválido. Formatos permitidos: .gif, .jpeg e .png"
     * )
     */
    private $bgNewsletterTemp;

    /**
     * Sets logoTemp
     *
     * @param UploadedFile $logoTemp
     */
    public function setLogoTemp(UploadedFile $logoTemp = null)
    {
        $this->logoTemp = $logoTemp;
    }

    /**
     * Get logoTemp
     *
     * @return UploadedFile
     */
    public function getLogoTemp()
    {
        return $this->logoTemp;
    }

    /**
     * Sets bgNewsletterTemp
     *
     * @param UploadedFile $bgNewsletterTemp
     */
    public function setBgNewsletterTemp(UploadedFile $bgNewsletterTemp = null)
    {
        $this->bgNewsletterTemp = $bgNewsletterTemp;
    }

    /**
     * Get bgNewsletterTemp
     *
     * @return UploadedFile
     */
    public function getBgNewsletterTemp()
    {
        return $this->bgNewsletterTemp;
    }

    /**
     * Manages the copying of the file to the relevant place on the server
     */
    public function uploadFile()
    {

        //Upload de image
        if($this->getLogoTemp()!=null){
          //Se o diretorio não existir, cria
          if (!file_exists(ParametersConfiguration::UPLOAD_PATH)) {
              mkdir(ParametersConfiguration::UPLOAD_PATH, 0755, true);
          }
          if(
              ($this->getLogoTemp() != $this->getLogo())
              && (null !== $this->getLogo())
          ){
              unlink(ParametersConfiguration::UPLOAD_PATH ."/". $this->getLogo());
          }

          // Generate a unique name for the file before saving it
          $logoName = md5(uniqid()).'.'.$this->getLogoTemp()->guessExtension();

          //UploadService::compress($this->getLogoTemp(), ParametersConfiguration::UPLOAD_PATH."/".$logoName, 100);
          // move takes the target directory and target filename as params
          $this->getLogoTemp()->move(ParametersConfiguration::UPLOAD_PATH,$logoName);

          // set the path property to the filename where you've saved the file
          $this->logo = $logoName;

          // clean up the file property as you won't need it anymore
          $this->setLogoTemp(null);
        }

        //Upload de image
        if($this->getBgNewsletterTemp()!=null){
          //Se o diretorio não existir, cria
          if (!file_exists(ParametersConfiguration::UPLOAD_PATH)) {
              mkdir(ParametersConfiguration::UPLOAD_PATH, 0755, true);
          }
          if(
              ($this->getBgNewsletterTemp() != $this->getBgNewsletter())
              && (null !== $this->getBgNewsletter())
          ){
              unlink(ParametersConfiguration::UPLOAD_PATH ."/". $this->getBgNewsletter());
          }

          // Generate a unique name for the file before saving it
          $bgName = md5(uniqid()).'.'.$this->getBgNewsletterTemp()->guessExtension();

          //UploadService::compress($this->getLogoTemp(), ParametersConfiguration::UPLOAD_PATH."/".$logoName, 100);
          // move takes the target directory and target filename as params
          $this->getBgNewsletterTemp()->move(ParametersConfiguration::UPLOAD_PATH,$bgName);

          // set the path property to the filename where you've saved the file
          $this->bgNewsletter = $bgName;

          // clean up the file property as you won't need it anymore
          $this->setBgNewsletterTemp(null);
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

    /**
     * Adds support for magic finders for repositories.
     *
     * @param string $method
     * @param array  $arguments
     *
     * @return object The found repository.
     * @throws \BadMethodCallException If the method called is an invalid find* method
     *                                 or no find* method at all and therefore an invalid
     *                                 method call.
     */
    public function __call($method, $arguments) {
      $property = lcfirst(substr($name, 3));
      if ('get' === substr($name, 0, 3)) {
          return isset($this->children[$property])
              ? $this->children[$property]
              : null;
      }
    }

}

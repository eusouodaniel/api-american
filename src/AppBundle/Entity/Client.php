<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClientRepository")
 */
class Client extends User
{
    public function __construct() {
        parent::__construct();
    }
    

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
     * @ORM\Column(name="key_vindi", type="string", nullable=true)
     */
    private $keyvindi;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_externo", type="string", nullable=true)
     */
    private $codexterno;

    /**
     * @var string
     *
     * @ORM\Column(name="cpf", type="string", nullable=true)
     */
    private $cpf;

    /**
     * Set keyvindi
     *
     * @param string $keyvindi
     *
     * @return Client
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
     * @return Client
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
     * Set cpf
     *
     * @param string $cpf
     *
     * @return Client
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get cpf
     *
     * @return string
     */
    public function getCpf()
    {
        return $this->cpf;
    }
}

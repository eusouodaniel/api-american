<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatusPayment
 *
 * @ORM\Table(name="payment_status")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PaymentStatusRepository")
 */
class PaymentStatus
{
    const AGUARDANDO_PAGAMENTO = 1;
    const EM_ANALISE = 2;
    const PAGA = 3;
    const DISPONIVEL = 4;
    const EM_DISPUTA = 5;
    const DEVOLVIDA = 6;
    const CANCELADA = 7;

    /**
     * __toString method
     */
    public function __toString() {
        return $this->meaning;
    }

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
     * @ORM\Column(name="meaning", type="string", length=255, unique=true)
     */
    private $meaning;

    /**
     * @var string
     *
     * @ORM\Column(name="key", type="string", length=255)
     */
    private $key;

    /**
     * Set id
     *
     * @param string $id
     *
     * @return StatusPayment
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set meaning
     *
     * @param string $meaning
     *
     * @return StatusPayment
     */
    public function setMeaning($meaning)
    {
        $this->meaning = $meaning;

        return $this;
    }

    /**
     * Get meaning
     *
     * @return string
     */
    public function getMeaning()
    {
        return $this->meaning;
    }

    /**
     * Set key
     *
     * @param string $key
     *
     * @return StatusPayment
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }
}

<?php

namespace AppBundle\Entity;

class SearchReport
{
    private $beginDate;
    private $endDate;
    private $plan;
    private $inscriptionStatus;
    private $paymentStatus;

    /**
     * Set beginDate
     *
     * @param Date $beginDate
     * @return SearchReport
     */
    public function setBeginDate($beginDate)
    {
        $this->beginDate = $beginDate;

        return $this;
    }

    /**
     * Get beginDate
     *
     * @return Date
     */
    public function getBeginDate()
    {
        return $this->beginDate;
    }

    /**
     * Set endDate
     *
     * @param Date $endDate
     * @return SearchReport
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return Date
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set plan
     *
     * @param Plan $plan
     * @return SearchReport
     */
    public function setPlan($plan)
    {
        $this->plan = $plan;

        return $this;
    }

    /**
     * Get plan
     *
     * @return Plan
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * Set inscriptionStatus
     *
     * @param InscriptionStatus $inscriptionStatus
     * @return SearchReport
     */
    public function setInscriptionStatus($inscriptionStatus)
    {
        $this->inscriptionStatus = $inscriptionStatus;

        return $this;
    }

    /**
     * Get inscriptionStatus
     *
     * @return InscriptionStatus
     */
    public function getInscriptionStatus()
    {
        return $this->inscriptionStatus;
    }

    /**
     * Set paymentStatus
     *
     * @param PaymentStatus $paymentStatus
     * @return SearchReport
     */
    public function setPaymentStatus($paymentStatus)
    {
        $this->paymentStatus = $paymentStatus;

        return $this;
    }

    /**
     * Get paymentStatus
     *
     * @return PaymentStatus
     */
    public function getPaymentStatus()
    {
        return $this->paymentStatus;
    }
}

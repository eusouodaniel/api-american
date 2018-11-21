<?php

namespace AppBundle\Entity;

class CreateProject
{

    private $token;
    private $name;
    private $description;

    /**
     * Set token
     *
     * @param String $token
     * @return CreateProject
     */
    public function setToken($token = null)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return CreateProject
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set name
     *
     * @param String $name
     * @return CreateProject
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return CreateProject
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param String $description
     * @return CreateProject
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return CreateProject
     */
    public function getDescription()
    {
        return $this->description;
    }

}

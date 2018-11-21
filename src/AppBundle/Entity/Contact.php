<?php

namespace AppBundle\Entity;

/**
 * Contact
 */
class Contact
{

  private $name;
  private $email;
  private $phone;
  private $message;
  private $subject;

  /**
   * Set name
   *
   * @param string $name
   * @return Contact
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
   * Set email
   *
   * @param string $email
   * @return Contact
   */
  public function setEmail($email)
  {
      $this->email = $email;

      return $this;
  }

  /**
   * Get email
   *
   * @return string
   */
  public function getEmail()
  {
      return $this->email;
  }

  /**
   * Set phone
   *
   * @param string $phone
   * @return Contact
   */
  public function setPhone($phone)
  {
      $this->phone = $phone;

      return $this;
  }

  /**
   * Get phone
   *
   * @return string
   */
  public function getPhone()
  {
      return $this->phone;
  }

  /**
   * Set message
   *
   * @param string $message
   * @return Contact
   */
  public function setMessage($message)
  {
      $this->message = $message;

      return $this;
  }

  /**
   * Get message
   *
   * @return string
   */
  public function getMessage()
  {
      return $this->message;
  }

  /**
   * Set subject
   *
   * @param string $subject
   * @return Contact
   */
  public function setSubject($subject)
  {
      $this->subject = $subject;

      return $this;
  }

  /**
   * Get subject
   *
   * @return string
   */
  public function getSubject()
  {
      return $this->subject;
  }

}

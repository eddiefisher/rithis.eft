<?php
// src/Eft/RithisBundle/Entity/Messages.php

namespace Eft\RithisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @orm\Entity
 * @ORM\Table(name="messages")
 */
class Messages
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;
  
  /**
   * @orm\Column(type="string", length="255", name="mail_to")
   * @Assert\NotBlank()
   * @Assert\Email()
   */
  protected $mailTo;
  
  /**
   * @orm\Column(type="string", length="255", name="mail_subject")
   * @Assert\NotBlank()
   */
  protected $mailSubject;
  
  /**
   * @orm\Column(type="text", name="mail_content")
   * @Assert\NotBlank()
   */
  protected $mailContent;
  
  /**
   * @orm\Column(type="datetime", name="created_at")
   */
  protected $createdAt;
  
  function __construct()
  {
    $this->createdAt = new \DateTime();
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
     * Set mailTo
     *
     * @param string $mailTo
     */
    public function setMailTo($mailTo)
    {
        $this->mailTo = $mailTo;
    }

    /**
     * Get mailTo
     *
     * @return string 
     */
    public function getMailTo()
    {
        return $this->mailTo;
    }

    /**
     * Set mailSubject
     *
     * @param string $mailSubject
     */
    public function setMailSubject($mailSubject)
    {
        $this->mailSubject = $mailSubject;
    }

    /**
     * Get mailSubject
     *
     * @return string 
     */
    public function getMailSubject()
    {
        return $this->mailSubject;
    }

    /**
     * Set mailContent
     *
     * @param text $mailContent
     */
    public function setMailContent($mailContent)
    {
        $this->mailContent = $mailContent;
    }

    /**
     * Get mailContent
     *
     * @return text 
     */
    public function getMailContent()
    {
        return $this->mailContent;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
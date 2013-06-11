<?php

namespace S118\EbrahimiBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity
 */
class PhoneEntity
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $type;

    /** 
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $status;

    /** 
     * @ORM\Column(type="string", length=11, nullable=false)
     */
    private $number;

    /** 
     * @ORM\ManyToOne(targetEntity="PersonEntity", inversedBy="PhoneEntities")
     * @ORM\JoinColumn(name="pid", referencedColumnName="id", nullable=false)
     */
    private $PersonEntity;

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
     * Set type
     *
     * @param boolean $type
     * @return PhoneEntity
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return boolean 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return PhoneEntity
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set number
     *
     * @param string $number
     * @return PhoneEntity
     */
    public function setNumber($number)
    {
        $this->number = $number;
    
        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set PersonEntity
     *
     * @param \S118\EbrahimiBundle\Entity\PersonEntity $personEntity
     * @return PhoneEntity
     */
    public function setPersonEntity(\S118\EbrahimiBundle\Entity\PersonEntity $personEntity)
    {
        $this->PersonEntity = $personEntity;
    
        return $this;
    }

    /**
     * Get PersonEntity
     *
     * @return \S118\EbrahimiBundle\Entity\PersonEntity 
     */
    public function getPersonEntity()
    {
        return $this->PersonEntity;
    }
}
<?php

namespace S118\EbrahimiBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Assetic\Filter\GoogleClosure\CompilerApiFilter;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity
 * @ORM\Table(indexes={@ORM\Index(name="family", columns={"ln"})})
 */
class PersonEntity
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(type="string", length=25, nullable=false)
     */
    private $fn;

    /** 
     * @ORM\Column(type="string", length=30, nullable=false)
     */
    private $ln;

    /** 
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $city;

    /** 
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $street;

    /** 
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $alley;

    /** 
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $type;

    /** 
     * @ORM\OneToMany(targetEntity="PhoneEntity", mappedBy="PersonEntity")
     */
    private $PhoneEntities;
    /**
     * Constructor
     */

    /**
     * @ORM\Column(name="fileName", type="string", length=255, nullable=true)
     */
    private $fileName;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    public function __construct()
    {
        $this->PhoneEntities = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set fn
     *
     * @param string $fn
     * @return PersonEntity
     */
    public function setFn($fn)
    {
        $this->fn = $fn;
    
        return $this;
    }

    /**
     * Get fn
     *
     * @return string 
     */
    public function getFn()
    {
        return $this->fn;
    }

    /**
     * Set ln
     *
     * @param string $ln
     * @return PersonEntity
     */
    public function setLn($ln)
    {
        $this->ln = $ln;
    
        return $this;
    }

    /**
     * Get ln
     *
     * @return string 
     */
    public function getLn()
    {
        return $this->ln;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return PersonEntity
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return PersonEntity
     */
    public function setStreet($street)
    {
        $this->street = $street;
    
        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set alley
     *
     * @param string $alley
     * @return PersonEntity
     */
    public function setAlley($alley)
    {
        $this->alley = $alley;
    
        return $this;
    }

    /**
     * Get alley
     *
     * @return string 
     */
    public function getAlley()
    {
        return $this->alley;
    }

    /**
     * Set type
     *
     * @param boolean $type
     * @return PersonEntity
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
     * Set fileName
     *
     * @param string $fileName
     * @return Document
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Add PhoneEntities
     *
     * @param \S118\EbrahimiBundle\Entity\PhoneEntity $phoneEntities
     * @return PersonEntity
     */
    public function addPhoneEntitie(\S118\EbrahimiBundle\Entity\PhoneEntity $phoneEntities)
    {
        $this->PhoneEntities[] = $phoneEntities;
    
        return $this;
    }

    /**
     * Remove PhoneEntities
     *
     * @param \S118\EbrahimiBundle\Entity\PhoneEntity $phoneEntities
     */
    public function removePhoneEntitie(\S118\EbrahimiBundle\Entity\PhoneEntity $phoneEntities)
    {
        $this->PhoneEntities->removeElement($phoneEntities);
    }

    /**
     * Get PhoneEntities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhoneEntities()
    {
        return $this->PhoneEntities;
    }

  public function __toString()
  {
      return $this->fn.' '.$this->ln;
  }

    public function getAbsolutePath()
    {
        return null === $this->fileName
            ? null
            : $this->getUploadRootDir().'/'.$this->fileName;
    }

    public function getWebPath()
    {
        return null === $this->fileName
            ? null
            : $this->getUploadDir().'/'.$this->fileName;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'bundles/118/persons/photoes';
    }

    public function upload($id)
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to

        $stringArray=explode(".",$this->getFile()->getClientOriginalName());
        $suffix=$stringArray[count($stringArray)-1];
        $this->fileName = ''.$this->id.'.'.$suffix;

        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->fileName
        );

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }
}
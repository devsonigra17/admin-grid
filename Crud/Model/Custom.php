<?php

namespace Dev\Crud\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Dev\Crud\Api\Data\CustomInterface;
 
class Custom extends AbstractModel implements CustomInterface , IdentityInterface
{
    const CACHE_TAG = 'id';
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0; 
    
    protected function _construct()
    {
        $this->_init('Dev\Crud\Model\ResourceModel\Custom');
    }
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }
	public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
	
	public function getId()
    {
        return parent::getData(self::ID);
    }
	
	public function getFname()
    {
        return $this->getData(self::FNAME);
    }
	
	public function getLname()
    {
        return $this->getData(self::LNAME);
    }
	
	public function getDob()
    {
        return $this->getData(self::DOB);
    }
	
	public function getGender()
    {
        return $this->getData(self::GENDER);
    }
	
	public function getImage()
    {
        return $this->getData(self::IMAGE);
    }

    public function getContact()
    {
        return $this->getData(self::CONTACT);
    }

    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    public function getHobby()
    {
        return $this->getData(self::HOBBY);
    }

    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }
	
	public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }
	
	public function setFname($fname)
    {
        return $this->setData(self::FNAME, $fname);
    }
	
	public function setLname($lname)
    {
        return $this->setData(self::LNAME, $lname);
    }
	
	public function setDob($dob)
    {
        return $this->setData(self::DOB, $dob);
    }
	
	public function setGender($gender)
    {
        return $this->setData(self::GENDER, $gender);
    }
	
	public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }

    public function setContact($contact)
    {
        return $this->setData(self::CONTACT, $contact);
    }
    
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    public function setHobby($hobby)
    {
        return $this->setData(self::HOBBY, $hobby);
    }

    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}
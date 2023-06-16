<?php

namespace Dev\Crud\Api\Data;

interface CustomInterface
{
    
    const ID = 'id';
    const FNAME = 'fname';
    const LNAME = 'lname';
    const DOB = 'dob';
    const GENDER = 'gender';
    const IMAGE = 'image';
    const CONTACT = 'contact';
    const EMAIL = 'email';
    const HOBBY = 'hobby';
    const STATUS = 'status';


    public function getId();

    public function setId($id);

    public function getFname();

    public function setFname($fname);

    public function getLname();

    public function setLname($lname);

    public function getDob();

    public function setDob($dob);

    public function getGender();

    public function setGender($gender);

    public function getImage();

    public function setImage($image);

    public function getContact();

    public function setContact($contact);

    public function getEmail();
    
    public function setEmail($email);

    public function getHobby();
    
    public function setHobby($hobby);

    public function getStatus();
    
    public function setStatus($status);
}

<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment_Model extends CI_Model
{
	/*
  * A private variable to represent each column in the database
  */
  private $_postNumber;
  private $_name;
  private $_email;
	private $_website;
	private $_comment;
	private $_submittedAt;

  function __construct()
  {
    parent::__construct();
  }
	/*
  * Class Methods
  */
  /**
  * Commit method, this will comment the entire object to the database
  */
  public function commit()
  {
    $data = array(
      'postNumber' => $this->_postNumber,
      'name' => $this->_name,
			'email' => $this->_email,
			'wesbite' => $this->_website,
			'comment' => $this->_comment,
			'submittedAt' => $this->_submittedAt
    );
    if($this->_postNumber > 0)
		{
      //We have an ID so we need to update this object because it is not new
      if($this->db->update("wallContents", $data, array("postNumber" => $this->_postNumber)))
			{
        return true;
      }
    }
		else
		{
      //We dont have an ID meaning it is new and not yet in the database so we need to do an insert
      if($this->db->insert("wallContents", $data))
			{
				/* THIS IS THE POINT OF FAILURE IT CAN'T INSERT INTO THE DB!!! */
        //Now we can get the ID and update the newly created object
        $this->_postNumber = $this->db->insert_postNumber();
        return true;
      }
    }
    return false;
  }
	/*
  * SET's & GET's
  * Set's and get's allow you to retrieve or set a private variable on an object
  */
	public function getPostNumber()
	{
		return $this->_postNumber;
	}
	public function setPostNumber($value)
	{
		$this->_postNumber = $value;
	}

	public function getName()
	{
		return $this->_name;
	}
	public function setName($value)
	{
		$this->_name = $value;
	}

	public function getEmail()
	{
		return $this->_email;
	}
	public function setEmail($value)
	{
		$this->_email = $value;
	}

	public function getWebsite()
	{
		return $this->_website;
	}
	public function setWebsite($value)
	{
		$this->_website = $value;
	}

	public function getComment()
	{
		return $this->_comment;
	}
	public function setComment($value)
	{
		$this->_comment = $value;
	}

	public function getSubmittedAt()
	{
		return $this->_submittedAt;
	}
	public function setSubmittedAt($value)
	{
		$this->_submittedAt = $value;
	}
}

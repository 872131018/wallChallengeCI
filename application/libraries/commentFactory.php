<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CommentFactory
{
	private $_ci;

	function __construct()
  {
		//When the class is constructed get an instance of codeigniter so we can access it locally
		$this->_ci =& get_instance();
		//Include the comment_model so we can use it
		$this->_ci->load->model("comment_model");
  }
	/*
	*First check is to see if request is for one for for all of them
	*Then the database is queried appropriately and the models are created
	*/
  public function getComments($postNumber = 0)
	{
		if($postNumber > 0)
		{
			//Getting an individual user
			$query = $this->_ci->db->get_where("wallContents", array("postNumber" => $postNumber));
			//Check if any results were returned
			if ($query->num_rows() > 0)
			{
				//Pass the data to our local function to create an object for us and return this new object
				return $this->createObjectFromData($query->row());
			}
			else
			{
				return false;
			}
		}
		else
		{
			//Getting all the users
			$results = $this->_ci->db->select("*")->from("wallContents")->get();
			//Check if any results were returned
			if ($results->num_rows() > 0)
			{
				//Create an array to store users
				$comments = array();
				//Loop through each row returned from the query
				foreach ($results->result() as $row)
				{
					//Pass the row data to our local function which creates a new user object with the data provided and add it to the users array
					$comments[] = $this->createObjectFromData($row);
				}
				//Return the users array
				return $comments;
			}
			else
			{
				return false;
			}
		}
  }
	/*
	*Commit comment to the database
	*/
	public function saveComment($passedComment)
	{
		/*
		*TODO: these methods need to be integrated and have error handling
		*/
		$comment = $this->createObjectFromData($passedComment);
		$comment->commit();
		return true;
	}
	/*
	*TODO: Move this setting to constructor
	*Constructor should probably get take an array
	*/
  public function createObjectFromData($row)
	{
		/*
		*Use type juggling to ensure object style syntax will work
		*/
		$row = (object)$row;
		/*
		*New comments wont have a post number or a submitted time
		*/
		if(!isset($row->postNumber))
		{
			$row->postNumber = null;
		}
		if(!isset($row->submittedAt))
		{
			$row->submittedAt = null;
		}
		//Create a new comment_model object
		$comment = new Comment_Model();
		//Set the postnumber on the comment model
		$comment->setPostNumber($row->postNumber);
		//Set the name on the comment model
		$comment->setName($row->name);
		//Set the email on the comment model
		$comment->setEmail($row->email);
		//set the website on the comment model
		$comment->setWebsite($row->website);
		//set the comment on the comment model
		$comment->setComment($row->comment);
		//set the submittedAt on the comment model
		$comment->setSubmittedAt($row->submittedAt);
		//Return the new user object
		return $comment;
  }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$this->load->view('welcome_message');
		/*
		*First thing is to load the index html
		*/
		$this->load->view('main_view');
	}
	/*
	*When the page calls for a wall update through ajax
	*/
	public function fillWall($postNumber = 0)
	{
		//Always ensure an integer
		$postNumber = (int)$postNumber;
		/*
		*The factory is where you put the models to work and manages them
		*/
		$this->load->library("CommentFactory");
		/*
		*Fill wall supports parameters
		*TODO: Convert request to use CI style parameters
		*/
		switch($_POST['action'])
		{
			case 'getWallContents':
				//$result = $manager->getWallContents($_GET['sortOrder']);
				//Create a data array so we can pass information to the view
				//TODO: Convert to using an object rather than an array
				/*
				*Each key of $data will be available as variable in view
				*/
		    $data = array(
		            "comments" => $this->commentfactory->getComments($postNumber)
		            );
		    $this->load->view("json_view", $data);
				/*
				if($result == NULL)
				{
					echo 'false';
				}
				else
				{
					echo $result;
				}
				*/
				break;
			case 'saveComment':
				if($this->commentfactory->saveComment($this->input->post()))
				{
					echo 'here';
				}
				break;
			default:
				echo 'false';
				break;
		}
	}
}

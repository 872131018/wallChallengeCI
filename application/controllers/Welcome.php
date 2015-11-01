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
		$this->load->view('login_view');
	}
	/*
	*When the page calls for a wall update through ajax
	*/
	public function fillWall()
	{
		echo 'here';
		var_dump($_GET);
		/*
		*Fill wall supports parameters
		*TODO: Convert request to use CI style parameters
		*/
		/*
		*TODO! Create a model for the comment and set up the database
		*/
		switch($_GET['action'])
		{
			case 'getWallContents':
				//$result = $manager->getWallContents($_GET['sortOrder']);
				if($result == NULL)
				{
					echo 'false';
				}
				else
				{
					echo $result;
				}
				break;
			default:
				echo 'false';
				break;
		}
	}
}

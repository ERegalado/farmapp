<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Farmapp extends CI_Controller {

	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the CI_Controller constructor						*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){
		parent::__construct();		
		$this->load->helper('js'); //load the js helper
		$this->load->model('mediModel');
	}
	
	public function index()
	{			
		//print_r($this->mediModel->getAll());
		$data = array(			
			'title' 		=> 'Bienvenido a Farmapp', 
			'mainView' 		=> 'home',
			'scripts'		=> jUI().maps()
		);		
		
		$this->load->view('template/wrapper',$data);
	}
	
	public function getCoincidences($medi){			
		echo json_encode($this->mediModel->getCoincidences(urldecode($medi)));
	}
	
	public function get($mediId){			
		echo json_encode($this->mediModel->get(urldecode($mediId)));
	}
}

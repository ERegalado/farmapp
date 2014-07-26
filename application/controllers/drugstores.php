<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Drugstores extends CI_Controller {

	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the CI_Controller constructor						*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){
		parent::__construct();		
		$this->load->helper('js'); //load the js helper
		$this->load->model('drugstoreModel');
	}
	
	public function index()
	{			
		//print_r($this->drugstoreModel->getAll());
		$data = array(			
			'title' 		=> 'Bienvenido a MediSV', 
			'mainView' 		=> 'home',
			'scripts'		=> jUI().maps()
		);		
		
		$this->load->view('template/wrapper',$data);
	}
	
	public function getCoincidences($dstore){			
		echo json_encode($this->drugstoreModel->getCoincidences(urldecode($dstore)));
	}
	
	public function get($mediId){			
		echo json_encode($this->drugstoreModel->get(urldecode($mediId)));
	}
}

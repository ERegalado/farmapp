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
		header('Access-Control-Allow-Origin: *');
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
	
	public function get($dstore){			
		echo json_encode($this->drugstoreModel->get(urldecode($dstore)));
	}
	
	public function getMedicines($dstore){			
		echo json_encode($this->drugstoreModel->getMedicines(urldecode($dstore)));
	}
	
	public function getTop(){			
		echo json_encode($this->drugstoreModel->getTop());
	}
	
	public function getNearest($lat,$lon,$mediId){			
		echo json_encode($this->drugstoreModel->getNearest(urldecode($lat),urldecode($lon),urldecode($mediId)));
	}
	
}

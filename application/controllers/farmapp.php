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
		header('Access-Control-Allow-Origin: *');
	}
	
	public function index()
	{			
		$this->load->model('drugstoreModel');
		$data = array(			
			'title' 		=> 'Bienvenido a Farmapp', 
			'mainView' 		=> 'home',
			'scripts'		=> jUI().maps().raty(),
			'topDS'			=> $this->drugstoreModel->getTop(),
			'topMedi'		=> $this->mediModel->getTop()
		);		
		
		$this->load->view('template/wrapper',$data);
	}
	
	public function getCoincidences($medi){			
		echo json_encode($this->mediModel->getCoincidences(urldecode($medi)));
	}
	
	public function get($mediId){
		//Update clicks
		$mediId = urldecode($mediId);
		$this->mediModel->updateClicks($mediId);
		echo json_encode($this->mediModel->get($mediId));
	}
	
	public function getDrugstores($mediId){
		echo json_encode($this->mediModel->getDrugstores(urldecode($mediId)));
	}
	
	public function getTop(){
		echo json_encode($this->mediModel->getTop());
	}	
	
	public function getPrice($medi){			
		echo json_encode($this->mediModel->get(urldecode($medi)));
	}
}

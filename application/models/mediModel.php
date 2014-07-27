<?php

class MediModel extends CI_Model{
	/*--------------------------------------------------------------------------*/
	/*  __construct ==> Call the Model constructor 								*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function __construct(){parent::__construct();}		
	
	/*--------------------------------------------------------------------------*/
	/*  getAll ==> gets all the Medicines										*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getAll(){
		$this->db->order_by('name','asc');
		return $this->db->get('med_medicine')->result_array();		
	}
	
	/*--------------------------------------------------------------------------*/
	/*  get ==> gets the info of a single medicine								*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function get($mediId){		
		return $this->db->get_where('med_medicine',array('idmedicine' => $mediId))->row_array();		
	}
	
	/*--------------------------------------------------------------------------*/
	/*  getCoincidences ==> gets the medicines that coincide with the criteria	*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getCoincidences($medi){
		$this->db->select('idmedicine,concentration,units');
		$this->db->select('CONCAT(name, ", ", concentration, units) name',false);		
		$this->db->like('name',$medi);
		$this->db->order_by('name','asc');		
		return $this->db->get('med_medicine')->result_array();		
	}
	
	/*--------------------------------------------------------------------------*/
	/*  getCoincidences ==> gets the medicines that coincide with the criteria	*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getDrugstores($mediId){
		$sql = "SELECT drugstores.iddrugstore, drugstores.name, CONCAT(address, ', ', cities.name, ', ', states.name) AS address, 
		IFNULL((SELECT AVG(IFNULL(rating,0)) FROM comments WHERE iddrugstore=drugstores.iddrugstore),0)
		rating, latitude, longitude FROM drugstores INNER JOIN medDrug ON drugstores.iddrugstore = medDrug.iddrugstore INNER JOIN cities ON 
		cities.idcity=drugstores.idcity INNER JOIN states ON states.idstate=cities.idstate WHERE medDrug.idmedicine=".$mediId;
		$res = $this->db->query($sql)->result_array();
		//echo $this->db->last_query();
		return $res;		
	}
	
	/*--------------------------------------------------------------------------*/
	/*  getTop ==> gets most voted												*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getTop(){
		$this->db->order_by('clicks','desc');
		$this->db->limit(6);
		return $this->db->get('med_medicine')->result_array();		
	}
			
	/*--------------------------------------------------------------------------*/
	/*  add ==> Inserts a new asset type with the data provided 				*/
	/*																			*/
	/*  $data 	- Array containing the info of the asset						*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function add($data){
		$this->db->insert('med_medicine',$data);		
	}
			
	/*--------------------------------------------------------------------------*/
	/*  update ==> Updates the info of the asset 			 					*/	
	/*																			*/
	/*  $asset 	- Asset's ID 													*/
	/*  $data 	- Array containing the new info of the asset					*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function update($medi,$data){
		$this->db->where(array('idmedicine' => $medi));
		$this->db->update('med_medicine',$data);
	}
	
	/*--------------------------------------------------------------------------*/
	/*  delete ==> Deletes a cat 												*/
	/*																			*/
	/*  $place 	: ID of the cat to delete 									 	*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function delete($cat){
		$this->db->where(array('asset_type' => $cat));
		$this->db->delete('asset_types');
		return true;
	}
	
	/*--------------------------------------------------------------------------*/
	/*  update ==> Updates the info of the asset 			 					*/	
	/*																			*/
	/*  $asset 	- Asset's ID 													*/
	/*  $data 	- Array containing the new info of the asset					*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function updateClicks($medi){
		$sql ="update med_medicine set clicks = clicks+1 where idmedicine=".$medi;
		return $this->db->query($sql);
	}
}
<?php

class DrugstoreModel extends CI_Model{
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
	function get($drugstoreId){		
		return $this->db->get_where('drugstores',array('iddrugstore' => $drugstoreId))->row_array();		
	}
	
	/*--------------------------------------------------------------------------*/
	/*  getCoincidences ==> gets the drug stores that match with the criteria	*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getCoincidences($drugstore){
		$this->db->select('iddrugstore, name, latitude, longitude ');
		$this->db->like('name',$drugstore);
		$this->db->order_by('name','asc');
		return $this->db->get('drugstores')->result_array();		
	}
	
	/*--------------------------------------------------------------------------*/
	/*  getNearest => Gets the nearest drugstores								*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getNearest($lat,$lon){
		return $this->db->get_where('drugstores',array('iddrugstore' => $drugstoreId))->row_array();		
	}
			
	/*--------------------------------------------------------------------------*/
	/*  add ==> Inserts a new asset type with the data provided 				*/
	/*																			*/
	/*  $data 	- Array containing the info of the asset						*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function add($data){
		$this->db->insert('asset_types',$data);		
	}
			
	/*--------------------------------------------------------------------------*/
	/*  update ==> Updates the info of the asset 			 					*/	
	/*																			*/
	/*  $asset 	- Asset's ID 													*/
	/*  $data 	- Array containing the new info of the asset					*/
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function update($cat,$data){
		$this->db->where(array('asset_type' => $cat));
		$this->db->update('asset_types',$data);
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
}
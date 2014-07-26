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
		$this->db->select('idmedicine,name,concentration,units');
		$this->db->like('name',$medi);
		$this->db->order_by('name','asc');		
		return $this->db->get('med_medicine')->result_array();		
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
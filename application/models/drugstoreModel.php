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
		$sql = "SELECT drugstores.iddrugstore, drugstores.name, CONCAT(address, ', ', cities.name, ', ', states.name) AS address, 
		latitude, longitude FROM drugstores 
		INNER JOIN cities ON cities.idcity=drugstores.idcity 
		INNER JOIN states ON states.idstate=cities.idstate 
		WHERE drugstores.name like '%".$drugstore."%'";
		return $this->db->query($sql)->result_array();		
	}
	
	/*--------------------------------------------------------------------------*/
	/*  getMedicines ==> gets the drug stores that match with the criteria		*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getMedicines($drugstore){
		$sql = "SELECT CONCAT(name, ', ', concentration, units) name FROM med_medicine INNER JOIN medDrug ON med_medicine.idmedicine=medDrug.idmedicine WHERE iddrugstore= ".$drugstore;
		return $this->db->query($sql)->result_array();		
	}
	
	/*--------------------------------------------------------------------------*/
	/*  getMedicines ==> gets the drug stores that match with the criteria		*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getTop(){
		$sql = "SELECT drugstores.iddrugstore, drugstores.name, drugstores.photo,
		(SELECT AVG(IFNULL(rating,0)) FROM comments WHERE iddrugstore=drugstores.iddrugstore) rating
		FROM drugstores INNER JOIN medDrug ON drugstores.iddrugstore = medDrug.iddrugstore ORDER BY rating DESC
		LIMIT 3";
		return $this->db->query($sql)->result_array();		
	}
	
	/*--------------------------------------------------------------------------*/
	/*  getNearest => Gets the nearest drugstores								*/	
	/*																			*/
	/*--------------------------------------------------------------------------*/
	function getNearest($lat,$lon,$medId){
		$sql = "SELECT d.*, 
		3956 * 2 * ASIN(SQRT(
		POWER(SIN((".$lat." -
		ABS( 
		latitude)) * PI()/180 / 2),2) + COS(".$lat." * PI()/180 ) * COS( 
		ABS
		(latitude) *  PI()/180) * POWER(SIN((".$lon."-longitude) *  PI()/180 / 2), 2) )) distance
		
		FROM medDrug md,drugstores d
		WHERE md.iddrugstore = d.iddrugstore
		AND md.idmedicine = ".$medId."
		HAVING distance < 10 ORDER BY distance LIMIT 10";
		return $this->db->query($sql)->result_array();		
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
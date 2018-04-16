<?php
include 'db.php';


class SQL  {
	private $db;
	public $result_query_email;
	public $email_array = array();
	public $result_query_user;
	public $result_query_regions;
	public $regions_array = array();
	public $result_query_city;
	public $city_array = array();
	public $result_query_district;
	public $district_array = array();
	
	public function __construct()
	{
		$this->db = new DB;
	}
	
	public function requestEmail() {
		$this->result_query_email = $this->db->mysqli->query("SELECT `id`,`email` FROM `registered_users`");
		
		while($row = $this->result_query_email->fetch_assoc()) {
			$this->email_array[] = $row;
		}
		return $this->email_array;
	}
	
	public function requestUser()
	{
		$this->result_query_user = $this->db->mysqli->query( "SELECT * FROM `registered_users` WHERE id =" . base64_decode( $_GET[ 'id' ] ) );
		return $this->result_query_user;
	}
	
	public function requestRegion(){
		$this->result_query_regions = $this->db->mysqli->query( "SELECT `ter_address` FROM `t_koatuu_tree` WHERE ter_type_id = 0" );
		while($row = $this->result_query_regions->fetch_assoc()) {
			$this->regions_array[] = $row;
		}
		return $this->regions_array;
	}
	
	public function requestCity($region){
		$this->result_query_city = $this->db->mysqli->query("SELECT `ter_name` FROM `t_koatuu_tree` WHERE ter_type_id = 1 AND ter_address LIKE '%".$region."'");
		while($row = $this->result_query_city->fetch_assoc()) {
			$this->city_array[] = $row;
		}
		return $this->city_array;
	}
	
	public function requestDistrict($region) {
		$this->result_query_district = $this->db->mysqli->query("SELECT `ter_name` FROM `t_koatuu_tree` WHERE ter_name LIKE '%район%' AND ter_address LIKE '%". $region ."%'");
		while($row = $this->result_query_district->fetch_assoc()) {
			$this->district_array[] = $row;
		}
		return $this->district_array;
	}
	
	public function addUserToDb ( $name, $email, $region, $city, $district ){
		$name = '"'.$this->db->mysqli->real_escape_string( $name ).'"';
		$email = '"'.$this->db->mysqli->real_escape_string( $email ).'"';
		$region = '"'.$this->db->mysqli->real_escape_string( $region ).'"';
		$city = '"'.$this->db->mysqli->real_escape_string( $city ).'"';
		$district = '"'.$this->db->mysqli->real_escape_string( $district ).'"';

		$insert_row = $this->db->mysqli->query("INSERT INTO registered_users (name, email, region, city, district) VALUES($name, $email,
$region, $city, $district)");
		
//		if($insert_row){
//			print 'Success! ID of last inserted record is : ' .$db->mysqli->insert_id .'<br />';
//		}else{
//			die('Error : ('. $db->mysqli->errno .') '. $db->mysqli->error);
//		}
	}
	
}

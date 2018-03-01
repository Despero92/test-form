<?php
include '..\model\sql_queries.php';


$sql = new SQL;
//$email_query_array = $sql->requestEmail();
$controller  = new Controller;


if( isset( $_GET[ 'email' ] ) ){
	$controller->email();
}
if( isset( $_GET[ 'region' ] ) ){
	$controller->createCityList();
}
if( isset( $_GET[ 'district' ] ) ){
	$controller->createDistrictList();
}


class Controller {
	private $sql;
	public $email;
	public $emails_array = array();
	public $result_query;
	public $city;
	public $city_array;
	public $district;
	public $district_array;
	
	public function __construct()
	{
		$this->sql = new SQL;
	}
	
	public function email (){
		if ( isset( $_GET[ 'email' ] ) ) {
			$this->email  = $_GET['email'];
			$this->email  = trim( $_GET[ 'email' ] );
			$this->email  = strip_tags( $this->email  );
			$this->email  = stripslashes( $this->email  );
			$this->email  = htmlspecialchars( $this->email , ENT_QUOTES );
			$this->checkEmail( $this->email , $this->sql->requestEmail() );
		}
	}
	
	public function checkEmail ( $email, $emails_array )
	{
		foreach ( $emails_array as $key => $value ) {
			if ( $email === $emails_array[ $key ][ 'email' ] ) {
				echo json_encode( array(
					  'link' => 'http://artjoker/card_user.php?id=' . base64_encode( $emails_array[ $key ][ 'id' ] )
				) );
				return;
			} else {
				echo json_encode( array( 'link' => 'false' ) );
				return;
			}
		}
	}
	
	public function createCityList(){
		if ( isset( $_GET[ 'region' ] ) ){
			$this->city  = $_GET['region'];
			$this->city  = trim( $_GET[ 'region' ] );
			$this->city  = strip_tags( $this->city  );
			$this->city  = stripslashes( $this->city  );
			$this->city  = htmlspecialchars( $this->city , ENT_QUOTES );
			$this->city_array = $this->sql->requestCity( $this->city );
			echo json_encode( $this->city_array );
			return;
		}
	}
	
	public function createDistrictList(){
		if ( isset( $_GET[ 'district' ] ) ){
			$this->district  = $_GET['district'];
			$this->district  = trim( $_GET[ 'district' ] );
			$this->district  = strip_tags( $this->district  );
			$this->district  = stripslashes( $this->district  );
			$this->district  = htmlspecialchars( $this->district , ENT_QUOTES );
			$this->district_array = $this->sql->requestDistrict( $this->district );
			echo json_encode( $this->district_array );
			return;
		}
	}
	
	public function completeRegistration (){
		$this->sql->addUserToDb( $_POST['name'], $_POST['email'], $_POST['region'], $_POST['city'], $_POST['district']);
	}
}


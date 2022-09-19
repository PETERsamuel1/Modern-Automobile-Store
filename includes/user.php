<?php 

/**
* 
*/
class User
{

	private $con;
	
	function __construct()
	{
		include_once("../database/db.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	//CHECK WHETHER ADMIN EMAIL ALREADY REGISTERED
	private function checkAdminExists($email)
	{
		$pre_stmt = $this->con->prepare("SELECT id FROM admin WHERE email = ?");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows > 0) {
			return 1;
		}else{
			return 0;
		}
	}

	//REGISTER ADMIN
	public function registerAdmin($firstname,$lastname,$idno,$phone,$email,$password)
	{
		if($this->checkAdminExists($email)){
			return "ADMIN_ALREADY_REGISTERED";
		}else{
			$pass_hash = password_hash($password,PASSWORD_BCRYPT,["cost"=>8]);

			$date = time();

			$profilephoto = "";

			$pre_stmt = $this->con->prepare("INSERT INTO `admin`(`firstname`, `lastname`, `idno`, `phone`, `email`, `password`,`registered_date`,`profile_photo`) VALUES (?,?,?,?,?,?,?,?)");
			$pre_stmt->bind_param("ssssssss",$firstname,$lastname,$idno,$phone,$email,$pass_hash,$date,$profilephoto);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return "SUCCESSFULLY_REGISTERED";
			}else{
				return "UNKOWN_ERROR";
			}
		}
	}

	//ADMIN LOGIN
	public function adminLogin($email, $password){
		$pre_stmt = $this->con->prepare("SELECT * FROM admin WHERE email = ?");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();

		if ($result->num_rows < 1) {
			return "NOT_REGISTERED";
		}else{
			$row = $result->fetch_assoc();
			if (password_verify($password,$row["password"])) {
				$_SESSION["adminid"] = $row["id"];
				$_SESSION["adminfirstname"] = $row["firstname"];
				$_SESSION["adminlastname"] = $row["lastname"];
				$_SESSION["adminidno"] = $row["idno"];
				$_SESSION["adminphone"] = $row["phone"];
				$_SESSION["adminemail"] = $row["email"];
				$_SESSION["adminprofilephoto"] = $row["profile_photo"];
				return "LOGGED_IN";
			}else {
				return "PASSWORD_NOT_MATCHED";
			}
		}
	}

	public function getCustomerDetails($userid){
		$pre_stmt = $this->con->prepare("SELECT * FROM customer_table WHERE id = ?");
		$pre_stmt->bind_param("i",$userid);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		  }
		  return $rows;
		}
	}

	//ADD NEW CONTACT INFO
	public function addNewContact($contactname, $contactemail, $contactphone, $contactmessage){
		$date = time();

		$pre_stmt = $this->con->prepare("INSERT INTO `contact_table`(`contact_name`, `contact_email`, `contact_phone`, `contact_message`, `date_created`) VALUES (?,?,?,?,?)");
		$pre_stmt->bind_param("sssss",$contactname,$contactemail,$contactphone,$contactmessage,$date);
		$result = $pre_stmt->execute() or die($this->con->error);
		if ($result) {
			return "SUCCESSFULLY_ADDED";
		}else{
			return "UNKOWN_ERROR";
		}
	}

	//CHECK WHETHER CUSTOMER EMAIL ALREADY REGISTERED
	private function checkCustomerExists($email)
	{
		$pre_stmt = $this->con->prepare("SELECT id FROM customer_table WHERE email = ?");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows > 0) {
			return 1;
		}else{
			return 0;
		}
	}

	//CHANGE CUSTOMER PASSWORD
	public function changeCustomerPassword($email,$password){
		$pre_stmt = $this->con->prepare("SELECT id FROM customer_table WHERE email = ?");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows < 1) {
			return "NOT_REGISTERED";
		}else{
			$row = $result->fetch_assoc();
			$customerid = $row["id"];
			$newpassword = password_hash($password,PASSWORD_BCRYPT,["cost"=>8]);

			$pre_stmt = $this->con->prepare("UPDATE `customer_table` SET `password`=? WHERE id = ?");
			$pre_stmt->bind_param("si",$newpassword,$customerid);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return "SUCCESSFULLY_UPDATED";
			}else{
				return "UNKOWN_ERROR";
			}
		}
	}

	//REGISTER CUSTOMER
	public function registerCustomer($firstname,$lastname,$phone,$email,$password,$address,$apartment,$country,$city,$postcode)
	{
		if($this->checkCustomerExists($email)){
			return "CUSTOMER_ALREADY_REGISTERED";
		}else{

			
			$pass_hash = password_hash($password,PASSWORD_BCRYPT,["cost"=>8]);


			$date = time();

			$pre_stmt = $this->con->prepare("INSERT INTO `customer_table`(`firstname`, `lastname`, `phone`, `email`, `password`, `address`, `apartment`, `country`, `city`, `postcode`, `registered_date`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
			$pre_stmt->bind_param("sssssssssss",$firstname,$lastname,$phone,$email,$pass_hash,$address,$apartment,$country,$city,$postcode,$date);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return "SUCCESSFULLY_REGISTERED";
			}else{
				return "UNKOWN_ERROR";
			}
		}
	}

	//UPDATE CUSTOMER
	public function updateCustomer($firstname,$lastname,$phone,$email,$address,$apartment,$country,$city,$postcode,$userid)
	{

		$pre_stmt = $this->con->prepare("UPDATE `customer_table` SET `firstname`=?,`lastname`=?,`phone`=?,`email`=?,`address`=?,`apartment`=?,`country`=?,`city`=?,`postcode`=? WHERE id = ?");
		$pre_stmt->bind_param("ssssssssss",$firstname,$lastname,$phone,$email,$address,$apartment,$country,$city,$postcode,$userid);
		$result = $pre_stmt->execute() or die($this->con->error);
		if ($result) {
			return "SUCCESSFULLY_UPDATED";
		}else{
			return "UNKOWN_ERROR";
		}
	}

	private function updateCartUser($userid){
		$ip_add = getenv("REMOTE_ADDR");
		$pre_stmt = $this->con->prepare("UPDATE cart_table SET user_id = ?  WHERE ip_address = ?");
		$pre_stmt->bind_param("is",$userid,$ip_add);
		$pre_stmt->execute() or die($this->con->error);
	}

	//CUSTOMER LOGIN
	public function customerLogin($email, $password){
		$pre_stmt = $this->con->prepare("SELECT * FROM customer_table WHERE email = ?");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();

		if ($result->num_rows < 1) {
			return "NOT_REGISTERED";
		}else{
			$row = $result->fetch_assoc();
			if (password_verify($password,$row["password"])) {
				$_SESSION["customerid"] = $row["id"];
				$_SESSION["customerfirstname"] = $row["firstname"];
				$_SESSION["customerlastname"] = $row["lastname"];
				$_SESSION["customerphone"] = $row["phone"];
				$_SESSION["customeremail"] = $row["email"];
				$this->updateCartUser($_SESSION["customerid"]);
				return "LOGGED_IN";
			}else {
				return "PASSWORD_NOT_MATCHED";
			}
		}
	}

}

//$u = new User();
//echo $u->registerAdmin("Peter","Samuel","33466987","0706209779","ptahsamuel@gmail.com","peter12345");
//echo $u->adminLogin("ptahsamuel@gmail.com","peter12345");

?>
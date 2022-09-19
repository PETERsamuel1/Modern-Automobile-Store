<?php

/**
* 
*/
class Service
{

	private $con;
	
	function __construct()
	{
		include_once("../database/db.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	//========================= CATEGORY =========================

	//CHECK WHETHER CATEGORY NAME EXISTS
	private function checkCategoryName($category_name)
	{
		$pre_stmt = $this->con->prepare("SELECT id FROM category_table WHERE category_name = ?");
		$pre_stmt->bind_param("s",$category_name);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows > 0) {
			return 1;
		}else{
			return 0;
		}

	}

	//ADD NEW CATEGORY
	public function addCategory($category_name)
	{
		if($this->checkCategoryName($category_name)){
			return "CATEGORY_ALREADY_EXISTS";
		}else{

			$status = "Active";
			$date = date('d/m/Y');

			$pre_stmt = $this->con->prepare("INSERT INTO `category_table`(`category_name`, `status`, `date_created`) VALUES (?,?,?)");
			$pre_stmt->bind_param("sss",$category_name,$status,$date);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return "CATEGORY_ADDED_SUCCESSFULLY";
			}else{
				return "UNKOWN_ERROR";
			}

		}

	}

	//GET ALL CATEGORIES WITH THEIR DETAILS
	public function getAllCategories()
	{
		$pre_stmt = $this->con->prepare("SELECT * FROM category_table ORDER BY date_created DESC");
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}
		return "NO_DATA";
	}

	public function getCollectionByProduct($productid){
		$pre_stmt = $this->con->prepare("SELECT category_id FROM product_table WHERE id = ?");
        $pre_stmt->bind_param("i",$productid);
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();
        if ($result->num_rows > 0) {
        	$row = $result->fetch_assoc();
			$catid = $row["category_id"];
        	if ($catid != "") {
        		$pre_stmt = $this->con->prepare("SELECT * FROM category_table WHERE id = ?");
		        $pre_stmt->bind_param("i",$catid);
		        $pre_stmt->execute() or die($this->con->error);
		        $result = $pre_stmt->get_result();
		        if ($result->num_rows > 0) {
		        	$rowz = $result->fetch_assoc();
		        	return $rowz;
		        }
        	}
        }
	}

	public function getCategoryById($catid){
		$pre_stmt = $this->con->prepare("SELECT * FROM category_table WHERE id = ?");
        $pre_stmt->bind_param("i",$catid);
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();
        if ($result->num_rows > 0) {
        	$rows = $result->fetch_assoc();
        	return $rows;
        }
	}

	public function getCategoryAndProduct($productid){
		$pre_stmt = $this->con->prepare("SELECT * FROM product_table WHERE id = ?");
        $pre_stmt->bind_param("i",$productid);
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();
        if ($result->num_rows > 0) {
        	$row = $result->fetch_assoc();
			$catid = $row["category_id"];
        	if ($catid != "") {
        		$pre_stmt = $this->con->prepare("SELECT * FROM category_table WHERE id = ?");
		        $pre_stmt->bind_param("i",$catid);
		        $pre_stmt->execute() or die($this->con->error);
		        $result = $pre_stmt->get_result();
		        if ($result->num_rows > 0) {
		        	$rowz = $result->fetch_assoc();
		        	return ["product"=>$row,"category"=>$rowz];
		        }
        	}
        }
	}

	//========================= END OF CATEGORY =========================

	//-------------------------------------------------------------------

	//========================= PRODUCT =========================

	//CHECK WHETHER PRODUCT NAME EXISTS
	private function checkProductName($product_name)
	{
		$pre_stmt = $this->con->prepare("SELECT id FROM product_table WHERE product_name = ?");
		$pre_stmt->bind_param("s",$product_name);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows > 0) {
			return 1;
		}else{
			return 0;
		}

	}

	//ADD NEW PRODUCT
	public function addProduct($category_id,$product_name,$product_image,$price,$description,$quantity)
	{
		if($this->checkProductName($product_name)){
			return "PRODUCT_ALREADY_EXISTS";
		}else{

			$status = "Active";
			$date = date('d/m/Y');

			$pre_stmt = $this->con->prepare("INSERT INTO `product_table`(`category_id`, `product_name`, `product_image`, `price`, `description`, `quantity`, `status`, `date_created`) VALUES (?,?,?,?,?,?,?,?)");
			$pre_stmt->bind_param("isssssss",$category_id,$product_name,$product_image,$price,$description,$quantity,$status,$date);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return "PRODUCT_ADDED_SUCCESSFULLY";
			}else{
				return "UNKOWN_ERROR";
			}

		}

	}

	public function getRelatedProducts($catid){
		$pre_stmt = $this->con->prepare("SELECT * FROM product_table WHERE category_id = ?");
        $pre_stmt->bind_param("i",$catid);
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();
        $rows = array();
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
            return $rows;
        } 
            return "NO_DATA";
	}

	public function getCategoriesSliderProducts(){
		$pre_stmt = $this->con->prepare("SELECT * FROM product_table LIMIT 6");
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();
        $rows = array();
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
            return $rows;
        } 
            return "NO_DATA";
	}

	public function getAllProducts($limit){
		$pre_stmt = $this->con->prepare("SELECT * FROM product_table LIMIT ".$limit);
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();
        $rows = array();
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
            return $rows;
        } 
            return "NO_DATA";
	}

	public function getAllCategoryProducts($catid,$limit){
		$pre_stmt = $this->con->prepare("SELECT * FROM product_table WHERE category_id = ? LIMIT ".$limit);
        $pre_stmt->bind_param("i",$catid);
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();
        $rows = array();
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
            return $rows;
        } 
            return "NO_DATA";
	}

	//========================= END OF PRODUCT =========================

	//-------------------------------------------------------------------

	//========================= CART =========================

	//CHECK WHETHER PRODUCT EXISTS IN CART
	private function checkCartProductByUserid($product_id,$user_id)
	{
		$pre_stmt = $this->con->prepare("SELECT id FROM cart_table WHERE product_id = ? AND user_id = ?");
		$pre_stmt->bind_param("ii",$product_id,$user_id);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows > 0) {
			return 1;
		}else{
			return 0;
		}

	}

	private function checkCartProductByIpaddress($product_id,$ip_add)
	{
		$pre_stmt = $this->con->prepare("SELECT id FROM cart_table WHERE product_id = ? AND ip_address = ?");
		$pre_stmt->bind_param("is",$product_id,$ip_add);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows > 0) {
			return 1;
		}else{
			return 0;
		}

	}

	//ADD NEW PRODUCT TO CART
	public function addCartProduct($product_id,$product_quantity)
	{

		if (isset($_SESSION["customerid"])) {
			$user_id = $_SESSION["customerid"];
			if ($this->checkCartProductByUserid($product_id,$user_id)) {
				return "PRODUCT_ALREADY_EXISTS";
			}else{
				//$ip = $_SERVER['REMOTE_ADDR'];
				//$m_time = mircotime();

				//$unique_id = md5($ip . $m_time . rand(0, time()));
				$ip_add = getenv("REMOTE_ADDR");
				$status = "Unpaid";
				$date = time();

				$pre_stmt = $this->con->prepare("SELECT price FROM product_table WHERE id=?");
				$pre_stmt->bind_param("i",$product_id);
				$pre_stmt->execute() or die($this->con->error);
		        $result = $pre_stmt->get_result();
		        if ($result->num_rows > 0) {
		            $price = $result->fetch_assoc();
		            $total_amount = $price["price"] * $product_quantity;
		            $pre_stmt = $this->con->prepare("INSERT INTO `cart_table`(`user_id`, `product_id`, `product_quantity`, `total_amount`, `ip_address`, `status`, `date_added`) VALUES (?,?,?,?,?,?,?)");
					$pre_stmt->bind_param("iisssss",$user_id,$product_id,$product_quantity,$total_amount,$ip_add,$status,$date);
					$result = $pre_stmt->execute() or die($this->con->error);
					if ($result) {
						return "PRODUCT_ADDED_SUCCESSFULLY";
					}else{
						return "UNKOWN_ERROR";
					}
		        }else{
		             return "NO_DATA";
		        }
			}
		}else{
			$ip_add = getenv("REMOTE_ADDR");
			if ($this->checkCartProductByIpaddress($product_id,$ip_add)) {
				return "PRODUCT_ALREADY_EXISTS";
			}else{

				$status = "Unpaid";
				$date = time();
				$user_id = "";

				$pre_stmt = $this->con->prepare("SELECT price FROM product_table WHERE id=?");
				$pre_stmt->bind_param("i",$product_id);
				$pre_stmt->execute() or die($this->con->error);
		        $result = $pre_stmt->get_result();
		        if ($result->num_rows > 0) {
		            $price = $result->fetch_assoc();
		            $total_amount = $price["price"] * $product_quantity;
		            $pre_stmt = $this->con->prepare("INSERT INTO `cart_table`(`user_id`, `product_id`, `product_quantity`, `total_amount`, `ip_address`, `status`, `date_added`) VALUES (?,?,?,?,?,?,?)");
					$pre_stmt->bind_param("iisssss",$user_id,$product_id,$product_quantity,$total_amount,$ip_add,$status,$date);
					$result = $pre_stmt->execute() or die($this->con->error);
					if ($result) {
						return "PRODUCT_ADDED_SUCCESSFULLY";
					}else{
						return "UNKOWN_ERROR";
					}
		        }else{
		             return "NO_DATA";
		        }
			}
		}

	}

	public function countCartTotalAmount(){
		if (isset($_SESSION["customerid"])) {
			$userid = $_SESSION["customerid"];
			$pre_stmt = $this->con->prepare("SELECT COUNT(*) AS count_item FROM cart_table WHERE user_id = ?");
			$pre_stmt->bind_param("i",$userid);
	        $pre_stmt->execute() or die($this->con->error);
	        $result = $pre_stmt->get_result();
	        if ($result->num_rows > 0) {
	            $count = $result->fetch_assoc();
	            return $count;
	        }else{
	             return "NO_DATA";
	        }
		}else{
			$ip_add = getenv("REMOTE_ADDR");
			$pre_stmt = $this->con->prepare("SELECT COUNT(*) AS count_item FROM cart_table WHERE ip_address = ?");
			$pre_stmt->bind_param("s",$ip_add);
	        $pre_stmt->execute() or die($this->con->error);
	        $result = $pre_stmt->get_result();
	        if ($result->num_rows > 0) {
	            $count = $result->fetch_assoc();
	            return $count;
	        }else{
	             return "NO_DATA";
	        }
		}
		
	}

	public function getTotalCartAmount(){
		if (isset($_SESSION["customerid"])) {
			$userid = $_SESSION["customerid"];
			$pre_stmt = $this->con->prepare("SELECT SUM(total_amount) AS total_amount FROM cart_table WHERE user_id = ?");
			$pre_stmt->bind_param("i",$userid);
	        $pre_stmt->execute() or die($this->con->error);
	        $result = $pre_stmt->get_result();
	        if ($result->num_rows > 0) {
	            $total_amount = $result->fetch_assoc();
	            return $total_amount;
	        }else{
	             return "NO_DATA";
	        }
		}else{
			$ip_add = getenv("REMOTE_ADDR");
			$pre_stmt = $this->con->prepare("SELECT SUM(total_amount) AS total_amount FROM cart_table WHERE ip_address = ?");
			$pre_stmt->bind_param("s",$ip_add);
	        $pre_stmt->execute() or die($this->con->error);
	        $result = $pre_stmt->get_result();
	        if ($result->num_rows > 0) {
	            $total_amount = $result->fetch_assoc();
	            return $total_amount;
	        }else{
	             return "NO_DATA";
	        }
		}
	}

	public function updateCartTotalAmount($field_value,$id){
		$pre_stmt = $this->con->prepare("SELECT product_id FROM cart_table WHERE id=?");
		$pre_stmt->bind_param("i",$id);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$product_id = $row["product_id"];
			$pre_stmt = $this->con->prepare("SELECT price FROM product_table WHERE id=?");
			$pre_stmt->bind_param("i",$product_id);
			$pre_stmt->execute() or die($this->con->error);
	        $result = $pre_stmt->get_result();
	        if ($result->num_rows > 0) {
	        	$row = $result->fetch_assoc();
	        	$price = $row["price"];
	        	$total_amount = $price * $field_value;
	        	$pre_stmt = $this->con->prepare("UPDATE cart_table SET total_amount = ?  WHERE id = ?");
				$pre_stmt->bind_param("si",$total_amount,$id);
				$result = $pre_stmt->execute() or die($this->con->error);
				if ($result) {
					return "UPDATED";
				}else{
					return "UNKOWN_ERROR";
				}
	        }
		}
	}

	public function getCartItems(){
		if (isset($_SESSION["customerid"])) {
			$userid = $_SESSION["customerid"];
			$pre_stmt = $this->con->prepare("SELECT a.id,a.user_id,a.product_id,a.product_quantity,a.status,a.date_added,b.product_name,b.product_image,b.price FROM cart_table AS a INNER JOIN product_table AS b ON a.product_id=b.id WHERE a.user_id = ? ORDER BY a.date_added DESC");
			$pre_stmt->bind_param("i",$userid);
	        $pre_stmt->execute() or die($this->con->error);
	        $result = $pre_stmt->get_result();
	        $rows = array();
	        if ($result->num_rows > 0) {   
	            while($row = $result->fetch_assoc()){
	            $rows[] = $row;
	        }
	            return $rows;
	        } 
	            return "NO_DATA";
		}else{
			$ip_add = getenv("REMOTE_ADDR");
			$pre_stmt = $this->con->prepare("SELECT a.id,a.user_id,a.product_id,a.product_quantity,a.status,a.date_added,b.product_name,b.product_image,b.price FROM cart_table AS a INNER JOIN product_table AS b ON a.product_id=b.id WHERE a.ip_address = ? ORDER BY a.date_added DESC");
			$pre_stmt->bind_param("s",$ip_add);
	        $pre_stmt->execute() or die($this->con->error);
	        $result = $pre_stmt->get_result();
	        $rows = array();
	        if ($result->num_rows > 0) {   
	            while($row = $result->fetch_assoc()){
	            $rows[] = $row;
	        }
	            return $rows;
	        } 
	            return "NO_DATA";
		}
	}

	//========================= END OF CART =========================

	//-------------------------------------------------------------------

	//========================= MANAGE RECORDS =========================

	//LIPA NA MPESA
	public function lipaNaMpesa($jsonMpesaResponse){
		try {
			$pre_stmt = $this->con->prepare("INSERT INTO `mobile_payments`(`TransactionType`, `TransID`, `TransTime`, `TransAmount`, `BusinessShortCode`, `BillRefNumber`, `InvoiceNumber`, `OrgAccountBalance`, `ThirdPartyTransID`, `MSISDN`, `FirstName`, `MiddleName`, `LastName`) VALUES(:TransactionType, :TransID, :TransTime, :TransAmount, :BusinessShortCode, :BillRefNumber, :InvoiceNumber, :OrgAccountBalance, :ThirdPartyTransID, :MSISDN, :FirstName, :MiddleName, :LastName)");
			$result = $pre_stmt->execute((array)($jsonMpesaResponse));
			if ($result) {
				return "SAVED_SUCCESSFULLY";
			}
		} catch (Exception $e) {
			$errLog = fopen('error.txt', 'a'); 

			fwrite($errLog, $e->getMessage());
			fclose($errLog);

			$logFailedTransaction = fopen('failedTransaction.txt', 'a');
			fwrite($logFailedTransaction, json_encode($jsonMpesaResponse));
			fclose($logFailedTransaction);
		}
	}

	public function getProductGraph(){
		$pre_stmt = $this->con->prepare("SELECT product_table.date_created as datecreated, COUNT(*) as totalproducts FROM product_table GROUP BY product_table.date_created");
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}
		return "NO_DATA";
	}

	public function getPaymentGraph(){
		$pre_stmt = $this->con->prepare("SELECT mobile_payments.TransTime as datecreated, COUNT(*) as totalpayments FROM mobile_payments GROUP BY mobile_payments.TransTime");
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}
		return "NO_DATA";
	}

	public function getMoneyAmount($table){
		$pre_stmt = $this->con->prepare("SELECT SUM(TransAmount) as totalamount FROM ".$table);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
    	if ($result->num_rows > 0) {
        	$amount = $result->fetch_assoc();
            	return $amount;
    	}else{
        	return "NO_DATA";
    	}
	}

	//COUNT NO OF RECORDS
	public function countNoOfRecords($table){
		$pre_stmt = $this->con->prepare("SELECT COUNT(*) AS totalrows FROM ".$table);
    	$pre_stmt->execute() or die($this->con->error);
    	$result = $pre_stmt->get_result();
    	if ($result->num_rows > 0) {
        	$count = $result->fetch_assoc();
            	return $count;
    	}else{
        	return "NO_DATA";
    	}
	}

	//COUNT NO OF RECORDS
	public function countNoOfRecordsByCategory($table,$catid){
		$pre_stmt = $this->con->prepare("SELECT COUNT(*) AS totalrows FROM ".$table." WHERE category_id = '$catid'");
    	$pre_stmt->execute() or die($this->con->error);
    	$result = $pre_stmt->get_result();
    	if ($result->num_rows > 0) {
        	$count = $result->fetch_assoc();
            	return $count;
    	}else{
        	return "NO_DATA";
    	}
	}

	//GET SINGLE RECORD
	public function getSingleRecord($table,$pk,$id){
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$pk."= ? LIMIT 1");
		$pre_stmt->bind_param("i",$id);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
		}
		return $row;
	}

	//UPDATE RECORD
	public function updateRecord($table,$id,$field_name,$field_value)
	{
		if ($table == "category_table") {
			$pre_stmt = $this->con->prepare("UPDATE category_table SET ".$field_name." = ?  WHERE id = ?");
			$pre_stmt->bind_param("si",$field_value,$id);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return "UPDATED";
			}else{
				return "UNKOWN_ERROR";
			}
		}

		if ($table == "product_table") {
			$pre_stmt = $this->con->prepare("UPDATE product_table SET ".$field_name." = ?  WHERE id = ?");
			$pre_stmt->bind_param("si",$field_value,$id);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return "UPDATED";
			}else{
				return "UNKOWN_ERROR";
			}
		}

		if ($table == "cart_table") {
			$pre_stmt = $this->con->prepare("UPDATE cart_table SET ".$field_name." = ? WHERE id = ?");
			$pre_stmt->bind_param("si",$field_value,$id);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				if ($field_name == "product_quantity") {
					$this->updateCartTotalAmount($field_value,$id);
					return "UPDATED";
				}else{
					return "UPDATED";
				}
			}else{
				return "UNKOWN_ERROR";
			}
		}
	}

	//DELETE RECORD
	public function deleteRecord($table,$pk,$id)
	{
		if($table == "category_table"){
			$pre_stmt = $this->con->prepare("SELECT p.id,c.id FROM category_table c,product_table p WHERE p.category_id='$id' AND c.id='$id'");
			$pre_stmt->execute();
			$result = $pre_stmt->get_result() or die($this->con->error);
			if ($result->num_rows > 0) {
				return "DEPENDENT_RECORD";
			}else{
				$pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
				$pre_stmt->bind_param("i",$id);
				$result = $pre_stmt->execute() or die($this->con->error);
				if ($result) {
					return "RECORD_DELETED";
				}
			}
		}

		if ($table == "product_table") {
			$pre_stmt = $this->con->prepare("SELECT p.id,c.id FROM cart_table c,product_table p WHERE p.id = '$id' AND c.product_id = '$id'");
			$pre_stmt->execute();
			$result = $pre_stmt->get_result() or die($this->con->error);
			if ($result->num_rows > 0) {
				return "DEPENDENT_RECORD";
			}else{
				$pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
				$pre_stmt->bind_param("i",$id);
				$result = $pre_stmt->execute() or die($this->con->error);
				if ($result) {
					return "RECORD_DELETED";
				}
			}
		}

		if ($table == "cart_table") {
			$pre_stmt = $this->con->prepare("DELETE FROM cart_table WHERE ".$pk." = ?");
			$pre_stmt->bind_param("i",$id);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return "RECORD_DELETED";
			}
		}
	}

	public function searchRecord($paramterm,$pk,$table){
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$pk." LIKE ?");
		$pre_stmt->bind_param("s",$paramterm);
    	$pre_stmt->execute() or die($this->con->error);
    	$result = $pre_stmt->get_result();
    	$rows = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}
		return "NO_DATA";
	}

	//MANAGE RECORD WITH PAGINATION
	public function manageRecordWithPagination($table,$pno,$rowno,$catid){
		$a = $this->pagination($this->con,$table,$pno,$rowno,$catid);
		if ($table == "category_table") {
			$sql = "SELECT t1.id, t1.category_name, t1.status, t1.date_created, count(t2.id) AS total_products FROM category_table AS t1 LEFT JOIN product_table AS t2 ON t1.id = t2.category_id GROUP BY t1.category_name ".$a["limit"];
		}else if($table == "product_table"){
			if ($catid == 0) {
				$sql = "SELECT t1.id, t1.category_name,t2.id,t2.product_name,t2.product_image,t2.price,t2.description,t2.quantity,t2.status,t2.date_created FROM category_table AS t1 INNER JOIN product_table AS t2 ON t1.id=t2.category_id ORDER BY t2.date_created ".$a["limit"];
			}else{
				$sql = "SELECT t1.id, t1.category_name,t2.id,t2.product_name,t2.product_image,t2.price,t2.description,t2.quantity,t2.status,t2.date_created FROM category_table AS t1 INNER JOIN product_table AS t2 ON t1.id=t2.category_id WHERE t2.category_id = '$catid' ORDER BY t2.date_created ".$a["limit"];
			}	
		}else{
			$sql = "SELECT * FROM ".$table." ".$a["limit"];
		}
		$result = $this->con->query($sql) or die($this->con->error);
		$rows = array();
		if($result->num_rows > 0){
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
		}
		return ["rows"=>$rows,"pagination"=>$a["pagination"]];

	}

	private function pagination($con,$table,$pno,$n,$catid){
		if ($catid == 0) {
			$query = $con->query("SELECT COUNT(*) as 'rows' FROM ".$table);
		}else{
			$query = $con->query("SELECT COUNT(*) as 'rows' FROM ".$table." WHERE category_id = '$catid'");
		}
		$row = mysqli_fetch_assoc($query);
		//$totalRecords = 100000;
		$pageno = $pno;
		$numberOfRecordsPerPage = $n;

		$last = ceil($row["rows"]/$numberOfRecordsPerPage);

		$pagination = "<ul class='pagination'>";

		if ($last != 1) {
			if ($pageno > 1) {
				$previous = "";
				$previous = $pageno - 1;
				$pagination .= "<li class='page-item'><a class='page-link' pn='".$previous."' href='#' style='color:#333;'> << </a></li></li>";
			}
			for($i=$pageno - 5;$i< $pageno ;$i++){
				if ($i > 0) {
					$pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";
				}
				
			}
			$pagination .= "<li class='page-item active'><a class='page-link' pn='".$pageno."' href='#' style='color:#333;'> $pageno </a></li>";
			for ($i=$pageno + 1; $i <= $last; $i++) { 
				$pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";
				if ($i > $pageno + 4) {
					break;
				}
			}
			if ($last > $pageno) {
				$next = $pageno + 1;
				$pagination .= "<li class='page-item'><a class='page-link' pn='".$next."' href='#' style='color:#333;'> >> </a></li></ul>";
			}
		}
	//LIMIT 0,10
		//LIMIT 20,10
		$limit = "LIMIT ".($pageno - 1) * $numberOfRecordsPerPage.",".$numberOfRecordsPerPage;

		return ["pagination"=>$pagination,"limit"=>$limit];
	}

	public function manageMainProductWithPagination($table,$pno){
		$a = $this->mainpagination($this->con,$table,$pno,9);
		if ($table == "category_table") {
			$sql = "SELECT * FROM category_table ".$a["limit"];
		}else if($table == "product_table"){
			$sql = "SELECT * FROM product_table WHERE status = 'Active'".$a["limit"];
		}else{
			$sql = "SELECT * FROM ".$table." ".$a["limit"];
		}
		$result = $this->con->query($sql) or die($this->con->error);
		$rows = array();
		if($result->num_rows > 0){
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
		}
		return ["rows"=>$rows,"pagination"=>$a["pagination"]];

	}

	private function mainpagination($con,$table,$pno,$n){
		$query = $con->query("SELECT COUNT(*) as 'rows' FROM ".$table." WHERE status = 'Active'");
		$row = mysqli_fetch_assoc($query);
		//$totalRecords = 100000;
		$pageno = $pno;
		$numberOfRecordsPerPage = $n;

		$last = ceil($row["rows"]/$numberOfRecordsPerPage);

		$pagination = "<ul class='pagination'>";

		if ($last != 1) {
			if ($pageno > 1) {
				$previous = "";
				$previous = $pageno - 1;
				$pagination .= "<li class='page-item'><a class='page-link' pn='".$previous."' href='#'>Previous</a></li>";
			}
			for($i=$pageno - 5;$i< $pageno ;$i++){
				if ($i > 0) {
					$pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";
				}
				
			}
			$pagination .= "<li class='page-item active'><a class='page-link' pn='".$pageno."' href='#'> $pageno </a></li>";
			for ($i=$pageno + 1; $i <= $last; $i++) { 
				$pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";
				if ($i > $pageno + 4) {
					break;
				}
			}
			if ($last > $pageno) {
				$next = $pageno + 1;
				$pagination .= "<li class='page-item'><a class='page-link' pn='".$next."' href='#'>Next</i></a></li></ul>";
			}
		}
	//LIMIT 0,10
		//LIMIT 20,10
		$limit = "LIMIT ".($pageno - 1) * $numberOfRecordsPerPage.",".$numberOfRecordsPerPage;

		return ["pagination"=>$pagination,"limit"=>$limit];
	}

	public function manageShopProductsByCategory($table,$pno,$pk,$catid){
		$a = $this->categorypagination($this->con,$table,$pno,$pk,$catid,9);

		$sql = "SELECT * FROM ".$table." WHERE ".$pk." = '$catid' AND status = 'Active' ".$a["limit"];
		
		$result = $this->con->query($sql) or die($this->con->error);
		$rows = array();
		if($result->num_rows > 0){
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
		}
		return ["rows"=>$rows,"pagination"=>$a["pagination"]];

	}

	private function categorypagination($con,$table,$pno,$pk,$catid,$n){
		$query = $con->query("SELECT COUNT(*) as 'rows' FROM ".$table." WHERE ".$pk." = '$catid' AND status = 'Active'");
		$row = mysqli_fetch_assoc($query);
		//$totalRecords = 100000;
		$pageno = $pno;
		$numberOfRecordsPerPage = $n;

		$last = ceil($row["rows"]/$numberOfRecordsPerPage);

		$pagination = "<ul class='pagination'>";

		if ($last != 1) {
			if ($pageno > 1) {
				$previous = "";
				$previous = $pageno - 1;
				$pagination .= "<li class='page-item'><a class='page-link cat-link' pn='".$previous."' href='#'>Previous</a></li>";
			}
			for($i=$pageno - 5;$i< $pageno ;$i++){
				if ($i > 0) {
					$pagination .= "<li class='page-item'><a class='page-link cat-link' pn='".$i."' href='#'> ".$i." </a></li>";
				}
				
			}
			$pagination .= "<li class='page-item active'><a class='page-link cat-link' pn='".$pageno."' href='#'> $pageno </a></li>";
			for ($i=$pageno + 1; $i <= $last; $i++) { 
				$pagination .= "<li class='page-item'><a class='page-link cat-link' pn='".$i."' href='#'> ".$i." </a></li>";
				if ($i > $pageno + 4) {
					break;
				}
			}
			if ($last > $pageno) {
				$next = $pageno + 1;
				$pagination .= "<li class='page-item'><a class='page-link cat-link' pn='".$next."' href='#'>Next</i></a></li></ul>";
			}
		}
	//LIMIT 0,10
		//LIMIT 20,10
		$limit = "LIMIT ".($pageno - 1) * $numberOfRecordsPerPage.",".$numberOfRecordsPerPage;

		return ["pagination"=>$pagination,"limit"=>$limit];
	}

	//========================= END OF MANAGE RECORDS ===================

}

//$s = new Service();
//echo $s->addCategory("Leather Bags");
//echo $s->addProduct("1","Kikoi Bag","","1400","A nice ladies shopping bag","20");
//echo $s->updateCategory("1","status","Inactive");
//echo $s->deleteRecord("category_table","id","1");

//echo $s->addCartProduct("1","1");

//$rows = $s->getAllCategories();

//echo $s->sumCartItems();
//$row = $s->getTotalCartAmount();
//$rows = $s->getSingleRecord("category_table","id",1);
//echo json_encode($row);

?>
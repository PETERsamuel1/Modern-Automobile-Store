<?php

include_once("../database/constants.php");
include_once("./user.php");
include_once("./service.php");
include_once("./sendmail.php");

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions

$path = '../img/products/'; // upload directory

if(isset($_POST['select_cat']) && isset($_POST['prod_name'])){

/*
	if (!empty($_POST['descriptions'])) {
		$description = "no_description";
	}else{
		$description = $_POST['descriptions'];
	}
*/	if(!empty($_POST['select_cat']) || !empty($_POST['prod_name']) || $_FILES['productphoto'])
	{
		$img = $_FILES['productphoto']['name'];
		$tmp = $_FILES['productphoto']['tmp_name'];
		// get uploaded file's extension
		$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
		// can upload same image using rand function
		$final_image = rand(1000,1000000).$img;
		// check's valid format
		if(in_array($ext, $valid_extensions)) 
		{ 
			$newpath = $path.strtolower($final_image); 
			if(move_uploaded_file($tmp,$newpath)) 
			{
				$cat_id = $_POST['select_cat'];
				$p_name = $_POST['prod_name'];
				$p_image = $final_image;
				$p_price = $_POST['prod_price'];
				$p_amount = $_POST['prod_amount'];
				$p_description = $_POST['prod_description'];

				$service = new Service();
				$result = $service->addProduct($cat_id,$p_name,$p_image,$p_price,$p_description,$p_amount);
				if ($result) {
					echo $result;

				}
				//$email = $_POST['email'];
				//include database configuration file
				//include_once 'db.php';
				//insert form data in the database
				//$insert = $db->query("INSERT uploading (name,email,file_name) VALUES ('".$name."','".$email."','".$path."')");
				//echo $insert?'ok':'err';
			}else {
				echo 'notuploaded';
			}
		} 
		else 
		{
			echo 'invalid';
		}
	}	
}

if (isset($_POST["getIpAddress"])) {
    $localIP = getHostByName(getHostName()); 
  
    // Displaying the address  
    //echo $localIP; 

    $IP = $_SERVER['REMOTE_ADDR']; 
  
// $IP stores the ip address of client 
    //echo "Client's IP address is: $IP"; 
    $userIP =   '';
    if(isset($_SERVER['HTTP_CLIENT_IP'])){
        $userIP =   $_SERVER['HTTP_CLIENT_IP'];
    }elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $userIP =   $_SERVER['HTTP_X_FORWARDED_FOR'];
    }elseif(isset($_SERVER['HTTP_X_FORWARDED'])){
        $userIP =   $_SERVER['HTTP_X_FORWARDED'];
    }elseif(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])){
        $userIP =   $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    }elseif(isset($_SERVER['HTTP_FORWARDED_FOR'])){
        $userIP =   $_SERVER['HTTP_FORWARDED_FOR'];
    }elseif(isset($_SERVER['HTTP_FORWARDED'])){
        $userIP =   $_SERVER['HTTP_FORWARDED'];
    }elseif(isset($_SERVER['REMOTE_ADDR'])){
        $userIP =   $_SERVER['REMOTE_ADDR'];
    }else{
        $userIP =   'UNKNOWN';
    }
    //echo $userIP;
}

if (isset($_POST["customerLoginemail"]) && isset($_POST["customerLoginpassword"])) {
    $user = new User();
    $result = $user->customerLogin($_POST["customerLoginemail"], $_POST["customerLoginpassword"]);
    echo $result;
    exit();
}

if (isset($_POST["changePasswordEmail"]) && isset($_POST["changePasswordPassword"])) {
    $user = new User();
    $result = $user->changeCustomerPassword($_POST["changePasswordEmail"],$_POST["changePasswordPassword"]);
    echo $result;
    exit();
}

if (isset($_POST["customerFirstname"]) && isset($_POST["customerLastname"])) {
    $user = new User();
    $result = $user->registerCustomer($_POST["customerFirstname"],$_POST["customerLastname"],$_POST["customerPhone"],$_POST["customerEmail"],$_POST["password"],"","","","","");
    echo $result;
    exit();
}

if (isset($_POST["txtContactName"]) && isset($_POST["txtContactEmail"])) {
    $sendmail = new Email();
    $user = new User();

    $result = $user->addNewContact($_POST["txtContactName"], $_POST["txtContactEmail"], $_POST["txtContactPhone"], $_POST["txtContactMessage"]);

    if ($result == "SUCCESSFULLY_ADDED") {
        $usersubject = "A new client contact";
        $message = "
                <h2>Client Name: ".$_POST['txtContactName']."</h2>
                <p><b>Client Phone Number:</b> ".$_POST['txtContactPhone']."</p>
                <p><b>Email:</b> ".$_POST['txtContactEmail']."</p>
                <p><b>Subject:</b> ".$usersubject."</p>
                <p><b>Message:</b> ".$_POST['txtContactMessage']."</p>
        ";
        $resp = $sendmail->sendMail($_POST["txtContactEmail"],$usersubject,$message);
        $status = $resp["status"];
        if ($status == 1) {
            echo $resp["message"];
        }else if ($status == 0) {
            echo $resp["message"]." "."Try again later";
        }
    }
    //echo $result["status"]." - ".$result["message"];
}


/*======Admin Login======*/

if (isset($_POST["adminemail"]) && isset($_POST["adminpassword"])) {
	$user = new User();
	$result = $user->adminLogin($_POST["adminemail"],$_POST["adminpassword"]);
	echo $result;
	exit();
}

if (isset($_POST["saveCategory"])) {
	$service = new Service();
	$result = $service->addCategory($_POST["catName"]);
	echo $result;
	exit();
}

if (isset($_POST["updateRecord"])) {
	$service = new Service();
	$result = $service->updateRecord($_POST["table"],$_POST["id"],$_POST["field"],$_POST["fieldvalue"]);
	echo $result;
	exit();
}

if (isset($_POST["getAllShopCategories"])) {
    $service = new Service();
    $rows = $service->getAllCategories();
    ?>
        <li class="active" data-filter="*" id="allcategories">All</li>
    <?php
    foreach ($rows as $row) {
        ?>
        <li id="featuredcollection" catid="<?php echo $row['id'];?>"><a><?php echo $row["category_name"];?></a></li>
        <?php
    }
}

if (isset($_POST["getAllFeaturedCollections"])) {

    $service = new Service();
    $rows = $service->getAllCategories();
    if ($rows > 0) {
        ?>
        <li class="active" data-filter="*" id="allmaincategories">All</li>
        <?php
        foreach ($rows as $row) {
            ?>
            <li data-filter=".oranges" id="mainfeaturedcollection" colid="<?php echo $row['id'];?>"><?php echo $row["category_name"];?></li>
            <?php
        }
    }else {
        echo "No Collections Yet";
    }   
    exit();
    
}

//To get Category
if (isset($_POST["getCategory"])) {
	$service = new Service();
	$rows = $service->getAllCategories();
	foreach ($rows as $row) {
		echo "<option value='".$row["id"]."'>".$row["category_name"]."</option>";
	}
	exit();
}

//Delete Category
if (isset($_POST["deleteCategory"])) {
	$service = new Service();
	$result = $service->deleteRecord("category_table","id",$_POST["id"]);
	echo $result;
}

//Delete Product
if (isset($_POST["deleteProduct"])) {
	$service = new Service();
	$result = $service->deleteRecord("product_table","id",$_POST["id"]);
	echo $result;
}

if (isset($_POST["deleteCartItem"])) {
    $service = new Service();
    $result = $service->deleteRecord("cart_table","id",$_POST["pid"]);
    echo $result;
}

if (isset($_POST["addCartProduct"])) {
    $service = new Service();
    $result = $service->addCartProduct($_POST["productid"],1);
    echo $result;
}

if (isset($_POST["countCartTotalAmount"])) {
    $service = new Service();
    $count = $service->countCartTotalAmount();
    if($count["count_item"] != ""){
        echo $count["count_item"];
    }else{
        echo 0;
    }
    exit();
}

if (isset($_POST["getTotalCartAmount"])) {
    $service = new Service();
    $total_amount = $service->getTotalCartAmount();
    if($total_amount["total_amount"] != ""){
        echo $total_amount["total_amount"];
    }else{
        echo 0;
    }
    exit();
}

if (isset($_POST["getTotalOrderAmount"])) {
    $service = new Service();
    $total_amount = $service->getTotalCartAmount();
    echo $total_amount["total_amount"];
    exit();
}

if (isset($_POST["getProductCategory"])) {
    $service = new Service();
    $row = $service->getCollectionByProduct($_POST["productid"]);
    if ($row > 0) {
        echo $row['id'];
    }
}

if (isset($_POST["updateCustomer"])) {
    $user = new User();
    $result = $user->updateCustomer($_POST["cfirstname"],$_POST["clastname"],$_POST["cphone"],$_POST["cemail"],$_POST["caddress"],$_POST["capartment"],$_POST["ccountry"],$_POST["ccity"],$_POST["cpostcode"],$_POST["customerid"]);
    echo $result;
    exit();
}

if (isset($_POST["getCategoriesNo"])) {
    $service = new Service();
    $count = $service->countNoOfRecords("category_table");
    $countno = $count["totalrows"];
    if ($countno > 0) {
        ?>

        <center><p><b>&nbsp;<?php echo $count["totalrows"];?></b></p></center>

        <?php
    }else{
        ?>

        <center><p><b>No categories yet</b></p></center>

        <?php
    }
}

if (isset($_POST["getProductsNo"])) {
    $service = new Service();
    $count = $service->countNoOfRecords("product_table");
    $countno = $count["totalrows"];
    if ($countno > 0) {
        ?>

        <center><p><b>&nbsp;<?php echo $count["totalrows"];?></b></p></center>

        <?php
    }else{
        ?>

        <center><p><b>No products yet</b></p></center>

        <?php
    }
}

if (isset($_POST["getCustomersNo"])) {
    $service = new Service();
    $count = $service->countNoOfRecords("customer_table");
    $countno = $count["totalrows"];
    if ($countno > 0) {
        ?>

        <center><p><b>&nbsp;<?php echo $count["totalrows"];?></b></p></center>

        <?php
    }else{
        ?>

        <center><p><b>No customers yet</b></p></center>

        <?php
    }
}

if (isset($_POST["getMoneyAmount"])) {
    $service = new Service();
    $amount = $service->getMoneyAmount("mobile_payments");
    $amountno = $amount["totalamount"];
    if ($amountno > 0) {
        ?>

        <center><p><b>&nbsp;<?php echo $amount["totalamount"];?></b></p></center>

        <?php
    }else{
        ?>

        <center><p><b>No payments yet</b></p></center>

        <?php
    }
}

if (isset($_POST["getFeaturedProducts"])) {
    $service = new Service();
    $rows = $service->getAllProducts($_POST["limit"]);
    if (count($rows) > 0) {
        ?>
        <div class="row">
        <?php 
        foreach ($rows as $row) {
            $image = $row["product_image"];
            $f_image = "img/products/".$image;
            $productprice = $row["price"];
            $productid = $row["id"];

            ?>
            <div class="col-lg-3 col-md-4 col-sm-6" id="productdetails" pid="<?php echo $row['id'];?>">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg">
                        <img src="<?php echo $f_image;?>" class="featured__item__pic set-bg">
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#"><?php echo $row["product_name"];?></a></h6>
                        <h5>KES:&nbsp;<?php 
                            echo $productprice;
                        ?></h5>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        </div>
        <?php
    }
    exit();
    
}

if (isset($_POST["getCategoriesSlider"])) {
    $service = new Service();
    $rows = $service->getCategoriesSliderProducts();
    if (count($rows) > 0) {
        foreach ($rows as $row) {
            $image = $row["product_image"];
            $f_image = "img/products/".$image;
            $productname = $row["product_name"];
            ?>
            <div class="col-lg-3">
                <div class="categories__item set-bg" data-setbg="<?php echo $f_image;?>">
                    <img src="<?php echo $f_image;?>">
                    <h5><span id="productdetails" pid="<?php echo $row['id'];?>"><?php echo $productname;?></span></h5>
                </div>
            </div>
            <?php
        }
    }
}

if (isset($_POST["getFeaturedProductsByCollection"])) {
    $service = new Service();
    $rows = $service->getAllCategoryProducts($_POST["collectionid"],$_POST["limit"]);
    if (count($rows) > 0) {
        ?>
        <div class="row">
        <?php 
        foreach ($rows as $row) {
            $image = $row["product_image"];
            $f_image = "img/products/".$image;
            $productprice = $row["price"];
            $productid = $row["id"];

            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mix" id="productdetails" pid="<?php echo $row['id'];?>">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg">
                        <img src="<?php echo $f_image;?>" class="featured__item__pic set-bg">
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#"><?php echo $row["product_name"];?></a></h6>
                        <h5>KES:&nbsp;<?php 
                            echo $productprice;
                        ?></h5>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        </div>
        <?php
    }
    exit();
}

if (isset($_POST["getAllShopProductsByCategory"])) {
    $service = new Service();
    $result = $service->manageShopProductsByCategory("product_table",$_POST["pageno"],"category_id",$_POST["categoryid"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = (($_POST["pageno"] - 1) * 9)+1;
        ?>
            <div class="row shop-wthree-info text-center">

            <?php foreach ($rows as $row) { ?>
                <div class="col-lg-4 shop-info-grid text-center mt-4" id="productdetails" pid="<?php echo $row['id'];?>">
                    <div class="product-info">
                        <div class="product-thumb-item">
                            <img src="img/products/<?php echo $row['product_image'];?>" class="img-fluid" alt="">

                        </div>
                        <div class="item-info-product">
                            <h4 id="productdetails" pid="<?php echo $row['id'];?>">
                                <?php

                                $pro_name = $row["product_name"];
                                if (strlen($pro_name) > 25) {
                                    $newpro_name = substr($pro_name, 0, 25);
                                    echo $newpro_name." ...";
                                }else{
                                    echo $pro_name;
                                }
                                ?>
                            </h4>

                            <div class="product_price">
                                <div class="grid-price">
                                    <span class="money"><b>KES</b> <?php echo $row["price"];?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="m-pagination">
                <nav aria-label="Page navigation example mt-5">
                    <?php echo $pagination;?>     
                </nav>
            </div>
        <?php
    }else{
        ?>
        <div style="display: flex;align-items: center;justify-content: center;text-align: center;margin-top: 90px;">
            <p>No products found in this category&nbsp;<a href="shop.php">Explore More</a></p>
        </div>
        <?php
    }

}

if (isset($_POST["getOrderItems"])) {
    $service = new Service();
    $rows = $service->getCartItems();
    if ($rows > 0) { $n = 1;?>
        <li>
            <span class="top__text">Product</span>
            <span class="top__text__right">Total</span>
        </li>
        <?php foreach ($rows as $row) { ?>
        
        <li><?php echo $n;?>. <?php echo $row["product_name"];?>&nbsp;(X <?php echo $row["product_quantity"];?>) 
        <span><?php
            $qty = $row["product_quantity"];
            $price = $row["price"];

            $totalprice = $qty * $price;

            echo "KES .".$totalprice;
            ?>
        </span></li>
        <?php
            $n++;
         } 
    }
}

if (isset($_POST["getCartItems"])) {
    $service = new Service();
    $rows = $service->getCartItems();
    if ($rows > 0) { $n = 0;?>
        <table id="cart-table-data">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
    <?php
        foreach ($rows as $row) {
            ?>
                <tr>
                    <td class="cart__product__item">
                        <div class="cart__product__item-img">
                            <img src="img/products/<?php echo $row['product_image'];?>" alt="">
                        </div>
                        <div class="cart__product__item__title">
                            <h6><?php echo $row["product_name"];?></h6>
                        </div>
                    </td>
                    <td class="cart__price">KES .<?php echo $row["price"];?></td>
                    <td class="cart__quantity">
                        <div class="pro-qty">
                            <span class="dec qtybtn" cpid="<?php echo $row['id'];?>">-</span>
                            <input type="text" value="<?php echo $row['product_quantity'];?>">
                            <span class="inc qtybtn" cpid="<?php echo $row['id'];?>">+</span>
                        </div>
                    </td>
                    <td class="cart__total">
                        <?php
                        $qty = $row["product_quantity"];
                        $price = $row["price"];

                        $totalprice = $qty * $price;

                        echo "KES .".$totalprice;
                        ?>
                        <input type="hidden" id="cart__total__price" value="<?php echo $totalprice;?>">
                    </td>
                    <td class="cart__close"><span class="fa fa-close" id="removecartitem" removepid="<?php echo $row['id'];?>"></span></td>
                </tr>
            <?php
        }
        ?>
            </tbody>
        </table>
        <?php
    }else{
        echo 1;
    }
}

if (isset($_POST["getRelatedProducts"])) {
    $prodid = $_POST["productid"];
    $service = new Service();
    $rows = $service->getRelatedProducts($_POST["categoryid"]);

    if ($rows > 0) {
        $count = $rows;
        $n = 0;
        foreach ($rows as $row) {
            $productprice = $row["price"];
            $productid = $row["id"];
            if ($prodid == $productid && $row > 0) {
                //echo "<center><a href='shop.php'>View other products</a></center>";
            }else{
            ?>
                <div class="col-lg-3 shop-info-grid text-center mt-4" id="productdetails" pid="<?php echo $row['id'];?>">
                    <div class="product-info">
                        <div class="product-thumb-item">
                            <img src="img/products/<?php echo $row['product_image'];?>" class="img-fluid" alt="">

                        </div>
                        <div class="item-info-product">
                            <h4>
                                <?php

                                $pro_name = $row["product_name"];
                                if (strlen($pro_name) > 25) {
                                    $newpro_name = substr($pro_name, 0, 25);
                                    echo $newpro_name." ...";
                                }else{
                                    echo $pro_name;
                                }
                                ?>
                            </h4>

                            <div class="product_price">
                                <div class="grid-price">
                                    <span class="money">KES .<?php echo $productprice;?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            $n++;
                if ($n == 4) {
                    break;
                }
            }
        }
    }

    if (count($rows) == 1) {
        echo "<a href='shop.php'>View other products</a>";
    }

}

if (isset($_POST["getProductDetails"])) {
    $service = new Service();
    $rowz = $service->getCollectionByProduct($_POST["productid"]);
    $row = $service->getSingleRecord("product_table","id",$_POST["productid"]);
    if ($row > 0 && $rowz > 0) {
        ?>
            <div class="row" style="margin: auto;">
                <div class="desc1-left col-md-6">
                    <img src="img/products/<?php echo $row['product_image'];?>" class="img-fluid" alt="">
                </div>
                <div class="desc1-right col-md-6 pl-lg-3">
                    <h3><?php echo $row["product_name"];?></h3>
                    <h4>Category : <a href="#"><?php echo $rowz["category_name"];?></a></h4>
                    <h5>KES .<?php echo $row["price"];?></h5>
                    <div class="product__details__button">
                        <div class="cart-btn" cpid="<?php echo $row['id'];?>">
                        <i class="fa fa-cart-arrow-down btn-icon"></i>
                        <div class="loader"></div>&nbsp;<b class="btn-text"> Add to cart</b>
                        </div>
                    </div>
                </div>


            </div>
            <div class="my-5">
                <h3 class="shop-sing"><?php echo $row["product_name"];?></h3>
                <p class="mt-3"><?php echo $row["description"];?></p>
            </div>
            <hr>
        <?php
    }
}

if (isset($_POST["getAllCategories"])) {
	$service = new Service();
	$count = $service->countNoOfRecords("category_table");
	$result = $service->manageRecordWithPagination("category_table",$_POST["pageno"],$_POST["rowno"],0);
	$rows = $result["rows"];
	$pagination = $result["pagination"];
	if (count($rows) > 0) {
		$n = (($_POST["pageno"] - 1) * $_POST["rowno"])+1;
		?>
			<table class="table table-striped table-dark table-borderless">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category Name</th>
                        <th>No of Prducts</th>
                        <th>Status</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                	foreach ($rows as $row) {
                		?>
                			<tr>
                				<td><?php echo $n;?></td>
                				<td><?php echo $row["category_name"];?></td>
                				<td><?php echo $row["total_products"];?></td>
                				<td>
				                	<?php
				                	$status = $row["status"];
				                	if ($status == "Active") {
				                		?>
				                		<label class="switch">
										  <input type="checkbox" checked="checked" id="togCatStatus" catid="<?php echo $row['id'];?>">
										  <span class="slider round"></span>
										</label>
										<p class="status">Active</p>
				                		<?php
				                	}else if ($status == "Inactive") {
				                		?>
				                			<label class="switch">
											  <input type="checkbox" id="togCatStatus" catid="<?php echo $row['id'];?>">
											  <span class="slider round"></span>
											</label>
											<p class="status">Inactive</p>
				                		<?php
				                	}

				                	?>
				                </td>
                				<td><?php echo $row["date_created"];?></td>
                				<td>
                					<a href="#" title="Delete" categoryid="<?php echo $row['id'];?>" id="removecat" data-toggle="tooltip"><i class="fas fa-trash fa-1x removeicon"></i></a>
                					<a href="#" title="Edit" categoryid="<?php echo $row['id'];?>" id="editcat" data-toggle="tooltip"><i class="fas fa-edit fa-1x editicon"></i></a>
                					<a href="#" title="View" categoryid="<?php echo $row['id'];?>" id="viewcatproducts" data-toggle="tooltip"><i class="fas fa-arrow-right fa-1x viewcatproductsicon"></i></a>
                				</td>
                			</tr>
                		<?php
                		$n++;
                	}
                ?>           
                </tbody>
            </table>
            <div class="clearfix">
                <div class="hint-text">Showing <b><?php echo count($rows);?></b> out of <b><?php echo $count["totalrows"];?></b> Categories</div>
                <?php echo $pagination;?>
            </div>
		<?php
	}else{
		?>
			<center><p><b>No Categories yet</b></p></center>
		<?php
	}
}

if (isset($_POST["getAllShopProducts"])) {
    $service = new Service();
    $result = $service->manageMainProductWithPagination("product_table",$_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = (($_POST["pageno"] - 1) * 9)+1;
        ?>
            <div class="row shop-wthree-info text-center">

            <?php foreach ($rows as $row) { ?>
                <div class="col-lg-4 shop-info-grid text-center mt-4" id="productdetails" pid="<?php echo $row['id'];?>">
                    <div class="product-info">
                        <div class="product-thumb-item">
                            <img src="img/products/<?php echo $row['product_image'];?>" class="img-fluid" alt="">

                        </div>
                        <div class="item-info-product">
                            <h4 id="productdetails" pid="<?php echo $row['id'];?>">
                                <?php

                                $pro_name = $row["product_name"];
                                if (strlen($pro_name) > 25) {
                                    $newpro_name = substr($pro_name, 0, 25);
                                    echo $newpro_name." ...";
                                }else{
                                    echo $pro_name;
                                }
                                ?>
                            </h4>

                            <div class="product_price">
                                <div class="grid-price">
                                    <span class="money"><b>KES</b> <?php echo $row["price"];?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="m-pagination">
                <nav aria-label="Page navigation example mt-5">
                    <?php echo $pagination;?>     
                </nav>
            </div>
        <?php
    }else{
        ?>
            <center><p>No products yet</p></center>
        <?php
    }
}

if (isset($_POST["getAllCustomerIssues"])) {
    $service = new Service();
    $count = $service->countNoOfRecords("contact_table");
    $result = $service->manageRecordWithPagination("contact_table",$_POST["pageno"],$_POST["rowno"],0);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = (($_POST["pageno"] - 1) * $_POST["rowno"])+1;
        ?>
            <table class="table table-striped table-dark table-borderless table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($rows as $row) {
                        ?>
                            <tr>
                                <td><?php echo $n;?></td>
                                <td><?php 
                                echo $row["contact_name"];
                                ?></td>
                                <td><?php echo $row["contact_phone"];?></td>
                                <td><?php echo $row["contact_email"];?></td>
                                <td><?php echo $row["contact_message"];?></td>
                                <td><?php echo(date("F d, Y",  $row["date_created"]));?></td>
                            </tr>
                        <?php
                        $n++;
                    }
                ?>           
                </tbody>
            </table>
            <div class="clearfix">
                <div class="hint-text">Showing <b><?php echo count($rows);?></b> out of <b><?php echo $count["totalrows"];?></b> Customer Issues</div>
                <?php echo $pagination;?>
            </div>
        <?php
    }else{
        ?>
            <center><p><b>No Customer Issues yet</b></p></center>
        <?php
    }
}

if (isset($_POST["getAllCustomers"])) {
    $service = new Service();
    $count = $service->countNoOfRecords("customer_table");
    $result = $service->manageRecordWithPagination("customer_table",$_POST["pageno"],$_POST["rowno"],0);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = (($_POST["pageno"] - 1) * $_POST["rowno"])+1;
        ?>
            <table class="table table-striped table-dark table-borderless table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($rows as $row) {
                        ?>
                            <tr>
                                <td><?php echo $n;?></td>
                                <td><?php 
                                echo $row["firstname"]." ".$row["lastname"];
                                ?></td>
                                <td><?php echo $row["phone"];?></td>
                                <td><?php echo $row["email"];?></td>
                                <td><?php 
                                if ($row["address"] != "") {
                                    echo $row["address"].",".$row["apartment"]." ".$row["postcode"];
                                }
                                ?></td>
                                <td><?php echo $row["city"];?></td>
                                <td><?php echo $row["country"];?></td>
                                <td><?php echo(date("F d, Y",  $row["registered_date"]));?></td>
                            </tr>
                        <?php
                        $n++;
                    }
                ?>           
                </tbody>
            </table>
            <div class="clearfix">
                <div class="hint-text">Showing <b><?php echo count($rows);?></b> out of <b><?php echo $count["totalrows"];?></b> Customers</div>
                <?php echo $pagination;?>
            </div>
        <?php
    }else{
        ?>
            <center><p><b>No Customers yet</b></p></center>
        <?php
    }
}

if (isset($_POST["getAllPayments"])) {
    $service = new Service();
    $count = $service->countNoOfRecords("mobile_payments");
    $result = $service->manageRecordWithPagination("mobile_payments",$_POST["pageno"],$_POST["rowno"],0);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = (($_POST["pageno"] - 1) * $_POST["rowno"])+1;
        ?>
            <table class="table table-striped table-dark table-borderless table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Payment Id</th>
                        <th>Amount</th>
                        <th>Customer Name</th>
                        <th>Date Payed</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($rows as $row) {
                        ?>
                            <tr>
                                <td><?php echo $n;?></td>
                                <td><?php echo $row["TransID"];?></td>
                                <td><?php echo $row["TransAmount"];?></td>
                                <td><?php echo $row["FirstName"]." ".$row["LastName"];?></td> 
                                <td><?php echo(date("F d, Y",  $row["TransTime"]));?></td>    
                            </tr>
                        <?php
                        $n++;
                    }
                ?>           
                </tbody>
            </table>
            <div class="clearfix">
                <div class="hint-text">Showing <b><?php echo count($rows);?></b> out of <b><?php echo $count["totalrows"];?></b> Transactions</div>
                <?php echo $pagination;?>
            </div>
        <?php
    }else{
        echo "NO_PAYMENTS";
    }
}

if (isset($_POST["getAllProducts"])) {
	$service = new Service();
	$count = $service->countNoOfRecords("product_table");
	$result = $service->manageRecordWithPagination("product_table",$_POST["pageno"],$_POST["rowno"],0);
	$rows = $result["rows"];
	$pagination = $result["pagination"];
	if (count($rows) > 0) {
		$n = (($_POST["pageno"] - 1) * $_POST["rowno"])+1;
		?>
			<table class="table table-striped table-dark table-borderless table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                	foreach ($rows as $row) {
                		?>
                			<tr>
                				<td><?php echo $n;?></td>
                				<td><?php 
                				$cat_name = $row["category_name"];
                				if (strlen($cat_name) > 13) {
                					$newcat_name = substr($cat_name, 0, 13);
                					echo $newcat_name." ...";
                				}else{
                					echo $cat_name;
                				}
                				?></td>
                				<td><img src="../img/products/<?php echo $row['product_image'];?>" style="width: 3rem;height: 3rem;border-radius: 50%;"></td>
                				<td><?php 
                					$pro_name = $row["product_name"];
                					if (strlen($pro_name) > 13) {
                						$newpro_name = substr($pro_name, 0, 13);
                						echo $newpro_name." ...";
                					}else{
                						echo $pro_name;
                					}
                				?></td>
                				<td><?php echo $row["price"];?></td>
                				<td><?php echo $row["quantity"];?></td>
                				<td><?php 
                					$pro_desc = $row["description"];
                					if (strlen($pro_desc) > 13) {
                						$newpro_desc = substr($pro_desc, 0, 13);
                						echo $newpro_desc." ...";
                					}else{
                						echo $pro_desc;
                					}
                				?></td>
                				<td>
				                	<?php
				                	$status = $row["status"];
				                	if ($status == "Active") {
				                		?>
				                		<label class="switch">
										  <input type="checkbox" checked="checked" id="togProdStatus" pid="<?php echo $row['id'];?>">
										  <span class="slider round"></span>
										</label>
										<p class="status">Active</p>
				                		<?php
				                	}else if ($status == "Inactive") {
				                		?>
				                			<label class="switch">
											  <input type="checkbox" id="togProdStatus" pid="<?php echo $row['id'];?>">
											  <span class="slider round"></span>
											</label>
											<p class="status">Inactive</p>
				                		<?php
				                	}

				                	?>
				                </td>
                				<td><?php echo $row["date_created"];?></td>
                				<td>
                					<div class="td-menu">
                					<span class="small-menu" menuid = "<?php echo $row['id'];?>">
                					<span><i class="fas fa-ellipsis-h"></i></span>
                					</span>
                					<div class="option-menu <?php echo $row['id'];?>">
                					<a href="#" title="Delete" productid="<?php echo $row['id'];?>" id="removeproduct" data-toggle="tooltip">Delete</a><br>
                					<a href="#" title="Edit" productid="<?php echo $row['id'];?>" id="editproduct" data-toggle="tooltip">Edit</a>
                					</div>
                					</div>
                				</td>
                			</tr>
                		<?php
                		$n++;
                	}
                ?>           
                </tbody>
            </table>
            <div class="clearfix">
                <div class="hint-text">Showing <b><?php echo count($rows);?></b> out of <b><?php echo $count["totalrows"];?></b> Products</div>
                <?php echo $pagination;?>
            </div>
		<?php
	}else{
		?>
			<center><p><b>No Products yet</b></p></center>
		<?php
	}
}

if (isset($_POST["getProductsByCategory"])) {
	$service = new Service();
	$count = $service->countNoOfRecordsByCategory("product_table",$_POST["catId"]);
	$result = $service->manageRecordWithPagination("product_table",$_POST["pageno"],$_POST["rowno"],$_POST["catId"]);
	$rows = $result["rows"];
	$pagination = $result["pagination"];
	if (count($rows) > 0) {
		$n = (($_POST["pageno"] - 1) * $_POST["rowno"])+1;
		?>
			<table class="table table-striped table-dark table-borderless table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                	foreach ($rows as $row) {
                		?>
                			<tr>
                				<td><?php echo $n;?></td>
                				<td><?php 
                				$cat_name = $row["category_name"];
                				if (strlen($cat_name) > 13) {
                					$newcat_name = substr($cat_name, 0, 13);
                					echo $newcat_name." ...";
                				}else{
                					echo $cat_name;
                				}
                				?></td>
                				<td><img src="../img/products/<?php echo $row['product_image'];?>" style="width: 3rem;height: 3rem;border-radius: 50%;"></td>
                				<td><?php 
                					$pro_name = $row["product_name"];
                					if (strlen($pro_name) > 13) {
                						$newpro_name = substr($pro_name, 0, 13);
                						echo $newpro_name." ...";
                					}else{
                						echo $pro_name;
                					}
                				?></td>
                				<td><?php echo $row["price"];?></td>
                				<td><?php echo $row["quantity"];?></td>
                				<td><?php 
                					$pro_desc = $row["description"];
                					if (strlen($pro_desc) > 13) {
                						$newpro_desc = substr($pro_desc, 0, 13);
                						echo $newpro_desc." ...";
                					}else{
                						echo $pro_desc;
                					}
                				?></td>
                				<td>
				                	<?php
				                	$status = $row["status"];
				                	if ($status == "Active") {
				                		?>
				                		<label class="switch">
										  <input type="checkbox" checked="checked" id="togProdStatus" pid="<?php echo $row['id'];?>">
										  <span class="slider round"></span>
										</label>
										<p class="status">Active</p>
				                		<?php
				                	}else if ($status == "Inactive") {
				                		?>
				                			<label class="switch">
											  <input type="checkbox" id="togProdStatus" pid="<?php echo $row['id'];?>">
											  <span class="slider round"></span>
											</label>
											<p class="status">Inactive</p>
				                		<?php
				                	}

				                	?>
				                </td>
                				<td><?php echo $row["date_created"];?></td>
                				<td>
                					<div class="td-menu">
                					<span class="small-menu" menuid = "<?php echo $row['id'];?>">
                					<span><i class="fas fa-ellipsis-h"></i></span>
                					</span>
                					<div class="option-menu <?php echo $row['id'];?>">
                					<a href="#" title="Delete" productid="<?php echo $row['id'];?>" id="removeproduct" data-toggle="tooltip"><i class="fas fa-trash fa-1x removeicon"></i>&nbsp;Delete</a><br>
                					<a href="#" title="Edit" productid="<?php echo $row['id'];?>" id="editproduct" data-toggle="tooltip"><i class="fas fa-edit fa-1x editicon"></i>&nbsp;Edit</a>
                					</div>
                					</div>
                				</td>
                			</tr>
                		<?php
                		$n++;
                	}
                ?>           
                </tbody>
            </table>
            <div class="clearfix">
                <div class="hint-text">Showing <b><?php echo count($rows);?></b> out of <b><?php echo $count["totalrows"];?></b> Products</div>
                <?php echo $pagination;?>
            </div>
		<?php
	}else{
		?>
			<center><p><b>No Products in this category</b></p></center>
		<?php
	}
}

if (isset($_REQUEST["pterm"])) {
    $param_term = $_REQUEST["pterm"] . '%';
    $service = new Service();
    $rows = $service->searchRecord($param_term,"product_name","product_table");
    if ($rows > 0) {?>
        <div class="row shop-wthree-info text-center">
        <?php
        foreach ($rows as $row) {
            ?>
                <div class="col-lg-4 shop-info-grid text-center mt-4" id="productdetails" pid="<?php echo $row['id'];?>">
                    <div class="product-info">
                        <div class="product-thumb-item">
                            <img src="img/products/<?php echo $row['product_image'];?>" class="img-fluid" alt="">

                        </div>
                        <div class="item-info-product">
                            <h4 id="productdetails" pid="<?php echo $row['id'];?>">
                                <?php

                                $pro_name = $row["product_name"];
                                if (strlen($pro_name) > 25) {
                                    $newpro_name = substr($pro_name, 0, 25);
                                    echo $newpro_name." ...";
                                }else{
                                    echo $pro_name;
                                }
                                ?>
                            </h4>

                            <div class="product_price">
                                <div class="grid-price">
                                    <span class="money"><b>KES</b> <?php echo $row["price"];?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php
        }else{
            ?>
            <center>Your search did not yield any results</center>
            <?php
        }
}

if (isset($_REQUEST["term"])) {
	$param_term = $_REQUEST["term"] . '%';
	$service = new Service();
	$rows = $service->searchRecord($param_term,"product_name","product_table");
	if ($rows > 0) {
		$n = 1;
		?>
			<table class="table table-striped table-dark table-borderless table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                	foreach ($rows as $row) {
                		?>
                			<tr>
                				<td><?php echo $n;?></td>
                				<td><?php 
                				$cat_name = $row["category_name"];
                				if (strlen($cat_name) > 13) {
                					$newcat_name = substr($cat_name, 0, 13);
                					echo $newcat_name." ...";
                				}else{
                					echo $cat_name;
                				}
                				?></td>
                				<td><img src="../img/products/<?php echo $row['product_image'];?>" style="width: 3rem;height: 3rem;border-radius: 50%;"></td>
                				<td><?php 
                					$pro_name = $row["product_name"];
                					if (strlen($pro_name) > 13) {
                						$newpro_name = substr($pro_name, 0, 13);
                						echo $newpro_name." ...";
                					}else{
                						echo $pro_name;
                					}
                				?></td>
                				<td><?php echo $row["price"];?></td>
                				<td><?php echo $row["quantity"];?></td>
                				<td><?php 
                					$pro_desc = $row["description"];
                					if (strlen($pro_desc) > 13) {
                						$newpro_desc = substr($pro_desc, 0, 13);
                						echo $newpro_desc." ...";
                					}else{
                						echo $pro_desc;
                					}
                				?></td>
                				<td>
				                	<?php
				                	$status = $row["status"];
				                	if ($status == "Active") {
				                		?>
				                		<label class="switch">
										  <input type="checkbox" checked="checked" id="togProdStatus" pid="<?php echo $row['id'];?>">
										  <span class="slider round"></span>
										</label>
										<p class="status">Active</p>
				                		<?php
				                	}else if ($status == "Inactive") {
				                		?>
				                			<label class="switch">
											  <input type="checkbox" id="togProdStatus" pid="<?php echo $row['id'];?>">
											  <span class="slider round"></span>
											</label>
											<p class="status">Inactive</p>
				                		<?php
				                	}

				                	?>
				                </td>
                				<td><?php echo $row["date_created"];?></td>
                				<td>
                					<div class="td-menu">
                					<span class="small-menu" menuid = "<?php echo $row['id'];?>">
                					<span><i class="fas fa-ellipsis-h"></i></span>
                					</span>
                					<div class="option-menu <?php echo $row['id'];?>">
                					<a href="#" title="Delete" productid="<?php echo $row['id'];?>" id="removeproduct" data-toggle="tooltip"><i class="fas fa-trash fa-1x removeicon"></i>&nbsp;Delete</a><br>
                					<a href="#" title="Edit" productid="<?php echo $row['id'];?>" id="editproduct" data-toggle="tooltip"><i class="fas fa-edit fa-1x editicon"></i>&nbsp;Edit</a>
                					</div>
                					</div>
                				</td>
                			</tr>
                		<?php
                		$n++;
                	}
                ?>           
                </tbody>
            </table>
            <div class="clearfix">
                <div class="hint-text">Showing <b></b> out of <b></b> Products</div>
            </div>
		<?php
	}else{
		?>
			<center><p><b>No Products in this category</b></p></center>
		<?php
	}
	exit();
}

?>
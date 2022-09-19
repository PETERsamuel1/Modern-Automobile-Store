<?php
include_once("database/constants.php");
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>| Shop(checkout)</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Baggage Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script>
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta tag Keywords -->
    <!-- Custom-Files -->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Bootstrap-Core-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!-- Style-CSS -->
    <!-- font-awesome-icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome-icons -->
    <!-- /Fonts -->
    <link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet">
    <!-- //Fonts -->

</head>
<style type="text/css">
.checkout {
    padding-top: 80px;
    padding-bottom: 70px;
    margin-left: 20%;
    margin-right: 20%;
}

.coupon__link {
    font-size: 14px;
    color: #444444;
    padding: 14px 0;
    background: #f5f5f5;
    border-top: 2px solid #ca1515;
    text-align: center;
    margin-bottom: 50px;
}

.coupon__link a {
    font-size: 14px;
    color: #444444;
}

.coupon__link span {
    font-size: 14px;
    color: #ca1515;
}

.checkout__form h5 {
    color: #111111;
    font-weight: 600;
    text-transform: uppercase;
    border-bottom: 1px solid #e1e1e1;
    padding-bottom: 20px;
    margin-bottom: 25px;
    text-align: center;
}

.checkout__form .checkout__form__input p {
    color: #444444;
    font-weight: 500;
    margin-bottom: 10px;
}

.checkout__form .checkout__form__input p span {
    color: #ca1515;
}

.checkout__form .checkout__form__input small {
    
}

.checkout__form .checkout__form__input input {
    height: 50px;
    width: 100%;
    border: 1px solid #e1e1e1;
    border-radius: 2px;
    margin-bottom: 25px;
    font-size: 14px;
    padding-left: 20px;
    color: #666666;
}

.checkout__form .checkout__form__input input::-webkit-input-placeholder {
    color: #666666;
}

.checkout__form .checkout__form__input input::-moz-placeholder {
    color: #666666;
}

.checkout__form .checkout__form__input input:-ms-input-placeholder {
    color: #666666;
}

.checkout__form .checkout__form__input input::-ms-input-placeholder {
    color: #666666;
}

.checkout__form .checkout__form__input input::placeholder {
    color: #666666;
}

.checkout__form .checkout__form__checkbox {
    margin-bottom: 20px;
}

.checkout__form .checkout__form__checkbox .acc, .checkout__form .checkout__form__checkbox  button {
    display: inline-block;
}

.checkout__form .checkout__form__checkbox label {
    display: block;
    padding-left: 24px;
    font-size: 14px;
    color: #444444;
    font-weight: 500;
    position: relative;
    cursor: pointer;
    margin-bottom: 16px;
}
/*
.checkout__form .checkout__form__checkbox  button {
    float: right;
}
*/
.checkout__form .checkout__form__checkbox label input {
    position: absolute;
    visibility: hidden;
}

.checkout__form .checkout__form__checkbox label input:checked~.checkmark {
    border-color: #ca1515;
}

.checkout__form .checkout__form__checkbox label input:checked~.checkmark:after {
    border-color: #ca1515;
    opacity: 1;
}

.checkout__form .checkout__form__checkbox label .checkmark {
    position: absolute;
    left: 0;
    top: 4px;
    height: 10px;
    width: 10px;
    border: 1px solid #444444;
    border-radius: 2px;
}

.checkout__form .checkout__form__checkbox label .checkmark:after {
    position: absolute;
    left: 0px;
    top: -2px;
    width: 11px;
    height: 5px;
    border: solid #ffffff;
    border-width: 1.5px 1.5px 0px 0px;
    -webkit-transform: rotate(127deg);
    -ms-transform: rotate(127deg);
    transform: rotate(127deg);
    opacity: 0;
    content: "";
}

.checkout__form .checkout__form__checkbox p {
    margin-bottom: 0;
}

.checkout__order {
    background: #f5f5f5;
    padding: 30px;
}

.checkout__order h5 {
    border-bottom: 1px solid #d7d7d7;
    text-align: center;
    margin-bottom: 15px;
    padding-bottom: 15px;
}

.checkout__order .site-btn {
    width: auto;
    position: relative;
}

.checkout__order__product {
    border-bottom: 1px solid #d7d7d7;
    padding-bottom: 22px;
}

.checkout__order__product ul li {
    list-style: none;
    font-size: 14px;
    color: #444444;
    font-weight: 500;
    overflow: hidden;
    margin-bottom: 14px;
    line-height: 24px;
}

.checkout__order__product ul li:last-child {
    margin-bottom: 0;
}

.checkout__order__product ul li span {
    font-size: 14px;
    color: #111111;
    font-weight: 600;
    float: right;
}

.checkout__order__product ul li .top__text {
    font-size: 16px;
    color: #111111;
    font-weight: 600;
    float: left;
}

.checkout__order__product ul li .top__text__right {
    font-size: 16px;
    color: #111111;
    font-weight: 600;
    float: right;
}

.checkout__order__total {
    padding-top: 12px;
    border-bottom: 1px solid #d7d7d7;
    padding-bottom: 10px;
    margin-bottom: 25px;
}

.checkout__order__total ul li {
    list-style: none;
    font-size: 16px;
    color: #111111;
    font-weight: 600;
    overflow: hidden;
    line-height: 40px;
}

.checkout__order__total ul li span {
    color: #ca1515;
    float: right;
}

.checkout__order__widget {
    padding-bottom: 10px;
}

.checkout__order__widget label {
    display: block;
    padding-left: 25px;
    font-size: 14px;
    font-weight: 500;
    color: #111111;
    position: relative;
    cursor: pointer;
    margin-bottom: 14px;
}

.checkout__order__widget label input {
    position: absolute;
    visibility: hidden;
}

.checkout__order__widget label input:checked~.checkmark {
    border-color: #ca1515;
}

.checkout__order__widget label input:checked~.checkmark:after {
    border-color: #ca1515;
    opacity: 1;
}

.checkout__order__widget label .checkmark {
    position: absolute;
    left: 0;
    top: 4px;
    height: 10px;
    width: 10px;
    border: 1px solid #444444;
    border-radius: 2px;
}

.checkout__order__widget label .checkmark:after {
    position: absolute;
    left: 0px;
    top: -2px;
    width: 11px;
    height: 5px;
    border: solid #ffffff;
    border-width: 1.5px 1.5px 0px 0px;
    -webkit-transform: rotate(127deg);
    -ms-transform: rotate(127deg);
    transform: rotate(127deg);
    opacity: 0;
    content: "";
}
.spad {
    padding-top: 40px;
    padding-bottom: 100px;
}
.paybill-div {
    
}
.paybill-div ul {
    list-style: none;
    margin-left: 20px;
}
</style>
<body>
    <div class="main-sec">
        <!-- //header -->
        <header class="py-sm-3 pt-3 pb-2" id="home">
            <div class="container">
                <!-- nav -->
                <div class="top-w3pvt d-flex">
                    <div id="logo">
                        <h1> <a href="index.php"><span class="log-w3pvt">M</span>odern Automobile</a> <label class="sub-des">Spare parts Store</label></h1>
                    </div>
                    <div class="forms ml-auto">
                    <?php
                        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
 
                        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                        $userid = "";
                        if (isset($_SESSION["customerid"])) {
                              $userid = $_SESSION["customerid"];
                         } 
                        if ($userid != "") {
                            $firstname = $_SESSION["customerfirstname"];
                            $lastname = $_SESSION["customerlastname"];
                            
                            ?>
                                <a href="#" style="border-style: solid;border-width: 1px;border-color: #e9ecef;" class="btn btn-user"><?php echo $firstname;?>
                                &nbsp;<?php echo $lastname;?>&nbsp;<span style="color: #333;"><i class="fa fa-chevron-down chev-down"></i></span></a>
                                <a href="logout.php?url=<?php echo $url;?>">
                                <ul style="list-style: none;color: #333;padding: 4px;background: #fff;display: flex;align-items: center;justify-content: center;position: absolute;width: 158px;z-index: 1;margin-top: 4px;" id="btn-logout">
                                    <li>Logout</li>
                                </ul>
                                </a>
                            <?php
                        }else{
                            ?>
                                <a href="login.php?referer=<?php echo $url;?>" class="btn"><i class="fa fa-user-circle" style="font-size: 22px;"></i> Sign In</a>
                                 <a href="register.php?referer=<?php echo $url;?>" class="btn"><i class="fa fa-user" style="font-size: 22px;"></i> Sign Up</a>
                            <?php
                        }
                    ?>
                    </div>
                </div>
                <div class="nav-top-wthree">
                    <nav>
                        <label for="drop" class="toggle"><span class="fa fa-bars"></span></label>
                        <input type="checkbox" id="drop" />
                        <ul class="menu">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="shop.php">Shop Now</a></li>
                            <li><a href="about.php">About Us</a></li>
                            <li class="active"><a href="shopping-cart.php">Checkout</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </nav>
                    <ul class="offcanvas__widget">
                        <li><a href="shopping-cart.php"><i class="fa fa-cart-arrow-down"></i>
                            <div class="tip-cart">0</div>
                        </a></li>
                    </ul>
                   
                    <div class="clearfix"></div>
                </div>
            </div>
        </header>
        <!-- //header -->
    </div>

    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./shop.php"><i class="fa fa-home"></i> Shop</a>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <?php 
                if ($userid != "") {
                    ?>
                        <form class="checkout__form" id="checkout__form" onsubmit="return false">
                        <input type="hidden" id="currentcustomerid" value="<?php echo $userid;?>">
                            <div class="row checkout__form__details">
                                <div class="col-lg-12">
                                    <h5>Billing details</h5>
                                    <small class="form-text text-muted" id="classalert"></small>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <p>First Name <span>*</span></p>
                                                <input type="text" id="txtCustomerFirstname" name="txtCustomerFirstname">
                                                <small class="form-text text-muted" id="cf_error"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <p>Last Name <span>*</span></p>
                                                <input type="text" id="txtCustomerLastname" name="txtCustomerLastname">
                                                <small class="form-text text-muted" id="cl_error"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="checkout__form__input">
                                                <p>Country <span>*</span></p>
                                                <input type="text" id="txtCountry" name="txtCountry">
                                                <small class="form-text text-muted" id="cc_error"></small>
                                            </div>
                                            <div class="checkout__form__input">
                                                <p>Address <span>*</span></p>
                                                <input type="text" placeholder="Street Address" id="txtCustomerAddress" name="txtCustomerAddress">
                                                <input type="text" placeholder="Apartment. suite, unit ect ( optinal )" id="txtCustomerApartment" name="txtCustomerApartment">
                                            </div>
                                            <small class="form-text text-muted" id="ca_error"></small>
                                            <div class="checkout__form__input">
                                                <p>Town/City <span>*</span></p>
                                                <input type="text" id="txtCity" name="txtCity">
                                            </div>
                                            <small class="form-text text-muted" id="cty_error"></small>
                                            <div class="checkout__form__input">
                                                <p>Postcode/Zip <span>*</span></p>
                                                <input type="text" id="txtCustomerPostcode" name="txtCustomerPostcode">
                                            </div>
                                            <small class="form-text text-muted" id="ccp_error"></small>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <p>Phone <span>*</span></p>
                                                <input type="text" id="txtCustomerPhone" name="txtCustomerPhone">
                                            </div>
                                            <small class="form-text text-muted" id="cpn_error"></small>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <p>Email <span>*</span></p>
                                                <input type="text" id="txtCustomerEmail" name="txtCustomerEmail">
                                            </div>
                                            <small class="form-text text-muted" id="cce_error"></small>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="checkout__form__checkbox">
                                                <button type="submit" id="btnsavedata" class="btn btn-primary pull-left">Save</button>
                                                <button class="btn btn-secondary pull-right" id="skip">Skip</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--
                                    <div class="col-lg-4">
                                        <div class="checkout__order">
                                            <h5>Your order</h5>
                                            <div class="checkout__order__product">
                                                <ul id="order-items">
                                                    
                                                </ul>
                                            </div>
                                            <div class="checkout__order__total">
                                                <ul>
                                                    <li>Total <span id="order_total"></span></li>
                                                </ul>
                                            </div>
                                            <div class="checkout__order__widget">
                                                <label for="o-acc">
                                                    Create an acount?
                                                    <input type="checkbox" id="o-acc">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <p>Create am acount by entering the information below. If you are a returing customer
                                                login at the top of the page.</p>
                                                <label for="check-payment">
                                                    Cheque payment
                                                    <input type="checkbox" id="check-payment">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label for="paypal">
                                                    PayPal
                                                    <input type="checkbox" id="paypal">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <button type="submit" class="site-btn" id="btn-order">Place oder</button>
                                        </div>
                                    </div>
                                    -->
                                </div>
                            </form>
                    <?php
                }else{
                    ?>
                        <script type="text/javascript">
                            var pageURL = $(location).attr("href");
                            window.location.href = encodeURI("login.php?referer="+pageURL+"");
                        </script>
                    <?php
                }
            ?>
                <div class="row checkout__order_details">
                    <div class="col-lg-12">
                            <div class="checkout__order">
                                <h5>Your order</h5>
                                <div class="checkout__order__product">
                                    <ul id="order-items">
                                        
                                    </ul>
                                </div>
                                <div class="checkout__order__total">
                                    <ul>
                                        <li>Total <span id="order_total"></span></li>
                                    </ul>
                                </div>
                                <div class="checkout__order__widget">
                                    <p class="p-info-text">Select how you wish to pay for your order</p>
                                    <input type="checkbox" id="check-payment-paybill">&nbsp;Mpesa Paybill Number
                                    <br>
                                    <input type="checkbox" id="check-payment-stkpush">&nbsp;Mpesa Stk Push
                                </div>
                                <button type="submit" class="site-btn btn btn-success" id="btn-order">Place oder</button>
                            </div>
                        </div>
                </div>
                <br>
                <button class="btn btn-secondary btn-small pull-left" id="back">Back</button>
            </div>
        </section>

    
    
    <!-- //footer -->
    <!-- copyright -->
    <div class="cpy-right text-center py-3">
        <p>© 2021 Modern Automobile. All rights reserved 
        </p>

    </div>

    <div id="paybillmodal" data-backdrop="static" data-keyboard="true" class="modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mpesa Paybill</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="paybill-div">
                        <p>To pay for your order through mpesa paybill: Follow the instructions below</p>
                        <ul>
                            <li>1. Go to <b>M-Pesa</b> and Choose <b>Lipa na M-PESA</b>, then <b>Pay Bill</b>.</li>
                            <li>2. Enter the <b>Kasinde Crafts Mpesa Pay bill</b> number, <b>xxxxxx</b>.</li>
                            <li>3. Enter your receipt number</li>
                            <li>4. Enter <b id="paybillamount"></b> as amount</li>
                            <li>5. Enter your mpesa pin to confirm payment</li>
                            <li><label>6. Enter Transaction Number you receive from mpesa</label><br><input type="text" class="form-control" id="txtTransactionNo" placeholder="Enter Transaction Number"><br></li>
                            <li>7. Click Finish button below to complete your order</li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="savecatbtn" class="btn btn-success btn-sm">Finish</button>   
                </div>
            </div>
        </div>
    </div>

    <div id="stkpushmodal" data-backdrop="static" data-keyboard="true" class="modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mpesa STK Push</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="stkpush-div">
                        <center><small id="stkpushtransactionprogress" class="form-text text-success">Transaction in progress wait .... !</small></center>
                        <label>Amount to be paid: KES .<b id="stkpushamount"></b></label><br>
                        <label>Enter your phone number</label>
                        <input type="text" class="form-control" name="" placeholder="Enter Phone number" id="txtStkPushPhoneNumber">
                        <small class="form-text text-muted" id="pns_error"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="stkpushbtn" class="btn btn-success btn-sm">Finish</button>   
                </div>
            </div>
        </div>
    </div>


    <!-- //copyright -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>

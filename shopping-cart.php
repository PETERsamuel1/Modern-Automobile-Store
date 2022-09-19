<?php
include_once("database/constants.php");
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>| Shop(cart)</title>
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
    /*---------------------
  Shop Cart
-----------------------*/

.shop-cart {
    padding-top: 70px;
    padding-bottom: 90px;
}

.shop__cart__table {
    margin-bottom: 30px;
}

.shop__cart__table table {
    width: 100%;
}

.shop__cart__table thead {
    border-bottom: 1px solid #f2f2f2;
}

.shop__cart__table thead th {
    font-size: 18px;
    color: #111111;
    font-weight: 600;
    text-transform: uppercase;
    padding-bottom: 20px;
}

.shop__cart__table tbody tr {
    border-bottom: 1px solid #f2f2f2;
}

.shop__cart__table tbody tr td {
    padding: 30px 0;
}

.shop__cart__table tbody tr .cart__product__item {
    overflow: hidden;
    width: 585px;
}
.shop__cart__table tbody tr .cart__product__item .cart__product__item-img {
    height: 100px;
    width: 100px;
    float: left;
    margin-right: 25px;
}
.shop__cart__table tbody tr .cart__product__item .cart__product__item-img img {
    float: left;
    height: 100%;
    width: 100%;
}

.shop__cart__table tbody tr .cart__product__item .cart__product__item__title {
    overflow: hidden;
    padding-top: 23px;
}

.shop__cart__table tbody tr .cart__product__item .cart__product__item__title h6 {
    color: #111111;
    font-weight: 600;
}

.shop__cart__table tbody tr .cart__product__item .cart__product__item__title .rating i {
    font-size: 10px;
    color: #e3c01c;
    margin-right: -4px;
}

.shop__cart__table tbody tr .cart__price {
    font-size: 16px;
    color: #ca1515;
    font-weight: 600;
    width: 190px;
}

.shop__cart__table tbody tr .cart__quantity {
    width: 190px;
}

.shop__cart__table tbody tr .cart__quantity .pro-qty {
    border: none;
    padding: 0;
    width: 110px;
    border-radius: 0;
}

.shop__cart__table tbody tr .cart__quantity .pro-qty input {
    color: #444444;
}

.shop__cart__table tbody tr .cart__quantity .pro-qty .qtybtn {
    font-size: 16px;
    color: #444444;
}

.shop__cart__table tbody tr .cart__total {
    font-size: 16px;
    color: #ca1515;
    font-weight: 600;
    width: 150px;
}

.shop__cart__table tbody tr .cart__close {
    text-align: right;
}

.shop__cart__table tbody tr .cart__close span {
    height: 45px;
    width: 45px;
    background: #f2f2f2;
    border-radius: 50%;
    font-size: 18px;
    color: #111111;
    line-height: 44px;
    text-align: center;
    display: inline-block;
    font-weight: 600;
    cursor: pointer;
}

.cart__btn {
    margin-bottom: 50px;
}

.cart__btn.update__btn {
    text-align: right;
}

.cart__btn a {
    font-size: 14px;
    color: #111111;
    font-weight: 600;
    text-transform: uppercase;
    display: inline-block;
    padding: 14px 30px 12px;
    background: #f5f5f5;
}

.cart__btn a span {
    color: #ca1515;
    font-size: 14px;
    margin-right: 5px;
}

.discount__content h6 {
    color: #111111;
    font-weight: 600;
    text-transform: uppercase;
    display: inline-block;
    margin-right: 30px;
}

.discount__content form {
    position: relative;
    width: 370px;
    display: inline-block;
}

.discount__content form input {
    height: 52px;
    width: 100%;
    border: 1px solid #444444;
    border-radius: 50px;
    padding-left: 30px;
    padding-right: 115px;
    font-size: 14px;
    color: #444444;
}

.discount__content form input::-webkit-input-placeholder {
    color: #444444;
}

.discount__content form input::-moz-placeholder {
    color: #444444;
}

.discount__content form input:-ms-input-placeholder {
    color: #444444;
}

.discount__content form input::-ms-input-placeholder {
    color: #444444;
}

.discount__content form input::placeholder {
    color: #444444;
}

.discount__content form button {
    position: absolute;
    right: 4px;
    top: 4px;
}

.cart__total__procced {
    background: #f5f5f5;
    padding: 40px;
}

.cart__total__procced h6 {
    color: #111111;
    font-weight: 600;
    text-transform: uppercase;
    margin-bottom: 10px;
}

.cart__total__procced ul {
    margin-bottom: 25px;
}

.cart__total__procced ul li {
    list-style: none;
    font-size: 16px;
    color: #111111;
    font-weight: 600;
    overflow: hidden;
    line-height: 40px;
}

.cart__total__procced ul li span {
    color: #ca1515;
    float: right;
}

.cart__total__procced .primary-btn {
    display: block;
    border-radius: 50px;
    text-align: center;
    padding: 12px 0 10px;
    background-color: #ced4da;
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
                        <a href="shop.php"><i class="fa fa-home"></i> Shop</a>
                        <span>Shopping cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <div class="container">
            <center><p id="continue-shopping">No products in cart Go to<a href="shop.php"> Shop</a> to add products to cart</p></center>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        
                    </div>
                </div>
            </div>
            <div class="row" id="cart-options">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="shop.php">Continue Shopping</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cart__total__procced">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Total <span id="cart-total-amt"></span></li>
                        </ul>
                        <a href="checkout.php" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- //footer -->
    <!-- copyright -->
    <div class="cpy-right text-center py-3">
        <p>© 2021 Modern Automobile. All rights reserved 
        </p>

    </div>
    <!-- //copyright -->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>

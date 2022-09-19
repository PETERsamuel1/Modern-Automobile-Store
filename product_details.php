<?php
include_once("database/constants.php");
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title id="myproduct"></title>
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
    .nav-product {
        width: 100%;
    }
    .nav-product .nav-cart {
        right: 10px;
        position: absolute;
        padding: 8px;
        border-radius: 18px;
        background-color: #e9ecef;
        margin-bottom: 5px;
        border-style: solid;
        border-width: 1px;
        border-color: #e9ecef;
    }
    .nav-product .nav-cart:hover{
        border-color: #ced4da;
        cursor: pointer;
    }
    .loader {
        width: 15px;
        height: 15px;
        top: 50%;
        left: 50%;
        margin-left: -13px;
        border-radius: 60px;
        animation: loader 0.8s linear infinite;
        -webkit-animation: loader 0.8s linear infinite;
    }

    @keyframes loader {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
            border: 4px solid #fff;
            border-left-color: transparent;
        }
        50% {
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg);
            border: 4px solid #fff;
            border-left-color: transparent;
        }
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
            border: 4px solid #fff;
            border-left-color: transparent;
        }
    }

    @-webkit-keyframes loader {
        0% {
            -webkit-transform: rotate(0deg);
            border: 4px solid #fff;
            border-left-color: transparent;
        }
        50% {
            -webkit-transform: rotate(180deg);
            border: 4px solid #fff
            border-left-color: transparent;
        }
        100% {
            -webkit-transform: rotate(360deg);
            border: 4px solid #fff;
            border-left-color: transparent;
        }
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
                            <li class="active"><a href="shop.php">Shop Now</a></li>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="shopping-cart.php">Checkout</a></li>
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
    <!-- //banner-->
    <!--/banner-bottom -->
    <section class="banner-bottom">
        <input type="hidden" name="product_id" id="product_id" value="<?php
        if(isset($_GET['productid'])){
        $pid =  $_GET['productid'];
        echo $pid;
        }?> 
        ">
        
        <div class="breadcrumb-option">
            <div class="container">
                <small id="palert"></small>
                <div class="row">
                    <div class="breadcrumb__links">
                        <a href="shop.php"><i class="fa fa-home"></i> Shop</a>
                        <span id="breadcrumb__links"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-md-5">
            <!-- product right -->
            <div class="left-ads-display wthree">
                <div class="single_product_details"></div>
                <!--/row-->
                <h4 class="title-wthree-single my-lg-5 my-4 text-left">Featured Spare Parts</h4>
                <input type="hidden" name="product_catid" id="product_catid">
                <div class="row shop-wthree-info text-center" id="relatedproducts">
                <!--
                    <div class="col-md-3 shop-info-grid text-center mt-4">
                        <div class="product-shoe-info shoe">
                            <div class="men-thumb-item">
                                <img src="images/b1.jpg" class="img-fluid" alt="">

                            </div>
                            <div class="item-info-product">
                                <h4>
                                    <a href="single.html">Messenger Bag </a>
                                </h4>

                                <div class="product_price">
                                    <div class="grid-price">
                                        <span class="money"><span class="line">$799</span> $675.00</span>
                                    </div>
                                </div>
                                <ul class="stars">
                                    <li><a href="#"><span class="fa fa-star" aria-hidden="true"></span></a></li>
                                    <li><a href="#"><span class="fa fa-star" aria-hidden="true"></span></a></li>
                                    <li><a href="#"><span class="fa fa-star-half-o" aria-hidden="true"></span></a></li>
                                    <li><a href="#"><span class="fa fa-star-half-o" aria-hidden="true"></span></a></li>
                                    <li><a href="#"><span class="fa fa-star-o" aria-hidden="true"></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 shop-info-grid text-center mt-4">
                        <div class="product-shoe-info shoe">
                            <div class="men-thumb-item">
                                <img src="images/b2.jpg" class="img-fluid" alt="">

                            </div>
                            <div class="item-info-product">
                                <h4>
                                    <a href="single.html">Shoulder Bag (Pink) </a>
                                </h4>

                                <div class="product_price">
                                    <div class="grid-price">
                                        <span class="money"><span class="line">$799</span> $675.00</span>
                                    </div>
                                </div>
                                <ul class="stars">
                                    <li><a href="#"><span class="fa fa-star" aria-hidden="true"></span></a></li>
                                    <li><a href="#"><span class="fa fa-star" aria-hidden="true"></span></a></li>
                                    <li><a href="#"><span class="fa fa-star-half-o" aria-hidden="true"></span></a></li>
                                    <li><a href="#"><span class="fa fa-star-half-o" aria-hidden="true"></span></a></li>
                                    <li><a href="#"><span class="fa fa-star-o" aria-hidden="true"></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 shop-info-grid text-center mt-4">
                        <div class="product-shoe-info shoe">
                            <div class="men-thumb-item">
                                <img src="images/b3.jpg" class="img-fluid" alt="">

                            </div>
                            <div class="item-info-product">
                                <h4>
                                    <a href="single.html">Sling Bag </a>
                                </h4>

                                <div class="product_price">
                                    <div class="grid-price">
                                        <span class="money"><span class="line">$599</span> $475.00</span>
                                    </div>
                                </div>
                                <ul class="stars">
                                    <li><a href="#"><span class="fa fa-star" aria-hidden="true"></span></a></li>
                                    <li><a href="#"><span class="fa fa-star" aria-hidden="true"></span></a></li>
                                    <li><a href="#"><span class="fa fa-star-half-o" aria-hidden="true"></span></a></li>
                                    <li><a href="#"><span class="fa fa-star-half-o" aria-hidden="true"></span></a></li>
                                    <li><a href="#"><span class="fa fa-star-o" aria-hidden="true"></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 shop-info-grid text-center mt-4">
                        <div class="product-shoe-info shoe">
                            <div class="men-thumb-item">
                                <img src="images/b4.jpg" class="img-fluid" alt="">

                            </div>
                            <div class="item-info-product">
                                <h4>
                                    <a href="single.html">Tote (Blue) </a>
                                </h4>

                                <div class="product_price">
                                    <div class="grid-price">
                                        <span class="money"><span class="line">$799</span> $675.00</span>
                                    </div>
                                </div>
                                <ul class="stars">
                                    <li><a href="#"><span class="fa fa-star" aria-hidden="true"></span></a></li>
                                    <li><a href="#"><span class="fa fa-star" aria-hidden="true"></span></a></li>
                                    <li><a href="#"><span class="fa fa-star-half-o" aria-hidden="true"></span></a></li>
                                    <li><a href="#"><span class="fa fa-star-half-o" aria-hidden="true"></span></a></li>
                                    <li><a href="#"><span class="fa fa-star-o" aria-hidden="true"></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    -->
                </div>
                <!--//row-->

            </div>
        </div>
    </section>
    
    <!-- //footer -->
    <!-- copyright -->
    <!-- copyright -->
    <div class="cpy-right text-center py-3">
        <p>© 2021 Modern Automobile. All rights reserved 
        </p>

    </div>
    <!-- //copyright -->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/slick/slick.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>

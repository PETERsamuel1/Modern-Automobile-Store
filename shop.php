<?php
include_once("database/constants.php");
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title> Shop</title>
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
    .p-categories-section {
        border-style: solid;
        border-width: 1px;
        border-color: #e9ecef;
        padding: 0;
        margin: 0;
        min-height: 200px;
    }
    .p-categories-header {
        background: #f7f7f7;
        width: 100%;
        top: 0;
        padding-top: 18px;
        display: flex;
        justify-content: center;
    }
    .p-categories-section h5 {
        font-weight: 400;
        padding-bottom: 20px;
    }

    .p-categories-section ul{
        list-style: none;
        top: 0;
        margin: 0;
    }

    .p-categories-section ul li{
        list-style: none;
        width: 100%;
        padding-top: 8px;
        padding-bottom: 8px;
        padding-left: 10px;
        font-weight: 300;
    }

    .p-categories-section ul li:hover{
        background-color: #fbc9be;
        cursor: pointer;
    }

    .p-categories-section ul li.active{
        background-color: #fbc9be;
    }

    .p-products-section .p-small-menu {
        background: #f7f7f7;
        width: 100%;
        padding: 20px;
    }

    .p-products-section .p-small-menu span {
        padding: 6px;
        background-color: #fff;
    }

    .p-products-section .p-small-menu .list-span,.column-span {
        margin-left: 15px;
    }

    .p-products-section .p-small-menu .search {
        float: right;
        width: 300px;
    }
    .animationLoading{ 
      display: block;
      margin-top: 15px;
      height: 100%;
      width: 100%;

    }
    @keyframes animate {
        from {transition:none;}
        to {background-color:#f6f7f8;transition: all 0.3s ease-out;}
    }

    #container{
      width:100%;
      padding-left: 15px;
      padding-right: 15px;
    }
    .shop-info-grid-loading
    {
      position:relative;
      background-color: #CCC;
      height: 350px;
      animation-name: animate; 
      animation-duration: 2s; 
      animation-iteration-count: infinite;
      animation-timing-function: linear;
    }

    .product-img-loading{
        margin-top: 10px;  
        padding: 1em;
        height: 170px;
        background-color: #fff;
    }

    .item-info-product-loading {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .item-info-product-loading .product-title-loading {
        width: 80%;
        height: 30px;
        background-color: #fff;
        margin-top: 10px;
        position: absolute;
    }

    .item-info-product-loading .product_price-loading{
        margin-top: 50px;
        width: 60%;
        background-color: #fff;
        height: 20px;
        position: absolute;
    }

    .item-info-product-loading .stars-loading{
      margin-top: 100px;
      width: 80%;
      background-color: #fff;
      height: 10px;
      position: absolute;
    }
    .store-filter {
      margin-bottom: 0;
      margin-top: 0;
      background-color: #fbc9be;
    }

    /*-- Store Sort --*/

    .store-sort {
      float: right;
    }

    /*-- Store Grid 

    .store-grid {
      float: right;
    }
    --*/
    .store-grid li {
      display: inline-block;
      width: 40px;
      height: 40px;
      line-height: 40px;
      background-color: #FFF;
      border: 1px solid #E4E7ED;
      text-align: center;
      -webkit-transition: 0.2s all;
      transition: 0.2s all;
    }

    .store-grid li+li {
      margin-left: 5px;
    }

    .store-grid li:hover {
      background-color: #fbc9be;
      color: #fff;
    }

    .store-grid li.active {
      background-color: #fbc9be;
      border-color: #e9ecef;
      color: #FFF;
      cursor: default;
    }

    .store-grid li a {
      display: block;
    }
    .search-box {
        margin-top: 0;
        margin-bottom: 0;
        padding: 15px 0 15px 15px;
        float: right;
        right: 15px;
    }
    .search-box .input-group {
            right: 15px;
            display: flex;
            align-items: center;
            border-radius: 15px;
    }
    .search-box .input-group-addon, .search-box input {
            border-color: #ddd;
            border-radius: 0;
    }
    .search-box .input-group-addon {
            border: none;
            border: none;
            background: transparent;
            position: absolute;
            z-index: 9;
            padding-left: 7px;
    }
    .search-box input {
        height: 35px;
        padding-left: 28px;     
        box-shadow: none !important;
        border-width: 0 0 1px 0;
        border-radius: 15px;

    }
    .search-box input:focus {
          border-color: #fbc9be;
    }
    .search-box i {
        float: right;
        color: #fbc9be;
        font-size: 19px;
        top: 2px;
        right: -10px;
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
        <div class="breadcrumb-option">
            <div class="container">
                <div class="row">
                    <div class="breadcrumb__links">
                        <a href="shop.php"><i class="fa fa-home"></i> Shop</a>
                        <span id="category-nav">All</span>
                        <input type="hidden" id="txtCategory">
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-3 p-categories-section">
                    <div class="p-categories-header"><h5>Categories</h5></div>
                    <ul class="p-categories">
                        
                    </ul>
                </div>
                <div class="col-lg-9 p-products-section">
                <!--
                    <div class="p-small-menu">
                        <span class="list-span"><i class="fa fa-list"></i></span>
                        <span class="column-span"><i class="fa fa-th-large"></i></span>
                        <input type="search" class="form-control search" name="">
                    </div>
                -->
                    <div class="store-filter clearfix">
                        <div class="store-sort">
                            <div class="search-box">
                                <div class="input-group">
                                    <input type="text" class="form-control" autocomplete="off" id="psearch" placeholder="Search&hellip;">
                                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    <div class="result"></div>
                                </div>
                            </div>
                        </div>
                        <!--
                        <ul class="store-grid">
                            <li class="active" id="show-grid"><a href="#"><i class="fa fa-th"></i></a></li>
                            <li id="show-list"><a href="#"><i class="fa fa-th-list"></i></a></li>
                        </ul>
                        -->
                    </div>
                    <div class="main-products"></div>
                <!--
                    <div class="row shop-wthree-info text-center">
                        <div class="col-lg-3 shop-info-grid text-center mt-4">
                            <div class="product-shoe-info shoe">
                                <div class="men-thumb-item">
                                    <img src="images/b5.jpg" class="img-fluid" alt="">

                                </div>
                                <div class="item-info-product">
                                    <h4>
                                        <a href="single.php">Satchel (Yellow) </a>
                                    </h4>

                                    <div class="product_price">
                                        <div class="grid-price">
                                            <span class="money"><span class="line">$999</span> $875.00</span>
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
                        <div class="col-lg-3 shop-info-grid text-center mt-4">
                            <div class="product-shoe-info shoe">
                                <div class="men-thumb-item">
                                    <img src="images/b6.jpg" class="img-fluid" alt="">

                                </div>
                                <div class="item-info-product">
                                    <h4>
                                        <a href="single.php">Shoulder Bag (Orange)</a>
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
                        <div class="col-lg-3 shop-info-grid text-center mt-4">
                            <div class="product-shoe-info shoe">
                                <div class="men-thumb-item">
                                    <img src="images/b8.jpg" class="img-fluid" alt="">

                                </div>
                                <div class="item-info-product">
                                    <h4>
                                        <a href="single.php">Hobo (Blue) </a>
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
                        <div class="col-lg-3 shop-info-grid text-center mt-4">
                            <div class="product-shoe-info shoe">
                                <div class="men-thumb-item">
                                    <img src="images/b7.jpg" class="img-fluid" alt="">

                                </div>
                                <div class="item-info-product">
                                    <h4>
                                        <a href="single.php">Satchel (Pink)</a>
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


                    </div>
                    -->
                    <!--//row1-->
                    <!--/row-->
                    <!--
                    <div class="row shop-wthree-info text-center mb-5">
                        <div class="col-lg-3 shop-info-grid text-center mt-4">
                            <div class="product-shoe-info shoe">
                                <div class="men-thumb-item">
                                    <img src="images/b3.jpg" class="img-fluid" alt="">

                                </div>
                                <div class="item-info-product">
                                    <h4>
                                        <a href="single.php">Sling Bag </a>
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
                        <div class="col-lg-3 shop-info-grid text-center mt-4">
                            <div class="product-shoe-info shoe">
                                <div class="men-thumb-item">
                                    <img src="images/b4.jpg" class="img-fluid" alt="">

                                </div>
                                <div class="item-info-product">
                                    <h4>
                                        <a href="single.php">Tote (Blue) </a>
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


                        <div class="col-lg-3 shop-info-grid text-center mt-4">
                            <div class="product-shoe-info shoe">
                                <div class="men-thumb-item">
                                    <img src="images/b1.jpg" class="img-fluid" alt="">

                                </div>
                                <div class="item-info-product">
                                    <h4>
                                        <a href="single.php">Messenger Bag </a>
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
                        <div class="col-lg-3 shop-info-grid text-center mt-4">
                            <div class="product-shoe-info shoe">
                                <div class="men-thumb-item">
                                    <img src="images/b2.jpg" class="img-fluid" alt="">

                                </div>
                                <div class="item-info-product">
                                    <h4>
                                        <a href="single.php">Shoulder Bag (Pink) </a>
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
                    </div>
                    -->
                    <!--
                    <nav aria-label="Page navigation example mt-5">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#">Previous</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                    -->
                </div>
            </div>
            
            <!--//row-->
            <!--/row1-->
            
        </div>
    </section>
    <!-- /banner-bottom -->
    
    <!-- //footer -->
    <!-- copyright -->
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
    <script type="text/javascript">
        $(document).ready(function(){
            //$('[data-toggle="tooltip"]').tooltip();
            // Animate select box length
            var searchInput = $(".search-box input");
            var inputGroup = $(".search-box .input-group");
            var boxWidth = inputGroup.width();
            searchInput.focus(function(){
                inputGroup.animate({
                    width: "500"
                });
                //inputGroup.css({"width":"100%"});
            }).blur(function(){
                inputGroup.animate({
                    width: boxWidth
                });
            });
        });
    </script>
</body>

</html>

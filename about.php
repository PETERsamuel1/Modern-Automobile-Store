<?php
include_once("database/constants.php");
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>About</title>
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

<body>
    <div class="main-sec">
        <!-- //header -->
        <header class="py-sm-3 pt-3 pb-2">
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
                            <li class="active"><a href="about.php">About Us</a></li>
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
    <section class="banner-bottom py-5">
        <div class="container py-md-5">
            <div class="row grids-wthree-info">
                <div class="col-lg-12 ab-info-con ab-inf-page text-left">
                    <h4>About Us</h4>
                    <p>
                    Modern Automobile Website is a project that its aim will be making the vendors who sell vehicle spare parts to serve wide range of customers and also it will make the identification of the spare part, ordering and payment will be very easier since the customer can do all the activities without having to go to the physically.
                    </p>
                     <!--a href="single.php" class="btn shop mt-4">Read More</a-->
                </div>
            </div>
           
        </div>
    </section>
  
    
    

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

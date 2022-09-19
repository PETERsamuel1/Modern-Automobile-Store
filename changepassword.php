
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Change Password </title>
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
    .icon-close {
        position: absolute;
        right: 10%;
        top: 30px;
        font-size: 22px;
        color: #333;
        height: 30px;
        width: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    .icon-close:hover{
        cursor: pointer;
        background-color: #ffffff;
    }
    .form-container{
        background-color: #fff;
        padding: 20px;
        -webkit-box-shadow: 0px 5px 10px rgba(91, 91, 91, 0.1);
        box-shadow: 0px 5px 10px rgba(91, 91, 91, 0.1);
    }
    .content-grid{
        
    }
    html,body{
        background-color: #fbc9be;
    }
</style>
<body>
    <div class="inner-page">

    <?php
    $ref = "";
    if (isset($_GET["referer"])) {
        $ref = $_GET["referer"];
    }
    if ($ref != "") {
        ?>
        <input type="hidden" id="referer" value="<?php echo $ref;?>">
        <?php
    }else{
        ?>
        <input type="hidden" id="referer" value="">
        <?php
    }
    ?>
        <!-- //header -->
        <header class="py-sm-3 pt-3 pb-2" id="home">
            <div class="container">
                <!-- nav -->
                <div class="top-w3pvt d-flex">
                    <div id="logo">
                        <h1> <a href="index.php"><span class="log-w3pvt">M</span>odern Automobile</a> <label class="sub-des">Spare parts Store</label></h1>
                    </div>
                    <span class="icon-close">
                        <i class="fa fa-close"></i>
                    </span>
                    <!--
                    <div class="forms ml-auto">
                        <a href="login.php" class="btn"><span class="fa fa-user-circle-o"></span> Sign In</a>
                        <a href="register.php" class="btn"><span class="fa fa-pencil-square-o"></span> Sign Up</a>
                    </div>
                    -->
                </div>
            </div>
        </header>
        <!-- //header -->

    </div>

    <!-- //banner-->
    <!--/login -->
    <section class="banner-bottom py-5" style="margin-right: 20%;margin-left: 20%;">
        <div class="container form-container">
            <div class="content-grid">
                <div class="text-center icon">
                    <span class="fa fa-unlock-alt"></span>
                </div>
                <div class="content-bottom">
                    <form id="userchangepasswordform" onsubmit="return false">
                        <small id="changepasswordinfo" class="form-text text-muted"></small>
                        <div class="field-group">
                            <div class="content-input-field">
                                <small class="form-text text-muted" id="cpemail_error"></small>
                                <input name="changePasswordEmail" id="changePasswordEmail" type="text" placeholder="Enter email address">
                            </div>
                        </div>
                        <div class="field-group">
                            <div class="content-input-field">
                                <small class="form-text text-muted" id="cppassword_error"></small>
                                <input name="changePasswordPassword" id="changePasswordPassword" type="Password" placeholder="Password">
                            </div>
                        </div>
                        <div class="field-group">
                            <div class="content-input-field">
                                <small class="form-text text-muted" id="cpconfirmpassword_error"></small>
                                <input name="changeConfirmPassword" id="changeConfirmPassword" type="Password" placeholder="Re-enter Password">
                            </div>
                        </div>
                        <div class="content-input-field">
                            <button type="submit" class="btn">Change password</button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- //copyright -->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>

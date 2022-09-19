<?php

include_once("templates/header.php");
include_once("../database/constants.php");

if (!isset($_SESSION["adminid"])) {
  header("location:".DOMAIN."/");
}
?>

<style type="text/css">
    body {
        color: #566787;
        background: #f5f5f5;
    		font-family: 'Roboto', sans-serif;
    	}

    .switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 21px;
    }

    .switch, .status{
        display: inline-block;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 17px;
        width: 17px;
        left: 2px;
        bottom: 2px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(20px);
        -ms-transform: translateX(20px);
        transform: translateX(20px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 24px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

	.table-wrapper {
        background: #fff;
        margin: 0 0;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }

	.table-title {
		    font-size: 15px;
        padding-bottom: 10px;
        margin: 0 0 10px;
		    min-height: 45px;
    }
    .table-title h2 {
        margin: 5px 0 0;
        font-size: 24px;
    }
	.table-title select {
    		border-color: #ddd;
    		border-width: 0 0 1px 0;
    		padding: 3px 10px 3px 5px;
    		margin: 0 5px;
	}
	.table-title .show-entries {
		    margin-top: 7px;
	}
  .table-title .show-categories {
        margin-top: 7px;
  }
	.search-box {
        position: relative;
        float: right;
        margin-top: 7px;
    }
	.search-box .input-group {
    		min-width: 200px;
    		position: absolute;
    		right: 0;
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
	}
    .search-box input {
        height: 26px;
        padding-left: 28px;		
    		box-shadow: none !important;
    		border-width: 0 0 1px 0;
    }
  	.search-box input:focus {
  		  border-color: #3FBAE4;
  	}
    .search-box i {
        color: #a0a5b1;
        font-size: 19px;
    		position: relative;
    		top: 2px;
    		left: -10px;
    }
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
    }
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table td:last-child .td-menu {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    table.table td:last-child .small-menu span {
      padding: 4px;
      border-radius: 50%;
    }
    table.table td:last-child .small-menu span:hover {
      background-color: #32325d;
      cursor: pointer;
    }
    table.table td:last-child .small-menu,.option-menu{
      display: inline-block;
    }
    table.table td:last-child {
        width: auto;
    }
    table.table td a {
        color: #a0a5b1;
        display: inline-block;
        margin: 0 5px;
    }
	  table.table td a.view {
        color: #03A9F4;
    }
    table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #E34724;
    }
    table.table td i {
        font-size: 19px;
    }    
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
		    padding: 0 10px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 30px !important;
        text-align: center;
    }
    .pagination li a:hover {
        color: #666;
    }	
    .pagination li.active a {
        background: #03A9F4;
    }
    .pagination li.active a:hover {        
        background: #0397d6;
    }
	  .pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }

    .option-menu {
      position: absolute;
      padding-top: 4px;
      padding-bottom: 4px;
      margin-top: 20px;
      right: 90px;
      background-color: #fff;
      border-radius: 4px;
      width: 75px;
    }
    .option-menu a {
     width: 100%;
      margin-left: 0;
    }
    .option-menu a:hover {
      background-color: blue;
    }
    .result span p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result span p:hover{
        background: #f2f2f2;
    }

    .no-show {
      visibility: hidden;
    }
</style>

<body id="page-top">
  <input type="hidden" name="adminid" id="adminid" value="<?php echo $_SESSION['adminidno'];?>">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <?php include_once("templates/sidebar.php");?>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <?php include_once("templates/navbar.php");?>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center mb-4 content-between">
            <h1 class="h3 mb-0 text-gray-800 user_title">Payments</h1>
            <h1 class="h3 mb-0 text-gray-800" id="categories" style="padding-left: 10px;"></h1>
          </div>

          <div class="small" id="classalert">
          
          </div>

          <center><small id="no_payments" class="no-show">No transactions have been made</small></center>
          <div class="row" id="payment-table-container">
            <div class="col-12">
              <div class="box">
                <div class="box-header with-border">
                  
                </div>
                  <div class="box-body">
                    <div class="container">
      				        <div class="table-wrapper">			
      				            <div class="table-title">
      				                <div class="row">
      				                    <div class="col-6">
                  										<div class="show-entries">
                  											<span>Show</span>
                  											<select class="prowno">
                  												<option value="5">5</option>
                  												<option value="10">10</option>
                  												<option value="15">15</option>
                  												<option value="20">20</option>
                  											</select>
                  											<span>Payments</span>
                  										</div>						
                  									</div>
      				                    <div class="col-6">
                                    <!--
      				                        <div class="search-box">
                    											<div class="input-group">
                    												<span class="input-group-addon"><i class="fas fa-search"></i></span>
                    												<input type="text" class="form-control" autocomplete="off" id="psearch" placeholder="Search&hellip;">
                                            <div class="result"></div>
                    											</div>
      				                        </div>
                                    -->
      				                    </div>
      				                </div>
      				            </div>
      				            <div id="payments_table">
      				            
      				            </div>
      				        </div>
      				    </div> 
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include_once("templates/footer.php");?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <?php include_once("templates/scripts.php"); ?>

	<script type="text/javascript">
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip();
			// Animate select box length
			var searchInput = $(".search-box input");
			var inputGroup = $(".search-box .input-group");
			var boxWidth = inputGroup.width();
			searchInput.focus(function(){
				inputGroup.animate({
					width: "300"
				});
			}).blur(function(){
				inputGroup.animate({
					width: boxWidth
				});
			});
		});
	</script>

</body>
</html>

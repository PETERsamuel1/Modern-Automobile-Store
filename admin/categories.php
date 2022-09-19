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
        padding: 20px;
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
	.search-box {
        position: relative;
        float: right;
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
        height: 34px;
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
    table.table td:last-child {
        width: 130px;
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
    #removecat, #editcat, #viewcatproducts {
      padding: 3px;
      background-color: #fff;
      border-radius: 50%;
    }

    #removecat:hover, #editcat:hover, #viewcatproducts:hover {
      background-color: #32325d;
    }

    #removecat .removeicon {
      color: #f5365c;
    }

    #editcat .editicon {
      color: #8965e0;
    }

    #viewcatproducts .viewcatproductsicon {
      color: #5e72e4;
    }

    #removecat .removeicon:hover {
      color: #fff;
    }

    #editcat .editicon:hover {
      color: #fff;
    }

    #viewcatproducts .viewcatproductsicon:hover {
      color: #fff;
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
            <h1 class="h3 mb-0 text-gray-800 user_title">Categories</h1>
            <h1 class="h3 mb-0 text-gray-800" id="categories" style="padding-left: 10px;"></h1>
          </div>

          <div class="small" id="classalert">
          
          </div>

          <div class="row">
            <div class="col-12">
              <div class="box">
                <div class="box-header with-border">
                  <input type="hidden" name="categoryid" id="categoryid">
                  <a href="#addnewcategory" data-toggle="modal" id="newcatbtn" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
                </div>
                <div class="box-body">
                  <div class="container">
				        <div class="table-wrapper">			
				            <div class="table-title">
				                <div class="row">
				                    <div class="col-sm-6">
										<div class="show-entries">
											<span>Show</span>
											<select class="rowno">
												<option value="5">5</option>
												<option value="10">10</option>
												<option value="15">15</option>
												<option value="20">20</option>
											</select>
											<span>Categories</span>
										</div>						
									</div>
				                    <div class="col-sm-6">
                              <!--
				                        <div class="search-box">
            											<div class="input-group">
            												<span class="input-group-addon"><i class="fas fa-search"></i></span>
            												<input type="text" class="form-control" placeholder="Search&hellip;">
            											</div>
				                        </div>
                              -->
				                    </div>
				                </div>
				            </div>
				            <div id="categories_table">
				            
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
      <?php include_once("templates/categorymodal.php");?>
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

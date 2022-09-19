
<?php

include_once("templates/header.php");
include_once("../database/constants.php");

if (!isset($_SESSION["adminid"])) {
  header("location:".DOMAIN."/");
}

?>
</style>
<body id="page-top">
<!--
<div class="progress" style="height: 10px;">
    <div class="progress-bar progress-bar-striped" style="min-width: 20px;"></div>
</div>
-->
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
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="container">
                  <input type="text" name="All" class="form-control" placeholder="All" style=" border-color: #6495ED;" readonly/>
                </div>
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="categories.php">Categories</a></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="categoriescount">
                        
                      </div>
                    </div>
                    <div class="col-auto">
                      <a href="categories.php"><i class="fas fa-fw fa-folder fa-2x text-primary"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="container">
                  <input type="text" name="All" class="form-control" placeholder="All" style=" border-color: #28B463;" readonly/>
                </div>
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a href="products.php" style="color: #28B463;">Spare parts</a></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="productscount">
                        
                      </div>
                    </div>
                    <div class="col-auto">
                      <a href="products.php"><i class="fas fa-fw fa-book fa-2x text-success"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="container">
                  <input type="text" name="All" class="form-control" placeholder="All" style=" border-color: #28B463;" readonly/>
                </div>
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Customers</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="customerscount">
                        
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-fw fa-users fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="container">
                  <input type="text" name="All" class="form-control" placeholder="All" style=" border-color: #28B463;" readonly/>
                </div>
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Amount of Money</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalmoney">
                        
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-money-bill fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Spare parts overview</h6>
                 
                </div>
                <!-- Card Body -->
                <div class="card-body" style="min-height: 325px;max-height: 325px;overflow-y: auto;">
                  <div id="chart-container">
                      <canvas id="graphCanvas"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Payment overview</h6>
                 
                </div>
                <!-- Card Body -->
                <div class="card-body" style="min-height: 325px;max-height: 325px;overflow-y: auto;">
                  <div id="chart-container">
                      <canvas id="graphPaymentCanvas"></canvas>
                      <center><small id="info">No payments yet</small></center>
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

</body>

</html>

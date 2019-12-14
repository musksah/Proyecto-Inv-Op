<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Cards</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-text mx-3">Konrad Lorenz<sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-table"></i>
          <span>Metodos Probabilísticos</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Metodos:</h6>
            <a class="collapse-item" href="sensitivity_analisis.php">Sensibility Analysis</a>
          </div>
        </div>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-table"></i>
          <span>Metodos No Probabilísticos</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Metodos:</h6>
            <a class="collapse-item" href="maximax.php">MaxiMax</a>
            <a class="collapse-item" href="maximin.php">MaxiMin</a>
           
          </div>
        </div>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sensitivity Analysis</h1>
          </div>

          <div>

            <div>

              <div class="col-md-9 offset-md-1">

                <!-- Default Card Example -->
                <div class="card mb-4">
                  <div class="card-header">
                    Matrix Generator
                  </div>
                  <div class="card-body">
                    <form method="POST" id="form_matrix_generator">
                      <input type="hidden" name="funcion" value="PayOffMatrix">
                      <div class="row">
                        <!-- <div class="col-md-6">
                          <label for=""></label>  
                        </div> -->
                        <div class="col-md-4" style="margin-top: 10px">
                          <label for="num_alterns">Cantidad de Alternativas:</label>
                        </div>
                        <div class="col-md-8">
                          <input type="number" min="2" max="15" placeholder="Ingrese un número" class="form-control" name="num_alterns" id="num_alterns" required>
                        </div>
                      </div>
                      <!-- <input type="hidden"  value="2" placeholder="Ingrese un número" class="form-control" name="num_uncerts" id="num_uncerts" required> -->
                      <div class="form-group row" style="margin-top: 30px">
                        <div class="col-md-4">
                          <label for="num_uncerts">Casos de Incertidumbre:</label>
                        </div>
                        <div class="col-md-8">
                          <input type="number" min="2" max="10" placeholder="Ingrese un número" class="form-control" name="num_uncerts" id="num_uncerts" required>
                        </div>
                      </div>
                      <div class="form-group row" style="margin-top: 30px">
                        <div class="col-md-12 text-center">
                          <input type="submit" placeholder="Ingrese un número" class="btn btn-primary" value="Generar Matriz">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="col-md-12" id="payoff_matrix_container">
                <!-- Default Card Example -->
                <div class="card mb-4">
                  <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">PayOff Matrix</h6>
                  </div>
                  <div class="card-body" id="card-body-payoff-matrix">

                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <!-- Default Card Example -->
                <div class="card mb-4">
                  <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Maximin</h6>
                  </div>
                  <div class="card-body" id="matrix_max">

                  </div>

                </div>
              </div>
              <div class="col-md-12">
                <!-- Default Card Example -->
                <div class="card mb-4">
                  <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Result</h6>
                  </div>
                  <div class="card-body">
                  <label >The minimum is:</label>
                    <span id="minimo"> </span>
                  </div>

                </div>
              </div>


              <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
              <div class="container my-auto">
                <div class="copyright text-center my-auto">
                  <span>Copyright &copy; Your Website 2019</span>
                </div>
              </div>
            </footer>
            <!-- End of Footer -->

          </div>
          <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
          <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
        <script src="js/maximin.js"></script> 

</body>

</html>
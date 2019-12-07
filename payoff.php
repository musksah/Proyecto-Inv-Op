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

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3">Konrad Lorenz<sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.html">
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Methods:</h6>
            <a class="collapse-item" href="buttons.html">MaxiMin</a>
            <a class="collapse-item" href="cards.html">Sensibility Analysis</a>
          </div>
        </div>
      </li>
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
            <h1 class="h3 mb-0 text-gray-800">PayOffs</h1>
          </div>

          <div>

            <div>

              <div class="col-lg-6">

                <!-- Default Card Example -->
                <div class="card mb-4">
                  <div class="card-header">
                    Datos del Programa
                  </div>
                  <div class="card-body">
                    <form action="controllers/maximaxcontroller.php" method="POST">
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Land Purchased at Locations</th>
                            <th scope="col">
                              <h3 class="text-center">A</h3>
                            </th>
                            <th scope="col">
                              <h3 class="text-center">B</h3>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-center">
                              <h3>A</h3>
                            </td>
                            <td class="">
                              <div class="form-group">
                                <input type="text" class="form-control" id="AA" aria-describedby="emailHelp" placeholder="Enter Number" name="AA">
                              </div>
                            </td>
                            <td class="">
                              <div class="form-group">
                                <input type="text" class="form-control" id="AB" aria-describedby="emailHelp" placeholder="Enter Number" name="AB">
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="  text-center">
                              <h3>B</h3>
                            </td>
                            <td class="">
                              <div class="form-group">
                                <input type="text" class="form-control" id="BA" placeholder="Enter Number" name="BA">
                              </div>
                            </td>
                            <td class="">
                              <div class="form-group">
                                <input type="text" class="form-control" id="BB" aria-describedby="emailHelp" placeholder="Enter Number" name="BB">
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class=" text-center">
                              <h3>A&B</h3>
                            </td>
                            <td class="">
                              <div class="form-group">
                                <input type="text" class="form-control" id="A_BA" aria-describedby="emailHelp" placeholder="Enter Number" name="A_BA">
                              </div>
                            </td>
                            <td class="">
                              <div class="form-group">
                                <input type="text" class="form-control" id="A_BB" aria-describedby="emailHelp" placeholder="Enter Number" name="A_BB">
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="  text-center">
                              <h3>None</h3>
                            </td>
                            <td class="">
                              <div class="form-group">
                                <input type="text" class="form-control" id="noneA" placeholder="Enter Number">
                              </div>
                            </td>
                            <td class="">
                              <div class="form-group">
                                <input type="text" class="form-control" id="noneB" aria-describedby="emailHelp" placeholder="Enter Number">
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-center">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </form>
                  </div>
                </div>
              </div>

              <div class="col-lg-6">

                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Maximum</h6>
                  </div>
                  <div class="card-body">
                    <?php
                    if (isset($_GET['maximo'])) {
                      echo "<p> El máximo es: " . $_GET['maximo'] . "</p>";
                    }
                    ?>
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

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
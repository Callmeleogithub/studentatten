<?php 
include '../Includes/dbcon.php';
include '../Includes/session.php';

$query = "SELECT tblclass.className,tblclassarms.classArmName 
FROM tblclassteacher
INNER JOIN tblclass ON tblclass.Id = tblclassteacher.classId
INNER JOIN tblclassarms ON tblclassarms.Id = tblclassteacher.classArmId
Where tblclassteacher.Id = '$_SESSION[userId]'";

$rs = $conn->query($query);
$num = $rs->num_rows;
$rrw = $rs->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="../img/logo/teacher.jpg" rel="icon">
  <title>Dashboard</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include "Includes/sidebar.php";?>
    <!-- Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <?php include "Includes/topbar.php";?>
        <!-- Topbar -->

        <!-- Dashboard Hero Section -->
        <div class="container-fluid px-4 py-4" id="container-wrapper" style="max-width: 98%; margin: 0 auto;">
          <div class="bg-white shadow-sm rounded-4 p-4">
            
            <!-- Title -->
            <div class="dashboard-hero text-center px-4 py-2">
              <h1 class="display-5 fw-bold text-dark mb-3">
                <i class="fas fa-tachometer-alt text-primary me-2"></i>
                Administrator Dashboard
              </h1>
            </div>

            <!-- Breadcrumbs -->
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb justify-content-center mb-4">
                <li class="breadcrumb-item">
                  <a href="./index.php" class="text-primary text-decoration-none">
                    <i class="fas fa-home me-1"></i> Home
                  </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">Dashboard</li>
              </ol>
            </nav>

            <!-- Cards Section -->
            <div class="row mb-3 mt-3">

              <!-- Students Card -->
              <?php 
              $query1=mysqli_query($conn,"SELECT * from tblstudents");                       
              $students = mysqli_num_rows($query1);
              ?>
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Students</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $students;?></div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-user-graduate fa-2x text-primary"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Class Card -->
              <?php 
              $query1=mysqli_query($conn,"SELECT * from tblclass");                       
              $class = mysqli_num_rows($query1);
              ?>
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Classes</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $class;?></div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-chalkboard fa-2x text-primary"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Class Arm Card -->
              <?php 
              $query1=mysqli_query($conn,"SELECT * from tblclassarms");                       
              $classArms = mysqli_num_rows($query1);
              ?>
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Class Arms</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $classArms;?></div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-code-branch fa-2x text-success"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Attendance Card -->
              <?php 
              $query1=mysqli_query($conn,"SELECT * from tblattendance");                       
              $totAttendance = mysqli_num_rows($query1);
              ?>
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Student Attendance</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totAttendance;?></div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-secondary"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Teachers Card -->
              <?php 
              $query1=mysqli_query($conn,"SELECT * from tblclassteacher");                       
              $classTeacher = mysqli_num_rows($query1);
              ?>
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Class Teachers</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $classTeacher;?></div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-chalkboard-teacher fa-2x text-danger"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Session and Terms Card -->
              <?php 
              $query1=mysqli_query($conn,"SELECT * from tblsessionterm");                       
              $sessTerm = mysqli_num_rows($query1);
              ?>
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Session & Terms</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $sessTerm;?></div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-calendar-alt fa-2x text-warning"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Terms Card -->
              <?php 
              $query1=mysqli_query($conn,"SELECT * from tblterm");                       
              $termonly = mysqli_num_rows($query1);
              ?>
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Terms</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $termonly;?></div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-th fa-2x text-info"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div> <!-- End of row -->
          </div> <!-- End of white box -->
        </div> <!-- End of container -->

      </div>
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap 5 JS Bundle (includes Popper.js) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>  
</body>
</html>

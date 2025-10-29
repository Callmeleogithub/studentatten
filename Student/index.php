<?php 
include 'Includes/dbcon.php'; 
include 'Includes/session.php'; 

$student_id = $_SESSION['userId'];
$full_name = $_SESSION['fullName'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
    .sidebar { min-height: 100vh; border-right: 1px solid #e2e8f0; }
    .card { border: none; }
  </style>
</head>
<body>
<div class="d-flex">

  <!-- Sidebar -->
  <?php include 'Includes/sidebar.php'; ?>

  <div class="flex-grow-1">
    <!-- Topbar -->
    <?php include 'Includes/topbar.php'; ?>

    <!-- Main Content -->
    <div class="container-fluid p-4">
      <h2 class="fw-bold text-dark mb-4">Welcome, <?php echo $full_name; ?></h2>

      <div class="row">
        <!-- Attendance Summary -->
        <div class="col-md-6 col-xl-4 mb-4">
          <div class="card shadow-sm rounded-3">
            <div class="card-body d-flex align-items-center justify-content-between">
              <div>
                <h6 class="text-muted text-uppercase small">Total Days Present</h6>
                <h4 class="fw-bold text-success">
                  <?php 
                    $query = mysqli_query($conn, "SELECT * FROM tblattendance WHERE studentId='$student_id' AND status='1'");
                    echo mysqli_num_rows($query);
                  ?>
                </h4>
              </div>
              <i class="fas fa-user-check fa-2x text-success"></i>
            </div>
          </div>
        </div>

        <!-- Leave Requests -->
        <div class="col-md-6 col-xl-4 mb-4">
          <div class="card shadow-sm rounded-3">
            <div class="card-body d-flex align-items-center justify-content-between">
              <div>
                <h6 class="text-muted text-uppercase small">Leave Requests</h6>
                <h4 class="fw-bold text-info">
                  <?php 
                    $leave = mysqli_query($conn, "SELECT * FROM leave_applications WHERE student_id='$student_id'");
                    echo mysqli_num_rows($leave);
                  ?>
                </h4>
              </div>
              <i class="fas fa-paper-plane fa-2x text-info"></i>
            </div>
          </div>
        </div>

        <!-- Pending Leaves -->
        <div class="col-md-6 col-xl-4 mb-4">
          <div class="card shadow-sm rounded-3">
            <div class="card-body d-flex align-items-center justify-content-between">
              <div>
                <h6 class="text-muted text-uppercase small">Pending Leaves</h6>
                <h4 class="fw-bold text-warning">
                  <?php 
                    $pending = mysqli_query($conn, "SELECT * FROM leave_applications WHERE student_id='$student_id' AND status='Pending'");
                    echo mysqli_num_rows($pending);
                  ?>
                </h4>
              </div>
              <i class="fas fa-hourglass-half fa-2x text-warning"></i>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

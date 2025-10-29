<div class="d-flex">
  
  <!-- Sidebar -->
  <ul class="navbar-nav bg-white shadow sidebar p-3" id="accordionSidebar">
    <a class="d-flex align-items-center mb-3" href="#">
      <img src="../img/logo/whiteboard.jpg" alt="Logo" class="rounded-circle shadow-sm me-2" style="width: 48px; height: 48px; border: 2px solid #6366f1;">
      <span class="fw-bold text-primary fs-5">SAMS</span>

    </a>
    <hr class="sidebar-divider my-2">
    <!-- Dashboard -->
    <li class="nav-item active">
      <a class="nav-link text-dark fw-semibold d-flex align-items-center gap-2" href="#">
        <i class="fas fa-tachometer-alt text-primary"></i>
        Dashboard
      </a>
    </li>

    <hr class="sidebar-divider">

    <!-- View Attendance -->
    <li class="nav-item">
      <a class="nav-link text-dark d-flex align-items-center gap-2" href="view_my_attendance.php">
        <i class="fas fa-calendar-check text-success"></i>
        My Attendance
      </a>
    </li>

    <!-- Apply for Leave -->
    <li class="nav-item">
      <a class="nav-link text-dark d-flex align-items-center gap-2" href="leave_form.php">
        <i class="fas fa-paper-plane text-info"></i>
        Apply for Leave
      </a>
    </li>

    <!-- View Leave Status -->
    <li class="nav-item">
      <a class="nav-link text-dark d-flex align-items-center gap-2" href="my_leave_status.php">
        <i class="fas fa-clock text-warning"></i>
        Leave Status
      </a>
    </li>

    <!-- Profile -->
    <li class="nav-item">
      <a class="nav-link text-dark d-flex align-items-center gap-2" href="my_profile.php">
        <i class="fas fa-user text-secondary"></i>
        My Profile
      </a>
    </li>

    <!-- Logout -->
    <li class="nav-item mt-3">
      <a class="nav-link text-danger d-flex align-items-center gap-2" href="../logout.php">
        <i class="fas fa-sign-out-alt"></i>
        Logout
      </a>
    </li>
  </ul>

  <!-- Main Content -->
  <div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold text-dark">Welcome, <?php echo $full_name; ?></h2>
      <span class="badge bg-primary fs-6">Student Panel</span>
    </div>

    <!-- Dashboard Cards -->
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
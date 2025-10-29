<!-- Modern Sidebar -->
<ul class="navbar-nav bg-white shadow sidebar p-3" id="accordionSidebar" style="min-height: 100vh; border-right: 1px solid #e2e8f0; font-family: 'Poppins', sans-serif;">

  <!-- Brand -->
  <a class="d-flex align-items-center mb-3" href="index.php">
    <img src="../img/logo/board.jpg" alt="Logo" class="rounded-circle shadow-sm me-2" style="width: 48px; height: 48px; border: 2px solid #6366f1;">
    <span class="fw-bold text-primary fs-5">SAMS</span>
  </a>

  <hr class="sidebar-divider my-2">

  <!-- Dashboard -->
  <li class="nav-item active">
    <a class="nav-link text-dark fw-semibold d-flex align-items-center gap-2" href="index.php">
      <i class="fas fa-tachometer-alt text-primary"></i>
      Dashboard
    </a>
  </li>

  <hr class="sidebar-divider">

  <!-- Students Section -->
  <div class="sidebar-heading text-muted small text-uppercase">Students</div>

  <li class="nav-item">
    <a class="nav-link collapsed text-dark d-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#collapseStudents" aria-expanded="false">
      <i class="fas fa-user-graduate text-danger"></i>
      Manage Students
    </a>
    <div id="collapseStudents" class="collapse" data-bs-parent="#accordionSidebar">
      <div class="bg-light rounded ms-3 mt-1 py-2 ps-3">
        <a class="collapse-item text-dark d-block mb-1" href="viewStudents.php">View Students</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider">

  <!-- Attendance Section -->
  <div class="sidebar-heading text-muted small text-uppercase">Attendance</div>

  <li class="nav-item">
    <a class="nav-link collapsed text-dark d-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAttendance" aria-expanded="false">
      <i class="fa fa-calendar-alt text-secondary"></i>
      Manage Attendance
    </a>
    <div id="collapseAttendance" class="collapse" data-bs-parent="#accordionSidebar">
      <div class="bg-light rounded ms-3 mt-1 py-2 ps-3">
        <a class="collapse-item text-dark d-block mb-1" href="takeAttendance.php">Take Attendance</a>
        <a class="collapse-item text-dark d-block mb-1" href="viewAttendance.php">View Class Attendance</a>
        <a class="collapse-item text-dark d-block mb-1" href="viewStudentAttendance.php">View Student Attendance</a>
        <a class="collapse-item text-dark d-block mb-1" href="downloadRecord.php">Today's Report (xls)</a>
      </div>
    </div>
  </li>

  <!-- You can continue with more sections like 'Leave Management' etc. following same pattern -->

  <hr class="sidebar-divider d-none d-md-block">
</ul>

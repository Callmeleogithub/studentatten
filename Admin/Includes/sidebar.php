<!-- Modern Sidebar -->
<ul class="navbar-nav bg-white shadow sidebar p-3" id="accordionSidebar" style="min-height: 100vh; border-right: 1px solid #e2e8f0; font-family: 'Poppins', sans-serif;">
  
  <!-- Brand -->
  <li class="nav-item text-center mb-3">
    <img src="../img/logo/teacher.jpg" alt="Logo" class="rounded-circle shadow-sm" style="width: 48px; height: 48px; border: 2px solid #6366f1;">
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider my-2">

  <!-- Dashboard -->
  <li class="nav-item active">
    <a class="nav-link text-dark fw-semibold d-flex align-items-center gap-2" href="index.php">
      <i class="fas fa-tachometer-alt text-primary"></i>
      Dashboard
    </a>
  </li>

  <hr class="sidebar-divider">

  <!-- Class Section -->
  <div class="sidebar-heading text-muted small text-uppercase">Class and Class Arms</div>

  <!-- Manage Classes -->
 
    <a class="nav-link collapsed text-dark d-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#collapseClasses" aria-expanded="false">
      <i class="fas fa-chalkboard text-info"></i>
      Manage Classes
    </a>
    <div id="collapseClasses" class="collapse" data-bs-parent="#accordionSidebar">
      <div class="bg-light rounded ms-3 mt-1 py-2 ps-3">
        <a class="collapse-item text-dark d-block mb-1" href="createClass.php">Create Class</a>
      </div>
    </div>


  <!-- Manage Class Arms -->
  <li class="nav-item">
    <a class="nav-link collapsed text-dark d-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#collapseArms" aria-expanded="false">
      <i class="fas fa-code-branch text-success"></i>
      Manage Class Arms
    </a>
    <div id="collapseArms" class="collapse" data-bs-parent="#accordionSidebar">
      <div class="bg-light rounded ms-3 mt-1 py-2 ps-3">
        <a class="collapse-item text-dark d-block mb-1" href="createClassArms.php">Create Class Arms</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider">

  <!-- Teachers -->
  <div class="sidebar-heading text-muted small text-uppercase">Teachers</div>

  <li class="nav-item">
    <a class="nav-link collapsed text-dark d-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTeachers" aria-expanded="false">
      <i class="fas fa-chalkboard-teacher text-warning"></i>
      Manage Teachers
    </a>
    <div id="collapseTeachers" class="collapse" data-bs-parent="#accordionSidebar">
      <div class="bg-light rounded ms-3 mt-1 py-2 ps-3">
        <a class="collapse-item text-dark d-block mb-1" href="createClassTeacher.php">Create Class Teachers</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider">

  <!-- Students -->
  <div class="sidebar-heading text-muted small text-uppercase">Students</div>

  <li class="nav-item">
    <a class="nav-link collapsed text-dark d-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#collapseStudents" aria-expanded="false">
      <i class="fas fa-user-graduate text-danger"></i>
      Manage Students
    </a>
    <div id="collapseStudents" class="collapse" data-bs-parent="#accordionSidebar">
      <div class="bg-light rounded ms-3 mt-1 py-2 ps-3">
        <a class="collapse-item text-dark d-block mb-1" href="createStudents.php">Create Students</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider">

  <!-- Session & Term -->
  <div class="sidebar-heading text-muted small text-uppercase">Session & Term</div>

  <li class="nav-item">
    <a class="nav-link collapsed text-dark d-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSession" aria-expanded="false">
      <i class="fas fa-calendar-alt text-secondary"></i>
      Manage Session & Term
    </a>
    <div id="collapseSession" class="collapse" data-bs-parent="#accordionSidebar">
      <div class="bg-light rounded ms-3 mt-1 py-2 ps-3">
        <a class="collapse-item text-dark d-block mb-1" href="createSessionTerm.php">Create Session and Term</a>
      </div>
    </div>
  </li>

  <hr class="sidebar-divider d-none d-md-block">

</ul>

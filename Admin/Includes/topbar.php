<?php 
  $query = "SELECT * FROM tbladmin WHERE Id = ".$_SESSION['userId']."";
  $rs = $conn->query($query);
  $rows = $rs->fetch_assoc();
  $fullName = $rows['firstName']." ".$rows['lastName'];
?>
<nav class="navbar navbar-expand-lg shadow-sm" 
     style="background: linear-gradient(90deg, #4f46e5, #3b82f6); height: 72px; margin: 0; padding: 0;">
  <div class="container-fluid d-flex justify-content-between align-items-center" style="height: 100%;">

    <!-- Sidebar Toggle -->
    <button class="btn btn-light d-md-none rounded-circle shadow-sm me-3" id="sidebarToggleTop">
      <i class="fas fa-bars text-primary"></i>
    </button>

    <!-- System Title -->
    <div class="text-white fw-bold fs-5 ms-md-4">
      Student Attendance Management System
    </div>

    <!-- Search Bar -->
    <form id="globalSearchForm" class="d-none d-lg-block" style="min-width: 300px; position: relative;">
      <div class="input-group shadow-sm">
        <input type="text" id="globalSearchInput" class="form-control border-0 ps-3 py-2" 
               placeholder="🔍 Search students..." style="border-radius: 30px 0 0 30px;">
        <button class="btn rounded-end" type="submit" 
                style="border-radius: 0 30px 30px 0; background: linear-gradient(90deg, #3b82f6, #4f46e5); color: white;">
          <i class="fas fa-search"></i>
        </button>
      </div>
      <!-- Search Results Dropdown -->
      <div id="globalSearchResults" class="position-absolute bg-white shadow-sm" 
           style="z-index:1000; width:100%; display:none;"></div>
    </form>

    <!-- User Dropdown -->
    <div class="dropdown">
      <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="d-none d-lg-inline fw-semibold">Welcome, <?php echo $fullName; ?></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="userDropdown">
  <li>
    <a class="dropdown-item" href="adminProfile.php">
      <i class="fas fa-user me-2 text-primary"></i> Profile
    </a>
  </li>
  <li>
    <a class="dropdown-item" href="adminProfile.php#settings">
      <i class="fas fa-cog me-2 text-warning"></i> Settings
    </a>
  </li>
  <li><hr class="dropdown-divider"></li>
  <li>
    <a class="dropdown-item text-danger fw-semibold" href="logout.php">
      <i class="fas fa-power-off me-2"></i> Logout
    </a>
  </li>
</ul>

    </div>

  </div>
</nav>

<!-- jQuery needed for AJAX -->
<script src="../vendor/jquery/jquery.min.js"></script>

<script>
$(document).ready(function(){

    function showResults(query){
        if(query.length === 0){
            $('#globalSearchResults').hide();
            return;
        }
        $.ajax({
            url: "ajaxStudentSearch.php",
            method: "GET",
            data: {search: query},
            success: function(data){
                $('#globalSearchResults').html(data).show();
            }
        });
    }

    // Live search on keyup
    $('#globalSearchInput').on('keyup', function(){
        let query = $(this).val();
        showResults(query);
    });

    // Trigger search on enter key
    $('#globalSearchForm').on('submit', function(e){
        e.preventDefault();
        let query = $('#globalSearchInput').val();
        showResults(query);
    });

    // Hide dropdown if clicked outside
    $(document).on('click', function(e){
        if(!$(e.target).closest('#globalSearchResults, #globalSearchInput').length){
            $('#globalSearchResults').hide();
        }
    });
});
</script>

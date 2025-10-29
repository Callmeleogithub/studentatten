<?php 
error_reporting(E_ALL);
include '../Includes/dbcon.php';
include '../Includes/session.php';

$adminId = $_SESSION['userId']; // logged-in admin ID

// Fetch admin info
$query = mysqli_query($conn, "SELECT * FROM tbladmin WHERE Id='$adminId'");
$admin = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SAMS | Admin Profile</title>
<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="css/ruang-admin.min.css" rel="stylesheet">
</head>
<body id="page-top">
<div id="wrapper">

<?php include "Includes/sidebar.php"; ?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php include "Includes/topbar.php"; ?>

<div class="container-fluid mt-4">
    <h1 class="h3 mb-4 text-gray-800">Admin Profile</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Personal Information</h6>
        </div>
        <div class="card-body">
            <p><strong>Full Name:</strong> <?php echo $admin['firstName'].' '.$admin['lastName']; ?></p>
            <p><strong>Username:</strong> <?php echo $admin['username']; ?></p>
            <p><strong>Email:</strong> <?php echo $admin['emailAddress']; ?></p>
        </div>
    </div>

</div>
<?php include "Includes/footer.php"; ?>
</div>
</div>
</div>

<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php 
error_reporting(E_ALL);
include '../Includes/dbcon.php';
include '../Includes/session.php';

$statusMsg = "";
$adminId = $_SESSION['userId'];

// Fetch admin info
$query = mysqli_query($conn, "SELECT * FROM tbladmin WHERE Id='$adminId'");
$admin = mysqli_fetch_assoc($query);

// Update personal info
if(isset($_POST['updateInfo'])){
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    $update = mysqli_query($conn, "UPDATE tbladmin SET 
        firstName='$fullName', email='$email', username='$username' 
        WHERE Id='$adminId'");

    $statusMsg = $update ? 
        "<div class='alert alert-success'>Profile updated successfully!</div>" :
        "<div class='alert alert-danger'>Error updating profile: ".mysqli_error($conn)."</div>";
}

// Change password
if(isset($_POST['changePassword'])){
    $oldPassword = mysqli_real_escape_string($conn, $_POST['oldPassword']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    if($oldPassword !== $admin['password']){
        $statusMsg = "<div class='alert alert-danger'>Old password is incorrect!</div>";
    } elseif($newPassword !== $confirmPassword){
        $statusMsg = "<div class='alert alert-danger'>New passwords do not match!</div>";
    } else {
        $updatePwd = mysqli_query($conn, "UPDATE tbladmin SET password='$newPassword' WHERE Id='$adminId'");
        $statusMsg = $updatePwd ? 
            "<div class='alert alert-success'>Password changed successfully!</div>" :
            "<div class='alert alert-danger'>Error changing password: ".mysqli_error($conn)."</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SAMS | Admin Settings</title>
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
    <h1 class="h3 mb-4 text-gray-800">Admin Settings</h1>
    <?php echo $statusMsg; ?>

    <!-- Update Info -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update Profile</h6>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label>Full Name</label>
                    <input type="text" name="fullName" value="<?php echo $admin['firstName']; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="emailAddress" name="emailAddress" value="<?php echo $admin['emailAddress']; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" value="<?php echo $admin['username']; ?>" class="form-control" required>
                </div>
                <button type="submit" name="updateInfo" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>

    <!-- Change Password -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-warning">Change Password</h6>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label>Old Password</label>
                    <input type="password" name="oldPassword" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>New Password</label>
                    <input type="password" name="newPassword" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Confirm New Password</label>
                    <input type="password" name="confirmPassword" class="form-control" required>
                </div>
                <button type="submit" name="changePassword" class="btn btn-warning">Change Password</button>
            </form>
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

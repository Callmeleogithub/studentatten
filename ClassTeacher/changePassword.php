<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include '../Includes/dbcon.php'; // Make sure this path is correct

// Check if teacher is logged in
if (!isset($_SESSION['userId'])) {
    header("Location: index.php");
    exit();
}

$teacher_id = $_SESSION['userId'];
$message = "";

// Handle form submission
if (isset($_POST['submit'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch current hashed password from DB
    $stmt = $conn->prepare("SELECT password FROM tblclassteacher WHERE Id = ?");
    $stmt->bind_param("i", $teacher_id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $db_password = $row['password'];

            // Verify current password
            if (password_verify($current_password, $db_password)) {
                if ($new_password === $confirm_password) {
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                    $update_stmt = $conn->prepare("UPDATE tblclassteacher SET password = ? WHERE Id = ?");
                    $update_stmt->bind_param("si", $hashed_password, $teacher_id);
                    if ($update_stmt->execute()) {
                        $message = "Password changed successfully!";
                    } else {
                        $message = "Error updating password!";
                    }
                    $update_stmt->close();
                } else {
                    $message = "New passwords do not match!";
                }
            } else {
                $message = "Current password is incorrect!";
            }

        } else {
            $message = "Teacher not found!";
        }
    } else {
        $message = "Database query failed!";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password - SAMS</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f1f5f9;
        }

        .container-login {
            margin-top: 50px;
        }

        .login-form {
            padding: 30px;
        }

        .login-form h5 {
            text-align: center;
            margin-bottom: 20px;
            color: #C33764;
            font-weight: 600;
        }

        .login-form img {
            width: 100px;
            border-radius: 50%;
        }

        .login-form h1 {
            margin-top: 15px;
            margin-bottom: 25px;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-success {
            background: linear-gradient(to right, #C33764, #1D2671);
            border: none;
            border-radius: 10px;
        }

        .btn-success:hover {
            opacity: 0.9;
        }

        .alert-info {
            background-color: #e2e3f3;
            color: #1d2671;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 20px;
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="container-login d-flex justify-content-center align-items-center" style="min-height: 100vh; background: #f1f5f9;">
    <div class="col-xl-6 col-lg-8 col-md-10">
        <div class="card shadow-sm p-4" style="border-radius:15px;">
            <div class="login-form text-center">
                <h5 class="mb-3" style="color:#C33764;">STUDENT ATTENDANCE MANAGEMENT SYSTEM</h5>
                <div class="mb-4">
                    <img src="../img/logo/teacher.jpg" alt="Logo" class="mb-3" style="width:100px; height:100px; border-radius:50%;">
                    <h1 class="h4 mb-0">Change Password</h1>
                </div>

                <?php if($message != ""): ?>
                    <div class="alert alert-info"><?= $message ?></div>
                <?php endif; ?>

                <form class="user" method="POST">
                    <div class="form-group mb-4 text-start">
                        <label>Current Password</label>
                        <input type="password" name="current_password" class="form-control py-2" placeholder="Enter current password" required>
                    </div>
                    <div class="form-group mb-4 text-start">
                        <label>New Password</label>
                        <input type="password" name="new_password" class="form-control py-2" placeholder="Enter new password" required>
                    </div>
                    <div class="form-group mb-4 text-start">
                        <label>Confirm New Password</label>
                        <input type="password" name="confirm_password" class="form-control py-2" placeholder="Confirm new password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success btn-block w-100 py-2" name="submit" value="Change Password">
                    </div>
                </form>

                <div class="text-center mt-3">
                    <a href="index.php" class="text-decoration-none">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>

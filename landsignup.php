<?php
include 'Includes/dbcon.php';
session_start();

$success_message = '';
$error_message = '';

if (isset($_POST['signup'])) {
    // Sanitize and get input values
    $userType = mysqli_real_escape_string($conn, $_POST['userType']);
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $emailAddress = mysqli_real_escape_string($conn, $_POST['emailAddress']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    // Basic Validation
    if (empty($firstName) || empty($lastName) || empty($emailAddress) || empty($password) || empty($confirmPassword) || empty($userType)) {
        $error_message = 'All fields are required.';
    } elseif (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Invalid email address format.';
    } elseif ($password !== $confirmPassword) {
        $error_message = 'Passwords do not match.';
    } elseif (strlen($password) < 6) { // Minimum password length
        $error_message = 'Password must be at least 6 characters long.';
    } else {
        // Hash the password securely
        // IMPORTANT: For production, use password_hash() and password_verify()
        // For simplicity and symmetry with your presumed login, I'm just storing it as is.
        // **HIGHLY RECOMMEND changing this to password_hash($password, PASSWORD_DEFAULT);**
        $hashed_password = md5($password);

        $table = '';
        $redirect_page = '';
        $username_field = ''; // This will be email for admin/teacher, admission for student

        switch ($userType) {
            case 'Administrator':
                $table = 'tbladmin';
                $username_field = 'emailAddress'; // Using email as username for admin
                $redirect_page = 'Admin/index.php'; // Or a confirmation page
                break;
            case 'ClassTeacher':
                $table = 'tblclassteacher';
                $username_field = 'emailAddress'; // Using email as username for teacher
                $redirect_page = 'ClassTeacher/index.php'; // Or a confirmation page
                break;
            case 'Student':
                // For students, you might have an 'admissionNumber' or 'studentId' as username.
                // For this signup, I'll assume `emailAddress` as a generic login,
                // but in a real system, students might be registered by an admin, not sign up themselves.
                $table = 'tblstudents';
                $username_field = 'emailAddress';
                $redirect_page = 'Students/index.php'; // Or a confirmation page
                break;
            default:
                $error_message = 'Invalid user role.';
                break;
        }

        if (empty($table)) {
            $error_message = 'Invalid user role selected.';
        } else {
            // Check if user already exists
            $check_query = "SELECT * FROM $table WHERE $username_field = '$emailAddress'";
            $check_result = mysqli_query($conn, $check_query);

            if (mysqli_num_rows($check_result) > 0) {
                $error_message = 'User with this email already exists.';
            } else {
                // Insert new user into the database
                // Note: Other fields like `admissionNumber`, `classId`, `sectionId`, `dateCreated`
                // are not being collected here. A real student signup might need an admin approval
                // or more fields. This is a generic signup.

                $insert_query = "";
                if ($userType == 'Student') {
                    // Students often need more specific fields like Admission Number, Class, Section.
                    // For a simple signup, we'll assume a basic student entry here.
                    // You might need to adjust this to fit your tblstudents schema.
                    $insert_query = "INSERT INTO $table (firstName, lastName, emailAddress, password, admissionNumber, classId, sectionId) 
                                     VALUES ('$firstName', '$lastName', '$emailAddress', '$hashed_password', '', '0', '0')";
                    // The '' for admissionNumber, and '0' for classId/sectionId are placeholders.
                    // A real student signup would likely involve an admin registering them or
                    // more detailed input fields here.
                } else {
                    $insert_query = "INSERT INTO $table (firstName, lastName, emailAddress, password) 
                                     VALUES ('$firstName', '$lastName', '$emailAddress', '$hashed_password')";
                }

                if (mysqli_query($conn, $insert_query)) {
                    $success_message = 'Account created successfully! You can now login.';
                    // You might want to automatically log them in or redirect to login page
                    header("refresh:3; Location: index.php"); // Redirect to login
                    exit();
                } else {
                    $error_message = 'Error creating account: ' . mysqli_error($conn);
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/teacher.jpg" rel="icon">
    <title>SAMS-Student Attendance System - Signup</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">

</head>

<title>Signup Panel</title>
<style>
    body {
        margin: 0;
        padding: 0;
        background: linear-gradient(135deg, #C33764, #1D2671);
        /* Matching gradient */
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', sans-serif;
    }

    .container-login {
        /* Reusing class for symmetrical layout */
        width: 100%;
        max-width: 600px;
        padding: 20px;
    }

    .card {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(14px);
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    .login-form {
        /* Reusing class name for styling consistency */
        padding: 40px 30px;
    }

    .login-form h5,
    .login-form h1 {
        color: #000;
        text-align: center;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.9);
        color: #111;
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        padding: 12px;
        margin-bottom: 15px;
        font-size: 16px;
    }

    .form-control::placeholder {
        color: #666;
    }

    .form-control:focus {
        outline: none;
        background: #fff;
        border-color: #C33764;
    }

    .btn-primary {
        /* Changed to btn-primary for signup to differentiate or keep btn-success */
        background: #1D2671;
        /* A different color from login, but still part of the gradient */
        border: none;
        border-radius: 10px;
        padding: 12px;
        color: #fff;
        font-weight: bold;
        transition: 0.3s ease;
    }

    /* You can use btn-success again if you want the same button color as login */
    .btn-primary:hover {
        background: #C33764;
    }

    img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 3px solid white;
    }

    select,
    input[type="text"],
    input[type="password"] {
        width: 100%;
    }

    .form-group label {
        font-weight: 600;
        color: #000;
    }

    option {
        color: #000;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: .25rem;
        text-align: center;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: .25rem;
        text-align: center;
    }

    .text-center a {
        color: #1D2671;
        /* Link color */
        font-weight: bold;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .text-center a:hover {
        color: #C33764;
        /* Hover color */
    }
</style>

<body class="bg-gradient-login" style="background-image: url('img/logo/education.jpg');">

    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <h5>STUDENT ATTENDANCE MANAGEMENT SYSTEM</h5>
                                    <div class="text-center">
                                        <img src="img/logo/teacher.jpg" alt="Logo">
                                        <br><br>
                                        <h1 class="h4 mb-4">Create Account</h1>
                                    </div>

                                    <?php
                                    if (!empty($error_message)) {
                                        echo '<div class="alert-danger">' . htmlspecialchars($error_message) . '</div>';
                                    }
                                    if (!empty($success_message)) {
                                        echo '<div class="alert-success">' . htmlspecialchars($success_message) . '</div>';
                                    }
                                    ?>

                                    <form class="user" method="Post" action="">
                                        <div class="form-group">
                                            <label for="userType">User Role</label>
                                            <select required name="userType" class="form-control mb-3" id="userType">
                                                <option value="">--Select User Roles--</option>
                                                <option value="Administrator" <?= (isset($_POST['userType']) && $_POST['userType'] == 'Administrator') ? 'selected' : '' ?>>
                                                    Administrator</option>
                                                <option value="ClassTeacher" <?= (isset($_POST['userType']) && $_POST['userType'] == 'ClassTeacher') ? 'selected' : '' ?>>
                                                    ClassTeacher</option>
                                                <option value="Student" <?= (isset($_POST['userType']) && $_POST['userType'] == 'Student') ? 'selected' : '' ?>>Student</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="firstName">First Name</label>
                                            <input type="text" class="form-control" name="firstName" id="firstName"
                                                placeholder="Enter First Name"
                                                value="<?= isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '' ?>"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="lastName">Last Name</label>
                                            <input type="text" class="form-control" name="lastName" id="lastName"
                                                placeholder="Enter Last Name"
                                                value="<?= isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '' ?>"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">Email Address</label>
                                            <input type="email" class="form-control" name="emailAddress"
                                                id="emailAddress" placeholder="Enter Email Address"
                                                value="<?= isset($_POST['emailAddress']) ? htmlspecialchars($_POST['emailAddress']) : '' ?>"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" required class="form-control"
                                                id="password" placeholder="Enter Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirmPassword">Confirm Password</label>
                                            <input type="password" name="confirmPassword" required class="form-control"
                                                id="confirmPassword" placeholder="Confirm Password">
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-block"
                                                value="Register Account" name="signup" />
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="font-weight-bold small" href="index.php">Already have an account?
                                            Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>
</body>

</html>
<?php 
include 'Includes/dbcon.php';
session_start();
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
    <title>SAMS-Student Attendance System</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login" style="background-image: url('img/logo/education.jpg');">

    <title>Login Panel</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #C33764, #1D2671);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .container-login {
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

        .btn-success {
            background: #C33764;
            border: none;
            border-radius: 10px;
            padding: 12px;
            color: #fff;
            font-weight: bold;
            transition: 0.3s ease;
        }

        .btn-success:hover {
            background: #1D2671;
        }

        img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid white;
        }

        select, input[type="text"], input[type="password"] {
            width: 100%;
        }

        .form-group label {
            font-weight: 600;
            color: #000;
        }

        option {
            color: #000;
        }
    </style>
</head>
<body>

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
                                    <h1 class="h4 mb-4">Login Panel</h1>
                                </div>
                                <form class="user" method="Post" action="">
                                    <div class="form-group">
                                        <label for="userType">User Role</label>
                                        <select required name="userType" class="form-control mb-3" id="userType">
                                            <option value="">--Select User Roles--</option>
                                            <option value="Administrator">Administrator</option>
                                            <option value="ClassTeacher">ClassTeacher</option>
                                            <option value="Student">Student</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
    <input type="text" class="form-control" name="username" id="username" placeholder="Enter Email Address" 
           value="<?= isset($_COOKIE['remembered_username']) ? htmlspecialchars($_COOKIE['remembered_username']) : '' ?>">
</div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" required class="form-control" id="password" placeholder="Enter Password">
                                    </div>
                                    <div class="form-group">
                                    <div class="form-group">
                                    <div class="form-group" style="color: #000;">
    <input type="checkbox" id="customCheck" name="remember" 
           <?= isset($_COOKIE['remembered_username']) ? 'checked' : '' ?>
           style="width: 18px; height: 18px; cursor: pointer;">
    <label for="customCheck" style="cursor: pointer; margin-left: 8px;">Remember Me</label>
</div>



                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success btn-block" value="Login" name="login" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['login'])) {

    $userType = $_POST['userType'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = md5($password);

    if ($userType == "Administrator") {

        $query = "SELECT * FROM tbladmin WHERE emailAddress = '$username' AND password = '$password'";
        $rs = $conn->query($query);
        $num = $rs->num_rows;
        $rows = $rs->fetch_assoc();

        if ($num > 0) {

            $_SESSION['userId'] = $rows['Id'];
            $_SESSION['firstName'] = $rows['firstName'];
            $_SESSION['lastName'] = $rows['lastName'];
            $_SESSION['emailAddress'] = $rows['emailAddress'];

            echo "<script type = \"text/javascript\">
            window.location = (\"Admin/index.php\")
            </script>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>
            Invalid Username/Password!
            </div>";
        }
    } else if ($userType == "ClassTeacher") {

        $query = "SELECT * FROM tblclassteacher WHERE emailAddress = '$username' AND password = '$password'";
        $rs = $conn->query($query);
        $num = $rs->num_rows;
        $rows = $rs->fetch_assoc();

        if ($num > 0) {

            $_SESSION['userId'] = $rows['Id'];
            $_SESSION['firstName'] = $rows['firstName'];
            $_SESSION['lastName'] = $rows['lastName'];
            $_SESSION['emailAddress'] = $rows['emailAddress'];
            $_SESSION['classId'] = $rows['classId'];
            $_SESSION['classArmId'] = $rows['classArmId'];

            echo "<script type = \"text/javascript\">
            window.location = (\"ClassTeacher/index.php\")
            </script>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>
            Invalid Username/Password!
            </div>";
        }
    } else if ($userType == "Student") {

        $query = "SELECT * FROM tblstudents WHERE emailAddress = '$username' AND password = '$password'";
        $rs = $conn->query($query);
        $num = $rs->num_rows;
        $rows = $rs->fetch_assoc();

        if ($num > 0) {

            $_SESSION['userId'] = $rows['Id'];
            $_SESSION['firstName'] = $rows['firstName'];
            $_SESSION['lastName'] = $rows['lastName'];
            $_SESSION['emailAddress'] = $rows['emailAddress'];
            $_SESSION['classId'] = $rows['classId'];
            $_SESSION['classArmId'] = $rows['classArmId'];

            echo "<script type = \"text/javascript\">
            window.location = (\"Student/index.php\")
            </script>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>
            Invalid Username/Password!
            </div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>
        Invalid Username/Password!
        </div>";
    }
}
?>


                                <!-- <hr>
                <a href="index.html" class="btn btn-google btn-block">
                  <i class="fab fa-google fa-fw"></i> Login with Google
                </a>
                <a href="index.html" class="btn btn-facebook btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                </a> -->


                                <div class="text-center">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Login Content -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>
</body>

</html>
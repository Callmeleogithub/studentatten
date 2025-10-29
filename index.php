<?php
session_start();
// Redirect logged-in users to index.php
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    header("Location: /studentatten/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome to SAMS - Student Attendance Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #C33764 0%, #1D2671 100%);
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            scroll-behavior: smooth;
            font-family: 'Segoe UI', sans-serif;
        }

        .hero {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 60px 20px;
        }

        .hero h1 {
            font-weight: 700;
            font-size: 3.5rem;
            margin-bottom: 20px;
            color: #fff;
            text-shadow: 2px 2px 6px rgba(0,0,0,0.6);
            line-height: 1.3;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 40px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.4);
            line-height: 1.6;
        }

        .btn-primary {
            background: linear-gradient(90deg, #C33764, #1D2671);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: 0 5px 15px rgba(195,55,100,.6);
            transition: background 0.3s ease, transform 0.2s;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background: linear-gradient(90deg, #1D2671, #C33764);
            transform: translateY(-2px);
            outline: none;
        }

        .features {
            background: #fff;
            color: #222;
            padding: 60px 15px;
            text-align: center;
        }

        .features h2 {
            margin-bottom: 50px;
            font-weight: 700;
            background: linear-gradient(90deg, #C33764, #1D2671);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: none;
        }

        .feature-item {
            margin-bottom: 40px;
        }

        .feature-icon {
            font-size: 50px;
            margin-bottom: 15px;
            background: linear-gradient(90deg, #C33764, #1D2671);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .feature-item h4 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #1D2671;
        }

        .feature-item p {
            font-size: 1rem;
            line-height: 1.6;
            color: #444;
        }

        footer {
            padding: 15px;
            text-align: center;
            background: #1D2671;
            color: #ccc;
            font-size: 0.95rem;
        }

        @media (max-width: 576px) {
            .hero h1 {
                font-size: 2.4rem;
            }
            .hero p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <main class="hero">
        <div>
            <h1>Student Attendance Management System</h1>
            <p>Effortlessly manage student attendance, track progress, and generate insightful reports with SAMS — your reliable attendance companion.</p>
            <a href="./landlogin.php" class="btn btn-primary mr-3" role="button" aria-label="Login to Student Attendance System">Login</a>
            <a href="./landsignup.php" class="btn btn-primary mr-3" role="button" aria-label="Login to Student Attendance System">Signup</a>
        </div>
    </main>

    <section class="features">
        <h2>Why Choose SAMS?</h2>
        <div class="container">
            <div class="row">
                <article class="col-md-4 feature-item">
                    <div class="feature-icon"><i class="fas fa-user-graduate" aria-hidden="true"></i></div>
                    <h4>Student Management</h4>
                    <p>Easily add, update, and manage student records and information.</p>
                </article>
                <article class="col-md-4 feature-item">
                    <div class="feature-icon"><i class="fas fa-clipboard-check" aria-hidden="true"></i></div>
                    <h4>Attendance Marking</h4>
                    <p>Quickly mark daily attendance with a user-friendly interface.</p>
                </article>
                <article class="col-md-4 feature-item">
                    <div class="feature-icon"><i class="fas fa-chart-line" aria-hidden="true"></i></div>
                    <h4>Insightful Reports</h4>
                    <p>Generate detailed attendance reports and track student performance over time.</p>
                </article>
            </div>
        </div>
    </section>

    <footer>
        &copy; <?php echo date("Y"); ?> SAMS - All Rights Reserved
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>

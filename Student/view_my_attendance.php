<?php 
include '../Includes/dbcon.php'; 
include '../Includes/session.php';

$student_id = $_SESSION['userId'];

// Handle optional filters
$filterMonth = $_GET['month'] ?? '';
$filterYear = $_GET['year'] ?? '';

$query = "SELECT * FROM tblattendance WHERE studentId = '$student_id'";

if ($filterMonth && $filterYear) {
    $query .= " AND MONTH(dateTimeTaken) = '$filterMonth' AND YEAR(dateTimeTaken) = '$filterYear'";
}
$query .= " ORDER BY dateTimeTaken DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Attendance</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8fafc;
      font-family: 'Segoe UI', sans-serif;
    }
    .status-present {
      color: green;
      font-weight: bold;
    }
    .status-absent {
      color: red;
      font-weight: bold;
    }
  </style>
</head>
<body>
<?php include '../Includes/topbar.php'; ?>

<div class="container mt-4">
  <h3 class="text-center fw-bold text-primary mb-4">📅 Your Attendance Record</h3>

  <!-- Filter Form -->
  <form class="row g-3 mb-4" method="GET">
    <div class="col-md-4">
      <select class="form-select" name="month">
        <option value="">Select Month</option>
        <?php 
          for ($m = 1; $m <= 12; $m++) {
            $selected = ($m == $filterMonth) ? 'selected' : '';
            echo "<option value='$m' $selected>".date("F", mktime(0, 0, 0, $m, 10))."</option>";
          }
        ?>
      </select>
    </div>
    <div class="col-md-4">
      <select class="form-select" name="year">
        <option value="">Select Year</option>
        <?php
          $startYear = 2022;
          $currentYear = date('Y');
          for ($y = $startYear; $y <= $currentYear; $y++) {
            $selected = ($y == $filterYear) ? 'selected' : '';
            echo "<option value='$y' $selected>$y</option>";
          }
        ?>
      </select>
    </div>
    <div class="col-md-4">
      <button class="btn btn-primary w-100">Filter</button>
    </div>
  </form>

  <!-- Attendance Table -->
  <div class="table-responsive shadow-sm">
    <table class="table table-bordered table-striped">
      <thead class="table-primary">
        <tr>
          <th>Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
          <?php while($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><?php echo date("d M, Y", strtotime($row['dateTimeTaken'])); ?></td>
            <td>
              <?php
                if ($row['status'] == 1) {
                  echo "<span class='status-present'>Present ✅</span>";
                } else {
                  echo "<span class='status-absent'>Absent ❌</span>";
                }
              ?>
            </td>
          </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="2" class="text-center text-danger">No attendance records found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>

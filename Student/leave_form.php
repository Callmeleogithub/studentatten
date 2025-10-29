<?php 
include '../Includes/dbcon.php'; 
include '../Includes/session.php'; 

$studentId = $_SESSION['userId'];
$fullName = $_SESSION['fullName'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Apply for Leave</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .form-card {
      max-width: 700px;
      margin: 50px auto;
      background: #fff;
      border-radius: 0.5rem;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
  </style>
</head>
<body>

<div class="container">
  <div class="form-card p-4">
    <h4 class="mb-4 text-center text-primary">📝 Leave Application Form</h4>
    
    <form action="submit_leave.php" method="POST">
      <!-- Hidden student ID -->
      <input type="hidden" name="student_id" value="<?php echo (int)$studentId; ?>">

      <!-- Student info -->
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Full Name</label>
          <input type="text" name="full_name" class="form-control" value="<?php echo $fullName; ?>" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" readonly>
        </div>
      </div>

      <!-- Leave Reason Dropdown -->
      <div class="mb-3">
        <label class="form-label">Leave Reason</label>
        <select name="leave_reason_id" class="form-select" id="reasonSelect" required>
          <option value="">-- Select Reason --</option>
          <?php
            $res = mysqli_query($conn, "SELECT * FROM leave_reasons");
            while ($row = mysqli_fetch_assoc($res)) {
              echo "<option value='{$row['id']}'>{$row['reason_name']}</option>";
            }
          ?>
          <option value="other">Other</option>
        </select>
      </div>

      <!-- If 'Other', show a text input -->
      <div class="mb-3" id="otherReasonDiv" style="display: none;">
        <label class="form-label">Specify Other Reason</label>
        <input type="text" class="form-control" name="other_reason" placeholder="Describe your reason">
      </div>

      <!-- From and To Dates -->
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">From Date</label>
          <input type="date" name="from_date" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">To Date</label>
          <input type="date" name="to_date" class="form-control" required>
        </div>
      </div>

      <!-- Additional Reason -->
      <div class="mb-4">
        <label class="form-label">Additional Description</label>
        <textarea name="reason_detail" class="form-control" rows="3" placeholder="Optional..."></textarea>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="btn btn-primary w-100">Submit Application</button>
    </form>
  </div>
</div>

<script>
  // Show/hide "Other reason" input field
  document.getElementById('reasonSelect').addEventListener('change', function() {
    const otherDiv = document.getElementById('otherReasonDiv');
    if (this.value === 'other') {
      otherDiv.style.display = 'block';
    } else {
      otherDiv.style.display = 'none';
    }
  });
</script>

</body>
</html>

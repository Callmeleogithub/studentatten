<?php
include '../Includes/dbcon.php';
include '../Includes/session.php';

// Optional: Process approve/reject actions (via GET params)
if (isset($_GET['action'], $_GET['leave_id'])) {
    $action = $_GET['action'];
    $leave_id = (int)$_GET['leave_id'];

    if (in_array($action, ['approve', 'reject'])) {
        $new_status = $action === 'approve' ? 'Approved' : 'Rejected';
        $stmt = $conn->prepare("UPDATE leave_applications SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $new_status, $leave_id);
        $stmt->execute();
        $stmt->close();
        header("Location: admin_leave_management.php");
        exit;
    }
}

// Filter leaves by status (optional)
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';

$sql = "SELECT l.*, r.reason_name FROM leave_applications l 
        LEFT JOIN leave_reasons r ON l.leave_reason_id = r.id ";

if ($status_filter && in_array($status_filter, ['Pending', 'Approved', 'Rejected'])) {
    $sql .= " WHERE l.status = '" . $conn->real_escape_string($status_filter) . "'";
}

$sql .= " ORDER BY l.created_at DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Admin - Leave Management</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

<div class="container my-5">
  <h2 class="mb-4">Leave Applications Management</h2>

  <div class="mb-3">
    <form method="GET" class="d-flex gap-2 align-items-center">
      <label for="status" class="form-label mb-0 fw-semibold">Filter by Status:</label>
      <select name="status" id="status" class="form-select w-auto" onchange="this.form.submit()">
        <option value="">All</option>
        <option value="Pending" <?= $status_filter=='Pending' ? 'selected' : '' ?>>Pending</option>
        <option value="Approved" <?= $status_filter=='Approved' ? 'selected' : '' ?>>Approved</option>
        <option value="Rejected" <?= $status_filter=='Rejected' ? 'selected' : '' ?>>Rejected</option>
      </select>
      <noscript><button type="submit" class="btn btn-primary">Filter</button></noscript>
    </form>
  </div>

  <table class="table table-bordered table-hover shadow-sm bg-white">
    <thead class="table-primary">
      <tr>
        <th>Student Name</th>
        <th>Email</th>
        <th>Reason</th>
        <th>Other Reason</th>
        <th>From</th>
        <th>To</th>
        <th>Details</th>
        <th>Status</th>
        <th>Applied On</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <?php
            $badgeClass = 'secondary';
            if ($row['status'] === 'Approved') $badgeClass = 'success';
            elseif ($row['status'] === 'Rejected') $badgeClass = 'danger';
            elseif ($row['status'] === 'Pending') $badgeClass = 'warning';
          ?>
          <tr>
            <td><?= htmlspecialchars($row['full_name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['reason_name'] ?: '-') ?></td>
            <td><?= htmlspecialchars($row['other_reason'] ?: '-') ?></td>
            <td><?= htmlspecialchars($row['from_date']) ?></td>
            <td><?= htmlspecialchars($row['to_date']) ?></td>
            <td><?= htmlspecialchars($row['reason_detail']) ?></td>
            <td><span class="badge bg-<?= $badgeClass ?>"><?= $row['status'] ?></span></td>
            <td><?= date('Y-m-d', strtotime($row['created_at'])) ?></td>
            <td>
              <?php if ($row['status'] === 'Pending'): ?>
                <a href="?action=approve&leave_id=<?= $row['id'] ?>" class="btn btn-success btn-sm mb-1" onclick="return confirm('Approve this leave?')">Approve</a>
                <a href="?action=reject&leave_id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Reject this leave?')">Reject</a>
              <?php else: ?>
                <em>No actions</em>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="10" class="text-center">No leave applications found.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

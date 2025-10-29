<?php
include '../Includes/dbcon.php';
include '../Includes/session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = (int)$_POST['student_id'];
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $leave_reason_id = $_POST['leave_reason_id'];
    $other_reason = isset($_POST['other_reason']) ? mysqli_real_escape_string($conn, trim($_POST['other_reason'])) : '';
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $reason_detail = isset($_POST['reason_detail']) ? mysqli_real_escape_string($conn, trim($_POST['reason_detail'])) : '';

    // Validate dates
    if (empty($from_date) || empty($to_date) || strtotime($to_date) < strtotime($from_date)) {
        echo "<script>alert('Invalid date range. Please select correct From and To dates.'); window.history.back();</script>";
        exit;
    }

    // If 'Other' reason is selected, insert a placeholder id like NULL or 0 and store text in other_reason column
    if ($leave_reason_id === 'other') {
        $leave_reason_id = NULL; // or 0 if you prefer
        if (empty($other_reason)) {
            echo "<script>alert('Please specify your reason for leave.'); window.history.back();</script>";
            exit;
        }
    } else {
        $other_reason = NULL; // no other reason text if predefined reason chosen
    }

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO leave_applications 
        (student_id, full_name, email, leave_reason_id, other_reason, from_date, to_date, reason_detail) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ississss", $student_id, $full_name, $email, $leave_reason_id, $other_reason, $from_date, $to_date, $reason_detail);

    if ($stmt->execute()) {
        echo "<script>alert('Leave application submitted successfully.'); window.location.href='leave_form.php';</script>";
    } else {
        echo "<script>alert('Error submitting leave. Please try again.'); window.history.back();</script>";
    }

    $stmt->close();
} else {
    // Not POST method
    header("Location: leave_form.php");
    exit;
}
?>

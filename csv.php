<?php
require 'inc/db.php'; // Adjust path if needed

// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get the ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Prepare the SQL query to fetch the weather observation record
$sql = "SELECT * FROM weather_observation WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
// Fetch the record
$record = $stmt->fetch(PDO::FETCH_ASSOC);

if ($record) {
    // Fetch the observer's name
    $user_id = $record['user_id']; // Adjust this field based on your schema
    $sql1 = "SELECT * FROM users WHERE id = :user_id";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt1->execute();
    $record1 = $stmt1->fetch(PDO::FETCH_ASSOC);
    $observer_name = $record1['first_name']." ".$record1['lat_name'];

    // Format observation time to AM/PM
    $observation_time = new DateTime($record['time_of_observation']);
    $formatted_time = $observation_time->format('g:i A'); // AM/PM format

    // Create CSV file
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=record_' . $id . '.csv');

    $output = fopen('php://output', 'w');

    // Add CSV header
    fputcsv($output, array_merge(array_keys($record), ['Observer Name', 'Formatted Observation Time']));

    // Add record data with observer name and formatted time
    fputcsv($output, array_merge(array_values($record), [$observer_name, $formatted_time]));

    fclose($output);
    exit();
} else {
    echo "Record not found.";
}
?>

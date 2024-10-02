<?php
require 'inc/db.php'; // Adjust path if needed

// Get the ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Prepare the SQL query
$sql = "SELECT * FROM meteorological_data WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
// Fetch the record
$record = $stmt->fetch(PDO::FETCH_ASSOC);

if ($record) {
    // Create CSV file
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=metereological_data_' . $id . '.csv');

    $output = fopen('php://output', 'w');

    // Add CSV header
    fputcsv($output, array_keys($record));

    // Add record data
    fputcsv($output, $record);

    fclose($output);
    exit();
} else {
    echo "Record not found.";
}
?>

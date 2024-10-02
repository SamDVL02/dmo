<?php
require 'vendor/autoload.php'; // Ensure TCPDF is properly autoloaded
require 'inc/db.php'; // Ensure database connection is included



// Get the ID from the URL and validate it
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    try {
        // Prepare the SQL query to fetch the specific row based on the ID
        $sql = "SELECT * FROM taf_data WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the row data
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Create new PDF document
            $pdf = new TCPDF();
            $pdf->AddPage();
            $pdf->SetFont('helvetica', '', 10);

            // Set title
            $pdf->Cell(0, 10, 'TAF Data Report', 0, 1, 'C');
            $pdf->Ln(10); // Add a line break

            // Set table header
            $pdf->SetFillColor(200, 220, 255); // Set header background color
            $pdf->Cell(30, 10, 'Field', 1, 0, 'C', true);
            $pdf->Cell(0, 10, 'Value', 1, 1, 'C', true);

            // Add data rows
            $pdf->SetFillColor(255, 255, 255); // Set row background color
            foreach ($row as $field => $value) {
                $pdf->Cell(30, 10, htmlspecialchars($field), 1, 0, 'L', true);
                $pdf->Cell(0, 10, htmlspecialchars($value), 1, 1, 'L', true);
            }

            // Output the PDF
            $pdf->Output('TAF_Data_' . $id . '.pdf', 'D');
            exit();
        } else {
            echo "Record not found.";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
} else {
    echo "Invalid ID.";
}
?>

<?php
require 'inc/db.php'; // Adjust path if needed
require 'vendor/autoload.php'; // Adjust path if needed



// Get the ID from the URL and validate it
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    try {
        // Prepare the SQL query
        $sql = "SELECT * FROM speci WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the record
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($record) {
            // Create new PDF document
            $pdf = new TCPDF();
            $pdf->AddPage();
            $pdf->SetFont('helvetica', '', 12);

            // Set title
            $pdf->Cell(0, 10, 'SPECIFIC REPORT', 0, 1, 'C');
            $pdf->Ln(10); // Add a line break

            // Define table headers
            $headers = ['', '', ''];

            // Set table header
            $pdf->SetFillColor(200, 220, 255); // Set header background color
            $pdf->Cell(60, 10, $headers[0], 1, 0, 'C', true);
            $pdf->Cell(60, 10, $headers[1], 1, 0, 'C', true);
            $pdf->Cell(60, 10, $headers[2], 1, 1, 'C', true);

            // Add record details into the table
            $count = 0;
            $cols = [];
            foreach ($record as $key => $value) {
                $cols[$count % 3][] = ucfirst($key) . ': ' . $value;
                $count++;
            }

            // Fill in the rows
            $pdf->SetFillColor(255, 255, 255); // Set row background color
            foreach ($cols as $row) {
                $pdf->Cell(60, 10, isset($row[0]) ? $row[0] : '', 1, 0, 'L', true);
                $pdf->Cell(60, 10, isset($row[1]) ? $row[1] : '', 1, 0, 'L', true);
                $pdf->Cell(60, 10, isset($row[2]) ? $row[2] : '', 1, 1, 'L', true);
            }

            // Output the PDF
            $pdf->Output('record_' . $id . '.pdf', 'D');
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
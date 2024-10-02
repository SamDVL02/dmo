<?php
require 'inc/db.php'; // Adjust path if needed
require 'vendor/autoload.php'; // Adjust path if needed


// Get the ID from the URL and validate it
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    try {
        // Prepare the SQL query
        $sql = "SELECT * FROM meteorological_data WHERE id = :id"; // Adjust the column name if needed
        $stmt = $conn->prepare($sql);

        // Bind the station parameter
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Assuming `station` is an integer
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Create new PDF document
            $pdf = new TCPDF();
            $pdf->AddPage();
            $pdf->SetFont('helvetica', '', 10);

            // Set title
            $pdf->Cell(0, 10, 'METAR Data Report for Station ID: ' . htmlspecialchars($id), 0, 1, 'C');
            $pdf->Ln(10); // Add a line break

            // Set table header
            $pdf->SetFillColor(200, 220, 255); // Set header background color
            $pdf->Cell(10, 10, 'ID', 1, 0, 'C', true);
            $pdf->Cell(30, 10, 'Longitude', 1, 0, 'C', true);
            $pdf->Cell(30, 10, 'Latitude', 1, 0, 'C', true);
            $pdf->Cell(20, 10, 'Month', 1, 0, 'C', true);
            $pdf->Cell(20, 10, 'Date', 1, 0, 'C', true);
            $pdf->Cell(20, 10, 'Time Obs', 1, 0, 'C', true);
            $pdf->Cell(25, 10, 'Barometer', 1, 0, 'C', true);
            $pdf->Cell(25, 10, 'Pressure', 1, 0, 'C', true);
            $pdf->Cell(25, 10, 'Thermo Temp', 1, 0, 'C', true);
            $pdf->Cell(25, 10, 'TWB', 1, 0, 'C', true);
            $pdf->Cell(25, 10, 'Visibility', 1, 0, 'C', true);
            $pdf->Cell(25, 10, 'Wind Speed', 1, 0, 'C', true);
            $pdf->Cell(25, 10, 'Cloud Amount', 1, 0, 'C', true);
            $pdf->Cell(25, 10, 'Wind Direction', 1, 1, 'C', true);

            // Add data rows
            $pdf->SetFillColor(255, 255, 255); // Set row background color
            $idCounter = 0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $idCounter++;
                $pdf->Cell(10, 10, $idCounter, 1, 0, 'C', true);
                $pdf->Cell(30, 10, htmlspecialchars($row['longitude']), 1, 0, 'L', true);
                $pdf->Cell(30, 10, htmlspecialchars($row['latitude']), 1, 0, 'L', true);
                $pdf->Cell(20, 10, htmlspecialchars($row['month']), 1, 0, 'L', true);
                $pdf->Cell(20, 10, htmlspecialchars($row['date']), 1, 0, 'L', true);
                $pdf->Cell(20, 10, htmlspecialchars($row['time_obs']), 1, 0, 'L', true);
                $pdf->Cell(25, 10, htmlspecialchars($row['barometer']), 1, 0, 'L', true);
                $pdf->Cell(25, 10, htmlspecialchars($row['pressure']), 1, 0, 'L', true);
                $pdf->Cell(25, 10, htmlspecialchars($row['thermo_temp']), 1, 0, 'L', true);
                $pdf->Cell(25, 10, htmlspecialchars($row['twb']), 1, 0, 'L', true);
                $pdf->Cell(25, 10, htmlspecialchars($row['visibility']), 1, 0, 'L', true);
                $pdf->Cell(25, 10, htmlspecialchars($row['wind_speed']), 1, 0, 'L', true);
                $pdf->Cell(25, 10, htmlspecialchars($row['cloud_amount']), 1, 0, 'L', true);
                $pdf->Cell(25, 10, htmlspecialchars($row['wind_direction']), 1, 1, 'L', true);
            }

            // Output the PDF
            $pdf->Output('METAR_Data_' . date('Ymd') . '.pdf', 'D');
            exit();
        } else {
            echo "No records found for the specified station.";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
} else {
    echo "Invalid ID.";
}
?>

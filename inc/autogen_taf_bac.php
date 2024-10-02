<?php
require_once "session.php";
require_once "db.php";
require_once "function.php";
require_once '../vendor/autoload.php'; // Ensure this path is correct

// use FPDF\FPDF;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $taf_type = $_POST['taf_type'] ?? '';
    $taf_date = $_POST['taf_date'] ?? '';
    $month = $_POST['month'] ?? '';
    $year = $_POST['year'] ?? '';
    $taf_time = $_POST['taf_time'] ?? '';
    $taf_services = $_POST['taf_services'] ?? '';
    $taf_validity_begin_date = $_POST['taf_validity_begin_date'] ?? '';
    $taf_validity_begin_time = $_POST['taf_validity_begin_time'] ?? '';
    $taf_validity_end_date = $_POST['taf_validity_end_date'] ?? '';
    $taf_validity_end_time = $_POST['taf_validity_end_time'] ?? '';
    $taf_cancellation = $_POST['taf_cancellation'] ?? '';
    $wind_direction = $_POST['wind_direction'] ?? '';
    $wind_speed_2 = $_POST['wind_speed_2'] ?? '';
    $wind_speed_1 = $_POST['wind_speed_1'] ?? '';
    $visibility = $_POST['visibility'] ?? '';
    $weather_descriptor = $_POST['weather_descriptor'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $weather_phenomenon = $_POST['weather_phenomenon'] ?? '';
    $weather_intensity = $_POST['weather_intensity'] ?? '';
    $cloud_layer_amount_1 = $_POST['cloud_layer_amount_1'] ?? '';
    $cloud_layer_type_1 = $_POST['cloud_layer_type_1'] ?? '';
    $cloud_height_1 = $_POST['cloud_height_1'] ?? '';
    $cloud_layer_amount_3 = $_POST['cloud_layer_amount_3'] ?? '';
    $cloud_layer_type_2 = $_POST['cloud_layer_type_2'] ?? '';
    $cloud_height_2 = $_POST['cloud_height_2'] ?? '';
    $cloud_layer_amount_4 = $_POST['cloud_layer_amount_4'] ?? '';
    $cloud_height_4 = $_POST['cloud_height_4'] ?? '';
    $cavok = $_POST['cavok'] ?? '';
    $station = $_SESSION['station'] ?? ''; // Retrieve station from session

    // SQL insert statement
    $sql = "INSERT INTO taf_data (
        taf_type,
        taf_date,
        month,
        year,
        taf_time,
        taf_services,
        taf_validity_begin_date,
        taf_validity_begin_time,
        taf_validity_end_date,
        taf_validity_end_time,
        taf_cancellation,
        wind_direction,
        wind_speed_2,
        wind_speed_1,
        visibility,
        weather_descriptor,
        subject,
        weather_phenomenon,
        weather_intensity,
        cloud_layer_amount_1,
        cloud_layer_type_1,
        cloud_height_1,
        cloud_layer_amount_3,
        cloud_layer_type_2,
        cloud_height_2,
        cloud_layer_amount_4,
        cloud_height_4,
        cavok,
        station
    ) VALUES (
        :taf_type,
        :taf_date,
        :month,
        :year,
        :taf_time,
        :taf_services,
        :taf_validity_begin_date,
        :taf_validity_begin_time,
        :taf_validity_end_date,
        :taf_validity_end_time,
        :taf_cancellation,
        :wind_direction,
        :wind_speed_2,
        :wind_speed_1,
        :visibility,
        :weather_descriptor,
        :subject,
        :weather_phenomenon,
        :weather_intensity,
        :cloud_layer_amount_1,
        :cloud_layer_type_1,
        :cloud_height_1,
        :cloud_layer_amount_3,
        :cloud_layer_type_2,
        :cloud_height_2,
        :cloud_layer_amount_4,
        :cloud_height_4,
        :cavok,
        :station
    )";

    try {
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            throw new Exception('Failed to prepare SQL statement: ' . implode(' ', $conn->errorInfo()));
        }

        // Bind parameters
        $stmt->bindParam(':taf_type', $taf_type);
        $stmt->bindParam(':taf_date', $taf_date);
        $stmt->bindParam(':month', $month);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':taf_time', $taf_time);
        $stmt->bindParam(':taf_services', $taf_services);
        $stmt->bindParam(':taf_validity_begin_date', $taf_validity_begin_date);
        $stmt->bindParam(':taf_validity_begin_time', $taf_validity_begin_time);
        $stmt->bindParam(':taf_validity_end_date', $taf_validity_end_date);
        $stmt->bindParam(':taf_validity_end_time', $taf_validity_end_time);
        $stmt->bindParam(':taf_cancellation', $taf_cancellation);
        $stmt->bindParam(':wind_direction', $wind_direction);
        $stmt->bindParam(':wind_speed_2', $wind_speed_2);
        $stmt->bindParam(':wind_speed_1', $wind_speed_1);
        $stmt->bindParam(':visibility', $visibility);
        $stmt->bindParam(':weather_descriptor', $weather_descriptor);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':weather_phenomenon', $weather_phenomenon);
        $stmt->bindParam(':weather_intensity', $weather_intensity);
        $stmt->bindParam(':cloud_layer_amount_1', $cloud_layer_amount_1);
        $stmt->bindParam(':cloud_layer_type_1', $cloud_layer_type_1);
        $stmt->bindParam(':cloud_height_1', $cloud_height_1);
        $stmt->bindParam(':cloud_layer_amount_3', $cloud_layer_amount_3);
        $stmt->bindParam(':cloud_layer_type_2', $cloud_layer_type_2);
        $stmt->bindParam(':cloud_height_2', $cloud_height_2);
        $stmt->bindParam(':cloud_layer_amount_4', $cloud_layer_amount_4);
        $stmt->bindParam(':cloud_height_4', $cloud_height_4);
        $stmt->bindParam(':cavok', $cavok);
        $stmt->bindParam(':station', $station);

        // Execute the statement
        $result = $stmt->execute();
        if ($result) {
            $_SESSION["SuccessMessage"] = "TAF data added successfully";

            // Generate PDF
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Times', 'B', 16);
            $pdf->Cell(0, 10, 'TAF Report', 0, 1, 'C');

            $pdf->SetFont('Arial', '', 12);

            // Header
            $pdf->SetFillColor(0, 0, 255); // Blue background
            $pdf->SetTextColor(255, 255, 255); // White text
            $pdf->Cell(90, 10, 'Parameter', 1, 0, 'C', true);
            $pdf->Cell(100, 10, 'Value', 1, 1, 'C', true);

            // Reset text color
            $pdf->SetTextColor(0, 0, 0);

            // Data rows
            $data = [
                'TAF Type' => $taf_type,
                'TAF Date' => $taf_date,
                'Month' => $month,
                'Year' => $year,
                'TAF Time' => $taf_time,
                'TAF Services' => $taf_services,
                'Validity Begin Date' => $taf_validity_begin_date,
                'Validity Begin Time' => $taf_validity_begin_time,
                'Validity End Date' => $taf_validity_end_date,
                'Validity End Time' => $taf_validity_end_time,
                'TAF Cancellation' => $taf_cancellation,
                'Wind Direction' => $wind_direction,
                'Wind Speed (2 digits)' => $wind_speed_2,
                'Wind Speed (1 digit)' => $wind_speed_1,
                'Visibility' => $visibility,
                'Weather Descriptor' => $weather_descriptor,
                'Subject' => $subject,
                'Weather Phenomenon' => $weather_phenomenon,
                'Weather Intensity' => $weather_intensity,
                'First Cloud Layer Amount' => $cloud_layer_amount_1,
                'First Cloud Layer Type' => $cloud_layer_type_1,
                'First Cloud Layer Height' => $cloud_height_1,
                'Third Cloud Layer Amount' => $cloud_layer_amount_3,
                'Second Cloud Layer Height' => $cloud_height_2,
                'Fourth Cloud Layer Amount' => $cloud_layer_amount_4,
                'Fourth Cloud Layer Height' => $cloud_height_4,
                'CAVOK' => $cavok,
                'Station' => $station
            ];

            foreach ($data as $key => $value) {
                $pdf->Cell(90, 10, $key, 1);
                $pdf->Cell(100, 10, $value, 1, 1);
            }

            // Save the PDF file
            $pdfFileName = 'taf_report_' . date('YmdHis') . '.pdf'; // Example filename
            $pdfFilePath = '../taf_report/' . $pdfFileName; // Path to save the PDF
            if (!file_exists('../taf_report')) {
                mkdir('../taf_report', 0755, true); // Create directory if not exists
            }
            $pdf->Output('F', $pdfFilePath); // Save to file

            // Provide download link
            $_SESSION["SuccessMessage"] = "TAF data added successfully. <a href='pdfs/$pdfFileName' target='_blank'>Download PDF</a>";
            header('Location: ../view_taf.php');
            exit();
        } else {
            echo "<div class='alert alert-danger'>Oops! Something went wrong.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}
?>

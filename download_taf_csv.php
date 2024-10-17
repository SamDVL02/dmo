<?php
include 'inc/db.php';

if (isset($_GET['filter'])) 
{
    $filter = $_GET['filter'];

    if ($filter == 'daily')
    {
        $sql = "SELECT * FROM taf_data WHERE DATE(created_at) = CURDATE()";
    } 
    elseif ($filter == 'weekly') 
    {
        $sql = "SELECT * FROM taf_data WHERE WEEK(created_at) = WEEK(CURDATE())";
    } 
    elseif ($filter == 'monthly') 
    {
        $sql = "SELECT * FROM taf_data WHERE MONTH(created_at) = MONTH(CURDATE())";
    }
    $filename = "taf_report_" . date("Y-m-d_H-i-s") . ".csv";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $metarData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $output = fopen('php://output', 'w');

    fputcsv($output, array(
        'TAF Type', 'Date', 'Time Of Observation', 'Services', 'Validity Begin Date', 
        'Validity begin Time', 'Validity End Date', 'Validity End Time', 'TAF Cancellation',
        'Wind Direction', 'Wind Speed Two', 'Wind Speed One','Visibility', 'Weather Descriptor', 'Subject', 
        'Weather Phenomenon', 'Weather Intensity', 'Cloud Layer Amount One',
        'Cloud Layer Type One', 'Cloud Height One', 'Cloud Layer Amount Three', 'Cloud Layer Type Two', 'Cloud height Two', 'Cloud Layer Amount Four',
        'Cloud Height Four', 'CAVOK'
    ));
    
    if (count($metarData) > 0) 
    {
        foreach ($metarData as $row) 
        {
            fputcsv($output, array(
               $row['taf_type'], $row['taf_date'], $row['taf_time'], $row['taf_services'], $row['taf_validity_begin_date'],
               $row['taf_validity_begin_time'], $row['taf_validity_end_date'], $row['taf_validity_end_time'], $row['taf_cancellation'],
               $row['wind_direction'], $row['wind_speed_2'], $row['wind_speed_1'],
               $row['visibility'], $row['weather_descriptor'], $row['subject'], $row['weather_phenomenon'],
               $row['weather_intensity'], $row['cloud_layer_amount_1'], $row['cloud_layer_type_1'], $row['cloud_height_1'],
               $row['cloud_layer_amount_3'], $row['cloud_layer_type_2'], $row['cloud_height_2'],
               $row['cloud_layer_amount_4'], $row['cloud_height_4'], $row['cavok'], 
            ));
        }
    } 
    else 
    {
        fputcsv($output, array("No data available for the selected filter."));
    }
    fclose($output);
    exit;

} 
else 
{
    echo "Invalid filter!";
}
?>

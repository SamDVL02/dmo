<?php
include 'inc/db.php';

if (isset($_GET['filter'])) 
{
    $filter = $_GET['filter'];

    if ($filter == 'daily')
    {
        $sql = "SELECT * FROM speci WHERE DATE(created_at) = CURDATE()";
    } 
    elseif ($filter == 'weekly') 
    {
        $sql = "SELECT * FROM speci WHERE WEEK(created_at) = WEEK(CURDATE())";
    } 
    elseif ($filter == 'monthly') 
    {
        $sql = "SELECT * FROM speci WHERE MONTH(created_at) = MONTH(CURDATE())";
    }
    $filename = "speci_report_" . date("Y-m-d_H-i-s") . ".csv";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $metarData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $output = fopen('php://output', 'w');

    fputcsv($output, array(
        'Time of Observation', 'Wind Direction', 'Wind Speed', 'Visibility', 'Present Weather',
        'Total Sky Cloud Cover', 'First Significant Cloud Oktas', 'First Significant Cloud Height',
        'Second Significant Cloud Oktas', 'Second Significant Cloud height', 'Second Individual Cloud Layer Type',
        'Third Significant Cloud Oktas', 'Third Significant Cloud Height', 'Fourth Significant Cloud Oktas',
        'Fourth Significant Cloud Height', 'Dry Bulb Temperature', 'Dew Point Temperature', 'QNH_H', 'QNH_w', 'CLP', 'Wet Bulb Temeprature', 'Trend', 'Remarks'
    ));
    
    if (count($metarData) > 0) 
    {
        foreach ($metarData as $row) 
        {
            fputcsv($output, array(
                $row['time_of_observation'], $row['wind_direction'],  $row['wind_speed'],  $row['visibility'],  $row['present_weather'],
                $row['total_sky_cloud_cover'],  $row['first_significant_cloud_oktas'],  $row['first_significant_cloud_height'],  $row['second_significant_cloud_oktas'],
                $row['second_significant_cloud_height'],  $row['second_individual_cloud_layer_type'],  $row['third_significant_cloud_oktas'],  $row['third_significant_cloud_height'],
                $row['fourth_significant_cloud_oktas'],  $row['fourth_significant_cloud_height'],  $row['dry_bulb_temperature'],  $row['dew_point_temperature'],  $row['qnh_h'],  $row['qnh_w'],
                $row['clp'],  $row['wet_bulb_temperature'],  $row['trend'],  $row['remarks'],
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

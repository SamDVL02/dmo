<?php
include 'inc/db.php';

if (isset($_GET['filter'])) 
{
    $filter = $_GET['filter'];

    if ($filter == 'daily')
    {
        $sql = "SELECT * FROM synop WHERE DATE(created_at) = CURDATE()";
    } 
    elseif ($filter == 'weekly') 
    {
        $sql = "SELECT * FROM synop WHERE WEEK(created_at) = WEEK(CURDATE())";
    } 
    elseif ($filter == 'monthly') 
    {
        $sql = "SELECT * FROM synop WHERE MONTH(created_at) = MONTH(CURDATE())";
    }
    $filename = "synop_report_" . date("Y-m-d_H-i-s") . ".csv";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $metarData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $output = fopen('php://output', 'w');

    fputcsv($output, array(
        'Time of Observation', 'Wind Measuring Instruments', 'Indicator for Precipitation Date',
        'Station Operation Weather', 'Height Lowest Cloud base', 'Visibility', 'Precipitation Duration', 'Preset Weather',
        'Past Weather One', 'Past Weather Two', 'Low Level Cloud Type', 'Medium level Cloud Type', 'High Level Cloud Type', 'Grass Temperature', 'Character Intensity of Precipitation', 'Hours from Precipitation to Observation',
        'Precipitation Amount', 'Type of Instruments for Evaporation measurement', 'Sunshine Card Segments', 'Cups Added Removed', 'First Lowest Cloud Layer Base Height', 'Second Lowest Cloud Layer Type',
        'Second Lowest Cloud Layer Base Height', 'Third Lowest Cloud Layer Type', 'Third Lowest Cloud layer Base Height', 'Fourth Lowest Cloud Layer Type', 'Fourth Lowest Cloud Layer Base Height', 'Wind Direction', 'Wind Speed'
    ));
    
    if (count($metarData) > 0) 
    { 
        foreach ($metarData as $row) 
        {
            fputcsv($output, array(
                $row['time_of_observation'], $row['wind_measuring_instruments'], $row['indicator_for_precipitation_data'], $row['station_operation_weather'], $row['height_of_lowest_cloud_base'],
                $row['visibility'], $row['precipitation_duration'], $row['present_weather'], $row['past_weather_1'], $row['past_weather_2'], $row['low_level_cloud_type'], $row['medium_level_cloud_type'],
                $row['high_level_cloud_type'], $row['grass_temperature'], $row['character_intensity_of_precipitation'], $row['hours_from_precipitation_to_observation'], $row['precipitation_amount'],
                $row['type_of_instrument_for_evaporation_measurement'], $row['sunshine_card_segments'], $row['cups_added_removed'], $row['first_lowest_cloud_layer_type'],
                $row['first_lowest_cloud_layer_base_height'], $row['second_lowest_cloud_layer_type'],
                $row['second_lowest_cloud_layer_base_height'], $row['third_lowest_cloud_layer_type'], $row['third_lowest_cloud_layer_base_height'], $row['fourth_lowest_cloud_layer_type'],
                $row['fourth_lowest_cloud_layer_base_height'], $row['wind_direction'], $row['wind_speed'],
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

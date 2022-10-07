<?php

$servername = "localhost";
// REPLACE with your Database name
$dbname = "belajariot";
// REPLACE with Database user
$username = "root";
// REPLACE with Database user password
$password = "";


$conn = new mysqli($servername, $username, $password, $dbname);


// chek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, soil, timestamp FROM iot ORDER BY timestamp DESC";
$result = $conn->query($sql);
while ($data = $result->fetch_assoc()) {
    $iot[] = $data;
}

$timestamps = array_column($iot, 'timestamp');
$soil = json_encode(array_reverse(array_column($iot, 'soil')), JSON_NUMERIC_CHECK);

$timestamp = json_encode(array_reverse($timestamps), JSON_NUMERIC_CHECK);
$result->free();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="refresh" content="10">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <title>Chart Data</title>


    <style>
        body {
            min-width: 310px;
            max-width: 1280px;
            height: 500px;
            margin: 0 auto;
        }

        h2 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 2.5rem;
            text-align: center;
        }
    </style>
</head>

<body>

    <h2>ESP Chart Data</h2>
    <div id="chart-waterLevel" class="container"></div>

    <script>
        var soil = <?php echo $soil; ?>;
        var timestamp = <?php echo $timestamp; ?>;
        var chartH = new Highcharts.Chart({
            chart: {
                renderTo: 'chart-waterLevel'
            },
            title: {
                text: 'Level Percentage'
            },
            series: [{
                showInLegend: false,
                data: soil
            }],
            plotOptions: {
                line: {
                    animation: false,
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            xAxis: {
                type: 'datetime',
                categories: timestamp
            },
            yAxis: {
                title: {
                    text: ' Level (%)'
                }
            },
            credits: {
                enabled: false
            }
        })
    </script>

</body>

</html>
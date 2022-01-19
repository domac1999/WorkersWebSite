<?php

include "../../includes/db.php";
include "functions.php";
session_start(); // start session

// do check
if (isset($_SESSION["user_role"])) {
    if ($_SESSION["user_role"] == "Standard") {
        header("location: ../index.php");
        exit; // prevent further execution, should there be more code that follows
    }
} else {
    header("location: ../index.php");
    exit; // prevent further execution, should there be more code that follows
}

?>



<?php

// Output buffering - used for buffering our request in the header,sending everything at the same time,atm php is sending requests one by one  ---- used for function header()
ob_start();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>HandyMan ADMIN</title>
        <link href="css/styles.css" rel="stylesheet" />
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
   
   <!-- izvješća -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar', 'corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['', 'Ukupno', 'Odobreni', 'Zabranjeni'],
                <?php

                $count_ads = countAds();
                echo "['Oglasi'," . $count_ads['all'] . "," . $count_ads['approved'] . "," . $count_ads['unapproved'] . "],";
                ?>

            ]);

            var options = {
                chart: {
                    title: 'Broj postavljenih oglasa',
                    subtitle: '',
                }
            };


            var data1 = google.visualization.arrayToDataTable([
                ['', 'Najviša cijena', 'Prosječna cijena', 'Najniža cijena'],
                <?php

                $count_ads = countAds();
                echo "['Oglasi',"  . $count_ads['ad_highest'] . "," . $count_ads['average_price'] . "," . $count_ads['ad_lowest'] . "],";
                ?>

            ]);

            var options1 = {
                chart: {
                    title: 'Cijene oglasa',
                    subtitle: '',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('barChart'));
            var chart1 = new google.charts.Bar(document.getElementById('bar1Chart'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
            chart1.draw(data1, google.charts.Bar.convertOptions(options1));
        }

    </script>
    
    </head>

    <body class="sb-nav-fixed">
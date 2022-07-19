<?php
include '../lib/session.php';
Session::checkSession();
?>
<?php include 'inc/header.php'; ?>

<?php

include '../classes/chart.php';
$chart = new Chart();
$res = $chart->chart_calculate();
$list = $res->fetch_array();

$dataPoints = array();
foreach ($res as $row) {
    $dataPoints[] = array(
        'y' => $row['total'],
        'label' => $row['month']
    );
}
?>

<script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: "Income Chart"
            },
            axisY: {
                title: "Revenue (in USD)",
                includeZero: true,
                prefix: "$"
            },
            data: [{
                type: "bar",
                yValueFormatString: "$#,##0",
                indexLabel: "{y}",
                indexLabelPlacement: "inside",
                indexLabelFontWeight: "bolder",
                indexLabelFontColor: "white",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }
</script>

<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<?php include 'inc/footer.php'; ?>
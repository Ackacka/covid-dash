<!DOCTYPE html>

<html>
    <head>
        <title>COVID Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/9c754b173e.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <script>
            window.onload = function () {

                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    exportEnabled: true,
                    theme: "light1", // "light1", "light2", "dark1", "dark2"
                    title: {
                        text: "<?php echo $chartTitle; ?>"
                    },
                    axisY: {
                        includeZero: true
                    },
                    axisX: {
                        title: "Dates",
                        valueFormatString: "DD-MMM"
                    },
                    data: [{
                            type: "line", //change type to bar, line, area, pie, etc
                            //indexLabel: "{y}", //Shows y value on all Data Points
                            indexLabelFontColor: "#5A5757",
                            indexLabelPlacement: "outside",
                            dataPoints: <?php echo $dataPoints; ?>
                        }]
                });
                chart.render();


            }
        </script>
    </head>
    

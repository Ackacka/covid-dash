<?php //  var_dump($chartTitle);  ?>
<!doctype html>
<html class="no-js" lang="en">

    <head>
        <?php include_once('dashboard_headPage.php'); ?>   
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/mystyle.css">
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

    <body>

        <nav class="navbar navbar-inverse visible-xs">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand mytitle" href="index.php?action=mainPage">SNMT-COVID</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="dashboard"><a href="index.php?action=mainPage" class="menu-icon"> <i class="menu-icon fa fa-dashboard"></i>Dashboard</a></li>        
                        <li class="dashboard">
                            <a href="index.php?action=logOut" class="menu-icon"> <i class="menu-icon fas fa-sign-out-alt"></i>Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>



        <div class="container-fluid">
            <div class="row content">
                <div class="col-sm-2 sidenav hidden-xs">
                    <h3 class="mytitle">SNMT-COVID</h3>
                    <ul class="nav nav-stacked">
                        <li class="dashboard"><a href="index.php?action=mainPage" class="menu-icon dashboardName"> <i class="menu-icon fa fa-dashboard"></i>Dashboard</a></li>
                    </ul><br>
                </div>
                <br>


                <div class="col-sm-10 mycontainer">        
                    <div class="well">
                        <h3><i class="menu-icon fa fa-dashboard"></i>Dashboard</h3>
                        <div class="user-area dropdown float-right show">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user user-avatar rounded-circle"></i>
                            </a>
                            <div class="user-menu dropdown-menu">
                                <?php if ($_SESSION['roleType'] == 2) { ?>
                                    <a class="nav-link" href="index.php?action=adminDash">
                                        <i class="fas fa-user-shield"></i> <?php echo htmlspecialchars(' Admin'); ?></a>
                                <?php } ?>
                                <?php if ($_SESSION["loginUser"] == "defaultUser") { ?>
                                    <a class="nav-link" href="index.php?action=loginPage">
                                        <i class="fas fa-sign-in-alt"></i> <?php echo htmlspecialchars(' Login'); ?></a>
                                <?php } else { ?>
                                    <a class="nav-link" href="index.php?action=logOut"><i class="fa fa-power-off"></i> Logout</a>
                                <?php } ?> 
                            </div>
                        </div> 
                    </div>

<!--                    <div class='secondcontainer content mt-3'>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><i class="ti-stats-up text-danger border-danger"></i></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text">Total Deaths</div>
                                            <div class="stat-digit count"><?php echo $dashInfo['death'] ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><i class="ti-stats-up text-success border-success"></i></div>
                                        <div class="stat-content dib">
                                            <div class="stat-text">Total Positive Cases</div>
                                            <div class="stat-digit count"><?php echo $dashInfo['positive'] ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                <div class="col-sm-12 caseschart">
                <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                        <form class="form-inline" action="index.php" method="post" enctype="multipart/form-data">
                            <input type='hidden' name='action' value='dashboard'>
                            <div class="form-group col-sm-12 pt-4" >
                            <label class="control-label col-sm-2 bystate"  for="state">Cases By State:</label>
                            <div class="col-sm-4" >
                                
                                <select name='states' class="form-control">
                                    <option id="state" selected="selected">Select A State</option>
                                    <?php
                                    // A sample product array
                                    $states = array("AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "ID", "IL", "IN", "IA",
                                        "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH",
                                        "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT",
                                        "VT", "VA", "WA", "WV", "WI", "WY");

                                    // Iterating through the product array
                                    foreach ($states as $state) {
                                        echo "<option value='$state'>$state</option>";
                                    }
                                    ?>
                                </select>
                                <span class="errorMsg error"> <?php echo htmlspecialchars($stateError) ?></span>
                                
                                <input type='submit' class='btn btn-secondary' value='Submit'></submit>
                            </div>
                            </div>
                        </form>
                        </div>
                    </div>
                
                    <div class="row justify-content-center ">
                        <div class="col-sm mt-5">
                            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
                </div>
                    </div>
                </div>

            </div>
        </div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<!--        <script src="vendors/js/widgets.js"></script>-->
    </body>
</html>

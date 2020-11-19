<?php //  var_dump($chartTitle);  ?>
<?php include_once 'views/header.php'; ?>
    <body>

        <div class="container-fluid">
            <div class="row content">
                <div class="col-lg-2 sidenav hidden-xs navbar-expand-lg navbar-dark">
                    <a class="mytitle navbar-brand" href="index.php?action=mainPage">SNMT-COVID</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavbar">
                        <ul class="nav nav-stacked navbar-nav">
                            <h3 class="menu-title">Dashboard</h3>
                            <li class="dashboard nav-item"><a href="index.php?action=dashboard" class="menu-icon dashboardName nav-link"> 
                                    <i class="menu-icon fa fa-dashboard"></i>Dashboard</a></li>
                            <h3 class="menu-title">Edit Users</h3><!-- /.menu-title -->
                            <li class="dashboard nav-item">
                                <a href="index.php?action=showUsers" class="menu-icon nav-link"> <i class="menu-icon ti-settings"></i>Users</a>
                            </li>
                            <h3 class="menu-title">Account</h3><!-- /.menu-title -->
                            <?php if ($_SESSION['roleType'] == 2) { ?>
                                <li class="dashboard nav-item">
                                    <a class="menu-icon nav-link" href="index.php?action=adminDash">
                                        <i class="menu-icon fas fa-user-shield"></i><?php echo htmlspecialchars('  Admin'); ?></a>
                                </li>            
                            <?php } ?>
                            <li class="dashboard nav-item">
                                <a href="index.php?action=logOut" class="menu-icon nav-link"> <i class="menu-icon fa fa-power-off"></i>Logout</a>
                            </li>
                        </ul><br>
                    </div>
                </div>
                <br>


              <div class="col-lg-10 mycontainer">
              <div class="well card">
                <div class="card-body">
                    <h3><i class="menu-icon fa fa-dashboard"></i>Dashboard</h3>
                </div>
              </div>

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
<?php include_once 'views/footer.php'; ?>

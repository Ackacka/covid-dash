<?php include_once('views/header.php'); ?>
<body>
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav hidden-xs navbar-expand-md navbar-dark">
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

            <div class="col-sm-10 mycontainer">
                <div class="well card">
                    <div class="card-body">
                        <h3><i class="menu-icon fa fa-dashboard"></i>Dashboard</h3>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Stripped Table</strong>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">City</th>
                                        <th scopt="col">State</th>
                                        <th scope="col">Zipcode</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user) : ?>                                            
                                        <tr>
                                            <th scope="row"><?php echo htmlspecialchars($user['userID']); ?></th>      
                                            <td><?php echo htmlspecialchars($user['firstName']); ?></td>               
                                            <td><?php echo htmlspecialchars($user['lastName']); ?></td>                 
                                            <td><?php echo htmlspecialchars($user['email']); ?></td>                   
                                            <td><?php echo htmlspecialchars($user['username']); ?></td>                
                                            <td><?php echo htmlspecialchars($user['city']); ?></td>                    
                                            <td><?php echo htmlspecialchars($user['state']); ?></td>                   
                                            <td><?php echo htmlspecialchars($user['zipcode']); ?></td>                 
                                            <td>
                                                <form method="POST" action="index.php?action=deleteUser">
                                                    <button class= "btn btn-danger" type="submit" name="userID" >Delete</button>
                                                </form>
                                            </td>                                                                           
                                        </tr>
                                    <?php endforeach; ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</div>
</body>
</html>

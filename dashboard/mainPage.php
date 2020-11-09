<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('dashboard_headPage.php'); ?>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark">
  <a class="navbar-brand" href="index.php?action=landing">SNMT-COVID</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mr-auto">

    </ul>
      
    <li  class="form-inline my-2 my-lg-0 navbar-nav nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php if ($_SESSION["loginUser"] == "defaultUser") {echo htmlspecialchars('Welcome!');} else { echo htmlspecialchars ('Hello ' .$_SESSION["loginUser"]);} ?>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown"> 
                       <?php if ($_SESSION['roleType'] == 2) { ?>
                        <a class="dropdown-item" href="index.php?action=adminDash">
                            <i class="fas fa-user-shield"></i> <?php echo htmlspecialchars(' Admin');?></a>
                       <?php } ?>
                        <?php if ($_SESSION["loginUser"] == "defaultUser") { ?>
                        <a class="dropdown-item" href="index.php?action=loginPage">
                            <i class="fas fa-sign-out-alt"></i> <?php echo htmlspecialchars(' Login');?></a>
                        <?php } else { ?>
                            <a class="dropdown-item" href="index.php?action=dashboard">
                            <i class="fa fa-dashboard"></i> <?php echo htmlspecialchars(' Dashboard');?></a> 
                            <a class="dropdown-item" href="index.php?action=logOut">
                                <i class="fas fa-sign-out-alt"></i> <?php echo htmlspecialchars(' Logout');?></a>
                        <?php } ?>
                    </div>
                </li>
  </div>  
</nav>
    



</body>
</html>



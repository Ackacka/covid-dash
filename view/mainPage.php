<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Template</title>
        <link rel="stylesheet" type="text/css" href="main.css"/>
    </head>
    <body>
        <h2>Template</h2>        
        
        <a href="index.php?action=loginPage">Login/Register</a>
        <br>
        <br>
        
        <?php if($_SESSION['loginUser'] !== 'defaultUser') { ?>
            <p class="loggedInAs">Logged in as <em><?php echo $_SESSION['loginUser']; ?></em></p>
            <a href="index.php?action=logOut">Log out</a>
        <?php } ?>
    </body>
</html>

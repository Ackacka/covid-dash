<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Template</title>
        <link rel="stylesheet" type="text/css" href="main.css"/>
    </head>
    <body>
        <h1>Account Sign Up</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="addUser">

    <fieldset> 
    <legend>User Registration</legend>
        <label>Username:  </label>
        <input type="text" name="username" value="<?php echo $username; ?>">
        <span class="errorMsg"> <?php echo $usernameError ?></span> 
        <br>
        
        <label>Email: </label>
        <input type="text" name="email" value="<?php echo $email; ?>">
        <span class="errorMsg"> <?php echo $emailError ?></span> 
        <br>
        
        <label>Password: </label>
        <input type="password" name="password" value="<?php echo $password; ?>">
        <span class="errorMsg"> <?php echo $passwordError ?></span> 
        <br><span class="errorMsg"><?php echo $pwdCapital?></span>
        <br><span class="errorMsg"><?php echo $pwdLower?></span>
        <br><span class="errorMsg"><?php echo $pwdNum?></span>
        <br><span class="errorMsg"><?php echo $pwdNonword?></span>   
        <br>        
    </fieldset>
        <br>
    <input type="submit" value="Submit">
    <br>

    </form>

    <p><a href="index.php?action=userLogin">Log In</a></p>
    <br>
    </main>			
    </body>
</html>

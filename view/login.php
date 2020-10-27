<!DOCTYPE html>

<html>
    <head>
        <?php include_once('headPage.php'); ?>
        <link rel="stylesheet" type="text/css" href="css/login.css"/>
    </head>
    <body>
        
        <div class="container">              
<!--	<img src="images/login.jpg"/>-->
            <h1 class="logo-badge"><span class="fa fa-user-circle"></span></h1>
            <h1>Account Sign In</h1>
		<form method="post" action="index.php">
                    <input type="hidden" name="action" value="userLogin">
			<div class="form-input ">                           
                            <input class="rounded" type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" placeholder="Enter Your User Name"/>  
                            <span style="color: red;"> <?php echo htmlspecialchars($usernameError) ?></span>
                            <br>
			</div>
                    
			<div class="form-input">
				<input class="rounded" type="password" name="password" placeholder="Enter Your Password"/> 
                                <span style="color: red;"> <?php echo htmlspecialchars($passwordError) ?></span>
                                <br>
			</div>
                    <br>
                    
		<input type="submit" type="submit" value="LOGIN" class="btn-login"/>                       
		</form>
                <br>
                <p>Do not have an account?</p>
                <p><a href="index.php?action=showAddUser">Register</a><br></p>
	</div>
    </body>
</html>

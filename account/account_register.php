<!DOCTYPE html>
<html>
    <head>
        <?php include_once('dashboard/dashboard_headPage.php'); ?>
        <link rel="stylesheet" type="text/css" href="css/addUser.css"/>
    </head>
    <body>
        <div class="container contact">
	<div class="row">
		<div class="col-md-3">
			<div class="contact-info">
                            <img class="add" src="images/add-friend.png"/>
				<h2>Register</h2>
			</div>
		</div>
		<div class="col-md-9">
                <form action="index.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="addUser">			
                            	<div class="form-group">
				  <label class="control-label col-sm-4" for="firstName">First Name:</label>
				  <div class="col-sm-10">          
					<input type="text" class="form-control" id="firstName" value="<?php echo htmlspecialchars($firstName); ?>" placeholder="Enter First Name" name="firstName">
                                        <span class="errorMsg error"> <?php echo htmlspecialchars($firstNameError) ?></span>
				  </div>
                                </div>
                                <div class="form-group">
				  <label class="control-label col-sm-2" for="lastName">Last Name:</label>
				  <div class="col-sm-10">          
					<input type="text" class="form-control" id="lastName" value="<?php echo htmlspecialchars($lastName); ?>" placeholder="Enter Last Name" name="lastName">
                                        <span class="errorMsg error"> <?php echo htmlspecialchars($lastNameError) ?></span>
				  </div>
                                </div>
                                <div class="form-group">
				  <label class="control-label col-sm-2" for="email">Email:</label>
				  <div class="col-sm-10">          
                                      <input class="form-control" type="email" id="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Enter Email" name="email">
                                      <span class="errorMsg error"> <?php echo htmlspecialchars($emailError) ?></span>
				  </div>
                                </div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="city">City:</label>
				  <div class="col-sm-10">          
					<input type="text" class="form-control" id="city" value="<?php echo htmlspecialchars($city); ?>" placeholder="Enter City" name="city">
                                        <span class="errorMsg error"> <?php echo htmlspecialchars($cityError) ?></span>
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-4" for="state">State:</label>
				  <div class="col-sm-10">          
					<input type="text" class="form-control" id="state" value="<?php echo htmlspecialchars($state); ?>" placeholder="Enter State" name="state">
                                        <span class="errorMsg error"> <?php echo htmlspecialchars($stateError) ?></span>
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="zipcode">Zipcode:</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" id="zipcode" value="<?php echo htmlspecialchars($zipcode); ?>" placeholder="Enter zipcode" name="zipcode">
                                        <span class="errorMsg error"> <?php echo htmlspecialchars($zipcodeError) ?></span>
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="username">Username:</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" id="username" value="<?php echo htmlspecialchars($username); ?>" placeholder="Enter Username" name="username"/>
                                        <span class="errorMsg error"> <?php echo htmlspecialchars($usernameError) ?></span>
				  </div>
				</div>
                                <div class="form-group">
				  <label class="control-label col-sm-2" for="password">Password:</label>
				  <div class="col-sm-10">
					<input type="password" class="form-control" id="password" value="<?php echo htmlspecialchars($password); ?>" placeholder="Enter Password" name="password">
                                        <span class="errorMsg error"> <?php echo htmlspecialchars($passwordError) ?></span>
				  </div>
				</div>
                                <div class="form-group useradmin">                                
                                <input  type="checkbox" id="admin" name="admin" value="admin" >                                
                                <label for="admin">Admin Account</label><br>
                                </div>				
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                <button type="submit" class="btn btn-success">Register</button>
                                </div>
                            <div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a></div>
			</div>
                    </form>
		</div>
            </div>
        </div>       
    </body>
</html>

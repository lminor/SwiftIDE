<div class="module">
    <div class="span3">
        <form action="?" class="signup-form" method="post">
        	<h3 class="welcomeprofile">
                <?php echo htmlentities($data['username']); ?>'s Profile
            </h3>

			<div class="welcomeprofile">
				<p>Make changes to your public profile, or delete your account.</p>

				<div class="loggedinoptions">
					<?php $u_num = $data['id'];?>
                    <!---<li><a href="auth.php" class="small button asphalt">Members Only</a></li>--->
                    <!---<li><a href="profile.php" class="small button asphalt">Manage Account</a></li>--->
                    <!---<li><a href="logout.php" class="small button asphalt">Logout</a></li>--->
				</div>

				<div class="item">
					<input type="hidden" name="id" value="<?php echo htmlentities($data['id']); ?>"/></td>
				</div>

				<div class="item">
                	<label for="username">Username:</label>
                	<input type="text" name="username" id="username" maxlength="40" size="40" value="<?php echo htmlentities($data['username']); ?>"/>
    			</div>

				<div class="item">
                	<label for="first_name">First Name:</label>
                	<input type="text" name="first_name" id="first_name" maxlength="40" size="40" value="<?php echo htmlentities($data['first_name']); ?>"/>
    			</div>

				<div class="item">
                	<label for="last_name">Last Name:</label>
                	<input type="text" name="last_name" id="last_name" maxlength="40" size="40" value="<?php echo htmlentities($data['last_name']); ?>"/>
    			</div>

    			<div class="item">
                	<label for="email">Email:</label>
                	<input type="text" name="email" id="email" maxlength="40" size="40" value="<?php echo htmlentities($data['email']); ?>"/>
    			</div>

				<div class="item" align="right">
                	<input type="submit" id="update" name="update" class="button" value="Update Profile" />
            	</div>

            	<div class="item" align="right">
                	<input type="submit" id="delete" name="supdate" class="button" value="Delete Account" />
            	</div>

				<div class="delete-user">
					<?php
	  					if ( isset($_POST['delete']) == 'delete' ) {
	    					$con = mysql_connect("localhost","root","root");
	    					mysql_select_db("SIDE", $con);
	    					$id = $_POST['id'];

                            /* TODO: REMOVE INLINE SQL QUERY!
                             * BETTER WAY TO DO THIS IS SETUP
                             * A DELETE PAGE WHICH USES AUTHMODEL
                             * TO DELETE MEMBER ACCOUNT AND
                             * REDIRECT THEM TO SIGNOUT.PHP WHEN
                             * THERE ACCOUNT HAS BEEN DELETED. */
	        				if( !empty($id) ) {
	          					$sql = mysql_query("DELETE FROM mambers WHERE id = '$id' LIMIT 1") or die (mysql_error());
	          					echo 'Account was deleted successfully.';
	          					unset($_SESSION['userInfo']);
								session_regenerate_id(true);
	        				}
	  					}
					?>
				</div>

				<div class="update-user">
					<?php
	  					if (isset($_POST['update']) == "update") {
	    					$con = mysql_connect("localhost","root","root");
	    					mysql_select_db("SIDE", $con);
	    					$id = $_POST['id'];
	    					$username = $_POST['username'];
	    					$first_name = $_POST['first_name'];
	    					$last_name = $_POST['last_name'];
	    					$email = $_POST['email'];

                            /* TODO: REMOVE INLINE SQL QUERY! */
	        				if ( !empty($id) ) {
	          					$sql = mysql_query("UPDATE members SET username = '$username', first_name = '$first_name', last_name = '$last_name', email = '$email' WHERE id='$id' LIMIT 1") or die   (mysql_error());
	          					echo 'Personal info has been updated.';
	        				}
	  					}
					?>
				</div>
			</div>
		</form>
	</div>
</div>
<?php	
	require 'header.php';
	echo "<div class='main'> <h4 class ='text-center'> <small>Please enter your details to log in </small></h4>";

	// $user variable holds username value
	// $pass variable holds password value
	$error = $user = $pass = "";
	// if the 'user' named textbox is entered by the user
	if (isset($_POST['user'])){
		$user = sanitizeString($_POST['user']);
		$pass = sanitizeString($_POST['pass']);
	
		if ($user == "" || $pass == "")
			$error = "Not all fields were entered!" . "<br>";
		else{
			$result = queryMySQL("SELECT user,pass FROM members
			WHERE user='$user' AND pass='$pass'");

			// if there is no such a record in the database
			if ($result->num_rows == 0){
				$error = "<span class='error'>Username/Password
				invalid</span><br><br>";
			}
			else{
				// storing the entered variables in the SESSION array
				$_SESSION['user'] = $user;
				$_SESSION['pass'] = $pass;
				
				// a hidden login button for a navigation 
				echo <<<_END
				<button id='loginButton' onclick="window.location='members.php?view=$user'" style ="visibility:hidden;">Click Me</button>
				<script type="text/javascript" src = "javascript.js">
				</script>								
_END;
			}
		}
	}
?>
 
<?php

// it calls the login.php again to validate the user inputs
// the checks are written above
echo <<<_END
 <div class='container'>   
  <form method = 'post' action='login.php'> 
    <div class='form-group row col-md-6'>
      <div class= 'col-xs-2'> 
      	<label for='Username'>Username:</label> 
      	<input type='text' maxlength = '16' class='form-control' id='user_field' name='user'> 
      </div> 
      <div class= 'col-xs-2'> 
     	 <label for='pwd'>Password:</label> 
     	 <input type='password' class='form-control' id='password_field' placeholder='Enter password' name='pass'> 
   	  </div>
      <input type='submit' class='btn btn-info mt-3' value = 'Login'> 
    </div> 
  </form> 
</div>
_END;

?>

</body>
</html>
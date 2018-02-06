<?php
	require_once 'header.php';

	echo "<div class='main'> <h4 class ='text-center'> <small>Please enter your details to sign up </small></h4>";

	$error = $user = $pass = "";
	// to destroy the previous sesson 
	if (isset($_SESSION['user'])) 
		destroySession();
	// if the 'user' named textbox is entered by the user 
	if (isset($_POST['user']))
	{
		$user = sanitizeString($_POST['user']);
		$pass = sanitizeString($_POST['pass']);

		if ($user == "" || $pass == "")
		$error = "Not all fields were entered<br><br>";
		else{
			// if the "typed" username already exists in the database
			$result = queryMysql("SELECT * FROM members WHERE user='$user'");
			if ($result->num_rows > 0)
				$error = "Sorry that username already exists<br><br>";
			else{
				// inserts the values into the database
				queryMysql("INSERT INTO members VALUES('$user', '$pass')");
				die("<h4>Account created</h4>Please Log in.<br><br>");
			}
		}
	}

echo <<<_END
 <div class='container'>   
  <form method = 'post' action='signup.php'> 
    <div class='form-group row col-md-6'>
      <div class= 'col-xs-2'> 
      	<label for='Username'>Username:</label> 
      	<input type='text' maxlength = '16' class='form-control' id='user_field' name='user'> 
      </div> 
      <div class= 'col-xs-2'> 
     	 <label for='pwd'>Password:</label> 
     	 <input type='password' class='form-control' id='password_field' placeholder='Enter password' name='pass'> 
   	  </div>
      <input type='submit' class='btn btn-info mt-3' value = 'Sign up'> 
    </div> 
  </form> 
</div>
_END;
?>

</form></div><br>
</body>
</html>
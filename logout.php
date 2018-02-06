<?php
require_once 'header.php';
	// if the user variable is set in the $_SESSION
	if (isset($_SESSION['user'])){
		// destroySession() function is implemented in functions.php
		destroySession();
		
		// a hidden logout button for navigation		
		echo <<<_END
			<button id='logoutButton' onclick="window.location='index.php'" style ="visibility:hidden;">Click Me</button>
			<script type="text/javascript" src = "javascript.js">
			</script>	
_END;
	}	
	else 
		echo "<div class='main'><br>"." You cannot log out because you are not logged in";
?>
<br><br></div>
</body>
</html>
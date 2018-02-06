<?php
	// loading header.php file which has all the GUI
	require_once 'header.php';
	echo "<div class='container-fluid'>" . 
	     "<br> <p class='text-center'> Welcome to $appname! " .
	     "<br> <p> In this website: " .
		 "<li> You can create your own profile:  </li>" .
		 "<li> You can add friends  </li>" .
		 "<li> You view other members' profile </li>" . 
		 "<li> You view the shared photos of your friends </li>" .
		 "<br>";

	if ($loggedin) 
		echo " $user, you are logged in.";
	else
		echo ' please sign up or log in';
	
	echo "</div>";
?>
</span><br><br>
</body>
</html>
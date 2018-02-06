<?php
	// to store some variables for a current single user
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<!-- bootstrap 4 css files -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"> 
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">  
	<link rel="stylesheet" href="styles.css" type='text/css'>  
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<?php
	// to prevent multiple inclusions of the same file
	require_once 'functions.php';

	// used for title in the home page
	$userstr = ' (Guest User)';

	// if the text field named 'user' is set by the user 
	if (isset($_SESSION['user'])){
		$user = $_SESSION['user'];
		/* use the value $loggedin variable to execute many .php files
		 such as friends.php, members.php, messages.php and profile.php */
		$loggedin = TRUE;
		// assigns the value of username
		$userstr = " ($user)";
	}
	else 
		$loggedin = FALSE;

	// every user will see a different title name due to $userstr variable changes 
	echo "<title>$appname"  . "$userstr </title><link rel='stylesheet' " .
	// loading css file
	"href='styles.css' type='text/css'>" .
	// <body> tag is closed in other .php files
	"</head><body>".
	"<div class='appname'>$appname$userstr</div>" ;
	

	// if the user is logged in, these navigation sections will appear
	if ($loggedin){

		echo "<nav class='navbar navbar-expand-sm bg-info navbar-dark'>
  			<ul class='navbar-nav'>
    			<li class='nav-item active'>
      				<a class = 'nav-link' href='members.php?view=$user'>Home</a>
    			</li> 
    			<li class='nav-item'>
      				<a class='nav-link' href='members.php'>Members</a>
    			</li> 
    			<li class='nav-item'>
      				<a class='nav-link' href='friends.php'>Friends</a>
    			</li>
    			<li class='nav-item'>
    				<a class='nav-link' href='news.php'>News</a>
    			</li>
    			<li class='nav-item'>
      				<a class='nav-link' href='profile.php'>Edit Profile</a>
    			</li>
    			<li class='nav-item'>
      				<a class='nav-link' href='logout.php'>Log out</a>
    			</li>
  			</ul>
			</nav>";
	}

	// if the user is NOT logged in, these navigation sections will appear
	else{
		echo "<nav class='navbar navbar-expand-sm bg-info navbar-dark'>
  			<ul class='navbar-nav'>
    			<li class='nav-item active'>
      				<a class = 'nav-link' href='index.php'>Home</a>
    			</li> 
    			<li class='nav-item'>
      				<a class='nav-link' href='signup.php'>Sign Up</a>
    			</li> 
    			<li class='nav-item'>
      				<a class='nav-link' href='login.php'>Log in</a>
    			</li>
  			</ul>
			</nav>";
	}
?>





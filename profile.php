<?php

require_once 'header.php';
	
	if (!$loggedin) 
		die("You can't view this page without login!");

	echo "<div class='main'><h4 class ='text-left'> <small> Your Profile  </small></h4>";
	$result = queryMysql("SELECT * FROM profiles WHERE user='$user'");


	// if the user posts the text field named 'text' 
	if (isset($_POST['text']))
	{
		$text = sanitizeString($_POST['text']);
		$text = preg_replace('/\s\s+/', ' ', $text);

		// if the user has already written a "bio" section
		if ($result->num_rows)
			queryMysql("UPDATE profiles SET text='$text' where user='$user'");
		else 
			queryMysql("INSERT INTO profiles VALUES('$user', '$text')");
	}

	// if the user doesn't post any new text
	else{
		// but already has a written bio section from before		
		if ($result->num_rows){
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$text = stripslashes($row['text']);
		}
		else $text = "";
	}
	$text = stripslashes(preg_replace('/\s\s+/', ' ', $text));


	// if a photo is uploaded 
	if (isset($_FILES['image']['name']))
	{
		// name of the profile image
		$saveto = "$user.jpg";
		move_uploaded_file($_FILES['image']['tmp_name'], $saveto);

		// typeok accepts only .jpeg and .png file extensions
		$typeok = TRUE;
		switch($_FILES['image']['type']){
			case "image/jpeg": 
			case "image/png": $src = imagecreatefrompng($saveto); break;
			default: $typeok = FALSE; break;
		}
	}
	
	showProfile($user);

// textarea to write introductory biography and a submit button to upload profile image
echo <<<_END
<div class='container'>
  <p>Write a short biography and/or upload an image</p>
  <form>
    <div class='form-group'>
      <textarea name = 'text' class='form-control mb-3' rows='4'></textarea>
      Image: <input type = 'file' name = 'image' size = '14'>
      	<input type='submit' value='Save Profile'>
    </div>
  </form>
</div>
_END;

?>
</body>
</html>
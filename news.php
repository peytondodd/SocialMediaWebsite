<?php
	require_once 'header.php';

	if(!loggedin)
		die("You can't view this page without login!");

  // initialize message variable
  $msg = "";

  // if upload button is clicked ...
  if (isset($_POST['upload'])) {
    // Get image name
      $image = $_FILES['image']['name'];
      
    // Get text
    $image_text = mysqli_real_escape_string($connection, $_POST['image_text']);

    // image file directory
    $target = "images/".basename($image);
    

    $currentDate = date("Y/m/d");

    $sql = "INSERT INTO images (image, image_text, date, user) VALUES ('$image', '$image_text', '$currentDate', 
    '$userstr')";
     
    // execute query
    $result = queryMysql($sql);


    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
      $msg = "Image uploaded successfully";
    }else{
      $msg = "Failed to upload image";
    }

  }
    
    // querying post from database to display the "post"
    $result = queryMysql("SELECT * FROM images");

    while ($row = mysqli_fetch_array($result)) {
        echo "<div id='img_div'>";
            echo "<p class = 'ml-3'>".$row['user']. " shared this image" . " on this date: " . $row['date'] . "</p>";
            echo "<img src='images/".$row['image']."' height = '120' width = '160' class = 'img-thumbnail ml-5 mb-2' >";
            echo "<p class = 'ml-3'>".$row['image_text']."</p>";            
        echo "</div>";
      }
?>
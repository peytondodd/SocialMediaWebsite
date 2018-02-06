<?php   
  require 'header.php';

// if the user is not logged in exit the script
if (!$loggedin) 
  die("You can't view this page without login!");

  echo "<div class='main'>";
  // the value of $view variable is initially set in the login.php
  if (isset($_GET['view'])){
    $view = sanitizeString($_GET['view']);
     // if the viewed profile is user's own profile
     if ($view == $user) 
        $name = "Your";
     // if the user tries to view another user's profile
     else{
        echo "You can only view the profile!";
        echo "<h3>$view's Profile</h3>";
        // implemented in functions.php, displays the user's profile image and a short biography
        showProfile($view);
        die("Hello stalker!");    
    }

    echo "<div class='main'><h4 class ='text-left'> <small> $name Profile  </small></h4>";   
    showProfile($view);


// to share images
echo <<<_END
    <form method='POST' action='news.php' enctype='multipart/form-data'>
    <input type='hidden' name='size' value='1000000'>
    <div>
      <input type="file" name="image" id = 'image_upload'>
    </div>
    <div>
      <textarea name ='image_text' class='form-control col-md-8 mt-2 ' id = 'image_text' 
        rows='3' 
        placeholder='Write something about your post...''></textarea>
    </div>
    <div>
      <button type='submit' id = 'image_submit' class='btn btn-info mt-2' name='upload'>POST</button>
    </div>
  </form>
_END;

    die("</div></body></html>");
  }

  // to "add" a user as a friend
  if (isset($_GET['add'])){
    $add = sanitizeString($_GET['add']);
    $result = queryMysql("SELECT * FROM friends WHERE user='$add'AND friend='$user'");
  
  if (!$result->num_rows)
    queryMysql("INSERT INTO friends VALUES ('$add', '$user')");
  }
  // to "remove" a user from friendship
  else if (isset($_GET['remove'])){
    $remove = sanitizeString($_GET['remove']);
    queryMysql("DELETE FROM friends WHERE user='$remove' AND friend='$user'");
  }

  // to "list" all the users in the database
  $result = queryMysql("SELECT user FROM members ORDER BY user");
  // $num  variable represents number of members
  $num = $result->num_rows;
  //echo "<h3>Other Members</h3><ul>";
  echo "<div class='main'><h4 class ='text-left'> <small> Other Members </small></h4>";

  for ($j = 0 ; $j < $num ; ++$j){
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if ($row['user'] == $user) 
      continue;

    echo "<li><a href='members.php?view=" .
    $row['user'] . "'>" . $row['user'] . "</a>";
    $friendship = "add";


    $result1 = queryMysql("SELECT * FROM friends WHERE
    user='" . $row['user'] . "' AND friend='$user'");
    $t1 = $result1->num_rows;
    $result2 = queryMysql("SELECT * FROM friends WHERE
    user='$user' AND friend='" . $row['user'] . "'");
    $t2 = $result2->num_rows;




    if (($t1 + $t2) > 1)      
      echo " &harr; is your friend";
    elseif ($t1)
      echo " &larr; you sent a friendship request";
    elseif ($t2) {
      echo " &rarr; sent you a friendship request";
      $friendship = "recip"; 
    }
    // if you didn't send a friendship request before
    if (!$t1) 
      echo " [<a href='members.php?add=" . $row['user'] . "'>$friendship</a>]";
    // to "reject" the received friendship request or drop the friend
    else
      echo " [<a href='members.php?remove=" . $row['user'] . "'>drop</a>]";
  }  
?>

</ul></div>
</body>
</html>
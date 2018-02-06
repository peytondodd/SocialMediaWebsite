<?php
require_once 'header.php';
    if (!$loggedin) 
        die("You can't view this page without login!");

    if (isset($_GET['view'])) 
        $view = sanitizeString($_GET['view']);
    else
        $view = $user;

    if ($view == $user){
        $name1 = $name2 = "Your";
        $name3 = "You are";
    }
    else{
        $name1 = "<a href='members.php?view=$view'>$view</a>'s";
        $name2 = "$view's";
        $name3 = "$view is";
    }
    echo "<div class='main'>";

    //showProfile($view);

    $friendshipRequestReceived = array();
    $friendshipRequestSent = array();

    $result = queryMysql("SELECT * FROM friends WHERE user='$view'");
    $num = $result->num_rows;

    // other users who sent you a friendship request
    for ($j = 0 ; $j < $num ; ++$j)
    { 
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $friendshipRequestReceived[$j] = $row['friend'];
    }
        $result = queryMysql("SELECT * FROM friends WHERE friend='$view'");
        $num = $result->num_rows;

    // users that you sent a friendship request
    for ($j = 0 ; $j < $num ; ++$j)
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $friendshipRequestSent[$j] = $row['user'];
    }
        // $mutual variable stores the 'friends'
        $mutual = array_intersect($friendshipRequestSent, $friendshipRequestReceived);
        $friendshipRequestReceived = array_diff($friendshipRequestReceived, $mutual);
        $friendshipRequestSent = array_diff($friendshipRequestSent, $mutual);
        $friends = FALSE;
    
    // listing friends
    if (sizeof($mutual)){
        echo "<span class='subhead'>$name2 friends</span><ul>";
        foreach($mutual as $friend)
            echo "<li><a href='members.php?view=$friend'>$friend</a>";
            echo "</ul>";
            $friends = TRUE;
            showProfile($friend);
    }
    
    // listing received friendship requests
    if (sizeof($friendshipRequestReceived)){
        echo "<span class='subhead'>Received friendship requests</span><ul>";
        foreach($friendshipRequestReceived as $friend)
        echo "<li><a href='members.php?view=$friend'>$friend</a>";
        echo "</ul>";
        showProfile($friend);
    }

    // listing sent friendship requests
    if (sizeof($friendshipRequestSent)){
        echo "<span class='subhead'>Sent friendship requests </span><ul>";
        foreach($friendshipRequestSent as $friend)
        echo "<li><a href='members.php?view=$friend'>$friend</a>";
        echo "</ul>";
    }
    
    if (!$friends) 
        echo "<br>You don't have any friends yet :(<br><br>";
    ?>
    </div><br>
    </body>
</html>
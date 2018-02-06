<?php
    // openning connection to MySQL
    $dbhost = 'localhost'; 
    $dbname = 'social_media_db'; 
    $dbuser = 'root'; 
    $dbpass = 'root';  
    $appname = "Gokhan's Webpage"; 
    // MySQL connection object is created
    $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    // checks connection
    if ($connection->connect_error) {
        echo "There is a MySQL connection error: ";
        die($connection->connect_error);
    }

    // a template to use ALL queries to MySQL
    function queryMysql($query){
        global $connection;
        $result = $connection->query($query);
        // if the query cannot be done
        if (!$result) 
            die($connection->error);
        return $result;
    }
    
    // destroys a PHP session and clears its data used for logout process
    function destroySession(){
        $_SESSION=array();
        if (session_id() != "" || isset($_COOKIE[session_name()]))
            // 2592000 seconds represents 1 month
        setcookie(session_name(), '', time()-2592000, '/');
        session_destroy();
    }

    // used for displaying texts after SQL operations
    function sanitizeString($var){
        global $connection;
        // to remove backslashes
        $var = stripslashes($var);
        // to remove html elements from strings
        $var = htmlentities($var);
        // to strip html entirely from input
        $var = strip_tags($var);        
        // to escape special characters in a string to use in SQL statements
        return $connection->real_escape_string($var);
    }

    function showProfile($user){
        // displays user's image
        if (file_exists("$user.jpg"))
            // image size is set
            echo "<img src='$user.jpg' height = '120' width = '160' style='float:left  ;'>";
        // displays "biography" section if the user has written sth in there
        $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");
        if ($result->num_rows > 0){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo stripslashes($row['text']) . "<br style='clear:left;'><br>";
        }
    }
?>
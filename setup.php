<!DOCTYPE html>
<html>
<head>
<title>Setting up database</title>
</head>
<body>
<h3>Setting up...</h3>

<?php
// creating database tables
// INDEX'ing is done for a faster search operation

require_once 'functions.php';

$sqlTableMembers = "CREATE TABLE members (
    user VARCHAR(16),
    pass VARCHAR(16),
    INDEX(user(6))
)";

if ($connection->query($sqlTableMembers) === TRUE) {
    echo "Table 'members' created successfully" . "<br>";
} else {
    echo "Error creating table: " . $connection->error . "<br>";
}

$sqlTableFriends = "CREATE TABLE friends (
    user VARCHAR(16),
    friend VARCHAR(16),
    INDEX(user(6)),
    INDEX(friend(6))
)";

if ($connection->query($sqlTableFriends) === TRUE) {
    echo "Table 'friends' created successfully" . "<br>";
} else {
    echo "Error creating table: " . $connection->error . "<br>";
}

$sqlTableProfiles = "CREATE TABLE profiles (
    user VARCHAR(16),
    text VARCHAR(4096),
    INDEX(user(6))
)";

if ($connection->query($sqlTableProfiles) === TRUE) {
    echo "Table 'profiles' created successfully" . "<br>";
} else {
    echo "Error creating table: " . $connection->error . "<br>";
}

$sqlTableSharingImages = "CREATE TABLE images (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    user VARCHAR(16),
    image_text TEXT,
    image VARCHAR(200),
    date DATE,
    INDEX(user(6)),
    INDEX(image(200))
)";

if ($connection->query($sqlTableSharingImages) === TRUE) {
    echo "Table 'images' created successfully" . "<br>";
} else {
    echo "Error creating table: " . $connection->error . "<br>";
}
?> 

<br>...done.
</body>
</html>
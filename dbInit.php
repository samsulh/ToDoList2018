<?php

$serverName = "localhost";
$userName = "todouser";
$password = "todopass";
$dbName = "todo_2018";

$dbCon = mysqli_connect($serverName, $userName, $password, $dbName);

if (!$dbCon)
{
    header("Location: index.php?error=database_not_connected");
    exit();
}

$users = "CREATE TABLE IF NOT EXISTS users
(
    userID INT NOT NULL AUTO_INCREMENT UNIQUE,
    userName VARCHAR(100) NOT NULL,
    userPassword VARCHAR(100),
    PRIMARY KEY(userID)
);";

$tasks = "CREATE TABLE IF NOT EXISTS tasks
(
    taskID INT NOT NULL AUTO_INCREMENT UNIQUE,
    taskName VARCHAR(100) NOT NULL,
    taskDueDate DATE,
    taskStatus VARCHAR(9),
    PRIMARY KEY(taskID)
);";

mysqli_query($dbCon, $users);
mysqli_query($dbCon, $tasks);

$myName = "samsul";
$myPassword = "password";

$createDefaultUser = "INSERT INTO users
(
    userName,
    userPassword
)
VALUES
(
    '$myName',
    '$myPassword'
);";

$numUsers = "SELECT * FROM users";
$myResult = mysqli_query($dbCon, $numUsers);
$numRows = mysqli_num_rows($myResult);
if ($numRows == 0)
{
    mysqli_query($dbCon, $createDefaultUser);
}

?>
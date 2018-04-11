<?php

include_once "dbInit.php";

$taskID = $_REQUEST["taskID"];

$startTask = "UPDATE tasks SET
    taskStatus='Started'
    WHERE taskID='$taskID';";

mysqli_query($dbCon, $startTask);

header("Location: index.php?startTask=successful");

exit();
    
?>
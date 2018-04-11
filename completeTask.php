<?php

include_once "dbInit.php";

$taskID = $_REQUEST["taskID"];

$completeTask = "UPDATE tasks SET
    taskStatus='Completed'
    WHERE taskID='$taskID';";

mysqli_query($dbCon, $completeTask);

header("Location: index.php?completeTask=successful");

exit();
    
?>
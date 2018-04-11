<?php

include_once "dbInit.php";

$taskID = $_REQUEST["taskID"];

$deleteTask = "DELETE FROM tasks WHERE taskID='$taskID';";

mysqli_query($dbCon, $deleteTask);

header("Location: index.php?deleteTask=successful");

exit();
    
?>
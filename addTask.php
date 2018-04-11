<?php

if (isset($_POST["submit"]))
{
    include_once "dbInit.php";

    $taskName = mysqli_real_escape_string($dbCon, $_POST["taskName"]);

    $taskDueDate = date("Y-m-d", strtotime($_POST["taskDueDate"]));
    
    $currentDate = date("Y-m-d");
    
    $allTasks = "SELECT * FROM tasks";
    $allTasksResult = mysqli_query($dbCon, $allTasks);
    $numRows = mysqli_num_rows($allTasksResult);
    
    if ($currentDate > $taskDueDate)
    {
        header("Location: index.php?addTask=invalidDate");
        exit();
    }
    else if ($numRows >= 100)
    {
        header("Location: index.php?addTask=maxTasksReached");
        exit();
    }
    else
    {
        $insertTask = "INSERT INTO tasks
        (
            taskName,
            taskDueDate,
            taskStatus
        )
        VALUES
        (
            '$taskName',
            '$taskDueDate',
            'Pending'
        )";
        
        mysqli_query($dbCon, $insertTask);
        
        header("Location: index.php?addTask=successful");
        exit();
    }	
}
else
{
    header("Location: index.php");
    exit();
}

?>


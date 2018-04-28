<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <title>Started Tasks</title>
        <script>
            function validateAddTask()
            {
                var taskName = document.forms["addTaskForm"]["taskName"].value;
                var taskDueDate =
                        document.forms["addTaskForm"]["taskDueDate"].value;
                
                if (taskName == "")
                {
                    alert("Please enter a task!");
                    return false;
                }
            }
	</script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Samsul's ToDo List</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">All Tasks</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="started.php">Started Tasks <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pending.php">Pending Tasks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="completed.php">Completed Tasks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="late.php">Late Tasks</a>
                    </li>
                </ul>
            </div>
        </nav>
        <br>
        <center>
            <form name="addTaskForm" action="addTask.php"
                  onsubmit="return validateAddTask()" method="POST">
                <input type="text" name="taskName"
                       value="<?php if(isset($taskName)) echo $taskName; ?>"
                       placeholder="Task Name"/>
                <p>Due Date: </p>
                <input type="date" value="<?php echo date('Y-m-d'); ?>"
                       name="taskDueDate"/>
                <br>
                <button type=submit name="submit">
                    Add
                </button>
            </form>
        </center>
        
        <?php

        include_once "dbInit.php";
        
        $currentDate = date("Y-m-d");

        $allTasks = "SELECT * FROM tasks";
        $allTasksResult = mysqli_query($dbCon, $allTasks);
        $numRows = mysqli_num_rows($allTasksResult);
        
        echo "<center>";
        
        $startedTasks = "SELECT * FROM tasks WHERE taskStatus='Started';";
        $startedTasksResult = mysqli_query($dbCon, $startedTasks);
        $numRowsStarted = mysqli_num_rows($startedTasksResult);
        echo "<h3>Number of Started Tasks: $numRowsStarted</h3>";
        
        echo "<br>";
        
        echo "<table border='1'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Task Name</th>";
        echo "<th>Due Date</th>";
        echo "<th>Status</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        
        while($row = mysqli_fetch_assoc($startedTasksResult))
        {
            echo "<tr>";
            echo "<td>" . $row["taskName"] . "</td>";
            echo "<td>" . $row["taskDueDate"]. "</td>";
            echo "<td>" . $row["taskStatus"] . "</td>";
            echo '</tr>';
        }
        
        echo "</tbody>";
        echo "</table>";
        echo "</center>";

        ?>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    </body>
</html>

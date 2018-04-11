<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Samsul's ToDo App</title>
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
        <center>
            <form name="addTaskForm" action="addTask.php"
                  onsubmit="return validateAddTask()" method="POST">
                <input type="text" name="taskName"
                       value="<?php if(isset($taskName)) echo $taskName; ?>"
                       placeholder="Task Name"/>
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
        echo "<h3>Total Number of Tasks: $numRows</h3>";
        
        $pendingTasks = "SELECT * FROM tasks WHERE taskStatus='Pending';";
        $pendingTasksResult = mysqli_query($dbCon, $pendingTasks);
        $numRowsPending = mysqli_num_rows($pendingTasksResult);
        echo "<h3>Number of <a href='pending.php'>Pending Tasks</a>: $numRowsPending</h3>";
        
        $startedTasks = "SELECT * FROM tasks WHERE taskStatus='Started';";
        $startedTasksResult = mysqli_query($dbCon, $startedTasks);
        $numRowsStarted = mysqli_num_rows($startedTasksResult);
        echo "<h3>Number of <a href='started.php'>Started Tasks</a>: $numRowsStarted</h3>";
        
        $completedTasks = "SELECT * FROM tasks WHERE taskStatus='Completed';";
        $completedTasksResult = mysqli_query($dbCon, $completedTasks);
        $numRowsCompleted = mysqli_num_rows($completedTasksResult);
        echo "<h3>Number of <a href='completed.php'>Completed Tasks</a>: $numRowsCompleted</h3>";
        
        $lateTasks = "SELECT * FROM tasks WHERE taskStatus='Late';";
        $lateTasksResult = mysqli_query($dbCon, $lateTasks);
        $numRowsLate = mysqli_num_rows($lateTasksResult);
        echo "<h3>Number of <a href='late.php'>Late Tasks</a>: $numRowsLate</h3>";
        
        echo "<br>";
        
        echo "<table border='1'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Task Name</th>";
        echo "<th>Due Date</th>";
        echo "<th>Status</th>";
        echo "<th>Action</th>";
        echo "<th>Delete</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        
        while($row = mysqli_fetch_assoc($allTasksResult))
        {
            echo "<tr>";
            echo "<td>" . $row["taskName"] . "</td>";
            echo "<td>" . $row["taskDueDate"]. "</td>";
            $taskDueDate = $row["taskDueDate"];
            if ($currentDate > $taskDueDate)
            {
                $taskID = $row["taskID"];
                $lateTask = "UPDATE tasks SET
                    taskStatus='Late'
                    WHERE taskID='$taskID';";
                mysqli_query($dbCon, $lateTask);
            }
            echo "<td>" . $row["taskStatus"] . "</td>";
            if ($row["taskStatus"] == "Pending")
            {
                echo "<td><a href='startTask.php?taskID=" . $row["taskID"] . "'"
                        . "role='button'>Start</a></td>";
            }
            else if ($row["taskStatus"] == "Started")
            {
                echo "<td><a href='completeTask.php?taskID=" . $row["taskID"] . "'"
                        . "role='button'>Done</a></td>";
            }
            else if ($row["taskStatus"] == "Completed")
            {
                echo "<td></td>";
            }
            else if ($row["taskStatus"] == "Late")
            {
                echo "<td></td>";
            }
            echo "<td><a href='deleteTask.php?taskID=" . $row["taskID"] . "' "
                    . "role='button'>Delete</a></td>";
            echo "<td></td>";
            echo '</tr>';
        }
        
        echo "</tbody>";
        echo "</table>";
        echo "</center>";

        ?>
    </body>
</html>

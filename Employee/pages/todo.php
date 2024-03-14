<?php
// Include the database configuration file
include 'dbconfig.php';

// Initialize the result message variable
$resultMessage = '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the delete button is clicked
    if (isset($_POST['delete_todo'])) {
        // Get the to-do item ID to be deleted
        $delete_id = mysqli_real_escape_string($connection, $_POST['delete_id']);

        // Prepare and execute the SQL statement to delete the to-do item
        $delete_query = "DELETE FROM todo WHERE id = ?";
        $delete_stmt = mysqli_prepare($connection, $delete_query);

        if ($delete_stmt) {
            mysqli_stmt_bind_param($delete_stmt, "i", $delete_id);
            $delete_result = mysqli_stmt_execute($delete_stmt);
            mysqli_stmt_close($delete_stmt);

            if ($delete_result) {
                $resultMessage = "To-Do deleted successfully!";
            } else {
                $resultMessage = "Error: " . mysqli_error($connection);
            }
        } else {
            $resultMessage = "Error: " . mysqli_error($connection);
        }
    } else {
        // Get task and priority from the form
        $task = mysqli_real_escape_string($connection, $_POST['task']);
        $priority = mysqli_real_escape_string($connection, $_POST['priority']);

        // Determine the color and priority badge based on priority
        $priority_colors = [
            'High' => 'danger',
            'Medium' => 'warning',
            'Low' => 'info'
        ];

        $color = isset($priority_colors[$priority]) ? $priority_colors[$priority] : 'info';

        // Prepare and execute the SQL statement with a prepared statement
        $query = "INSERT INTO todo (task, priority, color) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($connection, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $task, $priority, $color);
            $result = mysqli_stmt_execute($stmt);

            $resultMessage = $result ? "To-Do added successfully!" : "Error: " . mysqli_error($connection);

            mysqli_stmt_close($stmt);
        } else {
            $resultMessage = "Error: " . mysqli_error($connection);
        }
    }
}

// Fetch to-dos from the "todo" table and order by the latest
$todo_query = "SELECT * FROM todo ORDER BY id DESC";
$todo_result = mysqli_query($connection, $todo_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-D3k7DMBF8JTROct7crGi67tcOFRwOJrtmXM6enm+yUXb8fM7RpjwbuoxZ+WpMlQ6FZ9XeXM6AsjxKLf6ymV3yw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .add-todo {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .add-todo input {
            flex: 1;
            margin-right: 10px;
        }

        .todo-list {
            list-style: none;
            padding: 0;
        }

        .todo-list-item {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .priority-badge {
            margin-left: 10px;
            color: white;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<div class="card card-row card-primary">
    <div class="card-header">
        <h3 class="card-title">
            To Do
        </h3>
    </div>
    <div class="card-body">
        <div class="add-todo">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" class="form-control" id="task" name="task" placeholder="Enter Task" required>
                <select class="form-control" name="priority">
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
                <button type="submit" class="btn btn-primary">
                    <span style="font-size: 20px;">+</span>
                </button>
            </form>
        </div>
        <?php
        // Display the result message above the button
        if (!empty($resultMessage)) {
            echo '<div class="alert ' . (strpos($resultMessage, 'successfully') !== false ? 'alert-success' : 'alert-danger') . '">';
            echo $resultMessage;
            echo '</div>';
        }
        ?>
        <ul class="todo-list">
            <?php
            // Loop through each row in the result set
            while ($row = mysqli_fetch_assoc($todo_result)) {
                echo '<li class="todo-list-item text-' . $row['color'] . '" style="background-color: light' . $row['color'] . ';">';
                echo $row['task'];
                echo '<span class="priority-badge badge bg-' . $row['color'] . '">' . $row['priority'] . '</span>';
                echo '<form method="POST" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
                echo '<input type="hidden" name="delete_id" value="' . $row['id'] . '">';
                echo '<button type="submit" class="btn btn-danger" name="delete_todo" class="btn btn-tool" onclick="return confirm(\'Are you sure you want to delete this to-do?\')">Delete</button>';
                echo '</form>';
                echo '</li>';
            }
            ?>
        </ul>
    </div>
</div>

</body>
</html>

<?php
// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Meetings</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
       .centered {
            text-align: center;
       }
    </style>
    <?php include 'navbar.php'; ?>
</head>
<body>
    <div class="container">
    <h2 class="text-dark text-center">Minutes of Meetings (MoM)</h2>
    <table class="table table-bordered">
        <thead class="thead-dark text-center">
            <tr>
                <th>Date/Time</th>
                <th>Title</th>
                <th>Responsible</th>
                <th>Status</th>
                <th>Comments</th>
                <th class="centered">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database connection details
            $db_host = 'localhost';
            $db_user = 'root';
            $db_password = '';
            $db_name = 'mom';

            // Connect to MySQL database
            $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve meetings from the database
            $sql = "SELECT * FROM meetings";
            $result = $conn->query($sql);

            // Check if there are any meetings
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='centered'>" . $row["date_time"] . "</td>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td class='centered'>" . $row["responsible"] . "</td>";
                    echo "<td class='centered'>";
                    // Display badge based on status
                    if ($row["status"] == "closed") {
                        echo '<span class="badge badge-success">Closed</span>';
                    } elseif ($row["status"] == "open") {
                        echo '<span class="badge badge-danger">Open</span>';
                    } elseif ($row["status"] == "in_progress") {
                        echo '<span class="badge badge-warning">In Progress</span>';
                    } else {
                        // Handle other status if needed
                        echo '<span class="badge badge-secondary">' . $row["status"] . '</span>';
                    }
                    echo "</td>";
                    echo "<td>" . $row["agenda"] . "</td>";
                    echo "<td class='centered'><a href='#editModal' data-toggle='modal' data-id='" . $row["id"] . "' data-agenda='" . $row["agenda"] . "'><button class='btn btn-sm btn-info'>Edit</button></a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No meetings found</td></tr>";
            }

            // Close database connection
            $conn->close();
            ?>
        </tbody>
    </table>
        </div>
    <!-- Bootstrap Modal for Editing Meeting -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Update Meeting Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="meetingId" name="id">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input class="form-control" type="text" id="title" name="title" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="agenda">Updates:</label>
                            <input class="form-control" type="text" id="agenda" name="agenda" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" id="status" name="status">
                                <!-- <option value="open">Open</option> -->
                                <option value="in_progress">In Progress</option>
                                <option value="closed">Closed</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to reload the page
            function reloadPage() {
                location.reload();
            }

            // Bind reloadPage function to modal's hidden event
            $('#editModal').on('hidden.bs.modal', reloadPage);

            // Handle edit link click event
            $('a[data-toggle="modal"]').click(function() {
    var meetingId = $(this).data('id');
    var title = $(this).closest('tr').find('td:eq(1)').text(); // Fetch title value from the 2nd column (index 1)
    var agenda = $(this).closest('tr').find('td:eq(4)').text(); // Fetch agenda value from the 5th column (index 4)
    $('#meetingId').val(meetingId);
    $('#title').val(title); // Set the fetched title value to the 'title' input field
    $('#agenda').val(agenda); // Set the fetched agenda value to the 'agenda' input field
});

            // Handle edit form submission
            $('#editForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    type: 'POST',
                    url: 'edit_meeting.php',
                    data: form.serialize(),
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        $('#editModal').modal('hide');
                        // You may reload the page or update specific elements on the page as per your requirement
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>

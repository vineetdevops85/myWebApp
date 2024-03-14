<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Minutes</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .add-row-button {
            width: 100%;
            text-align: center;
            margin-top: 10px;
        }
    </style>
        <?php include 'navbar.php'; ?>
</head>
<body>
    <div class="container">
        <h1  class="text-dark text-center">Minutes of Meeting (MoM)</h1>
        <form action="save_meeting.php" method="POST" id="meetingForm">
            <table id="meetingTable">
                <thead>
                    <tr>
                        <th class="text-center">Title</th>
                        <th class="text-center">Responsible</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Comments</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tr>
                    <td><input class="form-control" type="text" name="title[]" required autocomplete="off"></td>
                    <td>
                        <select class="form-control" id="responsible" name="responsible[]" required>
                            <option value="Manager">Manager</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Lead">Lead</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="status[]" required>
                            <option value="">Select status</option>
                            <option value="open">Open</option>
                            <option value="in_progress" disabled>In Progress</option>
                            <option value="closed" disabled>Closed</option>
                        </select>
                    </td>
                    <td><textarea class="form-control" name="agenda[]" required></textarea></td>
                    <td class="text-center"><button class="btn btn-sm btn-danger" type="button" onclick="removeRow(this)">Remove Row</button></td>
                </tr>
            </table>
            <div class="add-row-button">
                <button class="btn btn-sm btn-info" type="button" onclick="addRow()">Add New</button>
            </div>
            <button class="btn btn-sm btn-success" type="button" onclick="confirmSave()">Save Meeting</button>
        </form>
    </div>

    <script>
        function addRow() {
            var table = document.getElementById('meetingTable');
            var newRow = table.insertRow(table.rows.length - 1); // Insert row before the last row (excluding the last row)
            var cellCount = table.rows[0].cells.length;
            for (var i = 0; i < cellCount; i++) {
                var cell = newRow.insertCell(i);
                if (i === cellCount - 1) {
                    cell.innerHTML = '<button class="btn btn-sm btn-danger" style="display: block; margin: 0 auto;" type="button" onclick="removeRow(this)">Remove Row</button>';
                } else {
                    cell.innerHTML = '<input class="form-control" type="text" name="title[]" required autocomplete="off">';
                    if (i === 1) {
                        cell.innerHTML = '<select class="form-control" id="responsible" name="responsible[]" required>' +
                            '<option value="Manager">Manager</option>' +
                            '<option value="Supervisor">Supervisor</option>' +
                            '<option value="Lead">Lead</option>' +
                            '</select>';
                    } else if (i === 2) {
                        cell.innerHTML = '<select class="form-control" name="status[]" required>' +
                            '<option value="">Select status</option>' +
                            '<option value="open">Open</option>' +
                            '<option value="in_progress" disabled select>In Progress</option>' +
                            '<option value="closed" disabled select>Closed</option>' +
                            '</select>';
                    } else if (i === 3) {
                        cell.innerHTML = '<textarea class="form-control" name="agenda[]" required></textarea>';
                    }
                }
            }
        }

        function removeRow(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }

        function confirmSave() {
            Swal.fire({
                title: "Do you want to add Minutes of Meeting (MoM)?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Yes",
                denyButtonText: `No`
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if the user confirms
                    document.getElementById("meetingForm").submit();
                } else if (result.isDenied) {
                    // Do nothing if the user denies
                }
            });
        }
    </script>
</body>
</html>

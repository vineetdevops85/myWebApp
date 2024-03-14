<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: system-ui;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 90%;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #1c1c1c;
            color: #f07b07;
        }

        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="text"],
        input[type="checkbox"] {
            margin-right: 5px;
            margin-bottom: 5px;
            width: 100%;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .download-link {
            margin-top: 20px;
            text-align: center;
        }

        a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        @media screen and (max-width: 600px) {
            form {
                width: 90%;
            }

            input[type="text"],
            select,
            input[type="checkbox"] {
                width: 100%;
            }
        }
        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 300px;
        }

        .custom-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            border: 2px solid #f55905;
            color: white;
            background-color: #f57905;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Add hover effect */
        .custom-button:hover {
            background-color: #f54905;
            color: white;
        }
    </style>
    <title>External Alarm Scripting Tool (EAST)</title>
</head>

<body>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle form submission
        $alarmStrings = [];

        // Get SiteId from the text box at the top
        $siteId = isset($_POST["SiteId"]) ? $_POST["SiteId"] : '';

        // Loop through each row
        for ($i = 1; $i <= 32; $i++) {
            $port = $_POST["port{$i}"];
            $ports = $_POST["ports{$i}"];
            $radio = isset($_POST["radio{$i}"]) ? $_POST["radio{$i}"] : '';

            // Check if the radio button is ticked
            if ($radio == 'on') {
                $dropdownValue = $_POST["port{$i}"];
                $dropdownValue2 = $_POST["ports{$i}"];
                $alarmStrings[] = "cmedit set SubNetwork=ONRM_ROOT_MO,MeContext={$siteId},ManagedElement={$siteId},Equipment=1,FieldReplaceableUnit=SAU-1,AlarmPort={$i} userlabel=\"{$dropdownValue}\", priority=\"{$dropdownValue2}\"";
            }
        }

        // Generate a unique filename with SiteId, date, and time
        $filename = $siteId . '_' . date('dmYHis') . '.txt';

        // Write the strings to the file
        file_put_contents($filename, implode(PHP_EOL, $alarmStrings));
    }
    ?>

    <form method="post">
        <h2 style="color: #f57b0a;">External Alarm Scripting Tool (EAST)</h2>
        <label for="SiteId"><b>Site ID:</b></label>
        <input type="text" name="SiteId" id="SiteId" required placeholder="Enter Site ID">

        <table>
            <tr>
                <th>SAU Port</th>
                <th>Alarm Slogan</th>
                <th>Priority</th>
                <th>Select Port</th>
            </tr>

            <?php
            // Generate the form with 32 rows
            for ($i = 1; $i <= 32; $i++) {
                echo '<tr>';
                echo "<td>{$i}</td>";
                echo '<td>';
                echo "<select name='port{$i}'>";
                // echo "<option value='' disabled selected>SELECT SLOGAN</option>";
                echo "<option value='RBS INTRUSION'>RBS INTRUSION</option>";
                echo "<option value='RBS CLIMATE FAIL'>RBS CLIMATE FAIL</option>";
                echo "<option value='RBS HEX FAN FAIL'>RBS HEX FAN FAIL</option>";
                echo "<option value='RBS EQPT TEMP HIGH'>RBS EQPT TEMP HIGH</option>";
                echo "<option value='RBS EQPT TEMP LOW'>RBS EQPT TEMP LOW</option>";
                echo "<option value='RBS DC CR'>RBS DC CR</option>";
                echo "<option value='RBS DC HIGH LOW VOLT'>RBS DC HIGH LOW VOLT</option>";
                echo "<option value='RBS DC MJ'>RBS DC MJ</option>";
                echo "<option value='RBS FUSE FAIL'>RBS FUSE FAIL</option>";
                echo "<option value='RBS DC RECT MJ'>RBS DC RECT MJ</option>";
                echo "<option value='RBS DC RECT CR'>RBS DC RECT CR</option>";
                echo "<option value='RBS BATT TEMP HIGH'>RBS BATT TEMP HIGH</option>";
                echo "<option value='RBS PORTABLE GEN RUNNING'>RBS PORTABLE GEN RUNNING</option>";
                echo "<option value='RBS RBS GEN TRANSFER SW OPERATED'>RBS RBS GEN TRANSFER SW OPERATED</option>";
                echo "<option value='RBS LTE RRU AT DC SYS SPD'>RBS LTE RRU AT DC SYS SPD</option>";
                echo "<option value='RBS BATT ON DISCHARGE'>RBS BATT ON DISCHARGE</option>";
                echo "<option value='RBS FIF PDU FUSE FAIL'>RBS FIF PDU FUSE FAIL</option>";
                echo "<option value='RBS BATT BKR FUSE DISCONNECT'>RBS BATT BKR FUSE DISCONNECT</option>";
                echo "<option value='RBS COMMERCIAL POWER FAIL'>RBS COMMERCIAL POWER FAIL</option>";
                echo "<option value='RBS PWR AC SPD'>RBS PWR AC SPD</option>";
                echo "<option value='RBS POWER UNCONVERTER CR'>RBS POWER UNCONVERTER CR</option>";
                echo "<option value='RBS POWER UNCONVERTER MJ'>RBS POWER UNCONVERTER MJ</option>";
                echo "<option value='RBS GENERATOR FUEL LOW'>RBS GENERATOR FUEL LOW</option>";
                echo "<option value='RBS GENERATOR SHUT DOWN'>RBS GENERATOR SHUT DOWN</option>";
                echo "<option value='RBS GENERATOR MJ'>RBS GENERATOR MJ</option>";
                echo "<option value='RBS DOOR OPEN'>RBS DOOR OPEN</option>";
                echo "<option value='RBS GENERATOR FUEL LEAK'>RBS GENERATOR FUEL LEAK</option>";
                echo "</select>";
                echo '</td>';
                echo '<td>';
                echo "<select name='ports{$i}'>";
                echo "<option value='MAJOR' style='color: orange;'>MAJOR</option>";
                echo "<option value='MINOR' style='color: green;'>MINOR</option>";
                echo "<option value='CRITICAL' style='color: red;'>CRITICAL</option>";
                echo "</select>";
                echo '</td>';
                echo '<td>';
                echo "<input type='checkbox' name='radio{$i}'>";
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </table>

        <button type="submit" class="custom-button">Generate Script</button>

        <!-- Move the link to the bottom -->
        <div class="download-link">
            <?php
            if (isset($filename)) {
                echo "<p>Download Script: <a href='{$filename}' download>{$filename}</a></p>";
            }
            ?>
        </div>
    </form>
</body>
</html>

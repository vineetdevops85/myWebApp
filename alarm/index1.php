<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $alarmStrings = [];

    // Loop through each row
    for ($i = 1; $i <= 16; $i++) {
        $port = $_POST["port{$i}"];
        $radio = isset($_POST["radio{$i}"]) ? $_POST["radio{$i}"] : '';
        $siteId = isset($_POST["siteId{$i}"]) ? $_POST["siteId{$i}"] : ''; // Initialize $siteId

        // Check if the radio button is ticked
        if ($radio == 'on') {
            $dropdownValue = $_POST["port{$i}"];
            $alarmStrings[] = "cmedit set SubNetwork=ONRM_ROOT_MO,SubNetwork={$siteId},MeContext={$siteId},ManagedElement=1,SAUPort={$i} userlabel={$dropdownValue}";
        }
    }

    // Generate a unique filename
    $filename = 'generated_strings_' . date('YmdHis') . '.txt';

    // Write the strings to the file
    file_put_contents($filename, implode(PHP_EOL, $alarmStrings));
}
?>

<?php
include 'dbconfig.php';

if(isset($_POST['submit']))
{
    // echo '<pre>';
    // print_r($_FILES);
    foreach ($_FILES['doc'] ['name'] as $key=>$val)
    {
        move_uploaded_file($_FILES['doc']['tmp_name'][$key],'media/'.$val);
    
        $query = "INSERT INTO upload (file_path) VALUES ('$val')";
        $data = mysqli_query($connection,$query);

        if($data)
        {
            echo "File uploaded to database";
        }
    else
    {
        echo "Failed";
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="#" method="POST" enctype="multipart/form-data">
    <input type="file" name="doc[]" multiple>
    <input type="submit" value="upload" name="submit">
</form>
</body>
</html>
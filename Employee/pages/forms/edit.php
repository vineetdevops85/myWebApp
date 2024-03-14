<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dttracker";

    $connection = new mysqli($servername, $username, $password, $dbname);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT * FROM entry WHERE ID = $id";
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $date = $row['date'];
            $fa = $row['fa'];
            $siteid = $row['siteid'];
            $script_type = $row['script_type'];
            $engg_sup = $row['engg_sup'];
            $radio_type = $row['radio_type'];
            $description = $row['description'];
            $comments = $row['comments'];
            $status = $row['status'];
            $veri_engg = $row['veri_engg'];
            $market = $row['market'];
            $file_paths = $row['file_paths'];
        } else {
            echo "Entry not found!";
            exit();
        }
    } else {
        echo "Invalid request!";
        exit();
    }

    // Fetch engineers, radio models, script types, market names from their respective tables
$engg_sup_query = "SELECT * FROM engg";
$engg_sup_result = mysqli_query($connection, $engg_sup_query);

$veri_engg_query = "SELECT * FROM engg";
$veri_engg_result = mysqli_query($connection, $veri_engg_query);

$radio_type_query = "SELECT * FROM radio";
$radio_type_result = mysqli_query($connection, $radio_type_query);

$script_type_query = "SELECT * FROM script";
$script_type_result = mysqli_query($connection, $script_type_query);

$market_name_query = "SELECT * FROM market";
$market_name_result = mysqli_query($connection, $market_name_query);

$status_options = ["Pending", "Approved", "Rejected"]; // Replace with your actual options
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label>Market</label>
                <select class="form-control select2" style="width: 100%;" name="market" required>
                    <?php while ($market_name_row = mysqli_fetch_assoc($market_name_result)): ?>
                        <?php
                            $selected = ($market_name_row['market_name'] == $market) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $market_name_row['market_name']; ?>" <?php echo $selected; ?>>
                            <?php echo $market_name_row['market_name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>FA Location</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $fa; ?>" name="fa" required>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Site ID</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $siteid; ?>" placeholder="Enter Site ID" name="siteid" required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Date:</label>
                    <div class="input-group date" id="reservationdate" required>
                    <input type="date" class="form-control" name="date" value="<?php echo $date; ?>">
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <!-- <div class="input-group-text"><i class="fa fa-calendar"></i></div> -->
                        </div>
                    </div>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- SELECT2 EXAMPLE -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Scripting Details</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label>Scripting Type</label>
                <select class="form-control select2bs4" style="width: 100%;" name="script_type" required>
                    <?php while ($script_type_row = mysqli_fetch_assoc($script_type_result)): ?>
                        <?php
                            $selectedScriptType = ($script_type_row['script_type'] == $script_type) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $script_type_row['script_type']; ?>" <?php echo $selectedScriptType; ?>>
                            <?php echo $script_type_row['script_type']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Description (SOW)</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $description; ?>" placeholder="Enter Scripting discription" name="description" required>
                </div>
                <label>Attach RFDS and RETCIQ</label>
                <div class="custom-file">
                <a href="../forms/media/<?php echo $file_paths; ?>" target="_blank"><?php echo $file_paths; ?></a>
                      <!-- <label class="custom-file-label" for="customFile">Choose file</label> -->
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                <label>Radio/RET/TMA</label>
                <select class="form-control select2bs4" style="width: 100%;" name="radio_type" required>
                    <?php while ($radio_type_row = mysqli_fetch_assoc($radio_type_result)): ?>
                        <?php
                            $selectedRadioType = ($radio_type_row['radio_model'] == $radio_type) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $radio_type_row['radio_model']; ?>" <?php echo $selectedRadioType; ?>>
                            <?php echo $radio_type_row['radio_model']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Comments (if any)</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $comments; ?>" placeholder="Enter Comments" name="comments">
                </div>
                <label>Attach Screenshot</label>
                <div class="custom-file">
                      <input type="file" name="doc1[]" required multiple>
                      <!-- <label class="custom-file-label" for="customFile">Choose file</label> -->
                </div>
                    
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          
        </div>
        <!-- /.card -->

        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Engineer Details</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                <label>Support Engineer</label>
                <select class="form-control select2bs4" style="width: 50%;" name="engg_sup">
                    <?php while ($engg_sup_row = mysqli_fetch_assoc($engg_sup_result)): ?>
                        <?php
                            $selectedEnggSup = ($engg_sup_row['engg'] == $engg_sup) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $engg_sup_row['engg']; ?>" <?php echo $selectedEnggSup; ?>>
                            <?php echo $engg_sup_row['engg']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <div class="form-group">
                <label>Verifying Engineer</label>
                <select class="form-control select2bs4" style="width: 50%;" name="veri_engg">
                    <?php while ($veri_engg_row = mysqli_fetch_assoc($veri_engg_result)): ?>
                        <?php
                            $selectedVeriEngg = ($veri_engg_row['engg'] == $veri_engg) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $veri_engg_row['engg']; ?>" <?php echo $selectedVeriEngg; ?>>
                            <?php echo $veri_engg_row['engg']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-4">
                <div class="form-group">
                <label>Status</label>
<select class="form-control select2bs4" style="width: 50%;" name="status">
    <?php foreach ($status_options as $option): ?>
        <?php
            $selectedStatus = ($option == $status) ? 'selected' : '';
        ?>
        <option value="<?php echo $option; ?>" <?php echo $selectedStatus; ?>>
            <?php echo $option; ?>
        </option>
    <?php endforeach; ?>
</select>

                </div>
                
              </div>
              
            </div>
            <!-- /.row -->
          </div>
        </div>
        <button type="submit" class="btn btn-success">Add Entry</button>
</form>
</body>
</html>
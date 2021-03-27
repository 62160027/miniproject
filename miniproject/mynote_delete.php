<?php
include 'database.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$index_number = $_GET['number'];

?> 

<!DOCTYPE html>
<html>
<head>
<style>
        <?php include "style.css" ?>
    </style>
    
<meta charset="UTF-8">
<title>Page Title</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

</head>
<body>

<div class="container">
<br><br>
<h1 class="text-center"> My Notes </h1>
  <div class="row">
  
    <div class="col">
    </div>
    <div class="col-6">
        <br><br>

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3 text-center"></div>
                    <h5 class="col-md-6 text-center">
                         Edit
                    </h5>
                    <?php 
                        echo '<a href="mynote_confirm_edit.php?number=' . $index_number . '" class="fa fa-save col-md-3 text-center" style="font-size: 2.5em; "></a>'
                    ?> 
                </div>
            </div>

            <div class="card-body card border-primary">
            <div class="row">
               
 
                    <?php 
                        $sql = "SELECT * FROM mynote_data WHERE number = $index_number";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">เรื่อง</label>
                                    <input type="email" class="form-control" value="'. $row["note_header"] .'">
                                </div>';
                            echo '<div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">รายละเอียด</label>
                                    <textarea class="form-control" rows="3">'. $row["note_detail"] .'</textarea>
                                </div>';
                            //echo "เรื่อง:" . [substr($row"note_header"],0,40) . "<br> รายละเอียด: " . substr($row["note_detail"],0,100). "</div>";
                            echo '<div class="col-md-3 text-center"></div>';
                            echo '
                            <div class="card-footer bg-transparent border-success text-center">
                                <a href="mynote_delete.php?number=' . $row['number'] . '" class="far fa-trash-alt col-md-3 text-center" style="font-size: 2.5em;color: red; "></a>
                            </div>   ';
                        }
                        } else {
                        echo "0 results";
                        }
                        $conn->close();
                    ?>

                </div>
            </div>
          
        </div>

    </div>
    
    <div class="col"></div>
</div>

<div class="modal" tabindex="-1" id="myModal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content text-center">
      <div class="modal-body">
        <h1 style="color:red">ลบข้อมูลหรือไม่</h1>
      </div>
      <div class="modal-footer">
        <a href="mynote_edit.php?number=<?=$index_number?>" type="button" class="btn btn-secondary">Dismiss</a> 
        <a href="mynote_confirm_delete.php?number=<?=$index_number?>" type="button" class="btn btn-primary">Confirm</a> 
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(window).on('load', function() {
        $('#myModal').modal({backdrop: 'static', keyboard: false}) ; 

        $('#myModal').modal('show');

    });

</script>

</body>
</html> 
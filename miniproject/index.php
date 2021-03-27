<?php
include 'database.php';

// Create connection
$conn = new mysqli($servername, $username,$password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

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
                         My Notes 
                    </h5>
                        <a href="mynote_insert.php" class="	fas fa-folder-plus col-md-3 text-center" style="font-size: 2.5em; "></a>
                </div>
            </div>

                    <?php 
                        $sql = "SELECT * FROM mynote_data ORDER BY start_date DESC;";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                        // output data of each row
                            while($row = $result->fetch_assoc()) {

                                $timestamp = strtotime($row["start_date"]);
                                
                                echo '<div class="card-body card border-primary" data-bs-toggle="modal" data-bs-target="#content'. $row['number'] .'"> ';
                                echo '<div class="row">';
                                echo '<div class="col-md-6">';
                                echo 'วันที่: ' . '<span class="badge bg-secondary">'. date("d/m/Y", $timestamp) .'</span>' . '<br>';
                                echo "เรื่อง: " . substr($row["note_header"],0,40) . "<br> รายละเอียด: " . substr($row["note_detail"],0,100). "...</div>";
                                echo '<div class="col-md-3 text-center"></div>';
                                echo '<a href="mynote_edit.php?number=' . $row['number'] . '" class="fa fa-edit col-md-3 text-center" style="font-size: 2.5em;"></a>';
                                echo "</div></div>";
                                echo '<!-- Modal -->
                                    <div class="modal fade" id="content'. $row['number'] .'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">เรื่อง: '.$row["note_header"].'</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">รายละเอียด: 
                                            ' .$row["note_detail"].'
                                        </div>
                                        </div>
                                    </div>
                                    </div>';
                            }

                        } else {
                            echo '<div class="card-body card border-primary">';
                            echo '<div class="row">';
                            echo '<div class="col-md-3"></div>';
                            echo '<div class="col-md-6 text-center">ไม่มีข้อมูล</div>';
                            echo '<div class="col-md-3"></div>';

                            echo "</div></div>";
                        }
                        $conn->close();
                    ?>

    
        </div>

    </div>
    
    <div class="col"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
</body>
</html> 
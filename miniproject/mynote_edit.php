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
        <?php echo '<form action="mynote_confirm_edit.php?number=' . $index_number. '"class="needs-validation" method="post" novalidate>'     ?> 
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <a href="index.php" class="btn btn-light fas fa-caret-square-left col-md-3 text-center" style="font-size: 2.5em; "></a>
                        </div>
                        <h5 class="col-md-6 text-center">
                            แก้ไข
                        </h5>
                        <button class="btn btn-light fa fa-save col-md-3 text-center" type="submit" style="font-size: 2.5em; "></button>
                        <?php 
                            //echo '<a type="submit" href="mynote_confirm_edit.php?number=' . $index_number. '" class="fa fa-save col-md-3 text-center" style="font-size: 2.5em; "></a>'
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
                                        <input type="text" class="form-control" value="'. $row["note_header"] .'" name="header" maxlength="10" required>
                                        <div class="invalid-feedback">
                                            กรุณาใส่หัวข้อ
                                        </div>
                                    </div>';
                                echo '<div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">รายละเอียด</label>
                                        <textarea class="form-control" rows="3" name="content" required >'. $row["note_detail"] .'</textarea>
                                        <div class="invalid-feedback">
                                            กรุณาใส่เนื้อหา
                                        </div>
                                    </div>';
                                //echo "เรื่อง:" . [substr($row"note_header"],0,40) . "<br> รายละเอียด: " . substr($row["note_detail"],0,100). "</div>";
                                echo '<div class="col-md-3 text-center"></div>';
                                //<a href="mynote_delete.php?number=' . $row['number'] . '" class="fas fa-trash-alt col-md-3 text-center" style="font-size: 2.5em;color: red; "></a>
                                echo '
                                <div class="card-footer bg-transparent border-success text-center">
                                    <i data-bs-toggle="modal" data-bs-target="#content'. $row['number'] .'" class="fas fa-trash-alt col-md-3 text-center" style="font-size: 2.5em;color: red; "></i>
                                </div>';

                                echo '<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="content'. $row['number'] .'">
                                    <div class="modal-dialog">
                                    <div class="modal-content text-center">
                                        <div class="modal-body">
                                        <h1 style="color:red">ลบข้อมูลหรือไม่</h1>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"  aria-label="Close">Dismiss</button> 
                                            <a href="mynote_confirm_delete.php?number='. $row['number'] .'" type="button" class="btn btn-primary">Confirm</a> 
                                        </div>
                                    </div>
                                    </div>
                                </div>';
                            }
                            } else {
                            echo "0 results";
                            }
                            $conn->close();
                        ?>

                    </div>
                </div>
            
            </div>
        </form>
    </div>
    
    <div class="col"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
<script>
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>

</body>
</html> 
<?php
// Start the session
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Running For Inspiration</title> 
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="/Lab04/styleIndex.css" media="all" rel="stylesheet" type="text/css"/>
 

</head>
<body>
  <?php
    $csvErr = $table= $avgPaceStr ="";
    if(isset($_POST["submit"])){
      $filePath = $_FILES["fileToUpload"]["tmp_name"];
      $fileName = basename($_FILES["fileToUpload"]["name"]);
      $fileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
      $uploadOk = 1;


      if ($_FILES["fileToUpload"]["size"] > 500000) {
        $csvErr = "ไฟล์มีขนาดใหญ่เกินไป";
        $uploadOk = 0;
      }


      if($fileType != "csv" ) {
        $csvErr = "รองรับไฟล์ .csv เท่านั้น";
        $uploadOk = 0;
      }

      if ($uploadOk == 0) {
        $csvErr .= "   ไฟล์ไม่ถูกอัพโหลด";
      } 
      else {
        calculatePace($filePath);
      }
    }
 
    function readCSV($csvFile){
      $file_handle = fopen($csvFile, 'r');
      while (!feof($file_handle) ) {
        $line_of_text[] = fgetcsv($file_handle, 1024);
      }
      fclose($file_handle);
      return $line_of_text;
    }

    function calculatePace($csvFile){
      $csv = readCSV($csvFile);
    
      $times = $distances = $pace = $sumPace =$avgPace= 0;
      $nline = count($csv)-2;
      global $table;
      $table .= "
      <table class=table>
        <tr>
          <th>Hours</th>
          <th>Minutes</th> 
          <th>Seconds</th>
          <th>Distance(km)</th>
          <th>Pace(mins/km)</th>
      </tr>";
      for( $i = 1 ; $i <= $nline ; $i++ ){
        $line = $csv[$i];
        if($csv[0] !== $line){
          $hr = (intval($line[0]));
          $min = (intval($line[1]));
          $sec = (intval($line[2]));
          $distance =(floatval($line[3]));
          $times += $hr*60;
          $times += $min;
          $times += $sec/60;
          $distances += $distance;
          if($distance>0){
            $pace = round(($hr*60 + $min + $sec/60 )/$distance,2);
          }
          else{
            $pace = 0;
          }
          $sumPace+=$pace;
          $table .="
            <tr>
              <td>".$hr."</td>
              <td>".$min."</td> 
              <td>".$sec."</td>
              <td>".$distance."</td> 
              <td>".floatval($pace)."</td>
            </tr>
          ";
        }

        
      }
      
      $avgPace =round($sumPace/$nline,2) ;
      global $avgPaceStr;
      $avgPaceStr =  "เพซการวิ่งเฉลี่ยของคุณคือ : " .$avgPace." mins/km";
      $table .= "</table>";
    }      
  ?>
  
  
  <div class="container">
    <div class="row container-header">
      <br><br><br>
      <div class ="col-2 plain"></div>
      <div class ="col-8 header"><h1 class="text-center"><br><br>RUN FOR INSPIRATION<br><br></h1></div>
      <div class ="col-2 plain"></div>
    </div>
    <div class="row container-header">
      <div class ="col-5 plain"></div>
      <div class ="col-2">
        <form action="01.php">
        <input type="submit" value="REGISTER" />
        </form>
      </div>
      <div class ="col-5 plain"></div>
    </div>
    <div class="row"></div>
    <div class="row container-body">
      <div class ="col-2 plain"></div>
      <div class ="col-8 header">
        <form  method="post" enctype="multipart/form-data">
          <h2 class="text-center">คำนวณ RUNNING PACE</h2>    
          <a class="text-center" href="csv_downloads/paceCalculate.csv">DOWNLOAD CSV FORMAT</a>
          <br><br>
          <span><p>อัพโหลด CSV:</p></span>
          <span class="error"> <?php echo $csvErr;?></span>
          <br><br>
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="submit" value="Upload CSV" name="submit">
        </form>
        <br><br>
        <h4><?php echo $avgPaceStr; ?><h4>
        <h6><?php echo $table; ?></h6>
        <br><br><br>
      </div>
      <div class ="col-2 plain"></div>
    </div>
</div>
  


  

  

</body>
</html>
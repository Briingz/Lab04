<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register History</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="/Lab04/style02.css" media="all" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="container">    
    <div class="row container-header">
        <br><br><br>
        <div class ="col-2 plain"></div>
        <div class ="col-8 header"><h1 class="text-center">ประวัติการสมัคร</h1></div>
        <div class ="col-2 plain"></div>
    </div>

 
    <?php
        
        $firstname = isset($_SESSION['firstname'])?$_SESSION['firstname']:"";
        $lastname = isset($_SESSION['lastname'])?$_SESSION['lastname']:"";
        $birthdate = isset($_SESSION['birthdate'])?$_SESSION['birthdate']:"";
        $email = isset($_SESSION['email'])?$_SESSION['email']:"";
        $gender = isset($_SESSION['gender'])?$_SESSION['gender']:"";
        $phone = isset($_SESSION['phone'])?$_SESSION['phone']:"";
        $runtype = isset($_SESSION['runtype'])?$_SESSION['runtype']:"";
        $ticketprice = isset($_SESSION['ticketprice'])?$_SESSION['ticketprice']:"";
        $clothsize = isset($_SESSION['clothsize'])?$_SESSION['clothsize']:"";
        $deliveryType = isset($_SESSION['deliveryType'])?$_SESSION['deliveryType']:"";
        //$profilepic = isset($_SESSION['target_file'])?$_SESSION['target_file']:"pic_uploads/user.jpg";
    ?>
    
    <?php
    
    $profilePic ="pic_uploads/user.jpg";
    $pictureErr ="";
    if(isset($_POST["uploadPic"])){
        $target_dir = "pic_uploads/";
        $filePath = $_FILES["fileToUpload"]["tmp_name"];
        $fileName = basename($_FILES["fileToUpload"]["name"]);
        $fileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
        $target_file = $target_dir."user_profile.".$fileType;
        $uploadOk = 1;
    
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $pictureErr = "ไฟล์มีขนาดใหญ่เกินไป";
            $uploadOk = 0;
        }
    

        if($fileType != "jpg"  && $fileType != "jpeg" ) {
            $pictureErr = "รองรับไฟล์ .jpg หรือ .jpeg เท่านั้น";
            $uploadOk = 0;
        }
    
        if ($uploadOk == 0) {
            $pictureErr .= "   ไฟล์ไม่ถูกอัพโหลด";
        } 
        else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $profilePic = $target_file;
                
            } else {
                $pictureErr = "Sorry, there was an error uploading your file.";
            }
        }
    }
    ?>
    <div class="row container-picture">
        <br><br><br>
        <div class ="col-2 plain"></div>
        <div class ="col-8 header">
            <img src="<?php echo $profilePic; ?>" >
            <form  method="post" enctype="multipart/form-data">
                <br><br>
                <span>อัพโหลดรูป PROFILE:</span>
                <span class="error"> <?php echo $pictureErr;?></span>
                <br><br>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload picture" name="uploadPic">
            </form><br><br>
        </div>
        <div class ="col-2 plain"></div>
    </div>

    <br><br><br>
    <div class="row container-body">
        <br><br><br>
        <div class ="col-2 plain"></div>
        <div class ="col-8 header">
        <?php
        
            echo "<h4>ข้อมูลส่วนตัว<h4>";
            echo "<h5>คุณ ".$firstname."   ".$lastname."<h5>";
            //echo "<br>";
            echo "<h5>วัน/เดือน/ปี เกิด : ".$birthdate."<h5>";
            //echo "<br>";
            echo ($gender === "female")?"<h5>เพศ : หญิง":"<h5>เพศ : ชาย"."<h5>";
            echo "<br><br>";

            echo "<h4>ข้อมูลการติดต่อ<h4>";
            echo "<h5>E-mail : ".$email."<h5>";
            echo "<h5>เบอร์โทรศัพท์ : ".$phone."<h5>";
            echo "<br><br>";
        
            echo "<h4>ข้อมูลการสั่งซื้อ<h4>";
            echo "<h5>ประเภทการวิ่ง : ".strtoupper($runtype)."<h5>";
            echo "<h5>ราคาบัตร : ".$ticketprice." บาท <h5>";
            echo "<h5>ไซส์เสื้อ : ".strtoupper($clothsize)."<h5>";
            echo "<br>";
            echo ($deliveryType === "ems")?"<h5>การจัดส่ง : EMS <h5>":"<h5>การจัดส่ง : มารับเอง <h5>";
            echo "<br>";
        ?>
        </div>
        <div class ="col-2 plain"></div>
    </div>
    <div class="row container-footer">
        <br><br><br>
        <div class ="col-5 plain"></div>
        <div class ="col-2 header">
            <form action=
            <?php      
                echo "index.php";
            ?>>
                <input type="submit" value="หน้าหลัก" name="mainpage"/>
            </form>
        </div>
        <div class ="col-5 plain"></div>
    </div>
    <br><br><br>
  





</div>
  


</body>
</html>

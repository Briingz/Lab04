<?php
// Start the session
session_start();
?>

<!DOCTYPE HTML>  
<html>
<head>
<title>Register Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="/Lab04/style01.css" media="all" rel="stylesheet" type="text/css"/>
</head>
<body>



<?php

     // define variables and set to empty values
     $firstname = $lastname = $birthdate = $email = $gender = $phone = 
     $runtype = $ticketprice = $clothsize = $deliveryType = "";
     // define error check variable;
   
     // error show messages
     $firstnameErr = $lastnameErr = $birthdateErr = $emailErr = $genderErr = $phoneErr = 
     $runtypeErr = $ticketpriceErr = $clothsizeErr = $deliveryTypeErr = 
     $addr_nameErr = $addr_addressErr = $addr_codeErr = $addr_phoneErr =
     $pictureErr = "";
     $formcorrect = "";
     
     /*$correctform = false;*/
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(
      empty($_POST["firstname"])){$firstnameErr="กรุณากรอกชื่อ";
    }
    else{
      $firstname = test_input($_POST["firstname"]);
      if (preg_match('/^\p{Thai}*$/u', $firstname) !== 1 ) {
        $firstnameErr="กรุณากรอกชื่อเป็นภาษาไทย";
      }
      else{
        $_SESSION['firstname']=$firstname;
      }
    }
    if(empty($_POST["lastname"])){$lastnameErr="กรุณากรอกนามสกุล";}
    else{
      $lastname = test_input($_POST["lastname"]);
      if (preg_match('/^\p{Thai}*$/u', $lastname) !== 1 ) {
        $lastnameErr="กรุณากรอกนามสกุลเป็นภาษาไทย";
      }
      else{
        $_SESSION['lastname']=$lastname;
      }
    }

    if(empty($_POST["birthdate"])){$birthdateErr="กรุณาเลือกวันเดือนปีเกิด";}
    else{
      $birthdate = test_input($_POST["birthdate"]);
      $_SESSION['birthdate']=$birthdate;
    }

    if(empty($_POST["email"])){$emailErr="กรุณากรอกE-mail";}
    else{
      $email = test_input($_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "E-mail ไม่ถูกต้อง"; 
      }
      else{
        $_SESSION['email']=$email;
      }
    }

    if(empty($_POST["gender"])){$genderErr="กรุณาเลือกเพศ";}
    else{
      $gender = test_input($_POST["gender"]);
      $_SESSION['gender']=$gender;
    }

    if(empty($_POST["phone"])){$phoneErr="กรุณากรอกเบอร์โทรศัพท์";}
    else{
      $phone = test_input($_POST["phone"]);
      if (preg_match("/^[0][689][0-9]{8}$/", $phone) !== 1) {
      $phoneErr = "เบอร์โทรศัพท์ ไม่ถูกต้อง"; 
      }
      else{
        $_SESSION['phone']=$phone;
      }
    }

    if(empty($_POST["runtype"])){$runtypeErr="กรุณาเลือกประเภทการวิ่ง";}
    else{
      $runtype = test_input($_POST["runtype"]);
      $_SESSION['runtype']=$runtype;
      if(empty($_POST["ticketprice"])){$ticketpriceErr="กรุณาเลือกราคาบัตร";}
      else{
        $ticketprice = test_input($_POST["ticketprice"]);
        $_SESSION['ticketprice']=$ticketprice;
      }
      
    }

    if(empty($_POST["clothsize"])){$clothsizeErr="กรุณาเลือกไซส์เสื้อ";}
    else{
      $clothsize = test_input($_POST["clothsize"]);
      $_SESSION['clothsize']=$clothsize;
    }

    if(empty($_POST["deliveryType"])){$deliveryTypeErr="กรุณาเลือกรูปแบบการรับสินค้า";}
    else{
      $deliveryType = test_input($_POST["deliveryType"]);
      $_SESSION['deliveryType']=$deliveryType;
    }
    

  }
  /*global $correctform;
  $correctform = (isset($_SESSION['firstname']) &&
                  isset($_SESSION['lastname'])  &&
                  isset($_SESSION['birthdate']) &&
                  isset($_SESSION['email']) &&
                  isset($_SESSION['gender'])  &&
                  isset($_SESSION['phone']) &&
                  isset($_SESSION['runtype']) &&
                  isset($_SESSION['ticketprice'])  &&
                  isset($_SESSION['clothsize']) &&
                  isset($_SESSION['deliveryType'])   );*/
  

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  //echo "TEST=".$correctform."\n";

?>




<div class="container">
    <div class="row container-header">
      <br><br><br>
      <div class ="col-2 plain"></div>
      <div class ="col-8 header">
        <h1 class="text-center">สมัครเข้าร่วมงานวิ่ง</h1>
        <h1 class="text-center">RUN FOR INSPIRATION</h1>
        </div>
      <div class ="col-2 plain"></div>
    </div>
    <div class="row container-body">
      <div class ="col-2 plain"></div>
      <div class ="col-8 header">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">   
        <div>
        <h4>ข้อมูลส่วนตัว</h4>
        <span>
        <h5>ชื่อ:</h5>
          <input type="text" name="firstname">
          <span class="error"> <?php echo $firstnameErr;?></span>
        </span>
        <span>
          <h5>สกุล:</h5> 
          <input type="text" name="lastname">
          <span class="error"> <?php echo $lastnameErr;?></span>
        </span>
        <br><br>
        <h5>วัน/เดือน/ปี เกิด:</h5>
        <input type="date" name="birthdate" min="1939-01-01" max="2004-01-01">
        <span class="error"> <?php echo $birthdateErr;?></span>
        <br><br>
        <h5>เพศ:</h5>
        <input type="radio" name="gender" value="female">หญิง
        <input type="radio" name="gender" value="male">ชาย
        <span class="error"> <?php echo $genderErr;?></span>
        <br><br><br><br>
        <h4>ข้อมูลการติดต่อ</h4>
        <h5>E-mail:</h5>
        <input type="text" name="email">
        <span class="error"> <?php echo $emailErr;?></span>
        <br><br>
        <h5>เบอร์โทรศัพท์:</h5>
        <input type="number" name="phone">
        <span class="error"> <?php echo $phoneErr;?></span>
        
      </div>
      <br><br><br><br>
      <h4>ข้อมูลงานวิ่ง</h4>
      <span>
        <h5>ประเภทการวิ่ง:</h5>
        <select name="runtype" id="runtypeselector" >
          <option class="empty"  value="empty" selected></option>
          <option class="funrun" value="funrun">FunRun ระยะทาง 5 km</option>
          <option class="mini"   value="mini">Mini Marathon ระยะทาง 10 km</option>
          <option class="half"   value="half">Half Marathon ระยะทาง 21 km</option>
          <option class="full"   value="full">Marathon ระยะทาง 42 km</option>
        </select>
        <span class="error"> <?php echo $runtypeErr;?></span>
      </span>        

      <span id="ticket-type" style="display:none;">
        <h5>ประเภทบัตร:</h5>
        <select name="ticketprice" id="ticketpriceSelector" [single]>
          <option class="empty"     value="empty" selected></option>
          <option class="funrun"    value="400">FunRun ปกติ 400 บาท</option>        
          <option class="funrun"    value="1000">FunRun Premium 1000 บาท</option>
          <option class="mini"      value="500">Mini Marathon ปกติ 500 บาท</option>
          <option class="mini"      value="1000">Mini Marathon Premium 1000 บาท</option>
          <option class="half"      value="700">Half Marathon ปกติ 700 บาท</option>
          <option class="half"      value="1500">Half Marathon Premium 1500 บาท</option>
          <option class="full"      value="800">Marathon ปกติ 800 บาท</option>
          <option class="full"      value="1500">Marathon Premium 1500 บาท</option>  
        </select>
        <span class="error"> <?php echo $ticketpriceErr;?></span>
      </span>
      <br><br>
      <div>
      <h5>ไซส์เสื้อ:</h5>
        <select name="clothsize" [single]>
          <option class="empty" value="" selected></option>
          <option value="ss" >size SS  รอบอก 36" ยาว 25"</option>
          <option value="s"  >size S   รอบอก 38" ยาว 26"</option>
          <option value="m"  >size M   รอบอก 40" ยาว 27"</option>
          <option value="l"  >size L   รอบอก 42" ยาว 28"</option>
          <option value="xl" >size XL  รอบอก 44" ยาว 29"</option>
          <option value="xxl">size XXL รอบอก 46" ยาว 30"</option>
        </select>
        <span class="error"> <?php echo $clothsizeErr;?></span>
      </div>
      <br><br>
      <div>
      <h5>ประเภทการจัดส่ง:</h5>
        <input type="radio" name="deliveryType" id="deliveryType-ems"  value="ems">EMS +60 บาท
        <input type="radio" name="deliveryType"                        value="getYourOwn">มารับเอง
        <span class="error"> <?php echo $deliveryTypeErr;?></span>
      </div>

      <br><br><br>
      <div class ="row">
      <div class = "col-4"></div>
        <div class = "col-4">
          <input type="submit"  name="submit" value="ตรวจสอบข้อมูล"> 
          <span class="correct"> <?php    
          if((isset($_SESSION['firstname']) && isset($_SESSION['lastname'])  &&
            isset($_SESSION['birthdate']) &&  isset($_SESSION['email']) &&
            isset($_SESSION['gender'])  &&  isset($_SESSION['phone']) &&
            isset($_SESSION['runtype']) &&  isset($_SESSION['ticketprice'])  &&
            isset($_SESSION['clothsize']) && isset($_SESSION['deliveryType'])  )){ 
              $correctform = "ข้อมูลถูกต้องครบถ้วน กรุณากด Register";
          }
          else if( $firstnameErr =="" && $lastnameErr == "" && $birthdateErr == ""&& 
                   $emailErr =="" && $genderErr =="" && $phoneErr =="" && $runtypeErr ==""&&
                  $ticketpriceErr ==""  && $clothsizeErr =="" && $deliveryTypeErr == "" && 
                  $addr_nameErr ==""  && $addr_addressErr =="" && $addr_codeErr =="" &&
                  $addr_phoneErr == "" ){
            $correctform = "";
          }
          else{
            $correctform = "ข้อมูลไม่ถูกต้อง หรือไม่ครบถ้วน กรุณากรอกใหม่";
          }
          echo $correctform
          ?></span>
        </div>
      </div>
       
      <br><br><br>
    </form>
    <div class= "row">
      <div class = "col-4"></div>
        <div class = "col-4"> 
          <form action="<?php 
          if((isset($_SESSION['firstname']) && isset($_SESSION['lastname'])  &&
            isset($_SESSION['birthdate']) &&  isset($_SESSION['email']) &&
            isset($_SESSION['gender'])  &&  isset($_SESSION['phone']) &&
            isset($_SESSION['runtype']) &&  isset($_SESSION['ticketprice'])  &&
            isset($_SESSION['clothsize']) && isset($_SESSION['deliveryType'])  )){ 
            echo "02.php";}
          else{
            echo htmlspecialchars($_SERVER["PHP_SELF"]);} 
          ?>">
            <input type="submit" value="REGISTER" />
          </form>
        </div>
      </div>
    </div>

        
      </div>
      <div class ="col-2 plain"></div>
    </div>
</div>


















<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


<script>
  $(document).ready(function() {
    $("#runtypeselector").on("change",function(){
      document.getElementById("ticket-type").style.display="";
      $("#ticket-type").val("empty");
      var className = $('#runtypeselector').find('option:selected').attr('class');
      console.log(className);
      if(className == "empty"){
        document.getElementById("ticket-type").style.display="none";
      }
      else{
        $('#ticketpriceSelector option').each(function () {
          var self = $(this);
          if (self.hasClass(className) || self.hasClass("empty")) {
            $("#ticket-type").val("empty");
            self.show();
          } 
          else {
            self.hide();
          }
        });
      }          
    });
  });
</script>

</body>
</html>

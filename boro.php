<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./imagesbg/.jpeg" type="image/x-jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="./formstyle.css" rel="stylesheet">
    <link href="./fstyle.js" rel="JavaScript">
    <title>Borrow</title>
</head>
<body>
  <!-- <section class="Hi"> -->
    <div class="navbar1">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand active" href="welcome.html">My<span style="color: rgb(51, 255, 0);">Library</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="know.html">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cont.html">Feedback</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  
<form class="signup-form" method="post">
<!-- form header -->
<div class="form-header">
    <h1>Borrow books</h1>
  </div>
  <!-- form body -->
<div class="form-body">

    <!-- Firstname and Lastname -->
    <div class="horizontal-group">
        <div class="form-group left">
            <label for="firstname" class="label-title">First name *</label>
            <input type="text" name="firstname" class="form-input" placeholder="enter your first name" required="required" />
        </div>
        <div class="form-group right">
            <label for="lastname" class="label-title">Last name</label>
            <input type="text" name="lastname" class="form-input" placeholder="enter your last name" />
        </div>
    </div>

</div>
<!-- Email -->
<div class="form-group">
    <label for="email" class="label-title">Email*</label>
    <input type="email" name="email" class="form-input" placeholder="enter your email" required="required">
  </div>
  <p></p>
  

  <!-- Gender and Hobbies -->
<div class="horizontal-group">

    <div class="form-group left">
        <label class="label-title">Preference:</label>
        <div class="input-group">
            <label for="Buy">
                <input type="radio" name="preference" value="Bought" > Buy</label>
            <label for="rent">
                <input type="radio" name="preference" value="Rented"> Rent</label>
        </div>
    </div>

    
    
</div>
<p></p>
 
 <!-- Profile picture and Age -->
 <div class="horizontal-group">

    <div class="form-group left" >
      <label for="Address" class="label-title">Address</label>
      <textarea class="form-input" name="address" cols="30" rows="4" style="height: auto;"></textarea>
    </div>
    
    <div class="form-group right">
      <label for="experience" class="label-title">No.of Copies</label>
      <input type="number" name="num" min="1" max="1000"  value="1" class="form-input">
    </div>
    <?php
    $servername = "localhost:3308";
    $username = "root";
    $password = "";
    $dbname = "awd_project";
    $conn = new mysqli($servername, $username, $password, $dbname);
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            };  
     $sql="SELECT Books FROM library_database";   
     $result=$conn->query($sql);    
    ?>
  </div>
  <p></p>
  <!-- Bio -->
  <div class="form-group">
    <label for="choose-file" class="label-title">Book's name and description:</label>
    <select name="option">
    <?php 
                while ($category = mysqli_fetch_array($result,MYSQLI_ASSOC)):; ?>
                <option value="<?php echo $category["Books"]; ?>">
                    <?php echo $category["Books"];   ?>
                </option>
            <?php 
                endwhile; 
            ?>
    </select>
  </div>
  
 
<div class="form-footer">

    <button type="submit" class="btn" onclick="myfunction()">Borrow</button>
    <script>
      function myfunction(){
        alert('Thank you for landing here your response has been recored')
      }
      </script>
  </div>
    </form>
     <?php
    $bok= $_POST['option'];
    $fn = $_POST['firstname'];
    $ln = $_POST['lastname'];
    $e= $_POST['email'];
    $p= $_POST['preference'];
    $add= $_POST['address'];
    $num =$_POST['num'];
    if(isset($_POST['firstname']))
        {
    $sql="INSERT INTO user_b (Firstname,Lastname,Email,Address,Book,No_of_Copies,Book_Status) VALUES ('$fn','$ln','$e','$add','$bok','$num','$p')";
    if ($conn->query($sql) === TRUE) {
      $sql= "SELECT Books FROM library_database where Books='$bok'";
                $result=$conn->query($sql);
                if($result->num_rows>0)
                {
                    $sql = "UPDATE library_database SET Copies_Available = Copies_Available-'$num',Copies_Borrowed=Copies_Borrowed+'$num' WHERE Books='$bok'";
                    $result=$conn->query($sql);
                    
                }
                else
                {
                    $sql = "INSERT INTO library_database (Books,Copies_Available) VALUES ('$book','$num')";
                    $result=$conn->query($sql);
                }
  } 	
  else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
} 
     

?> -->
</body>
</html>
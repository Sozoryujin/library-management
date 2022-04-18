<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./imagesbg/book.jpeg" type="image/x-jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="./formstyle.css" rel="stylesheet">
    <link href="./fstyle.js" rel="JavaScript">
    <title>Donate</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="welcome.html">My<span style="color: rgb(0, 255, 26);">Library</span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="know.html">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cont.html">Feedback</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
    <form class="signup-form" method="post">
<!-- form header -->
<div class="form-header">
    <h1>Donate books</h1>
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
            <input type="text" name="lastname" class="form-input" placeholder="enter your last name" required="required" />
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
        <label class="label-title">Cover:</label>
        <div class="input-group">
            <label for="Hardcover">
                <input type="radio" name="cov" value="Hardcover" id="Hardcover"> Hardcover </label>
            <label for="Softcover">
                <input type="radio" name="cov" value="Softcover" id="Softcover" required="required"> Softcover</label>
        </div>
    </div>

    
    
</div>
<p></p>
 
 <!-- Profile picture and Age -->
 <div class="horizontal-group">

    <div class="form-group left" >
      <label for="choose-file" class="label-title">Upload Book's Picture</label>
      <input type="file" name="pic" size="80" >
    </div>
    
    <div class="form-group right">
      <label for="experience" class="label-title">No.of Copies</label>
      <input type="number" name="num" min="1" max="1000"  value="1" placeholder="Choose No. of Copies" class="form-input" required = "required">
    </div>
  
  </div>
  <p></p>
  <!-- Bio -->
<div class="form-group">
    <label for="choose-file" class="label-title">Book's name and description:</label>
    <textarea class="form-input" name="desc" rows="4" cols="50" style="height:auto" required = "required"></textarea>
  </div>
  <p></p>
  <!-- form footer -->
<div class="form-footer">
    <!-- <a href="./thanks.html" -->
    <button type="submit" onclick="myfunction()" class="btn"  >Donate</button>
    <script> 
    function myfunction(){
      alert('Thank you for landing here,your response has been recorded')
    }
  </script>
    <!-- </a> -->
  </div>
    </form>
    <?php
    $target_dir = "BookPhotos/";
    $target_file = $target_dir . basename($_FILES["pic"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
    $fn = $_POST['firstname'];
    $ln = $_POST['lastname'];
    $e= $_POST['email'];
    $cov= $_POST['cov'];
    $num= $_POST['num'];
    $book =$_POST['desc'];
    $servername = "localhost:3308";
	    $username = "root";
        $password = "";
        $dbname = "awd_project";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
	    if ($conn->connect_error) {
  		    die("Connection failed: " . $conn->connect_error);
        }
        if(isset($_POST['firstname']))
        {
            $sql = "INSERT INTO users_donated (First_Name, Last_Name,Email,Cover,Book,No_of_Copies) VALUES ('$fn', '$ln', '$e','$cov','$book','$num')";
		    if ($conn->query($sql) === TRUE) {
                $sql= "SELECT Books FROM library_database where Books='$book'";
                $result=$conn->query($sql);
                if($result->num_rows>0)
                {
                    $sql = "UPDATE library_database SET Copies_Available = Copies_Available+'$num' WHERE Books='$book'";
                    $result=$conn->query($sql);
                    
                }
                else
                {
                    $sql = "INSERT INTO library_database (Books,Copies_Available,Copies_Borrowed) VALUES ('$book','$num','0')";
                    $result=$conn->query($sql);
                }
        
		    } 	
		    else {
  			    echo "Error: " . $sql . "<br>" . $conn->error;
		    }
        }
      
?>
</body>
</html>
<?php
$flag=0;
include("../db/dbconfig.php");

if(isset($_POST['submit']))
{
  $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $contact=$_POST['contact'];
  $email=$_POST['email'];
  $city=$_POST['city'];
  $username=$_POST['username'];
  $password=$_POST['password'];
  $cpassword=$_POST['cpassword'];

  if($password!=$cpassword)
  {
    $flag=1;
    ?>
    <script type="text/javascript">
      alert("passwords do not match!");
    </script>
    <?php
  }

  //second condition checking existence of email in database.
  $e="SELECT * FROM USER WHERE email='$email'";
  $eres=mysqli_query($conn,$e);
  $ec=mysqli_num_rows($eres);
  if($ec>0)
  {
    $flag=1;
    ?>
    <script type="text/javascript">
      alert("User With same email already exists");
      window.location="../signup/";
    </script>
    <?php
  }

  //third condition checking existence of phone number in database.
  $p="SELECT * FROM USER WHERE contact='$contact'";
  $pres=mysqli_query($conn,$p);
  $pc=mysqli_num_rows($pres);
  if($pc>0)
  {
    $flag=1;
    ?>
    <script type="text/javascript">
      alert("User With same contact number already exists");
      window.location="../signup/";
    </script>
    <?php
  }

  //fourth condition checking existence of username in database.
  $u="SELECT * FROM USER WHERE username='$username'";
  $ures=mysqli_query($conn,$u);
  $uc=mysqli_num_rows($ures);
  if($uc>0)
  {
    $flag=1;
    ?>
    <script type="text/javascript">
      alert("User With same username already exists");
      window.location="../signup/";
    </script>
    <?php
  }

  $iq="INSERT INTO user (fname,lname,contact,email,city,username,password) VALUES('$fname','$lname','$contact','$email','$city','$username','$password')";
  if($flag==0)
  {
    $r= mysqli_query($conn,$iq);
  }
  else
  {
    alert("Failed!");

  }
  
   if($r)
  {
    ?>
    <script type="text/javascript">
      alert("Registered!");
      window.location="../";
    </script>
      <?php
  }

  else
  {
    ?>
    <script type="text/javascript">
      alert("Failed!");
      window.location="../signup/";
    </script>
      <?php
  }
}
?>

<html>
<head>
<title>unseen</title>
<meta charset="utf-8"/>
<link rel="stylesheet" href="style_homie.css" type="text/css" />
<link rel="stylesheet" href="style_slider.css" type="text/css" />
<link rel="stylesheet" href="footer.css" type="text/css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- end -->
  <!-- fontawesome cdn -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

<style>
.signup{
  width:70%;
}
#fname,#lname,#contact,#city,#username,#email{
  width:70%;
  height:auto;
  padding: 12px 20px;
  box-sizing: border-box;
  border-radius: 10px;
  display:inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  margin:0% 35% 3% 35%;
}
#password,#cpassword{
  width:70%;
  height:auto;
  padding: 12px 20px;
  box-sizing: border-box;
  border-radius: 10px;
  display:inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  margin:0% 35% 3% 35%;
}
#signup{
  width:70%;
  cursor: pointer;
  padding: 12px 20px;
  color:white;
  border-radius: 10px;
  border: 1px solid #ccc;
  margin:0% 35% 2% 35%;
  background-color: #4CAF50;
  border:none;
}
button:hover {
    opacity: 0.8;
}

</style>

<meta name="viewport" content="width-device-width, initial scale=1.8">
</head>
<body bgcolor="white">

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">broCODE</a>
        </div> 
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                        <li><a href="../">Home</a></li>
                        <li><a href="../login/">Login</a></li>
                    </ul>
                  </li>

            </ul>
        </div>
</div>
</nav>

<div class="signup" style="margin-top: 70px;">
  <form method="POST">
  <div>
  <input type="text" id="fname" name="fname" placeholder="First name" required>
</div>
<div>
  <input type="text" id="lname" name="lname" placeholder="Last name" required>
</div>
<div>
  <input type="number" id="contact" name="contact" minlength="10" placeholder="Contact number" required>
</div>
<div>
  <input type="text" id="email" name="email" placeholder="Email" required>
</div>
<div>
    <select name="city" class="form-control" id="city">
      <option value="null" disabled selected>Choose Your City</option>
      <option value="1">Mumbai</option>
      <option value="2">Delhi</option>
      <option value="3">Bangalore</option>
      <option value="4">Kolkata</option>
    </select>
</div>
<div>
  <input type="text" id="username" minlength="5" maxlength="15" name="username" placeholder="Username" required>
</div>
<div>
  <input type="password" id="password" minlength="8" maxlength="20" name="password" placeholder="Password" required>
</div>
<div>
  <input type="password" id="cpassword" name="cpassword" placeholder="Confirm password" required>
</div>
<div>
  <input type="submit" id="signup" name="submit" value="submit" placeholder="submit">
</div>
</form>
</div>


<nav id="footer" style="background-color:black;color:white;padding:10px;">
  <div class="container">
    <div class="pull-left">
      <p> 2018. &copyAll Rights Reserved. Designed and coded by <a href="https://www.instagram.com/?hl=en" target="_blank">broCODE</a></p>
    </div>
    <div class="pull-right">
      &copySRS
    </div>
  </div>
</nav>

</body>
</html>
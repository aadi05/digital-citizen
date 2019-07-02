<?php

session_start();
include("../db/dbconfig.php");

if(isset($_POST['login']))
{
  $username=$_POST['username'];
   $password=$_POST['password'];

   $p="SELECT * FROM USER WHERE username='$username' AND password='$password'";
   $passwd= mysqli_query($conn,$p);
   $pc= mysqli_num_rows($passwd);

  if($pc>0)
  {
    $_SESSION['loginstatus']=1;
    $_SESSION['username']=$username;
    ?>
    <script type="text/javascript">
      alert("Login Succesful");
      window.location="../profile_home/";
    </script>
    <?php

  }
  else
    {
      ?>
    <script type="text/javascript">
      alert("Login Failed");
      window.location="../login/";
    </script>
    <?php
    }
    
}

?>

<html>
<head>
<title>GOsmart</title>
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
.login{
  width:70%;
}
#username{
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
#password{
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
#login{
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
        <a class="navbar-brand" href="#">GOsmart</a>
        </div> 
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../">Home</a></li>
            </ul>
        </div>
</div>
</nav><br>

<div class="login">
  <div>
    <img src="login.jpg" style="margin-left:50%;margin-top: none;">
  </div>
  <form method="POST">
  <div>
  <input type="text" id="username" name="username" minlength="5" maxlength="20" placeholder="username" required>
</div>
<div>
  <input type="password" id="password" name="password" minlength="8" maxlength="20" placeholder="password" required>
</div>
<div>
  <input type="submit" id="login" value="Login" name="login" placeholder="Login">
</div>
<div>
  <p style="margin-left:35%;margin-bottom:2%;font-size:20px;">Don't have an account? &nbsp<a href="../signup/" style="color:green;" id="signup">Signup</a></p>
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
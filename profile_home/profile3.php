<?php
  session_start();
  include("../db/dbconfig.php");
  $a=$_SESSION['loginstatus'];
  $e=$_SESSION['username'];

  if($a==1)
  {

  }
  else
  {
    session_destroy();
    header('Location:../login/');
  }

  $query="SELECT * FROM user WHERE username='$e'";
  $iquery=mysqli_query($conn,$query);
  $result=mysqli_fetch_assoc($iquery);
  $fname=$result['fname'];
  $lname=$result['lname'];
  $contact=$result['contact'];
  $email=$result['email'];
  $city=$result['city'];
  $username=$result['username'];

  $rquery="SELECT * FROM report WHERE username='$e'";
  $riquery=mysqli_query($conn,$rquery);
  $rresult=mysqli_fetch_assoc($riquery);
  $date = $rresult['date'];
  $location = $rresult['location'];
  $report = $rresult['report'];


  if(isset($_POST['update']))
  {
    $n_fname=$_POST['fname'];
    $n_lname=$_POST['lname'];
    $n_contact=$_POST['contact'];
    $n_email=$_POST['email'];
    $n_city=$_POST['city'];
    $n_username=$_POST['username'];
    $n_password=$_POST['password'];
    $n_cpassword=$_POST['cpassword'];

    $u_query="UPDATE user SET fname='$n_fname', lname='$n_lname', contact='$n_contact', email='$n_email', city='$n_city', username='$n_username', password='$n_password' WHERE username='$e'";
    $e_query=mysqli_query($conn,$u_query);

    if($n_password != $n_cpassword)
    {
      ?>
      <script type="text/javascript">
        alert("Enter correct password");
        window.location="../profile_home/profile3.php";
      </script>
      <?php

    }
    elseif($e_query)
    {
      ?>
      <script type="text/javascript">
        alert("Updated Successfully");
        window.location="../login/logout.php";
      </script>
      <?php
    }
    else
    {
      ?>
      <script type="text/javascript">
        alert("Update Failed");
      </script>
      <?php
    }
  }
?>
<!Doctype html>
<html>
<head>
<title>GOsmart</title>
<meta charset="utf-8"/>
<link rel="stylesheet" href="style_homie.css" type="text/css" />
<link rel="stylesheet" href="style_slider.css" type="text/css" />
<link rel="stylesheet" href="footer.css" type="text/css" />
<meta name="viewport" content="width-device-width, initial scale=1.8">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- end -->
  <!-- fontawesome cdn -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

<style>
/* Style the tab */
.tab {
    float: left;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    width: 30%;
    height: 300px;
}

/* Style the buttons that are used to open the tab content */
.tab button {
    display: block;
    background-color: inherit;
    color: black;
    padding: 22px 16px;
    width: 100%;
    border: none;
    outline: none;
    text-align: left;
    cursor: pointer;
    transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current "tab button" class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display:none;
    float: left;
    padding: 0px 12px;
    border: 1px solid #ccc;
    width: 70%;
    border-left: none;
    height: 635px;
    background-color: #e8ede6;
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
#update,#feed{
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
#feedback{
  width:70%;
  height:auto;
  border-radius: 5px;
  padding: 12px 20px;

}
button:hover {
    opacity: 0.8;
}

body{
  background-color: #e8ede6;
}
</style>
</head>

<body bgcolor="#e8ede6">
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
                <li><a href="index.php">Home</a></li>
                <li><a href="../login/logout.php" style="color:red;">Logout</a></li>

            </ul>
        </div>
</div>
</nav>

<div>
  <h1 align="center" style="margin-top:65px;background-color: #e8ede6;">Your Profile</h1>
</div>

<div class="tab">

  <button class="tablinks" onclick="openContent(event, 'booking')" id="defaultOpen">My Reports</button>
  <button class="tablinks" onclick="openContent(event, 'profile')">Account Settings</button>
  <button class="tablinks" onclick="openContent(event, 'feedback')">Feedback</button>
</div>

<div id="booking" class="tabcontent">
  <h1 align="center" style="margin: 7 5 7 5">Report Details</h1>
  <?php

$result = mysqli_query($conn,"SELECT * FROM report where username='$username'");

echo "<table border='2' width='100%'>
<tr>
<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date</th>
<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Location</th>
<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Report Submitted</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td align='center'>" . $row['date'] . "</td>";
echo "<td align='center'>" . $row['location'] . "</td>";
echo "<td align='center'>" . $row['report'] . "</td>";
echo "</tr>";
}
echo "</table>";
?>
</div>

<div id="profile" class="tabcontent">
  <h1 align="center" style="margin: 7 5 7 5">Update Profile Details</h1>
  <div style="width:70%;">
  <form method="POST">
        <div>
       <input type="text" name="fname" value="<?php echo $fname ?>" id="fname" placeholder="Enter new name" required>
          </div>
      
          <div>
            <input type="text" name="lname" value="<?php echo $lname ?>" id="lname" placeholder="Enter new last name" required>
          </div>
   
   
          <div>
            <input type="text" name="username" id="username" placeholder="Enter new username" required>
          </div>

          <div>
            <input type="number" name="contact" id="contact" value="<?php echo $contact ?>" placeholder="Enter new contact" required>
          </div>

          <div>
            <input type="email" name="email" id="email" value="<?php echo $email ?>" placeholder="Enter new email" required>
          </div>

          <div>
              <select name="city" class="form-control" id="city">
                <option value="null" disabled selected>Choose new city</option>
                <option value="1">Mumbai</option>
                <option value="2">Delhi</option>
                <option value="3">Bangalore</option>
                <option value="4">Kolkata</option>
              </select>
          </div>
  
          <div>
            <input type="password" name="password" id="password" placeholder="Enter new password" required>
          </div>
   
     
          <div >
            <input type="password" name="cpassword" id="cpassword" placeholder="Confirm password" required>
          </div>
        

          <div class="col-sm-12 form-group">
            <input type="submit" name="update" id="update" value="Update">
          </div>
  </form>
</div>
</div>

<div id="feedback" class="tabcontent">
  <h1 align="center" style="margin: 7 5 7 5">Feedback</h1>
  <div style="width: 70%;">
  <form method="POST">
  <div style="margin-left: 35%;">
    <textarea name="feedback" id="feedback" placeholder="YOUR FEEDBACK HERE" style="resize:vertical; width:350px;"></textarea>
  </div>
  <div>
    <input type="submit" name="feedback" id="feed" value="Submit">
  </div>
</form>
</div>
</div>

<script type="text/javascript">
function openContent(evt, contentName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(contentName).style.display = "block";
    evt.currentTarget.className += " active";
  }

    // Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

</script>

<nav id="footer" style="background-color:black;color:white;padding:10px; margin-top:700px;">
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
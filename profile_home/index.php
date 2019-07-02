<?php
  $flag=0;
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
  $username=$result['username'];

  $url="http://api.openweathermap.org/data/2.5/weather?lat=19.0643341&lon=72.8360576&mode=xml&APPID=f992b5133a32405640b43c9b82e9542c";
$getweather=simplexml_load_file($url);
$city = $getweather->city['name'];
$temperature = $getweather->temperature['value'];
$temp_degree = $temperature - 273;
$humdity = $getweather->humidity['value'];
$pressure = $getweather->pressure['value'];
$clouds = $getweather->clouds['name'];
$precipitation = $getweather->precipitation['mode'];
$weather = $getweather->weather['value'];

if(isset($_POST['submit']))
{
  $username=$_POST['username'];
  $location=$_POST['location'];
  $report = $_POST['report'];
  $date = date("Y/m/d");

  $iq="INSERT INTO report (date,username,location,report) VALUES('$date','$username','$location','$report')";
  $r= mysqli_query($conn,$iq);
  ?>
  <script type="text/javascript">
      alert("Your report has been noted!!!");
      window.location="index.php";
  </script>
  <?php
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>GOsmart</title>
   <!-- BOOSTRAP CDN  -->
    <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="website description">
  <meta name="keywords" comtent="xyz,abc,123">
  <link rel="stylesheet" type="text/css" href="../flip_style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- end -->
  <!-- fontawesome cdn -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <!-- end -->

  <link rel="icon" type="image/.png" href="img/logo.png">

  <!-- smooth scroll code -->
<script>
$(document).ready(function(){
  // Add scrollspy to <body>
  $('body').scrollspy({target: ".navbar", offset: 50});   

   // Add smooth scrolling on all links inside the navbar
  $("#myNavbar a").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    }  // End if
  });
});

</script>
<!-- smooth scroll code ends -->



<style type="text/css">
  
#emergency{
margin-top:55px;
background-color:grey;
color:white;
}

table{
border:1px solid black;
border-collapse:collapse;
width:100%;}

th,td{
  text-align: center;
}

.weather-data{
  background-image: url("../weather.jpg");
  padding-left:15%;
  background-color:black;
  height:130px;
  width:auto;
  display:grid;
  grid-template-rows:0.2fr 1fr 0.2fr 1fr;
  grid-template-columns:1fr 1fr 1fr;
  height:auto;

}

.jumbotron{
    color:white;
    margin-top:6%;
    padding:17%;
    background:url(../home.jpg) no-repeat center center fixed;
    width:100%;
    margin-bottom:0;
    background-size:cover;
    position:relative;
    display:table;
    height:600px;
  }

  .btn2{
    color:white;
    background:#2e6cd1;
    border-radius:11px;
    border: 2px solid white;
    font-size: 40px;
    margin-top: 200px;
    }

.weather-data h2{
  color:white;
  font-family:arial;
  font-size:18px;
  margin-left: 30px;
}

.weather-data h3{
  color:white;
  font-weight: bold;
  font-family:arial;
  font-size:24px;
}
.precaution{
  background-image: url("../img/pre.jpg");
  display:grid;
  margin-top:0;
  grid-template-rows: 1fr 1fr;
  grid-template-columns: 1fr 1fr;
}
 #news{
    font-family:arial;
    display:grid;
    font-size:10px;
    grid-template-columns:1fr 1fr 1fr;
    grid-template-rows:1fr 1fr;
    grid-gap:3px;
  }
      
  #username,#location,#report{
  width:100%;
  height:auto;
  border-radius: 10px;
  border: 1px solid #ccc;
}

#submit{
  width:100%;
  cursor: pointer;
  padding: 12px 20px;
  color:white;
  border-radius: 10px;
  border: 1px solid #ccc;
  margin:0% 35% 2% 35%;
  background-color: #4CAF50;
  border:none;
    }

</style>
</head>

<body>
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
                <li><a href="#home"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
                <li><a href="#precautions"><i class="fas fa-info-circle"></i>&nbsp;&nbsp;Precautions</a></li>
                <li><a href="#news"><i class="fas fa-newspaper"></i>&nbsp;&nbsp;News</a></li>
                <li><a href="#weather"><i class="fas fa-sun"></i>&nbsp;&nbsp;Weather</a></li>
                <li><a href="#report"><i class="fas fa-info-circle"></i>&nbsp;&nbsp;Report</a></li>
    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-building"></i>&nbsp;&nbsp;Department<span class="caret"></span></a>
    <ul class="dropdown-menu">
                        <li><a href="reg/">Police</a></li>
                        <li><a href="reg/">Fire</a></li>
                        <li><a href="user/">Ambulance</a></li>
                        <li><a href="reg/">Blood Bank</a></li>
                        <li><a href="reg/">Food & Medication</a></li>
                    </ul>
                  </li>
                <li><a href="#emergency"><i class="fas fa-hospital-alt"></i>&nbsp;&nbsp;Emergency Lines</a></li>
                <li><a href="profile3.php" style="color:#4CAF50"><i class="fas fa-user"></i>&nbsp;&nbsp;<?php echo $username ?></a></li>

            </ul>
        </div>
</div>
</nav>
<br>
<br>

<div class="jumbotron text-center container-fluid" id="home">
  <div class="row">

  </div>
  </div>


<div class="precaution" id="precautions">

<div class="flip-card" style="margin: 5% 0 5% 30%;">
  <div class="flip-card-inner">
    <div class="flip-card-front" style="background-color:#e0e2e2;">
      <img src="../img/1.jpg" alt="flooding" style="width:350px;height:300px; "> <h1 style="font-weight: bold;">Flooding</h1>
    </div>
    <div class="flip-card-back">
      <h1 align="center" style="color:black;">Precautions</h1> 
      <ul>
      <li align="left">If you are under a flood warning,Finf safe shelter right away.</li>
      <li align="left">Evacuate if told to do so.</li>
      <li align="left">Move to higher ground or a higher floor.<li>
      <li align="left">Stay where you are. <a href="../desc/flood.php" style="color:red;" target="_blank">Learn more</a></li>
    </ul>
    </div>
</div>
</div>

<div class="flip-card" style="margin: 5% 0 5% 10%;">
  <div class="flip-card-inner">
    <div class="flip-card-front" style="background-color: #e0e2e2;">
      <img src="../img/2.jpg" alt="hurricane" style="width:350px;height:300px;"><h1 style="font-weight: bold;">Hurricanes</h1>
    </div>
    <div class="flip-card-back">
      <h1 style="color:black;">Precautionary measures</h1> 
      <ul>
      <li align="left">Determine how best to protect yourself from high winds and flooding.
        <ul>
          <li align="left">Evacuate if told to do so.</li>
          <li align="left">Take refuge in a designated storm shelter, or an interior room for high winds.</li>
        </ul></li>
      <li align="left">Listen for emergency information and alerts.</li>
      <li align="left">Only use generators outdoors and away from windows.<li>
      <li align="left">Turn Around, Don’t Drown! Do not walk, swim, or drive through flood waters. <a href="../desc/hurricane.php" target="_blank" style="color:red;">Learn more</a></li>
    </ul>
    </div>
</div>
</div>

<div class="flip-card" style="margin: 5% 0 5% 30%;">
  <div class="flip-card-inner">
    <div class="flip-card-front" style="background-color: #e0e2e2;">
      <img src="../img/3.jpg" alt="wildfire" style="width:350px;height:300px;"><h1 style="font-weight: bold;">Wildfire</h1>
    </div>
    <div class="flip-card-back">
      <h1 style="color:black;">Precautionary measures</h1> 
      <ul>
      <li align="left">Leave if told to do so.</li>
      <li align="left">If trapped, call 9-1-1.</li>
      <li align="left">Listen for emergency information and alerts.<li>
      <li align="left">Use N95 masks to keep particles out of the air you breathe. <a href="../desc/fire.php" target="_blank" style="color:red;">Learn more</a></li>
    </ul>
    </div>
</div>
</div>


<aside class="flip-card" style="margin: 5% 0 5% 10%;">
  <div class="flip-card-inner">
    <div class="flip-card-front" style="background-color: #e0e2e2;">
      <img src="../img/4.jpg" alt="Avatar" style="width:350px;height:300px;"><h1 style="font-weight: bold;">Terrorist attack</h1>
    </div>
    <div class="flip-card-back">
      <h1 style="color:black;">What to do?</h1> 
      <ul>
      <li align="left">Getting away from the shooter or shooters is the top priority.</li>
      <li align="left">Leave your belongings behind and get away.</li>
      <li align="left">Help others escape, if possible, but evacuate regardless of whether others agree to follow.<li>
        <li align="left">Warn and prevent individuals from entering an area where the active shooter may be.</li>
      <li align="left">Call 911 when you are safe, and describe shooter, location, and weapons.<a href="../desc/terrorist.php" style="color:red;" target="_blank">Learn more</a></li>
    </ul>
    </div>
</div>
</aside></div>

<h1 style="color:white;font-weight:bold;background-color: black;margin-bottom:0;margin-top: 0;padding-left:10px;padding-top:10px;padding-bottom:10px;">News</h1>

<div id="news" style="background-color: #eee">
  <h1 id="title-1" ></h1>
  <h1 id="title-2"></h1>
  <h1 id="title-3"></h1>
  <div>
  <article id="summary-1"  style="font-size:20px;">
  </article><a href="" id="a1" style="font-size:20px;" target="_blank">see more...</a></div>
  <div>
  <article id="summary-2" style="font-size:20px;">
  </article><a href="" id="a2"  style="font-size:20px;" target="_blank">see more...</a></div>
  <div><article id="summary-3" style="font-size:20px;">
  </article><a href="" id="a3"  style="font-size:20px;" target="_blank">see more...</a></div>
  
  </div>

<script>
  var news1= document.getElementById("title");
  var request = new XMLHttpRequest();
  request.open('GET','https://newsapi.org/v2/top-headlines?sources=the-times-of-india&apiKey=972863cb293e45f6b0bcadd6c9b66d1a',true);
  request.onload = function(){
    var data =JSON.parse(this.response);
    document.getElementById("title-1").innerHTML = data.articles[1].title;
    document.getElementById("summary-1").innerHTML = data.articles[1].description;
    document.getElementById("a1").href=data.articles[1].url;
    
    
    document.getElementById("title-2").innerHTML = data.articles[2].title;
    document.getElementById("summary-2").innerHTML = data.articles[2].description;
    document.getElementById("a2").href=data.articles[2].url;
  
    
    document.getElementById("title-3").innerHTML = data.articles[3].title;
    document.getElementById("summary-3").innerHTML = data.articles[3].description;
    document.getElementById("a3").href=data.articles[3].url;
    
  }
  request.send();
  
  </script>

  <h1 style="color:white;font-weight:bold;background-color: black;margin-bottom:0;margin-top: 0;padding-left:10px;padding-top:10px;padding-bottom:10px;">Weather</h1>
<div class="weather-data" id="weather">
  <h3><i class="fas fa-map-marker-alt" style="color:red"></i>&nbsp;City</h3>
  <h3><i class="fas fa-sun" style="color:yellow"></i>&nbsp;Weather</h3>
  <h3><i class="fas fa-thermometer" style="color:orange"></i>&nbsp;Temperature</h3>
  <h2><?php echo $city ?></h2>
  <h2><?php echo $weather?></h2>
  <h2><?php echo $temperature?>K&nbsp;/&nbsp;<?php echo $temp_degree ?>C</h2>
  <h3><i class="fas fa-dot-circle" style="color:green"></i>&nbsp;Pressure</h3>
  <h3><i class="fas fa-tint" style="color:blue"></i>&nbsp;Humidtiy</h3>
  <h3><i class="fas fa-cloud" style="color:cyan"></i>&nbsp;Clouds</h3>
  <h2><?php echo $pressure ?>hPa</h2>
  <h2><?php echo $humdity ?>%</h2>
  <h2><?php echo $clouds ?></h2>
</div>

<h1 style="color:white;font-weight:bold;background-color: #2e4a4f;margin-bottom:0;margin-top: 0;padding-left:10px;padding-top:10px;padding-bottom:10px;">Report</h1>

    <div id="report" style="background-color: #eee;">
    <form method="POST">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3 form-group">
          <input type="text" id="username" name="username" value=<?php echo $username ?> placeholder="Username" style="margin-top:5%; margin-left: 5%;" class="form-control" required>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3 form-group">
      <input type="text" id="location" name="location" class="form-control" style=" margin-left: 5%;" placeholder="Location" required>
    </div>
  </div>
   <div class="row">
        <div class="col-sm-6 col-sm-offset-3 form-group">
      <textarea id="report" name="report" class="form-control" placeholder="Report about situation" style="resize:vertical;width:100%; margin-left: 5%;" required></textarea>
    </div>
  </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 form-group">
      <input type="submit" id="submit" name="submit" style=" margin-left: 5%;" class="form-control" value="submit">
    </div>
  </div>
    </form>
    </div>


<div id="department" style="margin-top: 20px;">
  <div id="police" style="margin-top: 10px;">
  </div>
</div>


<div id="emergency" style="margin-top: 100px;">
  <table>
    <tr>
      <th>Police</th>
      <th>Ambulance</th>
      <th>Fire</th>
      <th>Women's Helpline</th>  
      <th>Disaster Management</th>
      <th>AIDS Helpline</th>
      <th>Child Abuse Helpline</th>
      <th>Air Ambulance</th>
    </tr>
    <tr>
      <th>100</th>
      <th>102</th>
      <th>101</th>
      <th>108</th>
      <th>181</th>
      <th>1097</th>
      <th>1098</th>
      <th>9540161344</th>
    </tr>
</table>
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

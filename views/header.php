<!DOCTYPE html>

<html>

  <head>
  <meta name="google-site-verification" content="Yq-YaUuPk0apP4D1hDJg433JtQG88E0GKhZCLICgPqU" />
  <link href="https://plus.google.com/105118164707754900044" rel="publisher" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Attendance System</title>

    <!-- Mobile support -->
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Material Design for Bootstrap -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="dist/css/font-awesome.min.css">
    <!-- <link href="dist/css/bootswatch.min.css" rel="stylesheet"> -->
    <!-- <link href="dist/css/roboto.min.css" rel="stylesheet"> -->
    <!-- <link href="dist/css/material-fullpalette.min.css" rel="stylesheet"> -->
    <!-- <link href="dist/css/ripples.min.css" rel="stylesheet"> -->
    <script type="text/javascript" async="" src="https://ssl.google-analytics.com/ga.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Dropdown.js -->
    <link href="//cdn.rawgit.com/FezVrasta/dropdown.js/master/jquery.dropdown.css" rel="stylesheet">
    <!-- 
     -->
    <link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/droidarabickufi.css">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />

  </head>

  <!-- google analytics -->
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-84503201-1', 'auto');
  ga('send', 'pageview');

</script>



<!-- google analytics end here -->
  <body>
  <?php include_once("analyticstracking.php") ?>
  <!-- inner style start here-->
    <style nonce="z2c/KUU1H7aIEDkZL8YYnN1Z/i4">
        .body1 {
              background: #E9EAED;
              bottom: 0;
              left: 0;
              position: relative;
              top: 0;
              right: 0;
        }
        .color1 {
          color: #ffffff;
          background-color: #FF8A80;
        }
        .text1 {
          color: #ffffff;
        }
        .text2 {
          color: #7f8c8d;
        }
        .txtmov {
          color:#466BB0;
          font-size:12px;
          font-family: 'lato', serif;
        }
        .footerar {
          color:#E91E63;
          font-size:12px;
          font-family: 'Droid Arabic Kufi', serif;
        }
        .arpink {
          color:#E91E63;
          font-size:20px;
          font-family: 'Droid Arabic Kufi', serif;
        }
        .h3color {
          color :#466BB0;
          font-family: 'lato', serif;
        }
        .color2 {
          color: #ffffff;
          background-color: #1abc9c;
        }
        .color3 {
          color: #424242;
          background-color: #B39DDB;
        }
        .bgcolor1 {
          background-color: #4CAF50;
        }
        .colorfooter {
          color: #2196F3;
          background-color: #F9F9F9;
          position: relative;
          margin-bottom: 0px;
          margin-top: 0px; 
          bottom: 0px;
          margin: 0px;
          border: 0;
          width: 100%;
        }
        .imgleft {
          left: 0%;
        }
        .text3 {
              color: #424242;
              font-size: 20px;
              font-weight: 400;
              line-height: 28px;
            }
        .video-container {
              position: relative;
              padding-bottom: 56.25%;
              padding-top: 30px; height: 0; overflow: hidden;
              }
               
              .video-container iframe,
              .video-container object,
              .video-container embed {
              position: absolute;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              }    

      </style>
      <!-- inner style end here -->
<div class="body1">
    <!-- nav start here -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
  <div class="col-md-10 col-md-offset-1">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="http://mosama.me/attend/">Attendance Sys.</a>
    </div>
    

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
        <!-- <li><a href="#"><span class="sr-only">(current)</span></a></li> -->
        <!-- <li><a href="#">Cooking</a></li> -->
        <li><a href="http://mosama.me/attend/"><i class="fa fa-home"></i>&nbsp;Home</a></li>
        <li><a href="location-covered.php"><i class="fa fa-map-marker"></i>&nbsp;Location Covered</a></li>
        <li><a href="reports.php"><i class="fa fa-list-alt"></i>&nbsp;reports</a></li>
        <li><a href="members.php"><i class="fa fa-user"></i>&nbsp;members</a></li>
        <!-- <li><a href="#">About me <i class="fa fa-smile-o"></i></a></li> -->
        
        
        <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li> -->
      </ul>

      <!-- <form class="navbar-form navbar-right" role="search">
        <div class="form-group ">
          <img src="img/basma-website-logo.png" alt="Basma|yassin" width="50" height="50" style="box-shadow: 0 4px 10px rgba(0, 0, 0, 0.38);border-radius: 100px;background-color:#F48FB1;">
        </div>
      </form> -->
      
    </div>
    </div>
  </div>
</nav>
    <!-- nav end here -->
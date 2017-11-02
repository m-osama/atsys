
<html>
    <div class="body1">
 <?php 
  include 'views/header.php';
 ?>

    <!-- inner style start here -->
    <style>


    .body1 {
              background: #E9EAED;

            }
    .half1, .half2 {
              position: absolute;
              left: 0;
              right: 0;
            }
    .half1 {
              background: #FFFFFF;
              bottom: 50%;
              top: 0;
            }
    .half2 {
              background: #4285F4;
              bottom: 0;
              top: 50%;
            }
    </style>
    <!-- inner style end here -->
    <!-- <div class="body1"> -->
<!--       <div class="half1"></div>
      <div class="half2"></div> -->
    <!-- note start here -->
    <br><br>
    <div class="container">
    <div class="panel panel-default panal-info">
      <div class="panel-body">
        <h4 align="center">If you have a project would like to discuss, get in touch with us. </h4>
      </div>
    </div>
    </div>
    <!-- note end here -->
    <br>
    <!-- The HTML Markup start here -->
    <div class="container">
      <div class="panel panel-default">
        <div class="panel-body">
        <br><br>
          <div class="col-sm-6 col-sm-offset-3">
              <form class="form-horizontal" role="form" method="post" action="index.php">
                  <div class="form-group">
                      <label for="name" class="col-sm-2 control-label">Name</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="<?php echo htmlspecialchars($_POST['name']); ?>">
                          <?php echo "<p class='text-danger'>$errName</p>";?>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="email" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                          <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>">
                          <?php echo "<p class='text-danger'>$errEmail</p>";?>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="message" class="col-sm-2 control-label">Message</label>
                      <div class="col-sm-10">
                          <textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($_POST['message']);?></textarea>
                          <?php echo "<p class='text-danger'>$errMessage</p>";?>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
                          <?php echo "<p class='text-danger'>$errHuman</p>";?>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-sm-10 col-sm-offset-2">
                          <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-sm-10 col-sm-offset-2">
                          <?php echo $result; ?>    
                      </div>
                  </div>
              </form> 
          </div>
      </div>
      </div>
    </div>


    <!-- The HTML Markup end here -->
    <!-- php start here -->
    <?php
    if (isset($_POST["submit"])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $human = intval($_POST['human']);
        $from = 'mohammedosama@gmail.com'; 
        $to = '3mrosama@gmail.com'; 
        $subject = 'Message from Contact Demo ';
        
        $body = "From: $name\n E-Mail: $email\n Message:\n $message";
 
        // Check if name has been entered
        if (!$_POST['name']) {
            $errName = 'Please enter your name';
        }
        
        // Check if email has been entered and is valid
        if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errEmail = 'Please enter a valid email address';
        }
        
        //Check if message has been entered
        if (!$_POST['message']) {
            $errMessage = 'Please enter your message';
        }
        //Check if simple anti-bot test is correct
        if ($human !== 5) {
            $errHuman = 'Your anti-spam is incorrect';
        }
 
// If there are no errors, send the email
if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
    if (mail ($to, $subject, $body, $from)) {
        $result='<div class="alert alert-success">Thank You! I will be in touch</div>';
    } else {
        $result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>';
    }
}
    }
?>
    <!-- php start end  -->
    <!-- test 3 start -->
    <br><br><br><br>
    <!-- test 3 end -->
    
</div>
</div>

    <!-- test 3 end  -->
    


   <?php 
  include 'views/footer.php';
   ?>
   </div>
</html>
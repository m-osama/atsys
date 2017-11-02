<html>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>Members</title>
<?php 
  include 'views/header.php';
 ?>
    
    <!-- members start -->
    <div class="container">
      <div class="panel panel-default panal-info">
        <div class="panel-body">
          <div class="col-md-10 col-md-offset-1">
          
            <h1 class="h3color" style="font-family: 'lato', serif;"><i class="fa fa-users" style="color:#466BB0;"></i>&nbsp; Members</h1>
            <hr><br>
            <div>
              <h2 class="text-muted"><i class="fa fa-user-secret"></i>&nbsp;MANAGER</h2>
              <?php 
                include 'ahmedelsayed.php';
               ?>
              <hr>
              <h2 class="text-muted"><i class="fa fa-user"></i>TEAM LEADERS</h2>
              <?php 
                include 'mosama.php';
               ?>
               <hr>
               <h2 class="text-muted"><i class="fa fa-user-o"></i>TEAM MEMBERS</h2> 
              <?php 
                include 'msayed.php';
               ?>

            </div>

               
            <br><br><br><br>
          </div>
        </div>
      </div>
    </div>
    <!-- members end  -->
    <br><br>

    <?php 
  include 'views/footer.php';
   ?>
    
</html>
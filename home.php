<?php 
if (!session_id()) {
	session_start();
} 
include 'connect.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link href="css/style.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
</head>
<body>
  <?php include_once 'header.php'; ?>

  <?php 
  if (!empty($_SESSION['msg'])) {
    echo "
    <p style='text-align: center; color: #5c865c; font-size: 14px;'>".$_SESSION['msg']."</p>
    ";
    $_SESSION['msg']="";
    $_SESSION['movieId']="";
  }

  ?><div class="container">

  <div  class="panel with-nav-tabs panel-success" style="margin-top:3%;">
    <div class="panel-heading">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#nowshowing" data-toggle="tab">Available</a></li>
      </ul>
    </div>
    <div class="panel-body">
      <div class="tab-content">
        <div class="tab-pane fade in active" id="nowshowing">


          <?php 
          $count=0;
          $res=$conn->query("select * from movielist;");
          while ($row=$res->fetch_object()) {
             // $_SESSION['movie']=;

            if ($count==4) {
              echo "<div class='row'>";
              $count=0;
            }

            echo " 
            <div class='col-md-3 col-sm-12'>
              <div class='card-container'>
                <div class='card'>
                  <div class='front'>
                    <div class='cover'>
                      <img src='images/".$row->image."'/> 
                    </div>
                    <div class='content'>
                      <div class='main'>
                        <h3 class='name'>".$row->Name ."</h3>

                        <p><b>IMDB: </b>".$row->imdb."</p>

                        <p class='profession'><b>Genre: </b>".$row->Genre ."</p>

                        <p class='profession'><b>Director: </b> " .$row->Director ."</p>
                        

                      </div>
                    </div>
                  </div>
                  <!-- end front panel -->
                  <div class='back'>
                    <div class='content'>
                      <div class='main'>
                        <h4 class='text-center'>".$row->Name ."</h4>
                        <p class='text-center'>".$row->Description ." </p>
                      </div>
                      <div style='margin-top: 40px;' class='buy_ticket'>
                       <form action='ticket.php' method='post' >
                        <input type='hidden' name='movieId' value='".$row->movieId."' >
                        <input type='submit'  class='btn btn-primary btn-xs btn-block' type='submit' value='Details' name='submit'>
                      </form>

                    </div>
                  </div>
                </div> <!-- end card -->
              </div> <!-- end card-container -->
            </div>
          </div>";

          $count++;
        } ?>
      </div>
    </div>
  </div>
</div>
</div>

</div>
</div>
    <!-- Footer -->
    <footer class="page-footer font-small blue">
        <div class="footer-copyright text-center py-3">© 2022 Copyright:
            <a href="/"> Movie Bookings</a>
        </div>
    </footer>
</body>
</html>
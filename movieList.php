<?php 
if (!session_id()) {
	session_start();
} 
include 'connect.php';
?>
<!DOCTYPE html>
<html>
<head>  
  <link href="css/style.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
</head>
<body>

 <div class="container">

  <div class="panel with-nav-tabs panel-success" style="margin-top:5%;">
    <div class="panel-heading">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#nowshowing" data-toggle="tab">Movies</a></li>
      </ul>
    </div>
    <div class="panel-body">
      <div class="tab-content">
        <div class="tab-pane fade in active" id="nowshowing">
          <?php 
          $count=0;
          $res=$conn->query("select * from movielist;");
          while ($row=$res->fetch_object()) {
            $_SESSION['movie']=$row->movieId;

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
                        <a <a href='javascript:void(0)' onclick='openLoginModal();' class='btn btn-primary btn-xs btn-block'>Book</a>
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

</body>
</html>
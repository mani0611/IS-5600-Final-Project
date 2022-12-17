<?php
  if (!session_id()) {
    session_start();
  }
  include_once ('connect.php');
  ?>

  <!DOCTYPE html>
  <html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="#">

  <title>Movie Schedule</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    </head>

<body background="background-color: #3a1e1e;">
  <div class="navbar-wrapper">
      <div class="">

        <nav class="navbar navbar-default navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php"><h2>Movie Booking</h2></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse float-right">
              <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>                
                <li class="active"><a href="schedule.php">Schedule</a></li>
                
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li>
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                  </form>
                </li>
                <li><a href="javascript:void(0)" onclick="openLoginModal();">Login </a></li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>

    <div  class="container">
      <table id="fresh-table" class="table" width="100%" style="margin-top: 3%;">
        <thead>
          <th data-field="name" data-sortable="true">Movie</th>
          <th data-field="shows">Shows</th>
          <th>Action</th>

        </thead>
        <tbody>
          <?php 
          $movieRes=$conn->query("select * from movielist;");
          while ($movieRow=$movieRes->fetch_object()) {

            ?>
            <tr>
              <td style="font-weight: bold;"><?php echo "".$movieRow->Name;?>

              </td>
              <td>

                <?php 

                $movieTime=$conn->query("select * from timeSlot;");
                while ($movieTimeRow=$movieTime->fetch_object()) {
                  echo " <span class='label label-primary'>".$movieTimeRow->time."</span>"; 

                } ?>
              </td>

              <td>
                <a href="javascript:void(0)" onclick="openLoginModal()"; class="btn btn-primary btn-xs">Buy Ticket</a>
              </td>
            </tr>
            <?php  } ?>
          </tbody>

        </table>
      </div>
    </div>
  </div>
</div>
</div>
</section>

<div class="modal fade login" id="loginModal">
  <div class="modal-dialog login animated">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4>Login</h4>
      </div>
      <div class="modal-body">  
        <div class="box">
          <div class="content">
            <div class="error"></div>
            <div class="form loginBox">
              <form method="post" action="index.php" accept-charset="UTF-8">
                <input id="email" class="form-control" type="text" placeholder="Email" name="email">
                <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                <input class="btn btn-default btn-login" type="button" value="Login" onclick="login()">
              </form>
            </div>
          </div>
        </div>
        <div class="box">
          <div class="content registerBox" style="display:none;">
            <div class="form">
              <form method="post" html="{:multipart=>true}" data-remote="true" action="schedule.php" accept-charset="UTF-8">
                <input id="email" class="form-control" type="text" placeholder="Email" name="email">
                <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                <input id="password_confirmation" class="form-control" type="password" placeholder="Repeat Password" name="password_confirmation">
                <input class="btn btn-default btn-register" type="submit" value="Create account" name="commit" onclick="registration(event)"">
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="forgot login-footer">
          <span>
            <a href="javascript: showRegisterForm();">create an account</a>
            ?</span>
          </div>
          <div class="forgot register-footer" style="display:none">
            <span>Already have an account?</span>
            <a href="javascript: showLoginForm();">Login</a>
          </div>
        </div>        
      </div>
    </div>
  </div>
</div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    <script>
      $( document ).ready(function() {
        $('.datepicker').datepicker({
          weekStart:1,
          color: 'red'
        });
      });

      // table showtime
      var $table = $('#fresh-table'),
      $alertBtn = $('#alertBtn'), 
      full_screen = false,
      window_height;

      $().ready(function(){

        window_height = $(window).height();
        table_height = window_height - 20;


        $table.bootstrapTable({
          toolbar: ".toolbar",

          showRefresh: true,
          search: false,
          showToggle: true,
          showColumns: true,
          pagination: true,
          striped: true,
          sortable: true,
          height: table_height,
          pageSize: 25,
          pageList: [25,50,100],
          
          formatShowingRows: function(pageFrom, pageTo, totalRows){
            },
            formatRecordsPerPage: function(pageNumber){
              return pageNumber + " rows visible";
            },
            icons: {
              refresh: 'fa fa-refresh',
              toggle: 'fa fa-th-list',
              columns: 'fa fa-columns',
              detailOpen: 'fa fa-plus-circle',
              detailClose: 'fa fa-minus-circle'
            }
          });

        window.operateEvents = {
          'click .like': function (e, value, row, index) {
            alert('You click like icon, row: ' + JSON.stringify(row));
            console.log(value, row, index);
          },
          'click .edit': function (e, value, row, index) {
            alert('You click edit icon, row: ' + JSON.stringify(row));
            console.log(value, row, index);    
          },
          'click .remove': function (e, value, row, index) {
            $table.bootstrapTable('remove', {
              field: 'id',
              values: [row.id]
            });

          }
        };

        $alertBtn.click(function () {
          alert("You pressed on Alert");
        });


        $(window).resize(function () {
          $table.bootstrapTable('resetView');
        });    
      });


      function operateFormatter(value, row, index) {
        return [
        '<a rel="tooltip" title="Like" class="table-action like" href="javascript:void(0)" title="Like">',
        '<i class="fa fa-heart"></i>',
        '</a>',
        '<a rel="tooltip" title="Edit" class="table-action edit" href="javascript:void(0)" title="Edit">',
        '<i class="fa fa-edit"></i>',
        '</a>',
        '<a rel="tooltip" title="Remove" class="table-action remove" href="javascript:void(0)" title="Remove">',
        '<i class="fa fa-remove"></i>',
        '</a>'
        ].join('');
      }
    </script>
  
   <!-- Footer -->
   <footer class="page-footer font-small blue">
        <div class="footer-copyright text-center py-3">© 2022 Copyright:
            <a href="/"> Movie Bookings</a>
        </div>
    </footer>
</body>
</html>
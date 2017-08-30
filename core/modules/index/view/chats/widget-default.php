<?php
session_start();
include 'lib/config.php';
include 'lib/socialnetwork-lib.php';

ini_set('error_reporting',0);

?>
   <div class="col-md-3">
<?php Action::execute("_userbadge",array("user"=>Session::$user,"profile"=>Session::$profile,"from"=>"logged" ));?>
<?php Action::execute("_mainmenu",array());?>
    </div>
<!DOCTYPE html>
<html>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php echo Headerb (); ?>

<?php echo Side (); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Chat
        <small>13 nuevos mensajes</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">

          <div class="box box-solid">
            
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#"><i class="fa fa-inbox"></i> Mis chats
                  <span class="label label-primary pull-right">13</span></a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Mis conversaciones</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  
                  <?php
                  $chats = mysql_query("SELECT * FROM c_chats WHERE de = '".$_SESSION['id']."' OR para = '".$_SESSION['id']."' order by id_cch desc");
                  while($ch = mysql_fetch_array($chats)) { 

                    if($ch['de'] == $_SESSION['id']) {$var = $ch['para'];} elseif ($ch['para'] == $_SESSION['id']) {$var = $ch['de'];}
                    $usere = mysql_query("SELECT * FROM usuarios WHERE id_use = '$var'");
                    $us = mysql_fetch_array($usere);

                    $chat = mysql_query("SELECT * FROM chats WHERE id_cch = '".$ch['id_cch']."' ORDER BY id_cha desc limit 1");
                    $cha = mysql_fetch_array($chat);

                  ?>
                  <tr>
                    <td class="mailbox-star">
                    <?php if($cha['leido'] == 0) { ?>
                      <i class="fa fa-star text-yellow"></i>
                    <?php } else {?>
                      <i class="fa fa-star text-white"></i>
                    <?php } ?>
                    </td>
                    <td class="mailbox-name"><a href="chat.php?user_id=<?php echo $var; ?>&leido=1"><?php echo $us['user_id']; ?></a></td>
                    <td class="mailbox-subject"><?php echo $cha['mensaje']; ?>
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date"><?php echo $cha['fecha']; ?></td>
                  </tr>
                  <?php } ?>



                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- Page Script -->
<script>
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
</script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>

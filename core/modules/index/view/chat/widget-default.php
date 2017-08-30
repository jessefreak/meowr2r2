
<?php
session_start();
include 'lib/config.php';
include 'lib/socialnetwork-lib.php';

ini_set('error_reporting',0);



if(isset($_GET['leido'])) {
  $leido = mysql_real_escape_string($_GET['leido']);
  $usuariod = mysql_real_escape_string($_GET['user_id']);

  $tchats = mysql_query("SELECT * FROM chats WHERE de = '$usuariod' OR para = '$usuariod'");
  $tc = mysql_fetch_array($tchats);
  if($tc['de'] != $_SESSION['id']) {
  $update = mysql_query("UPDATE chats SET leido = '1' WHERE de = '$usuariod' OR para = '$usuariod'");
  }
}
?>
    <div class="col-md-3">
<?php Action::execute("_userbadge",array("user"=>Session::$user,"profile"=>Session::$profile,"from"=>"logged" ));?>
<?php Action::execute("_mainmenu",array());?>
    </div>


<?php echo Headerb (); ?>

<?php echo Side (); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <!-- Main content -->
    <section class="content">
 
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!-- /.mailbox-read-info -->
              <div class="mailbox-read-message">
              
     <div class="col-md-3">
          <a href="./?view=chats" class="btn btn-primary btn-block margin-bottom">Mis chats</a>

          <div class="box box-solid">
          
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

              


      <!-- Direct Chat -->
      <div class="row">
        <div class="col-md-12">
          <!-- DIRECT CHAT PRIMARY -->
            <div class="box-header with-border">
              <h3 class="box-title">NOMBRE USUARIO</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages" style="overflow: scroll; height: 400px;">

                
                <?php
                $user = mysql_real_escape_string($_GET['user_id']);
                $sess = $_SESSION['id'];
                $chats = mysql_query("SELECT * FROM chats WHERE de = '$user' AND para = '$sess' OR de = '$sess' AND para = '$user' order by id_cha desc");
                while($ch = mysql_fetch_array($chats)) { 

                  if($ch['de'] == $user) {$var = $user;} else {$var = $sess;}
                  $usere = mysql_query("SELECT * FROM usuarios WHERE id_use = '$var'");
                  $us = mysql_fetch_array($usere);
                ?>
  

                <?php if ($ch['de'] == $user) { ?>
                <!-- Message. Default to the left -->
                <div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left"><?php echo $us['user_id']; ?></span>
                    <span class="direct-chat-timestamp pull-right"><?php echo $ch['fecha']; ?></span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="avatars/<?php echo $us['avatar']; ?>"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                    <?php echo $ch['mensaje']; ?>
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->

                <?php } elseif ($ch['para'] == $user) { ?>

                <!-- Message to the right -->
                <div class="direct-chat-msg right">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-right"><?php echo $us['user_id']; ?></span>
                    <span class="direct-chat-timestamp pull-left"><?php echo $ch['fecha']; ?></span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="avatars/<?php echo $us['avatar']; ?>" alt="Message User Image"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                    <?php echo $ch['mensaje']; ?>
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->

                <?php } ?>
  

            <?php } ?>



              </div>
              <!--/.direct-chat-messages-->

              <!-- Contacts are loaded here -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">


              <form action="" method="post">
                <div class="input-group">
                  <input type="text" name="mensaje" placeholder="Escribe un mensaje" class="form-control">
                      <span class="input-group-btn">
                        <input type="submit" name="enviar" class="btn btn-primary btn-flat">Enviar</button>
                      </span>
                </div>
              </form>

              <?php
              if(isset($_POST['enviar'])) {

                $mensaje = mysql_real_escape_string($_POST['mensaje']);
                $de = $_SESSION['id'];
                $para = mysql_real_escape_string($_GET['usuario']);

                $comprobar = mysql_query("SELECT * FROM c_chats WHERE de = '$de' AND para = '$para' OR de = '$para' AND para = '$de'");
                $com = mysql_fetch_array($comprobar);
                if(mysql_num_rows($comprobar) == 0) {
                  $insert = mysql_query("INSERT INTO c_chats (de,para) VALUES ('$de','$para')");
                  $siguiente = mysql_query("SELECT id_cch FROM c_chats WHERE de = '$de' AND para = '$para' OR de = '$para' AND para = '$de'");
                  $si = mysql_fetch_array($siguiente);
                  $insert2 = mysql_query("INSERT INTO chats (id_cch,de,para,mensaje,fecha,leido) VALUES ('".$si['id_cch']."','$de','$para','$mensaje',now(),'0')");
                  if($insert) {echo '<script>window.location="chat.php?usuario='.$para.'"</script>';}
                }
                else
                {
                  $insert3 = mysql_query("INSERT INTO chats (id_cch,de,para,mensaje,fecha,leido) VALUES ('".$com['id_cch']."','$de','$para','$mensaje',now(),'0')");
                  if($insert3) {echo '<script>window.location="chat.php?usuario='.$para.'"</script>';}
                }



              }

              ?>


            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.col -->







              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
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
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>

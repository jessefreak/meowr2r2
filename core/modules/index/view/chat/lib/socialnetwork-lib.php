<?php

function Headerb () 

{
?>

<?php
}
?>

<?php
function Side ()

{
?>

        
        <div class="pull-left info">
          <p><?php echo ucwords($_SESSION['user_id']); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
     
     
<?php
}
?>
<?php
include 'inc/header.php';

Session::CheckSession();

$logMsg = Session::get('logMsg');
if (isset($logMsg)) {
  echo $logMsg;
}
$msg = Session::get('msg');
if (isset($msg)) {
  echo $msg;
}
Session::set("msg", NULL);
Session::set("logMsg", NULL);
?>
<?php

if (isset($_GET['remove'])) {
  $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
  $removeUser = $users->deleteUserById($remove);
}

if (isset($removeUser)) {
  echo $removeUser;
}
if (isset($_GET['deactive'])) {
  $deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['deactive']);
  $deactiveId = $users->userDeactiveByAdmin($deactive);
}

if (isset($deactiveId)) {
  echo $deactiveId;
}
if (isset($_GET['active'])) {
  $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active']);
  $activeId = $users->userActiveByAdmin($active);
}

if (isset($activeId)) {
  echo $activeId;
}


 ?>
      <div class="card ">
        <div class="card-header">
          <h3><i class="fas fa-users mr-2"></i>Liste des utilisateurs <span class="float-right"><strong>
</span>

          </strong></span></h3>
        </div>
        <div class="card-body pr-2 pl-2">
        <div>
        
        </div>
                    <?php

                      $allUser = $users->selectAllUserData();

                      if ($allUser) {
                        $i = 0;
                        foreach ($allUser as  $value) {

                     ?>

                      <div style="border: solid;width: 41%;display: inline-block;padding-left: 1%;margin-left: 6%;    border-radius: 22px;padding-bottom: 15px;border-color:green;    background-color: #80808014;">
                      <p><?php echo"<p style='text-align: center;'>Nom:  ". $value->name ."</p>"; ?></p>
                        
                        <?php echo"<p style='text-align: center;'>Username:  ". $value->username."</p>"; ?>
                        <?php echo"<p style='text-align: center;'>Email:  ". $value->email."</p>"; ?>

                        <?php echo"<p style='text-align: center;'>Mobile". $value->mobile."</p>"; ?>
                        
                          <?php if ($value->isActive == '0') { ?>
                          <p style='text-align: center;' class="text-success font-weight-bold">Statut : Activé</p> 
                        <?php }else{ ?><p style='text-align: center;' class="text-success font-weight-bold">Statut :  Desactivé</p>
                        <?php } ?>

                        <?php if ($value->roleid  == '1'){
                          echo "<p style='text-align: center;'>Profil <span class='text-success font-weight-bold'>Directeur</span></p>";
                        } elseif ($value->roleid == '2') {
                          echo "<p style='text-align: center;'>Profil <span class='text-danger font-weight-bold'>Salarié</span></p>";
                        }elseif ($value->roleid == '3') {
                            echo "<p style='text-align: center;'>Profil <span class='text-warning font-weight-bold'>Stagiaire</span></p>";
                        } ?>

                        
                          <?php if ( Session::get("roleid") == '1') {?>
                          <div style="text-align: center;">
                            <a class="btn btn-info btn-sm " style="width: 20%;" href="profile.php?id=<?php echo $value->id;?>">Modifier</a>
                            <a onclick="return confirm('Ce profil sera supprimé si vous cliquez sur OK !!')" style="width: 20%;" class="btn btn-danger
                    <?php if (Session::get("id") == $value->id) {
                      echo "disabled";
                    } ?>
                             btn-sm " href="?remove=<?php echo $value->id;?>">Supprimer</a>

                             <?php if ($value->isActive == '0') {  ?>
                               <a onclick="return confirm('Ce profil sera désactivé si vous cliquez sur OK !!')" style="width: 20%;" class="btn btn-warning
                       <?php if (Session::get("id") == $value->id) {
                         echo "disabled";
                       } ?>
                                btn-sm " href="?deactive=<?php echo $value->id;?>">Désactiver</a>
                             <?php } elseif($value->isActive == '1'){?>
                               <a onclick="return confirm('Ce profil sera activé si vous cliquez sur OK !!')" class="btn btn-secondary
                       <?php if (Session::get("id") == $value->id) {
                         echo "disabled";
                       } ?>
                                btn-sm " style="width: 20%;" href="?active=<?php echo $value->id;?>">Active</a> 
                             <?php } ?></div>




                        <?php  }elseif(Session::get("id") == $value->id  && Session::get("roleid") == '2'){ ?>
                        <p style='text-align: center;'>Pas de droit</p>
                        
                        <?php }elseif(Session::get("id") == $value->id  && Session::get("roleid") == '3'){ ?>
                          <p style='text-align: center;'>Pas de droit</p>
                        <?php } echo"</div> "?>
                        
                        
                    <?php }  ;}else{ ?>
                      No user availabe now !
                    <?php } ?> 









        </div>
      </div>



  <?php
  include 'inc/footer.php';

  ?>

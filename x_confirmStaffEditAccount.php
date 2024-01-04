<?php
include "zzz_initialize.php";

$id = $_POST['id'];

$sqlQuery = " SELECT * FROM account WHERE id=".$id;
$res = $link->query($sqlQuery);

$old_nm = "";
$old_em = "";
$old_ad = "";
$old_un = "";
$old_pw = "";

while($row = mysqli_fetch_object($res))
{
  $old_nm = $row->name;
  $old_em = $row->email;
  $old_ad = $row->address;
  $old_un = $row->username;
  $old_pw = $row->password;
}
?>
  <!-- MODAL CONTENT [START]-->
  <div class="modal-header" style="background-color: #2b2b2b;">
    <h4 class="modal-title" style="color: white;">Confirm Edit Account</h4>
  </div>

  <form autocomplete="off" method="post">
  <div class="modal-body" style="color: black;">

  <!-- HIDDEN INPUT FIELDS [START] -->
  <input type="text" name="nm" value="<?php echo($_POST["nm"]); ?>" hidden required>
  <input type="text" name="old_nm" value="<?php echo $old_nm; ?>" hidden required>
  <input type="email" name="em" value="<?php echo($_POST["em"]); ?>" hidden required>
  <input type="text" name="ad" value="<?php echo($_POST["ad"]); ?>" hidden required>
  <input type="text" name="un" value="<?php echo($_POST["un"]); ?>" hidden required>
  <input type="text" name="old_un" value="<?php echo $old_un; ?>" hidden required>
  <input type="text" name="pw" value="<?php echo($_POST["pw"]); ?>" hidden required>
  <!-- HIDDEN INPUT FIELDS [END] -->
  
  <h4>
    Review your new account information before you confirm the changes.
    All new changes are highlighed in blue.
  </h4>
  <hr style="border-color: black;"/>
  
  <?php 
  if($old_nm != $_POST['nm']){ echo("<span style='color:blue'>Name : ".$_POST['nm']."</span><br/>"); }
  else{ echo("<span style='color:black'>Name : ".$_POST['nm']."</span><br/>"); }
  ?>

  <?php 
  if($old_em != $_POST['em']){ echo("<span style='color:blue'>Email : ".$_POST['em']."</span><br/>"); }
  else{ echo("<span style='color:black'>Email : ".$_POST['em']."</span><br/>"); }
  ?>

  <?php 
  if($old_ad != $_POST['ad']){ echo("<span style='color:blue'>Address : ".$_POST['ad']."</span><br/>"); }
  else{ echo("<span style='color:black'>Address : ".$_POST['ad']."</span><br/>"); }
  ?>

  <?php 
  if($old_un != $_POST['un']){ echo("<span style='color:blue'>Username : ".$_POST['un']."</span><br/>"); }
  else{ echo("<span style='color:black'>Username : ".$_POST['un']."</span><br/>"); }
  ?>

  <?php 
  if($old_pw != $_POST['pw']){ echo("<span style='color:blue'>Password : ".$_POST['pw']."</span><br/>"); }
  else{ echo("<span style='color:black'>Password : ".$_POST['pw']."</span><br/>"); }
  ?>

  </div>
  <div class="modal-footer">
    <button style="height:36px;border-radius:30px;" type="button" class="btn btn-dark" data-bs-dismiss="modal" formnovalidate>Cancel</button>
    <button style="height:36px;border-radius:30px;" class="btn btn-info" type="submit" value="<?php echo($_POST['id']); ?>" name="edit_btn">Confirm</button>
  </div>
  </form>
  <!-- MODAL CONTENT [END]-->

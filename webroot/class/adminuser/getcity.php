<?php session_start();
require_once("../lib/config.php");
require_once("../lib/functions.php");
require_once("../lib/variable.php");
@extract($_REQUEST);
?>
<?php
 $sql="select * from $tbl_city where state_code='$_REQUEST[state]'";
$result=$obj->query($sql,$debug =-1);?>
<select name="city" class="txtfld txt" id="city_id" style="width:300px">
<?php
if($num=$obj->numRows($result)>0){
while($location = $obj->fetchNextObject($result)){?>
<option value="<?php echo $location->id;?>" <?php if($location->id == $line->city){?>selected<? }?> ><?php echo ucwords($location->city);?></option><?php }} else { ?>
<option value="">No City Found</option>



							<?php }?></select>


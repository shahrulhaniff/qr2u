<?
	/*TO CLEAR GENERATED FILE*/
	$files = glob('qr/temp/*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}
	
	
if (isset($_POST['detail'])) {
echo'
<table><tr>
<td> <a href="index.php"><img src="cross.png"/></a> </td>
</tr></table>
</div>
<div class="paddingsikit">';

$idd = $_POST['id'];
include "qr/qr.php"; 

echo '</div></div>';
}

?>


<? $id="haha"; ?>

<form action="" method="POST">
<input type='hidden' value='<?=$id?>' name='id'>&nbsp;
<input type="hidden" name="detail">
<input type="image" src="qrbtn.png" alt="Submit" width="35" height="35" title="Detail">
</form>
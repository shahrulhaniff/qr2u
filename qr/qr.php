<html>
<head>
<title>Print kod qr</TITLE>
<style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('search.png');
  background-position: 10px 12px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myUL {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

#myUL li a {
  border: 1px solid #ddd;
  margin-top: -1px; /* Prevent double borders */
  background-color: #f6f6f6;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  font-family: Arial;
  color: black;
  display: block
}

#myUL li a:hover:not(.header) {
  background-color: #eee;
}

.button {
    background-color: #4CAF50; /* Green */
    border: none;
	border-radius: 12px;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
}


.button2 {
    background-color: white; 
    color: #002526; 
    border: 2px solid #008CBA;
}

.button2:hover {
    background-color: #008CBA;
    color: white;
}

.button3 {
    background-color: white; 
    color: #002526; 
    border: 2px solid #ff0000;
}

.button3:hover {
    background-color: #ff0000;
    color: white;
}

.wrapper {
  top: 10%;
  margin: auto;
  width: 50%;
  border: 3px solid white;
  padding: 10px;
}
</style>
<script>
		function printDiv(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		}
	</script>
</head>
<body>
<div class="wrapper">
<?php    

    
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    //include "qrlib.php";  $idd = '6';  
	include "qr/qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'L';
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    
	/*
	echo 'sizeallqr:&nbsp;<select name="sizeallqr">';
        
    for($i=1;$i<=10;$i++)
        echo '<option value="'.$i.'"'.(($matrixPointSize==$i)?' selected':'').'>'.$i.'</option>';
        
    echo '</select>&nbsp<br>';
	*/
    $matrixPointSize = 8;
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);

    if (!isset($_REQUEST['data'])) { 
    $_REQUEST['data'] = $idd;
        //it's very important!
        if (trim($_REQUEST['data']) == '')
            die('data cannot be empty! <a href="?">back</a>');
            
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    } else {
    echo "cek QR.php";
        
    }    
    echo "<center>";
    //display generated file
	//------------------------------------------------------------------------------------------------------------------------------
	//------------------------------ dia display guna file temp ni, try buat deele lepas display atau temporary ----------- !!!!!
	//------------------------------------------------------------------------------------------------------------------------------
    echo '<img src="qr/'.$PNG_WEB_DIR.basename($filename).'" /><br>'; 
	
	echo (isset($_REQUEST['data'])?htmlspecialchars($_REQUEST['data']):''.$idd.'');
	echo "</center>";
	?>
	 </div>
	 
	 <?
	 //delete img lepas guna - DAH CUBA BELUM JADI LAGI , dah jadi padam komen ni //sleep(5);
	 //$file = "qr/".$PNG_WEB_DIR.basename($filename); 
	 //unlink($file);
	 //if (!unlink($file)){  echo ("Error deleting $file"); } //else { echo "done"; }
	 ?>
	 
</body>
</html>
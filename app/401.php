<?php

if ( file_exists( "../boot.php" ) ){
	include_once( "../boot.php" );
}
header("Cache-Control: public");
?>
<!DOCTYPE html>
<html lang='pt-br'>
<head>
	<meta http-equiv='content-type' content='text/html;charset=utf-8' />
	<title>401 - Unauthorized</title>
</head>

<body>
	<h1>Unauthorized</h1>
	<img src='<?php echo IMG; ?>401.jpg' alt='401' title='unauthorized'>
	
</body>
</html>

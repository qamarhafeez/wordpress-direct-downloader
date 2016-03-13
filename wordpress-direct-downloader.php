<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="stylesheet" href="style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
echo "Starting Step 1 (Downloading wordpress from Server)...<br />";
	if(!copy("http://wordpress.org/latest.zip", "wordpress.zip")):
		echo("Failed to Download");
		die();
	else:
		echo "Step 1 Completed<br /><br /><br />";
	endif;
######################STEP 2##########################
echo "Starting Step 2 (Extracting Zip File)....<br />";
$path = dirname(__FILE__);
$zip = new ZipArchive;
if ($zip->open("wordpress.zip") === TRUE) :
	$zip->extractTo($path);
	$zip->close();
	echo 'ok';
	echo "Step 2 Completed<br /><br /><br />";
else:
  echo 'Step 2 Failed! <br />';
  die();
endif;
#########################STEP 3#######################
echo "Starting Step 3 (Moving Files)....<br />";
$path = dirname(__FILE__);
$dirname = "wordpress/";
$dir = opendir($dirname);
while(false != ($file = readdir($dir)))
{
	if(($file != ".") and ($file != ".."))
	{
		$source_file = $path . "/wordpress/" . $file;
		$destination_file = $path . "/" . $file;
		rename($source_file, $destination_file);
	}
}
rmdir("wordpress");
unlink("wordpress.zip");
echo "Step 3 Completed<br /><br /><br />";

$url = $_SERVER['REQUEST_URI']; //returns the current URL
$parts = explode('/',$url);
$dir = $_SERVER['SERVER_NAME'];
for ($i = 0; $i < count($parts) - 1; $i++) {
 $dir .= $parts[$i] . "/";
}

echo "Your Wordpress is ready to use. <br /><a href='http://" . $dir . "' >Click Here for Wordpress</a>";
?>
</body>
</html>

<?php
	
    $filename = (array_key_exists("f", $_GET) ? $_GET["f"] : null);
    $s = (array_key_exists("s",$_GET) ? $_GET["s"] : null);
    if (null == $filename)
        die("You should gimme a file name as 'f' url parameter!");
    if (null == $s)
       $s = 100;
    $name='cache/'.basename($filename,".png").'_'.$s.'.png';
    if(file_exists($name)){
		$dest=imagecreatefrompng($name);
		imagealphablending($dest,false);
		imagesavealpha($dest,true);
	}
	else{
		list($width_orig, $height_orig) = getimagesize($filename);
		
		$dest = imagecreatetruecolor($s, $s);
		imagealphablending($dest,false);
		imagesavealpha($dest,true);
		$source = imagecreatefrompng($filename);
		imagecopyresampled($dest, $source, 0, 0, 0, 0, $s, $s, $width_orig, $height_orig);
		imagepng($dest,$name);
	}
    
    header('Content-type: image/png');
    imagepng($dest);
?>



<html>
<head>
<link href="styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Cache-control" content="no-cache">
<meta http-equiv="Expires" content="-1">
</head>
<BODY onload=setTimeout("self.close()",15000)> 
This will automatically close in 15 seconds
<br/><br/>
<?php
// Now let's delete a file stored by generator
// WARNING: Do not use fullpath if you modify this script
// or it may delete files from another path folder from the server 
// or might delete full root path.
// PLEASE!! make sure that you set the right path, folder, and file name.
//Set permission path and file
session_start();
if (!isset($_SESSION['zpuid'])) {
    die("<h1>Unathorized request!</h1> Request not accessible outside!");
}
function fsmodify($sndsec) {
       $chunks = explode('/', $sndsec);
       chmod($sndsec, is_dir($sndsec) ? 0755 : 0777);
       chown($sndsec, $root[0]);
       chgrp($sndsec, $root[0]);
    }


    function fsmodifyr($dir) 
    {
       if($sndsecs = glob($dir."/*")) {        
           foreach($sndsec as $sndsec) {
               fsmodify($sndsec);
               if(is_dir($sndsec)) fsmodifyr($sndsec);
           }
       }

       return fsmodify($dir);
    }

//Delete file function
function deletemyfile($filename)
{

 $filearray = explode("/", $filename);

 $filecountno = count($filearray);
 $filecountno = $filecountno-1;
 for($i=0;$i<=$filecountno;$i++)
 {
  $myfilename = $filearray[$i];
 }

 if(file_exists("$filename"))
 {
  if(unlink("$filename"))
  {
   $deleteresult = "<b>".$myfilename."</b>: File was deleted successfully. <br/><b>WARNING: Files not Protected!</b><br><br>";
  }
  else
  {
   $deleteresult = "<font color='red'><b>".$myfilename."</b>: Error! You may not have enough permission to delete this file.</font>";
  }
 }
 else
 {
  $deleteresult = "<font color='red'><b>".$myfilename."</b>: Error! File does not exist or the file is already deleted. Please create another .htpasswd.</font> <br><br><b>WARNING: Files not Protected!</b><br><br>";
 }
 return $deleteresult;
}

// Calling the function
$filename = 'snd.htpasswd';

$callresult = "<b>File Deletion Log: snd.htpasswd</b><br>";
$callresult = $callresult."<br>".deletemyfile($filename);
echo "$callresult";

//DELETE/UNLINK PROTECTION FILE
$fh = fopen('.htaccess', 'a');
fwrite($fh, '<h1>File Protection Deleted</h1>');
fclose($fh);

unlink('.htaccess');

//DELETE/UNLINK LOG FILE
$fh = fopen('snd.htpasswd.log', 'a');
fwrite($fh, '<h1>File Log Deleted</h1>');
fclose($fh);

unlink('snd.htpasswd.log');

?>
</body>
</html>
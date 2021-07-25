<?php

$sRootDir = getcwd();
$n = 0;

function dirToArray($dir) {
    global $sRootDir;  
    global $n;

   $cdir = scandir($dir);
   foreach ($cdir as $key => $value)
   {
      if (!in_array($value,array(".","..")))
      {
          if ($value == "uploads"){
                chdir($dir);
                echo("copying images from " . $dir);
                echo(shell_exec("cp -r uploads " . $sRootDir . "/apr3combined/wp-content/"));
                chdir($sRootDir);
                
            }
         else if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
         {
            dirToArray($dir . DIRECTORY_SEPARATOR . $value);
         }
         else
         {
            if($value == "wp-config.php"){
                chdir($dir);
                echo("wordpress installation in " . getcwd() . "\n");
                $n++;
                echo(shell_exec("wp export --dir=" . $sRootDir . " --filename_format={site}.wordpress1.{date}." . $n . ".xml"));
                chdir($sRootDir);
            }
         }
      }
   }
 
}


dirToArray(".");

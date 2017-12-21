<?php

function copydir($source,$destination,$toBack=true){
    
    if($toBack){
        echo "rsync content dari web front end ke back end..\n";
    }else{
        echo "rsync content dari Back end system ke Front end..\n";
    }
    
    
    if(!is_dir($destination)){
        $oldumask = umask(0); 
        mkdir($destination, 0777);
        umask($oldumask);
    }

    $dir_handle = @opendir($source) or die("Unable to open");
    
    while ($file = readdir($dir_handle)) {
        
        if($file!="." && $file!=".." && !is_dir("$source/$file"))
            
            copy("$source/$file","$destination/$file");
        
        if($file!="." && $file!=".." && is_dir("$source/$file"))
            
        copydir("$source/$file","$destination/$file");
    }

    closedir($dir_handle);
    
    echo "status [OK]\n";
}


//set source and destination coy
copydir("A:\\xampp\htdocs\\evclass\cdn\\front","A:\\xampp\htdocs\\ev.sys\cdn\\front",true);
copydir("A:\\xampp\htdocs\\ev.sys\cdn\\back\\evclass","A:\\xampp\htdocs\\evclass\cdn\\back\\evcourse",false);

//bak
copydir("A:\\xampp\htdocs\\evclass\cdn\\front","A:\\xampp\htdocs\\ev.sys\cdn\\bak\\evclass",true);
//end bak



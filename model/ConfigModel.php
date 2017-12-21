<?php

include_once './DB.php';

class ConfigModel extends DB{
            
    public function getGlobalCodeByName($name){
        
        $sql=" SELECT * FROM tm_global_code WHERE code_name='".$name."' ";
        
        return DB::fetch($sql);
    }    
}
?>

<?php

class Helper{
    
    public  function  clearUrl($str){
        
	$char=array("(","-)",","," ","%","&","'");
	$filter =array('-','-','-','-','persen','and','-');									
	$text = str_replace($char, $filter, $str);
	return strtolower($text);
        
    }
    
    public function _getTrue(){
        if(DB_DRIVER=='postgres'){
            
            return true;
            
        }else if(DB_DRIVER=='mysql'){
            return 1;
        }
    }
    
    public function _getFalse(){
        
        if(DB_DRIVER=='postgres'){
            
            return false;
            
        }else if(DB_DRIVER=='mysql'){
            
            return 0;
        }
        
        
    }

    public  function _generateCode($table=null,$prefix){
        
        $year=date("Y");        
        
        $fullDate=date("Y-m-d");                        
        
        if(DB_DRIVER=='postgres'){
            
            $sql ="SELECT created_at FROM ".$table." WHERE created_at::text LIKE '%".$year."%' ";
            
        }else if(DB_DRIVER=='mysql'){
            
            $sql ="SELECT created_at FROM ".$table." WHERE created_at LIKE '%".$year."%' ";
            
        }
        
        $count =DB::fetch($sql);
                                       
        $count = count($count)+1;
                                        
        $angka = $this->_getHelperIncrement(5, $count);
        
        $year = explode("-",$fullDate);
                                
        return SERVER_NAME.".".$prefix.".".substr($year[0],2).$year[1].".".$angka;                               
                
    }
    public  function _getHelperIncrement($len=5,$num=1){
        
        if($num < 10){
            $num = "000000".$num;
        }else if($num > 9 && $num < 100){
            $num = "00000".$num;
        }else if($num > 99 && $num < 1000){
            $num = "0000".$num;            
        }else if($num > 999 && $num < 10000){
            $num = "000".$num;                    
        }else if($num > 9999 && $num < 100000){
            $num = "00".$num;                    
        }else if($num > 99999 && $num < 1000000){
            $num = "0".$num;                            
        }else{            
            $num++;
        }
        
        return $num;
    }
    
    public function test(){
        echo "ok";
    }
}
?>

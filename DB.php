<?php

 
define('DEFAULT_CONNECT_DB','mysql');

if(DEFAULT_CONNECT_DB=="postgres"){
    
    define('DB_DRIVER','postgres');
    define('DB_PORT','5432');
    define('DB_HOST','127.0.0.1');
    define('DB_NAME','everyvents');
    define('DB_USER','postgres');
    define('DB_PWD','sa');

}else if(DEFAULT_CONNECT_DB=="mysql"){
    
    define('DB_DRIVER','mysql');
    define('DB_PORT','3306');
    define('DB_HOST','127.0.0.1');
    define('DB_NAME','cartonindus');
    define('DB_USER','root');
    define('DB_PWD','');
    
}

class DB{        
    
    public function __construct() {
        
        echo "Connecting to : ".DB_DRIVER."\n";
        
    }
            
    public static function config(){                
                
        if(DB_DRIVER =='mysql'){
            
            $conn=mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_NAME,DB_PORT);
        
            if (mysqli_connect_errno()){
                            
                echo "Failed to connect to ".DB_DRIVER. mysqli_connect_error();            
            }
            
        }else if(DB_DRIVER =='postgres'){
            
            try {
                                                
                $conn=@pg_connect("host=".DB_HOST." port=".DB_PORT." user=".DB_USER." dbname=".DB_NAME." password=".DB_PWD." ");
                
                if($conn){
                    
                    echo "Database Connection : [ok]\n";
                                        
                }else{
                    
                    echo "Failed to connect to ".DB_DRIVER;
                
                }
                
            } Catch (Exception $e) {
                
                echo "Failed to connect to Postgres " ; 
                
            }
            
        }
        
        
        return $conn;
        
    }	
    public static function connect(){
        
        $response = false;
        
        if(self::config()){
            
            if(DB_DRIVER =='mysql'){
                                                
                mysqli_select_db(self::config(),DB_NAME);
                mysqli_close(self::config());
                
            }else if(DB_DRIVER =='mysql'){
                
                pg_select_db(self::config(),DB_NAME);
                pg_close(self::config());
                
            }
            
            $response = true;                    
        }		
        
        return $response;
        
    }
    public static function setQuery($sql){
        
        switch(DB_DRIVER){
            
            case    "postgres":
                
                return pg_query(self::config(),$sql);
                
            break;        
            case    "mysql":
                
                return mysqli_query(self::config(),$sql);
                
            break;
            default :
                
            break;
        
        }
        
        
    }
    
    public static function commit(){
        
        return mysqli_commit(mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_NAME,DB_PORT));
        
    }
    public static function fetch($sql){
                        
        $rows = self::setQuery($sql);
        
        $result=array();
        
        if(DB_DRIVER=="mysql"){
            
            while($data = mysqli_fetch_array($rows)){
            
                array_push($result, $data);

            }
        
        }else if(DB_DRIVER=="mysql"){
            
            
            echo "ERROR ON DB.PHP LINE 125";
            die;
        }
            
        
        
                
        return $result;
                
    }
            
    public static function  insert($table="",$data=array()){
                        
        $sql = "INSERT INTO ".$table." SET ";
                
        if(is_array($data)){
            
            $n=1;
            foreach($data as $k=>$v){
               
                if($n!=count($data)){
                    $sql .=$k."='".$v."',";  
                }else{
                    $sql .=$k."='".$v."'";  
                }
                            
              $n++;
            }
        }    
        
        //echo $sql;die;
        
                        
        self::setQuery($sql);        
        
    }
    public static function update($table="",$key=NULL,$val=NULL,$data=array()){
        $sql = "UPDATE ".$table." SET ";
        
        $n=1;
        
        foreach($data as $k=>$v){
                                    
            if($n != count($data)){
                
                $sql.=$k."='".$v."',";
                
            }else{
                
                $sql.=$k."='".$v."'";
            }
            
            
            $n++;
            
        }
        
        $sql.=" WHERE ".$key."='".$val."'";
                    
        self::setQuery($sql);
        
    }    
    public static function setFlag($table="",$data=array()){
        
    }    
    public static function where($table=NULL,$data=array()){
        
        $sql=" WHERE ";
        $n=1;
        
        if(count($data) > 0){
            
            foreach($data as $k => $v){
                
                if($n != count($data)){
                    
                    $sql.=$k."=".$v." AND ";
                    
                }else{
                    
                    $sql.=$k."=".$v;
                    
                }
                
                
                $n++;
                
                        
            }
        }
        
        return $sql;
        
    }
    
    
}
?>

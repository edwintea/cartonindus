<?php

date_default_timezone_set("Asia/Bangkok"); 

define('SERVER_NAME','S01'); //alias from tm_servers
define('BASE_URL','http://everyvents.com/ev/');//ganti ke root untuk live
define('BASE_CDN','http://everyvents.com/ev/cdn/images/events/cover/');
define('BASE_BARCODE','http://localhost:81/ev.services/cdn/tickets/barcode/');
	
$App=array(
    'S01.APP.1701.0000001'    =>  array(
        'BASE_URL'      =>  'http://everyvents.com/',
        'BASE_CDN'      =>  'http://everyvents.com/cdn/',
        'BASE_ASSET'    =>  'http://everyvents.com/assets/',
        'BASE_TICKET'   =>  'http://localhost:81/ev.services/everyvents/cdn/tickets/'
    ),
    'S01.APP.1701.0000003'    =>  array(
        'BASE_URL'      =>  'http://everyvents.com/evcourse/',
        'BASE_CDN'      =>  'http://everyvents.com/evcourse/cdn/',
        'BASE_ASSET'    =>  'http://everyvents.com/evcourse/assets/',
        'BASE_TICKET'   =>  'http://localhost:81/ev.services/evcourse/cdn/tickets/'
    ),
    'S01.APP.1701.0000003'    =>  array(
        'BASE_URL'      =>  'http://everyvents.com/evsport/',
        'BASE_CDN'      =>  'http://everyvents.com/evsport/cdn/',
        'BASE_ASSET'    =>  'http://everyvents.com/evsport/assets/',
        'BASE_TICKET'  =>  'http://localhost:81/ev.services/evsport/cdn/tickets/'
    )
);


class Config{
    
    protected $base_url;
    protected $base_cdn;
    protected $driver;
            
    function __construct() {
        
        $this->base_url = BASE_URL;
        $this->base_cdn = BASE_CDN;
        
    }
    
    public function getBaseUrl(){
        
        return $this->base_url;
    }
    
    public function getBaseCdn(){
        
        return $this->base_cdn;
    }
    
    public function getDriver(){
        
        return $this->driver;
    }
    
    public function getConfig($app){
                
        $return = [];
        
        switch ($app){
            case    "S01.APP.1701.0000001"://everyvents
                
                $return   =  array(
                    'BASE_URL'      =>  'http://everyvents.com/',
                    'BASE_CDN'      =>  'http://everyvents.com/cdn/',
                    'BASE_ASSET'      =>  'http://everyvents.com/assets/',
                    'BASE_TICKET'  =>  'http://localhost:81/ev.services/everyvents/cdn/tickets/'
                );
            break;
            case    "S01.APP.1701.0000002": //evcourse
                $return   =  array(
                    'BASE_URL'      =>  'http://everyvents.com/evcourse/',
                    'BASE_CDN'      =>  'http://everyvents.com/evcourse/cdn/',
                    'BASE_ASSET'      =>  'http://everyvents.com/evcourse/assets/',
                    'BASE_TICKET'  =>  'http://localhost:81/ev.services/evcourse/cdn/tickets/'
                );
                
            break;
            case    "S01.APP.1701.0000003"://evsport 
                $return   =  array(
                    'BASE_URL'      =>  'http://everyvents.com/evsport/',
                    'BASE_CDN'      =>  'http://everyvents.com/evsport/cdn/',
                    'BASE_ASSET'      =>  'http://everyvents.com/evsport/assets/',
                    'BASE_TICKET'  =>  'http://localhost:81/ev.services/evsport/cdn/tickets/'
                );
                
            break;        
        }
        
        return $return;
    }
    
    
public function _getNow(){
        
        $date       =   date('Y-m-d');
        $day        =   date('D',strtotime($date));
        $d          =   date('d');
        $year       =   date('Y');
        $month      =   date('M',strtotime($date));
        $time       =   date('H:i');
        $A          =   date('A',strtotime($date));
        
        $d_now  =   $day.", ".$month." ".$d.",".$year." ".$time." ".$A;
        
        return $d_now;
        
    }
    public function formatDate($date){
        $d = explode(" ",$date);
        
        if(isset($d[1])){
            
            $date = $d[0];
            
        }else{
            
            $date = $date;
            
        }
        
        $day        =   date('D',strtotime($date));
        $d          =   date('d',strtotime($date));
        $year       =   date('Y',strtotime($date));
        $month      =   date('M',strtotime($date));
        $time       =   date('H:i',strtotime($date));
        $A          =   date('A',strtotime($date));
        
        return   $day.", ".$month." ".$d.",".$year;
        
        
    }
    public function customDate($date){
        
        $datetime = DateTime::createFromFormat('YmdHi',$date);
        echo $datetime->format('D');
                
    }
    public function createImage($blob,$ext,$des,$f_name=NULL,$newFile=false){
        
        $__1 = 25;
        $__2 = 75;

        $file = $this->base64_to_jpeg($blob, $ext, $des,$f_name,$newFile);

        $thumb1 = 200;
        $thumb2 = 200;
        
        
        return array('file_name'=>$file['name'],'file'=>$file['file']);
        
    }
    
    public function base64_to_jpeg($base64_string,$ext, $output_file,$f_name,$newFile){  
        
        if($ext=='jpg'){
            $ext="jpeg";
        }
        
        $data = str_replace('data:image/'.$ext.';base64,','',$base64_string);        
                                
        $data = base64_decode($data);
        
                       
        if(!$newFile){
            $unik=uniqid();
        }else{
            $unik = $f_name;
        }
        
        
        $file = $output_file . $unik . '.'.$ext;
        file_put_contents($file, $data);

        $response=array(
            'file'  =>  $file,
            'name'  =>  $unik . '.'.$ext
        );
        
        return $response;
    }
    public function setBarcodeNumber($s){
        $c = strlen($s);
        $r = "";
        
        for($i=0;$i < $c;$i++){
            $r.=substr($s, $i, 1)."   ";
        }
        
        return $r;
    }
}
?>

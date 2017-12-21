<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/Config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/Helper.php');
//include_once($_SERVER['DOCUMENT_ROOT'].'/Email.php');

include_once($_SERVER['DOCUMENT_ROOT'].'/OrderModel.php');

/*
 * trigger tr_events_book_item -> email not in users
 */
class AutoPostOrder{
    
    protected $config;
    
    public function __construct() {
        
        $this->config = new Config();       
        
    }

    public function go(){
                                        
        $orders = new OrderModel();
        $count=count($orders->getAll());
        $arr=[];
        
        //start api
        $key="UGx8Q6FqRmpg9nmug0vEem21P9Tc3Wf1rjvOw3YOGm0uGdua7QAB93lAC98HXEA5";
        
        $get    =  "http://portal.cartonindus.com/api/v1/order/get?appkey=".$key."&pending=1"; 
        $post   =  "http://portal.cartonindus.com/api/v1/order/update";
        
        $file_contents = file_get_contents($get);
        $json_decode = json_decode($file_contents);                
        
        echo var_dump($json_decode->data[0]); //get result
        
        if(count($json_decode->data[0]) > 0){
            
            foreach($json_decode->data[0] as $k => $d){
                
                if($k=='nospk'){
                    
                    $arr['nospk']="ok";
                    
                }else{
                    
                    $arr[$k]=$d;
                    
                }
                
            }
            
        }                
        
        
        $data = array(
            "appkey"    => $key,
            "id"        =>  $json_decode->data[0]->id,
            "data"      =>  $arr
        );
                
            
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['edwin'=>1]));
        $result = curl_exec($ch);
        echo $result;die;
        curl_close($ch);
            
                                
        if($count){
            
            echo "Found ".$count." New Order \n";
            
        }else{
            
            echo "Empty New Order \n";
        }
        
        
        DB::insert('spk', array(
            'nospk'            =>  count($orders->getAll())+1,
            'transdate'         =>  date('Y-m-d'),
            'transdateproduksi' =>  date('Y-m-d H:i:s'),
            'transdateorder'    =>  date('Y-m-d H:i:s')
        ));
        
        echo " Post OK \n";
        
    }
    
}
?>

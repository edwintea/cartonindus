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
    
    public function convertDateToEng($date){
        $s = explode("-",$date);			
		
        return $s[1]."/".$s[2]."/".$s[0];
    }
    
    public function go(){
                                        
        $orders = new OrderModel();        
						        
        //start api
        $key="UGx8Q6FqRmpg9nmug0vEem21P9Tc3Wf1rjvOw3YOGm0uGdua7QAB93lAC98HXEA5";
        
        $get    =  "http://portal.cartonindus.com/api/v1/order/get?appkey=".$key."&pending=1"; 
        $post   =  "http://portal.cartonindus.com/api/v1/order/update";
        
        $file_contents = file_get_contents($get);
        $json_decode = json_decode($file_contents);                
        $arr      =   $json_decode->data;
        
        //echo var_dump($arr); //get result
        
        echo"\nFound : ".count($arr)." Record dari portal\n";              
        		
        if(count($arr) > 0){
            
            for($i=0;$i < count($arr);$i++){
                
                $sql="SELECT * FROM spk WHERE (LTRIM(RTRIM(webid))= '".$arr[$i]->id."') "; 
				$no=count($orders->getAll())+1;
				
				$no="SPS-WEB-".$no;					
				                                
                $find=DB::fetch($sql);  				
								
				
                if(count($find) == 0){
										
					
                    DB::insert('spk', array(
                            'nospk'			=>	$no,
                            'unit'			=>      "PCS",
                            'jenis'                 =>	$arr[$i]->jenis,
                            'webid'                 =>	$arr[$i]->id,
                            'transdate'             =>      DEFAULT_CONNECT_DB=='mysql'?$arr[$i]->transdateorder:$this->convertDateToEng($arr[$i]->transdateorder),
                            'transdateproduksi'     =>      DEFAULT_CONNECT_DB=='mysql'?$arr[$i]->transdatekirim:$this->convertDateToEng($arr[$i]->transdatekirim),
                            'transdateorder'        =>      DEFAULT_CONNECT_DB=='mysql'?$arr[$i]->transdateorder:$this->convertDateToEng($arr[$i]->transdateorder),
                            'lebar'                 =>	$arr[$i]->lebar,
                            'qty'			=>	$arr[$i]->qty,
                            'itemprice'             =>	$arr[$i]->itemprice,
                            'spkstatus'             =>	$arr[$i]->spkstatus,
                            'deskripsi'		=>	$arr[$i]->deskripsispk,
                            'kwalitascetak'		=>	$arr[$i]->kwalitascetak
                    ));     
                    
                    echo "Posting 1 order from portal to Desktop [OK] \n";
                    
                }
                
            }
            
        }                
                
        //END PULL
		
		
		
        //push data to web
        $sql="SELECT * FROM spk WHERE (webid IS NOT NULL) ";                                
        $find=DB::fetch($sql);                
        
        if(count($find) > 0){
            
            for($i=0;$i < count($find);$i++){
                                        
                //echo var_dump($find[$i]);die;
                
                $data = array(
                    "appkey"    => $key,            
                    "data"      =>  $find[$i]
                );                

                $data_string = json_encode($data);                                                                                   

                $ch = curl_init($post);                                                                      
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                    'Content-Type: application/json',                                                                                
                    'Content-Length: ' . strlen($data_string))                                                                       
                );                                                                                                                   

                $result = curl_exec($ch);        
                
                echo "Updating 1 order from desktop to Portal [OK] \n";

            }        
            
        }        
		
        
        //end push
        
        echo "Connection closed \n";        
        
    }
    
}
?>

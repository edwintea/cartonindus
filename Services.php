<?php
    /*
     * author:edwin tea 
     */

    include_once('DB.php');    
    
    class Services extends DB{
        
        function __construct() {
            
            $this->run([                       
                                
                'task:order',
                
                /*                                                                                
                'ev:member-welcome',                                                                
                'ev:invoice-print', 
                'ev:invoice-remind',
                'ev:invoice-verify',
                'ev:invoice-completed',
                'ev:ticket-print',
                'ev:booking-autocancel',
                'ev:member-newsletter',                                
                'ev:event-autoclose',                
                 * 
                 */
            ]);
            
        }
        
        function run($task=array()){
                                   
            if(DB::connect()){
                
                try{
                    
                    if(is_array($task)){
                        
                        foreach($task as $t){
                            
                            echo "Start service : ".$t."\n";
                            
                            $this->_do($t);
                            
                            echo "End service =============================================\n";
                            echo "\n";
                        }
                    }else{
                        
                        echo "No Task";
                    }
                    
                } catch (Exception $ex) {

                }
                
                
            }  else {
                
                echo "ga konek database!";
                
            }
                        
        }
        
        function _do($task){
                                
            switch($task){
                
                case  'task:order':
                    
                    include_once('task/AutoPostOrder.php');
                    
                    $go = new AutoPostOrder();
                    
                    $go->go();
                                        
                break;                                
                default:
                    
                    echo "Task is not in list!";

                break;
            
            }
        }
        
        
    }
            
    new Services();
?>
<?php

include_once('Config.php');
include_once('Email.php');

include_once('model/UserModel.php');
include_once('model/EventModel.php');
include_once('model/InvoiceModel.php');
include_once('model/ConfigModel.php');
include_once('model/TicketModel.php');

include_once('template/Template.php');

/*
 * a.is_published=1 AND a.status=1 AND a.is_closed=0 AND a.end_date='".date('Y-m-d')
 */

class AutoClosedEvent extends Template{
    
    protected $config;
    
    public function __construct() {
        
        $this->config = new Config();       
        
    }

    public function go(){
                                                        
        $ev = new EventModel();
        $events = $ev->getNeedClosedEvents();                                                
                                   
        if(count($events) > 0){
                                               
            foreach($events as $e){
                    
                echo "Event : ".$e['venue_name']." will be closed now!\n";

                DB::update('tr_events', 'code', $e['code'], array(
                    'is_closed' =>  1,
                    'status'    =>  0 
                ));

                //send email notification to creator /  eo that it's event has been closed automatically
                //code..                                    
                    
                
            }
        }else{
                    
            echo "Not found! \n";
            
        }
        
    }
    
}
?>

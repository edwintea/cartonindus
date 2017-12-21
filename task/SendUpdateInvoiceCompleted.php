<?php

include_once('Config.php');

include_once('model/PaymentModel.php');

/*
 * trigger
 * *  tr_payments i_pym_sts=6
 *  tr_events_ticket_book is_printed=0
 */


class SendUpdateInvoiceCompleted{
    
    protected $config;
    
    public function __construct() {
        
        $this->config = new Config();       
        
    }

    public function go(){
                                                                   
        $payment = new PaymentModel();
        $d = $payment->getPaymentByStatus(6); //completed or paid trigger by admin
           
        
        if(count($d) > 0){
            
            echo "Found ".count($d)." Completed Invoices \n";
            
            foreach($d as $v){                                
                               
                //update invoice property
                DB::update('tr_invoices_property', 'i_invoice', $v['i_invoice'], array(
                    'is_completed' =>   1,                    
                ));                                                
            }
                    
        } 
        
    }    
}
?>

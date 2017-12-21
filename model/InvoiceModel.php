<?php

include_once './DB.php';
include_once './Helper.php';

class InvoiceModel extends DB{
            
    public function getInvoiceById($id){
        $sql="";
        return DB::fetch($sql);
    }
    public function getInvoiceNeedPrinted(){
        
        //status with payment status=1 => submitted
        
        $sql=" select a.*,
                b.name as payment_status,
                c.method_name as payment_method,
                d.event_name,
                e.firstname,
                e.email,
                f.name as payment_status,                
                h.code_name as last_status
                FROM tr_invoices a LEFT JOIN tm_payment_status b ON a.i_pym_sts = b.code
                LEFT JOIN tm_payment_method c ON a.i_pym_mthd = c.code 
                LEFT JOIN tr_events d ON a.f_code = d.code
                LEFT JOIN users e ON a.bill_to = e.code
                LEFT JOIN tm_payment_status f ON a.i_pym_sts = f.code                
                LEFT JOIN tm_global_code h ON a.i_global_code = h.code
                LEFT JOIN tr_invoices_printed i ON a.code = i.i_invoice
                WHERE a.i_pym_sts = ".Helper::_getTrue()." AND a.is_sendmail = ".Helper::_getFalse()." ";                                
        
        //echo $sql;die;
        
        return DB::fetch($sql);
    }
    public function getInvoiceByReminderToday(){
    
        $sql=" select a.*,
                b.name as payment_status,
                c.method_name as payment_method_name,
                d.event_name,
                e.code as i_user,
                e.firstname,
                e.email,
                f.name as payment_status,
                g.method_name as payment_method,
                h.code_name as last_status
                FROM tr_invoices a LEFT JOIN tm_payment_status b ON a.i_pym_sts = b.code                 
                LEFT JOIN tm_payment_method c ON a.i_pym_mthd = c.code 
                LEFT JOIN tr_events d ON a.f_code = d.code
                LEFT JOIN users e ON a.bill_to = e.code
                LEFT JOIN tm_payment_status f ON a.i_pym_sts = f.code
                LEFT JOIN tm_payment_method g ON a.i_pym_mthd = g.code
                LEFT JOIN tm_global_code h ON a.i_global_code = h.code
                WHERE a.reminder_date = '".date('Y-m-d')."' AND a.status=".Helper::_getTrue()."
                    AND a.i_pym_sts=".Helper::_getTrue()."
                ";
                        

        return DB::fetch($sql);
    }    
    public function getInvoiceHasPrinted($invoice){
                        
        $sql=" select * FROM tr_invoices_printed where i_invoice='".$invoice."' ";        
        
        return DB::fetch($sql);
    }
    public function getInvoiceHasRemind($invoice){
                        
        $sql=" select * FROM tr_invoices_reminder_duedate where i_invoice='".$invoice."' ";        
        
        return DB::fetch($sql);
    }
    public function getInvoiceItems($id){
        $sql=" select *
                FROM tr_invoices_item
                WHERE i_invoice = '".$id."' 
                ";
                            
        return DB::fetch($sql);
    }
    public function getInvoiceByTodayLatePayment(){
                        
        $sql=" select a.*,
                b.id as event_code,
                b.event_name,
                b.images_file
               FROM tr_invoices a LEFT JOIN tr_events b ON a.f_code = b.code 
               where a.late_payment_date='".date('Y-m-d')."' AND a.status=".Helper::_getTrue()." AND a.i_pym_sts=".Helper::_getTrue()." AND a.is_sendmail=".Helper::_getTrue()."  ";        
                
        
        return DB::fetch($sql);
    }
}
?>

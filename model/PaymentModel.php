<?php

include_once './DB.php';
include_once './Helper.php';

class PaymentModel extends DB{
            
    public function getPaymentByStatus($sts){
        $sql="SELECT a.* ,
                b.bill_to,
                b.code as i_invoice,
                b.i_booking,
                b.email,
                b.due_date,
                b.created_at,
                c.is_completed,
                c.count_remind,
                c.is_send_info_completed
                FROM tr_payments a LEFT JOIN tr_invoices b ON a.i_invoice = b.code
                LEFT JOIN tr_invoices_property c ON b.code = c.i_invoice                
                WHERE a.i_pym_sts='".$sts."'
                GROUP BY b.code 
                ORDER BY a.id ";
                
        return DB::fetch($sql);
    }
    
    public function getPaymentCompleted(){
        $sql="SELECT a.* ,
                b.bill_to,
                b.code as i_invoice,
                b.i_booking,                
                b.email,
                b.due_date,
                b.created_at,
                c.is_completed,
                c.count_remind,
                c.is_send_info_completed
                FROM tr_payments a LEFT JOIN tr_invoices b ON a.i_invoice = b.code 
                LEFT JOIN tr_invoices_property c ON b.code = c.i_invoice
                WHERE c.is_completed=".Helper::_getTrue()." AND c.is_send_info_completed=".Helper::_getTrue()."                
                ORDER BY c.id DESC ";
                
        return DB::fetch($sql);
    }
    public function getSendMailPaymentCompleted(){
        $sql="SELECT a.* ,
                b.bill_to,
                b.code as i_invoice,
                b.i_booking,
                b.address,
                b.email,
                b.phone,
                b.fullname,
                b.due_date,
                b.created_at as invoice_date,
                c.is_completed,
                c.count_remind,
                c.is_send_info_completed,
                d.event_name,
                e.name as payment_status,
                f.method_name as payment_method
                FROM tr_payments a LEFT JOIN tr_invoices b ON a.i_invoice = b.code 
                LEFT JOIN tr_invoices_property c ON b.code = c.i_invoice
                LEFT JOIN tr_events d ON b.f_code = d.code
                LEFT JOIN tm_payment_status e ON a.i_pym_sts = e.id
                LEFT JOIN tm_payment_method f ON a.i_pym_mthd = f.id
                WHERE c.is_completed=".Helper::_getTrue()." AND c.is_send_info_completed=".Helper::_getFalse()."                
                ORDER BY c.id DESC ";
                
        return DB::fetch($sql);
    }
}
?>

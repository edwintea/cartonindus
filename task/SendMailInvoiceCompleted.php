<?php

include_once('Config.php');
include_once('Helper.php');
include_once('Email.php');

include_once('model/UserModel.php');
include_once('model/TicketModel.php');
include_once('model/EventModel.php');
include_once('model/InvoiceModel.php');
include_once('model/PaymentModel.php');

require_once('lib/dompdf/autoload.inc.php');


/*
 * trigger
 * *  tr_payments i_pym_sts=6
 *  tr_events_ticket_book is_printed=0
 */


class SendMailInvoiceCompleted{
    
    protected $config;
    
    public function __construct() {
        
        $this->config = new Config();       
        
    }

    public function go(){
                                   
        $email = new Email();
        
        $invoice = new InvoiceModel();
        
        $payments = new PaymentModel();
        $payment = $payments->getSendMailPaymentCompleted(); //completed or paid trigger by admin        
                           
        if(count($payment) > 0){
            
            $helper = new Helper();
            
            echo "Found ".count($payment)." Completed Invoices \n";
            
            foreach($payment as $v){                                
                                                                                                                            
                //trap user detail as pembooking
                $member = new UserModel();
                $member = $member->getUserByUserId($v['bill_to']);
                                                                                                                               
                    
                $data=array(                        
                    'red_url'   =>  $this->config->getBaseUrl()."invoice/".base64_encode($v['i_invoice']),
                    'to'        =>  $v['email'],
                    'name'      =>  $v['fullname'],
                    'subject'   =>  "Everyvents - Invoice Completed ".$v['i_invoice']." a/n ".ucwords($v['fullname'])." Event :".$v['event_name'],
                    'due_date'  =>  $this->config->formatDate($v['due_date']),
                    'inv_date'  =>  $this->config->formatDate($v['invoice_date']),                        
                    'invoices'  =>  $payment,
                    'inv_items' =>  $items = $invoice->getInvoiceItems($v['i_invoice'])                    
                );                    


                echo "Sending Invoice complete ".$v['i_invoice']." to ".$v['email']."...\n";

                $mail = $email->_blast($this->_sendInvoice($data), $data);                


                if($mail['status'] == 1){

                    //post
                    echo $mail['message']."\n";

                    //update invoice status
                    DB::update('tr_invoices_property','i_invoice',$v['i_invoice'],array(                        
                        'is_send_info_completed'    =>  1
                    ));

                }else{

                    echo $mail['message']."\n";

                }                                                                                           
                
            }
                    
        }else{
            
            echo "Not Found!";
        } 
        
    }
    public function _sendInvoice($data){
        
        $tpl = "";
                        
        $tpl.="<html xmlns='http://www.w3.org/1999/xhtml'>";
        $tpl.="<head>";
        $tpl.="<meta charset='UTF-8'>";
        $tpl.="<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
        $tpl.="<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        $tpl.="<title>Everyvents | Invoice</title>";
        
        $tpl.="<style type='text/css'>body{font-family:Lucida sans,Helvetica,Sans-serif;font-size:12px;color:#252525}.container{width:700px;background:red;min-height:100px;margin-left:auto;margin-right:auto}.box,.header{min-height:10px}.box{background:#fff;width:auto}.btn-more{background:#959595;border:none;border-radius:5px;padding:12px;color:#fff;margin-top:15px;margin-bottom:15px;cursor:pointer}.header,tr:nth-of-type(odd){background:0 0}.header{width:100%;padding-top:12px;padding-bottom:12px}.header .left{width:50%;float:left}.header .right{width:50%;float:right;text-align:right}.invoice{width:100%}.invoice .left{width:50%;float:left}.invoice .left .to{margin-bottom:10px}.invoice .right{width:50%;float:right;padding-top:20px;text-align:right}.order{width:auto;min-height:150px;padding-top:15px;padding-bottom:15px}.order .title-order{font-size:23px}.order .no-order{font-size:14px}.footer,table{font-size:12px}table{width:100%;border-collapse:collapse}th{border-top:1px solid #ebebeb;padding:5px 0}td{padding:0;text-align:left}.table-size{width:15%}.table-size-event{width:30%}.title-padding{padding-top:8px;padding-bottom:8px}.title-sub-padding{padding-top:2px;padding-bottom:4px}.center-position{text-align:center}.left-position{text-align:left}.right-position{text-align:right}.footer,.payment{text-align:center;width:auto;min-height:10px}.payment{background:#0669B2;padding:20px;color:#fff}.footer .note,.footer a{color:#0669B2}.footer{background:#fff;padding:30px 20px}.footer a{text-decoration:none}.footer a:hover{opacity:.9}.clearer{clear:both}@media (max-width:720px){.header .left,.header .right,.invoice .left{float:left;text-align:center;width:100%}.container{width:auto}.header .left{margin-bottom:15px}.invoice .right{width:100%;float:right;padding-top:20px;text-align:center}}@media (min-width:581px){.tr-title-mobile{display:none}}@media (max-width:580px){.table-size-event{width:100%}table thead tr{display:none}.table-size{width:none}.table-size-mobile{width:100%;display:block}.td-sub-mobile{width:100%;float:left}.table-size-total-mobile{display:none}.center-position,.left-position,.right-position{text-align:center}}</style>";
        
        $tpl.="</head>";
        $tpl.="<body>";
        
            if(count($data['invoices']) > 0){
                foreach($data['invoices'] as $inv){

                    $tpl.="<div class='container'>";
                        $tpl.="<div class='box'>";
                            $tpl.="<div class='header'>";
                                $tpl.="<div class='left'>";
                                    $tpl.="<img src='http://everyvents.com/dev/everyvents/assets/img/logo-email.png'>";
                                $tpl.="</div>";
                                $tpl.="<div class='right'>";
                                    $tpl.="Plaza Kuningan <br/>";
                                    $tpl.="Menara Utara Lt. 10 <br/>";
                                    $tpl.="Jl. H.R. Rasuna Said Kav. C11-14 <br/>";
                                    $tpl.="Jakarta Selatan 12940";
                                $tpl.="</div>";
                                $tpl.="<div class='clearer'></div>";
                            $tpl.="</div>";

                            $tpl.="<div class='invoice'>";
                                $tpl.="<div class='left'>";
                                    $tpl.="<div class='to'><b>Invoiced To</b></div>";
                                    $tpl.=ucwords($inv['fullname'])."<br/>";
                                    $tpl.=$inv['address']."<br/>";
                                    $tpl.=$inv['email']."<br/>";
                                    $tpl.=$inv['phone']."<br/>";
                                    $tpl.=" Payment Status : ".$inv['payment_status']."";
                                $tpl.="</div>";
                                $tpl.="<div class='right'>";
                                    $tpl.="No. #".$inv['code']."<br />";
                                    $tpl.="Invoice Date: ".$data['inv_date']."<br />";
                                    $tpl.="Due Date: ".$data['due_date'];
                                $tpl.="</div>";
                                $tpl.="<div class='clearer'></div>";
                            $tpl.="</div>";
                            $tpl.="<div class='order'>";
                                $tpl.="<table>";
                                    $tpl.="<thead>";
                                        $tpl.="<tr>";
                                            $tpl.="<th class='left-position table-size-event title-padding'>";
                                                $tpl.="<b>Events</b>";
                                            $tpl.="</th>";
                                            $tpl.="<th class='center-position table-size title-padding'>";
                                                $tpl.="<b>Type</b>";
                                            $tpl.="</th>";
                                            $tpl.="<th class='center-position table-size title-padding'>";
                                                $tpl.="<b>Price</b>";
                                            $tpl.="</th>";
                                            $tpl.="<th class='center-position table-size title-padding'>";
                                                $tpl.="<b>Quantity</b>";
                                            $tpl.="</th>";
                                            $tpl.="<th class='right-position table-size title-padding'>";
                                                $tpl.="<b>Total</b>";
                                            $tpl.="</th>";
                                        $tpl.="</tr>";
                                    $tpl.="</thead>";
                                    $tpl.="<tbody>";
                                        $tpl.="<tr style='border-top: 1px solid #ebebeb;'>";
                                            $tpl.="<td class='left-position table-size-event table-size-mobile' style='padding-top: 12px; padding-bottom:12px; vertical-align: top;'>";
                                            
                                                $tpl.=ucwords($inv['event_name']);
                                                
                                            $tpl.="</td>";
                                            $tpl.="<td class='center-position td-sub-mobile' colspan='4'>";
                                                $tpl.="<table style='margin-top: 8px; margin-bottom: 8px;'>";
                                                    $tpl.="<tbody>";

                                                        $tpl.="<tr class='tr-title-mobile' style='border-top: 1px solid #ebebeb; border-bottom: 1px solid #ebebeb;'>";
                                                            $tpl.="<td class='center-position table-size title-padding'><b>Type</b></td>";
                                                            $tpl.="<td class='center-position table-size title-padding'><b>Price</b></td>";
                                                            $tpl.="<td class='center-position table-size title-padding'><b>Quantity</b></td>";
                                                            $tpl.="<td class='right-position table-size title-padding'><b>Total</b></td>"; 
                                                        $tpl.="</tr>";


                                                        if(count($data['inv_items']) > 0){

                                                            $grand_total=0;

                                                            foreach($data['inv_items'] as $item){

                                                                $currency = $item['currency'];
                                                                $sub_total = $item['amount'] * $item['qty'];
                                                                $total=0;
                                                                $total+=$item['amount'];
                                                                $grand_total+=$sub_total;

                                                                $tpl.="<tr>";
                                                                    $tpl.="<td class='center-position table-size title-sub-padding'>".$item['item']."</td>";
                                                                    $tpl.="<td class='center-position table-size title-sub-padding'>".$item['currency']." ".number_format($item['amount'], 0, '.', ',')."</td>";
                                                                    $tpl.="<td class='center-position table-size title-sub-padding'>".$item['qty']."</td>";
                                                                    $tpl.="<td class='right-position table-size title-sub-padding'>".$item['currency']." ".number_format($sub_total, 0, '.', ',')."</td>";
                                                                $tpl.="</tr>";
                                                            }                                                
                                                        }

                                                    $tpl.="</tbody>";
                                                $tpl.="</table>";
                                            $tpl.="</td>";
                                        $tpl.="</tr>";

                                        $tpl.="<tr style='border-top: 1px solid #ebebeb;'>";
                                            $tpl.="<td class='center-position' colspan='5'>";
                                                $tpl.="<table>";
                                                    $tpl.="<tbody>";
                                                        $tpl.="<tr style='border-bottom: 1px solid #ebebeb;' >";
                                                            $tpl.="<td class='center-position table-size title-padding'></td>";
                                                            $tpl.="<td class='center-position table-size title-padding'></td>";
                                                            $tpl.="<td class='right-position table-size title-padding'>";
                                                                $tpl.="<b>Sub Total</b>";
                                                            $tpl.="</td>";
                                                            $tpl.="<td class='right-position table-size title-padding'>";
                                                                $tpl.=$currency." ".number_format($grand_total, 0, '.', ',');
                                                            $tpl.="</td>";
                                                        $tpl.="</tr>";
                                                        $tpl.="<tr style='border-bottom: 1px solid #ebebeb;' >";
                                                            $tpl.="<td class='center-position table-size title-padding'></td>";
                                                            $tpl.="<td class='center-position table-size title-padding'></td>";
                                                            $tpl.="<td class='right-position table-size title-padding'>";
                                                                $tpl.="<b>Total</b>";
                                                            $tpl.="</td>";
                                                            $tpl.="<td class='right-position table-size title-padding'>";
                                                                $tpl.=$currency." ".number_format($grand_total, 0, '.', ',');
                                                            $tpl.="</td>";
                                                        $tpl.="</tr>";
                                                    $tpl.="</tbody>";
                                                $tpl.="</table>";
                                            $tpl.="</td>";
                                        $tpl.="</tr>";
                                    $tpl.="</tbody>";
                                $tpl.="</table>";
                            $tpl.="</div>";

                            $tpl.="<div class='payment'>";
                                $tpl.="Payment Method ".$inv['payment_method']."<br />";
                                $tpl.="Date Of Payment: ".$data['due_date']."";
                                $tpl.="Completed";
                            $tpl.="</div>";
                                                        
                        $tpl.="</div>";
                    $tpl.="</div>";
                }
            }
            
        $tpl.="</body>";
        $tpl.="</html>";
        
        
        return $tpl;
    }     
    
}
?>

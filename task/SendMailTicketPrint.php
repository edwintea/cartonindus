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


class SendMailTicketPrint{
    
    protected $config;
    
    public function __construct() {
        
        $this->config = new Config();       
        
    }

    public function go(){
                                   
        $email = new Email();
        
        $invoice = new InvoiceModel();
        
        $payment = new PaymentModel();
        //$d = $payment->getPaymentByStatus(6); //completed or paid trigger by admin
        $d = $payment->getPaymentCompleted();
           
        
        if(count($d) > 0){
            
            echo "Found ".count($d)." Completed Invoice \n";
            
            foreach($d as $v){                                
                                                                                            
                //trap user detail as pembooking
                $member = new UserModel();
                $member = $member->getUserByUserId($v['bill_to']);
                                                       
                //get the ticket list
                $tickets = new TicketModel();
                $tickets = $tickets->getTicketByBookingId($v['i_booking']);
                                  
                
                if(count($tickets) > 0){
                    
                    $helper = new Helper();
                    
                    foreach($tickets as $t){
                        
                        if($t['is_printed'] ==0){

                            //send ticket to email booker with attachment
                            echo "Send ticket for Invoice ".$v['i_invoice']." barcode : ".$t['i_barcode']." to ".$t['first_name']." with email : ". $t['email']." \n";

                            //send ticket by email
                                                        
                            $data=array(
                                'cdn'           =>  $this->config->getBaseCdn(),
                                'red_url'       =>  $this->config->getBaseUrl()."invoice/".base64_encode($t['invoice_code']),
                                'red_group'     =>  $this->config->getBaseUrl()."ev/group/".$helper->clearUrl($t['group_name'])."-".$t['i_group'],
                                'red_event'     =>  $this->config->getBaseUrl()."ev/ticket/".$helper->clearUrl($t['event_name'])."-".$t['event_id'],
                                'to'            =>  $t['email'],
                                'name'          =>  $t['first_name'],
                                'subject'       =>  "Everyvents - e-Ticket a/n ".ucwords($t['first_name'])." Event : ".$t['event_name'],                                
                                'event_image'   =>  $this->config->getBaseCdn().$t['images_file'],
                                'event_location'=>  $t['event_url_location'],
                                'start_date'    =>  $t['s_day'].",".$t['s_date']." ".$t['s_month']." ".$t['s_year'],
                                'end_date'      =>  $t['e_month'].",".$t['e_day']." ".$t['e_date']." ".$t['e_year'],
                                'ticket'        =>  $t,
                                'tickets'       =>  $invoice->getInvoiceItems($t['invoice_code'])                                
                            );
                            
                            echo "Printing ticket for ".$t['first_name']." with barcode : ".$t['i_barcode']."\n";
                                
                            
                            //CREATE TICKET FOR ATTACHMENT
                            $data['attachment']=$this->createTicket($t);
                                                                                                                                                                                                                            
                            //sen ticket by email
                            $mail = $email->_blast($this->_getTemplateTicket($data), $data);

                            if($mail['status']==1){                                                                                                                               
                                
                                //update invoice status                                
                                DB::update('tr_invoices', 'code', $v['i_invoice'], array(
                                    'i_pym_sts' =>   6,
                                    'payment_date'  =>  date('Y-m-d H:i:s')
                                ));
                                
                                //update flag is_printed=1 for ticket actiation
                                DB::update('tr_events_ticket_book', 'i_owner', $t['owner'], array(
                                    'is_printed'     =>  1,
                                    'printed_date'  =>  date('Y-m-d H:i:s'),
                                    'status'        =>  1
                                ));
                                                                                                                                

                            }else{

                                echo "Status Error coy : ".$mail['message'];

                            }
                        }else{

                            echo "[ Tidak ada tiket yang harus di cetak ] \n";

                        }                                                                
                    }                                                                                
                }                                                                                
            }
            
        }else{
            
            echo "Not found! \n";
        } 
        
    }
    public function _getTemplateTicket($data){
        
        $tpl = "";        
        
        $tpl.=$tpl.="<html xmlns='http://www.w3.org/1999/xhtml'>";
        $tpl.="<head>";
        $tpl.="<meta charset='UTF-8'>";
        $tpl.="<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
        $tpl.="<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        $tpl.="<title>Everyvents | Ticket Confirmation</title>";
        
        $tpl.="<style type='text/css'>.content .box-event .left .box-event-info .info-icon .detail a:hover,.content .title-event a:hover,.content a:hover,.e-tickets .box-e-tickets .mobile .link a:hover,.fitur .box-fitur .learn-more a:hover,.footer .link-footer a:hover,.footer a:hover,.search .box-search .left-search a:hover img,.search .box-search .right-search a:hover img{opacity:.9}body{font-family:Lucida sans,Helvetica,Sans-serif;font-size:12px;color:#252525}.container{width:660px;background:#f5f5f5;min-height:100px;margin-left:auto;margin-right:auto;padding:20px}.box,.header{min-height:10px}.box{background:#fff;width:auto}.header{width:100%;background:0 0;padding-top:12px;padding-bottom:12px;text-align:center}.header img{width:194px}.banner,.banner img{width:100%;min-height:10px}.info-event{background:#0669b2;width:auto;color:#fff;text-align:center;font-size:13px;padding:12px 25px}.info-event .left-border,.info-event .right-border{height:1px;background:#fff;margin-top:7px;float:left}.content .title-event a,.content a{color:#252525}.info-event .left-border{width:20%}.info-event .center-border{width:60%;float:left}.info-event .right-border{width:20%}.content{width:auto;min-height:200px;padding:20px}.content a{text-decoration:none}.content .title-event{font-size:15px;text-align:center;margin-bottom:15px}.content .title{font-size:14px;margin-bottom:20px;text-align:left}.btn-more{background:#959595;border:none;border-radius:5px;padding:8px;color:#fff;margin-top:15px;margin-bottom:15px;cursor:pointer}.content .box-event{min-height:120px;border-bottom:1px solid #c3c3c3;margin-top:15px}.content .box-event .left{width:59%;float:left;min-height:120px;border-right:1px solid #c3c3c3}.content .box-event .left .box-event-info{width:100%;min-height:10px;margin-bottom:8px}.content .box-event .left .box-event-info .icon{width:20px;min-height:10px;float:left;text-align:center}.content .box-event .left .box-event-info .info-icon{width:80%;min-height:10px;float:left;margin-left:10px}.content .box-event .left .box-event-info .info-icon .detail{margin-bottom:5px}.e-tickets .box-e-tickets .mobile img,.e-tickets .box-e-tickets .paper img{margin-bottom:15px}.content .box-event .left .box-event-info .info-icon .detail a{color:#1e5883;margin-right:15px}.content .box-event .right{width:40%;float:right;min-height:120px}.e-tickets{width:auto;padding:0 20px 20px;min-height:100px}.e-tickets .e-tickets-title{text-align:center;font-size:15px}.e-tickets .box-e-tickets{width:400px;margin-top:20px;min-height:10px;margin-left:auto;margin-right:auto}.e-tickets .box-e-tickets .mobile{width:50%;min-height:10px;float:left;text-align:center}.e-tickets .box-e-tickets .mobile .link a{color:#0669B2;text-decoration:none}.e-tickets .box-e-tickets .paper{width:50%;min-height:10px;float:right;text-align:center;padding-top:9px}.e-tickets .box-e-tickets .paper .link a{color:#0669B2;text-decoration:none}.e-tickets .box-e-tickets .paper .link a:hover{opacity:.9}.fitur{background:#f5f5f5;width:auto;min-height:100px;padding:20px;font-size:12px}.fitur .box-fitur{width:33.333%;min-height:50px;text-align:center;float:left}.fitur .box-fitur .icon-fitur{display:table;width:100%;height:82px}.fitur .box-fitur .icon-fitur .position{display:table-cell;vertical-align:bottom}.fitur .box-fitur .title-fitur{margin-top:15px;font-size:12px}.fitur .box-fitur .border-fitur{width:60px;height:2px;background:#252525;margin:8px auto}.order,th{background:#959595}.fitur .box-fitur .description-fitur{margin-bottom:8px;min-height:50px;font-size:12px}.fitur .box-fitur .learn-more{color:#0669B2;font-size:12px}.fitur .box-fitur .learn-more a{color:#0669B2;text-decoration:none}.order,.search,th{color:#fff}.order{width:auto;min-height:150px;padding:30px 50px}td,th{padding:5px 0}.order .title-order{font-size:23px}.order .no-order{font-size:14px}.order .ticket-order{text-align:center;font-size:13px;margin-top:20px;margin-bottom:20px}table{width:100%;border-collapse:collapse;font-size:13px}tr:nth-of-type(odd){background:0 0}th{font-weight:700;border-top:1px solid #fff}td{text-align:left}.table-size{width:25%}.center-position{text-align:center}.left-position{text-align:left}.right-position{text-align:right}.search{background:#0669B2;width:auto;min-height:10px;padding:20px}.footer .link-footer a,.footer a{color:#0669B2}.search .box-search{width:100%;min-height:10px}.search .box-search .left-search{width:50%;min-height:10px;float:left}.search .box-search .left-search .title-search{width:100%;margin-bottom:8px;font-size:13px}.search .box-search .right-search{width:50%;min-height:10px;float:right;text-align:right}.search .box-search .right-search .title-search{width:100%;margin-bottom:8px;font-size:13px}.search .box-search .right-search img{margin-left:5px}.footer{text-align:center;background:#fff;width:auto;min-height:10px;font-size:12px;padding:30px 20px}.footer a{text-decoration:none}.footer .link-footer{width:100%;margin-top:20px;font-size:11px}.footer .copyright{color:#898888;font-size:12px}.clearer{clear:both}@media (max-width:720px){.container{width:auto}}@media (min-width:581px){.tr-title-mobile{display:none}}@media (max-width:580px){.fitur .box-fitur{width:100%;margin-top:10px;margin-bottom:10px}.fitur .box-fitur .description-fitur{min-height:10px}table thead tr{display:none}.table-size{width:none}.table-size-mobile{width:100%;display:block}.td-sub-mobile{width:100%;float:left}.table-size-total-mobile{display:none}.order{padding:20px}.center-position,.left-position,.right-position{text-align:center}}@media (max-width:480px){.search .box-search .left-search{width:100%;text-align:center}.search .box-search .right-search{width:100%;text-align:center;margin-top:10px}.info-event .left-border,.info-event .right-border{margin-top:0;width:100%}.info-event .center-border{width:100%;padding-top:8px;padding-bottom:8px}.content .box-event .left{width:100%;border-right:none;border-bottom:1px solid #c3c3c3}.content .box-event .right{width:100%;min-height:10px;padding-top:10px}.e-tickets .box-e-tickets,.e-tickets .box-e-tickets .mobile{width:100%}.e-tickets .box-e-tickets .paper{width:100%;margin-top:20px}}</style>";
        
        $tpl.="</head>";

        $tpl.="<body>";
            $tpl.="<div class='container'>";
                $tpl.="<div class='box'>";
                    $tpl.="<div class='header'>";
                        $tpl.="<img src='http://everyvents.com/dev/everyvents/assets/img/logo-email.png'>";
                    $tpl.="</div>";

                    $tpl.="<div class='info-event'>";
                        $tpl.="<div class='left-border'></div>";
                        $tpl.="<div class='center-border'>";

                            $tpl.="Don't forget attend your event on ".$data['start_date'];

                        $tpl.="</div>";
                        $tpl.="<div class='right-border'></div>";
                        $tpl.="<div class='clearer'></div>";
                    $tpl.="</div>";

                    $tpl.="<div class='banner'>";
                        $tpl.="<a href='".$data['red_event']."'>";
                            $tpl.="<img src='".$data['event_image']."'>";
                        $tpl.="</a>";
                    $tpl.="</div>";

                    $tpl.="<div class='content'>";
                        $tpl.="<div class='title-event'>";
                            $tpl.="<a href='".$data['red_event']."'>".$data['ticket']['event_name']."</a>";
                        $tpl.="</div>";
                        
                        $tpl.="<div class='title'>";
                            $tpl.="Event Address";
                        $tpl.="</div>";
                                                
                        $tpl.="<img src='".$data['event_location']."' style='width: 100%;'>";

                        $tpl.="<div class='box-event'>";
                            $tpl.="<div class='left'>";
                                $tpl.="<div class='box-event-info'>";
                                    $tpl.="<div class='icon'>";
                                         $tpl.="<img src='http://everyvents.com/dev/everyvents/assets/img/icon-calender-email.png'>";
                                    $tpl.="</div>";
                                    $tpl.="<div class='info-icon'>";
                                        $tpl.="<div class='detail'>";
                                            $tpl.="TANGGAL EVENT<br/>";
                                            $tpl.="From ".$data['start_date']." </b>";
                                            $tpl.="to ";
                                            $tpl.=$data['end_date'];
                                        $tpl.="</div>";
                                    $tpl.="</div>";
                                    $tpl.="<div class='clearer'></div>";
                                $tpl.="</div>";
                                $tpl.="<div class='box-event-info'>";
                                    $tpl.="<div class='icon'>";
                                         $tpl.="<img src='http://everyvents.com/dev/everyvents/assets/img/icon-maps-email.png'>";
                                    $tpl.="</div>";
                                    $tpl.="<div class='info-icon'>";
                                        $tpl.="<div class='detail'>";
                                            $tpl.=$data['ticket']['event_address'];
                                        $tpl.="</div>";
                                    $tpl.="</div>";
                                    $tpl.="<div class='clearer'></div>";
                                $tpl.="</div>";
                                $tpl.="<div class='box-event-info'>";
                                    $tpl.="<div class='icon'>";
                                         $tpl.="<img src='http://everyvents.com/dev/everyvents/assets/img/Add-to-calendar.jpg'>";
                                    $tpl.="</div>";
                                    $tpl.="<div class='info-icon'>";
                                        $tpl.="<div class='detail'>";
                                            $tpl.="Add to my calender :<br/>";
                                            $tpl.="<a href='#'>";
                                                $tpl.="Google";
                                            $tpl.="</a>";
                                            $tpl.="<a href='#'>";
                                                $tpl.="Outlook";
                                            $tpl.="</a>";
                                            $tpl.="<a href='#'>";
                                                $tpl.="iCal";
                                            $tpl.="</a>";
                                            $tpl.="<a href='#'>";
                                                $tpl.="Yahoo";
                                            $tpl.="</a>";
                                        $tpl.="</div>";
                                    $tpl.="</div>";
                                    $tpl.="<div class='clearer'></div>";
                                $tpl.="</div>";
                            $tpl.="</div>";
                            $tpl.="<div class='right'>";
                                $tpl.="<div align='center'>";
                                    $tpl.="If you need quest on <br />";
                                    $tpl.="about this event";
                                $tpl.="</div>";
                                $tpl.="<div align='center'>";
                                    $tpl.="<a href='".$data['red_group']."'>";
                                        $tpl.="<button class='btn-more'>";
                                            $tpl.="CONTACT ORGANIZER";
                                        $tpl.="</button>";
                                    $tpl.="</a>";
                                $tpl.="</div>";
                            $tpl.="</div>";
                            $tpl.="<div class='clearer'></div>";
                        $tpl.="</div>";
                    $tpl.="</div>";
                    $tpl.="<div class='e-tickets'>";
                        $tpl.="<div class='e-tickets-title'>";
                            $tpl.="Get your offline e-Tickets!<br />";
                            $tpl.="Just show throught your EVERYVENTS App or download paper ticket";
                        $tpl.="</div>";
                        $tpl.="<div class='box-e-tickets'>";
                            $tpl.="<div class='mobile'>";
                                $tpl.="<img src='http://everyvents.com/dev/everyvents/assets/img/phone-icon.png'>";
                                $tpl.="<div class='link'><a href='#'>Mobile Tickets</a></div>";
                            $tpl.="</div>";
                            $tpl.="<div class='paper'>";
                                $tpl.="<img src='http://everyvents.com/dev/everyvents/assets/img/ticket-icon.png'>";
                                $tpl.="<div class='link'>";
                                    $tpl.="<a href='#'>Paper Tickets</a>";
                                $tpl.="</div>";
                            $tpl.="</div>";
                            $tpl.="<div class='clearer'></div>";
                        $tpl.="</div>";
                    $tpl.="</div>";

                    $tpl.="<div class='order'>";
                        if(count($data['tickets']) > 0){

                            $tpl.="<div class='title-order'>ORDER SUMMARY</div>";
                            $tpl.="<div class='no-order'>Order #".$data['ticket']['invoice_code']."</div>";
                            $tpl.="<div class='ticket-order'>";
                                $tpl.="ALL TICKETS PURCHASED FOR THIS EVENT";
                            $tpl.="</div>";

                            $tpl.="<table>";
                                $tpl.="<thead>";
                                    $tpl.="<tr>";
                                        $tpl.="<th class='left-position table-size'>Name</th>";
                                        $tpl.="<th class='center-position table-size'>Ticket</th>";
                                        $tpl.="<th class='center-position table-size'>Quantity</th>";
                                        $tpl.="<th class='right-position table-size'>Price</th>";
                                    $tpl.="</tr>";
                                $tpl.="</thead>";
                                $tpl.="<tbody>";

                                    $tpl.="<tr style='border-top: 1px solid #fff;'>";
                                        $tpl.="<td class='left-position table-size  table-size-mobile'' style='padding-top: 12px; vertical-align: top;'>";
                                            $tpl.="James";
                                        $tpl.="</td>";
                                        $tpl.="<td class='center-position td-sub-mobile' colspan='3'>";
                                            $tpl.="<table>";
                                                $tpl.="<tbody>";
                                                    $tpl.="<tr class='tr-title-mobile' style='border-top: 1px solid #fff; border-bottom: 1px solid #fff;'>";
                                                        $tpl.="<td class='center-position table-size'>Tickets</td>";
                                                        $tpl.="<td class='center-position table-size'>Quantity</td>";
                                                        $tpl.="<td class='right-position table-size'>Price</td> ";
                                                    $tpl.="</tr>";


                                                    $sub_total=0;
                                                    $grand_total=0;                                        

                                                    foreach($data['tickets'] as $ticket){

                                                        $curency = $ticket['currency'];
                                                        $total =  $ticket['qty'] * $ticket['amount'];
                                                        $sub_total +=$total;
                                                        $grand_total =$sub_total;


                                                        $tpl.="<tr>";
                                                            $tpl.="<td class='center-position table-size'>".$ticket['item']."</td>";
                                                            $tpl.="<td class='center-position table-size'>".$ticket['qty']."</td>";
                                                            $tpl.="<td class='right-position table-size'>".$ticket['currency']." ".number_format($ticket['amount'], 0, '.', ',')."</td> ";
                                                        $tpl.="</tr>";

                                                    }

                                                $tpl.="</tbody>";
                                            $tpl.="</table>";
                                        $tpl.="</td>";
                                    $tpl.="</tr>";
                                    $tpl.="<tr style='border-top: 1px solid #fff;'>";
                                        $tpl.="<td class='left-position table-size table-size-total-mobile' style='padding-top: 12px; vertical-align: top;'>";

                                        $tpl.="</td>";
                                        $tpl.="<td class='center-position' colspan='3'>";
                                            $tpl.="<table>";
                                                $tpl.="<tbody>";
                                                    $tpl.="<tr>";
                                                        $tpl.="<td class='center-position table-size'></td>";
                                                        $tpl.="<td class='center-position table-size'>Sub Total</td>";
                                                        $tpl.="<td class='right-position table-size'>".$curency." ".number_format($sub_total, 0, '.', ',')."</td>"; 
                                                    $tpl.="</tr>";
                                                    $tpl.="<tr>";
                                                        $tpl.="<td class='center-position table-size'></td>";
                                                        $tpl.="<td class='center-position table-size'>Total</td>";
                                                        $tpl.="<td class='right-position table-size'>".$curency." ".number_format($grand_total, 0, '.', ',')."</td>"; 
                                                    $tpl.="</tr>";
                                                $tpl.="</tbody>";
                                            $tpl.="</table>";
                                        $tpl.="</td>";
                                    $tpl.="</tr>";
                                $tpl.="</tbody>";
                            $tpl.="</table>";
                        }

                    $tpl.="</div>";

                    $tpl.="<div class='fitur'>";
                        $tpl.="<div class='box-fitur'>";
                            $tpl.="<div class='icon-fitur'>";
                                $tpl.="<div class='position'>";
                                    $tpl.="<img src='http://everyvents.com/dev/everyvents/assets/img/create-your-own-event.png'>";
                                $tpl.="</div>";
                            $tpl.="</div>";
                            $tpl.="<div class='title-fitur'>CREATE YOUR OWN EVENT</div>";
                            $tpl.="<div class='border-fitur'></div>";
                            $tpl.="<div class='description-fitur'>";
                                $tpl.="Anyone can sell tickets or <br />";
                                $tpl.="manage registration with <br />everyvents";
                            $tpl.="</div>";
                            $tpl.="<div class='learn-more'>";
                                $tpl.="<a href='".$data['red_url']."'>Learn More</a>";
                            $tpl.="</div>";
                        $tpl.="</div>";
                        $tpl.="<div class='box-fitur'>";
                            $tpl.="<div class='icon-fitur'>";
                                $tpl.="<div class='position'>";
                                    $tpl.="<img src='http://everyvents.com/dev/everyvents/assets/img/explore-great-event.png'>";
                                $tpl.="</div>";
                            $tpl.="</div>";
                            $tpl.="<div class='title-fitur'>EXPLORE GREAT EVENT</div>";
                            $tpl.="<div class='border-fitur'></div>";
                            $tpl.="<div class='description-fitur'>";
                                $tpl.="Find local events that <br /> match your passions";
                            $tpl.="</div>";
                            $tpl.="<div class='learn-more'>";
                                $tpl.="<a href='".$data['red_url']."event-tickets'>See Events</a>";
                            $tpl.="</div>";
                        $tpl.="</div>";
                        $tpl.="<div class='box-fitur'>";
                            $tpl.="<div class='icon-fitur'>";
                                $tpl.="<div class='position'>";
                                    $tpl.="<img src='http://everyvents.com/dev/everyvents/assets/img/get-the-app.png'>";
                                $tpl.="</div>";
                            $tpl.="</div>";
                            $tpl.="<div class='title-fitur'>GET THE APP</div>";
                            $tpl.="<div class='border-fitur'></div>";
                            $tpl.="<div class='description-fitur'>";
                                $tpl.="Find events, but tickets and <br /> access them on your phone";
                            $tpl.="</div>";
                            $tpl.="<div class='learn-more'>";
                                $tpl.="<a href='#'>Download E-App</a>";
                            $tpl.="</div>";
                        $tpl.="</div>";
                        $tpl.="<div class='clearer'></div>";
                    $tpl.="</div>";
                    $tpl.="<div class='search'>";
                        $tpl.="<div class='box-search'>";
                            $tpl.="<div class='left-search'>";
                                $tpl.="<div class='title-search'>";
                                    $tpl.="Find and explore more events on mobile app";
                                $tpl.="</div>";
                                $tpl.="<a href='#'><img src='http://everyvents.com/dev/everyvents/assets/img/itunes.png'></a>";
                                $tpl.="<a href='#'><img src='http://everyvents.com/dev/everyvents/assets/img/google+play.png'></a>";
                            $tpl.="</div>";
                            $tpl.="<div class='right-search'>";
                                $tpl.="<div class='title-search'>";
                                    $tpl.="Find latest promo from everyvents";
                                $tpl.="</div>";
                                $tpl.="<a href='#'><img src='http://everyvents.com/dev/everyvents/assets/img/fb-email.png'></a>";
                                $tpl.="<a href='#'><img src='http://everyvents.com/dev/everyvents/assets/img/instagram-email.png'></a>";
                            $tpl.="</div>";
                            $tpl.="<div class='clearer'></div>";
                        $tpl.="</div>";
                    $tpl.="</div>";
                    $tpl.="<div class='footer'>";   
                        $tpl.="This e-mail was sent to <a href='#'>admin@everyvents.com</a> You are recelving this email because <br /> ";
                        $tpl.="you've previously registred on everyvents.";
                        $tpl.="<div class='link-footer'>";
                            $tpl.="<a href='#'>Unsucbscribe | Contact Us</a>";
                        $tpl.="</div>";
                        $tpl.="<div class='copyright'>";
                            $tpl.="Copyright &copy; ".date('Y')." Everyvents. All rights reserved.";
                        $tpl.="</div>";
                    $tpl.="</div>";
                $tpl.="</div>";
            $tpl.="</div>";
        $tpl.="</body>";
        $tpl.="</html>"; 
    
        
        return $tpl;
    }   
    public function createTicket($data=array()){
                                               
        $barcode = $this->config->createImage($data['barcode'],'png',  './cdn/tickets/barcode/',$data['i_barcode'],TRUE);        
        
        $qrcode = $this->config->createImage($data['QRcode'],'png', './cdn/tickets/qrcode/',$data['i_barcode'],TRUE);
        
        $data['barcode'] = $data['i_barcode'].".png";
                                  
        
        $dompdf = new \Dompdf\Dompdf();        
                
        $file_path = "./cdn/tickets/pdf/".$data['i_barcode'].".pdf";     
                                        
                                                          
        $dompdf->loadHtml($this->renderTicket($data));

        $dompdf->render();

        $output = $dompdf->output();

        file_put_contents($file_path, $output);
                                                
        return $file_path;
                
    }
    public function renderTicket($data=array()){
                                       
        $tpl="<table border='1' style='margin-left: auto; margin-right: auto; padding: 5px; font-family: Lucida sans, Helvetica, Sans-serif; font-size: 11px; border:1px solid #252525'>";
            $tpl.="<tr>";
                $tpl.="<td style='max-width: 60px; padding: 0; border-left: none; border-top: none; border-bottom: none; border-right:1px solid #252525;'>";
                    $tpl.="<div style='transform: rotate(-90deg); -webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg); -ms-transform: rotate(-90deg); font-size: 20px; '>";
                        $tpl.="TICKET";
                    $tpl.="</div>";
                $tpl.="</td>";
                $tpl.="<td style='width: 480px; border:none;'>";
                    $tpl.="<table style='border:none; padding-left: 5px; padding-right: 5px;'>";
                        $tpl.="<tr>";
                            $tpl.="<td style='width: 250; border-left: none; border-top: none; border-bottom: none; border-right:none padding-right: 5px;'>";
                                $tpl.="<div style='width: auto; margin-top: 5px; margin-bottom: 5px;'>";
                                    $tpl.="<div style='width: 32%; float: left;'>";
                                        $tpl.="Event <span style='float: right;'>:</span>";
                                    $tpl.="</div>";
                                    $tpl.="<div style='width: 65%; float: right; padding-left: 5px;'>";
                                        $tpl.=$data['event_name'];
                                    $tpl.="</div>";
                                    $tpl.="<div style='clear: both;'></div>";
                                $tpl.="</div>";
                                $tpl.="<div style='width: auto; margin-top: 5px; margin-bottom: 5px;'>";
                                     $tpl.="<div style='width: 32%; float: left;'>";
                                        $tpl.="Date & Time <span style='float: right;'>:</span>";
                                    $tpl.="</div>";
                                    $tpl.="<div style='width: 65%; float: right; padding-left: 5px;'>";                                
                                        $tpl.=$data['s_date']." ".$data['s_month']." ".$data['s_year'].", ".$data['start_hour'].":".$data['start_minute']." ".$data['start_time'];
                                    $tpl.="</div>";
                                    $tpl.="<div style='clear: both;'></div>";
                                $tpl.="</div>";
                                $tpl.="<div style='width: auto; margin-top: 5px; margin-bottom: 5px;'>";
                                    $tpl.="<div style='width: 32%; float: left;'>";
                                        $tpl.="Location  <span style='float: right;'>:</span>";
                                    $tpl.="</div>";
                                    $tpl.="<div style='width: 65%; float: right; padding-left: 5px;'>";
                                        $tpl.=$data['venue_name'];
                                    $tpl.="</div>";
                                    $tpl.="<div style='clear: both;'></div>";
                                $tpl.="</div>";

                                $tpl.="<div style='width: auto; margin-top: 5px; margin-bottom: 5px;'>";
                                    $tpl.="<div style='width: 32%; float: left;'>";
                                        $tpl.="Name <span style='float: right;'>:</span>";
                                    $tpl.="</div>";
                                    $tpl.="<div style='width: 65%; float: right; padding-left: 5px;'>";
                                        $tpl.=ucwords($data['first_name']);
                                    $tpl.="</div>";
                                    $tpl.="<div style='clear: both;'></div>";
                                $tpl.="</div>";

                                /*
                                $tpl.="<div style='width: auto; margin-top: 5px; margin-bottom: 5px;'>";
                                    $tpl.="<div style='width: 32%; float: left;'>";
                                        $tpl.="Seat  <span style='float: right;'>:</span>";
                                    $tpl.="</div>";
                                    $tpl.="<div style='width: 65%; float: right; padding-left: 5px;'>";
                                        $tpl.="2";
                                    $tpl.="</div>";
                                    $tpl.="<div style='clear: both;'></div>";
                                $tpl.="</div>";
                                */

                                $tpl.="<div style='width: auto; margin-top: 5px; margin-bottom: 5px;'>";
                                    $tpl.="<div style='width: 32%; float: left;'>";
                                        $tpl.="Price  <span style='float: right;'>:</span>";
                                    $tpl.="</div>";
                                    $tpl.="<div style='width: 65%; float: right; padding-left: 5px;'>";
                                        $tpl.=$data['ticket_currency'].". ".number_format($data['ticket_fix_price'], 0, '.', ',');
                                    $tpl.="</div>";
                                    $tpl.="<div style='clear: both;'></div>";
                                $tpl.="</div>";
                                $tpl.="<div style='width: auto; margin-top: 5px; margin-bottom: 5px;'>";
                                    $tpl.="<div style='width: 32%; float: left;'>";
                                        $tpl.="Ticket Type  <span style='float: right;'>:</span>";
                                    $tpl.="</div>";
                                    $tpl.="<div style='width: 65%; float: right; padding-left: 5px;'>";
                                        $tpl.=$data['ticket_name'];                                        
                                    $tpl.="</div>";
                                    $tpl.="<div style='clear: both;'></div>";
                                $tpl.="</div>";

                            $tpl.="</td>";
                            $tpl.="<td style='width: 200px; text-align: right; border-left:1px solid #252525'>";

                                $tpl.="<img src='cdn/img/logo-email.png' style='width: 110px;'>";

                                $tpl.="<div style='width: auto; margin-top: 10px; margin-bottom: 15px;'>";
                                    $tpl.="Want to make great event ? <br/>";
                                    $tpl.="Organized your event with us";
                                $tpl.="</div>";

                                $tpl.="<img src='cdn/img/barcode-ticket.jpg' style='margin-bottom:10px;'>";

                                $tpl.="<div style='width: 100%;'>";
                                    $tpl.="www.everyvents.com";
                                $tpl.="</div>";

                            $tpl.="</td>";
                        $tpl.="</tr>";
                    $tpl.="</table>";

                $tpl.="</td>";
                $tpl.="<td style='width: 60px; padding:0; border-left: 1px solid #252525;; border-top: none; border-bottom: none; border-right:none;'>";
                    $tpl.="<img src='cdn/tickets/barcode/".$data['barcode']."' style='width:100px; transform: rotate(-90deg); -webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg); -ms-transform: rotate(-90deg);'>";
                $tpl.="</td>";
            $tpl.="</tr>";
        $tpl.="</table>";
                    
        $tpl.="<table>";
            $tpl.="<tr>";
                $tpl.="<td>";
                    $tpl.="<img src='cdn/tickets/barcode/".$data['barcode']."'>";
                $tpl.="</td>";
            $tpl.="</tr>";
            $tpl.="<tr>";
                $tpl.="<td>";                    
                    $tpl.=$this->config->setBarcodeNumber($data['i_barcode']);
                $tpl.="</td>";
            $tpl.="</tr>";
        $tpl.="</table>";
        
        
        //save to html file
        $fileHtml = 'cdn/tickets/html/'.$data['i_barcode'].".html";
        
        file_put_contents($fileHtml, $tpl);
        
        return $tpl;
        
    }
    
}
?>

<?php

include_once('Config.php');
include_once('Email.php');

include_once('model/UserModel.php');
include_once('model/EventModel.php');
include_once('model/InvoiceModel.php');
include_once('model/ConfigModel.php');
include_once('model/TicketModel.php');


class AutoCancelBooking{
    
    protected $config;
    protected $helper;
    
    public function __construct() {
        
        $this->config = new Config();
        $this->helper = new Helper();
        
    }

    public function go(){
                                 
        $email = new Email();
        $global_code = new ConfigModel();
        $g_code = $global_code->getGlobalCodeByName('canceled by system');        
        $g_code = count($g_code) > 0?$g_code[0]['code']:NULL;
            
        //echo $g_code;die;
        
        
        $invoice = new InvoiceModel();
        $invoices = $invoice->getInvoiceByTodayLatePayment();
                             
        if(count($invoices) > 0){
            
            echo "Found ".count($invoices)." booking will be canceled! \n";
            
            foreach($invoices as $inv){
                
                echo "send email to user because his invoice has been expire and let join to re-booking..\n";
                
                $data=array(                        
                    'red_url'       =>  $this->config->getBaseUrl(),
                    'cdn'            =>  $this->config->getBaseCdn(),
                    'to'            =>  $inv['email'],
                    'name'          =>  $inv['fullname'],
                    'subject'       =>  "Everyvents - Auto Cancel Booking Event : ".$inv['event_name'],
                    'invoice'       =>  $inv['code'],
                    'event'         =>  $inv['event_name'],
                    'event_image'   =>  $inv['images_file'],
                    'red_url_event' =>  $this->config->getBaseUrl()."ev/ticket/".$this->helper->clearUrl($inv['event_name'])."-".$inv['event_code'],
                    'invoices'      =>  $invoices,
                    'inv_items'     =>  $invoice->getInvoiceItems($inv['code'])

                );                    


                echo "Sending Void Invoice ".$inv['code']." to ".$inv['email']."...\n";

                $mail = $email->_blast($this->_getTemplateAutoCancelBooking($data), $data);       
                    
                if($mail['status'] == 1){
                                              
                    //set flag status booking to 0
                    DB::update('tr_invoices','code',$inv['code'],array(
                        'i_global_code'   =>  $g_code,
                        'updated_at'    =>  date('Y-m-d H:i:s'),
                        'status'        =>  0 
                    ));

                    //set flag status booking to 0 biar tidak resendn email lagi               

                    DB::update('tr_events_book','code',$inv['i_booking'],array(
                        'global_code'   =>  $g_code,
                        'updated_at'    =>  date('Y-m-d H:i:s'),
                        'status'        =>  0 
                    ));

                    //set flag status booking to 0 on bookng items

                    DB::update('tr_events_book_items','i_booking',$inv['i_booking'],array(
                        'description'       =>  "This item has been canceled by system because expiration of invoice",
                        'updated_at'    =>  date('Y-m-d H:i:s'),
                        'status'            =>  0 
                    ));                                 


                     $tickets = new TicketModel();                 
                     $tickets = $tickets->getTicketByBookingId($inv['i_booking']);                     

                     if(count($tickets) > 0){

                         foreach($tickets as $v){     

                            DB::update('tr_events_ticket_book','i_owner',$v['i_owner'],array(                            
                                'status'            =>  0 
                            ));                                 

                        }

                    }
                }
                
            }
        }else{
            
            echo "Not Found!\n";
        }
        
    }
    public function _getTemplateAutoCancelBooking($data){
        
        $tpl="";
        $tpl.="<html xmlns='http://www.w3.org/1999/xhtml'>";
        $tpl.="<head>";
        $tpl.="<meta charset='UTF-8'>";
        $tpl.="<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
        $tpl.="<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        $tpl.="<title>Everyvents | Auto Cancel Booking</title>";
        $tpl.="<style type='text/css'>.content a,.footer a{text-decoration:none}.content .link a:hover,.content a:hover,.fitur .box-fitur .learn-more a:hover,.footer .link-footer a:hover,.footer a:hover,.search .box-search .left-search a:hover img,.search .box-search .right-search a:hover img{opacity:.9}body{font-family:arial;font-size:14px;color:#252525}.container{width:660px;background:#f5f5f5;min-height:100px;margin-left:auto;margin-right:auto;padding:20px}.box,.header{min-height:10px}.box{background:#fff;width:auto}.btn-more{background:#959595;border:none;border-radius:5px;padding:12px;color:#fff;margin-top:15px;margin-bottom:15px;cursor:pointer}.header,.info{background:0 0}.header{width:100%;padding-top:12px;padding-bottom:12px;text-align:center}.content,.fitur,.search{padding:20px}.header img{width:194px}.info{width:auto;height:45px;border-top:1px solid #EBEBEB;border-bottom:1px solid #EBEBEB;line-height:45px;padding-left:20px;padding-right:20px}.info .left{float:left;width:50%;text-align:left}.info .right{float:right;width:50%;text-align:right}.content{width:auto;min-height:200px}.content .login,.content .login .box-login{width:100%;min-height:10px}.content a{color:#252525}.content .title{color:#0669B2;font-size:22px;margin-top:20px;margin-bottom:20px}.content .login{margin-top:30px;margin-bottom:30px;line-height:18px}.content .login .box-login .title-login{width:100px;float:left;margin-right:8px}.content .login .box-login .title-login .icon{float:right}.content .login .box-login .data-login{float:left}.content .link{width:100%;margin-top:20px;margin-bottom:20px}.content .link a{color:#0669B2}.fitur{background:#f5f5f5;width:auto;min-height:100px;font-size:12px}.fitur .box-fitur{width:33.333%;min-height:50px;text-align:center;float:left}.fitur .box-fitur .icon-fitur{display:table;width:100%;height:82px}.fitur .box-fitur .icon-fitur .position{display:table-cell;vertical-align:bottom}.fitur .box-fitur .title-fitur{margin-top:15px;font-size:12px}.fitur .box-fitur .border-fitur{width:60px;height:2px;background:#252525;margin:8px auto}.fitur .box-fitur .description-fitur{margin-bottom:8px;min-height:50px;font-size:12px}.fitur .box-fitur .learn-more{color:#0669B2;font-size:12px}.fitur .box-fitur .learn-more a{color:#0669B2;text-decoration:none}.search{background-color:#0669B2;width:auto;min-height:10px;color:#fff}.footer .link-footer a,.footer a{color:#0669B2}.search .box-search{width:100%;min-height:10px}.search .box-search .left-search{width:50%;min-height:10px;float:left}.search .box-search .left-search .title-search{width:100%;margin-bottom:8px;font-size:13px}.search .box-search .right-search{width:50%;min-height:10px;float:right;text-align:right}.search .box-search .right-search .title-search{width:100%;margin-bottom:8px;font-size:13px}.search .box-search .right-search img{margin-left:5px}.footer{text-align:center;background:#fff;width:auto;min-height:10px;font-size:12px;padding:30px 20px}.footer .link-footer{width:100%;margin-top:20px;font-size:11px}.footer .copyright{color:#898888;font-size:12px}.clearer{clear:both}@media (max-width:720px){.container{width:auto}}@media (max-width:580px){.fitur .box-fitur{width:100%;margin-top:10px;margin-bottom:10px}.fitur .box-fitur .description-fitur{min-height:10px}}@media (max-width:480px){.info{width:auto;height:auto;min-height:10px;padding-top:10px;padding-bottom:10px;line-height:20px}.info .left,.info .right,.search .box-search .left-search{width:100%;text-align:center}.search .box-search .right-search{width:100%;text-align:center;margin-top:10px}}</style>";
        $tpl.="</head>";

        $tpl.="<body>";
            $tpl.="<div class='container'>";
                $tpl.="<div class='box'>";
                    $tpl.="<div class='header'>";
                        $tpl.="<img src='http://everyvents.com/dev/everyvents/assets/img/logo-email.png'>";
                    $tpl.="</div>";
                    $tpl.="<div class='info'>";
                        $tpl.="<div class='left'>";
                            $tpl.="Hallo , ".ucwords($data['name']);
                        $tpl.="</div>";
                        $tpl.="<div class='right'>";
                            $tpl.=$this->config->_getNow();
                        $tpl.="</div>";
                        $tpl.="<div class='clearer'></div>";
                    $tpl.="</div>";
                    $tpl.="<div class='content'>";
                        $tpl.="<div class='title'>";
                            $tpl.="AUTO CANCEL BOOKING REMINDER";
                        $tpl.="</div>";
                        
                        $tpl.="<div class='box-events'>";
                            $tpl.="<img src='".$data['cdn'].$data['event_image']."' style='width: 100%'>";
                        $tpl.="</div>";
                        
                        $tpl.="<p>";
                        $tpl.="Your Event's Reservation has been canceled automatically , due to your date of payment";
                        
                        $tpl.="<div class='login'>";
                            
                            $tpl.="<div class='box-login'>";
                                $tpl.="<div class='title-login'>Invoice No"; 
                                    $tpl.="<div class='icon'>:</div>";
                                $tpl.="</div>";
                                $tpl.="<div class='data-login'>".$data['invoice']."</div>";
                                $tpl.="<div class='clearer'></div>";
                            $tpl.="</div>";
                            
                            $tpl.="<div class='box-login'>";
                                $tpl.="<div class='title-login'>Event ";
                                    $tpl.="<div class='icon'>:</div>";
                                $tpl.="</div>";
                                $tpl.="<div class='data-login'>".$data['event']."</div>";
                                $tpl.="<div class='clearer'></div>";
                            $tpl.="</div>";
                                                        
                            
                        $tpl.="</div>";
                                                                        
                        $tpl.="<div class='link'>";
                            $tpl.="<a href='".$data['red_url_event']."'>";
                                $tpl.="<button class='btn-more'>";
                                    $tpl.="TRY TO RE-BOOK";
                                $tpl.="</button>";
                            $tpl.="</a>";
                                                                                    
                        $tpl.="</div>";
                        
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
                                $tpl.="<a href='#'>Learn More</a>";
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
                                $tpl.="<a href='#'>See Events</a>";
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
                        $tpl.="</div>  ";
                        $tpl.="<div class='clearer'></div>";
                    $tpl.="</div>";
                    $tpl.="<div class='search'>";
                        $tpl.="<div class='box-search'>";
                            $tpl.="<div class='left-search'>";
                                $tpl.="<div class='title-search'>";
                                    $tpl.="Find and explore more events on mobile app";
                                $tpl.="</div>";
                                $tpl.="<a href='#'><img src='http://everyvents.com/dev/everyvents/assets/img/itunes.png'></a>";
                                $tpl.="<a href='#'><img src='http://everyvents.com/dev/everyvents/assets/img/google+play.png'></a> ";
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
                        $tpl.="This e-mail was sent to <a href='#'>admin@everyvents.com</a> You are recelving this email because <br />"; 
                        $tpl.="you've previously registred on everyvents.";

                        $tpl.="<div class='link-footer'>";
                            $tpl.="<a href='#'>Unsucbscribe | Contact Us</a>";
                        $tpl.="</div>";

                        $tpl.="<div class='copyright'>";
                            $tpl.="Copyright &copy; 2017 Everyvents. All rights reserved.";
                        $tpl.="</div>";
                    $tpl.="</div>";
                $tpl.="</div>";
            $tpl.="</div>";
        $tpl.="</body>";
        $tpl.="</html> ";
        
        return $tpl;                
    }
    
}
?>

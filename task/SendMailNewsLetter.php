<?php

include_once('Config.php');
include_once('Helper.php');
include_once('Email.php');

include_once('model/UserModel.php');
include_once('model/EventModel.php');

/*
 * trigger tr_members_newsletter
 */

class SendMailNewsLetter{
    
    protected $config;
    protected $helper;
    
    public function __construct() {
        
        $this->config = new Config();
        $this->helper = new Helper();
        
    }

    public function go(){
                                        
        //check apakah ada user baru;
        $email   =   new Email();        
        
        $users = new UserModel();                
                        
        $ev = new EventModel();
        $events = $ev->getAllActiveEvents();                                                
                        
                           
        if(count($events) > 0){
                       
            foreach($events as $e){
                                
                //find the users has interest                
                $members = $users->getInterestByCategory($e['i_category']);
                                                                           
                if(count($members) > 0){                                        
                    
                    foreach($members as $u){
                        
                        $member = $users->getMemberById($u['i_user'])[0];
                                                       
                        $newsletter = $users->getMemberNewsletter($member['code'], $e['code']);
                                                                        
                        //member belum dapet new tsb
                        if(count($newsletter)==0){
                                                                                                                                            
                            // send newsletter by email
                                                                                                                
                            echo "kirim newsletter ke ".$member['email']." Event : ".$e['event_name']." ... \n";                            

                            
                            $data=array(                
                                'to'            =>  $member['email'],
                                'name'          =>  $member['firstname'],
                                'subject'       =>  "Everyvents - Newsletter : ".strtoupper($e['category'])." ".$e['event_name'],
                                'user'          =>  $member,
                                'events'        =>  $ev->getBlastedEmail($e['code']),
                                'cdn'           =>  $this->config->getBaseCdn(),                                
                                'toDay'         =>  $this->config->_getNow(),
                                'base_red_url'  =>  $this->config->getBaseUrl()."event-tickets",
                                'red_url_category' =>  $this->config->getBaseUrl()."ev/category/".$this->helper->clearUrl($e['category'])."-".$e['i_category'],
                                'red_url_event' =>  $this->config->getBaseUrl()."ev/ticket/".$this->helper->clearUrl($e['event_name'])."-".$e['id']

                            ); 
                            
                                                                                                                                                                            
                            $mail = $email->_blast($this->_getTemplateNewsLetter($data), $data);                                                        
                            
                            if($mail['status']==1){
                                
                                $arr['i_user']   = $member['code'];
                                $arr['f_code'] = $e['code'];
                                $arr['status']          = 1;
                                $arr['receipt_date']    = date('Y-m-d H:i:s');
                                $arr['created_at']      = date('Y-m-d H:i:s');
                                $arr['updated_at']      = date('Y-m-d H:i:s');
                                
                                //post to history
                                DB::insert('tr_members_newsletter',$arr);
                            
                            }
                            
                            echo $mail['message']."\n";
                            
                        }else{
                            
                            echo "No blast email to ".$member['email']." of newsletter ".$e['event_name']." [ ".$e['category']." ]\n";
                        }
                                                
                                                
                    }                    
                    
                }                
                
            }
            
        }else{
            
            echo "Not found! \n";
            
        }                                   
        
    }
    
    public function _getTemplateNewsLetter($data){
        
        $helper = new Helper();
        
        
        $tpl = "";
        
        $tpl.="<html xmlns='http://www.w3.org/1999/xhtml'>";
        $tpl.="<head>";
        $tpl.="<meta charset='UTF-8'>";
        $tpl.="<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
        $tpl.="<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        $tpl.="<title>Everyvents | News Letter</title>";
        $tpl.="<style type='text/css'>.content a,body{color:#252525}.content a,.footer a{text-decoration:none}.content .box-events .detail-content .category a:hover,.content a:hover,.fitur .box-fitur .learn-more a:hover,.footer .link-footer a:hover,.footer a:hover,.search .box-search .left-search a:hover img,.search .box-search .right-search a:hover img{opacity:.9}body{font-family:Lucida sans,Helvetica,Sans-serif;font-size:12px}.container{width:660px;background:#f5f5f5;min-height:100px;margin-left:auto;margin-right:auto;padding:20px}.box,.header{min-height:10px}.box{background:#fff;width:auto}.header{width:100%;background:0 0;padding-top:12px;padding-bottom:12px;text-align:center}.header img{width:194px}.content{width:auto;min-height:200px;padding:20px}.content .title{font-size:13px;margin-top:10px;margin-bottom:20px;text-align:left}.btn-more{background:#959595;border:none;border-radius:5px;padding:12px;color:#fff;margin-top:15px;margin-bottom:15px;cursor:pointer}.content .box-events{background:#f5f5f5;width:100%;min-height:10px;margin-top:20px;margin-bottom:20px}.content .box-events img{width:100%}.content .box-events .detail-content{width:auto;padding:20px}.content .box-events .detail-content .datetime{font-size:10px;color:#959595}.content .box-events .detail-content .category{font-size:11px;margin-top:10px}.content .box-events .detail-content .category a{color:#0669B2}.content .box-events .detail-content .title-events{font-size:14px;width:380px;line-height:18px}.content .box-events .detail-content .detail-events{width:100%;min-height:10px;margin-top:10px}.content .box-events .detail-content .detail-events .address{width:380px;float:left;line-height:15px;font-size:11px}.btn-get-tickets{float:right;background:#0368b0;color:#fff;border:none;font-size:14px;padding:8px;cursor:pointer}.fitur{background:#f5f5f5;width:auto;min-height:100px;padding:20px;font-size:12px}.fitur .box-fitur{width:33.333%;min-height:50px;text-align:center;float:left}.fitur .box-fitur .icon-fitur{display:table;width:100%;height:82px}.fitur .box-fitur .icon-fitur .position{display:table-cell;vertical-align:bottom}.fitur .box-fitur .title-fitur{margin-top:15px;font-size:12px}.fitur .box-fitur .border-fitur{width:60px;height:2px;background:#252525;margin:8px auto}.fitur .box-fitur .description-fitur{margin-bottom:8px;min-height:50px;font-size:12px}.fitur .box-fitur .learn-more{color:#0669B2;font-size:12px}.fitur .box-fitur .learn-more a{color:#0669B2;text-decoration:none}.search{background:#0669B2;width:auto;min-height:10px;padding:20px;color:#fff}.footer .link-footer a,.footer a{color:#0669B2}.search .box-search{width:100%;min-height:10px}.search .box-search .left-search{width:50%;min-height:10px;float:left}.search .box-search .left-search .title-search{width:100%;margin-bottom:8px;font-size:13px}.search .box-search .right-search{width:50%;min-height:10px;float:right;text-align:right}.search .box-search .right-search .title-search{width:100%;margin-bottom:8px;font-size:13px}.search .box-search .right-search img{margin-left:5px}.footer{text-align:center;background:#fff;width:auto;min-height:10px;font-size:12px;padding:30px 20px}.footer .link-footer{width:100%;margin-top:20px;font-size:11px}.footer .copyright{color:#898888;font-size:12px}.clearer{clear:both}@media (max-width:720px){.container{width:auto}}@media (max-width:580px){.fitur .box-fitur{width:100%;margin-top:10px;margin-bottom:10px}.fitur .box-fitur .description-fitur{min-height:10px}}@media (max-width:480px){.search .box-search .left-search{width:100%;text-align:center}.search .box-search .right-search{width:100%;text-align:center;margin-top:10px}}</style>";
        $tpl.="</head>";

        $tpl.="<body>";
            $tpl.="<div class='container'>";
                $tpl.="<div class='box'>";
                    $tpl.="<div class='header'>";
                        $tpl.="<img src='http://everyvents.com/dev/everyvents/assets/img/logo-email.png'>";
                    $tpl.="</div>";
                    $tpl.="<div class='content'>";
                        $tpl.="<div class='title'>";
                            $tpl.="Here it is events that posisible you are interested as follow";
                        $tpl.="</div>";
                        
                        if(count($data['events']) > 0){                                                    
                            foreach($data['events'] as $v){

                                $tpl.="<div class='box-events'>";

                                    $tpl.="<img src='".$data['cdn'].$v['images_file']."' style='width: 100%'>";

                                    $tpl.="<div class='detail-content'>";

                                        $tpl.="<div class='datetime'>".$v['date']." ".substr(strtoupper($v['month']),0,3)." ".$v['year'].",".$v['start_hour'].":".$v['start_minute']." ".$v['start_time']."</div>";
                                        $tpl.="<div class='category'>";
                                            $tpl.="<a href='".$data['red_url_category']."'>".ucwords($v['category'])."</a>";
                                        $tpl.="</div>";
                                        $tpl.="<div class='title-events'>";
                                            $tpl.="<a href='".$data['red_url_event'].$helper->clearUrl($v['event_name'])."/".$v['id']."'>".ucwords($v['event_name'])."</a>";
                                        $tpl.="</div>";
                                        $tpl.="<div class='detail-events'>";
                                            $tpl.="<div class='address'>";
                                                $tpl.=$v['event_address'];
                                            $tpl.="</div>";
                                            $tpl.="<a href='".$data['red_url_event']."'>";
                                            $tpl.="<button class='btn-get-tickets'>GET TICKETS</button>";
                                            $tpl.="</a>";
                                            $tpl.="<div class='clearer'></div>";
                                        $tpl.="</div>";
                                    $tpl.="</div>";
                                $tpl.="</div>";
                            }
                        }

                        $tpl.="<div align='center'>";
                            $tpl.="<a href='".$data['base_red_url']."'>";
                                $tpl.="<button class='btn-more'>";
                                    $tpl.="EXPLORE MORE EVENTS";
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
        $tpl.="</html>";
                       
        return $tpl;
    }    
    
}
?>

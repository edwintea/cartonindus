<?php

include_once('Config.php');
include_once('Helper.php');
include_once('Email.php');

include_once('model/UserModel.php');
include_once('model/EventModel.php');

/*
 * trigger : all user not in tr_members_welcome
 */

class SendMailUsersWelcome{
    
    protected $config;    
    
    public function __construct() {
        
        $this->config = new Config();        
        
    }

    public function go(){
                        
        $users = new UserModel();        
        $count = count($users->getUserNeedWelcome());
        $users = $users->getUserNeedWelcome();
                        
        $events = new EventModel();                                       
        
        if($count >  0){
                        
            echo "Ada ".$count." Member baru!\n";
                                              
            //start loop and post to tr_members_welcome
                        
                    
            foreach($users as $u){ 
                
                //ECHO VAR_DUMP($events->getAllLimit($u['i_app'],4));DIE;                
                                                
                if($u['i_app'] !=""){
                    $data = array(
                        'APP'   =>array(
                            'i_app'         =>  ucwords($u['i_app']),
                            'app_name'      =>  ucwords($u['app_name']),
                        ),
                        'URL'   =>array(
                            'base_url'      =>  $this->config->getConfig($u['i_app'])['BASE_URL'],           
                            'base_asset'    =>  $this->config->getConfig($u['i_app'])['BASE_ASSET'],
                            'base_cdn'      =>  $this->config->getConfig($u['i_app'])['BASE_CDN'],
                            'base_ticket'   =>  $this->config->getConfig($u['i_app'])['BASE_TICKET'],                        
                            'red_url_event' =>  $this->config->getBaseUrl()."events/",
                            'verify_url'    =>  "verification/".base64_encode($u['i_app']|$u['code']."|".$u['email']),                        
                        ),
                        'EMAIL'             =>  array(
                            'from'          =>  "edwin@ev-class.com",
                            'to'            =>  $u['email'],
                            'subject'       =>  $u['app_name'].' - Welcome ',
                            'name'          =>  $u['firstname'],
                            'attachment'    =>  null,
                        ),
                        'CONTENT'           =>array(
                            'events'        =>  $events->getAllLimit($u['i_app'],4),                    
                            'toDay'         =>  $this->config->_getNow(),
                            'email'         =>  $u['email'],                    
                            'password'      =>  $u['password'],                    
                            'name'          =>  $u['firstname'],                                        
                        )                                                        
                    );
                                                
                
                
                    echo "Mengirim Email Welcome dari ".ucwords($u['app_name'])." ke ".$u['email']."...\n";

                    //send 1            
                    $mail   =   new Email();                

                    $mail1 = $mail->_blast($this->getTemplate($data,"welcome",true), $data);

                    if($mail1['status'] == 1){

                        echo $mail1['message']."\n";                    

                        $data['EMAIL']['subject']    =   ucwords($users[0]['app_name']).' - Account Verification';
                        $data['tpl']                =   'Verification in Everyvents';

                        echo "Mengirim email Akun ke ".$u['email']."...";

                        //send 2
                        $mail2 = $mail->_blast($this->getTemplate($data,"verification",false), $data);                

                        if($mail2['status'] == 1){

                            echo $mail2['message']."\n";

                            /*
                            DB::insert('tr_members_welcome', array(
                                'i_user'        =>  $u['code'],
                                'send_date'     =>  date('Y-m-d'),
                                'created_at'    =>  date('Y-m-d H:i:s'),
                                'updated_at'    =>  date('Y-m-d H:i:s')
                            ));
                             * 
                             */                                

                        }else{

                            echo "\n Error coy : ".$mail2['message']."\n";

                        }


                    }else{

                        echo "\n Error coy : ".$mail1['message']."\n";
                    }                                                
                    
                }else{
                    
                    echo "\n User  : ".$u['firstname']." Not Clustered \n";
                    
                }
            }
            
        }else{
            
            echo "User baru tidak ditemukan!\n";
        }
        
        
    }
    
    public function getMeta($data){
        $tpl="";
        
        if(is_array($data)){                    
                        
            $tpl.="<meta charset='UTF-8'>";
            $tpl.="<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
            $tpl.="<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            $tpl.="<title>".$data['APP']['app_name']." | Welcome</title>";

            $tpl.="<style type='text/css'>.content a,body{color:#252525}.content a,.footer a{text-decoration:none}.content .wrapper-box-content .box-content .category a:hover,.content a:hover,.fitur .box-fitur .learn-more a:hover,.footer .link-footer a:hover,.footer a:hover,.search .box-search .left-search a:hover img,.search .box-search .right-search a:hover img{opacity:.9}body{font-family:Lucida sans,Helvetica,Sans-serif;font-size:12px}.container{width:660px;background:#f5f5f5;min-height:100px;margin-left:auto;margin-right:auto;padding:20px}.banner,.box,.header{min-height:10px}.box{background:#fff;width:auto}.header,.info{background:0 0}.header{width:100%;padding-top:12px;padding-bottom:12px;text-align:center}.header img{width:194px}.banner{width:auto;position:relative;padding:0}.info{width:auto;height:45px;border-top:1px solid #EBEBEB;border-bottom:1px solid #EBEBEB;line-height:45px;padding-left:20px;padding-right:20px;margin-top:-5px}.info .left{float:left;width:50%;text-align:left}.info .right{float:right;width:50%;text-align:right}.content{width:auto;min-height:200px;padding:20px}.content .title{color:#0669B2;font-size:14px;margin-top:10px;margin-bottom:20px;text-align:center}.content .wrapper-box-content{width:auto;min-height:10px;margin-left:-2%;margin-right:-2%}.content .wrapper-box-content .box-content{width:43%;padding:1.5%;min-height:245px;background:#f5f5f5;float:left;margin:8px 2%}.content .wrapper-box-content .box-content .img-box-content{height:110px;position:relative;background-position:center;background-repeat:no-repeat;background-size:cover}.content .wrapper-box-content .box-content .idr{font-size:13px;margin-top:10px;margin-bottom:5px;width:100%;color:#959595}.content .wrapper-box-content .box-content .category{font-size:11px;position:relative;color:#0669B2;min-width:10px}.content .wrapper-box-content .box-content .category a{color:#0669B2}.content .wrapper-box-content .box-content .title-events{font-size:13px;width:100%;height:35px;overflow:hidden}.content .wrapper-box-content .box-content .detail-events{width:auto;margin-top:8px}.content .wrapper-box-content .box-content .detail-events .datetime{float:left;width:20%;min-height:50px;background:#fff;padding-left:5px;padding-right:5px}.content .wrapper-box-content .box-content .detail-events .datetime .day{width:100%;text-align:center;padding-top:15px;padding-bottom:15px;border-bottom:1px solid #f5f5f5}.content .wrapper-box-content .box-content .detail-events .datetime .date{font-size:10px;text-align:center;padding-top:5px;padding-bottom:5px}.content .wrapper-box-content .box-content .detail-events .address-events{float:right;width:70%;height:45px;font-size:11px;overflow:hidden}.btn-more{background:#959595;border:none;border-radius:5px;padding:12px;color:#fff;margin-top:15px;margin-bottom:15px;cursor:pointer}.fitur{background:#f5f5f5;width:auto;min-height:100px;padding:20px;font-size:12px}.fitur .box-fitur{width:33.333%;min-height:50px;text-align:center;float:left}.fitur .box-fitur .icon-fitur{display:table;width:100%;height:82px}.fitur .box-fitur .icon-fitur .position{display:table-cell;vertical-align:bottom}.fitur .box-fitur .title-fitur{margin-top:15px;font-size:12px}.fitur .box-fitur .border-fitur{width:60px;height:2px;background:#252525;margin:8px auto}.fitur .box-fitur .description-fitur{margin-bottom:8px;min-height:50px;font-size:12px}.fitur .box-fitur .learn-more{color:#0669B2;font-size:12px}.fitur .box-fitur .learn-more a{color:#0669B2;text-decoration:none}.search{background:#0669B2;width:auto;min-height:10px;padding:20px;color:#fff}.footer .link-footer a,.footer a{color:#0669B2}.search .box-search{width:100%;min-height:10px}.search .box-search .left-search{width:50%;min-height:10px;float:left}.search .box-search .left-search .title-search{width:100%;margin-bottom:8px;font-size:13px}.search .box-search .right-search{width:50%;min-height:10px;float:right;text-align:right}.search .box-search .right-search .title-search{width:100%;margin-bottom:8px;font-size:13px}.search .box-search .right-search img{margin-left:5px}.footer{text-align:center;background:#fff;width:auto;min-height:10px;font-size:12px;padding:30px 20px}.footer .link-footer{width:100%;margin-top:20px;font-size:11px}.footer .copyright{color:#898888;font-size:12px}.clearer{clear:both}@media (max-width:720px){.container{width:auto}.content .wrapper-box-content .box-content .img-box-content{height:140px}.content .wrapper-box-content .box-content{width:42%;padding:2%}}@media (max-width:580px){.content .wrapper-box-content .box-content .img-box-content{height:120px}.content .wrapper-box-content .box-content{width:auto;padding:5%}.content .wrapper-box-content .box-content .detail-events .datetime{width:18%}.content .wrapper-box-content .box-content .detail-events .address-events{width:74%;height:45px}.fitur .box-fitur{width:100%;margin-top:10px;margin-bottom:10px}.fitur .box-fitur .description-fitur{min-height:10px}}@media (max-width:480px){.info{width:auto;height:auto;min-height:10px;padding-top:10px;padding-bottom:10px;line-height:20px}.info .left,.info .right,.search .box-search .left-search{width:100%;text-align:center}.search .box-search .right-search{width:100%;text-align:center;margin-top:10px}}</style>";
            
        }
        
        return $tpl;
        
    }
    
    public function getHeader($data){
        $tpl="";
                        
        if(is_array($data)){                    
                        
            $tpl.="<div class='header'>";
                $tpl.="<img src='".$data['URL']['base_asset']."images/logo.png'>"; //standar nama file harus logo.png untuk semua apps
            $tpl.="</div>";
            
        }
        
        return $tpl;
    }
    
    public function getBanner($data){
        
        $tpl="";
        
        if(is_array($data)){                    
                        
            $tpl.="<div class='banner'>";
                $tpl.="<a href='#'>";
                    $tpl.="<img src='".$data['URL']['base_asset']."images/e-welcome.jpg' style='width:100%'>";
                $tpl.="</a>";
            $tpl.="</div>";
            
        }
        
        return $tpl;        
                    
    }
    
    public function getInfo($data){
        
        $tpl="";
        
        if(is_array($data)){                    
                        
            $tpl.="<div class='info'>";
                $tpl.="<div class='left'>";
                    $tpl.="Hallo , ".ucwords($data['EMAIL']['name']);
                $tpl.="</div>";
                $tpl.="<div class='right'>";
                    $tpl.=$this->config->_getNow();
                $tpl.="</div>";
                $tpl.="<div class='clearer'></div>";
            $tpl.="</div>";
            
        }
        
        return $tpl;        
                    
    }
    
    public function getFooter($data){
        
        $tpl="";
        
        if(is_array($data)){                    
                        
            $tpl.="<div class='fitur'>";
                $tpl.="<div class='box-fitur'>";
                    $tpl.="<div class='icon-fitur'>";
                        $tpl.="<div class='position'>";
                            $tpl.="<img src='".$data['URL']['base_asset']."images/create-your-own-event.png'>";
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
                            $tpl.="<img src='".$data['URL']['base_asset']."images/explore-great-event.png'>";
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
                            $tpl.="<img src='".$data['URL']['base_asset']."images/get-the-app.png'>";
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
                        $tpl.="<a href='#'><img src='".$data['URL']['base_asset']."images/itunes.png'></a>";
                        $tpl.="<a href='#'><img src='".$data['URL']['base_asset']."images/google+play.png'></a>";
                    $tpl.="</div>";
                    $tpl.="<div class='right-search'>";
                        $tpl.="<div class='title-search'>";
                            $tpl.="Find latest promo from everyvents";
                        $tpl.="</div>";
                        $tpl.="<a href='#'><img src='".$data['URL']['base_asset']."images/fb-email.png'></a>";
                        $tpl.="<a href='#'><img src='".$data['URL']['base_asset']."images/instagram-email.png'></a>";
                    $tpl.="</div>";
                    $tpl.="<div class='clearer'></div>";
                $tpl.="</div>";
            $tpl.="</div>";

            $tpl.="<div class='footer'>";
                $tpl.="This e-mail was sent to <a href='#'>admin@everyvents.com</a> You are recelving this email because <br />"; 
                $tpl.="you've previously registred on ".$data['APP']['app_name'].".";
                $tpl.="<div class='link-footer'>";
                    $tpl.="<a href='#'>Unsucbscribe | Contact Us</a>";
                $tpl.="</div>";
                $tpl.="<div class='copyright'>";
                    $tpl.="Copyright &copy;".date('Y')."Everyvents. All rights reserved.<br>";
                    //$tpl.="Your Internet provider : ".$data['user'][0]['os_provider'];
                $tpl.="</div>";
            $tpl.="</div>";
            
        }
        
        return $tpl; 
           
    }
    
    public function getContent($data,$content){
        
        $help = new Helper();                     
        
        $tpl="";
        
        if(is_array($data)){                    
                        
            switch($content){
                case    "welcome":                                        
                    
                    if(count($data['CONTENT']['events']) > 0){
                        
                        $tpl.="<div class='content'>";
                            $tpl.="<div class='title'>";
                                $tpl.="Here it is events that posisible you are interested as follow";
                            $tpl.="</div>";

                            $tpl.="<div class='wrapper-box-content'>";                                
                            
                                foreach($data['CONTENT']['events'] as $v){
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
                                    $tpl.="<div class='box-content'>";
                                        $tpl.="<img src='".$data['URL']['base_cdn'].$v['images_file']."' style='width: 100%'>";

                                        $tpl.="<div class='idr'>";
                                            if($v['min_price'] != $v['max_price']){

                                                $tpl.="<div class='events_date'>".$v['currency']." ".number_format($v['min_price'], 0, '.', ',')." - ".$v['currency']." ".number_format($v['max_price'], 0, '.', ',')."</div>";

                                            }  else {

                                                $tpl.="<div class='events_date'>".$v['currency']." ".number_format($v['min_price'], 0, '.', ',')." </div>";

                                            }

                                        $tpl.="</div>";
                                                                                
                                        $tpl.="<div class='category'>";
                                            $tpl.="<a href='#'>".ucwords($v['category'])."</a>";
                                        $tpl.="</div>";
                                        $tpl.="<div class='title-events'>";
                                            $tpl.="<a href='".$data['URL']['red_url_event'].$help->clearUrl($v['event_name'])."-".$v['id']."'>";
                                                $tpl.=ucwords($v['event_name']);
                                            $tpl.="</a>";
                                        $tpl.="</div>";
                                        $tpl.="<div class='detail-events'>";
                                            $tpl.="<div class='datetime'>";
                                                $tpl.="<div class='day'>".strtoupper(substr($v['day'],0,3))."</div>";
                                                $tpl.="<div class='date'>".strtoupper(substr($v['month'],0,3))." ".$v['date']."</div>";
                                            $tpl.="</div>";
                                            $tpl.="<div class='address-events'>";
                                                $tpl.=$v['event_address'];
                                            $tpl.="</div>";
                                            $tpl.="<div class='clearer'></div>";
                                        $tpl.="</div>";
                                    $tpl.="</div>";
                                                                            
                                }

                                $tpl.="<div class='clearer'></div>";
                            $tpl.="</div>";
                            $tpl.="<div align='center'>";
                                $tpl.="<a href='".$data['URL']['base_url']."events'>";
                                    $tpl.="<button class='btn-more'>";
                                        $tpl.="EXPLORE MORE EVENTS";
                                    $tpl.="</button>";
                                $tpl.="</a>";
                            $tpl.="</div>";
                        $tpl.="</div>";

                    }
                    
                    
                break;
                case    "verification":
                    
                    $tpl.="<div class='content'>";
                        $tpl.="<div class='title'>";
                            $tpl.="E-MAIL VERIFICATION";
                        $tpl.="</div>";
                        $tpl.="Your account has been registered";
                        
                        $tpl.="<div class='login'>";
                            $tpl.="<div class='box-login'>";
                                $tpl.="<div class='title-login'>Username ";
                                    $tpl.="<div class='icon'>:</div>";
                                $tpl.="</div>";
                                $tpl.="<div class='data-login'>".$data['EMAIL']['to']."</div>";
                                $tpl.="<div class='clearer'></div>";
                            $tpl.="</div>";
                            $tpl.="<div class='box-login'>";
                                $tpl.="<div class='title-login'>Password"; 
                                    $tpl.="<div class='icon'>:</div>";
                                $tpl.="</div>";
                                $tpl.="<div class='data-login'>".$data['CONTENT']['password']."</div>";
                                $tpl.="<div class='clearer'></div>";
                            $tpl.="</div>";
                        $tpl.="</div>";
                        $tpl.="Please click on the following link to verify your email address. By clicking on the following link you are agree to <b><a href='#'>term of service</a></b>";
                        $tpl.="<div class='link'>";
                            $tpl.="<a href='".$data['URL']['verify_url']."'>";
                                $tpl.="<button class='btn-more'>";
                                    $tpl.="VERIFY NOW";
                                $tpl.="</button>";
                            $tpl.="</a>";
                        $tpl.="</div>";
                        
                    $tpl.="</div>";
                    
                break;
                default :
                    
                    $tpl="Well...";
                    
                break;
            }
                        
            
        }
        
        return $tpl;   
        
    }
    
    public function getTemplate($data=array(),$type="",$banner=true){        
                                  
        $tpl="";
                        
        $tpl.="<html xmlns='http://www.w3.org/1999/xhtml'>";
        $tpl.="<head>";
        
            $tpl.=$this->getMeta($data);
        
        $tpl.="</head>";

        $tpl.="<body>";
        
            $tpl.="<div class='container'>";
                $tpl.="<div class='box'>";
                
                    $tpl.=$this->getHeader($data);
                    
                    if($banner){
                        
                        $tpl.=$this->getBanner($data);
                        
                    }
                    
                    
                    $tpl.=$this->getInfo($data);
                    
                    
                    //dynamic content
                    
                    $tpl.=$this->getContent($data,$type);
                    
                    //end dynamic
                    
                    
                    $tpl.=$this->getFooter($data);
                    
                    
                $tpl.="</div>";
            $tpl.="</div>";
        $tpl.="</body>";
        $tpl.="</html>";
        
        return $tpl;
        
    }        
    
}
?>

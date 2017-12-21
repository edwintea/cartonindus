<?php

include_once('Config.php');
include_once('Helper.php');
include_once('Email.php');

include_once('model/UserModel.php');
include_once('model/EventModel.php');
include_once('model/InvoiceModel.php');


/*
 * trigger tr_events_book_item -> email not in users
 */
class AutoSyncUser{
    
    protected $config;
    
    public function __construct() {
        
        $this->config = new Config();       
        
    }

    public function go(){
                                        
        $new = new UserModel();
        $new = $new->getDelegationNotInMember();
                            
        if(count($new) > 0){
            
            $helper = new Helper();
                                    
            foreach($new as $n){
                                
                
                echo "Posting new user :  ".$n['email']." with name : ".$n['firstname']."\n";                
                
                $code = $helper->_generateCode('users','USR');
                
                
                DB::insert('users',array(
                    'i_app'         =>  $n['i_app'], //berdasarkan di aplikasi mana dia melakukan booking
                    'i_group'       =>  "S01.USG.1701.0000013",
                    'i_token'       => uniqid(),
                    'code'          =>  $code,
                    'firstname'     =>  $n['firstname'],
                    'email'         =>  $n['email'],
                    'password'      =>  uniqid(),
                    'scope'         =>  'public',
                    'is_autoreg'      =>  1,
                    'status'        =>  1,
                    'created_at'    =>  date('Y-m-d H:i:s'),
                    
                ));
                                
                DB::commit();
                                                                
                
                echo "New Member has been add \n";
            }
        }else{
            
            echo "Not found! \n";
        }
        
    }
    
}
?>

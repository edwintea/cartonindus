<?php

include_once './DB.php';

class UserModel extends DB{
            
    public function getMemberById($id){
        $sql=" SELECT * FROM users WHERE code='".$id."' ";
                        
        return DB::fetch($sql);
    }
    public function getMemberNewsletter($userid=NULL,$f_code=NULL){
        
        $sql=" SELECT * 
            FROM tr_members_newsletter 
            WHERE i_user='".$userid."' AND f_code='".$f_code."' ";
                        
        return DB::fetch($sql);
    }
    public function getUserNeedWelcome(){
        $sql=" SELECT a.*,
                b.device_type,
                b.browser_name,
                b.os_name,
                b.os_touch,
                b.os_mobile,
                b.os_tablet,
                b.os_asn,
                b.os_provider,
                b.activity_name,
                c.app_name
                
            FROM users a 
            LEFT JOIN tr_users_browse_history b ON a.code = b.f_code            
            LEFT JOIN tm_apps c ON a.i_app = c.code            
            WHERE a.code NOT IN(SELECT i_user FROM tr_members_welcome) 
            AND a.scope='public'
            GROUP BY a.id,a.email
            ORDER BY a.code DESC";                        
                        
        
        return DB::fetch($sql);
    }
    public function getInterestByCategory($id){
        
        $sql=" SELECT a.*
               FROM tr_members_interest a LEFT JOIN users b ON a.i_user = b.code
               WHERE a.i_category='".$id."' AND b.scope='public' ";
          
        //echo $sql;die;
        
        return DB::fetch($sql);
        
    }
    public function getDelegationNotInMember(){
        
        $sql="SELECT a.*,
            b.code as i_booking,
            c.i_app
            FROM tr_events_book_items a LEFT JOIN tr_events_book b ON a.i_booking = b.code
            LEFT JOIN tr_events c ON b.i_event = c.code
            WHERE a.email NOT IN
                (SELECT email FROM users)
            ";
                        
        return DB::fetch($sql);
        
    }
    public function getUserByUserId($userid){
        
        $sql="SELECT * FROM users WHERE code='".$userid."' ";                
        return DB::fetch($sql);
        
    }
}
?>

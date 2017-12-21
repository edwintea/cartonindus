<?php

include_once './DB.php';
include_once './Helper.php';

class EventModel extends DB{
            
    public function getAllLimit($i_app,$limit=10){
        
        $sql=" select a.*,
            b.id as i_category,
            b.category,
            c.firstname, 
            d.ticket_currency as currency,
            MIN(d.ticket_price) as min_price,
            MAX(d.ticket_price) as max_price,
            
            DAY(a.start_date) as date,
            DAYNAME(a.start_date) as day,
            MONTHNAME(a.start_date) as month,
            YEAR(a.start_date) as year,
            DATEDIFF(a.start_date,'".date('Y-m-d')."') as days_left,
                
            (SELECT SUM(ticket_seats)  FROM tr_events_ticket WHERE i_event=a.code) as tot_ticket,
            (SELECT COUNT(*)  FROM tr_events_book_items e LEFT JOIN tr_events_book f ON e.i_booking = f.code WHERE f.i_event=a.code AND e.status=".Helper::_getTrue().") as used_ticket,
            ((SELECT SUM(ticket_seats)  FROM tr_events_ticket WHERE i_event=a.code)-(SELECT COUNT(*)  FROM tr_events_book_items e LEFT JOIN tr_events_book f ON e.i_booking = f.code WHERE f.i_event=a.code AND e.status=".Helper::_getTrue().")) as sisa_ticket
            
            FROM tr_events a LEFT JOIN tm_events_category b ON a.i_category = b.code 
            LEFT JOIN users c ON a.created_by = c.code 
            LEFT JOIN tr_events_ticket d ON a.code = d.i_event             
            WHERE a.i_app = '".$i_app."' 
            AND a.is_approved=".Helper::_getTrue()."
            AND a.is_published=".Helper::_getTrue()." 
            AND a.status=".Helper::_getTrue()."  
            AND a.is_closed=".Helper::_getFalse()." 
            GROUP BY a.code            
            ORDER BY a.start_date 
            LIMIT ".$limit."
            ";
        
        //echo $sql;die;
        
        return DB::fetch($sql);
    }
    public function getAllActiveEvents(){
        $sql=" select a.*,
            b.code as i_category,
            b.category,
            c.firstname, 
            d.ticket_currency as currency,
            MIN(d.ticket_price) as min_price,
            MAX(d.ticket_price) as max_price,
            
            DAY(a.start_date) as date,
            DAYNAME(a.start_date) as day,
            MONTHNAME(a.start_date) as month,
            YEAR(a.start_date) as year,
            DATEDIFF(a.start_date,'".date('Y-m-d')."') as days_left,
                
            (SELECT SUM(ticket_seats)  FROM tr_events_ticket WHERE i_event=a.code) as tot_ticket,
            (SELECT COUNT(*)  FROM tr_events_book_items e LEFT JOIN tr_events_book f ON e.i_booking = f.code WHERE f.i_event=a.code AND e.status=1) as used_ticket,
            ((SELECT SUM(ticket_seats)  FROM tr_events_ticket WHERE i_event=a.code)-(SELECT COUNT(*)  FROM tr_events_book_items e LEFT JOIN tr_events_book f ON e.i_booking = f.code WHERE f.i_event=a.code AND e.status=1)) as sisa_ticket
            
            FROM tr_events a LEFT JOIN tm_events_category b ON a.i_category = b.code 
            LEFT JOIN users c ON a.created_by = c.code 
            LEFT JOIN tr_events_ticket d ON a.code = d.i_event             
            WHERE a.is_published=".Helper::_getTrue()." AND a.status=".Helper::_getTrue()." AND a.is_closed=".Helper::_getFalse()."
            GROUP BY a.code            
            ORDER BY a.start_date             
            ";
        
        //echo $sql;die;
        
        return DB::fetch($sql);
    }
    public function getNeedClosedEvents(){
        $sql=" select a.*,
            b.id as i_category,
            b.category,
            c.firstname, 
            d.ticket_currency as currency,
            MIN(d.ticket_price) as min_price,
            MAX(d.ticket_price) as max_price,
            
            DAY(a.start_date) as date,
            DAYNAME(a.start_date) as day,
            MONTHNAME(a.start_date) as month,
            YEAR(a.start_date) as year,
            DATEDIFF(a.start_date,'".date('Y-m-d')."') as days_left,
                
            (SELECT SUM(ticket_seats)  FROM tr_events_ticket WHERE i_event=a.code) as tot_ticket,
            (SELECT COUNT(*)  FROM tr_events_book_items e LEFT JOIN tr_events_book f ON e.i_booking = f.code WHERE f.i_event=a.code AND e.status=1) as used_ticket,
            ((SELECT SUM(ticket_seats)  FROM tr_events_ticket WHERE i_event=a.code)-(SELECT COUNT(*)  FROM tr_events_book_items e LEFT JOIN tr_events_book f ON e.i_booking = f.code WHERE f.i_event=a.code AND e.status=1)) as sisa_ticket
            
            FROM tr_events a LEFT JOIN tm_events_category b ON a.i_category = b.id 
            LEFT JOIN users c ON a.created_by = c.id 
            LEFT JOIN tr_events_ticket d ON a.code = d.i_event             
            WHERE a.is_published=".Helper::_getTrue()." AND a.status=".Helper::_getTrue()." AND a.is_closed=".Helper::_getFalse()." AND a.end_date < '".date('Y-m-d')."' 
            GROUP BY a.code            
            ORDER BY a.start_date             
            ";
        
        return DB::fetch($sql);
    }
    
    public function getBlastedEmail($event=NULL){
        
        $sql=" select a.*,            
            b.category,
            c.firstname, 
            d.ticket_currency as currency,
            MIN(d.ticket_price) as min_price,
            MAX(d.ticket_price) as max_price,
            
            DAY(a.start_date) as date,
            DAYNAME(a.start_date) as day,
            MONTHNAME(a.start_date) as month,
            YEAR(a.start_date) as year,
            DATEDIFF(a.start_date,'".date('Y-m-d')."') as days_left,
            
            (SELECT SUM(ticket_seats)  FROM tr_events_ticket WHERE i_event=a.code) as tot_ticket,
            (SELECT COUNT(*)  FROM tr_events_book_items e LEFT JOIN tr_events_book f ON e.i_booking = f.code WHERE f.i_event=a.code AND e.status=1) as used_ticket,
            ((SELECT SUM(ticket_seats)  FROM tr_events_ticket WHERE i_event=a.code)-(SELECT COUNT(*)  FROM tr_events_book_items e LEFT JOIN tr_events_book f ON e.i_booking = f.code WHERE f.i_event=a.code AND e.status=1)) as sisa_ticket
            FROM tr_events a LEFT JOIN tm_events_category b ON a.i_category = b.code 
            LEFT JOIN users c ON a.created_by = c.code 
            LEFT JOIN tr_events_ticket d ON a.code = d.i_event             
            WHERE a.code='".$event."' AND a.is_published=".Helper::_getTrue()." AND a.status=".Helper::_getTrue()." AND a.is_closed=".Helper::_getTrue()."
            GROUP BY a.code
            ORDER BY a.start_date             
            ";
        
        return DB::fetch($sql);
        
    }
}
?>

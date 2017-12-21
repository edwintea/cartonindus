<?php

include_once './DB.php';
include_once './Helper.php';

class TicketModel extends DB{
            
    public function getTicketByBookingId($id){
        $sql=" select a.*,
                b.code as owner,
                b.i_booking,
                b.email,
                b.firstname,
                b.is_booker,
                c.code as invoice_code,
                d.id as event_id,
                d.code as event_code,
                d.event_name,
                d.venue_name,
                d.event_address,
                d.event_url_location,
                d.images_file,

                DAY(d.start_date) as s_date,
                DAYNAME(d.start_date) as s_day,
                MONTHNAME(d.start_date) as s_month,
                YEAR(d.start_date) as s_year,

                DAY(d.end_date) as e_date,
                DAYNAME(d.end_date) as e_day,
                MONTHNAME(d.end_date) as e_month,
                YEAR(d.end_date) as e_year,
                
                d.start_hour,
                d.start_minute,
                d.start_time,
                
                e.id as i_group,
                e.group_name,
                
                f.ticket_name,
                f.ticket_currency,
                f.ticket_fix_price,
                
                g.firstname as booker
                
                FROM tr_events_ticket_book a LEFT JOIN tr_events_book_items b ON a.i_owner = b.code
                LEFT JOIN tr_invoices c ON c.i_booking = b.i_booking 
                LEFT JOIN tr_events d ON d.code = c.f_code
                LEFT JOIN tr_events_group e ON d.i_group = e.code
                LEFT JOIN tr_events_ticket f ON b.i_ticket = f.code
                LEFT JOIN tr_events_book_items g ON a.i_owner = g.code
                WHERE b.i_booking = '".$id."'
            ";
               
        //echo $sql;die;
        
        return DB::fetch($sql);
    }
}
?>

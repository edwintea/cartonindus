<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Everyvents | Ticket Confirmation</title>
<style type="text/css">

    body{
        font-family: Lucida sans, Helvetica, Sans-serif;
        font-size: 12px;
        color: #252525;
    }
    .container{
        width: 660px;
        background: #f5f5f5;
        min-height: 100px;
        margin-left: auto;
        margin-right: auto;
        padding: 20px 20px;
    }
    .box{
        background: #fff; width: auto; min-height: 10px;
    }

    .header{
        width: 100%;
        min-height: 10px;
        background: transparent;
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
    }
    .header img{
        width: 194px;
    }

    .banner{
        width: 100%;
        min-height: 10px;
    }
    .banner img{
        width: 100%;
        min-height: 10px;
    }

    .info-event{
        background: #0669b2; width: auto;
        color:#fff; padding-top: 12px; padding-bottom: 12px; padding-left: 25px; 
        padding-right: 25px; text-align: center; font-size: 13px;
    }
    .info-event .left-border{
        width: 20%; height:1px; background: #fff; float: left; margin-top: 7px;
    }
    .info-event .center-border{
        width: 60%; float: left;
    }
    .info-event .right-border{
        width: 20%; height:1px; background: #fff; float: left; margin-top: 7px;
    }

    .content{
        width: auto; min-height: 200px; padding: 20px; 
    }
    .content a{
        color: #252525;
        text-decoration: none;

    }
    .content a:hover{
        opacity: 0.9;
    }
    .content .title-event{
        font-size: 15px;
        text-align: center;
        margin-bottom: 15px;
    }
    .content .title-event a{
        color: #252525;
    }
    .content .title-event a:hover{
        opacity: 0.9;
    }

    .content .title{
        font-size: 14px; margin-bottom: 20px;
        text-align: left;
    }
    .btn-more{
        background: #959595;
        border:none; border-radius: 5px; padding: 8px; color: #fff; margin-top: 15px; margin-bottom: 15px;
        cursor: pointer;
    }
    .content .box-event{
        min-height: 120px; border-bottom: 1px solid #c3c3c3; margin-top: 15px;
    }
    .content .box-event .left{
        width: 59%; float: left; min-height: 120px; border-right: 1px solid #c3c3c3;
    }
    .content .box-event .left .box-event-info{
        width: 100%; min-height: 10px; margin-bottom: 8px;
    }
    .content .box-event .left .box-event-info .icon{
        width: 20px; min-height: 10px; float: left; text-align: center;
    }
    .content .box-event .left .box-event-info .info-icon{
        width: 80%; min-height: 10px; float: left; margin-left: 10px;
    }
    .content .box-event .left .box-event-info .info-icon .detail{
        margin-bottom: 5px;

    }
    .content .box-event .left .box-event-info .info-icon .detail a{
        color:#1e5883;
        margin-right: 15px;
    }
    .content .box-event .left .box-event-info .info-icon .detail a:hover{
        opacity: 0.9;
    }
    .content .box-event .right{
        width: 40%; float: right; min-height: 120px;
    }

    .e-tickets{
        width: auto; padding: 0px 20px 20px 20px; min-height: 100px;
    }
    .e-tickets .e-tickets-title{
        text-align: center; font-size: 15px; 
    }
    .e-tickets .box-e-tickets{
        width: 400px; margin-top:20px; 
        min-height: 10px; margin-left: auto; margin-right: auto;
    }
    .e-tickets .box-e-tickets .mobile{
        width:50%; min-height: 10px; float: left; text-align: center;
    }
    .e-tickets .box-e-tickets .mobile img{
        margin-bottom: 15px;
    }
    .e-tickets .box-e-tickets .mobile .link a{
        color: #0669B2;
        text-decoration: none;
    }
    .e-tickets .box-e-tickets .mobile .link a:hover{
        opacity: 0.9;
    }
    .e-tickets .box-e-tickets .paper{
        width:50%; min-height: 10px; float: right; text-align: center;
        padding-top: 9px;
    }
    .e-tickets .box-e-tickets .paper img{
        margin-bottom: 15px;
    }
    .e-tickets .box-e-tickets .paper .link a{
        color: #0669B2;
        text-decoration: none;
    }
    .e-tickets .box-e-tickets .paper .link a:hover{
        opacity: 0.9;
    }


    .fitur{
        background: #f5f5f5; width: auto; min-height: 100px; padding: 20px;
        font-size: 12px; 
    }
    .fitur .box-fitur{
        width: 33.333%; min-height: 50px; text-align: center; float: left;
    }
    .fitur .box-fitur .icon-fitur{
        display: table; width: 100%; height: 82px; 
    }
    .fitur .box-fitur .icon-fitur .position{
        display: table-cell; vertical-align: bottom;
    }
    .fitur .box-fitur .title-fitur{
        margin-top: 15px;
        font-size: 12px;
    }
    .fitur .box-fitur .border-fitur{
        width: 60px; height: 2px; background: #252525; margin-left: auto; margin-right: auto;
        margin-top: 8px;
        margin-bottom: 8px;
    }
    .fitur .box-fitur .description-fitur{
        margin-bottom: 8px;
        min-height: 50px; 
        font-size: 12px;
    }
    .fitur .box-fitur .learn-more{
       color:#0669B2;
       font-size: 12px;
    }
    .fitur .box-fitur .learn-more a{
       color:#0669B2;
       text-decoration: none;
    }
    .fitur .box-fitur .learn-more a:hover{
       opacity: 0.9;
    }


    .order{
        width: auto; background: #959595; min-height: 150px; padding: 30px 50px; color: #fff;
    }
    .order .title-order{
        font-size: 23px; 
    }
    .order .no-order{
        font-size: 14px;
    }
    .order .ticket-order{
        text-align: center; font-size: 13px; margin-top: 20px;  margin-bottom: 20px;
    }

    table { 
      width: 100%; 
      border-collapse: collapse; 
      font-size: 13px;
    }
    /* Zebra striping */
    tr:nth-of-type(odd) { 
      background: transparent; 
    }
    th { 
      background: #959595; 
      color: white; 
      font-weight: bold; 
      border-top: 1px solid #fff;
      padding: 5px 0px;
    }
    td{ 
      padding: 5px 0px;  
      text-align: left; 
    }
    .table-size{
        width: 25%;
    }

    /*
    table { 
      width: 100%; 
      margin-top: 20px;
      font-size: 12px;
    }
    th{ 
      background: transparent; 
      color: white; 
      font-weight: bold; 
      padding: 6px; 
    }
    td{ 
        padding: 6px; 
    }
    */
    .center-position{
        text-align: center;
    }
    .left-position{
        text-align: left;
    }
    .right-position{
        text-align: right;
    }

    .search{
        background: #0669B2; width: auto; min-height: 10px; padding: 20px; color:#fff; 
    }
    .search .box-search{
        width: 100%; min-height: 10px;
    }
    .search .box-search .left-search{
        width: 50%; min-height: 10px; float: left;
    }
    .search .box-search .left-search .title-search{
        width: 100%; margin-bottom: 8px; font-size: 13px;
    }
    .search .box-search .left-search a:hover img{
        opacity: 0.9;
    }
    .search .box-search .right-search{
        width: 50%; min-height: 10px; float: right; text-align: right;
    }
    .search .box-search .right-search .title-search{
        width: 100%; margin-bottom: 8px; font-size: 13px;
    }
    .search .box-search .right-search img{
        margin-left: 5px;
    }
    .search .box-search .right-search a:hover img{
        opacity: 0.9;
    }

    .footer{
        text-align:center; background: #fff; width: auto; min-height: 10px; padding-top: 30px; padding-bottom: 30px;
        padding-left: 20px;
        padding-right: 20px;
        font-size: 12px;
    }
    .footer a{
        color:#0669B2;
        text-decoration: none;
    }
    .footer a:hover{
        opacity: 0.9;
    }
    .footer .link-footer{
        width:100%; margin-top: 20px; font-size: 11px;
    }
    .footer .link-footer a{
        color:#0669B2;
    }
    .footer .link-footer a:hover{
        opacity: 0.9;
    }
    .footer .copyright{
        color: #898888;
        font-size: 12px;
    }

    .clearer{
        clear: both;
    }

    @media (max-width: 720px) {
        .container{
            width: auto;
        }
    }

    @media (min-width: 581px) {
        .tr-title-mobile{
            display: none;
        }
    }

    @media (max-width: 580px) {

        .fitur .box-fitur {
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .fitur .box-fitur .description-fitur {
            min-height: 10px;
        }


        /*
        table, thead, tbody, th, td, tr { 
            display: block; 
        }
        thead tr { 
            position: absolute;
            top: -9999px;
            left: -9999px;
        }
        tr { border: 1px solid #ccc;  margin-bottom: 10px;}
        td { 
            border: none;
            border-bottom: 1px solid #eee; 
            position: relative;
            padding-left: 50%; 
        }
        td:before { 
            position: absolute;
            top: 6px;
            left: 6px;
            width: 45%; 
            padding-right: 10px; 
            white-space: nowrap;
        }

       
        td:nth-of-type(1):before { content: "Name"; }
        td:nth-of-type(2):before { content: "Ticket Type"; }
        td:nth-of-type(3):before { content: "Quantity"; }
        td:nth-of-type(4):before { content: "Price"; }
        */
        
        table thead tr { 
            display: none;
        }
        .table-size{
            width: none;
        }
        .table-size-mobile{
            width: 100%;
            display: block;
        }
        .td-sub-mobile{
            width: 100%;
            float: left;
        }
        .table-size-total-mobile{
            display: none;
        }

        .order{
            padding: 20px 20px;
        }
        .left-position{
            text-align: center;
        }
        .center-position{
            text-align: center;
        }
        .right-position{
            text-align: center;
        }
    }

    @media (max-width: 480px) {
        .search .box-search .left-search {
            width: 100%;
            text-align: center;
        }
        .search .box-search .right-search {
            width: 100%;
            text-align: center;
            margin-top: 10px;
        }

        .info-event .left-border {
            width: 100%;
            margin-top: 0px;
        }
        .info-event .center-border {
            width: 100%;
            padding-top: 8px;
            padding-bottom: 8px;
        }
        .info-event .right-border {
            width: 100%;
            margin-top: 0px;
        }

        .content .box-event .left {
            width: 100%;
            border-right: none;
            border-bottom: 1px solid #c3c3c3;
        }
        .content .box-event .right {
            width: 100%;
            min-height: 10px;
            padding-top: 10px;
        }

        .e-tickets .box-e-tickets {
            width: 100%;
        }
        .e-tickets .box-e-tickets .mobile {
            width: 100%;
        }
        .e-tickets .box-e-tickets .paper {
            width: 100%;
            margin-top: 20px;
        }
    }
</style>
</head>

<body>
    <div class="container">
        <div class="box">
            <div class="header">
                <img src="http://everyvents.com/dev/everyvents/assets/img/logo-email.png">
            </div>

            <div class="info-event">
                <div class="left-border"></div>
                <div class="center-border">
                    @php
                        $ev_date =  Carbon\Carbon::createFromFormat('YmdHi',str_replace('-','',$email['ticket']->start_date).$email['ticket']->start_hour.$email['ticket']->start_minute);
                        $ev_date =  $ev_date->toDayDateTimeString();
                        
                    @endphp
                    
                    Don't forget attend your event on {{$ev_date}}
                    
                </div>
                <div class="right-border"></div>
                <div class="clearer"></div>
            </div>

            <div class="banner">
                <a href="{{$email['red_event']}}">
                    <img src="{{$email['cdn']}}{{$email['ticket']->images_file}}">
                </a>
            </div>

            <div class="content">
                <div class="title-event">
                    <a href="{{$email['red_event']}}">{{$email['ticket']->event_name}}</a>
                </div>
                <div class="title">
                    Event Address
                </div>
                <img src="{{$email['ticket']->event_url_location}}" style="width: 100%">
                    
                <div class="box-event">
                    <div class="left">
                        <div class="box-event-info">
                            <div class="icon">
                                 <img src="http://everyvents.com/dev/everyvents/assets/img/icon-calender-email.png">
                            </div>
                            <div class="info-icon">
                                <div class="detail">
                                    {{$ev_date}}<br/>
                                    From {{$email['ticket']->start_hour}}:{{$email['ticket']->start_minute}} {{$email['ticket']->start_time}} 
                                    to 
                                    {{$email['ticket']->end_hour}}:{{$email['ticket']->end_minute}} {{$email['ticket']->end_time}} 
                                </div>
                            </div>
                            <div class="clearer"></div>
                        </div>
                        <div class="box-event-info">
                            <div class="icon">
                                 <img src="http://everyvents.com/dev/everyvents/assets/img/icon-maps-email.png">
                            </div>
                            <div class="info-icon">
                                <div class="detail">
                                    {{$email['ticket']->event_address}}
                                </div>
                            </div>
                            <div class="clearer"></div>
                        </div>
                        <div class="box-event-info">
                            <div class="icon">
                                 <img src="http://everyvents.com/dev/everyvents/assets/img/Add-to-calendar.jpg">
                            </div>
                            <div class="info-icon">
                                <div class="detail">
                                    Add to my calender :<br/>
                                    <a href="#">
                                        Google
                                    </a>
                                    <a href="#">
                                        Outlook
                                    </a>
                                    <a href="#">
                                        iCal
                                    </a>
                                    <a href="#">
                                        Yahoo
                                    </a>
                                </div>
                            </div>
                            <div class="clearer"></div>
                        </div>
                    </div>
                    <div class="right">
                        <div align="center">
                            If you need quest on <br />
                            about this event
                        </div>
                        <div align="center">
                            <a href="{{$email['red_group']}}">
                                <button class="btn-more">
                                    CONTACT ORGANIZER
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="clearer"></div>
                </div>
            </div>
            <div class="e-tickets">
                <div class="e-tickets-title">
                    Get your offline e-Tickets!<br />
                    Just show throught your EVERYVENTS App or download paper ticket
                </div>
                <div class="box-e-tickets">
                    <div class="mobile">
                        <img src="http://everyvents.com/dev/everyvents/assets/img/phone-icon.png">
                        <div class="link"><a href="#">Mobile Tickets</a></div>
                    </div>
                    <div class="paper">
                        <img src="http://everyvents.com/dev/everyvents/assets/img/ticket-icon.png">
                        <div class="link">
                            <a href="#">Paper Tickets</a>
                        </div>
                    </div>
                    <div class="clearer"></div>
                </div>
            </div>

            <div class="order">
                @if(count($email['tickets']) > 0)
                <div class="title-order">ORDER SUMMARY</div>
                <div class="no-order">Order #{{$email['ticket']->invoice_code}}</div>
                <div class="ticket-order">
                    ALL TICKETS PURCHASED FOR THIS EVENT
                </div>
         
                <table>
                    <thead>
                        <tr>
                            <th class="left-position table-size">Name</th>
                            <th class="center-position table-size">Ticket</th>
                            <th class="center-position table-size">Quantity</th>
                            <th class="right-position table-size">Price</th>
                        </tr>
                    </thead>
                    <tbody>                                                                        
                        
                        <tr style="border-top: 1px solid #fff;">
                            <td class="left-position table-size  table-size-mobile"" style="padding-top: 12px; vertical-align: top;">
                                James
                            </td>
                            <td class="center-position td-sub-mobile" colspan="3">
                                <table>
                                    <tbody>                                        
                                        <tr class="tr-title-mobile" style="border-top: 1px solid #fff; border-bottom: 1px solid #fff;">
                                            <td class="center-position table-size">Tickets</td>
                                            <td class="center-position table-size">Quantity</td>
                                            <td class="right-position table-size">Price</td> 
                                        </tr>
                                        
                                        @php
                                            $sub_total=0;
                                            $grand_total=0;
                                        @endphp
                                        
                                        @foreach($email['tickets'] as $ticket)
                                        @php
                                            $curency = $ticket->currency;
                                            $total =  $ticket->qty * $ticket->amount;
                                            $sub_total +=$total;
                                            $grand_total =$sub_total;
                                            
                                        @endphp
                                        
                                        <tr>
                                            <td class="center-position table-size">{{$ticket->item}}</td>
                                            <td class="center-position table-size">{{$ticket->qty}}</td>
                                            <td class="right-position table-size">{{$ticket->currency}}.{{number_format($ticket->amount, 0, '.', ',')}}</td> 
                                        </tr>
                                        @endforeach
                                                                                
                                    </tbody>
                                </table>
                            </td>                      
                        </tr>
                        <tr style="border-top: 1px solid #fff;">
                            <td class="left-position table-size table-size-total-mobile" style="padding-top: 12px; vertical-align: top;">
                                
                            </td>
                            <td class="center-position" colspan="3">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="center-position table-size"></td>
                                            <td class="center-position table-size">Sub Total</td>
                                            <td class="right-position table-size">{{$curency}}.{{number_format($sub_total, 0, '.', ',')}}</td> 
                                        </tr>
                                        <tr>
                                            <td class="center-position table-size"></td>
                                            <td class="center-position table-size">Total</td>
                                            <td class="right-position table-size">{{$curency}}.{{number_format($grand_total, 0, '.', ',')}}</td> 
                                        </tr>
                                    </tbody>
                                </table>
                            </td>                      
                        </tr>
                    </tbody>
                </table>
                @endif
                
            </div>
        
            <div class="fitur">
                <div class="box-fitur">
                    <div class="icon-fitur">
                        <div class="position">
                            <img src="http://everyvents.com/dev/everyvents/assets/img/create-your-own-event.png">
                        </div>
                    </div>
                    <div class="title-fitur">CREATE YOUR OWN EVENT</div>
                    <div class="border-fitur"></div>
                    <div class="description-fitur">
                        Anyone can sell tickets or <br />
                        manage registration with <br />everyvents
                    </div>
                    <div class="learn-more">
                        <a href="{{$email['red_url']}}">Learn More</a>
                    </div>
                </div>
                <div class="box-fitur">
                    <div class="icon-fitur">
                        <div class="position">
                            <img src="http://everyvents.com/dev/everyvents/assets/img/explore-great-event.png">
                        </div>
                    </div>
                    <div class="title-fitur">EXPLORE GREAT EVENT</div>
                    <div class="border-fitur"></div>
                    <div class="description-fitur">
                        Find local events that <br /> match your passions
                    </div>
                    <div class="learn-more">
                        <a href="{{$email['red_url']}}event-tickets">See Events</a>
                    </div>
                </div>
                <div class="box-fitur">
                    <div class="icon-fitur">
                        <div class="position">
                            <img src="http://everyvents.com/dev/everyvents/assets/img/get-the-app.png">
                        </div>
                    </div>
                    <div class="title-fitur">GET THE APP</div>
                    <div class="border-fitur"></div>
                    <div class="description-fitur">
                        Find events, but tickets and <br /> access them on your phone
                    </div>
                    <div class="learn-more">
                        <a href="#">Download E-App</a>
                    </div>
                </div>  
                <div class="clearer"></div>       
            </div>
            <div class="search">
                <div class="box-search">
                    <div class="left-search">
                        <div class="title-search">
                            Find and explore more events on mobile app
                        </div>
                        <a href="#"><img src="http://everyvents.com/dev/everyvents/assets/img/itunes.png"></a>
                        <a href="#"><img src="http://everyvents.com/dev/everyvents/assets/img/google+play.png"></a> 
                    </div>
                    <div class="right-search">
                        <div class="title-search">
                            Find latest promo from everyvents
                        </div>
                        <a href="#"><img src="http://everyvents.com/dev/everyvents/assets/img/fb-email.png"></a>
                        <a href="#"><img src="http://everyvents.com/dev/everyvents/assets/img/instagram-email.png"></a>
                    </div>
                    <div class="clearer"></div>
                </div>
            </div>
            <div class="footer">   
                This e-mail was sent to <a href="#">admin@everyvents.com</a> You are recelving this email because <br /> 
                you've previously registred on everyvents.
                <div class="link-footer">
                    <a href="#">Unsucbscribe | Contact Us</a>
                </div>
                <div class="copyright">
                    Copyright &copy; @php echo date('Y');@endphp Everyvents. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</body>
</html> 
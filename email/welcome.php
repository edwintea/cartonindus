<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Everyvents | Welcome</title>
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
        width: auto;
        min-height: 10px;
        position: relative;
        padding: 0;
    }

    .info{
        width: auto;
        background: transparent;
        height: 45px;
        border-top: 1px solid #EBEBEB;
        border-bottom: 1px solid #EBEBEB;
        line-height: 45px;
        padding-left: 20px;
        padding-right: 20px;
        margin-top: -5px;

    }
    .info .left{
        float: left;
        width: 50%;
        text-align: left;
    }
    .info .right{
        float: right;
        width: 50%;
        text-align: right;
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
    .content .title{
        color: #0669B2; font-size: 14px; margin-top:10px; margin-bottom: 20px;
        
        text-align: center;
    }
    .content .wrapper-box-content{
        width: auto; min-height: 10px; margin-left: -2%; margin-right: -2%;
    }
    .content .wrapper-box-content .box-content{
        width: 43%; padding: 1.5%; min-height: 245px; background: #f5f5f5;
        float: left; margin-left: 2%; margin-right: 2%;
        margin-bottom: 8px;
        margin-top: 8px;
    }
    .content .wrapper-box-content .box-content .img-box-content{
        height: 110px;
        position: relative;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .content .wrapper-box-content .box-content .idr{
        font-size: 13px;
        margin-top: 10px;
        margin-bottom: 5px;
        width: 100%;
        color: #959595;
    }
    .content .wrapper-box-content .box-content .category{
        font-size: 11px; position: relative; color:#0669B2; min-width: 10px;
    }
    .content .wrapper-box-content .box-content .category a{
        color:#0669B2;
    }
    .content .wrapper-box-content .box-content .category a:hover{
        opacity: 0.9;
    }
    .content .wrapper-box-content .box-content .title-events{
        font-size: 13px;
        width: 100%;
        height: 35px;
        overflow: hidden;
    }
    .content .wrapper-box-content .box-content .detail-events{
        width: auto; margin-top: 8px;
    }
    .content .wrapper-box-content .box-content .detail-events .datetime{
        float: left; width: 20%; 
        min-height: 50px; background: #fff; padding-left: 5px; padding-right: 5px;
    }
    .content .wrapper-box-content .box-content .detail-events .datetime .day{
        width: 100%; text-align: center;  
        padding-top: 15px; padding-bottom: 15px; border-bottom: 1px solid #f5f5f5;
    }
    .content .wrapper-box-content .box-content .detail-events .datetime .date{
        font-size: 10px; text-align: center; padding-top: 5px; padding-bottom: 5px;
    }
    .content .wrapper-box-content .box-content .detail-events .address-events{
        float: right; width: 70%; height: 45px; font-size: 11px; overflow: hidden;
    }
    .btn-more{
        background: #959595;
        border:none; border-radius: 5px; padding: 12px; color: #fff; margin-top: 15px; margin-bottom: 15px;
        cursor: pointer;
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

        .content .wrapper-box-content .box-content .img-box-content {
            height: 140px;
        }
        .content .wrapper-box-content .box-content {
            width: 42%;
            padding: 2%;
        }
    }

    @media (max-width: 580px) {

        .content .wrapper-box-content .box-content .img-box-content {
            height: 120px;
        }
        .content .wrapper-box-content .box-content {
            width: auto;
            padding: 5%;
        }
        .content .wrapper-box-content .box-content .detail-events .datetime {
            width: 18%;
        }
        .content .wrapper-box-content .box-content .detail-events .address-events {
            width: 74%;
            height: 45px;
        }

        .fitur .box-fitur {
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .fitur .box-fitur .description-fitur {
            min-height: 10px;
        }
    }

    @media (max-width: 480px) {
        .info {
            width: auto;
            height: auto;
            min-height: 10px;
            padding-top: 10px;
            padding-bottom: 10px;
            line-height: 20px;
        }
        .info .left {
            width: 100%;
            text-align: center;
        }
        .info .right {
            width: 100%;
            text-align: center;
        }

        .search .box-search .left-search {
            width: 100%;
            text-align: center;
        }
        .search .box-search .right-search {
            width: 100%;
            text-align: center;
            margin-top: 10px;
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
            <div class="banner">
                <a href="#">
                    <img src="http://everyvents.com/dev/everyvents/assets/img/e-welcome.jpg" style="width:100%">
                </a>
            </div>
            <div class="info">
                <div class="left">
                    Hallo. {{ucwords($email['name'])}}
                </div>
                <div class="right">
                    {{$email['toDay']->toDayDateTimeString()}}
                </div>
                <div class="clearer"></div>
            </div>
            
            @if(count($email['events']) >0)
            <div class="content">
                <div class="title">
                    Here it is events that posisible you are interested as follow
                </div>
               
                <div class="wrapper-box-content">
                    
                    @foreach($email['events'] as $v)
                    
                    <div class="box-content">
                        <img src="{{$email['cdn']}}{{$v->images_file}}" style="width: 100%">                        
                         
                        <div class="idr">
                            @if($v->min_price != $v->max_price)

                                <div class="events_date">{{$v->currency}} {{number_format($v->min_price, 0, '.', ',')}} - {{$v->currency}} {{number_format($v->max_price, 0, '.', ',') }}</div>

                            @else

                                <div class="events_date">{{$v->currency}} {{number_format($v->min_price, 0, '.', ',')}} </div>

                            @endif

                        </div>
                            
                        <div class="category">
                            <a href="#">{{ucwords($v->category)}}</a>
                        </div>
                        <div class="title-events">
                            <a href="">
                                {{ucwords($v->event_name)}}
                            </a>
                        </div>
                        <div class="detail-events">
                            <div class="datetime">
                                <div class="day">{{strtoupper(substr($v->day,0,3))}}</div>
                                <div class="date">{{strtoupper(substr($v->month,0,3))}} {{$v->date}}</div>
                            </div>
                            <div class="address-events">
                                {!!$v->event_address!!}
                            </div>
                            <div class="clearer"></div>
                        </div>
                    </div>
                    @endforeach
                                        
                    <div class="clearer"></div>
                </div>
                <div align="center">
                    <a href="{{$email['red_url']}}">
                        <button class="btn-more">
                            EXPLORE MORE EVENTS
                        </button>
                    </a>
                </div>
            </div>
            @endif
            
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
                        <a href="#">Learn More</a>
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
                        <a href="#">See Events</a>
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
                    Copyright &copy; <?php echo date('Y');?> Everyvents. All rights reserved.<br>
                    Your Internet provider : {{$email['user'][0]->os_provider}}    
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html> 
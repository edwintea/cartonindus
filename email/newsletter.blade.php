<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Everyvents | News Letter</title>
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
        font-size: 13px; margin-top:10px; margin-bottom: 20px;
        
        text-align: left;
    }
    .btn-more{
        background: #959595;
        border:none; border-radius: 5px; padding: 12px; color: #fff; margin-top: 15px; margin-bottom: 15px;
        cursor: pointer;
    }
    .content .box-events{
        background: #f5f5f5; width: 100%; min-height: 10px;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .content .box-events img{
        width: 100%;
    }
    .content .box-events .detail-content{
        width:auto; padding: 20px;
    }
    .content .box-events .detail-content .datetime{
        font-size: 10px;
        color: #959595;
    }
    .content .box-events .detail-content .category{
        font-size: 11px;
        margin-top: 10px;
    }
    .content .box-events .detail-content .category a{
        color: #0669B2;
    }
    .content .box-events .detail-content .category a:hover{
        opacity: 0.9;
    }
    .content .box-events .detail-content .title-events{
        font-size: 14px;
        
        width: 380px;
        line-height: 18px;
    }
    .content .box-events .detail-content .detail-events{
        width: 100%; min-height: 10px; margin-top: 10px;
    }
    .content .box-events .detail-content .detail-events .address{
        width: 380px; float: left; line-height: 15px; font-size: 11px;
    }
    .btn-get-tickets{
        float: right;
        background: #0368b0;
        color: #fff;
        border: none;
        font-size: 14px;
        padding: 8px;
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
    }
</style>
</head>

<body>
    <div class="container">
        <div class="box">
            <div class="header">
                <img src="http://everyvents.com/dev/everyvents/assets/img/logo-email.png">
            </div>
            <div class="content">
                <div class="title">
                    Here it is events that posisible you are interested as follow
                </div>
                @if(count($email['events']) > 0)
                    @foreach($email['events'] as $v)
                    
                        <div class="box-events">

                            <img src="{{$email['cdn']}}{{$v->images_file}}" style="width: 100%">                            

                            <div class="detail-content">

                                <div class="datetime">{{$v->date}} {{substr(strtoupper($v->month),0,3)}} {{$v->year}}, {{$v->start_hour}}:{{$v->start_minute}} {{$v->start_time}}</div>
                                <div class="category">
                                    <a href="#">{{ucwords($v->category)}}</a>
                                </div>
                                <div class="title-events">
                                    <a href="{{$email['red_url']}}event-tickets/d/{{base64_encode($v->code)}}">{{ucwords($v->event_name)}}</a>
                                </div>
                                <div class="detail-events">
                                    <div class="address">
                                        {{$v->event_address}}
                                    </div>
                                    <a href="{{$email['red_url']}}">
                                    <button class="btn-get-tickets">GET TICKETS</button>
                                    </a>
                                    <div class="clearer"></div>
                                </div>
                            </div>
                        </div>
                    
                    @endforeach
                
                @endif
                                
                <div align="center">
                    <a href="{{$email['base_red_url']}}">
                        <button class="btn-more">
                            EXPLORE MORE EVENTS
                        </button>
                    </a>
                </div>
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
                    Copyright &copy; 2017 Everyvents. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</body>
</html> 
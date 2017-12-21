<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Everyvents | Verification</title>
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

    .info{
        width: auto;
        background: transparent;
        height: 45px;
        border-top: 1px solid #EBEBEB;
        border-bottom: 1px solid #EBEBEB;
        line-height: 45px;
        padding-left: 20px;
        padding-right: 20px;
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
        width: auto; min-height: 150px; padding: 20px; 
    }
    .content a{
        color: #252525;
        text-decoration: none;
    }
    .content a:hover{
        opacity: 0.9;
    }
    .content .title{
        color: #0669B2; font-size: 22px; margin-top:20px; margin-bottom: 20px;
        
    }
    .btn-manage{
        background: #0669B2;
        width: 120px;
        height: 35px;
        border: none;
        font-size: 12px;
        color: #fff;
        margin-top: 25px;
    }
    .btn-manage:hover{
        opacity: 0.9;
        cursor: pointer;
    }
  
    .tips{
        background: #f5f5f5; width: auto; min-height: 100px; padding: 15px 20px 30px 20px;
    }
    .tips .title{
        font-size: 18px;
        margin-top: 15px;
    }
    .tips .box-tips{
        width: 33.333%; min-height: 50px; text-align: center; float: left;
    }
    .tips .box-tips .icon-tips{
        display: table; width: 100%; height: 82px; 
    }
    .tips .box-tips .icon-tips .position{
        display: table-cell; vertical-align: bottom;
    }
    .tips .box-tips .title-tips{
        margin-top: 15px;
        font-size: 12px;
        color: #0669B2;
    }
    .tips .box-tips .title-tips a{
        color: #0669B2;
        text-decoration: none;
    }
    .tips .box-tips .title-tips a:hover{
        opacity: 0.9
    }
    .tips .box-tips .border-tips{
        width: 60px; height: 2px; background: #252525; margin-left: auto; margin-right: auto;
        margin-top: 8px;
        margin-bottom: 8px;
    }
    .tips .box-tips .description-tips{
        margin-bottom: 8px;
        min-height: 50px; 
        font-size: 12px;
    }

    .question{
        background: #fff; width: auto; min-height: 10px; padding: 30px 20px;
    }
    .question .title{
        font-size: 18px; margin-bottom:10px;
    }


    .fitur{
        background: #f5f5f5; width: auto; min-height: 100px; padding: 15px 20px 30px 20px;
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
        background-color: #0669B2; width: auto; min-height: 10px; padding: 20px; color:#fff; 
        
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

        .tips .box-tips {
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .tips .box-tips .description-tips {
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
            <div class="info">
                <div class="left">
                    Hallo. Andri
                </div>
                <div class="right">
                    Wednesday - March 15, 2017
                </div>
                <div class="clearer"></div>
            </div>
            <div class="content">
                <div class="title">
                    YOUR EVENT WAS PUBLISH!
                </div>
                Nice work. Your event "Music Concert", is up and running and ready for action. Go ahead and check it out.
               
                <a href="#"><button class="btn-manage">MANAGE EVENT</button></a>
                
            </div>
            <div class="tips">
                <div class="title">Tips manage your event</div>
                <div class="box-tips">
                    <div class="icon-tips">
                        <div class="position">
                            <img src="http://everyvents.com/dev/everyvents/assets/img/icon-message.png">
                        </div>
                    </div>
                    <div class="title-tips"><a href="#">SEND INVITES</a></div>
                    <div class="border-tips"></div>
                    <div class="description-tips">
                        Upload your contacts, send <br />
                        email invitations and track <br />
                        your result in your<br />
                        account.
                    </div>
                </div>
                <div class="box-tips">
                    <div class="icon-tips">
                        <div class="position">
                            <img src="http://everyvents.com/dev/everyvents/assets/img/icon-money.png">
                        </div>
                    </div>
                    <div class="title-tips"><a href="#">GET YOUR MONEY</a></div>
                    <div class="border-tips"></div>
                    <div class="description-tips">
                        If you're collecting money<br />
                        for your event, make sure <br />
                        you tell us where to send it.
                    </div>
                </div>
                <div class="box-tips">
                    <div class="icon-tips">
                        <div class="position">
                            <img src="http://everyvents.com/dev/everyvents/assets/img/icon-speaker.png">
                        </div>
                    </div>
                    <div class="title-tips"><a href="#">PROMOTE FOR FREE</a></div>
                    <div class="border-tips"></div>
                    <div class="description-tips">
                        Share your event on <br />
                        Facebook, Twitter, Instagram <br />
                        and show up on search<br />
                        engines, if you want.
                    </div>
                </div>
                <div class="box-tips">
                    <div class="icon-tips">
                        <div class="position">
                            <img src="http://everyvents.com/dev/everyvents/assets/img/icon-go-mobile.png">
                        </div>
                    </div>
                    <div class="title-tips"><a href="#">GO MOBILE</a></div>
                    <div class="border-tips"></div>
                    <div class="description-tips">
                        Stay on top of your event<br />
                        from anywyhere with our<br />
                        free Everyvents app and <br />
                        Everyvents Organizer
                    </div>
                </div>
                <div class="box-tips">
                    <div class="icon-tips">
                        <div class="position">
                            <img src="http://everyvents.com/dev/everyvents/assets/img/icon-collect-info.png">
                        </div>
                    </div>
                    <div class="title-tips"><a href="#">COLLECT INFO</a></div>
                    <div class="border-tips"></div>
                    <div class="description-tips">
                        Add extra questions in the <br />
                        registration from to learn<br />
                        more about your attendees.
                    </div>
                </div>
                <div class="box-tips">
                    <div class="icon-tips">
                        <div class="position">
                            <img src="http://everyvents.com/dev/everyvents/assets/img/icon-pc.png">
                        </div>
                    </div>
                    <div class="title-tips"><a href="#">SELL ON YOUR SITE</a></div>
                    <div class="border-tips"></div>
                    <div class="description-tips">
                        Add a calender, ticket box, or <br />buttons to 
                        sell tickets 
                        <br />on your
                        own site.
                    </div>
                </div>  
                <div class="clearer"></div>
            </div>
            <div class="question">
                <div class="title">Any Question?</div>
                Check out our <b>Help Center</b> for great tips from our event expert.
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
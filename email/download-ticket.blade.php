<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Everyvents | Ticket</title>
</head>

<body>

<style type="text/css">

body{
    font-family: Lucida sans, Helvetica, Sans-serif;
    font-size: 12px;
    color: #252525;
}

.corner {
    background:#fff;
    height:34px;
    width:30px;    
    position:absolute;
    z-index: 100;
}

#top-left {
    left: -1px;
    top: -1px;
    border-radius: 0px 0px 30px 0px;
    border-bottom: 1px solid #424242;
    border-right: 1px solid #424242;
}
#top-right {
    right: -1px;
    top: -1px;
    border-radius: 0px 0px 0px 30px;
    border-bottom: 1px solid #424242;
    border-left: 1px solid #424242;
}
#bottom-left {
    left: -1px;
    bottom: -1px;
    border-radius: 0px 30px 0px 0px;
    border-top: 1px solid #424242;
    border-right: 1px solid #424242;
}
#bottom-right {
    right: -1px;
    bottom: -1px;
    border-radius: 30px 0px 0px 0px;
    border-top: 1px solid #424242;
    border-left: 1px solid #424242;
}

.box-ticket {
    position:relative;
    min-height:100px;
    width:530px;
    border: 1px solid #424242;
    background:#fff;
    margin: 0 auto;
    border-radius: 5px -5px 5px 5px;
}
.box-ticket .ticket {
    display: table-cell; vertical-align: middle; padding-top: 30px; padding-bottom: 30px;
}

.box-ticket .ticket .label {
    max-width: 42px; display: table-cell; vertical-align: middle; text-align: center; font-size: 20px; 
    padding: 0; border-right: 1px solid #ebebeb;  
    letter-spacing: 2px;
}
.box-ticket .ticket .label .position{
    transform: rotate(-90deg); -webkit-transform: rotate(-90deg); 
    -moz-transform: rotate(-90deg); -ms-transform: rotate(-90deg); 
    vertical-align: middle; display: table-cell; left: -21px; position: relative;
}

.box-ticket .ticket .content{
    width: 446px; display: table-cell; vertical-align: middle; 
}
.box-ticket .ticket .content .box-content{
    width: auto; min-height: 10px; font-size: 11px; 
    padding-left: 15px; padding-right: 15px;
}
.box-ticket .ticket .content .box-content .left{
    width: 40%; float: left; 
}
.box-ticket .ticket .content .box-content .left span{
    float: right;
}
.box-ticket .ticket .content .box-content .right{
    width: 58%; float: right; 
}

.box-ticket .ticket .barcode{
    width: 42px; display: table-cell; vertical-align: middle; border-left: 1px solid #ebebeb;
}
.box-ticket .ticket .barcode .detail-barcode{
    margin-left: 10px;
}
.box-margin{
    margin-bottom: 8px;
}

.box-ticket .ticket .content .company{
    width: 200px; display: table-cell; vertical-align: middle;
}
.box-ticket .ticket .content .company .box-company{
    padding-left: 15px; padding-right:15px; text-align: right; font-size: 11px;
}
.box-ticket .ticket .content .company .box-company .logo{
    width: 100px;
}
.box-ticket .ticket .content .company .box-company .organized{
    width: auto; margin-top: 10px; margin-bottom: 20px;
}
.box-ticket .ticket .content .company .box-company .weblink{
    margin-top: 5px;
}

.corner-dashed {
    background:#fff;
    height:34px;
    width:30px;    
    position:absolute;
    z-index: 100;
}

#top-left-dashed {
    left: -1px;
    top: -1px;
    border-radius: 0px 0px 30px 0px;

    border-bottom: 1px dashed #eeeeee;
    border-right: 1px dashed #eeeeee;

}
#top-right-dashed {
    right: -1px;
    top: -1px;
    border-radius: 0px 0px 0px 30px;

    border-bottom: 1px dashed #eeeeee;
    border-left: 1px dashed #eeeeee;
  
}
#bottom-left-dashed {
    left: -1px;
    bottom: -1px;
    border-radius: 0px 30px 0px 0px;

    border-top: 1px dashed #eeeeee;
    border-right: 1px dashed #eeeeee;
   
}
#bottom-right-dashed {
    right: -1px;
    bottom: -1px;
    border-radius: 30px 0px 0px 0px;

    border-top: 1px dashed #eeeeee;
    border-left: 1px dashed #eeeeee;

}
.box-ticket-dashed {
    position:relative;
    min-height:100px;
    width:530px;

    border-bottom: 1px dashed #eeeeee;
    border-left: 1px dashed #eeeeee;
    border-right: 1px dashed #eeeeee;

    background:#fff;
    margin: 0 auto;
    border-radius: 5px -5px 5px 5px;
}
.box-ticket-dashed .ticket-dashed {
    padding-top: 50px; padding-bottom: 50px; text-align: center;
}

.clearer{
    clear: both;
}

</style>

<div class="box-ticket">
    <div id="top-right"  class="corner"></div>
    <div id="top-left" class="corner"></div>
    <div id="bottom-right" class="corner"></div>
    <div id="bottom-left" class="corner"></div>
    <div class="ticket">
        <div class="label">
            <div class="position">
                TICKET
            </div>
        </div>
        <div class="content">  
            <div style="width: 246px; display: table-cell; vertical-align: middle; border-right: 1px solid #ebebeb">      
                <div class="box-content">
                    <div class="left">
                        Event <span>:</span>
                    </div>
                    <div class="right">
                        Cross-platform utility
                    </div>
                    <div class="clearer"></div>
                </div>
                <div class="box-margin"></div>
                <div class="box-content">
                    <div class="left">
                        Date & Time<span>:</span>
                    </div>
                    <div class="right">
                        5 Sept 2016, 12:30 pm
                    </div>
                    <div class="clearer"></div>
                </div>
                <div class="box-margin"></div>
                <div class="box-content">
                    <div class="left">
                        Location <span>:</span>
                    </div>
                    <div class="right">
                        Gelora Bung Karno
                    </div>
                    <div class="clearer"></div>
                </div>
                <div class="box-margin"></div>
                <div class="box-content">
                    <div class="left">
                        Ordered By <span>:</span>
                    </div>
                    <div class="right">
                        Mr. Andri
                    </div>
                    <div class="clearer"></div>
                </div>
                <div class="box-margin"></div>
                <div class="box-content">
                    <div class="left">
                        Seat <span>:</span>
                    </div>
                    <div class="right">
                        2
                    </div>
                    <div class="clearer"></div>
                </div>
                <div class="box-margin"></div>
                <div class="box-content">
                    <div class="left">
                        Price <span>:</span>
                    </div>
                    <div class="right">
                        Rp. 10.000
                    </div>
                    <div class="clearer"></div>
                </div>
                <div class="box-margin"></div>
                <div class="box-content">
                    <div class="left">
                        Ticket Type <span>:</span>
                    </div>
                    <div class="right">
                        Standard
                    </div>
                    <div class="clearer"></div>
                </div>
            </div>
            <div class="company">
                <div class="box-company">
                    <img src="http://everyvents.com/dev/everyvents/assets/img/logo-email.png" class="logo">
                    <div class="organized">
                        Want to make great event ? <br/>
                        Organized your event with us
                    </div>
                    <img src="http://everyvents.com/dev/everyvents/assets/img/barcode-ticket.jpg">
                    <div class="weblink">
                        www.everyvents.com
                    </div>
                </div>
            </div>
        </div>
        <div class="barcode">
            <img src="http://everyvents.com/dev/everyvents/assets/img/qr.jpg" class="detail-barcode">
        </div>
    </div>
</div>



<div class="box-ticket-dashed">
    <div id="top-right-dashed"  class="corner-dashed"></div>
    <div id="top-left-dashed" class="corner-dashed"></div>
    <div id="bottom-right-dashed" class="corner-dashed"></div>
    <div id="bottom-left-dashed" class="corner-dashed"></div>
    <div class="ticket-dashed">
        <img src="http://everyvents.com/dev/everyvents/assets/img/E-ticket.png">
    </div>
</div>
<div class="box-ticket-dashed">
    <div id="top-right-dashed"  class="corner-dashed"></div>
    <div id="top-left-dashed" class="corner-dashed"></div>
    <div id="bottom-right-dashed" class="corner-dashed"></div>
    <div id="bottom-left-dashed" class="corner-dashed"></div>
    <div class="ticket-dashed">
        <img src="http://everyvents.com/dev/everyvents/assets/img/E-ticket.png">
    </div>
</div>

</body>
</html> 
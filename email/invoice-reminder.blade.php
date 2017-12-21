<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Everyvents | Ticket Confirmation</title>
<style type="text/css">

    body{
        font-family:Lucida sans, Helvetica, Sans-serif;
        font-size: 12px;
        color: #252525;
    }
    .container{
        width: 700px;
        background: red;
        min-height: 100px;
        margin-left: auto;
        margin-right: auto;
    }
    .box{
        background: #fff; width: auto; min-height: 10px;
    }
    
    .btn-more{
        background: #959595;
        border:none; border-radius: 5px; padding: 12px; color: #fff; margin-top: 15px; margin-bottom: 15px;
        cursor: pointer;
    }

    .header{
        width: 100%;
        min-height: 10px;
        background: transparent;
        padding-top: 12px;
        padding-bottom: 12px;
    }
    .header .left{
        width: 50%;
        float: left;
    }
    .header .right{
        width: 50%;
        float: right;
        text-align: right;
    }

    .invoice{
        width: 100%;
    }
    .invoice .left{
        width: 50%; float: left;
    }
    .invoice .left .to{
        margin-bottom: 10px;
    }
    .invoice .right{
        width: 50%; float: right; padding-top: 20px; text-align: right;
    }

    .order{
        width: auto; min-height: 150px; padding-top: 15px; padding-bottom: 15px;
    }
    .order .title-order{
        font-size: 23px; 
    }
    .order .no-order{
        font-size: 14px;
    }
    

    table { 
      width: 100%; 
      border-collapse: collapse; 
      font-size: 12px;
    }
    /* Zebra striping */
    tr:nth-of-type(odd) { 
      background: transparent; 
    }
    th { 
     
      border-top: 1px solid #ebebeb;
      padding: 5px 0px;
    }
    td{ 
      padding: 0px 0px;  
      text-align: left; 
    }
    .table-size{
        width: 15%;
    }
    .table-size-event{
        width: 30%;
    }
    .title-padding{
        padding-top: 8px;
        padding-bottom: 8px;
    }
    .title-sub-padding{
        padding-top: 2px;
        padding-bottom: 4px;
    }

    .center-position{
        text-align: center;
    }
    .left-position{
        text-align: left;
    }
    .right-position{
        text-align: right;
    }

    .payment{
        background: #0669B2; width: auto; min-height: 10px; padding: 20px; color:#fff; 
        text-align: center;
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
    .footer .note{
        color:#0669B2;
    }

    .clearer{
        clear: both;
    }

    @media (max-width: 720px) {
        .container{
            width: auto;
        }
        .header .left{
            width: 100%;
            float: left;
            text-align: center;
            margin-bottom: 15px;
        }
        .header .right{
            width: 100%;
            float: left;
            text-align: center;
        }     

        .invoice .left{
            width: 100%; float: left; text-align: center;
        }
        .invoice .right{
            width: 100%; float: right; padding-top: 20px; text-align: center;
        }

        
       
    }

    @media (min-width: 581px) {
        .tr-title-mobile{
            display: none;
        }
    }
    @media (max-width: 580px) {
        
        .table-size-event{
            width: 100%;
        }

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
        
    }
</style>
</head>

<body>
    @if(count($email['invoices']) > 0)
        @foreach($email['invoices'] as $inv)
        @php
            $inv_date = Carbon\Carbon::createFromFormat('YmdHi',date('YmdHi'));
            $inv_date =$inv_date->toDayDateTimeString();
                
            $due_date = Carbon\Carbon::createFromFormat('YmdHi',str_replace('-','',$inv->late_payment_date)."0000");
            $due_date =$due_date->toDayDateTimeString();                                                        
                        
        @endphp
        <div class="container">
            <div class="box">
                <div class="header">
                    <div class="left">
                        <img src="http://everyvents.com/dev/everyvents/assets/img/logo-email.png">
                    </div>
                    <div class="right">
                        Plaza Kuningan <br/>
                        Menara Utara Lt. 10 <br/>
                        Jl. H.R. Rasuna Said Kav. C11-14 <br/>
                        Jakarta Selatan 12940
                    </div>
                    <div class="clearer"></div>
                </div>

                <div class="invoice">
                    <div class="left">
                        <div class="to"><b>Invoiced To</b></div>
                        {{ucwords($inv->fullname)}}<br/>
                        {{$inv->address}}<br/>                        
                        {{$inv->email}}<br/>
                        {{$inv->phone}}<br/>
                        <b>Waiting for Payment</b>
                    </div>
                    <div class="right">
                        No. #{{$inv->code}}<br />
                        Invoice Date: {{$inv_date}}<br />
                        Due Date: {{$due_date}}
                    </div>
                    <div class="clearer"></div>
                </div>
                <div class="order">
                    <table>
                        <thead>
                            <tr>
                                <th class="left-position table-size-event title-padding">
                                    <b>Events</b>
                                </th>
                                <th class="center-position table-size title-padding">
                                    <b>Type</b>
                                </th>
                                <th class="center-position table-size title-padding">
                                    <b>Price</b>
                                </th>
                                <th class="center-position table-size title-padding">
                                    <b>Quantity</b>
                                </th>
                                <th class="right-position table-size title-padding">
                                    <b>Total</b>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-top: 1px solid #ebebeb;">
                                <td class="left-position table-size-event table-size-mobile" style="padding-top: 12px; padding-bottom:12px; vertical-align: top;">
                                    {{ucwords($inv->event_name)}}
                                </td>
                                <td class="center-position td-sub-mobile" colspan="4">
                                    <table style="margin-top: 8px; margin-bottom: 8px;">
                                        <tbody>

                                            <tr class="tr-title-mobile" style="border-top: 1px solid #ebebeb; border-bottom: 1px solid #ebebeb;">
                                                <td class="center-position table-size title-padding"><b>Type</b></td> 
                                                <td class="center-position table-size title-padding"><b>Price</b></td>
                                                <td class="center-position table-size title-padding"><b>Quantity</b></td>
                                                <td class="right-position table-size title-padding"><b>Total</b></td> 
                                            </tr>
                                            
                                            <!--loop item-->
                                            @if(count($email['inv_items']) > 0)
                                                @php
                                                    $grand_total=0;
                                                @endphp
                                                
                                                @foreach($email['inv_items'] as $item)
                                                    @php

                                                        $curency = $item->currency;
                                                        $sub_total = $item->amount * $item->qty;
                                                        $total=0;
                                                        $total+=$item->amount;
                                                        $grand_total+=$sub_total;
                                                    @endphp
                                                <tr>
                                                    <td class="center-position table-size title-sub-padding">{{$item->item}}</td>
                                                    <td class="center-position table-size title-sub-padding">{{$item->currency}} {{number_format($item->amount, 0, '.', ',')}}</td>
                                                    <td class="center-position table-size title-sub-padding">{{$item->qty}}</td>
                                                    <td class="right-position table-size title-sub-padding">{{$item->currency}} {{number_format($sub_total, 0, '.', ',')}}</td> 
                                                </tr>
                                                @endforeach
                                            @endif
                                            
                                            <!-- end loop-->                                            

                                        </tbody>
                                    </table>
                                </td>                      
                            </tr>

                            <tr style="border-top: 1px solid #ebebeb;">
                                <!--
                                <td class="left-position table-size table-size-total-mobile" style="padding-top: 12px; vertical-align: top;">

                                </td>
                                -->
                                <td class="center-position" colspan="5">
                                    <table>
                                        <tbody>
                                            <tr style="border-bottom: 1px solid #ebebeb;" >
                                                <td class="center-position table-size title-padding"></td>
                                                <td class="center-position table-size title-padding"></td>
                                                <td class="right-position table-size title-padding">
                                                    <b>Sub Total</b>
                                                </td>
                                                <td class="right-position table-size title-padding">
                                                    {{$curency}} {{number_format($grand_total, 0, '.', ',')}}
                                                </td> 
                                            </tr>
                                            <tr style="border-bottom: 1px solid #ebebeb;" >
                                                <td class="center-position table-size title-padding"></td>
                                                <td class="center-position table-size title-padding"></td>
                                                <td class="right-position table-size title-padding">
                                                    <b>Total</b>
                                                </td>
                                                <td class="right-position table-size title-padding">
                                                    {{$curency}} {{number_format($grand_total, 0, '.', ',')}}
                                                </td> 
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>                      
                            </tr>
                        </tbody>
                    </table>

                </div>


                <div class="payment">
                    Payment Method {{$inv->payment_method}}<br />
                    Date Of Payment: {{$due_date}}
                </div>
                <div class="footer"> 

                    <div class="note"> 
                        <i>
                        *Note that all payment are non-refundable unless the event is cancelled by the organizer themselves.
                        </i>
                    </div>

                    <p>
                    Untuk pembayaran melalui transfer bank harap gunakan SALAH SATU rekening berikut:<br />
                    BCA Cabang Monginsidi, Jakarta. No Rek. 000.222.444 a/n Sababay (pemrosesan 1 jam s.d. 1 hari)<br />
                    BCA Cab. Wisma Nusantara, Jakarta. No Rek. 000.222.444 a/n Sababay (1-7 hari)<br />
                    Bank Mandiri Cab. Patrajasa, Jakarta. No Rek. 000.222.444 a/n Sababay ( 1 jam s.d. 1 hari)<br />
                    Bank Mandiri Cab. Wisma Nusantara, Jakarta. No Rek. 000.222.444 a/n Sababay (2-7 hari)
                    </p>

                    <p>
                        PENTING: Cantumkan nomor tagihan (#INV.170522.00076) dalam kolom berita dan lakukan KONFIRMASI PEMBAYARAN setelah transfer
                    </p>

                    <p>
                        (Login ke http://everyvents.com/ lalu klik Menu Payment Confirmation, klik Send)
                    </p>

                    <p>
                        atau klik tombol dibawah ini :<br>
                            <a href="{{$email['red_url']}}">
                                <button class="btn-more">
                                    PAY NOW!
                                </button>
                            </a>
                    </p>

                    Setoran TUNAI/nama pemilik rekening berbeda dari nama di tagihan, dan tanpa berita nomor tagihan, tidak dapat diproses!. 
                    Kami tidak bertanggung jawab atas keterlambatan proses karena berita salah/tidak lengkap atau jika ada masalah pada internet banking
                </div>
            </div>
        </div>
        @endforeach
    @endif            
</body>
</html> 
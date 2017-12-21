<?php

include_once('lib/PHPMailer/class.phpmailer.php');

class Email{
            
    public function _blast($tpl=NULL,$data=array()){
        
        $mail = new PHPMailer();
        
        try{
            
            $mail->CharSet = 'UTF-8';
            $body = $tpl;
            
            $mail->IsSMTP();
            
            $mail->Host       = 'premium38.web-hosting.com';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;
            $mail->SMTPDebug  = 1;
            $mail->SMTPAuth   = true;
            $mail->Username   = 'info@ev-class.com';
            $mail->Password   = '1q2w3e4r';
            
            $mail->SetFrom($data['EMAIL']['from'], $data['APP']['app_name']);
            $mail->AddReplyTo('no-reply@ev.com','no-reply');
            $mail->Subject    = $data['EMAIL']['subject'];
            $mail->MsgHTML($body);

            $mail->AddAddress($data['EMAIL']['to'], ucwords($data['EMAIL']['name']));
            $mail->addBCC("kubilk56@gmail.com", $data['EMAIL']['subject']);
                                    
            if(isset($data['EMAIL']['attachment'])){                
                    
                $mail->AddAttachment($data['EMAIL']['attachment']);
                
            }
            
            $mail->send();

            $status=1;
            $message="Email was Send Coy...";
            
        } catch (Exception $ex) {
            
            $status=0;
            $message="Opps,...Email was not send Coy...";

        }        
        
        return array(
            'status'    =>  $status,
            'message'   =>  $message
        );
    }
    
    public function _setReponse($sts=0,$info=NULL){
        
        return array(
            'status'    =>  $sts,
            'message'   =>  $info
        );
    }
}
?>

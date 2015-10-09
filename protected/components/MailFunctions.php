<?php

class MailFunctions
{
  public static function SendMailFunction($mail_to, $mail_from, $message="", $subject="", $cc = []) {

    Yii::import('application.extensions.phpmailer.JPhpMailer');

    $mail = new JPhpMailer;
    $__smtp = $mail->__smtp;

    if(is_null($mail_to)) $mail_to = $__smtp['addreply'];
    if(is_null($mail_from)) $mail_from = $__smtp['addreply'];

    $mail_arr = explode(",",$mail_to);

    if($subject=="") $subject = Yii::t('trans','Site title');

    $mail->IsSMTP();

    $mail->SMTPSecure = 'ssl';
    $mail->Host    = $__smtp['host'];
    $mail->SMTPAuth = $__smtp['auth'];
    $mail->Port = $__smtp['port'];
    $mail->Username = $__smtp['username'];
    $mail->Password = $__smtp['password'];
    $mail->AddReplyTo($mail_from, $mail_from);
    $mail->SetFrom($mail_from, $mail_from);

    if (!empty($cc)) {
      if (is_array($cc) && count($cc) == 2) {
        $mail->AddCC($cc[0], $cc[1]);
      } else if (is_array($cc)) {
        $mail->AddCC($cc[0]);
      } else {
        $mail->AddCC($cc);
      }
    }

    $mail->Subject = $subject;

    $mail->MsgHTML($message);
    $mail->CharSet= "utf-8";
    foreach($mail_arr as $email){
      $mail->AddAddress(trim($email));
    }
    if($mail->Send()){
    }
  }

}

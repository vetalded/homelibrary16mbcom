<?php

/**
 * JPhpMailer class file.
 *
 * @version alpha 2 (2010-6-3 16:42)
 * @author jerry2801 <jerry2801@gmail.com>
 * @required PHPMailer v5.1
 *
 * A typical usage of JPhpMailer is as follows:
 * <pre>
 * Yii::import('ext.phpmailer.JPhpMailer');
 * $mail=new JPhpMailer;
 * $mail->IsSMTP();
 * $mail->Host='smpt.163.com';
 * $mail->SMTPAuth=true;
 * $mail->Username='yourname@yourdomain';
 * $mail->Password='yourpassword';
 * $mail->SetFrom('name@yourdomain.com','First Last');
 * $mail->Subject='PHPMailer Test Subject via smtp, basic with authentication';
 * $mail->AltBody='To view the message, please use an HTML compatible email viewer!';
 * $mail->MsgHTML('<h1>JUST A TEST!</h1>');
 * $mail->AddAddress('whoto@otherdomain.com','John Doe');
 * $mail->Send();
 * </pre>
 */

require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'class.phpmailer.php';

class JPhpMailer extends PHPMailer
{
  public $__smtp = array(
    "host" => "smtp.gmail.com", //smtp сервер
    "auth" => true,                 //сервер требует авторизации
    "port" => 465,                    //порт (по-умолчанию - 25)
    "username" => "software.aura@gmail.com",//имя пользователя на сервере
    "password" => "wbluesch",//пароль
    "addreply" => "software.aura@gmail.com",//ваш е-mail
    "replyto" => "software.aura@gmail.com"//e-mail ответа
  );
/*	public $__smtp = array(
		"host" => "tls://mail3.nest.vn.ua",
		"auth" => true,
		"port" => 587,
		"username" => "admin@aura.nest.vn.ua",
		"password" => "gfhjkmf",
		"addreply" => "software.aura@gmail.com",
		"replyto" => "software.aura@gmail.com",
	);*/
}

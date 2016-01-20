<?php
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$ques = $_POST['ques'];
$ref = $_POST['ref'];
$utm = $_POST['utm'];
$sitename = $_POST['sitename'];
$formname = $_POST['formname'];
$maillist = explode('|', $_POST['emailsarr']);
$headers  = "Content-type: text/html; charset=utf-8 \r\n";
$headers .= "From: $sitename\r\n";
$td1_style = "border: 1px solid #000; max-width: 140px; padding: 5px 10px; font-weight: bold; background-color: #e8e8e8;";
$td2_style = "border: 1px solid #000; max-width: 460px; min-width: 300px; padding: 5px 10px;";
$msg_top = "
		<html>
			<body>
				<table style=\"border-collapse: collapse;\">
					<tr>
						<td style=\"$td1_style\">Имя</td>
						<td style=\"$td2_style\">$name</td>
					</tr>
					<tr>
						<td style=\"$td1_style\">Номер телефона</td>
						<td style=\"$td2_style\">$phone</td>
					</tr>";
$msg_bot = "
					<tr>
						<td style=\"$td1_style vertical-align: top;\">Реферер</td>
						<td style=\"$td2_style\">$ref</td>
					</tr>
					<tr>
						<td style=\"$td1_style vertical-align: top;\">utm-метки</td>
						<td style=\"$td2_style\">$utm</td>
					</tr>
				</table>
			</body>
		</html>";
$msg_mail = "
					<tr>
						<td style=\"$td1_style\">Электронный адрес</td>
						<td style=\"$td2_style\">$email</td>
					</tr>";
$msg_ques = "
					<tr>
						<td style=\"$td1_style vertical-align: top;\">Вопрос</td>
						<td style=\"$td2_style\">$ques</td>
					</tr>";
if(!empty($_POST['callback'])) {
    $subject = "$sitename | Заказ звонка";
    $message = $msg_top.$msg_bot;
}
if(!empty($_POST['request'])) {
    $subject = "$sitename | Заявка $formname";
    $message = $msg_top.$msg_mail.$msg_bot;
}
if(!empty($_POST['question'])) {
    $subject = "$sitename | Вопрос менеджеру";
    $message = $msg_top.$msg_mail.$msg_ques.$msg_bot;
}
if(!empty($_POST['callback']) || !empty($_POST['request']) || !empty($_POST['question'])) {
    foreach ($maillist as $mail) {
        mail($mail, $subject, $message, $headers) or print "Не могу отправить письмо !!!";
    }
}


require_once 'config.php';
$today = date("Y-m-d H:i:s");
$arrpopup = array("name"=>$name,"phone"=>$phone,"email"=>$email,"date"=>$today,"formname"=>$formname);
DB::insert(DB::insertSql("callback",$arrpopup),$arrpopup);

//	unset($name,$email,$phone,$ques,$ref);
?>
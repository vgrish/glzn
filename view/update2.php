<? include "../config.php";
	switch ($_POST['form']) {
		case 'card':
            $login = ConfigSites::sessionId();
            $data = DB::selectSql("SELECT
					cart.id as id,
					price.id as price_id,
					price.name as name,
					price.price as price,
					cart.size as size,
					cart.kol as kol,
					price_photo.src as src,
					colors.rgb as color
					FROM cart
					LEFT JOIN price ON price.id=cart.price_id
					LEFT JOIN colors ON colors.id=cart.color
					LEFT JOIN price_photo ON price_photo.price_id=cart.price_id AND price_photo.color=cart.color
					WHERE login='$login'");
			echo json_encode($data);
			break;
		case 'add_card':
			$now = ConfigSites::today();
            $login = ConfigSites::sessionId();
            $array = array('price_id'=>$_POST['id'],'login'=>$login,'size'=>$_POST['size'],'color'=>$_POST['color'],'kol'=>$_POST['kol'],'date'=>$now);
            $lastId = DB::insert(DB::insertSql("cart",$array),$array);
            return $lastId;
		break;
		case 'card_count_minus':
            DB::updatePM("UPDATE `cart` SET `kol` = `kol`-1 WHERE id =".$_POST['id']);
            break;
        case 'card_count_plus':
            DB::updatePM("UPDATE `cart` SET `kol` = `kol`+1 WHERE id =".$_POST['id']);
		break;
		case 'delete_card':
            DB::deleteCart($_POST['id']);
		break;
        case 'oformzakaz':
            $now = ConfigSites::today();
            $array = array("date"=>$now,"sun"=>$_POST['sumzakaz'],"sun_dost"=>$_POST['sumdost'],"name"=>$_POST['name'],"phone"=>$_POST['phone'],"email"=>$_POST['email'],"region"=>$_POST['address_state'],"city"=>$_POST['city'],"index"=>$_POST['cityindex'],"street"=>$_POST['street'],"house"=>$_POST['house'],"comment"=>$_POST['comment'],"delivery"=>$_POST['delivery'],"type_payment"=>$_POST['payment'],"payment"=>"false");
            $lastId = DB::insert(DB::insertSql("count_zakaz",$array),$array);
            $login = ConfigSites::sessionId();
            $carts = DB::selectParam("cart","login",$login,false,false);

            include "../classes/class.phpmailer.php";

            $mail_admin = new PHPMailer();
            $mail_admin->From = 'info@glzn.ru';      // от кого
            $mail_admin->FromName = "GLZN";   // от кого
            $mailsendlist = ConfigSites::$emailsArr;
            foreach ($mailsendlist as $maillist) {
                $mail_admin->AddAddress($maillist); // кому - адрес, Имя
            }
            $mail_admin->IsHTML(true);        // выставляем формат письма HTML
            $mail_admin->Subject = "GLZN | Новый заказ №".$lastId;  // тема письма

            $mess_admin = MailerSend::zakazsendAdmin($array,$lastId);
            $mail_admin->Body = $mess_admin;
            $mail_admin->Send();


            $mail_user = new PHPMailer();
            $mail_user->From = 'info@glzn.ru';       // от кого
            $mail_user->FromName = "GLZN";   // от кого
            $mail_user->AddAddress($_POST['email']); // кому - адрес, Имя
            $mail_user->IsHTML(true);        // выставляем формат письма HTML
            $mail_user->Subject = "GLZN | Оформлен заказ №".$lastId." на сайте GLZN.ru";  // тема письма
            $mess_user = MailerSend::zakazsendUser($array,$carts,$lastId);
            $mail_user->Body = $mess_user;
            $mail_user->Send();




            foreach ($carts as $cart) {
                $arrZakaz = array('nzakaz'=>$lastId,'price_id'=>$cart['price_id'],"size"=>$cart['size'],"color"=>$cart['color'],"kol"=>$cart['kol']);
                DB::insert(DB::insertSql("zakaz",$arrZakaz),$arrZakaz);
            }
            DB::deleteCartLogin($login);

            if ($_POST['payment']=="Картой on-line") {
                $summ = $_POST['sumzakaz']+$_POST['sumdost'];
                $result = array("type"=>"card","zakaz"=>$lastId,"summ"=>$summ);
            } else {
                $result = array("type"=>"thanks");
            }
            echo json_encode($result);
        break;
	}

class MailerSend {
    public static function zakazsendUser($arrayClients, $arrayZakaz, $nzakaz) {
        $now = ConfigSites::today();
        $message_user = 'Здравствуйте, '.$arrayClients['name'].'!<br><br>
            Ваш заказ № '.$nzakaz.' от '.$now.' принят.<br><br>
            <table>
                <tr>
                    <td>Артикул</td>
                    <td>Наименование</td>
                    <td>Размер</td>
                    <td>Цвет</td>
                    <td>Количество</td>
                    <td>Цена</td>
                </tr>';
        foreach ($arrayZakaz as $zakaz) {
            $price = DB::selectID("price",$zakaz['price_id']);
            $color = DB::selectID("colors",$zakaz['color']);
            $message_user .= '<tr>
                <td>'.$price[0]["nomer"].'</td>
                <td>'.$price[0]["name"].'</td>
                <td>'.$zakaz["size"].'</td>
                <td>'.$color[0]["value"].'</td>
                <td>'.$zakaz["kol"].'</td>
                <td>'.$price[0]["price"].'</td>

            ';
        }
        $message_user .= '</table>
            Сумма заказа: '.$arrayClients["sun"].' руб.<br><br>
            У вас есть вопросы? Позвоните нам по телефону +7 (495) 240-53-14 или воспользуйтесь формой обратной связи.<br><br><br>
            Спасибо за покупку!<br><br>
            С уважением, GLZN<br>
            http://glzn.ru/<br><br>';

        return $message_user;

        $message_admin = 'Новый заказ №'.$nzakaz.' на сумму '.$arrayClients["sun"].' руб<br>';
        $message_admin .= 'Имя: '.$arrayClients['name'].'<br>';
        $message_admin .= 'Телефон: '.$arrayClients['phone'].'<br>';
        $message_admin .= 'Email: '.$arrayClients['email'].'<br>';
    }

    public static function zakazsendAdmin($arrayClients, $nzakaz) {
        $message_admin = 'Новый заказ №'.$nzakaz.' на сумму '.$arrayClients["sun"].' руб<br>';
        $message_admin .= 'Имя: '.$arrayClients['name'].'<br>';
        $message_admin .= 'Телефон: '.$arrayClients['phone'].'<br>';
        $message_admin .= 'Email: '.$arrayClients['email'].'<br>';
        return $message_admin;
    }
}
?>
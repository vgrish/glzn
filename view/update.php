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

            $headers  = "Content-type: text/html; charset=utf-8 \r\n";
            $headers .= "From: GLZN <info@glzn.ru>\r\n";
            $td1_style = "border: 1px solid #000; max-width: 140px; padding: 5px 10px; font-weight: bold; background-color: #e8e8e8;";
            $td2_style = "border: 1px solid #000; max-width: 460px; min-width: 300px; padding: 5px 10px;";

            $now = ConfigSites::today();
            $maillist = explode("|", ConfigSites::$emailsArr);
            $array = array("date"=>$now,"sun"=>$_POST['sumzakaz'],"sun_dost"=>$_POST['sumdost'],"name"=>$_POST['name'],"phone"=>$_POST['phone'],"email"=>$_POST['email'],"region"=>$_POST['address_state'],"city"=>$_POST['city'],"index"=>$_POST['cityindex'],"street"=>$_POST['street'],"house"=>$_POST['house'],"comment"=>$_POST['comment'],"delivery"=>$_POST['delivery'],"type_payment"=>$_POST['payment'],"payment"=>"false");
            $lastId = DB::insert(DB::insertSql("count_zakaz",$array),$array);

            $msg_admin = "
                        <html>
                            <body>
                                <table style=\"border-collapse: collapse;\">
                                    <tr>
                                        <td style=\"$td1_style\">Имя</td>
                                        <td style=\"$td2_style\">".$_POST['name']."</td>
                                    </tr>
                                    <tr>
                                        <td style=\"$td1_style\">Номер телефона</td>
                                        <td style=\"$td2_style\">".$_POST['phone']."</td>
                                    </tr>
                                    <tr>
                                        <td style=\"$td1_style\">Email</td>
                                        <td style=\"$td2_style\">".$_POST['email']."</td>
                                    </tr>
                                    <tr>
                                        <td style=\"$td1_style\">Номер заказа</td>
                                        <td style=\"$td2_style\">".$lastId."</td>
                                    </tr>
                                </table>
                            </body>
                        </html>";
            $subject_admin = "Новый заказ с сайта GLZN №".$lastId;
            foreach ($maillist as $mail) {
                mail($mail, $subject_admin, $msg_admin, $headers);
            }

            $msg_user = "
                        <html>
                            <body>
                                Здравствуйте, ".$_POST['name']."!<br><br>
                                Ваш заказ № ".$lastId." от ".$now." принят.<br><br>
                                Сумма заказа: ".$_POST['sumzakaz']." руб.<br><br>
                                У вас есть вопросы? Позвоните нам по телефону +7 (495) 133-0299 или воспользуйтесь формой обратной связи.<br><br><br>
                                Спасибо за покупку!<br><br><br><br>
                                С уважением, GLZN<br>
                                http://glzn.ru/<br><br>
                            </body>
                        </html>";
            $subject_user = "GLZN | Оформлен заказ №".$lastId." на сайте GLZN.ru";
            mail($_POST['email'], $subject_user, $msg_user, $headers);

            $login = ConfigSites::sessionId();
            $carts = DB::selectParam("cart","login",$login,false,false);




            foreach ($carts as $cart) {
                $arrZakaz = array('nzakaz'=>$lastId,'price_id'=>$cart['price_id'],"size"=>$cart['size'],"color"=>$cart['color'],"kol"=>$cart['kol']);
                DB::insert(DB::insertSql("zakaz",$arrZakaz),$arrZakaz);
            }
            DB::deleteCartLogin($login);

            if ($_POST['payment']=="Картой on-line") {
                $summ = $_POST['sumzakaz']+$_POST['sumdost'];
                $shopId = ConfigSites::$shopId;
                $scid = ConfigSites::$scid;
                $result = array("type"=>"card","zakaz"=>$lastId,"summ"=>$summ,"email"=>$_POST['email'],"phone"=>$_POST['phone'],"shopId"=>$shopId,"scid"=>$scid);
            } else {
                $result = array("type"=>"thanks");
            }
            echo json_encode($result);
        break;
	}
?>
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
?>
<?
include "models/function.php";
$param1 = "pages_contact";
$param2 = "pages_dostavka";
if (isset($_POST["contact"])) {
    $array1 = array("phone"=>$_POST['phone'],"adres"=>$_POST['adres'],"email"=>$_POST['email'],"fb"=>$_POST['fb'],"in"=>$_POST['in'],"tw"=>$_POST['tw'],"vk"=>$_POST['vk']);
    DB::update(DB::updateSql($param1,$array1),$array1,1);
    header("Location: pages_settings.php");
}

if (isset($_POST["dostavka"])) {
    $array2 = array("title"=>$_POST['title'],"ptitle"=>$_POST['ptitle'],"text"=>$_POST['text']);
    DB::update(DB::updateSql($param2,$array2),$array2,1);
    header("Location: pages_settings.php");
}

$records1 = DB::select($param1);
$records2 = DB::select($param2);
require_once 'view/tpl_top.php';
?>

<div class="app app-header-fixed  ">
    <?
    include "view/header.php";
    $active_c = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col">
                    <div class="bg-light lter b-b wrapper-md wrapper-md__i">
                        <h1 class="m-n font-thin h3 inline"><?=($records1)?"Настройки":"Не найдено"?></h1>
                    </div>
					<div class="wrapper-md">
						<div class="row">
							<div class="col-lg-6 item">
								<div class="panel panel-info">
									<form method="post" enctype="multipart/form-data">
										<div class="panel-body">
											<div class="clear">
												<label>Контакты</label>
												<input type="text" class="form-control m-b" placeholder="Телефон" name="phone" value="<?=$records1[0]['phone']?>">
												<input type="text" class="form-control m-b" placeholder="Адрес" name="adres" value="<?=$records1[0]['adres']?>">
												<input type="text" class="form-control m-b" placeholder="E-mail" name="email" value="<?=$records1[0]['email']?>">
												<input type="text" class="form-control m-b" placeholder="Facebook" name="fb" value="<?=$records1[0]['fb']?>">
												<input type="text" class="form-control m-b" placeholder="Instagram" name="in" value="<?=$records1[0]['in']?>">
												<input type="text" class="form-control m-b" placeholder="Twitter" name="tw" value="<?=$records1[0]['tw']?>">
												<input type="text" class="form-control m-b" placeholder="VK" name="vk" value="<?=$records1[0]['vk']?>">
											</div>
											<input type="hidden" name="contact" value="1">
											<button class="btn m-b-xs btn-success">Сохранить</button>
										</div>
									</form>
								</div>
							</div>
							<div class="col-lg-6 item">
								<div class="panel panel-info">
									<form method="post" enctype="multipart/form-data">
										<div class="panel-body">
											<div class="clear">
												<label>Доставка</label>
												<input type="text" class="form-control m-b" placeholder="осуществляется по всей России." name="title" value="<?=$records2[0]['title']?>">
												<input type="text" class="form-control m-b" placeholder="Возможные варианты доставки:" name="ptitle" value="<?=$records2[0]['ptitle']?>">
												<textarea class="form-control m-b" placeholder="" rows="8" name="text"><?=$records2[0]['text']?></textarea>
											</div>
											<input type="hidden" name="dostavka" value="1">
											<button class="btn m-b-xs btn-success">Сохранить</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? require_once 'view/tpl_bottom.php'; ?>
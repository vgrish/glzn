<? include "models/function.php";
$param = "settings";
if (isset($_POST["go"])) {
    $id = array_pop($_POST);
    DB::update(DB::updateSql($param,$_POST),$_POST,$id);
    header("Location: ".$_SERVER['REQUEST_URI']);
}
$record = DB::select($param);
require_once 'view/tpl_top.php';
?>
<div class="app app-header-fixed  ">
	<? include "view/header.php";
	$active_g = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col">
					<div class="bg-light lter b-b wrapper-md wrapper-md__i">
						<h1 class="m-n font-thin h3 inline">Настройки сайта</h1>
					</div>
					<div class="wrapper-md">
						<form method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-lg-12">
									<div class="panel panel-default">
										<div class="panel-heading font-bold">Основные настройки</div>
										<div class="panel-body">
											<div class="form-group">
                                                <div class="col-lg-12">
													<label>Название компании</label>
													<input type="text" class="form-control m-b required-js" name="company" value="<?=(isset($record[0]["company"]))?$record[0]["company"]:""?>">
                                                    <label>Сайт</label>
                                                    <input type="text" class="form-control m-b required-js" name="site" value="<?=(isset($record[0]["site"]))?$record[0]["site"]:""?>">
                                                    <label>Телефон</label>
                                                    <input type="text" class="form-control m-b required-js" name="phone" value="<?=(isset($record[0]["phone"]))?$record[0]["phone"]:""?>">
                                                    <label>Адрес</label>
                                                    <input type="text" class="form-control m-b required-js" name="address" value="<?=(isset($record[0]["address"]))?$record[0]["address"]:""?>">
                                                    <label>Текущий курс EUR</label>
                                                    <input type="text" class="form-control m-b required-js" name="eur" value="<?=(isset($record[0]["eur"]))?$record[0]["eur"]:""?>">
                                                    <label>Коэффициент накрутки (1.30 = +30%)</label>
                                                    <input type="text" class="form-control m-b required-js" name="percent" value="<?=(isset($record[0]["percent"]))?$record[0]["percent"]:""?>">
                                                    <label>Email(Основной)</label>
                                                    <input type="text" class="form-control m-b required-js" name="email_osnovnoy" value="<?=(isset($record[0]["email_osnovnoy"]))?$record[0]["email_osnovnoy"]:""?>">
                                                    <label>Email(Для заявок)</label>
                                                    <input type="text" class="form-control m-b required-js" name="email_rasslka" value="<?=(isset($record[0]["email_rasslka"]))?$record[0]["email_rasslka"]:""?>">
                                                    <label>ВКонтакте</label>
                                                    <input type="text" class="form-control m-b" name="soc_vk" value="<?=(isset($record[0]["soc_vk"]))?$record[0]["soc_vk"]:""?>">
                                                    <label>Facebook</label>
                                                    <input type="text" class="form-control m-b" name="soc_fb" value="<?=(isset($record[0]["soc_fb"]))?$record[0]["soc_fb"]:""?>">
                                                    <label>Twitter</label>
                                                    <input type="text" class="form-control m-b" name="soc_tw" value="<?=(isset($record[0]["soc_tw"]))?$record[0]["soc_tw"]:""?>">
                                                    <label>Instagram</label>
                                                    <input type="text" class="form-control m-b" name="soc_im" value="<?=(isset($record[0]["soc_im"]))?$record[0]["soc_im"]:""?>">
													<label>Карта (scripts)</label>
													<textarea name="maps" class="form-control m-b" id="" cols="30" rows="10"><?=(isset($record[0]["maps"]))?$record[0]["maps"]:""?></textarea>
                                                </div>
                                            </div>
										</div>
	  								</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<input type="hidden" name="go" value="1">
									<div class="btn btn-success button listsave">Сохранить</div>
		                        </div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? require_once 'view/tpl_bottom.php'; ?>
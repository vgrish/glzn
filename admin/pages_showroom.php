<?
include "models/function.php";
$param = "pages_show";
if (isset($_POST["go"])) {
    $array1 = array("name"=>$_POST['name'], "text"=>$_POST['text']);

    if ($_FILES['photo']['error'][0] != 4) {
        $dir = '../img/show/';
        foreach ($_FILES['photo']['name'] as $k=>$v ) {
            $ext = strtolower(pathinfo($_FILES['photo']['name'][$k], PATHINFO_EXTENSION));
            $img = $dir.uniqid().".".$ext;
            move_uploaded_file($_FILES['photo']['tmp_name'][$k], $img);
            $img = str_replace('../', '', $img);
            $arr_img[] = $img;
        }
        $string_img = serialize($arr_img);
        $array1 += array('img'=>$string_img);
    }

    DB::update(DB::updateSql($param,$array1),$array1,1);
    header("Location: pages_showroom.php");
}

$records = DB::select($param);
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
                        <h1 class="m-n font-thin h3 inline"><?=($records)?"Шоурум":"Не найдено"?></h1>
                    </div>
                    <? if ($records) : ?>
					<div class="wrapper-md">
						<div class="row">
							<div class="col-lg-12 item">
								<div class="panel panel-info">
									<form method="post" enctype="multipart/form-data">
										<div class="panel-body">
											<?
												$array_img = unserialize($records[0]['img']);
												foreach ($array_img as $k=>$v) {
													?>
														<img src="../<?=$array_img[$k]?>" width="200" alt="..." class="pullright">
													<?
												}
											?>
											<br>
											<label>Выбрать другие фотографии:</label>
                                            <input ui-jq="filestyle" name="photo[]" type="file" data-icon="false" multiple data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="photo"  accept="image/fits" tabindex="-1" style="position: absolute;  clip: rect(0px 0px 0px 0px);">
											<div class="clear">
												<label>Введите заголовок</label>
												<input type="text" class="form-control m-b" placeholder="" name="name" value="<?=$records[0]['name']?>">
												<label>Введите текст</label>
												<input type="text" class="form-control m-b" placeholder="" name="text" value="<?=$records[0]['text']?>">
											</div>
											<input type="hidden" name="go" value="1">
											<button class="btn m-b-xs btn-success">Сохранить</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					<? endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? require_once 'view/tpl_bottom.php'; ?>
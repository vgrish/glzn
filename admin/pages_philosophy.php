<? include "models/function.php";
$param = "pages_philosophy";
if (isset($_POST["go"])) {
    $array = array("title"=>$_POST['title'],"fio"=>$_POST['fio'],"prof"=>$_POST['prof'],"text"=>$_POST['text']);
    if ($_FILES["img"]["error"] == UPLOAD_ERR_OK) {
        $dir = '../img/philosophy/';
        $ext1 = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));
        $img = $dir.uniqid().".".$ext1;
        move_uploaded_file($_FILES['img']['tmp_name'], $img);
        $img = str_replace('../', '', $img);
        $array += array('img'=>$img);
    }

    $id = array_pop($_POST);
    DB::update(DB::updateSql($param,$array),$array,$id);
    header("Location: ".$param.".php");
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
                        <h1 class="m-n font-thin h3 inline"><?=($records)?"Основатель бренда":"Не найдено"?></h1>
                    </div>
                    <? if ($records) : ?>
					<div class="wrapper-md">
						<div class="row">
							<div class="col-lg-12 item">
								<div class="panel panel-info">
									<form method="post" enctype="multipart/form-data">
										<div class="panel-body">
											<img src="../<?=$records[0]['img']?>" width="200" alt="..." class="pullright">
											<br>
											<label>Выбрать другую картинку:</label>
                                            <input ui-jq="filestyle" name="img" type="file" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="files"  accept="image/fits" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);">
											<div class="clear">
												<label>Введите заголовок</label>
												<input type="text" class="form-control m-b" name="title" value="<?=$records[0]['title']?>">
												<label>Введите текст</label>
												<textarea class="form-control m-b" rows="8" name="text"><?=$records[0]['text']?></textarea>
												<label>Введите Ф.И.О.</label>
												<input type="text" class="form-control m-b" name="fio" value="<?=$records[0]['fio']?>">
												<label>Введите профессию</label>
												<input type="text" class="form-control m-b" name="prof" value="<?=$records[0]['prof']?>">
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
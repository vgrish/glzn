<?
include "models/function.php";
$param = "pages_sewing";

if (isset($_POST["go"])) {
    $array1 = array("title"=>$_POST['title'],"name"=>$_POST['name'],"text"=>$_POST['text']);
    DB::update(DB::updateSql($param,$array1),$array1,1);
    header("Location: pages_settings.php");
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
                        <h1 class="m-n font-thin h3 inline"><?=($records)?"Индивидуальный пошив":"Не найдено"?></h1>
                    </div>
                    <? if ($records) : ?>
					<div class="wrapper-md">
						<div class="row">
							<div class="col-lg-12 item">
								<div class="panel panel-info">
									<form method="post" enctype="multipart/form-data">
										<div class="panel-body">
											<div class="clear">
												<label>Введите заголовок</label>
												<input type="text" class="form-control m-b" placeholder="" name="title" value="<?=$records[0]['title']?>">
												<label>Введите подзаголовок</label>
												<input type="text" class="form-control m-b" placeholder="" name="name" value="<?=$records[0]['name']?>">
												<label>Введите текст</label>
												<textarea class="form-control m-b" placeholder="" rows="8" name="text" style="height: 145px"><?=$records[0]['text']?></textarea>
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
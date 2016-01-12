<? include "models/function.php";
$param = "opt";
if (isset($_POST["go"])) {
	if ($_POST["go"] == "save") {
        array_pop($_POST);
        DB::insert(DB::insertSql($param,$_POST),$_POST);
        header("Location: ".$param.".php");
	} else {
        $id = array_pop($_POST);
        DB::update(DB::updateSql($param,$_POST),$_POST,$id);
		header("Location: ".$param.".php");
	}
}
if (isset($_GET["delete"])) {
    Delete::del($_GET["title"],$_GET["delete"]);
    header("Location: ".$param.".php");
}
$records = DB::select($param);
require_once 'view/tpl_top.php';
?>
<div class="app app-header-fixed">
    <?
    include "view/tpl_popup_opt.php";
    include "view/header.php";
	$active_b = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col">
					<div class="bg-light lter b-b wrapper-md wrapper-md__i">
						<h1 class="m-n font-thin h3 inline"><?=($records==false)?"Не найдено":"Наценка на базовую стоимость"?></h1>
					</div>
					<div class="wrapper-md">
						<? if ($records != false) :?>
							<div class="row">
								<div class="col-lg-12">
									<div class="panel panel-default product">
										<div class="table-responsive">
											<table class="table table-striped b-t b-light">
												<tr>
													<td>Название</td>
													<td>Курс</td>
													<td style="width:90px;">Изм.</td>
												</tr>
												<?
												foreach ($records as $record) {
													?>
													<tr>
														<td><?=$record["name"]?></td>
														<td><?=$record["sun"]?></td>
														<td>
															<button class="btn btn-xs btn-info edit"
																	data-id="<?=$record["id"]?>"
																	data-title="<?=$param?>" data-toggle="modal"
																	data-target=".<?=$param?>"><i class="icon-pencil"></i></button>
															<a href="?delete=<?=$record["id"]?>&title=<?=$param?>" class="btn
															btn-xs
															btn-danger" onclick="return confirm('Удалить?');"><i
																	class="icon-close"></i></a>
														</td>
													</tr>
													<?
												}
												?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						<? endif; ?>
						<button class="btn m-b-xs btn-success" data-toggle="modal" data-target=".<?=$param?>">Добавить</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? require_once 'view/tpl_bottom.php'; ?>
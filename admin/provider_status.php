<? include "models/function.php";
$param = "provider_status";
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
    include "view/tpl_popup_status.php";
    include "view/header.php";
	$active_h = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col">
					<div class="bg-light lter b-b wrapper-md wrapper-md__i">
						<h1 class="m-n font-thin h3 inline"><?=($records==false)?"Не найдено":"Статусы заказов"?></h1>
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
													<td>Цвет</td>
													<td style="width:90px;">Изм.</td>
												</tr>
												<?
												foreach ($records as $record) {
													?>
													<tr>
														<td><?=$record["name"]?></td>
														<td><? if (isset($record["color"]) and $record["color"]) :?><button class="btn btn-xs w-xs btn-<?=$record["color"]?>"><?=$record["name"]?></button><? endif; ?></td>
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
						<br><br><br><br>
						* для справки<br>
						<button class="btn m-b-xs w-xs btn-success">success</button><br>
						<button class="btn m-b-xs w-xs btn-primary">primary</button><br>
						<button class="btn m-b-xs w-xs btn-info">info</button><br>
						<button class="btn m-b-xs w-xs btn-danger">danger</button><br>
						<button class="btn m-b-xs w-xs btn-warning">warning</button><br>
						<button class="btn m-b-xs w-xs btn-dark">dark</button><br>
						<button class="btn m-b-xs w-xs btn-default">default</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? require_once 'view/tpl_bottom.php'; ?>
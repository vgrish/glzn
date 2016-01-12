<? include "models/function.php";
$param = "provider";
if (isset($_POST["go"])) {
	if ($_POST["go"] == "save") {
        array_pop($_POST);
        DB::insert(DB::insertSql($param,$_POST),$_POST);
        header("Location: pricelist.php");
	} else {
        $id = array_pop($_POST);
        DB::update(DB::updateSql($param,$_POST),$_POST,$id);
		header("Location: pricelist.php");
	}
}

if (isset($_POST["update"])) {
	IncludeClass::inc(array('Price'));
	Price::importPrice($_FILES,$_POST["update"]);
	header("Location: pricelist.php");
}

if (isset($_GET["delete"])) {
    Delete::del($_GET["title"],$_GET["delete"]);
    header("Location: pricelist.php");
}
$records = DB::select($param);
require_once 'view/tpl_top.php';
?>
<div class="app app-header-fixed">
    <?
    include "view/tpl_popup_provider.php";
    include "view/header.php";
	$active_h = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col">
					<div class="bg-light lter b-b wrapper-md wrapper-md__i">
						<h1 class="m-n font-thin h3 inline"><?=($records==false)?"Не найдено":"Прайс-листы"?></h1>
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
													<td>Назв. для клиента</td>
													<td>Доставка</td>
													<td>Наценка</td>
													<td>Валюта</td>
													<td style="width:194px;">Действия</td>
												</tr>
												<?
												foreach ($records as $record) {
													$kurs = DB::selectID('kurs',$record["kurs"]);
													?>
													<tr>
														<td><?=$record["name"]?></td>
														<td><?=$record["name_klient"]?></td>
														<td><?=$record["delivery"]?></td>
														<td><?=$record["margin"]?></td>
														<td><?=$kurs[0]['name']?></td>
														<td>
															<button class="btn btn-xs btn-info edit"
																	data-id="<?=$record["id"]?>"
																	data-title="<?=$param?>" data-toggle="modal"
																	data-target=".<?=$param?>"><i class="icon-pencil"></i></button>
															<a href="?delete=<?=$record["id"]?>&title=<?=$param?>" class="btn
															btn-xs
															btn-danger" onclick="return confirm('Удалить?');"><i
																	class="icon-close"></i></a>
															<button class="btn btn-xs btn-success updatePrice"
																	data-id="<?=$record["id"]?>"
																	data-title="<?=$param?>" data-toggle="modal"
																	data-target=".update"><i class="glyphicon glyphicon-download-alt"></i> Обновление</button>
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
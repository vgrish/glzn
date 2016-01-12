<? include "models/function.php";
$param = "clients";
if (isset($_POST["go"])) {
	$id = array_pop($_POST);
	DB::update(DB::updateSql($param,$_POST),$_POST,$id);
	header("Location: ".$param.".php");
}
if (isset($_GET["delete"])) {
	Delete::del($_GET["title"],$_GET["delete"]);
	header("Location: ".$_SERVER['REQUEST_URI']);
}
$records = DB::select($param);
require_once 'view/tpl_top.php';
?>
<div class="app app-header-fixed  ">
	<?
	include "view/tpl_popup_clients.php";
	include "view/header.php";
	$active_b = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col">
					<div class="bg-light lter b-b wrapper-md wrapper-md__i">
						<h1 class="m-n font-thin h3 inline"><?=($records==false)?"Не найдено":"Все клиенты"?></h1>
					</div>
					<div class="wrapper-md">
						<? if ($records != false) :?>
							<div class="row">
								<div class="col-lg-12">
									<div class="panel panel-default product">
										<div class="table-responsive">
											<table class="table table-striped b-t b-light">
												<tr>
													<td>№Клиента</td>
													<td>Имя</td>
													<td>Телефон</td>
													<td>Email</td>
													<td>Опт</td>
													<td style="width:90px;">Изм.</td>
												</tr>
												<?
												foreach ($records as $record) {
													$opt = DB::selectID('opt',$record["opt"]);
													?>
													<tr>
														<td><?=$record["login"]?></td>
														<td><?=$record["name"]?></td>
														<td><?=$record["phone"]?></td>
														<td><?=$record["email"]?></td>
														<td><?=$opt[0]['name']?></td>
														<td>
															<button class="btn btn-xs btn-info edit"
																	data-id="<?=$record["id"]?>"
																	data-title="<?=$param?>" data-toggle="modal"
																	data-target=".<?=$param?>"><i class="icon-pencil"></i></button>
															<a title="Удалить" href="?delete=<?=$record["id"]?>&title=<?=$param?>" class="btn btn-xs btn-danger" onclick="return confirm('Удалить?');"><i class="fa fa-times"></i></a>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? require_once 'view/tpl_bottom.php'; ?>
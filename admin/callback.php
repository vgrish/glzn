<? include "models/function.php";
$param = "callback";
$records = DB::select($param);
require_once 'view/tpl_top.php';
?>
<div class="app app-header-fixed  ">
	<? include "view/header.php";
	$active_f = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col">
					<div class="bg-light lter b-b wrapper-md wrapper-md__i">
						<h1 class="m-n font-thin h3 inline"><?=($records==false)?"Не найдено":"Заявки"?></h1>
					</div>
					<div class="wrapper-md">
						<? if ($records != false) :?>
							<div class="row">
								<div class="col-lg-12">
									<div class="panel panel-default product">
										<div class="table-responsive">
											<table class="table table-striped b-t b-light">
												<tr>
													<td>Имя</td>
													<td>Телефон</td>
													<td>Email</td>
													<td>Форма</td>
													<td>Дата</td>
												</tr>
												<?
												foreach ($records as $record) {
													?>
													<tr>
														<td><?=$record["name"]?></td>
														<td><?=$record["phone"]?></td>
														<td><?=$record["email"]?></td>
														<td><?=$record["formname"]?></td>
														<td><?=data_russian(date_exp($record["date"]))?> в <?=time_exp($record["date"])?></td>
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
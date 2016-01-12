<? include "models/function.php";
$param = "colors";
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
    include "view/tpl_popup_colors.php";
    include "view/header.php";
	$active_d = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col">
					<div class="bg-light lter b-b wrapper-md wrapper-md__i">
						<h1 class="m-n font-thin h3 inline"><?=($records==false)?"Не найдено":"Цвета товаров"?></h1>
					</div>
                    <div class="btn-group btn-group-justified">
                        <a class="btn btn-primary" data-toggle="modal" data-target=".<?=$param?>"><i class="fa fa-plus"></i> Добавить цвета товаров</a>
                    </div>
					<div class="wrapper-md">
						<? if ($records != false) :?>
							<div class="row">
								<div class="col-lg-12">
									<div class="panel panel-default product">
										<div class="table-responsive">
                                            <table class="table table-striped b-t b-light">
                                                <thead>
                                                <tr>
                                                    <th>Наименование</th>
                                                    <th style="width:20px;"></th>
                                                    <th>Код цвета</th>
                                                    <th style="width:20px;"></th>
                                                    <th style="width:20px;"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?
                                                foreach ($records as $record) {
                                                    ?>
                                                    <tr>
                                                        <form method="POST">
                                                            <td><div class="input-group m-b"><input name="value" class="form-control no-border" value="<?=$record["value"]?>"></div></td>
                                                            <td><div class="input-group m-b"><span class="input-group-addon" style="background-color:<?=$record["rgb"]?>;height:35px"></span></div></td>
                                                            <td><input name="rgb" class="form-control no-border" value="<?=$record["rgb"]?>"></td>
                                                            <td style="padding:14px 0"><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></td>
                                                            <input type="hidden" name="go" value="<?=$record["id"]?>">
                                                        </form>
                                                        <td style="padding:14px 0"><a title="Удалить" href="?delete=<?=$record["id"]?>&title=<?=$param?>" class="btn btn-xs btn-danger" onclick="return confirm('Удалить?');"><i class="fa fa-times"></i></a><br></td>
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
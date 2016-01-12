<? include "models/function.php";
$param = "settings_size";
if (isset($_POST["go"])) {
    $arrayName = array('s1','s2','s3','s4','s5');
    $arr1 = array_combine($arrayName, $_POST["jarsy1"]);
    DB::update(DB::updateSql($param,$arr1),$arr1,1);
    $arr2 = array_combine($arrayName, $_POST["jarsy2"]);
    DB::update(DB::updateSql($param,$arr2),$arr2,2);
    $arr3 = array_combine($arrayName, $_POST["jarsy3"]);
    DB::update(DB::updateSql($param,$arr3),$arr3,3);
    $arr4 = array_combine($arrayName, $_POST["all1"]);
    DB::update(DB::updateSql($param,$arr4),$arr4,4);
    $arr5 = array_combine($arrayName, $_POST["all2"]);
    DB::update(DB::updateSql($param,$arr5),$arr5,5);
    $arr6 = array_combine($arrayName, $_POST["all3"]);
    DB::update(DB::updateSql($param,$arr6),$arr6,6);
    header("Location: ".$param.".php");
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
					<div class="wrapper-md">
						<? if ($records != false) :?>
							<div class="row">
								<div class="col-lg-12">
                                    <form method="POST">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Для изделий из трикотажа (джерси)</div>
                                            <div class="table-responsive">
                                                <table class="table table-striped b-t b-light">
                                                    <thead>
                                                    <tr>
                                                        <th width="200px;"></th>
                                                        <th>XS</th>
                                                        <th>S</th>
                                                        <th>M</th>
                                                        <th>L</th>
                                                        <th>XL</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>Обхват груди</td>
                                                        <td><input name="jarsy1[]" class="form-control no-border" value="<?=$records[0]['s1']?>"></td>
                                                        <td><input name="jarsy1[]" class="form-control no-border" value="<?=$records[0]['s2']?>"></td>
                                                        <td><input name="jarsy1[]" class="form-control no-border" value="<?=$records[0]['s3']?>"></td>
                                                        <td><input name="jarsy1[]" class="form-control no-border" value="<?=$records[0]['s4']?>"></td>
                                                        <td><input name="jarsy1[]" class="form-control no-border" value="<?=$records[0]['s5']?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Обхват талии</td>
                                                        <td><input name="jarsy2[]" class="form-control no-border" value="<?=$records[1]['s1']?>"></td>
                                                        <td><input name="jarsy2[]" class="form-control no-border" value="<?=$records[1]['s2']?>"></td>
                                                        <td><input name="jarsy2[]" class="form-control no-border" value="<?=$records[1]['s3']?>"></td>
                                                        <td><input name="jarsy2[]" class="form-control no-border" value="<?=$records[1]['s4']?>"></td>
                                                        <td><input name="jarsy2[]" class="form-control no-border" value="<?=$records[1]['s5']?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Обхват бедер</td>
                                                        <td><input name="jarsy3[]" class="form-control no-border" value="<?=$records[2]['s1']?>"></td>
                                                        <td><input name="jarsy3[]" class="form-control no-border" value="<?=$records[2]['s2']?>"></td>
                                                        <td><input name="jarsy3[]" class="form-control no-border" value="<?=$records[2]['s3']?>"></td>
                                                        <td><input name="jarsy3[]" class="form-control no-border" value="<?=$records[2]['s4']?>"></td>
                                                        <td><input name="jarsy3[]" class="form-control no-border" value="<?=$records[2]['s5']?>"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Для остальных изделий</div>
                                            <div class="table-responsive">
                                                <table class="table table-striped b-t b-light">
                                                    <thead>
                                                    <tr>
                                                        <th width="200px;"></th>
                                                        <th>40</th>
                                                        <th>42</th>
                                                        <th>44</th>
                                                        <th>46</th>
                                                        <th>48</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>Обхват груди</td>
                                                        <td><input name="all1[]" class="form-control no-border" value="<?=$records[3]['s1']?>"></td>
                                                        <td><input name="all1[]" class="form-control no-border" value="<?=$records[3]['s2']?>"></td>
                                                        <td><input name="all1[]" class="form-control no-border" value="<?=$records[3]['s3']?>"></td>
                                                        <td><input name="all1[]" class="form-control no-border" value="<?=$records[3]['s4']?>"></td>
                                                        <td><input name="all1[]" class="form-control no-border" value="<?=$records[3]['s5']?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Обхват талии</td>
                                                        <td><input name="all2[]" class="form-control no-border" value="<?=$records[4]['s1']?>"></td>
                                                        <td><input name="all2[]" class="form-control no-border" value="<?=$records[4]['s2']?>"></td>
                                                        <td><input name="all2[]" class="form-control no-border" value="<?=$records[4]['s3']?>"></td>
                                                        <td><input name="all2[]" class="form-control no-border" value="<?=$records[4]['s4']?>"></td>
                                                        <td><input name="all2[]" class="form-control no-border" value="<?=$records[4]['s5']?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Обхват бедер</td>
                                                        <td><input name="all3[]" class="form-control no-border" value="<?=$records[5]['s1']?>"></td>
                                                        <td><input name="all3[]" class="form-control no-border" value="<?=$records[5]['s2']?>"></td>
                                                        <td><input name="all3[]" class="form-control no-border" value="<?=$records[5]['s3']?>"></td>
                                                        <td><input name="all3[]" class="form-control no-border" value="<?=$records[5]['s4']?>"></td>
                                                        <td><input name="all3[]" class="form-control no-border" value="<?=$records[5]['s5']?>"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <input type="hidden" name="go" value="save">
                                        <button type="submit" class="btn btn-success">Сохранить все</button>
                                    </form>
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
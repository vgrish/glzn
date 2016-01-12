<? include "models/function.php";
$param = "pages_press";
if (isset($_POST["go"])) {
    $array = array("text"=>$_POST['text']);
    if ($_FILES["img1"]["error"] == UPLOAD_ERR_OK) {
        $dir1 = '../img/press/';
        $ext1 = strtolower(pathinfo($_FILES['img1']['name'], PATHINFO_EXTENSION));
        $img1 = $dir1.uniqid().".".$ext1;
        move_uploaded_file($_FILES['img1']['tmp_name'], $img1);
        $img1 = str_replace('../', '', $img1);
        $array += array('img1'=>$img1);
    }

    if ($_FILES["img2"]["error"] == UPLOAD_ERR_OK) {
        $dir2 = '../img/press/';
        $ext2 = strtolower(pathinfo($_FILES['img2']['name'], PATHINFO_EXTENSION));
        $img2 = $dir2.uniqid().".".$ext2;
        move_uploaded_file($_FILES['img2']['tmp_name'], $img2);
        $img2 = str_replace('../', '', $img2);
        $array += array('img2'=>$img2);
    }

    if ($_POST["go"] == "save") {
        array_pop($_POST);
        DB::insert(DB::insertSql($param,$array),$array);
        header("Location: ".$param.".php");
    } else {
        $id = array_pop($_POST);
        DB::update(DB::updateSql($param,$array),$array,$id);
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
<div class="app app-header-fixed  ">
    <?
    include "view/tpl_popup_pages_press.php";
    include "view/header.php";
    $active_c = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col">
                    <div class="bg-light lter b-b wrapper-md wrapper-md__i">
                        <h1 class="m-n font-thin h3 inline"><?=($records)?"Пресса":"Не найдено"?></h1>
                    </div>
                    <div class="btn-group btn-group-justified">
                        <a class="btn btn-primary" data-toggle="modal" data-target=".<?=$param?>"><i class="fa fa-plus"></i> Добавить статью</a>
                    </div>
                    <? if ($records) : ?>
					<div class="wrapper-md">
						<div class="row">
							<?
							$i = 0;
							foreach ($records as $record) {
								?>
								<div class="col-sm-4 item">
									<div class="panel panel-default">
										<div class="panel-heading">
											<div class="clearfix">
												<div class="clear">
													<div class="h3 m-t-xs m-b-xs">
                                                        <? if (isset($record['img1']) and $record['img1']):?><img width="174" class="logo" src="../<?=$record['img1']?>" data-img="<?=$record['img1']?>" alt=""><? endif; ?>
                                                        <a title="Удалить" href="?delete=<?=$record["id"]?>&title=<?=$param?>" class="btn btn-xs btn-danger pull-right" onclick="return confirm('Удалить?');"><i class="fa fa-times"></i></a>
                                                        <button class="btn btn-xs btn-info edit pull-right"
                                                                data-id="<?=$record["id"]?>"
                                                                data-title="<?=$param?>" data-toggle="modal"
                                                                data-target=".<?=$param?>"><i class="icon-pencil"></i></button>
                                                    </div>
												</div>
											</div>
										</div>
										<ul class="list-group no-radius">
											<? if (isset($record['img2']) and $record['img2']):?>
											<li class="list-group-item img">
												<img class="photo" src="../<?=$record['img2']?>" data-img="<?=$record['img2']?>" alt="" width="100%">
											</li>
											<? endif; ?>
											<li class="list-group-item text"><?=$record['text']?></li>
										</ul>
									</div>
								</div>
							<?
								$i++;
								if ($i==3) {
									?></div><div class="row"><?
									$i=0;
								}
							} ?>
						</div>
					<? endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? require_once 'view/tpl_bottom.php'; ?>
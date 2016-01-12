<? include "models/function.php";
$param = "pages_client";

if (isset($_POST["go"])) {
    $array = array("name"=>$_POST['name'],"text"=>$_POST['text'],"year"=>$_POST['year']);
    if ($_FILES["img"]["error"] == UPLOAD_ERR_OK) {
        $dir = '../img/clients/';
        $ext1 = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));
        $img = $dir . uniqid() . "." . $ext1;
        move_uploaded_file($_FILES['img']['tmp_name'], $img);
        $img = str_replace('../', '', $img);
        $array += array('img'=>$img);
    }

    if ($_POST["go"] == "save") {
        array_pop($_POST);
        DB::insert(DB::insertSql($param,$array),$array);
        header("Location: ".$param."s.php");
    } else {
        $id = array_pop($_POST);
        DB::update(DB::updateSql($param,$array),$array,$id);
        header("Location: ".$param."s.php");
    }
}

if (isset($_GET["delete"])) {
    Delete::del($_GET["title"],$_GET["delete"]);
    header("Location: ".$param."s.php");
}

$records = DB::select($param);
require_once 'view/tpl_top.php';
?>
<div class="app app-header-fixed  ">
    <?
    include "view/tpl_popup_pages_clients.php";
    include "view/header.php";
    $active_c = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col">
					<div class="bg-light lter b-b wrapper-md wrapper-md__i">
						<h1 class="m-n font-thin h3 inline"><?=($records)?"Наши клиенты":"Клиенты еще не добавлены"?></h1>
					</div>
                    <div class="btn-group btn-group-justified">
                        <a class="btn btn-primary" data-toggle="modal" data-target=".<?=$param?>"><i class="fa fa-plus"></i> Добавить клиента</a>
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
													<div class="h3 m-t-xs m-b-xs"><?=$record['name']?>
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
											<li class="list-group-item img">
												<img src="../<?=$record['img']?>" data-img="<?=$record['img']?>" alt="" width="100%">
											</li>
											<li class="list-group-item year"><?=$record['year']?></li>
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
							}
                            ?>
						</div>
					<? endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? require_once 'view/tpl_bottom.php'; ?>
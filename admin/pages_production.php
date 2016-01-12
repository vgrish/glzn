<?
include "models/function.php";
$param = "pages_production";
if (isset($_POST["go"])) {
    $array1 = array("text"=>$_POST['text1']);
    if (filesUpload($_FILES['photo11'])!=false) { $array1 += array('img1'=>$img1); }
    if (filesUpload($_FILES['photo12'])!=false) { $array1 += array('img2'=>$img2); }
    $array2 = array("text"=>$_POST['text2']);
    if (filesUpload($_FILES['photo21'])!=false) { $array2 += array('img1'=>$img1); }
    if (filesUpload($_FILES['photo22'])!=false) { $array2 += array('img2'=>$img2); }
    $array3 = array("text"=>$_POST['text3']);
    if (filesUpload($_FILES['photo31'])!=false) { $array3 += array('img1'=>$img1); }
    if (filesUpload($_FILES['photo32'])!=false) { $array3 += array('img2'=>$img2); }
    $array4 = array("text"=>$_POST['text4']);
    if (filesUpload($_FILES['photo41'])!=false) { $array4 += array('img1'=>$img1); }
    if (filesUpload($_FILES['photo42'])!=false) { $array4 += array('img2'=>$img2); }

    DB::update(DB::updateSql($param,$array1),$array1,1);
    DB::update(DB::updateSql($param,$array2),$array2,2);
    DB::update(DB::updateSql($param,$array3),$array3,3);
    DB::update(DB::updateSql($param,$array4),$array4,4);
    header("Location: ".$param.".php");
}

if (isset($_GET["delete"])) {
    Delete::del($_GET["title"],$_GET["delete"]);
    header("Location: ".$param.".php");
}

function filesUpload($file) {
    if ($file["error"] == UPLOAD_ERR_OK) {
        $dir = '../img/manufacturing/';
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $img = $dir.uniqid().".".$ext;
        move_uploaded_file($file['tmp_name'], $img);
        $img = str_replace('../', '', $img);
        return $img;
    } else {
        return false;
    }
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
                        <h1 class="m-n font-thin h3 inline"><?=($records)?"Продукция":"Не найдено"?></h1>
                    </div>
                    <? if ($records) : ?>
					<div class="wrapper-md">
						<div class="row">
							<div class="col-lg-12">
								<form method="post" enctype="multipart/form-data">
									<div class="panel panel-default">
										<div class="table-responsive">
											<table class="table table-striped m-b-none">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center pos-rlt" style="background-color: #3a3f51 !important; width:171px;">
                                                            <img src="../<?=$records[0]['img1']?>" alt="">
                                                            <input ui-jq="filestyle" name="photo11" type="file" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="photo11"  accept="image/fits" tabindex="-1" style="position: absolute;  clip: rect(0px 0px 0px 0px);">
                                                        </td>
                                                        <td class="text-center" style="width:171px;">
                                                            <img src="../<?=$records[0]['img2']?>" width="50" alt="">
                                                            <input ui-jq="filestyle" name="photo12" type="file" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="photo12"  accept="image/fits" tabindex="-1" style="position: absolute;  clip: rect(0px 0px 0px 0px);">
                                                        </td>
                                                        <td><textarea class="form-control m-b" style="height: 85px;" name="text1"><?=$records[0]['text']?></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="background-color: #3a3f51 !important;">
                                                            <img src="../<?=$records[1]['img1']?>" alt="">
                                                            <input ui-jq="filestyle" name="photo21" type="file" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="photo21"  accept="image/fits" tabindex="-1" style="position: absolute;  clip: rect(0px 0px 0px 0px);">
                                                        </td>
                                                        <td class="text-center">
                                                            <img src="../<?=$records[1]['img2']?>" width="50" alt="">
                                                            <input ui-jq="filestyle" name="photo22" type="file" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="photo22"  accept="image/fits" tabindex="-1" style="position: absolute;  clip: rect(0px 0px 0px 0px);">
                                                        </td>
                                                        <td><textarea class="form-control m-b" style="height: 85px;" name="text2"><?=$records[1]['text']?></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="background-color: #3a3f51 !important;">
                                                            <img src="../<?=$records[2]['img1']?>" alt="">
                                                            <input ui-jq="filestyle" name="photo31" type="file" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="photo31"  accept="image/fits" tabindex="-1" style="position: absolute;  clip: rect(0px 0px 0px 0px);">
                                                        </td>
                                                        <td class="text-center">
                                                            <img src="../<?=$records[2]['img2']?>" width="50" alt="">
                                                            <input ui-jq="filestyle" name="photo32" type="file" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="photo32"  accept="image/fits" tabindex="-1" style="position: absolute;  clip: rect(0px 0px 0px 0px);">
                                                        </td>
                                                        <td><textarea class="form-control m-b" style="height: 85px;" name="text3"><?=$records[2]['text']?></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="background-color: #3a3f51 !important;">
                                                            <img src="../<?=$records[3]['img1']?>" alt="">
                                                            <input ui-jq="filestyle" name="photo41" type="file" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="photo41"  accept="image/fits" tabindex="-1" style="position: absolute;  clip: rect(0px 0px 0px 0px);">
                                                        </td>
                                                        <td class="text-center">
                                                            <img src="../<?=$records[3]['img2']?>" width="50" alt="">
                                                            <input ui-jq="filestyle" name="photo42" type="file" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="photo42"  accept="image/fits" tabindex="-1" style="position: absolute;  clip: rect(0px 0px 0px 0px);">
                                                        </td>
                                                        <td><textarea class="form-control m-b" style="height: 85px;" name="text4"><?=$records[3]['text']?></textarea></td>
                                                    </tr>
                                                </tbody>
											</table>
											<input type="hidden" name="go" value="go">
										</div>
									</div>
								<button class="btn m-b-xs btn-success">Сохранить</button>
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
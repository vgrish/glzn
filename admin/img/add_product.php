<? include "models/function.php";

if (isset($_POST["go"])) {
    $objImg = new UploadImg();
    $name_img = $objImg->upload($_FILES,$_POST["photo_now"]);
    $objAttr = new AttrValue();
    $data_attr = $objAttr->conbine($_POST["attr"], $_POST["val"]);

    if (isset($_POST["related"]) and $_POST["related"]) {
        $related = array_slice($_POST["related"], 0, 4);
        $data_related = serialize($related);
    } else {
        $data_related="";
    }

    require_once "classes/Product.php";
    $obj = new Product();
    if ($_POST["go"] == "save") {
        $fff = $obj->insert(
            $obj->insertSql(),
            trimStr($_POST["section"]),
            trimStr($_POST["name"]),
            trimStr($_POST["nomer"]),
            trimStr($_POST["brand"]),
            trimStr($_POST["viscous"]),
            trimStr($_POST["type"]),
            trimStr($_POST["volume"]),
            trimStr($_POST["price"]),
            trimStr($_POST["text"]),
            $data_related,
            $data_attr,
            trimStr($_POST["title"]),
            trimStr($_POST["description"]),
            trimStr($_POST["keywords"]),
            $name_img,
            trimStr($_POST["img_title"]),
            trimStr($_POST["img_alt"])
        );
        header("Location: production.php?id=" . $_POST["section"]);
    } else {
        $obj->update($obj->updateSql(),
            trimStr($_POST["section"]),
            trimStr($_POST["name"]),
            trimStr($_POST["nomer"]),
            trimStr($_POST["brand"]),
            trimStr($_POST["viscous"]),
            trimStr($_POST["type"]),
            trimStr($_POST["volume"]),
            trimStr($_POST["price"]),
            trimStr($_POST["text"]),
            $data_related,
            $data_attr,
            trimStr($_POST["title"]),
            trimStr($_POST["description"]),
            trimStr($_POST["keywords"]),
            $name_img,
            trimStr($_POST["img_title"]),
            trimStr($_POST["img_alt"]),
            $_POST['go']);
        header("Location: production.php?id=" . $_POST["section"]);
    }
}
if (isset($_GET["delete"])) {
    $delete = new Delete();
    $delete->del($_GET["title"],$_GET["delete"]);
    header("Location: production.php?id=" . $_GET["delete"]);
}
require_once "classes/Catalog.php";
$section = new Catalog();
require_once "classes/Product.php";
$objEdit = new Product();
$related = $objEdit->selectAll();

if (isset($_GET["edit"])) {
    $record = $objEdit->selectId($_GET['edit']);
    $nowSection = $objEdit->selectSectionId($_GET['edit']);
}
require_once 'view/tpl_top.php';
?>
<div class="app app-header-fixed  ">
	<? include "view/header.php";
	$active_d = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col">
					<div class="bg-light lter b-b wrapper-md wrapper-md__i">
						<h1 class="m-n font-thin h3 inline"><?=(isset($_GET["edit"]))?"Редактирование товара":"Добавление товара"?></h1>
					</div>
					<div class="wrapper-md">
						<form method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-lg-8">
									<div class="panel panel-default">
										<div class="panel-heading font-bold">Раздел</div>
										<div class="panel-body">
											<div class="form-group">
												<select name="section" class="form-control m-b">
                                                    <?=(isset($nowSection))?'<option value="'.$nowSection[0]["id"].'">'.$nowSection[0]["name"].'</option>':""?>
                                                    <? $section->viewCatOptions($section->getCat(),0); ?>
												</select>
											</div>
										</div>
	  								</div>
									<div class="panel panel-default">
										<div class="panel-heading font-bold">Описание</div>
										<div class="panel-body">
											<div class="form-group">
                                                <div class="col-lg-12">
                                                    <label>Наименование</label>
                                                    <input type="text" class="form-control m-b required-js" name="name" value="<?=(isset($record[0]["name"]))?$record[0]["name"]:""?>">
                                                    <label>Артикул</label>
                                                    <input type="text" class="form-control m-b required-js" name="nomer" value="<?=(isset($record[0]["nomer"]))?$record[0]["nomer"]:""?>">
                                                    <label>Сокращенное описание</label>
                                                    <input type="text" class="form-control m-b required-js" name="brand" value="<?=(isset($record[0]["brand"]))?$record[0]["brand"]:""?>">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Вязкость</label>
                                                    <input type="text" class="form-control m-b" name="viscous" value="<?=(isset($record[0]["viscous"]))?$record[0]["viscous"]:""?>">
                                                    <label>Тип масла</label>
                                                    <input type="text" class="form-control m-b" name="type" value="<?=(isset($record[0]["type"]))?$record[0]["type"]:""?>">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Объем</label>
                                                    <input type="text" class="form-control m-b" name="volume" value="<?=(isset($record[0]["volume"]))?$record[0]["volume"]:""?>">
                                                    <label>Цена</label>
                                                    <input type="text" class="form-control m-b required-js" name="price" value="<?=(isset($record[0]["price"]))?$record[0]["price"]:""?>">
                                                </div>
                                            </div>
										</div>
                                        <div class="panel-heading font-bold">Meta-данные</div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <label>Meta-Title</label>
                                                    <input type="text" class="form-control m-b" name="title" value="<?=(isset($record[0]["title"]))?$record[0]["title"]:""?>">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Meta-Description</label>
                                                    <input type="text" class="form-control m-b" name="description" value="<?=(isset($record[0]["description"]))?$record[0]["description"]:""?>">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Meta-Keywords</label>
                                                    <input type="text" class="form-control m-b" name="keywords" value="<?=(isset($record[0]["keywords"]))?$record[0]["keywords"]:""?>">
                                                </div>
                                            </div>
                                        </div>
	  								</div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading font-bold">Похожие товары</div>
                                        <div class="panel-body">
                                            <select ui-jq="chosen" data-placeholder="Выберите похожие товары..." multiple class="w-full chosen-select" max="5" name="related[]">
                                                <?
                                                if (isset($record[0]["related"]) AND $record[0]["related"]) { $array_selected = unserialize($record[0]["related"]); }
                                                foreach ($related as $relateds) {
                                                    ?><option value="<?=$relateds['id']?>"
                                                    <?
                                                    if (isset($record[0]["related"]) AND $record[0]["related"]) {
                                                        if (in_array($relateds['id'], $array_selected)) {
                                                            echo "selected";
                                                        }
                                                    }
                                                    ?>
                                                    ><?=$relateds["nomer"]?> - <?=$relateds["name"]?></option><?
                                                }
                                                ?>
                                            </select>
                                            <span class="help-block m-b-none"><i class="fa fa-asterisk text-danger"></i>Максимальное количество похожих товаров: 4</span>
                                        </div>
                                    </div>
								</div>
								<div class="col-lg-4">
									<div class="panel panel-default">
										<div class="panel-heading font-bold">Фото</div>
										<div class="panel-body">
											<div class="col-md-12 general_photo m-b text-center">
												<label for="photo" class="upload_photo">
													<input type="file" name="photo" id="photo" accept="image/jpeg,image/jpg,image/png,image/gif">
													<input type="hidden" name="photo_now" value="<?=(isset($record[0]["img"]) AND $record[0]["img"])?$record[0]["img"]:""?>">
													<img src="<?=(isset($record[0]["img"]) AND $record[0]["img"])?"../".$record[0]["img"]:"img/photo.jpg"?>">
												</label><br>
                                                <label>Img(title)</label>
                                                <input type="text" class="form-control m-b"
                                                       name="img_title" value="<?=(isset($record[0]["img_title"]))?$record[0]["img_title"]:""?>">
                                                <label>Img(alt)</label>
                                                <input type="text" class="form-control m-b"
                                                       name="img_alt" value="<?=(isset($record[0]["img_alt"]))?$record[0]["img_alt"]:""?>">
											</div>
										</div>
	  								</div>
								</div>
							</div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading font-bold">Дополнительные параметры</div>
                                        <table class="table addAttr__i">
                                            <tbody>
                                            <?
                                            if (isset($record[0]["attr"]) AND $record[0]["attr"]) :
                                                $array = unserialize($record[0]["attr"]);
                                                $item = count($array)-1;
                                                $i = 0;
                                                foreach ($array as $key => $value) {
                                                    ?>
                                                    <tr class="line">
                                                        <td><input class="form-control" name="attr[]" placeholder="Название" value="<?=$key?>"></td>
                                                        <td><input class="form-control" name="val[]" placeholder="Значение" value="<?=$value?>"></td>
                                                        <? if ($i==0) :?>
                                                            <td width="50"><button type="button" class="btn btn-primary addattr" data-idd="<?=$item?>"><i class="fa fa-plus-circle"></i></button></td>
                                                        <? else: ?>
                                                            <td width="50"><button type="button" class="btn btn-danger delattr"><i class="fa fa-minus-circle"></i></button></td>
                                                        <? endif; ?>
                                                    </tr>
                                                    <? $i++;}
                                            else :?>
                                                <tr class="line">
                                                    <td><input class="form-control" name="attr[]" placeholder="Название" value=""></td>
                                                    <td><input class="form-control" name="val[]" placeholder="Значение" value=""></td>
                                                    <td width="50"><button type="button" class="btn btn-primary addattr" data-idd="0"><i class="fa fa-plus-circle"></i></button></td>
                                                </tr>
                                            <? endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading font-bold">Полное описание</div>
                                        <div class="panel-body">
                                            <div id="summernote">Введиет текст страницы</div>
                                            <textarea name="text" class="hidden"><?=(isset($record[0]["text"]))?$record[0]["text"]:""?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="row">
								<div class="col-lg-12">
									<input type="hidden" name="go" value="<?=(isset($_GET["edit"]))?$_GET["edit"]:"save"?>">
									<div class="btn btn-success button listsave">Сохранить</div>
		                        </div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? require_once 'view/tpl_bottom.php'; ?>
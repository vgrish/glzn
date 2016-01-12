<? include "models/function.php";
IncludeClass::inc(array("Product"));
if (isset($_POST["go"])) {
    array_pop($_POST['colors']);
    $nn = DB::selectAI("price");
    $attr = AttrValue::conbine($_POST["attr"], $_POST["val"]);
    if ($_POST["go"]=="save") {
        $arrText = array("section"=>$_POST['section'],"name"=>$_POST['name'],"nomer"=>$_POST['nomer'],"size"=>$_POST['size'],"price"=>$_POST['price'],"text"=>$_POST['text'],"attr"=>$attr,"title"=>$_POST['title'],"description"=>$_POST['description'],"keywords"=>$_POST['keywords'], "nn"=>$nn, "best"=>0);
        $lastId = DB::insert(DB::insertSql("price",$arrText),$arrText);
    } else {
        $arrText = array("section"=>$_POST['section'],"name"=>$_POST['name'],"nomer"=>$_POST['nomer'],"size"=>$_POST['size'],"price"=>$_POST['price'],"text"=>$_POST['text'],"attr"=>$attr,"title"=>$_POST['title'],"description"=>$_POST['description'],"keywords"=>$_POST['keywords']);
        $lastId = $_POST["go"];
        DB::update(DB::updateSql("price",$arrText),$arrText,$lastId);
    }

    $dir = "../photo/";
    $arrTmpPhoto = array();
    foreach ($_POST['tmpPhoto'] as $fileBody) {
        $fileName = $dir.uniqid();
        // определяем формат файла
        preg_match('#data:image\/(png|jpg|jpeg|gif);#', $fileBody, $fileTypeMatch);
        $fileType = $fileTypeMatch[1];
        // декодируем содержимое файла
        $fileBody = preg_replace('#^data.*?base64,#', '', $fileBody);
        $fileBody = base64_decode($fileBody);
        // сохраем файл
        $nameFile = $fileName.'.'.$fileType;
        file_put_contents($nameFile, $fileBody);
        $photo = str_replace('../', '', $nameFile);
        $arrTmpPhoto[] = $photo;
    }
    $array_photoTMP = array();
    foreach ($arrTmpPhoto as $key111=>$value111) {
        $array_photoTMP[]= array("photo"=>$arrTmpPhoto[$key111],"color"=>$_POST["colors"][$key111]);
    }
    if ($_POST["go"]!="save") { DB::deletePhoto($_POST["go"]); }
    Product::insertPhoto($array_photoTMP,$lastId);
    header("Location: production.php?id=" . $_POST["section"]);
}

require_once "classes/Catalog.php";
$section = new Catalog();
require_once "classes/Product.php";
$objEdit = new Product();
$related = $objEdit->selectAll();
$colors = DB::select("colors");

if (isset($_GET["edit"])) {
    $record = DB::selectID("price",$_GET['edit']);
//    $nowSection = DB::selectParam("catalog","id",$record[0]['section'],false,"limit 1");
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
								<div class="col-lg-7">
									<div class="panel panel-default">
										<div class="panel-heading font-bold">Раздел</div>
										<div class="panel-body">
											<div class="form-group">
												<select name="section" class="form-control m-b">
                                                    <?
                                                        if (isset($nowSection) AND $nowSection) {
                                                            ?><option value="<?=$nowSection[0]['id']?>"><?=$nowSection[0]['name']?></option><?
                                                        }
                                                    ?>
                                                    <? Catalog::viewCatOptions(Catalog::getCat(),0); ?>
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
                                                    <label>Размеры</label>
                                                    <input type="text" class="form-control m-b" name="size" value="<?=(isset($record[0]["size"]))?$record[0]["size"]:""?>">
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
								</div>
								<div class="col-lg-5">
									<div class="panel panel-default">
										<div class="panel-heading font-bold">Фото</div>
										<div class="panel-body">
											<div class="col-md-12 general_photo m-b text-center">
												<label for="photo" class="upload_photo">
                                                    <input name="photo[]" type="file" id="files" accept="image/fits">
                                                    <?
                                                    if (isset($_GET['edit']) AND $_GET['edit']) {
                                                        $recordsPhoto = DB::selectParam('price_photo','price_id',$_GET['edit'], "id|ASC", false);
                                                        if ($recordsPhoto) {
                                                            foreach ($recordsPhoto as $photos) {
                                                                $path = "../".$photos['src'];
                                                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                                                $data = file_get_contents($path);
                                                                $photo = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                                                ?>
                                                                <div class="item__photo col-xs-4 pos-rlt m-t">
                                                                    <i class="glyphicon text-danger glyphicon-remove-circle removeIcon"></i>
                                                                    <input type="hidden" name="tmpPhoto[]" value="<?=$photo?>">
                                                                    <img src="<?=$photo?>"><br>
                                                                    <select name="colors[]">
                                                                        <option value="0">Выберите цвет</option>
                                                                        <?
                                                                        foreach ($colors as $color) {
                                                                            ?><option value="<?=$color['id']?>" <?=($color['id']==$photos['color'])?"selected=\"selected\"":""?>><?=$color['value']?></option><?
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <br><br>
                                                                </div>
                                                            <?
                                                            }
                                                        }
                                                    }
                                                    ?>
												</label><br>
                                                 <div class="colors hidden">
                                                     <select name="colors[]">
                                                         <option value="0">Выберите цвет</option>
                                                         <?
                                                         foreach ($colors as $color) {
                                                             ?><option value="<?=$color['id']?>"><?=$color['value']?></option><?
                                                         }
                                                         ?>
                                                     </select>
                                                 </div>
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
<? include "models/function.php";
IncludeClass::inc(array("Catalog"));
$param = "catalog";
$record = false;
if (isset($_POST["go"])) {
	if (!$_POST["name_en"]) { $_POST["name_en"] = Rename::replace($_POST["name_ru"]);
    } else {
        $_POST["name_en"] = Rename::replace($_POST["name_en"]);
    }
	if ($_POST["go"] == "save") {
		array_pop($_POST);
		$_POST['nn'] = DB::selectAI($param);
		DB::insert(DB::insertSql($param,$_POST),$_POST);
		header("Location: ".$_SERVER['REQUEST_URI']);
	}  else {
		$id = array_pop($_POST);
		DB::update(DB::updateSql($param,$_POST),$_POST,$id);
		header("Location: ".$_SERVER['REQUEST_URI']);
	}
}

if (isset($_GET["delete"])) {
    Delete::del($_GET["title"],$_GET["delete"]);
    header("Location: production.php");
}

if (isset($_GET["id"])) {
	$record = DB::selectParam('price','section',$_GET["id"], 'nn|ASC', false);
}
require_once 'view/tpl_top.php';
?>
<div class="app app-header-fixed  ">
	<?
	include "view/tpl_popup_production.php";
	include "view/header.php";
	$active_d = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col w-xl bg-white-only b-l bg-auto no-border-xs">
					<div class="padder-md">
						<div class="m-b text-md m-t font-bold">Меню каталога</div>
                        <div ui-jq="nestable" class="dd">
						    <? Catalog::viewCatLi(Catalog::getCat(),0); ?>
                        </div>
                        <button type="button" class="btn btn-success w-full nestable_save" data-table="catalog">Сохранить сортировку</button>
					</div>
				</div>
				<div class="col">
					<div class="bg-light lter b-b wrapper-md wrapper-md__i">
						<h1 class="m-n font-thin h3 inline">Каталог продукции</h1>
					</div>
					<div class="m-b-sm">
						<div class="btn-group btn-group-justified">
							<a class="btn btn-primary section-js" data-toggle="modal" data-target=".section"><i class="fa fa-plus"></i> Добавить раздел</a>
							<a class="btn btn-info subsection-js" data-toggle="modal" data-target=".section"><i class="fa fa-plus"></i> Добавить подраздел</a>
							<a href="add_product.php" class="btn btn-success" ><i class="fa fa-plus"></i> Добавить товар</a>
						</div>
					</div>
					<div class="wrapper-md">
						<? if ($record != false) :?>
							<div class="row">
								<div class="col-lg-12">
                                    <ul class="sortable list">
                                        <?
                                        foreach ($record as $product) {
                                            $recordsPhoto = DB::selectParam('price_photo','price_id',$product["id"], false, "limit 1");
                                        ?>
                                        <li class="list-group-item" draggable="true" data-id="<?=$product["id"]?>">
                                            <span class="pull-right">
                                                <a href="add_product.php?edit=<?=$product["id"]?>" title="Редактировать" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                                <a title="Удалить" href="?delete=<?=$product["id"]?>&title=price" class="btn btn-xs btn-danger" onclick="return confirm('Удалить?');"><i class="fa fa-times"></i></a><br>

                                                <a title="Лучшее" class="btn btn-xs <?=($product["best"]==0)?"btn-default":"btn-success"?> m-t edit_sezons" data-id="<?=$product["id"]?>"><i class="fa fa-lightbulb-o"></i></a>
                                            </span>
                                            <span class="pull-left"><i class="fa fa-sort text-muted fa m-r-sm"></i> </span>
                                            <div class="clear">
												<img height="120" class="photo-product" src="<?=($recordsPhoto[0]['src'])?"../".$recordsPhoto[0]['src']:"img/photo.jpg"?>">
												Артикул: <strong><?=$product['nomer']?></strong><br>
												Наименование: <strong><?=$product['name']?></strong><br>
												Цена: <strong><?=$product['price']?></strong><br>
                                            </div>
                                        </li>
                                    <?}?>
                                    </ul>
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
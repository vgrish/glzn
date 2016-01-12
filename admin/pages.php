<? include "models/function.php";
IncludeClass::inc(array("Pages"));
$param = "section";
$record = false;

if (isset($_POST["go"])) {
    $obj = new Pages();
	if (!$_POST["url"]) { $url = replaceStr(translitIt($_POST["name"])); } else { $url = $_POST["url"]; }
	if ($_POST["go"] == "save") {
		$obj->insertSection($obj->insertSectionSql(),$_POST["section"],$url,trimStr($_POST["name"]));
		header("Location: ".$_SERVER['REQUEST_URI']);
	} else {
		$obj->updateSection($obj->updateSectionSql(),$_POST["section"],$url,trimStr($_POST["name"]),$_POST['go']);
		header("Location: ".$_SERVER['REQUEST_URI']);
	}
}

if (isset($_POST["pages"])) {
	if ($_POST["pages"] == "insert") {
        array_pop($_POST);
        DB::insert(DB::insertSql("pages",$_POST),$_POST);
        header("Location: ".$_SERVER['REQUEST_URI']);
	} else {
        array_pop($_POST);
        $id = array_pop($_POST);
        DB::update(DB::updateSql("pages",$_POST),$_POST,$id);
        header("Location: ".$_SERVER['REQUEST_URI']);
	}
}

if (isset($_GET["delete"])) {
    Delete::del($_GET["title"],$_GET["delete"]);
    header("Location: pages.php");
}

if (isset($_GET["id"])) {
	$record = Pages::PagesSelect($_GET["id"]);
	$sectionName = Pages::selectId($_GET["id"]);
}
require_once 'view/tpl_top.php';
?>
<div class="app app-header-fixed  ">
	<?
    include "view/tpl_popup_pages.php";
    include "view/header.php";
	$active_c = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
	<div id="content" class="app-content" role="main">
		<div class="app-content-body ">
			<div class="hbox hbox-auto-xs hbox-auto-sm">
				<div class="col w-xl bg-white-only b-l bg-auto no-border-xs">
					<div class="padder-md">
						<div class="m-b text-md m-t font-bold">Все страницы</div>
						<div ui-jq="nestable" class="dd">
							<? Pages::viewCatLi(Pages::getCat(),0); ?>
						</div>
						<button type="button" class="btn btn-success w-full nestable_save_pages">Сохранить сортировку</button>
					</div>
				</div>
				<div class="col">
					<div class="bg-light lter b-b wrapper-md wrapper-md__i">
						<h1 class="m-n font-thin h3 inline">Страницы</h1>
					</div>
					<div class="m-b-sm">
						<div class="btn-group btn-group-justified">
							<a class="btn btn-primary section-js" data-toggle="modal" data-target=".section"><i class="fa fa-plus"></i> Добавить раздел</a>
							<a class="btn btn-info subsection-js" data-toggle="modal" data-target=".section"><i class="fa fa-plus"></i> Добавить подраздел</a>
						</div>
					</div>
					<div class="wrapper-md">
						<? if (isset($_GET["id"])) :?>
							<form method="post">
								<div class="row">
									<div class="col-lg-12">
										<div class="panel panel-default">
											<div class="panel-heading font-bold">Настройки страницы: <?=$sectionName[0]["name_ru"]?></div>
											<div class="panel-body">
												<div class="form-group">
													<label>Заголовок</label>
													<input type="text" class="form-control m-b required-js" name="name" value="<?=(isset($record[0]["name"]))?$record[0]["name"]:""?>">
													<label>Meta-Title</label>
													<input type="text" class="form-control m-b required-js" name="title" value="<?=(isset($record[0]["title"]))?$record[0]["title"]:""?>">
													<label>Meta-Description</label>
													<input type="text" class="form-control m-b" name="description" value="<?=(isset($record[0]["description"]))?$record[0]["description"]:""?>">
													<label>Meta-Keywords</label>
													<input type="text" class="form-control m-b" name="keywords" value="<?=(isset($record[0]["keywords"]))?$record[0]["keywords"]:""?>">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="panel panel-default">
											<div class="panel-heading font-bold">Текст</div>
											<div class="panel-body">
												<div id="summernote">Введиет текст страницы</div>
												<textarea name="text" class="hidden"><?=(isset($record[0]["text"]))?$record[0]["text"]:""?></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
                                        <input type="hidden" name="section" value="<?=(isset($record[0]["id"]))?$record[0]["id"]:$_GET['id']?>">
                                        <input type="hidden" name="pages" value="<?=($record)?"update":"insert"?>">
										<div class="btn btn-success button listsave">Сохранить</div>
									</div>
								</div>
							</form>
						<? endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? require_once 'view/tpl_bottom.php'; ?>
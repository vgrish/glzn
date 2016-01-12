<? include "models/function.php";
$record = DB::select("count_zakaz");
require_once 'view/tpl_top.php';
?>
<div class="app app-header-fixed  ">
	<? include "view/header.php";
	$active_e = "class=\"active\""; include "view/nav.php"; ?>
	<!-- content -->
    <div id="content" class="app-content" role="main">
        <div class="app-content-body ">
            <div class="hbox hbox-auto-xs hbox-auto-sm">
                <div class="col">
                    <div class="bg-light lter b-b wrapper-md wrapper-md__i">
                        <h1 class="m-n font-thin h3 inline">Заказы</h1>
                    </div>
                    <div class="wrapper-md">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><?=($record==false)?"Нет заказов":"Заказы"?></div>
                                    <? if ($record != false) :?>
                                        <div class="table-responsive">
                                            <table class="table table-striped b-t b-light">
                                                <thead>
                                                <tr>
                                                    <th width="20">№</th>
                                                    <th>№Заказа</th>
                                                    <th>Дата</th>
                                                    <th>Имя</th>
                                                    <th>Телефон</th>
                                                    <th>Email</th>
                                                    <th>Сумма</th>
                                                    <th style="width:70px;">Оплата</th>
                                                    <th style="width:70px;"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <? if ($record != false) : ?>
                                                    <?
                                                        $i = 1;
                                                        foreach ($record as $records) { ?>
                                                        <tr>
                                                            <td><?=$i?></td>
                                                            <td>№<?=$records["id"]?></td>
                                                            <td><?=data_russian(date_exp($records["date"]))?></td>
                                                            <td><?=$records["name"]?></td>
                                                            <td><?=$records["phone"]?></td>
                                                            <td><?=$records["email"]?></td>
                                                            <td><?=$records["sun"]?></td>
                                                            <td><button class="btn btn-xs w-xs btn-<?=($records["payment"]=="fail")?"danger":"success"?>"><?=($records["payment"]=="fail")?"не оплачен":"оплачено"?></td>
                                                            <td><a href="zakaz_view.php?id=<?=$records["id"]?>" class="btn btn-xsm btn-info view_zakaz">просмотр</a></td>
                                                        </tr>
                                                    <? $i++; } ?>
                                                <? endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<? require_once 'view/tpl_bottom.php'; ?>
<? include "models/function.php";
$zakaz_name = DB::selectId("count_zakaz",$_GET["id"]);
$zakaz = DB::selectParam("zakaz","nzakaz",$_GET["id"],false,false);
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
                                    <div class="table-responsive">
                                        <table class="table table-striped b-t b-light">
                                            <thead>
                                            <tr>
                                                <th width="270">Фото</th>
                                                <th>Артикул</th>
                                                <th>Наименование</th>
                                                <th>Кол-во</th>
                                                <th>Цвет</th>
                                                <th>Размер</th>
                                                <th>Цена</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?
                                            foreach ($zakaz as $zakazz) {
                                                $photo = DB::selectSql("SELECT * FROM price_photo WHERE price_id={$zakazz['price_id']} AND color={$zakazz['color']}");
                                                $price = DB::selectID("price",$zakazz['price_id']);
                                                $color = DB::selectID("colors",$zakazz['color']);
                                                ?>
                                                <tr>
                                                    <td><img src="../<?=$photo[0]["src"]?>" alt="" style="width: 250px"/></td>
                                                    <td><?=$price[0]["nomer"]?></td>
                                                    <td><?=$price[0]["name"]?></td>
                                                    <td><?=$zakazz["kol"]?></td>
                                                    <td><?=$color[0]["value"]?></td>
                                                    <td><?=$zakazz["size"]?></td>
                                                    <td><?=$price[0]["price"]?></td>
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
                    </div>
                </div>
                <div class="col w-lg bg-light lter b-l bg-auto">
                    <div class="wrapper">
                        <div class="">
                            <h4 class="m-t-xs m-b-xs">Заказ №<?=$zakaz_name[0]["id"]?></h4>
                            <ul class="list-group no-bg no-borders pull-in">
                                <li class="list-group-item">
                                    <div class="clear">
                                        <small class="text-muted">Дата:</small>
                                        <div><?=data_russian(date_exp($zakaz_name[0]["date"]))?></div>
                                    </div>
                                    <div class="clear">
                                        <small class="text-muted">Имя:</small>
                                        <div><?=$zakaz_name[0]["name"]?></div>
                                    </div>
                                    <div class="clear">
                                        <small class="text-muted">Телефон:</small>
                                        <div><?=$zakaz_name[0]["phone"]?></div>
                                    </div>
                                    <div class="clear">
                                        <small class="text-muted">Email:</small>
                                        <div><?=$zakaz_name[0]["email"]?></div>
                                    </div>
                                    <div class="clear">
                                        <small class="text-muted">Регион:</small>
                                        <div><?=$zakaz_name[0]["region"]?></div>
                                    </div>
                                    <div class="clear">
                                        <small class="text-muted">Город:</small>
                                        <div><?=$zakaz_name[0]["city"]?></div>
                                    </div>
                                    <div class="clear">
                                        <small class="text-muted">Индекс:</small>
                                        <div><?=$zakaz_name[0]["index"]?></div>
                                    </div>
                                    <div class="clear">
                                        <small class="text-muted">Улица:</small>
                                        <div><?=$zakaz_name[0]["street"]?></div>
                                    </div>
                                    <div class="clear">
                                        <small class="text-muted">Дом:</small>
                                        <div><?=$zakaz_name[0]["house"]?></div>
                                    </div>
                                    <div class="clear">
                                        <small class="text-muted">Сумма заказа:</small>
                                        <div><?=$zakaz_name[0]["sun"]?></div>
                                    </div>
                                    <div class="clear">
                                        <small class="text-muted">Сумма доставки:</small>
                                        <div><?=$zakaz_name[0]["sun_dost"]?></div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="clear">
                                        <small class="text-muted">Комментарий к заказу:</small>
                                        <div><?=$zakaz_name[0]["comment"]?></div>
                                    </div>
                                    <div class="clear">
                                        <small class="text-muted">Способ доставки:</small>
                                        <div><?=$zakaz_name[0]["delivery"]?></div>
                                    </div>
                                    <div class="clear">
                                        <small class="text-muted">Тип оплаты:</small>
                                        <div><?=$zakaz_name[0]["type_payment"]?></div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="clear">
                                        <small class="text-muted">Оплата:</small>
                                        <div><?=($zakaz_name[0]["payment"]=="fail")?"не оплачено":"оплачено"?></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<? require_once 'view/tpl_bottom.php'; ?>
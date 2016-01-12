<?php include "config.php";
    $product = DB::selectID('price',$_GET['id']);
    $photos = DB::selectParam('price_photo','price_id',$_GET['id'],"id|ASC",false);
//var_dump($photos);
    $link = DB::selectID('catalog',$product[0]['section']);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
	<title><?=($product[0]["title"])?"GLZN ".$product[0]["title"]:"GLZN"?></title>
    <meta name="description" content="<?=($product[0]["description"])?$product[0]["description"]:""?>">
    <meta name="keywords" content="<?=($product[0]["keywords"])?$product[0]["keywords"]:""?>">
	<link rel="shortcut icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?=ConfigSites::$prefix?>img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?=ConfigSites::$prefix?>css/style.css" />
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.5.7/slick.css"/>
</head>
<body id="product">
	<div class="content black">
        <div class="burger">
            <div class="burger-top"></div>
            <div class="burger-mid"></div>
            <div class="burger-bot"></div>
        </div>
        <div class="js-block">
            <div class="menu black hidden">
                <div class="menu-container">
                    <?php include 'view/menu.php';?>
                </div>
            </div>
            <div class="container">
                <div class="product-col left">
                    <div class="col-nav">
                        <a href="<?=ConfigSites::$prefix?>catalog/<?=$link[0]['name_en']?>" class="toCatalog">В галерею</a>
                        <?
                        if (count($photos)>1) {
                            ?>
                                <div class="slider-arrows">
                                    <div class="arrow left disabled"></div>
                                    <div class="arrow right"></div>
                                </div>
                            <?
                        }
                        ?>
                    </div>
                    <div class="product-title mobile"><?=$product[0]['name']?></div>
                    <div class="product-slider-container">
                        <div class="slider">
                            <?
                            foreach ($photos as $photo ) {
                                ?>
                                <a href="<?=ConfigSites::$prefix?><?=$photo['src']?>" rel="group" class="fancybox">
                                    <div class="product-info mobile">
                                        <span class="art-container">
                                            <span class="art">Артикул: </span><span class="product-art-value"><?=$product[0]['nomer']?></span>
                                        </span>
                                    </div>
                                    <img src="<?=ConfigSites::$prefix?><?=$photo['src']?>" alt="">
                                </a>
                                <?
                            }
                            ?>
                        </div>
                        <div class="slider-nav">
                            <?
                            $i=0;
                            foreach ($photos as $photo) {
                                if ($photo['src']) {
                                    ?>
                                    <img src="<?=ConfigSites::$prefix?><?=$photo['src']?>" alt="" data-num="<?=$i?>">
                                    <?
                                    $i++;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="product-col right">
                    <div class="product-title"><?=$product[0]['name']?></div>
                    <p class="product-art">
                        <span class="art">Артикул: </span><span class="product-art-value"><?=$product[0]['nomer']?></span>
                    </p>
                    <div class="hr"></div>
                        <?
                            if (isset($product[0]["attr"])) {
                                $array = unserialize($product[0]["attr"]);
                                $item = count($array)-1;
                                $i = 0;
                                foreach ($array as $key => $value) {
                                    if ($key) {
                                        ?>
                                            <div class="structure">
                                                <div class="head"><?=$key?>:</div>
                                                <div class="value"><?=$value?></div>
                                            </div>
                                        <?
                                        $i++;
                                    }
                                }
                            }
                        ?>
                    <div class="colors">
                        <div class="head">Цена</div>
                        <span class="product-price-value"><?=ceil($product[0]['price'])?></span>&nbsp;<span>руб</span>
                    </div>
                    <div class="colors">
                        <div class="head">Цвета:</div>
                        <?
                        if (count($photos)>1) {
                            function array_value_recursive($key, array $arr){
                                $val = array();
                                array_walk_recursive($arr, function($v, $k) use($key, &$val){
                                    if($k == $key) array_push($val, $v);
                                });
                                return count($val) > 1 ? $val : array_pop($val);
                            }
                            $i=1;
                            $uniq = array_unique(array_value_recursive('color',$photos));
                            foreach ($uniq as $k=>$v ) {
                                $color_hex = DB::selectID('colors',$uniq[$k]);
                                ?>
                                <label class="<?=($i==1)?"active":""?>">
                                    <input type="radio" name="color" value="<?=$uniq[$k]?>" data-num="<?=$k?>" <?=($i==1)?"checked":""?>>
                                    <div class="color-box" style="background-color: <?=$color_hex[0]['rgb']?>;"></div>
                                </label>
                                <?
                                $i++;
                            }
                        } else {
                            $i=1;
                            foreach ($photos as $photo ) {
                                $color_hex = DB::selectID('colors',$photo['color']);
                                ?>
                                <label class="<?=($i==1)?"active":""?>">
                                    <input type="radio" name="color" value="<?=$photo['color']?>" data-num="<?=$i?>" <?=($i==1)?"checked":""?>>
                                    <div class="color-box" style="background-color: <?=$color_hex[0]['rgb']?>;"></div>
                                </label>
                                <?
                                $i++;
                            }
                        }
                        ?>
                    </div>
                    <div class="sizes">
                        <div class="head">Размеры:</div>
                        <?
                            $sizes = explode(',',$product[0]['size']);
                            $i=1;
                            foreach ($sizes as $size ) {
                                ?>
                                <label class="<?=($i==1)?"active":""?>">
                                    <input type="radio" name="size" value="<?=$size?>" <?=($i==1)?"checked":""?>>
                                    <div class="size-box"><?=$size?></div>
                                </label>
                                <?
                                $i++;
                            }

                        ?>
                    </div>
                    <a href="javascript:void(0);" class="sizes-table" onclick="popup('size-table');">Таблица размеров</a>
                    <div class="count">
                        <div class="head">Количество:</div>
                        <div class="item-count-value">1</div>
                        <div class="item-count-controls">
                            <div class="inc"></div>
                            <div class="dec"></div>
                        </div>
                    </div>
                    <div class="btn dark filled addToCart" data-id="<?=$product[0]['id']?>"><span>Добавить в корзину</span></div>
                    <div class="benefits">
                        <?=$product[0]["text"]?>
                    </div>
                </div>
            </div>
        </div>
	</div>
	<?php	include 'view/popups.php';?>
	<script type="text/javascript" src="<?=ConfigSites::$prefix?>js/plugins.js"></script>
<? include 'view/counter.php'; ?>
</body>
</html>
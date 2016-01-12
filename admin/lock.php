<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="ru"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="ru"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="ru"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="ru"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Сраница ошибки</title>
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<? include "fns/css.php"; ?>
	<style>

@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,300,700&subset=latin,cyrillic);
@import url(http://fonts.googleapis.com/css?family=Changa+One);

body { line-height: 1; }
ol, ul { list-style: none; }
/*-----------------[Базовые Стили]-----------------*/
html, body, .comingcontainer{ height: 100%; margin: 0; padding: 0; overflow: hidden; }

body { font-family: 'Open Sans', sans-serif; font-size: 14px; color: #3c3c3c;
	background: url(img/ch2.png) top right no-repeat, url(img/ch1.png) top left no-repeat, #F7F7F7 url(img/bg1.png);background-attachment:fixed;
}
@keyframes go3d {
	0% { text-shadow: 0px 0px 2px #686868; }
	100% {
		/***** 3D Трансформация *****/
		text-shadow: 0px 0px 2px #686868,
	                 0px 1px 1px #ddd,
	                 0px 2px 1px #d6d6d6,
	                 0px 3px 1px #ccc,
	                 0px 4px 1px #c5c5c5,
	                 0px 5px 1px #c1c1c1,
	                 0px 6px 1px #bbb,
	                 0px 7px 1px #777,
	                 0px 8px 3px rgba(100, 100, 100, 0.4),
	                 0px 9px 5px rgba(100, 100, 100, 0.1),
	                 0px 10px 7px rgba(100, 100, 100, 0.15),
	                 0px 11px 9px rgba(100, 100, 100, 0.2),
	                 0px 12px 11px rgba(100, 100, 100, 0.25),
                	 0px 13px 15px rgba(100, 100, 100, 0.3);  }
}

@-webkit-keyframes go3d {
	0% { text-shadow: 0px 0px 2px #686868; }
	100% {
		/***** 3D Трансформация *****/
		text-shadow: 0px 0px 2px #686868,
	                 0px 1px 1px #ddd,
	                 0px 2px 1px #d6d6d6,
	                 0px 3px 1px #ccc,
	                 0px 4px 1px #c5c5c5,
	                 0px 5px 1px #c1c1c1,
	                 0px 6px 1px #bbb,
	                 0px 7px 1px #777,
	                 0px 8px 3px rgba(100, 100, 100, 0.4),
	                 0px 9px 5px rgba(100, 100, 100, 0.1),
	                 0px 10px 7px rgba(100, 100, 100, 0.15),
	                 0px 11px 9px rgba(100, 100, 100, 0.2),
	                 0px 12px 11px rgba(100, 100, 100, 0.25),
                	 0px 13px 15px rgba(100, 100, 100, 0.3);  }
}

@-moz-keyframes go3d {
	0% { text-shadow: 0px 0px 2px #686868; }
	100% {
		/***** 3D Трансформация *****/
		text-shadow: 0px 0px 2px #686868,
	                 0px 1px 1px #ddd,
	                 0px 2px 1px #d6d6d6,
	                 0px 3px 1px #ccc,
	                 0px 4px 1px #c5c5c5,
	                 0px 5px 1px #c1c1c1,
	                 0px 6px 1px #bbb,
	                 0px 7px 1px #777,
	                 0px 8px 3px rgba(100, 100, 100, 0.4),
	                 0px 9px 5px rgba(100, 100, 100, 0.1),
	                 0px 10px 7px rgba(100, 100, 100, 0.15),
	                 0px 11px 9px rgba(100, 100, 100, 0.2),
	                 0px 12px 11px rgba(100, 100, 100, 0.25),
                	 0px 13px 15px rgba(100, 100, 100, 0.3);  }
}

@-ms-keyframes go3d {
	0% { text-shadow: 0px 0px 2px #686868; }
	100% {
		/***** 3D Трансформация *****/
		text-shadow: 0px 0px 2px #686868,
	                 0px 1px 1px #ddd,
	                 0px 2px 1px #d6d6d6,
	                 0px 3px 1px #ccc,
	                 0px 4px 1px #c5c5c5,
	                 0px 5px 1px #c1c1c1,
	                 0px 6px 1px #bbb,
	                 0px 7px 1px #777,
	                 0px 8px 3px rgba(100, 100, 100, 0.4),
	                 0px 9px 5px rgba(100, 100, 100, 0.1),
	                 0px 10px 7px rgba(100, 100, 100, 0.15),
	                 0px 11px 9px rgba(100, 100, 100, 0.2),
	                 0px 12px 11px rgba(100, 100, 100, 0.25),
                	 0px 13px 15px rgba(100, 100, 100, 0.3);  }
}

@-o-keyframes go3d {
	0% { text-shadow: 0px 0px 2px #686868; }
	100% {
		/***** 3D Трансформация *****/
		text-shadow: 0px 0px 2px #686868,
	                 0px 1px 1px #ddd,
	                 0px 2px 1px #d6d6d6,
	                 0px 3px 1px #ccc,
	                 0px 4px 1px #c5c5c5,
	                 0px 5px 1px #c1c1c1,
	                 0px 6px 1px #bbb,
	                 0px 7px 1px #777,
	                 0px 8px 3px rgba(100, 100, 100, 0.4),
	                 0px 9px 5px rgba(100, 100, 100, 0.1),
	                 0px 10px 7px rgba(100, 100, 100, 0.15),
	                 0px 11px 9px rgba(100, 100, 100, 0.2),
	                 0px 12px 11px rgba(100, 100, 100, 0.25),
                	 0px 13px 15px rgba(100, 100, 100, 0.3);  }
}

.go3d {
	-webkit-animation: go3d 2s;
	-moz-animation: go3d 2s;
	-ms-animation: go3d 2s;
	-o-animation: go3d 2s;
	animation: go3d 2s;
}

.comingcontainer{
	width: 100%;
}

.checkbacksoon {
	width: auto;
	height: 100%;
	padding-top: 13%;
}

.checkbacksoon p {
	text-shadow: none;
	font-weight: normal;
	color: #666;
	font-family: 'Open Sans', sans-serif;
	display: block;
	margin: auto;
	text-align:center;
	text-shadow: 0px 1px 0px #ffffff;
}


.checkbacksoon p span {
	color:#fff;
	font-family: 'Changa One', cursive;
	font-size: 200px;
	line-height: 220px;
	letter-spacing: 1px;

	cursor:pointer;

	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	-o-transition: all 0.1s linear;
	-ms-transition: all 0.1s linear;
	transition: all 0.1s linear;

	/***** 3D Трансформация *****/
		text-shadow: 0px 0px 2px #686868,
	                 0px 1px 1px #ddd,
	                 0px 2px 1px #d6d6d6,
	                 0px 3px 1px #ccc,
	                 0px 4px 1px #c5c5c5,
	                 0px 5px 1px #c1c1c1,
	                 0px 6px 1px #bbb,
	                 0px 7px 1px #777,
	                 0px 8px 3px rgba(100, 100, 100, 0.4),
	                 0px 9px 5px rgba(100, 100, 100, 0.1),
	                 0px 10px 7px rgba(100, 100, 100, 0.15),
	                 0px 11px 9px rgba(100, 100, 100, 0.2),
	                 0px 12px 11px rgba(100, 100, 100, 0.25),
                	 0px 13px 15px rgba(100, 100, 100, 0.3);
}

.checkbacksoon p span:hover {
	text-shadow: 0px 0px 2px #686868;

	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	-o-transition: all 0.1s linear;
	-ms-transition: all 0.1s linear;
	transition: all 0.1s linear;
}

.error {
	font-size: 16px;
    width: 700px;
    max-width: 90%;
    line-height: 2em;
    letter-spacing: 1px;font-weight: 400;text-shadow: 0px 1px 1px #ffffff;
}

/* Нижняя панель навигации
================================================== */

nav {
	width: 100%;
    position: absolute;
    bottom: 0;
    margin-top: 20px;
	min-height: 50px;
	background-color: #FFFFFF;
	-moz-box-shadow:0px 2px 3px rgba(204,204,204,0.65);
	-webkit-box-shadow:0px 2px 3px rgba(204,204,204,0.65);
	box-shadow:0px 2px 3px rgba(204,204,204,0.65);
	-ms-filter:"progid:DXImageTransform.Microsoft.dropshadow(OffX=0,OffY=2,Color=#a6cccccc,Positive=true)";
	filter:progid:DXImageTransform.Microsoft.dropshadow(OffX=0,OffY=2,Color=#a6cccccc,Positive=true);
}

nav ul {
	margin: 0;
	text-align: center;
}

nav ul li {
	display: inline;
}

nav ul li:last-child {
	margin-right: 0;
}

nav ul li a {
	font-family: 'Open Sans', san-serif;
	font-size: 13px;
	color: #666666;
	text-transform: uppercase;
	padding: 0 10px;
	text-decoration: none;
	border-width:6px 6px 6px 6px;
	margin: 0 15px;
    line-height: 50px;

	-webkit-transition: all 0.2s linear;
	-moz-transition: all 0.2s linear;
	-o-transition: all 0.2s linear;
	-ms-transition: all 0.2s linear;
	transition: all 0.2s linear;
}

nav ul li a:hover, nav ul li a.selected {
	color: #FF7F00;
	text-decoration: none;
	border-width: 6px 6px 6px 6px;

	-webkit-transition: all 0.2s linear;
	-moz-transition: all 0.2s linear;
	-o-transition: all 0.2s linear;
	-ms-transition: all 0.2s linear;
	transition: all 0.2s linear;
}

nav ul li a:active {
	color: #e00000;
}

nav ul li {
    position: relative;
}

nav ul li:hover > ul {
    visibility: visible;
}

nav ul li ul {
    visibility: hidden;
    position: absolute;
    left: auto;
    right: -100px;
    top: 23px;
    width: 200px;

    background-color: #FFF;
    text-align: left;
    margin-top: 0;
    padding: 0 10px 5px;


    -moz-box-shadow:0px 2px 3px rgba(204,204,204,0.65);
	-webkit-box-shadow:0px 2px 3px rgba(204,204,204,0.65);
	box-shadow:0px 2px 3px rgba(204,204,204,0.65);
	-ms-filter:"progid:DXImageTransform.Microsoft.dropshadow(OffX=0,OffY=2,Color=#a6cccccc,Positive=true)";
	filter:progid:DXImageTransform.Microsoft.dropshadow(OffX=0,OffY=2,Color=#a6cccccc,Positive=true);
}

nav ul li ul li {
    width: auto;
    display: block !important;
}

nav ul li ul li a {
	text-decoration: none;
	border: none;
    height: 30px;
    line-height: 30px;
    width: 180px;
    display: block !important;

	-webkit-transition: all 0.2s linear;
	-moz-transition: all 0.2s linear;
	-o-transition: all 0.2s linear;
	-ms-transition: all 0.2s linear;
	transition: all 0.2s linear;
}

nav ul li ul li a:hover {
	border: none;
    background-color: #f9f9f9;

	-webkit-transition: all 0.2s linear;
	-moz-transition: all 0.2s linear;
	-o-transition: all 0.2s linear;
	-ms-transition: all 0.2s linear;
	transition: all 0.2s linear;
}

.search {
  /* устанавливаем необходимую ширину формы в зависимости от дизайна
  ** форма без проблем растягивается */
   width: 420px;

  /* кнопку отправки будем позиционировать абсолютно,
  ** поэтому необходимо это свойство */
  position: relative;margin: auto;top:25px;
}

.search input {
  /* отключаем бордюры у инпутов */
  border: none;
}

/* стили для поля ввода */
.search .input {
  /* растягиваем поле ввода на всю ширину формы */
  width: 100%;

  /* за счет верхнего (8px) и нижнего (9px) внутренних отступов
  ** регулируем высоту формы
  ** внутренний отступ справа (37px) делаем больше левого,
  ** т.к. там будет размещена кнопка отправки  */
  padding: 8px 37px 9px 15px;

  /* чтобы ширина поля ввода (100%) включала в себя внутренние отступы */
  -moz-box-sizing: border-box;
  box-sizing: border-box;

  /* добавляем внутренние тени */
  box-shadow: inset 0 0 5px rgba(0,0,0,0.1), inset 0 1px 2px rgba(0,0,0,0.3);

  /* закругляем углы */
  border-radius: 20px;

  background: #EEE;
  font: 13px Tahoma, Arial, sans-serif;
  color: #555;
  outline: none;
}

/* меняем оформление поля ввода при фокусе */
.search .input:focus {
  box-shadow: inset 0 0 5px rgba(0,0,0,0.2), inset 0 1px 2px rgba(0,0,0,0.4);
  background: #E8E8E8;
  color: #333;
}

/* оформляем кнопку отправки */
.search .submit {
  /* позиционируем кнопку абсолютно от правого края формы */
  position: absolute;
  top: 0;
  right: 0;

  width: 37px;

  /* растягиваем кнопку на всю высоту формы */
  height: 100%;

  cursor: pointer;
  background: url(https://lh4.googleusercontent.com/-b-5aBxcxarY/UAfFW9lVyjI/AAAAAAAABUg/gQtEXuPuIds/s13/go.png) 50% no-repeat;

  /* добавляем прозрачность кнопке отправки */
  opacity: 0.5;
}

/* при наведении курсора меняем прозрачность кнопки отправки */
.search .submit:hover {
  opacity: 0.8;
}

/* данное свойство необходимо для того, чтобы в браузерах
** Chrome и Safari можно было стилизовать инпуты */
input[type="search"] {
  -webkit-appearance: none;
}
/* задаем отдельные стили для браузеров IE ниже 9-й версии */
*+html .search {
  /* для IE7 подгоняем ширину под другие браузеры и добавляем правый
  ** внутренний отступ, чтобы кнопка отправки встала на свое место */
  width: 28%;
  padding: 0 52px 0 0;
}
.search .input {
  border: 1px solid #DFDFDF;
  border-top: 1px solid #B3B3B3;
  padding-top: 7px;
  background-bottom: 8px;
}
.search .input:focus {
  border: 1px solid #CFCFCF;
  border-top: 1px solid #999;
}
.search .submit {
  filter: alpha(opacity=50);
}
.search .submit:hover {
  filter: alpha(opacity=80);
}
/* Media Queries
================================================== */

/* Меньше, чем стандартные 960 (устройства и браузеры) */
@media only screen and (max-width: 1200px) {

}
@media only screen and (max-width: 959px) {

}

/* Планшетный экран размер стандартного 960 (устройства и браузеры) */
@media only screen and (min-width: 768px) and (max-width: 959px) {

}

/* Все мобильные экраны (устройства и браузеры) */
@media only screen and (max-width: 767px) {

}

/* Мобильные экраны и планшеты (устройства и браузеры) */
@media only screen and (min-width: 480px) and (max-width: 767px) {
    .checkbacksoon p span { font-size: 150px; line-height: 160px; }.error {font-size: 14px;}.search {width: 220px;}
}
/* Мобильные экраны (устройства и браузеры) */
@media only screen and (max-width: 479px) {
    .checkbacksoon p span { font-size: 150px; line-height: 160px; }.error {font-size: 14px;}.search {width: 220px;}

</style>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

</head>
<body>
<div class="comingcontainer">
    <div class="checkbacksoon">
		<p>
			<span class="go3d">‹</span>
			<span class="go3d"><i class="icon-lock"></i></span>
			<span class="go3d">›</span>

		</p>

        <p class="error">
		Похоже, вы выбрали неправильный путь.<br> Не волнуйтесь, время от времени, это случается с каждым из нас.</p>
		<div class="alert alert-info" style="margin-top:15px;">
            <p>Вы зарегистрированы? <a href="index.php">Вход.</a>
        </div>

	</div>
</div>

</body>
</html>
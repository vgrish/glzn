<?php
if (!empty($_COOKIE['sid'])) {
    session_id($_COOKIE['sid']);
}
session_start();
require_once 'classes/Auth.class.php';
if (Auth\User::isAuthorized()):
    header("Location: zakaz.php");
else :
?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Authorization</title>
    <? include "view/css.php"; ?>
  </head>

  <body>
<div class="app app-header-fixed  ">
    <div class="container w-xxl w-auto-xs">
      <form class="form-signin ajax" method="post" action="./ajax.php">
        <div class="main-error alert alert-error hide"></div>

        <h2 class="form-signin-heading">Вход в админку</h2>
        <input name="username" type="text" class="input-block-level form-control m-b" placeholder="Логин" autofocus>
        <input name="password" type="password" class="input-block-level form-control m-b" placeholder="Пароль">
        <label class="checkbox m-l-md">
          <input name="remember-me" type="checkbox" value="remember-me" checked> Запомнить меня
        </label>
        <input type="hidden" name="act" value="login">
        <button class="btn btn-large btn-primary btn-block" type="submit">Войти</button>
      </form>
    </div> <!-- /container -->
</div>
    <? include "view/js.php"; ?>
    <script src="js/ajax-form.js"></script>

  </body>
</html>
<?php endif; ?>
<?php

if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}
session_start();
require_once 'fns/classes/Auth.class.php';

?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <? include "fns/css.php"; ?>
  </head>

  <body>
<div class="app app-header-fixed  ">
    <div class="container w-xxl w-auto-xs">

      <?php if (Auth\User::isAuthorized()): ?>
    
      <h1>Your are already registered!</h1>

      <form class="ajax" method="post" action="ajax.php">
          <input type="hidden" name="act" value="logout">
          <div class="form-actions">
              <button class="btn btn-large btn-primary" type="submit">Выход</button>
          </div>
      </form>

      <?php else: ?>

      <form class="form-signin ajax" method="post" action="ajax.php">
        <div class="main-error alert alert-error hide"></div>

        <h2 class="form-signin-heading">Регистрация</h2>
        <input name="username" type="text" class="input-block-level form-control m-b" placeholder="Логин" autofocus>
        <input name="password1" type="password" class="input-block-level form-control m-b" placeholder="Пароль">
        <input name="password2" type="password" class="input-block-level form-control m-b" placeholder="Повторите пароль">
        <input type="hidden" name="act" value="register">
        <button class="btn btn-large btn-primary" type="submit">Регистрация</button>
        <div class="alert alert-info" style="margin-top:15px;">
            <p>Вы зарегистрированы? <a href="index.php">Вход.</a>
        </div>
      </form>

      <?php endif; ?>

    </div> <!-- /container -->
</div>
    <? include "fns/js.php"; ?>
    <script src="js/ajax-form.js"></script>

  </body>
</html>

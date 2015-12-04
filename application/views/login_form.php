<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">         
        <link href="<?= base_url(); ?>/css/style.css" rel="stylesheet" type="text/css"/>        
        <title>Login Form</title>
    </head>
    <body>
        <?= form_open('auth/login') ?>
        <div id="main">        
        <strong><?= $message ?></strong>
        <dl>
            <dt>ユーザ名</dt>
            <dd>
                <?= form_input('userName', $userName, 'size="20"'); ?>
            </dd>
            
            <dt>パスワード</dt>
            <dd>
                <?= form_password('passWord', $passWord, 'size="20"'); ?>
            </dd>
        </dl>        
        <?= form_hidden('nextUri', $next); ?>
        <?= form_submit('submit_login', 'ログイン'); ?>        
        </div>
    </body>
</html>

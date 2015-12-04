<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="<?= base_url()?>application/css/style.css" rel="stylesheet" type="text/css"/>
        <title></title>
    </head>
    <body>
        <div id="main">
            <?= form_open('TagController/AddTag') ?>
            <?= form_input('TagName', ''); ?>
            <?= form_submit('submit_AddNewTag', '追加') ?>
            <?= form_close() ?>
        </div>
    </body>
</html>

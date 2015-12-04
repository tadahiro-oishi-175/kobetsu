<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="<?= base_url() ?>application/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>application/css/jquery.tagit.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>application/js/ui/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="<?= base_url() ?>application/js/jquery-2.1.4.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?= base_url() ?>application/js/ui/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?= base_url() ?>application/js/tag-it.js" type="text/javascript" charset="utf-8"></script>
        <title></title>
    </head>
    <body>
        <div id="main">
            <?php foreach ($caseViewList as $caseView): ?>
                <?= $caseView ?>
            <?php endforeach; ?>
        </div>
    </body>
</html>

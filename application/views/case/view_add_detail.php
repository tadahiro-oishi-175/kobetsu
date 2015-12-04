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
            <?= form_open('CaseController/AddNewCase') ?>
            <p>案件基本情報</p>
            <table class="ReadableTable">
                <thead>
                    <tr><th>項目</th><th>設定値</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <td>案件種別</td><td><?= form_dropdown('CaseType', array('大型', 'trisan', 'メンテ'), ''); ?></td>
                    </tr>
                    <tr>
                        <td>案件ID</td><td style="width: 300px;"><?= form_input('CaseID', '', 'style="text-align: left;"') ?> </td>
                    </tr>
                    <tr>
                        <td>案件タイトル</td>
                        <td><?= form_input('CaseTitle', '', 'style="text-align: left; width: 200px;"') ?></td>
                    </tr>
                    <tr>
                        <td>対象機種</td><td></td>
                    </tr>
                    <tr>
                        <td>対象OS</td>
                        <td nowrap><?= $selectOS ?></td>
                    </tr>
                    <tr>
                        <td>要求詳細</td>
                        <td><?= anchor_popup('CaseController/AddDetail') ?></td>
                    </tr>
                    <tr>
                        <td>受注金額</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>CSW要否</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>SUT要否</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>WHQL要否</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <?= form_submit('submit_AddNewCase', '登録') ?>
            <?= form_close() ?>
        </div>
    </body>
</html>

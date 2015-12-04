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
        <link href="<?= base_url() ?>application/css/dropzone.css" rel="stylesheet" type="text/css"/>
        <script src="<?= base_url() ?>application/js/jquery-2.1.4.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?= base_url() ?>application/js/dropzone.js" type="text/javascript" charset="utf-8"></script>
        <script>
            $(document).ready(function () {
//                Dropzone.options.file = {
//                    paramName : "file"
//                    , dragover : function(e) {
//                        $("div#file").css("background-color", "#f0f0f0");
//                    }
//                    , dragleave : function(e) {
//                        $("div#file").css("background-color", "#ffffff");
//                    }
//                    , success : function(file, responseText, e) {
//                        
//                    }
//                }
                //$("div#file").dropzone({ url: "SpecController/UploadFile" });
            });
        </script>
        <style>
            #box {
                border :1px solid #000;
                width: 300px;
                height: 300px;
            }
        </style>
        <title>View Spec</title>
    </head>
    <body>
        <?php echo form_open("SpecController/EditSpec/$specObj->SpecID"); ?>
        <div id="main">

            <label>案件基本情報</label>
            <table class="InputForm">
                <tr>
                    <th nowrap>RQ No</th>
                    <td><?= $caseObj->CaseNo ?></td>
                </tr>

                <tr>
                    <th nowrap>案件名</th>
                    <td><?= $caseObj->CaseTitle ?></td>
                </tr>

                <tr>
                    <th nowrap>顧客名</th>
                    <td><?= $caseObj->CustomerName ?></td>
                </tr>
            </table>
            <br>

            <label>仕様基本情報</label>
            <table class="InputForm">
                <tr>
                    <th nowrap>仕様詳細</th>
                    <td><?= $specObj->SpecDetail ?></td>
                </tr>
                <tr>
                    <th>対象OS</th>
                    <td><?= $selectOS ?></td>
                </tr>
                <tr>
                    <th>対象言語</th>
                    <td></td>
                </tr>
                <tr>
                    <th>その他条件/コメント</th>
                    <td><?= $specObj->SpecRemark ?></td>
                </tr>
            </table>
            <br>
            <?= $specView ?>

            <?php echo form_submit('go_EditSpec', '編集'); ?>
            <?php echo form_close(); ?>
            <?= anchor_popup("SpecController/ViewAgreeDoc/$specObj->SpecID", 'agree', 'width=210mm; height=297px;') ?>
        </div>
        <div style="float: right; width: 250px; height:200px; padding-right: 20px">
            <form action="<?= base_url() ?>SpecController/UploadFile" class="dropzone"/>

        </div>

    </body>
</html>

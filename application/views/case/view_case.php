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
        <script>
            $(document).ready(function () {
                var caseLabel = "<?= ($caseObj->CaseTypeName == '大型個別') ? 'RQ' : ($caseObj->CaseTypeName == 'trisan' ? 'trisan' : 'メンテ') ?>";
                $("#caseLabel").text(caseLabel);
                //$('#tag-input').tagit();
                //$('#tag-input').tagit({placeholderText: "タグをつけよう", fieldName: "tags[]"});
                $('#tags').tagit({
                    fieldName: "tags",
                    singleField: true,
                    tagSource: ["c++", "java", "php", "javascript", "ruby", "python"],
                    readOnly: true,
                    sortable: 'handle',
                    afterTagAdded: function () {
                        //window.alert();
                        //$(this).find('li').addClass('customStyle');
                    }
                });
            });
        </script>
        <title></title>
    </head>
    <body>
        <div id="main">
            <?= form_open('CaseController/EditCase/' . $caseObj->CaseID) ?>
            <table class="InputForm">
                <tr>
                    <th>案件管理番号</th>
                    <td><?= $caseObj->CaseSeqNo ?></td>
                </tr>
            </table>
            <br>
            <table class="InputForm">
                <tr>
                    <th>案件種別</th>
                    <td><?= $caseObj->CaseTypeName ?></td>
                </tr>
                <tr>
                    <th nowrap>案件番号</th>
                    <td><label id="caseLabel"></label><?= $caseObj->CaseNo ?></td>
                </tr>

                <tr>
                    <th nowrap>案件名</th>
                    <td><?= $caseObj->CaseTitle ?></td>
                </tr>

                <tr>
                    <th nowrap>顧客名</th>
                    <td><?= $caseObj->CustomerName ?></td>
                </tr>
                
                <tr>
                    <th>タグ</th>
                    <td><?= $tags ?></td>
                </tr>
            </table>

            <?= form_submit('go_EditCase', '編集') ?>
            <?= form_close() ?>

            <?= form_open('CaseController/DeleteCase/' . $caseObj->CaseID) ?>
            <?= form_submit('submit_EditCase', '削除') ?>
            <?= form_close() ?>
        </div>
    </body>
</html>

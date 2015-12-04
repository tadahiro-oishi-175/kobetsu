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
                $("#caseType").change(function () {
                    var type = $("#caseType option:selected").val();
                    var caseLabel = "";
                    switch (type) {
                        case "1":
                            caseLabel = "RQ";
                            break;
                        case "2":
                            caseLabel = "@trisan";
                            break;
                        default:
                            break;
                    }
                    $("#caseLabel").text(caseLabel);
                });
                $('#tag-input').tagit({
                    placeholderText: 'EnterかTabでタグ追加',
                    fieldName: "tags",
                    singleField: true,
                    tagSource: [<?= $tagSource ?>],
                    readOnly: false,
                    sortable: 'handle',
                    allowDuplicates: false,
                    allowSpaces: true,
                    showAutocompleteOnFocus: true,
                    afterTagAdded: function () {
                        window.alert();
                        //$(this).find('li').addClass('customStyle');
                    }
                });
            });
        </script>
        <title>要求詳細の入力</title>
    </head>
    <body>
        <div id="main">
            <?= form_open('CaseController/AddNewCase') ?>
            <table class="InputForm">
                <tr>
                    <th>案件管理番号</th>
                    <td>※自動採番されます</td>
                </tr>
            </table>
            <br>
            <table class="InputForm">
                <tr>
                    <th>案件種別</th>
                    <td><?= form_dropdown('CaseTypeID', $caseTypeNames, '', 'id ="caseType"') ?></td>
                </tr>
                <tr>
                    <th nowrap>案件番号</th>
                    <td><label id="caseLabel">RQ</label><?= form_input('CaseNo', '') ?></td>
                </tr>

                <tr>
                    <th nowrap>案件名</th>
                    <td><?= form_input('CaseTitle', '') ?></td>
                </tr>

                <tr>
                    <th nowrap>顧客名</th>
                    <td><?= form_input('CustomerName', '') ?></td>
                </tr>

                <tr>
                    <th>タグ</th>
                    <td><ul id="tag-input"></ul></td>
                </tr>
            </table>
            <?= form_submit('submit_AddNewCase', '登録') ?>
            <?= form_close() ?>
        </div>
    </body>
</html>

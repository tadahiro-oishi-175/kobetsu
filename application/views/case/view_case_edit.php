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
                $('#tags').tagit({
                    fieldName: "tags",
                    singleField: true,
                    tagSource: [<?= $tagSource ?>],
                    readOnly: false,
                    sortable: 'handle',
                    allowDuplicates: false,
                    allowSpaces: true,
                    showAutocompleteOnFocus: true,
                    afterTagAdded: function () {
                        //$(this).find('li').addClass('customStyle');
                    }
                });
            });
        </script>
        <title></title>
    </head>
    <body>
        <div id="main">
            <?= form_open("CaseController/EditCase/$caseObj->CaseID") ?>
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
                    <td><?= form_dropdown('CaseTypeID', $caseTypeNames, $caseObj->CaseTypeID, 'id ="caseType"'); ?></td>
                </tr>
                <tr>
                    <th nowrap>案件番号</th>
                    <td><label id="caseLabel">RQ</label><?= form_input('CaseNo', $caseObj->CaseNo, 'style="text-align: left;"') ?></td>
                </tr>

                <tr>
                    <th nowrap>案件名</th>
                    <td><?= form_input('CaseTitle', $caseObj->CaseTitle, 'style="text-align: left; width: 200px;"') ?></td>
                </tr>

                <tr>
                    <th nowrap>顧客名</th>
                    <td><?= form_input('CustomerName', '') ?></td>
                </tr>

                <tr>
                    <th>タグ</th>
                    <td><?= $tags ?></td>
                </tr>
            </table>
            <?= form_submit('submit_EditCase', '登録') ?>
            <?= form_close() ?>
        </div>
    </body>
</html>

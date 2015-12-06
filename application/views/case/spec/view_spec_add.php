<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>    
    <head>
        <meta charset="UTF-8">        
        <link href="<?= base_url(); ?>application/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url(); ?>application/css/multi-select.css" rel="stylesheet" type="text/css">
        <script src="<?= base_url() ?>application/js/jquery-2.1.4.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?= base_url() ?>application/js/jquery.multi-select.js" type="text/javascript" charset="utf-8"></script>
        <script>
            $(document).ready(function () {
                $('#selectProduct').multiSelect({
                    keepOrder: false,
                    selectableHeader: "<div class='header_item'>機種リスト</div>",
                    selectionHeader: "<div class='header_item'>対象機種</div>",
                });
                
                $('.IfMultiProduct')
            });
        </script>
        <title>Add Spec</title>
    </head>
    <body>        
        <div id="main">
            <strong><?= validation_errors(); ?></strong>
            <?= form_open("SpecController/AddNewSpec/$caseObj->CaseID"); ?>
            <?= form_hidden('CaseID', $caseObj->CaseID) ?> 

            <label>案件基本情報</label>
            <?= $caseBasicView ?>
            <br>

            <label>仕様基本情報</label>
            <table class="InputForm">
                <tr>
                    <th nowrap>仕様詳細</th>
                    <td><?= form_textarea('SpecDetail', '') ?></td>
                </tr>
                <tr>
                    <th>対象機種</th>
                    <td><?= form_multiselect('targetProduct[]', $allProductNames, $supportedProductIDs, 'id="selectProduct"') ?></td>
                </tr>
                <tr>
                    <th>対象OS</th>
                    <td><?= $selectOS ?></td>
                </tr>
                <tr>
                    <th>対象PDL</th>
                    <td><?= $selectPDL ?></td>
                </tr>
                <tr>
                    <th>対象言語</th>
                    <td></td>
                </tr>        
                <tr>
                    <th>WHQL取得の有無</th>
                    <td>要<?= form_radio('SpecWHQL', 1, $reqObj->ReqWHQL ? TRUE : FALSE) ?> 　不要<?= form_radio('SpecWHQL', 0, $reqObj->ReqWHQL ? FALSE : TRUE); ?></td>
                </tr>

                <tr>
                    <th>インストーラ対応の有無</th>
                    <td>要<?= form_radio('SpecCSW', 1, $reqObj->ReqCSW ? TRUE : FALSE) ?> 　不要<?= form_radio('SpecCSW', 0, $reqObj->ReqCSW ? FALSE : TRUE); ?></td>
                </tr>

                <tr>
                    <th>MakeDisk対応の有無</th>
                    <td>要<?= form_radio('SpecSUT', 1, $reqObj->ReqSUT ? TRUE : FALSE) ?> 　不要<?= form_radio('SpecSUT', 0, $reqObj->ReqSUT ? FALSE : TRUE); ?></td>
                </tr>

                <tr>
                    <th>Readme対応の有無</th>
                    <td>要<?= form_radio('SpecReadme', 1, $reqObj->ReqReadme ? TRUE : FALSE) ?> 　不要<?= form_radio('SpecReadme', 0, $reqObj->ReqReadme ? FALSE : TRUE); ?></td>
                </tr>
                <tr>
                    <th>その他条件/コメント</th>
                    <td><?= form_textarea('SpecRemark', '') ?></td>
                </tr>
            </table>
            <?php echo form_submit('submit_AddNewSpec', '登録'); ?>
            <?php echo form_close(); ?> 
        </div>
    </body>
</html>

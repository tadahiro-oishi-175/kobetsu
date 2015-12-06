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
        <script src="<?= base_url() ?>application/js/jquery-2.1.4.min.js" type="text/javascript" charset="utf-8"></script>
        <title>Add Requirement</title>
    </head>
    <body>        
        <div id="main">
            <strong><?= validation_errors(); ?></strong>
            <?= form_open("SpecController/AddNewSpec/$caseObj->CaseID"); ?>
            <?= form_hidden('CaseID', $caseObj->CaseID) ?> 

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
                    <td><?= form_textarea('SpecDetail', '') ?></td>
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
                    <th>その他条件/コメント</th>
                    <td><?= form_textarea('SpecRemark', '') ?></td>
                </tr>
            </table>
            <?= $specView ?>
            <?php echo form_submit('submit_AddNewSpec', '登録'); ?>
            <?php echo form_close(); ?> 
        </div>
    </body>
</html>

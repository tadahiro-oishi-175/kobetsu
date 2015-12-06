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
        <script src="<?= base_url() ?>application/js/jquery-2.1.4.min.js" type="text/javascript" charset="utf-8"></script>
        <title>View Requirement</title>
    </head>
    <body>
        <?php echo form_open("RequirementController/EditRequirement/$reqObj->RequirementID"); ?>
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
            <label>要求詳細</label>
            <table class="InputForm">
                <tr>
                    <th nowrap>要求内容</th>
                    <td><?= $reqObj->RequirementInfo ?></td>
                </tr>

                <tr>
                    <th nowrap>要求背景</th>
                    <td><?= $reqObj->RequirementDetail ?></td>
                </tr>

                <tr>
                    <th>対象機種</th>
                    <td><?= $supportedProducts ?></td>
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
                    <td><?= $reqObj->ReqWHQL ? '要' : '不要' ?></td>
                </tr>

                <tr>
                    <th>インストーラ対応の有無</th>
                    <td><?= $reqObj->ReqCSW ? '要' : '不要' ?></td>
                </tr>

                <tr>
                    <th>MakeDisk対応の有無</th>
                    <td><?= $reqObj->ReqSUT ? '要' : '不要' ?></td>
                </tr>

                <tr>
                    <th>Readme対応の有無</th>
                    <td><?= $reqObj->ReqReadme ? '要' : '不要' ?></td>
                </tr>

                <tr>
                    <th>その他条件/コメント</th>
                    <td><?= $reqObj->ReqRemark ?></td>
                </tr>
            </table>
            <?php echo form_submit('go_EditRequirement', '編集'); ?>
            <?php echo form_close(); ?>
        </div>
    </body>
</html>

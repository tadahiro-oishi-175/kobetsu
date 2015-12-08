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
        <style>
            .track-progress[data-steps="3"] li { width: 20%; }
            .track-progress[data-steps="4"] li { width: 18%; }
            .track-progress[data-steps="5"] li { width: 15%; }
            .track-progress[data-steps="6"] li { width: 15%; }

            .track-progress {
                margin: 0;
                padding: 0;
                overflow: hidden;
            }

            .track-progress li > span {
                display: block;

                color: #999;
                font-weight: bold;
                text-transform: uppercase;
            }

            .track-progress li.done > span {
                color: #666;
                background-color: #ccc;
            }

            .track-progress li {
                list-style-type: none;
                display: inline-block;

                position: relative;
                margin: 0;
                padding: 0;

                text-align: center;
                line-height: 30px;
                height: 30px;

                background-color: #f0f0f0;
            }
            .track-progress li > span:after,
            .track-progress li > span:before {
                content: "";
                display: block;
                width: 0px;
                height: 0px;

                position: absolute;
                top: 0;
                left: 0;

                border: solid transparent;
                border-left-color: #f0f0f0;
                border-width: 15px;
            }

            .track-progress li > span:after {
                top: -5px;
                z-index: 1;
                border-left-color: white;
                border-width: 20px;
            }

            .track-progress li > span:before {
                z-index: 2;
            }
            .track-progress li.done + li > span:before {
                border-left-color: #ccc;
            }

            .track-progress li:first-child > span:after,
            .track-progress li:first-child > span:before {
                display: none;
            }
            .track-progress li:first-child i,
            .track-progress li:last-child i {
                display: block;
                height: 0;
                width: 0;

                position: absolute;
                top: 0;
                left: 0;

                border: solid transparent;
                border-left-color: white;
                border-width: 15px;
            }

            .track-progress li:last-child i {
                left: auto;
                right: -15px;

                border-left-color: transparent;
                border-top-color: white;
                border-bottom-color: white;
            }
        </style>
    </head>
    <body>
        <?php echo form_open("RequirementController/EditRequirement/$reqObj->RequirementID"); ?>
        <ol class="track-progress" data-steps="4">
            <li class="done">
                <span>1. First Step</span>
                <i></i>
            </li><!--
            --><li class="done">
                <span>2. Second Step</span>
            </li><!--
            --><li class="done">
                <span><a href="#">3. Third Step</a></span>
                <i></i>
            </li><!--
            --><li>
                <span>Final Details2</span>
                <i></i>
            </li>
        </ol>
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

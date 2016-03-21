<title>要求検討</title>
<script></script>
<?= $progress ?>
<div id="main">
    <div id="submain">
        <?php echo form_open("RequirementController/EditRequirement/$reqObj->RequirementID"); ?>
        <?= $caseBasicView ?>
        <?= $caseInfoView ?>
        
        <label>要求詳細</label><?php echo form_submit('go_EditRequirement', '編集'); ?>
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
                <td><?= $selectLang ?></td>
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
        <?= form_close(); ?>
    </div>
    <div id="DropZone">
        <div id="DocDropzone">
            <label>要求検討資料</label>
            <form action="<?= base_url() ?>RequirementController/UploadHandOffDoc/<?= $reqObj->RequirementID ?>" class="dropzone"/>
        </div>
        <div id="DocList">
            <label>登録済みファイル (ドラッグでソート可能)</label>
            <?= $docsView ?>
        </div>
    </div>
</div>

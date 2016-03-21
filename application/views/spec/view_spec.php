<title>仕様詳細</title>
<script>
    $(document).ready(function () {
        var ProdCount = "<?= $productCount ?>";
        if (ProdCount > 1) {
            $(".IfMultiProduct").show();
            $(".IfNotMultiProduct").hide();
        } else {
            $(".IfMultiProduct").hide();
            $(".IfNotMultiProduct").show();
        }
        Dropzone.options.file = {
            paramName: "file",
            parallelUploads: 1,
            dictMaxFilesExceeded: "一度にアップロードできるのは1ファイルまでです"
        }
    });
</script>
<?= $progress ?>
<div id="main">
    <?= form_open("SpecController/EditSpec/$specObj->SpecID"); ?>
    <div id="submain">
        <?= $caseBasicView ?>
        <?= $caseInfoView ?>
        <?= $reqInfoView ?>
        <label>仕様基本情報</label><?= form_submit('go_EditSpec', '編集'); ?>
        <table class="InputForm">
            <tr>
                <th nowrap>仕様詳細</th>
                <td><?= $specObj->SpecDetail ?></td>
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
                <td><?= $specObj->SpecWHQL ? '要' : '不要' ?></td>
            </tr>
            <tr>
                <th>インストーラ対応の有無</th>
                <td><?= $specObj->SpecCSW ? '要' : '不要' ?></td>
            </tr>

            <tr>
                <th>MakeDisk対応の有無</th>
                <td><?= $specObj->SpecSUT ? '要' : '不要' ?></td>
            </tr>

            <tr>
                <th>Readme対応の有無</th>
                <td><?= $specObj->SpecReadme ? '要' : '不要' ?></td>
            </tr>
            <tr>
                <th>その他条件/コメント</th>
                <td><?= $specObj->SpecRemark ?></td>
            </tr>
        </table>
        <?= form_close(); ?>
        <hr>
        <?= form_open("SpecController/PreviewAgreeDoc/$specObj->SpecID"); ?>
        <?= form_submit('edit_AgreeDoc', '個別対応確認書プレビュー'); ?>
        <?= form_close(); ?>
    </div>
    <div id="DropZone">
        <div id="DocDropzone">
            <label>個別対応確認書</label>
            <form action="<?= base_url() ?>SpecController/UploadAgreeDoc/<?= $specObj->SpecID ?>" class="dropzone"/>
        </div>
        <div id="DocList">
            <label>登録済みファイル (ドラッグでソート可能)</label>
            <?= $docsView ?>
        </div>
    </div>
</div>

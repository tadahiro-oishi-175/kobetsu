<title>案件詳細</title>
<script>
    $(document).ready(function () {
        var caseLabel = "<?= ($caseObj->CaseTypeName == '大型個別') ? 'RQ' : ($caseObj->CaseTypeName == 'trisan' ? 'trisan' : 'AR') ?>";
        $("#caseLabel").text(caseLabel);
        $("#tags").tagit({
            fieldName: "tags",
            singleField: true,
            tagSource: ["c++", "java", "php", "javascript", "ruby", "python"],
            readOnly: true,
            sortable: 'handle',
            afterTagAdded: function () {
                //window.alert();
                //$(this).find('li').addClass('customStyle');
            },
            onTagClicked: function () {
                window.alert();
            }
        });
        Dropzone.options.file = {
            paramName: "file",
            parallelUploads: 1,
            dictMaxFilesExceeded: "一度にアップロードできるのは1ファイルまでです"
        }
    });
</script>

<?= $progress ?>
<div id="main">
    <div id="submain">
        <?= form_open('CaseController/EditCase/' . $caseObj->CaseID) ?>
        <label>案件管理情報</label><?= form_submit('go_EditCaseBasicInfo', '編集') ?>
        <table class="InputForm">
            <tr>
                <th>案件管理番号</th>
                <td><?= $caseObj->CaseSeqNo ?></td>
            </tr>
            <tr>
                <th>案件担当者名</th>
                <td><?= $workerName ?></td>
            </tr>
            <tr>
                <th>案件ステイタス</th>
                <td><?= $statusName ?></td>
            </tr>
        </table>
        <?= form_close(); ?>
        <br>
        <?= form_open('CaseController/EditCase/' . $caseObj->CaseID) ?>
        <label>案件基本情報</label><?= form_submit('go_EditCaseDetailInfo', '編集') ?>
        <table class="InputForm">
            <tr>
                <th>案件種別</th>
                <td><?= $caseObj->CaseTypeName ?></td>
            </tr>
            <tr>
                <th>案件番号</th>
                <td><label id="caseLabel"></label><?= $caseObj->CaseNo ?></td>
            </tr>

            <tr>
                <th>案件名</th>
                <td><?= $caseObj->CaseTitle ?></td>
            </tr>

            <tr>
                <th>顧客名</th>
                <td><?= $caseObj->CustomerName ?></td>
            </tr>
            <tr>
                <th>見積回答納期</th>
                <td><?= $caseObj->ResponseDeadline ?></td>
            </tr>
            <tr>
                <th>タグ</th>
                <td><?= $tags ?></td>
            </tr>
        </table>
        <?= form_close(); ?>

        <?= form_open('CaseController/DeleteCase/' . $caseObj->CaseID) ?>
        <?= form_submit('submit_DeleteCase', 'この案件を削除', 'id="deleteCase"') ?>
        <?= form_close() ?>
    </div>
    <div id="DropZone">
        <div id="DocDropzone">
            <label>要求資料を登録</label>
            <form action="<?= base_url() ?>CaseController/UploadCaseDoc/<?= $caseObj->CaseID ?>" class="dropzone"/>
        </div>
        <div id="DocList">
            <label>登録済みファイル (ドラッグでソート可能)</label>
            <?= $docsView ?>
        </div>
    </div>
</div>
</body>


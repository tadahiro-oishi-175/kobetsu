<title>案件の編集</title>
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
            placeholderText: 'EnterかTabでタグ追加',
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
<?= $progress ?>
<div id="main">
    <div id="submain">
        <?= form_open("CaseController/EditCase/$caseObj->CaseID") ?>
        <strong><?= validation_errors(); ?></strong>
        <label>案件管理情報</label><?= form_submit('submit_EditCase', '保存') ?>
        <table class="InputForm">
            <tr>
                <th class="requiredItem">案件管理番号</th>
                <td><?= form_input('CaseSeqNo', $caseObj->CaseSeqNo, 'class="inputTextShort"') ?></td>
            </tr>
            <tr>
                <th>案件担当者名</th>
                <td><?= form_dropdown('WorkerID', $workerNames, $caseObj->WorkerID) ?></td>
            </tr>
            <tr>
                <th>案件ステイタス</th>
                <td><?= $statusName ?></td>
            </tr>
        </table>
        <br><br>
        <label>案件基本情報</label><?= form_submit('submit_EditCase', '保存') ?>
        <table class="InputForm">
            <tr>
                <th>案件種別</th>
                <td><?= form_dropdown('CaseTypeID', $caseTypeNames, $caseObj->CaseTypeID, 'id ="caseType"'); ?></td>
            </tr>
            <tr>
                <th class="requiredItem">案件番号</th>
                <td><label id="caseLabel">RQ</label><?= form_input('CaseNo', $caseObj->CaseNo, 'class="inputTextShort"') ?></td>
            </tr>

            <tr>
                <th class="requiredItem">案件名</th>
                <td><?= form_input('CaseTitle', $caseObj->CaseTitle) ?></td>
            </tr>

            <tr>
                <th>顧客名</th>
                <td><?= form_input('CustomerName', '') ?></td>
            </tr>
            <tr>
                <th>見積回答納期</th>
                <td><?= form_input('ResponseDeadline', '', 'id="date", class="inputTextShort"') ?></td>
            </tr>
            <tr>
                <th>タグ</th>
                <td backg><?= $tags ?></td>
            </tr>
        </table>
        <?= form_close() ?>
    </div>
</div>

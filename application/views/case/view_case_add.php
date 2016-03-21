<title>要求詳細の入力</title>
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
                case "3":
                    caseLabel = "AR";
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
<?= $progress ?>
<div id="main">
    <strong><?= validation_errors(); ?></strong>
    <div id="submain">
        <?= form_open('CaseController/AddNewCase') ?>
        <label>案件管理情報</label>
        <table class="InputForm">
            <tr>
                <th class="requiredItem">案件管理番号</th>
                <td><?= form_input('CaseSeqNo', $nextCaseSeqNo, 'class="inputTextShort" required') ?></td>
            </tr>
            <tr>
                <th>案件担当者名</th>
                <td><?= form_dropdown('WorkerID', $workerNames, '') ?></td>
            </tr>
        </table>
        <br>
        <label>案件基本情報</label>
        <table class="InputForm">
            <tr>
                <th>案件種別</th>
                <td><?= form_dropdown('CaseTypeID', $caseTypeNames, '', 'id ="caseType"') ?></td>
            </tr>
            <tr>
                <th class="requiredItem">案件番号</th>
                <td><label id="caseLabel">RQ</label><?= form_input('CaseNo', '', 'class="inputTextShort" required') ?></td>
            </tr>

            <tr>
                <th class="requiredItem">案件名</th>
                <td><?= form_input('CaseTitle', '', 'required') ?></td>
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
                <td><ul id="tag-input" class="InputTag"></ul></td>
            </tr>
        </table>
        <?= form_submit('submit_AddNewCase', '登録') ?>
        <?= form_close() ?>
    </div>
</div>
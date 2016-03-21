<title>仕様登録</title>        
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
<?= $progress ?>
<div id="main">
    <?= form_hidden('CaseID', $caseObj->CaseID) ?>
    <?= form_open("SpecController/AddNewSpec/$caseObj->CaseID"); ?>
    <div id="submain">
        <strong><?= validation_errors(); ?></strong>
        <?= $caseBasicView ?>
        <?= $caseInfoView ?>
        <?= $reqInfoView ?>
        <label>仕様基本情報</label>　<strong>※要求検討の情報をコピーしています。要求から変更がある場合は変更してください。</strong>
        <table class="InputForm">
            <tr>
                <th class="requiredItem">仕様詳細</th>
                <td><?= form_textarea('SpecDetail', '', 'required') ?></td>
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
                <td><?= $selectLang ?></td>
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
</div>
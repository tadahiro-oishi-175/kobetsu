<title>要求編集</title>
<script>
    $(document).ready(function () {
        $('#selectProduct').multiSelect({
            keepOrder: false,
            selectableHeader: "<div class='header_item'>機種リスト</div>",
            selectionHeader: "<div class='header_item'>対象機種</div>",
        });
    });
</script>
<?= $progress ?>
<div id="main">
    <div id="submain">
        <strong><?= validation_errors(); ?></strong>
        <?php echo form_open("RequirementController/EditRequirement/$reqObj->RequirementID"); ?>
        <?= $caseBasicView ?>
        <?= $caseInfoView ?>
        <label>要求詳細</label>
        <table class="InputForm">
            <tr>
                <th class="requiredItem">要求内容</th>
                <td><?= form_textarea('RequirementInfo', $reqObj->RequirementInfo) ?></td>
            </tr>

            <tr>
                <th nowrap>要求背景</th>
                <td><?= form_textarea('RequirementDetail', $reqObj->RequirementDetail) ?></td>
            </tr>

            <tr>
                <th class="requiredItem">対象機種</th>
                <td><?= form_multiselect('targetProduct[]', $allProductNames, $supportedProductIDs, 'id="selectProduct"') ?></td>
            </tr>

            <tr>
                <th class="requiredItem">対象OS</th>
                <td><?= $selectOS ?></td>
            </tr>

            <tr>
                <th class="requiredItem">対象PDL</th>
                <td><?= $selectPDL ?></td>
            </tr>

            <tr>
                <th class="requiredItem">対象言語</th>
                <td><?= $selectLang ?></td>
            </tr>

            <tr>
                <th>WHQL取得の有無</th>
                <td>要<?= form_radio('ReqWHQL', 1, $reqObj->ReqWHQL ? TRUE : FALSE); ?>　不要<?= form_radio('ReqWHQL', 0, $reqObj->ReqWHQL ? FALSE : TRUE); ?></td>
            </tr>

            <tr>
                <th>インストーラ対応の有無</th>
                <td>要<?= form_radio('ReqCSW', 1, $reqObj->ReqCSW ? TRUE : FALSE); ?>　不要<?= form_radio('ReqCSW', 0, $reqObj->ReqCSW ? FALSE : TRUE); ?></td>
            </tr>

            <tr>
                <th>MakeDisk対応の有無</th>
                <td>要<?= form_radio('ReqSUT', 1, $reqObj->ReqSUT ? TRUE : FALSE); ?>　不要<?= form_radio('ReqSUT', 0, $reqObj->ReqSUT ? FALSE : TRUE); ?></td>
            </tr>

            <tr>
                <th>Readme対応の有無</th>
                <td>要<?= form_radio('ReqReadme', 1, $reqObj->ReqReadme ? TRUE : FALSE); ?>　不要<?= form_radio('ReqReadme', 0, $reqObj->ReqReadme ? FALSE : TRUE); ?></td>
            </tr>

            <tr>
                <th>その他条件/コメント</th>
                <td><?= form_textarea('ReqRemark', $reqObj->ReqRemark) ?></td>
            </tr>
        </table>
        <?php echo form_submit('submit_EditRequirement', '保存'); ?>
        <?php echo form_close(); ?> 
    </div>
</div>

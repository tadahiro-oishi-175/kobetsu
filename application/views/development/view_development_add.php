<title>開発情報登録</title>
<?= $progress ?>
<div id="main">
    <?php echo form_open("DevelopmentController/AddNewDevelopment/$specObj->SpecID"); ?>
    <div id="submain">
        <?= $caseBasicView ?>
        <?= $caseInfoView ?>
        <?= $reqInfoView ?>
        <?= $specInfoView ?>
        <?= $prodView ?>
        <label>開発情報</label>
        <table class="InputForm">
            <tr>
                <th nowrap>開発委託先</th>
                <td><?= form_dropdown('DeveloperID', $developers, '') ?></td>
            </tr>
        </table>
        <?php echo form_submit('submit_AddNewDevelopment', '登録'); ?>
        <?php echo form_close(); ?>
    </div>
</div>
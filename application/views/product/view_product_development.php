<div style="margin-top: 15px;" class="IfMultiProduct">
    <?= form_open("SpecController/EditSpecDevelopment/$specObj->SpecID/$prodObj->ProductID"); ?>
    <label>仕様詳細情報:<?= $prodObj->ProductName ?></label><?php echo form_submit('go_EditSpecDevelopment', '編集'); ?>
    <table class="InputForm">
        <tr>
            <th>対象機種</th>
            <td><?= $prodObj->ProductName ?></td>
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
            <th>ドライバーバージョン</th>
            <td><?= isset($devObj)? $devObj->DevDriverVersion : ''?></td>
        </tr>
    </table>
    <?= form_close() ?>
</div>
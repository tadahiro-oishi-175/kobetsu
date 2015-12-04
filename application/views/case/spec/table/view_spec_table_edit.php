<div style="margin-top: 15px;">
    <?= form_hidden('SpecID', $specObj->SpecID) ?>
    <label>仕様詳細</label>
    <table class="InputForm">
        <tr>
            <th>対象機種</th>
            <td></td>
        </tr>

        <tr>
            <th>WHQL取得の有無</th>
            <td>要<?= form_radio("SpecWHQL", 1, $specObj->SpecWHQL ? TRUE : FALSE); ?>　不要<?= form_radio("SpecWHQL", 0, $specObj->SpecWHQL ? FALSE : TRUE); ?></td>
        </tr>

        <tr>
            <th>インストーラ対応の有無</th>
            <td>要<?= form_radio("SpecCSW", 1, $specObj->SpecCSW ? TRUE : FALSE); ?>　不要<?= form_radio("SpecCSW", 0, $specObj->SpecCSW ? FALSE : TRUE); ?></td>
        </tr>

        <tr>
            <th>MakeDisk対応の有無</th>
            <td>要<?= form_radio("SpecSUT", 1, $specObj->SpecSUT ? TRUE : FALSE); ?>　不要<?= form_radio("SpecSUT", 0, $specObj->SpecSUT ? FALSE : TRUE); ?></td>
        </tr>

        <tr>
            <th>Readme対応の有無</th>
            <td>要<?= form_radio("SpecReadme", 1, $specObj->SpecReadme ? TRUE : FALSE); ?>　不要<?= form_radio("SpecReadme", 0, $specObj->SpecReadme ? FALSE : TRUE); ?></td>
        </tr>
    </table>
</div>
<div style="margin-top: 15px;">
    <label>仕様詳細情報</label>
    <table class="InputForm">
        <tr>
            <th>対象機種</th>
            <td></td>
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
    </table>
</div>
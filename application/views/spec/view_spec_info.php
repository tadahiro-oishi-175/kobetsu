<div class="DoneInfo">
    <label>仕様基本情報</label>
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
        <tr>
            <th>その他条件/コメント</th>
            <td><?= $specObj->SpecRemark ?></td>
        </tr>
    </table>
</div>
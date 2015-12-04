<div style="margin-top: 15px;">
    <label>仕様詳細情報</label>
    <table class="InputForm">
        <tr>
            <th>対象機種</th>
            <td></td>
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
    </table>
</div>
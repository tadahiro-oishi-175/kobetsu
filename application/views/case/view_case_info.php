<div class="DoneInfo">
    <label>案件基本情報</label>
    <table class="InputForm">
        <tr>
            <th>案件種別</th>
            <td><?= $caseTypeName ?></td>
        </tr>
        <tr>
            <th nowrap>案件番号</th>
            <td><label id="caseLabel"></label><?= $caseObj->CaseNo ?></td>
        </tr>

        <tr>
            <th nowrap>案件名</th>
            <td><?= $caseObj->CaseTitle ?></td>
        </tr>
        <tr>
            <th nowrap>顧客名</th>
            <td><?= $caseObj->CustomerName ?></td>
        </tr>
        <tr>
            <th nowrap>見積回答納期</th>
            <td><?= $caseObj->ResponseDeadline ?></td>
        </tr>
    </table>
</div>


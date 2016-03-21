<div class="DoneInfo">
    <label>案件管理情報</label>
    <table class="InputForm">
        <tr>
            <th nowrap>案件管理番号</th>
            <td><?= $caseObj->CaseSeqNo ?></td>
        </tr>
        <tr>
            <th nowrap>案件担当者名</th>
            <td><?= $workerName ?></td>
        </tr>
        <tr>
            <th nowrap>案件ステイタス</th>
            <td><?= $statusName ?></td>
        </tr>
    </table>
</div>
<div>
    <table id="caseTable">
        <tbody>
            <tr class="caseDataRow">
                <td colspan="5" id="caseTitleCell"><?= anchor("CaseController/ViewCaseDetail/$caseObj->CaseID", "■$caseTypeLabel $caseObj->CaseNo") ?>:<span><?= $caseObj->CaseTitle ?></span></td>
                <td colspan="3" id="customerNameCell">顧客名: <?= $caseObj->CustomerName ? $caseObj->CustomerName : '' ?></td>
                <td colspan="2" id="caseRankCell">Rank</td>
            <tr class="caseDataRow">
                <td id="status"><?= $statusName ?></td>
                <td id="product">Kisyu2/Seito2</td>
                <td id="pdl">ART/EX</td>
                <td id="os">x86, x64</td>
                <td id="csw">無</td>
                <td id="sut">無</td>
                <td id="whql">non WHQL</td>
                <td id="worker"><?= $workerName ?></td>
                <td id="regdate"><?= $caseObj->RegisteredDate ? $caseObj->RegisteredDate : '' ?></td>
                <td id="findate">2016/03/30</td>
            </tr>
            <tr class="caseTagRow">
                <td colspan="10"><?= $tags ?></td>
            </tr>
        </tbody>
    </table>
</div>
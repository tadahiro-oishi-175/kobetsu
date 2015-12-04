<div id="case">
    <?= anchor("CaseController/ViewCaseDetail/$caseObj->CaseID", "$caseTypeLabel $caseObj->CaseNo") ?>:<?= $caseObj->CaseTitle ?>
    <div>
        <ul>
            <li style="display: <?= ($reqObj == null) ? 'block' : 'none' ?>;"><?= anchor("RequirementController/AddNewRequirement/$caseObj->CaseID", '要求') ?></li>
            <li style="display: <?= ($reqObj != null) ? 'block' : 'none' ?>;"><?= anchor("RequirementController/ViewRequirementDetail/$reqObj->RequirementID", '要求') ?></li>
            <li style="display: <?= ($reqObj != null && $specObj == null) ? 'block' : 'none' ?>;"><?= anchor("SpecController/AddNewSpec/$caseObj->CaseID", '仕様') ?></li>
            <li style="display: <?= ($reqObj != null && $specObj != null) ? 'block' : 'none' ?>;"><?= ($specObj != null) ? anchor("SpecController/ViewSpecDetail/$specObj->SpecID", '仕様') : '' ?></li>
            <li class="not_registered"><?= anchor("CaseController/AddNewCaseDetail/$caseObj->CaseID/Dev", '開発') ?></li>
            <li class="registered"><?= anchor("CaseController/ViewCaseDetail/$caseObj->CaseID/Dev", '開発') ?></li>
            <li class="not_registered"><?= anchor("CaseController/AddNewCaseDetail/$caseObj->CaseID/Dev", 'リリース') ?></li>
            <li class="registered"><?= anchor("CaseController/ViewCaseDetail/$caseObj->CaseID/Dev", 'リリース') ?></li>
            <li class="not_registered"><?= anchor("CaseController/AddNewCaseDetail/$caseObj->CaseID/Dev", '点検') ?></li>
            <li class="registered"><?= anchor("CaseController/ViewCaseDetail/$caseObj->CaseID/Dev", '点検') ?></li>
            <li class="not_registered"><?= anchor("CaseController/AddNewCaseDetail/$caseObj->CaseID/Dev", '成果物') ?></li>
            <li class="registered"><?= anchor("CaseController/ViewCaseDetail/$caseObj->CaseID/Dev", '成果物') ?></li>
        </ul>
    </div>
</div>
<div style="display: inline-block; text-align: justify">    
    <?php foreach ($PDLObjs as $PDLObj): ?>
        <label><?= form_checkbox('targetPDL[]', $PDLObj->PDLID, in_array($PDLObj->PDLID, $supportedPDLID) ? TRUE : FALSE) ?><?= $PDLObj->PDLName?></label>
    <?php endforeach; ?>
</div>
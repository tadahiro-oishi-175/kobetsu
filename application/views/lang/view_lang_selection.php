<div style="display: inline-block; text-align: justify">    
    <?php foreach ($LangObjs as $LangObj): ?>
        <label><?= form_checkbox('targetLang[]', $LangObj->LangID, FALSE) ?><?= $LangObj->LangName ?></label>
    <?php endforeach; ?>
</div>
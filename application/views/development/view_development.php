<title>開発詳細</title>
<?= $progress ?>
<div id="main">
    <div id="submain">
        <?php echo form_open("DevelopmentController/EditDevelopment/$devObj->DevelopmentID"); ?>
        <?= $caseBasicView ?>
        <?= $caseInfoView ?>
        <?= $reqInfoView ?>
        <?= $specInfoView ?>
        <?php echo form_close(); ?>
    </div>
</div>

<?php

$config = array(
    'CaseValidation' => array(
        array(
            'field' => 'CaseNo',
            'label' => '案件番号',
            'rules' => 'required'),
        array(
            'field' => 'CaseTitle',
            'label' => '案件名',
            'rules' => 'required')
    ),
    'RequirementValidation' => array(
        array(
            'field' => 'targetProduct',
            'label' => '対象機種',
            'rules' => 'required'),
        array(
            'field' => 'targetOS',
            'label' => '対象OS',
            'rules' => 'required'),
        array(
            'field' => 'targetPDL',
            'label' => '対象PDL',
            'rules' => 'required'),
        array(
            'field' => 'targetLang',
            'label' => '対象言語',
            'rules' => 'required'),
    ),
    'SpecValidation' => array(
        array(
            'field' => 'targetProduct',
            'label' => '対象機種',
            'rules' => 'required'),
        array(
            'field' => 'targetOS',
            'label' => '対象OS',
            'rules' => 'required'),
        array(
            'field' => 'targetPDL',
            'label' => '対象PDL',
            'rules' => 'required'),
        array(
            'field' => 'targetLang',
            'label' => '対象言語',
            'rules' => 'required'),
    ),
);
?>


<?php

$config = array(
    'FeatureValidation' => array(
        array(
            'field' => 'FeatureName',
            'label' => '機能名',
            'rules' => 'required'),
        array(
            'field' => 'FeatureGPDKeyword',
            'label' => 'GPD Keyword',
            'rules' => 'alpha_dash')
    ),
    'OptionValidation' => array(
        array(
            'field' => 'OptionName',
            'label' => '選択肢名',
            'rules' => 'required'),
        array(
            'field' => 'OptionGPDKeyword',
            'label' => 'GPD Keyword',
            'rules' => 'alpha_dash')
    ),
    'LayoutValidation' => array(
        array(
            'field' => 'LayoutName',
            'label' => 'レイアウト名',
            'rules' => 'required'),
    ),
    'ConstraintValidation' => array(
        array(
            'field' => 'ConstName',
            'label' => '禁則名',
            'rules' => 'required')
    ),
    'VPValidation' => array(
        array(
            'field' => 'VPName',
            'label' => '可変点名',
            'rules' => 'required'),
        array(
            'field' => 'NewVariantNames[]',
            'label' => '変異体名',
            'rules' => 'required')
    ),
    'VariantValidation' => array(
        array(
            'field' => 'VariantName',
            'label' => '変異体名',
            'rules' => 'required')
    ),
    'ProductValidation' => array(
        array(
            'field' => 'ProductName',
            'label' => '製品名',
            'rules' => 'required')
    )
);
?>


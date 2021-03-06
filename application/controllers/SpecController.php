<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CaseController
 *
 * @author Oishi-Tadahiro
 */
class SpecController extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function ViewSpecDetail($SpecID) {
        $caseID = $this->GetCaseIDBySpecID($SpecID);
        $specObj = $this->spec_model->getSpec(array('SpecID' => $SpecID));
        $caseObj = $this->case_model->getCase(array('CaseID' => $caseID));
        $reqObj = $this->requirement_model->getRequirement(array('CaseID' => $caseID));

        $result['specObj'] = $specObj;
        $result['reqObj'] = $reqObj;
        $result['caseObj'] = $caseObj;
        $result['CaseID'] = $caseID;
        $result['selectOS'] = $this->GetOSSelectionView('Spec', $SpecID, $isEdit = NULL);
        $result['selectPDL'] = $this->GetPDLSelectionView('Spec', $SpecID, $isEdit = NULL);
        $result['selectLang'] = $this->GetLangSelectionView('Spec', $SpecID, $isEdit = NULL);
        $result['caseBasicView'] = $this->GetCaseBasicView($caseID);
        $result['caseInfoView'] = $this->GetCaseInfoView($caseID);
        $result['reqInfoView'] = $this->GetRequirementInfoView($caseID);
        $result['supportedProducts'] = $this->GetProductSelectionView('Spec', $SpecID, $isEdit = FALSE);
        $result['progress'] = $this->GetProgressView('Spec', $caseID, $SpecID);
//$result['specView'] = $this->GetSpecDevlopmentView($specObj);
        $result['docsView'] = $this->getAgreeDocTableView($SpecID);
        $this->load->view('spec/view_spec', $result);
    }

    public function AddNewSpec($CaseID) {
        if ($this->input->post('submit_AddNewSpec') && $this->form_validation->run('SpecValidation')) {
            $this->BeginTransaction();

// Add New Spec Data
            $specData = array(
                'RequirementID' => $this->GetRequirementIDByCaseID($CaseID),
                'SpecDetail' => $this->input->post('SpecDetail'),
                'SpecWHQL' => $this->input->post('SpecWHQL'),
                'SpecCSW' => $this->input->post('SpecCSW'),
                'SpecSUT' => $this->input->post('SpecSUT'),
                'SpecReadme' => $this->input->post('SpecReadme')
            );
            $specID = $this->spec_model->insertSpec($specData);

// Update Target Product Information
            $targetProduct = ($this->input->post('targetProduct') != NULL) ? $this->input->post('targetProduct') : array();
            $this->UpdateTargetInfo('Spec', $specID, 'Product', $targetProduct);

// Update Target OS Information
            $targetOS = ($this->input->post('targetOS') != NULL) ? $this->input->post('targetOS') : array();
            $this->UpdateTargetInfo('Spec', $specID, 'OS', $targetOS);

// Update Target PDL Information
            $targetPDLs = ($this->input->post('targetPDL') != NULL) ? $this->input->post('targetPDL') : array();
            $this->UpdateTargetInfo('Spec', $specID, 'PDL', $targetPDLs);

// Update Target Lang Information
            $targetLangs = ($this->input->post('targetLang') != NULL) ? $this->input->post('targetLang') : array();
            $this->UpdateTargetInfo('Spec', $specID, 'Lang', $targetLangs);

            $this->EndTransaction();
            $this->ViewSpecDetail($specID);
        } else {
            $caseObj = $this->case_model->getCase(array('CaseID' => $CaseID));
            $reqObj = $this->requirement_model->getRequirement(array('CaseID' => $CaseID));
            $result['caseObj'] = $caseObj;
            $result['reqObj'] = $reqObj;
            $result['CaseID'] = $caseObj->CaseID;
            $result['caseBasicView'] = $this->GetCaseBasicView($caseObj->CaseID);
            $result['caseInfoView'] = $this->GetCaseInfoView($caseObj->CaseID);
            $result['reqInfoView'] = $this->GetRequirementInfoView($caseObj->CaseID);
            $result['allProductNames'] = $this->product_model->getAllProductNameArray();

// OS,PDL,言語,機種の選択状態の初期値はRequirementから引き継ぐ
            $result['supportedProductIDs'] = $this->product_model->getSupportedProductIDArray('Requirement', array('RequirementID' => $reqObj->RequirementID));
            $result['productCount'] = count($result['supportedProductIDs']);
            $result['selectOS'] = $this->GetOSSelectionView('Requirement', $reqObj->RequirementID, TRUE);
            $result['selectPDL'] = $this->GetPDLSelectionView('Requirement', $reqObj->RequirementID, TRUE);
            $result['selectLang'] = $this->GetLangSelectionView('Requirement', $reqObj->RequirementID, TRUE);
            $result['progress'] = $this->GetProgressView('Spec', $caseObj->CaseID, NULL);
            $this->load->view('spec/view_spec_add', $result);
        }
    }

    public function EditSpec($SpecID) {
        if ($this->input->post('submit_EditSpec') && $this->form_validation->run('SpecValidation')) {
            $this->BeginTransaction();

            $specData = array(
                'SpecDetail' => $this->input->post('SpecDetail'),
                'SpecRemark' => $this->input->post('SpecRemark'),
                'SpecWHQL' => $this->input->post('SpecWHQL'),
                'SpecCSW' => $this->input->post('SpecCSW'),
                'SpecSUT' => $this->input->post('SpecSUT'),
                'SpecReadme' => $this->input->post('SpecReadme')
            );
            $this->spec_model->updateSpec(array('SpecID' => $SpecID), $specData);

// Update Target Product Information
            $targetProduct = ($this->input->post('targetProduct') != NULL) ? $this->input->post('targetProduct') : array();
            $this->UpdateTargetInfo('Spec', $SpecID, 'Product', $targetProduct);

// Update Target OS Infomation
            $targetOS = ($this->input->post('targetOS') != NULL) ? $this->input->post('targetOS') : array();
            $this->UpdateTargetInfo('Spec', $SpecID, 'OS', $targetOS);

// Update Target PDL Information
            $targetPDL = ($this->input->post('targetPDL') != NULL) ? $this->input->post('targetPDL') : array();
            $this->UpdateTargetInfo('Spec', $SpecID, 'PDL', $targetPDL);

// Update Target Lang Information
            $targetLang = ($this->input->post('targetLang') != NULL) ? $this->input->post('targetLang') : array();
            $this->UpdateTargetInfo('Spec', $SpecID, 'Lang', $targetLang);

            $this->EndTransaction();
            $this->ViewSpecDetail($SpecID);
        } else {
            $caseID = $this->GetCaseIDBySpecID($SpecID);
            $specObj = $this->spec_model->getSpec(array('SpecID' => $SpecID));
            $caseObj = $this->case_model->getCase(array('CaseID' => $caseID));
            $reqObj = $this->requirement_model->getRequirement(array('CaseID' => $caseID));

            $result['specObj'] = $specObj;
            $result['reqObj'] = $reqObj;
            $result['caseObj'] = $caseObj;
            $result['allProductNames'] = $this->product_model->getAllProductNameArray();
            $result['supportedProductIDs'] = $this->product_model->getSupportedProductIDArray('Spec', array('SpecID' => $SpecID));
            $result['productCount'] = count($result['supportedProductIDs']);
            $result['caseBasicView'] = $this->GetCaseBasicView($caseObj->CaseID);
            $result['caseInfoView'] = $this->GetCaseInfoView($caseObj->CaseID);
            $result['reqInfoView'] = $this->GetRequirementInfoView($caseID);
            $result['selectOS'] = $this->GetOSSelectionView('Spec', $specObj->SpecID, $isEdit = TRUE);
            $result['selectPDL'] = $this->GetPDLSelectionView('Spec', $specObj->SpecID, $isEdit = TRUE);
            $result['selectLang'] = $this->GetLangSelectionView('Spec', $specObj->SpecID, $isEdit = TRUE);
            $result['progress'] = $this->GetProgressView('Spec', $caseObj->CaseID, $SpecID);
            $this->load->view('spec/view_spec_edit', $result);
        }
    }

    public function ViewAgreeDoc($SpecID) {
        $specObj = $this->spec_model->getSpec(array('SpecID' => $SpecID));
        $caseObj = $this->case_model->getCase(array('CaseID' => $this->GetCaseIDBySpecID($SpecID)));
        $reqObj = $this->requirement_model->getRequirement(array('RequirementID' => $specObj->RequirementID));

        $result['specObj'] = $specObj;
        $result['reqObj'] = $reqObj;
        $result['caseObj'] = $caseObj;

        $result['title'] = $this->case_model->getCaseTypeLabel($caseObj->CaseTypeID) . $caseObj->CaseNo . ':' . $caseObj->CaseTitle;
        $this->load->view('document/agree_doc', $result, FALSE);
//$view = $this->load->view('document/agree_doc', NULL, TRUE);
//file_put_contents("hoge.html", $view); // 個別対応確認書のViewをファイルに保存する
    }

    public function PreviewAgreeDoc($SpecID) {
        $specObj = $this->spec_model->getSpec(array('SpecID' => $SpecID));
        $caseObj = $this->case_model->getCase(array('CaseID' => $this->GetCaseIDBySpecID($SpecID)));
        $reqObj = $this->requirement_model->getRequirement(array('RequirementID' => $specObj->RequirementID));

        $result['specObj'] = $specObj;
        $result['reqObj'] = $reqObj;
        $result['caseObj'] = $caseObj;

        $result['title'] = $this->case_model->getCaseTypeLabel($caseObj->CaseTypeID) . $caseObj->CaseNo . ':' . $caseObj->CaseTitle;
        $result['supportedOSName'] = $this->os_model->getSupportedOSNameArray('Spec', array('SpecID' => $SpecID));
        $result['supportedLangName'] = $this->lang_model->getSupportedLangNameArray('Spec', array('SpecID' => $SpecID));
        $this->load->view('document/agree_doc', $result, FALSE);
//file_put_contents("hoge.html", $view); // 個別対応確認書のViewをファイルに保存する
    }

    public function EditAgreeDoc($SpecID) {
        if ($this->input->post('submitAgreeDoc')) {
            $specObj = $this->spec_model->getSpec(array('SpecID' => $SpecID));
            $caseObj = $this->case_model->getCase(array('CaseID' => $this->GetCaseIDBySpecID($SpecID)));
            $reqObj = $this->requirement_model->getRequirement(array('RequirementID' => $specObj->RequirementID));



            $result['title'] = $this->case_model->getCaseTypeLabel($caseObj->CaseTypeID) . $caseObj->CaseNo . ':' . $caseObj->CaseTitle;
            $result['supportedOSName'] = $this->os_model->getSupportedOSNameArray('Spec', array('SpecID' => $SpecID));
            $result['supportedLangName'] = $this->lang_model->getSupportedLangNameArray('Spec', array('SpecID' => $SpecID));
            
            $specObj->deliverType = $this->input->post('deliverType') ? $this->input->post('deliverType') : NULL;
            $specObj->SpecCSW = ($this->input->post('SpecCSW') == TRUE) ? FALSE : TRUE;
            $specObj->SpecDetail = $this->input->post('NewSpecDetail') ? $this->input->post('NewSpecDetail') : '';
            $specObj->PlugandPlayInstall = $this->input->post('PlugandPlayInstall') ? '○' : '';
            $specObj->SupportVersionUp = $this->input->post('SupportVersionUp') ? '○' : '';
            $specObj->SupportKyouzon = $this->input->post('SupportKyouzon') ? '○' : '';
            $specObj->SupportExclusive = $this->input->post('SupportExclusive') ? '○' : '';
            $specObj->HasDifference = $this->input->post('HasDifference') ? '○' : '';
            $specObj->SupportNewFuncHelp = $this->input->post('SupportNewFuncHelp') ? '○' : '';
            $specObj->NewLimitation1 = $this->input->post('NewLimitation1') ? $this->input->post('NewLimitation1') : NULL;
            
            $result['specObj'] = $specObj;
            $result['reqObj'] = $reqObj;
            $result['caseObj'] = $caseObj;
            $this->load->view('document/agree_doc', $result, FALSE);
        } else {
            $specObj = $this->spec_model->getSpec(array('SpecID' => $SpecID));
            $caseObj = $this->case_model->getCase(array('CaseID' => $this->GetCaseIDBySpecID($SpecID)));
            $reqObj = $this->requirement_model->getRequirement(array('RequirementID' => $specObj->RequirementID));
            $result['specObj'] = $specObj;
            $result['reqObj'] = $reqObj;
            $result['caseObj'] = $caseObj;

            $result['title'] = $this->case_model->getCaseTypeLabel($caseObj->CaseTypeID) . $caseObj->CaseNo . ':' . $caseObj->CaseTitle;
            $result['supportedOSName'] = $this->os_model->getSupportedOSNameArray('Spec', array('SpecID' => $SpecID));
            $result['supportedLangName'] = $this->lang_model->getSupportedLangNameArray('Spec', array('SpecID' => $SpecID));
            $this->load->view('document/agree_doc_edit', $result, FALSE);
        }
    }

    public function UploadAgreeDoc($SpecID) {
        parent::UploadFile('AgreeDoc', $SpecID);
    }

//    public function AddSpecDevelopment($specID, $productID) {
//        if ($this->input->post('submit_AddSpecDevelopment') != NULL) {
//            $this->BeginTransaction();
//
//            // Add New Development Data
//            $devData = array(
//                'SpecID' => $specID,
//                'ProductID' => $productID,
//                'DevDriverVersion' => $this->input->post('DevDriverVersion'),
//            );
//            $develomentID = $this->development_model->insertDevelopment($devData);
//
//            // Update Target PDL Information
//            $targetPDL = ($this->input->post('targetPDL') != NULL) ? $this->input->post('targetPDL') : array();
//            $this->UpdateTargetInfo('Development', $develomentID, 'PDL', $targetPDL);
//
//            $this->EndTransaction();
//            $this->ViewSpecDetail($specID);
//        } else {
//            $result['specObj'] = $this->spec_model->getSpec(array('SpecID' => $specID));
//            $result['prodObj'] = $this->product_model->getProduct(array('ProductID' => $productID));
//            $result['selectPDL'] = $this->GetPDLSelectionView('Spec', $specID, TRUE);
//            $this->load->view('development/table/view_development_table_add', $result);
//        }
//    }
//    public function EditSpecDevelopment($specID, $productID) {
//        if ($this->input->post('submit_EditSpecDevelopment') != NULL) {
//            $this->BeginTransaction();
//
//            $developmentID = $this->input->post('DevelopmentID');
//
//            $devData = array(
//                'DevDriverVersion' => $this->input->post('DevDriverVersion'),
//            );
//
//            $this->development_model->updateDevelopment(array('DevelopmentID' => $developmentID), $devData);
//
//            // Update Target PDL Information
//            $targetPDL = ($this->input->post('targetPDL') != NULL) ? $this->input->post('targetPDL') : array();
//            $this->UpdateTargetInfo('Development', $developmentID, 'PDL', $targetPDL);
//            $this->EndTransaction();
//            $this->ViewSpecDetail($specID);
//        } else {
//            $specObj = $this->spec_model->getSpec(array('SpecID' => $specID));
//            $prodObj = $this->product_model->getProduct(array('ProductID' => $productID));
//            $devObj = $this->development_model->getDevelopment(array('SpecID' => $specID));
//
//            $result['specObj'] = $specObj;
//            $result['prodObj'] = $prodObj;
//            if ($devObj) {
//                $result['devObj'] = $devObj;
//                $result['selectPDL'] = $this->GetPDLSelectionView('Development', $devObj->DevelopmentID, TRUE);
//                $this->load->view('development/table/view_development_table_edit', $result);
//            } else {
//                redirect("SpecController/AddSpecDevelopment/$specID/$productID");
//            }
//        }
//    }

    private function getAgreeDocTableView($SpecID) {
        $result['docs'] = $this->spec_model->getSpecAgreeDocs($SpecID);
        $result['category'] = 'AgreeDoc';
        $result['id'] = $SpecID;
        return $this->load->view('document/document_list', $result, TRUE);
    }

}

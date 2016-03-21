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
class RequirementController extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function ViewAllRequirement() {
        
    }

    public function ViewRequirementDetail($RequirementID) {
        $reqObj = $this->requirement_model->getRequirement(array('RequirementID' => $RequirementID));
        $caseID = $reqObj->CaseID;
        $caseObj = $this->case_model->getCase(array('CaseID' => $caseID));
        $caseObj->CaseTypeName = $this->case_model->getCaseTypeObj(array('CaseTypeID' => $caseObj->CaseTypeID))->CaseTypeName;
        $result['caseObj'] = $caseObj;
        $result['reqObj'] = $reqObj;
        $result['supportedProducts'] = $this->GetProductSelectionView('Requirement', $RequirementID, $isEdit = FALSE);
        $result['selectOS'] = $this->GetOSSelectionView('Requirement', $RequirementID, $isEdit = FALSE);
        $result['selectPDL'] = $this->GetPDLSelectionView('Requirement', $RequirementID, $isEdit = FALSE);
        $result['selectLang'] = $this->GetLangSelectionView('Requirement', $RequirementID, $isEdit = FALSE);
        $result['progress'] = $this->GetProgressView('Requirement', $caseID, $RequirementID);
        $result['tags'] = $this->tag_model->getTagDataListHtml(array('CaseID' => $caseID));
        $result['caseBasicView'] = $this->GetCaseBasicView($caseID);
        $result['caseInfoView'] = $this->GetCaseInfoView($caseID);
        $result['docsView'] = $this->getHandOffDocTableView($RequirementID);
        $this->load->view('requirement/view_requirement', $result);
    }

    public function AddNewRequirement($CaseID) {
        if ($this->input->post('submit_AddNewRequirement') && $this->form_validation->run('RequirementValidation')) {
            $this->BeginTransaction();

            // Add Detail
            $requirementData = array(
                'CaseID' => $CaseID,
                'RequirementInfo' => $this->input->post('RequirementInfo'),
                'RequirementDetail' => $this->input->post('RequirementDetail'),
                'ReqWHQL' => $this->input->post('ReqWHQL'),
                'ReqCSW' => $this->input->post('ReqCSW'),
                'ReqSUT' => $this->input->post('ReqSUT'),
            );
            $requirementID = $this->requirement_model->insertRequirement($requirementData);

            // Update Target Product Information
            $targetProduct = ($this->input->post('targetProduct') != NULL) ? $this->input->post('targetProduct') : array();
            $this->UpdateTargetInfo('Requirement', $requirementID, 'Product', $targetProduct);

            // Update Target OS Information
            $targetOS = ($this->input->post('targetOS') != NULL) ? $this->input->post('targetOS') : array();
            $this->UpdateTargetInfo('Requirement', $requirementID, 'OS', $targetOS);

            // Update Target PDL Information
            $targetPDLs = ($this->input->post('targetPDL') != NULL) ? $this->input->post('targetPDL') : array();
            $this->UpdateTargetInfo('Requirement', $requirementID, 'PDL', $targetPDLs);

            // Update Target Lang Information
            $targetLangs = ($this->input->post('targetLang') != NULL) ? $this->input->post('targetLang') : array();
            $this->UpdateTargetInfo('Requirement', $requirementID, 'Lang', $targetLangs);

            $this->EndTransaction();
            $this->ViewRequirementDetail($requirementID);
        } else {
            $result['CaseID'] = $CaseID;
            $result['caseObj'] = $this->case_model->getCase(array('CaseID' => $CaseID));
            $result['allProductNames'] = $this->product_model->getAllProductNameArray();
            $result['selectOS'] = $this->GetOSSelectionView();
            $result['selectLang'] = $this->GetLangSelectionView();
            $result['selectPDL'] = $this->GetPDLSelectionView();
            $result['caseBasicView'] = $this->GetCaseBasicView($CaseID);
            $result['caseInfoView'] = $this->GetCaseInfoView($CaseID);
            $result['progress'] = $this->GetProgressView('Requirement', $CaseID, NULL);
            $this->load->view('requirement/view_requirement_add', $result);
        }
    }

    public function EditRequirement($RequirementID) {
        if ($this->input->post('submit_EditRequirement') && $this->form_validation->run('RequirementValidation')) {
            $this->BeginTransaction();

            $RequirementData = array(
                'RequirementInfo' => $this->input->post('RequirementInfo'),
                'RequirementDetail' => $this->input->post('RequirementDetail'),
                'ReqWHQL' => $this->input->post('ReqWHQL'),
                'ReqCSW' => $this->input->post('ReqCSW'),
                'ReqSUT' => $this->input->post('ReqSUT'),
            );
            $this->requirement_model->updateRequirement(array('RequirementID' => $RequirementID), $RequirementData);

            // Update Target Product Information
            $targetProduct = ($this->input->post('targetProduct') != NULL) ? $this->input->post('targetProduct') : array();
            $this->UpdateTargetInfo('Requirement', $RequirementID, 'Product', $targetProduct);

            // Update Target OS Information
            $targetOS = ($this->input->post('targetOS') != NULL) ? $this->input->post('targetOS') : array();
            $this->UpdateTargetInfo('Requirement', $RequirementID, 'OS', $targetOS);

            // Update Target PDL Information
            $targetPDL = ($this->input->post('targetPDL') != NULL) ? $this->input->post('targetPDL') : array();
            $this->UpdateTargetInfo('Requirement', $RequirementID, 'PDL', $targetPDL);

            // Update Target Lang Information
            $targetLang = ($this->input->post('targetLang') != NULL) ? $this->input->post('targetLang') : array();
            $this->UpdateTargetInfo('Requirement', $RequirementID, 'Lang', $targetLang);

            $this->EndTransaction();
            $this->ViewRequirementDetail($RequirementID);
        } else {
            $reqObj = $this->requirement_model->getRequirement(array('RequirementID' => $RequirementID));
            $caseObj = $this->case_model->getCase(array('CaseID' => $reqObj->CaseID));
            $result['allProductNames'] = $this->product_model->getAllProductNameArray();
            $result['supportedProductIDs'] = $this->product_model->getSupportedProductIDArray('Requirement', array('RequirementID' => $RequirementID));
            $result['selectOS'] = $this->GetOSSelectionView('Requirement', $RequirementID, $isEdit = TRUE);
            $result['selectLang'] = $this->GetLangSelectionView('Requirement', $RequirementID, $isEdit = TRUE);
            $result['selectPDL'] = $this->GetPDLSelectionView('Requirement', $RequirementID, $isEdit = TRUE);
            $result['caseTypeNames'] = $this->case_model->getCaseTypeNames();
            $result['caseObj'] = $caseObj;
            $result['reqObj'] = $reqObj;
            $result['caseBasicView'] = $this->GetCaseBasicView($caseObj->CaseID);
            $result['caseInfoView'] = $this->GetCaseInfoView($caseObj->CaseID);
            $result['progress'] = $this->GetProgressView('Requirement', $caseObj->CaseID, $RequirementID);
            $this->load->view('requirement/view_requirement_edit', $result);
        }
    }

    public function UploadHandOffDoc($RequirementID) {
        parent::UploadFile('HandOffDoc', $RequirementID);
    }

    private function getHandOffDocTableView($RequirementID) {
        $result['docs'] = $this->requirement_model->getRequirementHandOffDocuments($RequirementID);
        $result['category'] = 'HandOffDoc';
        $result['id'] = $RequirementID;
        return $this->load->view('document/document_list', $result, TRUE);
    }

}

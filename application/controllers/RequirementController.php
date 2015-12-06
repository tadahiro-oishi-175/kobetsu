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
        $result['tags'] = $this->tag_model->getTagDataListHtml(array('CaseID' => $caseID));
        $this->load->view('case/requirement/view_requirement', $result);
    }

    public function AddNewRequirement($CaseID) {
        if ($this->input->post('submit_AddNewRequirement') != NULL) {
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
            $tagetPDLs = ($this->input->post('targetPDL') != NULL) ? $this->input->post('targetPDL') : array();
            $this->UpdateTargetInfo('Requirement', $requirementID, 'PDL', $tagetPDLs);
            
            $this->EndTransaction();
            $this->ViewRequirementDetail($requirementID);
        } else {
            $result['CaseID'] = $CaseID;
            $result['caseObj'] = $this->case_model->getCase(array('CaseID' => $CaseID));
            $result['allProductNames'] = $this->product_model->getAllProductNameArray();
            $result['selectOS'] = $this->GetOSSelectionView();
            $result['selectPDL'] = $this->GetPDLSelectionView();
            $this->load->view('case/requirement/view_requirement_add', $result);
        }
    }

    public function EditRequirement($RequirementID) {
        if ($this->input->post('submit_EditRequirement') != NULL) {
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
            
            $this->EndTransaction();
            $this->ViewRequirementDetail($RequirementID);
        } else {
            $reqObj = $this->requirement_model->getRequirement(array('RequirementID' => $RequirementID));
            $caseObj = $this->case_model->getCase(array('CaseID' => $reqObj->CaseID));
            $result['allProductNames'] = $this->product_model->getAllProductNameArray();
            $result['supportedProductIDs'] = $this->product_model->getSupportedProductIDArray('Requirement', array('RequirementID' => $RequirementID));
            $result['selectOS'] = $this->GetOSSelectionView('Requirement', $RequirementID, $isEdit = TRUE);
            $result['selectPDL'] = $this->GetPDLSelectionView('Requirement', $RequirementID, $isEdit = TRUE);
            $result['caseTypeNames'] = $this->case_model->getCaseTypeNames();
            $result['caseObj'] = $caseObj;
            $result['reqObj'] = $reqObj;
            $this->load->view('case/requirement/view_requirement_edit', $result);
        }
    }
}

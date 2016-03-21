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
class DevelopmentController extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function ViewAllDevelopment() {
        
    }

    public function ViewDevelopmentDetail($DevelopmentID) {
        $devObj = $this->development_model->getDevelopment(array('DevelopmentID' => $DevelopmentID));
        $specID = $devObj->SpecID;
        $caseObj = $this->case_model->getCase(array('CaseID' => $this->GetCaseIDBySpecID($specID)));
        $result['caseObj'] = $caseObj;
        $result['devObj'] = $devObj;
        $result['caseBasicView'] = $this->GetCaseBasicView($caseObj->CaseID);
        $result['caseInfoView'] = $this->GetCaseInfoView($caseObj->CaseID);
        $result['reqInfoView'] = $this->GetRequirementInfoView($caseObj->CaseID);
        $result['specInfoView'] = $this->GetSpecInfoView($caseObj->CaseID);
        $result['progress'] = $this->GetProgressView('Development', $caseObj->CaseID);
        $this->load->view('development/view_development', $result);
    }

    public function AddNewDevelopment($SpecID) {
        if ($this->input->post('submit_AddNewDevelopment') != NULL) {
            $this->BeginTransaction();

            // Add Detail
            $devlopmentData = array(
                'SpecID' => $SpecID,
            );
            $developmentID = $this->development_model->insertDevelopment($devlopmentData);

            $this->EndTransaction();
            $this->ViewDevelopmentDetail($developmentID);
        } else {
            $caseObj = $this->case_model->getCase(array('CaseID' => $this->GetCaseIDBySpecID($SpecID)));
            $reqObj = $this->requirement_model->getRequirement(array('CaseID' => $caseObj->CaseID));
            $specObj = $this->spec_model->getSpec(array('SpecID' => $SpecID));
            $result['caseObj'] = $caseObj;
            $result['reqObj'] = $reqObj;
            $result['specObj'] = $specObj;
            $result['supportedProducts'] = $this->GetProductSelectionView('Spec', $specObj->SpecID, $isEdit = FALSE);
            $result['caseBasicView'] = $this->GetCaseBasicView($caseObj->CaseID);
            $result['caseInfoView'] = $this->GetCaseInfoView($caseObj->CaseID);
            $result['reqInfoView'] = $this->GetRequirementInfoView($caseObj->CaseID);
            $result['specInfoView'] = $this->GetSpecInfoView($caseObj->CaseID);
            $result['allProductNames'] = $this->product_model->getAllProductNameArray();
            $result['progress'] = $this->GetProgressView('Development', $caseObj->CaseID);

            // OS,PDL,機種の選択状態の初期値はRequirementから引き継ぐ
            $result['prodView'] = $this->getProductDevelopmentView($SpecID);
            $result['developers'] = $this->developer_model->getAllDevelopers();
            $this->load->view('development/view_development_add', $result);
        }
    }

    public function EditDevelopment($DevelopmentID) {
        if ($this->input->post('submit_EditRequirement') != NULL) {
            $this->BeginTransaction();


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
            $result['caseBasicView'] = $this->GetCaseBasicView($caseObj->CaseID);
            $result['caseInfoView'] = $this->GetCaseInfoView($caseObj->CaseID);
            $result['reqInfoView'] = $this->GetRequirementInfoView($caseObj->CaseID);
            $result['specInfoView'] = $this->GetSpecInfoView($caseObj->CaseID);
            $this->load->view('requirement/view_requirement_edit', $result);
        }
    }
    
    private function getProductDevelopmentView($SpecID) {
        $view = '';
        $supportedProdctNames = $this->product_model->getSupportedProducts('Spec', array('SpecID' => $SpecID));
        foreach($supportedProdctNames as $prodName) {
            $result['prodName'] = $prodName;
            $view .= $this->load->view('product/view_product_development_add', $result, TRUE);
        }
        return $view;
        //$result['productCount'] = count($result['supportedProductIDs']);
    }
}

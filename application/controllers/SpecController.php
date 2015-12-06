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
        $specObj = $this->spec_model->getSpec(array('SpecID' => $SpecID));
        $caseObj = $this->case_model->getCase(array('CaseID' => $specObj->CaseID));
        $reqObj = $this->requirement_model->getRequirement(array('CaseID' => $specObj->CaseID));

        $result['specObj'] = $specObj;
        $result['reqObj'] = $reqObj;
        $result['caseObj'] = $caseObj;
        $result['CaseID'] = $reqObj->CaseID;
        $result['selectOS'] = $this->GetOSSelectionView('Spec', $SpecID, $isEdit = NULL);
        $result['selectPDL'] = $this->GetPDLSelectionView('Spec', $SpecID, $isEdit);
        $result['caseBasicView'] = $this->load->view('case/view_case_basic', $result, TRUE);
        $result['supportedProducts'] = $this->GetProductSelectionView('Spec', $SpecID, $isEdit = FALSE);
        $result['specView'] = $this->getSpecDevlopmentView($specObj);

        $this->load->view('case/spec/view_spec', $result);
    }

    public function AddNewSpec($CaseID) {
        if ($this->input->post('submit_AddNewSpec') != NULL) {
            $this->BeginTransaction();

            // Add New Spec Data
            $specData = array(
                'CaseID' => $CaseID,
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
            $tagetPDLs = ($this->input->post('targetPDL') != NULL) ? $this->input->post('targetPDL') : array();
            $this->UpdateTargetInfo('Spec', $specID, 'PDL', $tagetPDLs);

            $this->EndTransaction();
            $this->ViewSpecDetail($specID);
        } else {
            $caseObj = $this->case_model->getCase(array('CaseID' => $CaseID));
            $reqObj = $this->requirement_model->getRequirement(array('CaseID' => $CaseID));
            $result['caseObj'] = $caseObj;
            $result['reqObj'] = $reqObj;
            $result['CaseID'] = $caseObj->CaseID;
            $result['caseBasicView'] = $this->load->view('case/view_case_basic', $result, TRUE);

            $result['allProductNames'] = $this->product_model->getAllProductNameArray();

            // OS,PDL,機種の選択状態の初期値はRequirementから引き継ぐ
            $result['supportedProductIDs'] = $this->product_model->getSupportedProductIDArray('Requirement', array('RequirementID' => $reqObj->RequirementID));
            $result['productCount'] = count($result['supportedProductIDs']);
            $result['selectOS'] = $this->GetOSSelectionView('Requirement', $reqObj->RequirementID, TRUE);
            $result['selectPDL'] = $this->GetPDLSelectionView('Requirement', $reqObj->RequirementID, TRUE);
            $this->load->view('case/spec/view_spec_add', $result);
        }
    }

    public function EditSpec($SpecID) {
        if ($this->input->post('submit_EditSpec') != NULL) {
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

            $this->EndTransaction();
            $this->ViewSpecDetail($SpecID);
        } else {
            $specObj = $this->spec_model->getSpec(array('SpecID' => $SpecID));
            $caseObj = $this->case_model->getCase(array('CaseID' => $specObj->CaseID));
            $reqObj = $this->requirement_model->getRequirement(array('CaseID' => $specObj->CaseID));

            $result['specObj'] = $specObj;
            $result['reqObj'] = $reqObj;
            $result['caseObj'] = $caseObj;
            $result['allProductNames'] = $this->product_model->getAllProductNameArray();
            $result['supportedProductIDs'] = $this->product_model->getSupportedProductIDArray('Spec', array('SpecID' => $SpecID));
            $result['productCount'] = count($result['supportedProductIDs']);
            $result['caseBasicView'] = $this->load->view('case/view_case_basic', $result, TRUE);
            $result['selectOS'] = $this->GetOSSelectionView('Spec', $specObj->SpecID, $isEdit = TRUE);
            $result['selectPDL'] = $this->GetPDLSelectionView('Spec', $specObj->SpecID, $isEdit = TRUE);
            $this->load->view('case/spec/view_spec_edit', $result);
        }
    }

    public function ViewAgreeDoc($SpecID) {
        $specObj = $this->spec_model->getSpec(array('SpecID' => $SpecID));
        $caseObj = $this->case_model->getCase(array('CaseID' => $specObj->CaseID));
        $reqObj = $this->requirement_model->getRequirement(array('CaseID' => $specObj->CaseID));

        $result['specObj'] = $specObj;
        $result['reqObj'] = $reqObj;
        $result['caseObj'] = $caseObj;

        $result['title'] = $this->case_model->getCaseTypeLabel($caseObj->CaseTypeID) . $caseObj->CaseNo . ':' . $caseObj->CaseTitle;
        $this->load->view('document/agree_doc', $result, FALSE);
        //$view = $this->load->view('document/agree_doc', NULL, TRUE);
        //file_put_contents("hoge.html", $view); // 個別対応確認書のViewをファイルに保存する
    }

    public function UploadFile() {
        $ini = parse_ini_file(APPPATH . '/config/config.ini');
        $path = $ini['uploadPath'];
        if (!is_dir($path)) {
            mkdir($path, 0777, TRUE);
        }
        $outputPath = getcwd() . "/application/pdf/";
        if (!is_dir($outputPath)) {
            mkdir($outputPath, 0777, TRUE);
        }
        $config = array(
            'upload_path' => $path,
            //'file_name' => 'hoge.jpg',
            'allowed_types' => '*',
            'remove_spaces' => TRUE,
            'encrypt_name' => FALSE,
        );
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('file')) {
            $result['error'] = $this->upload->display_errors();
            return null;
        } else {
            $file_info = $this->upload->data();
            $data = array(
                'FileName' => $file_info['file_name'],
                'FilePath' => $file_info['file_path'],
                'ViewName' => $file_info['raw_name'],
                'OriginalName' => $file_info['client_name']
            );
        }

//        if ($convert) {
//            $this->convertDocx2View($file_info, $category, $id);
//        } else {
//            $this->copyView($file_info, $category, $id);
//        }
        return $result;
    }

    public function AddSpecDevelopment($specID, $productID) {
        if ($this->input->post('submit_AddSpecDevelopment') != NULL) {
            $this->BeginTransaction();

            // Add New Development Data
            $devData = array(
                'SpecID' => $specID,
                'ProductID' => $productID,
                'DevDriverVersion' => $this->input->post('DevDriverVersion'),
            );
            $develomentID = $this->development_model->insertDevelopment($devData);

            // Update Target PDL Information
            $targetPDL = ($this->input->post('targetPDL') != NULL) ? $this->input->post('targetPDL') : array();
            $this->UpdateTargetInfo('Development', $develomentID, 'PDL', $targetPDL);

            $this->EndTransaction();
            $this->ViewSpecDetail($specID);
        } else {
            $result['specObj'] = $this->spec_model->getSpec(array('SpecID' => $specID));
            $result['prodObj'] = $this->product_model->getProduct(array('ProductID' => $productID));
            $result['selectPDL'] = $this->GetPDLSelectionView('Spec', $specID, TRUE);
            $this->load->view('development/table/view_development_table_add', $result);
        }
    }

    public function EditSpecDevelopment($specID, $productID) {
        if ($this->input->post('submit_EditSpecDevelopment') != NULL) {
            $this->BeginTransaction();
            
            $developmentID = $this->input->post('DevelopmentID');
            
            $devData = array(
                'DevDriverVersion' => $this->input->post('DevDriverVersion'),
            );

            $this->development_model->updateDevelopment(array('DevelopmentID' => $developmentID), $devData);
            
            // Update Target PDL Information
            $targetPDL = ($this->input->post('targetPDL') != NULL) ? $this->input->post('targetPDL') : array();
            $this->UpdateTargetInfo('Development', $developmentID, 'PDL', $targetPDL);
            $this->EndTransaction();
            $this->ViewSpecDetail($specID);
        } else {
            $specObj = $this->spec_model->getSpec(array('SpecID' => $specID));
            $prodObj = $this->product_model->getProduct(array('ProductID' => $productID));
            $devObj = $this->development_model->getDevelopment(array('SpecID' => $specID, 'ProductID' => $productID));

            $result['specObj'] = $specObj;
            $result['prodObj'] = $prodObj;
            if ($devObj) {
                $result['devObj'] = $devObj;
                $result['selectPDL'] = $this->GetPDLSelectionView('Development', $devObj->DevelopmentID, TRUE);
                $this->load->view('development/table/view_development_table_edit', $result);
            } else {
                redirect("SpecController/AddSpecDevelopment/$specID/$productID");
            }
        }
    }

    private function getSpecDevlopmentView($specObj, $isEdit = NULL) {
        $specID = $specObj->SpecID;
        $view = '';
        $supportedProductIDs = $this->product_model->getSupportedProductIDArray('Spec', array('SpecID' => $specID));
        foreach ($supportedProductIDs as $productID) {
            $result['prodObj'] = $this->product_model->getProduct(array('ProductID' => $productID));
            $result['productCount'] = count($supportedProductIDs);
            $devObj = $this->development_model->getDevelopment(array('SpecID' => $specID, 'ProductID' => $productID));
            if ($devObj) {
                $result['selectOS'] = $this->GetOSSelectionView('Development', $devObj->DevelopmentID, FALSE);
                $result['selectPDL'] = $this->GetPDLSelectionView('Development', $devObj->DevelopmentID, FALSE);
                $result['devObj'] = $devObj;
            } else {
                $result['selectOS'] = $this->GetOSSelectionView('Spec', $specID, $isEdit);
                $result['selectPDL'] = $this->GetPDLSelectionView('Spec', $specID, $isEdit);
            }
            $view .= $this->load->view('development/table/view_development_table', $result, TRUE);
        }
        return $view;
    }

}

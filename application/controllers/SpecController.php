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
        $result['selectOS'] = $this->GetOSSelectionView('Spec', $specObj->SpecID, $isEdit = FALSE);
        $result['specView'] = $this->load->view('case/spec/table/view_spec_table', $result, TRUE);

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

            // Update Target OS Information
            $targetOS = ($this->input->post('targetOS') != NULL) ? $this->input->post('targetOS') : array();
            $this->UpdateTargetInfo('Spec', $specID, 'OS', $targetOS);

            $this->EndTransaction();
            $this->ViewSpecDetail($specID);
        } else {
            $caseObj = $this->case_model->getCase(array('CaseID' => $CaseID));
            $reqObj = $this->requirement_model->getRequirement(array('CaseID' => $CaseID));
            $result['caseObj'] = $caseObj;
            $result['reqObj'] = $reqObj;
            $result['CaseID'] = $caseObj->CaseID;

            // OS選択の初期値はRequirementから引き継ぐ
            $result['selectOS'] = $this->GetOSSelectionView('Requirement', $reqObj->RequirementID, $isEdit = FALSE);
            $result['specView'] = $this->load->view('case/spec/table/view_spec_table_add', $result, TRUE);
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

            // Update Target OS Infomation
            $targetOS = ($this->input->post('targetOS') != NULL) ? $this->input->post('targetOS') : array();
            $this->UpdateTargetInfo('Spec', $SpecID, 'OS', $targetOS);

            $this->EndTransaction();
            $this->ViewSpecDetail($SpecID);
        } else {
            $specObj = $this->spec_model->getSpec(array('SpecID' => $SpecID));
            $caseObj = $this->case_model->getCase(array('CaseID' => $specObj->CaseID));
            $reqObj = $this->requirement_model->getRequirement(array('CaseID' => $specObj->CaseID));

            $result['specObj'] = $specObj;
            $result['reqObj'] = $reqObj;
            $result['caseObj'] = $caseObj;
            $result['selectOS'] = $this->GetOSSelectionView('Spec', $specObj->SpecID, $isEdit = FALSE);
            $result['specView'] = $this->load->view('case/spec/table/view_spec_table_edit', $result, TRUE);
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

}

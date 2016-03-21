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
class CaseController extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function ViewAllCase() {
        $result['searchBoxView'] = $this->getSearchBoxView();
        $result['caseViewList'] = $this->GetCaseViewList($this->case_model->getAllCases());
        $this->load->view('case/view_all_case', $result);
    }
    
    public function ViewFilteredCase() {
        $workerFilterID = $this->input->post('workerFilterID');
        $statusFilterID = $this->input->post('statusFilterID');
        $productFilterID = $this->input->post('productFilterID');
        $pdlFilterID = $this->input->post('pdlFilterID');
        $where = $this->getWherePhrase($workerFilterID, $statusFilterID, $productFilterID, $pdlFilterID);
        $html = $this->GetCaseViewList($this->case_model->getCase($where));
        echo $html;
    }

    public function ViewCaseDetail($CaseID) {
        $caseObj = $this->case_model->getCase(array('CaseID' => $CaseID));
        $caseObj->CaseTypeName = $this->case_model->getCaseTypeObj(array('CaseTypeID' => $caseObj->CaseTypeID))->CaseTypeName;

        $result['caseObj'] = $caseObj;
        $result['statusName'] = $this->GetCaseStatusName($CaseID);
        $result['workerName'] = $caseObj->WorkerID ? $this->worker_model->getWorker(array('WorkerID' => $caseObj->WorkerID))->WorkerName : '';
        $result['tags'] = $this->tag_model->getTagDataListHtml(array('CaseID' => $CaseID));
        $result['progress'] = $this->GetProgressView('Case', $CaseID);
        $result['docsView'] = $this->getAttachedDocTableView($CaseID);
        $this->load->view('case/view_case', $result);
    }

    public function AddNewCase() {
        if ($this->input->post('submit_AddNewCase') && $this->form_validation->run('CaseValidation')) {
            $this->BeginTransaction();

            $data = array(
                'CaseTypeID' => $this->input->post('CaseTypeID'),
                'CaseNo' => $this->input->post('CaseNo'),
                'CaseSeqNo' => $this->input->post('CaseSeqNo'),
                'CaseTitle' => $this->input->post('CaseTitle'),
                'CustomerName' => $this->input->post('CustomerName'),
                'WorkerID' => $this->input->post('WorkerID') ? $this->input->post('WorkerID') : NULL,
                'StatusID' => $this->input->post('WorkerID') ? $this->GetCaseStatusID('担当者アサイン済み') : $this->GetCaseStatusID('担当者アサイン待ち'),
                'ResponseDeadline' => $this->input->post('ResponseDeadline'),
                'RegisteredDate' => mdate('%Y/%m/%d'),
            );
            $caseID = $this->case_model->insertCase($data);

            // Add Tags
            $tags = explode(',', $this->input->post('tags'));
            $this->updateCaseTagRelation($caseID, $tags);

            $this->EndTransaction();
            $this->ViewCaseDetail($caseID);
        } else {
            $result['caseTypeNames'] = $this->case_model->getCaseTypeNames();
            $result['workerNames'] = $this->worker_model->getAllWorkerNames();
            $result['tagSource'] = $this->tag_model->getTagSource();
            $result['progress'] = $this->GetProgressView('Case', NULL);
            $result['ResponseDeadline'] = '';
            $result['nextCaseSeqNo'] = 9999;
            $this->load->view('case/view_case_add', $result);
        }
    }

    public function EditCase($CaseID) {
        if ($this->input->post('submit_EditCase') != NULL && $this->form_validation->run('CaseValidation')) {
            $this->BeginTransaction();
            $data = array(
                'CaseTypeID' => $this->input->post('CaseTypeID'),
                'CaseNo' => $this->input->post('CaseNo'),
                'CaseSeqNo' => $this->input->post('CaseSeqNo'),
                'CaseTitle' => $this->input->post('CaseTitle'),
                'CustomerName' => $this->input->post('CustomerName'),
                'WorkerID' => $this->input->post('WorkerID') ? $this->input->post('WorkerID') : NULL,
                'StatusID' => $this->input->post('WorkerID') ? $this->GetCaseStatusID('担当者アサイン済み') : $this->GetCaseStatusID('担当者アサイン待ち'),
                'ResponseDeadline' => $this->input->post('ResponseDeadline'),
            );
            $this->case_model->updateCase(array('CaseID' => $CaseID), $data);

            // Add Tags
            $tags = explode(',', $this->input->post('tags'));
            $this->updateCaseTagRelation($CaseID, $tags);

            $this->EndTransaction();
            $this->ViewCaseDetail($CaseID);
        } else {
            $caseObj = $this->case_model->getCase(array('CaseID' => $CaseID));
            $result['workerNames'] = $this->worker_model->getAllWorkerNames();
            $result['caseTypeNames'] = $this->case_model->getCaseTypeNames();
            //$result['statusNames'] = $this->status_model->getAllStatusNames();
            $result['caseObj'] = $caseObj;
            $result['statusName'] = $this->GetCaseStatusName($CaseID);
            $result['tags'] = $this->tag_model->getTagDataListHtml(array('CaseID' => $CaseID));
            $result['tagSource'] = $this->tag_model->getTagSource();
            $result['progress'] = $this->GetProgressView('Case', $CaseID);
            $this->load->view('case/view_case_edit', $result);
        }
    }

    public function DeleteCase($CaseID) {
        if ($this->input->post('submit_DeleteCase')) {
            $this->BeginTransaction();

            // Delete from Requirement and related tables if exist
            if ($this->requirement_model->getRequirement(array('CaseID' => $CaseID))) {
                $RequirementID = $this->requirement_model->getRequirement(array('CaseID' => $CaseID))->RequirementID;
                $this->requirement_model->deleteRequirement(array('RequirementID' => $RequirementID));
            }

            // Delete from Case Master
            $this->case_model->deleteCase(array('CaseID' => $CaseID));

            $this->EndTransaction();
        }
        $this->ViewAllCase();
    }

    public function GetCaseViewList($CaseArray) {
        $viewList = array();
        foreach ($CaseArray as $case) {
            array_push($viewList, $this->getSingleCaseView($case));
        }
        
        $html = '';
        foreach($viewList as $view) {
            $html .= '<li class="dataRow">'.$view.'</li>';
        }
        return $html;
    }

    public function UploadCaseDoc($CaseID) {
        $result = parent::UploadFile('CaseDoc', $CaseID);
        if ($result) {
            header("Location: " . "CaseController/ViewCaseDetail/$CaseID");
        } else {
            echo $this->upload->display_errors();
        }
    }

    public function UpdateCaseList($category, $id) {
        return "hogehoge";
        //return json_encode("hogehoeg");
    }

    private function getSearchBoxView() {
        $result = NULL;
        $result['stasus'] = array('' => '全て') + $this->status_model->getAllStatusNames();
        $result['workers'] = array('' => '全て') + $this->worker_model->getAllWorkerNames();
        $result['products'] = array('' => '全て') + $this->product_model->getAllProductNames();
        $result['pdls'] = array('' => '全て') + $this->pdl_model->getAllPDLNames();
        return $this->load->view('case/list/view_search_box', $result, TRUE);
    }

    private function getSingleCaseView($CaseObj) {
        $reqObj = $this->requirement_model->getRequirement(array('CaseID' => $CaseObj->CaseID));
        if ($reqObj) {
            $specObj = $this->spec_model->getSpec(array('RequirementID' => $reqObj->RequirementID));
        } else {
            $specObj = NULL;
        }

        if ($specObj) {
            $devObj = $this->development_model->getDevelopment(array('SpecID' => $specObj->SpecID));
        } else {
            $devObj = NULL;
        }

        $result['caseObj'] = $CaseObj;
        $result['reqObj'] = $reqObj;
        $result['specObj'] = $specObj;
        $result['devObj'] = $devObj;
        $result['caseTypeLabel'] = $this->case_model->getCaseTypeLabel($CaseObj->CaseTypeID);
        $result['statusName'] = $CaseObj->StatusID ? $this->status_model->getStatus(array('StatusID' => $CaseObj->StatusID))->StatusName : '';
        $result['workerName'] = $CaseObj->WorkerID ? $this->worker_model->getWorker(array('WorkerID' => $CaseObj->WorkerID))->WorkerName : '(未入力)';
        $result['tags'] = $this->getTagListView($CaseObj->CaseID);
        return $this->load->view('case/list/view_singleCase', $result, TRUE);
    }

    private function getTagListView($CaseID) {
        $tags = $this->tag_model->getTagObjs(array('CaseID' => $CaseID));
        $result['tags'] = $tags;
        return $this->load->view('tag/list/view_tag_list', $result, TRUE);
    }

    private function getAttachedDocTableView($CaseID) {
        $result['docs'] = $this->case_model->getCaseAttachedDocuments($CaseID);
        $result['category'] = 'AttachedDoc';
        $result['id'] = $CaseID;
        return $this->load->view('document/document_list', $result, TRUE);
    }

    private function updateCaseTagRelation($CaseID, $Tags) {
        foreach ($Tags as $tag) {
            if (empty($tag)) {
                continue;
            }
            $tagObj = $this->tag_model->getTagObj(array('TagName' => $tag));
            // Tag masterに無いタグは新規タグなので追加する。
            if ($tagObj == NULL) {
                $tagID = $this->tag_model->insertTag(array('TagName' => $tag));
            } else {
                $tagID = $tagObj->TagID;
            }

            // Tag Masterにある かつ 現在CaseIDとのリレーションがないならリレーションを追加
            if (!$this->tag_model->isExistTagCaseRelation($CaseID, $tagID)) {
                $this->tag_model->insertTagRelation($CaseID, $tagID);
            }
        }
        $currentTags = $this->tag_model->getTagObjs(array('CaseID' => $CaseID));
        foreach ($currentTags as $current) {
            if (!in_array($current->TagName, $Tags)) {
                $this->tag_model->deleteTagRelation($CaseID, $current->TagID);
            }
        }
    }
    
    private function getWherePhrase($workerFilterID, $statusFilterID, $productFilterID, $pdlFilterID) {
        $where = array();
        if($workerFilterID) {
            $where += array('WorkerID' => $workerFilterID);
        }
        
        if($statusFilterID) {
            $where += array('StatusID' => $statusFilterID);
        }
        return $where;
    }

}

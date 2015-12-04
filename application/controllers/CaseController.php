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
        $cases = $this->case_model->getAllCases();
        $result['caseViewList'] = $this->GetCaseViewList($cases);
        $this->load->view('case/view_all_case', $result);
    }

    public function ViewCaseDetail($CaseID) {
        $caseObj = $this->case_model->getCase(array('CaseID' => $CaseID));
        $caseObj->CaseTypeName = $this->case_model->getCaseTypeObj(array('CaseTypeID' => $caseObj->CaseTypeID))->CaseTypeName;

        $result['tagsView'] = $this->getTagsView($CaseID);
        $result['caseObj'] = $caseObj;
        $result['tags'] = $this->tag_model->getTagDataListHtml(array('CaseID' => $CaseID));
        $this->load->view('case/view_case', $result);
    }

    public function AddNewCase() {
        if ($this->input->post('submit_AddNewCase') != NULL) {
            $this->BeginTransaction();

            $data = array(
                'CaseTypeID' => $this->input->post('CaseTypeID'),
                'CaseNo' => $this->input->post('CaseNo'),
                'CaseTitle' => $this->input->post('CaseTitle'),
            );
            $caseID = $this->case_model->insertCase($data);

            // Add Tags
            $tags = explode(',', $this->input->post('tags'));
            $this->updateCaseTagRelation($caseID, $tags);

            $this->EndTransaction();
            $this->ViewAllCase();
        } else {
            $result['caseTypeNames'] = $this->case_model->getCaseTypeNames();
            $result['tagSource'] = $this->tag_model->getTagSource();
            $this->load->view('case/view_case_add', $result);
        }
    }

    public function EditCase($CaseID) {
        if ($this->input->post('submit_EditCase') != NULL) {
            $this->BeginTransaction();
            $data = array(
                'CaseTypeID' => $this->input->post('CaseTypeID'),
                'CaseNo' => $this->input->post('CaseNo'),
                'CaseTitle' => $this->input->post('CaseTitle'),
            );
            $this->case_model->updateCase(array('CaseID' => $CaseID), $data);

            // Add Tags
            $tags = explode(',', $this->input->post('tags'));
            $this->updateCaseTagRelation($CaseID, $tags);

            $this->EndTransaction();
            $this->ViewCaseDetail($CaseID);
        } else {
            $caseObj = $this->case_model->getCase(array('CaseID' => $CaseID));
            $result['tagsView'] = $this->getTagsView($CaseID);
            $result['caseTypeNames'] = $this->case_model->getCaseTypeNames();
            $result['caseObj'] = $caseObj;
            $result['tags'] = $this->tag_model->getTagDataListHtml(array('CaseID' => $CaseID));
            $result['tagSource'] = $this->tag_model->getTagSource();
            $this->load->view('case/view_case_edit', $result);
        }
    }

    public function DeleteCase($CaseID) {
        $this->BeginTransaction();

        // Delete from Requirement and related tables if exist
        if ($this->requirement_model->getRequirement(array('CaseID' => $CaseID))) {
            $RequirementID = $this->requirement_model->getRequirement(array('CaseID' => $CaseID))->RequirementID;
            $this->requirement_model->deleteRequirement(array('RequirementID' => $RequirementID));
        }

        // Delete from Case Master
        $this->case_model->deleteCase(array('CaseID' => $CaseID));

        $this->EndTransaction();
        $this->ViewAllCase();
    }

    public function GetCaseViewList($CaseArray) {
        $result = array();
        foreach ($CaseArray as $case) {
            array_push($result, $this->getSingleCaseView($case));
        }
        return $result;
    }

    private function getSingleCaseView($CaseObj) {
        $reqObj = $this->requirement_model->getRequirement(array('CaseID' => $CaseObj->CaseID));
        if ($reqObj) {
            $result['specObj'] = $this->spec_model->getSpec(array('CaseID' => $CaseObj->CaseID));
        } else {
            $result['specObj'] = NULL;
        }
        $result['caseObj'] = $CaseObj;
        $result['reqObj'] = $reqObj;
        $result['caseTypeLabel'] = $this->case_model->getCaseTypeLabel($CaseObj->CaseTypeID);
        return $this->load->view('case/list/view_singleCase', $result, TRUE);
    }

    private function getTagsView($CaseID) {
        $result['tags'] = $this->tag_model->getTagObjs(array('CaseID' => $CaseID));
        return $this->load->view('tag/table/view_tag_table', $result, TRUE);
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

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @author Oishi-Tadahiro
 */
class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('casemodel', 'case_model', TRUE);
        $this->load->model('requirementmodel', 'requirement_model', TRUE);
        $this->load->model('specmodel', 'spec_model', TRUE);
        $this->load->model('developermodel', 'developer_model', TRUE);
        $this->load->model('developmentmodel', 'development_model', TRUE);
        $this->load->model('tagmodel', 'tag_model', TRUE);
        $this->load->model('pdlmodel', 'pdl_model', TRUE);
        $this->load->model('langmodel', 'lang_model', TRUE);
        $this->load->model('osmodel', 'os_model', TRUE);
        $this->load->model('outputdocmodel', 'outputdoc_model', TRUE);
        $this->load->model('productmodel', 'product_model', TRUE);
        $this->load->model('requestermodel', 'requester_model', TRUE);
        $this->load->model('statusmodel', 'status_model', TRUE);
        $this->load->model('swmodel', 'sw_model', TRUE);
        $this->load->model('workermodel', 'worker_model', TRUE);
        $this->load->model('usermodel', 'user_model', TRUE);
        $this->load->model('agreedocmodel', 'agreedoc_model', TRUE);
        $this->load->model('handoffdocmodel', 'handoffdoc_model', TRUE);
        $this->load->model('attachedmodel', 'attached_model', TRUE);
    }

    public function login_check() {
        if ($this->session->userdata('is_login') != TRUE) {
            redirect("auth/login/" . $this->uri->uri_string());
        }
    }

    protected function GetProductSelectionView($category = NULL, $id = NULL, $isEdit = NULL) {
        switch ($category) {
            case 'Requirement':
                $where = array('RequirementID' => $id);
                break;
            case 'Spec':
                $where = array('SpecID' => $id);
                break;
            default:
                break;
        }
        //$result['supportedProductID'] = $this->product_model->getSupportedProductIDArray($category, $where);

        $result = array();
        $ids = $this->product_model->getSupportedProductIDArray($category, $where);
        foreach ($ids as $id) {
            $obj = $this->product_model->getProduct(array('ProductID' => $id));
            array_push($result, $obj->ProductName);
        }
        return '<p>' . implode(',', $result) . '</p>';
//        $result['isEdit'] = $isEdit;
//        return $this->load->view('product/view_product_supported', $result, TRUE);
    }

    protected function GetOSSelectionView($category = NULL, $id = NULL, $isEdit = NULL) {
        $result['x86'] = $this->db->get_where('os_master', array('ArcID' => 1))->result();
        $result['x64'] = $this->db->get_where('os_master', array('ArcID' => 2))->result();

        switch ($category) {
            case 'Requirement':
                $where = array('RequirementID' => $id);
                break;
            case 'Spec':
                $where = array('SpecID' => $id);
                break;
            default:
                return $this->load->view('os/view_os_selection', $result, TRUE);
        }
        $result['supportedOSID'] = $this->os_model->getSupportedOSIDArray($category, $where);
        if ($isEdit) {
            return $this->load->view('os/view_os_supported', $result, TRUE);
        } else {
            $os = array();
            foreach ($result['supportedOSID'] as $OSID) {
                $osObj = $this->os_model->getOS(array('OSID' => $OSID));
                array_push($os, $osObj->OSName);
            }
            return implode(',', $os);
        }
    }

    protected function GetPDLSelectionView($category = NULL, $id = NULL, $isEdit = NULL) {
        $result['PDLObjs'] = $this->pdl_model->getAllPDLs();
        switch ($category) {
            case 'Requirement':
                $where = array('RequirementID' => $id);
                break;
            case 'Spec':
                $where = array('SpecID' => $id);
                break;
            case 'Development':
                $where = array('DevelopmentID' => $id);
                break;
            default:
                return $this->load->view('pdl/view_pdl_selection', $result, TRUE);
        }
        $result['supportedPDLID'] = $this->pdl_model->getSupportedPDLIDArray($category, $where);
        if ($isEdit) {
            return $this->load->view('pdl/view_pdl_supported', $result, TRUE);
        } else {
            $pdl = array();
            foreach ($result['supportedPDLID'] as $PDLID) {
                $pdlObj = $this->pdl_model->getPDL(array('PDLID' => $PDLID));
                array_push($pdl, $pdlObj->PDLName);
            }
            return implode(',', $pdl);
        }
    }

    protected function GetLangSelectionView($category = NULL, $id = NULL, $isEdit = NULL) {
        $result['LangObjs'] = $this->lang_model->getAllLangs();
        switch ($category) {
            case 'Requirement':
                $where = array('RequirementID' => $id);
                break;
            case 'Spec':
                $where = array('SpecID' => $id);
                break;
            case 'Development':
                $where = array('DevelopmentID' => $id);
                break;
            default:
                return $this->load->view('lang/view_lang_selection', $result, TRUE);
        }
        $result['supportedLangID'] = $this->lang_model->getSupportedLangIDArray($category, $where);
        if ($isEdit) {
            return $this->load->view('lang/view_lang_supported', $result, TRUE);
        } else {
            $lang = array();
            foreach ($result['supportedLangID'] as $LangID) {
                $langObj = $this->lang_model->getLang(array('LangID' => $LangID));
                array_push($lang, $langObj->LangName);
            }
            return implode(',', $lang);
        }
    }

    protected function GetSpecDevlopmentView($specObj, $isEdit = NULL) {
        $specID = $specObj->SpecID;
        $view = '';
        $supportedProductIDs = $this->product_model->getSupportedProductIDArray('Spec', array('SpecID' => $specID));
        foreach ($supportedProductIDs as $productID) {
            $result['prodObj'] = $this->product_model->getProduct(array('ProductID' => $productID));
            $result['productCount'] = count($supportedProductIDs);
            $devObj = $this->development_model->getDevelopment(array('SpecID' => $specID));
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

    protected function GetProgressView($category, $caseID, $id = NULL) {
        switch ($category) {
            case 'Case':
                $caseObj = $caseID ? $this->case_model->getCase(array('CaseID' => $caseID)) : NULL;
                $reqObj = $caseID ? $this->requirement_model->getRequirement(array('CaseID' => $caseID)) : NULL;
                $specObj = $reqObj ? $this->spec_model->getSpec(array('RequirementID' => $reqObj->RequirementID)) : NULL;
                $devObj = $specObj ? $this->development_model->getDevelopment(array('SpecID' => $specObj->SpecID)) : NULL;
                break;
            case 'Requirement':
                $caseObj = $this->case_model->getCase(array('CaseID' => $caseID));
                $reqObj = $id ? $this->requirement_model->getRequirement(array('RequirementID' => $id)) : NULL;
                $specObj = $id ? $this->spec_model->getSpec(array('RequirementID' => $id)) : NULL;
                $devObj = $specObj ? $this->development_model->getDevelopment(array('SpecID' => $specObj->SpecID)) : NULL;
                break;
            case 'Spec':
                $caseObj = $this->case_model->getCase(array('CaseID' => $caseID));
                $reqObj = $this->requirement_model->getRequirement(array('RequirementID' => $this->GetRequirementIDByCaseID($caseID)));
                $specObj = $id ? $this->spec_model->getSpec(array('SpecID' => $id)) : NULL;
                $devObj = $specObj ? $this->development_model->getDevelopment(array('SpecID' => $specObj->SpecID)) : NULL;
                break;
            case 'Development':
                $caseObj = $this->case_model->getCase(array('CaseID' => $caseID));
                $reqObj = $this->requirement_model->getRequirement(array('RequirementID' => $this->GetRequirementIDByCaseID($caseID)));
                $specObj = $this->spec_model->getSpec(array('SpecID' => $this->GetSpecIDByCaseID($caseID)));
                $devObj = $id ? $this->development_model->getDevelopment(array('DevelopmentD' => $id)) : NULL;
                break;
            default:
                break;
        }
        $result['case_title'] = $this->getCaseTitle($category, $caseObj, $reqObj, $specObj, $devObj);
        $result['req_title'] = $this->getRequirementTitle($category, $caseObj, $reqObj, $specObj, $devObj);
        $result['spec_title'] = $this->getSpecTitle($category, $caseObj, $reqObj, $specObj, $devObj);
        $result['dev_title'] = $this->getDevelopmentTitle($category, $caseObj, $reqObj, $specObj, $devObj);
        return $this->load->view('progress', $result, TRUE);
    }

    protected function GetCaseBasicView($CaseID, $editBtn = NULL) {
        $caseObj = $this->case_model->getCase(array('CaseID' => $CaseID));
        $result['workerName'] = $caseObj->WorkerID ? $this->worker_model->getWorker(array('WorkerID' => $caseObj->WorkerID))->WorkerName : '';
        $result['statusName'] = $this->GetCaseStatusName($caseObj->CaseID);
        $result['caseObj'] = $caseObj;
        return $this->load->view('case/view_case_basic', $result, TRUE);
    }

    protected function GetCaseInfoView($CaseID, $editBtn = NULL) {
        $caseObj = $this->case_model->getCase(array('CaseID' => $CaseID));
        $result['caseTypeName'] = $this->case_model->getCaseTypeObj(array('CaseTypeID' => $caseObj->CaseTypeID))->CaseTypeName;
        $result['caseObj'] = $caseObj;
        $result['editBtn'] = $editBtn;
        return $this->load->view('case/view_case_info', $result, TRUE);
    }

    protected function GetRequirementInfoView($CaseID) {
        $reqObj = $this->requirement_model->getRequirement(array('RequirementID' => $this->GetRequirementIDByCaseID($CaseID)));
        $result['reqObj'] = $reqObj;
        return $this->load->view('requirement/view_requirement_info', $result, TRUE);
    }

    protected function GetSpecInfoView($CaseID) {
        $specObj = $this->spec_model->getSpec(array('SpecID' => $this->GetSpecIDByCaseID($CaseID)));
        $result['selectOS'] = $this->GetOSSelectionView('Spec', $specObj->SpecID, $isEdit = NULL);
        $result['selectPDL'] = $this->GetPDLSelectionView('Spec', $specObj->SpecID, $isEdit = NULL);
        $result['selectLang'] = $this->GetLangSelectionView('Spec', $specObj->SpecID, $isEdit = NULL);
        $result['supportedProducts'] = $this->GetProductSelectionView('Spec', $specObj->SpecID, $isEdit = FALSE);
        $result['specObj'] = $specObj;
        return $this->load->view('spec/view_spec_info', $result, TRUE);
    }

    protected function UploadFile($category, $id) {

        switch ($category) {
            case 'CaseDoc':
                $caseID = $id;
                break;
            case 'HandOffDoc':
                $caseID = $this->GetCaseIDByRequirementID($id);
                break;
            case 'AgreeDoc':
                $caseID = $this->GetCaseIDBySpecID($id);
                break;
            default:
                break;
        }
        $caseDirName = $this->getCaseDirName($caseID);

        $ini = parse_ini_file(APPPATH . '/config/config.ini');
        $path = $ini['uploadPath'] . "\\" . $caseDirName . '\\' . $category;
        if (!is_dir($path)) {
            mkdir($path, 0777, TRUE);
        }

        $config = array(
            'upload_path' => $path,
            'allowed_types' => '*',
            'encrypt_name' => TRUE,
        );

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('file')) {
            return false;
        } else {
            $file_info = $this->upload->data();
            $this->addFileInfo($category, $id, $file_info);
            return true;
        }
    }

    protected function BeginTransaction() {
        $this->db->trans_start();
    }

    protected function EndTransaction() {
        $this->db->trans_complete();
    }

    protected function UpdateTargetInfo($category, $id, $target, $valueArray) {
        switch ($category) {
            case 'Requirement':
                $this->requirement_model->updateTargetInfo($id, $target, $valueArray);
                break;
            case 'Spec':
                $this->spec_model->updateTargetInfo($id, $target, $valueArray);
                break;
            case 'Development':
                $this->development_model->updateTargetInfo($id, $target, $valueArray);
            default:
                break;
        }
    }

    protected function GetCaseIDByRequirementID($requirementID) {
        return $this->requirement_model->getRequirement(array('RequirementID' => $requirementID))->CaseID;
    }

    protected function GetCaseIDBySpecID($specID) {
        $requirementID = $this->spec_model->getSpec(array('SpecID' => $specID))->RequirementID;
        return $this->requirement_model->getRequirement(array('RequirementID' => $requirementID))->CaseID;
    }

    protected function GetRequirementIDByCaseID($CaseID) {
        return $this->requirement_model->getRequirement(array('CaseID' => $CaseID))->RequirementID;
    }

    protected function GetSpecIDByCaseID($CaseID) {
        return $this->spec_model->getSpec(array('RequirementID' => $this->GetRequirementIDByCaseID($CaseID)))->SpecID;
    }

    protected function GetSpecIDByDevelopmentID($DevelopmentID) {
        return $this->development_model->getDevelopment(array('DevelopmentID' => $DevelopmentID))->SpecID;
    }

    protected function GetCaseStatusID($phase) {
        $id = $this->status_model->getStatus(array('StatusName' => $phase))->StatusID;
        if ($id) {
            return $id;
        } else {
            return 99;
        }
    }

    protected function GetCaseStatusName($caseID) {
        $statusID = $this->case_model->getCase(array('CaseID' => $caseID))->StatusID;
        if ($statusID) {
            return $this->status_model->getStatus(array('StatusID' => $statusID))->StatusName;
        } else {
            'ステイタス不明';
        }
    }

    private function addFileInfo($category, $id, $file_info) {
        $this->BeginTransaction();

        $path = $file_info['full_path'];
        $name = $file_info['orig_name'];

        switch ($category) {
            case 'CaseDoc':
                $attached_data = array(
                    'AttachedPath' => $path,
                    'AttachedName' => $name,
                );
                $attachedDocID = $this->attached_model->insertAttached($attached_data);
                $maxSequenceNo = $this->case_model->getMaxSequenceNo(array('CaseID' => $id));
                $case_data = array(
                    'CaseID' => $id,
                    'AttachedID' => $attachedDocID,
                    'SequenceNo' => $maxSequenceNo + 1,
                );
                $this->case_model->addCaseAttached($case_data);
                break;
            case 'HandOffDoc':
                $handoff_data = array(
                    'HandOffDocPath' => $path,
                    'HandOffDocName' => $name,
                );
                $handoffDocID = $this->handoffdoc_model->insertHandOffDoc($handoff_data);
                $maxSequenceNo = $this->requirement_model->getMaxSequenceNo(array('RequirementID' => $id));
                $req_data = array(
                    'RequirementID' => $id,
                    'HandOffDocID' => $handoffDocID,
                    'SequenceNo' => $maxSequenceNo + 1,
                );
                $this->requirement_model->addRequirementHandOff($req_data);
                break;
            case 'AgreeDoc':
                $data = array(
                    'AgreeDocPath' => $path,
                    'AgreeDocName' => $name,
                );
                $agreeDocID = $this->agreedoc_model->insertAgreeDoc($data);
                $maxSequenceNo = $this->spec_model->getMaxSequenceNo(array('SpecID' => $id));
                $spec_data = array(
                    'SpecID' => $id,
                    'AgreeDocID' => $agreeDocID,
                    'SequenceNo' => $maxSequenceNo + 1,
                );
                $this->spec_model->addSpecAgreeDoc($spec_data);
                break;
            default:
                break;
        }

        $this->EndTransaction();
    }

    private function getCaseDirName($CaseID) {
        $caseObj = $this->case_model->getCase(array('CaseID' => $CaseID));
        switch ($caseObj->CaseTypeID) {
            case '1':
                return "RQ" . $caseObj->CaseNo;
            case '2':
                return "@trisan[" . $caseObj->CaseNo . "]";
            case '3':
                return "AR" . $caseObj->CaseNo;
            default:
                return "UnknownCase";
        }
    }

    private function getCaseTitle($category, $caseObj, $reqObj, $specObj, $devObj) {
        $case_title_str = '1. 案件登録';

        switch ($category) {
            case 'Case':
                return "<strong>$case_title_str</strong>";
            case 'Requirement':
            case 'Spec':
            case 'Development':
                return anchor(base_url() . "CaseController/ViewCaseDetail/$caseObj->CaseID", $case_title_str);
            default:
                return;
        }
    }

    private function getRequirementTitle($category, $caseObj, $reqObj, $specObj, $devObj) {
        $req_title_str = '2. 要求検討';

        switch ($category) {
            case 'Case':
                if (!$this->isSatisfiedToReqPhase($caseObj)) {
                    return $req_title_str;
                } else if ($reqObj) {
                    return anchor(base_url() . "RequirementController/ViewRequirementDetail/$reqObj->RequirementID", $req_title_str);
                } else {
                    return anchor(base_url() . "RequirementController/AddNewRequirement/$caseObj->CaseID", $req_title_str);
                }
            case 'Spec':
            case 'Development':
                return anchor(base_url() . "RequirementController/ViewRequirementDetail/$reqObj->RequirementID", $req_title_str);
            case 'Requirement':
                return "<strong>$req_title_str</strong>";
            default:
                break;
        }
    }

    private function getSpecTitle($category, $caseObj, $reqObj, $specObj, $devObj) {
        $spec_title_str = '3. 仕様検討';
        switch ($category) {
            case 'Case':
                if ($specObj) {
                    return anchor(base_url() . "SpecController/ViewSpecDetail/$specObj->SpecID", $spec_title_str);
                } else {
                    return $spec_title_str;
                }
            case 'Requirement':
                if (!$this->isSatisfiedToSpecPhase($reqObj)) {
                    return $spec_title_str;
                } else if ($specObj) {
                    return anchor(base_url() . "SpecController/ViewSpecDetail/$specObj->SpecID", $spec_title_str);
                } else {
                    return anchor(base_url() . "SpecController/AddNewSpec/$caseObj->CaseID", $spec_title_str);
                }
            case 'Spec':
                return "<strong>$spec_title_str</strong>";
            case 'Development':
                return anchor(base_url() . "SpecController/ViewSpecDetail/$specObj->SpecID", $spec_title_str);
            default:
                break;
        }
    }

    private function getDevelopmentTitle($category, $caseObj, $reqObj, $specObj, $devObj) {
        $dev_title_str = '4. 開発検討';
        switch ($category) {
            case 'Case':
            case 'Requirement':
            case 'Spec':
                if ($devObj) {
                    return anchor(base_url() . "DevelopmentController/ViewDevelopmentDetail/$devObj->DevelopmentID", $dev_title_str);
                } else if ($specObj) {
                    return anchor(base_url() . "DevelopmentController/AddNewDevelopment/$specObj->SpecID", $dev_title_str);
                } else {
                    return $dev_title_str;
                }
            case 'Development':
                return "<strong>$dev_title_str</strong>";
            default:
                break;
        }
    }

    private function isSatisfiedToReqPhase($caseObj) {
        if (!$caseObj) {
            return false;
        }
        
        if (!$caseObj->WorkerID || !$caseObj->CaseSeqNo || !$caseObj->CaseTitle) {
            return false;
        }
        
        return true;
    }

    private function isSatisfiedToSpecPhase($reqObj) {
        if (!$reqObj) {
            return false;
        }
        if (!$reqObj->RequirementInfo) {
            return false;
        }

        $prodIDs = $this->product_model->getSupportedProductIDArray('Requirement', array('RequirementID' => $reqObj->RequirementID));
        $OSIDs = $this->os_model->getSupportedOSIDArray('Requirement', array('RequirementID' => $reqObj->RequirementID));
        $PDLIDs = $this->pdl_model->getSupportedPDLIDArray('Requirement', array('RequirementID' => $reqObj->RequirementID));
        $LangIDs = $this->lang_model->getSupportedLangIDArray('Requirement', array('RequirementID' => $reqObj->RequirementID));
        if (count($prodIDs) < 1 || count($OSIDs) < 1 || count($PDLIDs) < 1 || count($LangIDs) < 1) {
            return false;
        }

        return true;
    }

}

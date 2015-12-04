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
    }

    public function login_check() {
        if ($this->session->userdata('is_login') != TRUE) {
            redirect("auth/login/" . $this->uri->uri_string());
        }
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
        $result['isEdit'] = $isEdit;
        return $this->load->view('os/view_os_supported', $result, TRUE);
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
            default:
                return $this->load->view('pdl/view_pdl_selection', $result, TRUE);
        }
        $result['supportedPDLID'] = $this->pdl_model->getSupportedPDLIDArray($category, $where);
        $result['isEdit'] = $isEdit;
        return $this->load->view('pdl/view_pdl_supported', $result, TRUE);
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
            default:
                break;
        }
    }

}

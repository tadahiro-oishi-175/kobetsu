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
    }

    public function login_check() {
        if ($this->session->userdata('is_login') != TRUE) {
            redirect("auth/login/" . $this->uri->uri_string());
        }
    }
    
    protected function GetProductSelectionView($category = NULL, $id = NULL, $isEdit = NULL) {
        switch($category) {
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
        foreach($ids as $id) {
            $obj = $this->product_model->getProduct(array('ProductID' => $id));
            array_push($result, $obj->ProductName);
        }
        return '<p>'.implode(',', $result).'</p>';
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
        if($isEdit) {
            return $this->load->view('os/view_os_supported', $result, TRUE);
        } else {
            $os = array();
            foreach($result['supportedOSID'] as $OSID) {
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
        if($isEdit) {
            return $this->load->view('pdl/view_pdl_supported', $result, TRUE);
        } else {
            $pdl = array();
            foreach($result['supportedPDLID'] as $PDLID) {
                $pdlObj = $this->pdl_model->getPDL(array('PDLID' => $PDLID));
                array_push($pdl, $pdlObj->PDLName);
            }
            return implode(',', $pdl);
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

}

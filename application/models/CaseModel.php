<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CaseModel
 *
 * @author Oishi-Tadahiro
 */
class CaseModel extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->my_table_name = $this->table_case_master;
    }

    public function getAllCases() {
        return $this->GetAllRecords($this->my_table_name);
    }

    public function getCase($where) {
        return $this->GetRecord($this->my_table_name, $where);
    }
    
    public function insertCase($data) {
        return $this->InsertRecord($this->my_table_name, $data);
    }

    public function updateCase($where, $data) {
        return $this->UpdateRecord($this->my_table_name, $where, $data);
    }
    
    public function getMaxSequenceNo($where) {
        $this->db->select_max('SequenceNo');
        return $this->db->get_where($this->table_case_attached, $where)->row()->SequenceNo;
    }

    public function getCaseAttached($where) {
        $result = array();
        $this->db->order_by('AttachedID');
        $objs = $this->db->get_where($this->table_case_attached, $where)->result();
        foreach($objs as $obj) {
            $result += array($obj->AttachedID => $obj->SequenceNo);
        }
        return $result;
    }
    
    public function addCaseAttached($data) {
        return $this->InsertRecord($this->table_case_attached, $data);
    }
    
    public function updateCaseAttached($where, $data) {
        $this->UpdateRecord($this->table_case_attached, $where, $data);
    }
    
    public function delCaseAttached($where) {
        $this->DeleteRecord($this->table_case_attached, $where);
    }

    public function deleteCase($where) {
        $this->DeleteRecord($this->table_case_attached, $where);
        $this->DeleteRecord($this->table_case_tag, $where);
        return $this->DeleteRecord($this->my_table_name, $where);
    }

    public function getCaseTypeObj($where) {
        return $this->GetRecord($this->table_casetype_master, $where);
    }

    public function getCaseTypeNames() {
        $typeNames = array();
        $objs = $this->GetAllNames($this->table_casetype_master, array('CaseTypeID', 'CaseTypeName'));
        foreach ($objs as $obj) {
            $typeNames += array($obj->CaseTypeID => $obj->CaseTypeName);
        }
        return $typeNames;
    }

    public function getCaseTypeLabel($CaseTypeID) {
        switch ($CaseTypeID) {
            case 1:
                return 'RQ';
            case 2:
                return '@trisan';
            case 3:
                return 'AR';
            default:
                return '';
        }
    }
    
    public function getCaseAttachedDocuments($CaseID) {
        $this->db->order_by('SequenceNo');
        $objs = $this->db->get_where($this->table_case_attached, array('CaseID' => $CaseID))->result();
        foreach($objs as $obj) {
            $attachedObj = $this->attached_model->getAttached(array('AttachedID' => $obj->AttachedID));
            $obj->DocID = $obj->AttachedID;
            $obj->DocName = $attachedObj->AttachedName;
        }
        return $objs;
    }

}

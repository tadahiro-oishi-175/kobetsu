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

    public function deleteCase($where) {
        $this->DeleteRecord($this->table_case_agreedoc, $where);
        $this->DeleteRecord($this->table_case_handoffdoc, $where);
        $this->DeleteRecord($this->table_case_outputdoc, $where);
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

}

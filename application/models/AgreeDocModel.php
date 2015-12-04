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
class AgreeDocModel extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->my_table_name = $this->table_agreedoc_master;
    }

    public function getAllAgreeDocs() {
        return $this->GetAllRecords($this->my_table_name);
    }

    public function getAgreeDoc($where) {
        return $this->GetRecord($this->my_table_name, $where);
    }

    public function insertAgreeDoc($data) {
        return $this->InsertRecord($this->my_table_name, $data);
    }

    public function updateAgreeDoc($where, $data) {
        return $this->UpdateRecord($this->my_table_name, $where, $data);
    }

    public function deleteAgreeDoc($where) {
        return $this->DeleteRecord($this->my_table_name, $where);
    }

}

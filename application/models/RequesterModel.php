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
class RequesterModel extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->my_table_name = $this->table_requester_master;
    }

    public function getAllRequesters() {
        return $this->GetAllRecords($this->my_table_name);
    }
    
    public function getRequester($where) {
        return $this->GetRecord($this->my_table_name, $where);
    }
    
    public function insertRequester($data) {
        return $this->InsertRecord($this->my_table_name, $data);
    }
    
    public function updateRequester($where, $data) {
        return $this->UpdateRecord($this->my_table_name, $where, $data);
    }
    
    public function deleteRequester($where) {
        return $this->DeleteRecord($this->my_table_name, $where);
    }
}

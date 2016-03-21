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
class StatusModel extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->my_table_name = $this->table_status_master;
    }

    public function getAllStatus() {
        return $this->GetAllRecords($this->my_table_name);
    }
    
    public function getStatus($where) {
        return $this->GetRecord($this->my_table_name, $where);
    }
    
    public function insertStatus($data) {
        return $this->InsertRecord($this->my_table_name, $data);
    }
    
    public function updateStatus($where, $data) {
        return $this->UpdateRecord($this->my_table_name, $where, $data);
    }
    
    public function deleteStatus($where) {
        return $this->DeleteRecord($this->my_table_name, $where);
    }
    
    public function getAllStatusNames() {
        $result = array();
        $objs = $this->getAllStatus();
        foreach($objs as $obj) {
            $result += array($obj->StatusID => $obj->StatusName);
        }
        return $result;
    }
}

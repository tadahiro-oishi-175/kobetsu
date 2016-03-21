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
class WorkerModel extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->my_table_name = $this->table_worker_master;
    }

    public function getAllWorkers() {
        return $this->GetAllRecords($this->my_table_name);
    }
    
    public function getWorker($where) {
        return $this->GetRecord($this->my_table_name, $where);
    }
    
    public function insertWorker($data) {
        return $this->InsertRecord($this->my_table_name, $data);
    }
    
    public function updateWorker($where, $data) {
        return $this->UpdateRecord($this->my_table_name, $where, $data);
    }
    
    public function deleteWorker($where) {
        return $this->DeleteRecord($this->my_table_name, $where);
    }
    
    public function getAllWorkerNames() {
        $result = array(NULL => '--未アサイン--');
        $objs = $this->getAllWorkers();
        foreach($objs as $obj) {
            $result += array($obj->WorkerID => $obj->WorkerName);
        }
        return $result;
    }
}

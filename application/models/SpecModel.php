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
class SpecModel extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->my_table_name = $this->table_spec_master;
    }

    public function getSpec($where) {
        return $this->GetRecord($this->my_table_name, $where);
    }

    public function insertSpec($data) {
        return $this->InsertRecord($this->my_table_name, $data);
    }

    public function updateSpec($where, $data) {
        return $this->UpdateRecord($this->my_table_name, $where, $data);
    }

    public function deleteSpec($where) {
        $this->DeleteRecord($this->table_spec_os, $where);
        $this->DeleteRecord($this->table_spec_product, $where);
        return $this->DeleteRecord($this->my_table_name, $where);
    }

    public function updateTargetInfo($specID, $target, $valueArray) {
        switch ($target) {
            case 'OS':
                $this->DeleteRecord($this->table_spec_os, array('SpecID' => $specID));
                foreach ($valueArray as $value) {
                    $data = array(
                        'SpecID' => $specID,
                        'OSID' => $value,
                    );
                    $this->InsertRecord($this->table_spec_os, $data);
                }
                break;
            default:
                break;
        }
    }
}

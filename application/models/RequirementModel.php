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
class RequirementModel extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->my_table_name = $this->table_requirement_master;
    }

    public function getRequirement($where) {
        return $this->GetRecord($this->my_table_name, $where);
    }

    public function insertRequirement($data) {
        return $this->InsertRecord($this->my_table_name, $data);
    }

    public function updateRequirement($where, $data) {
        return $this->UpdateRecord($this->my_table_name, $where, $data);
    }

    public function deleteRequirement($where) {
        $specObjs = $this->spec_model->getSpec($where);
        if (is_array($specObjs)) {
            foreach ($specObjs as $specObj) {
                $this->spec_model->deleteSpec(array('SpecID' => $specObj->SpecID));
            }
        } else {
            $specObj = $specObjs;
            $this->spec_model->deleteSpec(array('SpecID' => $specObj->SpecID));
        }
        $this->DeleteRecord($this->table_requirement_arc, $where);
        $this->DeleteRecord($this->table_requirement_lang, $where);
        $this->DeleteRecord($this->table_requirement_os, $where);
        $this->DeleteRecord($this->table_requirement_product, $where);
        $this->DeleteRecord($this->table_requirement_sw, $where);
        return $this->DeleteRecord($this->my_table_name, $where);
    }

    public function updateTargetInfo($requirementID, $target, $valueArray) {
        switch ($target) {
            case 'OS':
                $table = $this->table_requirement_os;
                $column = 'OSID';
                break;
            case 'PDL':
                $table = $this->table_requirement_pdl;
                $column = 'PDLID';
                break;
            default:
                break;
        }
        $this->DeleteRecord($table, array('RequirementID' => $requirementID));
        foreach ($valueArray as $value) {
            $data = array(
                'RequirementID' => $requirementID,
                $column => $value,
            );
            $this->InsertRecord($table, $data);
        }
    }

}

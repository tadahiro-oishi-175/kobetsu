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
class LangModel extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->my_table_name = $this->table_lang_master;
    }

    public function getAllLangs() {
        return $this->GetAllRecords($this->my_table_name);
    }

    public function getLang($where) {
        return $this->GetRecord($this->my_table_name, $where);
    }

    public function insertLang($data) {
        return $this->InsertRecord($this->my_table_name, $data);
    }

    public function updateLang($where, $data) {
        return $this->UpdateRecord($this->my_table_name, $where, $data);
    }

    public function deleteLang($where) {
        return $this->DeleteRecord($this->my_table_name, $where);
    }

    public function getSupportedLangIDArray($category, $where) {
        switch ($category) {
            case 'Requirement':
                $table = $this->table_requirement_lang;
                break;
            case 'Spec':
                $table = $this->table_spec_lang;
                break;
            case 'Development':
                $table = $this->table_development_lang;
                break;
            default:
                $table = '';
                break;
        }
        $this->db->select('LangID');
        $result = array();
        $objs = $this->GetRecord($table, $where);

        if (is_array($objs)) {
            foreach ($objs as $obj) {
                array_push($result, $obj->LangID);
            }
        } else {
            array_push($result, $objs->LangID);
        }
        return $result;
    }

    public function getSupportedLangNameArray($category, $where) {
        switch ($category) {
            case 'Requirement':
                $table = $this->table_requirement_lang;
                break;
            case 'Spec':
                $table = $this->table_spec_lang;
                break;
            case 'Development':
                $table = $this->table_development_lang;
                break;
            default:
                $table = '';
                break;
        }
        $result = array();
        $this->db->join($this->table_lang_master, $table.'.LangID='.$this->table_lang_master.'.LangID');
        $objs = $this->db->get_where($table, $where)->result();

        if (is_array($objs)) {
            foreach ($objs as $obj) {
                array_push($result, $obj->LangName);
            }
        } else {
            array_push($result, $objs->LangName);
        }
        return $result;
    }
}

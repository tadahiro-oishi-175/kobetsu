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
class TagModel extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->my_table_name = $this->table_tag_master;
    }

    public function getAllTags() {
        return $this->GetAllRecords($this->my_table_name);
    }

    public function getTagObj($where) {
        return $this->GetRecord($this->my_table_name, $where);
    }

    public function insertTag($data) {
        return $this->InsertRecord($this->my_table_name, $data);
    }

    public function updateTag($where, $data) {
        return $this->UpdateRecord($this->my_table_name, $where, $data);
    }

    public function deleteTag($where) {
        return $this->DeleteRecord($this->my_table_name, $where);
    }

    public function getTagObjs($where = NULL) {
        $this->db->join($this->table_tag_master, $this->table_case_tag . '.TagID=' . $this->table_tag_master . '.TagID');
        return $this->GetAllRecords($this->table_case_tag, $where);
        //return $this->db->get_where($this->table_case_tag, $where)->result();
    }

    public function getTagDataListHtml($where = NULL) {
        $tags = $this->getTagObjs($where);
        
        $html = '<ul id="tags" class="InputTag">';
        foreach ($tags as $tag) {
            $html .= "<li data-value=\"$tag->TagID\">$tag->TagName</li>";
        }
        $html .= '</ul>';
        return $html;
    }

    public function insertTagRelation($CaseID, $TagID) {
        $data = array('CaseID' => $CaseID, 'TagID' => $TagID);
        $this->InsertRecord($this->table_case_tag, $data);
    }
    
    public function deleteTagRelation($CaseID, $TagID) {
        $this->DeleteRecord($this->table_case_tag, array('CaseID' => $CaseID, 'TagID' => $TagID));
    }

    public function isExistTagCaseRelation($CaseID, $TagID) {
        $hoge = $this->db->get_where($this->table_case_tag, array('CaseID' => $CaseID, 'TagID' => $TagID))->num_rows() > 0 ? TRUE : FALSE;
        return $hoge;
    }
    
    public function getTagSource() {
        $result = array();
        $tagNames = $this->GetAllNames($this->table_tag_master, 'TagName');
        foreach($tagNames as $name) {
            array_push($result, "\"$name->TagName\"");
        }
        return implode(',', $result);
    }
}

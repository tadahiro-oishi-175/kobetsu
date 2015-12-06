<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Model
 *
 * @author Oishi-Tadahiro
 */
class MY_Model extends CI_Model {

    private $user, $date, $history_table_name = 'history';
    protected $my_table_name;
    
    // master tables
    protected $table_case_master = 'case_master';
    protected $table_requirement_master = 'requirement_master';
    protected $table_spec_master = 'spec_master';
    protected $table_development_master = 'development_master';
    protected $table_casetype_master = 'casetype_master';
    protected $table_tag_master = 'tag_master';
    protected $table_pdl_master = 'pdl_master';
    protected $table_lang_master = 'lang_master';
    protected $table_os_master = 'os_master';
    protected $table_product_master = 'product_master';
    protected $table_attached_master = 'attached_master';
    protected $table_agreedoc_master = 'agreedoc_master';
    protected $table_handoffdoc_master = 'handoffdoc_master';
    protected $table_outputdoc_master = 'outputdoc_master';
    protected $table_outputdoctype_master = 'outputdoctype_master';
    protected $table_developer_master = 'developer_master';
    protected $table_worker_master = 'worker_master';
    protected $table_requester_master = 'requester_master';
    protected $table_user_master = 'user_master';
    protected $table_status_master = 'status_master';
    protected $table_sw_master = 'sw_master';
    
    // case related tables
    protected $table_case_agreedoc = 'case_agreedoc';
    protected $table_case_handoffdoc = 'case_handoffdoc';
    protected $table_case_tag = 'case_tag';
    protected $table_case_outputdoc = 'case_outputdoc';
    
    // requirement tables
    protected $table_requirement_pdl = 'requirement_pdl';
    protected $table_requirement_lang = 'requirement_lang';
    protected $table_requirement_os = 'requirement_os';
    protected $table_requirement_product = 'requirement_product';
    protected $table_requirement_sw = 'requirement_sw';
    
    // spec tables
    protected $table_spec_os = 'spec_os';
    protected $table_spec_pdl = 'spec_pdl';
    protected $table_spec_product = 'spec_product';
    
    // development tables
    protected $table_development_pdl = 'development_pdl';
    protected $table_development_lang = 'development_lang';
    protected $table_development_os = 'development_os';
    
    // history tables
    protected $table_worker_history = 'worker_history';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function init() {
        $this->user = $this->session->userdata('userName') != NULL ? $this->session->userdata('userName') : 'UnknownUser';
        $this->date = mdate('%Y-%m-%d %H:%i:%s');
    }

    protected function recordHistory($action, $category) {
        $this->init();
        $data = array(
            'Action' => $action,
            'Category' => $category,
        );
        $this->db->set($data);
        $this->db->insert($this->history_table_name, $data);
    }

    protected function GetAllRecords($tableName, $where = NULL) {
        if($where) {
            return $this->db->get_where($tableName, $where)->result();
        } else {
            return $this->db->get($tableName)->result();
        }
    }

    protected function GetRecord($tableName, $where) {
        $result = $this->db->get_where($tableName, $where);
        if ($result->num_rows() > 1) {
            return $result->result();
        } else {
            return $result->row();
        }
    }

    protected function GetRecordArray($tableName, $where) {
        $result = $this->db->get_where($tableName, $where);
        if ($result->num_rows() > 1) {
            return $result->result_array();
        } else {
            return $result->row_array();
        }
    }

    protected function InsertRecord($tableName, $data) {
        $this->db->insert($tableName, $data);
        return $this->db->insert_id();
    }

    protected function UpdateRecord($tableName, $where, $data) {
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update($tableName, $data);
    }

    protected function UpdateRecordIfChanged($tableName, $where, $data) {
        $oldData = $this->db->get_where($tableName, $where);
        // めんどくさいのであとでやるかも。
    }
    
    protected function DeleteRecord($tableName, $where) {
        $this->db->where($where);
        $this->db->delete($tableName);
    }

    protected function GetAllNames($tableName, $select) {
        $this->db->select($select);
        return $this->db->get($tableName)->result();
    }
}

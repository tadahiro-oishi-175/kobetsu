<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CaseController
 *
 * @author Oishi-Tadahiro
 */
class TagController extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function ViewAllTag() {
        //$result['tags'] = $this->tag_model->getAllTags();
        $result['tags'] = $this->tag_model->getTagDataListHtml();
        
        $this->load->view('tag/view_all_tag', $result);
    }

    public function AddTag() {
        if ($this->input->post('submit_AddNewTag') != NULL) {
            $this->BeginTransaction();
            $data = array(
                'TagName' => $this->input->post('TagName'),
            );
            
            $id = $this->tag_model->insertTag($data);
            $this->EndTransaction();
            $this->ViewAllTag();
        } else {
            $result['selectOS'] = NULL;
            $this->load->view('tag/view_add_newTag', $result);
        }
    }

    public function EditTag($TagID) {
        if ($this->input->post('submit_EditTag') != NULL) {
            $this->BeginTransaction();

            // Edit
            $this->tag_model->updateTag($where, $data);

            $this->EndTransaction();
        } else {
            $result = NULL;
            $this->load->view('', $result);
        }
    }

    public function DeleteTag($TagID) {
        $this->BeginTransaction();

        // Delete
        $this->tag_model->deleteTag($where);

        $this->EndTransaction();
    }
}

<?php

class Comments_Model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function add_comment($comment_data) {
        $this->db->insert('comments', $comment_data);
    }

    function delete_comments($id) {
        $this->db->delete('comments', array('user_id' => $id));
        $this->db->delete('comments', array('profile_id' => $id));
    }

    function get_comments_byid($id) {
        $this->db->select('users.first_name, users.last_name, comments.messages_id, comments.comment, comments.created_at, comments.id ');
        $this->db->from('comments');
        $this->db->join('users', 'users.id = comments.user_id');
        $this->db->where('profile_id', $id);
        $this->db->order_by('comments.id ASC');
        $query = $this->db->get();
        // $query = $this->db->get_where('comments', array('profile_id' => $id))->result();
        return $query->result();
    }

}

//end of file
<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('get_user')) {
    function get_user($id){
        $CI =& get_instance();
    
        $query = $CI->db->get_where('user', array('id_user' => $id), 1, 0);
        foreach ($query->result() as $row){
            // Return a object with userdata!
            return $row;
        }
    }
}
<?php

if (!function_exists('helper_log')) {

    function helper_log($aktifitas, $status, $desc, $nop = "", $user_id = "") {
        $ci = & get_instance();

        $user_id = $user_id ? $user_id : $ci->session->userdata('user_id');
        $ci->db->set('user_id', $user_id);
        $ci->db->set('log_aktifitas', $aktifitas);
        $ci->db->set('log_status', $status);
        $ci->db->set('ip_address', $ci->input->ip_address());
        $ci->db->set('log_time', date('Y-m-d H:i:s'));
        $ci->db->set('log_by', (!empty($ci->session->userdata('user_id')) ? $ci->session->userdata('user_id') : $user_id));
        if (is_array($desc)) {
            $desc = json_encode($desc);
        }
        $ci->db->set('log_desc', $desc);
        if ($ci->db->insert('log_activity')) {
            return true;
        }
        return false;
    }

}

if (!function_exists('auto_code')) {

    function auto_code($prefix, $delim = "-", $position = "append") {

        $ci = & get_instance();
        $values = array($prefix);
        $ci->db->query("INSERT INTO auto_code (prefix, sequence ) VALUES ( ?, 1 ) ON DUPLICATE KEY UPDATE sequence  =  sequence + 1", $values);
        $result = $ci->db->query("SELECT sequence FROM auto_code WHERE prefix = ?", $values);
        $row = $result->row();
        if ($position == "append") {
            $result = strtoupper($prefix) . $delim . str_pad($row->sequence, 5, '0', STR_PAD_LEFT);
        } else {
            $result = str_pad($row->sequence, 5, '0', STR_PAD_LEFT) . $delim . strtoupper($prefix);
        }

        return $result;
    }

}
?>
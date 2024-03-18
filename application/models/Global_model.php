<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Global_model extends CI_Model
{
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if (!isset($is_logged_in) || $is_logged_in != true) {
			redirect(site_url()."login", 'reload');
		}
	}

}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Enc extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('secure'); // load library secure yg telah kita buat
    }

    public function index()
    {
        $id             = 2020; // data yg akan di enkripsi
        $encrypt_id     = $this->secure->encrypt_url($id); // mengenkripsi $id
        $decrypt_id     = $this->secure->decrypt_url($encrypt_id); // mendekripsi $encrypt_id

        //Output
        echo "<b>Text asli: </b>" . $id;
        echo "<br/> <br/>";
        echo "<b>Text di Enkripsi: </b>" . $encrypt_id;
        echo "<br/><br/>";
        echo "<b>Text di Dekripsi:</b> " . $decrypt_id;
        echo "<br/> <br/>";
        echo "<b>URL di Enkripsi: </b>" . base_url() . "EnkripsiDanDekripsi/" . $encrypt_id;
        echo "<br/> <br/>";
        echo "<b>URL di Dekripsi: </b>" . base_url() . "EnkripsiDanDekripsi/" . $decrypt_id;
    }
}
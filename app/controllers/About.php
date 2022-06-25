<?php

class About {

    public function index($nama = null, $pekerjaan = null)
    {
        if (is_null($nama) || is_null($pekerjaan)) {
            echo 'Parameter harus diisi';
            return;
        }
        echo "Hallo saya $nama, saya adalah $pekerjaan";
    }

    public function page()
    {
        echo 'About/page';
    }

    // Nambah comment ini harus di push
}
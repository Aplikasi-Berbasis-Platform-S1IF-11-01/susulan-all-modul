<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$profil = [
    'nama'      => 'Deshan Rafif Alfarisi',
    'pekerjaan' => 'Web Developer',
    'lokasi'    => 'Jakarta',
    'nim'       => '2311102326',
    'modul'     => 'Modul 10 - AJAX'
];

echo json_encode($profil);
?>

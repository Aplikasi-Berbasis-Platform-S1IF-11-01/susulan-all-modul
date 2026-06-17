<?php
header('Content-Type: application/json');

$profil = [
    'nama' => 'Nofita Fitriyani',
    'pekerjaan' => 'Lagi nganggur ueyy :(',
    'lokasi' => 'Puertorico'
];

echo json_encode($profil);
?>
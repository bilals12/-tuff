<?php
header('Content-type: application/json');
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('HTTP/1.0 404 Not Found');
    exit();
}
require '../../../../backend/configuration/database.php';
require '../../../../backend/configuration/funcsinit.php';
if (!$user->UserLoggedIn() || !$user->notBanned($odb)) {
    header('HTTP/1.0 404 Not Found');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $AttacksDB = $odb->query("SELECT hour(`datetime`) AS hour, COUNT(*) AS count FROM `attacklogs` GROUP BY hour(`datetime`) ORDER BY hour(`datetime`)");
    $data = array();
    while ($row = $AttacksDB->fetch(PDO::FETCH_ASSOC)) {
        $data[] = array('hour' => '' . $row['hour'] . ':00', 'attacks' => $row['count']);
    }
    echo json_encode($data);
}
?>
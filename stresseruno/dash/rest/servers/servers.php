<?php
$ServerDB = $odb->query("SELECT * FROM `servers` ORDER BY `id` ASC");
while ($serverinfo = $ServerDB->fetch(PDO::FETCH_ASSOC)) {
    $name = $serverinfo['name'];
    $type = $serverinfo['type'];
    $slots = $serverinfo['slots'];
    $status = $serverinfo['status'];
    $premium = $serverinfo['premium'];
    if ($premium == 'no') {
        $premiumtext = '<span class="vnm-dark-badge px-2 py-1 rounded-lg">Basic</span>';
    } else if ($premium == 'yes') {
        $premiumtext = '<span class="vnm-dark-badge px-2 py-1 rounded-lg">Premium</span>';
    }
    if ($status == 'online') {
        $statustext = '<i class="fa-solid fa-check"></i> Online';
    } else if ($status == 'offline') {
        $statustext = '<i class="fa-solid fa-xmark"></i> Offline';
    } else if ($status == 'maintaince') {
        $statustext = '<i class="fa-solid fa-triangle-exclamation"></i> Maintenance';
    }
    $CheckLogs = $odb->prepare("SELECT COUNT(*) FROM `attacklogs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0 AND `servers` = :server");
    $CheckLogs->execute(array(':server' => $name));
    $runningattacks = $CheckLogs->fetchColumn(0);
    $CheckServers = $odb->prepare("SELECT `slots` FROM `servers` WHERE `name` = :server");
    $CheckServers->execute(array(':server' => $name));
    $serverslots = $CheckServers->fetchColumn(0);
    $serverload = $serverslots - $runningattacks;
    $percentagefull = ($runningattacks / $serverslots) * 100;
    $percentage = round($percentagefull, 2);
    if ($percentage >= 0 AND $percentage <= 35) {
        $loadbar = '
				<div class="progress mt-1 mx-md-5 mx-lg-5 mx-xl-5 mx-xxl-5" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" title="' . $runningattacks . '/' . $serverslots . '">
	                <div class="progress-bar bg-green progress-bar-animated" style="width: ' . $percentage . '%;" role="progressbar" aria-valuenow="' . $percentage . '" aria-valuemin="0" aria-valuemax="100"></div>
	            </div>';
    } else if ($percentage >= 36 AND $percentage <= 74) {
        $loadbar = '
				<div class="progress mt-1 mx-md-5 mx-lg-5 mx-xl-5 mx-xxl-5" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" title="' . $runningattacks . '/' . $serverslots . '">
	                <div class="progress-bar bg-orange progress-bar-animated" style="width: ' . $percentage . '%;" role="progressbar" aria-valuenow="' . $percentage . '" aria-valuemin="0" aria-valuemax="100"></div>
	            </div>';
    } else if ($percentage >= 75 AND $percentage <= 100) {
        $loadbar = '
				<div class="progress mt-1 mx-md-5 mx-lg-5 mx-xl-5 mx-xxl-5" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" title="' . $runningattacks . '/' . $serverslots . '">
	                <div class="progress-bar bg-red progress-bar-animated" style="width: ' . $percentage . '%;" role="progressbar" aria-valuenow="' . $percentage . '" aria-valuemin="0" aria-valuemax="100"></div>
	            </div>';
    } else if ($percentage > 100) {
        $loadbar = '
				<div class="progress mt-1 mx-md-5 mx-lg-5 mx-xl-5 mx-xxl-5" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="custom-tooltip" title="' . $runningattacks . '/' . $serverslots . '">
	                <div class="progress-bar bg-red progress-bar-animated" style="width: ' . $percentage . '%;" role="progressbar" aria-valuenow="' . $percentage . '" aria-valuemin="0" aria-valuemax="100"></div>
	            </div>';
    }
    echo '
			<tr>
	            <td>' . $name . '</td>
	            <td>
	              ' . $loadbar . '
	            </td>
	            <td class="text-center">' . $premiumtext . '</td>
	            <td class="text-center">' . $statustext . '</td>
	        </tr>
		';
}
?>
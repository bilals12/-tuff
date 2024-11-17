<?php
require_once '../backend/configuration/database.php';
require_once '../backend/configuration/funcsinit.php';
if (!$user->UserLoggedIn()) {
    header('Location: /login');
    exit;
}
if ($user->isUserAdmin($odb)) {
    $adminli = '<li><a class="dropdown-item" href="admin/home">Admin Dash</a></li>';
} else {
    $adminli = '';
}
if ($user->isUserSupport($odb)) {
    $supportli = '<li><a class="dropdown-item" href="support/home">Support Dash</a></li>';
} else {
    $supportli = '';
}
if (!($user->activeMembership($odb))) {
    header('Location: rest/user/logout.php');
}
$UserInfoDB = $odb->prepare("SELECT * FROM `users` WHERE `id` = :id");
$UserInfoDB->execute(array(':id' => $_SESSION['id']));
$user = $UserInfoDB->fetch(PDO::FETCH_ASSOC);
$planid = $user['plan'];
$Notifs = $odb->prepare("SELECT * FROM `notifications` WHERE `username` = :user");
$Notifs->execute(array(':user' => $_SESSION['username']));
$notifs = $Notifs->fetch(PDO::FETCH_ASSOC);
$notifsnumb = $Notifs->rowCount();
$PlanDB = $odb->prepare("SELECT * FROM `plans` WHERE `id` = :id");
$PlanDB->execute(array(':id' => $planid));
$plan = $PlanDB->fetch(PDO::FETCH_ASSOC);
$concs = $plan['concs'];
$dbcreated = strtotime($user['created']);
$created = date('m/d/Y H:i', $dbcreated);
$dexp = $user['planexpire'];
$expire = date('m/d/Y H:i', $dexp);
if ($setting['maintenance'] == 'yes') {
    header('Location: maintenance');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  	<title>Stresser.uno &mdash; <?php echo $pagename; ?></title>

  	<link rel="icon" href="assets/img/logo.png" type="image/x-icon">
 
    <script src="assets/vendor/js/jquery.min.js"></script>
   	<script src="assets/vendor/js/moment.min.js"></script>
    <script src="assets/vendor/js/chart.js"></script>

    <link rel="stylesheet" type="text/css" href="assets/css/styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="assets/vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/css/toastify.min.css">
   
    <script src="assets/vendor/js/apexcharts.js"></script>
    
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    
    <script src="assets/vendor/js/nouislider.min.js"></script>
    <link rel="stylesheet" href="assets/css/nouislider.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="assets/css/datatables.css?v=<?php echo time(); ?>">
    <script src="assets/vendor/js/wNumb.min.js"></script>


</head>
<body class="bg-gray-900">
	
	<div id="preloader">
    	<span class="loader-animated"></span>
  	</div>
	
	<nav class="navbar navbar-dark bg-gray-800 border-gray-nav">
	  	<div class="container">
		    <a class="navbar-brand" href="home">
		    	<!-- <img src="LOGO" class="mr-3 img-logo" alt="Stresser.TOP Logo" style="height:30px;" /> -->
	        	<span class="self-center logo-text">Stresser<span style="color: #b4c6fc;">.uno</span></span>
	        </a>
		    <div class="d-flex align-items-center">
		    	<div class="flex-shrink-0 dropdown">
		      		<a href="#" class="nav-item-vnm me-2" id="notifdrop" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-regular fa-bell"></i></a>
		      		
		      		<ul class="dropdown-menu profildrop bg-gray-700 dropdown-menu-end rounded-0 mt-2 pt-0 text-small shadow" aria-labelledby="notifdrop">
			          	<li><a class="dropdown-item">No notifications</a></li>
			            
			        </ul>
		      	</div>
		      	<div class="flex-shrink-0 dropdown">
		          <a href="#" class="d-block link-dark text-decoration-none ml-3" id="profiledrop" data-bs-toggle="dropdown" aria-expanded="false">
		            <img src="https://ui-avatars.com/api/?name=<?php echo $_SESSION['username']; ?>&background=b4c6fc&color=fff&rounded=true" alt="mdo" class="rounded-circle profile-img">
		          </a>
		          <ul class="dropdown-menu profildrop bg-gray-700 dropdown-menu-end rounded-0 mt-2 pt-0 text-small shadow" aria-labelledby="profiledrop">
		          	<div class="">
		          		<div class="px-4 py-2 mt-2">
                        	<h6 class="mb-0 text-white"><?php echo $_SESSION['username']; ?></h6>
                        	<p class="mb-0 font-size-11 text-gray-400 fw-semibold">Balance: <?php echo $user['balance']; ?>$</p>
                        </div>
                    </div>
		            <li><hr class="dropdown-divider"></li>
		            <li><a class="dropdown-item" href="profile">Profile</a></li>
		            <?php echo $adminli; ?>
		            <?php echo $supportli; ?>
		            <li><a class="dropdown-item pointer" onclick="SignOut()">Sign out</a></li>
		          </ul>
		        </div>
		    </div>
	  	</div>
	</nav>
	<nav class="navbar navbar-expand-lg navbar-dark bg-gray-800">
	  <div class="container">
	    
	    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarunder" aria-controls="navbarunder" aria-expanded="false" aria-label="Toggle navigation">
	      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
	    </button>
	    <div class="navbar-collapse justify-content-md-center collapse" id="navbarunder">
	      <ul class="navbar-nav under-nav">
	        <li class="nav-item spacing">
	          <a class="nav-link d-inline-flex <?=$pagename == 'Dashboard' ? 'active' : '' ?>" aria-current="page" href="home">
	          	<svg class="me-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg> Home
	          </a>
	        </li>
	        <li class="nav-item spacing">
	          <a class="nav-link d-inline-flex <?=$pagename == 'Stress Panel' ? 'active' : '' ?>" href="stress">
	          	<svg class="me-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg> Stress Panel
	          </a>
	        </li>
	        <li class="nav-item spacing">
	          <a class="nav-link d-inline-flex <?=$pagename == 'Purchase' ? 'active' : '' ?>" href="purchase">
	          	<svg class="me-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg> Purchase
	          </a>
	        </li>
	        <li class="nav-item spacing">
	          <a class="nav-link d-inline-flex <?=$pagename == 'Deposit' ? 'active' : '' ?>" href="deposit">
	          	<svg class="me-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg> Deposit
	          </a>
	        </li>
	        <li class="nav-item spacing">
	          <a class="nav-link d-inline-flex <?=$pagename == 'API Manager' ? 'active' : '' ?>" href="manager">
	          	<svg class="me-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> API Manager
	          </a>
	        </li>
	        <li class="nav-item spacing">
	          <a class="nav-link d-inline-flex <?=$pagename == 'Support' ? 'active' : '' ?>" href="tickets">
	          	<svg class="me-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg> Support
	          </a>
	        </li>
	        <li class="nav-item spacing">
	          <a class="nav-link d-inline-flex" href="https://t.me/stresseruno" target="_blank">
	          	<svg class="me-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg> Telegram
	          </a>
	        </li>
			
	      </ul>
	    </div>
	  </div>
	</nav>







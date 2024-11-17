<?php
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
    $concs = intval($_POST['concs']);
    $attacktime = intval($_POST['attacktime']);
    $premium = intval($_POST['premium']);
    $blacklist = intval($_POST['blacklist']);
    $apiaccess = intval($_POST['apiaccess']);
    $price = intval($_POST['price']);
    $couponcode = htmlentities($user->CheckInput($_POST['coupon']));
    if (!(is_numeric($_POST['concs'])) || !(is_numeric($_POST['attacktime'])) || !(is_numeric($_POST['premium'])) || !(is_numeric($_POST['blacklist'])) || !(is_numeric($_POST['apiaccess'])) || !(is_numeric($_POST['price']))) {
        header('HTTP/1.0 400 Bad Request');
        exit();
    }
    if ($user->SecureText($couponcode)) {
        header('HTTP/1.0 400 Bad Request');
        exit();
    }
    if (empty($concs) && empty($attacktime) && empty($premium) && empty($blacklist) && empty($apiaccess) && empty($price)) {
        $errors[] = "You must select at least one addon";
        echo json_encode(array('status' => 'error', 'message' => 'You must select at least one add-on.'));
        die();
    }
    // CHECKING BALANCE
    $CheckBalance = $odb->prepare("SELECT `balance` FROM `users` WHERE `id` = :id AND `username` = :username");
    $CheckBalance->execute(array(':id' => $_SESSION['id'], ':username' => $_SESSION['username']));
    $balance = $CheckBalance->fetchColumn(0);
    // USER PLAN ID
    $CheckPlan = $odb->prepare("SELECT `plan` FROM `users` WHERE `id` = :id AND `username` = :username");
    $CheckPlan->execute(array(':id' => $_SESSION['id'], ':username' => $_SESSION['username']));
    $plan = $CheckPlan->fetchColumn(0);
    // USER ADD-ONS
    $UserAddons = $odb->prepare("SELECT `addon_concs`, `addon_time`, `addon_blacklist` FROM `users` WHERE `id` = :id AND `username` = :username");
    $UserAddons->execute(array(':id' => $_SESSION['id'], ':username' => $_SESSION['username']));
    $useraddons = $UserAddons->fetch(PDO::FETCH_ASSOC);
    // CHECKING PLAN INFO
    $SQLPlan = $odb->prepare("SELECT `time`, `concs` FROM `plans` WHERE `id` = :planid");
    $SQLPlan->execute(array(":planid" => $plan));
    $planinfo = $SQLPlan->fetch(PDO::FETCH_ASSOC);
    if ($plan == '0') {
        $errors[] = "Only paid membership can be upgraded with add-ons.";
        echo json_encode(array('status' => 'error', 'message' => 'Only paid membership can be upgraded with add-ons.'));
        die();
    }
    if ($price == '0') {
        $errors[] = "Price cannot be zero.";
        echo json_encode(array('status' => 'error', 'message' => 'Price cannot be zero.'));
        die();
    }
    // CHECKING FIELDS
    if (!empty($premium)) {
        $CheckPremium = $odb->prepare("SELECT `plans`.`premium` + `users`.`premium` FROM `plans`,`users` WHERE `users`.`plan` = `plans`.`id` AND `users`.`id` = :id");
        $CheckPremium->execute(array(':id' => $_SESSION['id']));
        $haspremium = $CheckPremium->fetchColumn(0);
        if ($haspremium > '0') {
            $errors[] = "You already have premium add-on";
            echo json_encode(array('status' => 'error', 'message' => 'You already have premium add-on.'));
            die();
        }
    } else if (!empty($apiaccess)) {
        $CheckAPI = $odb->prepare("SELECT `plans`.`apiaccess` + `users`.`apiaccess` FROM `plans`,`users` WHERE `users`.`plan` = `plans`.`id` AND `users`.`id` = :id");
        $CheckAPI->execute(array(':id' => $_SESSION['id']));
        $apiaccess = $CheckAPI->fetchColumn(0);
        if ($apiaccess > '0') {
            $errors[] = "You already have API access.";
            echo json_encode(array('status' => 'error', 'message' => 'You already have API access.'));
            die();
        }
    } else if (!empty($blacklist)) {
        if ($useraddons['addon_blacklist'] > '0') {
            $errors[] = "You already have blacklist add-on.";
            echo json_encode(array('status' => 'error', 'message' => 'You already have blacklist add-on.'));
            die();
        }
    }
    if (!empty($concs)) {
        if (($useraddons['addon_concs'] + $planinfo['concs'] + $concs) > 30) {
            $errors[] = "You already have blacklist add-on.";
            echo json_encode(array('status' => 'error', 'message' => 'The maximum number of concurrents is 30'));
            die();
        }
    }
    if (!empty($attacktime)) {
        if (($useraddons['addon_time'] + $planinfo['time'] + $attacktime) > 3600) {
            $errors[] = "The maximum attack time is 3600s.";
            echo json_encode(array('status' => 'error', 'message' => 'The maximum attack time is 3600s.'));
            die();
        }
    }
    // CHECKING CONCS PRICE
    if ($concs == 1 && $price < 20) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    } else if ($concs == 2 && $price < 40) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    } else if ($concs == 3 && $price < 60) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    } else if ($concs == 4 && $price < 80) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    } else if ($concs == 5 && $price < 100) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    } else if ($concs == 6 && $price < 120) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    } else if ($concs == 7 && $price < 140) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    } else if ($concs == 8 && $price < 160) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    } else if ($concs == 9 && $price < 180) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    } else if ($concs == 10 && $price < 200) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    }
    // CHECKING TIME PRICE
    if ($attacktime == 300 && $price < 5) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    } else if ($attacktime == 600 && $price < 10) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    } else if ($attacktime == 900 && $price < 15) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    } else if ($attacktime == 1200 && $price < 20) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    } else if ($attacktime == 1500 && $price < 25) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    } else if ($attacktime == 1800 && $price < 30) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    } else if ($attacktime == 2100 && $price < 35) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    } else if ($attacktime == 2400 && $price < 40) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    } else if ($attacktime == 2700 && $price < 45) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    } else if ($attacktime == 3000 && $price < 50) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    }
    // MORE CHECKS
    if ($premium == 1 && $price < 20) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    }
    if ($blacklist == 1 && $price < 40) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    }
    if ($apiaccess == 1 && $price < 25) {
        $errors[] = "Invalid price";
        echo json_encode(array('status' => 'error', 'message' => 'Invalid price'));
        die();
    }
    if (empty($errors)) {
        if (empty($couponcode)) {
            if ($price > $balance) {
                $errors[] = "You do not have enought balance for this addon.";
                echo json_encode(array('status' => 'error', 'message' => 'You do not have enought balance for this addon.'));
                die();
            } else if ($balance >= $price) {
                $SQLUpdate = $odb->prepare("UPDATE `users` SET `balance` = `balance` -:price, `addon_time` = `addon_time` + :attacktime, `addon_concs` = `addon_concs` + :concs, `addon_blacklist` = `addon_blacklist` + :blacklist, `premium` = `premium` + :premium, `apiaccess` = `apiaccess` + :apiaccess WHERE `username` = :user AND `id` = :id");
                $SQLUpdate->execute(array(':price' => $price, ':attacktime' => $attacktime, ':concs' => $concs, ':blacklist' => $blacklist, ':premium' => $premium, ':apiaccess' => $apiaccess, ':user' => $_SESSION['username'], ':id' => $_SESSION['id']));
                $SQLInsert = $odb->prepare("INSERT INTO `addons`(`id`, `user`, `concs`, `attacktime`, `blacklist`, `apiaccess`, `created_at`) VALUES (NULL, :user, :concs, :attacktime, :blacklist, :apiaccess, NOW())");
                $SQLInsert->execute(array(':user' => $_SESSION['username'], ':concs' => $concs, ':attacktime' => $attacktime, ':blacklist' => $blacklist, ':apiaccess' => $apiaccess));
                echo json_encode(array('status' => 'success', 'message' => 'You have successfully purchased an addon for ' . $price . '$'));
                die();
            }
        } else {
            if (!filter_var($couponcode, FILTER_SANITIZE_STRING)) {
                $errors[] = "Invalid coupon format!";
                echo json_encode(array('status' => 'error', 'message' => 'Invalid coupon format!'));
                die();
            }
            $CheckCoupon = $odb->prepare("SELECT `code`, `percent` FROM `addon_coupons` WHERE `code` = :code AND `expire_at` > UNIX_TIMESTAMP()");
            $CheckCoupon->execute(array(':code' => $couponcode));
            $checkc = $CheckCoupon->rowCount();
            $coupon = $CheckCoupon->fetch(PDO::FETCH_ASSOC);
            if ($checkc == 0) {
                $errors[] = "Invalid coupon code.";
                echo json_encode(array('status' => 'error', 'message' => 'Invalid coupon code.'));
                die();
            } else {
                $percent = $coupon['percent'];
                $discount = $price - (($price / 100) * $percent);
                if ($discount > $balance) {
                    $errors[] = "You do not have enought balance for this add-on.";
                    echo json_encode(array('status' => 'error', 'message' => 'You do not have enought balance for this add-on.'));
                    die();
                } else if ($balance >= $discount) {
                    $SQLUpdate = $odb->prepare("UPDATE `users` SET `balance` = `balance` -:price, `addon_time` = `addon_time` + :attacktime, `addon_concs` = `addon_concs` + :concs, `addon_blacklist` = `addon_blacklist` + :blacklist, `premium` = `premium` + :premium, `apiaccess` = `apiaccess` + :apiaccess WHERE `username` = :user AND `id` = :id");
                    $SQLUpdate->execute(array(':price' => $discount, ':attacktime' => $attacktime, ':concs' => $concs, ':blacklist' => $blacklist, ':premium' => $premium, ':apiaccess' => $apiaccess, ':user' => $_SESSION['username'], ':id' => $_SESSION['id']));
                    $SQLInsert2 = $odb->prepare("INSERT INTO `addons`(`id`, `user`, `concs`, `attacktime`, `blacklist`, `apiaccess`, `created_at`) VALUES (NULL, :user, :concs, :attacktime, :blacklist, :apiaccess, NOW())");
                    $SQLInsert2->execute(array(':user' => $_SESSION['username'], ':concs' => $concs, ':attacktime' => $attacktime, ':blacklist' => $blacklist, ':apiaccess' => $apiaccess));
                    echo json_encode(array('status' => 'success', 'message' => 'You have successfully purchased an addon for ' . $discount . '$'));
                    die();
                }
            }
        }
    }
} else {
    header('HTTP/1.0 400 Bad Request');
    exit();
}
?>
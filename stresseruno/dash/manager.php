<?php
$pagename = "API Manager";
include 'header.php';
$SelectAPI = $odb->prepare("SELECT `apitoken` FROM `users` WHERE `username` = :username AND `id` = :id");
$SelectAPI->execute(array(':username' => $_SESSION['username'], ':id' => $_SESSION['id']));
$apitoken = $SelectAPI->fetchColumn(0);
?>


  <div class="main">
    <div class="container mt-5 px-4">
      <div class="row g-4">
        <div class="col-md-12">
          <div class="card apicard">
            <div class="card-header">
              Your API key & link
            </div>
            <div class="card-body text-center">
              <div class="mb-3">
                <input type="text" class="form-control text-center" id="apitokenfield" readonly>
              </div>
              <div class="row g-2 text-center mb-3">
                <div class="col-md-2">
                  <button type="button" onclick="GenerateToken()" id="gentoken-btn" class="btn btn-vnm-indigo w-100 py-2">
                    <span id="createp_def"><i class="fa-solid fa-arrows-rotate"></i> Create</span>
                    <span id="createp_loadi" style="display: none;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please wait..</span>
                  </button>

                </div>
                <div class="col-md-2">
                  <button type="button" onclick="DisableToken()" id="distoken-btn" class="btn btn-vnm-red w-100 py-2">
                    <span id="createp_def"><i class="fa-solid fa-circle-xmark"></i> Disable Access</span>
                    <span id="createp_loadi" style="display: none;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please wait..</span>
                  </button>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card apicard">
            <div class="card-header">
              API Params
            </div>
            <div class="card-body">
              <ul>
                <li><span class="vnm-dark-badge py-1 px-2 rounded-lg">key</span> - Your API Key</li>
                <li><span class="vnm-dark-badge py-1 px-2 rounded-lg">host</span> - IP Address or Website URL</li>
                <li><span class="vnm-dark-badge py-1 px-2 rounded-lg">port</span> - Dest. Port (0-65535) | for Websites not required</li>
                <li><span class="vnm-dark-badge py-1 px-2 rounded-lg">time</span> - Attack Time (min 120 sec)</li>
                <li><span class="vnm-dark-badge py-1 px-2 rounded-lg">method</span> - Method Name from list</li>

              </ul>
                <div class="text-center">
                  <a class="advanced-drop" id="advanced-drop" data-bs-toggle="collapse" href="#viewmorecoll" role="button" aria-expanded="false" aria-controls="viewmorecoll">View More <i class="fa-solid fa-caret-down"></i></a>

                </div>
                <div class="collapse" id="viewmorecoll">
                  <ul>
                    <li><span class="vnm-dark-badge py-1 px-2 rounded-lg">concs</span> - Concurrents number (default 1)</li>
                    <li><span class="vnm-dark-badge py-1 px-2 rounded-lg">req_method</span> - Request method (GET, POST)</li>
                    <li><span class="vnm-dark-badge py-1 px-2 rounded-lg">reqs</span> - Requests per IP</li>

                  </ul>

                </div>
            </div>
          </div>

        </div>
        <div class="col-md-6">
          <div class="card apicard">
            <div class="card-header">
              Attack Methods
            </div>
            <div class="card-body">
              <ul>
                <li>Amplification <br>
                  <?php
$SelectL7 = $odb->query("SELECT * FROM `methods` WHERE `type` = 'AMP' ORDER BY `id` ASC");
$countm = $SelectL7->rowCount();
if ($countm == 0) {
    echo '<span class="vnm-dark-badge py-1 px-2 rounded-lg" style="font-size: .6rem;">NONE</span>';
} else {
    while ($methodinfo = $SelectL7->fetch(PDO::FETCH_ASSOC)) {
        $apiname = $methodinfo['apiname'];
        echo ' <span class="vnm-dark-badge py-1 px-2 rounded-lg" style="font-size: .6rem;">' . $apiname . '</span>';
    }
}
?>
                </li>
                <li>User Datagram Protocol <br>
                  <?php
$SelectL7 = $odb->query("SELECT * FROM `methods` WHERE `type` = 'UDP' ORDER BY `id` ASC");
$countm = $SelectL7->rowCount();
if ($countm == 0) {
    echo '<span class="vnm-dark-badge py-1 px-2 rounded-lg" style="font-size: .6rem;">NONE</span>';
} else {
    while ($methodinfo = $SelectL7->fetch(PDO::FETCH_ASSOC)) {
        $apiname = $methodinfo['apiname'];
        echo ' <span class="vnm-dark-badge py-1 px-2 rounded-lg" style="font-size: .6rem;">' . $apiname . '</span>';
    }
}
?>
                </li>
                <li>Transmission Control Protocol <br>
                  <?php
$SelectL7 = $odb->query("SELECT * FROM `methods` WHERE `type` = 'TCP' ORDER BY `id` ASC");
$countm = $SelectL7->rowCount();
if ($countm == 0) {
    echo '<span class="vnm-dark-badge py-1 px-2 rounded-lg" style="font-size: .6rem;">NONE</span>';
} else {
    while ($methodinfo = $SelectL7->fetch(PDO::FETCH_ASSOC)) {
        $apiname = $methodinfo['apiname'];
        echo ' <span class="vnm-dark-badge py-1 px-2 rounded-lg" style="font-size: .6rem;">' . $apiname . '</span>';
    }
}
?>
                </li>
                <li>Botnet <br>
                  <?php
$SelectL7 = $odb->query("SELECT * FROM `methods` WHERE `type` = 'BOTNET' ORDER BY `id` ASC");
$countm = $SelectL7->rowCount();
if ($countm == 0) {
    echo '<span class="vnm-dark-badge py-1 px-2 rounded-lg" style="font-size: .6rem;">NONE</span>';
} else {
    while ($methodinfo = $SelectL7->fetch(PDO::FETCH_ASSOC)) {
        $apiname = $methodinfo['apiname'];
        echo ' <span class="vnm-dark-badge py-1 px-2 rounded-lg" style="font-size: .6rem;">' . $apiname . '</span>';
    }
}
?>
                </li>
                <li>Basic Layer7 <br>
                  <?php
$SelectL7 = $odb->query("SELECT * FROM `methods` WHERE `type` = 'BASICL7' ORDER BY `id` ASC");
$countm = $SelectL7->rowCount();
if ($countm == 0) {
    echo '<span class="vnm-dark-badge py-1 px-2 rounded-lg" style="font-size: .6rem;">NONE</span>';
} else {
    while ($methodinfo = $SelectL7->fetch(PDO::FETCH_ASSOC)) {
        $apiname = $methodinfo['apiname'];
        echo ' <span class="vnm-dark-badge py-1 px-2 rounded-lg" style="font-size: .6rem;">' . $apiname . '</span>';
    }
}
?>
                </li>
                <li>Premium Layer7 <br>
                  <?php
$SelectL7 = $odb->query("SELECT * FROM `methods` WHERE `type` = 'PREMIUML7' ORDER BY `id` ASC");
$countm = $SelectL7->rowCount();
if ($countm == 0) {
    echo '<span class="vnm-dark-badge py-1 px-2 rounded-lg" style="font-size: .6rem;">NONE</span>';
} else {
    while ($methodinfo = $SelectL7->fetch(PDO::FETCH_ASSOC)) {
        $apiname = $methodinfo['apiname'];
        echo ' <span class="vnm-dark-badge py-1 px-2 rounded-lg" style="font-size: .6rem;">' . $apiname . '</span>';
    }
}
?>
                </li>
              </ul>
            </div>
          </div>

        </div>
      </div>
      </div>

    </div>
  </div>
 



<?php include 'footer.php'; ?>
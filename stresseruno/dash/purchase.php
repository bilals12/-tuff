<?php
$pagename = "Purchase";
include 'header.php';
?>


  <div class="main">
      <div class="container mt-5 px-4">
        <div class="row g-4">

          <?php
$SQLPlans = $odb->query("SELECT * FROM `plans` WHERE `private` = 'no' ORDER BY `id` ASC");
while ($plan = $SQLPlans->fetch(PDO::FETCH_ASSOC)) {
    $id = $plan['id'];
    $name = '' . $plan['name'] . '';
    $price = $plan['price'];
    $length = $plan['length'];
    $lengthtype = $plan['pagelength'];
    $concs = $plan['concs'];
    $time = $plan['time'];
    $premium = $plan['premium'];
    $apiaccess = $plan['apiaccess'];
    $support = $plan['supportprio'];
    if ($premium == 0) {
        $premiumtext = '
                  <svg class="flex-shrink-0 w-5 h-5 dvnm-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                  <span class="plan-spec plan-nospec">Premium</span>';
    } else if ($premium == 1) {
        $premiumtext = '
                  <svg class="flex-shrink-0 w-5 h-5 vnm-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                  <span class="plan-spec">Premium</span>';
    }
    if ($apiaccess == 0) {
        $apitext = '
                  <svg class="flex-shrink-0 w-5 h-5 dvnm-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                  <span class="plan-spec plan-nospec">API access</span>';
    } else if ($apiaccess == 1) {
        $apitext = '
                  <svg class="flex-shrink-0 w-5 h-5 vnm-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                  <span class="plan-spec">API access</span>';
    }
    if ($support == 0) {
        $supptext = '
                  <svg class="flex-shrink-0 w-5 h-5 dvnm-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                  <span class="plan-spec plan-nospec">Prioritized support</span>';
    } else if ($support == 1) {
        $supptext = '
                  <svg class="flex-shrink-0 w-5 h-5 vnm-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                  <span class="plan-spec">Prioritized support</span>';
    }
    if ($length == 1) {
        $lenghtt = '1 day';
    } else if ($length == 30) {
        $lenghtt = '1 month';
    }
    echo '
                <div class="col-12 col-md-4 col-lg-3">
                  <div class="card rounded-lg purchase-card">
                    <h5 class="mb-3">' . $name . '</h5>
                    <div class="d-flex align-items-baseline purchase-price">
                      <span class="pricing-currency">$</span>
                      <span class="pricing-price">' . $price . '</span>
                      <span class="ms-1 pricing-time">/' . strtolower($lengthtype) . '</span>
                    </div>
                    <ul>
                      <li class="d-flex ">
                        <svg class="flex-shrink-0 w-5 h-5 vnm-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span class="plan-spec">' . $concs . ' concurrent</span>
                      </li>
                      <li class="d-flex ">
                        <svg class="flex-shrink-0 w-5 h-5 vnm-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span class="plan-spec">' . $time . ' seconds</span>
                      </li>
                      <li class="d-flex ">
                        ' . $premiumtext . '
                      </li>
                      <li class="d-flex ">
                        ' . $apitext . '
                      </li>
                      <li class="d-flex ">
                        ' . $supptext . '
                      </li>
                  </ul>
                    <button type="button" name="' . $name . '" id="' . $id . '" onclick="PurchasePlan(this)" id="purchase-btn" class="btn btn-vnm-indigo w-100 py-2">
                      <span id="purcp_def"><i class="fa-solid fa-basket-shopping"></i>
                     Purchase
                    </span>
                          <span id="purcp_loadi" style="display: none;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
                           Please wait..
                          </span>
                  </button>
                  </div>
                </div>';
}
?>
          


          <div class="col-12 col-md-12 mb-5">
            <div class="card rounded-lg bg-gray-800 pupgrade-card">
              <div class="card-body">
                <div class="row">
                  
                  <div class="col-12 col-md-7 mx-4 py-2 mt-2">
                    <h5>Do you want to upgrade your plan?</h5>
                    <p>Upgrading your plan unlocks new features. You can buy more concurrents, attack time, premium hub access or api access. Also you can buy blacklist for your website or ip address, which means that attacks on your site/ip from our stresser will be blocked. You can purchase it <a data-bs-toggle="modal" data-bs-target="#upgrade-modal" class="here-link">here</a>.</p>
                  </div>
                  

               </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="upgrade-modal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content bg-gray-800">
            <div class="modal-header">
              <p class="modal-title" id="upgrademodal-label">Purchase Add-on</p>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="container">
                <div class="row">
                  <div class="col-lg-6 mb-2">
                    <div class="form-group">
                      <label for="addonconcurrents">Extra Concurrents</label>
                      <select class="form-select custom-select" onclick="addon_price()" id="addonconcurrents" name="addonconcurrents">
                        <option value="0">None</option>
                        <option value="1">1 (+ 20$)</option>
                        <option value="2">2 (+ 40$)</option>
                        <option value="3">3 (+ 60$)</option>
                        <option value="4">4 (+ 80$)</option>
                        <option value="5">5 (+ 100$)</option>
                        <option value="6">6 (+ 120$)</option>
                        <option value="7">7 (+ 140$)</option>
                        <option value="8">8 (+ 160$)</option>
                        <option value="9">9 (+ 180$)</option>
                        <option value="10">10 (+ 200$)</option>
                        <option value="11">11 (+ 220$)</option>
                        <option value="12">12 (+ 240$)</option>
                        <option value="13">13 (+ 260$)</option>
                    
                      </select>
                    </div>  
                </div>
                <div class="col-lg-6 mb-2">
                    <div class="form-group">
                      <label for="addonboottime">Extra Boot Time</label>
                      <select class="form-select custom-select" onclick="addon_price()" id="addonboottime" name="addonboottime">
                        <option value="0">None</option>
                        <option value="300">300s (+ 5$)</option>
                        <option value="600">600s (+ 10$)</option>
                        <option value="900">900s (+ 15$)</option>
                        <option value="1200">1200s (+ 20$)</option>
                        <option value="1500">1500s (+ 25$)</option>
                        <option value="1800">1800s (+ 30$)</option>
                        <option value="2100">2100s (+ 35$)</option>
                        <option value="2400">2400s (+ 40$)</option>
                        <option value="2700">2700s (+ 45$)</option>
                        <option value="3000">3000s (+ 50$)</option>
                        
                      </select>
                    </div>  
                </div>
                <div class="col-lg-6 mb-2">
                    <div class="form-group">
                      <label for="addonpremium">Premium Methods</label>
                      <select class="form-select custom-select" onclick="addon_price()" id="addonpremium" name="addonpremium">
                        <option value="0">No</option>
                        <option value="1">Yes (+ 20$)</option>
                        
                        
                      </select>
                      <input class="form-control" type="text" id="premium" readonly hidden>
                    </div>  
                </div>
                <div class="col-lg-6 mb-2">
                    <div class="form-group">
                      <label for="addonblacklist">Blacklist</label>
                      <select class="form-select custom-select" onclick="addon_price()" id="addonblacklist" name="addonblacklist">
                        <option value="0">No</option>
                        <option value="1">Yes (+ 40$)</option>
                        
                        
                      </select>
                      <input class="form-control" type="text" id="blacklist" readonly hidden>
                    </div>  
                </div>
                <div class="col-lg-12 mb-2">
                    <div class="form-group">
                      <label for="addonapi">API Access</label>
                      <select class="form-select custom-select" onclick="addon_price()" id="addonapi" name="addonapi">
                        <option value="0">No</option>
                        <option value="1">Yes (+ 25$)</option>
                      </select>
                      <input class="form-control" type="text" id="apiaccess" readonly hidden>
                    </div>  
                </div>
              </div>
              </div>  
              
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    
                    <input type="text" class="form-control" id="concurrents_total" readonly hidden>
                    <input class="form-control" type="text" id="base_concurrents" readonly hidden>
                    <input class="form-control" type="text" id="extraconcurrents" readonly hidden >
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <input type="text" class="form-control" id="maxboot_total" readonly hidden>
                    <input class="form-control" type="text" id="base_maxboot" readonly hidden>
                    <input class="form-control" type="text" id="maxboot" readonly hidden>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-label">Total Price</label>
                    <input type="text" class="form-control" id="price_total" readonly>
                    <input class="form-control" type="text" id="base_price" readonly hidden>
                    <input class="form-control" type="text" id="price" readonly hidden >
                  </div>
                </div>

              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <div class="col-md-6">
                  <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-ticket"></i></span>
                    <input type="text" class="form-control" placeholder="Coupon code" aria-label="Coupon" id="couponcodeaddon" aria-describedby="addon-wrapping">
                  </div>

                </div>
                <div class="col-md-6">
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-vnm-red py-2" id="cancelupgrade-btn" data-bs-dismiss="modal" aria-label="Close">
                      <span id="cancelupgrade_def"><i class="fa-solid fa-xmark" style="color: #fff !important;"></i>
                        Cancel 
                      </span>
                      <span id="cancelupgrade_loadi" style="display: none;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
                       Please wait..
                      </span>
                    </button>
                    <button type="button" onclick="PurchaseAddon()" class="btn btn-vnm-indigo py-2" id="pupgrade-btn">
                      <span id="pupgrade_def"><i class="fa-solid fa-cash-register"></i>
                        Purchase
                      </span>
                      <span id="pupgrade_loadi" style="display: none;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
                       Please wait..
                      </span>
                    </button>
                  </div>
                </div>

              </div>
              
            </div>
          </div>
        </div>
      </div>



      <div class="modal fade" id="purchase-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content bg-gray-800">
            <div class="modal-header">
              <p class="modal-title" id="purchasemodal-label"></p>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <ul class="profile-plan list-group list-group-flush d-inline text-start">
                <li class="list-group-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg> <span>Concurrents</span><br><b id="planconcs"></b></li>
                <li class="list-group-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> <span>Attack Time</span><br><b id="planatime"></b></li>
                <li class="list-group-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg> <span>Premium</span><br><b id="planpremium"></b></li>
                <li class="list-group-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> <span>API Access</span><br><b id="planapi"></b></li>
                <li class="list-group-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> <span>Total Price</span><br><b id="planprice"></b></li>
                
              </ul>
            </div>
            <div class="modal-footer">
              <div class="row">
                <div class="col-md-6">
                  <div class="input-group flex-nowrap mb-2">
                    <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-ticket"></i></span>
                    <input type="text" class="form-control" placeholder="Coupon code" aria-label="Coupon" id="couponcode2" aria-describedby="addon-wrapping">
                  </div>

                </div>
                <div class="col-md-6">
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-vnm-red py-2" id="cancelpurchase-btn" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark" style="color: #fff !important;"></i> Cancel</button>
                    <button type="button" class="btn btn-vnm-indigo py-2" id="purchase-btnnnn"><i class="fa-solid fa-cash-register"></i> Purchase</button>
                  </div>
                </div>

              </div>
              
            </div>
          </div>
        </div>
      </div>


      </div>
    </div>




<?php include 'footer.php'; ?>
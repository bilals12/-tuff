<?php
$pagename = "Dashboard";
include 'header.php';
?>

	<div class="main">
  		<div class="container mt-5 px-4">
  			<div class="row g-4">
  				<div class="col-12 col-md-4">
  					<div class="card rounded-lg bg-gray-800 p-4 profile-card">
  						<div class="card-body">
  							<div class="d-flex flex-column align-items-center text-center">
  							<img src="https://ui-avatars.com/api/?name=<?php echo $_SESSION['username']; ?>&background=8DA2FB&color=fff&rounded=true" alt="mdo" class="rounded-circle">
  							<div class="mt-3">
  								<h6><?php echo $_SESSION['username']; ?></h6>
  								<span class="vnm-indigo-badge px-2 py-1 rounded-lg"><?php echo $plan['name']; ?></span>
  							</div>
  							
  							</div>
  							<div class="mt-4">
		                        <ul class="profile-plan list-group list-group-flush d-inline text-start">
		                          <li class="list-group-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg> <span>Concurrents</span><br><b><?php echo $plan['concs'] + $user['addon_concs']; ?></b></li>
		                          <li class="list-group-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> <span>Attack Time</span><br><b><?php echo $plan['time'] + $user['addon_time']; ?></b></li>
		                          <li class="list-group-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> <span>Expire</span><br><b><?php echo $expire; ?></b></li>
		                          
		                        </ul>
		                    </div>
  						</div>
  					</div>
  				</div>
  				<div class="col-12 col-md-8">
  					<div class="card rounded-lg bg-gray-800 p-4 profile-options">
  						<div class="card-header">
  							<ul class="nav justify-content-center">
							  <li class="nav-item">
							    <a class="nav-link active" id="account-tab" data-bs-toggle="tab" data-bs-target="#account-tab-pane" type="button" role="tab" aria-controls="account-tab-pane" aria-selected="false">Account</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings-tab-pane" type="button" role="tab" aria-controls="settings-tab-pane" aria-selected="false">Settings</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment-tab-pane" type="button" role="tab" aria-controls="payment-tab-pane" aria-selected="false">Payment History</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="stat-tab" data-bs-toggle="tab" data-bs-target="#stat-tab-pane" type="button" role="tab" aria-controls="stat-tab-pane" aria-selected="false">Delete Account</a>
							  </li>
							</ul>
  						</div>
  						<div class="card-body">
  							<div class="tab-content" id="profiletab">
							  <div class="tab-pane fade show active" id="account-tab-pane" role="tabpanel" aria-labelledby="account-tab" tabindex="0">
							  	<div class="row">
							  		<div class="col-md-12 mt-3">
							  			<ul class="list-group list-group-flush">
										  <li class="list-group-item">
										  	<div class="row">
							                    <div class="col-md-6">
							                      <h6 class="mb-0">Username</h6>
							                    </div>
							                    <div class="col-md-6 content">
							                      <?php echo $_SESSION['username']; ?>
							                    </div>
							                </div>
										  </li>
										  <li class="list-group-item">
										  	<div class="row">
							                    <div class="col-md-6">
							                      <h6 class="mb-0">Email</h6>
							                    </div>
							                    <div class="col-md-6 content">
							                      <?php echo $user['email']; ?>
							                    </div>
							                </div>
										  </li>
										  <li class="list-group-item">
										  	<div class="row">
							                    <div class="col-md-6">
							                      <h6 class="mb-0">Balance</h6>
							                    </div>
							                    <div class="col-md-6 content">
							                      <?php echo '' . $user['balance'] . '$'; ?>
							                    </div>
							                </div>
										  </li>
										  <li class="list-group-item">
										  	<div class="row">
							                    <div class="col-md-6">
							                      <h6 class="mb-0">Plan</h6>
							                    </div>
							                    <div class="col-md-6 content">
							                      <?php echo $plan['name']; ?>
							                    </div>
							                </div>
										  </li>
										  <li class="list-group-item">
										  	<div class="row">
							                    <div class="col-md-6">
							                      <h6 class="mb-0">Rank</h6>
							                    </div>
							                    <div class="col-md-6 content">
							                      <?php echo $_SESSION['rank']; ?>
							                    </div>
							                </div>
										  </li>
										  <li class="list-group-item">
										  	<div class="row">
							                    <div class="col-md-6">
							                      <h6 class="mb-0">Secret key</h6>
							                    </div>
							                    <div class="col-md-6 content">
							                      <span class="spoiler" id="secretkey"><?php echo $user['secretkey']; ?></span>
							                    </div>
							                </div>
										  </li>
										  <li class="list-group-item">
										  	<div class="row">
							                    <div class="col-md-6">
							                      <h6 class="mb-0">Created</h6>
							                    </div>
							                    <div class="col-md-6 content">
							                      <?php
echo $created;
?>
							                    </div>
							                </div>
										  </li>
										  
										</ul>
									</div>
							  	</div>
							  </div>
							  <div class="tab-pane fade" id="settings-tab-pane" role="tabpanel" aria-labelledby="settings-tab" tabindex="0">
							  	<div class="row">
							  		<div class="col-md-6 mt-3">
							  			<div class="mb-3">
										    <label for="currpassword" class="form-label">Current Password</label>
										    <input type="password" class="form-control" placeholder="Current password" id="currpassword" required>
										    
										</div>
										<div class="mb-3">
										    <label for="npassword" class="form-label">New Password</label>
										    <input type="password" class="form-control" placeholder="New password" id="npassword" required>
										    
										</div>
										<div class="mb-3">
										    <label for="cpassword" class="form-label">Confirm Password</label>
										    <input type="password" class="form-control" placeholder="Current password" id="cpassword" required>
										    
										</div>
										<button type="button" onclick="ChangePass()" id="savepassbtn" class="btn btn-vnm-indigo w-100 py-2">
						  					<span id="savepass_def"><i class="fa-solid fa-floppy-disk"></i>
										 	 Save
										 	</span>
                            				<span id="savepass_loadi" style="display: none;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
                            				 Please wait..
                            				</span>
										</button>
									</div>
									

							  	</div>
							  </div>
							  <div class="tab-pane fade" id="payment-tab-pane" role="tabpanel" aria-labelledby="payment-tab" tabindex="0">
							  	<div class="table-responsive mx-2">
				                  <table id="billing-table" style="width:100%" class="mt-2 stripe display table bg-gray-800 table-striped table-bordered border-gray">
				                    <thead>
				                      <tr>
				                      	<th scope="col" class="text-start">ID</th>
				                        <th scope="col" class="text-center">Type</th>
				                        <th scope="col" class="text-center">Amount</th>
				                       	<th scope="col" class="text-center">Status</th>
				                        <th scope="col" class="text-center">Date</th>
				                        <th scope="col" class="text-center">Action</th>
				                      </tr>
				                    </thead>
				                    
				                  </table>
				                </div>
							  </div>
							  <div class="tab-pane fade" id="stat-tab-pane" role="tabpanel" aria-labelledby="stat-tab" tabindex="0">
							  	<div class="row">
							  		<div class="col-md-6 mt-3">
										<div class="mb-3">
										    <h6>Delete your account</h6>
										    <p>Your account can not be recovered in any way, so please be careful.</p>
										    
										    <button type="button" onclick="DeleteAcc()" id="deleteaccbtn" class="btn btn-vnm-red w-100 py-2">
							  					<span id="delete_def"><i class="fa-solid fa-trash-can"></i>
											 	 Delete
											 	</span>
	                            				<span id="delete_loadi" style="display: none;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
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

  				</div>





  			
  			</div>
  		</div>
  	</div>
<?php include 'footer.php'; ?>
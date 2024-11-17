<?php
$pagename = "Deposit";
include 'header.php';
?>


	<div class="main">
  		<div class="container mt-5 px-4">
  			<div class="row g-4">
  				<div class="col-md-4">
  					<div class="card funds-div rounded-lg bg-gray-800">
  						<div class="card-header">
  							Deposit funds
  						</div>
  						<div class="card-body">
  							<div class="mx-2">
  								<div class="row mt-1">
  									<div class="col-md-12">
  										<div class="mb-3">
										    <label for="depamount" class="form-label">Amount</label>
										    <input type="text" class="form-control" placeholder="10$" id="depamount" required>
										    
										</div>
  									</div>
  									<div class="col-md-12">
  										<div class="mb-4">
										    <label for="gateway" class="form-label">Payment gateway</label>
										    <select class="form-select" id="gateway">
											  <option value="0" selected>Select payment gateway</option>
											  <option value="BITCOIN">Bitcoin</option>
											  <option value="ETHEREUM">Ethereum</option>
											  <option value="LITECOIN">Litecoin</option>
											  <option value="USDT:TRC20">USDT:TRC20</option>
											</select>

										</div>
  									</div>

  									<div class="col-md-12 text-center">
							  			<div class="mb-2">
							  				<button type="button" onclick="Deposit()" id="depbtn" class="btn btn-vnm-indigo w-100 py-2">
							  					<span id="dep_def"><i class="fa-solid fa-coins"></i>
											 	 Deposit
											 	</span>
                                				<span id="dep_loadi" style="display: none;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
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
  				<div class="col-md-8">
	  				<div class="card rounded-lg billing-div bg-gray-800 g-4">
	  					<div class="card-header">
	  						Payment history
	  					</div>

	  					<div class="card-body">
	  						<div>
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
	  					</div>
	  				</div>
	  			</div>
  			</div>



  			<div class="modal fade" id="payment-modal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			    <div class="modal-content bg-gray-800">
			      <div class="modal-header">
			        <p class="modal-title" id="modal-label"></p>
			        <button type="button" style="background: transparent;border: none;" data-bs-dismiss="modal" aria-label="Close"><i style="color: #fff;" class="fa-solid fa-x"></i></button>
			      </div>
			      <div class="modal-body">
			       	<div class="row"> 
			       		<div class="col-md-6">
			       			<div class="mb-3">
							    <label for="cryptocoin" class="form-label">Crypto</label>
							    <input type="text" class="form-control" id="cryptocoin" disabled>
										    
							</div>

							<label for="addressdiv" class="form-label">Address</label>
							<div id="addressdiv" class="input-group mb-3">
							  <input type="text" id="address" class="form-control" aria-describedby="button-addr" disabled>
							  <button class="btn btn-vnm-indigo" type="button" onclick="copyaddr()" id="button-addr">Copy</button>
							</div>
			       			
							<label for="cryptoamountdiv" class="form-label">Amount</label>
							<div id="cryptoamountdiv" class="input-group mb-3">
							  <input type="text" id="cryptoamount" class="form-control" aria-describedby="button-amount" disabled>
							  <button class="btn btn-vnm-indigo" type="button" onclick="copyamount()"  id="button-amount">Copy</button>
							</div>

							<div class="mb-3">
							    <label for="cryptoamountpaid" class="form-label">Amount paid</label>
							    <input type="text" class="form-control" id="cryptoamountpaid" disabled>
										    
							</div>
							<div class="mb-3">
							    <label for="cryptoexpires" class="form-label">Expires</label>
							    <input type="text" class="form-control" id="cryptoexpires" disabled>
										    
							</div>
			       		</div>
			       		<div class="col-md-6 text-center">
			       			<div class="mb-3">
				       			<label for="cryptoqr" class="form-label">QR Code</label>
				       			<div id="cryptoqr">
				       				<img id="qrimage">
				       			</div>
			       			</div>
			       			<div class="mb-3">
							    <label for="cryptostatus" class="form-label">Payment status</label>
							    <input type="text" class="form-control" id="cryptostatus" disabled>
										    
							</div>
							<div class="mb-3">
							    <label for="cryptoconfirms" class="form-label">Confirmations</label>
							    <input type="text" class="form-control" id="cryptoconfirms" disabled>
										    
							</div>

							<label for="cryptohashdiv" class="form-label">Hash</label>
							<div id="cryptohashdiv" class="input-group mb-3">
							  <input type="text" id="cryptohash" class="form-control" aria-describedby="button-hash" disabled>
							  <button class="btn btn-vnm-indigo" type="button" onclick="openhash()" id="button-hash">Open</button>
							</div>
			       		</div>


			       	</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-vnm-red py-2" id="cancel-btn">
			        	<span id="cancelpay_def"><i class="fa-solid fa-xmark" style="color: #fff !important;"></i>
					 	 Cancel Payment
					 	</span>
        				<span id="cancelpay_loadi" style="display: none;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
        				 Please wait..
        				</span>

			        </button>
			        <button type="button" class="btn btn-vnm-indigo py-2" id="recheck-btn">
			        	<span id="recheck_def"><i class="fa-solid fa-arrows-rotate"></i>
					 	 Re-Check
					 	</span>
        				<span id="recheck_loadi" style="display: none;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
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

  	
<?php include 'footer.php'; ?>
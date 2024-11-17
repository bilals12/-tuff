<?php
$pagename = "Support";
include 'header.php';
$Opened = $odb->prepare("SELECT COUNT(*) FROM `tickets` WHERE `user` = :user AND `status` = 'open'");
$Opened->execute(array(':user' => $_SESSION['username']));
$opened = $Opened->fetchColumn(0);
$Closed = $odb->prepare("SELECT COUNT(*) FROM `tickets` WHERE `user` = :user AND `status` = 'closed'");
$Closed->execute(array(':user' => $_SESSION['username']));
$closed = $Closed->fetchColumn(0);
$Answered = $odb->prepare("SELECT COUNT(*) FROM `tickets` WHERE `user` = :user AND `status` = 'answered'");
$Answered->execute(array(':user' => $_SESSION['username']));
$answered = $Answered->fetchColumn(0);
$CustomerR = $odb->prepare("SELECT COUNT(*) FROM `tickets` WHERE `user` = :user AND `status` = 'customer-reply'");
$CustomerR->execute(array(':user' => $_SESSION['username']));
$customerreplied = $CustomerR->fetchColumn(0);
?>
	<div class="main">
    	<div class="container mt-5 mb-5 px-4">
      		<div class="row g-4">
      			<div class="col-md-3">
      				<div class="card support-card rounded-lg bg-gray-800">
      					<div class="card-header">
      						Tickets View
      					</div>
      					<div class="card-body">
      						<ul class="list-group list-group-flush">
							  <li class="list-group-item">
							  	<div class="row">
							  		<div class="col col-md-8 text-start">
							  			Opened
							  		</div>
							  		<div class="col col-md-4 text-end">
							  			<span class="vnm-indigo-badge px-2 py-1 rounded-lg"><?php echo $opened; ?></span>
							  		</div>
							  	
							  	</div>

							  </li>
							  <li class="list-group-item">
							  	<div class="row">
							  		<div class="col col-md-8 text-start">
							  			Closed
							  		</div>
							  		<div class="col col-md-4 text-end">
							  			<span class="vnm-indigo-badge px-2 py-1 rounded-lg"><?php echo $closed; ?></span>
							  		</div>
							  	
							  	</div>

							  </li>
							  <li class="list-group-item">
							  	<div class="row">
							  		<div class="col col-md-8 text-start">
							  			Answered
							  		</div>
							  		<div class="col col-md-4 text-end">
							  			<span class="vnm-indigo-badge px-2 py-1 rounded-lg"><?php echo $answered; ?></span>
							  		</div>
							  	
							  	</div>

							  </li>
							  <li class="list-group-item">
							  	<div class="row">
							  		<div class="col col-md-8 text-start">
							  			Customer-Replied
							  		</div>
							  		<div class="col col-md-4 text-end">
							  			<span class="vnm-indigo-badge px-2 py-1 rounded-lg"><?php echo $customerreplied; ?></span>
							  		</div>
							  	
							  	</div>
							  </li>
							  
							</ul>


      					</div>

      				</div>
      			</div>
      			<div class="col-md-9">
      				<div class="card support-card rounded-lg bg-gray-800">
      					<div class="card-header">
      						<div class="row">
      							<div class="col-md-6 text-start">
      								Support Tickets
      							</div>
      							<div class="col-md-6 text-end">
      								<button type="button" onclick="OpenTicketModal()" style="text-transform: uppercase; font-size: 0.8rem;" id="openticketbtn" class="btn btn-primary btn-sm"><i class="fa-solid fa-file-pen"></i> Open Ticket</button>
      							</div>
      						</div>
      					</div>
      					<div class="card-body">
      						<div class="table-responsive mx-2">
				              <table id="tickets-table" style="width:100%" class="mt-2 stripe display table bg-grayy-800 table-striped table-bordered border-gray">
				                <thead>
				                  <tr>
				                    
				                    <th scope="col" class="text-center">Subject</th>
				                    <th scope="col" class="text-center">Status</th>
				                    <th scope="col" class="text-center">Created</th>
				                    
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

	<div class="modal fade" id="viewticket-modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
	    <div class="modal-content bg-gray-900">
	      <div class="modal-header">
	        <span id="ticket-label"></span>
	        <button type="button" style="background: transparent;border: none;" data-bs-dismiss="modal" aria-label="Close"><i style="color: #fff;" class="fa-solid fa-x"></i></button>
	      </div>
	      <div class="modal-body">
	        <div class="row g-4">
	        	<div class="col-md-7">
	        		<div id="ticket-content">

	        		</div>
	        	</div>
	        	<div class="col-md-5">
	        		<textarea class="form-control" id="replyarea" placeholder="Leave your reply here.." style="height: 350px"></textarea>
				</div>
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-vnm-red" id="closeticket-btn"><i class="fa-solid fa-xmark" style="color: #fff !important;"></i> Close Ticket</button>
	        <button type="button" class="btn btn-vnm-indigo" id="reply-btn"><i class="fa-solid fa-reply"></i> Reply</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="openticket-modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
	    <div class="modal-content bg-gray-900">
	      <div class="modal-header">
	        Open Ticket
	        <button type="button" style="background: transparent;border: none;" data-bs-dismiss="modal" aria-label="Close"><i style="color: #fff;" class="fa-solid fa-x"></i></button>
	      </div>
	      <div class="modal-body">
	        <div class="row g-4">
	        	
	        		<div class="col-md-8">
		        		<div class="">
						    <label for="ticketsubject" class="form-label">Subject</label>
						    <input type="text" class="form-control" placeholder="Leave your subject here.." id="ticketsubject" required>
						    
						</div>
					</div>
					<div class="col-md-4">
						<div class="">
						    <label for="ticketpriority" class="form-label">Priority</label>
						    <select class="form-select" id="ticketpriority">
							  <option value="low">Low</option>
							  <option value="normal">Normal</option>
							  <option value="high">High</option>
							  
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="mb-3">
						    <label for="ticketmessage" class="form-label">Message</label>
						    <textarea class="form-control" id="ticketmessage" placeholder="Leave your message here.." style="height: 350px"></textarea>
						    
						</div>
					</div>
	        	
	        	
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-vnm-red" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark" style="color: #fff !important;"></i> Cancel</button>
	        <button type="button" class="btn btn-vnm-indigo" id="reply-btn" onclick="OpenTicket()"><i class="fa-solid fa-share"></i> Send</button>
	      </div>
	    </div>
	  </div>
	</div>
<?php include 'footer.php' ?>
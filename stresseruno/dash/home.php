
<?php 
  $pagename = "Dashboard";
  include 'header.php'; 
?>


  	<div class="main">
  		<div class="container mt-5 px-4">
  			<div class="row">
  				<div class="col-12 col-md-3 col-lg-3">
  					<div class="rounded-lg stats-card">
              <?php 
                $TodayDB = $odb -> query("SELECT COUNT(*) FROM `attacklogs` WHERE date(`datetime`) = CURDATE()");
                $today = $TodayDB -> fetchColumn(0);
              ?>
  						<h5><?php echo $today; ?></h5>
  						<p class="mb-2">Today Attacks</p>
  						<div class="c-chart-wrapper" style="height:55px;">
			              <canvas class="chart" id="todayattacks" height="70" width="208" style="display: block; box-sizing: border-box; height: 70px; width: 208px;"></canvas>
			            </div>
  					</div>
  				</div>
  				<div class="col-12 col-md-3 col-lg-3">
  					<div class="rounded-lg stats-card">
              <?php
                $TotalAttacks = $odb -> query("SELECT COUNT(*) FROM `attacklogs`");
                $total = $TotalAttacks -> fetchColumn(0);
              ?>
  						<h5><?php echo $total; ?></h5>
  						<p class="mb-2">Total Attacks</p>
  						<div class="c-chart-wrapper" style="height:55px;">
			              <canvas class="chart" id="totalattacks" height="70" width="208" style="display: block; box-sizing: border-box; height: 70px; width: 208px;"></canvas>
			            </div>
  					</div>
  				</div>
  				<div class="col-12 col-md-3 col-lg-3">
  					<div class="rounded-lg stats-card">
              <?php
                $RunningAttacks = $odb -> query("SELECT COUNT(*) FROM `attacklogs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0");
                $running = $RunningAttacks -> fetchColumn(0);

              ?>
  						<h5><?php echo $running; ?></h5>
  						<p class="mb-2">Running Attacks</p>
  						<div class="c-chart-wrapper" style="height:55px;">
              				<canvas class="chart" id="runningattacks" height="70" width="208" style="display: block; box-sizing: border-box; height: 70px; width: 208px;"></canvas>
            			</div>
  					</div>
  				</div>
  				<div class="col-12 col-md-3 col-lg-3">
  					<div class="rounded-lg stats-card">
              <?php
                $TotalUsers = $odb -> query("SELECT COUNT(*) FROM `users`");
                $totalusers = $TotalUsers -> fetchColumn(0);

              ?>
  						<h5><?php echo $totalusers; ?></h5>
  						<p class="mb-2">Total Users</p>
  						<div class="c-chart-wrapper" style="height:55px;">
			              <canvas class="chart" id="totalusers" height="70" width="208" style="display: block; box-sizing: border-box; height: 70px; width: 208px;"></canvas>
			            </div>
  					</div>
  				</div>
  			</div>

  		</div>
  		<div class="container px-4">
  				
  			<div class="row">
  				<div class="col-12 col-md-8 col-lg-8">
 					  <div class="news-card rounded-lg">
              <div class="news-und">
 						    <ol class="ms-1">
                  <?php include 'rest/news/news.php'; ?>
                  
                </ol>
              </div>
 					  </div>
  
  				</div>	
		  		
		  		<div class="col-12 col-md-4 col-lg-4">
		  			<?php
              if($planid == '0'){
                echo '
                  <div class="info-card rounded-lg">
                    <div class="d-flex flex-column text-center mx-auto items-center p-5">
                      <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="sevg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>

                      </div>
                      <div>
                        <h5 class="mb-2 text-white">Upgrade to Paid Membership</h5>
                        <p class="mb-2">Get paid membership to unlock more features.</p>
                      </div>
                      <div>
                        <ul class="text-start features-ul">
                          <li class="p-2"><i class="fa-regular fa-circle-check"></i> Premium L4/L7 methods.</li>
                          <li class="p-2"><i class="fa-regular fa-circle-check"></i> Support tickets priority.</li>
                          <li class="p-2"><i class="fa-regular fa-circle-check"></i> Advanced attack options.</li>
                        </ul>
                      </div>
                      <div>
                        <a href="/dash/purchase"><button class="btn btn-vnm-prim px-5 py-2">Get Membership</button></a>
                      </div>
                    </div>
                  </div>

                ';
              }else{
                $userconcscard = $plan['concs']+$user['addon_concs'];
                $usertimecard = $plan['time']+$user['addon_time'];
                echo '
                  <div class="info-card rounded-lg">
                    <div class="d-flex flex-column text-center mx-auto mt-4 px-5 py-4">
                      <div>
                        <svg fill="none" class="sivg" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>

                      </div>
                      <div>
                        <h5 class="mb-1 text-white">'.$_SESSION['username'].'</h5>
                        <span class="vnm-indigo-badge px-2 py-1 rounded-lg">'.$plan['name'].'</span>

                      </div>
                      <div class="mt-4">
                        <ul class="profile-plan list-group list-group-flush d-inline text-start">
                              <li class="list-group-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg> <span>Concurrents</span><br><b>'.$userconcscard.'</b></li>
                              <li class="list-group-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> <span>Attack Time</span><br><b>'.$usertimecard.'</b></li>
                              <li class="list-group-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> <span>Expire</span><br><b>'.$expire.'</b></li>
                              
                            </ul>
                      </div>
                      <!--<div>
                        <a href="/dash/purchase"><button class="btn btn-vnm-prim px-5 py-2">Get Membership</button></a>
                      </div>-->
                    </div>
                  </div>

                ';
              }


            ?>
              
		  		</div>
  



  			</div>
  		</div>
  	  <div class="container px-4 mb-5">
        <div class="row g-4">
          <div class="col-12 col-md-8 col-lg-8">
            <div class="card bg-gray-800 rounded-lg network-card">
              <div class="card-header">
                Network status
              </div>
              <div class="card-body">
                <div class="table-responsive mx-2">
                  <table class="mt-2 table bg-gray-800 table-striped table-bordered border-gray">
                    <thead>
                      <tr>
                        <th scope="col" class="text-start">Name</th>
                        <th scope="col" class="text-center">Usage</th>
                        <!-- <th scope="col" class="text-center">Type</th> -->
                        <th scope="col" class="text-center">Network</th>
                        <th scope="col" class="text-center">Status</th>
                      </tr>
                    </thead>
                    <tbody id="servers">
                      <?php include 'rest/servers/servers.php'; ?>
                        
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-4 col-lg-4">
            <div class="card bg-gray-800 rounded-lg statistic-card">
              <div class="card-header">
                Statistics
              </div>
              <div class="card-body">
                <div id="statisticschart" style="height: 10rem;"></div>
              </div>

            </div>

          </div>
        </div>
      </div>
    </div>







    <script src="assets/js/charts.js?v=<?php echo time(); ?>"></script>
<?php include 'footer.php'; ?>


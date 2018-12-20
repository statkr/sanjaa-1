<?php
//Check if init.php exists
if(!file_exists('core/frontinit.php')){
	header('Location: install/');
    exit;
}else{
 require_once 'core/frontinit.php';
 require_once 'functions/flags.php';
}

//Getting Job Data
$title = Input::get('title');
$query = DB::getInstance()->get("job", "*", ["slug" => $title, "LIMIT" => 1]);
if ($query->count() === 1) {
 foreach($query->results() as $row) {
  $jobid = $row->jobid;
  $title_job = $row->title;
  $clientid = $row->clientid;
  $catid = $row->catid;
  $budget = $row->budget;
  $job_type = $row->job_type;
  $start_date = $row->start_date;
  $end_date = $row->end_date;
  $description_job = $row->description;
  $skills = $row->skills;
  $arr=explode(',',$skills);
  $date_added = ago(strtotime($row->date_added));
  $completed = $row->completed;
  $accepted = $row->accepted;
	$job_country = $row->country;

	//computedays left for job
	$today = strtotime('now');
	$remaining_hours = (strtotime($end_date) - $today)/3600;
	$remaining_hours = floor($remaining_hours ) ;
	$days = 0;
	$hours = 0;
	while (1) {
		if ($remaining_hours < 24) {
			$hours = $remaining_hours;
			break;
		}
		$remaining_hours = $remaining_hours - 24 ;
		$days++ ;
	}
	if ($hours < 0) {
		$time_remaining = "Apply Date is over ";
	}else {
		$time_remaining = $days." days, ".$hours." hours left";
	}


 }
} else {
  Redirect::to('jobs.php');
}

//Getting Category Name
$query = DB::getInstance()->get("category", "*", ["catid" => $catid, "LIMIT" => 1]);
if ($query->count() === 1) {
 foreach($query->results() as $row) {
  $cat_name = $row->name;
 }
}else {
  $cat_name = "Undefined";
}

//Getting Client
$q1 = DB::getInstance()->get("client", "*", ["clientid" => $clientid]);
if ($q1->count()) {
	 foreach ($q1->results() as $r1) {
	  $name1 = $r1->name;
	  $username1 = $r1->username;
	  $imagelocation = $r1->imagelocation;
	  $bgimage = $r1->bgimage;
		$profile_c = DB::getInstance()->get("profile", "*", ["userid" => $clientid]);
		if ($profile_c->count()) {
			foreach ($profile_c->results() as $cl) {
				$country_c = $cl->country ;
			}
		}
		$ratings_c = DB::getInstance()->get("ratings_client", "*", ["clientid" => $clientid]);
		if ($ratings_c->count()) {
			$star_c = 0;
			$s_sum_c = 0;
			foreach ($ratings_c->results() as $rate) {
				$s_sum_c += $rate->star;
			}
			$star_c = ($s_sum_c / $ratings_c->count()) ;
		}else{$star_c = 0 ;}
  }
}

//Getting Proposals
$q2 = DB::getInstance()->get("proposal", "*", ["jobid" => $jobid]);
 if ($q2->count() === 0) {
  $job_proposals = 0;
 } else {
  $job_proposals = $q2->count();
 }
?>


<!doctype html>
<html lang="en">

<!-- Basic Page Needs
================================================== -->


<!-- include header.php Basic Page Needs
================================================== -->
<?php include ('includes/template/front_header.php'); ?>



<body>

<!-- Wrapper -->
<div id="wrapper">


	<!--  Header navigation bar Container
	================================================== -->
	<?php include 'includes/template/front_nav.php' ; ?>


<div class="clearfix"></div>
<!-- Header Container / End -->



<!-- Titlebar
================================================== -->
<div class="single-page-header freelancer-header" data-background-image="<?php echo $jobs_header_img; ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="single-page-header-inner">
					<div class="left-side">
						<div class="header-image freelancer-avatar"><a href=""><img src="Client/<?php echo $imagelocation; ?>" alt=""></a></div>
						<div class="header-details">
							<h3><?php echo $title_job; ?></h3>
							<h5>About the Employer</h5>
							<ul>
								<li><a href="#"><i class="icon-material-outline-business"></i> <?php echo $name1; ?></a></li>
								<li>
									<?php if ($star_c == 0) { ?>
										<span class="not-rated">Not rated yet !</span>
									<?php }else { ?>
										<div class="star-rating" data-rating="<?php echo bcdiv($star_c,1,1); ?>"></div>
									<?php } ?>
								</li>
								<li><?php echo $country_c; ?></li>
								<li>
									<div class="verified-badge-with-title">
										<?php
						 		         if($accepted === 1):
						 					  if($completed === '1'):
						 					   echo $lang['completed'];
						 					  else:
						 					   echo $lang['on']; echo $lang['progress'];
						 					  endif;
						 				 else:
						 				 echo $lang['opened'];
						 				 endif;
						 		    ?>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="right-side">
						<div class="salary-box">
							<div class="salary-type">Project Budget</div>
							<div class="salary-amount"><?php echo $budget; ?> Fcfa</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Page Content
================================================== -->
<div class="container">
	<div class="row">

		<!-- Content -->
		<div class="col-xl-8 col-lg-8 content-right-offset">

			<!-- Description -->
			<div class="single-page-section">
				<h3 class="margin-bottom-25">Project Description</h3>
				<?php echo $description_job; ?>
				</div>


			<!-- Skills -->
			<div class="single-page-section">
				<h3>Skills Required</h3>
				<div class="task-tags">
				<?php
				foreach ($arr as $skill) {?>
					<span><?php echo $skill; ?></span>
				<?php } ?>
				</div>
			</div>
			<div class="clearfix"></div>

			<!-- Freelancers Bidding -->
			<div class="boxed-list margin-bottom-60">
				<div class="boxed-list-headline">
					<h3><i class="icon-material-outline-group"></i> Freelancers Proposals</h3>
				</div>
				<ul class="boxed-list-ul">

					<?php
					//Getting Proposals
					$p2 = DB::getInstance()->get("proposal", "*", ["jobid" => $jobid]);

					 if ($p2->count()) {
						foreach ($p2->results() as $p) {
							$f2 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $p->freelancerid]);
							foreach ($f2->results() as $f) {
								$profile = DB::getInstance()->get("profile", "*", ["userid" => $p->freelancerid]);
								if ($profile->count()) {
									foreach ($profile->results() as $c) {
										if ($c->country == '') {
											$country = 'Unknown' ;
										}else {
											$country = $c->country ;
										}

									}
								}
								$ratings = DB::getInstance()->get("ratings", "*", ["freelancerid" => $f->freelancerid]);
								if ($ratings->count()) {
									$star = 0;
									$s_sum = 0;
									foreach ($ratings->results() as $rate) {
										$s_sum += $rate->star;
									}
									$star = ($s_sum / $ratings->count()) ;
								}else{$star = 0 ;}

							 ?>

							<li>
								<div class="bid">
									<!-- Avatar -->
									<div class="bids-avatar">
										<div class="freelancer-avatar">
											<div class="verified-badge"></div>
											<a href="freelancer.php?a=overview&id=<?php echo $f->freelancerid; ?>"><img src="Freelancer/<?php echo $f->imagelocation; ?>" alt=""></a>
										</div>
									</div>

									<!-- Content -->
									<div class="bids-content">
										<!-- Name -->
										<div class="freelancer-name">
											<h4><a href="freelancer.php?a=overview&id=<?php echo $f->freelancerid; ?>"><?php echo $f->name; ?> <img class="flag" src="assets/img/flags/<?php echo flag($country); ?>" alt="" title="<?php echo $country;?>" data-tippy-placement="top"></a></h4>
											<?php if ($star == 0) { ?>
												<span class="not-rated">Not rated yet !</span>
											<?php }else { ?>
												<div class="star-rating" data-rating="<?php echo bcdiv($star,1,1); ?>"></div>
											<?php } ?>

										</div>
									</div>

									<!-- Bid -->
									<div class="bids-bid">
										<div class="bid-rate">
											<div class="rate"><?php echo $p->budget; ?> Fcfa</div>
											<span><i class="icon-material-outline-location-on"></i> <?php echo $country; ?></span>
										</div>
									</div>
								</div>
							</li>

					<?php }
					}
				}else{
						echo "<br/><span>No Proposals yet !  <a><b>BE THE FIRST TO APPLY</b></a><span>";
				} ?>


				</ul>
			</div>

		</div>


		<!-- Sidebar -->
		<div class="col-xl-4 col-lg-4">
			<div class="sidebar-container">
				<div class="countdown <?php echo ($hours>=0)?"green":""; ?> margin-bottom-35" style="<?php echo ($hours<0)?"background:rgb(255, 233, 233); color:#de5959;":"" ; ?>"><?php echo $time_remaining; ?></div>
				<?php
		 	 //Start new Admin object
		 	 $admin = new Admin();
		 	 //Start new Client object
		 	 $client = new Client();
		 	 //Start new Freelancer object
		 	 $freelancer = new Freelancer();

		 	 if ($admin->isLoggedIn()) { ?>
		 	<?php } elseif($client->isLoggedIn()) { ?>
		 	<?php } elseif($freelancer->isLoggedIn()) { ?>
				<a href="Freelancer/addproposal.php?id=<?php echo $jobid; ?>" class="apply-now-button"><?php echo $lang['send']; ?> <?php echo $lang['proposal']; ?> <i class="icon-material-outline-arrow-right-alt"></i></a>
			<?php } else { ?>
				<a href="#sign-in-dialog" class="apply-now-button popup-with-zoom-anim margin-bottom-50"><?php echo $lang['send']; ?> <?php echo $lang['proposal']; ?> <i class="icon-material-outline-arrow-right-alt"></i></a>
			<?php } ?>
				<!-- Sidebar Widget -->
				<div class="sidebar-widget">
					<div class="job-overview">
						<div class="job-overview-headline">Project Summary</div>
						<div class="job-overview-inner">
							<ul>
								<li>
									<i class="icon-material-outline-access-time"></i>
									<span>Date Posted</span>
									<h5><?php echo $date_added; ?></h5>
								</li>
								<li>
									<i class="icon-material-outline-location-on"></i>
									<span>Work Location</span>
									<h5><?php echo $job_country; ?></h5>
								</li>
								<li>
									<i class="icon-material-outline-date-range"></i>
									<span>Start date</span>
									<h5><?php echo $start_date; ?></h5>
								</li>
								<li>
									<i class="icon-material-outline-date-range"></i>
									<span>End date</span>
									<h5><?php echo $end_date; ?></h5>
								</li>

							</ul>
						</div>
					</div>
				</div>

				<!-- Sidebar Widget -->
				<div class="sidebar-widget">
					<h3>Share this Project</h3>

					<!-- Copy URL -->
					<div class="copy-url">
						<input id="copy-url" type="text" value="" class="with-border">
						<button class="copy-url-button ripple-effect" data-clipboard-target="#copy-url" title="Copy to Clipboard" data-tippy-placement="top"><i class="icon-material-outline-file-copy"></i></button>
					</div>

					<!-- Share Buttons -->
					<div class="share-buttons margin-top-25">
						<div class="share-buttons-trigger"><i class="icon-feather-share-2"></i></div>
						<div class="share-buttons-content">
							<span>Interesting? <strong>Share It!</strong></span>
							<ul class="share-buttons-icons">
								<li><a href="#" data-button-color="#3b5998" title="Share on Facebook" data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a></li>
								<li><a href="#" data-button-color="#1da1f2" title="Share on Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
								<li><a href="#" data-button-color="#dd4b39" title="Share on Google Plus" data-tippy-placement="top"><i class="icon-brand-google-plus-g"></i></a></li>
								<li><a href="#" data-button-color="#0077b5" title="Share on LinkedIn" data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>

	</div>
</div>


<!-- Spacer -->
<div class="margin-top-15"></div>
<!-- Spacer / End-->


<!-- include footer.php Basic Page scripts and footer section Needs
================================================== -->
<?php include ('includes/template/front_footer.php'); ?>


</body>

<!-- Mirrored from www.vasterad.com/themes/hireo/single-task-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 Sep 2018 11:13:56 GMT -->
</html>

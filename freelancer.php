<?php
//Check if init.php exists
if(!file_exists('core/frontinit.php')){
	header('Location: install/');
    exit;
}else{
 require_once 'core/frontinit.php';
 require_once 'functions/flags.php';
}

//Get Freelancer's Data
$freelancerid = Input::get('id');
$query = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $freelancerid, "LIMIT" => 1]);
if ($query->count() === 1) {
 foreach($query->results() as $row) {
  $name = $row->name;
  $username = $row->username;
  $email = $row->email;
  $phone = $row->phone;
  $freelancer_imagelocation = $row->imagelocation;
  $freelancer_bgimage = $row->bgimage;
	$freelancer_title = $row->freelancer_title ;
 }
} else {
  Redirect::to('services.php');
}

$query = DB::getInstance()->get("profile", "*", ["userid" => $freelancerid, "LIMIT" => 1]);
if ($query->count()) {
 foreach($query->results() as $row) {
 	$nid = $row->id;
 	$location = $row->location;
 	$city = $row->city;
 	$country = $row->country;
 	$rate = $row->rate;
 	$website = $row->website;
 	$about = $row->about;
 	$education_profile = $row->education;
 	$work_profile = $row->work;
 	$awards_profile = $row->awards;
	$skills = $row->skills;
	$arr=explode(',',$skills);
 }
} else {
  Redirect::to('services.php');
}

$ratings = DB::getInstance()->get("ratings", "*", ["freelancerid" => $freelancerid]);
if ($ratings->count()) {
	$star = 0;
	$s_sum = 0;
	foreach ($ratings->results() as $rate) {
		$s_sum += $rate->star;
	}
	$star = ($s_sum / $ratings->count()) ;
}else{$star = 0 ;}

?>
<!doctype html>
<html lang="en">

<head>


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
<div class="single-page-header freelancer-header" data-background-image="<?php echo $services_header_img; ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="single-page-header-inner">
					<div class="left-side"> <!-- image previous size width:130px; height:130px; -->
						<div class="header-image freelancer-avatar"><img style="" src="Freelancer/<?php echo $freelancer_imagelocation; ?>" alt=""></div>
						<div class="header-details">
							<h3><?php echo $name; ?> <span><?php echo escape($freelancer_title); ?></span></h3>
							<ul>
								<li>
									<?php if ($star == 0) { ?>
										<span class="not-rated">Not rated yet !</span>
									<?php }else { ?>
										<div class="star-rating" data-rating="<?php echo bcdiv($star,1,1); ?>"></div>
									<?php } ?>
								</li>
								<li><img class="flag" src="assets/img/flags/<?php echo flag($country); ?>" alt=""> <?php echo $country; ?></li>
								<li><div class="verified-badge-with-title">Verified</div></li>
							</ul>
						</div>

					</div>

					<div class="right-side">
						<!-- Breadcrumbs -->
						<nav id="breadcrumbs" style="width:100% ;" class="dark">
							<ul>
								<li></li>
								<li style="display:block"><a href="freelancer.php?a=overview&id=<?php echo $freelancerid ?>">Overview</a></li>
								<li style="display:block"><a href="freelancer.php?a=portfolio&id=<?php echo $freelancerid ?>">My Portfolio</a></li>
								<li style="display:block"><a href="freelancer.php?a=services&id=<?php echo $freelancerid ?>">My Services</a></li>
								<li style="display:block"><a href="freelancer.php?a=jobs&id=<?php echo $freelancerid ?>">Jobs completed & Assigned</a></li>
								<li style="display:block"><a href="freelancer.php?a=reviews&id=<?php echo $freelancerid ?>">Reviews</a></li>
							</ul>
						</nav>
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
			<?php if (Input::get('a') == 'overview') { ?>
			<!-- Page Content -->
			<div class="single-page-section">

				<h3 class="margin-bottom-25">About Me</h3>
				<p><?php echo $about; ?></p>
			</div>

			<!-- Boxed List -->
			<div class="boxed-list margin-bottom-60">
				<div class="boxed-list-headline">
					<h3><i class="icon-material-outline-thumb-up"></i> <?php echo $lang['education']; ?></h3>
				</div>
				<ul class="boxed-list-ul">
					<li>
						<div class="boxed-list-item">
							<!-- Content -->
							<div class="item-content">
								<hp><?php echo $education_profile; ?></p>

							</div>
						</div>

					</div>
					</li>
					<!-- Boxed List / End -->

					</ul>



				<div class="clearfix"></div>
				<!-- Pagination / End -->



			<!-- Boxed List -->
			<div class="boxed-list margin-bottom-60">
				<div class="boxed-list-headline">
					<h3><i class="icon-material-outline-business"></i> <?php echo $lang['work']; ?> <?php echo $lang['experience']; ?></h3>
				</div>
				<ul class="boxed-list-ul">
					<li>
						<div class="boxed-list-item">
							<!-- Content -->
							<div class="item-content">
								<p><?php echo $work_profile; ?></p>
							</div>
						</div>
					</li>

				</ul>
			</div>
			<!-- Boxed List / End -->

			<div class="clearfix"></div>
			<!-- Pagination / End -->

						<!-- Boxed List -->
						<div class="boxed-list margin-bottom-60">
							<div class="boxed-list-headline">
								<h3><i class="icon-material-outline-business"></i> <?php echo $lang['awards']; ?> <?php echo $lang['and']; ?> <?php echo $lang['achievements']; ?></h3>
							</div>
							<ul class="boxed-list-ul">
								<li>
									<div class="boxed-list-item">
										<!-- Content -->
										<div class="item-content">
											<p><?php echo $awards_profile; ?></p>
										</div>
									</div>
								</li>

							</ul>
						</div>
						<!-- Boxed List / End -->

					<?php }elseif (Input::get('a') == 'portfolio') { ?>
					<?php
					 $query = DB::getInstance()->get("portfolio", "*", ["userid" => $freelancerid]);
					 if ($query->count()) {

							$portfolioList = '';
							$x = 1;
							?>
							<!-- Freelancers List Container -->
							<div class="freelancers-container freelancers-grid-layout margin-top-35">
						<?php
						foreach($query->results() as $row) {

						 $portfolio_title = $row->title;
						 $portfolio_date = $row->date;
						 $portfolio_client = $row->client;
						 $portfolio_website = $row->website;
						 $portfolio_desc = $row->description;
						 $portfolio_imagelocation = $row->imagelocation;
						 ?>
						<div class="freelancer">
							<!-- Overview -->
							<div class="freelancer-overview">
								<div class="freelancer-overview-inner">

									<!-- Bookmark Icon -->
									<span class="bookmark-icon"></span>

									<!-- Avatar -->
									<div class="">
										<a href="#"><img src="Freelancer/<?php echo escape($row->imagelocation) ; ?>"></a>
									</div>

								</div>
							</div>

						</div>
					<?php }?>
					</div>
					<?php
				 }else {
					  echo '<h3>'.$lang['no_content_found'].'</h3>';
					}
				}elseif (Input::get('a') == 'services' && !Input::get('sid')) { ?>

					<!-- Freelancers List Container -->
					<div class="freelancers-container freelancers-list-layout margin-top-35">

						<?php
				       $query = DB::getInstance()->get("ratings", "*", ["AND" => ["freelancerid" => $freelancerid]]);
				       $count = $query->count();
							 $re = $count/7;

					    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
					    $limit = $service_limit;
					    $startpoint = ($page * $limit) - $limit;

				     $q1 = DB::getInstance()->get("service", "*", ["userid" => $freelancerid]);
					   $total = $q1->count();

						 $query = DB::getInstance()->get("service", "*", ["ORDER" => "date_added DESC", "LIMIT" => [$startpoint, $limit], "AND" => ["userid" => $freelancerid, "active" => 1, "delete_remove" => 0]]);
					  if($query->count()) {
					    $x = 1;
						foreach($query->results() as $row) {

			            foreach ($arr as $key => $value) {
			              $skills_each .=  '<label class="label label-success">'. $value .'</label> &nbsp;';
			            }


						$q3 = DB::getInstance()->get("category", "*", ["catid" => $row->catid, "LIMIT" => 1]);
						if ($q3->count()) {
						 foreach($q3->results() as $r3) {
						 	$category_name = $r3->name;
						 }
						}
						?>
					<!--Freelancer -->
					<div class="freelancer">

						<!-- Overview -->
						<div class="freelancer-overview">
							<div class="freelancer-overview-inner">

								<!-- Bookmark Icon -->
								<span class="bookmark-icon"></span>
								<!-- Avatar -->
								<div class="freelancer-avatar">
									<div class="verified-badge"></div>
									<a href="single-freelancer-profile.html"><img src="Freelancer/<?php echo escape($freelancer_imagelocation); ?>" alt=""></a>
								</div>

								<!-- Name -->
								<div class="freelancer-name">
									<h4><a href="freelancer.php?a=services&id=<?php echo escape($row->userid); ?>&sid=<?php echo escape($row->serviceid); ?>"><?php echo escape($row->title); ?> <img class="flag" src="images/flags/gb.svg" alt="" title="United Kingdom" data-tippy-placement="top"></a></h4>
									<span><?php echo escape($name1); ?></span>
									<!-- Rating -->
									<div class="freelancer-rating">
										<?php if ($star == 0) { ?>
											<span class="not-rated">Not rated yet !</span>
										<?php }else { ?>
											<div class="star-rating" data-rating="<?php echo bcdiv($star,1,1); ?>"></div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>

						<!-- Details -->
						<div class="freelancer-details">
							<div class="freelancer-details-list">
								<ul>
									<li>Location <strong><i class="icon-material-outline-location-on"></i> <?php echo escape($country); ?></strong></li>
									<li>Rate <strong><?php echo escape($row->rate); echo " ".$currency_symbol;?> / hr</strong></li>
								</ul>
							</div>
							<a href="freelancer.php?a=services&id=<?php echo escape($row->userid); ?>&sid=<?php echo escape($row->serviceid); ?>" class="button button-sliding-icon ripple-effect">View Service <i class="icon-material-outline-arrow-right-alt"></i></a>
						</div>
					</div>
					<!-- Freelancer / End -->
				<?php }}else {
					echo '<p>'.$lang['no_content_found'].'</p>';
				} ?>
					</div>

				<?php }elseif (Input::get('a') == 'services' && Input::get('sid')) { ?>

					<?php
					$query = DB::getInstance()->get("service", "*", ["ORDER" => "date_added DESC", "AND" => ["serviceid" => Input::get('sid'), "userid" => $freelancerid, "active" => 1, "delete_remove" => 0]]);
					if($query->count()) {
						$x = 1;
								foreach ($arr as $key => $value) {
									$skills_each .=  '<label class="label label-success">'. $value .'</label> &nbsp;';
								}

					foreach($query->results() as $row) {
						$serviceList = '';

					$q3 = DB::getInstance()->get("category", "*", ["catid" => $row->catid, "LIMIT" => 1]);
					if ($q3->count()) {
					 foreach($q3->results() as $r3) {
						$category_name = $r3->name;
					 }
					}

					$serviceList .= '
							 <p><strong>'. $lang['category'] .' :- </strong> '. escape($category_name) .'</p><br/>
							 <p><strong>'. $lang['rate_hour'] .' :- </strong> '. escape($row->rate) .'</p><br/>
											 <h4>'. $lang['description'] .'</h4>
							 '. $row->description .'
							 <br/>
							 <h4>
							 ';

							 ?>
							 <!-- Page Content -->
							<div class="single-page-section">
							 <h3 class="margin-bottom-25"><?php echo  escape($row->title); ?></h3>
							 <p><?php echo $serviceList; ?></p>
							</div>
							 <?php

								 unset($serviceList);
								 unset($skills);
					 $x++;

					 }
					}else {
					echo $serviceList = '<p>'.$lang['no_content_found'].'</p>';
					}
					 ?>


				<?php } elseif (Input::get('a') == 'jobs') { ?>

				  <?php
				    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
				    $limit = $job_limit;
				    $startpoint = ($page * $limit) - $limit;

				    $q1 = DB::getInstance()->get("job", "*", ["freelancerid" => $freelancerid]);
				    $total = $q1->count();

				    $query = DB::getInstance()->get("job", "*", ["ORDER" => "date_added DESC", "LIMIT" => [$startpoint, $limit],
				                          "AND" => [
				                              "freelancerid" => $freelancerid,
				                            "active" => 1,
				                            "delete_remove" => 0
				                          ]]);
				  if($query->count()) {
				    $x = 1;

				  foreach($query->results() as $row) {
				    $q1 = DB::getInstance()->get("client", "*", ["clientid" => $row->clientid]);
				  if ($q1->count()) {
				     foreach ($q1->results() as $r1) {
				      $name1 = $r1->name;
				      $username1 = $r1->username;
				      $imagelocation = $r1->imagelocation;
				      }
				  }

				  //Getting Proposals
				  $q2 = DB::getInstance()->get("proposal", "*", ["jobid" => $row->jobid]);
				   if ($q2->count() === 0) {
				    $job_proposals = 0;
				   } else {
				    $job_proposals = $q2->count();
				   }

				  $blurb = truncateHtml($row->description, 100);
				  if ($row->accepted === '1' ) {
				     if ($row->completed === '1') {
				      $senp ='
				      <p>' . $lang['completed'] . '</p>
				      ';
				     } else {
				      $senp ='
				      <p>' . $lang['in_complete'] . '</p>
				      ';
				     }
				  } else {
				    $senp ='
				    <p>' . $lang['waiting'] . ' ' . $lang['client'] . ' ' . $lang['to'] . ' ' . $lang['accept'] . '</p>';
				  } ?>

					<!-- Task -->
					<a href="jobpost.php?title=<?php echo escape($row->slug); ?>" class="task-listing">

						<!-- Job Listing Details -->
						<div class="task-listing-details">

							<!-- Details -->
							<div class="task-listing-description">
								<h3 class="task-listing-title"><?php echo escape($row->title); ?></h3>
								<ul class="task-icons">
									<li><i class="icon-material-outline-location-on"></i><?php echo escape($row->country); ?></li>
									<li><i class="icon-material-outline-access-time"></i><?php echo ago(strtotime($row->date_added)); ?> </li>
									<li><i class="icon-feather-users"></i> <?php echo escape($job_proposals); ?> Proposals</li>
								</ul>
								<p class="task-listing-text"><?php echo $blurb; ?></p>
								<div class="task-tags">

									<?php
									$n =0;
									foreach ($skills_arr as $skill) {?>
										<?php if ($n > 1) {
											echo " +".(sizeof($skills_arr)-$n)." more ";
											break;
										} ?>
										<span><?php echo $skill; ?></span>
									<?php $n++ ?>
									<?php } ?>
								</div>
							</div>

						</div>

						<div class="task-listing-bid">
							<div class="task-listing-bid-inner">
								<div class="task-offers">
									<strong><?php echo escape($row->budget); ?> Fcfa</strong>
									<span>Fixed Price</span>
									<strong><?php echo $senp; ?></strong>
								</div>
							</div>
						</div>
					</a>
				<?php
				 unset($senp);
				 $x++;
			 }}else {
			 	echo '<p>'.$lang['no_content_found'].'</p>';
			 }
			 //print
	 		echo Pagination($total,$limit,$page,'?a=jobs&id='.$clientid.'&');
		} elseif (Input::get('a') == 'reviews'){?>

			<div class="boxed-list-headline" style="margin-bottom:20px;">
				<h3><i class="icon-material-outline-thumb-up"></i> <?php echo $lang['ratings']; ?></h3>
			</div>

			<?php
			$q = DB::getInstance()->get("job", "*", ["AND" => ["freelancerid" => Input::get('id'), "completed" => 1]]);
			if ($q->count()) {
				 foreach ($q->results() as $r) {

							$q1 = DB::getInstance()->get("client", "*", ["clientid" => $r->clientid]);
						if ($q1->count()) {
							 foreach ($q1->results() as $r1) {
								$name1 = $r1->name;
								$username1 = $r1->username;
								$imagelocation = $r1->imagelocation;
								 }
						}

									 $jl = [
												 '1'=>'1',
												 '2'=>'2',
												 '3'=>'3',
												 '4'=>'4',
												 '5'=>'5',
												 '6'=>'6'
												 ];

				foreach ($jl as $key => $value) {


					$query = DB::getInstance()->get("ratings", "*", ["AND" => ["jobid" => $r->jobid,
																																						"freelancerid" => Input::get('id'),
																																						"star_type" => $value]]);
					if ($query->count()) {
					 foreach($query->results() as $row) {

						$star = $row->star;
						$star_type = $value;

						if($star_type === '1'):
						 $titl .='<span class="rate">'.$lang['skills'].'</span>';
						elseif($star_type === '2'):
						 $titl .= '<span class="rate">'.$lang['quality'].' '.$lang['of'].' '.$lang['work'].'</span>';
						elseif($star_type === '3'):
						 $titl .='<span class="rate">'.$lang['availability'].'</span>';
						elseif($star_type === '4'):
						 $titl .='<span class="rate">'.$lang['adherence'].' '.$lang['to'].' '.$lang['schedule'].'</span>';
						elseif($star_type === '5'):
						 $titl .= '<span class="rate">'.$lang['communication'].'</span>';
						elseif($star_type === '6'):
						 $titl .= '<span class="rate">'.$lang['cooperation'].'</span>';
						endif;

						$star_arr[] = $row->star ;
						$msg_arr[] = $titl;

						$titl;
					 }
					}

					unset($titl);
					$x++;
				}
			?>

			<?php

			$query = DB::getInstance()->get("ratings", "*", ["AND" => ["jobid" => $r->jobid]]);
			if ($query->count()) :
			?>

								<!-- Task -->
								<a href="jobpost.php?title=<?php echo escape($r->slug); ?>" class="task-listing">
									<!-- Job Listing Details -->
									<div class="task-listing-details">
										<!-- Details -->
										<div class="task-listing-description">
											<h3 class="task-listing-title"><?php echo escape($r->title) ?></h3>
											<p class="task-listing-text">
												<div class="freelancer-rating">
													<?php
													$n = 0;
													foreach ($msg_arr as $value) {
												  ?>
															<div class="star-rating" data-rating="<?php echo bcdiv($star_arr[$n],1,1); ?>"><?php echo $value; ?></div>
													<?php $n++ ; } ?>

												</div>
												<div style="margin-top:20px;">
												<?php

												 foreach ($arrs as $value) {
													echo $value.'<br/>';
												}
												 unset($arrs);
																 echo '<h3>'.$lang['message'].'</h3>';
												$query = DB::getInstance()->get("ratings", "*", ["AND" => ["jobid" => $r->jobid,
																																													"freelancerid" => Input::get('id'),
																																													"star_type" => 7]]);
												if ($query->count()) {
												 foreach($query->results() as $row) {
													$message = $row->message;
													echo '<p>'.$message.'</p>';
												 }
												}
												 ?>
												 <div class="freelancer-indicators" style="margin-top:20px;">
													 <?php
													 $success = DB::getInstance()->sum("ratings", "star", ["AND" => ["star_type[!]" => 7,
																																													 "jobid" => $r->jobid,
																																													 "freelancerid" => Input::get('id')]]);
													 foreach($success->results()[0] as $suc) {
													 	$suc_new = $suc;
													 }
													 $percentage = $suc_new/30 * 100;
													 $percentage = round($percentage, 1);
													  ?>
													 <!-- Indicator -->
													 <div class="indicator">
														 <strong><?php echo $percentage; ?>%</strong>
														 <div class="indicator-bar" data-indicator-percentage="<?php echo $percentage; ?>"><span></span></div>
														 <span>Job Success</span>
													 </div>
												 </div>
											</div>
											</p>
										</div>
									</div>

									<div class="task-listing-bid">
										<div class="header-image freelancer-avatar"><img src="Freelancer/<?php echo $freelancer_imagelocation; ?>" alt=""></div>
										<div class="task-listing-bid-inner">
											<div class="task-offers">
												<strong><?php echo escape($name1) ?></strong>
											</div>

										</div>
									</div>

								</a>
		<?php
		endif;
				}
					}else {
			echo '<p>'.$lang['no_content_found'].'</p>';
			}

		} ?>
		</div>


		<!-- Sidebar -->
		<div class="col-xl-4 col-lg-4">
			<div class="sidebar-container">

				<!-- Profile Overview -->
				<div class="profile-overview">
					<div class="overview-item">
						<strong><?php
						 $query = DB::getInstance()->get("job", "*", ["AND" => ["freelancerid" => $freelancerid, "invite" => 1]]);
						 echo $query->count(); ?>
				 		</strong>
						<span>
							<?php echo $lang['jobs']; ?> <?php echo $lang['invites']; ?>
						</span>
					</div>
					<div class="overview-item">
						<strong>
							<?php
	             $query = DB::getInstance()->get("job", "*", ["AND" => ["freelancerid" => $freelancerid, "accepted" => 1]]);
	             echo $query->count();
	            ?>
						</strong>
						<span><?php echo $lang['jobs']; ?> <?php echo $lang['assigned']; ?></span>
					</div>
					<div class="overview-item">
						<strong>
							<?php
	             $query = DB::getInstance()->get("job", "*", ["AND" => ["freelancerid" => $freelancerid, "completed" => 1]]);
	             echo $query->count();
	            ?>
						</strong>
						<span>
							<?php echo $lang['jobs']; ?> Finish
						</span>
					</div>
				</div>


				<?php
				//Start new Admin object
				$admin = new Admin();
				//Start new Client object
				$client = new Client();
				//Start new Freelancer object
				$freelancer = new Freelancer();

				if ($admin->isLoggedIn()) {
						} elseif($freelancer->isLoggedIn()) {

						} elseif($client->isLoggedIn()) { ?>
				<!-- Button -->
				<a href="Client/invite.php?id=<?php echo escape($freelancerid); ?>" class="apply-now-button  margin-bottom-50">Make an Offer <i class="icon-material-outline-arrow-right-alt"></i></a>
			<?php }else {?>
				<a href="#sign-in-dialog" class="apply-now-button popup-with-zoom-anim margin-bottom-50">Make an Offer <i class="icon-material-outline-arrow-right-alt"></i></a>
				<?php } ?>
				<!-- Freelancer Indicators -->
				<div class="sidebar-widget">
					<div class="freelancer-indicators">

						<!-- Indicator -->
						<div class="indicator">
							<strong><?php echo $lang['payments']; ?> <?php echo $lang['received']; ?></strong>
							<div class="indicator-bar" data-indicator-percentage="100"><span></span></div>
							<span>
								<?php
				$query = DB::getInstance()->get("job", "*", ["AND" =>["freelancerid" => $freelancerid, "invite" => "0", "delete_remove" => 0, "accepted" => 1]]);
				if ($query->count()) {
				 foreach($query->results() as $row) {


					$q1 = DB::getInstance()->get("milestone", "*", ["AND" =>["jobid" => $row->jobid]]);
					if ($q1->count()) {
					 foreach($q1->results() as $r1) {

								$query = DB::getInstance()->sum("transactions", "payment", ["AND" => ["membershipid" => $r1->id, "freelancerid" => $r1->clientid]]);
					foreach($query->results()[0] as $payy) {
						 $paj[] = $payy;
					}

					}
					 }

				 }
				}
				echo $currency_symbol.'&nbsp;';
				echo array_sum($paj);
								?>

							</span>
						</div>

						<!-- Indicator -->
						<div class="indicator">
							<strong><?php echo $lang['website']; ?></strong>
							<div class="indicator-bar" data-indicator-percentage="100"><span></span></div>
							<span><?php echo $website; ?></span>
						</div>


						<!-- Indicator -->
						<div class="indicator">
							<strong><?php echo $lang['phone']; ?></strong>
							<div class="indicator-bar" data-indicator-percentage="100"><span></span></div>
							<span> <?php echo $phone; ?></span>
						</div>

						<!-- Indicator -->
						<div class="indicator">
							<strong><?php echo $lang['email']; ?> </strong>
							<div class="indicator-bar" data-indicator-percentage="100"><span></span></div>
							<span><?php echo $email; ?></span>
						</div>
					</div>
				</div>

				<!-- Widget -->
				<!-- div class="sidebar-widget">
					<h3>Social Profiles</h3>
					<div class="freelancer-socials margin-top-25">
						<ul>
							<li><a href="#" title="Dribbble" data-tippy-placement="top"><i class="icon-brand-dribbble"></i></a></li>
							<li><a href="#" title="Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
							<li><a href="#" title="Behance" data-tippy-placement="top"><i class="icon-brand-behance"></i></a></li>
							<li><a href="#" title="GitHub" data-tippy-placement="top"><i class="icon-brand-github"></i></a></li>

						</ul>
					</div>
				</div -->

				<!-- Widget -->
				<div class="sidebar-widget">
					<h3>Skills</h3>
					<div class="task-tags">
						<?php
             foreach ($arr as $key => $value) {
               echo '<span>'.$value.'</span>&nbsp;';
             }
 		   			?>
					</div>
				</div>


				<!-- Sidebar Widget -->
				<div class="sidebar-widget">

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

<!-- Mirrored from www.vasterad.com/themes/hireo/single-freelancer-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 Sep 2018 11:14:21 GMT -->
</html>

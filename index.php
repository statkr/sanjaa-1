<?php
//Check if init.php exists
if(!file_exists('core/frontinit.php')){
	header('Location: install/');
    exit;
}else{
 require_once 'core/frontinit.php';
 require_once 'functions/flags.php';
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



<!-- Intro Banner
================================================== -->
<div class="intro-banner dark-overlay" data-background-image="<?php echo $header_img; ?>">

	<!-- Transparent Header Spacer -->
	<div class="transparent-header-spacer"></div>

	<div class="container">

		<!-- Intro Headline -->
		<div class="row">
			<div class="col-md-12">
				<div class="banner-headline">
					<h3>
						<strong><?php echo $top_title; ?></strong>
						<?php if($show_downtitle === '1'): ?>
						<br>
						<span><?php echo $down_title; ?></span>
						<?php endif; ?>
					</h3>
				</div>
			</div>
		</div>

		<!-- Search Bar -->
		<div class="row">
			<div class="col-md-12">
				<form action="search_services.php" method="get">
				<div class="intro-banner-search-form margin-top-95">

					<!-- Search Field -->
					<div class="intro-search-field">
						<label for ="intro-keywords" class="field-title ripple-effect">What do you need done?</label>
						<input id="intro-keywords" type="text"  name="searchterm" placeholder="Eg: logo, Website, Typing, Marketing, ...etc">
					</div>
					<input type="hidden" name="price" value="1,1000">
					<!-- Button -->
					<div class="intro-search-button">
						<button class="button ripple-effect">Search</button>
					</div>

				</div>
			  </form>
			</div>
		</div>


		<?php
		$query = DB::getInstance()->get("job", "*", ["AND"=>["active" => 1, "delete_remove" => 0]]);
	if ($query->count() === '') {
		$jobsposted = 0;
	} else {
		$jobsposted = $query->count();
	}

		$q1 = DB::getInstance()->get("job", "*", ["AND"=>["active" => 1, "delete_remove" => 0, "completed" => 1]]);
	if ($q1->count() === '') {
		$jobscompleted = 0;
	} else {
		$jobscompleted = $q1->count();
	}

		$q2 = DB::getInstance()->get("freelancer", "*", ["AND"=>["active" => 1, "delete_remove" => 0]]);
	if ($q2->count() === '') {
		$freelancercount = 0;
	} else {
		$freelancercount = $q2->count();
	}

		$q3 = DB::getInstance()->get("client", "*", ["AND"=>["active" => 1, "delete_remove" => 0]]);
	if ($q3->count() === '') {
		$clientcount = 0;
	} else {
		$clientcount = $q3->count();
	}

		?>


		<!-- Stats -->
		<div class="row">
			<div class="col-md-12">
				<ul class="intro-stats margin-top-45 hide-under-992px">
					<li>
						<strong class="counter"><?php echo $jobsposted; ?></strong>
						<span>Posted Projects</span>
					</li>
					<li>
						<strong class="counter"><?php echo $clientcount; ?></strong>
						<span>Clients</span>
					</li>
					<li>
						<strong class="counter"><?php echo $freelancercount; ?></strong>
						<span>Freelancers</span>
					</li>
				</ul>
			</div>
		</div>

	</div>
</div>


<!-- Icon Boxes -->
<div class="section padding-top-65 padding-bottom-65">
	<div class="container">
		<div class="row">

			<div class="col-xl-12">
				<!-- Section Headline -->
				<div class="section-headline centered margin-top-0 margin-bottom-5">
					<h3>How It Works for <strong classs="color" style="color:#2a41e8;">Clients</strong>?</h3>
				</div>
			</div>

			<div class="col-xl-3 col-md-3">
				<!-- Icon Box -->
				<div class="icon-box with-line">
					<!-- Icon -->
					<div class="icon-box-circle">
						<div class="icon-box-circle-inner">
							<i class="icon-line-awesome-lock"></i>
							<div class="icon-box-check"><i class="icon-material-outline-check"></i></div>
						</div>
					</div>
					<h3>Create an Account</h3>
					<p>Create a <b>free</b> Client acount in at most 2minutes and start posting projects.</p>
				</div>
			</div>

			<div class="col-xl-3 col-md-3">
				<!-- Icon Box -->
				<div class="icon-box with-line">
					<!-- Icon -->
					<div class="icon-box-circle">
						<div class="icon-box-circle-inner">
							<i class="icon-line-awesome-legal"></i>
							<div class="icon-box-check"><i class="icon-material-outline-check"></i></div>
						</div>
					</div>
					<h3>Post a Project</h3>
					<p>After creating an acount you can start posting your projects for free.</p>
				</div>
			</div>

			<div class="col-xl-3 col-md-3">
				<!-- Icon Box -->
				<div class="icon-box with-line">
					<!-- Icon -->
					<div class="icon-box-circle">
						<div class="icon-box-circle-inner">
							<i class=" icon-material-outline-check"></i>
							<div class="icon-box-check"><i class="icon-material-outline-check"></i></div>
						</div>
					</div>
					<h3>Choose an Expert</h3>
					<p>After posting a project wait for not more than a day to see Experts aply to work on the project.</p>
				</div>
			</div>

			<div class="col-xl-3 col-md-3">
				<!-- Icon Box -->
				<div class="icon-box">
					<!-- Icon -->
					<div class="icon-box-circle">
						<div class="icon-box-circle-inner">
							<i class=" icon-line-awesome-trophy"></i>
							<div class="icon-box-check"><i class="icon-material-outline-check"></i></div>
						</div>
					</div>
					<h3>Aprove and pay</h3>
					<p>Accept an Expert and let him work the project while you pay for each well done steps of the project.</p>
				</div>
			</div>

		</div>
	</div>
</div>
<!-- Icon Boxes / End -->





<!-- Icon Boxes -->
<div class="section padding-top-65 padding-bottom-65">
	<div class="container">
		<div class="row">

			<div class="col-xl-12">
				<!-- Section Headline -->
				<div class="section-headline centered margin-top-0 margin-bottom-5">
					<h3>How It Works for <strong classs="color" style="color:#2a41e8;">Freelancers</strong>?</h3>
				</div>
			</div>

			<div class="col-xl-3 col-md-3">
				<!-- Icon Box -->
				<div class="icon-box with-line">
					<!-- Icon -->
					<div class="icon-box-circle">
						<div class="icon-box-circle-inner">
							<i class="icon-line-awesome-lock"></i>
							<div class="icon-box-check"><i class="icon-material-outline-check"></i></div>
						</div>
					</div>
					<h3>Create an Account</h3>
					<p>Create a <b>free</b> Freelancer acount in at most 1minutes.</p>
				</div>
			</div>

			<div class="col-xl-3 col-md-3">
				<!-- Icon Box -->
				<div class="icon-box with-line">
					<!-- Icon -->
					<div class="icon-box-circle">
						<div class="icon-box-circle-inner">
							<i class="icon-line-awesome-list-alt"></i>
							<div class="icon-box-check"><i class="icon-material-outline-check"></i></div>
						</div>
					</div>
					<h3>Browse available Projects</h3>
					<p>After creating an acount you can start browsing the available projects that suits your skills.</p>
				</div>
			</div>

			<div class="col-xl-3 col-md-3">
				<!-- Icon Box -->
				<div class="icon-box with-line">
					<!-- Icon -->
					<div class="icon-box-circle">
						<div class="icon-box-circle-inner">
							<i class=" icon-material-outline-check"></i>
							<div class="icon-box-check"><i class="icon-material-outline-check"></i></div>
						</div>
					</div>
					<h3>Apply on a project</h3>
            		After browsing projects select one and aply to work on the project.</p>
				</div>
			</div>

			<div class="col-xl-3 col-md-3">
				<!-- Icon Box -->
				<div class="icon-box">
					<!-- Icon -->
					<div class="icon-box-circle">
						<div class="icon-box-circle-inner">
							<i class=" icon-line-awesome-trophy"></i>
							<div class="icon-box-check"><i class="icon-material-outline-check"></i></div>
						</div>
					</div>
					<h3>Wait for Aproval</h3>
					<p>After applying on a project, Waite for approval from the Client. If you are aproved ,Work the project and get paid</p>
				</div>
			</div>

		</div>
	</div>
</div>
<!-- Icon Boxes / End -->




<!-- Photo Section -->
<div class="photo-section" data-background-image="assets/front_assets/images/blog-03a.jpg">

	<!-- Infobox -->
	<div class="text-content white-font">
		<div class="container">

			<div class="row">
				<div class="col-lg-6 col-md-8 col-sm-12">
					<h2>Hire experts or be hired. <br> For any job, any time.</h2>
					<p>With Sanjaa you can be hired for a project or you can hire skillfull freelancers for any ongoing or long term project you have. </p>
					<a href="register.php" class="button button-sliding-icon ripple-effect big margin-top-20">Get Started <i class="icon-material-outline-arrow-right-alt"></i></a>
				</div>
			</div>

		</div>
	</div>

	<!-- Infobox / End -->

</div>
<!-- Photo Section / End -->




<!-- Content
================================================== -->
<!-- Category Boxes -->
<div class="section margin-top-65 margin-bottom-65">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">

				<div class="section-headline centered margin-bottom-15">
					<h3><?php echo $lang['popular']; ?> <?php echo $lang['categories']; ?></h3>
				</div>

				<!-- Category Boxes Container -->
				<div class="categories-container">

				<?php
				$query = DB::getInstance()->get("category", "*", ["ORDER" => "item_order ASC","active"=> 1]);
				if($query->count()) {
				 $x = 1;
				 foreach($query->results() as $row) {
					 $query_cat_jobs = DB::getInstance()->get("job", "*", ["OR" => [
						"AND #first with both" => [
							"catid" => $row->catid,
							"invite" => 0,
							"accepted" => 0,
							"active" => 1,
							"delete_remove" => 0
						],
						"AND #second with both" => [
							"catid" => $row->catid,
							"invite" => 1,
							"public" => 1,
							"accepted" => 0,
							"active" => 1,
							"delete_remove" => 0
						]
					]]);
			   	 $count = $query_cat_jobs->count();
				 ?>


					<!-- Category Box -->
					<a href="search.php?searchterm=&price=10,5000&tags=&selected_cats[]=<?php echo escape($row->catid); ?>" class="category-box">
						<div class="category-box-icon">
							<i class="fa <?php echo $row->icon ; ?>"></i>
						</div>
						<div class="category-box-counter"><?php echo $count; ?></div>
						<div class="category-box-content">
							<h3><?php echo escape($row->name); ?></h3>
							<p><?php echo escape($row->sub_category); ?></p>
						</div>
					</a>



					<?php
					$x++;
						}
					}else {
					 echo $List = '<p>'.$lang['no_content_found'].'</p>';
					}
					?>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- Category Boxes / End -->




<!-- Features Jobs -->
<div class="section gray margin-top-45 padding-top-65 padding-bottom-75">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">

				<!-- Section Headline -->
				<div class="section-headline margin-top-0 margin-bottom-35">
					<h3>Recent Projects</h3>
					<a href="jobs.php" class="headline-link">Browse All Projects</a>
				</div>

				<!-- Jobs Container -->
				<div class="tasks-list-container compact-list margin-top-35">


		 		<?php
					 $limit = 5;
					 $query_jobs = DB::getInstance()->get("job", "*", ["ORDER" => "featured DESC","LIMIT" => 5,
																														 "AND" => ["invite" => 0,
														 																					 "public" => 1,
														 																					 "accepted" => 0,
																																			 "active" => 1,
																																			 "delete_remove" => 0
																																			]]);
					 if($query_jobs->count()) {

						 $jobList = '';
						 $x = 1;

					 foreach($query_jobs->results() as $row) {
						 $skills = $row->skills;
					   $skills_arr = explode(',',$skills);
					?>
					<!-- Task -->
					<a href="jobpost.php?title=<?php echo escape($row->slug); ?>" class="task-listing">

						<!-- Job Listing Details -->
						<div class="task-listing-details">

							<!-- Details -->
							<div class="task-listing-description">
								<h3 class="task-listing-title"><?php echo escape($row->title); ?></h3>
								<ul class="task-icons">
									<li><i class="icon-material-outline-location-on"></i><?php echo escape($row->country); ?></li>
									<li><i class="icon-material-outline-access-time"></i><?php echo ago(strtotime($row->date_added)); ?></li>
								</ul>
								<div class="task-tags margin-top-15">

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
								</div>
								<span class="button button-sliding-icon ripple-effect">Bid Now <i class="icon-material-outline-arrow-right-alt"></i></span>
							</div>
						</div>
					</a>

			<?php	}
		 }else {
			echo $jobList = '<p>'.$lang['no_content_found'].'</p>';
		} ?>
				</div>
				<!-- Jobs Container / End -->
			</div>
		</div>
	</div>
</div>
<!-- Featured Jobs / End -->





<!-- Highest Rated Freelancers -->
<div class="section gray padding-top-65 padding-bottom-70 full-width-carousel-fix">
	<div class="container">
		<div class="row">

			<div class="col-xl-12">
				<!-- Section Headline -->
				<div class="section-headline margin-top-0 margin-bottom-25">
					<h3>Highest Rated Freelancers</h3>
					<a href="freelancers.php" class="headline-link">Browse All Freelancers</a>
				</div>
			</div>

			<div class="col-xl-12">
				<div class="default-slick-carousel freelancers-container freelancers-grid-layout">
					<?php
					$query = DB::getInstance()->get("freelancer", "*", ["ORDER" => "membership_date DESC", "LIMIT" => [$startpoint, $limit], "AND" => ["active" => 1, "delete_remove" => 0]]);
					if($query->count()) {
					 $x = 1;

					foreach($query->results() as $row) {
						$name1 = $row->name;
						$username1 = $row->username;
						$imagelocation = $row->imagelocation;


					$q2 = DB::getInstance()->get("profile", "*", ["userid" => $row->freelancerid]);
					if ($q2->count()) {
					foreach($q2->results() as $r2) {
					 $country = $r2->country;
					 $skills = $r2->skills;
					 $arr=explode(',',$skills);
					 $rate_hour = $r2->rate;
					}
					}


					$qj = DB::getInstance()->get("job", "*", ["AND" =>["freelancerid" => $row->freelancerid, "invite" => "0", "delete_remove" => 0, "accepted" => 1]]);
					if ($qj->count()) {
					foreach($qj->results() as $rj) {

					 $q1 = DB::getInstance()->get("milestone", "*", ["AND" =>["jobid" => $rj->jobid]]);
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
					$qr = DB::getInstance()->get("ratings", "*", ["AND" => ["freelancerid" => $row->freelancerid]]);
					if ($qr->count()) {
						$star_c = 0;
						$s_sum_c = 0;
						foreach ($qr->results() as $rate) {
							$s_sum_c += $rate->star;
						}
						$star_c = ($s_sum_c / $qr->count()) ;
					}else{$star_c = 0 ;}

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
									<a href="freelancer.php?a=overview&id=<?php echo escape($row->freelancerid); ?>"><img style="width:110px; height:110px;" src="Freelancer/<?php echo escape($imagelocation); ?>" alt=""></a>
								</div>

								<!-- Name -->
								<div class="freelancer-name">
									<h4><a href="freelancer.php?a=overview&id=<?php echo escape($row->freelancerid); ?>"><?php echo escape($name1); ?> <img class="flag" src="assets/img/flags/<?php echo flag($country); ?>" alt="<?php echo $country; ?>" title="United Kingdom" data-tippy-placement="top"></a></h4>
									<span><?php echo escape($row->freelancer_title); ?></span>
								</div>

								<!-- Rating -->
								<div class="freelancer-rating">
									<?php if ($star_c == 0) { ?>
										<span class="not-rated">Not rated yet !</span>
									<?php }else { ?>
										<div class="star-rating" data-rating="<?php echo bcdiv($star_c,1,1); ?>"></div>
									<?php } ?>
								</div>
							</div>
						</div>

						<!-- Details -->
						<div class="freelancer-details">
							<div class="freelancer-details-list">
								<ul>
									<li>Location <strong><i class="icon-material-outline-location-on"></i>  <?php echo $country; ?></strong></li>
									<li>Rate <strong><?php echo $rate_hour; echo " ".$currency_symbol; ?> / hr</strong></li>
									<li>Earned <strong><?php echo array_sum($paj); echo " ".$currency_symbol; ?></strong></li>
								</ul>
							</div>
							<a href="freelancer.php?a=overview&id=<?php echo escape($row->freelancerid); ?>" class="button button-sliding-icon ripple-effect">View Profile <i class="icon-material-outline-arrow-right-alt"></i></a>
						</div>
					</div>
					<!-- Freelancer / End -->
				<?php }} ?>

				</div>
			</div>

		</div>
	</div>
</div>
<!-- Highest Rated Freelancers / End-->


<!-- Testimonials -->
<div class="section gray padding-top-65 padding-bottom-55">

	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<!-- Section Headline -->
				<div class="section-headline centered margin-top-0 margin-bottom-5">
					<h3><?php echo $lang['testimonies']; ?></h3>
				</div>
			</div>
		</div>
	</div>

	<!-- Categories Carousel -->
	<div class="fullwidth-carousel-container margin-top-20">
		<div class="testimonial-carousel testimonials">

			<?php
		 		 $query = DB::getInstance()->get("team", "*", ["testimony" => 1]);
		 if($query->count()) {
		 	 $x = 1;
		  foreach($query->results() as $row) {
				?>

			<!-- Item -->
			<div class="fw-carousel-review">
				<div class="testimonial-box">
					<div class="testimonial-avatar">
						<img src="Admin/<?php echo escape($row->imagelocation); ?>" alt="">
					</div>
					<div class="testimonial-author">
						<h4><?php echo escape($row->name); ?></h4>
						 <span><?php echo escape($row->title); ?></span>
					</div>
					<div class="testimonial"><?php echo  escape($row->description); ?></div>
				</div>
			</div>

	<?php
			}
	 }else {
		echo $List = '<p>'.$lang['no_content_found'].'</p>';
	 }
		?>

		</div>
	</div>
	<!-- Categories Carousel / End -->

</div>
<!-- Testimonials / End -->


<!-- Counters -->
<div class="section padding-top-70 padding-bottom-75">
	<div class="container">
		<div class="row">

			<div class="col-xl-12">
				<div class="counters-container">

					<!-- Counter -->
					<div class="single-counter">
						<i class="icon-line-awesome-suitcase"></i>
						<div class="counter-inner">
							<h3><span class="counter"><?php echo $jobsposted; ?></span></h3>
							<span class="counter-title"><?php echo $lang['jobs']; ?> <?php echo $lang['posted']; ?></span>
						</div>
					</div>

					<!-- Counter -->
					<div class="single-counter">
						<i class="icon-line-awesome-legal"></i>
						<div class="counter-inner">
							<h3><span class="counter"><?php echo $clientcount; ?></span></h3>
							<span class="counter-title"><?php echo $lang['clients']; ?></span>
						</div>
					</div>

					<!-- Counter -->
					<div class="single-counter">
						<i class="icon-line-awesome-user"></i>
						<div class="counter-inner">
							<h3><span class="counter"><?php echo $freelancercount; ?></span></h3>
							<span class="counter-title"><?php echo $lang['freelancers']; ?></span>
						</div>
					</div>

					<!-- Counter -->
					<div class="single-counter">
						<i class="icon-line-awesome-trophy"></i>
						<div class="counter-inner">
							<h3><span class="counter"><?php echo $jobscompleted; ?></span></h3>
							<span class="counter-title"><?php echo $lang['jobs']; ?> <?php echo $lang['completed']; ?></span>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- Counters / End -->


<!-- include footer.php Basic Page scripts and footer section Needs
================================================== -->
<?php include ('includes/template/front_footer.php'); ?>


</body>

</html>

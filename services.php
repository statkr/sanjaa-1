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

<!-- Include header.php. Contains header content. -->
<?php include ('includes/template/front_header.php'); ?>


<body class="gray">

<!-- Wrapper -->
<div id="wrapper">

<!-- Header Container
================================================== -->
<?php include 'includes/template/front_nav.php' ; ?>


<div class="clearfix"></div>
<!-- Header Container / End -->

<!-- Spacer -->
<div class="margin-top-90"></div>
<!-- Spacer / End-->

<!-- Page Content
================================================== -->
<div class="container">
	<div class="row">
		<div class="col-xl-3 col-lg-4">

			<!-- job sidebar search navigation Container
			================================================== -->
			<?php include 'includes/template/side_service_search.php' ; ?>

		</div>


		<div class="col-xl-9 col-lg-8 content-left-offset">

			<h3 class="page-title">All Services for Sale</h3>

			<div class="notify-box margin-top-15">
				<div class="switch-container">
				</div>

				<div class="sort-by">
					<span>Sort by:</span>
					<select class="selectpicker hide-tick">
						<option>Relevance</option>
						<option>Newest</option>
						<option>Oldest</option>
						<option>Random</option>
					</select>
				</div>
			</div>

			<!-- Freelancers List Container -->
			<div class="freelancers-container freelancers-list-layout compact-list margin-top-35">

				<?php

			 	 $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
			 	 $limit = $service_limit;
			 	 $startpoint = ($page * $limit) - $limit;
				 $q1 = DB::getInstance()->get("service", "*");
			 	 $total = $q1->count();

			  $query = DB::getInstance()->get("service", "*", ["ORDER" => "date_added DESC", "LIMIT" => [$startpoint, $limit], "AND" => ["active" => 1, "delete_remove" => 0]]);
			  if($query->count()) {
			 	 $x = 1;

			  foreach($query->results() as $row) {

			 	 $q1 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $row->userid]);
			  if ($q1->count()) {
			 		foreach ($q1->results() as $r1) {
			 		 $name1 = $r1->name;
			 		 $username1 = $r1->username;
			 		 $imagelocation = $r1->imagelocation;
			 			}
			  }

			  $q2 = DB::getInstance()->get("profile", "*", ["userid" => $row->userid]);
			  if ($q2->count()) {
			 	foreach($q2->results() as $r2) {
			 	 $country = $r2->country;
			 	 $skills = $r2->skills;
			 	 $arr=explode(',',$skills);
			 	}
			  }

			  $blurb = truncateHtml($row->description, 400);
			 			 foreach ($arr as $key => $value) {
			 				 $skills_each .=  '<label class="label label-success">'. $value .'</label> &nbsp;';
			 				 }

			  $qj = DB::getInstance()->get("job", "*", ["AND" =>["freelancerid" => $row->userid, "invite" => "0", "delete_remove" => 0, "accepted" => 1]]);
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
			 	$qr = DB::getInstance()->get("ratings", "*", ["AND" => ["freelancerid" => $row->userid]]);
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
								<a href="freelancer.php?a=overview&id=<?php echo escape($row->userid); ?>"><img src="Freelancer/<?php echo escape($imagelocation); ?>" alt=""></a>
							</div>

							<!-- Name -->
							<div class="freelancer-name">
								<h4><a href="freelancer.php?a=overview&id=<?php echo escape($row->userid); ?>"><?php echo escape($name1); ?> <img class="flag" src="assets/img/flags/<?php echo flag($country); ?>" alt="" title="United Kingdom" data-tippy-placement="top"></a></h4>
								<span><?php echo escape($row->title); ?></span>
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
					</div>

					<!-- Details -->
					<div class="freelancer-details">
						<div class="freelancer-details-list">
							<ul>
								<li>Location <strong><i class="icon-material-outline-location-on"></i> <?php echo escape($country); ?></strong></li>
								<li>Rate <strong><?php echo escape($r2->rate); echo " ".$currency_symbol;?> / hr</strong></li>
								<li><?php echo $lang['earned']; ?> <strong><?php echo array_sum($paj); echo " ".$currency_symbol;?></strong></li>
							</ul>
						</div>
						<a href="freelancer.php?a=services&id=<?php echo escape($row->userid); ?>&sid=<?php echo escape($row->serviceid); ?>" class="button button-sliding-icon ripple-effect">View Service <i class="icon-material-outline-arrow-right-alt"></i></a>
					</div>
				</div>
				<!-- Freelancer / End -->

				<?php
				}
				}else {
				echo $serviceList = '<p>'.$lang['no_content_found'].'</p>';
				}
				?>


			</div>
			<!-- Tasks Container / End -->


			<!-- Pagination -->
			<div class="clearfix"></div>
			<?php echo Pagination($total,$limit,$page); ?>

		</div>
	</div>
</div>

<!-- include footer.php Basic Page scripts and footer section Needs
================================================== -->
<?php include ('includes/template/front_footer.php'); ?>

</body>

</html>

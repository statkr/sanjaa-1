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

<!-- include header.php Basic Page Needs
================================================== -->
<?php include ('includes/template/front_header.php'); ?>

<body class="gray">

<!-- Wrapper -->
<div id="wrapper">

	<!-- Header navigation bar Container
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
			<?php include 'includes/template/side_freelancers_search.php' ; ?>

		</div>
		<div class="col-xl-9 col-lg-8 content-left-offset">

			<h3 class="page-title">Search Results</h3>

			<div class="notify-box margin-top-15">
				<div class="switch-container">
					<label class="switch"><input type="checkbox"><span class="switch-button"></span><span class="switch-text">Turn on email alerts for this search</span></label>
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
			<div class="freelancers-container freelancers-grid-layout margin-top-35">

				<?php

				$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
				$limit = $service_limit;
				$startpoint = ($page * $limit) - $limit;
				$q1 = DB::getInstance()->get("freelancer", "*");
				$total = $q1->count();

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
								<h4><a href="freelancer.php?a=overview&id=<?php echo escape($row->freelancerid); ?>"><?php echo escape($name1); ?><img class="flag"  src="assets/img/flags/<?php echo flag($country); ?>" alt="" title="cameroon" data-tippy-placement="top"></a></h4>
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
								<li>Location <strong><i class="icon-material-outline-location-on"></i> <?php echo $country; ?></strong></li>
								<li>Rate <strong><?php echo $rate_hour; echo " ".$currency_symbol; ?> / hr</strong></li>
								<li>Earned <strong><?php echo array_sum($paj); echo " ".$currency_symbol; ?></strong></li>
							</ul>
						</div>
						<a href="freelancer.php?a=overview&id=<?php echo escape($row->freelancerid); ?>" class="button button-sliding-icon ripple-effect">View Profile <i class="icon-material-outline-arrow-right-alt"></i></a>
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
			<!-- Freelancers Container / End -->


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

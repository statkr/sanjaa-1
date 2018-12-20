<?php
//Check if init.php exists
if(!file_exists('core/frontinit.php')){
	header('Location: install/');
    exit;
}else{
 require_once 'core/frontinit.php';
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

				/* pdo database connection for this page */
				try{
		 	 		$DBH = new PDO('mysql:host='. Config::get('mysql/host') .';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
		 	  }catch(PDOException $e){
		 	 		die($e->getMessage());
		 	  }
				/* this are for pagination purpose */
				$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
				$limit = $job_limit;
				$startpoint = ($page * $limit) - $limit;
				//$q1 = DB::getInstance()->get("freelancer", "*");
				//$total = $q1->count();
				$displayed = array();
 				/* Start of search algorithm */

				/* search fields */
				 $searchterm = explode(",", isset($_GET['searchterm'])?Input::get('searchterm'):array(1) );
				 $price = explode(",", Input::get('price') );
				 $tags = explode(",", isset($_GET['tags'])?Input::get('tags'):array(1) );

				 /* this block is only for debug purpose */
				 /*
				 echo "<pre>";
				 print_r($price);
				 print_r($tags);
				 print_r($selected_cats);
				 print_r($searchterm);
				 echo Config::get('mysql/db');
				 echo "</pre>";
				 */

				 //code for the skills sellected
					$tag_list = "";
					if (sizeof($tags) == 1 && $tags[0] =="") {
							$tag_list .= '' ;
					}elseif (sizeof($tags) >= 1) {
						$it = 1;
						$tag_list .= 'AND ' ;
						foreach ($tags as $skill) {
							if ($it == sizeof($tags)) {
								$tag_list .= 'skills LIKE "%'.$skill.'%"' ;
							}else {
								$tag_list .= 'skills LIKE "%'.$skill.'%" OR ' ;
							}
							$it++ ;
						}
					}

					//code for the key words sellected
					$key_list = "";
					if (sizeof($searchterm) == 1 && $searchterm[0] =="") {
							$key_list .= '' ;
					}elseif (sizeof($searchterm) >= 1) {
						$iit = 1;
						$key_list .= 'AND ' ;
						foreach ($searchterm as $key_w) {
							if ($iit == sizeof($searchterm)) {
									$key_list .= 'freelancer_title LIKE "%'.$key_w.'%"' ;
							}else {
								$key_list .= 'freelancer_title LIKE "%'.$key_w.'%" OR ' ;
							}
							$iit++ ;
						}
					}

					if (sizeof($searchterm) == 1 && $searchterm[0] ==""){
						$num_result= 0;
					}else {
						$sql_query = 'SELECT * FROM freelancer WHERE active=1
																		 AND delete_remove=0 '.$key_list ;
					  $query = $DBH->prepare($sql_query);
						//echo $sql_query;

						$query->execute();
						/* End  of search algorithm */
						$num_result = $query->rowCount();
					}

				if($num_result >0) {
				 $x = 1;

				foreach($query->fetchAll() as $row) {
					$name1 = $row['name'];
					$username1 = $row['username'];
					$imagelocation = $row['imagelocation'];
					$displayed[] = $row['freelancerid']; //array used to monitor already displayed freelancers

				$q2 = DB::getInstance()->get("profile", "*", ["userid" => $row['freelancerid']]);
				if ($q2->count()) {
				foreach($q2->results() as $r2) {
				 $country = $r2->country;
				 $rate_hour = $r2->rate;
				}
				}


				$qj = DB::getInstance()->get("job", "*", ["AND" =>["freelancerid" => $row['freelancerid'], "invite" => "0", "delete_remove" => 0, "accepted" => 1]]);
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
				$qr = DB::getInstance()->get("ratings", "*", ["AND" => ["freelancerid" => $row['freelancerid']]]);
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
								<a href="freelancer.php?a=overview&id=<?php echo escape($row['freelancerid']); ?>"><img style="width:110px; height:110px;" src="Freelancer/<?php echo escape($imagelocation); ?>" alt=""></a>
							</div>

							<!-- Name -->
							<div class="freelancer-name">
								<h4><a href="single-freelancer-profile.html"><?php echo escape($name1); ?><img class="flag"  src="images/flags/gb.svg" alt="" title="United Kingdom" data-tippy-placement="top"></a></h4>
								<span><?php echo escape($row['freelancer_title']); ?></span>
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
						<a href="freelancer.php?a=overview&id=<?php echo escape($row['freelancerid']); ?>" class="button button-sliding-icon ripple-effect">View Profile <i class="icon-material-outline-arrow-right-alt"></i></a>
					</div>
				</div>
				<!-- Freelancer / End -->

				<?php
					}
				}/*
				echo "<pre>";
				print_r($displayed);
				echo "</pre>";*/
				$sql_query_1 = 'SELECT * FROM profile WHERE rate >= '.$price[0].
															 ' AND rate <= '.$price[1].
															 ' AND active=1
																 AND delete_remove=0 '.$tag_list ;
				$query1 = $DBH->prepare($sql_query_1);
				//echo $sql_query_1;
				$query1->execute();
				/* End  of search algorithm */
		 if($query1->rowCount()) {
			 foreach($query1->fetchAll() as $row1) {
				 if (in_array($row1['userid'], $displayed)) {
				 	continue;
				 }
				 $is_there = 0;
					$rate_hour = $row1['rate'];
					$country = $row1['country'];
					 $qq2 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $row1['userid']]);
					 if ($qq2->count()) {
						 foreach($qq2->results() as $r2) {
							 $name1 = $r2->name;
							 $username1 = $r2->username;
							 $imagelocation = $r2->imagelocation;
							 $freelancer_title = $r2->freelancer_title ;
						 }
					 }



					 				$qj = DB::getInstance()->get("job", "*", ["AND" =>["freelancerid" => $row1['userid'], "invite" => "0", "delete_remove" => 0, "accepted" => 1]]);
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
					 				$qr = DB::getInstance()->get("ratings", "*", ["AND" => ["freelancerid" => $row1['userid']]]);
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
								<a href="freelancer.php?a=overview&id=<?php echo escape($row1['userid']); ?>"><img style="width:110px; height:110px;" src="Freelancer/<?php echo escape($imagelocation); ?>" alt=""></a>
							</div>

							<!-- Name -->
							<div class="freelancer-name">
								<h4><a href="freelancer.php?a=overview&id=<?php echo escape($row1['userid']); ?>"><?php echo escape($name1); ?><img class="flag"  src="images/flags/gb.svg" alt="" title="United Kingdom" data-tippy-placement="top"></a></h4>
								<span><?php echo escape($freelancer_title); ?></span>
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
						<a href="freelancer.php?a=overview&id=<?php echo escape($row1['userid']); ?>" class="button button-sliding-icon ripple-effect">View Profile <i class="icon-material-outline-arrow-right-alt"></i></a>
					</div>
				</div>
				<!-- Freelancer / End -->
			<?php }} ?>



			</div>
			<!-- Freelancers Container / End -->


			<!-- Pagination -->
			<div class="clearfix"></div>
			<?php //echo Pagination($total,$limit,$page); ?>

		</div>
	</div>
</div>

<!-- include footer.php Basic Page scripts and footer section Needs
================================================== -->
<?php include ('includes/template/front_footer.php'); ?>

</body>

</html>

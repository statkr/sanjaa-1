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
			<?php include 'includes/template/side_job_search.php' ; ?>

			</div>


		<div class="col-xl-9 col-lg-8 content-left-offset">

			<h3 class="page-title">Available Projects</h3>

			<div class="notify-box margin-top-15">
				<div class="switch-container">
					<label class="switch"><span class="switch-text"></span></label>
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

			<!-- Tasks Container -->
			<div class="tasks-list-container compact-list margin-top-35">

				<?php
						  $limit = 5;
				      $query = DB::getInstance()->get("job", "*", ["ORDER" => "date_added DESC",
				                                                        "AND" => [
				                                                                  "featured" => 1,
				                                                                  "active" => 1,
				                                                                  "delete_remove" => 0
				                                                                 ]]);
						  if($query->count()) {
						    $x = 1;

							foreach($query->results() as $row) {

							//Getting Proposals
							$q2 = DB::getInstance()->get("proposal", "*", ["jobid" => $row->jobid]);
							 if ($q2->count() === 0) {
							  $job_proposals = 0;
							 } else {
							  $job_proposals = $q2->count();
							 }

							$blurb = truncateHtml($row->description, 100);
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
							</div>
							<span class="button button-sliding-icon ripple-effect">Apply Now <i class="icon-material-outline-arrow-right-alt"></i></span>
						</div>
					</div>
				</a>
		<?php }}?>



		<?php
			$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
			$limit = $job_limit;
			$startpoint = ($page * $limit) - $limit;

			$q1 = DB::getInstance()->get("job", "*");
			$total = $q1->count();

			$query = DB::getInstance()->get("job", "*", ["ORDER" => "date_added DESC", "LIMIT" => [$startpoint, $limit],
														"AND #first" => [
															"featured" => 0,
															"invite" => 0,
															"public" => 1,
															"accepted" => 0,
															"active" => 1,
															"delete_remove" => 0
														]
													]);
		if($query->count()) {
		$x = 1;

		foreach($query->results() as $row) {

		//Getting Proposals
		$q2 = DB::getInstance()->get("proposal", "*", ["jobid" => $row->jobid]);
		 if ($q2->count() === 0) {
			$job_proposals = 0;
		 } else {
			$job_proposals = $q2->count();
		 }

		$blurb = truncateHtml($row->description, 100);
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
						</div>
						<span class="button button-sliding-icon ripple-effect">Apply Now <i class="icon-material-outline-arrow-right-alt"></i></span>
					</div>
				</div>
			</a>
	<?php }
	}else {
	 echo '<p>'.$lang['no_content_found'].'</p>';
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

<!-- Mirrored from www.vasterad.com/themes/hireo/tasks-list-layout-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 Sep 2018 11:13:44 GMT -->
</html>

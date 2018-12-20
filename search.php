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
				$q1 = DB::getInstance()->get("job", "*", ["title[~]" => $searchterm]);
				$total = $q1->count();

 				/* Start of search algorithm */

				/* search fields */
				 $searchterm = explode(",", isset($_GET['searchterm'])?Input::get('searchterm'):array(1) );
				 $selected_cats = isset($_GET['selected_cats'])?Input::get('selected_cats'):array(1) ;
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
						if (sizeof($selected_cats) == 1 && $selected_cats[0] == 1) {
							$tag_list .= '' ;
						}else {
							$tag_list .= 'AND ' ;
						}
					}elseif (sizeof($tags) >= 1) {
						$it = 1;
						foreach ($tags as $skill) {
							if ($it == sizeof($tags) && $selected_cats[0] != 1) {
								$tag_list .= 'skills LIKE "%'.$skill.'%" AND' ;
							}elseif ($it == sizeof($tags) && sizeof($selected_cats) == 1 && $selected_cats[0] == 1) {
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
						if (sizeof($tags) == 1 && $tags[0] =="") {
							$key_list .= '' ;
						}else {
							$key_list .= 'AND ' ;
						}
					}elseif (sizeof($searchterm) >= 1) {
						$iit = 1;
						$key_list .= 'AND ' ;
						foreach ($searchterm as $key_w) {
							if ($iit == sizeof($searchterm) && sizeof($tags) == 1 && $tags[0] =="") {
								if (sizeof($selected_cats) == 1 && $selected_cats[0] == 1) {
									$key_list .= 'title LIKE "%'.$key_w.'%"' ;
								}else {
									$key_list .= 'title LIKE "%'.$key_w.'%" AND' ;
								}
							}else {
								$key_list .= 'title LIKE "%'.$key_w.'%" OR ' ;
							}
							$iit++ ;
						}
					}


					 //category parameters
				   $inQuery = implode(',', array_fill(0, count($selected_cats), '?'));
					 if (sizeof($selected_cats) == 1 && $selected_cats[0] == 1) {
					 		$inQuery = '' ;
					 }else{
						 $inQuery = ' catid IN ('.$inQuery.')' ;
					 }

					 $sql_query = 'SELECT * FROM job WHERE budget >= '.$price[0].
					 												' AND budget <= '.$price[1].
																	' AND active=1
																		AND public=1
																	  AND delete_remove=0 '.$key_list.''.$tag_list.''.$inQuery ;

					 $query = $DBH->prepare($sql_query);
					 //echo $sql_query;

					 // bindvalue is 1-indexed, so $k+1
					 foreach ($selected_cats as $k => $id){
					     $query->bindValue(($k+1), $id);
					 }
					 $query->execute();
					 /* End  of search algorithm */





			 if($query->rowCount()) {
				 $x = 1;
			 foreach($query->fetchAll() as $row) {
			 //Getting Proposals
			 $q2 = DB::getInstance()->get("proposal", "*", ["jobid" => $row["jobid"]]);
				if ($q2->count() === 0) {
				 $job_proposals = 0;
				} else {
				 $job_proposals = $q2->count();
				}

			 $blurb = truncateHtml($row["description"], 100);
			 ?>
				<!-- Task -->
				<a href="jobpost.php?title=<?php echo escape($row["slug"]); ?>" class="task-listing">

					<!-- Job Listing Details -->
					<div class="task-listing-details">

						<!-- Details -->
						<div class="task-listing-description">
							<h3 class="task-listing-title"><?php echo escape($row["title"]); ?></h3>
							<ul class="task-icons">
								<li><i class="icon-material-outline-location-on"></i><?php echo escape($row["country"]); ?></li>
								<li><i class="icon-material-outline-access-time"></i><?php echo ago(strtotime($row["date_added"])); ?> </li>
								<li><i class="icon-feather-users"></i> <?php echo escape($job_proposals); ?> Proposals</li>
							</ul>
							<p class="task-listing-text"><?php echo $blurb; ?></p>
							<div class="task-tags">

								<?php
								$n =0;
								$skills_arr = explode(',', $row["skills"]);
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
								<strong><?php echo escape($row["budget"]); ?> Fcfa</strong>
								<span>Fixed Price</span>
							</div>
							<span class="button button-sliding-icon ripple-effect">Apply Now <i class="icon-material-outline-arrow-right-alt"></i></span>
						</div>
					</div>
				</a>
		<?php }}else {
			echo "<b>No Matched Projects</b>";
		}  ?>





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

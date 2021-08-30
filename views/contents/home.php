<?php
	/*
	//Get profile users
	$json_statistics  = file_get_contents(SERVER_API . 'Dashboards/get_statistics_dashboard/');
	$array_statistics = json_decode($json_statistics );
	$statistics		  = $array_statistics->data;
	
	//Get data highcharts
	$json_statistics2  = file_get_contents(SERVER_API . 'Dashboards/get_proforms_highCharts/October');
	$array_statistics2 = json_decode($json_statistics2 );
	//$statistics2		  = $array_statistics2->data;
	
	//print_r($json_statistics2);
	*/
?>
<div class="wrapper-content ">
	<div class="row">
		<div class="col-md-6 mtop15">
			<div class="profile-image">
			<img alt="profile" class="img-circle circle-border m-b-md" src="../assets/images/uploads/<?php echo $_COOKIE['user_image']?>"> </div>
			<div class="profile-info">
				<div>
					<div>
						<h2 class="no-margins"> <?php echo $_COOKIE['first_name']. ' ' .$_COOKIE['last_name']?> </h2>
						<h4><?php echo $_COOKIE['profile']?></h4>
						<small> There are many variations of passages of Lorem Ipsum available, but the majority
						have suffered alteration in some form Ipsum available. </small> </div>
				</div>
			</div>
		</div>
		
		
	</div>
</div>

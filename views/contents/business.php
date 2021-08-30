<?php  /*
	$id_url=explode("/", $_GET['views']);
	$codigo = $id_url['1'];
	
	$json_user = file_get_contents(SERVER_API . 'Users/update_user/'.$codigo);
	$datos_user = json_decode($json_user );
	$get_data = $datos_user->data;
	//var_dump($get_data);
	//Get profile users
	$json_profile = file_get_contents(SERVER_API . 'Users/get_profile_user/');
	$datos_profile = json_decode($json_profile );
	$datos = $datos_profile->data;
	
	
	$json_prov = file_get_contents(SERVER_API . 'Users/get_prov/');
	$datos_prov = json_decode($json_prov);
	$data_prov = $datos_prov->data;
*/
?>
<div class="wrapper-content" id="business_efect">


<div class="tab-content">
	<div class="tab-pane fade active in" id="info_general">
		<div class="panel-body"> <strong>Lorem ipsum dolor sit amet</strong>
		<p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap. </p>
		<p> Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, </p>
		</div>
	</div>
	<div class="tab-pane fade" id="configuracion">
		<div class="panel-body"> <strong>Lorem ipsum dolor sit amet</strong>
			<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. </p>
			<p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
				sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
		</div>
	</div>
	<div class="tab-pane fade" id="reglamento">
		<div class="panel-body">
			<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. </p>
		</div>
	</div>
	<!--

	<div class="row">
		<div class="col-sm-4">
            <div class="social-feed-box">
				<div class="pull-right social-action dropdown">
					<button class="dropdown-toggle btn-white" data-toggle="dropdown"> <i class="fa fa-angle-down"></i> </button>
					<ul class="dropdown-menu m-t-xs">
						<li><a href="#">Mute</a></li>
						<li><a href="#">Block</a></li>
						<li><a href="#">Report</a></li>
					</ul>
				</div>
				<div class="social-avatar"> <a class="pull-left" href=""> <img src="<?php echo SERVER_URL ?>assets/images/teem/placeholders.jpg" alt="image"> </a>
					<div class="media-body"> <a href="#">Mitch Buchannon </a> <small class="text-muted">Today 9:00 pm - 11.06.20117</small> </div>
				</div>
				<div class="social-body"> <img alt="" class="img-responsive" src="<?php echo SERVER_URL ?>assets/images/gallery/placeholders.jpg">
					<div class="btn-group">
						<button class="btn btn-white btn-xs"><i class="fa fa-thumbs-up"></i> Like this!</button>
						<button class="btn btn-white btn-xs"><i class="fa fa-comments"></i> Comment</button>
						<button class="btn btn-white btn-xs"><i class="fa fa-share"></i> Share</button>
					</div>
				</div>
				<div class="social-footer">
					<div class="social-comment"> <a class="pull-left" href=""> <img src="<?php echo SERVER_URL ?>assets/images/teem/placeholders.jpg" alt="image"> </a>
						<div class="media-body"> <a href="#">Mitch Buchannon </a> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam euismod eleifend ipsum, at posuere augue. Pellentesque mi felis, aliquam at iaculis eu, mi felis, aliquam at iaculis mi felis, aliquam at iaculis finibus eu ex. Integer efficitur tincidunt malesuada. Sed sit amet molestie elit, vel placerat ipsum. <br>
						<a class="small" href="#"><i class="fa fa-thumbs-up"></i> 26 Like this!</a> - <small class="text-muted">12.06.2014</small> </div>
					</div>
					<div class="social-comment"> <a class="pull-left" href=""> <img src="<?php echo SERVER_URL ?>assets/images/teem/placeholders.jpg" alt="image"> </a>
						<div class="media-body"> <a href="#">Robert Angier </a> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam euismod eleifend ipsum, at posuere augue. <br>
						<a class="small" href="#"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> - <small class="text-muted">2.01.2017</small> </div>
					</div>
					<div class="social-comment"> <a class="pull-left" href=""> <img src="<?php echo SERVER_URL ?>assets/images/teem/placeholders.jpg" alt="image"> </a>
						<div class="media-body"> <a href="#"> Jordan Belfort </a> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam euismod eleifend ipsum, at posuere augue. <br>
						<a class="small" href="#"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> - <small class="text-muted">2.01.2017</small> </div>
					</div>
					<div class="social-comment"> <a class="pull-left" href=""> <img src="<?php echo SERVER_URL ?>assets/images/teem/placeholders.jpg" alt="image"> </a>
						<div class="media-body">
							<textarea placeholder="Write comment..." class="form-control"></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
            <div class="social-feed-box">
				<div class="pull-right social-action dropdown">
					<button class="dropdown-toggle btn-white" data-toggle="dropdown"> <i class="fa fa-angle-down"></i> </button>
					<ul class="dropdown-menu m-t-xs">
						<li><a href="#">Mute</a></li>
						<li><a href="#">Block</a></li>
						<li><a href="#">Report</a></li>
					</ul>
				</div>
				<div class="social-avatar"> <a class="pull-left" href=""> <img src="<?php echo SERVER_URL ?>assets/images/teem/placeholders.jpg" alt="image"> </a>
					<div class="media-body"> <a href="#">Mitch Buchannon </a> <small class="text-muted">Today 9:00 pm - 11.06.20117</small> </div>
				</div>
				<div class="social-body">
					<p> Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Packages and web page editors now use Lorem Ipsum as their default model text. </p>
					<img alt="" class="img-responsive" src="<?php echo SERVER_URL ?>assets/images/gallery/placeholders.jpg">
					<div class="btn-group">
						<button class="btn btn-white btn-xs"><i class="fa fa-thumbs-up"></i> Like this!</button>
						<button class="btn btn-white btn-xs"><i class="fa fa-comments"></i> Comment</button>
						<button class="btn btn-white btn-xs"><i class="fa fa-share"></i> Share</button>
					</div>
				</div>
				<div class="social-footer">
					<div class="social-comment"> <a class="pull-left" href=""> <img src="<?php echo SERVER_URL ?>assets/images/teem/placeholders.jpg" alt="image"> </a>
						<div class="media-body"> <a href="#">Mitch Buchannon </a> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam euismod eleifend ipsum, at posuere augue. Pellentesque mi felis, aliquam at iaculis eu, mi felis, aliquam at iaculis mi felis, aliquam at iaculis finibus eu ex. Integer efficitur tincidunt malesuada. Sed sit amet molestie elit, vel placerat ipsum. <br>
						<a class="small" href="#"><i class="fa fa-thumbs-up"></i> 26 Like this!</a> - <small class="text-muted">12.06.2014</small> </div>
					</div>
					<div class="social-comment"> <a class="pull-left" href=""> <img src="<?php echo SERVER_URL ?>assets/images/teem/placeholders.jpg" alt="image"> </a>
						<div class="media-body"> <a href="#">Robert Angier </a> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam euismod eleifend ipsum, at posuere augue. <br>
						<a class="small" href="#"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> - <small class="text-muted">2.01.2017</small> </div>
					</div>
					<div class="social-comment"> <a class="pull-left" href=""> <img src="<?php echo SERVER_URL ?>assets/images/teem/placeholders.jpg" alt="image"> </a>
						<div class="media-body"> <a href="#"> Jordan Belfort </a> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam euismod eleifend ipsum, at posuere augue. <br>
						<a class="small" href="#"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> - <small class="text-muted">2.01.2017</small> </div>
					</div>
					<div class="social-comment"> <a class="pull-left" href=""> <img src="<?php echo SERVER_URL ?>assets/images/teem/placeholders.jpg" alt="image"> </a>
						<div class="media-body">
							<textarea placeholder="Write comment..." class="form-control"></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
            <div class="social-feed-box">
				<div class="pull-right social-action dropdown">
					<button class="dropdown-toggle btn-white" data-toggle="dropdown"> <i class="fa fa-angle-down"></i> </button>
					<ul class="dropdown-menu m-t-xs">
						<li><a href="#">Mute</a></li>
						<li><a href="#">Block</a></li>
						<li><a href="#">Report</a></li>
					</ul>
				</div>
				<div class="social-avatar"> <a class="pull-left" href=""> <img src="<?php echo SERVER_URL ?>assets/images/teem/placeholders.jpg" alt="image"> </a>
					<div class="media-body"> <a href="#">Mitch Buchannon </a> <small class="text-muted">Today 9:00 pm - 11.06.20117</small> </div>
				</div>
				<div class="social-body">
					<p> Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Packages and web page editors now use Lorem Ipsum as their default model text. </p>
					<img alt="" class="img-responsive" src="<?php echo SERVER_URL ?>assets/images/gallery/placeholders.jpg">
					<div class="btn-group">
						<button class="btn btn-white btn-xs"><i class="fa fa-thumbs-up"></i> Like this!</button>
						<button class="btn btn-white btn-xs"><i class="fa fa-comments"></i> Comment</button>
						<button class="btn btn-white btn-xs"><i class="fa fa-share"></i> Share</button>
					</div>
				</div>
				<div class="social-footer">
					<div class="social-comment"> <a class="pull-left" href=""> <img src="<?php echo SERVER_URL ?>assets/images/teem/placeholders.jpg" alt="image"> </a>
						<div class="media-body"> <a href="#">Mitch Buchannon </a> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam euismod eleifend ipsum, at posuere augue. Pellentesque mi felis, aliquam at iaculis eu, mi felis, aliquam at iaculis mi felis, aliquam at iaculis finibus eu ex. Integer efficitur tincidunt malesuada. Sed sit amet molestie elit, vel placerat ipsum. <br>
						<a class="small" href="#"><i class="fa fa-thumbs-up"></i> 26 Like this!</a> - <small class="text-muted">12.06.2014</small> </div>
					</div>
					<div class="social-comment"> <a class="pull-left" href=""> <img src="<?php echo SERVER_URL ?>assets/images/teem/placeholders.jpg" alt="image"> </a>
						<div class="media-body"> <a href="#">Robert Angier </a> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam euismod eleifend ipsum, at posuere augue. <br>
						<a class="small" href="#"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> - <small class="text-muted">2.01.2017</small> </div>
					</div>
					<div class="social-comment"> <a class="pull-left" href=""> <img src="<?php echo SERVER_URL ?>assets/images/teem/placeholders.jpg" alt="image"> </a>
						<div class="media-body"> <a href="#"> Jordan Belfort </a> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam euismod eleifend ipsum, at posuere augue. <br>
						<a class="small" href="#"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> - <small class="text-muted">2.01.2017</small> </div>
					</div>
					<div class="social-comment"> <a class="pull-left" href=""> <img src="<?php echo SERVER_URL ?>assets/images/teem/placeholders.jpg" alt="image"> </a>
						<div class="media-body">
							<textarea placeholder="Write comment..." class="form-control"></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>-->
</div>

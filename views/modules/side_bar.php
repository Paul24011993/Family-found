<div class="page-sidebar-wrapper">
	<div class="page-sidebar" >
		<ul class="page-sidebar-menu  page-header-fixed " id="accordion">
			<li class="sidebar-search-wrapper">
				<!-- START RESPONSIVE SEARCH FORM -->
				<form class="sidebar-search  " action="search_results.html" method="POST" autocomplete="off">
					<a href="javascript:;" class="remove"> <i class="icon-close"></i> </a>
					<div class="input-group">
						<input type="text" class="form-control" id="search" placeholder="Buscar...">
						<span class="input-group-btn"> 
							<a href="javascript:;" class="btn submit">
								<i class="icon-magnifier"></i>
							</a> 
						</span>
					</div>
				</form>
				<div class="card my-4" id="card_result">
					<div class="car-body">
						<ul class="page-sidebar-menu" id="result-search"></ul>
					</div>
				</div>
				<!-- END RESPONSIVE SEARCH FORM -->
			</li>
			<li class="nav-item active">
				<a class="nav-link nav-toggle" id="item-home" href="<?php echo SERVER_URL?>home/"> <i class="fa fa-th-large"></i> <span class="title">Inicio</span> </a>
			</li>
		</ul>
	</div>
</div>

<?php 
$filelist = dirToArray(PUBLIC_PATH . '/reports-photographics/aprobado');
$hidenames = (isset($_GET['hidenames']) &&  $_GET['hidenames'] == true) ? true : false;
?>
<style> 
.tree li {
    list-style-type:none;
    margin:0;
    padding:10px 5px 0 5px;
    position:relative
}
.tree li::before, 
.tree li::after {
    content:'';
    left:-20px;
    position:absolute;
    right:auto
}
.tree li::before {
    border-left:2px solid #000;
    bottom:50px;
    height:100%;
    top:0;
    width:1px
}
.tree li::after {
    border-top:2px solid #000;
    height:20px;
    top:25px;
    width:25px
}
.tree li span {
    -moz-border-radius:5px;
    -webkit-border-radius:5px;
    border:2px solid #000;
    border-radius:3px;
    display:inline-block;
    padding:3px 8px;
    text-decoration:none;
    cursor:pointer;
}
.tree>ul>li::before,
.tree>ul>li::after {
    border:0
}
.tree li:last-child::before {
    height:27px
}
.tree li span:hover {
    background: DARKSEAGREEN;
    border:2px solid #94a0b4;
    }

[aria-expanded="false"] > .expanded,
[aria-expanded="true"] > .collapsed {
  display: none;
}
    
    
</style>

<div class="page-title">
	<div class="title_left">
		<h3>Explorador de archivos (BETA)</h3>
	</div>
</div>
<div class="clearfix"></div>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2><?= $title; ?></h2>
				<ul class="nav navbar-right panel_toolbox">
					<!-- // 
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a></li>
							<li><a href="#">Settings 2</a></li>
						</ul>
					</li>
					<li><a class="close-link"><i class="fa fa-close"></i></a></li>
					-->
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="tree ">
					<ul>
						<?php 
						foreach($filelist as $year=>$period){
							$continue1 = (is_array($period)) ? true : false;
							?>
							<li>
								<span>
									<a style="color:#000; text-decoration:none;" data-toggle="collapse" href="#year-<?= $year; ?>" aria-expanded="false" aria-controls="year-<?= $year; ?>">
										<i class="collapsed"><i class="fa fa-folder"></i></i>
										<i class="expanded"><i class="fa fa-folder-open"></i></i> 
										<?= $year; ?>
										<?= " (" . (($continue1) ? count($period) : 0) . ") "; ?>
									</a>
								</span>
								<div id="year-<?= $year; ?>" class="collapse ">
									<ul>
										<?php 
										if($continue1 == true){
											foreach($period as $period_name=>$group){ 
												$continue2 = (is_array($group)) ? true : false;
												//https://areadeclientes.monteverdeltda.com/index.php?action=CreateZipPhotos&period_name=MTYtMjggRkVCUkVSTw==
												?>
												<li>
													<span>
														<a style="color:#000; text-decoration:none;" data-toggle="collapse" href="#year-<?= $year; ?>-period-<?= strtolower(strtr($period_name, " .", "--")); ?>" aria-expanded="false" aria-controls="year-<?= $year; ?>-period-<?= strtolower(strtr($period_name, " .", "--")); ?>">
															<i class="collapsed"><i class="fa fa-folder"></i></i>
															<i class="expanded"><i class="fa fa-folder-open"></i></i> 
															<?= ($period_name); ?>
															<?= " (" . (($continue2) ? count($group) : 0) . ") "; ?>
														</a>
													</span> 
													<ul>
														<div id="year-<?= $year; ?>-period-<?= strtolower(strtr($period_name, " .", "--")); ?>" class="collapse">
															
															<li>
																<span>
																	<a style="color:#000; text-decoration:none;" href="<?= "/index.php?action=CreateZipPhotos&year={$year}&period_name=" . base64_encode($period_name); ?>" download="">
																		Descargar
																	</a>
																</span>
															</li>
															<?php 
															if($continue2 == true){
																foreach($group as $group_name=>$microroute){
																	$continue3 = (is_array($microroute)) ? true : false;
																	?>
																	<li>
																		<span>
																			<a style="color:#000; text-decoration:none;" data-toggle="collapse" href="#year-<?= $year; ?>-period-<?= strtolower(strtr($period_name, " .", "--")); ?>-group-<?= strtolower(strtr($group_name, " .", "--")); ?>" aria-expanded="false" aria-controls="year-<?= $year; ?>-period-<?= strtolower(strtr($period_name, " .", "--")); ?>-group-<?= strtolower(strtr($group_name, " .", "--")); ?>">
																				<i class="collapsed"><i class="fa fa-folder"></i></i>
																				<i class="expanded"><i class="fa fa-folder-open"></i></i> 
																				<?= $group_name; ?>
																				<?= " (" . (($continue3) ? count($microroute) : 0) . ") "; ?>
																			</a>
																		</span>
																		<ul>
																			<div id="year-<?= $year; ?>-period-<?= strtolower(strtr($period_name, " .", "--")); ?>-group-<?= strtolower(strtr($group_name, " .", "--")); ?>" class="collapse">
																				<?php 
																				if($continue3 == true){
																					foreach($microroute as $microroute_name=>$type){
																						$continue4 = (is_array($type)) ? true : false;
																						?>
																						<li>
																							<span>
																								<a style="color:#000; text-decoration:none;" data-toggle="collapse" href="#year-<?= $year; ?>-period-<?= strtolower(strtr($period_name, " .", "--")); ?>-group-<?= strtolower(strtr($group_name, " .", "--")); ?>-microroute-<?= strtolower(strtr($microroute_name, " .", "--")); ?>" aria-expanded="false" aria-controls="year-<?= $year; ?>-period-<?= strtolower(strtr($period_name, " .", "--")); ?>-group-<?= strtolower(strtr($group_name, " .", "--")); ?>-microroute-<?= strtolower(strtr($microroute_name, " .", "--")); ?>">
																									<i class="collapsed"><i class="fa fa-folder"></i></i>
																									<i class="expanded"><i class="fa fa-folder-open"></i></i> 
																									<?= $microroute_name; ?>
																									<?= " (" . (($continue4) ? count($type) : 0) . ") "; ?>
																								</a>
																							</span>
																							<ul>
																								<div id="year-<?= $year; ?>-period-<?= strtolower(strtr($period_name, " .", "--")); ?>-group-<?= strtolower(strtr($group_name, " .", "--")); ?>-microroute-<?= strtolower(strtr($microroute_name, " .", "--")); ?>" class="collapse">
																									<?php 
																									if($continue4 == true){
																										foreach($type as $type_name=>$status){
																											$continue5 = (is_array($status)) ? true : false;
																											?>
																											<li>
																												<span>
																													<a style="color:#000; text-decoration:none;" data-toggle="collapse" href="#year-<?= $year; ?>-period-<?= strtolower(strtr($period_name, " .", "--")); ?>-group-<?= strtolower(strtr($group_name, " .", "--")); ?>-microroute-<?= strtolower(strtr($microroute_name, " .", "--")); ?>-type-<?= strtolower(strtr($type_name, " .", "--")); ?>" aria-expanded="false" aria-controls="year-<?= $year; ?>-period-<?= strtolower(strtr($period_name, " .", "--")); ?>-group-<?= strtolower(strtr($group_name, " .", "--")); ?>-microroute-<?= strtolower(strtr($microroute_name, " .", "--")); ?>-type-<?= strtolower(strtr($type_name, " .", "--")); ?>">
																														<i class="collapsed"><i class="fa fa-folder"></i></i>
																														<i class="expanded"><i class="fa fa-folder-open"></i></i> 
																														<?= $type_name; ?>
																														<?= " (" . (($continue5) ? count($status) : 0) . ") "; ?>
																													</a>
																												</span>
																												<ul>
																													<div id="year-<?= $year; ?>-period-<?= strtolower(strtr($period_name, " .", "--")); ?>-group-<?= strtolower(strtr($group_name, " .", "--")); ?>-microroute-<?= strtolower(strtr($microroute_name, " .", "--")); ?>-type-<?= strtolower(strtr($type_name, " .", "--")); ?>" class="collapse">
																														<?php 
																															if($continue5 == true){
																																$photos_total = 0;;
																																foreach($status as $status_name=>$photo){
																																	$continue6 = (!is_array($photo) && is_string($photo)) ? true : false;
																																	if($continue6 == true){
																																		$photos_total++;
																																		if($hidenames === false){
																																			echo "<li>
																																				<span>
																																					<a data-style-active=\"text\" style=\"cursor:pointer;\" class=\"linkToImg\" data-file_name=\"{$photo}\" data-path_short=\"/public/reports-photographics/aprobado/{$year}/{$period_name}/{$group_name}/{$microroute_name}/{$type_name}/{$photo}\">
																																						<i class=\"fa fa-folder\"></i> {$photo}
																																					</a>
																																				</span>
																																			</li>";
																																			#echo '<li><span><i class="fa fa-file"></i><a href="#!"> ' . $photo . '</a></span></li>';
																																		}
																																	}
																																} ?>
																																<?php if($hidenames === true){ ?>
																																	<?= "<li><a>" . ($photos_total) . "</a></li>"; ?>
																																<?php } ?>
																															<?php } ?>
																														
																													</div>
																												</ul>
																											</li>
																										<?php } ?>
																									<?php } ?>
																								</div>
																							</ul>
																						</li>
																					<?php } ?>
																				<?php } ?>
																			</div>
																		</ul>
																	</li>
																<?php } ?>
															<?php } ?>
														</div>
													</ul>
												</li>
											<?php } ?>
										<?php } ?>
									</ul>
								</div>
							</li>
						<?php } ?>
					</ul>
				</div>

			</div>
		</div>
	</div>
</div>


<script>

$(".linkToImg").click(function(a){
	console.log('Click');
	TextThis = $(this).data('file_name');
	path_shortThis = $(this).data('path_short');
	styleActive = $(this).data('style-active');
	console.log(styleActive);
	
	if(styleActive == 'text'){
		$(this).data('style-active', 'image');
		$img = $('<img />');
		$img.attr('width', '225px');
		$img.attr('class', 'img img-responsive');
		$img.data('file_name', TextThis);
		$img.attr('src', path_shortThis);
		$(this).html($img);
	} else {
		$(this).data('style-active', 'text');
		$(this).html(TextThis);
	}
});

</script>
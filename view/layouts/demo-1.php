<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/
?>
<!DOCTYPE html>
<html lang="<?= $this->getLang(); ?>">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="<?= $this->getCharset(); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?= $title; ?></title>
		<?= $this->head(); ?>
	</head>
	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<div class="col-md-3 left_col">
					<div class="left_col scroll-view">
                        <?= 
                            PHPStrap\Util\Html::tag('div', 
                                    FelipheGomez\Url::a(['demo/index']
                                        , PHPStrap\Util\Html::tag('i', '', ['fa fa-leaf']) . PHPStrap\Util\Html::tag('span', 'C&CMS')
                                        , ['site_title'])
                                , ['navbar nav_title']
                                , ['style' => 'border: 0;']) 
                            . PHPStrap\Util\Html::clearfix(); ?>
							<!-- menu profile quick info -->
							 <?php
								$profile_pic = PHPStrap\Util\Html::tag('div', 
									PHPStrap\Media::image('/public/assets/images/img.jpg', '...', ['img-circle profile_img'])
								, ['profile_pic']);
								$profile_info = PHPStrap\Util\Html::tag('div', 
									PHPStrap\Util\Html::tag('span', 'Bienvend@, ')
									. PHPStrap\Util\Html::tag('h2', 'Feliphe Gomez')
								, ['profile_info']);
							?>
							<?= PHPStrap\Util\Html::tag('div', $profile_pic . $profile_info . PHPStrap\Util\Html::clearfix(), ['profile clearfix']); ?>
							<!-- /menu profile quick info -->
						<br />
						<!-- sidebar menu -->
						<?php 
							/*
							Ejemplo: 
							// ---------------------------------------------------------------------------------------------
							$menu_section_1 = PHPStrap\Util\Html::tag('div', 
								PHPStrap\Util\Html::tag('h3', 'General')
								. PHPStrap\Util\Html::ul([
									PHPStrap\Util\Html::tag('li', 
										FelipheGomez\Url::a('javascript:void(0)', PHPStrap\Util\Html::tag('i', ' ', ["fa fa-home"]) . "Home" . PHPStrap\Util\Html::tag('span', '', ["fa fa-chevron-down"]))
										. PHPStrap\Util\Html::ul([
											PHPStrap\Util\Html::tag('li', FelipheGomez\Url::a(['demo/index'], 'Dashboard'))
											, PHPStrap\Util\Html::tag('li', FelipheGomez\Url::a(['demo/index2'], 'Dashboard 2'))
											, PHPStrap\Util\Html::tag('li', FelipheGomez\Url::a(['demo/index3'], 'Dashboard 3'))
										], ['nav child_menu']))
								], ['nav side-menu'])
							, ['menu_section']);
							echo PHPStrap\Util\Html::tag('div', $menu_section_1.'<div class="clearfix"></div>', ['main_menu_side hidden-print main_menu'], ['id' => 'sidebar-menu']);
							// ---------------------------------------------------------------------------------------------
								<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
									<div class="menu_section">
										<h3>General</h3>
										<ul class="nav side-menu">
											<li>
												<a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
												<ul class="nav child_menu">
													<li><a href="/index.php?controller=demo&action=index&">Dashboard</a></li>
													<li><a href="/index.php?controller=demo&action=index2&">Dashboard 2</a></li>
													<li><a href="/index.php?controller=demo&action=index3&">Dashboard 3</a></li>
												</ul>
											</li>
										</ul>
									</div>
								</div>
							*/
							$menu_section_1 = PHPStrap\Util\Html::tag('div', 
								PHPStrap\Util\Html::tag('h3', 'General')
								. PHPStrap\Util\Html::ul([
									FelipheGomez\Url::a('javascript:void(0)', PHPStrap\Util\Html::tag('i', ' ', ["fa fa-home"]) . "Inicio" . PHPStrap\Util\Html::tag('span', '', ["fa fa-chevron-down"]))
									. PHPStrap\Util\Html::ul([
										FelipheGomez\Url::a(['demo/index'], 'Tablero')
										, FelipheGomez\Url::a(['demo/index2'], 'Tablero 2')
										, FelipheGomez\Url::a(['demo/index3'], 'Tablero 3')
									], ['nav child_menu'])
									, FelipheGomez\Url::a('javascript:void(0)', PHPStrap\Util\Html::tag('i', ' ', ["fa fa-edit"]) . "Formularios" . PHPStrap\Util\Html::tag('span', '', ["fa fa-chevron-down"]))
									. PHPStrap\Util\Html::ul([
										FelipheGomez\Url::a(['demo/form'], 'Formulario básico')
										, FelipheGomez\Url::a(['demo/form_advanced'], 'Componentes avanzados')
										, FelipheGomez\Url::a(['demo/form_validation'], 'Validación de formulario')
										, FelipheGomez\Url::a(['demo/form_wizards'], 'Asistente de formulario')
										, FelipheGomez\Url::a(['demo/form_upload'], 'Carga de formulario')
										, FelipheGomez\Url::a(['demo/form_buttons'], 'Botones de formulario')
									], ['nav child_menu'])
									, FelipheGomez\Url::a('javascript:void(0)', PHPStrap\Util\Html::tag('i', ' ', ["fa fa-desktop"]) . "Elementos de la IU" . PHPStrap\Util\Html::tag('span', '', ["fa fa-chevron-down"]))
										. PHPStrap\Util\Html::ul([
											FelipheGomez\Url::a(['demo/general_elements'], 'Elementos generales')
											, FelipheGomez\Url::a(['demo/media_gallery'], 'Galería media')
											, FelipheGomez\Url::a(['demo/typography'], 'Tipografía')
											, FelipheGomez\Url::a(['demo/icons'], 'Íconos')
											, FelipheGomez\Url::a(['demo/glyphicons'], 'Íconos - Glyphicons')
											, FelipheGomez\Url::a(['demo/widgets'], 'Widgets')
											, FelipheGomez\Url::a(['demo/invoice'], 'Factura')
											, FelipheGomez\Url::a(['demo/inbox'], 'Bandeja de entrada')
											, FelipheGomez\Url::a(['demo/calendar'], 'Calendario')
										], ['nav child_menu'])
									, FelipheGomez\Url::a('javascript:void(0)', PHPStrap\Util\Html::tag('i', ' ', ["fa fa-table"]) . "Tablas" . PHPStrap\Util\Html::tag('span', '', ["fa fa-chevron-down"]))
										. PHPStrap\Util\Html::ul([
											FelipheGomez\Url::a(['demo/tables'], 'Tablas')
											, FelipheGomez\Url::a(['demo/tables_dynamic'], 'Tabla dinámica')
										], ['nav child_menu'])
									, FelipheGomez\Url::a('javascript:void(0)', PHPStrap\Util\Html::tag('i', ' ', ["fa fa-bar-chart-o"]) . "Presentación de datos" . PHPStrap\Util\Html::tag('span', '', ["fa fa-chevron-down"]))
										. PHPStrap\Util\Html::ul([
											FelipheGomez\Url::a(['demo/chartjs'], 'Chart JS')
											, FelipheGomez\Url::a(['demo/chartjs2'], 'Chart JS2')
											, FelipheGomez\Url::a(['demo/morisjs'], 'Moris JS')
											, FelipheGomez\Url::a(['demo/echarts'], 'ECharts')
											, FelipheGomez\Url::a(['demo/other_charts'], 'Otros gráficos')
										], ['nav child_menu'])
									, FelipheGomez\Url::a('javascript:void(0)', PHPStrap\Util\Html::tag('i', ' ', ["fa fa-clone"]) . "Diseños" . PHPStrap\Util\Html::tag('span', '', ["fa fa-chevron-down"]))
										. PHPStrap\Util\Html::ul([
											FelipheGomez\Url::a(['demo/fixed_sidebar'], 'Barra lateral fija')
											, FelipheGomez\Url::a(['demo/fixed_footer'], 'Pie de página fijo')
										], ['nav child_menu'])
								], ['nav side-menu'])
							, ['menu_section']);
							
							$menu_section_2 = PHPStrap\Util\Html::tag('div', 
								PHPStrap\Util\Html::tag('h3', 'Live On')
								. PHPStrap\Util\Html::ul([
									FelipheGomez\Url::a('javascript:void(0)', PHPStrap\Util\Html::tag('i', ' ', ["fa fa-bug"]) . "Páginas adicionales" . PHPStrap\Util\Html::tag('span', '', ["fa fa-chevron-down"]))
										. PHPStrap\Util\Html::ul([
											FelipheGomez\Url::a(['demo/e_commerce'], 'Comercio electrónico')
											, FelipheGomez\Url::a(['demo/projects'], 'Proyectos')
											, FelipheGomez\Url::a(['demo/project_detail'], 'Detalle del proyecto')
											, FelipheGomez\Url::a(['demo/contacts'], 'Contactos')
											, FelipheGomez\Url::a(['demo/profile'], 'Perfil')
										], ['nav child_menu'])
									, FelipheGomez\Url::a('javascript:void(0)', PHPStrap\Util\Html::tag('i', ' ', ["fa fa-windows"]) . "Extras" . PHPStrap\Util\Html::tag('span', '', ["fa fa-chevron-down"]))
										. PHPStrap\Util\Html::ul([
											FelipheGomez\Url::a(['demo/page_403'], 'Error 403')
											, FelipheGomez\Url::a(['demo/page_404'], 'Error 404')
											, FelipheGomez\Url::a(['demo/page_500'], 'Error 500')
											, FelipheGomez\Url::a(['demo/plain_page'], 'Página simple')
											, FelipheGomez\Url::a(['demo/login'], 'Página de inicio de sesión')
											, FelipheGomez\Url::a(['demo/pricing_tables'], 'Tablas de precios')
										], ['nav child_menu'])
									, 
									FelipheGomez\Url::a('javascript:void(0)', 
										PHPStrap\Util\Html::tag('i', ' ', ["fa fa-windows"])
										. 'Landing Page'
										. PHPStrap\Util\Html::tag('span', 'Próximamente', ["label label-success pull-right"]))
									, PHPStrap\Util\Html::tag('a', PHPStrap\Util\Html::tag('i', ' ', ["fa fa-sitemap"]) . "Menú multinivel" . PHPStrap\Util\Html::tag('span', '', ["fa fa-chevron-down"]))
										. PHPStrap\Util\Html::ul([
											FelipheGomez\Url::a('#level1_1', 'Nivel uno')
											, PHPStrap\Util\Html::tag('a', "Nivel uno" . PHPStrap\Util\Html::tag('span', '', ["fa fa-chevron-down"]))
												. PHPStrap\Util\Html::ul([
													FelipheGomez\Url::a('#level2_1', 'Nivel dos', ['sub_menu'])
													, FelipheGomez\Url::a('#level2_2', 'Nivel dos')
													, FelipheGomez\Url::a('#level3_1', "Nivel tres" . PHPStrap\Util\Html::tag('span', '', ["fa fa-chevron-down"]))
														. PHPStrap\Util\Html::ul([
															FelipheGomez\Url::a('#level3_1', 'Nivel tres')
														], ['nav child_menu'])
											], ['nav child_menu'])
										], ['nav child_menu'])
								], ['nav side-menu'])
							, ['menu_section']);
							echo PHPStrap\Util\Html::tag('div', $menu_section_1.$menu_section_2.PHPStrap\Util\Html::clearfix(), ['main_menu_side hidden-print main_menu'], ['id' => 'sidebar-menu']);
						?>
						<!-- /sidebar menu -->
						<!-- /menu footer buttons -->
						<?= PHPStrap\Util\Html::tag('div', 
								PHPStrap\Util\Html::tag('a', PHPStrap\Util\Html::tag('span', "", ['glyphicon glyphicon-cog'], ['aria-hidden' => 'true']), [], [
									'data-toggle' => 'tooltip'
									, 'data-placement' => 'top'
									, 'title' => 'Configuraciones'
								])
								. PHPStrap\Util\Html::tag('a', PHPStrap\Util\Html::tag('span', "", ['glyphicon glyphicon-fullscreen'], ['aria-hidden' => 'true']), [], [
									'data-toggle' => 'tooltip'
									, 'data-placement' => 'top'
									, 'title' => 'Pantalla Completa'
								])
								. PHPStrap\Util\Html::tag('a', PHPStrap\Util\Html::tag('span', "", ['glyphicon glyphicon-eye-close'], ['aria-hidden' => 'true']), [], [
									'data-toggle' => 'tooltip'
									, 'data-placement' => 'top'
									, 'title' => 'Bloquear'
								])
								. PHPStrap\Util\Html::tag('a', PHPStrap\Util\Html::tag('span', "", ['glyphicon glyphicon-off'], ['aria-hidden' => 'true']), [], [
									'data-toggle' => 'tooltip'
									, 'data-placement' => 'top'
									, 'title' => 'Cerrar sesión'
									, 'href' => 'login.html'
								])
							, ["sidebar-footer hidden-small"]);
						?>
						<!-- /menu footer buttons -->
					</div>
				</div>
				<!-- top navigation -->
				<div class="top_nav">
					<div class="nav_menu">
						<?= PHPStrap\Util\Html::tag('nav', 
								$navbar = PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('a', PHPStrap\Util\Html::tag('i', '', ['fa fa-bars']), [], ['id' => 'menu_toggle']), ['nav toggle'])
								. PHPStrap\Util\Html::tag('ul', 
                                    PHPStrap\Util\Html::tag('li', 
                                        FelipheGomez\Url::a(
                                                'javascript:void(0)'
                                                , PHPStrap\Media::imageClean('/public/assets/images/img.jpg', '...') . 'Feliphe Gomez' . PHPStrap\Util\Html::tag('span', '', ["fa fa-angle-down"])
                                                , ['user-profile dropdown-toggle']
                                                , ['data-toggle' => 'dropdown', 'aria-expanded' => 'false']
                                            )
                                            . PHPStrap\Util\Html::ul([
                                                        FelipheGomez\Url::a('javascript:void(0)', "Perfil ")
                                                        , FelipheGomez\Url::a('javascript:void(0)', "Ayuda ")
                                                        , FelipheGomez\Url::a('javascript:void(0)', PHPStrap\Util\Html::tag('span', '50%', ["badge bg-red pull-right"]) . PHPStrap\Util\Html::tag('span', 'Configuraciones'))
                                                        , FelipheGomez\Url::a('javascript:void(0)', PHPStrap\Util\Html::tag('span', '', ["fa fa-sign-out pull-right"]) . "Salir ")
                                                    ]
                                                , ['dropdown-menu dropdown-usermenu pull-right']) 
                                    , [''])
                                    . PHPStrap\Util\Html::tag('li', 
                                        FelipheGomez\Url::a(
                                                'javascript:void(0)'
                                                , PHPStrap\Util\Html::tag('i', '', ['fa fa-envelope-o']) . PHPStrap\Util\Html::tag('span', '6', ['badge bg-green'])
                                                , ['dropdown-toggle info-number']
                                                , ['data-toggle' => 'dropdown', 'aria-expanded' => 'false']
                                            )
                                        . PHPStrap\Util\Html::tag('ul', 
                                                // Item
                                                PHPStrap\Util\Html::tag('li', 
                                                        PHPStrap\Util\Html::tag('a', 
                                                            PHPStrap\Util\Html::tag('span', PHPStrap\Media::imageClean('/public/assets/images/img.jpg', '...'), ['image'])
                                                            . PHPStrap\Util\Html::tag('span', 
                                                                    PHPStrap\Util\Html::tag('span', 'Feliphe Gomez')
                                                                    . PHPStrap\Util\Html::tag('span', '3 mins ago', ['time'])
                                                                )
                                                            . PHPStrap\Util\Html::tag('span', 'Film festivals used to be do-or-die moments for movie makers. They were where...', ['message'])
                                                            , [], [])
                                                    , [], [])
                                                . 
                                                // Footer
                                                PHPStrap\Util\Html::tag('li', 
                                                        PHPStrap\Util\Html::tag('div', 
                                                            PHPStrap\Util\Html::tag('a', 
                                                                    PHPStrap\Util\Html::tag('strong', 'Ver todas las alertas')
                                                                    . PHPStrap\Util\Html::tag('i', '', ['fa fa-angle-right'])
                                                                )
                                                            , ['text-center'], [])
                                                    , [], [])
                                            , ['dropdown-menu list-unstyled msg_list'], ['id' => 'menu1', 'role' => 'menu'])
                                    , ['dropdown'], ['role' => 'presentation'])
                                , ['nav navbar-nav navbar-right'])
							);
						?>
					</div>
				</div>
				<!-- /top navigation -->
				<!-- page content -->
				<div class="right_col" role="main">
					<div class="">
						<?php $this->getView($description); ?>
					</div>
				</div>
				<!-- /page content -->
				<!-- footer content -->
				<?= PHPStrap\Util\Html::tag('footer', PHPStrap\Util\Html::tag('div', ControladorBase::PowerBy(), ['pull-right']) . PHPStrap\Util\Html::clearfix(), []); ?>
				<!-- /footer content -->
			</div>
		</div>
		<?= $this->footerScripts(); ?>
	</body>
</html>
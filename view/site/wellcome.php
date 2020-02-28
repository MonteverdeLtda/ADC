
<div id="app-wellcome">
	<div>
		<div class="page-title">
			<div class="title_left">
				<h3><?= $title; ?></h3>
			</div>
			
			<!-- //
			<div class="title_right">
				<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search for...">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">Go!</button>
						</span>
					</div>
				</div>
			</div>
			-->
		</div>
		<div class="row">
			<router-view :key="$route.fullPath" ></router-view>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

<template id="wellcome">
	<div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="row">
				<div class="col-md-8 col-sm-8 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Bienvenid@</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="#">Settings 1</a></li>
										<li><a href="#">Settings 2</a></li>
									</ul>
								</li>
								<li><a class="close-link"><i class="fa fa-close"></i></a></li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							  <div class="bs-example" data-example-id="simple-jumbotron">
								<div class="jumbotron">
								  <h1>Hola!, <?= $this->user->username; ?>!</h1>
								  <p>Recuerda mantener tus datos actualizados.</p>
								</div>
							  </div>

						</div>
						<div class="x_content">
							<?php 
								# echo json_encode($this->user);
							?>
						</div>
					</div>
				</div>
				<?php 
				// Panel # 3 - Ajustes rápidos
				$PanelX_3 = new PHPStrap\PanelX();
				$PanelX_3->addStyle("tile fixed_height_320");
				$PanelX_3->addHeader("Ajustes rápidos");
				$PanelX_3->addButton(PHPStrap\Util\Html::tag('a', PHPStrap\Util\Html::tag('i', '', 'fa fa-chevron-up'), 'collapse-link'));
				$PanelX_3->addButton(
					PHPStrap\Util\Html::tag('a', 
						PHPStrap\Util\Html::tag('i', '', 'fa fa-wrench')
					, ['dropdown-toggle'], ['data-toggle' => 'dropdown', 'role' => 'button', 'aria-expanded' => 'false'])
					// dropdown-menu
					. PHPStrap\Util\Html::tag('ul', 
						PHPStrap\Util\Html::tag('li', FelipheGomez\Url::a('#', "Opcion 1"), ['dropdown'])
						. PHPStrap\Util\Html::tag('li', FelipheGomez\Url::a('#', "Opcion 2"), ['dropdown'])
					, ['dropdown-menu'], ['role' => 'menu'])
					. PHPStrap\Util\Html::clearfix()
				, ['dropdown']);
				$PanelX_3->addButton(PHPStrap\Util\Html::tag('a', PHPStrap\Util\Html::tag('i', '', 'fa fa-close'), 'close-link'));
				$PanelX_3->addContent(
					PHPStrap\Util\Html::tag('div', 
						PHPStrap\Util\Html::tag('ul', 
							PHPStrap\Util\Html::tag('li', PHPStrap\Util\Html::tag('i', '', ['fa fa-user'], []) . PHPStrap\Util\Html::tag('a', 'Mi perfil', [], [ 'href' => '/Me' ]) , [], [])
							# . PHPStrap\Util\Html::tag('li', PHPStrap\Util\Html::tag('i', '', ['fa fa-bars'], []) . PHPStrap\Util\Html::tag('a', 'Subscription', [], [ 'href' => '#' ]) , [], [])			
							# . PHPStrap\Util\Html::tag('li', PHPStrap\Util\Html::tag('i', '', ['fa fa-bar-chart'], []) . PHPStrap\Util\Html::tag('a', 'Auto Renewal', [], [ 'href' => '#' ]) , [], [])			
							# . PHPStrap\Util\Html::tag('li', PHPStrap\Util\Html::tag('i', '', ['fa fa-line-chart'], []) . PHPStrap\Util\Html::tag('a', 'Achievements', [], [ 'href' => '#' ]) , [], [])		
							. PHPStrap\Util\Html::tag('li', PHPStrap\Util\Html::tag('i', '', ['fa fa-sign-out'], []) . PHPStrap\Util\Html::tag('a', 'Salir', [], [ 'href' => '/index.php?controller=site&action=logout' ]) , [], [])		
						, ['quick-list'], [])
						. PHPStrap\Util\Html::tag('div', 
							PHPStrap\Util\Html::tag('h4', 'Perfil completado', [], [])
							. PHPStrap\Util\Html::tag('canvas', '', [], ['width' => '150', 'height' => '80', 'id' => 'chart_gauge_01', 'style' => 'width: 160px; height: 100px;'])
							. PHPStrap\Util\Html::tag('div', 
								PHPStrap\Util\Html::tag('span', '0', ['gauge-value pull-left'], ['id' => 'gauge-text'])
								. PHPStrap\Util\Html::tag('span', '%', ['gauge-value pull-left'], [])
								. PHPStrap\Util\Html::tag('span', '100%', ['goal-value pull-right'], ['id' => 'goal-text'])
							, ['goal-wrapper'], [])
						, ['sidebar-widget'], [])
					, ['dashboard-widget-content'], [])
				);
				echo PHPStrap\Util\Html::tag('div', 
					# PHPStrap\Util\Html::tag('div', $PanelX_1 , ['col-md-4 col-sm-4 col-xs-12'], [])
					# . PHPStrap\Util\Html::tag('div', $PanelX_2 , ['col-md-4 col-sm-4 col-xs-12'], [])
					PHPStrap\Util\Html::tag('div', $PanelX_3 , ['col-md-4 col-sm-4 col-xs-12'], [])
				, ['row'], []);
				?>				
			</div>
		</div>
	</div>
</template>


<script>
var Wellcome = Vue.extend({
	template: '#wellcome',
	data(){
		return {
		};
	},
	created: function () {},
	mounted: function () {
		var self = this;
		console.log('load');
	},
	methods: {
		
	}
});

var router = new VueRouter({
	linkActiveClass: 'active',
	routes:[
		{ path: '/', component: Wellcome, name: 'Wellcome' },
	]
});

app = new Vue({
	router: router,
	data: function () {
		return {};
	},
	methods: {
	}
}).$mount('#app-wellcome');
</script>
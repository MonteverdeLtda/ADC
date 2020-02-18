<!-- top tiles -->
<?= 
    PHPStrap\Util\Html::tag('div', 
        // Usuarios
        PHPStrap\Util\Html::tag('div', 
            PHPStrap\Util\Html::tag('span', PHPStrap\Util\Html::tag('i', '', ['fa fa-user'], []) . 'Usuarios totales', ['count_top'], [])
            . PHPStrap\Util\Html::tag('div', '2500', ['count'], [])
            . PHPStrap\Util\Html::tag('span', PHPStrap\Util\Html::tag('i', '4%', ['green'], []) . 'Desde la semana pasada', ['count_bottom'], [])
        , ['col-md-2 col-sm-4 col-xs-6 tile_stats_count'], [])
        . // Tiempo promedio
        PHPStrap\Util\Html::tag('div', 
            PHPStrap\Util\Html::tag('span', PHPStrap\Util\Html::tag('i', '', ['fa fa-clock-o'], []) . 'Usuarios totales', ['count_top'], [])
            . PHPStrap\Util\Html::tag('div', '123.50', ['count'], [])
            . PHPStrap\Util\Html::tag('span', PHPStrap\Util\Html::tag('i', '4%', ['green'], []) . 'Desde la semana pasada', ['count_bottom'], [])
        , ['col-md-2 col-sm-4 col-xs-6 tile_stats_count'], [])
        . // Total Cuentas
        PHPStrap\Util\Html::tag('div', 
            PHPStrap\Util\Html::tag('span', PHPStrap\Util\Html::tag('i', '', ['fa fa-user'], []) . 'Total Cuentas', ['count_top'], [])
            . PHPStrap\Util\Html::tag('div', '4,567', ['count'], [])
            . PHPStrap\Util\Html::tag('span', PHPStrap\Util\Html::tag('i', '4%', ['green'], []) . 'Desde la semana pasada', ['count_bottom'], [])
        , ['col-md-2 col-sm-4 col-xs-6 tile_stats_count'], [])
        . // Total Solicitudes
        PHPStrap\Util\Html::tag('div', 
            PHPStrap\Util\Html::tag('span', PHPStrap\Util\Html::tag('i', '', ['fa fa-clock-o'], []) . 'Total Solicitudes', ['count_top'], [])
            . PHPStrap\Util\Html::tag('div', '2,315', ['count'], [])
            . PHPStrap\Util\Html::tag('span', PHPStrap\Util\Html::tag('i', '4%', ['green'], []) . 'Desde la semana pasada', ['count_bottom'], [])
        , ['col-md-2 col-sm-4 col-xs-6 tile_stats_count'], [])
        . // Total Conexiones
        PHPStrap\Util\Html::tag('div', 
            PHPStrap\Util\Html::tag('span', PHPStrap\Util\Html::tag('i', '', ['fa fa-user'], []) . 'Total Conexiones', ['count_top'], [])
            . PHPStrap\Util\Html::tag('div', '7,325', ['count'], [])
            . PHPStrap\Util\Html::tag('span', PHPStrap\Util\Html::tag('i', '4%', ['green'], []) . 'Desde la semana pasada', ['count_bottom'], [])
        , ['col-md-2 col-sm-4 col-xs-6 tile_stats_count'], [])
    , ['row tile_count'], []);
?>
<!-- /top tiles -->
<?= 
    PHPStrap\Util\Html::tag('div', 
        PHPStrap\Util\Html::tag('div', 
            PHPStrap\Util\Html::tag('div', 
                PHPStrap\Util\Html::tag('div', 
                    PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('h3', 'Actividades de red ' . PHPStrap\Util\Html::tag('small', 'Título del gráfico subtítulo')), ['col-md-6'])
                    . PHPStrap\Util\Html::tag('div', 
                        PHPStrap\Util\Html::tag('div', 
                            PHPStrap\Util\Html::tag('i', '', ['glyphicon glyphicon-calendar fa fa-calendar'])
                            . PHPStrap\Util\Html::tag('span', 'December 30, 2014 - January 28, 2015')
                            . PHPStrap\Util\Html::tag('b', '', ['caret'])
                        , ['pull-right'], ['id' => 'reportrange', 'style' => 'background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc'])
                    , ['col-md-6'])
                , ['row x_title'], [])
                . PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('div', '', ['demo-placeholder'], ['id' => 'chart_plot_01']), ['col-md-9 col-sm-9 col-xs-12'], [])
                . PHPStrap\Util\Html::tag('div', 
                    PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('h2', 'Rendimiento campañas') . PHPStrap\Util\Html::clearfix(), ['x_title'])
                    . PHPStrap\Util\Html::tag('div', 
                        // Campaña de Facebook
                        PHPStrap\Util\Html::tag('div', 
                            PHPStrap\Util\Html::tag('p', 'Campaña de Facebook')
                            . PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('div', '', ['progress-bar bg-green'], ['role' => 'progressbar', 'data-transitiongoal' => '76']), ['progress progress_sm'], ['style' => 'width: 100%;']))
                        )
                        . // Campaña de Twitter
                        PHPStrap\Util\Html::tag('div', 
                            PHPStrap\Util\Html::tag('p', 'Campaña de Twitter')
                            . PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('div', '', ['progress-bar bg-green'], ['role' => 'progressbar', 'data-transitiongoal' => '60']), ['progress progress_sm'], ['style' => 'width: 100%;']))
                        )
                        . // Medios convencionales
                        PHPStrap\Util\Html::tag('div', 
                            PHPStrap\Util\Html::tag('p', 'Medios convencionales')
                            . PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('div', '', ['progress-bar bg-green'], ['role' => 'progressbar', 'data-transitiongoal' => '40']), ['progress progress_sm'], ['style' => 'width: 100%;']))
                        )
                        . // Vallas publicitarias
                        PHPStrap\Util\Html::tag('div', 
                            PHPStrap\Util\Html::tag('p', 'Vallas publicitarias')
                            . PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('div', '', ['progress-bar bg-green'], ['role' => 'progressbar', 'data-transitiongoal' => '50']), ['progress progress_sm'], ['style' => 'width: 100%;']))
                        )
                    , ['col-md-12 col-sm-12 col-xs-6'])
                    . PHPStrap\Util\Html::clearfix()
                , ['col-md-3 col-sm-3 col-xs-12 bg-white'], [])
                . PHPStrap\Util\Html::clearfix()
            , ['dashboard_graph'], [])
        , ['col-md-12 col-sm-12 col-xs-12'], [])
    , ['row'], [])." <br />"
?>
<?php 
// Panel # 1 - Uso de la aplicación
$PanelX_1 = new PHPStrap\PanelX();
$PanelX_1->addStyle("tile fixed_height_320");
$PanelX_1->addHeader("Uso de la aplicación");
$PanelX_1->addButton(PHPStrap\Util\Html::tag('a', PHPStrap\Util\Html::tag('i', '', 'fa fa-chevron-up'), 'collapse-link'));
$PanelX_1->addButton(
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
$PanelX_1->addButton(PHPStrap\Util\Html::tag('a', PHPStrap\Util\Html::tag('i', '', 'fa fa-close'), 'close-link'));
$PanelX_1->addContent(
    PHPStrap\Util\Html::tag('h4', 'Todas las versiones', [], [])
    . PHPStrap\Util\Html::tag('div', 
        PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('span', '0.1.5.2'), ['w_left w_25'], [])
        . PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('div', 
            PHPStrap\Util\Html::tag('div', 
                PHPStrap\Util\Html::tag('span', '60% completo', ['sr-only'], []), ['progress-bar bg-green'], ['role' => 'progressbar', 'aria-valuenow' => '60', 'aria-valuemin' => '0', 'aria-valuemax' => '100', 'style' => 'width: 66%;'])
        , ['progress']), ['w_center w_55'], [])
        . PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('span', '123k'), ['w_right w_20'], [])
    , ['widget_summary'], [])
    // Sumary # 2
    . PHPStrap\Util\Html::tag('div', 
        PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('span', '0.1.5.3'), ['w_left w_25'], [])
        . PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('div', 
            PHPStrap\Util\Html::tag('div', 
                PHPStrap\Util\Html::tag('span', '60% completo', ['sr-only'], []), ['progress-bar bg-green'], ['role' => 'progressbar', 'aria-valuenow' => '60', 'aria-valuemin' => '0', 'aria-valuemax' => '100', 'style' => 'width: 45%;'])
        , ['progress']), ['w_center w_55'], [])
        . PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('span', '53k'), ['w_right w_20'], [])
    , ['widget_summary'], [])
    // # 3
    . PHPStrap\Util\Html::tag('div', 
        PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('span', '0.1.5.4'), ['w_left w_25'], [])
        . PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('div', 
            PHPStrap\Util\Html::tag('div', 
                PHPStrap\Util\Html::tag('span', '60% completo', ['sr-only'], []), ['progress-bar bg-green'], ['role' => 'progressbar', 'aria-valuenow' => '60', 'aria-valuemin' => '0', 'aria-valuemax' => '100', 'style' => 'width: 25%;'])
        , ['progress']), ['w_center w_55'], [])
        . PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('span', '23k'), ['w_right w_20'], [])
    , ['widget_summary'], [])
    // # 4
    . PHPStrap\Util\Html::tag('div', 
        PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('span', '0.1.5.5'), ['w_left w_25'], [])
        . PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('div', 
            PHPStrap\Util\Html::tag('div', 
                PHPStrap\Util\Html::tag('span', '60% completo', ['sr-only'], []), ['progress-bar bg-green'], ['role' => 'progressbar', 'aria-valuenow' => '60', 'aria-valuemin' => '0', 'aria-valuemax' => '100', 'style' => 'width: 5%;'])
        , ['progress']), ['w_center w_55'], [])
        . PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('span', '3k'), ['w_right w_20'], [])
    , ['widget_summary'], [])
    // # 5
    . PHPStrap\Util\Html::tag('div', 
        PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('span', '0.1.5.6'), ['w_left w_25'], [])
        . PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('div', 
            PHPStrap\Util\Html::tag('div', 
                PHPStrap\Util\Html::tag('span', '60% completo', ['sr-only'], []), ['progress-bar bg-green'], ['role' => 'progressbar', 'aria-valuenow' => '60', 'aria-valuemin' => '0', 'aria-valuemax' => '100', 'style' => 'width: 2%;'])
        , ['progress']), ['w_center w_55'], [])
        . PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('span', '1k'), ['w_right w_20'], [])
    , ['widget_summary'], [])
);

// Panel # 2 - Uso en dispositivos
$PanelX_2 = new PHPStrap\PanelX();
$PanelX_2->addStyle("tile fixed_height_320 overflow_hidden");
$PanelX_2->addHeader("Uso en dispositivos");
$PanelX_2->addButton(PHPStrap\Util\Html::tag('a', PHPStrap\Util\Html::tag('i', '', 'fa fa-chevron-up'), 'collapse-link'));
$PanelX_2->addButton(
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
$PanelX_2->addButton(PHPStrap\Util\Html::tag('a', PHPStrap\Util\Html::tag('i', '', 'fa fa-close'), 'close-link'));
$PanelX_2->addContent(
    PHPStrap\Table::basicTable(
        [
            [
                "", PHPStrap\Util\Html::tag('p', 'Top 5')
            ],
            [
                PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('p', 'Device', [], []), ['col-lg-7 col-md-7 col-sm-7 col-xs-7'])
                , PHPStrap\Util\Html::tag('div', PHPStrap\Util\Html::tag('p', 'Progress', [], []), ['col-lg-5 col-md-5 col-sm-5 col-xs-5'])
            ]
            , [
                PHPStrap\Util\Html::tag('canvas', '', ['canvasDoughnut'], ['style' => 'margin: 15px 10px 10px 0', 'width' => '140', 'height' => '140'])
                , PHPStrap\Table::basicTable(
                    [
                        [ PHPStrap\Util\Html::tag('p', PHPStrap\Util\Html::tag('i', '', ['fa fa-square blue']) . 'IOS'), "30%" ]
                        , [ PHPStrap\Util\Html::tag('p', PHPStrap\Util\Html::tag('i', '', ['fa fa-square green']) . 'Android'), "10%" ]
                        , [ PHPStrap\Util\Html::tag('p', PHPStrap\Util\Html::tag('i', '', ['fa fa-square purple']) . 'Blackberry'), "20%" ]
                        , [ PHPStrap\Util\Html::tag('p', PHPStrap\Util\Html::tag('i', '', ['fa fa-square aero']) . 'Symbian'), "15%" ]
                        , [ PHPStrap\Util\Html::tag('p', PHPStrap\Util\Html::tag('i', '', ['fa fa-square red']) . 'Otros'), "30%" ]
                    ]
                , 0, 0, ['tile_info'], [])
            ]
        ]
    , 1, 0, [], ['style' => 'width:100%'])
);

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
			PHPStrap\Util\Html::tag('li', PHPStrap\Util\Html::tag('i', '', ['fa fa-calendar-o'], []) . PHPStrap\Util\Html::tag('a', 'Settings', [], [ 'href' => '#' ]) , [], [])
			. PHPStrap\Util\Html::tag('li', PHPStrap\Util\Html::tag('i', '', ['fa fa-bars'], []) . PHPStrap\Util\Html::tag('a', 'Subscription', [], [ 'href' => '#' ]) , [], [])			
			. PHPStrap\Util\Html::tag('li', PHPStrap\Util\Html::tag('i', '', ['fa fa-bar-chart'], []) . PHPStrap\Util\Html::tag('a', 'Auto Renewal', [], [ 'href' => '#' ]) , [], [])			
			. PHPStrap\Util\Html::tag('li', PHPStrap\Util\Html::tag('i', '', ['fa fa-line-chart'], []) . PHPStrap\Util\Html::tag('a', 'Achievements', [], [ 'href' => '#' ]) , [], [])		
			. PHPStrap\Util\Html::tag('li', PHPStrap\Util\Html::tag('i', '', ['fa fa-area-chart'], []) . PHPStrap\Util\Html::tag('a', 'Logout', [], [ 'href' => '#' ]) , [], [])		
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
    PHPStrap\Util\Html::tag('div', $PanelX_1 , ['col-md-4 col-sm-4 col-xs-12'], [])
    . PHPStrap\Util\Html::tag('div', $PanelX_2 , ['col-md-4 col-sm-4 col-xs-12'], [])
    . PHPStrap\Util\Html::tag('div', $PanelX_3 , ['col-md-4 col-sm-4 col-xs-12'], [])
, ['row'], []);


// Panel # 4 - Actividades recientes
$PanelX_4 = new PHPStrap\PanelX();
$PanelX_4->addHeader("Actividades recientes " . PHPStrap\Util\Html::tag('small', 'Sesiones', [], []));
$PanelX_4->addButton(PHPStrap\Util\Html::tag('a', PHPStrap\Util\Html::tag('i', '', 'fa fa-chevron-up'), 'collapse-link'));
$PanelX_4->addButton(
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
$PanelX_4->addButton(PHPStrap\Util\Html::tag('a', PHPStrap\Util\Html::tag('i', '', 'fa fa-close'), 'close-link'));
$PanelX_4->addContent(
	PHPStrap\Util\Html::tag('div', 
		PHPStrap\Util\Html::tag('ul', 
			PHPStrap\Util\Html::tag('li', 
				PHPStrap\Util\Html::tag('div', 
					PHPStrap\Util\Html::tag('div', 
						PHPStrap\Util\Html::tag('h2', PHPStrap\Util\Html::tag('a', '¿Quién necesita vTiger cuando tienes C&CMS?', [], []), ['title'], [])
						. PHPStrap\Util\Html::tag('div', 
							PHPStrap\Util\Html::tag('span', 'Hace 17 Horas ', [], []) . "por " . PHPStrap\Util\Html::tag('a', 'Feliphe Gomez', [], [])
						, ['byline'], [])
						. PHPStrap\Util\Html::tag('p', 
							"Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and…"
							. PHPStrap\Util\Html::tag('a', 'Leer Más', [], [])
						, ['excerpt'], [])
					, ['block_content'], [])
				, ['block'], [])
			, [], [])
			
			. PHPStrap\Util\Html::tag('li', 
				PHPStrap\Util\Html::tag('div', 
					PHPStrap\Util\Html::tag('div', 
						PHPStrap\Util\Html::tag('h2', PHPStrap\Util\Html::tag('a', '¿Quién necesita vTiger cuando tienes C&CMS?', [], []), ['title'], [])
						. PHPStrap\Util\Html::tag('div', 
							PHPStrap\Util\Html::tag('span', 'Hace 17 Horas ', [], []) . "por " . PHPStrap\Util\Html::tag('a', 'Feliphe Gomez', [], [])
						, ['byline'], [])
						. PHPStrap\Util\Html::tag('p', 
							"Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and…"
							. PHPStrap\Util\Html::tag('a', 'Leer Más', [], [])
						, ['excerpt'], [])
					, ['block_content'], [])
				, ['block'], [])
			, [], [])
			
			. PHPStrap\Util\Html::tag('li', 
				PHPStrap\Util\Html::tag('div', 
					PHPStrap\Util\Html::tag('div', 
						PHPStrap\Util\Html::tag('h2', PHPStrap\Util\Html::tag('a', '¿Quién necesita vTiger cuando tienes C&CMS?', [], []), ['title'], [])
						. PHPStrap\Util\Html::tag('div', 
							PHPStrap\Util\Html::tag('span', 'Hace 17 Horas ', [], []) . "por " . PHPStrap\Util\Html::tag('a', 'Feliphe Gomez', [], [])
						, ['byline'], [])
						. PHPStrap\Util\Html::tag('p', 
							"Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and…"
							. PHPStrap\Util\Html::tag('a', 'Leer Más', [], [])
						, ['excerpt'], [])
					, ['block_content'], [])
				, ['block'], [])
			, [], [])
			
			. PHPStrap\Util\Html::tag('li', 
				PHPStrap\Util\Html::tag('div', 
					PHPStrap\Util\Html::tag('div', 
						PHPStrap\Util\Html::tag('h2', PHPStrap\Util\Html::tag('a', '¿Quién necesita vTiger cuando tienes C&CMS?', [], []), ['title'], [])
						. PHPStrap\Util\Html::tag('div', 
							PHPStrap\Util\Html::tag('span', 'Hace 17 Horas ', [], []) . "por " . PHPStrap\Util\Html::tag('a', 'Feliphe Gomez', [], [])
						, ['byline'], [])
						. PHPStrap\Util\Html::tag('p', 
							"Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and…"
							. PHPStrap\Util\Html::tag('a', 'Leer Más', [], [])
						, ['excerpt'], [])
					, ['block_content'], [])
				, ['block'], [])
			, [], [])
		, ['list-unstyled timeline widget'], [])
	, ['dashboard-widget-content'], [])
);


// Panel # 5 - Ubicación de los visitantes
$PanelX_5 = new PHPStrap\PanelX();
$PanelX_5->addHeader("Ubicación de los visitantes " . PHPStrap\Util\Html::tag('small', 'GEO presentación', [], []));
$PanelX_5->addButton(PHPStrap\Util\Html::tag('a', PHPStrap\Util\Html::tag('i', '', 'fa fa-chevron-up'), 'collapse-link'));
$PanelX_5->addButton(
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
$PanelX_5->addButton(PHPStrap\Util\Html::tag('a', PHPStrap\Util\Html::tag('i', '', 'fa fa-close'), 'close-link'));
$PanelX_5->addContent(
	PHPStrap\Util\Html::tag('div', 
		PHPStrap\Util\Html::tag('div', 
			PHPStrap\Util\Html::tag('h2', '125.7k vistas de 60 países', ['line_30'], [])
			. PHPStrap\Table::basicTable(
				[
					[ 'United States', "33%" ]
					, [ 'France', "27%" ]
					, [ 'Germany', "16%" ]
					, [ 'Spain', "11%" ]
					, [ 'Britain', "10%" ]
				]
			, 1, 0, ['countries_list'], [])
		, ['col-md-4 hidden-small'], [])
		. PHPStrap\Util\Html::tag('div', '', ['col-md-8 col-sm-12 col-xs-12'], ['id' => 'world-map-gdp', 'style' => 'height:230px;'])
	, ['dashboard-widget-content'], [])
);

// Panel # 6 - Ubicación de los visitantes
$PanelX_6 = new PHPStrap\PanelX();
$PanelX_6->addHeader("Ubicación de los visitantes " . PHPStrap\Util\Html::tag('small', 'GEO presentación', [], []));
$PanelX_6->addButton(PHPStrap\Util\Html::tag('a', PHPStrap\Util\Html::tag('i', '', 'fa fa-chevron-up'), 'collapse-link'));
$PanelX_6->addButton(
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
$PanelX_6->addButton(PHPStrap\Util\Html::tag('a', PHPStrap\Util\Html::tag('i', '', 'fa fa-close'), 'close-link'));
$PanelX_6->addContent(
	PHPStrap\Util\Html::tag('div', 
		PHPStrap\Util\Html::tag('ul', 
			PHPStrap\Util\Html::tag('li', PHPStrap\Util\Html::tag('p', PHPStrap\Util\Html::tag('input', '', ['flat'], ['type' => 'checkbox']) . 'Programar reunión con nuevo cliente', [], []), ['line_30'], [])
			. PHPStrap\Util\Html::tag('li', PHPStrap\Util\Html::tag('p', PHPStrap\Util\Html::tag('input', '', ['flat'], ['type' => 'checkbox']) . 'Crear dirección de correo electrónico para nuevo pasante', [], []), ['line_30'], [])
			. PHPStrap\Util\Html::tag('li', PHPStrap\Util\Html::tag('p', PHPStrap\Util\Html::tag('input', '', ['flat'], ['type' => 'checkbox']) . 'Haga que repare la impresora de red', [], []), ['line_30'], [])
			. PHPStrap\Util\Html::tag('li', PHPStrap\Util\Html::tag('p', PHPStrap\Util\Html::tag('input', '', ['flat'], ['type' => 'checkbox']) . 'Copie las copias de seguridad en una ubicación externa', [], []), ['line_30'], [])
			. PHPStrap\Util\Html::tag('li', PHPStrap\Util\Html::tag('p', PHPStrap\Util\Html::tag('input', '', ['flat'], ['type' => 'checkbox']) . 'Camión de comida', [], []), ['line_30'], [])
		, ['to_do'], [])
	, [''], [])
);

// Panel # 7 - Widget del tiempo
$PanelX_7 = new PHPStrap\PanelX();
$PanelX_7->addHeader("Widget del tiempo ");
$PanelX_7->addButton(PHPStrap\Util\Html::tag('a', PHPStrap\Util\Html::tag('i', '', 'fa fa-chevron-up'), 'collapse-link'));
$PanelX_7->addButton(
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
$PanelX_7->addButton(PHPStrap\Util\Html::tag('a', PHPStrap\Util\Html::tag('i', '', 'fa fa-close'), 'close-link'));
$PanelX_7->addContent(
	PHPStrap\Util\Html::tag('div', 
		PHPStrap\Util\Html::tag('div', 
			PHPStrap\Util\Html::tag('div', 
				PHPStrap\Util\Html::tag('b', 'Lunes', [], []) . ', 07:30 AM'
				. PHPStrap\Util\Html::tag('span', ' F', [], [])
				. PHPStrap\Util\Html::tag('span', PHPStrap\Util\Html::tag('b', ' C'))
			, ['temperature'], [])
		, ['col-sm-12'], [])
	, ['row'], [])
	. PHPStrap\Util\Html::tag('div', 
		PHPStrap\Util\Html::tag('div', 
			PHPStrap\Util\Html::tag('div', 
				PHPStrap\Util\Html::tag('canvas', '', [], ['id' => 'partly-cloudy-day', 'height' => '84', 'width' => '84'])
			, ['weather-icon'], [])
		, ['col-sm-4'], [])
		. PHPStrap\Util\Html::tag('div', 
			PHPStrap\Util\Html::tag('div', 
				PHPStrap\Util\Html::tag('h2', 'Texas <br> ' . PHPStrap\Util\Html::tag('i', 'Partly Cloudy Day', [], []), [], [])
			, ['weather-text'], [])
		, ['col-sm-8'], [])
		. PHPStrap\Util\Html::tag('div', 
			PHPStrap\Util\Html::tag('div', 
				PHPStrap\Util\Html::tag('h3', '23', ['degrees'], [])
			, ['weather-text pull-right'], [])
		, ['col-sm-12'], [])
		. PHPStrap\Util\Html::clearfix()
	, ['row'], [])
	. PHPStrap\Util\Html::tag('div', 
		// Lunes
		PHPStrap\Util\Html::tag('div', 
			PHPStrap\Util\Html::tag('div', 
				PHPStrap\Util\Html::tag('h2', 'Lunes', ['day'], [])
				. PHPStrap\Util\Html::tag('h3', '25', ['degrees'], [])
				. PHPStrap\Util\Html::tag('canvas', '', ['degrees'], ['id' => 'clear-day', 'height' => '32', 'width' => '32'])
				. PHPStrap\Util\Html::tag('h5', '15' . PHPStrap\Util\Html::tag('i', 'km/h', [], []), [], [])
			, ['daily-weather'], [])
		, ['col-sm-2'], [])
		// Martes
		. PHPStrap\Util\Html::tag('div', 
			PHPStrap\Util\Html::tag('div', 
				PHPStrap\Util\Html::tag('h2', 'Martes', ['day'], [])
				. PHPStrap\Util\Html::tag('h3', '26', ['degrees'], [])
				. PHPStrap\Util\Html::tag('canvas', '', ['degrees'], ['id' => 'rain', 'height' => '32', 'width' => '32'])
				. PHPStrap\Util\Html::tag('h5', '12' . PHPStrap\Util\Html::tag('i', 'km/h', [], []), [], [])
			, ['daily-weather'], [])
		, ['col-sm-2'], [])
		// Miercoles
		. PHPStrap\Util\Html::tag('div', 
			PHPStrap\Util\Html::tag('div', 
				PHPStrap\Util\Html::tag('h2', 'Miercoles', ['day'], [])
				. PHPStrap\Util\Html::tag('h3', '27', ['degrees'], [])
				. PHPStrap\Util\Html::tag('canvas', '', ['degrees'], ['id' => 'snow', 'height' => '32', 'width' => '32'])
				. PHPStrap\Util\Html::tag('h5', '14' . PHPStrap\Util\Html::tag('i', 'km/h', [], []), [], [])
			, ['daily-weather'], [])
		, ['col-sm-2'], [])
		// Jueves
		. PHPStrap\Util\Html::tag('div', 
			PHPStrap\Util\Html::tag('div', 
				PHPStrap\Util\Html::tag('h2', 'Jueves', ['day'], [])
				. PHPStrap\Util\Html::tag('h3', '28', ['degrees'], [])
				. PHPStrap\Util\Html::tag('canvas', '', ['degrees'], ['id' => 'sleet', 'height' => '32', 'width' => '32'])
				. PHPStrap\Util\Html::tag('h5', '15' . PHPStrap\Util\Html::tag('i', 'km/h', [], []), [], [])
			, ['daily-weather'], [])
		, ['col-sm-2'], [])
		// Viernes
		. PHPStrap\Util\Html::tag('div', 
			PHPStrap\Util\Html::tag('div', 
				PHPStrap\Util\Html::tag('h2', 'Viernes', ['day'], [])
				. PHPStrap\Util\Html::tag('h3', '29', ['degrees'], [])
				. PHPStrap\Util\Html::tag('canvas', '', ['degrees'], ['id' => 'wind', 'height' => '32', 'width' => '32'])
				. PHPStrap\Util\Html::tag('h5', '11' . PHPStrap\Util\Html::tag('i', 'km/h', [], []), [], [])
			, ['daily-weather'], [])
		, ['col-sm-2'], [])
		// Sabado
		. PHPStrap\Util\Html::tag('div', 
			PHPStrap\Util\Html::tag('div', 
				PHPStrap\Util\Html::tag('h2', 'Lunes', ['day'], [])
				. PHPStrap\Util\Html::tag('h3', '30', ['degrees'], [])
				. PHPStrap\Util\Html::tag('canvas', '', ['degrees'], ['id' => 'cloudy', 'height' => '32', 'width' => '32'])
				. PHPStrap\Util\Html::tag('h5', '10' . PHPStrap\Util\Html::tag('i', 'km/h', [], []), [], [])
			, ['daily-weather'], [])
		, ['col-sm-2'], [])
		. PHPStrap\Util\Html::clearfix()
	, ['row weather-days'], [])
);

echo PHPStrap\Util\Html::tag('div', 
    PHPStrap\Util\Html::tag('div', $PanelX_4 , ['col-md-4 col-sm-4 col-xs-12'], [])
    . PHPStrap\Util\Html::tag('div', 
		$PanelX_5 
		. PHPStrap\Util\Html::tag('div', $PanelX_6 , ['col-md-6 col-sm-6 col-xs-12'], [])
		. PHPStrap\Util\Html::tag('div', $PanelX_7 , ['col-md-6 col-sm-6 col-xs-12'], [])
	, ['col-md-8 col-sm-8 col-xs-12'], [])
, ['row'], []);

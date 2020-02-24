<style>
.modal {
	overflow: auto;
}
.bootbox-input-textarea {
	min-height: 170px;
}

.tag-purple { background: #673ab7; }
.tag-purple:after { border-left: 11px solid #673ab7; }

.tag-danger { background: #a94442; }
.tag-danger:after { border-left: 11px solid #a94442; }

.tag-success { background: #6ba74c; }
.tag-success:after { border-left: 11px solid #6ba74c; }

.tag-primary { background: #337ab7; }
.tag-primary:after { border-left: 11px solid #337ab7; }

.tag-default { background: #999; }
.tag-default:after { border-left: 11px solid #999; }

.hide-bullets {
    list-style:none;
    margin-left: -40px;
    margin-top:20px;
}

.thumbnail {
    padding: 0;
}

.carousel-inner>.item>img, .carousel-inner>.item>a>img {
    width: 100%;
}

table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
	background-color: #6ba74c;
}
.item-gallery {
	height: 150px;
}
.prod_color li {
	    margin: 0px 0px;
}
</style>

<div id="me-executed-reports-dashboard">
	<div class="page-title">
		<div class="title_left">
			<h3><?= $title; ?></h3>
		</div>
	</div>
	<div class="clearfix"></div>
	
	<div >
		<div class="row ">
			<div class="col-md-12">
				<div id="reportrange-date" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
					<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
					<span>Diciembre 30, 2015 - Enero 28, 2015</span> <b class="caret"></b>
				</div><br>
				<div class="clearfix"><br></div>
			</div>
		</div>

		<div class="row">
			<router-view :key="$route.fullPath" ></router-view>
		</div>
	</div>

</div>

<template id="home">
	<div>
		<div class="row top_tiles">
			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="tile-stats" style="zoom:0.8;">
					<div class="icon"><i class="fa fa-calendar"></i></div>
					<div class="count">{{ totals.area_m2.schedule.toLocaleString() }}</div>
					<h3>Programado</h3>
					<p>La sumatoria se origina por un total de {{ totals.microroutes.schedule }} microrutas.</p>
				</div>
			</div>
			<div class="animated flipInX col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="tile-stats" style="zoom:0.8;">
					<div class="icon"><i class="fa fa-check-square-o"></i></div>
					<div class="count">{{ totals.area_m2.executed.toLocaleString() }}</div>
					<h3>Ejecutado</h3>
					<p>La sumatoria se origina por un total de {{ totals.microroutes.executed }} microrutas.</p>
				</div>
			</div>
			<div class="animated flipInX col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="tile-stats" style="zoom:0.8;">
					<div class="icon"><i class="fa fa-clock-o"></i></div>
					<div class="count">{{ (totals.area_m2.schedule - (totals.area_m2.novelty + totals.area_m2.executed)).toLocaleString() }}</div>
					<h3>Pendiente</h3>
					<p>La sumatoria se origina por un total de {{ (totals.microroutes.schedule - (totals.microroutes.novelty + totals.microroutes.executed)) }} microrutas.</p>
				</div>
			</div>
			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="tile-stats" style="zoom:0.8;">
					<div class="icon"><i class="fa fa-share"></i></div>
					<div class="count">{{ totals.area_m2.novelty.toLocaleString() }}</div>
					<h3>Pospuesto</h3>
					<p>La sumatoria se origina por un total de {{ totals.microroutes.novelty }} microrutas.</p>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-8 col-sm-12 col-xs-12">
				<div class="dashboard_graph x_panel">
					<div class="x_content">
						<div class="demo-container" >
							<div id="chart_plot_principal" class="demo-placeholder"></div>
						</div>
					</div>
					<div class="x_content">
						<div class="demo-container" >
							<div id="chart_plot_secondary" class="demo-placeholder"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-4 col-sm-12 col-xs-12">
				<div class="x_panel" style="height: 595px;overflow: auto;">
					<div class="x_content">
						<!-- // {{ datas.xDays }} -->
						<!-- start accordion -->
						<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
						  <div class="panel" v-for="(item,item_i) in datas.xDays" v-if="item.microroutes !== undefined && item.microroutes.totals.count > 0">
							<a class="panel-heading" role="tab" id="'headingOne-' + item.label" data-toggle="collapse" data-parent="#accordion" :href="'#collapseOne-' + item.label" aria-expanded="false" :aria-controls="'collapseOne-' + item.label">
							  <h4 class="panel-title">{{ item.label }} | Resumen de ejecucion</h4>
							</a>
							<div :id="'collapseOne-' + item.label" class="panel-collapse collapse " role="tabpanel" :aria-labelledby="'headingOne-' + item.label">
							  <div class="panel-body">
								<div class="row">
									<div class="col-xs-12">
										<p class="lead">Resumen rápido</p>
										<div class="table-responsive">
											<table class="table">
												<tbody>
													<tr>
														<th style="width:50%">T. Prog.</th>
														<td>{{ item.schedule.totals.count }}</td>
														<td>{{ item.schedule.totals.area_m2.toLocaleString() }} m2</td>
													</tr>
													<tr>
														<th>T. Ejec.</th>
														<td>{{ item.executed.totals.count }}</td>
														<td>{{ item.executed.totals.area_m2.toLocaleString() }} m2</td>
													</tr>
													<tr>
														<th>T. Posp:</th>
														<td>{{ item.novelty.totals.count }}</td>
														<td>{{ item.novelty.totals.area_m2.toLocaleString() }} m2</td>
													</tr>
													<tr>
														<th>T. Apro:</th>
														<td>{{ item.approved.totals.count }}</td>
														<td>{{ item.approved.totals.area_m2.toLocaleString() }} m2</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-xs-12">
										<p class="lead">Detalle</p>
										<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
														<th>Microruta</th>
														<th>F. Inicio</th>
														<th>F. Fin</th>
														<th>Estado</th>
													</tr>
												</thead>
												<tbody>
													<tr v-for="(schedule, schedule_id) in item.schedule.data">
														<td>{{ schedule.microroute.name }}</td>
														<td>{{ schedule.date_executed_schedule }}</td>
														<td>{{ schedule.date_executed_schedule_end }}</td>
														<td>
															<i title="Pospuesto" class="fa fa-times" v-if="schedule.in_novelty == 1"></i>
															<i title="Aprobado" class="fa fa-check" v-else-if="schedule.is_approved == 1"></i>
															<i title="Ejecutado" class="fa fa-check-square-o" v-else-if="schedule.is_executed == 1"></i>
															<i title="Pendiente" class="fa fa-clock-o" v-else></i>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							  </div>
							</div>
						  </div>
						</div>
						<!-- end of accordion -->
					</div>
				</div>
			</div>
		</div>
	
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content" style="zoom: 0.55;">
						<ul class="list-inline prod_color">
						  <li v-for="(schedule, schedule_i) in schedules">
							<div @click="openScheduleInModal(schedule.id)"
								:class="'color bg-' + (schedule.in_novelty == 1 ? 'red' : schedule.is_approved == 1 ? 'green' : schedule.is_executed == 1 ? 'blue' : 'gray')"
								:title="schedule.microroute.name + ': ' + (schedule.in_novelty == 1 ? 'Pospuesto' : schedule.is_approved == 1 ? 'Completo' : schedule.is_executed == 1 ? 'Ejecutado' : 'No Ejecutado')"
							></div>
						  </li>
						  
						  <!-- //
						  <li>
							<p>Blue</p>
							<div class="color bg-blue"></div>
						  </li>
						  <li>
							<p>Red</p>
							<div class="color bg-red"></div>
						  </li>
						  <li>
							<p>Orange</p>
							<div class="color bg-orange"></div>
						  </li>-->

						</ul>
					</div>
				</div>
			</div>
		</div>
	
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<table id="datatable-buttons-microroutes-dashboard" class="table table-striped table-bordered"></table>
				</div>
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="x_panel">
				<div class="x_content">
					<div class="row">
						<div class="col-sm-12">
							<h4>Totales x Dia</h4>
							<div class="">
								<table class="table table-bordered table-striped datatable">
									<thead>
										<tr>
											<th>Día</th>
											<!-- // <th>Microrutas.</th> -->
											<th>Progr.</th>
											<th>Ejec.</th>
											<th>Noved.</th>
											<th>Aprob.</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(item,item_i) in datas.xDays" >
											<td>{{ item.label }}</td>
											<!-- // <td>{{ item.microroutes.totals.count }}</td> -->
											<td>{{ item.schedule.totals.count }}</td>
											<td>{{ item.executed.totals.count }}</td>
											<td>{{ item.novelty.totals.count }}</td>
											<td>{{ item.approved.totals.count }}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="modal fade bs-microroutes-me-account-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel">Microrutas</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<table id="datatable-buttons-microroutes-modal" class="table table-striped table-bordered"></table>
								<div id="demo_info"></div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
var Home = Vue.extend({
	template: '#home',
	data(){
		return {
			options: {
			},
			filter: {
				dates: {
					start: moment().subtract(30, 'days').format('YYYY-MM-DD'),
					end: moment().format('YYYY-MM-DD'),
				},
			},
			microroutes: [],
			schedules: [],
			datas: {
				xDays: [],
				// forDate: [],
			},
			
			totals: {
				microroutes: {
					schedule: 0,
					executed: 0,
					approved: 0,
					novelty: 0,
				},
				area_m2: {
					schedule: 0,
					executed: 0,
					approved: 0,
					novelty: 0,
				},
			},
			chart_plot_03_settings: {
				series: {
					curvedLines: {
						apply: true,
						active: true,
						monotonicFit: true
					}
				},
				colors: ["#26B99A"],
				grid: {
					borderWidth: {
						top: 0,
						right: 0,
						bottom: 1,
						left: 1
					},
					borderColor: {
						bottom: "#7F8790",
						left: "#7F8790"
					}
				}
			},
			chart_plot_03_data: [
			],
			theme: {
				color: [
					'#26B99A', '#34495E', '#BDC3C7', '#3498DB',
					'#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
				],
				title: {
					itemGap: 8,
					textStyle: {
						fontWeight: 'normal',
						color: '#408829'
					}
				},
				dataRange: {
					color: ['#1f610a', '#97b58d']
				},
				toolbox: {
					color: ['#408829', '#408829', '#408829', '#408829']
				},
				tooltip: {
					backgroundColor: 'rgba(0,0,0,0.5)',
					axisPointer: {
						type: 'line',
						lineStyle: {
							color: '#408829',
							type: 'dashed'
						},
						crossStyle: {
							color: '#408829'
						},
						shadowStyle: {
							color: 'rgba(200,200,200,0.3)'
						}
					}
				},
				dataZoom: {
					dataBackgroundColor: '#eee',
					fillerColor: 'rgba(64,136,41,0.2)',
					handleColor: '#408829'
				},
				grid: {
					borderWidth: 0
				},
				categoryAxis: {
					axisLine: {
						lineStyle: {
							color: '#408829'
						}
					},
					splitLine: {
						lineStyle: {
							color: ['#eee']
						}
					}
				},
				valueAxis: {
					  axisLine: {
						  lineStyle: {
							  color: '#408829'
						  }
					  },
					  splitArea: {
						  show: true,
						  areaStyle: {
							  color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
						  }
					  },
					  splitLine: {
						  lineStyle: {
							  color: ['#eee']
						  }
					  }
				  },
				  timeline: {
					  lineStyle: {
						  color: '#408829'
					  },
					  controlStyle: {
						  normal: {color: '#408829'},
						  emphasis: {color: '#408829'}
					  }
				  },
				  k: {
					  itemStyle: {
						  normal: {
							  color: '#68a54a',
							  color0: '#a9cba2',
							  lineStyle: {
								  width: 1,
								  color: '#408829',
								  color0: '#86b379'
							  }
						  }
					  }
				  },
				  map: {
					  itemStyle: {
						  normal: {
							  areaStyle: {
								  color: '#ddd'
							  },
							  label: {
								  textStyle: {
									  color: '#c12e34'
								  }
							  }
						  },
						  emphasis: {
							  areaStyle: {
								  color: '#99d2dd'
							  },
							  label: {
								  textStyle: {
									  color: '#c12e34'
								  }
							  }
						  }
					  }
				  },
				  force: {
					  itemStyle: {
						  normal: {
							  linkStyle: {
								  strokeColor: '#408829'
							  }
						  }
					  }
				  },
				  chord: {
					  padding: 4,
					  itemStyle: {
						  normal: {
							  lineStyle: {
								  width: 1,
								  color: 'rgba(128, 128, 128, 0.5)'
							  },
							  chordStyle: {
								  lineStyle: {
									  width: 1,
									  color: 'rgba(128, 128, 128, 0.5)'
								  }
							  }
						  },
						  emphasis: {
							  lineStyle: {
								  width: 1,
								  color: 'rgba(128, 128, 128, 0.5)'
							  },
							  chordStyle: {
								  lineStyle: {
									  width: 1,
									  color: 'rgba(128, 128, 128, 0.5)'
								  }
							  }
						  }
					  }
				  },
				  gauge: {
					  startAngle: 225,
					  endAngle: -45,
					  axisLine: {
						  show: true,
						  lineStyle: {
							  color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
							  width: 8
						  }
					  },
					  axisTick: {
						  splitNumber: 10,
						  length: 12,
						  lineStyle: {
							  color: 'auto'
						  }
					  },
					  axisLabel: {
						  textStyle: {
							  color: 'auto'
						  }
					  },
					  splitLine: {
						  length: 18,
						  lineStyle: {
							  color: 'auto'
						  }
					  },
					  pointer: {
						  length: '90%',
						  color: 'auto'
					  },
					  title: {
						  textStyle: {
							  color: '#333'
						  }
					  },
					  detail: {
						  textStyle: {
							  color: 'auto'
						  }
					  }
				  },
				  textStyle: {
					  fontFamily: 'Arial, Verdana, sans-serif'
				  }
			},
			echartBar: null,
			echartBarS: null,
			charts: {
				principal: []
			},
		};
	},
	created: function () {
		var self = this;
		
	},
	mounted: function () {
		var self = this;
				
		self.echartBar = echarts.init(document.getElementById('chart_plot_principal'), self.theme);
		self.echartBarS = echarts.init(document.getElementById('chart_plot_secondary'), self.theme);
		self.init_daterangepicker();
		
	},
	computed: {
	},
	methods: {
		openScheduleInModal(schedule_id){
			var self = this;
			scheduleIndex = self.schedules.findIndex((x) => x.id == schedule_id);
			schedule = self.schedules[scheduleIndex];
			console.log(scheduleIndex);
			console.log(schedule);
			
			$ReadListInModal = $('<div></div>');
			if(schedule.id == schedule_id && $ReadListInModal.text() == ''){
				$textStatus = schedule.in_novelty == 1 ? 'Con observacion' : schedule.is_approved == 1 ? 'Aprobado' : schedule.is_executed == 1 ? 'Ejecutado' : 'No Ejecutado';
				$colorStatus = schedule.in_novelty == 1 ? 'tag-danger' : schedule.is_approved == 1 ? 'tag-success' : schedule.is_executed == 1 ? 'tag-primary' : 'tag-default';
				$textPeriod = schedule.period.name +' de ' + schedule.year
				$textBodyParr = schedule.in_novelty == 1 ? 'la programacion va ser movida por motivos ajenos.' : schedule.is_approved == 1 ? 'Ejecutado y Aprobado' : schedule.is_executed == 1 ? 'La programacion ya fue ejecutada, estamos esperando tu respuesta.' : 'Aún no hemos ejecutado la programacion.';
				
				$bodySchedulesModal = $('<div></div>').attr('class', 'row')
					.append(
						$('<div></div>').attr('class', 'col-xs-12')
							.append($('<p></p>').append($('<b></b>').append('Contrato: ')).append(schedule.microroute.contract.name))
							.append($('<p></p>').append($('<b></b>').append('Direccion(es): ')).append(schedule.microroute.address_text))
							.append($('<p></p>').append($('<b></b>').append('Lote REF: ')).append(schedule.microroute.id_ref))
							.append($('<p></p>').append($('<b></b>').append('Area m2: ')).append(schedule.microroute.area_m2))
							.append($('<p></p>').append($('<b></b>').append('Descripcion: ')).append(schedule.microroute.description))
							
					)
					.append(
						$('<div></div>').attr('class', 'col-xs-12').append($('<p></p>').append($textBodyParr))
					)
					.append(
						$('<div></div>').attr('class', 'col-xs-6')
							.append(
								$('<h5></h5>').append("Registro del Antes")
							)
							.append(
								$('<ul></ul>').attr('class', 'hide-bullets-modal row modal-gallery-microroute-' + schedule.microroute.id + ' modal-gallery-microroute-' + schedule.microroute.id + '-schedule-' + schedule.id + "-A").attr('data-status', '1').attr('data-type', 'A').attr('data-microroute', schedule.microroute.id).attr('data-schedule', schedule.id)
									/*.append(
										$('<div></div>').attr('class', 'col-xs-6 col-md-3')
											.append($('<a></a>').append($('<img />').attr('class', 'thumbnail').attr('style', 'width: 100%;height: auto;').attr('data-action', 'zoom').attr('src', 'https://www.jqueryscript.net/images/jQuery-Gallery-Image-Zoom.jpg')))
									)*/
							)
					)
					.append(
						$('<div></div>').attr('class', 'col-xs-6')
							.append(
								$('<h5></h5>').append("Registro del Despues")

							)
							.append(
								$('<ul></ul>').attr('class', 'hide-bullets-modal row modal-gallery-microroute-' + schedule.microroute.id + ' modal-gallery-microroute-' + schedule.microroute.id + '-schedule-' + schedule.id + "-D").attr('data-status', '1').attr('data-type', 'D').attr('data-microroute', schedule.microroute.id).attr('data-schedule', schedule.id)
									
							)
					)
					.append(
						$('<div></div>').attr('class', 'clearfix')
					);
				
				MV.api.readList('/reports_photographic', {
					filter: [
						'status,eq,1',
						'schedule,in,' + schedule_id,
					],
					join: [
						'schedule',
					]
				}, (AllGallerys) => {
					
					AllGallerys.forEach((file) => {
						var $boxGallery = $( ".modal-gallery-microroute-" + file.schedule.microroute + '-schedule-' + file.schedule.id + "-" + file.type );
						$boxGallery.append(
							$('<div></div>').attr('class', 'col-xs-6 col-md-3 item-gallery')
								.append($('<a></a>').append($('<img />').attr('class', 'thumbnail').attr('style', 'width: 100%;height: auto;').attr('data-action', 'zoom').attr('src', file.file_path_short)))
						);
					});
					/*
					selectedIds.forEach((a) => {
						if($( ".gallery-microroute-" + microrouteId + '-schedule-' + a + "-A" ).html() == ""){
							$( ".gallery-microroute-" + microrouteId + '-schedule-' + a + "-A" ).html("<div>No hay imagenes disponibles.</div>");
						}
						if($( ".gallery-microroute-" + microrouteId + '-schedule-' + a + "-D" ).html() == ""){
							$( ".gallery-microroute-" + microrouteId + '-schedule-' + a + "-D" ).html("<div>No hay imagenes disponibles.</div>");
						}
					});*/
				});
				
				btnsModal = {
					cancel: {
						label: "Cerrar",
						className: 'btn-default',
						callback: function(){
							console.log('Custom cancel clicked');
						}
					},
				};
				
				if(schedule.is_executed == 1 && schedule.in_novelty == 0 && schedule.is_approved == 0){
					btnsModal.noclose = {
						label: "¿Falta algo?",
						className: 'btn-warning',
						callback: function(){
							console.log('Custom button clicked');
							return false;
						}
					};
					
					btnsModal.ok = {
						label: "Aprobar",
						className: 'btn-success',
						callback: function(){
							console.log('Custom OK clicked');
							bootbox.confirm({
								message: "Confirma antes de realizar esta accion.",
								locale: 'es',
								callback: function (result) {
									if(result !== null){
										if(result == true){
											MV.api.update('/schedule/' + schedule.id, {
												updated_by: <?= $this->user->id;?>,
												is_approved: 1,
												date_approved: moment().format('YYYY-MM-DD'),
												time_approved: moment().format('HH:mm:ss'),
											}, (x) => {
												console.log('response approved: ', x);
												if(x > 0){
													self.schedules[scheduleIndex].date_approved = moment().format('YYYY-MM-DD');
													self.schedules[scheduleIndex].time_approved = moment().format('HH:mm:ss');
													self.schedules[scheduleIndex].is_approved = 1;
												}
											});
										} else {
											var dialog = bootbox.dialog({
												title: $textStatus + ' ' + $textPeriod + ' ' + schedule.microroute.name,
												message: $bodySchedulesModal.html(),
												size: 'large',
												buttons: btnsModal
											});
										}
									}
								}
							});
						}
					};
				}
				
				var dialog = bootbox.dialog({
					title: $textStatus + ' ' + $textPeriod + ' ' + schedule.microroute.name,
					message: $bodySchedulesModal.html(),
					size: 'large',
					buttons: btnsModal
				});
			}
		},
		recordsFilter(){
			var self = this;
			try {
				self.microroutes = [];
				// self.datas.forDate = [];
				self.datas.xDays = [];
				self.totals.area_m2.schedule = self.totals.area_m2.executed = self.totals.area_m2.approved = self.totals.area_m2.novelty = 0;
				self.totals.microroutes.schedule = self.totals.microroutes.executed = self.totals.microroutes.approved = self.totals.microroutes.novelty = 0;
				
				const diffRange = moment(self.filter.dates.end).diff(moment(self.filter.dates.start), 'days');
				date = moment(moment(self.filter.dates.start));
				for (var i = 1; i <= diffRange; i++) {
					textFormat = date.format('YYYY-MM-DD');
					//indexR = self.datas.forDate.findIndex((a) => a.label == textFormat);
					indexRR = self.datas.xDays.findIndex((a) => a.label == textFormat);
					/*if(indexR <= -1){
						self.datas.forDate.push({
							label: textFormat,
							data: {
								microroutes: [],
								schedules: [],
								executed: [],
								approved: [],
								novelty: [],
							},
							totals: {
								schedule: 0,
								executed: 0,
								approved: 0,
								novelty: 0,
							},
							area_m2: {
								schedule: 0,
								executed: 0,
								approved: 0,
								novelty: 0,
							},
						});
					}*/
					if(indexRR <= -1){
						self.datas.xDays.push({
							label: textFormat,
							microroutes: {
								data: [],
								totals: {
									area_m2: 0,
									count: 0,
								},
							},
							schedule: {
								data: [],
								totals: {
									area_m2: 0,
									count: 0,
								},
							},
							executed: {
								data: [],
								totals: {
									area_m2: 0,
									count: 0,
								},
							},
							approved: {
								data: [],
								totals: {
									area_m2: 0,
									count: 0,
								},
							},
							novelty: {
								data: [],
								totals: {
									area_m2: 0,
									count: 0,
								},
							},
						});
					}
					date.add({ days: 1 });
				}
				
				idsContracts = [];
				if(self.$root.contracts.actives.length > 0){
					self.$root.contracts.actives.forEach((contract) => {
						rStart = moment(contract.end) >= moment(self.filter.dates.end) && moment(self.filter.dates.start) >= moment(contract.start) ? true : false;
						if(rStart == true){ idsContracts.push(contract.id); }
					});
					
					MV.api.readList('/microroutes', {
						filter: [
							'contract,in,' + idsContracts.join()
						],
					}, (allMicroroutes) => {
						// self.microroutes = allMicroroutes;
						idsMicroroutes = allMicroroutes.map((a) => a.id);
						
						MV.api.readList('/schedule', {
							join: [
								'microroutes,accounts_contracts',
								'periods',
							],
							filter: [
								'microroute,in,' + idsMicroroutes.join(),
								'date_executed_schedule,ge,' + self.filter.dates.start,
								'date_executed_schedule_end,le,' + moment(self.filter.dates.end).format('YYYY-MM-DD'),
							],
						}, (allSchedule) => {
							idsSchedule = allSchedule.map((a) => a.id);
							
							self.schedules = allSchedule;
							allSchedule.forEach((schedule) => {
								totalDias = moment(schedule.date_executed_schedule_end).diff(moment(schedule.date_executed_schedule), 'days');
								schedule.totalDias = totalDias;
								micIndex = self.microroutes.findIndex((x) => x.id == schedule.microroute.id);
								if(micIndex < 0){
									schedule.microroute.repeats = {
										schedule: 0,
										executed: 0,
										approved: 0,
										novelty: 0,
									};
									schedule.microroute.totals = {
										schedule: 0,
										executed: 0,
										approved: 0,
										novelty: 0,
									};
									schedule.microroute.schedules = [];
									self.microroutes.push(schedule.microroute);
								}
								micRIndex = self.microroutes.findIndex((x) => x.id == schedule.microroute.id);
								if(micRIndex > -1){
									self.totals.microroutes.schedule++;
									self.totals.area_m2.schedule += schedule.microroute.area_m2;
									self.microroutes[micRIndex].repeats.schedule++;
									self.microroutes[micRIndex].totals.schedule += schedule.microroute.area_m2;
											
									if(schedule.is_executed == 1){
										self.totals.microroutes.executed++;
										self.totals.area_m2.executed += schedule.microroute.area_m2;
										self.microroutes[micRIndex].repeats.executed++;
										self.microroutes[micRIndex].totals.executed += schedule.microroute.area_m2;
									};
									if(schedule.is_approved == 1){
										self.totals.microroutes.approved++;
										self.totals.area_m2.approved += schedule.microroute.area_m2;
										self.microroutes[micRIndex].repeats.approved++;
										self.microroutes[micRIndex].totals.approved += schedule.microroute.area_m2;
									};
									if(schedule.in_novelty == 1){
										self.totals.microroutes.novelty++;
										self.totals.area_m2.novelty += schedule.microroute.area_m2;
										self.microroutes[micRIndex].repeats.novelty++;
										self.microroutes[micRIndex].totals.novelty += schedule.microroute.area_m2;
									};
								}
								
								
								if(totalDias > 0){
									areaForDay = window.isNaN(((schedule.microroute.area_m2 !== undefined && schedule.microroute.area_m2 > 0 && totalDias > 0) ? (schedule.microroute.area_m2 / totalDias) : 0)) ? 0 : ((schedule.microroute.area_m2 !== undefined && schedule.microroute.area_m2 > 0 && totalDias > 0) ? (schedule.microroute.area_m2 / totalDias) : 0);
									// console.log('areaForDay', areaForDay);
									dateAdd = moment(schedule.date_executed_schedule);
									
									for (var ii = 0; ii < totalDias; ii++) {
										textFormatAdd = dateAdd.format('YYYY-MM-DD');
										indexDay = self.datas.xDays.findIndex((a) => a.label == textFormatAdd);
										if(indexDay > -1){
											
											inSchedule = self.datas.xDays[indexDay].schedule.data.findIndex((x) => x.id == schedule.id);
											if(inSchedule <= -1){
												self.datas.xDays[indexDay].schedule.data.push(schedule);
												self.datas.xDays[indexDay].schedule.totals.area_m2 += areaForDay;
												self.datas.xDays[indexDay].schedule.totals.count++;
											}
											
											if(schedule.is_executed == 1){
												indexDayExecuted = self.datas.xDays.findIndex((a) => a.label == schedule.date_executed);
												if(self.datas.xDays[indexDayExecuted] !== undefined){
													indexExecuted = self.datas.xDays[indexDayExecuted].executed.data.findIndex((x) => x.id == schedule.id);
													if(indexExecuted <= -1){
														self.datas.xDays[indexDayExecuted].executed.data.push(schedule);
														self.datas.xDays[indexDayExecuted].executed.totals.area_m2 += areaForDay;
														self.datas.xDays[indexDayExecuted].executed.totals.count++;
													}
												}
											}
											
											if(schedule.is_approved == 1){
												indexDayApproved = self.datas.xDays.findIndex((a) => a.label == schedule.date_approved);
												if(self.datas.xDays[indexDayApproved] !== undefined){
													indexApproved = self.datas.xDays[indexDayApproved].approved.data.findIndex((x) => x.id == schedule.id);
													if(indexApproved <= -1){
														self.datas.xDays[indexDayApproved].approved.data.push(schedule);
														self.datas.xDays[indexDayApproved].approved.totals.area_m2 += schedule.microroute.area_m2;
														self.datas.xDays[indexDayApproved].approved.totals.count++;
													}
												}
											}
											
											if(schedule.in_novelty == 1){
												indexDayNovelty = self.datas.xDays.findIndex((a) => a.label == schedule.date_novelty);
												if(self.datas.xDays[indexDayNovelty] !== undefined){
													indexNovelty = self.datas.xDays[indexDayNovelty].novelty.data.findIndex((x) => x.id == schedule.id);
													if(indexNovelty <= -1){
														self.datas.xDays[indexDayNovelty].novelty.data.push(schedule);
														self.datas.xDays[indexDayNovelty].novelty.totals.area_m2 += schedule.microroute.area_m2;
														self.datas.xDays[indexDayNovelty].novelty.totals.count++;
													}
												}
											}
											
											
											inMicroroute = self.datas.xDays[indexDay].microroutes.data.findIndex((x) => x.id == schedule.microroute.id);
											if(inMicroroute <= -1){
												self.datas.xDays[indexDay].microroutes.data.push(schedule);
												self.datas.xDays[indexDay].microroutes.totals.area_m2 += areaForDay;
												self.datas.xDays[indexDay].microroutes.totals.count++;
											}
											
											micRIndex = self.microroutes.findIndex((x) => x.id == schedule.microroute.id);
											if(micRIndex > -1){
												micSchIndex = self.microroutes[micRIndex].schedules.findIndex((x) => x.id == schedule.id);
												if(micSchIndex <= -1){
													self.microroutes[micRIndex].schedules.push(schedule);
												}
											}
											
										}
									
										dateAdd.add({ days: 1 });
									}
								}
							});
							self.initDatatable()
						});
					});
				}
			}
			catch(e) {
				console.error(e);
				console.log(e);
			}
		},
		init_daterangepicker(){
			var self = this;
			if (typeof($.fn.daterangepicker) === 'undefined') { return; }
			var cb = function(start, end, label) {
				// console.log(start.toISOString(), end.toISOString(), label);
				dateStart = start;
				dateEnd = end.add({ days: 1 });
				self.filter.dates.start = dateStart.format('YYYY-MM-DD');
				self.filter.dates.end = dateEnd.format('YYYY-MM-DD');
				$('#reportrange-date span').html(dateStart.format('MMMM D, YYYY') + ' - ' + dateEnd.subtract({ days: 1 }).format('MMMM D, YYYY'));
			};
			
			var optionSet1 = {
				startDate: moment().subtract({ days: 29 }),
				endDate: moment(),
				minDate: '01/01/2020',
				maxDate: moment(),
				dateLimit: {
					days: 60
				},
				showDropdowns: true,
				showWeekNumbers: true,
				timePicker: false,
				timePickerIncrement: 1,
				timePicker12Hour: true,
				ranges: {
					'Hoy': [moment(), moment()],
					'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
					'Últimos 7 Días': [moment().subtract(6, 'days'), moment()],
					'Últimos 30 Días': [moment().subtract(29, 'days'), moment()],
					'Mes en curso': [moment().startOf('month'), moment().endOf('month')],
					'Mes Anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
				},
				opens: 'left',
				buttonClasses: ['btn btn-default'],
				applyClass: 'btn-small btn-primary',
				cancelClass: 'btn-small',
				format: 'MM/DD/YYYY',
				separator: ' to ',
				locale: {
					applyLabel: 'Aceptar',
					cancelLabel: 'Limpiar',
					fromLabel: 'From',
					toLabel: 'To',
					customRangeLabel: 'Personalizado',
					daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
					monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
					firstDay: 1
				}
			};

			$('#reportrange-date span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
			$('#reportrange-date').daterangepicker(optionSet1, cb);
			$('#reportrange-date').on('show.daterangepicker', function() {
				// console.log(("show event fired");
			});
			$('#reportrange-date').on('hide.daterangepicker', function() {
				// console.log(("hide event fired");
			});
			$('#reportrange-date').on('apply.daterangepicker', function(ev, picker) {
				// console.log(("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
				console.log('Fechas cambiadas actualizando filtro.');
				self.recordsFilter();
			});
			$('#reportrange-date').on('cancel.daterangepicker', function(ev, picker) {
				// console.log(("cancel event fired");
			});
			$('#options1').click(function() {
				$('#reportrange-date').data('daterangepicker').setOptions(optionSet1, cb);
			});
			$('#options2').click(function() {
				$('#reportrange-date').data('daterangepicker').setOptions(optionSet2, cb);
			});
			$('#destroy').click(function() {
				$('#reportrange-date').data('daterangepicker').remove();
			});
			self.recordsFilter();
		},
		initDatatable(){
			var self = this;
			labels = self.datas.xDays.map((x) => x.label);
			dataScheduleBase = dataExecutedBase = dataApprovedBase = dataNoveltyBase = self.datas.xDays;
			
			// dataScheduleBase = self.datas.xDays.filter((x) => x.microroutes.data.length > 0);
			charters = {
				day: {
					schedule: { area_m2: [], count: [], },
					executed: { area_m2: [], count: [], },
					approved: { area_m2: [], count: [], },
					novelty: { area_m2: [], count: [], },
				},
				totals: {
					schedule: { area_m2: [], count: [], },
					executed: { area_m2: [], count: [], },
					approved: { area_m2: [], count: [], },
					novelty: { area_m2: [], count: [], },
				},
			};
			charters.day.schedule.area_m2 = dataScheduleBase.map((x) => x.schedule.totals.area_m2);
			charters.day.schedule.count = dataScheduleBase.map((x) => x.schedule.totals.count);
			charters.day.executed.area_m2 = dataScheduleBase.map((x) => x.executed.totals.area_m2);
			charters.day.executed.count = dataScheduleBase.map((x) => x.executed.totals.count);
			charters.day.approved.area_m2 = dataScheduleBase.map((x) => x.approved.totals.area_m2);
			charters.day.approved.count = dataScheduleBase.map((x) => x.approved.totals.count);
			charters.day.novelty.area_m2 = dataScheduleBase.map((x) => x.novelty.totals.area_m2);
			charters.day.novelty.count = dataScheduleBase.map((x) => x.novelty.totals.count);
			
			tempTotal = 0; charters.totals.schedule.area_m2 = charters.day.schedule.area_m2.map((z) => { z = tempTotal = (z + tempTotal); return z; });
			tempTotal = 0; charters.totals.schedule.count  =  charters.day.schedule.count.map( (z)  => { z = tempTotal = (z + tempTotal); return z; });
			
			tempTotal = 0; charters.totals.executed.area_m2 = charters.day.executed.area_m2.map((z) => { z = tempTotal = (z + tempTotal); return z; });
			tempTotal = 0; charters.totals.executed.count  =  charters.day.executed.count.map( (z)  => { z = tempTotal = (z + tempTotal); return z; });
			
			tempTotal = 0; charters.totals.approved.area_m2 = charters.day.approved.area_m2.map((z) => { z = tempTotal = (z + tempTotal); return z; });
			tempTotal = 0; charters.totals.approved.count  =  charters.day.approved.count.map( (z)  => { z = tempTotal = (z + tempTotal); return z; });
			
			tempTotal = 0; charters.totals.novelty.area_m2 = charters.day.novelty.area_m2.map((z) => { z = tempTotal = (z + tempTotal); return z; });
			tempTotal = 0; charters.totals.novelty.count  =  charters.day.novelty.count.map( (z)  => { z = tempTotal = (z + tempTotal); return z; });
						
			self.echartBar.setOption({
				title: {
					text: 'Grafico # 1',
					subtext: 'Graph Sub-text'
				},
				tooltip: {
					trigger: 'axis'
				},
				legend: {
					data: ['Programado', 'Ejecutado', 'Pospuesto']
					// data: ['Programado', 'Ejecutado', 'Aprobado', 'Ejecutado']
					/*
					data: [
						'Programado x Dia', 'Programado',
						'Ejecutado x Dia', 'Ejecutado',
						'Aprobado x Dia', 'Aprobado',
						'Pospuesto x Dia', 'Pospuesto',
					]*/
				},
				toolbox: {
					show: false
				},
				calculable: false,
				xAxis: [{
					type: 'category',
					data: labels
				}],
				yAxis: [{
					type: 'value'
				}],
				series: [
					{
						name: 'Programado',
						type: 'line',
						data: charters.totals.schedule.area_m2,
						/*
						markPoint: {
							data: dataNovelty
						},*/
						markLine: {
							data: [{
								type: 'average',
								name: '???'
							}]
						}
					},
					{
						name: 'Ejecutado',
						type: 'line',
						data: charters.totals.executed.area_m2,
						markLine: {
							data: [{
								type: 'average',
								name: '???'
							}]
						}
					},
					{
						name: 'Pospuesto',
						type: 'line',
						data: charters.totals.novelty.area_m2,
						markLine: {
							data: [{
								type: 'average',
								name: '???'
							}]
						}
					},
					/*
					{
						name: 'Aprobado',
						type: 'line',
						data: charters.totals.approved.area_m2,
						markLine: {
							data: [{
								type: 'average',
								name: '???'
							}]
						}
					},*/
				]
			});
			
			self.echartBarS.setOption({
				title: {
					text: 'Grafico # 2',
					subtext: 'Graph Sub-text'
				},
				tooltip: {
					trigger: 'axis'
				},
				legend: {
					data: ['Programado', 'Ejecutado', 'Aprobado', 'Pospuesto']
				},
				toolbox: {
					show: false
				},
				calculable: false,
				xAxis: [{
					type: 'category',
					data: labels
				}],
				yAxis: [{
					type: 'value'
				}],
				series: [
					{
						name: 'Programado',
						type: 'bar',
						data: charters.day.schedule.area_m2,
						/*
						markPoint: {
							data: dataNovelty
						},*/
						markLine: {
							data: [{
								type: 'average',
								name: '???'
							}]
						}
					},	
					{
						name: 'Ejecutado',
						type: 'bar',
						data: charters.day.executed.area_m2,
						/*
						markPoint: {
							data: dataNovelty
						},*/
						markLine: {
							data: [{
								type: 'average',
								name: '???'
							}]
						}
					},	
					{
						name: 'Pospuesto',
						type: 'bar',
						data: charters.day.novelty.area_m2,
						markLine: {
							data: [{
								type: 'average',
								name: '???'
							}]
						}
					},
					/*
					{
						name: 'Aprobado',
						type: 'bar',
						data: charters.day.approved.area_m2,
						markLine: {
							data: [{
								type: 'average',
								name: '???'
							}]
						}
					},	*/
				]
			});
			
			
			$('#datatable-buttons-microroutes-dashboard').html('');
				$('.datatable').DataTable({
					destroy: true,
					language: { "url": "/public/assets/build/js/lang-datatable.json" },
					// data: self.records,
					fixedHeader: true,
					dom: "Blfrtip",
					buttons: [
						{
						  extend: "copy",
						  className: "btn-sm"
						},
						{
						  extend: "csv",
						  className: "btn-sm"
						},
						{
						  extend: "excel",
						  className: "btn-sm"
						},
						{
						  extend: "pdfHtml5",
						  className: "btn-sm"
						},
						{
						  extend: "print",
						  className: "btn-sm"
						},
					],
					responsive: false,
				});
				
				self.dataTable = $('#datatable-buttons-microroutes-dashboard')
					.DataTable({
						destroy: true,
						language: { "url": "/public/assets/build/js/lang-datatable.json" },
						// data: self.records,
						fixedHeader: true,
						data: self.microroutes.map(b => {
							// console.log(b); ///////// assssssssssssssssssssssss
							$ulList = $('<ul></ul>').attr("class", "list-unstyled timeline");
							// console.log(b);
							b.schedules.forEach((c) => {
								$textStatus = c.in_novelty == 1 ? 'Con observacion' : c.is_approved == 1 ? 'Aprobado' : c.is_executed == 1 ? 'Ejecutado' : 'No Ejecutado';
								$colorStatus = c.in_novelty == 1 ? 'tag-danger' : c.is_approved == 1 ? 'tag-success' : c.is_executed == 1 ? 'tag-primary' : 'tag-default';
								$textPeriod = c.period.name +' de ' + c.year
								$textBodyParr = c.in_novelty == 1 ? 'la programacion va ser movida por motivos ajenos.' : c.is_approved == 1 ? 'Ejecutado y Aprobado' : c.is_executed == 1 ? 'La programacion ya fue ejecutada, estamos esperando tu respuesta.' : 'Aún no hemos ejecutado la programacion.';
								
								$bodySchedules = $('<div></div>').attr('class', 'row')
									.append(
										$('<div></div>').attr('class', 'col-xs-12')
											.append($('<p></p>').append($('<b></b>').append('Contrato: ')).append(b.contract.name))
											.append($('<p></p>').append($('<b></b>').append('Direccion(es): ')).append(b.address_text))
											.append($('<p></p>').append($('<b></b>').append('Lote REF: ')).append(b.id_ref))
											.append($('<p></p>').append($('<b></b>').append('Area m2: ')).append(b.area_m2))
											.append($('<p></p>').append($('<b></b>').append('Descripcion: ')).append(b.description))
											
									)
									.append(
										$('<div></div>').attr('class', 'col-xs-12').append($('<p></p>').append($textBodyParr))
									)
									.append(
										$('<div></div>').attr('class', 'col-xs-6')
											.append(
												$('<h5></h5>').append("Registro del Antes")
											)
											.append(
												$('<ul></ul>').attr('class', 'hide-bullets row gallery-microroute-' + c.microroute.id + ' gallery-microroute-' + c.microroute.id + '-schedule-' + c.id + "-A").attr('data-status', '1').attr('data-type', 'A').attr('data-microroute', c.microroute.id).attr('data-schedule', c.id)
													/*.append(
														$('<div></div>').attr('class', 'col-xs-6 col-md-3')
															.append($('<a></a>').append($('<img />').attr('class', 'thumbnail').attr('style', 'width: 100%;height: auto;').attr('data-action', 'zoom').attr('src', 'https://www.jqueryscript.net/images/jQuery-Gallery-Image-Zoom.jpg')))
													)*/
											)
									)
									.append(
										$('<div></div>').attr('class', 'col-xs-6')
											.append(
												$('<h5></h5>').append("Registro del Despues")

											)
											.append(
												$('<ul></ul>').attr('class', 'hide-bullets row gallery-microroute-' + c.microroute.id + ' gallery-microroute-' + c.microroute.id + '-schedule-' + c.id + "-D").attr('data-status', '1').attr('data-type', 'D').attr('data-microroute', c.microroute.id).attr('data-schedule', c.id)
													/*.append(
														$('<div></div>').attr('class', 'col-xs-6 col-md-3')
															.append($('<a></a>').append($('<img />').attr('class', 'thumbnail').attr('style', 'width: 100%;height: auto;').attr('data-action', 'zoom').attr('src', 'https://www.jqueryscript.net/images/jQuery-Gallery-Image-Zoom.jpg')))
													)*/
											)
									);
								
											
								$itemBlock_content = $("<div></div>").attr("class", "block_content")
									.append($("<h5></h5>").append($("<a></a>").append($textPeriod)))
									.append($("<div></div>").attr('class', 'byline').append($("<span></span>").append(c.date_executed_schedule + ' - ' + c.date_executed_schedule_end)))
									.append($("<p></p>").attr('class', 'excerpt').append($bodySchedules));
								$itemTags = $("<div></div>").attr("class", "tags")
									.append($("<a></a>").attr("class", "tag " + $colorStatus).append($("<span></span>").text($textStatus)));
								$itemBlock = $("<div></div>").attr('class', 'block').append($itemTags).append($itemBlock_content);
								$item = $("<li></li>").append($itemBlock);
								$ulList.append($item);
							});
							$htmlSchedule = $('<div></div>').append($ulList);
							joinIdsSchedules = b.schedules.map((b) => { return b.id; });
							
							return [
								//b.id,
								"<font class=\"current-status-microroute\" data-microroute=\"" + b.id + "\" data-schedules=\"" + joinIdsSchedules.join(',') + "\">" + b.id + "</font>", 
								b.name, 
								// b.id_ref, 
								// b.address_text, 
								//b.area_m2.toLocaleString(),
								b.repeats.schedule,
								b.repeats.executed,
								b.repeats.novelty,
								(b.repeats.schedule - (b.repeats.executed + b.repeats.novelty)),
								(100 - (((b.repeats.schedule - (b.repeats.executed + b.repeats.novelty)) * 100) / b.repeats.schedule)) + '%',
								b.totals.schedule.toLocaleString(),
								b.totals.executed.toLocaleString(),
								(b.totals.schedule - (b.totals.executed + b.totals.novelty)).toLocaleString(),
								(100 - (((b.totals.schedule - (b.totals.executed + b.totals.novelty)) * 100) / b.totals.schedule)) + '%',
								//(b.obs.length <= 3) ? 'Sin Observaciones' : b.obs.length, 
								// b.contract.name,
								//b.description,
								/*
								JSON.stringify(b.schedules.map(b=>{
									return [b.id, b.date_executed_schedule, b.date_executed_schedule_end, b.is_executed, b.is_approved, b.in_novelty];
								})),*/
								$htmlSchedule.html(),
							]
						}),
						columns: [
							{ title: "id" },
							{ title: "Microruta" },
							// { title: "Lote REF." },
							// { title: "Direccion(es)" },
							// { title: "Area m2" },
							{ title: "Frec." },
							{ title: "Frec. Ejec." },
							{ title: "Frec. Pos." },
							{ title: "Frec. Pdtes." },
							{ title: "Progreso Frec" },
							{ title: "Total Prog." },
							{ title: "Total Ejec." },
							{ title: "Total Pdte" },
							{ title: "Progreso m2" },
							//{ title: "Obs." },
							//{ title: "Contrato" },
							// { title: "Descripcion" },
							//{ title: "schedules" },
							{ title: "" },
						],
						dom: "Blfrtip",
						buttons: [
							{
							  extend: "copy",
							  className: "btn-sm"
							},
							{
							  extend: "csv",
							  className: "btn-sm"
							},
							{
							  extend: "excel",
							  className: "btn-sm"
							},
							{
							  extend: "pdfHtml5",
							  className: "btn-sm"
							},
							{
							  extend: "print",
							  className: "btn-sm"
							},
						],
						responsive: true,
						initComplete: function( settings, json ) {
							var apiTables = this.api();
							
							apiTables.$('td:first-child').click( function () {
								stepNext = !$(this).hasClass('parent');
								
								if(stepNext == true){
									/*var subDialog = bootbox.dialog({
										message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog"></i> Por favor espera mientras hacemos algo...</p>',
										closeButton: false
									});*/
									
									tds = $(this).find( ".current-status-microroute" );
									microrouteId = parseInt($(tds[0]).data('microroute'));
									selectedIds = $(tds[0]).data('schedules') + '';
									
									if(microrouteId > 0 && selectedIds !== ''){
										selectedIds = selectedIds.split(',');
										setTimeout(() => {
											selectedIds.forEach((a) => {
												$( ".gallery-microroute-" + microrouteId + '-schedule-' + a + "-A" ).html('<div><i class="fa fa-spin fa-cog"></i> Por favor espera mientras hacemos algo...</div>');
												$( ".gallery-microroute-" + microrouteId + '-schedule-' + a + "-D" ).html('<div><i class="fa fa-spin fa-cog"></i> Por favor espera mientras hacemos algo...</div>');
											});
										
											MV.api.readList('/reports_photographic', {
												filter: [
													'status,eq,1',
													'schedule,in,' + selectedIds.join(','),
												],
												join: [
													'schedule',
												]
											}, (AllGallerys) => {
												selectedIds.forEach((a) => {
													$( ".gallery-microroute-" + microrouteId + '-schedule-' + a + "-A" ).html('');
													$( ".gallery-microroute-" + microrouteId + '-schedule-' + a + "-D" ).html('');
												});
												
												AllGallerys.forEach((file) => {
													
													var $boxGallery = $( ".gallery-microroute-" + file.schedule.microroute + '-schedule-' + file.schedule.id + "-" + file.type );
													$boxGallery.append(
														$('<div></div>').attr('class', 'col-xs-6 col-md-3 item-gallery')
															.append($('<a></a>').append($('<img />').attr('class', 'thumbnail').attr('style', 'width: 100%;height: auto;').attr('data-action', 'zoom').attr('src', file.file_path_short)))
													);
												});
												
												selectedIds.forEach((a) => {
													if($( ".gallery-microroute-" + microrouteId + '-schedule-' + a + "-A" ).html() == ""){
														$( ".gallery-microroute-" + microrouteId + '-schedule-' + a + "-A" ).html("<div>No hay imagenes disponibles.</div>");
													}
													if($( ".gallery-microroute-" + microrouteId + '-schedule-' + a + "-D" ).html() == ""){
														$( ".gallery-microroute-" + microrouteId + '-schedule-' + a + "-D" ).html("<div>No hay imagenes disponibles.</div>");
													}
												});
											});
										}, 1000);
									}
								}
							});
						}
					});
		},
	}
});

var router = new VueRouter({
	linkActiveClass: 'active',
	routes:[
		{ path: '/', component: Home, name: 'Home' }
	]
});

var app = new Vue({
	router: router,
	created(){
		var self = this;
	},
	mounted(){
		var self = this;
		self.loadMicrorouted();
	},
	data: function () {
		return {
			contracts: {
				actives: [],
				others: [],
			},
		};
	},
	methods: {
		loadMicrorouted(){
			var self = this;
			self.records = [];
			MV.api.readList('/accounts_users', {
				filter: [
					'user,eq,<?= $this->user->id; ?>'
				],
				join: [
					'accounts,identifications_types',
					'accounts,accounts_types',
					'accounts,economic_activities',
					'accounts,users',
					'accounts,identifications_types',
					'accounts,accounts_contracts',
					'permissions_group,permissions_items',
				]
			}, (a) => {
				a.forEach((b) => {
					b.isAdmin = self.isAdminInAccount(b.permissions);
					b.isManager = self.isManagerInAccount(b.permissions);
					b.account.accounts_contracts.forEach((c) => {
						c.is_active = c.is_active == 1 ? true : false;
						// Agregar contrato
						if(c.is_active == true){ self.contracts.actives.push(c); } 
						else { self.contracts.others.push(c); }
					});
				});
			});
		},
		isAdminInAccount(data){
			var self = this;
			try {
				if(data !== null){
					if(Array.isArray(data.permissions_items)){
						detect = data.permissions_items.filter((a) => a.tag == 'me:accounts:admin');
						if(detect.length > 0){ return true; } else { return false; };
					} else { return false; }; 
				} else { return false; };
			} catch (e){
				console.error(e);
				return false;
			}
		},
		isManagerInAccount(data){
			var self = this;
			try {
				if(self.isAdminInAccount(data) == true){ return true; }
				
				if(data !== null){
					if(Array.isArray(data.permissions_items)){
						detect = data.permissions_items.filter((a) => a.tag == 'me:accounts:manager');
						if(detect.length > 0){ return true; } else { return false; };
					} else { return false; }; 
				} else { return false; };
			} catch (e){
				console.error(e);
				return false;
			}
		},
	}
}).$mount('#me-executed-reports-dashboard');
</script>
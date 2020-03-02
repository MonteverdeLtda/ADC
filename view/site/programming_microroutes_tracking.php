
<link href='https://unpkg.com/fullcalendar-scheduler@1.10.0/dist/scheduler.min.css' rel='stylesheet' /> 
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/redmond/jquery-ui.css" rel="stylesheet" />

<script src='https://unpkg.com/fullcalendar@3.10.1/dist/fullcalendar.min.js'></script>
<script src='https://unpkg.com/fullcalendar-scheduler@1.10.0/dist/scheduler.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>

<style>
.ui-datepicker {
	z-index: 99999999999999 !important;
}
.fc-license-message, .fc-timeline-event .fc-time, .fc-day-grid-event .fc-time {
	display: none;
}

.modal {
	overflow: auto !important;
}
</style>


<div id="emvarias-microroutes">
	<div class="page-title">
		<div class="title_left">
			<!-- // <h3><?= $title; ?> <small><?= $subtitle; ?></small></h3> -->
		</div>
		<div class="title_right">
		</div>
	</div>
	<div class="clearfix"></div>
	
	<div class="row">
		<router-view :key="$route.fullPath" ></router-view>
	</div>
</div>

<template id="list">
	<div>
		<div class="row">
			<div class="col-xs-6" v-for="(group, group_i) in groups">
				<div class="x_panel">
					<div class="x_title">
						<h2>{{ group.name }} <small>( {{ group.schedules.length }} )</small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
					
						<div class="table-responsive">
							
								<table class="table table-bordered">
									<thead>
										<tr>
											<th></th>
											<th>Microruta</th>
											<th>Lote</th>
											<th>F. Inicio</th>
											<th>F. Fin</th>
											<th>F. Area</th>
											<th>Fotos Req.</th>
											<th>Fotos Ant.</th>
											<th>Proc Ant.</th>
											<th>Fotos Desp.</th>
											<th>Proc Desp.</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(schedule, schedule_i) in group.schedules" :class="schedule.daysToEnd < 0 ? schedule.classText : ''">
											<td>{{ schedule.id }}</td>
											<td>{{ schedule.microroute.name }}</td>
											<td>{{ schedule.microroute.id_ref }}</td>
											<td>{{ schedule.date_executed_schedule }}</td>
											<td>{{ schedule.date_executed_schedule_end }}</td>
											<td>{{ schedule.microroute.area_m2 }}</td>
											<td>{{ schedule.photosReq }}</td>
											<td :class="schedule.daysToStart <= 0 ? (schedule.totals['A'].approved >= schedule.photosReq ? 'bg-success' : 'bg-danger') : ''">{{ schedule.totals["A"].approved }}</td>
											<td>
												<ul v-if="schedule.daysToStart <= 0" class="list-inline prod_color">
													<li><div :title="schedule.porcCurA + '%'" :class="'color bg-' + (schedule.porcCurA >= 100 ? 'green' : schedule.porcCurA >= 50 ? 'orange' : 'red')"></div></li>
												</ul>
											</td>
											<td :class="schedule.daysToStart <= 0 ? (schedule.totals['D'].approved >= schedule.photosReq ? 'bg-success' : 'bg-danger') : ''">{{ schedule.totals["D"].approved }}</td>
											<td>
												<ul v-if="schedule.daysToStart <= 0" class="list-inline prod_color">
													<li><div :title="schedule.porcCurD + '%'" :class="'color bg-' + (schedule.porcCurD >= 100 ? 'green' : schedule.porcCurD >= 50 ? 'orange' : 'red')"></div></li>
												</ul>
											</td>
											<td>
												<a @click="scheduleToExecuted(schedule, schedule.group.group_notification)" class="btn btn-primary btn-xs send-to-executed" data-schedule="' + schedule.id + '" data-group_notificacions="' + schedule.group.group_notification + '">
													<i class="fa fa-bullhorn"></i> Cambiar a Ejecutado
												</a>
											</td>
										</tr>
									</tbody>
								</table>
							
						</div>
						
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Listado Completo <small>({{ total }})</small></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="row">
					
						<div class="col-md-12 col-sm-12 col-xs-12" style="zoom:0.8;">
							<div class="x_content">
								<table class="table table-striped table-bordered projects">
									<!-- // 
									<thead>
										<tr>
											<th style="width: 1%">#</th>
											<th style="width: 20%">Microruta</th>
											<th>Lote</th>
											<th>Area</th>
											<th>Direccion(es)</th>
											<th>Cuadrilla</th>
											<th>????</th>
											<th>Proceso</th>
											<th>Estado</th>
											<th style="width: 20%">Acciones</th>
										</tr>
									</thead>
									-->
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12" style="zoom:0.8;">
							<div class="x_content">	
								<!-- // 
								<p class="text-muted font-13 m-b-30">
									The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
								</p>
								-->
								<table id="datatable-buttons2" class="table table-striped table-bordered"></table>
								<div id="demo_info"></div>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_content">
								<div id='calendar-box'></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade bs-gallery-photos-status-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel">Galería</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<template v-if="modalGallery.length > 0">
								<div class="col-md-55" v-for="(media, media_i) in modalGallery">
									<div class="thumbnail">
										<div class="image view view-first">
											<img style="width: 100%; display: block;" :src="media.file_path_short" alt="image" />
											<div class="mask">
												<div class="tools tools-bottom">
													<!-- // <a href="#"><i class="fa fa-times"></i></a> -->
													<a style="zoom:0.75;">{{ media.file_name }}</a>
												</div>
											</div>
										</div>
										<div class="caption">
											<p>{{ media.created }}</p>
											<p>
												<a :href="media.file_path_short" target="_blank"><i class="fa fa-link"></i></a>
												<a :href="media.file_path_short" download><i class="fa fa-download"></i></a>
												<a v-if="media.status == 0" @click="approveFile(media, media.type)"><i class="fa fa-check"></i></a>
												<a v-if="media.status == 0" @click="declineFile(media, media.type)"><i class="fa fa-times"></i></a>
											</p>
										</div>
									</div>
								</div>
							</template>
							<template v-else>
								<div class="col-md-12">
									<p>No hay Imagenes</p>
								</div>
							</template>
						</div>
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
	
</script>
<script>
function FormException(error, aviso){
	this.name = error;
	this.message = aviso;
};

var List = Vue.extend({
	template: '#list',
	data(){
		return {
			baseAreaCalc_m2_photos: 0.000986,
			minPhotosSpaceSmall: 8,
			options: {
				groups: [],
				periods: [],
			},
			filter: {
				period: 0,
				group: 0,
				year: moment().format('Y')
			},
			total: 0,
			records: [],
			dataTable: null,
			id_edit: null,
			calendar: null,
			events: [],
			modalGallery: [],
			
			
			
			groups: [],
			dateStart: moment(),
			dateEnd: moment(),
		};
	},
	created() {
		
	},
	mounted() {
		var self = this;
		
		self.loadOptions();
		//$( "#menu_toggle" ).click(function(event){ self.load();  });
		
		$( ".bs-gallery-photos-status-modal-lg" ).on('shown.bs.modal', function(event){
			var subDialog = bootbox.dialog({
				message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog"></i> Por favor espera mientras hacemos algo...</p>',
				closeButton: false
			});
			self.modalGallery = [];
			var schedule = $(event.relatedTarget).data('schedule');
			var type = $(event.relatedTarget).data('type');
			var status = $(event.relatedTarget).data('status');
			
			title = (status == 0) ? 'Pendientes' : (status == 1) ? 'Aprobados' : (status == 2) ? 'Rechazados' : 'Galeria';
			$('.bs-gallery-photos-status-modal-lg #myModalLabel').text(title);
			
			MV.api.readList('/reports_photographic', {
				filter: [
					'schedule,eq,' + schedule,
					'type,eq,' + type,
					'status,eq,' + status,
				],
				join: [
					'users',
					'schedule,microroutes',
					'schedule,users',
				]
			}, function(a){
				console.log(a);
				self.modalGallery = a;
				subDialog.modal('hide');
			})
		});
	},
	methods: {
		scheduleToExecuted(scheduleData, group_notificacions){
			var self = this;
			// console.log('schedule', scheduleData);
			schedule = (scheduleData.id !== undefined) ? scheduleData.id : 0;
			
			
			bootbox.confirm({
				message: "Deseas cambiar a ejecutado?.",
				locale: 'es',
				buttons: {
					confirm: {
						label: 'Pasar a Ejecutado',
						className: 'btn-success'
					},
					cancel: {
						label: 'Cerrar',
						className: 'btn-default'
					}
				},
				callback: function (result) {
					if(result === true){
					
						MV.api.readList('/notifications_groups_users', {
							filter: [
								'group,eq,' + group_notificacions
							],
						},function(IdsNots){
							MV.api.update('/schedule/' + schedule, {
								is_executed: 1,
								is_approved: 0,
								date_executed: moment().format('Y-MM-DD'),
								time_executed: moment().format('HH:mm:ss'),
								updated_by: <?= ($this->user->id); ?>
							},function(xs){
								self.createLogSchedule({
									schedule: schedule,
									action: 'event-executed',
									data: {
										is_executed: 1,
										is_approved: 0,
										date_executed: moment().format('Y-MM-DD'),
										time_executed: moment().format('HH:mm:ss'),
										updated_by: <?= ($this->user->id); ?>
									},
									response: xs,
								}, function(w){
									new PNotify({
										"title": "¡Éxito!",
										"text": "Actualizado con exito.",
										"styling":"bootstrap3",
										"type":"success",
										"icon":true,
										"animation":"zoom",
										"hide":true
									});
									
									MV.api.read('/schedule/' + schedule, {
										join: [
											'groups',
											'periods',
											'microroutes',
										]
									}, function(scheduleObj){
										IdsNots.forEach(function(abc){
											self.createNotification({
												user: abc.user,
												type: 'schedule-executed',
												data: scheduleObj,
											}, function(wsa){
												console.log(wsa)
												console.log('ID NOTIFICADO: ', abc.user);
											});
											
										});
										
										indexGroup = self.groups.findIndex((z) => z.id == scheduleData.group.id);
										if(indexGroup > -1){
											indexSchedule = self.groups[indexGroup].schedules.findIndex((x) => x.id == scheduleData.id);
											if(indexSchedule > -1){
												self.groups[indexGroup].schedules.splice(indexSchedule, 1);
											}
										}
										// self.load();
									});
								});
							});
						});
					}
				}
			});
			
		},
		progressHtml(total, color){
			var self = this;
			total = (total > 100) ? 100 : total;
			$html = '';
			try {
				$html += '<div title="' + parseInt(total) + '" class="progress-bar progress-bar-striped progress-bar-animated bg-' + color + '" role="progressbar" data-transitiongoal="' + total + '" aria-valuenow="' + total + '" aria-valuemin="0" aria-valuemax="100" style="width: ' + total + '%;height: 17px;"></div>';
				return $html;
			} catch(e){
				console.log(e);
				return "";
			}
		},
		createNotification(data, callb){
			var self = this;
			try{
				send = {};
					
				send.type = data.type;
				send.datajson = JSON.stringify(data.data);
				send.user = data.user;
				send.created_by = <?= $this->user->id; ?>;
				
				MV.api.create('/notifications', send, function (l){
					callb(l);
				});
			}
			catch(e){
				console.error(e);
				callb(e)
			}
		},
		declineFile(file, type){
			var self = this;
			try {
				console.log(file);
				var indexFile = self.modalGallery.findIndex((a) => a.id == file.id);
				console.log(indexFile);
				MV.apiFG.get('/index.php', { params: {
					controller: 'site',
					action: 'Report_Photo_NoPass',
					file_id: file.id
				}}).then(function (response) {
					self.createLogSchedule({
						schedule: file.schedule.id,
						action: 'declined-file',
						data: {
							controller: 'site',
							action: 'Report_Photo_Approve',
							file_id: file.id
						},
						response: response,
					}, function(w){
						self.createNotification({
							user: file.create_by.id,
							type: 'photographic-report-declined',
							data: file,
						}, function(w){
						});
						
						
						new PNotify({
							"title": "¡Éxito!",
							"text": "Se rechazo con éxito y se envio una notificacion al propietario.",
							"styling":"bootstrap3",
							"type":"success",
							"icon":true,
							"animation":"zoom",
							"hide":true
						});
						
						console.log(response);
						self.modalGallery.splice(indexFile, 1);
						$('#total-pendientes-'+type+'-' + file.schedule.id).html(parseInt($('#total-pendientes-'+type+'-' + file.schedule.id).html()) - 1);
						$('#total-rechazadas-'+type+'-' + file.schedule.id).html(parseInt($('#total-rechazadas-'+type+'-' + file.schedule.id).html()) + 1);
						
						/*
						bootbox.confirm({
							message: "Deseas enviar una notificacion por Whatsapp del rechazo?.",
							locale: 'es',
							buttons: {
								confirm: {
									label: 'Enviar',
									className: 'btn-success'
								},
								cancel: {
									label: 'Cerrar',
									className: 'btn-default'
								}
							},
							callback: function (result) {							if(result === true){
									urlWA = 'https://wa.me/57' + file.create_by.mobile + '?text=Se%20ha%20rechazado%20una%20FOTO' + '%20M:%20' + file.schedule.microroute.name + '.%0AIngresa%20a%20https%3A%2F%2Fmicuenta.monteverdeltda.com%20para%20gestionarla.';
									window.open(urlWA,'popUpWindow','height=500,width=600,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes');
								}
							}
						});
						*/
					});
				}).catch(function (error) {
					console.error(error);
					console.log(error.response);
				});
					
				}
				catch(e){
					console.log(e);
				}
		},
		approveFile(file, type){
			var self = this;
			try {
				console.log(file);
				var indexFile = self.modalGallery.findIndex((a) => a.id == file.id);
				console.log(indexFile);
				
				MV.apiFG.get('/index.php', { params: {
					controller: 'site',
					action: 'Report_Photo_Approve',
					file_id: file.id
				}}).then(function (response) {
					self.createLogSchedule({
						schedule: file.schedule.id,
						action: 'approved-file',
						data: {
							controller: 'site',
							action: 'Report_Photo_Approve',
							file_id: file.id
						},
						response: response,
					}, function(w){
						new PNotify({
							"title": "¡Éxito!",
							"text": "Aprobado con éxito",
							"styling":"bootstrap3",
							"type":"success",
							"icon":true,
							"animation":"zoom",
							"hide":true
						});
						self.modalGallery.splice(indexFile, 1);
						$('#total-pendientes-'+type+'-' + file.schedule.id).html(parseInt($('#total-pendientes-'+type+'-' + file.schedule.id).html()) - 1);
						$('#total-aprobadas-'+type+'-' + file.schedule.id).html(parseInt($('#total-aprobadas-'+type+'-' + file.schedule.id).html()) + 1);
					});
					//self.modalGallery[indexFile].status = 1;
					//self.modalGallery[indexFile].updated_by = <?= json_encode($this->user); ?>;
				}).catch(function (error) {
					console.error(error);
					console.log(error.response);
				});
			}
			catch(e){
				console.log(e);
			}
		},
		booleanToint(d, def){
			var def = (def !== undefined) ? def : 0;
			var self = this;
			if(d === true){ return 1; } 
			else if(d === false){ return 0; } 
			else { return def; }
		},
		intToboolean(d, def){
			var self = this;
			def = (def !== undefined) ? def : false;
			var self = this;
			if(d == 1){
				return true;
			} else if(d === 0){
				return false;
			} else {
				return def;
			}
		},
		jsonEvent(a){
			var self = this;
			var totalAntesPendientes = 0;
			var totalDespuesPendientes = 0;
			var totalAntesAprobadas = 0;
			var totalDespuesAprobadas = 0;
			var totalAntesDeclinadas = 0;
			var totalDespuesDeclinadas = 0;
			var totalProg = 0;
			var photosReq = (parseInt(parseFloat(a.microroute.area_m2) * self.baseAreaCalc_m2_photos) < self.minPhotosSpaceSmall) ? self.minPhotosSpaceSmall : parseInt(parseFloat(a.microroute.area_m2) * self.baseAreaCalc_m2_photos);
			
			a.reports_photographic.forEach(function(b){
				//console.log(b);
				sumaAp = (b.type.toUpperCase() == 'A' && b.status == 0) ? 1 : 0;
				sumaAa = (b.type.toUpperCase() == 'A' && b.status == 1) ? 1 : 0;
				sumaAd = (b.type.toUpperCase() == 'A' && b.status == 2) ? 1 : 0;
				sumaDp = (b.type.toUpperCase() == 'D' && b.status == 0) ? 1 : 0;
				sumaDa = (b.type.toUpperCase() == 'D' && b.status == 1) ? 1 : 0;
				sumaDd = (b.type.toUpperCase() == 'D' && b.status == 2) ? 1 : 0;

				totalAntesPendientes += sumaAp;
				totalDespuesPendientes += sumaDp;
				totalAntesAprobadas += sumaAa;
				totalDespuesAprobadas += sumaDa;
				totalAntesDeclinadas += sumaAd;
				totalDespuesDeclinadas += sumaDd;
			});
			var porcCurA = ((totalAntesAprobadas * 100) / photosReq);
			//var porcColorA = (porcCurA <= 49) ? 'gray' : (porcCurA <= 65) ? 'red' : (porcCurA < 100) ? 'orange' : 'green'; // 4 Colores
			var porcColorA = (porcCurA >= 100) ? 'green' : (porcCurA >= 50) ? 'orange' : 'red'; // 3 Colores
			
			var porcCurD = ((totalDespuesAprobadas * 100) / photosReq);
			//var porcColorD = (porcCurD <= 49) ? 'gray' : (porcCurD <= 65) ? 'red' : (porcCurD < 100) ? 'orange' : 'green'; // 4 Colores
			var porcColorD = (porcCurD >= 100) ? 'green' : (porcCurD >= 50) ? 'orange' : 'red'; // 3 Colores
			
			var ret = [];
			// baseAreaCalc_m2_photos
			
			ret.push(a.id);
			ret.push("<a>" + a.microroute.name + '</a>');
			ret.push(a.microroute.id_ref);
			ret.push(a.group.name);
			ret.push(a.date_executed_schedule + ':I');
			ret.push(a.date_executed_schedule_end + ':F');
			ret.push(a.microroute.area_m2.toLocaleString());
			ret.push(photosReq);
			ret.push(parseInt(porcCurA));
			ret.push('<div id="progress-A-' + a.id + '">' + self.progressHtml(porcCurA, porcColorA) + '</div>');
			ret.push('<span data-schedule="' + a.id + '" data-type="A" data-status="0" data-toggle="modal" data-target=".bs-gallery-photos-status-modal-lg" class="badge bg-blue"><i class="fa fa-circle"></i> <font id="total-pendientes-A-' + a.id + '">' + totalAntesPendientes + '</font></span>' 
				+ '<span data-schedule="' + a.id + '" data-type="A" data-status="1" data-toggle="modal" data-target=".bs-gallery-photos-status-modal-lg" class="badge bg-green"><i class="fa fa-thumbs-o-up"></i>  <font id="total-aprobadas-A-' + a.id + '">' + totalAntesAprobadas + '</font></span>' + 
				'<span data-schedule="' + a.id + '" data-type="A" data-status="2" data-toggle="modal" data-target=".bs-gallery-photos-status-modal-lg" class="badge bg-red"><i class="fa fa-thumbs-o-down"></i> <font id="total-rechazadas-A-' + a.id + '">' + totalAntesDeclinadas + '</font></span>');
			ret.push(parseInt(porcCurD));
			ret.push('<div id="progress-D-' + a.id + '">' + self.progressHtml(porcCurD, porcColorD) + '</div>');
			ret.push('<span data-schedule="' + a.id + '" data-type="D" data-status="0" data-toggle="modal" data-target=".bs-gallery-photos-status-modal-lg" class="badge bg-blue"><i class="fa fa-circle"></i> <font id="total-pendientes-D-' + a.id + '">' + totalDespuesPendientes + '</font></span>' 
				+ '<span data-schedule="' + a.id + '" data-type="D" data-status="1" data-toggle="modal" data-target=".bs-gallery-photos-status-modal-lg" class="badge bg-green"><i class="fa fa-thumbs-o-up"></i> <font id="total-aprobadas-D-' + a.id + '">' + totalDespuesAprobadas + '</font></span>' + 
				'<span data-schedule="' + a.id + '" data-type="D" data-status="2" data-toggle="modal" data-target=".bs-gallery-photos-status-modal-lg" class="badge bg-red"><i class="fa fa-thumbs-o-down"></i> <font id="total-rechazadas-D-' + a.id + '">' + totalDespuesDeclinadas + '</font></span>');
			
			/*ret.push(
				(a.is_executed == 0 && a.is_approved == 0) ? '<a href="#" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Mover a Ejecutado </a>' : 
					(a.is_executed == 1 && a.is_approved == 0) ? ' <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Aprobar </a>' : 
						(a.is_executed == 1 && a.is_approved == 1) ? '<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> ABROBADO!! </a>' 
							: 'INFORMACION SIN PARAMETRIZAR'
			);*/
			ret.push(
				(a.is_executed == 0 && a.is_approved == 0) ? '<a class="btn btn-primary btn-xs send-to-executed" data-schedule="' + a.id + '" data-group_notificacions="' + a.group.group_notification + '"><i class="fa fa-check"></i> Ejecutado </a>' : ''
			);
			//console.log('ret', ret);
			return ret;
		},
		createLogSchedule(data, callb){
			var self = this;
			try{
				send = {};
				send.schedule = data.schedule;
				send.action = data.action;
				send.data_in = JSON.stringify(data.data);
				send.data_out = JSON.stringify(data.response);
				send.created_by = <?= $this->user->id; ?>;
				api.post('/records/schedule_log', send).then(function (l){
					if(l.status == 200){ callb(l); } 
					else { throw new FormException('error_create_log', 'No se pudo crear el LOG.'); }
				}).catch(function (e) {
					callb(e);
					return e;
				});
			}
			catch(e){
				console.error(e);
				callb(e)
			}
		},
		loadOptions(){
			var self = this;
			var subDialog = bootbox.dialog({
				message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog"></i> Por favor espera mientras hacemos algo...</p>',
				closeButton: false
			});
			
			MV.api.readList('periods', {}, function(a){
				self.options.periods = a;
				a.forEach(function(x){
					if(x.start_month == moment().format('M') || x.end_month == moment().format('M')){
						var startDate   = moment(x.start + '/' + self.filter.year, "DD/MM/YYYY");
						var endDate     = moment(x.end + '/' + self.filter.year, "DD/MM/YYYY");
						var compareDate = moment();
						result = compareDate.isBetween(startDate, endDate);
						if(result == true){
							self.filter.period = x.id;
							dateStart = moment(x.start + '/' + moment().format('YYYY'));
							// console.log('dateStart', dateStart);
							self.dateStart = startDate;
							self.dateEnd = endDate;
						}
					}
				});
				MV.api.readList('groups', {}, function(b){				
					self.options.groups = b;
					subDialog.modal('hide');
					self.load();
				});
			});
		},
		load(){
			var self = this;
			self.loading = true;
			self.records = [];
			self.total = 0;
			
			var dialog = bootbox.dialog({
				message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog"></i> Por favor espera mientras hacemos algo...</p>',
				closeButton: false
			});
			
			dateSt = self.dateStart.format('YYYY-MM-DD');
			dataEnd = self.dateEnd.format('YYYY-MM-DD');
			dataEn = moment().add({ days: 1 }).format('YYYY-MM-DD');
			
			console.log('Filtro inicio. ', dateSt);
			console.log('Filtro fin. ', dataEn);
			console.log('Filtro fin. ', dataEnd);
			console.log('Filtro. ', 'date_executed_schedule,bt,' + dateSt + ',' + dataEn);
			
			
			
			MV.api.readList('/schedule', {
				join: [
					'microroutes',
					'microroutes,groups',
					'microroutes,periods',
					'groups',
					'periods',
					'reports_photographic',
				],
				filter: [
					'period,eq,' + self.filter.period,
					'year,eq,' + self.filter.year,
					'is_executed,in,0',
					// 'date_executed_schedule,ge,' + ,
					'date_executed_schedule,bt,' + dateSt + ',' + dataEn,
					'date_executed_schedule_end,bt,' + dateSt + ',' + dataEnd,
				],
				order: 'group,asc'
			}, (a) => {
				dialog.modal('hide');
				self.total = a.length;
				self.records = a;
				dialog.modal('hide');
				// console.log('a', a);
				
				a.forEach((b) => {
					b_i = self.groups.findIndex((z) => z.id == b.group.id);
					// console.log(b_i);
					if(b_i > -1){
						// self.groups[b_i].schedules.push(b);
					} 
					else {
						MeSchedules = [];
						self.groups.push({
							id: b.group.id,
							name: b.group.name,
							group_notification: b.group.group_notification,
							schedules: []
						});
						
					}
					b_i = self.groups.findIndex((z) => z.id == b.group.id);
					if(b_i > -1){
						var totalAntesPendientes = 0;
						var totalDespuesPendientes = 0;
						var totalAntesAprobadas = 0;
						var totalDespuesAprobadas = 0;
						var totalAntesDeclinadas = 0;
						var totalDespuesDeclinadas = 0;
						var totalProg = 0;
						var photosReq = (parseInt(parseFloat(b.microroute.area_m2) * self.baseAreaCalc_m2_photos) < self.minPhotosSpaceSmall) ? self.minPhotosSpaceSmall : parseInt(parseFloat(b.microroute.area_m2) * self.baseAreaCalc_m2_photos);
						b.photosReq = photosReq;
						
						b.reports_photographic.forEach(function(c){
							sumaAp = (c.type.toUpperCase() == 'A' && c.status == 0) ? 1 : 0;
							sumaAa = (c.type.toUpperCase() == 'A' && c.status == 1) ? 1 : 0;
							sumaAd = (c.type.toUpperCase() == 'A' && c.status == 2) ? 1 : 0;
							sumaDp = (c.type.toUpperCase() == 'D' && c.status == 0) ? 1 : 0;
							sumaDa = (c.type.toUpperCase() == 'D' && c.status == 1) ? 1 : 0;
							sumaDd = (c.type.toUpperCase() == 'D' && c.status == 2) ? 1 : 0;

							totalAntesPendientes += sumaAp;
							totalDespuesPendientes += sumaDp;
							totalAntesAprobadas += sumaAa;
							totalDespuesAprobadas += sumaDa;
							totalAntesDeclinadas += sumaAd;
							totalDespuesDeclinadas += sumaDd;
						});
						var porcCurA = ((totalAntesAprobadas * 100) / photosReq);
						//var porcColorA = (porcCurA <= 49) ? 'gray' : (porcCurA <= 65) ? 'red' : (porcCurA < 100) ? 'orange' : 'green'; // 4 Colores
						var porcColorA = (porcCurA >= 100) ? 'green' : (porcCurA >= 50) ? 'orange' : 'red'; // 3 Colores
						
						var porcCurD = ((totalDespuesAprobadas * 100) / photosReq);
						//var porcColorD = (porcCurD <= 49) ? 'gray' : (porcCurD <= 65) ? 'red' : (porcCurD < 100) ? 'orange' : 'green'; // 4 Colores
						var porcColorD = (porcCurD >= 100) ? 'green' : (porcCurD >= 50) ? 'orange' : 'red'; // 3 Colores
						
						b.porcCurA = porcCurA;
						b.porcCurD = porcCurD;
						b.totals = {
							"A": {
								pending: totalAntesPendientes,
								approved: totalAntesAprobadas,
								declined: totalAntesDeclinadas,
							},
							"D": {
								pending: totalDespuesPendientes,
								approved: totalDespuesAprobadas,
								declined: totalDespuesDeclinadas,
							},
						};
						
						//totalDays = moment(b.date_executed_schedule).diff(moment(), 'days');
						
						b.daysToStart = parseInt(moment(b.date_executed_schedule).diff(moment(), 'days'));
						b.daysToEnd = parseInt(moment(b.date_executed_schedule_end).diff(moment(), 'days'));
						totalDays = b.daysToEnd - b.daysToStart;
						
						// b.classText = 'bg-' + ((b.is_executed == 0 && totalDays < -1) ? 'danger' : b.is_approved == 1 ? 'success' : b.in_novelty == 1 ? 'secondary' : b.is_executed == 1 ? 'primary' : 'default');
						//b.classText = 'bg-' + ((b.is_executed == 0 && totalDays < -1) ? ((b.totals["A"].approved >= photosReq && b.totals["D"].approved >= photosReq) ? 'success' : (b.totals["A"].approved >= photosReq || b.totals["D"].approved >= photosReq) ? 'warning' : 'danger') : (b.is_executed == 0 && totalDays < 0) ? 'info' : 'default');
						
						b.classText = (b.daysToStart <= 0) ? (
							(b.totals["A"].approved >= photosReq && b.totals["D"].approved >= photosReq) 
								? 'bg-success' 
								: (b.totals["A"].approved >= photosReq || b.totals["D"].approved >= photosReq) 
									? 'bg-warning' 
									: 'bg-danger'
						)  : 'bg-default';
						
						b.activeColors = (b.daysToStart <= 0 && b.daysToEnd >= 0) ? true : (b.daysToEnd <= 0) ? true : false;
						

						self.groups[b_i].schedules.push(b);
					}
					
				});
				
				self.dataTable = $('.projects')
					.DataTable({
						destroy: true,
						//responsive: true,
						dom: "Blfrtip",
						buttons: [ { extend: "copy", className: "btn-sm" }, { extend: "csv", className: "btn-sm" }, { extend: "excel", className: "btn-sm" }, { extend: "pdfHtml5", className: "btn-sm" }, { extend: "print", className: "btn-sm" }, ],
						language: { "url": "/public/assets/build/js/lang-datatable.json" },
						// data: self.records,
						fixedHeader: true,
						data: a.map(function(v){ return self.jsonEvent(v); }),
						rowReorder: true,
						columns: [
							{ title: "#" },
							{ title: "Microruta" },
							{ title: "Lote" },
							{ title: "Cuadrilla" },
							{ title: "Fec. Inicio" },
							{ title: "Fec. Fin" },
							{ title: "Area m2" },
							{ title: "Req." },
							{ title: "% Ant." },
							{ title: "Proceso Ant." },
							{ title: "F. Ant" },
							{ title: "% Desp." },
							{ title: "Proceso Desp." },
							{ title: "T. Desp" },
							{ title: "Acciones" },
						],
						initComplete: function( settings, json ) {
							//self.loadEvents();
							var apiTables = this.api();
							
						}
					}).on( 'order.dt', function () {

						$.each( $(".send-to-executed"), function(i,o) {
							$(o).attr("onclick", "").unbind("click");
							$(o).click(function(event){								
								var schedule_obj = null;
								var schedule = $(this).data('schedule');
								var group_notificacions = $(this).data('group_notificacions');
								if(schedule !== undefined && schedule > 0 && schedule !== undefined && schedule > 0){
									bootbox.confirm({
										message: "Deseas cambiar a ejecutado?.",
										locale: 'es',
										buttons: {
											confirm: {
												label: 'Pasar a Ejecutado',
												className: 'btn-success'
											},
											cancel: {
												label: 'Cerrar',
												className: 'btn-default'
											}
										},
										callback: function (result) {
											if(result === true){
											
												MV.api.readList('/notifications_groups_users', {
													filter: [
														'group,eq,' + group_notificacions
													],
												},function(IdsNots){
													MV.api.update('/schedule/' + schedule, {
														is_executed: 1,
														is_approved: 0,
														date_executed: moment().format('Y-MM-DD'),
														time_executed: moment().format('HH:mm:ss'),
														updated_by: <?= ($this->user->id); ?>
													},function(xs){
														self.createLogSchedule({
															schedule: schedule,
															action: 'event-executed',
															data: {
																is_executed: 1,
																is_approved: 0,
																date_executed: moment().format('Y-MM-DD'),
																time_executed: moment().format('HH:mm:ss'),
																updated_by: <?= ($this->user->id); ?>
															},
															response: xs,
														}, function(w){
															new PNotify({
																"title": "¡Éxito!",
																"text": "Actualizado con exito.",
																"styling":"bootstrap3",
																"type":"success",
																"icon":true,
																"animation":"zoom",
																"hide":true
															});
															
															MV.api.read('/schedule/' + schedule, {
																join: [
																	'groups',
																	'periods',
																	'microroutes',
																]
															}, function(scheduleObj){
																IdsNots.forEach(function(abc){
																	self.createNotification({
																		user: abc.user,
																		type: 'schedule-executed',
																		data: scheduleObj,
																	}, function(wsa){
																		// console.log(wsa)
																		console.log('ID NOTIFICADO: ', abc.user);
																	});
																});
															
																self.load();
															});
														});
													});
												});
											}
										}
									});
									
								}
							});
						});
						
					});
			});
			
		},
	}
});

var router = new VueRouter({
	linkActiveClass: 'active',
	routes:[
		{ path: '/', component: List, name: 'Home' },
	]
});

app = new Vue({
	router: router,
	data: function () {
		return {};
	},
	methods: {
	}
}).$mount('#emvarias-microroutes');
</script>
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

.fc-listMonth-view .fc-scroller, .fc-list-view .fc-scroller {
	min-height: 500px !important;
}

.popover-content {
	zoom: 0.8;
}

</style>


<div id="emvarias-microroutes">
	<div class="clearfix"></div>
	
	<div class="row">
		<router-view :key="$route.fullPath" ></router-view>
	</div>
</div>

<template id="list">
	<div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><?= $title; ?><small></small></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-12">Periodo</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<select @change="loadEvents" v-model="formCreate.period" class="select2_single form-control" tabindex="-1" disabled>
										<option value="0">Seleccione una opcion</option>
										<option v-for="(option, i_option) in options.periods" :value="option.id">{{ option.name }}</option>
									</select>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input readonly="" @change="loadEvents" v-model="formCreate.year" id="birthday" class="date-picker form-control col-md-7 col-xs-12" min="2018" required="required" type="number">
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Grupo</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<select @change="loadEvents" v-model="formCreate.group" class="select2_single form-control" tabindex="-1">
										<option value="0">Seleccione una opcion</option>
										<option v-for="(option, i_option) in options.groups" :value="option.id">{{ option.name }}</option>
									</select>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<div id='calendar-box'></div>
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
			options: {
				groups: [],
				periods: [],
			},
			total: 0,
			records: [],
			dataTable: null,
			formCreate: {
				microroute: 0,
				year: moment().format('Y'),
				period: 0,
				group: 0,
				date_executed_schedule: '',
				date_executed_schedule_end: '',
				created_by: "<?= $this->user->id; ?>"
			},
			id_edit: null,
			calendar: null,
			events: [],
		};
	},
	created: function () {},
	computed: {
		startDatePicket(){
			var self = this;
			var x = self.options.periods.find((x) => x.id == self.formCreate.period);
			var startDate   = moment(x.start + '/' + self.formCreate.year, "DD/MM/YYYY");
			var endDate     = moment(x.end + '/' + self.formCreate.year, "DD/MM/YYYY");
			var compareDate = moment();
			result = compareDate.isBetween(startDate, endDate);
			return new Date(startDate.format('Y'), (startDate.format('M')-1), (startDate.format('D')));
		},
		endDatePicket(){
			var self = this;
			var x = self.options.periods.find((x) => x.id == self.formCreate.period);
			var startDate   = moment(x.start + '/' + self.formCreate.year, "DD/MM/YYYY");
			var endDate     = moment(x.end + '/' + self.formCreate.year, "DD/MM/YYYY");
			var compareDate = moment();
			result = compareDate.isBetween(startDate, endDate);
			return new Date(endDate.format('Y'), (endDate.format('M')-1), (endDate.format('D')-1));
		},
	},
	mounted: function () {
		var self = this;
		
		self.loadOptions();
	},
	methods: {
		changeDatesInputs(){
			var self = this;
			var x = self.options.periods.find((x) => x.id == self.formCreate.period);
			if(x.start_month && x.end_month){
				var startDate   = moment(x.start + '/' + self.formCreate.year, "DD/MM/YYYY");
				var endDate     = moment(x.end + '/' + self.formCreate.year, "DD/MM/YYYY");
				var compareDate = moment();
				result = compareDate.isBetween(startDate, endDate);
				$('#example1').datepicker('destroy').datepicker({
					minDate: self.startDatePicket,
					maxDate: self.endDatePicket,
					dateFormat: "yy-mm-dd"
				}).change(function() {
					self.formCreate.date_executed_schedule = $(this).val();
					$('#example2').datepicker('destroy').datepicker({
						minDate: $(this).val(),
						maxDate: self.endDatePicket,
						dateFormat: "yy-mm-dd"
					}).change(function() {
						self.formCreate.date_executed_schedule_end = $(this).val();
					});
				});
				$('#example2').datepicker('destroy').datepicker({
					minDate: self.startDatePicket,
					maxDate: self.endDatePicket,
					dateFormat: "yy-mm-dd"
				}).change(function() {
					self.formCreate.date_executed_schedule_end = $(this).val();
				});
			}
		},
		loadEvents(){
			var self = this;
			console.log('loadEvents');
			$('#calendar-box').fullCalendar( 'removeEventSource', self.events );
			self.events = [];
			if(self.formCreate.year > 1950 && self.formCreate.period)
			{
				self.changeDatesInputs();
				self.init_calendar();
			}
			if(self.formCreate.year > 1950 && self.formCreate.period > 0 && self.formCreate.group > 0)
			{
				MV.api.readList('/schedule', {
					join: [
						'microroutes',
						'period',
						'group',
						'users'
					],
					filter: [
						'year,eq,' + self.formCreate.year,
						'period,eq,' + self.formCreate.period,
						'group,eq,' + self.formCreate.group,
					]
				}, function(a){
					events = [];
					a.forEach(function(ab){
						events.push(self.jsonEvent(ab));
					})
					self.events = events;
					//$('#calendar-box').fullCalendar( 'addEventSource', events );
					$('#calendar-box').fullCalendar( 'gotoDate', self.startDatePicket );
				});				
			}
		},
		booleanToint(d, def){
			def = (def !== undefined) ? def : 0;
			var self = this;
			if(d === true){
				return 1;
			} else if(d === false){
				return 0;
			} else {
				return def;
			}
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
		init_calendar(){
			var self = this;
			if( typeof ($.fn.fullCalendar) === 'undefined'){ return; }
			console.log(('init_calendar'));
				
			var date = new Date(),
				d = date.getDate(),
				m = date.getMonth(),
				y = date.getFullYear(),
				started,
				categoryClass;
				
			if(self.calendar !== null){
				self.calendar.fullCalendar('destroy')
			}
			var calendar = self.calendar = $('#calendar-box').fullCalendar({
				dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
				dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
				monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
				monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
				buttonText: { today:    'Hoy', month:    'Mes', week:     'Semana', day:      'Día', list:     'Lista' },
				defaultButtonText: { prev: "Anterior", next: "Siguiente", prevYear: "Ant Año", nextYear: "Sig Año", today: 'Hoy', month: 'mes', week: 'Semana', day: 'Día', timelineMonth: 'Gantt' },
				defaultView: 'timelineMonth',
				timeZone: 'UTC',
				editable: false,
				droppable: false,
				selectable: false,
				selectHelper: true,
				visibleRange: {
					start: self.startDatePicket,
					end: self.endDatePicket
				},
				dateAlignment: self.startDatePicket,
				defaultDate: self.startDatePicket,
				header: {
					// left: 'prev,next today timelineDay,timelineWeek,timelineMonth,timelineYear',
					left: 'prev,next today timelineMonth',
					center: 'title',
					// right: 'month,agendaWeek,listMonth,agendaDay'
					right: 'month,agendaWeek,listMonth'
				},
				events: function(start, end, timezone, callback) {
					MV.api.read('/schedule', {
						join: [
							'microroutes',
							'period',
							'group',
							'users'
						],
						filter: [
							'year,eq,' + self.formCreate.year,
							'period,eq,' + self.formCreate.period,
							'group,eq,' + self.formCreate.group,
						]
					}, function(rb){
						console.log('rb',rb);
						events = [];
						rb.forEach(function(ab){
							events.push(self.jsonEvent(ab));
						})
						callback(events);
					});
				},
				eventRender: function(eventObj, element) {
					element.popover({
					  title: eventObj.title + ' | ' + eventObj.microroute.address_text + ' | ' + eventObj.microroute.area_m2.toLocaleString() + ' m2',
					  content: eventObj.microroute.description,
					  trigger: 'hover',
					  placement: 'top',
					  container: 'body'
					});
					
					element.click(function(e) {
						if (e.which === 1) {
							//$('.popover.fade.top').remove();
						}
						
					});
					element.mousemove(function(e) {
						if (e.which === 1) {
							$('.popover.fade.top').remove();
						}
					});
				},
				dayClick: function (date, jsEvent, view, resourceOb) {
					dateStart = dateEnd = date;
					// dateEnd = date.add({ days: 1 });
					self.formCreate.date_executed_schedule = dateStart.format('YYYY-MM-DD');
					self.formCreate.date_executed_schedule_end = dateEnd.format('YYYY-MM-DD');
					$('#example1').val(self.formCreate.date_executed_schedule);
					$('#example2').val(self.formCreate.date_executed_schedule_end);
				},
				select: function( start, end, jsEvent, view, resourceOb){
					dateStart = start;
					dateEnd = end.subtract({ days: 1 });
					self.formCreate.date_executed_schedule = dateStart.format('YYYY-MM-DD');
					self.formCreate.date_executed_schedule_end = dateEnd.format('YYYY-MM-DD');
					$('#example1').val(self.formCreate.date_executed_schedule);
					$('#example2').val(self.formCreate.date_executed_schedule_end);
				},
				
				eventDrop: function(event, delta, revertFunc, jsEvent, ui, view) {
					if (!confirm("Desea modificar la fecha de este evento?")) {
						revertFunc();
					} else {
						if(moment().diff(event.start, 'days') > 0){
							alert('No puedes modificar el evento antes de hoy.');
							revertFunc();
						} else {
							var subDialog = bootbox.dialog({
								message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog"></i> Por favor espera mientras hacemos algo...</p>',
								closeButton: false
							});
							if(event.id > 0){
								event.color = 'gray';
								event.date_executed_schedule = event.start.format('YYYY-MM-DD');
								
								MV.api.update('/schedule/' + event.id, {
									id: event.id,
									date_executed_schedule: event.start.format('YYYY-MM-DD'),
									date_executed_schedule_end:  event.end.toISOString(),
									updated_by: <?= $this->user->id; ?>
								},(b) => {
									if(b > 0){
										self.createLogSchedule({
											schedule: event.id,
											action: 'edit',
											data: {
												id: event.id,
												date_executed_schedule_end: event.end.format('YYYY-MM-DD'),
												date_executed_schedule: event.start.format('YYYY-MM-DD'),
												updated_by: <?= $this->user->id; ?>
											},
											response: b,
										}, function(w){
											event.date_executed_schedule = event.start.format('YYYY-MM-DD');
											event.date_executed_schedule_end = event.end.format('YYYY-MM-DD');
											
											new PNotify({
												"title": "¡Éxito!",
												"text": "Modificado con éxito",
												"styling":"bootstrap3",
												"type":"success",
												"icon":true,
												"animation":"zoom",
												"hide":true
											});
											
										});
									}
									else {
										self.createLogSchedule({
											schedule: event.id,
											action: 'edit-error',
											data: {
												id: event.id,
												group: event.resourceId,
												date_executed_schedule: event.start.format('YYYY-MM-DD'),
												updated_by: <?= $this->user->id; ?>
											},
											response: e.response,
										}, function(w){
											revertFunc();
										});
									}
									subDialog.modal('hide');
								});
								
							} else {
								revertFunc();
							}
						}
					}
				},
				// events: [{title: 'All Day Event',start: new Date(y, m, 1)}, {title: 'Long Event',start: new Date(y, m, d - 5),end: new Date(y, m, d - 2)}, {title: 'Meeting',start: new Date(y, m, d, 10, 30),allDay: false}, {title: 'Lunch',start: new Date(y, m, d + 14, 12, 0),end: new Date(y, m, d, 14, 0),allDay: false}, {title: 'Birthday Party',start: new Date(y, m, d + 1, 19, 0),end: new Date(y, m, d + 1, 22, 30),allDay: false}, {title: 'Click for Google',start: new Date(y, m, 28),end: new Date(y, m, 29),url: 'http://google.com/'}]
			});
		},
		jsonEvent(a){
			var self = this;
			//a.editable = (a.editable == 1) ? 1 : (a.created_by.id === undefined && a.created_by == '<?= $this->user->id; ?>') ? 1 : (a.created_by.id !== undefined && a.created_by.id == '<?= $this->user->id; ?>') ? 1 : 0;
			//a['100_events_staff'].forEach(function(b){ a.editable = (b.isAdmin == 1) ? 1 : a.editable; });
			a.title = (a.microroute.name);
			a.start = moment(a.date_executed_schedule);
			a.end = moment(a.date_executed_schedule_end);
			
			totalDays = a.start.diff(moment(), 'days');
			console.log('a.start', a.start.format('YYYY-MM-DD'));
			console.log('totalDays', totalDays);
			
			if(totalDays > -1 || (a.is_executed == 0 && totalDays < -1)){
				a.editable = self.intToboolean(1);
			} else {
				a.editable = self.intToboolean(0);
			}
			
			
			a.color = (a.is_executed == 0 && totalDays < -1) ? '#f44336' : a.is_approved == 1 ? '#8bc34a' : a.is_executed == 1 ? '#638bab' : 'gray';
			
			
			
			a.editable = self.intToboolean(0);
			a.allDay = self.intToboolean(0);
			return a;
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
				api.post('/records/schedule_log', send)
				.then(function (l){
					if(l.status == 200){
						callb(l);
					} else {
						throw new FormException('error_create_log', 'No se pudo crear el LOG.');
					}
				})
				.catch(function (e) {
					callb(e);
					return e;
				});
			}
			catch(e){
				console.error(e);
				callb(e)
			}
		},
		createSchedule(){
			var self = this;
			try{
				if(
					self.formCreate.microroute > 0
					&& self.formCreate.year > 1950
					&& self.formCreate.period > 0
					&& self.formCreate.group > 0
					&& self.formCreate.date_executed_schedule !== ''
					&& self.formCreate.date_executed_schedule_end !== ''
					&& self.formCreate.created_by > 0
				){
					console.log('Completo', self.formCreate);
					var asx = self.formCreate.date_executed_schedule_end;
					self.formCreate.date_executed_schedule_end = moment(self.formCreate.date_executed_schedule_end).add({ days: 1 }).format('YYYY-MM-DD');
					
					bootbox.confirm({
						message: "Confirma antes de agregar.",
						locale: 'es',
						callback: function (result) {
							if(result !== null){
								if(result == true){
					
									MV.api.create('/schedule', self.formCreate, function(a){
										if(parseInt(a) > 0){
											self.createLogSchedule({
												schedule: a,
												action: 'create-event',
												data: self.formCreate,
												response: a,
											}, function(w){
												self.formCreate.date_executed_schedule_end = asx;
												new PNotify({
													"title": "¡Éxito!",
													"text": "Creada con éxito",
													"styling":"bootstrap3",
													"type":"success",
													"icon":true,
													"animation":"zoom",
													"hide":true
												});
												
												self.loadEvents();
											})
												
										}
									});
								} else {
								}
							}
						}
					});
				} else {
					console.log('Formulario incompleto');
					new PNotify({
						"title": "¡ups!",
						"text": "Formulario incompleto",
						"styling":"bootstrap3",
						"type":"error",
						"icon":true,
						"animation":"zoom",
						"hide":true
					});
				}
			}catch(e){
				console.error(e);
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
						var startDate   = moment(x.start + '/' + self.formCreate.year, "DD/MM/YYYY");
						var endDate     = moment(x.end + '/' + self.formCreate.year, "DD/MM/YYYY");
						var compareDate = moment();
						result = compareDate.isBetween(startDate, endDate);
						if(result == true){
							self.formCreate.period = x.id;
							// console.log('x', x); // console.log('startDate', startDate); // console.log('endDate', endDate); // console.log('compareDate', compareDate); // console.log('result', result);
							
							$('#example1').datepicker({
								minDate: self.startDatePicket,
								maxDate: self.endDatePicket,
								dateFormat: "yy-mm-dd"
							});
							
							$('#example2').datepicker({
								minDate: self.startDatePicket,
								maxDate: self.endDatePicket,
								dateFormat: "yy-mm-dd"
							});
							
							$('#example2').change(function() {
								self.formCreate.date_executed_schedule_end = $('#example2').val();
							})
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
			window.scrollTo(0, 0);
			
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
		zfill(number, width) {
			var numberOutput = Math.abs(number);
			var length = number.toString().length;
			var zero = "0";
			if (width <= length) {
				if (number < 0) { return ("-" + numberOutput.toString()); }
				else { return numberOutput.toString(); }
			} else {
				if (number < 0) { return ("-" + (zero.repeat(width - length)) + numberOutput.toString()); }
				else { return ((zero.repeat(width - length)) + numberOutput.toString()); }
			}
		},
		formatMoney(number, decPlaces, decSep, thouSep) {
			decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
			decSep = typeof decSep === "undefined" ? "." : decSep;
			thouSep = typeof thouSep === "undefined" ? "," : thouSep;
			var sign = number < 0 ? "-" : "";
			var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
			var j = (j = i.length) > 3 ? j % 3 : 0;
			return sign + (j ? i.substr(0, j) + thouSep : "") + i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) + (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
		},
	}
}).$mount('#emvarias-microroutes');
</script>
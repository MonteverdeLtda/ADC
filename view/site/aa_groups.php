<link href='https://unpkg.com/fullcalendar-scheduler@1.10.0/dist/scheduler.min.css' rel='stylesheet' /> 
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/redmond/jquery-ui.css" rel="stylesheet" />
<script src='https://unpkg.com/fullcalendar@3.10.1/dist/fullcalendar.min.js'></script>
<script src='https://unpkg.com/fullcalendar-scheduler@1.10.0/dist/scheduler.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
<style>
ul.quick-list {
	width: 100%;
}
.fc-license-message {
	display: none;
}
</style>

<div id="app-groups_microroutes">
	<div class="page-title">
		<div class="title_left">
			<!-- // <h3><?= $title; ?> <small><?= $subtitle; ?></small></h3> -->
		</div>
		<div class="title_right">
		</div>
	</div>
	<div class="clearfix"></div>
	
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" v-for="(group, group_i) in aa_groups">
			<div class="x_panel">
				<div class="x_title">
					<h2 style="zoom:0.8;">{{ group.name }} <small></small></h2>
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
					<div class="dashboard-widget-content">
						<ul class="quick-list">
							<li style="cursor:pointer;" data-toggle="modal" data-target=".bs-modal-info-basic" @click="modals.basic = group">
								<i class="fa fa-sort-amount-desc"></i>
								<a href="#">Informacion Básica</a>
							</li>
							<li style="cursor:pointer;" data-toggle="modal" data-target=".bs-modal-staff-group" @click="modals.staff.aa_groups_staff = group.aa_groups_staff">
								<i class="fa fa-users"></i>
								<a>{{ group.aa_groups_staff.length }} Integrante(s)</a>
							</li>
							<li style="cursor:pointer;" data-toggle="modal" data-target=".bs-modal-microroutes-in-group" @click="modals.microroutes.aa_groups_microroutes = group.aa_groups_microroutes">
								<i class="fa fa-code-fork"></i>
								<a href="#">{{ group.aa_groups_microroutes.length }} Microrutas Asignadas</a>
							</li>
							<li style="cursor:pointer;" data-toggle="modal" data-target=".bs-modal-managers-group" @click="modals.managers.aa_groups_managers = group.aa_groups_managers">
								<i class="fa fa-bell"></i>
								<a href="#">Gestores ({{ group.aa_groups_managers.length }}) </a>
							</li>
							<li style="cursor:pointer;" data-toggle="modal" data-target=".bs-modal-microroutes-programming" @click="modals.microroutes_programming.aa_groups_microroutes = group.aa_groups_microroutes">
								<i class="fa fa-calendar"></i>
								<a href="#">Crear Programacion </a>
							</li>
							<!-- // 
							<li>
								<i class="fa fa-area-chart"></i>
								<a href="#">Logout</a>
							</li>
							-->
						</ul>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade bs-modal-info-basic" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Grupo # {{ modals.basic.id }} | {{ modals.basic.name }}</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<label class="control-label col-xs-12">
										{{ modals.basic.name }}
											<a class="color blue" @click="fastChangeNameGroup"><i class="fa fa-pencil"></i></a>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Área Max por día</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<label class="control-label col-xs-12">
										{{ modals.basic.max_area_for_day }}
											<a class="color blue" @click="fastChangeMaxAreaForDayGroup"><i class="fa fa-exchange"></i></a>
									</label>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label col-xs-12">Operario(s)</label>
									<div class="col-xs-12">
										<label class="control-label col-xs-12 text-center">
											{{ modals.basic.operators }}
											<a class="color blue pull-right" @click="changeToolsInGroup('operators', modals.basic.operators)"><i class="fa fa-exchange"></i></a>
										</label>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label col-xs-12">Conductor(es)</label>
									<div class="col-xs-12">
										<label class="control-label col-xs-12 text-center">
											{{ modals.basic.drivers }}
											<a class="color blue pull-right" @click="changeToolsInGroup('drivers', modals.basic.drivers)"><i class="fa fa-exchange"></i></a>
										</label>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label col-xs-12">Guadañador(es)</label>
									<div class="col-xs-12">
										<label class="control-label col-xs-12 text-center">
											{{ modals.basic.scythes }}
											<a class="color blue pull-right" @click="changeToolsInGroup('scythes', modals.basic.scythes)"><i class="fa fa-exchange"></i></a>
										</label>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label col-xs-12">Auxiliar(es)</label>
									<div class="col-xs-12">
										<label class="control-label col-xs-12 text-center">
											{{ modals.basic.auxiliary }}
											<a class="color blue pull-right" @click="changeToolsInGroup('auxiliary', modals.basic.auxiliary)"><i class="fa fa-exchange"></i></a>
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade bs-modal-staff-group" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Staff de Grupo ({{ modals.staff.aa_groups_staff.length }})</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 text-center">
							<ul class="pagination pagination-split">
								<li><a href="#">Agregar</a></li>
							</ul>
						</div>
						<div class="clearfix"></div>
						
						<div class="col-xs-12">
							<div class="">
								<table class="table table-bordered">
									<tr v-for="(groups_staff, groups_staff_i) in modals.staff.aa_groups_staff">
										<td>{{ groups_staff.name }}</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade bs-modal-managers-group" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Gestores del Grupo ({{ modals.managers.aa_groups_managers.length }})</h4>
				</div>
				<div class="modal-body">
					
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 text-center">
							<ul class="pagination pagination-split">
								<li><a href="#">Agregar</a></li>
							</ul>
						</div>
						<div class="clearfix"></div>
						
						<div class="col-md-4 col-sm-6 col-xs-12 profile_details" v-for="(group_manager, group_manager_i) in modals.managers.aa_groups_managers">
							<div class="well profile_view">
								<div class="col-sm-12">
									<h4 class="brief"><i>{{ group_manager.user.username }}</i></h4>
									<div class="left">
										<h4>{{ group_manager.user.names }} {{ group_manager.user.surname }}</h4>
										<p><strong>Correo Electronico: </strong> {{ group_manager.user.email }} </p>
										<ul class="list-unstyled">
											<li><i class="fa fa-building"></i> Dirección: {{ group_manager.user.address }}</li>
											<li><i class="fa fa-phone"></i> Teléfono/Móvil: {{ group_manager.user.phone }} / {{ group_manager.user.mobile }}</li>
										</ul>
									</div>
									
									<!-- // 
									 col-xs-7
									<div class="right col-xs-5 text-center">
										<img src="/public/assets/images/img.jpg" alt="" class="img-circle img-responsive">
									</div>
									--->
								</div>
								<!-- //
								<div class="col-xs-12 bottom text-center">
									<div class="col-xs-12 col-sm-6 emphasis">
										<p class="ratings">
											<a>4.0</a>
											<a href="#"><span class="fa fa-star"></span></a>
											<a href="#"><span class="fa fa-star"></span></a>
											<a href="#"><span class="fa fa-star"></span></a>
											<a href="#"><span class="fa fa-star"></span></a>
											<a href="#"><span class="fa fa-star-o"></span></a>
										</p>
										</div>
									<div class="col-xs-12 col-sm-6 emphasis">
										<button type="button" class="btn btn-success btn-xs"> <i class="fa fa-user"></i> <i class="fa fa-comments-o"></i> </button>
										<button type="button" class="btn btn-primary btn-xs"><i class="fa fa-user"> </i> View Profile</button>
									</div>
								</div>
								-->
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<!-- // <button type="button" class="btn btn-primary">Save changes</button> -->
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade bs-modal-microroutes-in-group" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel"> Microrutas en el grupo ({{ modals.microroutes.aa_groups_microroutes.length }})</h4>
				</div>
				<div class="modal-body">
					
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 text-center">
							<ul class="pagination pagination-split">
								<li><a href="#">Agregar</a></li>
							</ul>
						</div>
						<div class="clearfix"></div>
						
						
						<!-- // 
						<table class="table table-bordered">
							<tr v-for="(groups_microroute, groups_microroute_i) in modals.microroutes.aa_groups_microroutes">
								<td>{{ groups_microroute.microroute.id }}</td>
								<td>
									Z{{ groups_microroute.microroute.zone.id }}CC{{ zfill(groups_microroute.microroute.count, 4) }}
								</td>
								<td>
									{{ groups_microroute.microroute.zone.name }}
								</td>
								<td>{{ groups_microroute.microroute.id_ref }}</td>
								<td>{{ groups_microroute.microroute.description }}</td>
							</tr>
						</table>
						-->
										
						<!-- start accordion -->
						<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
							<div class="panel"  v-for="(groups_microroute, groups_microroute_i) in modals.microroutes.aa_groups_microroutes">
								<a class="panel-heading" role="tab" id="'headingOne-' + groups_microroute.microroute.id" data-toggle="collapse" data-parent="#accordion" :href="'#collapseOne-' + groups_microroute.microroute.id" aria-expanded="false" :aria-controls="'collapseOne-' + groups_microroute.microroute.id">
									<h4 class="panel-title">Z{{ groups_microroute.microroute.zone.id }}CC{{ zfill(groups_microroute.microroute.count, 4) }}FMX - {{ groups_microroute.microroute.zone.name }} | {{ groups_microroute.microroute.area_m2.toLocaleString() }} m2</h4>
								</a>
								<div :id="'collapseOne-' + groups_microroute.microroute.id" class="panel-collapse collapse " role="tabpanel" :aria-labelledby="'headingOne-' + groups_microroute.microroute.id">
									<div class="panel-body">
										<table class="table table-bordered">
											<thead>
												<tr> <!-- // <th>#</th> --></tr>
											</thead>
											<tbody>
												<tr>
													<td><b>ID: </b> {{ groups_microroute.microroute.id }}</td>
													<td><b>Lote Ref: </b> {{ groups_microroute.microroute.id_ref }}</td>
													<td><b>Últ. Ejec: </b> {{ groups_microroute.microroute.last_executed }}</td>
													<td><b>Int. Actual: </b> {{ groups_microroute.microroute.interval_days }}</td>
												</tr>
												<tr>
													<td colspan="4">{{ groups_microroute.microroute.address_text }}</td>
												</tr>
												<tr>
													<td colspan="4">{{ groups_microroute.microroute.description }}</td>
												</tr>
												<tr>
													<td colspan="4">{{ groups_microroute.microroute.obs }}</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!-- end of accordion -->
						
						<!-- // 
						<div class="col-md-4 col-sm-6 col-xs-12 profile_details" v-for="(group_manager, group_manager_i) in modals.managers.aa_groups_managers">
							<div class="well profile_view">
								<div class="col-sm-12">
									<h4 class="brief"><i>{{ group_manager.user.username }}</i></h4>
									<div class="left">
										<h4>{{ group_manager.user.names }} {{ group_manager.user.surname }}</h4>
										<p><strong>Correo Electronico: </strong> {{ group_manager.user.email }} </p>
										<ul class="list-unstyled">
											<li><i class="fa fa-building"></i> Dirección: {{ group_manager.user.address }}</li>
											<li><i class="fa fa-phone"></i> Teléfono/Móvil: {{ group_manager.user.phone }} / {{ group_manager.user.mobile }}</li>
										</ul>
									</div>
									
								</div>
							</div>
						</div>
						-->
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade bs-modal-microroutes-programming" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="width: calc(95vw);">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel"> Programacion nueva ({{ modals.microroutes_programming.aa_groups_microroutes.length }})</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2>Plain Page</h2>
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
									<div class="row ">
										<div class="col-md-12">
											
										  <div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">First Name <span class="required">*</span></label>
											<div class="col-md-8 col-sm-8 col-xs-12">
											  <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>
										  <div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">First Name <span class="required">*</span></label>
											<div class="col-md-8 col-sm-8 col-xs-12">
												<div id="reportrange-date" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
													<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
													<span>Diciembre 30, 2015 - Enero 28, 2015</span> <b class="caret"></b>
												</div><br>
												<div class="clearfix"><br></div>
											</div>
										  </div>
										
										
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-4">
							<div class="x_panel">
								<div class="x_title">
									<h2>Plain Page</h2>
									<ul class="nav navbar-right panel_toolbox">
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<div class="checkbox" v-for="(groups_microroute, groups_microroute_i) in modals.microroutes_programming.aa_groups_microroutes">
										<label>
										  <input type="checkbox" class="flat" @change="toggleMicrorouteInProgrammingModal(groups_microroute.microroute)" >
										  Z{{ groups_microroute.microroute.zone.id }}CC{{ zfill(groups_microroute.microroute.count, 4) }}FM{{ groups_microroute.microroute.repeat_ini }} - ({{ groups_microroute.microroute.area_m2.toLocaleString() }} m2)
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-8">
							<div class="x_panel">
								<div class="x_title">
									<h2 style="zoom:0.8;">Periodo: {{ filter.dates.start }} - {{ filter.dates.endText }} ({{ filter.dates.days }} Días)</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a @click="autoProgramming"><i class="fa fa-clock-o"></i></a></li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<div id="calendar-box-modal"></div>
								</div>
								<div class="x_content">
									{{ modals.microroutes_programming.forDays }}
								</div>
								<div class="x_content">
									<table class="table table-hover">
										<thead>
											<tr>
												<th v-for="(day, day_i) in modals.microroutes_programming.forDays">{{ day.label }}</th>
											</tr>
										</thead>
										<thead>
											<tr>
												<th v-for="(day, day_i) in modals.microroutes_programming.forDays">{{ day.microroutes }}</th>
											</tr>
										</thead>
										<thead>
											<tr>
												<th v-for="(day, day_i) in modals.microroutes_programming.forDays">{{ day.count }}</th>
											</tr>
											<tr>
												<th v-for="(day, day_i) in modals.microroutes_programming.forDays">{{ day.area_m2 }}</th>
											</tr>
										</thead>
									</table>
								</div>
								<div class="x_content">
									{{ modals.microroutes_programming.aa_groups_microroutes_selected }}
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
</script>
<script>
app = new Vue({
	data: function () {
		return {
			options: {
				periods: [],
				days: [],
			},
			calendar: null,
			filter: {
				dates: {
					days: 0,
					start: moment().format('YYYY-MM-DD'),
					end: moment().add({ days: 1 }).format('YYYY-MM-DD'),
					endText: '',
				},
			},
			aa_groups: [],
			modals: {
				basic: {
					id: 0,
					name: '',
					max_area_for_day: 0,
					operators: 0,
					drivers: 0,
					scythes: 0,
					auxiliary: 0,
				},
				staff: {
					aa_groups_staff: [],
				},
				microroutes: {
					aa_groups_microroutes: [],
				},
				microroutes_programming: {
					aa_groups_microroutes: [],
					aa_groups_microroutes_selected: [],
					forDays: [],
				},
				managers: {
					aa_groups_managers: [],
				},
			},
		};
	},
	created(){
		var self = this;
		self.load();
	},
	mounted(){
		var self = this;
			MV.api.readList('/aa_periods', {}, a => {
				// console.log('a', a);
				var dateIni = moment().add(2, 'days');
				var periodCurrent = 0;
				// console.log('dateIni: ', dateIni.format('YYYY-MM-DD'));
				
				periods_enableds = [];
				a.forEach(b => {
					dateStart = moment(dateIni.format('YYYY') + '-' + b.start_month +'-'+ b.start_day);
					dateEnd = moment(dateIni.format('YYYY') + '-' + b.end_month +'-'+ b.end_day);
					dateStartNext = moment(dateStart).add(1, "M");
					dateEndNext = moment(dateEnd).add(1, "M");
					resultCurrent = dateIni.isBetween(dateStart, dateEnd);
					
					if(resultCurrent == true){
						console.log('periodo actual: ', b);
						periods_enableds.push(b);
						a.forEach((z) => {
							if(b.end_day == z.start_day && b.end_month == z.start_month){
								periods_enableds.push(z);
							}
						});
					}
					
				});				
				// console.log('periods_enableds', periods_enableds);
				self.options.periods = periods_enableds;
				
				var periods_ranges = {};
				periods_enableds.forEach(z => {
					// console.log('z',z);
					periods_ranges[z.name] = [moment(moment().format('YYYY') + '-' + z.start_month + '-' + z.start_day), moment(moment().format('YYYY') + '-' + z.end_month + '-' + z.end_day).subtract(1, 'days')];
					
				});
				if (typeof($.fn.daterangepicker) === 'undefined') { return; }
				var cb = function(start, end, label) {
					// console.log(start.toISOString(), end.toISOString(), label);
					dateStart = start;
					dateEnd = end.add({ days: 1 });
					self.filter.dates.start = dateStart.format('YYYY-MM-DD');
					self.filter.dates.end = dateEnd.format('YYYY-MM-DD');
					self.filter.dates.endText = moment(dateEnd).subtract(1, 'days').format('YYYY-MM-DD');
					self.filter.dates.days = moment(dateEnd).diff(moment(dateStart), 'days');
					$('#reportrange-date span').html(dateStart.format('MMMM D, YYYY') + ' - ' + dateEnd.subtract({ days: 1 }).format('MMMM D, YYYY'));
				};
				
				var optionSet1 = {
					startDate: moment().subtract({ days: 29 }),
					endDate: moment(),
					//minDate: moment(),
					//maxDate: moment(),
					dateLimit: {
						days: 60
					},
					showDropdowns: true,
					showWeekNumbers: true,
					timePicker: false,
					timePickerIncrement: 1,
					timePicker12Hour: true,
					ranges: periods_ranges,
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
				
				//$('#reportrange-date span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
				self.filter.dates.start = moment(Object.values(periods_ranges)[0][0]).format('YYYY-MM-DD');
				self.filter.dates.end = moment(Object.values(periods_ranges)[0][1]).add(1, 'days').format('YYYY-MM-DD');
				self.filter.dates.endText = moment(Object.values(periods_ranges)[0][1]).format('YYYY-MM-DD');
				self.filter.dates.days = moment(self.filter.dates.end).diff(moment(self.filter.dates.start), 'days');
				
				$('#reportrange-date span').html(moment(self.filter.dates.start).format('MMMM D, YYYY') + ' - ' + moment(self.filter.dates.endText).format('MMMM D, YYYY'));
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
					self.init_calendar();
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
				
				self.init_calendar();
				self.iniPanelToolbox();

		});
	},
	methods: {
		zfill: MV.format.zfill,
		autoProgramming(){
			var self = this;
			console.log('autoProgramming');
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
			
			daysTotals = moment(self.filter.dates.end).diff(moment(self.filter.dates.start), 'days');
			
			self.modals.microroutes_programming.forDays = [];
			console.log('daysTotals', daysTotals);
			
			dateIniStart = moment(self.filter.dates.start);
			for (var i = 0; i < daysTotals; i++) {
				//console.log('dia #: ',  i+1);
				// console.log('dia dateIniStart: ',  dateIniStart);
				self.modals.microroutes_programming.forDays.push({
					label: dateIniStart.format('YYYY-MM-DD'),
					microroutes: [],
					count: 0,
					area_m2: 0,
				});
				dateIniStart.add(1, 'days');
			}
			console.log('self.modals.microroutes_programming.forDays', self.modals.microroutes_programming.forDays);
			
		},
		toggleMicrorouteInProgrammingModal(microroute){
			var self = this;
			console.log('iniciando toggleMicrorouteInProgrammingModal()');
			try {
				i = self.modals.microroutes_programming.aa_groups_microroutes_selected.findIndex(a => a.id == microroute.id);
				if(i > -1){
					self.modals.microroutes_programming.aa_groups_microroutes_selected.splice(i, 1);
				} 
				else {
					self.modals.microroutes_programming.aa_groups_microroutes_selected.push(microroute);
				}
			} catch(e){
				
			}
		},
		load(){
			var self = this;
			console.log('iniciando load()');
			
			MV.api.readList('/aa_groups', {
				join: [
					'aa_groups_microroutes,aa_microroutes,aa_zones',
					'aa_groups_staff,users',
					'aa_groups_managers,users',
				],
			}, (a) => {
				self.aa_groups = a;
				console.log('Result: load()', a);
			});
		},
		changeToolsInGroup(item, currentValue){
			var self = this;
			send = {};
			send[item] = currentValue;
			
			bootbox.prompt({
				title: "Selecciona el nuevo valor.",
				inputType: 'number',
				min: 0,
				step: 1,
				value: currentValue,
				callback(result){
					if(parseInt(currentValue) !== parseInt(result) && result !== null){
						send[item] = parseInt(result);
						
						MV.api.update('/aa_groups/' + self.modals.basic.id, send, a => {
							if(a > 0){
								self.modals.basic[item] = parseInt(result);
								new PNotify({
									"title": "¡Éxito!",
									"text": "Campo actualizado con éxito.",
									"styling":"bootstrap3",
									"type":"success",
									"icon":true,
									"animation":"zoom",
									"hide":true
								});
							} else {
								new PNotify({
									"title": "¡Ups!",
									"text": "Hubo un error actualizado el campo.",
									"styling":"bootstrap3",
									"type":"error",
									"icon":true,
									"animation":"slide",
									"hide":true
								});
							}
						});
					}
				}
			});
		},
		fastChangeNameGroup(){
			var self = this;
			bootbox.prompt({
				title: "Selecciona el nuevo nombre.",
				inputType: 'text',
				value: self.modals.basic.name,
				callback(result){
					if(self.modals.basic.name !== result && result !== null){						
						MV.api.update('/aa_groups/' + self.modals.basic.id, {
							name: result
						}, a => {
							if(a > 0){
								self.modals.basic.name = result;
								new PNotify({
									"title": "¡Éxito!",
									"text": "Campo actualizado con éxito.",
									"styling":"bootstrap3",
									"type":"success",
									"icon":true,
									"animation":"zoom",
									"hide":true
								});
							} else {
								new PNotify({
									"title": "¡Ups!",
									"text": "Hubo un error actualizado el campo.",
									"styling":"bootstrap3",
									"type":"error",
									"icon":true,
									"animation":"slide",
									"hide":true
								});
							}
						});
					}
				}
			});
		},
		fastChangeMaxAreaForDayGroup(){
			var self = this;
			bootbox.prompt({
				title: "Selecciona la nueva área.",
				inputType: 'number',
				min: 0,
				step: 'any',
				value: parseFloat(self.modals.basic.max_area_for_day),
				callback(result){
					if(parseFloat(self.modals.basic.max_area_for_day) !== parseFloat(result) && result !== null){						
						MV.api.update('/aa_groups/' + self.modals.basic.id, {
							max_area_for_day: parseFloat(result)
						}, a => {
							if(a > 0){
								self.modals.basic.max_area_for_day = parseFloat(result);
								new PNotify({
									"title": "¡Éxito!",
									"text": "Campo actualizado con éxito.",
									"styling":"bootstrap3",
									"type":"success",
									"icon":true,
									"animation":"zoom",
									"hide":true
								});
							} else {
								new PNotify({
									"title": "¡Ups!",
									"text": "Hubo un error actualizado el campo.",
									"styling":"bootstrap3",
									"type":"error",
									"icon":true,
									"animation":"slide",
									"hide":true
								});
							}
						});
					}
				}
			});
		},
		changeInfoBasicItemGroup(id, item, value, textSuccess, textError){
			var self = this;
			send = {};
			send[item] = value;
			
			MV.api.update('/aa_groups/' + id, send, a => {
				if(a > 0){
					new PNotify({
						"title": "¡Éxito!",
						"text": "Campo actualizado con éxito.",
						"styling":"bootstrap3",
						"type":"success",
						"icon":true,
						"animation":"zoom",
						"hide":true
					});
				} else {
					new PNotify({
						"title": "¡Ups!",
						"text": "Hubo un error actualizado el campo.",
						"styling":"bootstrap3",
						"type":"error",
						"icon":true,
						"animation":"slide",
						"hide":true
					});
				}
			});
		},
		// Panel toolbox
		iniPanelToolbox(){
			$('.collapse-link').on('click', function() {
				var $BOX_PANEL = $(this).closest('.x_panel'),
					$ICON = $(this).find('i'),
					$BOX_CONTENT = $BOX_PANEL.find('.x_content');
				
				// fix for some div with hardcoded fix class
				if ($BOX_PANEL.attr('style')) {
					$BOX_CONTENT.slideToggle(200, function(){
						$BOX_PANEL.removeAttr('style');
					});
				} else {
					$BOX_CONTENT.slideToggle(200); 
					$BOX_PANEL.css('height', 'auto');  
				}

				$ICON.toggleClass('fa-chevron-up fa-chevron-down');
			});

			$('.close-link').click(function () {
				var $BOX_PANEL = $(this).closest('.x_panel');

				$BOX_PANEL.remove();
			});
		},
		// /Panel toolbox
	}
}).$mount('#app-groups_microroutes');
</script>
<div id="emvarias-me-report-current-period">
	<div class="page-title">
		<div class="title_left">
			<h3> <small></small></h3>
		</div>
		<div class="title_right">
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><?= $title; ?> <small></small></h2>
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
					<table id="datatable-buttons2" class="table table-striped table-bordereds"></table>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<script>
var app = new Vue({
	data: function () {
		return {
			options: {
				periods: [],
			},
			currentDate: {
				year: moment().format('Y'),
				month: moment().format('M'),
				day: moment().format('D'),
			},
			filter: {
				year: moment().format('Y'),
				period: 0,
				group: 0,
				create_by: <?= $this->user->id; ?>,
			}
		};
	},
	mounted(){
		var self = this;
		self.loadOptions();
	},
	methods: {
		loadOptions(){
			var self = this;
			MV.api.readList('/periods', {}, function(e){
				self.options.periods = e;
				e.forEach(function(b){
					if((self.currentDate.day >= b.start_day && self.currentDate.day <= b.end_day) == true && b.start_month == self.currentDate.month){
						self.filter.period = b.id;
					}
				});
				self.load();
			});
		},
		load(){
			var self = this;
			var dialog = bootbox.dialog({
				message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog"></i> Por favor espera mientras hacemos algo...</p>',
				closeButton: false
			});
			
			MV.api.readList('/reports_photographic', {
				filter: [
					'year,eq,' + self.filter.year,
					'period,eq,' + self.filter.period,
					//'group,eq,' + self.filter.group,
					'create_by,eq,' + self.filter.create_by,
				],
				join: [
					'schedule,microroutes',
					'schedule,periods',
					'schedule,groups',
					'schedule,users',
					'users',
				],
			}, function (aR) {
				console.log(aR);
				dialog.modal('hide');
				
				self.dataTable = $('#datatable-buttons2').DataTable({
					destroy: true,
					dom: "Blfrtip",
					buttons: [{ extend: "copy", className: "btn-sm btn-default" }, ],
					//responsive: true,
					"processing": true,
					language: { "url": "/public/assets/build/js/lang-datatable.json" },
					data: aR.map(a => [
						a.id,
						a.schedule.microroute.name, 
						a.schedule.group.name, 
						(a.type == 'D') ? 'Despues' : (a.type == 'A') ? 'Antes' : 'Otro', 
						(a.schedule.microroute.id_ref.length > 1 || a.schedule.microroute.id_ref.length !== 'N/A') ? a.schedule.microroute.id_ref : 'N/A', 
						a.created, 
						(a.status == 0) ? 'En revision' : (a.status == 1) ? 'Aprobada' : (a.status == 2) ? 'Rechazada' : 'Sin parametrizacion', 
						a.create_by.username, 
						'<a href="' + a.file_path_short + '" target="_new"><i class="fa fa-search-plus"></i></a>', 
					]),
					"order": [[1, 'asc']],
					columns: [
						{ title: "Id INT" }, 
						{ title: "Microruta" }, 
						{ title: "Cuadrilla" }, 
						{ title: "Estado Act." }, 
						{ title: "Lote Ref" }, 
						{ title: "F. Subida" }, 
						{ title: "Estado" }, 
						{ title: "Creada por" }, 
						{ title: "Acciones" }, 
					],
					initComplete: function( settings, json ) {
						//subDialog.modal('hide');
						var apiTables = this.api();
						/*
						apiTables.$('tr').click(function(){
							tds = $(this).find( "td" );
							selectedId = parseInt($(tds[0]).text());
							self.form_search_create.microroute = ((parseInt(selectedId)>0) ? parseInt(selectedId) : 0);
							//document.getElementById('CreateScheduleModal').scrollTo(0, 0);
						});*/
						
						/*
						apiTables.$("button.create-schedule-fast").click(function() {
							try {
							} catch(e){
								console.error(e);
								return false;
							}
						});
						*/
						
					},
				});
				
			});
		},
	}
}).$mount('#emvarias-me-report-current-period');
</script>
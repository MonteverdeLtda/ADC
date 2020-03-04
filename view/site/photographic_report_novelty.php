<style>
.product-image {
	height: 450px;
	max-height: 750px;
	
	
    border: 1px solid #e82b2b;
    margin: 0px;
    display: flex;
    padding: 5px;
}


</style>

<div class="container" id="schedule-report-before-creator">
	<div class="page-title">
	  <div class="title_left">
		<h3><?= $title; ?> </h3>
	  </div>
	</div>
	<div class="clearfix"></div>
	<div class="row" id="screenshot">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label col-md-12 col-sm-12 col-xs-12">Periodo</label>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<select v-model="createForm.period" class="select2_single form-control disabled" tabindex="-1" readonly="" disabled="">
										<option value="0">Seleccione la fecha del reporte</option>
										<option v-for="(option, i_option) in options.periods" :value="option.id">{{ option.name }}</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<fieldset>
								<label class="control-label col-md-12 col-sm-12 col-xs-12">Fecha del suceso</label>
								<div class="control-group">
									<div class="controls">
										<div class="col-md-11 xdisplay_inputx form-group has-feedback ">
											<input v-model="createForm.date_report" type="text" class="form-control has-feedback-left" id="date-filter" placeholder="Fecha del suceso" aria-describedby="inputSuccess2Status2" />
											<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
											<span id="inputSuccess2Status2" class="sr-only">(success)</span>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
							</fieldset>
						</div>
				
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label class="control-label col-md-12 col-sm-12 col-xs-12">Cuadrilla</label>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<select v-model="createForm.group" class="select2_single form-control" tabindex="-1">
										<option value="0">Seleccione una opcion</option>
										<option v-for="(option, i_option) in options.groups" :value="option.id">{{ option.name }}</option>
									</select>
								</div>
							</div>
						</div>
				
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label col-md-12 col-sm-12 col-xs-12">Resumen de los hechos</label>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<textarea class="form-control" v-model="createForm.notes" rows="5"></textarea>
								</div>
							</div>
						</div>
				
						<div class="col-md-12 col-sm-12 col-xs-12">
							<br>
							<div class="form-group">
								<div :class="(idReport > 0) ? '' : 'hide ' + ' col-md-12 col-sm-12 col-xs-12'">
									<button @click="idReport = 0; createForm.notes = ''" type="button" class="btn btn-warning">Nuevo Reporte</button>
								</div>
								<div :class="(idReport <= 0) ? '' : 'hide ' + ' col-md-12 col-sm-12 col-xs-12'">
									<button @click="submitForm" type="button" class="btn btn-success pull-right">Reportar</button>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="x_panel">
				<div class="x_content">						
					<div :class="(idReport > 0) ? '' : 'hide ' + ' col-md-12 col-sm-12 col-xs-12'">
						<br />
						<div class="col-md-12 col-sm-12 col-xs-12'">
							<div class="form-group pull-right">
								<a class="btn btn-md btn-default fileinput-button">
								  <i class="fa fa-camera-retro"></i> Subir Archivo
								</a>
							</div>
						</div>
						
						<div class="x_panel">
							<div class="x_content">
								<div class="row">
									<p>Imagenes capturadas</p>
									<div class="product_gallery">
										<div class="row" id="screenshots-images"></div>
									</div>
									<div class="clearfix"></div>
								</div>
								
								<div class="col-xs-12 dropzone1"></div>
								<div class="table table-striped" class="files" id="previews">
									<div id="template" class="file-row">
										<!-- This is used as the file preview template -->
										<div>
											<span class="preview"><img data-dz-thumbnail /></span>
										</div>
										<div>
											<p class="name" data-dz-name></p>
											<strong class="error text-danger" data-dz-errormessage></strong>
										</div>
										<div>
											<p class="size" data-dz-size></p>
											<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
											  <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
											</div>
										</div>
										<div>
											<button class="btn btn-primary start">
												<i class="glyphicon glyphicon-upload"></i>
												<span>Subir</span>
											</button>
											<!-- // 
											<button data-dz-remove class="btn btn-warning cancel">
												<i class="glyphicon glyphicon-ban-circle"></i>
												<span>Cancelar</span>
											</button>-->
											<button data-dz-remove class="btn btn-danger delete ">
												<i class="glyphicon glyphicon-trash"></i>
												<span>Eliminar</span>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="clearfix"></div>					
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<font class="hide">{{ urlForm }}</font>
			
	</div>
</div>

<script>
var app = new Vue({
	data: function () {
		return {
			options: {
				groups: [],
				periods: [],
				schedule: [],
			},
			createForm: {
				date_report: null,
				group: 0,
				period: 0,
				year: moment().format('Y'),
				lat: 0,
				lng: 0,
				notes: '',
				created_by: '<?= $this->user->id; ?>',
			},
			idReport: 0,
			current: {
				dateISO: {
					year: moment().format('Y'),
					month: moment().format('M'),
					day: moment().format('D'),
				}
			},
			geo: {
				active: false,
				msg: '',
				urlMap: '/index.php?controller=sw&action=staticmap&maptype=wikimedia&zoom=16&center=6.2386064999999995,-75.58853739999999&size=450x450',
				lat: 0,
				lng: 0,
				options: {
					// enableHighAccuracy = should the device take extra time or power to return a really accurate result, or should it give you the quick (but less accurate) answer?
					enableHighAccuracy: false,
					// timeout = how long does the device have, in milliseconds to return a result?
					timeout: 5000,
					// maximumAge = maximum age for a possible previously-cached position. 0 = must return the current position, not a prior cached position
					maximumAge: 0
				},
			},
			myDropzone: null
		};
	},
	mounted(){
		var self = this;
		self.getLocation();
		self.loadOptions();
					
		$(document).ready(function(){
		  $('[data-toggle="tooltip"]').popover({
				title: this.title,
				content: ($(this).data('description')) ? $(this).data('description') : '',
				trigger: 'hover',
				placement: 'right',
				container: 'body'
			});
		});
		$('#date-filter').daterangepicker({
		  singleDatePicker: true,
		  singleClasses: "picker_2",
		  dateFormat: 'yy-mm-dd'
		}, function(start, end, label) {
			// console.log(start.toISOString(), end.toISOString(), label);
			
			self.createForm.date_report = start.format('Y-MM-DD');
			self.createForm.year = start.format('Y');
			self.loadDay();
		//}).data('daterangepicker').show();
		});
		self.loadDropzone();
		
		// self.loadDropzone();
		/*
		$('#CreateScheduleModal').on('show.bs.modal', function (e) {
			$('.modal .modal-dialog').attr('class', 'modal-md modal-dialog  ' + 'zoomIn' + '  animated');
		})
		$('#CreateScheduleModal').on('hide.bs.modal', function (e) {
			$('.modal .modal-dialog').attr('class', 'modal-md modal-dialog  ' + 'zoomOut' + '  animated');
		})*/
	},
	computed: {
		classObjectGEO: function () {
			var self = this;
			return (self.geo.active == true) ? 'btn btn-md btn-success' : 'btn btn-md btn-default';
		},
		urlForm(){
			var self = this;
			url = "/index.php?action=send_file_novelty";
			try {
				if(self.idReport !== undefined && self.idReport > 0){ 
					url += "&id_report=" + self.idReport;
				}
				if(self.year !== undefined && self.year > 1950){ 
					url += "&year=" + self.year;
				}
				
				if(self.createForm.date_report !== undefined && moment(self.createForm.date_report).isValid() == true){ 
					url += "&date_report=" + self.createForm.date_report;
				}
				
				period_a = self.options.periods.find((a) => (a.id == self.createForm.period));
				if(period_a !== undefined && period_a.name !== undefined){ 
					url += "&period=" + (period_a.id);
					url += "&period_name=" + btoa(period_a.name);
				}
				
				group_a = self.options.groups.find((a) => (a.id == self.createForm.group));
				if(group_a !== undefined && group_a.name !== undefined){ 
					url += "&group=" + (group_a.id);
					url += "&group_name=" + btoa(group_a.name);
				}
				
				url += "&lat=" + (self.geo.lat);
				url += "&lng=" + (self.geo.lng);
				return url;
			} catch(e){
				console.error(e)
				return '';
			}
		},
	},
	methods: {
		abrir_Popup(url, title="Mi Cuenta") {
			var objeto_window_referencia;
			var configuracion_ventana = "width=800,height=800,menubar=no,location=yes,resizable=no,scrollbars=no,status=no";
			objeto_window_referencia = window.open(url, title, configuracion_ventana);
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
				// console.log('send LOG: ', send);
				api.post('/records/schedule_log', send)
				.then(function (l){
					// console.log('log', l);
					if(l.status == 200){
						// console.log('Registro creado con exito.');
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
				// console.log('Error al creado el registro.');
				console.error(e);
				callb(e)
				// data
			}
		},
		submitForm(){
			var self = this;
			var subDialog = bootbox.dialog({
				message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog"></i> Por favor espera mientras hacemos algo...</p>',
				closeButton: false
			});
			
			try {
				if(moment(self.createForm.date_report).isValid() == true 
					&& self.createForm.group > 0
					&& self.createForm.period > 0
					&& self.createForm.year > 1950
					&& self.createForm.notes.length > 10
				){
					console.log('Formulario correcto');
					console.log('Agregar: ', self.createForm);
					
					MV.api.create('/novelties_generals', self.createForm, function(a){
						subDialog.modal('hide');
						if(a > 0){
							self.idReport = a;
							MV.apiFG.get('/index.php', {
								params: {
									action: 'CreateReportPDFNovelty',
									novelty_general_id: a
								}
							}).then((b) => {
								console.log('b', b);
								console.log('PDF cargado.');
							}).catch((e) => {
								console.log('Error cargando PDF.');
							});
						}
					});
				}else {
					console.log('Formulario incompleto.');
					subDialog.modal('hide');
				}
			} catch(e) {
				console.log(e);
				subDialog.modal('hide');
			}
		},
		canvasToElementMedia(fileResponse){
			var self = this;
			$htmlout = '';
			try {
				$htmlout += '<div class="col-md-55" data-path_short="' + fileResponse.path_short + '">';
					$htmlout += '<div class="thumbnail">';
						$htmlout += '<div class="image view view-first">';
							$htmlout += '<img style="width: 100%; display: block;" src="' + fileResponse.path_short + '" alt="image" />';
							$htmlout += '<div class="mask">';
								$htmlout += '<p>' + fileResponse.size + '</p>';
							$htmlout += '</div>';
						$htmlout += '</div>';
						$htmlout += '<div class="caption">';
								$htmlout += '<p>Click para abrir</p>';
						$htmlout += '</div>';
					$htmlout += '</div>';
				$htmlout += '</div>';
				return $htmlout;
			} catch(e) {
				console.error(e);
				return "$htmlout";
			}
		},
		loadDropzone(){
			var self = this;
			// Dropzone class:
			// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
			var previewNode = document.querySelector("#template");
			previewNode.id = "";
			var previewTemplate = previewNode.parentNode.innerHTML;
			previewNode.parentNode.removeChild(previewNode);
			var myDropzone = self.myDropzone = new Dropzone(".dropzone1", {
				// Make the whole body a dropzone
				url: self.urlForm, // Set the url
				thumbnailWidth: 80,
				thumbnailHeight: 80,
				parallelUploads: 3,
				previewTemplate: previewTemplate,
				autoQueue: false, // Make sure the files aren't queued until manually added
				previewsContainer: "#previews", // Define the container to display the previews
				clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
				init: function() {
					this.on("processing", function(file) {
						console.log('processing');
						this.options.url = self.urlForm;
					});
				},
				// acceptedFiles: 'image/*;capture=camera'
				// acceptedFiles: 'image/*'
			});
			
			// "myAwesomeDropzone" is the camelized version of the HTML element's ID
			myDropzone.on("error", function(file,errorMessage,xhr){
				console.log('log our failure so we dont accidentally complete');
				console.log(xhr);
				console.log(errorMessage);
				alert(errorMessage);
                // log our failure so we don't accidentally complete
                //$scope.errors.push(file.name);
                // retry!
                //myDropZone.context.dropzone.uploadFile(file);
				
				myDropzone.removeFile(file);
				myDropzone.addFile(file);
            });
			
			myDropzone.on("addedfile", function(file) {
			  // Hookup the start button
			  file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
			});
			// Update the total progress bar
			myDropzone.on("totaluploadprogress", function(progress) {
			  $("#total-progress .progress-bar").css('width', progress + "%");
			});

			myDropzone.on("sending", function(file) {
			  // Show the total progress bar when upload starts
			  $("#total-progress").css('opacity', "1");
			  // And disable the start button
			  file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
			});
			// Hide the total progress bar when nothing's uploading anymore
			myDropzone.on("queuecomplete", function(progress) {
			  $("#total-progress").css('opacity', "0");
			});
			// Hide the total progress bar when nothing's uploading anymore
			myDropzone.on("success", function(file, response) {
				console.log('response', response);
				console.log(response.message);
				console.log(response.success);
				console.log(response.additional);
				if(response.error == false){
					myDropzone.removeFile(file);
					errors = false;
					
					
					response.additional.files.forEach((ac) => {
						$inputGroup = $(self.canvasToElementMedia(ac));
						$inputGroup.click(function(){
							// console.log('click');
							self.abrir_Popup($(this).data('path_short'), 'Visor de fotos rápido');
						});
						
						$("#screenshots-images").append($inputGroup);
					});
					
					
					
					
					
					self.createLogSchedule({
						schedule: self.createForm.schedule,
						action: 'new-picture',
						data: file,
						response: response,
					}, function(w){
						
					});
					return file.previewElement.classList.add("dz-success");
				} else {
					return file.previewElement.classList.add("dz-danger");
				}
			});
			// Setup the buttons for all transfers
			// The "add files" button doesn't need to be setup because the config
			// `clickable` has already been specified.
			// image/*;capture=camera
			//$("#actions .start").onclick = function() { myDropzone.removeAllFiles(true); };
		},
		getLocation(){
			var self = this;
			if('geolocation' in navigator){
				// geolocation is supported :)
				self.requestLocation();
			}else{
				self.geo.msg = "Sorry, looks like your browser doesn't support geolocation";
			}
		},
		requestLocation(){
			var self = this;
			navigator.geolocation.getCurrentPosition(self.successGEO, self.errorGEO, self.geo.options);
		},
		successGEO(pos){
			var self = this;
			// console.log('pos', pos);
			try {				
				self.createForm.lng = self.geo.lng = pos.coords.longitude;
				self.createForm.lat = self.geo.lat = pos.coords.latitude;
				// and presto, we have the device's location!
				self.geo.msg = 'lon: ' + self.geo.lng + ' and lat: ' + self.geo.lat;
				self.geo.urlMap = '/index.php?controller=sw&action=staticmap&maptype=wikimedia&zoom=16&center=' + self.geo.lat + ',' + self.geo.lng + '&size=450x450&markers=' + self.geo.lat + ',' + self.geo.lng + ',bullseye';
				//var boxImgMap = document.querySelector('#boxImgMap');
				// boxImgMap.src = self.geo.urlMap;
			} catch(e){
				console.log(e);
			}
		},
		errorGEO(err){
			var self = this;
			// return the error message
			self.geo.msg = 'Error: ' + err + ' -------- ' + JSON.stringify(err) + ' :(';
			self.outputResult(self.geo.msg); // output button
			$('.pure-button').removeClass('pure-button-primary').addClass('pure-button-error'); // change button style
		},		
		outputResult(msg){
			var self = this;
			$('.result').addClass('result').html(self.geo.msg);
		},
		loadOptions(){
			var self = this;
			try {				
				MV.api.readList('/periods', {
					filter: [
						//'end_day,le,' + self.current.dateISO.day,
						//'start_month,eq,' + self.current.dateISO.month
					],
				}, function(a){
					self.options.periods = a;
					//a.forEach(function(b){ if((self.current.dateISO.day >= b.start_day && self.current.dateISO.day <= b.end_day) == true && b.start_month == self.current.dateISO.month){ self.createForm.period = b.id; } });					
				});
				MV.api.readList('/groups', { }, function(a){ self.options.groups = a; });
			} catch(e){
				console.log('error en loadOptions');
			}
		},
		resetAll(){
			var self = this;
			self.createForm.period = 0;
			self.idReport = 0;
		},
		loadDay(){
			var self = this;
			var dialog = bootbox.dialog({
				message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog"></i> Por favor espera mientras hacemos algo...</p>',
				closeButton: false
			});
			
			try {
				self.resetAll();
				var Dt = moment(self.createForm.date_report);				
				resultPeriod = self.options.periods.filter(function(a){
					if(a.start_month == Dt.format('M')){						
						if(a.start_day <= Dt.format('D') && Dt.format('D') <= a.end_day){
							console.log('Periodo AutoSelect: ', a.name);
							self.createForm.period = a.id;
						}
					}
				});
				
				indexPeriod = self.options.periods.findIndex(x => x.id == self.createForm.period);
				
				if(indexPeriod >= 0){						
					startDate = new Date(self.createForm.year, Number(self.options.periods[indexPeriod].start_month)-1, self.options.periods[indexPeriod].start_day);
					endDate = new Date(self.createForm.year, Number(self.options.periods[indexPeriod].end_month)-1, self.options.periods[indexPeriod].end_day);
					
				}
				dialog.modal('hide');
			} catch(e){
				console.error(e);
				dialog.modal('hide');
			}
		},
		
	}
}).$mount('#schedule-report-before-creator');



</script>
<style>
.product-image {
	height: 450px;
	max-height: 750px;
	
	
    border: 1px solid #e82b2b;
    margin: 0px;
    display: flex;
    padding: 5px;
}

.dropzone1 {
	display: grid;
	width: calc(80vw);
	height: 250px;
    background: white;
    border-radius: 5px;
    border: 2px dashed rgb(0, 135, 247);
    border-image: none;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
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
		<div class="clearfix"></div>
		
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!-- start form for validation -->
			<form id="demo-form" data-parsley-validate>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<div class="form-group">
						<label class="control-label col-md-12 col-sm-12 col-xs-12">Periodo</label>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<select @change="loadLots" v-model="createForm.period" class="select2_single form-control" tabindex="-1">
								<option value="0">Seleccione una opcion</option>
								<option v-for="(option, i_option) in options.periods" :value="option.id">{{ option.name }}</option>
							</select>
						</div>
					</div>
				</div>
				
				<div class="col-md-6 col-sm-6 col-xs-6">
					<div class="form-group">
						<label class="control-label col-md-12 col-sm-12 col-xs-12">Cuadrilla</label>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<select @change="loadLots" v-model="createForm.group" class="select2_single form-control" tabindex="-1">
								<option value="0">Seleccione una opcion</option>
								<option v-for="(option, i_option) in options.groups" :value="option.id">{{ option.name }}</option>
							</select>
						</div>
					</div>
				</div>
				
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="control-label col-md-12 col-sm-12 col-xs-12">Microruta/Lote *</label>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<select v-model="createForm.schedule" class="select2_single2 form-control" tabindex="-1">
								<!-- // <option v-for="(option, i_option) in options.groups" :value="option.id">{{ option.name }}</option> -->
							</select>
						</div>
					</div>
				</div>
				<br/>
				<!-- // <img id="boxImgMap" class="img img-responsive hide" width="100%" :src="geo.urlMap" /> -->
				<!-- // <br/>
				<div class="">{{ geo.msg }}</div> -->
				<!-- // 
				<h3 class="prod_title">{{ addressSelected }}</h3>						
				<p>{{ descriptionSelected }}</p>
				-->
			</form>

			<br />
				<div :class="(createForm.schedule > 0) ? 'col-md-12 col-sm-12 col-xs-12' : 'hide'">
					<div class="form-group pull-right">
						<!-- //
						<a class="btn btn-md btn-default fileinput-button">
						  <i class="fa fa-camera-retro"></i> Subir Archivo
						</a>-->
						
					</div>
					<div class="actions-alls">
						<button class="btn btn-success " @click="upAll">
							<i class="glyphicon glyphicon-upload"></i>
							<span>Subir todas</span>
						</button>
						<button class="btn btn-warning " @click="clearGalleryOut">
							<i class="fa fa-eraser"></i>
							<span>Limpiar Galeria</span>
						</button>
					</div>
				</div>
			<br />
			<div class=" col-xs-12" style="border:0px solid #e5e5e5;">
				<!-- // 
					{{ createForm }}
				-->
				<!-- // 
				<div class="product_social">
					<ul class="list-inline">
						<li><a href="#" data-toggle="tooltip" title="Hooray!">Hover over me</a></li>
						<li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
						<li><a href="#"><i class="fa fa-envelope-square"></i></a></li>
						<li><a href="#"><i class="fa fa-rss-square"></i></a></li>
					</ul>
				</div>
				-->
			</div>
		</div>
		
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<div class="row">
						<p>Imagenes Subidas</p>
						<div class="product_gallery">
							<div class="row" id="screenshots-images"></div>
						</div>
						<div class="clearfix"></div>
					</div>
					
					<div :class="(createForm.schedule > 0) ? 'col-md-12 col-sm-12 col-xs-12' : 'hide'">
						<div class="col-xs-12">
							<div class="form-group pull-right">
								<a class="btn btn-md btn-default fileinput-button">
								  <i class="fa fa-camera-retro"></i> Subir Archivo
								  <!---// <input onclick="javascript:return false;" class="form-control" type="file" accepted="image/*" /> -->
								</a>
								
							</div>
						</div>
						<div class="dropzone1 "></div>
						<!-- // <form action="/file-upload" class="dropzone1" id="my-awesome-dropzone" method="post" enctype="multipart/form-data"> -->
						<!-- // 
						<form action="/file-upload" class="dropzone1" id="my-awesome-dropzone" method="post" enctype="multipart/form-data">
							<div class="fallback">
								<input name="file" type="file" multiple />
							</div>
						</form>
						-->
					</div>
					
					<!--
					<form action="/file-upload" class="dropzone1" id="">
					  <div class="fallback">
						<input name="file" type="file" multiple />
					  </div>
					</form>
					-->
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
				schedule: 0,
				year: moment().format('Y'),
				type: 'A',
				group: 0,
				period: 0,
				lat: 0,
				lng: 0,
			},
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
		
		self.loadDropzone();
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
		addressSelected(){
			var self = this;
			try{
				return self.options.schedule.find(x => x.id === self.createForm.schedule).address_text;
			} catch(e){
				return " - Complete el formulario para ver más información - ";
			}
		},
		descriptionSelected(){
			var self = this;
			try{
				return self.options.schedule.find(x => x.id === self.createForm.schedule).description;
			} catch(e){
				return " - Complete el formulario para ver más información - ";
			}
		},
		contractName(){
			return "CW72436";
		},
		periodName(){
			var self = this;
			try{
				return self.options.schedule.find(x => x.id == self.createForm.schedule).period.name;
			} catch(e){
				return "";
			}
		},
		groupName(){
			var self = this;
			try{
				return self.options.schedule.find(x => x.id == self.createForm.schedule).group.name;
			} catch(e){
				return "";
			}
		},
		dateUpda(){
			var self = this;
			try{
				return self.options.schedule.find(x => x.id == self.createForm.schedule).date_executed_schedule;
			} catch(e){
				return ((Math.floor(Math.random() * (1 + 40 - 20))) + 20);
			}
		},
		microrouterName(){
			var self = this;
			try{
				var micr = self.options.schedule.find(x => x.id == self.createForm.schedule).microroute;
				return micr.name;
			} catch(e){
				return "SIN-RUTA";
			}
		},
		urlForm(){
			var self = this;
			url = "/index.php?action=send_photo_schedule";
			try {
				if(self.createForm.schedule > 0){
					url += "&period_name=" + btoa(self.periodName);
					url += "&year=" + self.createForm.year;
					url += "&period=" + self.createForm.period;
					url += "&schedule=" + self.createForm.schedule;
					url += "&route_name=" + btoa(self.microrouterName);
					url += "&group=" + self.createForm.group;
					url += "&date_executed=" + self.dateUpda;
					url += "&group_name=" + btoa(self.groupName);
					url += "&lat=" + (self.createForm.lat);
					url += "&lng=" + (self.createForm.lng);
				}
				return url + "&type=<?= $_GET['type']; ?>";
			} catch(e){
				console.error(e)
				return '';
			}
		},
	},
	methods: {
		clearGalleryOut(){
			var self = this;
			$('.product_gallery').html('<div class="row" id="screenshots-images"></div>');
		},
		abrir_Popup(url, title="Mi Cuenta") {
			var objeto_window_referencia;
			var configuracion_ventana = "width=800,height=800,menubar=no,location=yes,resizable=no,scrollbars=no,status=no";
			objeto_window_referencia = window.open(url, title, configuracion_ventana);
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
								$htmlout += '<p>Click para abrir</p>';
							$htmlout += '</div>';
						$htmlout += '</div>';
						$htmlout += '<div class="caption">';
							$htmlout += '<p> ' + fileResponse.name + '</p>';
						$htmlout += '</div>';
					$htmlout += '</div>';
				$htmlout += '</div>';
				return $htmlout;
			} catch(e) {
				console.error(e);
				return "$htmlout";
			}
		},
		upAll(){
			var self = this;
			self.myDropzone.enqueueFiles(self.myDropzone.getFilesWithStatus(Dropzone.ADDED));
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
		dataURItoBlob(dataURI) {
			var self = this;
			
			var byteString, mimestring;

			if(dataURI.split(',')[0].indexOf('base64') !== -1 ) { byteString = atob(dataURI.split(',')[1]); } 
			else { byteString = decodeURI(dataURI.split(',')[1]); };

			mimestring = dataURI.split(',')[0].split(':')[1].split(';')[0];

			var content = new Array();
			for (var i = 0; i < byteString.length; i++) { content[i] = byteString.charCodeAt(i); }

			return new Blob([new Uint8Array(content)], {type: mimestring});
		},
		dataURLtoFile(dataurl, filename) {
			var arr = dataurl.split(','),
				mime = arr[0].match(/:(.*?);/)[1],
				bstr = atob(arr[1]), 
				n = bstr.length, 
				u8arr = new Uint8Array(n);
				
			while(n--){
				u8arr[n] = bstr.charCodeAt(n);
			}
			return new File([u8arr], filename, {type:mime});
		},
		save(dataURI) {
			var self = this;
			var blob = self.dataURItoBlob(dataURI);
			return blob;
		},
		dataURItoBlob2(dataURI) {
		  // http://stackoverflow.com/a/12300351/4578017
		  var byteString = atob(dataURI.split(',')[1]);

		  var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0]

		  var ab = new ArrayBuffer(byteString.length);
		  var ia = new Uint8Array(ab);
		  for (var i = 0; i < byteString.length; i++) {
			ia[i] = byteString.charCodeAt(i);
		  }

		  var blob = new Blob([ab], {type: mimeString});
		  return blob;
		},
		showErrorModal(text, title = null){
			title = (title !== null) ? title : "¡Ups!";
			new PNotify({
				"title": title,
				"text": text,
				"styling":"bootstrap3",
				"type":"error",
				"icon":true,
				"animation":"flip",
				"hide":true,
				"delay": 2500,
			});
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
				paramName: 'file',
				thumbnailWidth: 80,
				thumbnailHeight: 80,
				addRemoveLinks: false,
				headers: {
					"Cache-Control": null,
				},
				previewTemplate: previewTemplate,
				autoQueue: false, // Make sure the files aren't queued until manually added
				previewsContainer: "#previews", // Define the container to display the previews
				clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
				init: function() {
					this.on("processing", function(file) {
						console.log('processing');
						this.options.url = self.urlForm;
						console.log(this.options);
					});
				},
				// acceptedFiles: 'image/*;capture=camera'
				acceptedFiles: 'image/*'
				/*onDropHandler(files) {      
					  var file = files[0]
					  const reader = new FileReader();
					  reader.onload = (event) => {
						console.log(event.target.result);
					  };
					  reader.readAsDataURL(file);
				}
				*/
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
			  
			  file.previewElement.querySelector(".start").onclick = function() {
				  myDropzone.enqueueFile(file);
			  };
						
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
					myDropzone.removeFile(file);
					myDropzone.addFile(file);
					self.showErrorModal(response.message);
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
				$('.pure-button').removeClass('pure-button-primary').addClass('btn-success'); // change button style
			} catch(e){
				
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
					a.forEach(function(b){ if((self.current.dateISO.day >= b.start_day && self.current.dateISO.day <= b.end_day) == true && b.start_month == self.current.dateISO.month){ self.createForm.period = b.id; } });					
				});
				MV.api.readList('/groups', { }, function(a){ self.options.groups = a; });
			} catch(e){
				console.log('error en loadOptions');
			}
		},
		loadLots(){
			var self = this;
			var subDialog = bootbox.dialog({
				message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog"></i> Por favor espera mientras hacemos algo...</p>',
				closeButton: false
			});
			try {
				$("#contentScheduleSelected").html('');
				MV.api.readList('/schedule', {
					filter: [
						'period,eq,' + self.createForm.period,
						'group,eq,' + self.createForm.group,
						'year,eq,' + self.createForm.year
					],
					join: [
						'periods',
						'groups',
						'microroutes',
					],
					order: 'date_executed_schedule,asc'
				}, function(a){
					$(".select2_single2").html('<option value="">Seleccione una opcion</option><option value="0">Seleccione una opcion</option>');
					self.options.schedule = a;					
					a.forEach(function(b){
						$input = $('<input />')
							.attr('id', 'shedule-option-' + b.id)
							.attr('v-model', "createForm.schedule")
							.attr('type', "radio")
							.attr('class', "flat")
							.attr('name', "schedule")
							.attr('required', "true")
							.val(b.id).change(function(c){
								self.createForm.schedule = parseInt($(c.target).val());
							});
							
							console.log('b', b);
						title = '(' + b.date_executed_schedule + ' - ' + moment(b.date_executed_schedule_end).subtract({ days: 1}).format('YYYY-MM-DD') + ') - ' + b.microroute.name + ' - (Lote:' + b.microroute.id_ref + ') - ' + b.microroute.address_text;
						
						
						$option = $('<option />')
							.attr('id', 'shedule-option-select-' + b.id)
							.text(title)
							.attr('required', "true")
							.val(b.id).change(function(c){
								self.createForm.schedule = parseInt($(c.target).val());
							});
						
						$inputText = $('<label></label>').text(title).attr('for', 'shedule-option-' + b.id);
						$inputGroup = $('<div></div>').append($input,$inputText).popover({
							title: b.address_text,
							content: b.description,
							trigger: 'focus',
							placement: 'top',
							// container: 'body'
						});
						//$("#contentScheduleSelected").append($inputGroup);
						
						$(".select2_single2").append($option);
						
					});
					subDialog.modal('hide');
					
					$(".select2_single2").select2({
					  placeholder: "Seleccione Microruta/Lote",
					  allowClear: true
					})
					.on('select2:select', function (e) {
						var data = e.params.data;
						self.createForm.schedule = data.id;
						$('.dropzone1').removeClass('hide');
					});
				});
			} catch(e){
				console.log('error en loadLots');
				subDialog.modal('hide');
			}
		}
	}
}).$mount('#schedule-report-before-creator');



</script>
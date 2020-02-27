<?php 

?>
<style>
button, .buttons, .btn, .modal-footer .btn+.btn {
    margin-bottom: 5px !important;
    margin-right: 5px !important;
}
.dropzone {
	max-height: 150px !important;
}
</style>
<script>
var appNotifications = new Vue({
	data: function () {
		return {
			records: [],
			geo: {
				active: false,
				msg: '',
				urlMap: '/index.php?controller=sw&action=staticmap&maptype=wikimedia&zoom=16&center=6.2386064999999995,-75.58853739999999&size=450x450',
				lat: 0,
				lng: 0,
				options: {
					enableHighAccuracy: false,
					timeout: 5000,
					maximumAge: 0
				},
			},
			myDropzone: null,
			notActive: null,
			notificacionLocale: false,
		};
	},
	mounted(){
		var self = this;
		self.load();
		self.notifyMe();
	},
	directives: {
	},
	computed: {
		urlFormSendFilePhotographicReport(){
			// console.log('fileData', fileData);
			var self = this;
			url = "/index.php?action=send_photo_schedule";
			try {
				if(self.notActive !== null && self.notActive.type == 'photographic-report-declined'){
					var fileData = self.notActive.datajson;
					if(fileData.year > 0){ url += "&year=" + fileData.year; }
					if(fileData.period !== undefined && fileData.period.name !== undefined){ url += "&period_name=" + btoa(fileData.period.name); }
					if(fileData.group !== undefined && fileData.group.name !== undefined){ url += "&group_name=" + btoa(fileData.group.name); }
					if(fileData.period !== undefined && fileData.period.id !== undefined){ url += "&period=" + (fileData.period.id); }
					if(fileData.group !== undefined && fileData.group.id !== undefined){ url += "&group=" + (fileData.group.id); }
					if(fileData.schedule !== undefined && fileData.schedule.id !== undefined){ url += "&schedule=" + (fileData.schedule.id); }
					if(fileData.schedule !== undefined && fileData.schedule.microroute !== undefined && fileData.schedule.microroute.name !== undefined){ url += "&route_name=" + btoa(fileData.schedule.microroute.name); }
					if(fileData.schedule !== undefined && fileData.schedule !== undefined && fileData.schedule.date_executed_schedule !== undefined){ url += "&date_executed=" + (fileData.schedule.date_executed_schedule); }
					if(fileData.type !== undefined){ url += "&type=" + (fileData.type); }
					
					url += "&lat=" + (self.geo.lat);
					url += "&lng=" + (self.geo.lng);
					
					//return url + "&type=";
					console.log('url final: ', url);
				}
				return url;
			} catch(e){
				console.error(e)
				return '';
			}
		},
	},
	methods: {
		notifyMe() {
            var self = this;
			// Let's check if the browser supports notifications
			if (!("Notification" in window)) {
				alert("This browser does not support desktop notification");
			}
			
			// Let's check whether notification permissions have already been granted
			else if (Notification.permission === "granted") {
				// If it's okay let's create a notification
				self.notificacionLocale = true;
				self.syncNotifications();
				// var notification = new Notification("Ahora veras tus notificaciones en esta parte");
			}
			
			// Otherwise, we need to ask the user for permission
			else if (Notification.permission !== 'denied') {
				Notification.requestPermission(function (permission) {
					// If the user accepts, let's create a notification
					if (permission === "granted") {
						// var notification = new Notification("granted");
						self.notificacionLocale = true;
						self.syncNotifications();
					}
				});
			}
			// At last, if the user has denied notifications, and you 
			// want to be respectful there is no need to bother them any more.
		},
		syncNotifications(){
            var self = this;
			if(localStorage.lastNotificationMV){
				date = moment(localStorage.lastNotificationMV);
				if(date.isValid()){
					totalDays = moment().diff(date, 'minutes');
					if(totalDays >= 5){
						loadSyncNots();
					}
				} else {
					self.loadSyncNots();
				}
			} else {
				self.loadSyncNots();
			}
		},
		loadSyncNots(){
            var self = this;
			console.log('loadSyncNots');
			self.meNotificationsPendings(function(a){
				(Array.isArray(a) === true ? a : []).forEach(function(b){
					b.datajson = JSON.parse(b.datajson);
					$create = false;
					$title = 'Nueva notificacion';
					$messageTxt = 'Tienes una nueva notificacion.';
					$buttonsBox = $('<div></div>');
					
					if(b.type == 'photographic-report-declined'){
						$title = 'Foto rechazada';
						$messageTxt = "Se ha rechazado una fotografia tuya en una microruta. "+ b.datajson.schedule.microroute.name;
						$create = true;
					} else if(b.type == 'schedule-executed'){
						$title = b.datajson.microroute.name;
						$messageTxt = 'se ha cambiado el estado a "Ejecutado".';						
						$create = true;
					} else if(b.type == 'novelty-execution-schedule'){
						$title = 'Hay una observación';
						$messageTxt = b.datajson.schedule.microroute.name + ' necesita gestion, gestionala para continuar la aprobación.';
						$create = true;
					} else if(b.type == 'new-communication-client'){
						$title = 'Nuevo mensaje';
						$messageTxt = b.datajson.message.substr(0,65);
						$create = true;
					} else if(b.type == 'response-communication-client'){
						$title = 'Respondimos tu solicitud.';
						$messageTxt = b.datajson.message.substr(0,65);
						$create = true;
					}
					
					if($create == true){
						console.log('title', $title);
						console.log('messageTxt', $messageTxt);
						
						var notification = new Notification($title, {
							id: b.id,
							body: $messageTxt,
							data: b,
						}).onclick = function(event) {
							window.open('<?= $this->urlServer(); ?>');
						};
					}
				});
				localStorage.lastNotificationMV = new Date();
			});
		},
		addToTask: function(){
            var self = this;
            setTimeout(self.load, 300000); // 300000 == 5 Minutos || 1Min = 60000 || 1Seg = 1000
        },
		openNotificationInModal(dataNot, eljQuery){
			var self = this;
			try {
				self.notActive = dataNot;
				
				if(dataNot.type == 'photographic-report-declined'){
					MV.api.read('/reports_photographic/' + dataNot.datajson.id, {}, function(img){
						$messageTxt = $('<div></div>');
						$title = 'Foto rechazada';
						$parrOne = $('<p></p>')
							.append("Se ha rechazado una fotografia tuya en la microruta <b>" + dataNot.datajson.schedule.microroute.name + "</b>")
							.append(
								$('<b></b>').append($('<br />'))
								.append("F. programacion: " )
								.append(dataNot.datajson.schedule.date_executed_schedule)
								.append(moment(dataNot.datajson.schedule.date_executed_schedule_end).subtract({ days: 1 }).format('Y-MM-DD') == dataNot.datajson.schedule.date_executed_schedule ? '' 
									: '/' + moment(dataNot.datajson.schedule.date_executed_schedule_end).subtract({ days: 1 }).format('Y-MM-DD'))
							);
						
						$previewsDropzone = $('<div></div>').attr('id', 'previews-dropzone-notifications').attr('class', 'table table-striped files')
							.append($('<div></div>').attr('id', 'template-dropzone-notifications').attr('class', 'file-row')
								.append($('<div></div>')
									.append($('<span></span>').attr('class', 'preview').append($('<img />').attr('data-dz-thumbnail', '')))
								)
								
								.append($('<div></div>')
									.append($('<p></p>').attr('class', 'name').attr('data-dz-name', ''))
									.append($('<strong></strong>').attr('class', 'error text-danger').attr('data-dz-errormessage', ''))
								)
								
								.append($('<div></div>')
									.append($('<p></p>').attr('class', 'size').attr('data-dz-size', ''))
									.append(
										$('<div></div>').attr('class', 'progress progress-striped active').attr('role', 'progressbar').attr('aria-valuemin', '0').attr('aria-valuemax', '100').attr('aria-valuenow', '0')
											.append($('<div></div>').attr('class', 'progress-bar progress-bar-success').attr('style', 'width:0%;').attr('data-dz-uploadprogress', ''))
									)
								)
								
								.append($('<div></div>')
									.append($('<button></button>').attr('class', 'btn btn-primary start-dropzone-notifications')
										.append($('<i></i>').attr('class', 'glyphicon glyphicon-upload'))
										.append($('<span></span>').append('Subir')))
									.append($('<button></button>').attr('class', 'btn btn-danger cancel').attr('data-dz-remove', '')
										.append($('<i></i>').attr('class', 'glyphicon glyphicon-ban-circle'))
										.append($('<span></span>').append('Cancelar')))
									.append($('<button></button>').attr('class', 'btn btn-danger delete').attr('data-dz-remove', '')
										.append($('<i></i>').attr('class', 'glyphicon glyphicon-trash'))
										.append($('<span></span>').append('Eliminar')))
								)
							);
						
						
					
						$imgBox = $('<div></div>').attr('class', 'row')
							.append(
								$('<div></div>').attr('class', 'col-xs-7')
									.append(
										$('<img />')
											.attr('class', 'img img-responsive')
											.attr('src', img.file_path_short)
									)
							).append(
								$('<div></div>').attr('class', 'col-xs-5')
									.append($('<div></div>').attr('class', 'btn btn-default').attr('id', 'fileinput-button-modal-notifications').text('Subir otra foto/archivo'))
									.append($('<div></div>').attr('class', 'dropzone').attr('id', 'dropzone-notifications').attr('style', 'max-height: 150px !important;'))
									.append($previewsDropzone)
							);
						
						$messageTxt.append($parrOne).append($('<b></b>')).append($imgBox);
						
						var dialog = bootbox.dialog({
							title: $title,
							message: $messageTxt.html(),
							size: 'large',
							className: 'rubberBand animated',
							buttons: {
								cancel: {
									label: "Cerrar",
									className: 'btn-danger',
									callback: function(){
										console.log('Custom cancel clicked');
									}
								},
								noclose: {
									label: "Subir todo",
									className: 'btn-warning',
									callback: function(){
										console.log('Custom button clicked');
										self.myDropzone.enqueueFiles(self.myDropzone.getFilesWithStatus(Dropzone.ADDED));
										return false;
									}
								},
								ok: {
									label: "Marcar como leida",
									className: 'btn-default',
									callback: function(){
										console.log('Custom OK clicked');
											bootbox.confirm({
												message: "Marcar notificacion como leida?.",
												locale: 'es',
												buttons: { confirm: { label: 'Marcar', }, },
												callback: function (result) {
													if(result === true){
														MV.api.update('/notifications/' + dataNot.id, {
															read: 1,
															updated_by: <?= ($this->user->id); ?>
														},function(xs){
															eljQuery.remove();
															$count.text(parseInt($count.text())-1);
														});
													}
												}
											});
										
									}
								},
							}
						})
						.init(function (){
							var previewNode = document.querySelector("#template-dropzone-notifications");
							previewNode.id = "";
							var previewTemplate = previewNode.parentNode.innerHTML;
							previewNode.parentNode.removeChild(previewNode);
							
							var myDropzone = self.myDropzone = new Dropzone('#dropzone-notifications', {
								// Make the whole body a dropzone
								url: self.urlFormSendFilePhotographicReport, // Set the url
								thumbnailWidth: 80,
								thumbnailHeight: 80,
								parallelUploads: 3,
								previewTemplate: previewTemplate,
								autoQueue: false, // Make sure the files aren't queued until manually added
								previewsContainer: "#previews-dropzone-notifications", // Define the container to display the previews
								clickable: "#fileinput-button-modal-notifications", // Define the element that should be used as click trigger to select files.
								init: function() {
									this.on("processing", function(file) {
										console.log('processing');
										this.options.url = self.urlFormSendFilePhotographicReport;
									});
								},
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
							  file.previewElement.querySelector(".start-dropzone-notifications").onclick = function() { myDropzone.enqueueFile(file); };
							});
							// Update the total progress bar
							myDropzone.on("totaluploadprogress", function(progress) {
							  $("#total-progress .progress-bar").css('width', progress + "%");
							});

							myDropzone.on("sending", function(file) {
							  // Show the total progress bar when upload starts
							  $("#total-progress").css('opacity', "1");
							  // And disable the start button
							  file.previewElement.querySelector(".start-dropzone-notifications").setAttribute("disabled", "disabled");
							});
							// Hide the total progress bar when nothing's uploading anymore
							myDropzone.on("queuecomplete", function(progress) {
							  $("#total-progress").css('opacity', "0");
							});
							// Hide the total progress bar when nothing's uploading anymore
							myDropzone.on("success", function(file, response) {
								if(response.error == false){
									myDropzone.removeFile(file);
									errors = false;
									
									$inputGroup = $(self.canvasToElementMedia(response.files[0]));
									$inputGroup.click(function(){
										// console.log('click');
										self.abrir_Popup($(this).data('path_short'), 'Visor de fotos rápido');
									});
									
									$("#screenshots-images").append($inputGroup);
									self.createLogSchedule({
										schedule: dataNot.datajson.schedule.ID,
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
						});
					})
				} 
				else if(dataNot.type == 'schedule-executed'){
					console.log('dataNot', dataNot);
					$title = dataNot.datajson.microroute.name;
					$parrOne = $('<p></p>')
						.append('El gestor revisó el progreso y a cambiado el estado de una programacion a "<b>Ejecutado</b>".').append($('<br />'))
						.append($('<br />')).append('<b>Microruta: </b>' + dataNot.datajson.microroute.name)
						.append($('<br />')).append('<b>Lote: </b>' + dataNot.datajson.microroute.id_ref)
						.append($('<br />')).append('<b>Lote Direccion(es): </b>' + dataNot.datajson.microroute.address_text)
						.append($('<br />')).append('<b>Cuadrilla: </b>' + dataNot.datajson.group.name)
						.append($('<br />')).append('<b>Periodo: </b>' + dataNot.datajson.period.name + ' ' + dataNot.datajson.year)
						.append($('<br />')).append('<b>Fecha Programacion: </b>' + dataNot.datajson.date_executed_schedule)
							.append(
								((moment(dataNot.datajson.date_executed_schedule_end)
									.subtract({ days: 1}).format('Y-MM-DD')) == dataNot.datajson.date_executed_schedule) ? '' : '/' + moment(dataNot.datajson.date_executed_schedule_end).subtract({ days: 1}).format('Y-MM-DD')
								);
					
					bootbox.alert({
						locale: 'es',
						title: $title,
						message: $parrOne.html(),
						size: 'large',
						buttons: {
							ok: {
								label: "Marcar como leida",
							}
						},
						className: 'rubberBand animated',
						callback: function () {
							bootbox.confirm({
								message: "Marcar notificacion como leida?.",
								locale: 'es',
								buttons: { confirm: { label: 'Marcar', }, },
								callback: function (result) {
									if(result === true){
										MV.api.update('/notifications/' + dataNot.id, {
											read: 1,
											updated_by: <?= ($this->user->id); ?>
										},function(xs){
											eljQuery.remove();
											$count.text(parseInt($count.text())-1);
										});
									}
								}
							});
						}
					});
					
					//$messageTxt.append($parrOne);
					$create = true;
				} 
				else if(dataNot.type == 'novelty-execution-schedule'){
					$title = dataNot.datajson.schedule.microroute.name + ' | Necesita de tu gestion.';
					$parrOne = $('<p></p>').append('Hay una observación, gestionala para continuar la aprobación.');
					$parrTwo = $('<p></p>')
						.append($('<b></b>').append('Observacion recibida: '))
						.append($('<br />'))
						.append($('<pre></pre>').append($('<code></code>').append(dataNot.datajson.novelty.comment)))
						.append($('<br />'))
						//.append($('<pre></pre>').append($('<code></code>').append(JSON.stringify(dataNot.datajson.novelty))))
						//.append($('<b></b>').text('Observacion recibida: ').attr('class', 'pull-right'))
						.append($('<div></div>').attr('class', 'clearfix'));
					
					$bodyBox = $('<p></p>').append($parrOne).append($parrTwo);
					
					MV.api.read('/schedule_execution_novelties/' + dataNot.datajson.novelty.id, {
					}, function(noveltyLive){
						var isEditable = noveltyLive.status == 0 ? true : false;
						console.log('noveltyLive',noveltyLive);
						
						MV.api.readList('/groups_managers', {
							filter: [
								'group,eq,' + dataNot.datajson.novelty.group
							]
						}, function(nn){
							console.log('dataNot.datajson.novelty.group', dataNot.datajson.novelty.group);
							console.log('nn', nn);
							var isManager = nn.findIndex((a) => a.user === <?= $this->user->id; ?>);
							console.log('isManager', isManager);
							if(isEditable == false){
								$bodyBox.append($('<p></p>').append("La novedad ya fue gestionada."));
							}
							
							var buttonsEnabled = {
								cancel: {
									label: "Cerrar",
									className: 'btn-danger',
									callback: function(){
										console.log('Custom cancel clicked');
									}
								},
								ok: {
									label: "Marcar como leida",
									className: 'btn-default',
									callback: function(){
										bootbox.confirm({
											message: "Marcar notificacion como leida?.",
											locale: 'es',
											buttons: { confirm: { label: 'Marcar', }, },
											callback: function (result) {
												if(result === true){
													MV.api.update('/notifications/' + dataNot.id, {
														read: 1,
														updated_by: <?= ($this->user->id); ?>
													},function(xs){
														eljQuery.remove();
														$count.text(parseInt($count.text())-1);
													});
												}
											}
										});
									}
								},
							};
							
							if(isManager >= 0 && isEditable == true){
								buttonsEnabled.noclose2 = {
									label: "Subir fotos Antes",
									className: 'btn-warning',
									callback: function(){
										urlOpen = ('/index.php?controller=site&action=Photographic_Report_Live_Offline&type=A');
										// window.open(urlOpen, '_blank');
										window.location.replace(urlOpen);
										return false;
									}
								};
								
								buttonsEnabled.noclose3 = {
									label: "Subir fotos Despues",
									className: 'btn-warning',
									callback: function(){
										urlOpen = ('/index.php?controller=site&action=Photographic_Report_Live_Offline&type=D');
										//window.open(urlOpen, '_blank');
										window.location.replace(urlOpen);
										return false;
									}
								};
								buttonsEnabled.noclose1 = {
									label: "Gestionada",
									className: 'btn-success',
									callback: function(){
										bootbox.confirm({
											message: "Marcar observacion como gestionada?, se enviará una notificación al cliente para ser gestionada su aprobación.",
											locale: 'es',
											buttons: { confirm: { label: 'Confirmar', }, },
											callback: function (result) {
												if(result === true){
													MV.api.update('/schedule_execution_novelties/' + dataNot.datajson.novelty.id, {
														status: 1,
														updated_by: <?= ($this->user->id); ?>
													},function(xs){
														MV.api.update('/schedule/' + dataNot.datajson.schedule.id, {
															in_novelty: 0,
															updated_by: <?= ($this->user->id); ?>
														},function(xs2){
															self.createLogSchedule({
																schedule: dataNot.datajson.schedule.id,
																action: 'event-out-novelty',
																data: {
																	in_novelty: 0,
																	updated_by: <?= ($this->user->id); ?>
																},
																response: xs2,
															}, function(w){
																bootbox.confirm({
																	message: "Marcar notificacion como leida?.",
																	locale: 'es',
																	buttons: { confirm: { label: 'Marcar', }, },
																	callback: function (result) {
																		if(result === true){
																			MV.api.update('/notifications/' + dataNot.id, {
																				read: 1,
																				updated_by: <?= ($this->user->id); ?>
																			},function(xs){
																				eljQuery.remove();
																				$count.text(parseInt($count.text())-1);
																			});
																		}
																	}
																});
															});
														});
													});
												}
											}
										});
									}
								};
								
							};
							
							var dialog = bootbox.dialog({
								title: $title,
								message: $bodyBox.html(),
								size: 'large',
								className: 'rubberBand animated',
								buttons: buttonsEnabled
							})
							.init(function (){});
						});
						
					});
						
					$create = true;
				} 
				else if(dataNot.type == 'new-communication-client'){
					MV.api.read('/accounts_communications/' + dataNot.datajson.communication, {
						join: [
							'accounts',
							'users',
							'accounts_communications_parts,users',
						]
					}, function(communication){
						var isEditable = communication.is_closed == 0 ? true : false;
						console.log('communication', communication);
						
						$messagesHtml = $('<div></div>').attr('class', 'row').attr('id', 'notifications-list-parts-box');
						communication.accounts_communications_parts.forEach((x) => {
							$messagesHtml.append(
								$('<div></div>').attr('class', 'col-md-12')
									.append($('<strong></strong>').text(x.created_by.surname + ' ' + x.created_by.names + ' '))
									.append($('<span></span>').text('(' + x.created_by.email + ') '))
									.append($('<strong></strong>').attr('class', 'pull-right').text(x.created))
									.append($('<p></p>').append(x.message))
							);
						});
						
						$title = "Nuevo mensaje/comunicacion del cliente " + communication.account.names + ' ' + communication.account.surname;
						
						
						if(isEditable == true){
							$buttonReply = $('<button></button>')
								.attr('id', 'btn-notifications-modal-communications-reply')
								.attr('class', 'btn btn-sm btn-primary')
								.attr('type', 'button')
								.append($('<i></i>').attr('class', 'fa fa-reply'))
								.append(' Responder');
							$buttonMarkAsSolved = $('<button></button>')
								.attr('id', 'btn-notifications-modal-communications-solved')
								.attr('class', 'btn btn-sm btn-success')
								.attr('type', 'button')
								.append($('<i></i>').attr('class', 'fa fa-check'))
								.append(' Gestión completa ');
						}
						else {
							$buttonReply = $('<div></div>');
							$buttonMarkAsSolved = $('<div></div>');
						}
						
						$Body = $('<div></div>').attr('class', 'row')
							.append($('<div></div>').attr('class', 'col-sm-12 mail_list_column'))
							.append($('<div></div>').attr('class', 'col-sm-12 mail_view').attr('id', 'notifications-box-current-part')
							.append(
								$('<div></div>').attr('class', 'inbox-body')
									.append(
										$('<div></div>').attr('class', 'mail_heading row')
											.append($('<div></div>').attr('class', 'col-md-8').append(
													$('<div></div>').attr('class', 'btn-group')
														.append($buttonReply)
														.append($buttonMarkAsSolved)
												)
											)
											.append($('<div></div>').attr('class', 'col-md-4 text-right').append($('<p></p>').attr('class', 'date').attr('style', 'zoom:0.8;').text('Última actividad')))
											.append($('<div></div>').attr('class', 'col-md-12').append($('<h2></h2>')))
									)
									.append(
										$('<div></div>').attr('class', 'sender-info')
											.append($('<div></div>').attr('class', 'view-mail').append($('<div></div>').append($messagesHtml)))
											.append($('<div></div>').attr('class', 'ln_solid'))
									)
							));
						
						$bodyBox = $('<div></div>').attr('class', 'row').append($Body);
						
						if(isEditable == false){
							$bodyBox.append($('<p></p>').append("La comunicacion posiblemente ya fue gestionada o el cliente cambio su estado a solucionada."));
						}
					
						var buttonsEnabled = {
							cancel: {
								label: "Cerrar",
								className: 'btn-danger',
								callback: function(){
									console.log('Custom cancel clicked');
								}
							},
							ok: {
								label: "Marcar como leida",
								className: 'btn-default',
								callback: function(){
									bootbox.confirm({
										message: "Marcar notificacion como leida?.",
										locale: 'es',
										buttons: { confirm: { label: 'Marcar', }, },
										callback: function (result) {
											if(result === true){
												MV.api.update('/notifications/' + dataNot.id, {
													read: 1,
													updated_by: <?= ($this->user->id); ?>
												},function(xs){
													eljQuery.remove();
													$count.text(parseInt($count.text())-1);
												});
											}
										}
									});
								}
							},
						};
						
						var dialog = bootbox.dialog({
							title: $title,
							message: $bodyBox.html(),
							size: 'large',
							className: 'rubberBand animated',
							buttons: buttonsEnabled
						})
						.init(function (){
							$('#btn-notifications-modal-communications-solved').click((event) => {
								bootbox.confirm({
									title: "Confirma tu accion",
									message: "Debes de confirmar antes de cambiar esta comunicacion a \"Solucionada\", eventualmente será cerrada por nuestro sistema y no recibiras mas notificaciones.",
									locale: 'es',
									centerVertical: true,
									callback: (a) => {
										if(a == true){
											MV.api.update('/accounts_communications/' + communication.id, {
												status: 0,
												is_closed: 1,
												updated_by: <?= $this->user->id; ?>,
											}, (c) => {
												if(c > 0){
													self.MeAccountCommunications(communication.account.id);
													communication.is_closed = 1;
													new PNotify({
														"title": "Exito!",
														"text": "la comunicacion fue archivada correctamente.",
														"styling":"bootstrap3",
														"type":"success",
														"icon":true,
														"animation":"flip",
														"hide":true,
														"delay": 2500,
													});
												}
											});
										}
									}
								});
								
							});
								
							$('#btn-notifications-modal-communications-reply').click((event) => {
								bootbox.prompt({
									title: "Comunicacion a 1 click",
									message: "Escribe la informacion adiccional o el nuevo mensaje que deseas enviar.",
									locale: 'es',
									centerVertical: true,
									inputType: 'textarea',
									callback: (a) => {
										if(a !== null){
											if(a.length > 15){
												MV.api.create('/accounts_communications_parts', {
													communication: communication.id,
													account: communication.account.id,
													message: a,
													created_by: <?= $this->user->id; ?>,
													updated_by: <?= $this->user->id; ?>,
												}, (b) => {
													if(b > 0){
														MV.api.update('/accounts_communications/' + communication.id, {
															account: communication.account.id,
															status: 1,
															updated_by: <?= $this->user->id; ?>,
														}, (c) => {
															if(c > 0){
																MV.api.read('/accounts_communications_parts/' + b, {
																	filter: [
																		'account,eq,' + communication.account.id,
																	],
																	join: [
																		'users',
																	],
																}, (d) => {
																	send = {};
																	send.type = 'response-communication-client';
																	send.datajson = JSON.stringify(d);
																	send.user = d.created_by.id;
																	send.created_by = <?= $this->user->id; ?>;
																	
																	MV.api.create('/notifications', send, (f) => {
																		console.log('Result noti: ', f);
																		new PNotify({
																			"title": "Exito!",
																			"text": "la notificación se a enviado correctamente.",
																			"styling":"bootstrap3",
																			"type":"success",
																			"icon":true,
																			"animation":"flip",
																			"hide":true,
																			"delay": 2500,
																		});
																		
																		$('#notifications-list-parts-box').append(
																			$('<div></div>').attr('class', 'col-md-12')
																				.append($('<strong></strong>').text(d.created_by.surname + ' ' + d.created_by.names + ' '))
																				.append($('<span></span>').text('(' + d.created_by.email + ') '))
																				.append($('<strong></strong>').attr('class', 'pull-right').text(d.created))
																				.append($('<p></p>').append(d.message))
																		);
																	});
																	
																	/*
																	self.sendNotificationAccountGroup(communication.account.id, {
																		type: 'new-communication-client',
																		data: d,
																	});*/
																	/*
																	self.meCommunicationsPartsView.push(d);
																	self.MeAccountCommunications(communication.account.id);
																	*/
																});
															}
														});
													} else {
														self.showErrorModal("Ocurrio un error misterioso al enviar el mensaje.");
													}
												});
											} 
											else {
												self.showErrorModal("El mensaje no puede ser enviado por que es demaciado corto, danos mas informacion sobre tu solicitud.");
											}
										}
									}
								});
							});
						});
					});
				} 
				else if(dataNot.type == 'response-communication-client'){
					MV.api.read('/accounts_communications/' + dataNot.datajson.communication, {
						join: [
							'accounts',
							'users',
							'accounts_communications_parts,users',
						]
					}, function(communication){
						var isEditable = communication.is_closed == 0 ? true : false;
						console.log('communication', communication);
						
						$messagesHtml = $('<div></div>').attr('class', 'row').attr('id', 'notifications-list-parts-box');
						communication.accounts_communications_parts.forEach((x) => {
							$messagesHtml.append(
								$('<div></div>').attr('class', 'col-md-12')
									.append($('<strong></strong>').text(x.created_by.surname + ' ' + x.created_by.names + ' '))
									.append($('<span></span>').text('(' + x.created_by.email + ') '))
									.append($('<strong></strong>').attr('class', 'pull-right').text(x.created))
									.append($('<p></p>').append(x.message))
							);
						});
						
						$title = "Respondimos tu mensaje/comunicacion";
						
						if(isEditable == true){
							$buttonReply = $('<button></button>')
								.attr('id', 'btn-notifications-modal-communications-reply')
								.attr('class', 'btn btn-sm btn-primary')
								.attr('type', 'button')
								.append($('<i></i>').attr('class', 'fa fa-reply'))
								.append(' Responder');
							$buttonMarkAsSolved = $('<button></button>')
								.attr('id', 'btn-notifications-modal-communications-solved')
								.attr('class', 'btn btn-sm btn-success')
								.attr('type', 'button')
								.append($('<i></i>').attr('class', 'fa fa-check'))
								.append(' Gestión completa ');
						}
						else {
							$buttonReply = $('<div></div>');
							$buttonMarkAsSolved = $('<div></div>');
						}
						
						
						$Body = $('<div></div>').attr('class', 'row')
							.append($('<div></div>').attr('class', 'col-sm-12 mail_list_column'))
							.append($('<div></div>').attr('class', 'col-sm-12 mail_view').attr('id', 'notifications-box-current-part')
							.append(
								$('<div></div>').attr('class', 'inbox-body')
									.append(
										$('<div></div>').attr('class', 'mail_heading row')
											.append($('<div></div>').attr('class', 'col-md-8').append(
													$('<div></div>').attr('class', 'btn-group')
														.append($buttonReply)
														.append($buttonMarkAsSolved)
												)
											)
											.append($('<div></div>').attr('class', 'col-md-4 text-right').append($('<p></p>').attr('class', 'date').attr('style', 'zoom:0.8;').text('Última actividad')))
											.append($('<div></div>').attr('class', 'col-md-12').append($('<h2></h2>')))
									)
									.append(
										$('<div></div>').attr('class', 'sender-info')
											.append($('<div></div>').attr('class', 'view-mail').append($('<div></div>').append($messagesHtml)))
											.append($('<div></div>').attr('class', 'ln_solid'))
									)
							));
						
						$bodyBox = $('<div></div>').attr('class', 'row').append($Body);
						
						if(isEditable == false){
							$bodyBox.append($('<p></p>').append("La comunicacion posiblemente ya fue gestionada o el cliente cambio su estado a solucionada."));
						}
					
						var buttonsEnabled = {
							cancel: {
								label: "Cerrar",
								className: 'btn-danger',
								callback: function(){
									console.log('Custom cancel clicked');
								}
							},
							ok: {
								label: "Marcar como leida",
								className: 'btn-default',
								callback: function(){
									bootbox.confirm({
										message: "Marcar notificacion como leida?.",
										locale: 'es',
										buttons: { confirm: { label: 'Marcar', }, },
										callback: function (result) {
											if(result === true){
												MV.api.update('/notifications/' + dataNot.id, {
													read: 1,
													updated_by: <?= ($this->user->id); ?>
												},function(xs){
													eljQuery.remove();
													$count.text(parseInt($count.text())-1);
												});
											}
										}
									});
								}
							},
						};
						
						var dialog = bootbox.dialog({
							title: $title,
							message: $bodyBox.html(),
							size: 'large',
							className: 'rubberBand animated',
							buttons: buttonsEnabled
						})
						.init(function (){
							$('#btn-notifications-modal-communications-solved').click((event) => {
								bootbox.confirm({
									title: "Confirma tu accion",
									message: "Debes de confirmar antes de cambiar esta comunicacion a \"Solucionada\", eventualmente será cerrada por nuestro sistema y no recibiras mas notificaciones.",
									locale: 'es',
									centerVertical: true,
									callback: (a) => {
										if(a == true){
											MV.api.update('/accounts_communications/' + communication.id, {
												status: 0,
												is_closed: 1,
												updated_by: <?= $this->user->id; ?>,
											}, (c) => {
												if(c > 0){
													self.MeAccountCommunications(communication.account.id);
													communication.is_closed = 1;
													new PNotify({
														"title": "Exito!",
														"text": "la comunicacion fue archivada correctamente.",
														"styling":"bootstrap3",
														"type":"success",
														"icon":true,
														"animation":"flip",
														"hide":true,
														"delay": 2500,
													});
												}
											});
										}
									}
								});
								
							});
								
							$('#btn-notifications-modal-communications-reply').click((event) => {
								bootbox.prompt({
									title: "Comunicacion a 1 click",
									message: "Escribe la informacion adiccional o el nuevo mensaje que deseas enviar.",
									locale: 'es',
									centerVertical: true,
									inputType: 'textarea',
									callback: (a) => {
										if(a !== null){
											if(a.length > 15){
												MV.api.create('/accounts_communications_parts', {
													communication: communication.id,
													account: communication.account.id,
													message: a,
													created_by: <?= $this->user->id; ?>,
													updated_by: <?= $this->user->id; ?>,
												}, (b) => {
													if(b > 0){
														MV.api.update('/accounts_communications/' + communication.id, {
															account: communication.account.id,
															status: 0,
															updated_by: <?= $this->user->id; ?>,
														}, (c) => {
															if(c > 0){
																MV.api.read('/accounts_communications_parts/' + b, {
																	filter: [
																		'account,eq,' + communication.account.id,
																	],
																	join: [
																		'users',
																	],
																}, (d) => {
																	send = {};
																	send.type = 'response-communication-client';
																	send.datajson = JSON.stringify(d);
																	send.user = d.created_by.id;
																	send.created_by = <?= $this->user->id; ?>;
																	
																	MV.api.create('/notifications', send, (f) => {
																		console.log('Result noti: ', f);
																		new PNotify({
																			"title": "Exito!",
																			"text": "la notificación se a enviado correctamente.",
																			"styling":"bootstrap3",
																			"type":"success",
																			"icon":true,
																			"animation":"flip",
																			"hide":true,
																			"delay": 2500,
																		});
																		
																		$('#notifications-list-parts-box').append(
																			$('<div></div>').attr('class', 'col-md-12')
																				.append($('<strong></strong>').text(d.created_by.surname + ' ' + d.created_by.names + ' '))
																				.append($('<span></span>').text('(' + d.created_by.email + ') '))
																				.append($('<strong></strong>').attr('class', 'pull-right').text(d.created))
																				.append($('<p></p>').append(d.message))
																		);
																	});
																	
																	/*
																	self.sendNotificationAccountGroup(communication.account.id, {
																		type: 'new-communication-client',
																		data: d,
																	});*/
																	/*
																	self.meCommunicationsPartsView.push(d);
																	self.MeAccountCommunications(communication.account.id);
																	*/
																});
															}
														});
													} else {
														self.showErrorModal("Ocurrio un error misterioso al enviar el mensaje.");
													}
												});
											} 
											else {
												self.showErrorModal("El mensaje no puede ser enviado por que es demaciado corto, danos mas informacion sobre tu solicitud.");
											}
										}
									}
								});
							});
						});
					});
				}
				
			} catch (e){
				console.error(e);
				console.log(e);
			}
		},
		sendNotificationAccountGroup(account_id, data){
			var self = this;
			try{
				MV.api.read('/accounts/' + account_id, {
					join: [
						'notifications_groups,notifications_groups_users'
					]
				}, (a) => {
					if(a.notifications_group !== undefined && a.notifications_group.id){
						a.notifications_group.notifications_groups_users.forEach((b) => {
							send = {};
							send.type = data.type;
							send.datajson = JSON.stringify(data.data);
							send.user = b.user;
							send.created_by = <?= $this->user->id; ?>;
							
							MV.api.create('/notifications', send, (a) => {
								console.log('Result noti: ', a);
							});
						});
					}
				});
			}
			catch(e){
				console.error(e);
				callb(e)
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
		load(task){
			var self = this;
			var task = (task !== undefined) ? true : task;
			$Ul = $('#menu-notifications-top');
			$count = $('#count-notifications');
			if(self.records.length == 0){
				$Ul.html('<li><a><i class="fa fa-spinner fa-spin"></i> Cargando, espere... </a></li>');
				$count.text(0);
				self.meNotificationsPendings(function(a){
					self.records = Array.isArray(a) === true ? a : [];
					$Ul.html('');
					self.records.forEach(function(b){
						b.datajson = JSON.parse(b.datajson);
						$create = false;
						$title = 'Nueva notificacion';
						$messageTxt = 'Tienes una nueva notificacion.';
						$buttonsBox = $('<div></div>');
						
						if(b.type == 'photographic-report-declined'){
							$title = 'Foto rechazada';
							$messageTxt = "Se ha rechazado una fotografia tuya en la microruta "+ b.datajson.schedule.microroute.name +".<br><b>F. programacion: </b>" + b.datajson.schedule.date_executed_schedule;
							$messageTxt += (moment(b.datajson.schedule.date_executed_schedule_end).subtract({ days: 1 }).format('Y-MM-DD') == b.datajson.schedule.date_executed_schedule) ? '' : '/' + moment(b.datajson.schedule.date_executed_schedule_end).subtract({ days: 1 }).format('Y-MM-DD');
							$create = true;
						} else if(b.type == 'schedule-executed'){
							$title = b.datajson.microroute.name;
							$messageTxt = 'se ha cambiado el estado a "Ejecutado".';						
							$create = true;
						} else if(b.type == 'novelty-execution-schedule'){
							$title = 'Hay una observación';
							$messageTxt = b.datajson.schedule.microroute.name + ' necesita gestion, gestionala para continuar la aprobación.';
							$create = true;
						} else if(b.type == 'new-communication-client'){
							$title = 'Nuevo mensaje';
							$messageTxt = b.datajson.message.substr(0,65);
							$create = true;
						} else if(b.type == 'response-communication-client'){
							$title = 'Respondimos tu solicitud.';
							$messageTxt = b.datajson.message.substr(0,65);
							$create = true;
						}
						
						if($create == true){
							/*
							$buttonReadNot = $('<button></button>').attr('style', 'display: inline-flex;zoom:0.5;').attr('class', 'btn-round btn-success').append($('<i></i>').attr('class', 'fa fa-check')).click(function(){
								$thisElement = $(this);
								bootbox.confirm({
									message: "Marcar notificacion como leida?.",
									locale: 'es',
									buttons: { confirm: { label: 'Marcar', }, },
									callback: function (result) {
										if(result === true){
											MV.api.update('/notifications/' + b.id, {
												read: 1,
												updated_by: <?= ($this->user->id); ?>
											},function(xs){
												$thisElement.remove();
												$count.text(parseInt($count.text())-1);
											});
										}
									}
								});
							});
							$buttonsBox.append($buttonReadNot);*/
							
							$count.text(parseInt($count.text())+1);
							$spanTime = $('<span></span>').attr('class', 'time').attr('style', 'display: inline-flex;').append(moment(b.created).format('DD-MM-Y HH:mm:ss')).append($buttonsBox);
							$spanUsername = $('<span></span>').append($title);
							
							$spanBox = $('<span></span>').append($spanUsername).append($spanTime);
							$message = $('<span></span>').attr('class', 'message').append($messageTxt);
							
							$ABox = $('<a></a>').append($spanBox).append($message);
							
							$Li = $('<li></li>').append($ABox).click(function(){
								self.openNotificationInModal(b, $(this));
							});
							
							$Ul.append($Li);
						}
					});
					
					if(self.records.length == 0){
						$Li = $('<li></li>').append($('<a></a>').append(
							$('<span></span>').append('').append('')
						).append(
							$('<span></span>').attr('class', 'message').append('No tienes notificaciones sin leer.')
						));
						$Ul.append($Li);
					}
					
					if(task == true){
						self.addToTask();
					}
				});
			}
		},
		meNotificationsPendings(call){
			var self = this;
			try{
				MV.api.readList('/notifications', {
					filter: [
						'user,eq,<?= $this->user->id; ?>',
						'read,eq,0'
					],
					order: 'created,desc'
				}, call);
			} catch(e){
				
			}
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
	}
}).$mount('#notifications-navbar-top');
</script>
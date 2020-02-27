<style>
.tinder {
	width: 100%;
	min-height: 87vh;
	overflow: inherit;
	display: flex;
	flex-direction: column;
	position: relative;
	opacity: 0;
	transition: opacity 0.1s ease-in-out;
	/* background: brown; */
}

.loaded.tinder {
	opacity: 1;
}

.tinder--status {
	position: absolute;
	top: 50%;
	/* margin-top: -30px; */
	z-index: 2;
	width: 100%;
	text-align: center;
	pointer-events: none;
}

.tinder--status i {
	font-size: 100px;
	opacity: 0;
	transform: scale(0.3);
	transition: all 0.2s ease-in-out;
	position: absolute;
	width: 100px;
	margin-left: -50px;
}

.tinder_love .fa-check {
	opacity: 0.7;
	transform: scale(1);
}

.tinder_nope .fa-remove {
	opacity: 0.7;
	transform: scale(1);
}

.tinder--cards {
	flex-grow: 1;
	padding-top: 40px;
	text-align: center;
	display: flex;
	justify-content: center;
	align-items: flex-end;
	z-index: 1;
}

.tinder--card {
	display: inline-block;
	width: 90vw;
	max-width: 90%;
	height: 70vh;
	/* background: #337ab7; */
	background: #F7F7F7;
	padding-bottom: 40px;
	border-radius: 8px;
	overflow: hidden;
	position: absolute;
	will-change: transform;
	transition: all 0.3s ease-in-out;
	cursor: -webkit-grab;
	cursor: -moz-grab;
	cursor: grab;
	
	inline-size: 450px;
}

.moving.tinder--card {
  transition: none;
  cursor: -webkit-grabbing;
  cursor: -moz-grabbing;
  cursor: grabbing;
}

.tinder--card img {
  max-width: 100%;
  pointer-events: none;
}

.tinder--card h3 {
  margin-top: 32px;
  font-size: 32px;
  padding: 0 16px;
  pointer-events: none;
}

.tinder--card p {
  margin-top: 24px;
  font-size: 20px;
  padding: 0 16px;
  pointer-events: none;
}

.tinder--buttons {
	flex: 0 0 100px;
	text-align: center;
	padding-top: 20px;
    z-index: 9999999999;
}

.tinder--buttons button {
  border-radius: 50%;
  line-height: 60px;
  width: 60px;
  border: 0;
  background: #FFFFFF;
  display: inline-block;
  margin: 0 8px;
}

.tinder--buttons button:focus {
  outline: 0;
}

.tinder--buttons i {
  font-size: 32px;
  vertical-align: middle;
}

.fa-check {
  color: #6ba74c;
}

.fa-remove {
  color: #CDD6DD;
}

.modal {
	z-index: 9999999999;
}
</style>
<div id="reporting-app">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 col-xs-offset-0">
				<div class="tinder col-md-12">
					<div class="tinder--status">
						<i class="fa fa-remove"></i>
						<i class="fa fa-check"></i>
					</div>
					<div class="tinder--cards col-md-12">
						<div v-for="(record, record_i) in records" class="tinder--card" :id="record.id">
							<img :src="record.file_path_short">
							<h3>
								{{ record.schedule.microroute.name }} - {{ (record.type == 'A') ? 'Antes' : (record.type == 'D') ? 'Despues' : 'Otro' }} - {{ record.created }} 
							</h3>
							<p>
								{{ record.schedule.period.name }} - {{ record.year }}<br>
								{{ record.schedule.group.name }}<br>
								{{ record.schedule.date_executed_schedule }} - {{ record.schedule.date_executed_schedule_end }}<br>
							</p>
						</div>
					</div>
					<div class="tinder--buttons col-md-12">
						<button @click="declineReport" id="nope"> <i class="fa fa-remove"></i></button>
						<button id="popup" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-info"></i></button>
						<button @click="aprobeReport" id="love"><i class="fa fa-check"></i></button>
					</div>
				</div>
			</div>
			
			
			<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
				  <div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel2">Contrato CW72436 - Informe Registro Fotografico</h4>
					</div>
					<div class="modal-body">
						<h4></h4>
						<div class="row">
							<div class="col-xs-12">
								
								<div class="table-responsive">
									<table class="table table-bordered" v-if="selected.id > 0">
										<tr>
											<th width="25%">Año</th>
											<td width="25%">{{ selected.year }}</td>
											<th width="25%">Periodo</th>
											<td width="25%">{{ selected.period.name }}</td>
										</tr>
										<tr>
											<th>Fecha y Hora del Reporte</th>
											<td colspan="3">{{ selected.created }}</td>
										</tr>
										<tr>
											<th>Microruta</th>
											<td>{{ selected.schedule.microroute.name }}</td>
											<th>Área</th>
											<td>{{ selected.schedule.microroute.area_m2.toLocaleString() }} m²</td>
										</tr>
										<tr>
											<th>Direccion del Lote</th>
											<td colspan="3">{{ selected.schedule.microroute.address_text }}</td>
										</tr>
										<tr>
											<th>Descripción</th>
											<td colspan="3">
												<template v-if="selected.schedule.microroute.description !== null && selected.schedule.microroute.description !== ''">
													{{ selected.schedule.microroute.description }}
												</template>
												<template v-else>
													Sin descripción.
												</template>
											</td>
										</tr>
										<tr>
											<th>Observaciones</th>
											<td colspan="3">
												<template v-if="selected.schedule.microroute.obs !== null && selected.schedule.microroute.obs !== ''">
													{{ selected.schedule.microroute.obs }}
												</template>
												<template v-else>
													Sin observaciones.
												</template>
											</td>
										</tr>
										<tr>
											<th>Cuadrilla/Grupo</th>
											<td>{{ selected.group.name }}</td>
											<th>Reportado por</th>
											<td>{{ selected.create_by.username }}</td>
										</tr>
										<tr>
											<th colspan="2">Tipo de Foto</th>
											<td colspan="2">{{ (selected.type == 'A') ? 'Antes' : (selected.type == 'D') ? 'Despues' : 'Desconocido' }}</td>
										</tr>
										<!-- // 
										<tr>
											<td colspan="4">
												<img class="img img-responsive" width="100%" :src="selected.file_path_short" alt="image" />	
											</td>
										</tr>
										-->
									</table>
								</div>

							</div>
						</div>						<div class="table-responsives">
							<table class="table table-bordered" v-if="selected.id > 0">
								<tr>
									<td colspan="4">
										<a class="btn btn-default pull-right" :href="selected.file_path_short" target="_blank"><i class="fa fa-search-plus"></i></a>
										<a class="btn btn-default pull-right" :href="selected.file_path_short" download><i class="fa fa-download" ></i></a>
									</td>
								</tr>
							</table>
						</div>
						<!-- // 
						-->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				  </div>
				</div>
			  </div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>

<script>
var app = new Vue({
	data: function () {
		return {
			loading: true,
			records: [],
			total: 0,
			page: 1,
			limit: 1000,
			selected: {
				"id": 0,
				"route": {
					"id": 0,
					"name": "",
					"microroute": {
						"id": 0,
						"name": "",
						"address": {
							"id": 0,
							"department": 0,
							"city": 0,
							"via_principal": 0,
							"via_principal_number": "",
							"via_principal_letter": "",
							"via_principal_quadrant": "",
							"via_secondary_number": "",
							"via_secondary_letter": "",
							"via_secondary_quadrant": "",
							"via_end_number": "",
							"via_end_extra": "",
							"minsize": "",
							"complete": "",
							"point": null
						},
						"geometry": ""
					}
				},
				"year": 0,
				"type": "",
				"group": {
					"id": 0,
					"name": ""
				},
				"period": {
					"id": 0,
					"name": ""
				},
				"media": {
					"id": 0,
					"name": "",
					"type": "",
					"size": "0",
					"path_full": "",
					"path_short": "",
					"create_by": 0,
					"created": "",
					"updated": ""
				},
				"status": 0,
				"created": "1950-01-01 00:00:01",
				"created_by": {
					"id": 0,
					"username": "",
					"password": "",
					"identification_type": 0,
					"identification_number": "",
					"names": "",
					"surname": "",
					"phone": "",
					"mobile": "",
					"address": "",
					"department": 0,
					"city": 0,
					"email": "",
					"avatar": 0,
					"permissions": 0,
					"bulletin": 0,
					"marketing": 0,
					"analytic": 0,
					"registered": "1950-01-01 00:00:01",
					"updated": "1950-01-01 00:00:01",
					"last_connection": "1950-01-01 00:00:01"
				}
			},
			tinderContainer: null,
			allCards: null,
			nope: null,
			love: null,
			popup: null,
		};
	},
	mounted(){
		var self = this;
		self.load();
	},
	directives: {
		forCallback(el, binding) {
			var self = this;
			let element = binding.value
			element.callback()
			if(self.loading == true){
				var key = element.key
				var len = 0
				
				if (Array.isArray(element.array)) {
					len = element.array.length
				}
				else if (typeof element.array === 'object') {
					var keys = Object.keys(element.array)
					key = keys.indexOf(key)
					len = keys.length
				}
				
				if (key == len - 1) {
					if (typeof element.callback === 'function') {
						element.callback()
					}
				}
			}
		}
	},
	computed: {
	},
	methods: {
		callback() {
			var self = this;
			console.log('v-for loop finished');
			if(self.loading == true){
				self.runTinder();
				self.loading = false;
			}
		},
		load(){
			var self = this;
			self.loading = true;
			self.records = [];
			self.total = 0;
			var subDialog = bootbox.dialog({
				message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog"></i> Por favor espera mientras hacemos algo...</p>',
				closeButton: false
			});
			
			MV.apiFG('/api.php/records/reports_photographic', {
				params: {
					filter: [
						'status,eq,0'
					],
					join: [
						'schedule,microroutes',
						'schedule,groups',
						'schedule,periods',
						'schedule,users',
						'schedule,schedule_comments,users',
						'groups',
						'periods',
						'users',
					],
					order: "id",
					page: self.page + "," + self.limit
				}
			}).then(function (response) {
				if(response.status == 200){
					self.total = response.data.results;
					console.log('response', response.data.records);
					self.records = response.data.records;
					setTimeout(function(){
						if(self.records.length == 0){
							alert('No hay fotografias pendientes por revision...');
							/*$('.tinder').append('<h3>No hay resultados.</h3>' + '<p>No hay fotografias pendientes por revision...</p>');*/
						} else {
							self.runTinder();
						}
						subDialog.modal('hide');
					}, 3000);
					// $(".tinder--cards").html('');
				} else {
					subDialog.modal('hide');
				}
			}).catch(function (error) {
				console.log('error list-routes::methods::load()');
				console.log(error.response);
				self.loading = false;
				subDialog.modal('hide');
			});
		},
		initCards(card, index) {
			var self = this;
			var tinderContainer = document.querySelector('.tinder');
			var allCards = document.querySelectorAll('.tinder--card');
			var newCards = document.querySelectorAll('.tinder--card:not(.removed)');

			newCards.forEach(function (card, index) {
				if(index == 0){
					detect = self.records.find(x => (x.id == $(card).attr('id')));
					if(detect !== undefined){
						// console.log('card', card);
						// console.log('index', index);
						// console.log('detect', detect);
						self.selected = detect;
					}
				}
				card.style.zIndex = allCards.length - index;
				card.style.transform = 'scale(' + (20 - index) / 20 + ') translateY(-' + 30 * index + 'px)';
				card.style.opacity = (10 - index) / 10;
			});
		  
			tinderContainer.classList.add('loaded');
		},
		createButtonListener(love) {
			var self = this;
		  return function (event) {
			var cards = document.querySelectorAll('.tinder--card:not(.removed)');
			var moveOutWidth = document.body.clientWidth * 1.5;

			if (!cards.length) return false;

			var card = cards[0];

			card.classList.add('removed');

			if (love) {
			  card.style.transform = 'translate(' + moveOutWidth + 'px, -100px) rotate(-30deg)';
			} else {
			  card.style.transform = 'translate(-' + moveOutWidth + 'px, -100px) rotate(30deg)';
			}

			self.initCards();

			event.preventDefault();
		  };
		},
		runTinder(){
			var self = this;
			var tinderContainer = document.querySelector('.tinder');
			var allCards = document.querySelectorAll('.tinder--card');
			var nope = document.getElementById('nope');
			var love = document.getElementById('love');
			var popup = document.getElementById('popup');
			
			self.initCards();
			
			allCards.forEach(function (el) {
				// console.log('el', el);
				var hammertime = new Hammer(el);
				
				hammertime.on('pan', function (event) {
					el.classList.add('moving');
				});
				
				hammertime.on('pan', function (event) {
					if (event.deltaX === 0) return;
					if (event.center.x === 0 && event.center.y === 0) return;
					
					tinderContainer.classList.toggle('tinder_love', event.deltaX > 0);
					tinderContainer.classList.toggle('tinder_nope', event.deltaX < 0);
					
					var xMulti = event.deltaX * 0.03;
					var yMulti = event.deltaY / 80;
					var rotate = xMulti * yMulti;
					
					event.target.style.transform = 'translate(' + event.deltaX + 'px, ' + event.deltaY + 'px) rotate(' + rotate + 'deg)';
				});
				
				hammertime.on('panend', function (event) {
					el.classList.remove('moving');
					tinderContainer.classList.remove('tinder_love');
					tinderContainer.classList.remove('tinder_nope');
					var moveOutWidth = document.body.clientWidth;
					var keep = Math.abs(event.deltaX) < 80 || Math.abs(event.velocityX) < 0.4;
					event.target.classList.toggle('removed', !keep);
					
					if (keep) {
						event.target.style.transform = '';
					} else {
						var endX = Math.max(Math.abs(event.velocityX) * moveOutWidth, moveOutWidth);
						var toX = event.deltaX > 0 ? endX : -endX;
						var endY = Math.abs(event.velocityY) * moveOutWidth;
						var toY = event.deltaY > 0 ? endY : -endY;
						var xMulti = event.deltaX * 0.03;
						var yMulti = event.deltaY / 80;
						var rotate = xMulti * yMulti;
						event.target.style.transform = 'translate(' + toX + 'px, ' + (toY + event.deltaY) + 'px) rotate(' + rotate + 'deg)';
							
						if(event.deltaX < 0){
							console.log('rechazado');
							self.declineReport();
						} else if(event.deltaX > 0){
							console.log('Aprobado');
							self.aprobeReport();
						} else {
							console.log('Otro');
						}
						self.initCards();
					}
				});
			});
			function getEventType(event) {
				console.log(event.type);
			}
			
			
			var nopeListener = self.createButtonListener(false);
			var loveListener = self.createButtonListener(true);
			nope.addEventListener('click', nopeListener);
			love.addEventListener('click', loveListener);
			/*
			$(nope).click(function(){
				console.log('KO');
			});
			$(love).click(function(){
				console.log('OK');
			});*/
		},
		aprobeReport(){
			var self = this;
			$count = $('#count-photografics-pending-revision');
			MV.apiFG.get('/index.php', { params: {
				controller: 'site',
				action: 'Report_Photo_Approve',
				file_id: self.selected.id
			}}).then(function (response) {
				// console.log(response);
				self.createLogSchedule({
					schedule: self.selected.schedule.id,
					action: 'approved-file',
					data: {
						controller: 'site',
						action: 'Report_Photo_Approve',
						file_id: self.selected.id
					},
					response: response,
				}, function(w){
					new PNotify({
						"title": "¡Éxito!",
						"text": "Aprobado con éxito",
						"styling":"bootstrap3",
						"type":"success",
						"icon":true,
						delay: 1500,
						"animation":"zoom",
						"hide":true
					});
					$count.text(parseInt($count.text())-1);
				});
			}).catch(function (error) {
				console.error(error);
				console.log(error.response);
			});
			
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
		declineReport(){
			var self = this;
			$count = $('#count-photografics-pending-revision');
			
			MV.apiFG.get('/index.php', { params: {
				controller: 'site',
				action: 'Report_Photo_NoPass',
				file_id: self.selected.id
			}}).then(function (response) {
				console.log(response);
				self.createLogSchedule({
					schedule: self.selected.schedule.id,
					action: 'declined-file',
					data: {
						controller: 'site',
						action: 'Report_Photo_Approve',
						file_id: self.selected.id
					},
					response: response,
				}, function(w){
					
				});
				
				self.createNotification({
					user: self.selected.create_by.id,
					type: 'photographic-report-declined',
					data: self.selected,
				}, function(w){
					new PNotify({
						"title": "¡Éxito!",
						"text": "Se rechazo con éxito y se envio una notificacion al propietario.",
						"styling":"bootstrap3",
						"type":"success",
						"icon":true,
						"animation":"zoom",
						delay: 1500,
						"hide":true
					});
					$count.text(parseInt($count.text())-1);
					//console.log(self.selected)
					/*
					MV.api.readList('/notifications_groups_users', {
						filter: [
							'group,eq,' + group_notificacions
						],
					},function(IdsNots){
						
					})*/
					
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
						callback: function (result) {
							if(result === true){
								// urlWA = 'https://wa.me/57' + self.selected.created_by.mobile + '?text=Se%20ha%20rechazado%20una%20FOTO' + '.%0AIngresa%20a%20https%3A%2F%2Fmicuenta.monteverdeltda.com%20para%20gestionarla.' + '%20https%3A%2F%2Fmicuenta.monteverdeltda.com' + encodeURI(self.selected.media.path_short);
								urlWA = 'https://wa.me/57' + self.selected.create_by.mobile + '?text=Se%20ha%20rechazado%20una%20FOTO' + '%20M:%20' + self.selected.schedule.microroute.name + '.%0AIngresa%20a%20https%3A%2F%2Fmicuenta.monteverdeltda.com%20para%20gestionarla.';
								window.open(urlWA,'popUpWindow','height=500,width=600,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes');
							}
						}
					});*/
				});
				
			}).catch(function (error) {
				console.error(error);
				console.log(error.response);
			});
		},
	}
}).$mount('#reporting-app');
</script>
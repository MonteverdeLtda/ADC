<div id="emvarias-lots">
	<div class="page-title">
		<div class="title_left">
			<h3> <small></small></h3>
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
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><?= $title; ?> <small>({{ total }})</small></h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link-panel"><i class="fa fa-chevron-up"></i></a></li>
						<!-- // 
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Settings 1</a></li>
								<li><a href="#">Settings 2</a></li>
							</ul>
						</li>
						-->
						
						<router-link  v-bind:to="{ name: 'Create' }" tag="li">
							<a class="close-link-panel"><i class="fa fa-plus"></i></a>
						</router-link>
					</ul>
					<div class="clearfix"></div>
				</div>
				
				<div class="x_content">
					<p class="text-muted font-13 m-b-30">
						
					</p>
					<table id="datatable-buttons2" class="table table-striped table-bordered">
					</table>
				</div>
			</div>
		</div>
	</div>
</template>


<template id="create">
	<div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><?= $title; ?> <small>Añadir</small></h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link-panel"><i class="fa fa-chevron-up"></i></a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Settings 1</a></li>
								<li><a href="#">Settings 2</a></li>
							</ul>
						</li>
						
						<router-link  v-bind:to="{ name: 'Home' }" tag="li">
							<a class="close-link-panel"><i class="fa fa-close"></i></a>
						</router-link>
					</ul>
					<div class="clearfix"></div>
				</div>
				
				<div class="x_content">
					<p class="text-muted font-13 m-b-30">
						<!-- // {{ forms.create }} -->
					</p>
					<form class="form-horizontal form-label-left" action="javascript:return false;" v-on:submit="submitFormCreate">
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Cuenta / Cliente</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<select v-model="forms.create.account" class="form-control accountSearch">
									<option value="0">Seleccione una opcion</option>
									<!-- // <option v-for="(item, item_i) in $root.accounts" :value="item.id"> {{ item.identification_number }} - {{ item.names }} {{ item.surname }}</option> -->
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Contrato</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<select v-model="forms.create.contract" class="form-control contractSearch">
									<option value="0">Seleccione una opcion</option>
								</select>
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre / Titulo / Ref</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input v-model="forms.create.name" type="text" class="form-control" placeholder="Nombre de la microruta">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Id Ref / Lote Ref / Ref 2</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input v-model="forms.create.id_ref" type="text" class="form-control" placeholder="Lote de referencia">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Área m2</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input v-model="forms.create.area_m2" type="number" min="0" step="0.00001" class="form-control" placeholder="Área total m2">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Zona</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input v-model="forms.create.zone_client" type="text" class="form-control" placeholder="Zona">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<textarea v-model="forms.create.description" rows="5" class="form-control" placeholder="Descripción"></textarea>
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<textarea v-model="forms.create.obs" rows="5" class="form-control" placeholder="Observaciones"></textarea>
							</div>
						</div>
						
						
						<div class="control-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Direccion(es)</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input name="address_text" id="address_tags" type="text" class="tags form-control" />
								<div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
							</div>
						</div>
						
						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
								<router-link  v-bind:to="{ name: 'Home' }" tag="button" type="button" class="btn btn-default">
									Cancelar
								</router-link>
								
								<button type="submit" class="btn btn-success">Añadir</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</template>


<template id="edit">
	<div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><?= $title; ?> <small>Editar</small></h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link-panel"><i class="fa fa-chevron-up"></i></a></li>
						<router-link  v-bind:to="{ name: 'Create' }" tag="li">
							<a class="close-link-panel"><i class="fa fa-plus"></i></a>
						</router-link>
						<router-link  v-bind:to="{ name: 'Home' }" tag="li">
							<a class="close-link-panel"><i class="fa fa-close"></i></a>
						</router-link>
					</ul>
					<div class="clearfix"></div>
				</div>
				
				<div class="x_content">
					<p class="text-muted font-13 m-b-30">
						<!-- // {{ forms.edit }} -->
					</p>
					<form class="form-horizontal form-label-left" action="javascript:return false;" v-on:submit="submitFormEdit">
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Cuenta / Cliente</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<select v-model="forms.edit.account" class="form-control accountSearch">
									<option value="0">Seleccione una opcion</option>
									<!-- // <option v-for="(item, item_i) in $root.accounts" :value="item.id"> {{ item.identification_number }} - {{ item.names }} {{ item.surname }}</option> -->
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Contrato</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<select v-model="forms.edit.contract" class="form-control contractSearch">
									<option value="0">Seleccione una opcion</option>
								</select>
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre / Titulo / Ref</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input v-model="forms.edit.name" type="text" class="form-control" placeholder="Nombre de la microruta">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Id Ref / Lote Ref / Ref 2</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input v-model="forms.edit.id_ref" type="text" class="form-control" placeholder="Lote de referencia">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Área m2</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input v-model="forms.edit.area_m2" type="number" min="0" step="0.00001" class="form-control" placeholder="Área total m2">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Zona</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input v-model="forms.edit.zone_client" type="text" class="form-control" placeholder="Zona">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<textarea v-model="forms.edit.description" rows="5" class="form-control" placeholder="Descripción"></textarea>
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<textarea v-model="forms.edit.obs" rows="5" class="form-control" placeholder="Observaciones"></textarea>
							</div>
						</div>
						
						
						<div class="control-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Direccion(es)</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input name="address_text" id="address_tags" type="text" class="tags form-control"  v-model="forms.edit.address_text" />
								<div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
							</div>
						</div>
						
						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
								<router-link  v-bind:to="{ name: 'Home' }" tag="button" type="button" class="btn btn-default">
									Cancelar
								</router-link>
								
								<button type="submit" class="btn btn-success">Guardar</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
var Home = Vue.extend({
	template: '#list',
	data(){
		return {
			total: 0,
			records: [],
			dataTable: null,
		};
	},
	created: function () {
	},
	mounted: function () {
		var self = this;
		self.$root.PanelToolbox();
		self.load();
	},
	methods: {
		load(){
			var self = this;
			self.loading = true;
			self.records = [];
			self.total = 0;
			window.scrollTo(0, 0);
			
			var dialog = bootbox.dialog({
				message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog"></i> Por favor espera mientras hacemos algo...</p>',
				closeButton: false
			});
			
			MV.api.readList('/microroutes', {
				join: [
					'accounts_contracts'
				],
			}, (a) => {
				if(Array.isArray(a) && a.length > 0){
					self.total = a.length;
					//console.log('Normal: ', a.data.records);
					let result = a.map(a => [
						a.id, 
						a.contract.name, 
						a.name, 
						a.id_ref, 
						a.address_text, 
						a.area_m2.toLocaleString(), 
						a.zone_client, 
						'<button class="btn btn-sm btn-danger delete-microroute" data-microroute="' + a.id + '"><i class="fa fa-trash"></i></button>'
						+ '<button class="btn btn-sm btn-primary edit-microroute" data-microroute="' + a.id + '"><i class="fa fa-edit"></i></button>',
						a.obs, 
						a.description
					]);
					//console.log('result: ', result);
					self.records = result;
					
					self.dataTable = $('#datatable-buttons2').DataTable( {
						destroy: true,
						"language": {
							"url": "/public/assets/build/js/lang-datatable.json"
						},
						data: self.records,
						columns: [
							{ title: "id" },
							{ title: "Contrato" },
							{ title: "Microruta (1ra)" },
							{ title: "Lote REF." },
							{ title: "Direccion(es)" },
							{ title: "Area m2" },
							{ title: "Zona." },
							{ title: "Acciones" },
							{ title: "Obs." },
							{ title: "Descripción" },
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
								dialog.modal('hide');
								var apiTables = this.api();
									
								apiTables.$(".delete-microroute").click(function() {
									button = $(this).find( "button" );
									element = $(button.prevObject[0]);
									microroute = element.data('microroute');
									bootbox.confirm({
										message: "Confirma que deseas eliminar la microruta permanentemente?, este cambio es inrreversible y podria eliminar contenido relacionado con la está, si no sabes lo que estas haciendo cierra está ventana.",
										locale: 'es',
										callback: function (a) {
											if(a !== undefined && a == true){
												var Notice = new PNotify({
													styling: "bootstrap3",
													text: 'Eliminando Microruta...',
													icon: 'fa fa-spinner fa-pulse',
													hide: false,
													shadow: false,
													width: '200px',
												});

												MV.api.remove('/microroutes/' + microroute, {}, (b) => {
													if(b > 0){
														Notice.update({
															type: 'success',
															title: 'Exito!',
															text: 'Se borro correctamente la informacion.',
															icon: 'fa fa-check',
															hide: true,
															shadow: true,
														});
														
														setTimeout(() => {
															self.load();
														}, 1000);
														
													} else {
														Notice.update({
															type: 'error',
															title: 'Error eliminando el contacto',
															text: 'Ocurrio un error eliminando la microruta.',
															icon: 'fa fa-times',
															hide: true,
															shadow: true,
														});
													}
												});
												
											}
										}
									});
								});
								
								apiTables.$(".edit-microroute").click(function() {
									button = $(this).find( "button" );
									element = $(button.prevObject[0]);
									microroute = element.data('microroute');
									
									self.$router.push({
										name: 'Edit',
										params: {
											microroute_id: microroute
										}
									});
								});
							}
					} );
				} else {
					alert("Ocurrio un error cargando la lista.");
					console.log(a);
				}
			});
		},
	}
});

var Create = Vue.extend({
	template: '#create',
	data(){
		return {
			forms: {
				create: {
					contract: 0,
					account: 0,
					name: '',
					id_ref: 'N/A',
					description: '',
					address_text: '',
					area_m2: 0.00000,
					zone_client: 'N/A',
					obs: 'Sin observacion(es)',
				}
			}
		};
	},
	created: function () {
	},
	mounted: function () {
		var self = this;
		self.$root.PanelToolbox();
		
		setTimeout(() => {
			if(typeof($.fn.inputmask) !== 'undefined'){
				$(":input").inputmask();
			}
			
			if(typeof($.fn.tagsInput) !== 'undefined'){
				$('#address_tags').tagsInput({
					width: 'auto',
					'interactive':true,
					'defaultText':'Agregar',
					// 'onAddTag':callback_function,
					// 'onRemoveTag':callback_function,
					'onChange' : (a) => { self.forms.create.address_text = jQuery( a ).tagsInput()[0].value; },
					// 'delimiter': [',',';'],   // Or a string with a single delimiter. Ex: ';'
					'removeWithBackspace' : true,
					'minChars' : 5,
					'maxChars' : 0, // if not provided there is no limit
					'placeholderColor' : '#666666'
				});
				
			}
			
			$(".accountSearch").select2({
				placeholder: "Select a state",
				allowClear: true,
				data: self.$root.accounts.map((a) => {
					return {
						"id": a.id,
						"text": a.identification_number + ' - ' + a.names + ' ' + a.surname
					};
				})
			})
			.on('select2:select', function (e) {
				var itemData = e.params.data;
				self.forms.create.account = itemData.id;
				$(".contractSearch").select2({
					placeholder: "Select a state",
					allowClear: true,
					data: self.forms.create.account > 0 ? (self.$root.accounts.find((a) => a.id == self.forms.create.account).accounts_contracts.map((a) => {
						if(a.is_active == 1){ return { id: a.id, text: a.name + ' | ' + a.start + ' - ' + a.end }; };
					})) : []
				})
				.on('select2:select', function (e) {
					var itemData = e.params.data;
					self.forms.create.contract = itemData.id;
				});
			});
			
			$(".contractSearch").select2({
				placeholder: "Select a state",
				allowClear: true,
				data: self.forms.create.account > 0 ? (self.$root.accounts.find((a) => a.id == self.forms.create.account).accounts_contracts.map((a) => {
					if(a.is_active == 1){ return { id: a.id, text: a.name }; };
				})) : []
			})
			.on('select2:select', function (e) {
				var itemData = e.params.data;
				self.forms.create.contract = itemData.id;
			});
				
			//init_SmartWizard();
			//init_select2();
					
		}, 1500);
	},
	methods: {
		loadInputsSelectSearch(){
			var self = this;
		},
		submitFormCreate(){
			var self = this;
			if(
				self.forms.create.account > 0
				&& self.forms.create.contract > 0
				&& self.forms.create.name.length > 2
				&& self.forms.create.id_ref.length > 2
				&& self.forms.create.description.length > 2
				&& self.forms.create.address_text.length > 2
				&& self.forms.create.area_m2 > 0
			){
				MV.api.create('/microroutes', self.forms.create,(a) => {
					if(a > 0){
						new PNotify({
							"title": "Exito!",
							"text": "Se agrego la nueva microruta. # Registro: " + a,
							"styling":"bootstrap3",
							"type":"success",
							"icon":true,
							"animation":"flip",
							"hide":true,
							"delay": 2500,
						});
						
						self.$router.push({
							name: 'Home'
						});
					}
				});
				
			} else {
				self.$root.showErrorModal('Faltan campos en el formulario.');
			}
		}
	}
});

var Edit = Vue.extend({
	template: '#edit',
	data(){
		return {
			forms: {
				edit: {
					id: this.$route.params.microroute_id,
					contract: 0,
					account: 0,
					name: '',
					id_ref: 'N/A',
					description: '',
					address_text: '',
					area_m2: 0.00000,
					zone_client: 'N/A',
					obs: 'Sin observacion(es)',
				}
			}
		};
	},
	created: function () {
	},
	mounted: function () {
		var self = this;
		self.$root.PanelToolbox();
		self.load();
		
		
	},
	methods: {
		load(){
			var self = this;
			MV.api.readSingle('/microroutes', self.forms.edit.id, {}, (microroute) => {
				if(microroute.id){
					self.forms.edit = microroute;
					
					setTimeout(() => {
						if(typeof($.fn.inputmask) !== 'undefined'){
							$(":input").inputmask();
						}
						
						if(typeof($.fn.tagsInput) !== 'undefined'){
							$('#address_tags').tagsInput({
								width: 'auto',
								'interactive':true,
								'defaultText':'Agregar',
								// 'onAddTag':callback_function,
								// 'onRemoveTag':callback_function,
								'onChange' : (a) => { self.forms.edit.address_text = jQuery( a ).tagsInput()[0].value; },
								// 'delimiter': [',',';'],   // Or a string with a single delimiter. Ex: ';'
								'removeWithBackspace' : true,
								'minChars' : 5,
								'maxChars' : 0, // if not provided there is no limit
								'placeholderColor' : '#666666'
							}).importTags(microroute.address_text);
						}
						
						$(".accountSearch").select2({
							placeholder: "Select a state",
							allowClear: true,
							data: self.$root.accounts.map((a) => {
								return {
									"id": a.id,
									"text": a.identification_number + ' - ' + a.names + ' ' + a.surname
								};
							})
						})
						.on('select2:select', function (e) {
							var itemData = e.params.data;
							self.forms.edit.account = itemData.id;
							$(".contractSearch").select2({
								placeholder: "Select a state",
								allowClear: true,
								data: self.forms.edit.account > 0 ? (self.$root.accounts.find((a) => a.id == self.forms.edit.account).accounts_contracts.map((a) => {
									if(a.is_active == 1){ return { id: a.id, text: a.name + ' | ' + a.start + ' - ' + a.end }; };
								})) : []
							})
							.on('select2:select', function (e) {
								var itemData = e.params.data;
								self.forms.edit.contract = itemData.id;
							});
						}).val(self.forms.edit.account).trigger('change');
						
						$(".contractSearch").select2({
							placeholder: "Select a state",
							allowClear: true,
							data: self.forms.edit.account > 0 ? (self.$root.accounts.find((a) => a.id == self.forms.edit.account).accounts_contracts.map((a) => {
								if(a.is_active == 1){ return { id: a.id, text: a.name }; };
							})) : []
						})
						.on('select2:select', function (e) {
							var itemData = e.params.data;
							self.forms.edit.contract = itemData.id;
						}).val(self.forms.edit.contract).trigger('change');
							
						//init_SmartWizard();
						//init_select2();
								
					}, 1000);
					
				}
			});
			
		},
		loadInputsSelectSearch(){
			var self = this;
		},
		submitFormEdit(){
			var self = this;
			if(
				self.forms.edit.account > 0
				&& self.forms.edit.contract > 0
				&& self.forms.edit.name.length > 2
				&& self.forms.edit.id_ref.length > 2
				&& self.forms.edit.description.length > 2
				&& self.forms.edit.address_text.length > 2
				&& self.forms.edit.area_m2 > 0
			){
				MV.api.update('/microroutes/' + self.$route.params.microroute_id, {
					id: self.$route.params.microroute_id,
					contract: self.forms.edit.contract,
					account: self.forms.edit.account,
					name: self.forms.edit.name,
					id_ref: self.forms.edit.id_ref,
					description: self.forms.edit.description,
					address_text: self.forms.edit.address_text,
					area_m2: self.forms.edit.area_m2,
					zone_client: self.forms.edit.zone_client,
					obs: self.forms.edit.obs,
				}, (a) => {
					if(a > 0){
						new PNotify({
							"title": "Exito!",
							"styling":"bootstrap3",
							"text": "Se actualizaro " + a + " campo(s) de la microruta correctamente.",
							"type":"success",
							"icon":true,
							"animation":"flip",
							"hide":true,
							"delay": 2500,
						});
						
						self.$router.push({
							name: 'Home'
						});
					} else {
						self.$root.showErrorModal('Ocurrion un error guardando la informaicon, intente nuevamente si el problema continue contacte con soporte.');
					}
				});
			} else {
				self.$root.showErrorModal('Faltan campos en el formulario.');
			}
		}
	}
});

var router = new VueRouter({
	linkActiveClass: 'active',
	routes:[
		{ path: '/', component: Home, name: 'Home' },
		{ path: '/create', component: Create, name: 'Create' },
		{ path: '/edit/:microroute_id', component: Edit, name: 'Edit' },
	]
});


app = new Vue({
	router: router,
	data: function () {
		return {
			accounts: [],
		};
	},
	mounted: function () {
		var self = this;
		self.loadAccounts();
	},
	methods: {
		loadAccounts(){
			var self = this;
			MV.api.readList('/accounts', {
				join: [
					'accounts_contracts'
				]
			}, (a) => {
				if(Array.isArray(a)){ self.accounts = a; }
			});
		},
		PanelToolbox(){
			var self = this;
			// Panel toolbox
			$(document).ready(function() {
				$('.collapse-link-panel').on('click', function() {
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

				$('.close-link-panel').click(function () {
					var $BOX_PANEL = $(this).closest('.x_panel');
					$BOX_PANEL.remove();
				});
			});
			// /Panel toolbox

			// Tooltip
			$(document).ready(function() {
				$('[data-toggle="tooltip"]').tooltip({
					container: 'body'
				});
			});
			// /Tooltip

			// Progressbar
			if ($(".progress .progress-bar")[0]) {
				$('.progress .progress-bar').progressbar();
			}
			// /Progressbar

			// Switchery
			$(document).ready(function() {
				if ($(".js-switch")[0]) {
					var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
					elems.forEach(function (html) {
						var switchery = new Switchery(html, {
							color: '#26B99A'
						});
					});
				}
			});
			// /Switchery


			// iCheck
			$(document).ready(function() {
				if ($("input.flat")[0]) {
					$(document).ready(function () {
						$('input.flat').iCheck({
							checkboxClass: 'icheckbox_flat-green',
							radioClass: 'iradio_flat-green'
						});
					});
				}
			});
			// /iCheck
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
				"delay": 1500,
			});
		},
	}
}).$mount('#emvarias-lots');
</script>
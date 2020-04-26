<style>
.modal {
	overflow: auto;
}
.bootbox-input-textarea {
	min-height: 170px;
}
</style>

<div class="page-title">
	<div class="title_left">
		<h3><?= $title; ?></h3>
	</div>
</div>
<div class="clearfix"></div>

<div id="me-accounts">	 
	<div class="row">
		<router-view :key="$route.fullPath" ></router-view>
	</div>
</div>

<template id="home">
	<div>
		<div class="col-md-12">
			<div class="x_panel">
				<div class="x_content">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 text-center">
							
						</div>
						<div class="clearfix"></div>
				  
				  
						<div class="col-md-6 col-sm-6 col-xs-12 profile_details" v-for="(accountInfo, i) in records">
							<div class="well profile_view">
								<div class="col-sm-12">
									<h4 class="brief"><i><b>Nivel de Acceso</b>: {{ accountInfo.permissions !== null ? accountInfo.permissions.name : 'Solo lectura' }}</i></h4>
									<div class="left col-xs-12">
										<h3>{{ accountInfo.account.names }} {{ accountInfo.account.surname }}</h3>
										<p><strong>Tipo de Cuenta.: </strong> {{ accountInfo.account.type.name }}</p>
										<p><strong>Act. Econom.: </strong> {{ accountInfo.account.economic_activity.name }}</p>
										<ul class="list-unstyled">
											<li><i class="fa fa-at"></i> : {{ accountInfo.account.email }}</li>
											<li><i class="fa fa-building"></i> .: {{ accountInfo.account.address }}</li>
											<li><i class="fa fa-phone"></i> : {{ accountInfo.account.phone }}</li>
											<li><i class="fa fa-mobile"></i> : {{ accountInfo.account.mobile }}</li>
										</ul>
									</div>
								</div>
								<div class="col-xs-12 bottom text-center">
									<!-- //
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
									-->
									<div class="col-xs-12 col-sm-12 emphasis">
										<template v-if="accountInfo.isAdmin === true">
											<button type="button" class="btn btn-default btn-xs" @click="openEditAccount(accountInfo)">
												<i class="fa fa-edit"> </i> Act. Datos
											</button>
											<button type="button" class="btn btn-success btn-xs" @click="openManagerUsersInAccount(accountInfo)">
												<i class="fa fa-users"></i>
											</button>
										</template>
										
										<template v-if="accountInfo.isAdmin === true || accountInfo.isManager === true">
											<button type="button" class="btn btn-info btn-xs" @click="MeAccountCommunications(accountInfo.account.id)">
												<i class="fa fa-comments"></i>
											</button>
											<button type="button" class="btn btn-default btn-xs" @click="openListMicroroutesModal(accountInfo)">
												<i class="fa fa-road"> </i> Microrutas
											</button>
											<!-- // <button type="button" class="btn btn-primary btn-xs">
												<i class="fa fa-dashboard"> </i> Consola
											</button>-->
										</template>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade bs-edit-me-account-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizacion de datos</h4>
					</div>
					<div class="modal-body">
						<div class="col-xs-3">
							<!-- required for floating -->
							<!-- Nav tabs -->
							<ul class="nav nav-tabs tabs-left">
								<li class="active"><a href="#info-basic-account" data-toggle="tab">Informacion Básica</a></li>
								<li><a href="#contacts-modal" data-toggle="tab">Mis Contactos</a></li>
							</ul>
						</div>
						
						<div class="col-xs-9">
							<div class="tab-content">
								<div class="tab-pane active" id="info-basic-account">
									<br />
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" v-if="forms.account_edit !== null">
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Correo Electronico Principal <span class="required"> *</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input v-model="forms.account_edit.email" type="text" name="email" required="required" class="form-control col-xs-12">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone"> Teléfono Fijo <span class="required"> *</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input v-model="forms.account_edit.phone" type="text" name="phone" required="required" class="form-control col-xs-12">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="mobile"> Teléfono Móvil <span class="required"> *</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input v-model="forms.account_edit.mobile" type="text" name="mobile" required="required" class="form-control col-xs-12">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="address"> Dirección principal <span class="required"> *</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input v-model="forms.account_edit.address" type="text" name="address" required="required" class="form-control col-xs-12">
											</div>
										</div>
										<div class="ln_solid"></div>
										<button @click="submitEditAccountInModal" type="button" class="btn btn-success pull-right">Actualizar</button>
									</form>
								</div>
								<div class="tab-pane" id="contacts-modal">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12 text-center">
											<p><b>Nota: </b> Se deseas eliminar, actualizar o agregar un nuevo contacto pulsa en el botón inferior que dice "Contactar".</p>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-sm-12 col-xs-12 text-center">
											<div class="col-md-6 col-sm-6 col-xs-6 profile_details" v-for="(contact, contact_i) in forms.account_edit_contacts">
												<div class="well profile_view">
													<div class="col-sm-12">
														<h4 class="brief"><i> {{ contact.type.name }}</i></h4>
														<div class="left col-xs-12">
															<h3>{{ contact.contact.names }} {{ contact.contact.surname }}</h3>
															<p><strong> </strong> </p>
															<ul class="list-unstyled">
																<li><i class="fa fa-at"></i> {{ contact.contact.email }}</li>
																<li><i class="fa fa-building"></i> {{ contact.contact.address }}</li>
																<li><i class="fa fa-phone"></i> {{ contact.contact.phone }}</li>
																<li><i class="fa fa-mobile"></i> {{ contact.contact.mobile }}</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="messages">Messages Tab.</div>
								<div class="tab-pane" id="settings">Settings Tab.</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-info pull-left" @click="MeAccountContact(forms.create_user.account)"> <i class="fa fa-comment"></i> Contactar</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade bs-manager-users-me-account-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel">Gestión de Usuarios</h4>
					</div>
					<div class="modal-body">
							<div class="col-md-3 col-sm-12">
								<!-- required for floating -->
								<!-- Nav tabs -->
								<ul class="nav nav-tabs tabs-left">
									<li class="active"><a href="#list-users" data-toggle="tab">Listado de usuarios</a></li>
									<li><a href="#new-user-modal" data-toggle="tab">Nuevo usuario</a></li>
									<!-- // 
										<li><a href="#messages" data-toggle="tab">Messages</a></li>
										<li><a href="#settings" data-toggle="tab">Settings</a></li>
									-->
								</ul>
							</div>
							<div class="col-md-9 col-sm-12">
								<div class="tab-content">
									<div class="tab-pane active" id="list-users">
										<div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12 text-center">
												<div class="col-md-6 col-sm-6 col-xs-12 profile_details" v-for="(user, user_i) in forms.manager_users">
													<div class="well profile_view">
														<div class="col-sm-12">
															<h4 class="brief"><i> {{ user.permissions !== null ? user.permissions.name : 'Solo lectura' }}</i></h4>
															<div class="left col-xs-12">
																<h3>{{ user.user.names }} {{ user.user.surname }}</h3>
																<p><strong> </strong> </p>
																<ul class="list-unstyled">
																	<li><i class="fa fa-at"></i> {{ user.user.email }}</li>
																	<li><i class="fa fa-building"></i> {{ user.user.address }}</li>
																	<li><i class="fa fa-phone"></i> {{ user.user.phone }}</li>
																	<li><i class="fa fa-mobile"></i> {{ user.user.mobile }}</li>
																</ul>
															</div>
														</div>
														
														<div class="col-xs-12 bottom text-center">
															<template v-if="user.user.id !== <?= $this->user->id; ?>">
																<div class="col-xs-12 col-sm-12 emphasis">
																	<button type="button" class="btn btn-primary btn-xs" @click="updatePermissionsUserInMeAccount(user.id)">
																		<i class="fa fa-cogs"></i> 
																	</button>
																	<button type="button" class="btn btn-danger btn-xs" @click="deleteUserInMeAccount(user.id)">
																		<i class="fa fa-trash"> </i>
																	</button>
																</div>
															</template>
															<template v-else>
																No puedes gestionar tu propio perfil.
															</template>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>
									<div class="tab-pane" id="new-user-modal">
										<div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12 text-center">
												<br />
												<form class="form-horizontal form-label-left input_mask" action="javascript:return false;">
													<div class="form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12" for="address"> Nivel de acceso. <span class="required"> *</span></label>
														<div class="col-md-9 col-sm-9 col-xs-12">
															<select v-model="forms.create_user.permissions" class="form-control">
																<option value="0">Seleccione una opcion...</option>
																<option v-for="(option, option_i) in options.permissions_group" :value="option.id">{{ option.name }}</option>
															</select>
														</div>
													</div>
													
													<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
														<input @change="checkInputNicknewUser" type="text" class="form-control has-feedback-left mask-nick" placeholder="Usuario de acceso" autocomplete="off" />
														<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
													</div>
													
													<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
														<input @change="checkInputEmailnewUser" type="text" class="form-control" placeholder="Correo electronico" autocomplete="off" />
														<span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
													</div>
													
													<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
														<input v-model="forms.create_user.names" type="text" class="form-control has-feedback-left mask-names" placeholder="Nombre(s)" autocomplete="off" />
														<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
													</div>
													
													<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
														<input v-model="forms.create_user.surname" type="text" class="form-control" placeholder="Apellido(s)" autocomplete="off" />
														<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
													</div>
													<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
														<input v-model="forms.create_user.password" type="password" class="form-control has-feedback-left" placeholder="Contraseña de acceso" autocomplete="off" />
														<span class="fa fa-asterisk form-control-feedback left" aria-hidden="true"></span>
													</div>
													
													<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
														<input v-model="forms.create_user.verify_password" type="password" class="form-control" placeholder="Verifique la contraseña" autocomplete="off" />
														<span class="fa fa-asterisk form-control-feedback right" aria-hidden="true"></span>
													</div>
													
													<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
														<input v-model="forms.create_user.phone" type="text" class="form-control has-feedback-left mask-phone" placeholder="teléfono" autocomplete="off" />
														<span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
													</div>
													
													<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
														<input v-model="forms.create_user.mobile" type="text" class="form-control  mask-mobile" placeholder="Movil" autocomplete="off" />
														<span class="fa fa-mobile form-control-feedback right" aria-hidden="true"></span>
													</div>
													<div class="ln_solid"></div>
													<div class="form-group">
														<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
															<button class="btn btn-primary" type="reset">Limpar</button>
															<button @click="submitCreateUserInAccount" type="button" class="btn btn-success">Crear usuario</button>
														</div>
													</div>

												</form>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
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
		
		<div class="modal fade bs-communications-me-account-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel">Comunicaciones</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							
							<div class="col-sm-3 mail_list_column" id="box-list-communications">
								<button @click="MeAccountContact(forms.create_user.account)" class="btn btn-sm btn-success btn-block" type="button">Contactar</button>
								
								<template v-if="meCommunicationsView.length > 0">
									<a @click="meCommunicationsPartsView = communication.accounts_communications_parts; replySelected = communication;" v-for="(communication, communication_i) in meCommunicationsView" v-if="communication.accounts_communications_parts.length > 0" style="cursor:pointer;">
										<div class="mail_list">
											<div class="left">
												<i class="fa fa-circle-o" v-if="communication.status == 0"></i> 
												<i class="fa fa-circle" v-if="communication.status == 1"></i> 
												<i class="fa fa-check" v-if="communication.is_closed == 1"></i> 
											</div>
											<div class="right">
												<h3>{{ communication.accounts_communications_parts[(communication.accounts_communications_parts.length-1)].created_by.username }} <small>{{ communication.accounts_communications_parts[(communication.accounts_communications_parts.length-1)].created }}</small></h3>
												<p>
													{{ communication.accounts_communications_parts[(communication.accounts_communications_parts.length-1)].message.substr(0,65) }}...
												</p>
											</div>
										</div>
									</a>
								</template>
								<template v-else>
									<a>
										<div class="mail_list">
											<div class="left">
												<i class="fa fa-circle"></i> <i class="fa fa-edit"></i>
											</div>
											<div class="right">
												<h3>No tienes comunicaciones <small>-</small></h3>
												<p>Contactanos desde el boton "Contactar"</p>
											</div>
										</div>
									</a>
								</template>
							</div>
							<!-- /MAIL LIST -->
							
							<!-- CONTENT MAIL -->
							<div class="col-sm-9 mail_view">
								<div class="inbox-body" v-if="meCommunicationsPartsView.length > 0 && replySelected !== null">
									<div class="mail_heading row">
										<div class="col-md-8">
											<div class="btn-group">
												<button v-if="replySelected.is_closed == 0" @click="replyCommunication()" class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Responder</button>
												<button @click="markAsRead" v-if="replySelected.status == 1" class="btn btn-sm btn-info" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Marcar como leido"><i class="fa fa-check"></i> Marcar como leido</button>
												<button @click="markAsSolved" v-if="replySelected.is_closed == 0" class="btn btn-sm btn-success" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Cerrar y Marcar como solucionado"><i class="fa fa-check"></i> Solucionado</button>
												<button onclick="javascript:window.print();" class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
												<!-- // 
												<button class="btn btn-sm btn-default" type="button"  data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i></button>
												
												-->
											</div>
										</div>
										<div class="col-md-4 text-right">
											<p class="date" style="zoom:0.8;"> Última actividad {{ replySelected.updated }}</p>
										</div>
										<div class="col-md-12"><h4></h4></div>
										<!-- // <div class="col-md-12"> <h4>{{ meCommunicationsPartsView[0].message.substr(0,155) }}</h4> </div> -->
									</div>
									<template v-if="meCommunicationsPartsView.length > 0" v-for="(part, part_i) in meCommunicationsPartsView">
										<div class="sender-info">
											<div class="row">
												<div class="col-md-12">
													<strong>{{ part.created_by.username }}</strong>
													<span>({{ part.created_by.email }})</span> Fecha y Hora: <strong>{{ part.created }}</strong>
													<!-- // <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a> -->
												</div>
											</div>
										</div>
										<div class="view-mail">
											<p>{{ part.message }}</p>
										</div>
										<div class="ln_solid"></div>
									</template>
									
									
									<!-- //
									<div class="btn-group">
										<button class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Reply</button>
										<button class="btn btn-sm btn-default" type="button"  data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i></button>
										<button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
										<button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
									</div>
									-->
								</div>
							</div>
							<!-- /CONTENT MAIL -->
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
				economic_activities: [],
				identifications_types: [],
				permissions_group: [],
			},
			records: [],
			dialogEdit: null,
			dialogCommunications: null,
			dialogMicroroutes: null,
			forms: {
				account_edit: null,
				account_edit_contacts: [],
				manager_users: [],
				create_user: {
					username: 'tu.usuario',
					password: '123456',
					verify_password: '',
					names: '',
					surname: '',
					phone: '',
					mobile: '',
					email: '',
					permissions: 0,
					account: 0,
				},
			},
			replySelected: null,
			meCommunicationsView: [],
			meCommunicationsPartsView: [],
			meMicroroutesView: [],
		};
	},
	mounted: function () {
		var self = this;
		self.loadOptions();
		self.dialogEdit = $(".bs-edit-me-account-modal-lg");
		self.dialogManagerusers = $(".bs-manager-users-me-account-modal-lg");
		self.dialogCommunications = $(".bs-communications-me-account-modal-lg");
		self.dialogMicroroutes = $(".bs-microroutes-me-account-modal-lg");
		
		$(".mask-phone").inputmask("57 (9{1,2}) 9{3} 9{4}").change((event) => {
			self.forms.create_user.phone = $(event.target).val().replace("_", "").replace("_", "").replace("_", "").replace("_", "").replace("_", "").replace("_", "").replace("_", "").replace("_", "").replace("_", "").replace("_", "");
		});
		
		$(".mask-mobile").inputmask({ mask: "57 9{3} 9{3} 9{4}", removeMaskOnSubmit: true }).change((event) => {
			self.forms.create_user.mobile = $(event.target).val().replace("_", "").replace("_", "").replace("_", "").replace("_", "").replace("_", "").replace("_", "").replace("_", "").replace("_", "").replace("_", "").replace("_", "");
		});
		
	},
	computed: {
	},
	methods: {
		openListMicroroutesModal(data){
			var self = this;
			self.setFormAccountEdit(data);
			// $("#datatable-buttons-microroutes-modal")
			self.dialogMicroroutes.modal('show');
			$('#datatable-buttons-microroutes-modal').html('Cargando, porfavor espere...');
			setTimeout(self.loadListMicroroutes, 1500); // 300000 == 5 Minutos || 1Min = 60000 || 1Seg = 1000
		},
		loadListMicroroutes(){
			var self = this;
			MV.api.readList('/microroutes', {
				filter: [
					'account,eq,' + self.forms.create_user.account
				], 
				join: [
					'accounts_contracts'
				],
			}, (a) => {
				if(a.length > 0){
					self.meMicroroutesTotal = a.length;
					self.meMicroroutesView = a;
					$('#datatable-buttons-microroutes-modal').html('');
					self.dataTable = $('#datatable-buttons-microroutes-modal')
						.DataTable({
							destroy: true,
							language: { "url": "/public/assets/build/js/lang-datatable.json" },
							// data: self.records,
							fixedHeader: true,
							data: a.map(b => [
								// b.id,
								// b.name, 
								// b.id_ref, 
								b.address_text, 
								b.area_m2.toLocaleString(),
								b.contract.name,
								(b.last_executed !== null) ? b.last_executed : '- 0 -',
								'<button class="request-microroute-in-model btn btn-sm btn-default" data-account_id="' + b.account + '" data-microroute_id="' + b.id + '" data-microroute_name="' + b.name + '"><i class="fa fa-comment"></i></button>',
								(b.obs.length <= 3) ? 'Sin Observaciones' : b.obs.length, 
								b.description,
							]),
							columns: [
								// { title: "id" },
								// { title: "Microruta" },
								// { title: "Lote REF." },
								{ title: "Direccion(es)" },
								{ title: "Area m2" },
								{ title: "Contrato" },
								{ title: "Última ejecucion" },
								{ title: "Action" },
								{ title: "Obs." },
								{ title: "Descripcion" },
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
								
								apiTables.$('tr').click( function () {
									tds = $(this).find( ".request-microroute-in-model" );
									selectedId = parseInt($(tds[0]).data('microroute_id'));
									microroute_id = ((parseInt(selectedId)>0) ? parseInt(selectedId) : 0);
								} );
								
								apiTables.$(".request-microroute-in-model").click(function() {
									microroute_id = $(this).data('microroute_id');
									microroute_name = $(this).data('microroute_name');
									account_id = $(this).data('account_id');
									
									try {										
										textBase = 'Solicitud para Actualizar/Remover la microruta ' + microroute_name + ".\n" 
											+ "**Informacion Nueva**: " + "\n";
										bootbox.prompt({
											title: "Nueva comunicacion",
											value: textBase,
											inputType: 'textarea',
											callback: function (result) {
												if(result !== null){
													if(result.length > 15 && escape(result) !== escape(textBase)){
														MV.api.create('/accounts_communications', {
															account: account_id,
															created_by: <?= $this->user->id; ?>,
															updated_by: <?= $this->user->id; ?>,
														}, (b) => {
															if(b > 0){
																MV.api.create('/accounts_communications_parts', {
																	communication: b,
																	account: account_id,
																	message: result,
																	created_by: <?= $this->user->id; ?>,
																	updated_by: <?= $this->user->id; ?>,
																}, (c) => {
																	if(c > 0){
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
																		
																		self.sendNotificationAccountGroup(account_id, {
																			type: 'new-communication-client',
																			data:  {
																				id: c,
																				communication: b,
																				account: account_id,
																				message: result,
																				created_by: <?= $this->user->id; ?>,
																				updated_by: <?= $this->user->id; ?>,
																			},
																		});
																	} else {
																		self.showErrorModal("Ocurrio un error misterioso al enviar el mensaje.");
																	}
																});
															} else {
																self.showErrorModal("Ocurrio un error misterioso al enviar el mensaje.");
															}
														});
													} else {
														if(result.length <= 15){
															self.showErrorModal("El mensaje es muy corto para ser enviado...");
														}
														else if(escape(result) == escape(textBase)){
															self.showErrorModal("Debes contarnos cual es tu solicitud para proceder");
														}
													}
												}
											}
										});
									} catch(e){
										console.error(e);
										return false;
									}
								});
							}
						});
				} else {
					self.showErrorModal("No hay microrutas para mostrar.");
					console.log(a);
					self.dialogMicroroutes.modal('show');
				}
			});
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
		replyCommunication(){
			var self = this;
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
								communication: self.replySelected.id,
								account: self.replySelected.account,
								message: a,
								created_by: <?= $this->user->id; ?>,
								updated_by: <?= $this->user->id; ?>,
							}, (b) => {
								if(b > 0){
									MV.api.update('/accounts_communications/' + self.replySelected.id, {
										account: self.replySelected.account,
										status: 0,
										updated_by: <?= $this->user->id; ?>,
									}, (c) => {
										if(c > 0){
											MV.api.read('/accounts_communications_parts/' + b, {
												filter: [
													'account,eq,' + self.replySelected.account,
												],
												join: [
													'users',
												],
											}, (d) => {
												self.meCommunicationsPartsView.push(d);
												self.MeAccountCommunications(self.replySelected.account);
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
												
												self.sendNotificationAccountGroup(self.replySelected.account, {
													type: 'new-communication-client',
													data: d,
												})
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
		},
		markAsRead(){
			var self = this;
			bootbox.confirm({
				title: "Confirma tu accion",
				message: "Debes de confirmar antes de cambiar esta comunicacion a \"Leida\", Nuestro personal esperara tu proxima comunicación.",
				locale: 'es',
				centerVertical: true,
				callback: (a) => {
					if(a == true){
						MV.api.update('/accounts_communications/' + self.replySelected.id, {
							status: 0,
							updated_by: <?= $this->user->id; ?>,
						}, (c) => {
							if(c > 0){
								self.replySelected.status = 0;
								self.MeAccountCommunications(self.replySelected.account);
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
		},
		markAsSolved(){
			var self = this;
			bootbox.confirm({
				title: "Confirma tu accion",
				message: "Debes de confirmar antes de cambiar esta comunicacion a \"Solucionada\", eventualmente será cerrada por nuestro sistema y no recibiras mas notificaciones.",
				locale: 'es',
				centerVertical: true,
				callback: (a) => {
					if(a == true){
						MV.api.update('/accounts_communications/' + self.replySelected.id, {
							status: 0,
							is_closed: 1,
							updated_by: <?= $this->user->id; ?>,
						}, (c) => {
							if(c > 0){
								self.MeAccountCommunications(self.replySelected.account);
								self.replySelected.is_closed = 1;
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
		},
		MeAccountCommunications(account_id){
			var self = this;
			var box_list_communications = $("#box-list-communications");
			self.forms.create_user.account = account_id;
			MV.api.readList('/accounts_communications', {
				filter: [
					'account,eq,' + account_id,
				], join: [
					'users',
					'accounts_communications_parts,users',
				],
				order: 'updated,desc'
			}, (a) => {
				self.meCommunicationsView = [];
				a.forEach((b) => {
					self.meCommunicationsView.push(b);
				});
				self.dialogCommunications.modal('show');
			});
		},
		MeAccountContact(account_id){
			var self = this;
			bootbox.prompt({
				title: "Nueva Solicitud/Comunicacion",
				message: "Cuentanos tu solicitud y nuestro personal sera notificado.",
				locale: 'es',
				centerVertical: true,
				inputType: 'textarea',
				callback: (a) => {
					if(a !== null){
						if(a.length > 15){
							MV.api.create('/accounts_communications', {
								account: account_id,
								created_by: <?= $this->user->id; ?>,
								updated_by: <?= $this->user->id; ?>,
							}, (b) => {
								if(b > 0){
									MV.api.create('/accounts_communications_parts', {
										communication: b,
										account: account_id,
										message: a,
										created_by: <?= $this->user->id; ?>,
										updated_by: <?= $this->user->id; ?>,
									}, (c) => {
										if(c > 0){
											self.MeAccountCommunications(account_id);
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
											
											self.sendNotificationAccountGroup(account_id, {
												type: 'new-communication-client',
												data:  {
													id: c,
													communication: b,
													account: account_id,
													message: a,
													created_by: <?= $this->user->id; ?>,
													updated_by: <?= $this->user->id; ?>,
												},
											});
										} else {
											self.showErrorModal("Ocurrio un error misterioso al enviar el mensaje.");
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
		},
		deleteUserInMeAccount(relationshipId){
			var self = this;
			bootbox.confirm({
				message: "Confirme que desea eliminar este usuario de su lista?",
				locale: 'es',
				centerVertical: true,
				callback: function (result) {
					if(result == true){
						MV.api.remove('/accounts_users/' + relationshipId, {
							id: relationshipId
						}, (a) => {
							self.loadUsersAccountInModal();
						});
					}
				}
			});
		},
		updatePermissionsUserInMeAccount(relationshipId){
			var self = this;
			options = self.options.permissions_group.map((a) => {
				return {
					value: a.id,
					text: a.name,
				};
			});
			bootbox.prompt({
				title: "Actualizar permisos",
				message: "Elija los nuevos permisos de acceso.",
				locale: 'es',
				centerVertical: true,
				inputType: 'radio',
				inputOptions: options,
				callback: function (result) {
					if(result > 0){
						MV.api.update('/accounts_users/' + relationshipId, {
							id: relationshipId,
							permissions: result,
						}, (a) => {
							self.loadUsersAccountInModal();
						});
					}
				}
			});
		},
		resetFormCreateUser(){
			var self = this;
			self.forms.create_user.username = 'tu.usuario';
			self.forms.create_user.password = '123456';
			self.forms.create_user.verify_password = '';
			self.forms.create_user.names = '';
			self.forms.create_user.surname = '';
			self.forms.create_user.phone = '';
			self.forms.create_user.mobile = '';
			self.forms.create_user.email = 'otro@usuario.com';
			self.forms.create_user.permissions = 0;
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
		checkInputEmailnewUser(event){
			var self = this;
			var newValue = $(event.target).val();
			userResult = self.validateEmail(newValue);
			if(userResult == true && newValue !== self.forms.create_user.email){
				MV.api.readList('/users', {
					filter: [
						'email,eq,' + newValue
					]
				}, (a) => {
					if(a.length > 0){
						bootbox.confirm({
							message: "Desea agrega a " + newValue + "?",
							locale: 'es',
							centerVertical: true,
							callback: function (b) {
								if(b == true){
									options = self.options.permissions_group.map((a) => {
										return {
											value: a.id,
											text: a.name,
										};
									});
									bootbox.prompt({
										title: "Actualizar permisos",
										message: "Elija los nuevos permisos de acceso.",
										locale: 'es',
										centerVertical: true,
										inputType: 'radio',
										inputOptions: options,
										callback: function (c) {
											if(c > 0){
												MV.api.create('/accounts_users', {
													user: a[0].id,
													account: self.forms.create_user.account,
													permissions: c,
												}, (d) => {
													self.loadUsersAccountInModal();
												});
											}
										}
									});
								} else {
									self.showErrorModal("Ya existe este usuario intenta con otro.");
									$(event.target).val(self.forms.create_user.email);
								}
							}
						});
						self.showErrorModal("Ya existe este usuario intenta con otro o selecciona \"Añadir\"");
						$(event.target).val(self.forms.create_user.username);
					} else {
						self.forms.create_user.email = newValue;
						$(event.target).val(newValue);
					}
				});
			} else {
				$(event.target).val(self.forms.create_user.email);
				self.showErrorModal("Usuario invalido.");
			}
		},
		checkInputNicknewUser(event){
			var self = this;
			var newValue = $(event.target).val();
			userResult = self.validateNick(newValue);
			if(userResult == true && newValue !== self.forms.create_user.username){
				MV.api.readList('/users', {
					filter: [
						'username,eq,' + newValue
					]
				}, (a) => {
					if(a.length > 0){
						bootbox.confirm({
							message: "Desea agrega a " + newValue + "?",
							locale: 'es',
							centerVertical: true,
							callback: function (b) {
								if(b == true){
									options = self.options.permissions_group.map((a) => {
										return {
											value: a.id,
											text: a.name,
										};
									});
									bootbox.prompt({
										title: "Actualizar permisos",
										message: "Elija los nuevos permisos de acceso.",
										locale: 'es',
										centerVertical: true,
										inputType: 'radio',
										inputOptions: options,
										callback: function (c) {
											if(c > 0){
												MV.api.create('/accounts_users', {
													user: a[0].id,
													account: self.forms.create_user.account,
													permissions: c,
												}, (d) => {
													self.loadUsersAccountInModal();
												});
											}
										}
									});
								}
							}
						});
						self.showErrorModal("Ya existe este usuario intenta con otro o selecciona \"Añadir\"");
						$(event.target).val(self.forms.create_user.username);
					} else {
						self.forms.create_user.username = newValue;
						$(event.target).val(newValue);
					}
				});
			} else {
				$(event.target).val(self.forms.create_user.username);
				self.showErrorModal("Usuario invalido.");
			}
		},
		validateEmail(email) {
			var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(String(email).toLowerCase());
		},
		validateNick(username) {
			var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))$/;
			return re.test(String(username).toLowerCase());
		},
		submitCreateUserInAccount(){
			var self = this;
			try {
				if(self.validateNick(self.forms.create_user.username) == true && self.validateEmail(self.forms.create_user.email) == true){
					if(self.forms.create_user.password !== self.forms.create_user.verify_password){
						self.showErrorModal("Las contraseñas no coinciden.");
					} else {
						if(self.forms.create_user.permissions > 0 || self.forms.create_user.permissions == null){
							send = self.forms.create_user;
							send.controller = 'site';
							send.action = 'InviteUserInAccount';
							
							MV.apiFG.get('/index.php', {
								params: send
							})
							.then(function (a){
								response = a.data;
								if(response.error !== undefined && response.error == false){
									new PNotify({
										"title": "Exito!",
										"text": "Usuario creado correctamente!",
										"styling":"bootstrap3",
										"type":"success",
										"icon":true,
										"animation":"flip",
										"hide":true,
										"delay": 1500,
									});
									self.resetFormCreateUser();
									self.loadUsersAccountInModal();
								} else {
									self.showErrorModal("Ocurrio un error agregando el usuario.");
								}
							})
							.catch(function (e) {
								if(e.response) { console.log(e.response); }
								console.log(e);
							});
						} else {
							self.showErrorModal("Selecciona los permisos para esté usuario.");
						}
					}
				}
			} catch (e){
				console.error(e);
				return false;
			}
		},
		submitEditAccountInModal(){
			var self = this;
			try {				
				MV.api.update('/accounts/' + self.forms.account_edit.id, self.forms.account_edit, (a) => {
					if(Number(a) > 0){
						new PNotify({
							"title": "¡Éxito!",
							"text": "Datos actualizados correctamente.",
							"styling":"bootstrap3",
							"type":"success",
							"icon":true,
							"animation":"zoom",
							"hide":true,
							"delay": 2500,
						});
						self.dialogEdit.modal('hide');
						self.load();
					} else {
						new PNotify({
							"title": "¡Ups!",
							"text": "Ocurrio un error actualizando los datos, intenta nuevamente.",
							"styling":"bootstrap3",
							"type":"error",
							"icon":true,
							"animation":"zoom",
							"hide":true,
							"delay": 2500,
						});
					}
				});
			} catch(e){
				console.error(e);
			}
		},
		loadOptions(data){
			var self = this;
			MV.api.readList('/economic_activities', {}, (a) => {
				self.options.economic_activities = a;
			});
			MV.api.readList('/identifications_types', {}, (a) => {
				self.options.identifications_types = a;
			});
			MV.api.readList('/permissions_group', {
				filter: [
					'for_user,eq,0',
					'for_account,eq,1',
				]
			}, (a) => {
				self.options.permissions_group = a;
			});
			self.load();
		},
		setFormAccountEdit(data){
			var self = this;
			try {
				self.forms.account_edit = {
					id: data.account.id,
					email: data.account.email,
					phone: data.account.phone,
					mobile: data.account.mobile,
					birthday: data.account.birthday,
					address: data.account.address,
				};
				self.forms.create_user.account = data.account.id;
				self.forms.account_edit_contacts = (data.account.accounts_contacts) ? data.account.accounts_contacts : [];
			} catch (e){
				console.error(e);
				return false;
			}
			
		},
		openEditAccount(data){
			var self = this;
			try {
				if(self.isAdminInAccount(data.permissions) == true){
					self.setFormAccountEdit(data);
					self.dialogEdit.modal('show');
				} else {
					return false;
				}
			} catch (e){
				console.error(e);
				return false;
			}
		},
		loadUsersAccountInModal(){
			var self = this;
			try {
				self.forms.manager_users = [];
				MV.api.readList('/accounts_users', {
					filter: [
						'account,eq,' + self.forms.create_user.account
					],
					join: [
						'users',
						'permissions_group'
					]
				}, (a) => {
					self.forms.manager_users = a;
				});
			} catch (e){
				console.error(e);
				return false;
			}
		},
		openManagerUsersInAccount(data){
			var self = this;
			try {
				if(self.isAdminInAccount(data.permissions) == true){
					self.forms.manager_users = [];
					MV.api.readList('/accounts_users', {
						filter: [
							'account,eq,' + data.account.id
						],
						join: [
							'users',
							'permissions_group'
						]
					}, (a) => {
						self.setFormAccountEdit(data);
						self.forms.manager_users = a;
						self.dialogManagerusers.modal('show');
					});
				} else {
					return false;
				}
			} catch (e){
				console.error(e);
				return false;
			}
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
		load(){
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
					'accounts,accounts_contacts,contacts',
					'accounts,accounts_contacts,contacts_types',
					'permissions_group,permissions_items',
				]
			}, (a) => {
				a.forEach((b) => {
					b.isAdmin = self.isAdminInAccount(b.permissions);
					b.isManager = self.isManagerInAccount(b.permissions);
					self.records.push(b);
				});
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
	mounted(){
		var self = this;
	},
	data: function () { return {}; },
	methods: {
	}
}).$mount('#me-accounts');
</script>
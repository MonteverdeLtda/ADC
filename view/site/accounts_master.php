<style>
.circle-color {
	position: relative;
	margin: 0 auto;
	width: 25px;
	height: 25px;
	border-radius: 9999px;
	background-color: HSL(45,100%,50%);
}
.modal {
	overflow: auto;
}
.bootbox-input-textarea {
	min-height: 170px;
}
</style>

<div class="page-title">
	<div class="title_left">
		<h3><?= isset($title) ? $title : ""; ?> <small> <?= isset($subtitle) ? $subtitle : ""; ?></small></h3>
	</div>
</div>
<div class="clearfix"></div>

<div class="row" id="accounts-app">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<router-view :key="$route.fullPath" ></router-view>
	</div>
</div>
<div class="clearfix"></div>

<template id="list">
	<div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Listado general <small>Cuentas</small></h2>
						<ul class="nav navbar-right panel_toolbox">
							<li>
								<router-link  v-bind:to="{ name: 'Search' }">
									<i class="fa fa-plus"></i> / <i class="fa fa-search"></i>
								</router-link>
							</li>
							<!-- // <li><a @click="load" class="refresh"><i class="glyphicon glyphicon-refresh"></i></a></li> -->
							<!-- //
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>

								<ul class="dropdown-menu" role="menu">
									<li><a href="#">Settings 1</a></li>
									<li><a href="#">Settings 2</a></li>
								</ul>
							</li>
							-->
							<!-- // <li><a class="close-link"><i class="fa fa-close"></i></a></li> -->
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<p class="text-muted font-13 m-b-30">
							Las cuentas son aquellas entidades y/o personas naturales a las cuales se les presta servicios y/o projectos, Son requeridas para la facturacion.
						</p>
						<table id="datatable-buttons2" class="table table-striped table-bordered table-responsive">
							<thead></thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<template id="view">
	<div>
		<div class="row  btn-pref btn-group btn-group-justified">
			<div class="col-md-12 col-sm-12 col-xs-12" >
				<div class="x_panel" >
					<div class="x_title">
						<h2>Ver <small>Cuenta</small></h2>
						<ul class="nav navbar-right panel_toolbox">
							<!-- // <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li> -->
							<li><a @click="load" class="refresh"><i class="glyphicon glyphicon-refresh"></i></a></li>
							<!-- // <li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#">Settings 1</a></li>
									<li><a href="#">Settings 2</a></li>
								</ul>
							</li>-->
							<li>
								<router-link  v-bind:to="{ name: 'List' }">
									<i class="fa fa-close"></i>
								</router-link>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div>
							<center>
								<div class="tabnav">
									<div class="btn-group btn-group-justified ">
										<div class="btn-group  " role="group">
											<button id="b1" type="button" class="btn btn-nav" href="#tab-basic" data-toggle="tab" >
												<div class="visible"><span class="glyphicon glyphicon-dashboard" aria-hidden="true"> </span> Info. Básica </div>
											</button>
										</div>
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-nav" href="#tab-contacts" data-toggle="tab" >
												<div class="visible"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Contactos </div>
											</button>
										</div>
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-nav" href="#tab-contracts" data-toggle="tab" >
												<div class="visible"><span class="fa fa-legal" aria-hidden="true"></span> Contratos </div>
											</button>
										</div>
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-nav" href="#tab-headquarters" data-toggle="tab">
												<div class="visible"><span class="fa fa-building-o" aria-hidden="true"></span> Sedes </div>
											</button>
										</div>
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-nav" href="#tab-requests" data-toggle="tab">
												<div class="visible"><span class="fa fa-info-circle" aria-hidden="true"></span> Solicitudes </div>
											</button>
										</div>


										<!-- //
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-nav" href="#tab-users" data-toggle="tab">
												<div class="visible">
													<span class="fa fa-users" aria-hidden="true"></span>
													Usuarios
												</div>
											</button>
										</div>
										-->

										<!-- //
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-nav" href="#tab4" data-toggle="tab">

											<div class="visible">Multimedia <span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span></div>
											</button>
										</div>
										-->

										<!-- //
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-nav" href="#tab5" data-toggle="tab">
											 <div class="visible">Dashboard <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span></div>
											</button>
										</div>
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-nav" href="#tab6" data-toggle="tab">
											<div class="visible">Studio <span class="glyphicon glyphicon-bell"  aria-hidden="true"></span></div>
											</button>
										</div>
										-->
									</div>
								</div>
							</center>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div  class="tab-content" style="margin-top:10px; ">
					<!-- Info Básica -->
					<div class="tab-pane active" id="tab-basic">
						<div class="x_panel">
							<div class="x_content">
								<div class="col-sm-12">
									<div class="card card-default">
										<div class="card-header">
											<h4 class="card-title" style="color: #666;">
												<i class="glyphicon glyphicon-info-sign text-gold"></i>
												<b>I: Informacion Básica</b>
											</h4>
										</div>
										<div class="card-body">
											<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
												</div>
											</div>

											<div class="row">
												<div class="col-sm-12">
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">Tipo de Cliente</label>
															<select class="form-control select2_single2" v-model="record.type" data-options="accounts_types" data-model="type" required="true">
																<option value="0">Seleccione una opcion</option>
																<option v-for="(item, index_item) in options.accounts_types" :key="item.id" :value="item.id">{{ item.name }}</option>
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">Actividad Economica</label>
															<select v-model="record.economic_activity" id="form-create-economic_activity" data-model="economic_activity" required="required" class="form-control select2_single2">
																<option value="0">Seleccione una opcion.</option>
																<option v-for="(item, index_item) in options.economic_activities" :key="item.id" :value="item.id">{{ item.name }}</option>
															</select>
														</div>
													</div>
												</div>
												<div class="col-sm-12">
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">Tipo de Documento</label>
															<select class="form-control" v-model="record.identification_type" required="true">
																<option value="">Seleccione una opcion</option>
																<option v-for="(item, index_item) in options.identifications_types" :key="item.id" :value="item.id">{{ item.name }}</option>
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label"># Documento</label>
															<input type="text" class="form-control" v-model="record.identification_number" required="true" />
														</div>
													</div>
												</div>
												<div class="col-sm-12">
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">Nombres</label>
															<input type="text" class="form-control" v-model="record.names" required="true" />
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">Apellidos</label>
															<input type="text" class="form-control" v-model="record.surname" required="true" />
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="card card-default" v-if="record.type == 1">
										<div class="card-header">
											<h4 class="card-title" style="color: #666;">
												<i class="glyphicon glyphicon-phone-alt text-gold"></i>
												<b>Información Campañas Marketing</b>
											</h4>
										</div>
										<div class="card-body">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Genero (*)</label>
													<select v-model="record.gender" type="text" class="form-control col-md-7 col-xs-12">
														<option></option>
														<option value="male">Masculino</option>
														<option value="female">Femenino</option>
													</select>
												</div>
											</div>
										</div>
										<br>
									</div>

									<hr />
									<div class="card card-default">
										<div class="card-header">
											<h4 class="card-title" style="color: #666;">
												<i class="glyphicon glyphicon-phone-alt text-gold"></i>
												<b>II: Informacion de contacto</b>
											</h4>
										</div>
										<div class="card-body">
											<div class="row">
												<div class="col-sm-12">
													<div class="col-sm-4">
														<label class="control-label">Email</label>
														<div class="input-group">
															<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
															<input type="text" class="form-control" v-model="record.email" required="true" />
														</div>
													</div>
													<div class="col-sm-4">
														<label class="control-label">T. Fijo</label>
														<div class="input-group">
															<span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
															<input type="text" class="form-control" v-model="record.phone" required="true" />
														</div>
													</div>
													<div class="col-sm-4">
														<label class="control-label">T. Móvil</label>
														<div class="input-group">
															<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
															<input type="text" class="form-control" v-model="record.mobile" required="true" />
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>



									<hr />
									<div class="card card-default">
										<div class="card-header">
											<h4 class="card-title" style="color: #666;">
												<i class="glyphicon glyphicon-map-marker text-gold"></i>
												<b>III: Ubicación</b>
											</h4>
										</div>
										<div class="card-body">
											<div class="row">
												<div class="col-sm-12">
													<label class="control-label">Dirección</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
														<input type="text" class="form-control" v-model="record.address" required="true" />
													</div>
												</div>
											
											</div>
										</div>
									</div>
									<hr />
									<div class="card card-default">
										<div class="pull-right">
											<a @click="saveAccount" class="btn btn-md btn-default">
												<i class="fa fa-save"></i>
												Guardar
											</a>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<!-- // Info Básica -->
					<!-- Contactos -->
					<div class="tab-pane panel" id="tab-contacts">
						<div class="x_panel">
							<div class="x_title">
								<h2>
									<i class="fa fa-user text-gold"></i>
									<b>Contactos</b>
								</h2>
								<ul class="nav navbar-right panel_toolbox">
									<!-- // <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li> -->
									<li>
										<a data-toggle="modal" data-target="#create-contact-modal" style="color: #666;">
											<i class="glyphicon glyphicon-plus"></i>
											Nuevo
										</a>
									</li>
									<li>
										<a data-toggle="modal" data-target="#search-contact-modal" style="color: #666;">
											<i class="glyphicon glyphicon-search"></i>
											Existente
										</a>
									</li>
								</ul>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<template v-if="record.accounts_contacts !== undefined && record.accounts_contacts !== null">
									<template v-if="record.accounts_contacts.length > 0">
										<div class="col-xs-12">
											<div class="">
												<div class="">
													<div class="row">
														<!--
															<div class="col-md-12 col-sm-12 col-xs-12 text-center">
																<ul class="pagination pagination-split">
																	<li><a href="#">A</a></li>
																	<li><a href="#">B</a></li>
																	<li><a href="#">C</a></li>
																	<li><a href="#">D</a></li>
																	<li><a href="#">E</a></li>
																	<li>...</li>
																	<li><a href="#">W</a></li>
																	<li><a href="#">X</a></li>
																	<li><a href="#">Y</a></li>
																	<li><a href="#">Z</a></li>
																</ul>
															</div>
														-->

														<div v-for="(contact, index_contact) in record.accounts_contacts" class="col-md-4 col-sm-4 col-xs-6">
															<div class="profile_details">
																<div class="well profile_view">
																	<div class="col-sm-12">
																		<template v-if="contact.type !== undefined && contact.type.name !== undefined">
																			<h4 class="brief"><i>{{ contact.type.name }}</i></h4>
																		</template>
																		<div class="left col-xs-12">
																			<template v-if="contact.contact !== undefined && contact.contact.id !== undefined">
																				<h2>{{ contact.contact.names }} {{ contact.contact.surname }} </h2>


																				<!-- // <p><strong>About: </strong> Web Designer / UX / Graphic Artist / Coffee Lover </p> -->
																				<p>
																					<strong><i class="glyphicon glyphicon-phone-alt"></i>: </strong>
																					 {{ contact.contact.phone }}
																				</p>
																				<p>
																					<strong><i class="glyphicon glyphicon-phone"></i>: </strong>
																					 {{ contact.contact.mobile }}
																				</p>
																				<ul class="list-unstyled">
																					<li><i class="fa fa-building"></i> Dirección: {{ contact.contact.address }}</li>
																					<li></li>
																					<li></li>
																				</ul>
																			</template>

																		</div>
																		<div class="right col-xs-5 text-center">
																			<!-- // <img src="/public/assets/images/img.jpg" alt="" class="img-circle img-responsive"> -->

																		</div>
																	</div>
																	<div class="col-xs-12 bottom text-center">
																		<div class="col-xs-12 col-sm-6 emphasis">
																			<!-- //
																			<p class="ratings">
																				<a>4.0</a>
																				<a href="#"><span class="fa fa-star"></span></a>
																				<a href="#"><span class="fa fa-star"></span></a>
																				<a href="#"><span class="fa fa-star"></span></a>
																				<a href="#"><span class="fa fa-star"></span></a>
																				<a href="#"><span class="fa fa-star-o"></span></a>
																			</p>
																			-->
																		</div>
																		<div class="col-xs-12 col-sm-12 emphasis">
																			<!-- //
																			<button type="button" class="btn btn-success btn-xs"> <i class="fa fa-user">
																				</i> <i class="fa fa-comments-o"></i>
																			</button>
																			-->
																			<button @click="removeContactInAccount(contact.id)" type="button" class="btn btn-danger btn-xs pull-left">
																				<i class="fa fa-times"> </i> Quitar
																			</button>
																			<button @click="loadContactInModal(contact)" type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#view-contacts-modal">
																				<i class="fa fa-user"> </i> Ver
																			</button>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</template>
									<template v-else>
										<p>
											Esta cuanta no tiene contactos, Agrega almenos 1.
										</p>
									</template>
								</template>
							</div>
						</div>
					</div>
					<!-- // Contactos -->
					<!-- Contratos -->
					<div class="tab-pane panel" id="tab-contracts">
						<div class="x_panel">
							<div class="x_title">
								<h2>
									<i class="fa fa-legal text-gold"></i>
									<b>Contratos</b>
								</h2>
								<ul class="nav navbar-right panel_toolbox">
									<!-- // <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li> -->
									<li>
										<a @click="createContractInModal" style="color: #666;">
											<i class="glyphicon glyphicon-plus"></i>
											Nuevo
										</a>
									</li>
								</ul>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<template v-if="record.accounts_contracts !== undefined && record.accounts_contracts !== null">
									<template v-if="record.accounts_contracts.length > 0">
										<div class="col-xs-12">
											<div class="">
												<div class="">
													<div class="row">
														<!--
															<div class="col-md-12 col-sm-12 col-xs-12 text-center">
																<ul class="pagination pagination-split">
																	<li><a href="#">A</a></li>
																	<li><a href="#">B</a></li>
																	<li><a href="#">C</a></li>
																	<li><a href="#">D</a></li>
																	<li><a href="#">E</a></li>
																	<li>...</li>
																	<li><a href="#">W</a></li>
																	<li><a href="#">X</a></li>
																	<li><a href="#">Y</a></li>
																	<li><a href="#">Z</a></li>
																</ul>
															</div>
														-->

														<div v-for="(contract, contract_i) in record.accounts_contracts" class="col-md-4 col-sm-4 col-xs-6">
															<div class="profile_details">
																<div class="well profile_view">
																	<div class="col-sm-12">
																		<h4 class="brief"><i>{{ contract.start }} | {{ contract.end }}</i></h4>
																		<div class="left col-xs-12">
																			<h2> {{ contract.name }} </h2>
																			
																			<template v-if="contract.is_active == 1">
																				<p>Contrato activo.</p>
																			</template>
																			<template v-else>
																				<p>Contrato inactivo.</p>
																			</template>

																			<ul class="list-unstyled">
																				<li>Microrutas: <a @click="openListMicroroutesModal(contract)" class="btn btn-default"> <i class="fa fa-road"></i>  {{ contract.microroutes.length }}</a></li>
																				<li></li>
																				<li></li>
																			</ul>
																		</div>
																		<div class="right col-xs-5 text-center">
																			<!-- // <img src="/public/assets/images/img.jpg" alt="" class="img-circle img-responsive"> -->
																		</div>
																	</div>
																	<div class="col-xs-12 bottom text-center">
																		<div class="col-xs-12 col-sm-6 emphasis">
																			<!-- //
																			<p class="ratings">
																				<a>4.0</a>
																				<a href="#"><span class="fa fa-star"></span></a>
																				<a href="#"><span class="fa fa-star"></span></a>
																				<a href="#"><span class="fa fa-star"></span></a>
																				<a href="#"><span class="fa fa-star"></span></a>
																				<a href="#"><span class="fa fa-star-o"></span></a>
																			</p>
																			-->
																		</div>
																		<div class="col-xs-12 col-sm-12 emphasis">
																			<!-- //
																			<button type="button" class="btn btn-success btn-xs"> <i class="fa fa-user">
																				</i> <i class="fa fa-comments-o"></i>
																			</button>
																			-->
																			<button @click="loadContractInModal(contract)" type="button" class="btn btn-primary btn-xs pull-right">
																				<i class="fa fa-user"> </i> Ver
																			</button>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														
														
														
														
													</div>
												</div>
											</div>
										</div>
									</template>
									<template v-else>
										<p>
											Esta cuanta no tiene contratos.
										</p>
									</template>
								</template>
							</div>
						</div>
					</div>
					<!-- // Contactos -->
					<!-- Servicios -->
					<div class="tab-pane panel" id="tab-services">
						<div class="x_panel">
							<div class="x_title">
								<h2>
									<i class="glyphicon glyphicon-search text-gold"></i>
									<b>Servicios</b>
								</h2>
								<ul class="nav navbar-right panel_toolbox">
									<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
										<ul class="dropdown-menu" role="menu">
											<li><a href="#">Settings 1</a></li>
											<li><a href="#">Settings 2</a></li>
										</ul>
									</li>
								</ul>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
							</div>
						</div>
					</div>
					<!-- // Servicios -->
					<!-- Sedes -->
					<div class="tab-pane panel" id="tab-headquarters">
						<div class="x_panel">
							<div class="x_title">
								<h2>
									<i class="glyphicon glyphicon-search text-gold"></i>
									<b>Sedes</b>
								</h2>
								<ul class="nav navbar-right panel_toolbox">
									<!-- //
									<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
										<ul class="dropdown-menu" role="menu">
											<li><a href="#">Settings 1</a></li>
											<li><a href="#">Settings 2</a></li>
										</ul>
									</li>
									-->
									<li>
										<a data-toggle="modal" data-target="#headquarters-modal"><i class="fa fa-plus"></i></a>
									</li>
								</ul>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">

									<!-- start project list -->
									<table class="table table-striped projects">
										<thead>
											<tr>
											  <th style="width: 1%">#</th>
											  <th style="width: 20%">Sede</th>
											  <th>Direccion</th>
											  <th style="width: 10%">Acciones</th>
											</tr>
										</thead>
										<tbody>
											<template v-if="record.accounts_headquarters.length > 0">
												<tr v-for="(headquarter, index_headquarter) in record.accounts_headquarters">
													<td>#</td>
													<td>
														<a>{{ headquarter.name }}</a>
														<!-- // <br />
														<small>Created 01.01.2015</small> -->
													</td>
													<td>
														{{ headquarter.address.complete }}
													</td>
													<td>
														<a @click="removeHeadquarters(headquarter.id)" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Quitar Sede </a>
														<!-- //
														<router-link tag="a" v-bind:to="{ name: 'Project-Details', params: { account_id: $route.params.account_id, project_id: 0 } }" class="btn btn-primary btn-xs">
															<i class="fa fa-folder"></i> Ver </a>
														</router-link>
														<a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
														<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
														-->
													</td>
												</tr>
											</template>
										</tbody>
									</table>
									<!-- end project list -->

							</div>
						</div>
					</div>
					<!-- // Sedes -->
					<!-- Solicitudes -->
					<div class="tab-pane panel" id="tab-requests">
						<div class="x_panel">
							<div class="x_title">
								<h2>
									<i class="fa fa-info-circle"></i>
									<b>Solicitudes</b>
								</h2>
								<ul class="nav navbar-right panel_toolbox">
									<li>
										<router-link  v-bind:to="{ name: 'Create-Request', params: { account_id: $route.params.account_id } }">
											<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										</router-link>
									</li>
								</ul>
								<div class="clearfix"></div>
							</div>
							
							<div class="x_content">
								<!-- start project list -->
								<table class="table table-striped projects">
									<thead>
										<tr>
											<th style="width: 1%">#</th>
											<th colspan="2">Estado Actual</th>
											<!-- <th>Creada por</th> -->
											<!-- // <th style="width: 20%">Project Name</th> -->
											<th>Fecha Creación</th>
											<th>Última Actualización</th>
											<th style="width: 20%">#Edit</th>
										</tr>
									</thead>
									<tbody>
										<template v-if="record.requests.length > 0">
											<tr v-for="(request, request_index) in record.requests">
												<td>{{ request.id }}</td>
												<td><div :title="request.status.description" class="circle-color" :style="'background-color:#' + request.status.color"></div></td>
												<td>
													<button :title="request.status.description" type="button" class="btn btn-xs"  :style="'color: #FFFFFF;background-color:#' + request.status.color">
														{{ request.status.name }}
													</button>
												</td>
												<td>{{ request.created }}</td>
												<td>{{ request.updated }}</td>
												
												<!-- //
												<td>
													<ul class="list-inline">
														<li>
															<img src="/public/assets/images/user.png" class="avatar" :title="request.create_by.names + ' ' + request.create_by.surname" :alt="request.create_by.names + ' ' + request.create_by.surname">
															{{ request.create_by.names }} {{ request.create_by.surname }}
														</li>
													</ul>
												</td>
												-->
												<!-- //
												<td>
													<a>Pesamakini Backend UI</a>
													<br />
													<small>Created {{ request.created }}</small>
												</td>
												-->.
												<!-- //
												<td>
													<ul class="list-inline">
														<li>
															<img src="/public/assets/images/user.png" class="avatar" alt="Avatar">
														</li>
														<li>
															<img src="/public/assets/images/user.png" class="avatar" alt="Avatar">
														</li>
														<li>
														<img src="/public/assets/images/user.png" class="avatar" alt="Avatar">
														</li>
														<li>
														<img src="/public/assets/images/user.png" class="avatar" alt="Avatar">
														</li>
													</ul>
												</td>
												-->
												<!-- //
												<td class="project_progress">
													<div class="progress progress_sm">
														<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="57"></div>
													</div>
													<small>57% Complete</small>
												</td>
												-->
												
												<td>
													<router-link  v-bind:to="{ name: 'View-Requests', params: { account_id: request.account, request_id: request.id } }" class="btn btn-primary btn-xs">
														<i class="fa fa-folder"></i> Abrir 
													</router-link>
													<!-- // <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a> -->
													<!-- // <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a> -->
													<!-- // <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a> -->
												</td>
											</tr>
										</template>
										<template v-else>
											<tr>
												<td colspan="6">
													No hay solicitudes.
												</td>
											</tr>
										</template>
									</tbody>
								</table>
								<!-- end project list -->

							</div>
							
							<div class="x_content">
								{{ record.requests }}
								<hr>
							</div>
						</div>
					</div>
					<!-- // Solicitudes -->
					<!-- Usuarios -->
					<div class="tab-pane panel" id="tab-users">
						<div class="x_panel">
							<div class="x_title">
								<h2>
									<i class="glyphicon glyphicon-search text-gold"></i>
									<b>Usuarios</b>
								</h2>
								<ul class="nav navbar-right panel_toolbox">
									<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
										<ul class="dropdown-menu" role="menu">
											<li><a href="#">Settings 1</a></li>
											<li><a href="#">Settings 2</a></li>
										</ul>
									</li>
								</ul>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
							</div>
						</div>
					</div>
					<!-- // Usuarios -->
				</div>
			</div>
			<div class="col-md-7 col-sm-7 col-xs-7">
				<div class="btn-group" role="group">
					<button type="button" class="btn btn-nav" href="#tab4" data-toggle="tab">
						<div class="visible">
							<router-link  v-bind:to="{ name: 'Search' }">
								<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
								Regresar
							</router-link>
						</div>
					</button>
				</div>
			</div>
		</div>

		<!-- Modal View and Edit  -->
		<div class="modal fade" id="view-contacts-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabelSmall" aria-hidden="true">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modalLabelSmall">Ver Contacto</h4>
					</div>
					<div class="modal-body">
						<div class="container bootstrap snippet">
							<div class="row">
								<ul class="nav nav-tabs">
									<li class="active"><a data-toggle="tab" href="#home">Contacto</a></li>
									<!-- //
										<li><a data-toggle="tab" href="#messages">Menu 1</a></li>
										<li><a data-toggle="tab" href="#settings">Menu 2</a></li>
									-->
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="home">
										<form class="form" action="javascript:false;" v-on:submit="saveContactModal" method="post" id="registrationForm">
											<div class="form-group">
												<div class="col-xs-12">
													<label for="first_name"><h4>Relacion / Parentesco</h4></label>
													<select class="form-control" v-model="edit.contact.type" name="contact_identification_identification_type" id="contact_identification_type" required="true">
														<option value="0">Seleccione una opcion</option>
														<option v-for="(item, index_item) in options.contacts_types" :key="item.id" :value="item.id">{{ item.name }}</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4>Tipo Documento</h4></label>
													<select class="form-control" v-model="edit.contact.contact.identification_type" name="contact_identification_identification_type" id="contact_identification_type" required="true">
														<option value="">Seleccione una opcion</option>
														<option v-for="(item, index_item) in options.identifications_types" :key="item.id" :value="item.id">{{ item.name }}</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4># Documento</h4></label>
													<input type="text" class="form-control" name="contact_identification_number" id="contact_identification_number" placeholder="Numero documento de identidad" title="Ingrese el numero de documento de identificación." v-model="edit.contact.contact.identification_number">
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4>Nombres</h4></label>
													<input type="text" class="form-control" name="contact_names" id="contact_names" placeholder="Nombres" title="Ingrese el/los nombre(s) completo." v-model="edit.contact.contact.names">
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4>Apellidos</h4></label>
													<input type="text" class="form-control" name="contact_surname" id="contact_surname" placeholder="Apellidos" title="Ingrese el/los apellidos." v-model="edit.contact.contact.surname">
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4>Correo Electronico</h4></label>
													<input type="email" class="form-control" name="contact_email" id="contact_email" placeholder="" title="Ingrese el correo electronico." v-model="edit.contact.contact.email">
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4>Telefono Fijo</h4></label>
													<input type="text" class="form-control" name="contact_" id="contact_" placeholder="" title="Ingrese el teléfono fijo." v-model="edit.contact.contact.phone">
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4>Telefono Móvil</h4></label>
													<input type="text" class="form-control" name="contact_mobile" id="contact_mobile" placeholder="Telefono Celular / Movil" title="Ingrese el teléfono móvil." v-model="edit.contact.contact.mobile">
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4>Fecha de cumpleaños</h4></label>
													<input type="date" class="form-control" name="contact_birthdayEdit" id="contact_birthdayEdit" placeholder="" title="Cumpleaños." v-model="edit.contact.contact.birthday">
													Formato: AÑO-MES-DÍA
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="mobile"><h4>Departamento</h4></label>

													<select class="form-control" v-model="edit.contact.contact.department" @change="loadCitysModal(edit.contact.contact.department)">
														<option value="">Seleccione una opcion</option>
														<option v-for="(item, index_item) in options.geo_departments" :key="item.id" :value="item.id">{{ item.name }}</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="email"><h4>Ciudad</h4></label>
													<select class="form-control" v-model="edit.contact.contact.city">
														<option value="">Seleccione una opcion</option>
														<option v-for="(item, index_item) in options.geo_citysModal" :key="item.id" :value="item.id">{{ item.name }}</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-12">
													<label for="email"><h4>Dirección</h4></label>
													<textarea v-model="edit.contact.contact.address" type="text" class="form-control">{{ edit.contact.contact.address }}</textarea>
												</div>
											</div>

											<div class="form-group">
												<div class="col-xs-12">
													<br>
													<button class="btn btn-sm btn-success" type="submit">
														<i class="glyphicon glyphicon-floppy-disk"></i>
														Guardar
													</button>
													<!-- <button class="btn btn-sm" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button> -->
													<button class="btn btn-sm pull-right" type="button"  class="close" data-dismiss="modal" aria-label="Close">
														<i class="glyphicon glyphicon-remove"></i>
														Cerrar
													</button>
												</div>
											</div>
										</form>
										<hr>
									</div>
									<!-- tab-pane-->
									<div class="tab-pane" id="messages"></div>
									<!-- /tab-pane-->
									<!-- tab-pane-->
									<div class="tab-pane" id="settings"></div>
									<!-- /tab-pane-->
								</div>
								<!--/tab-content-->
							</div>
							<!--/row-->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Modal View and Edit  -->

		<!-- Modal New -->
		<div class="modal fade" id="create-contact-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabelSmall" aria-hidden="true">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modalLabelSmall">Nuevo Contacto</h4>
					</div>
					<div class="modal-body">
						<div class="container bootstrap snippet">
							<div class="row">
								<ul class="nav nav-tabs">
									<li class="active"><a data-toggle="tab" href="#home">Contacto</a></li>
									<!-- //
										<li><a data-toggle="tab" href="#messages">Menu 1</a></li>
										<li><a data-toggle="tab" href="#settings">Menu 2</a></li>
									-->
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="home">
										<form class="form" action="javascript:false;" v-on:submit="createContactModalAndInclude" method="post" id="registrationForm">
											<div class="form-group">
												<div class="col-xs-12">
													<label for="first_name"><h4>Relacion / Parentesco</h4></label>
													<select class="form-control" v-model="news.contact.type" name="contact_identification_identification_type" id="contact_identification_type" required="true">
														<option value="0">Seleccione una opcion</option>
														<option v-for="(item, index_item) in options.contacts_types" :key="item.id" :value="item.id">{{ item.name }}</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4>Tipo Documento (*)</h4></label>
													<select class="form-control" v-model="contactModalCreate.identification_type" name="contact_identification_identification_type" id="contact_identification_type" required="true">
														<option value="">Seleccione una opcion</option>
														<option v-for="(item, index_item) in options.identifications_types" :key="item.id" :value="item.id">{{ item.name }}</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4># Documento (*)</h4></label>
													<input type="text" required="" class="form-control" name="contact_identification_number" id="contact_identification_number" placeholder="Numero documento de identidad" title="Ingrese el numero de documento de identificación." v-model="contactModalCreate.identification_number">
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4>Nombres (*)</h4></label>
													<input type="text" required="" class="form-control" name="contact_names" id="contact_names" placeholder="Nombres" title="Ingrese el/los nombre(s) completo." v-model="contactModalCreate.names">
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4>Apellidos (*)</h4></label>
													<input type="text" required="" class="form-control" name="contact_surname" id="contact_surname" placeholder="Apellidos" title="Ingrese el/los apellidos." v-model="contactModalCreate.surname">
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4>Correo Electronico (*)</h4></label>
													<input type="email" required="" class="form-control" name="contact_email" id="contact_email" placeholder="" title="Ingrese el correo electronico." v-model="contactModalCreate.email">
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4>Telefono Fijo</h4></label>
													<input type="text" class="form-control" name="contact_" id="contact_" placeholder="" title="Ingrese el teléfono fijo." v-model="contactModalCreate.phone">
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4>Telefono Móvil</h4></label>
													<input type="text" class="form-control" name="contact_mobile" id="contact_mobile" placeholder="Telefono Celular / Movil" title="Ingrese el teléfono móvil." v-model="contactModalCreate.mobile">
												</div>
											</div>

											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4>Fecha de cumpleaños</h4></label>
													<input type="date" class="form-control" name="contact_birthday" id="contact_birthday" placeholder="" title="Cumpleaños." v-model="contactModalCreate.birthday">
													Formato: AÑO-MES-DÍA
												</div>
											</div>


											<div class="form-group">
												<div class="col-xs-6">
													<label for="mobile"><h4>Departamento</h4></label>

													<select class="form-control" v-model="contactModalCreate.department" @change="loadCitysModal(contactModalCreate.department)">
														<option value="">Seleccione una opcion</option>
														<option v-for="(item, index_item) in options.geo_departments" :key="item.id" :value="item.id">{{ item.name }}</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="email"><h4>Ciudad</h4></label>
													<select class="form-control" v-model="contactModalCreate.city" >
														<option value="">Seleccione una opcion</option>
														<option v-for="(item, index_item) in options.geo_citysModal" :key="item.id" :value="item.id">{{ item.name }}</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-12">
													<label for="email"><h4>Dirección</h4></label>
													<textarea type="text" class="form-control">{{ contactModalCreate.address }}</textarea>
												</div>
											</div>

											<div class="form-group">
												<div class="col-xs-12">
													<br>
													<button class="btn btn-sm btn-success" type="submit">
														<i class="glyphicon glyphicon-floppy-disk"></i>
														Guardar
													</button>
													<!-- <button class="btn btn-sm" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button> -->
													<button class="btn btn-sm pull-right" type="button"  class="close" data-dismiss="modal" aria-label="Close">
														<i class="glyphicon glyphicon-remove"></i>
														Cerrar
													</button>
												</div>
											</div>
										</form>
										<hr>
									</div>
									<!-- tab-pane-->
									<div class="tab-pane" id="messages"></div>
									<!-- /tab-pane-->
									<!-- tab-pane-->
									<div class="tab-pane" id="settings"></div>
									<!-- /tab-pane-->
								</div>
								<!--/tab-content-->
							</div>
							<!--/row-->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Modal New -->

		<!-- Modal Search -->
		<div class="modal fade" id="search-contact-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabelSmall" aria-hidden="true">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modalLabelSmall">buscar Contacto</h4>
					</div>
					<div class="modal-body">
						<div class="container bootstrap snippet">
							<div class="row">
								<ul class="nav nav-tabs">
									<li class="active"><a data-toggle="tab" href="#home">Contacto</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="home">
										<form class="form" action="javascript:false;" v-on:submit="searchContactModal" method="post" id="registrationForm">
											<div class="form-group">
												<div class="col-xs-5">
													<label for="first_name"><h4>Tipo Documento (*)</h4></label>
													<select class="form-control" v-model="contactModalSearch.identification_type" name="contact_identification_identification_type" id="contact_identification_type" required="true">
														<option value="">Seleccione una opcion</option>
														<option v-for="(item, index_item) in options.identifications_types" :key="item.id" :value="item.id">{{ item.name }}</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-5">
													<label for="first_name"><h4># Documento (*)</h4></label>
													<input type="text" required="" class="form-control" name="contact_identification_number" id="contact_identification_number" placeholder="Numero documento de identidad" title="Ingrese el numero de documento de identificación." v-model="contactModalSearch.identification_number">
												</div>
											</div>

											<div class="form-group">
												<div class="col-xs-12">
													<br />
													<button class="btn btn-sm btn-info pull-right" type="submit">
														<i class="glyphicon glyphicon-search"></i>
														Buscar
													</button>
												</div>
											</div>
											
											<template v-if="contactModalSearch.id !== null && contactModalSearch.id !== undefined && contactModalSearch.id > 0">
												<div class="form-group">
													<div class="col-xs-12">
														<label for="first_name"><h4>Relacion / Parentesco</h4></label>
														<select class="form-control" v-model="search.contact.type" name="contact_identification_identification_type" id="contact_identification_type" required="true">
															<option value="0">Seleccione una opcion</option>
															<option v-for="(item, index_item) in options.contacts_types" :key="item.id" :value="item.id">{{ item.name }}</option>
														</select>
													</div>
												</div>
												
												<div class="form-group">
													<div class="col-xs-12">
														<br />
														<button @click="includeContactModalSearch" class="btn btn-sm btn-success pull-right" type="button">
															<i class="glyphicon glyphicon-ok"></i>
															Añadir
														</button>
													</div>
												</div>
											</template>
										</form>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4>Nombres (*)</h4></label>
													<input readonly="" type="text" required="" class="form-control" name="contact_names" id="contact_names" placeholder="Nombres" title="Ingrese el/los nombre(s) completo." v-model="contactModalSearch.names">
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4>Apellidos (*)</h4></label>
													<input readonly="" type="text" required="" class="form-control" name="contact_surname" id="contact_surname" placeholder="Apellidos" title="Ingrese el/los apellidos." v-model="contactModalSearch.surname">
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4>Correo Electronico (*)</h4></label>
													<input readonly="" type="email" required="" class="form-control" name="contact_email" id="contact_email" placeholder="" title="Ingrese el correo electronico." v-model="contactModalSearch.email">
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4>Telefono Fijo</h4></label>
													<input readonly="" type="text" class="form-control" name="contact_" id="contact_" placeholder="" title="Ingrese el teléfono fijo." v-model="contactModalSearch.phone">
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4>Telefono Móvil</h4></label>
													<input readonly="" type="text" class="form-control" name="contact_mobile" id="contact_mobile" placeholder="Telefono Celular / Movil" title="Ingrese el teléfono móvil." v-model="contactModalSearch.mobile">
												</div>
											</div>

											<div class="form-group">
												<div class="col-xs-6">
													<label for="first_name"><h4>Fecha de cumpleaños</h4></label>
													<input readonly="" type="text" class="form-control" name="contact_birthday" id="contact_birthday" placeholder="" title="Cumpleaños." v-model="contactModalSearch.birthday">
													Formato: AÑO-MES-DÍA
												</div>
											</div>


											<div class="form-group">
												<div class="col-xs-12">
													<br>
													<!-- <button class="btn btn-sm" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button> -->
													<button class="btn btn-sm pull-right" type="button"  class="close" data-dismiss="modal" aria-label="Close">
														<i class="glyphicon glyphicon-remove"></i>
														Cerrar
													</button>
												</div>
											</div>
										<hr>
									</div>
									<!-- tab-pane-->
									<div class="tab-pane" id="messages"></div>
									<!-- /tab-pane-->
									<!-- tab-pane-->
									<div class="tab-pane" id="settings"></div>
									<!-- /tab-pane-->
								</div>
								<!--/tab-content-->
							</div>
							<!--/row-->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Modal Search -->

		<!-- Modal Addresses -->
		<div class="modal fade" id="addresses-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabelSmall" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modalLabelSmall">Normalizar Direcciones</h4>
					</div>
					<div class="modal-body">
						<form class="form" action="javascript:false;" v-on:submit="NormalizeAddressesModal" method="post">

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<select @change="loadCitys" v-model="addressNormalize.department" type="text" id="inputSuccess2" required="required" class="form-control has-feedback-left">
									<option value="">Elija un departamento...</option>
									<option v-for="(item, index_item) in options.geo_departments" :key="item.id" :value="item.id">{{ item.name }}</option>
								</select>
								<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<select v-model="addressNormalize.city" type="text" id="inputSuccess2" required="required" class="form-control has-feedback-left">
									<option value="">Elija una ciudad...</option>
									<option v-for="(item, index_item) in options.geo_citys" :key="item.id" :value="item.id">{{ item.name }}</option>
								</select>
								<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
							</div>

							<div class="col-xs-4">
								<h5>Via principal. (*)</h5>
								<div class="form-group">
									<select v-model="addressNormalize.via_principal" required="required" class="form-control">
										<option value="">Elija una opción...</option>
										<option v-for="(item, index_item) in options.geo_types_vias" :key="item.id" :value="item.id">{{ item.name }} - {{ item.code }}</option>
									</select>
								</div>
							</div>
							<div class="col-xs-2">
								<h5>Num. (*)</h5>
								<div class="form-group">
									<input v-model="addressNormalize.via_principal_number" type="text" required="" class="form-control" />
								</div>
							</div>
							<div class="col-xs-2">
								<h5>Letra</h5>
								<div class="form-group">
									<input v-model="addressNormalize.via_principal_letter" type="text" class="form-control" />
								</div>
							</div>
							<div class="col-xs-2">
								<h5>Cuadrante</h5>
								<div class="form-group">
									<select v-model="addressNormalize.via_principal_quadrant" class="form-control">
										<option value="">Elija una opción...</option>
										<option v-for="(item, index_item) in options.geo_types_quadrants" :key="item.id" :value="item.code">{{ item.name }}</option>
									</select>
								</div>
							</div>
							<div class="col-xs-2">
								<h5>Num. (*)</h5>
								<div class="form-group">
									<input v-model="addressNormalize.via_secondary_number" type="text" required="" class="form-control" />
								</div>
							</div>

							<div class="col-xs-2">
								<h5>Letra.</h5>
								<div class="form-group">
									<input v-model="addressNormalize.via_secondary_letter" type="text" class="form-control" />
								</div>
							</div>
							<div class="col-xs-2">
								<h5>Cuadrante</h5>
								<div class="form-group">
									<select v-model="addressNormalize.via_secondary_quadrant" class="form-control">
										<option value="">Elija una opción...</option>
										<option v-for="(item, index_item) in options.geo_types_quadrants" :key="item.id" :value="item.code">{{ item.name }}</option>
									</select>
								</div>
							</div>
							<div class="col-xs-2">
								<h5>Num. (*)</h5>
								<div class="form-group">
									<input v-model="addressNormalize.via_end_number" type="text" required="" class="form-control" />
								</div>
							</div>

							<div class="col-xs-12">
								<h5>Complemento</h5>
								<div class="form-group">
									<input v-model="addressNormalize.via_end_extra" type="text" class="form-control" />
								</div>
							</div>
							<div class="col-xs-12">
								<h5>Simple</h5>
								<div class="form-group">
									<input v-model="repairAddressMin" type="text" readonly="" class="form-control" />
								</div>
							</div>
							<div class="col-xs-12">
								<h5>Completo</h5>
								<div class="form-group">
									<input v-model="repairAddressFull" type="text" readonly="" class="form-control" />
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group">
									<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
										<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Cancelar</button>
										<button class="btn btn-primary" type="reset">Limpiar Formulario</button>
										<button v-if="addressNormalizeError === false" type="submit" class="btn btn-success">Guardar Direccion</button>
									</div>
								</div>
							</div>
							<div class="col-xs-12">
								{{ addressNormalize }}
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /Modal Addresses -->

		<!-- Modal headquarters -->
		<div class="modal fade" id="headquarters-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabelSmall" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modalLabelSmall">Normalizar Direcciones</h4>
					</div>
					<div class="modal-body">
						<form class="form" action="javascript:false;" v-on:submit="NormalizeheadquartersModal" method="post">

							<div class="col-xs-12">
								<h5>Nombre o alias de la Sede. (*)</h5>
								<div class="form-group">
									<input v-model="headquarterName" type="text" required="" class="form-control" />
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<select @change="loadCitysHeadquarters" v-model="headquartersNormalize.department" type="text" id="inputSuccess2" required="required" class="form-control has-feedback-left">
									<option value="">Elija un departamento...</option>
									<option v-for="(item, index_item) in options.geo_departments" :key="item.id" :value="item.id">{{ item.name }}</option>
								</select>
								<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<select v-model="headquartersNormalize.city" type="text" id="inputSuccess2" required="required" class="form-control has-feedback-left">
									<option value="">Elija una ciudad...</option>
									<option v-for="(item, index_item) in options.geo_citys" :key="item.id" :value="item.id">{{ item.name }}</option>
								</select>
								<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
							</div>

							<div class="col-xs-4">
								<h5>Via principal. (*)</h5>
								<div class="form-group">
									<select v-model="headquartersNormalize.via_principal" required="required" class="form-control">
										<option value="">Elija una opción...</option>
										<option v-for="(item, index_item) in options.geo_types_vias" :key="item.id" :value="item.id">{{ item.name }} - {{ item.code }}</option>
									</select>
								</div>
							</div>
							<div class="col-xs-2">
								<h5>Num. (*)</h5>
								<div class="form-group">
									<input v-model="headquartersNormalize.via_principal_number" type="text" required="" class="form-control" />
								</div>
							</div>
							<div class="col-xs-2">
								<h5>Letra</h5>
								<div class="form-group">
									<input v-model="headquartersNormalize.via_principal_letter" type="text" class="form-control" />
								</div>
							</div>
							<div class="col-xs-2">
								<h5>Cuadrante</h5>
								<div class="form-group">
									<select v-model="headquartersNormalize.via_principal_quadrant" class="form-control">
										<option value="">Elija una opción...</option>
										<option v-for="(item, index_item) in options.geo_types_quadrants" :key="item.id" :value="item.code">{{ item.name }}</option>
									</select>
								</div>
							</div>
							<div class="col-xs-2">
								<h5>Num. (*)</h5>
								<div class="form-group">
									<input v-model="headquartersNormalize.via_secondary_number" type="text" required="" class="form-control" />
								</div>
							</div>

							<div class="col-xs-2">
								<h5>Letra.</h5>
								<div class="form-group">
									<input v-model="headquartersNormalize.via_secondary_letter" type="text" class="form-control" />
								</div>
							</div>
							<div class="col-xs-2">
								<h5>Cuadrante</h5>
								<div class="form-group">
									<select v-model="headquartersNormalize.via_secondary_quadrant" class="form-control">
										<option value="">Elija una opción...</option>
										<option v-for="(item, index_item) in options.geo_types_quadrants" :key="item.id" :value="item.code">{{ item.name }}</option>
									</select>
								</div>
							</div>
							<div class="col-xs-2">
								<h5>Num. (*)</h5>
								<div class="form-group">
									<input v-model="headquartersNormalize.via_end_number" type="text" required="" class="form-control" />
								</div>
							</div>

							<div class="col-xs-12">
								<h5>Complemento</h5>
								<div class="form-group">
									<input v-model="headquartersNormalize.via_end_extra" type="text" class="form-control" />
								</div>
							</div>
							<div class="col-xs-12">
								<h5>Simple</h5>
								<div class="form-group">
									<input v-model="repairheadquartersMin" type="text" readonly="" class="form-control" />
								</div>
							</div>
							<div class="col-xs-12">
								<h5>Completo</h5>
								<div class="form-group">
									<input v-model="repairheadquartersFull" type="text" readonly="" class="form-control" />
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group">
									<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
										<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Cancelar</button>
										<button class="btn btn-primary" type="reset">Limpiar Formulario</button>
										<button v-if="headquartersNormalizeError === false" type="submit" class="btn btn-success">Guardar Direccion</button>
									</div>
								</div>
							</div>
							<div class="col-xs-12">
								{{ headquartersNormalize }}
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /Modal headquarters -->
		
		<!-- Modal Microroutes -->
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
		<!-- /Modal Microroutes -->
		
	</div>
</template>

<template id="create">
	<div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Crear <small>Cuenta</small></h2>
						<ul class="nav navbar-right panel_toolbox">
							<li>
								<router-link  v-bind:to="{ name: 'List' }">
									<i class="fa fa-close"></i>
								</router-link>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form v-on:submit="searchAccount" action="javascript:return false;" >
							<div class="row">
								<div class="col-sm-6 form-group has-feedback">
									<div class="col-xs-12">
										<label class="control-label" for="form-create-identification_number">Tipo de Cliente</label>
										<select v-model="form.identification_type" type="text" id="form-create-identification_type" required="required" class="form-control has-feedback-left">
											<option value="0">-- Tipo de Cliente --</option>
											<option v-for="(item, index_item) in options.identifications_types" :key="item.id" :value="item.id">{{ item.code }} - {{ item.name }}</option>
										</select>
										<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
									</div>
								</div>
								<div class="col-sm-6 form-group has-feedback">
									<div class="col-xs-12">
										<label class="control-label" for="form-create-identification_number"># Documento</label>
										<div class="has-feedback-left">
											<div class="input-group col-xs-11">
												<input type="text" v-model="form.identification_number" id="form-create-identification_number" name="form-create-identification_number" required="required" class="form-control" />
												<span class="input-group-btn">
													<button type="submit" class="btn btn-primary">
														<i class="fa fa-search"></i>
													</button>
												</span>
											</div>
										</div>
										<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>

				<template v-if="form_enabled == true">
					<form v-on:submit="createAccount" class="form-horizontal- form-label-left input_mask" action="javascript:return false;">
						<div class="x_panel">
							<div class="x_title">
								<h2>Información Básica</h2>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div class="col-md-6 col-sm-6 col-xs-6 form-group">
									<select v-model="form.type" id="form-create-type" required="required" class="form-control">
										<option value="0">-- Tipo de Cliente --</option>
										<option v-for="(item, index_item) in options.accounts_types" :key="item.id" :value="item.id">{{ item.name }}</option>
									</select>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6 form-group has-feedback">
									<select v-model="form.economic_activity" id="form-create-economic_activity" required="required" class="form-control">
										<option value="0">-- Actividad Economica --</option>
										<option v-for="(item, index_item) in options.economic_activities" :key="item.id" :value="item.id">{{ item.name }}</option>
									</select>
								</div>

								<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<input type="text" v-model="form.names" class="form-control has-feedback-left" id="inputSuccess2" required="required" :placeholder="(form.type == 1) ? 'Nombre(s)' : 'Razon social' + '(*)'" />
									<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
								</div>

								<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<input type="text" v-model="form.surname" class="form-control" id="inputSuccess3" required="required" :placeholder="(form.type == 1) ? 'Apellido(s)' : 'Nombre comercial' + '(*)'" />
									<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
								</div>

								<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
									<input type="email" v-model="form.email" class="form-control has-feedback-left" required="required" placeholder="Email / Correo electronico (*)">
									<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
								</div>

								<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
									<input type="text" v-model="form.phone" class="form-control" id="inputSuccess5" required="required" placeholder="T. Fijo">
									<span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
								</div>

								<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
									<input type="text" v-model="form.mobile" class="form-control" id="inputSuccess6" required="required" placeholder="T. Móvil">
									<span class="fa fa-mobile form-control-feedback right" aria-hidden="true"></span>
								</div>
							</div>
						</div>

						<div class="x_panel" class="x_panel" v-if="form.type == 1">
							<div class="x_title">
								<h2>Información Campañas Marketing</h2>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<input type="date" v-model="form.birthday" class="form-control has-feedback-left" placeholder="EFecha de nacimiento (*)">
									<span class="fa fa-birthday-cake form-control-feedback left" aria-hidden="true"></span>
								</div>

								<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="form-create-gender">Genero (*)</label>
									<div class="col-xs-9">
										<select v-model="form.gender" type="text" class="form-control col-md-7 col-xs-12">
											<option></option>
											<option value="male">Masculino</option>
											<option value="female">Femenino</option>
										</select>
									</div>
								</div>
							</div>
						</div>


						<div class="x_panel" class="x_panel">
							<div class="x_title">
								<h2>Dirección Principal</h2>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<label class="control-label col-xs-12">Dirección</label>
									<div class="col-sm-12">
										<div class="input-group">
											<input readonly="" v-model="addressNormalize.complete" type="text" class="form-control" required="required" class="form-control">
											<span class="input-group-btn">
												<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addresses-modal">
													<i class="fa fa-search"></i>
												</button>

											</span>
										</div>
									</div>

									<!-- //
									<div class="col-xs-12">
										<textarea v-model="form.address" type="text" id="form-create-type" required="required" class="form-control">{{ form.address }}</textarea>
									</div>
									-->
								</div>
							</div>
						</div>

						<div>
							<div class="x_content">

							</div>
						</div>
						<div>
							<div class="x_content">
								<div class="form-group">
									<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
										<button type="button" class="btn btn-primary">Cancelar</button>
										<button class="btn btn-primary" type="reset">Limpiar Formulario</button>
										<button type="submit" class="btn btn-success">Crear</button>
									</div>
								</div>
							</div>
						</div>
						<div>
							<div class="x_content">
								{{ form }}
							</div>
						</div>
					</form>
				</template>

			</div>
		</div>

		<!-- Modal Addresses -->
		<div class="modal fade" id="addresses-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabelSmall" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modalLabelSmall">Normalizar Direcciones</h4>
					</div>
					<div class="modal-body">
						<form class="form" action="javascript:false;" v-on:submit="NormalizeAddressesModal" method="post">

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<select @change="loadCitys" v-model="addressNormalize.department" type="text" id="inputSuccess2" required="required" class="form-control has-feedback-left">
									<option value="">Elija un departamento...</option>
									<option v-for="(item, index_item) in options.geo_departments" :key="item.id" :value="item.id">{{ item.name }}</option>
								</select>
								<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<select v-model="addressNormalize.city" type="text" id="inputSuccess2" required="required" class="form-control has-feedback-left">
									<option value="">Elija una ciudad...</option>
									<option v-for="(item, index_item) in options.geo_citys" :key="item.id" :value="item.id">{{ item.name }}</option>
								</select>
								<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
							</div>

							<div class="col-xs-4">
								<h5>Via principal. (*)</h5>
								<div class="form-group">
									<select v-model="addressNormalize.via_principal" required="required" class="form-control">
										<option value="">Elija una opción...</option>
										<option v-for="(item, index_item) in options.geo_types_vias" :key="item.id" :value="item.id">{{ item.name }} - {{ item.code }}</option>
									</select>
								</div>
							</div>
							<div class="col-xs-2">
								<h5>Num. (*)</h5>
								<div class="form-group">
									<input v-model="addressNormalize.via_principal_number" type="text" required="" class="form-control" />
								</div>
							</div>
							<div class="col-xs-2">
								<h5>Letra</h5>
								<div class="form-group">
									<input v-model="addressNormalize.via_principal_letter" type="text" class="form-control" />
								</div>
							</div>
							<div class="col-xs-2">
								<h5>Cuadrante</h5>
								<div class="form-group">
									<select v-model="addressNormalize.via_principal_quadrant" class="form-control">
										<option value="">Elija una opción...</option>
										<option v-for="(item, index_item) in options.geo_types_quadrants" :key="item.id" :value="item.code">{{ item.name }}</option>
									</select>
								</div>
							</div>
							<div class="col-xs-2">
								<h5>Num. (*)</h5>
								<div class="form-group">
									<input v-model="addressNormalize.via_secondary_number" type="text" required="" class="form-control" />
								</div>
							</div>

							<div class="col-xs-2">
								<h5>Letra.</h5>
								<div class="form-group">
									<input v-model="addressNormalize.via_secondary_letter" type="text" class="form-control" />
								</div>
							</div>
							<div class="col-xs-2">
								<h5>Cuadrante</h5>
								<div class="form-group">
									<select v-model="addressNormalize.via_secondary_quadrant" class="form-control">
										<option value="">Elija una opción...</option>
										<option v-for="(item, index_item) in options.geo_types_quadrants" :key="item.id" :value="item.code">{{ item.name }}</option>
									</select>
								</div>
							</div>
							<div class="col-xs-2">
								<h5>Num. (*)</h5>
								<div class="form-group">
									<input v-model="addressNormalize.via_end_number" type="text" required="" class="form-control" />
								</div>
							</div>

							<div class="col-xs-12">
								<h5>Complemento</h5>
								<div class="form-group">
									<input v-model="addressNormalize.via_end_extra" type="text" class="form-control" />
								</div>
							</div>
							<div class="col-xs-12">
								<h5>Simple</h5>
								<div class="form-group">
									<input v-model="repairAddressMin" type="text" readonly="" class="form-control" />
								</div>
							</div>
							<div class="col-xs-12">
								<h5>Completo</h5>
								<div class="form-group">
									<input v-model="repairAddressFull" type="text" readonly="" class="form-control" />
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group">
									<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
										<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Cancelar</button>
										<button class="btn btn-primary" type="reset">Limpiar Formulario</button>
										<button v-if="addressNormalizeError === false" type="submit" class="btn btn-success">Guardar Direccion</button>
									</div>
								</div>
							</div>
							<div class="col-xs-12">
								{{ addressNormalize }}
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /Modal Addresses -->
	</div>
</template>

<template id="create-requests">
	<div>
		<form v-on:submit="newRequest" action="javascript:return false;" >
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Crear <small>Solicitud</small></h2>
							<ul class="nav navbar-right panel_toolbox">
								<li>
									<router-link  v-bind:to="{ name: 'View', params: { account_id: $route.params.account_id } }">
										<span class="fa fa-close" aria-hidden="true"></span>
									</router-link>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div class="row">
								<div class="col-sm-12">

									<div class="col-xs-12 form-group has-feedback">
										<label class="control-label" for="form-create-identification_number">Solicitud del cliente</label>
										<textarea rows="5" v-model="form.description" id="form-create-identification_number" name="form-create-identification_number" required="required" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-sm-4 col-xs-4">
					<div class="x_panel">
						<div class="x_title">
							<h2>Contacto(s) <small>(*)</small></h2>
							<!-- //
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
							-->
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div class="">
								<template v-if="options.contacts.length > 0">
									<div class="col-md-12 col-sm-12 col-xs-12 profile_details" v-for="(contact, contact_index) in options.contacts">
										<div class="well profile_view">
											<template v-if="contact.id !== undefined && contact.id > 0">
												<div class="col-sm-12">
													<h4 class="brief">
														<i>{{ contact.identification_type.code }} {{ contact.identification_number }}</i>
													</h4>
													<div class="left col-xs-12">
														<h2>{{ contact.names }} {{ contact.surname }} </h2>
														<p><strong>Email: </strong> {{ contact.email }}</p>
														<ul class="list-unstyled">
															<li><i class="fa fa-building"></i> Direccion: {{ contact.address }}</li>
															<li><i class="fa fa-phone"></i> Tel. Fijo #: {{ contact.phone }} - {{ contact.mobile }}</li>
															<li><i class="fa fa-phone"></i> Tel. Móvil: {{ contact.mobile }}</li>
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
													<div class="col-xs-12 col-sm-6 emphasis pull-right">
														<!-- // 
														<button type="button" class="btn btn-success btn-xs"> <i class="fa fa-user">
														</i> <i class="fa fa-plus"></i> </button>
														-->
														<input name="contacts[]" v-model="form.contacts" :value="contact" type="checkbox" class="" style="border: 0px solid #00000000;">
														
														<template v-if="form.contacts.indexOf(contact) >= 0">
															<template v-if="form.contact === contact.id">
																<a><span class="fa fa-star"></span></a>
															</template>
															<template v-else>
																<!-- // <a><span class="fa fa-star-o"></span></a> -->
																<input name="contact" v-model="form.contact" :value="contact.id" type="radio" class="fa fa-star-o" style="opacity: 0.5;">
															</template>
														</template>
															
														
														
														
														<!-- // 
														<button type="button" class="btn btn-primary btn-xs">
														<i class="fa fa-user"> </i> View Profile
														</button>
														-->
													</div>
												</div>
											</template>
										</div>
									</div>
								</template>
							</div>
						</div>
					</div>
					<div class="x_panel">
						<div class="x_title">
							<h2>Direccion(es) <small>(*)</small></h2>
							<!-- //
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
							-->
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div class="">
								<template v-if="options.addresses.length > 0">
									<ul class="to_do">
										<li v-for="(address, address_index) in options.addresses">
											<template v-if="address.id !== undefined && address.id > 0">
												<p>
													<div class="icheckbox_flat-green" style="position: relative;">
														<input name="addresses[]" v-model="form.addresses" :value="address" type="checkbox" class="" style="border: 0px solid #00000000;">
													</div> 
													{{ address.minsize }}
												</p>
											</template>
										</li>
									</ul>
								</template>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-8 col-sm-8 col-xs-8">
					<div class="x_panel">
						<div class="x_title">
							<h2><i class="fa fa-bars"></i> Servicios <small></small></h2>
							<!-- //
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
							-->
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div class="" role="tabpanel" data-example-id="togglable-tabs">
								<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
								<!-- // <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Home</a></li>-->
									<li v-for="(category, category_index) in options.services" role="presentation" class="">
										<a :href="'#tab_services' + category.id" role="tab" :id="'categories-services' + category.id" data-toggle="tab" aria-expanded="false">
											{{ category.name }} ({{ category.services.length }})
										</a>
									</li>
								</ul>
								<div id="myTabContent" class="tab-content">
									<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
										<p></p>
									</div>
									<div v-for="(category, category_index) in options.services" role="tabpanel" class="tab-pane fade" :id="'tab_services' + category.id" :aria-labelledby="'categories-services' + category.id">
										<template v-if="category.description !== null && category.description !== undefined">
											<p>{{ category.description }}</p>
										</template>
										<template v-else>
											<p>Esta categoria no tiene descripcion.</p>
										</template>										
										<template v-if="category.services.length > 0">
											<ul class="to_do">
												<li v-for="(service, service_index) in category.services">
													<template v-if="service.id !== undefined && service.id > 0">
														<p>
															<div class="icheckbox_flat-green" style="position: relative;">
																<input name="services[]" v-model="form.services" :value="service" type="checkbox" class="" style="border: 0px solid #00000000;">
															</div> 
															{{ service.name }} (<b>{{ service.medition.name }}</b>)
														</p>
													</template>
												</li>
											</ul>
										</template>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="x_panel">
							<div class="x_title">
								<h2>Solicitud <small>Vista Previa</small></h2>
								<!-- //
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
								-->
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<section class="content invoice">
									<div class="row">
										<div class="col-xs-12 invoice-header">
											<h1>
												<i class="fa fa-globe"></i> 
												Solicitud.
												<small class="pull-right">Fecha : 16/08/2016</small>
											</h1>
										</div>
									</div>
									
									<div class="row invoice-info">
										<div class="col-sm-4 invoice-col">
											Creada por:
											<address>
												<!-- // <strong><?= BUSSINES_NAME_LG; ?></strong> -->
												<strong><?= BUSSINES_NAME_MD; ?></strong>
												<br><?= BUSSINES_ADDRESS; ?>
												<br><?= BUSSINES_PHONE; ?> - <?= BUSSINES_MOBILE; ?>
												<br><?= BUSSINES_EMAIL; ?>
												<br>
												<br><strong><?= "{$this->user->names} {$this->user->surname}"; ?></strong>
												<br>Tel: <?= $this->user->phone; ?>
												<br>Móvil: <?= $this->user->mobile; ?>
												<br>Email: <?= $this->user->email; ?>
											</address>
										</div>
										<div class="col-sm-4 invoice-col">
											Para: 
											<address>
												<strong>{{ options.account.names }} {{ options.account.surname }}</strong>
												<br>{{ options.account.address.minsize }}
												<br>Tel. Fijo: {{ options.account.phone }}
												<br>Tel. Móvil: {{ options.account.mobile }}
												<br>Email: {{ options.account.email }}
											</address>
										</div>
										<div class="col-sm-4 invoice-col">
											<b>Solicitud # 00000000-000000</b>
											<br>
											<!-- // <br> <b>Order ID:</b> 4F3S8J -->
											<!-- // <br> <b>Payment Due:</b> 2/22/2014 -->
											<br>
											<b>Cliente:</b> {{ options.account.id }}
										</div>
									</div>
									
									<div class="row">
										<div class="col-xs-12">
											<p class="lead">Transcripcion:</p>
											<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
												<template v-if="form.description !== null && form.description.length > 2">
													{{ form.description }}
												</template>
												<template v-else>
													No se ha escrito nada en la solicitud
												</template>
											</p>
										</div>
									
										<div class="col-xs-12 table">
											<table class="table table-striped">
												<thead>
													<tr>
														<!-- // <th style="width: 15%">Qty</th> -->
														<th>Servicio</th>
														<th>Codigo</th>
														<th style="width: 37%">Descripción</th>
														<th>T. Medición</th>
													</tr>
												</thead>
												<tbody>
													<template v-if="form.services.length > 0">
														<tr v-for="(service, service_index) in form.services">
															<!-- //
															<td>
																<input width="" class="form-control" value="1.00" v-model="service.qty" type="number" step="0.01" />
															</td>
															-->
															<td>{{ service.name }}</td>
															<td>{{ service.category }}-{{ service.medition.id }}-{{ service.id }}</td>
															<td>{{ service.description }}</td>
															<td :title="service.medition.name">{{ service.medition.code }}</td>
														</tr>
													</template>
													<template v-else>
														<tr>
															<td colspan="6">
																No se han seleccionado servicios.
															</td>
														</tr>
													</template>
												</tbody>
											</table>
										</div>
									</div>
									
									<div class="row">
										<div class="col-xs-7">
											<p class="lead">Persona(s) de Contacto(s):</p>
											<template v-if="form.contact == 0 || form.contact == null || form.contact == undefined">
												<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">No se a selecciona contacto principal.</p>
											</template>
											<template v-if="form.contacts.length > 0">
												<table class="table table-striped">
													<thead>
														<tr>
															<th></th>
															<th>Contacto</th>
															<th>Tel. Fijo</th>
															<th>Tel. Móvil</th>
														</tr>
													</thead>
													
													<tr v-for="(contact, contact_index) in form.contacts">
														<td>
															<i v-if="form.contact === contact.id" class="fa fa-star"></i>
														</td>
														<td>{{ contact.names }} {{ contact.surname }}</td>
														<td>{{ contact.phone }}</td>
														<td>{{ contact.mobile }}</td>
													</tr>
												</table>
											</template>
											<template v-else>
													<tr>
														<td colspan="6">
															<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">No se han seleccionado contactos.</p>
														</td>
													</tr>
												</table>
											</template>
										</div>
										<div class="col-xs-5">
											<p class="lead">Direccion(es)</p>
											<div class="table-responsive">
												<table class="table">
													<tbody>
														<template v-if="form.addresses.length > 0">
															<tr v-for="(address, address_index) in form.addresses">
																<!-- // <th style="width:20%">Codigo: {{ address.id }}</th> -->
																<td>{{ address.minsize }}</td>
															</tr>
														</template>
														<template v-else>
															<tr>
																<td colspan="2">
																	No se han seleccionado direcciones.
																</td>
															</tr>
														</template>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									
									<div class="row no-print">
										<!-- //
										<div class="col-xs-12">
											<button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
											<button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
											<button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
										</div>
										-->
									</div>
								</section>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="pull-right">
						<button type="button" class="btn btn-primary" @click="createRequest">
							<i class="fa fa-search"></i>
							Crear Solicitud
						</button>
					</div>
				</div>
				<div class="col-md-7 col-sm-7 col-xs-7">
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-nav" href="#tab4" data-toggle="tab">
							<div class="visible">
								<router-link  v-bind:to="{ name: 'Search' }">
									<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
									Regresar
								</router-link>
							</div>
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</template>

<template id="view-request">
	<div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-xs-3">
					<div class="x_panel">
						<div class="x_title">
							<h2>Estado<small>Actual</small></h2>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div class="col-xs-4">
								<div class="circle-color" :style="'background-color: #' + record.status.color"></div>
							</div>
							<div class="col-xs-8">
								{{ record.status.name }}
							</div>
						</div>
					</div>
					
					<div class="x_panel" >
						<div class="x_title">
							<h2>Calendario<small>Agenda</small></h2>
							<ul class="nav navbar-right panel_toolbox">
								<template v-if="record.status.calendar_enabled == 1">
									<li>
										<a class="fa fa-plus" data-toggle="modal" data-target=".bs-study-modal-lg">
											<span class="" aria-hidden="true"></span>
										</a>
									</li>
								</template>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div id='my-calendar-home'></div>
						</div>
					</div>
					
				</div>
				<div class="col-xs-9">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="x_panel">
							<div class="x_title">
								<h2>Visor de Solicitudes<small>Gestión</small></h2>
								<ul class="nav navbar-right panel_toolbox">
									<li>
										<router-link  v-bind:to="{ name: 'View', params: { account_id: $route.params.account_id } }">
											<span class="fa fa-close" aria-hidden="true"></span>
										</router-link>
									</li>
								</ul>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<section class="content invoice">
									<div class="row">
										<div class="col-xs-12 invoice-header">
											<h1>
												<i class="fa fa-globe"></i> 
												Solicitud
												<small class="pull-right">Fecha: {{ record.created }}</small>
											</h1>
										</div>
									</div>
									
									<div class="row invoice-info">
										<div class="col-sm-4 invoice-col">
											Creada por:
											<address>
												<strong><?= BUSSINES_NAME_MD; ?></strong>
												<br><?= BUSSINES_ADDRESS; ?>
												<br><?= BUSSINES_PHONE; ?> - <?= BUSSINES_MOBILE; ?>
												<br><?= BUSSINES_EMAIL; ?>
												<br>
												<br><strong>{{ record.create_by.names }} {{ record.create_by.surname }}</strong>
												<br>Tel: {{ record.create_by.phone }}
												<br>Móvil: {{ record.create_by.mobile }}
												<br>Email: {{ record.create_by.email }}
											</address>
										</div>
										
										<div class="col-sm-4 invoice-col">
											Para: 
											<address>
												<strong>{{ record.account.names }}</strong>
												<br>{{ record.account.address.minsize }}
												<br>Tel. Fijo: {{ record.account.phone }}
												<br>Tel. Móvil: {{ record.account.mobile }}
												<br>Email: {{ record.account.email }}
											</address>
										</div>
										
										<div class="col-sm-4 invoice-col">
											<b>Solicitud # 00000000-{{ record.id }}</b>
											<br>
											<br>
											<b>Cliente:</b> {{ record.account.id }}
										</div>
									</div>
									
									<div class="row">
										<div class="col-xs-12">
											<p class="lead">Transcripcion:</p>
											<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
												<template v-if="record.description !== null && record.description.length > 2">
													{{ record.description }}
												</template>
												<template v-else>
													No se ha escrito nada en la solicitud
												</template>
											</p>
										</div>
										
										<div class="col-xs-12 table">
											<table class="table table-striped">
												<!-- //
												<thead>
													<tr>
														<th>Servicio</th>
														<th>Codigo</th>
														<th style="width: 37%">Descripción</th>
														<th>T. Medición</th>
													</tr>
												</thead>
												<tbody>
													<template v-if="record.requests_services.length > 0">
														<tr v-for="(service, service_index) in record.requests_services">
															<td>{{ service.service.name }}</td>
															<td>{{ service.service.category }}-{{ service.service.medition.id }}-{{ service.service.id }}</td>
															<td>{{ service.service.description }}</td>
															<td :title="service.medition.name">{{ service.service.medition.code }}</td>
														</tr>
													</template>
													<template v-else>
														<tr>
															<td colspan="6">
																No se han seleccionado servicios.
															</td>
														</tr>
													</template>
												</tbody>												
												-->
											</table>
										</div>
									</div>
									
									<div class="row">
										<div class="col-xs-7">
											<p class="lead">Persona(s) de Contacto(s):</p>
											<template v-if="record.requests_contacts.length > 0">
												<table class="table table-striped">
													<thead>
														<tr>
															<th></th>
															<th>Contacto</th>
															<th>Tel. Fijo</th>
															<th>Tel. Móvil</th>
														</tr>
													</thead>
													
													<tr v-for="(contact, contact_index) in record.requests_contacts">
														<td>
															<i v-if="record.contact.id === contact.contact.id" class="fa fa-star"></i>
														</td>
														<td>{{ contact.contact.names }} {{ contact.contact.surname }}</td>
														<td>{{ contact.contact.phone }}</td>
														<td>{{ contact.contact.mobile }}</td>
													</tr>
												</table>
											</template>
											<template v-else>
													<tr>
														<td colspan="6">
															<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">Solicitud sin contactos.</p>
														</td>
													</tr>
												</table>
											</template>
										</div>
										
										<div class="col-xs-5">
											<p class="lead">Direccion(es)</p>
											<div class="table-responsive">
												<table class="table">
													<tbody>
														<template v-if="record.requests_addresses.length > 0">
															<tr v-for="(address, address_index) in record.requests_addresses">
																<td>{{ address.address.minsize }}</td>
															</tr>
														</template>
														<template v-else>
															<tr>
																<td colspan="2">
																	No se han seleccionado direcciones.
																</td>
															</tr>
														</template>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</section>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade bs-study-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel">Agendar Visita Técnica</h4>
					</div>
					<div class="modal-body">
					</div>
				</div>
			</div>
		</div>
		
	</div>
</template>

<script>
function FormException(error, aviso){
	this.name = error;
	this.message = aviso;
};

var api = axios.create({
	baseURL: '/api.php',
   withCredentials: true
});

api.interceptors.response.use(function (response) {
  if (response.headers['x-xsrf-token']) {
    document.cookie = 'XSRF-TOKEN=' + response.headers['x-xsrf-token'] + '; path=/';
  }
  return response;
});

var List = Vue.extend({
	template: '#list',
	data(){
		return {
			records: null,
			list: null
		};
	},
	mounted: function () {
		var self = this;
		self.load();
	},
	methods: {
		load(){
			var self = this;
			api.get('/records/accounts', {
				params: {
					join: [
						'identifications_types',
						'addresses',
						'accounts_types',
						'geo_departments',
						'geo_citys',
					]
				}
			}).then(function (response) {
				if(response.data.records && response.data.records.length > 0){
					self.records = response.data.records;
					self.list = [];
					response.data.records.forEach(function(a){
						item = {
							view_account: "<a onclick=\"javascript:app.$router.push({name:'View', params: {account_id: " + a.id + "}});\" class=\"btn btn-sm btn-default\"><i class=\"fa fa-eye\"></i></router-link>",
							id: a.id,
							type: (a.type !== null && a.type.name !== undefined) ? a.type.name : a.type,
							identification_type: (a.identification_type !== null && a.identification_type.name !== undefined) ? a.identification_type.code + ' - ' + a.identification_type.name : a.identification_type,
							identification_number: a.identification_number,
							names: a.names,
							surname: a.surname,
							email: a.email,
							phone: a.phone,
							mobile: a.mobile,
							address: (a.address !== null && a.address !== undefined && a.address.id !== undefined) ? a.address.minsize : "Sin dirección registrada",
							//view_account: "<button class=\"btn btn-sm btn-default\"><i class=\"fa fa-eye\"></i> Ver cuenta</button>",
							//"<router-link tag="a" v-for="subject in subjects" v-bind:to="{name: 'List', params: {subject: subject.name}}" class="list-group-item " :key="subject.name"></router-link>"
							// edit_account: "<button class=\"btn btn-sm btn-warning\">Modificar Cuenta</button>",
							// action: "<button class=\"btn btn-sm btn-default\">Nueva Solicitud</button>",
							// <router-link tag="a" v-for="subject in subjects" v-bind:to="{name: 'List', params: {subject: subject.name}}" class="list-group-item " :key="subject.name"></router-link>
						};
						// console.log('item', item);
						self.list.push(Object.values(item));
					});
					self.init_DataTables();
				}
			}).catch(function (error) {
			  console.log(error);
			});
		},
		init_DataTables() {
			var self = this;
			/* DATA TABLES */
			if( typeof ($.fn.DataTable) === 'undefined'){ return; }
			// console.log(('init_DataTables');
			var handleDataTableButtons = function() {
				if ($("#datatable-buttons2").length) {
					$("#datatable-buttons2").DataTable({
						data: self.list,
						dom: "Blfrtip",
						columns: [
							{ title: "" },
							{ title: "ID" },
							{ title: "Tipo" },
							{ title: "T. Doc" },
							{ title: "Documento" },
							{ title: "Nombres" },
							{ title: "Apellidos" },
							{ title: "E-mail" },
							{ title: "Telefono" },
							{ title: "Movil" },
							{ title: "Dirección" },
							// { title: "<i class=\"fa fa-edit\"></i>" },
							// { title: "<i class=\"fa fa-plus\"></i>" },
						],
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
						responsive: true
					});
				}
			};
			TableManageButtons = function() {
				"use strict";
				return {
					init: function() {
						handleDataTableButtons();
					}
				};
			}();
			$('#datatable').dataTable();
			$('#datatable-keytable').DataTable({
				keys: true
			});
			$('#datatable-responsive').DataTable();
			$('#datatable-scroller').DataTable({
				deferRender: true,
				scrollY: 380,
				scrollCollapse: true,
				scroller: true
			});
			$('#datatable-fixed-header').DataTable({
				fixedHeader: true
			});
			var $datatable = $('#datatable-checkbox');
			$datatable.dataTable({
				'order': [[ 1, 'asc' ]],
				'columnDefs': [
					{ orderable: false, targets: [0] }
				]
			});
			$datatable.on('draw.dt', function() {
				$('checkbox input').iCheck({
					checkboxClass: 'icheckbox_flat-green'
				});
			});
			TableManageButtons.init();
		},
	}
});

var View = Vue.extend({
	template: '#view',
	data(){
		return {
			meMicroroutesTotal: 0,
			meMicroroutesView: [],
			
			options: {
				accounts_types: [],
				identifications_types: [],
				geo_departments: [],
				geo_citys: [],
				geo_citysModal: [],
				geo_types_vias: [],
				geo_types_quadrants: [],
				contacts_types: [],
			},
			record: {
				id: this.$route.params.account_id,
				type: 0,
				economic_activity: 0,
				identification_type: 0,
				identification_number: '',
				names: '',
				surname: '',
				email: '',
				phone: '',
				mobile: '',
				gender: null,
				address: 0,
				update_by: <?= $this->user->id; ?>,
				birthday: '',
				accounts_contacts: [],
				accounts_headquarters: [],
				requests: [],
			},
			contactModal: {
				id: 0,
				id_ref: 0,
				type: 0,
				identification_type: 0,
				identification_number: '',
				names: '',
				surname: '',
				email: '',
				phone: '',
				mobile: '',
				birthday: '',
				address: '',
				department: 0,
				city: 0,
			},
			contactModalCreate: {
				identification_type: null,
				identification_number: null,
				names: null,
				surname: null,
				email: null,
				phone: null,
				mobile: null,
				birthday: '1990-10-31',
				address: null,
				department: null,
				city: null,
			},
			contactModalSearch: {
				id: null,
				identification_type: null,
				identification_number: null,
				names: null,
				surname: null,
				email: null,
				phone: null,
				mobile: null,
				birthday: '1990-10-31',
				address: null,
				department: null,
				city: null,
			},
			addressNormalizeError: true,
			addressNormalize: {
				department: 0,
				city: 0,
				via_principal: 0,
				via_principal_number: '',
				via_principal_letter: '',
				via_principal_quadrant: '',
				via_secondary_number: '',
				via_secondary_letter: '',
				via_secondary_quadrant: '',
				via_end_number: '',
				via_end_extra: '',
				minsize: '',
				complete: '',
			},

			headquarterName: '',
			headquartersNormalizeError: true,
			headquartersNormalize: {
				department: 0,
				city: 0,
				via_principal: 0,
				via_principal_number: '',
				via_principal_letter: '',
				via_principal_quadrant: '',
				via_secondary_number: '',
				via_secondary_letter: '',
				via_secondary_quadrant: '',
				via_end_number: '',
				via_end_extra: '',
				minsize: '',
				complete: '',
			},
		
			news: {
				contact: {
					type: 0,
				}
			},
			edit: {
				contact: {
					id: 0,
					account: this.$route.params.account_id,
					type: 0,
					contact: {
						id: 0,
						type: 0,
						identification_type: 0,
						identification_number: '',
						names: '',
						surname: '',
						email: '',
						phone: '',
						mobile: '',
						birthday: '',
						address: '',
						department: 0,
						city: 0,
					},
				}
			},
			search: {
				type: 0,
				contact: {
					id: 0,
					account: this.$route.params.account_id,
					type: 0,
					contact: {
						id: 0,
						type: 0,
						identification_type: 0,
						identification_number: '',
						names: '',
						surname: '',
						email: '',
						phone: '',
						mobile: '',
						birthday: '',
						address: '',
						department: 0,
						city: 0,
					},
				}
			},
		};
	},
	mounted: function () {
		var self = this;
		self.dialogMicroroutes = $(".bs-microroutes-me-account-modal-lg");
		// $('.inputmask-date-mysql').inputmask({ "mask": "9999-99-99" });
		/*$(".select2_single2").select2({
		  //placeholder: "Seleccione una opcion...",
		  allowClear: true,
		  language: "es"
		}).on('select2:select', function (e) {
			console.log('data e: ', 2);
			console.log('data Select: ', data);
			console.log('data Select: ', data.model);
			// self.record.schedule = data.id;
		});
		*/
		self.loadOptions();
	},
	methods: {
		loadContractInModal(contract){
			var self = this;
			$htmlBox = $('<div></div>').attr('class', 'animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12')
				.append(
					$('<div></div>').attr('class', 'tile-stats')
						.append(
							$('<div></div>').attr('class', 'icon').append($('<i></i>').attr('class', contract.is_active == 1 ? 'fa fa-check-square-o' : 'fa fa-times'))
						)
						.append($('<div></div>').attr('class', 'count').append(contract.name))
						.append($('<p></p>').append('Fecha de inicio: ' + contract.start + ' | Fecha Fin: ' + contract.end))
						//.append($('<h3></h3>').append('# ' + contract.id))
				);
				
			
				bootbox.dialog({
					title: "Viendo Contrato # " + contract.id,
					message: $htmlBox.html(),
					location: 'es',
					closeButton: true,
					buttons: {
						cancel: {
							label: "Cerrar",
							className: 'btn-default',
							callback: function(){
								console.log('Custom cancel clicked');
							}
						},
					}
				});
		},
		createContractInModal(){
			var self = this;
			$htmlBox = $('<div></div>').attr('class', 'animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12')
				.append(
					$('<div></div>').attr('class', 'tile-stats')
						.append(
							$('<div></div>').attr('class', 'icon').append($('<i></i>').attr('class', 'fa fa-check-square-o'))
						)
						.append($('<div></div>').attr('class', 'count').append(''))
						.append($('<p></p>')
							.append($('<input />').attr('class', 'form-control').attr('type', 'text'))
							.append($('<input />').attr('class', 'form-control').attr('type', 'date'))
							.append($('<input />').attr('class', 'form-control').attr('type', 'date'))
						)
						//.append($('<h3></h3>').append('# ' + contract.id))
				);
				
			
				bootbox.dialog({
					title: "Creacion rapida de contratos",
					message: $htmlBox.html(),
					location: 'es',
					closeButton: true,
					buttons: {
						cancel: {
							label: "Cerrar",
							className: 'btn-default',
							callback: function(){
								console.log('Custom cancel clicked');
							}
						},
						ok: {
							label: "Crear Contrato",
							className: 'btn-success',
							callback: function(){
								console.log('Custom cancel clicked');
								
							}
						},
					}
				});
		},
		openListMicroroutesModal(contract){
			var self = this;
			self.dialogMicroroutes.modal('show');
			$('#datatable-buttons-microroutes-modal').html('Cargando, porfavor espere...');
			setTimeout(() => {
				console.log(contract);
				MV.api.readList('/microroutes', {
					filter: [
						'account,eq,' + contract.account,
						'contract,eq,' + contract.id,
					], 
					join: [
						'accounts_contracts',
					]
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
									b.id,
									b.name, 
									b.id_ref, 
									b.address_text, 
									b.area_m2.toLocaleString(),
									b.contract.name,
									(b.last_executed !== null) ? b.last_executed : '- 0 -',
									'<button class="request-microroute-in-model btn btn-sm btn-default" data-account_id="' + b.account + '" data-microroute_id="' + b.id + '" data-microroute_name="' + b.name + '"><i class="fa fa-comment"></i></button>',
									(b.obs.length <= 3) ? 'Sin Observaciones' : b.obs.length, 
									b.description,
								]),
								columns: [
									{ title: "id" },
									{ title: "Microruta" },
									{ title: "Lote REF." },
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
														/*
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
															*/
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
			}, 1500); // 300000 == 5 Minutos || 1Min = 60000 || 1Seg = 1000
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
		includeContactModalSearch(){
			var self = this;
			var Notice = new PNotify({
				styling: "bootstrap3",
				text: 'Agregando contacto...',
				icon: 'fa fa-spinner fa-pulse',
				hide: false,
				shadow: false,
				width: '200px',
			});

			if(self.contactModalSearch.id > 0){
				api.post('/records/accounts_contacts', {
					account: self.$route.params.account_id,
					type: self.search.contact.type,
					contact: self.contactModalSearch.id
				})
				.then(function (b) {
					if(b.data > 0){
						Notice.update({
							type: 'success',
							title: 'Contacto enlazado!',
							text: 'Se guardo con éxito.',
							icon: 'fa fa-check',
							hide: true,
							shadow: true,
							modules: {
							  Buttons: {
								closer: false,
								sticker: false
							  }
							}
						});
						self.load();
						$('#search-contact-modal').modal('hide');
					}
				})
				.catch(function (e) {
					console.error(e);
					console.log(e.response);

					Notice.update({
						type: 'error',
						title: 'Error enlazado el contacto',
						text: (e.response.data.message != undefined) ? e.response.data.code + ' | ' + e.response.data.message : 'Error',
						icon: 'fa fa-times',
						hide: true,
						shadow: true,
					});
				});
			}
		},
		searchContactModal(){
			var self = this;
			self.contactModalSearch.id = 0;
			var Notice = new PNotify({
				styling: "bootstrap3",
				text: 'Buscando Contacto...',
				icon: 'fa fa-spinner fa-pulse',
				hide: false,
				shadow: false,
				width: '200px',
			});

			var filters = [
				'identification_type,eq,' + self.contactModalSearch.identification_type,
				'identification_number,eq,' + self.contactModalSearch.identification_number,
			];
			api.get('/records/contacts', {
				params: {
					filter: filters
				}
			})
			.then(function (a) {
				console.log(a);
				if(a.data !== undefined && a.data.records !== undefined && a.data.records.length > 0){
					Notice.update({
						type: 'success',
						title: 'Exito!',
						text: 'Se encontro un contacto con los datos ingresados.',
						icon: 'fa fa-check',
						hide: true,
						shadow: true,
						modules: {
						  Buttons: {
							closer: false,
							sticker: false
						  }
						}
					});
					self.contactModalSearch = a.data.records[0];
				} else {
					Notice.update({
						type: 'error',
						title: 'Error!',
						text: 'UPS!, NO Se encontro ningun contacto con los datos ingresados.',
						icon: 'fa fa-check',
						hide: true,
						shadow: true,
						modules: {
						  Buttons: {
							closer: false,
							sticker: false
						  }
						}
					});
				}
				/*
					self.load();
					$('#create-contact-modal').modal('hide');
				*/
			})
			.catch(function (e) {
				console.error(e);
				console.log(e.response);

				Notice.update({
					type: 'error',
					title: 'Error enlazado el contacto',
					text: (e.response.data.message != undefined) ? e.response.data.code + ' | ' + e.response.data.message : 'Error',
					icon: 'fa fa-times',
					hide: true,
					shadow: true,
				});
			});

		},
		removeContactInAccount(contactIn_ID){
			var self = this;
			bootbox.confirm({
				message: "Confirma que deseas eliminar el contacto de esta cuenta?",
				locale: 'es',
				callback: function (a) {
					if(a !== undefined && a == true){

						var Notice = new PNotify({
							styling: "bootstrap3",
							text: 'Eliminando Contacto...',
							icon: 'fa fa-spinner fa-pulse',
							hide: false,
							shadow: false,
							width: '200px',
						});

						api.delete('/records/accounts_contacts/' + contactIn_ID)
						.then(function (b) {
							if(b.data > 0){
								Notice.update({
									type: 'error',
									title: 'Error',
									text: 'No hay numero(s) de contacto.',
									icon: 'fa fa-times',
									hide: true,
									shadow: true,
								});
								self.load();
							}
						})
						.catch(function (e) {
							console.error(e);
							console.log(e.response);

							Notice.update({
								type: 'error',
								title: 'Error eliminando el contacto',
								text: (e.response.data.message != undefined) ? e.response.data.code + ' | ' + e.response.data.message : 'Error',
								icon: 'fa fa-times',
								hide: true,
								shadow: true,
							});
						});
					}
				}
			});

		},
		createContactModalAndInclude(){
			var self = this;
			var Notice = new PNotify({
				styling: "bootstrap3",
				text: 'Validando datos...',
				icon: 'fa fa-spinner fa-pulse',
				hide: false,
				shadow: false,
				width: '200px',
			});

			if(self.contactModalCreate.identification_type
				&& self.contactModalCreate.identification_number
				&& self.contactModalCreate.names
				&& self.contactModalCreate.surname
				&& self.contactModalCreate.email){
				if(self.contactModalCreate.phone.length == 0 && self.contactModalCreate.mobile.length == 0){
					Notice.update({
						type: 'error',
						title: 'Error',
						text: 'No hay numero(s) de contacto.',
						icon: 'fa fa-times',
						hide: true,
						shadow: true,
					});
				} else {
					api.get('/records/contacts', {
						params: {
							filter: [
								'identification_type,eq,' + self.contactModalCreate.identification_type,
								'identification_number,eq,' + self.contactModalCreate.identification_number,
							]
						}
					})
					.then(function (x) {
						if(x.data !== undefined && x.data.records !== undefined && x.data.records.length > 0){
							Notice.update({
								type: 'error',
								title: 'Ups! Error',
								text: 'Ya existe un contacto con los datos ingresados.',
								icon: 'fa fa-check',
								hide: true,
								shadow: true,
								modules: {
								  Buttons: {
									closer: false,
									sticker: false
								  }
								}
							});
						} else {
							api.post('/records/contacts', self.contactModalCreate)
							.then(function (a) {
								if(a.data > 0){
									Notice.update({
										title: 'Contacto guardado!',
										text: 'Se guardo con éxito, se va a enlazar con la cuenta.',
										icon: 'fa fa-check',
										hide: true,
										shadow: true,
										modules: {
										  Buttons: {
											closer: false,
											sticker: false
										  }
										}
									});

									api.post('/records/accounts_contacts', {
										account: self.$route.params.account_id,
										type: self.news.contact.type,
										contact: a.data
									})
									.then(function (b) {
										if(b.data > 0){
											 Notice.update({
												type: 'success',
												title: 'Contacto enlazado!',
												text: 'Se guardo con éxito.',
												icon: 'fa fa-check',
												hide: true,
												shadow: true,
												modules: {
												  Buttons: {
													closer: false,
													sticker: false
												  }
												}
											});
											self.load();
											$('#create-contact-modal').modal('hide');
										}
									})
									.catch(function (e) {
										console.error(e);
										console.log(e.response);

										Notice.update({
											type: 'error',
											title: 'Error enlazado el contacto',
											text: (e.response.data.message != undefined) ? e.response.data.code + ' | ' + e.response.data.message : 'Error',
											icon: 'fa fa-times',
											hide: true,
											shadow: true,
										});
									});
								}
							})
							.catch(function (e) {
								console.error(e);
								console.log(e.response);

								Notice.update({
									type: 'error',
									title: 'Error actualizando el contacto',
									text: (e.response.data.message != undefined) ? e.response.data.code + ' | ' + e.response.data.message : 'Error',
									icon: 'fa fa-times',
									hide: true,
									shadow: true,
								});
							});
						}
					})
					.catch(function (e) {
						console.error(e);
						console.log(e.response);

						Notice.update({
							type: 'error',
							title: 'Error buscando validando el contacto.',
							text: (e.response.data.message != undefined) ? e.response.data.code + ' | ' + e.response.data.message : 'Error',
							icon: 'fa fa-times',
							hide: true,
							shadow: true,
						});
					});
				}
			} else  {
				Notice.update({
					type: 'error',
					title: 'Error',
					text: 'Formulario incompleto.',
					icon: 'fa fa-times',
					hide: true,
					shadow: true,
				});
			}
		},
		loadContactInModal(contact){
			var self = this;
			if (contact !== undefined && contact !== null){
				self.edit.contact.id = contact.id;
				self.edit.contact.type = contact.type.id;
				
				api.get('/records/contacts/' + contact.contact.id, { params: {} })
				.then(function (a) {
					if(a.data.id !== undefined){
						self.edit.contact.contact = a.data;
						self.edit.contact.contact = a.data;
						self.loadCitysModal(self.edit.contact.contact.department);
					}
				})
				.catch(function (e) {
					console.error(e);
					console.log(e.response);
				});
			}
		},
		saveContactModal(){
			var self = this;
			message = "";

			var Notice = new PNotify({
				styling: "bootstrap3",
				text: 'Guardando contacto...',
				icon: 'fa fa-spinner fa-pulse',
				hide: false,
				shadow: false,
				width: '200px',
			});
			
			
			
			
			api.put('/records/accounts_contacts/' + self.edit.contact.id, {
				id: self.edit.contact.id,
				account: self.$route.params.account_id,
				type: self.edit.contact.type,
				contact: self.edit.contact.contact.id,
			})
			.then(function (a) {
				if(a.data > 0){
					self.load();
				}
			})
			.catch(function (e) {
				console.error(e);
				console.log(e.response);
			});
			
			api.put('/records/contacts/' + self.edit.contact.contact.id, self.edit.contact.contact)
			.then(function (a) {
				if(a.data > 0){
					self.load();
					Notice.update({
						type: 'success',
						title: 'Contacto guardado!',
						text: 'Se guardo con éxito.',
						icon: 'fa fa-check',
						hide: true,
						shadow: true,
						modules: {
						  Buttons: {
							closer: false,
							sticker: false
						  }
						}
					});
				}
			})
			.catch(function (e) {
				console.error(e);
				console.log(e.response);

				Notice.update({
					type: 'error',
					title: 'Error actualizando el contacto',
					text: (e.response.data.message != undefined) ? e.response.data.code + ' | ' + e.response.data.message : 'Error',
					icon: 'fa fa-times',
					hide: true,
					shadow: true,
				});
			});
		},
		saveAccount(){
			var self = this;
			message = "";

			var Notice = new PNotify({
				styling: "bootstrap3",
				text: 'Guardando...',
				icon: 'fa fa-spinner fa-pulse',
				hide: false,
				shadow: false,
				width: '200px',
			});
			
			self.record.updated_by = <?= $this->user->id; ?>;
			MV.api.update('/accounts/' +  self.record.id, self.record, (a) => {
				if(a > 0){
					Notice.update({
						type: 'success',
						title: 'Guardado!',
						text: 'Se guardo con éxito.',
						icon: 'fa fa-check',
						hide: true,
						shadow: true,
						modules: {
						  Buttons: {
							closer: false,
							sticker: false
						  }
						}
					});
				} else {
					Notice.update({
						type: 'error',
						title: 'Error',
						text: (e.response.data.message != undefined) ? e.response.data.code + ' | ' + e.response.data.message : 'Error',
						icon: 'fa fa-times',
						hide: true,
						shadow: true,
					});
				}
			});
			
			
		},
		loadCitys(){
			var self = this;
			self.options.geo_citys = [];
			if(self.addressNormalize.department !== undefined && self.addressNormalize.department !== null && self.addressNormalize.department > 0){
				api.get('/records/geo_citys/', { params: {
					filter: [
						'department,eq,' + self.addressNormalize.department
					]
				}}).then(function (a) {
					if(a.data.records !== undefined){ self.options.geo_citys = a.data.records; }
				});
			}
		},
		loadCitysModal(department){
			var self = this;
			self.options.geo_citysModal = [];
			if(department !== undefined && department !== null && department > 0){
				api.get('/records/geo_citys/', { params: {
					filter: [
						'department,eq,' + department
					]
				}}).then(function (a) {
					if(a.data.records !== undefined){ self.options.geo_citysModal = a.data.records; }
				});
			}
		},
		loadOptions(){
			var self = this;
			MV.api.readList('/identifications_types', {}, (a) => {
				self.options.identifications_types = a;
				MV.api.readList('/geo_departments', {}, (a) => {
					self.options.geo_departments = a;
					MV.api.readList('/accounts_types', {}, (a) => {
						self.options.accounts_types = a;
						MV.api.readList('/economic_activities', {}, (a) => {
							self.options.economic_activities = a;
							MV.api.readList('/geo_types_vias', {}, (a) => {
								self.options.geo_types_vias = a;
								MV.api.readList('/geo_types_quadrants', {}, (a) => {
									self.options.geo_types_quadrants = a;
									MV.api.readList('/contacts_types', {}, (a) => {
										self.options.contacts_types = a;
										
										self.load();
										
									});
								});
							});
						});
					});
				});
			});
		},
		load(){
			var self = this;
			MV.api.readSingle('/accounts', self.record.id, {
				join: [
					'accounts_contacts',
					'accounts_contacts,contacts_types',
					'accounts_contacts,contacts',
					'accounts_contacts,contacts,identifications_types',
					'accounts_contacts,contacts,geo_departments',
					'accounts_contacts,contacts,geo_citys',
					'accounts_headquarters,addresses',
					'accounts_contracts,microroutes',
					'requests',
					'requests,requests_status',
					'requests,users',
				]
			}, (a) => {
				if(a.id){
					self.record = a;
					
					//$(".select2_single2").trigger('change');
				} else {
					self.$router.push({
						name:'Search',
					});
				}
			});
		},
		NormalizeAddressesModal(){
			var self = this;
			self.record.address = 0;
			api.get('/records/addresses', {
				params: {
					filter: [
						'department,eq,' + self.addressNormalize.department,
						'city,eq,' + self.addressNormalize.city,
						'complete,eq,' + self.addressNormalize.complete,
						'minsize,eq,' + self.addressNormalize.minsize
					]
				}
			})
			.then(function (a) {
				if(a.data !== undefined && a.data.records !== undefined && a.data.records.length > 0){
					// console.log("Direccion existente");
					self.record.address = a.data.records[0].id;
					$('#addresses-modal').modal('hide');
				} else {
					// console.log("Direccion nueva");

					api.post('/records/addresses', self.addressNormalize)
					.then(function (b) {
						if(b.data > 0){
							// console.log("Direccion nueva agregada con exito.");
							self.record.address = b.data;
							$('#addresses-modal').modal('hide');
						}
					})
					.catch(function (e) {
						console.log("Error al agregada la direccion nueva.");
						console.error(e);
						console.log(e.response);
					});
				}
			})
			.catch(function (e) {
				console.log("error NormalizeAddressesModal");
				console.error(e);
				console.log(e.response);
			});
		},
		NormalizeheadquartersModal(){
			var self = this;
			api.get('/records/addresses', {
				params: {
					filter: [
						'department,eq,' + self.headquartersNormalize.department,
						'city,eq,' + self.headquartersNormalize.city,
						'complete,eq,' + self.headquartersNormalize.complete,
						'minsize,eq,' + self.headquartersNormalize.minsize
					]
				}
			})
			.then(function (a) {
				if(a.data !== undefined && a.data.records !== undefined && a.data.records.length > 0){
					// console.log("Direccion existente");

					api.post('/records/accounts_headquarters', {
						name: self.headquarterName,
						account: self.$route.params.account_id,
						address: a.data.records[0].id
					})
					.then(function (d) {
						if(d.data > 0){
							self.load();
							$('#headquarters-modal').modal('hide');
						}
					})
					.catch(function (e) {
						console.log("Error al agregada la sede nueva.");
						console.error(e);
						console.log(e.response);
					});

				} else {
					api.post('/records/addresses', self.headquartersNormalize)
					.then(function (b) {
						if(b.data > 0){
							// console.log("Direccion nueva agregada con exito.");

							api.post('/records/accounts_headquarters', {
								name: self.headquarterName,
								account: self.$route.params.account_id,
								address: b.data
							})
							.then(function (d) {
								if(d.data > 0){
									self.load();
									$('#headquarters-modal').modal('hide');
								}
							})
							.catch(function (e) {
								console.log("Error al agregada la sede nueva.");
								console.error(e);
								console.log(e.response);
							});
						}
					})
					.catch(function (e) {
						console.log("Error al agregada la direccion nueva.");
						console.error(e);
						console.log(e.response);
					});
				}
			})
			.catch(function (e) {
				console.log("error NormalizeheadquartersModal");
				console.error(e);
				console.log(e.response);
			});
		},
		loadCitysHeadquarters(){
			var self = this;
			self.options.geo_citys = [];
			if(self.headquartersNormalize.department !== undefined && self.headquartersNormalize.department !== null && self.headquartersNormalize.department > 0){
				api.get('/records/geo_citys/', { params: {
					filter: [
						'department,eq,' + self.headquartersNormalize.department
					]
				}}).then(function (a) {
					if(a.data.records !== undefined){ self.options.geo_citys = a.data.records; }
				});
			}
		},
		removeHeadquarters(headquarter_id){
			var self = this;
			bootbox.confirm({
				message: "Confirma que deseas eliminar la sede de esta cuenta?",
				locale: 'es',
				callback: function (a) {
					if(a !== undefined && a == true){
						var Notice = new PNotify({
							styling: "bootstrap3",
							text: 'Eliminando sede...',
							icon: 'fa fa-spinner fa-pulse',
							hide: false,
							shadow: false,
							width: '200px',
						});

						api.delete('/records/accounts_headquarters/' + headquarter_id)
						.then(function (b) {
							if(b.data > 0){
								Notice.update({
									type: 'error',
									title: 'Error',
									text: 'No hay numero(s) de contacto.',
									icon: 'fa fa-times',
									hide: true,
									shadow: true,
								});
								self.load();
							}
						})
						.catch(function (e) {
							console.error(e);
							console.log(e.response);

							Notice.update({
								type: 'error',
								title: 'Error eliminando la sede',
								text: (e.response.data.message != undefined) ? e.response.data.code + ' | ' + e.response.data.message : 'Error',
								icon: 'fa fa-times',
								hide: true,
								shadow: true,
							});
						});
					}
				}
			});


				api.get('/records/geo_citys/', { params: {
					filter: [
						'department,eq,' + self.headquartersNormalize.department
					]
				}}).then(function (a) {
					if(a.data.records !== undefined){ self.options.geo_citys = a.data.records; }
				});
		}
	},
	computed: {
		repairAddressMin(){
			var self = this;
			var addressReturn = "";
			try {
				var principal_via = self.options.geo_types_vias[self.options.geo_types_vias.map(function(x) { return x.id; }).indexOf(self.addressNormalize.via_principal)];
				self.addressNormalize.department = self.addressNormalize.department;
				self.addressNormalize.city = self.addressNormalize.city;
				var geo_city = self.options.geo_citys[self.options.geo_citys.map(function(x) { return x.id; }).indexOf(self.addressNormalize.city)];
				var geo_department = self.options.geo_departments[self.options.geo_departments.map(function(x) { return x.id; }).indexOf(self.addressNormalize.department)];

				self.addressNormalize.via_principal_number = self.addressNormalize.via_principal_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.addressNormalize.via_secondary_number = self.addressNormalize.via_secondary_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.addressNormalize.via_end_number = self.addressNormalize.via_end_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.addressNormalize.via_principal_letter = self.addressNormalize.via_principal_letter.replace(/[0-9-+()\s]/g, '').toUpperCase();
				self.addressNormalize.via_secondary_letter = self.addressNormalize.via_secondary_letter.replace(/[0-9-+()\s]/g, '').toUpperCase();
				self.addressNormalize.via_end_extra = self.addressNormalize.via_end_extra.toUpperCase();

				// Calle 33 AA # 80b 34 Laureles – Medellín
				if(self.addressNormalize.via_principal_number.length > 0 && self.addressNormalize.via_secondary_number.length > 0 && self.addressNormalize.via_end_number.length > 0){
					if(principal_via.id !== undefined){ addressReturn += principal_via.code; }
					addressReturn += ' ' + self.addressNormalize.via_principal_number;
					addressReturn += (self.addressNormalize.via_principal_letter !== "") ? '' + self.addressNormalize.via_principal_letter : "";
					addressReturn += (self.addressNormalize.via_principal_quadrant !== "") ? ' ' + self.addressNormalize.via_principal_quadrant : "";
					addressReturn += (self.addressNormalize.via_secondary_number !== "") ? ' ' + self.addressNormalize.via_secondary_number : "";
					addressReturn += (self.addressNormalize.via_secondary_letter !== "") ? '' + self.addressNormalize.via_secondary_letter : "";
					addressReturn += (self.addressNormalize.via_secondary_quadrant !== "") ? ' ' + self.addressNormalize.via_secondary_quadrant : "";
					addressReturn += (self.addressNormalize.via_end_number !== "") ? '-' + self.addressNormalize.via_end_number : "";
					addressReturn += (self.addressNormalize.via_end_extra !== "") ? ' ' + self.addressNormalize.via_end_extra : "";

					if(geo_city.id !== undefined){ addressReturn += ', ' + geo_city.name.toUpperCase(); }
					if(geo_department.id !== undefined){ addressReturn += ', ' + geo_department.name.toUpperCase(); }

					self.addressNormalize.minsize = addressReturn;
					return addressReturn;
				} else {
					self.addressNormalizeError = true;
					return "Formulario incompleto";
				}
			} catch(e){
				self.addressNormalizeError = true;
				return "Direccion invalida";
			};
		},
		repairAddressFull(){
			var self = this;
			var addressReturn = "";
			try {
				var principal_via = self.options.geo_types_vias[self.options.geo_types_vias.map(function(x) { return x.id; }).indexOf(self.addressNormalize.via_principal)];
				var geo_city = self.options.geo_citys[self.options.geo_citys.map(function(x) { return x.id; }).indexOf(self.addressNormalize.city)];
				var geo_department = self.options.geo_departments[self.options.geo_departments.map(function(x) { return x.id; }).indexOf(self.addressNormalize.department)];

				self.addressNormalize.via_principal_number = self.addressNormalize.via_principal_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.addressNormalize.via_secondary_number = self.addressNormalize.via_secondary_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.addressNormalize.via_end_number = self.addressNormalize.via_end_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.addressNormalize.via_principal_letter = self.addressNormalize.via_principal_letter.replace(/[0-9-+()\s]/g, '').toUpperCase();
				self.addressNormalize.via_secondary_letter = self.addressNormalize.via_secondary_letter.replace(/[0-9-+()\s]/g, '').toUpperCase();
				self.addressNormalize.via_end_extra = self.addressNormalize.via_end_extra.toUpperCase();

				if(self.addressNormalize.via_principal_number.length > 0 && self.addressNormalize.via_secondary_number.length > 0 && self.addressNormalize.via_end_number.length > 0){
					if(principal_via.id !== undefined){ addressReturn += principal_via.name; }

					addressReturn += ' ' + self.addressNormalize.via_principal_number;
					addressReturn += (self.addressNormalize.via_principal_letter !== "") ? '' + self.addressNormalize.via_principal_letter : "";
					addressReturn += (self.addressNormalize.via_principal_quadrant !== "") ? ' ' + self.addressNormalize.via_principal_quadrant : "";
					addressReturn += (self.addressNormalize.via_secondary_number !== "") ? ' ' + self.addressNormalize.via_secondary_number : "";
					addressReturn += (self.addressNormalize.via_secondary_letter !== "") ? '' + self.addressNormalize.via_secondary_letter : "";
					addressReturn += (self.addressNormalize.via_secondary_quadrant !== "") ? ' ' + self.addressNormalize.via_secondary_quadrant : "";
					addressReturn += (self.addressNormalize.via_end_number !== "") ? '-' + self.addressNormalize.via_end_number : "";
					addressReturn += (self.addressNormalize.via_end_extra !== "") ? ' ' + self.addressNormalize.via_end_extra : "";

					if(geo_city.id !== undefined){ addressReturn += ', ' + geo_city.name.toUpperCase(); }
					if(geo_department.id !== undefined){ addressReturn += ', ' + geo_department.name.toUpperCase(); }

					self.addressNormalize.complete = addressReturn;
					self.addressNormalizeError = false;

					return addressReturn;
				} else {
					self.addressNormalizeError = true;
					return "Formulario incompleto";
				}
			} catch(e){
				self.addressNormalizeError = true;
				return "Direccion invalida";
			};
		},
		repairheadquartersMin(){
			var self = this;
			var addressReturn = "";
			try {
				var principal_via = self.options.geo_types_vias[self.options.geo_types_vias.map(function(x) { return x.id; }).indexOf(self.headquartersNormalize.via_principal)];
				self.headquartersNormalize.department = self.headquartersNormalize.department;
				self.headquartersNormalize.city = self.headquartersNormalize.city;
				var geo_city = self.options.geo_citys[self.options.geo_citys.map(function(x) { return x.id; }).indexOf(self.headquartersNormalize.city)];
				var geo_department = self.options.geo_departments[self.options.geo_departments.map(function(x) { return x.id; }).indexOf(self.headquartersNormalize.department)];

				self.headquartersNormalize.via_principal_number = self.headquartersNormalize.via_principal_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.headquartersNormalize.via_secondary_number = self.headquartersNormalize.via_secondary_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.headquartersNormalize.via_end_number = self.headquartersNormalize.via_end_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.headquartersNormalize.via_principal_letter = self.headquartersNormalize.via_principal_letter.replace(/[0-9-+()\s]/g, '').toUpperCase();
				self.headquartersNormalize.via_secondary_letter = self.headquartersNormalize.via_secondary_letter.replace(/[0-9-+()\s]/g, '').toUpperCase();
				self.headquartersNormalize.via_end_extra = self.headquartersNormalize.via_end_extra.toUpperCase();

				// Calle 33 AA # 80b 34 Laureles – Medellín
				if(self.headquarterName.length >= 3 && self.headquartersNormalize.via_principal_number.length > 0 && self.headquartersNormalize.via_secondary_number.length > 0 && self.headquartersNormalize.via_end_number.length > 0){
					if(principal_via.id !== undefined){ addressReturn += principal_via.code; }
					addressReturn += ' ' + self.headquartersNormalize.via_principal_number;
					addressReturn += (self.headquartersNormalize.via_principal_letter !== "") ? '' + self.headquartersNormalize.via_principal_letter : "";
					addressReturn += (self.headquartersNormalize.via_principal_quadrant !== "") ? ' ' + self.headquartersNormalize.via_principal_quadrant : "";
					addressReturn += (self.headquartersNormalize.via_secondary_number !== "") ? ' ' + self.headquartersNormalize.via_secondary_number : "";
					addressReturn += (self.headquartersNormalize.via_secondary_letter !== "") ? '' + self.headquartersNormalize.via_secondary_letter : "";
					addressReturn += (self.headquartersNormalize.via_secondary_quadrant !== "") ? ' ' + self.headquartersNormalize.via_secondary_quadrant : "";
					addressReturn += (self.headquartersNormalize.via_end_number !== "") ? '-' + self.headquartersNormalize.via_end_number : "";
					addressReturn += (self.headquartersNormalize.via_end_extra !== "") ? ' ' + self.headquartersNormalize.via_end_extra : "";

					if(geo_city.id !== undefined){ addressReturn += ', ' + geo_city.name.toUpperCase(); }
					if(geo_department.id !== undefined){ addressReturn += ', ' + geo_department.name.toUpperCase(); }

					self.headquartersNormalize.minsize = addressReturn;
					return addressReturn;
				} else {
					self.headquartersNormalizeError = true;
					return "Formulario incompleto";
				}
			} catch(e){
				self.headquartersNormalizeError = true;
				return "Direccion invalida";
			};
		},
		repairheadquartersFull(){
			var self = this;
			var addressReturn = "";
			try {
				var principal_via = self.options.geo_types_vias[self.options.geo_types_vias.map(function(x) { return x.id; }).indexOf(self.headquartersNormalize.via_principal)];
				var geo_city = self.options.geo_citys[self.options.geo_citys.map(function(x) { return x.id; }).indexOf(self.headquartersNormalize.city)];
				var geo_department = self.options.geo_departments[self.options.geo_departments.map(function(x) { return x.id; }).indexOf(self.headquartersNormalize.department)];

				self.headquartersNormalize.via_principal_number = self.headquartersNormalize.via_principal_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.headquartersNormalize.via_secondary_number = self.headquartersNormalize.via_secondary_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.headquartersNormalize.via_end_number = self.headquartersNormalize.via_end_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.headquartersNormalize.via_principal_letter = self.headquartersNormalize.via_principal_letter.replace(/[0-9-+()\s]/g, '').toUpperCase();
				self.headquartersNormalize.via_secondary_letter = self.headquartersNormalize.via_secondary_letter.replace(/[0-9-+()\s]/g, '').toUpperCase();
				self.headquartersNormalize.via_end_extra = self.headquartersNormalize.via_end_extra.toUpperCase();

				if(self.headquarterName.length >= 3 && self.headquartersNormalize.via_principal_number.length > 0 && self.headquartersNormalize.via_secondary_number.length > 0 && self.headquartersNormalize.via_end_number.length > 0){
					if(principal_via.id !== undefined){ addressReturn += principal_via.name; }

					addressReturn += ' ' + self.headquartersNormalize.via_principal_number;
					addressReturn += (self.headquartersNormalize.via_principal_letter !== "") ? '' + self.headquartersNormalize.via_principal_letter : "";
					addressReturn += (self.headquartersNormalize.via_principal_quadrant !== "") ? ' ' + self.headquartersNormalize.via_principal_quadrant : "";
					addressReturn += (self.headquartersNormalize.via_secondary_number !== "") ? ' ' + self.headquartersNormalize.via_secondary_number : "";
					addressReturn += (self.headquartersNormalize.via_secondary_letter !== "") ? '' + self.headquartersNormalize.via_secondary_letter : "";
					addressReturn += (self.headquartersNormalize.via_secondary_quadrant !== "") ? ' ' + self.headquartersNormalize.via_secondary_quadrant : "";
					addressReturn += (self.headquartersNormalize.via_end_number !== "") ? '-' + self.headquartersNormalize.via_end_number : "";
					addressReturn += (self.headquartersNormalize.via_end_extra !== "") ? ' ' + self.headquartersNormalize.via_end_extra : "";

					if(geo_city.id !== undefined){ addressReturn += ', ' + geo_city.name.toUpperCase(); }
					if(geo_department.id !== undefined){ addressReturn += ', ' + geo_department.name.toUpperCase(); }

					self.headquartersNormalize.complete = addressReturn;
					self.headquartersNormalizeError = false;

					return addressReturn;
				} else {
					self.headquartersNormalizeError = true;
					return "Formulario incompleto";
				}
			} catch(e){
				self.headquartersNormalizeError = true;
				return "Direccion invalida";
			};
		},
	},
});

var Create = Vue.extend({
	template: '#create',
	data(){
		return {
			form_enabled: false,
			options: {
				accounts_types: [],
				economic_activities: [],
				identifications_types: [],
				geo_departments: [],
				geo_citys: [],
				geo_types_vias: [],
				geo_types_quadrants: [],
			},
			form: {
				type: 0,
				economic_activity: 0,
				identification_type: 0,
				identification_number: '',
				names: '',
				surname: '',
				email: '',
				phone: '',
				mobile: '',
				birthday: null,
				gender: null,
				address: 0,
				create_by: <?= $this->user->id; ?>,
				update_by: <?= $this->user->id; ?>,
			},
			list: null,
			addressNormalizeError: true,
			addressNormalize: {
				department: 0,
				city: 0,
				via_principal: 0,
				via_principal_number: '',
				via_principal_letter: '',
				via_principal_quadrant: '',
				via_secondary_number: '',
				via_secondary_letter: '',
				via_secondary_quadrant: '',
				via_end_number: '',
				via_end_extra: '',
				minsize: '',
				complete: '',
			},
		};
	},
	computed: {
		repairAddressMin(){
			var self = this;
			var addressReturn = "";
			try {
				var principal_via = self.options.geo_types_vias[self.options.geo_types_vias.map(function(x) { return x.id; }).indexOf(self.addressNormalize.via_principal)];
				self.addressNormalize.department = self.addressNormalize.department;
				self.addressNormalize.city = self.addressNormalize.city;
				var geo_city = self.options.geo_citys[self.options.geo_citys.map(function(x) { return x.id; }).indexOf(self.addressNormalize.city)];
				var geo_department = self.options.geo_departments[self.options.geo_departments.map(function(x) { return x.id; }).indexOf(self.addressNormalize.department)];

				self.addressNormalize.via_principal_number = self.addressNormalize.via_principal_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.addressNormalize.via_secondary_number = self.addressNormalize.via_secondary_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.addressNormalize.via_end_number = self.addressNormalize.via_end_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.addressNormalize.via_principal_letter = self.addressNormalize.via_principal_letter.replace(/[0-9-+()\s]/g, '').toUpperCase();
				self.addressNormalize.via_secondary_letter = self.addressNormalize.via_secondary_letter.replace(/[0-9-+()\s]/g, '').toUpperCase();
				self.addressNormalize.via_end_extra = self.addressNormalize.via_end_extra.toUpperCase();

				// Calle 33 AA # 80b 34 Laureles – Medellín
				if(self.addressNormalize.via_principal_number.length > 0 && self.addressNormalize.via_secondary_number.length > 0 && self.addressNormalize.via_end_number.length > 0){
					if(principal_via.id !== undefined){ addressReturn += principal_via.code; }
					addressReturn += ' ' + self.addressNormalize.via_principal_number;
					addressReturn += (self.addressNormalize.via_principal_letter !== "") ? '' + self.addressNormalize.via_principal_letter : "";
					addressReturn += (self.addressNormalize.via_principal_quadrant !== "") ? ' ' + self.addressNormalize.via_principal_quadrant : "";
					addressReturn += (self.addressNormalize.via_secondary_number !== "") ? ' ' + self.addressNormalize.via_secondary_number : "";
					addressReturn += (self.addressNormalize.via_secondary_letter !== "") ? '' + self.addressNormalize.via_secondary_letter : "";
					addressReturn += (self.addressNormalize.via_secondary_quadrant !== "") ? ' ' + self.addressNormalize.via_secondary_quadrant : "";
					addressReturn += (self.addressNormalize.via_end_number !== "") ? '-' + self.addressNormalize.via_end_number : "";
					addressReturn += (self.addressNormalize.via_end_extra !== "") ? ' ' + self.addressNormalize.via_end_extra : "";

					if(geo_city.id !== undefined){ addressReturn += ', ' + geo_city.name.toUpperCase(); }
					if(geo_department.id !== undefined){ addressReturn += ', ' + geo_department.name.toUpperCase(); }

					self.addressNormalize.minsize = addressReturn;
					return addressReturn;
				} else {
					self.addressNormalizeError = true;
					return "Formulario incompleto";
				}
			} catch(e){
				self.addressNormalizeError = true;
				return "Direccion invalida";
			};
		},
		repairAddressFull(){
			var self = this;
			var addressReturn = "";
			try {
				var principal_via = self.options.geo_types_vias[self.options.geo_types_vias.map(function(x) { return x.id; }).indexOf(self.addressNormalize.via_principal)];
				var geo_city = self.options.geo_citys[self.options.geo_citys.map(function(x) { return x.id; }).indexOf(self.addressNormalize.city)];
				var geo_department = self.options.geo_departments[self.options.geo_departments.map(function(x) { return x.id; }).indexOf(self.addressNormalize.department)];

				self.addressNormalize.via_principal_number = self.addressNormalize.via_principal_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.addressNormalize.via_secondary_number = self.addressNormalize.via_secondary_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.addressNormalize.via_end_number = self.addressNormalize.via_end_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.addressNormalize.via_principal_letter = self.addressNormalize.via_principal_letter.replace(/[0-9-+()\s]/g, '').toUpperCase();
				self.addressNormalize.via_secondary_letter = self.addressNormalize.via_secondary_letter.replace(/[0-9-+()\s]/g, '').toUpperCase();
				self.addressNormalize.via_end_extra = self.addressNormalize.via_end_extra.toUpperCase();

				if(self.addressNormalize.via_principal_number.length > 0 && self.addressNormalize.via_secondary_number.length > 0 && self.addressNormalize.via_end_number.length > 0){
					if(principal_via.id !== undefined){ addressReturn += principal_via.name; }

					addressReturn += ' ' + self.addressNormalize.via_principal_number;
					addressReturn += (self.addressNormalize.via_principal_letter !== "") ? '' + self.addressNormalize.via_principal_letter : "";
					addressReturn += (self.addressNormalize.via_principal_quadrant !== "") ? ' ' + self.addressNormalize.via_principal_quadrant : "";
					addressReturn += (self.addressNormalize.via_secondary_number !== "") ? ' ' + self.addressNormalize.via_secondary_number : "";
					addressReturn += (self.addressNormalize.via_secondary_letter !== "") ? '' + self.addressNormalize.via_secondary_letter : "";
					addressReturn += (self.addressNormalize.via_secondary_quadrant !== "") ? ' ' + self.addressNormalize.via_secondary_quadrant : "";
					addressReturn += (self.addressNormalize.via_end_number !== "") ? '-' + self.addressNormalize.via_end_number : "";
					addressReturn += (self.addressNormalize.via_end_extra !== "") ? ' ' + self.addressNormalize.via_end_extra : "";

					if(geo_city.id !== undefined){ addressReturn += ', ' + geo_city.name.toUpperCase(); }
					if(geo_department.id !== undefined){ addressReturn += ', ' + geo_department.name.toUpperCase(); }

					self.addressNormalize.complete = addressReturn;
					self.addressNormalizeError = false;

					return addressReturn;
				} else {
					self.addressNormalizeError = true;
					return "Formulario incompleto";
				}
			} catch(e){
				self.addressNormalizeError = true;
				return "Direccion invalida";
			};
		},
	},
	mounted: function () {
		var self = this;
		self.loadOptions();
	},
	methods: {
		NormalizeAddressesModal(){
			var self = this;
			self.form.address = 0;
			api.get('/records/addresses', {
				params: {
					filter: [
						'department,eq,' + self.addressNormalize.department,
						'city,eq,' + self.addressNormalize.city,
						'complete,eq,' + self.addressNormalize.complete,
						'minsize,eq,' + self.addressNormalize.minsize
					]
				}
			})
			.then(function (a) {
				if(a.data !== undefined && a.data.records !== undefined && a.data.records.length > 0){
					// console.log("Direccion existente");
					self.form.address = a.data.records[0].id;
					$('#addresses-modal').modal('hide');
				} else {
					// console.log("Direccion nueva");

					api.post('/records/addresses', self.addressNormalize)
					.then(function (b) {
						if(b.data > 0){
							// console.log("Direccion nueva agregada con exito.");
							self.form.address = b.data;
							$('#addresses-modal').modal('hide');
						}
					})
					.catch(function (e) {
						console.log("Error al agregada la direccion nueva.");
						console.error(e);
						console.log(e.response);
					});
				}
			})
			.catch(function (e) {
				console.log("error NormalizeAddressesModal");
				console.error(e);
				console.log(e.response);
			});
		},
		searchAccount(){
			var self = this;
			self.form_enabled = false;
			var Notice = new PNotify({
				styling: "bootstrap3",
				text: 'Revisando datos...',
				icon: 'fa fa-spinner fa-pulse',
				hide: false,
				shadow: false,
				width: '200px',
			});

			if (self.form.identification_number.length > 5 && self.form.identification_type > 0){
				api.get('/records/accounts', {
					params: {
						filter: [
							'identification_number,eq,' + self.form.identification_number,
							'identification_type,eq,' + self.form.identification_type
						]
					}
				})
				.then(function (a) {
					if(a.data !== undefined && a.data.records !== undefined && a.data.records.length > 0){
						Notice.update({
							type: 'success',
							title: 'Cliente encontrado!',
							text: 'Ya existe un cliente con los datos ingresados.',
							icon: 'fa fa-times',
							hide: true,
							shadow: true,
							modules: {
							  Buttons: {
								closer: false,
								sticker: false
							  }
							}
						});

						self.$router.push({
							name:'View',
							params: {
								account_id: a.data.records[0].id
							}
						});

					} else {
						Notice.update({
							type: 'error',
							title: 'Cliente no encontrado!',
							text: 'Puedes crear la ficha del cliente y así poder continuar.',
							icon: 'fa fa-check',
							hide: true,
							shadow: true,
							modules: {
							  Buttons: {
								closer: false,
								sticker: false
							  }
							}
						});
						self.form_enabled = true;
						$("form-create-identification_type")
					}
				})
				.catch(function (e) {
					console.error(e);
					console.log(e.response);

					Notice.update({
						type: 'error',
						title: 'Error enlazado el contacto',
						text: (e.response.data.message != undefined) ? e.response.data.code + ' | ' + e.response.data.message : 'Error',
						icon: 'fa fa-times',
						hide: true,
						shadow: true,
					});
				});

				Notice.update({
					type: 'info',
					title: 'Espere',
					text: 'Validando que si existe el cliente.',
					icon: 'fa fa-check',
					hide: true,
					shadow: true,
					modules: {
					  Buttons: {
						closer: false,
						sticker: false
					  }
					}
				});
			} else {
				Notice.update({
					type: 'error',
					title: 'Datos incompletos',
					text: 'Complete el "T. Documento" & el "# Documento"',
					icon: 'fa fa-times',
					hide: true,
					shadow: true,
				});
			}
		},
		loadOptions(){
			var self = this;
			api.get('/records/identifications_types/', { params: {} }).then(function (a) {
				if(a.data.records !== undefined){ self.options.identifications_types = a.data.records; }
				api.get('/records/geo_departments/', { params: {} }).then(function (a) {
					if(a.data.records !== undefined){ self.options.geo_departments = a.data.records; }
					api.get('/records/accounts_types/', { params: {} }).then(function (a) {
						if(a.data.records !== undefined){ self.options.accounts_types = a.data.records; }
						api.get('/records/economic_activities/', { params: {} }).then(function (a) {
							if(a.data.records !== undefined){ self.options.economic_activities = a.data.records; }
							api.get('/records/geo_types_vias/', { params: {} }).then(function (a) {
								if(a.data.records !== undefined){ self.options.geo_types_vias = a.data.records; }
								api.get('/records/geo_types_quadrants/', { params: {} }).then(function (a) {
									if(a.data.records !== undefined){ self.options.geo_types_quadrants = a.data.records; }
								});
							});
						});
					});
				});
			});
		},
		loadCitys(){
			var self = this;
			self.options.geo_citys = [];
			if(self.addressNormalize.department !== undefined && self.addressNormalize.department !== null && self.addressNormalize.department > 0){
				api.get('/records/geo_citys/', { params: {
					filter: [
						'department,eq,' + self.addressNormalize.department
					]
				}}).then(function (a) {
					if(a.data.records !== undefined){ self.options.geo_citys = a.data.records; }
				});
			}
		},
		createAccount(){
			var self = this;

			var Notice = new PNotify({
				styling: "bootstrap3",
				text: 'Validando formulario...',
				icon: 'fa fa-spinner fa-pulse',
				hide: false,
				shadow: false,
				width: '200px',
			});

			try {
				if(
					self.form.type > 0
					&& self.form.economic_activity > 0
					&& self.form.identification_type > 0
					&& self.form.identification_number.length >= 3
					&& self.form.names.length >= 3
					&& self.form.surname.length >= 3
					&& self.form.email.length >= 3
					&& self.form.phone.length >= 3
					&& self.form.mobile.length >= 3
					&& self.form.address > 0
					&& self.addressNormalizeError == false
				){
					console.log("Formulario valido");

					Notice.update({
						type: 'info',
						title: 'Enviando datos',
						text: "Por favor espere...",
						icon: 'fa fa-times',
						hide: false,
						shadow: false,
					});


					api.post('/records/accounts', self.form)
					.then(function (a) {
						if(a.data > 0){
							 Notice.update({
								type: 'success',
								title: 'Éxito!',
								text: 'Se creo la cuenta con éxito.',
								icon: 'fa fa-check',
								hide: true,
								shadow: true,
								modules: {
								  Buttons: {
									closer: false,
									sticker: false
								  }
								}
							});
							self.$router.push({
								name:'View',
								params: {
									account_id: a.data
								}
							});
						}
					})
					.catch(function (e) {
						console.error(e);
						console.log(e.response);
						Notice.update({
							type: 'error',
							title: 'Error creando la cuenta',
							text: (e.response.data.message != undefined) ? e.response.data.code + ' | ' + e.response.data.message : 'Error',
							icon: 'fa fa-times',
							hide: true,
							shadow: true,
						});
					});
				} else {
					console.log("Formulario incompleto");
					 Notice.update({
						type: 'error',
						title: 'Ups! Datos incompletos',
						text: 'Completa todos los campos para poder continuar.',
						icon: 'fa fa-check',
						hide: true,
						shadow: true,
						modules: {
						  Buttons: {
							closer: false,
							sticker: false
						  }
						}
					});
				}
			}
			catch (e){
				console.log("ERROR");
				console.error(e);
				 Notice.update({
					type: 'error',
					title: 'Error Inesperado!',
					text: 'Ocurrio un error intenta nuevamente.',
					icon: 'fa fa-check',
					hide: true,
					shadow: true,
					modules: {
					  Buttons: {
						closer: false,
						sticker: false
					  }
					}
				});
			}
		},
	}
});

var CreateRequest = Vue.extend({
	template: '#create-requests',
	data(){
		return {
			options: {
				addresses: [],
				contacts: [],
				services: [],
				account: {
					id: this.$route.params.account_id,
					type: 0,
					economic_activity: 0,
					identification_type: 0,
					identification_number: '',
					names: '',
					surname: '',
					email: '',
					phone: '',
					mobile: '',
					gender: null,
					address: 0,
					update_by: <?= $this->user->id; ?>,
					birthday: '',
					accounts_contacts: [],
					accounts_headquarters: [],
				},
			},
			form: {
				account: this.$route.params.account_id,
				create_by: <?= $this->user->id; ?>,
				update_by: <?= $this->user->id; ?>,
				contacts: 0,
				contacts: [],
				description: '',
				addresses: [],
				services: [],
			},
		};
	},
	computed: {
	},
	mounted: function () {
		var self = this;
		self.loadOptions();
	},
	methods: {
		newRequest(){
		},
		loadOptions(){
			var self = this;
			/* Limpiar listas actuales */
			self.options.addresses = [];
			self.options.contacts = [];
			self.options.services = [];

			/* Cargar direcciones */
			api.get('/records/accounts/' + self.$route.params.account_id, {
				params: {
					join: [
						'addresses',
						'accounts_headquarters,addresses',
					]
				}
			}).then(function (response) {
				console.log('addresses', response);
				if(response.data !== undefined && response.data.id > 0){
					self.options.addresses.push(response.data.address);
					if(response.data.accounts_headquarters !== undefined && response.data.accounts_headquarters.length > 0){
						response.data.accounts_headquarters.forEach(function(a){
							if(a.id !== undefined && a.id > 0){
								self.options.addresses.push(a.address);
							}
						});
					}
				}
			}).catch(function (error) {
			  console.log(error);
			});
			
			/* Cargar Contactos */
			api.get('/records/accounts_contacts', {
				params: {
					filter: [
						'account,eq,' + self.$route.params.account_id
					],
					join: [
						'contacts',
						'contacts_types',
						'contacts,addresses',
						'contacts,identifications_types',
					]
				}
			}).then(function (response) {
				if(response.data !== undefined && response.data.records !== undefined){
					if(response.data.records !== undefined && response.data.records.length > 0){
						response.data.records.forEach(function(a){
							console.log('contact', a);
							if(a.id !== undefined && a.id > 0){
								self.options.contacts.push(a.contact);
							}
						});
					}
				}
			}).catch(function (error) {
			  console.log(error);
			});
			
			/* Cargar Servicios */
			api.get('/records/services_categories', {
				params: {
					join: [
						'services,meditions',
					]
				}
			}).then(function (response) {
				if(response.data !== undefined && response.data.records !== undefined){
					if(response.data.records !== undefined && response.data.records.length > 0){
						self.options.services = response.data.records;
					}
				}
			}).catch(function (error) {
			  console.log(error);
			});
			
			/* Cargar Info Cuenta */
			api.get('/records/accounts/' + self.$route.params.account_id, {
				params: {
					join: [
						'addresses',
						'accounts_types',
						'economic_activities',
						'identifications_types',
					]
				}
			}).then(function (response) {
				if(response.data.id !== undefined && response.data.id >= 0){
					self.options.account = response.data;
				}
			}).catch(function (error) {
			  console.log(error);
			});
			
		},
		createRequest(){
			var self = this;
			console.log('createRequest');
			
			var Notice = new PNotify({
				styling: "bootstrap3",
				text: 'Estamos revisando la solicitud...',
				icon: 'fa fa-spinner fa-pulse',
				hide: false,
				shadow: false,
				width: '200px',
			});
			try {
				// Validar Descripción
				if(self.form.description.length > 5){
					// Validando contactos.
					if(self.form.contacts.length > 0){
						// Validando si hay contacto favorito
						if(self.form.contact > 0){
							// Buscar contacto en la lista de los seleccionados.
							resultado = self.form.contacts.find( contact => contact.id === self.form.contact ) !== undefined;
							contactInList = (resultado == true) ? true : false;
							// Validando contacto in lista.
							if(contactInList == true){
								// Validar Direcciones
								if(self.form.addresses.length > 0){
									// Validar Servicios
									if(self.form.services.length > 0){
										Notice.update({
											type: 'info',
											title: 'Solicitud Validada!',
											text: 'Se va a guardar la solicitud en el sistema, espere...',
											icon: 'fa fa-spinner fa-pulse',
											hide: false,
											shadow: false,
										});
										
										api.post('/records/requests', {
											account: parseInt(self.$route.params.account_id),
											contact: self.form.contact,
											description: self.form.description,
											create_by: <?= $this->user->id; ?>,
											update_by: <?= $this->user->id; ?>,
										})
										.then(function (a) {
											if(a.data > 0){
												var request_id = a.data; // ID de la solicitud
												
												Notice.update({
													type: 'info',
													title: 'En proceso!',
													text: 'Enlazando contactos, espere...',
													icon: 'fa fa-spinner fa-pulse',
													hide: false,
													shadow: false,
												});
												
												sends = [];
												self.form.contacts.forEach(function(contact){
													sends.push({
														request: request_id,
														contact: contact.id
													});
												});
												
												api.post('/records/requests_contacts', sends)
												.then(function (a) {
													if(a.data.length > 0){
														Notice.update({
															type: 'info',
															title: 'En proceso!',
															text: a.data.length + ' Contacto(s) agregado(s), espere...',
															icon: 'fa fa-spinner fa-pulse',
															hide: false,
															shadow: false,
														});
													}
													
													sends = [];
													self.form.addresses.forEach(function(address){
														sends.push({
															request: request_id,
															address: address.id
														});
													});
													
													api.post('/records/requests_addresses', sends)
													.then(function (a) {
														if(a.data.length > 0){
															Notice.update({
																type: 'info',
																title: 'En proceso!',
																text: a.data.length + ' Direccion(es) agregada(s), espere...',
																icon: 'fa fa-spinner fa-pulse',
																hide: false,
																shadow: false,
															});
														}
														
														sends = [];
														self.form.services.forEach(function(service){
															sends.push({
																request: request_id,
																service: service.id
															});
														});
														
														api.post('/records/requests_services', sends)
														.then(function (a) {
															if(a.data.length > 0){
																Notice.update({
																	type: 'info',
																	title: 'En proceso!',
																	text: a.data.length + ' Servicio(s) agregado(s), espere...',
																	icon: 'fa fa-spinner fa-pulse',
																	hide: false,
																	shadow: false,
																});
															}
															
															
															Notice.update({
																type: 'success',
																title: 'Solicitud Creada!',
																text: 'Se creo con éxito.',
																icon: 'fa fa-check',
																hide: true,
																shadow: true,
																modules: {
																  Buttons: {
																	closer: false,
																	sticker: false
																  }
																}
															});
															
															self.$router.push({ name:'View-Requests', params: { account_id: self.$route.params.account_id, request_id: request_id } });
															
															
														});
													});
												});
												
											}
										})
										.catch(function (e) {
											console.error(e);
											console.log(e.response);

											Notice.update({
												type: 'error',
												title: 'Error enlazado el contacto',
												text: (e.response.data.message != undefined) ? e.response.data.code + ' | ' + e.response.data.message : 'Error',
												icon: 'fa fa-times',
												hide: true,
												shadow: true,
											});
										});
									} else {
										throw new FormException('Error', "Seleccione almenos un (1) servicios.");
									}
								} else {
									throw new FormException('Error', "Seleccione almenos una (1) dirección.");
								}
							} else {
								throw new FormException('Error', "El contacto principal/favorito no esta en la lista de contactos.");
							}
						}  else {
							throw new FormException('Error', "Seleccione el contacto principal/favorito.");
						}
					} else {
						throw new FormException('Error', "Seleccione almenos un (1) contacto.");
					}
				} else {
					throw new FormException('Error', "Falta la solicitud transcrita del cliente.");
				}
			
			} catch(e){
				console.log('error', e);
				console.error(e);
				if(e.message !== undefined && e.name !== undefined){
				
					Notice.update({
						type: 'error',
						title: e.name,
						text: e.message,
						icon: 'fa fa-times',
						hide: true,
						shadow: true,
						modules: {
						  Buttons: {
							closer: false,
							sticker: false
						  }
						}
					});
				}
			}
		},
	}
});

var ViewRequest = Vue.extend({
	template: '#view-request',
	data(){
		return {
			record: {
				"id": this.$route.params.request_id,
				"account": {
					"id": this.$route.params.account_id,
					"type": {
						"id": 0,
						"name": ""
					},
					"economic_activity": 0,
					"identification_type": {
						"id": 0,
						"name": "",
						"code": ""
					},
					"identification_number": "",
					"names": "",
					"surname": "",
					"email": "",
					"phone": "",
					"mobile": "",
					"birthday": "",
					"gender": "",
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
						"complete": ""
					},
					"create_by": 0,
					"create": "",
					"update_by": 0,
					"updated": ""
				},
				"contact": {
					"id": 0,
					"identification_type": 0,
					"identification_number": "",
					"names": "",
					"surname": "",
					"email": "",
					"phone": "",
					"mobile": "",
					"birthday": "",
					"address": "",
					"department": "",
					"city": "",
					"create": "",
					"updated": ""
				},
				"status": {
					"id": 1,
					"name": "",
					"description": "",
					"color": "",
					"porcentage": ""
				},
				"description": "",
				"created": "",
				"create_by": {
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
					"registered": "",
					"updated": "",
					"last_connection": ""
				},
				"updated": "",
				"update_by": {
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
					"registered": "",
					"updated": "",
					"last_connection": ""
				},
				"requests_addresses": [],
				"requests_contacts": [],
				"requests_services": []
			},
			events: [],
		};
	},
	mounted(){
		var self = this;
		self.loadCalendar();
		self.load();
	},
	methods: {
		loadCalendar(){
			var self = this;
			var calendar = $('#my-calendar-home').fullCalendar({
				timeZone: 'UTC',
				height: 420,
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,listMonth'
				},
				selectable: false,
				selectHelper: true,
				/*
				select: function(start, end, allDay) {
					$('#fc_create').click();
					started = start;
					ended = end;
					$(".antosubmit").on("click", function() {
						var title = $("#title").val();
						if (end) {
							ended = end;
						}
						categoryClass = $("#event_type").val();
						if (title) {
							calendar.fullCalendar('renderEvent', {
								title: title,
								start: started,
								end: end,
								allDay: allDay
							},
								true // make the event "stick"
							);
						}

						$('#title').val('');
						calendar.fullCalendar('unselect');
						$('.antoclose').click();
						return false;
					});
				},*/
				/*
				eventClick: function(calEvent, jsEvent, view) {
					self.selected = calEvent.request;

					$('#fc_edit').click();
					$('#title2').val(calEvent.title);
					categoryClass = $("#event_type").val();
					$(".antosubmit2").on("click", function() {
						bootbox.confirm({
							message: "Deseas cambiar el titulo del evento?.<br><hr>",
							locale: 'es',
							callback: function (rM) {
								if(rM == true){
									api.put('/records/events/' + calEvent.id, {
										id: calEvent.id,
										title: $("#title2").val()
									})
									.then(rd => {
										if(rd.data != undefined && rd.data > 0){
											calEvent.title = $("#title2").val();
											calendar.fullCalendar('updateEvent', calEvent);
											$('.antoclose2').click();
										}
									});
								}
							}
						});

					});
					$(".antosubmit3").on("click", function() {
						$('.antoclose2').click();
						api.get('/records/events/' + calEvent.id, {
							params: {
							}
						})
						.then(response => {
							if(response.data != undefined && response.data.request > 0){
								location.replace('/micuenta/calendar#/view/' + response.data.id);
							}else{
								console.log("Error encontrando la solicitud.");
							}
						});
					});
					calendar.fullCalendar('unselect');
				},
				*/
				editable: false,
				events: self.events,
				plugins: [ 'list', 'timeGrid', 'month' ],
				defaultView: 'month',
			});
		},
		load(){
			var self = this;
			api.get('/records/requests/' + self.$route.params.request_id, {
				params: {
					join: [
						"accounts,identifications_types",
						"accounts,accounts_types",
						"accounts,addresses",
						"contacts",
						"requests_status",
						"users",
						
						"requests_addresses,addresses",
						"requests_contacts,contacts",
						"requests_contacts,contacts_types",
						"requests_services,services",
					]
				}
			}).then(function (response) {
				if(response.data.id && response.data.id > 0){
					self.record = response.data;
				}
			}).catch(function (error) {
			  console.log(error);
			});
			
		},
	},
});

var router = new VueRouter({
	linkActiveClass: 'active',
	routes:[
		{ path: '/', component: List, name: 'List' },
		{ path: '/search', component: Create, name: 'Search' },
		{ path: '/view/:account_id', component: View, name: 'View' },
		{ path: '/view/:account_id/requests/create', component: CreateRequest, name: 'Create-Request' },
		{ path: '/view/:account_id/requests/view/:request_id', component: ViewRequest, name: 'View-Requests' },
	]
});

app = new Vue({
	router: router,
	data: function () {
		return {

		};
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
		}
	}
}).$mount('#accounts-app');
</script>

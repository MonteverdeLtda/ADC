<?php 
?>
<style>
.modal {
	overflow: auto;
}
</style>
<div class="page-title">
	<div class="title_left">
		<h3><?= isset($title) ? $title : ""; ?> <small> <?= isset($subtitle) ? $subtitle : ""; ?></small></h3>
	</div>
</div>
<div class="clearfix"></div>
<div class="row" id="employees-app">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<router-view :key="$route.fullPath" ></router-view>
	</div>
</div>
<div class="clearfix"></div>

<template id="home">
	<div>
		
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Relación de empleados<small></small></h2>
						<ul class="nav navbar-right panel_toolbox">
							<li>
								<router-link :to="{ name: 'Create'}">
									<span class="fa fa-plus" aria-hidden="true"></span>
								</router-link>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable-keytable-employees" class="table table-striped table-bordered"></table>
					</div>
				</div>
			</div>
		</div>
		
		
		
	</div>
</template>

<template id="create">
	<div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Nuevo empleado<small></small></h2>
						<ul class="nav navbar-right panel_toolbox">
							<li>
								<router-link :to="{ name: 'Home'}">
									<span class="fa fa-close" aria-hidden="true"></span>
								</router-link>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<br />
						<form class="form-horizontal form-label-left" action="javascript:return false;" v-on:submit="createEmployee">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre(s) <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" required="required" class="form-control col-md-7 col-xs-12" v-model="record.names">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Apellido(s) <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" required="required" class="form-control col-md-7 col-xs-12" v-model="record.surname">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de identificación <span class="required">*</span></label>
								<div class="col-md-3 col-sm-3 col-xs-6">
									<select class="form-control col-md-7 col-xs-12" required="required" v-model="record.identification_type">
										<option value="0">Seleccione</option>
										<option v-for="(item, item_i) in $root.options.identifications_types" :value="item.id">{{ item.name }}</option>
									</select>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-6">
									<input class="form-control col-md-7 col-xs-12" type="text" name="middle-name" required="required" v-model="record.identification_number">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Nacionalidad <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control col-md-7 col-xs-12" required="required" v-model="record.nationality">
										<option value="0">Seleccione</option>
										<option v-for="(item, item_i) in $root.options.countries" :value="item.id">{{ item.name }} ({{ item.iso }})</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de nacimiento <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="cal_birthday" class="form-control col-md-7 col-xs-12" type="text" required="required" v-model="record.birthdate">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Lugar de nacimiento <span class="required">*</span></label>
								<div class="col-md-2 col-sm-2 col-xs-4">
									<select class="form-control col-md-7 col-xs-12" required="required" v-model="record.place_birth_country" @change="record.place_birth_department=0;record.place_birth_city=0;">
										<option value="0">Seleccione</option>
										<option v-for="(item, item_i) in $root.options.countries" :value="item.id">{{ item.name }}</option>
									</select>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-4">
									<select class="form-control col-md-7 col-xs-12" required="required" v-model="record.place_birth_department" @change="record.place_birth_city=0;">
										<option value="0">Seleccione</option>
										<option v-for="(item, item_i) in $root.options.departments.filter(dtp => dtp.country == record.place_birth_country)" :value="item.id">{{ item.name }}</option>
									</select>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-4">
									<select class="form-control col-md-7 col-xs-12" required="required" v-model="record.place_birth_city">
										<option value="0">Seleccione</option>
										<option v-for="(item, item_i) in $root.options.citys.filter(city => city.department == record.place_birth_department)" :value="item.id">{{ item.name }}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Género <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="btn-group" >
										<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
											<input type="radio" v-model="record.gender" value="male" required="required"> &nbsp; Masculino &nbsp;
										</label>
										<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
											<input type="radio" v-model="record.gender" value="female" required="required"> Femenino
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Estado civil <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control col-md-7 col-xs-12" required="required" v-model="record.status_marital">
										<option value="0">Seleccione</option>
										<option v-for="(item, item_i) in $root.options.status_marital" :value="item.id">{{ item.name }}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono Fijo <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input class="form-control col-md-7 col-xs-12" type="text" required="required" v-model="record.phone" datas-inputmask="'mask': '(9) 999 9999'">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono Móvil <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input class="form-control col-md-7 col-xs-12" type="text" required="required" v-model="record.mobile" datas-inputmask="'mask' : '399 999-9999'">
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Direccion <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">									
									<div class="input-group col-xs-12">
										<template v-if="record.address > 0">
											<input readonly="true" type="text" class="form-control" :value="repairAddressFull">
										</template>
										<template v-else>
											<input readonly="true" type="text" class="form-control" value="Ingrese su direccion">
										</template>
										
										<span class="input-group-btn">
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addresses-modal">
												<i class="fa fa-search"></i>
											</button>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Licencia de conducción <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control col-md-7 col-xs-12" required="required" v-model="record.driving_license">
										<option value="0">Seleccione</option>
										<option v-for="(item, item_i) in $root.options.driving_licenses" :value="item.id">{{ item.name }}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Dispone de vehículo propio <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="btn-group" >
										<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
											<input type="radio" v-model="record.own_vehicle" value="1" required="required"> &nbsp; Si &nbsp;
										</label>
										<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
											<input type="radio" v-model="record.own_vehicle" value="0" required="required"> No
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Discapacidad <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="btn-group" >
										<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
											<input type="radio" v-model="record.disability" value="1" required="required"> &nbsp; Si &nbsp;
										</label>
										<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
											<input type="radio" v-model="record.disability" value="0" required="required"> No
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Estado <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control col-md-7 col-xs-12" required="required" v-model="record.status">
										<option value="0">Seleccione</option>
										<option v-for="(item, item_i) in $root.options.employees_status" :value="item.id">{{ item.name }}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Libreta Militar / Número / D.M. <span class="required">*</span></label>
								<div class="col-md-2 col-sm-2 col-xs-4">
									<select class="form-control col-md-7 col-xs-12" required="required" v-model="record.military_card">
										<option value="0">Seleccione</option>
										<option v-for="(item, item_i) in $root.options.military_cards" :value="item.id">{{ item.name }}</option>
									</select>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-4">
									<input type="text" required="required" class="form-control col-md-7 col-xs-12" v-model="record.military_card_number">
								</div>
								<div class="col-md-2 col-sm-2 col-xs-4">
									<input type="text" required="required" class="form-control col-md-7 col-xs-12" v-model="record.military_card_dm">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">EPS <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control col-md-7 col-xs-12" required="required" v-model="record.eps">
										<option value="0">Seleccione</option>
										<option v-for="(item, item_i) in $root.options.membership_entities.filter(enty => enty.type == 'eps')" :value="item.id">{{ item.name }}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">ARL <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control col-md-7 col-xs-12" required="required" v-model="record.arl">
										<option value="0">Seleccione</option>
										<option v-for="(item, item_i) in $root.options.membership_entities.filter(enty => enty.type == 'arl')" :value="item.id">{{ item.name }}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">AFP <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control col-md-7 col-xs-12" required="required" v-model="record.afp">
										<option value="0">Seleccione</option>
										<option v-for="(item, item_i) in $root.options.membership_entities.filter(enty => enty.type == 'afp')" :value="item.id">{{ item.name }}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">CCF <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control col-md-7 col-xs-12" required="required" v-model="record.ccf">
										<option value="0">Seleccione</option>
										<option v-for="(item, item_i) in $root.options.membership_entities.filter(enty => enty.type == 'ccf')" :value="item.id">{{ item.name }}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones del Jefe de RRHH Y/O Contratos <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea rows="7" class="form-control col-md-7 col-xs-12" required="required" v-model="record.notes"></textarea>
								</div>
							</div>
							
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button class="btn btn-primary" type="button">Cancelar</button>
									<button class="btn btn-primary" type="reset">Limpiar</button>
									<button type="submit" class="btn btn-success">Crear</button>
								</div>
							</div>
						</form>
					</div>
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
									<select v-model="addressNormalize.department" type="text" required="required" class="form-control has-feedback-left" @change="addressNormalize.city = 0;">
										<option value="0">Elija un departamento...</option>
										<option v-for="(item, item_i) in $root.options.departments" :value="item.id">{{ item.name }}</option>
									</select>
									<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<select v-model="addressNormalize.city" type="text" id="inputSuccess2" required="required" class="form-control has-feedback-left">
										<option value="0">Elija una ciudad...</option>
										<option v-for="(item, item_i) in $root.options.citys.filter(city => city.department == addressNormalize.department)" :value="item.id">{{ item.name }}</option>
									</select>
									<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
								</div>

								<div class="col-xs-4">
									<h5>Via principal. (*)</h5>
									<div class="form-group">
										<select v-model="addressNormalize.via_principal" required="required" class="form-control">
											<option value="0">Elija una opción...</option>
											<option v-for="(item, index_item) in $root.options.types_vias" :key="item.id" :value="item.id">{{ item.name }} - {{ item.code }}</option>
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
											<option value="0">Elija una opción...</option>
											<option v-for="(item, index_item) in $root.options.types_quadrants" :key="item.id" :value="item.code">{{ item.name }}</option>
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
											<option value="0">Elija una opción...</option>
											<option v-for="(item, index_item) in $root.options.types_quadrants" :key="item.id" :value="item.code">{{ item.name }}</option>
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
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /Modal Addresses -->
		</div>
	</div>
</template>

<template id="single">
	<div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel" v-if="record !== null">
					<div class="x_title">
						<h2>Visor de Empleados <small>HV</small></h2>
						<ul class="nav navbar-right panel_toolbox">
							<li>
								<router-link :to="{ name: 'Home'}">
									<span class="fa fa-close" aria-hidden="true"></span>
								</router-link>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
							<div class="profile_img">
								<div id="crop-avatar">
									<!-- Current avatar -->
									<img class="img-responsive avatar-view" :src="(record.photo !== null && record.photo > 0) ? '/public/assets/images/picture.jpg' : defaultData.photo" alt="Avatar" title="Change the avatar" />
								</div>
							</div>
							<h3>{{ record.names }} {{ record.surname }} </h3>
							<h4>{{ record.identification_type.code }} {{ record.identification_number }} ({{ record.nationality.name }})</h4>
							<ul class="list-unstyled user_data">
								<li><i class="fa fa-birthday-cake user-profile-icon"></i> {{ record.birthdate }} <i > {{ record.place_birth_city.name }}, {{ record.place_birth_department.name }}, {{ record.place_birth_country.name }}</i> </li>
								<li><i class="fa fa-map-marker user-profile-icon"></i> {{ record.address.minsize }}</li>
								<li><b>Estado civil:</b> {{ record.status_marital.name }}</li>
								<li><b>Libreta Militar:</b> {{ record.military_card.name }} {{ record.military_card_number }} | <b>Distrito:</b> {{ record.military_card_dm }}</li>
								<li><b>Licencia:</b> {{ record.driving_license.name }}</li>
								<li>
									<i class="fa fa-car fa-lg user-profile-icon" v-if="record.own_vehicle == 1" title="Tiene vehículo propio"></i>
									<span class="fa-stack fa-lg" v-else title="Sin vehículo propio">
									  <i class="fa fa-car fa-stack-1x"></i>
									  <i class="fa fa-ban fa-stack-2x text-danger"></i>
									</span>
									
									<i class="fa fa-wheelchair fa-lg user-profile-icon" v-if="record.disability == 1" title="Discapacidad"></i> 
									<span class="fa-stack fa-lg" v-else title="Sin Discapacidad">
									  <i class="fa fa-wheelchair fa-stack-1x"></i>
									  <i class="fa fa-ban fa-stack-2x text-danger"></i>
									</span>
									
									<i :class="'fa fa-' + record.gender + ' fa-lg user-profile-icon'" title="Género"></i> 
								</li>
								<li class="m-top-xs">
									<br /><b>EPS: </b> {{ record.eps.name }}
									<br /><b>ARL: </b> {{ record.arl.name }}
									<br /><b>AFP: </b> {{ record.afp.name }}
									<br /><b>CCF: </b> {{ record.ccf.name }}
								</li>
								<!-- //
								<li class="m-top-xs">
									<i class="fa fa-external-link user-profile-icon"></i>
									<a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a>
								</li>
								-->
							</ul>
							<!-- <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a> -->
							<br />
							
							<!-- start skills -- >
							<h4>Skills</h4>
							<ul class="list-unstyled user_data">
								<li>
									<p>Web Applications</p>
									<div class="progress progress_sm">
										<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
									</div>
								</li>
								<li>
									<p>Website Design</p>
									<div class="progress progress_sm">
										<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70"></div>
									</div>
								</li>
								<li>
									<p>Automation & Testing</p>
									<div class="progress progress_sm">
										<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30"></div>
									</div>
								</li>
								<li>
									<p>UI / UX</p>
									<div class="progress progress_sm">
										<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
									</div>
								</li>
							</ul>
							<!-- end of skills -->
						</div>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<div class="" role="tabpanel" data-example-id="togglable-tabs">
								<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
									<li role="presentation" class="active">
										<a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
											<i class="fa fa-book"></i> Formación
										</a>
									</li>
									<li role="presentation">
										<a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">
											<i class="fa fa-briefcase"></i> Experiencias profesionales
										</a>
									</li>
									<li role="presentation" class="">
										<a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">
											<i class="fa fa-line-chart"></i> Desempeño
										</a>
									</li>
									<li role="presentation" class="">
										<a href="#tab_content4" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false">
											<i class="fa fa-users"></i> Grupo familiar
										</a>
									</li>
								</ul>
								<div id="myTabContent" class="tab-content">
									<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
										<div class="dashboard-widget-content">
											<ul class="list-unstyled timeline widget">
												<li v-for="(item, item_i) in record.employees_studies">
													<div class="block">
														<div class="block_content">
															<h2 class="title"><a>{{ item.name }} ({{ item.status.name }})</a> <a @click="removeStudy(item.id)" class="pull-right"><i class="fa fa-lg fa-times"></i></a></h2>
															<div class="byline">
																<span>{{ item.level_study.name }} </span> en <a>{{ item.educational_center }}</a>
															</div>
															<p class="excerpt">
																{{ item.period_start }} - {{ item.period_end }}
															</p>
														</div>
													</div>
												</li>
											</ul>
										</div>
										<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#new-study-modal">
											<i class="fa fa-plus"></i>
										</button>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
										<div class="dashboard-widget-content">
											<ul class="list-unstyled timeline widget">
												<li v-for="(item, item_i) in record.employees_experiences">
													<div class="block">
														<div class="block_content">
															<h2 class="title"><a>{{ item.company }} ({{ item.company_sector.name }})</a> <a @click="removeExperiency(item.id)" class="pull-right"><i class="fa fa-lg fa-times"></i></a></h2>
															<div class="byline">
																<span>{{ item.position }} </span> en el área de <a>{{ item.area.name }}</a>
															</div>
															<p class="excerpt">
																{{ item.period_start }} - {{ (item.period_end !== null) ? item.period_end : 'Actualmente' }}
															</p>
															<p class="excerpt">
																{{ item.notes }}
															</p>
														</div>
													</div>
												</li>
											</ul>
										</div>
										
										<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#new-experiency-modal">
											<i class="fa fa-plus"></i>
										</button>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
										<ul class="list-unstyled timeline">
											<li>
											  <div class="block">
												<div class="tags">
												  <a href="" class="tag">
													<span>Entertainment</span>
												  </a>
												</div>
												<div class="block_content">
												  <h2 class="title">
																  <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
															  </h2>
												  <div class="byline">
													<span>13 hours ago</span> by <a>Jane Smith</a>
												  </div>
												  <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
												  </p>
												</div>
											  </div>
											</li>
											<li>
											  <div class="block">
												<div class="tags">
												  <a href="" class="tag">
													<span>Entertainment</span>
												  </a>
												</div>
												<div class="block_content">
												  <h2 class="title">
																  <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
															  </h2>
												  <div class="byline">
													<span>13 hours ago</span> by <a>Jane Smith</a>
												  </div>
												  <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
												  </p>
												</div>
											  </div>
											</li>
											<li>
											  <div class="block">
												<div class="tags">
												  <a href="" class="tag">
													<span>Entertainment</span>
												  </a>
												</div>
												<div class="block_content">
												  <h2 class="title">
																  <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
															  </h2>
												  <div class="byline">
													<span>13 hours ago</span> by <a>Jane Smith</a>
												  </div>
												  <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
												  </p>
												</div>
											  </div>
											</li>
										</ul>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
										<div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12 text-center">
											</div>
											<div class="clearfix"></div>
										  
												<div class="col-md-6 col-sm-6 col-xs-12 profile_details">
													<div class="well profile_view">
														<div class="col-sm-12">
															<h4 class="brief"><i>Digital Strategist</i></h4>
															<div class="left col-xs-12">
																<h2>Nicole Pearson</h2>
																<p><strong>About: </strong> Web Designer / UX / Graphic Artist / Coffee Lover </p>
																<ul class="list-unstyled">
																	<li><i class="fa fa-building"></i> Address: </li>
																	<li><i class="fa fa-phone"></i> Phone #: </li>
																</ul>
															</div>
														</div>
														<div class="col-xs-12 bottom text-center">
															<div class="col-xs-12 col-sm-6 emphasis">
																<p class="ratings">
																	<a href="#"><span class="fa fa-star"></span></a>
																	<a href="#"><span class="fa fa-star-o"></span></a>
																</p>
															</div>
															<div class="col-xs-12 col-sm-6 emphasis">
																<button type="button" class="btn btn-success btn-xs"> <i class="fa fa-user">
																										</i> <i class="fa fa-comments-o"></i> </button>
																<button type="button" class="btn btn-primary btn-xs">
																	<i class="fa fa-user"> </i> View Profile
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
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal new study -->
		<div class="modal fade" id="new-study-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabelSmall" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modalLabelSmall">Agregar estudios</h4>
					</div>
					<form class="form-horizontal form-label-left" action="javascript:return false;" v-on:submit="createNewStudy">
						<div class="modal-body">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Centro educativo <span class="required">*</span></label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" required="required" class="form-control col-md-7 col-xs-12" v-model="modals.new_study.educational_center" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Nivel de estudios <span class="required">*</span></label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<select class="form-control col-md-7 col-xs-12" required="required" v-model="modals.new_study.level_study">
										<option value="0">Seleccione</option>
										<option v-for="(item, item_i) in $root.options.study_levels" :value="item.id">{{ item.name }}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Título obtenido <span class="required">*</span></label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" v-model="modals.new_study.name" required="required" class="form-control col-md-7 col-xs-12" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Estado <span class="required">*</span></label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<div class="btn-group" >
										<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" v-for="(item, item_i) in $root.options.study_status">
											<input type="radio" v-model="modals.new_study.status" :value="item.id" required="required"> &nbsp; {{ item.name }} &nbsp;
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Periodo <span class="required">*</span></label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input type="text" required="required" class="form-control col-md-7 col-xs-12 date_modal_sql" v-model="modals.new_study.period_start" >
								</div>
								<div class="col-md-5 col-sm-5 col-xs-12">
									<input type="text" required="required" class="form-control col-md-7 col-xs-12 date_modal_sql" v-model="modals.new_study.period_end" >
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Cancelar</button>
									<button type="submit" class="btn btn-success">Crear</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- // Modal new study -->
		
		<!-- Modal new experiency -->
		<div class="modal fade" id="new-experiency-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabelSmall" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modalLabelSmall">Agregar experiencia profesional</h4>
					</div>
					<form class="form-horizontal form-label-left" action="javascript:return false;" v-on:submit="createNewExperiency">
						<div class="modal-body">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Empresa <span class="required">*</span></label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" required="required" class="form-control col-md-7 col-xs-12" v-model="modals.new_experiency.company" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Sector de la empresa <span class="required">*</span></label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<select class="form-control col-md-7 col-xs-12" required="required" v-model="modals.new_experiency.company_sector">
										<option value="0">Seleccione</option>
										<option v-for="(item, item_i) in $root.options.companies_sectors" :value="item.id">{{ item.name }}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Cargo <span class="required">*</span></label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" v-model="modals.new_experiency.position" required="required" class="form-control col-md-7 col-xs-12" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Área <span class="required">*</span></label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<select class="form-control col-md-7 col-xs-12" required="required" v-model="modals.new_experiency.area">
										<option value="0">Seleccione</option>
										<option v-for="(item, item_i) in $root.options.companies_areas" :value="item.id">{{ item.name }}</option>
									</select>
								</div>
							</div>
					
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Periodo <span class="required">*</span></label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input type="text" required="required" class="form-control col-md-7 col-xs-12 date_modal_sql" v-model="modals.new_experiency.period_start" >
								</div>
								<div class="col-md-5 col-sm-5 col-xs-12">
									<input v-if="defaultData.experiency_date_current == false" type="text" required="required" class="form-control col-md-7 col-xs-12 date_modal_sql" v-model="modals.new_experiency.period_end" >
									
									<label class="control-label">
										<input type="checkbox"  class="" v-model="defaultData.experiency_date_current" >
										Actualmente
									</label>									
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Funciones y logros del cargo <span class="required">*</span></label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<textarea rows="10" v-model="modals.new_experiency.notes" required="required" class="form-control col-md-7 col-xs-12"></textarea>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Cancelar</button>
									<button type="submit" class="btn btn-success">Crear</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- // Modal new experiency -->
	</div>
</template>

<script>
var Home = Vue.extend({
	template: '#home',
	data(){
		return {
			list: [],
		}
	},
	mounted(){
		var self = this;
		self.load();
	},
	methods: {
		load(){
			var self = this;
			self.list = [];
			
			MV.api.readList('/employees', {
				join: [
					'employees_status',
					'addresses',
				]
			}, (r)=>{
				try {
					r.forEach(function(a){
						$btnView = $('<button></button>')
						.attr('class', 'btn btn-default btn-view')
						.append($('<i></i>').attr('class', 'fa fa-eye'));
						
						item = [
							a.id,
							'<button class="btn btn-default btn-view" employee_id="' + a.id + '">Ver</button>',
							a.status.name,
							a.identification_number,
							a.names,
							a.surname,
							a.gender,
							a.phone,
							a.mobile,
							a.address.minsize,
						];
						self.list.push(item);
						// self.list.push(Object.values(item));
					});
					
					$("#datatable-keytable-employees").DataTable({
						data: self.list,
						dom: "Blfrtip",
						columns: [
							{ title: "" },
							{ title: "" },
							{ title: "Estado" },
							{ title: "# Doc." },
							{ title: "Nombre(s)" },
							{ title: "Apellido(s)" },
							{ title: "Genero" },
							{ title: "Teléfono" },
							{ title: "Móvil" },
							{ title: "Direccion" },
						],
						buttons: [
							{ extend: "copy", className: "btn-sm" },
							{ extend: "csv", className: "btn-sm" },
							{ extend: "excel", className: "btn-sm" },
							{ extend: "pdfHtml5", className: "btn-sm" },
							{ extend: "print", className: "btn-sm" },
						],
						responsive: true
					});
					
					$(".btn-view").on('click', (e)=>{
						console.log($(e.target).attr('employee_id'))
						self.$router.push({
							name: 'Single',
							params: {
								employee_id: $(e.target).attr('employee_id')
							},
						});
						/*
						alert("ok");*/
					});
						/*
					$('#datatable-keytable-employees').DataTable({
						keys: true,
						data: Object.values(r)
						columns: [
							{ title: "Name" },
							{ title: "Position" },
							{ title: "Office" },
							{ title: "Extn." },
							{ title: "Start date" },
							{ title: "Salary" }
						
					});
					]*/
				} catch(e){
					console.error(e);
					console.log(e.response);
				}
			})
		}
	}
});

var Create = Vue.extend({
	template: '#create',
	data(){
		return {
			addressNormalizeError: true,
			record: {
				names: '',
				surname: '',
				identification_type: 0,
				identification_number: '',
				nationality: 0,
				birthdate: '1950-01-01',
				place_birth_country: 0,
				place_birth_department: 0,
				place_birth_city: 0,
				gender: '',
				status_marital: 0,
				phone: '',
				mobile: '',
				address: 0,
				driving_license: 0,
				own_vehicle: 0,
				disability: 0,
				status: 0,
				military_card: 0,
				military_card_number: '',
				military_card_dm: '',
				notes: '',
				eps: 0,
				arl: 0,
				afp: 0,
				ccf: 0,
			},
			addressNormalize: {
				department: 0,
				city: 0,
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
			}
		}
	},
	mounted(){
		var self = this;
		$('#cal_birthday').daterangepicker({
			singleDatePicker: true,
			singleClasses: "picker_1",
			locale: {
				format: 'YYYY-MM-DD'
			}
		}, function(start, end, label) {
			//console.log(start.toISOString(), end.toISOString(), label);
		});
	},
	methods: {
		NormalizeAddressesModal(){
			var self = this;
			self.record.address = 0;
			MV.api.read('/addresses', {
				filter: [
					'department,eq,' + self.addressNormalize.department,
					'city,eq,' + self.addressNormalize.city,
					'complete,eq,' + self.addressNormalize.complete,
					'minsize,eq,' + self.addressNormalize.minsize
				]
			}, (a) => {
				console.log("Buscando: ", a);
				if(a.length > 0){
					// console.log("Direccion existente");
					self.record.address = a[0].id;
					$('#addresses-modal').modal('hide');
				} else {
					MV.api.create('/addresses', self.addressNormalize, (b) => {
						if(b > 0){
							// console.log("Direccion nueva agregada con exito.");
							self.record.address = b;
							$('#addresses-modal').modal('hide');
						} else {
							console.log("Error creando");
						}
					});
				}
			});
		},
		createEmployee(){
			var self = this;
			MV.api.create('/employees', self.record, (a) => {
				if(a > 0){
					new PNotify({
						"title": "Exito!",
						"text": "El empleado se creo con exito.",
						"styling":"bootstrap3",
						"type":"success",
						"icon":true,
						"animation":"flip",
						"hide":true,
						"delay": 2500,
					});
					
					self.$router.push({
						name: 'Single',
						params: {
							employee_id: a
						},
					});
				} else {
					new PNotify({
						"title": "Ups!",
						"text": "Verifica el formulario e intenta de nuevo.",
						"styling":"bootstrap3",
						"type":"error",
						"icon":true,
						"animation":"flip",
						"hide":true,
						"delay": 2500,
					});
				}
			});
		}
	},
	computed: {
		repairAddressMin(){
			var self = this;
			var addressReturn = "";
			try {
				var principal_via = self.$root.options.types_vias[self.$root.options.types_vias.map(function(x) { return x.id; }).indexOf(self.addressNormalize.via_principal)];
				self.addressNormalize.department = self.addressNormalize.department;
				self.addressNormalize.city = self.addressNormalize.city;
				var city = self.$root.options.citys[self.$root.options.citys.map(function(x) { return x.id; }).indexOf(self.addressNormalize.city)];
				var department = self.$root.options.departments[self.$root.options.departments.map(function(x) { return x.id; }).indexOf(self.addressNormalize.department)];

				self.addressNormalize.via_principal_number = self.addressNormalize.via_principal_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.addressNormalize.via_secondary_number = self.addressNormalize.via_secondary_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.addressNormalize.via_end_number = self.addressNormalize.via_end_number.replace(/[a-zA-Z-+()\s]/g, '');
				self.addressNormalize.via_principal_letter = self.addressNormalize.via_principal_letter.replace(/[0-9-+()\s]/g, '').toUpperCase();
				self.addressNormalize.via_secondary_letter = self.addressNormalize.via_secondary_letter.replace(/[0-9-+()\s]/g, '').toUpperCase();
				self.addressNormalize.via_end_extra = self.addressNormalize.via_end_extra.toUpperCase();

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

					if(city.id !== undefined){ addressReturn += ', ' + city.name.toUpperCase(); }
					if(department.id !== undefined){ addressReturn += ', ' + department.name.toUpperCase(); }

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
				var principal_via = self.$root.options.types_vias[self.$root.options.types_vias.map(function(x) { return x.id; }).indexOf(self.addressNormalize.via_principal)];
				var city = self.$root.options.citys[self.$root.options.citys.map(function(x) { return x.id; }).indexOf(self.addressNormalize.city)];
				var department = self.$root.options.departments[self.$root.options.departments.map(function(x) { return x.id; }).indexOf(self.addressNormalize.department)];

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

					if(city.id !== undefined){ addressReturn += ', ' + city.name.toUpperCase(); }
					if(department.id !== undefined){ addressReturn += ', ' + department.name.toUpperCase(); }

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
	}
});

var Single = Vue.extend({
	template: '#single',
	data(){
		return {
			employee_id: this.$route.params.employee_id,
			record: null,
			defaultData: {
				photo: 'data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAAA8AAD/4QMvaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjYtYzA2NyA3OS4xNTc3NDcsIDIwMTUvMDMvMzAtMjM6NDA6NDIgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDQyAyMDE1IChXaW5kb3dzKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo3RkVCODBDMjU1OTMxMUVBQTZGOEI1OTNBODA2MjE2NSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo3RkVCODBDMzU1OTMxMUVBQTZGOEI1OTNBODA2MjE2NSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjdGRUI4MEMwNTU5MzExRUFBNkY4QjU5M0E4MDYyMTY1IiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjdGRUI4MEMxNTU5MzExRUFBNkY4QjU5M0E4MDYyMTY1Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+/+4ADkFkb2JlAGTAAAAAAf/bAIQABgQEBAUEBgUFBgkGBQYJ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',
				experiency_date_current: false,
			},
			modals: {
				new_study: {
					employee: this.$route.params.employee_id,
					name: '',
					educational_center: '',
					level_study: 0,
					status: 0,
					period_start: '1950-01-01',
					period_end: '1950-01-01',
				},
				new_experiency: {
					employee: this.$route.params.employee_id,
					company: '',
					company_sector: 0,
					position: '',
					area: 0,
					period_start: '1950-01-01',
					period_end: '1950-01-01',
					notes: '',
				},
			}
		};
	},
	mounted(){
		var self = this;
		
		$('.date_modal_sql').daterangepicker({
			singleDatePicker: true,
			singleClasses: "picker_1",
			locale: {
				format: 'YYYY-MM-DD'
			}
		}, function(start, end, label) {});
		
		self.load();
		
	},
	methods: {
		load(){
			var self = this;
			//self.record = null;
			MV.api.readSingle('/employees', self.employee_id, {
				join: [
					'employees_status',
					'addresses',
					'driving_licenses',
					'geo_citys',
					'geo_countries',
					'geo_departments',
					'identifications_types',
					'membership_entities',
					'military_cards',
					//'pictures',
					'status_marital',
					'employees_studies,study_levels',
					'employees_studies,study_status',
					'employees_experiences,companies_areas',
					'employees_experiences,companies_sectors',
				]
			}, (r)=>{
				self.record = r;
			});
		},
		createNewExperiency(){
			var self = this;
			if(self.modals.new_experiency.employee.length > 0
			&& self.modals.new_experiency.company.length >= 3
			&& self.modals.new_experiency.company_sector > 0
			&& self.modals.new_experiency.position.length >= 4
			&& self.modals.new_experiency.area > 0
			&& self.modals.new_experiency.notes.length > 20
			&& self.modals.new_experiency.period_start.length >= 10){
				if(self.defaultData.experiency_date_current == true){
					self.modals.new_experiency.period_end = null;
					delete self.modals.new_experiency.period_end;
				} else {
					if(self.modals.new_experiency.period_end.length <= 9){
						new PNotify({
							"title": "Ups!",
							"text": "Verifica el formulario e intenta de nuevo.",
							"styling":"bootstrap3",
							"type":"error",
							"icon":true,
							"animation":"flip",
							"hide":true,
							"delay": 2500,
						});
						return false;
					}
				}
				
				MV.api.create('/employees_experiences', self.modals.new_experiency, (a) => {
					if(a > 0){
						self.modals.new_experiency = {
							employee: this.$route.params.employee_id,
							company: '',
							company_sector: 0,
							position: '',
							area: 0,
							period_start: '1950-01-01',
							period_end: '1950-01-01',
							notes: '',
						};
						self.defaultData.experiency_date_current = false;
						
						new PNotify({
							"title": "Exito!",
							"text": "Estudio agregado.",
							"styling":"bootstrap3",
							"type":"success",
							"icon":true,
							"animation":"flip",
							"hide":true,
							"delay": 2500,
						});
						
						$('#new-experiency-modal').modal('hide');
						self.load();
					} else {
						new PNotify({
							"title": "Ups!",
							"text": "Error creando.",
							"styling":"bootstrap3",
							"type":"error",
							"icon":true,
							"animation":"flip",
							"hide":true,
							"delay": 2500,
						});
					}
				});
			} else {
				new PNotify({
					"title": "Ups!",
					"text": "Verifica el formulario e intenta de nuevo.",
					"styling":"bootstrap3",
					"type":"error",
					"icon":true,
					"animation":"flip",
					"hide":true,
					"delay": 2500,
				});
			}
			
		},
		createNewStudy(){
			var self = this;
			if(self.modals.new_study.employee > 0 && self.modals.new_study.name.length >= 5 && self.modals.new_study.educational_center.length >= 5 && self.modals.new_study.level_study > 0
				&& self.modals.new_study.status > 0 && self.modals.new_study.period_start.length >= 5 && self.modals.new_study.period_end.length >= 5){
				MV.api.create('/employees_studies', self.modals.new_study, (a) => {
					if(a > 0){
						self.modals.new_study = {
							employee: self.$route.params.employee_id,
							name: '',
							educational_center: '',
							level_study: 0,
							status: 0,
							period_start: '1950-01-01',
							period_end: '1950-01-01',
						};
						
						new PNotify({
							"title": "Exito!",
							"text": "Estudio agregado.",
							"styling":"bootstrap3",
							"type":"success",
							"icon":true,
							"animation":"flip",
							"hide":true,
							"delay": 2500,
						});
						
						$('#new-study-modal').modal('hide');
						self.load();
					} else {
						new PNotify({
							"title": "Ups!",
							"text": "Error creando.",
							"styling":"bootstrap3",
							"type":"error",
							"icon":true,
							"animation":"flip",
							"hide":true,
							"delay": 2500,
						});
					}
				});
			} else {
				new PNotify({
					"title": "Ups!",
					"text": "Verifica el formulario e intenta de nuevo.",
					"styling":"bootstrap3",
					"type":"error",
					"icon":true,
					"animation":"flip",
					"hide":true,
					"delay": 2500,
				});
			}
		},
		removeStudy(study_ref_id){
			var self = this;
			bootbox.confirm({
				message: "Confirma antes de eliminar?",
				locale: 'es',
				callback: (a) => {
					if(a == true){
						MV.api.remove('/employees_studies/' + study_ref_id, {}, (b) => {
							if(b > 0){
								self.load();
								new PNotify({
									"title": "Exito!",
									"text": "Estudio eliminado.",
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
		removeExperiency(experiency_ref_id){
			var self = this;
			bootbox.confirm({
				message: "Confirma antes de eliminar?",
				locale: 'es',
				callback: (a) => {
					if(a == true){
						MV.api.remove('/employees_experiences/' + experiency_ref_id, {}, (b) => {
							if(b > 0){
								self.load();
								new PNotify({
									"title": "Exito!",
									"text": "Estudio eliminado.",
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
	},
});

var router = new VueRouter({
	linkActiveClass: 'active',
	routes:[
		{ path: '/', component: Home, name: 'Home' },
		{ path: '/create', component: Create, name: 'Create' },
		{ path: '/view/single/:employee_id', component: Single, name: 'Single' },
	]
});

var app = new Vue({
	router: router,
	data: function () {
		return {
			options: {
				identifications_types: [],
				status_marital: [],
				countries: [],
				departments: [],
				citys: [],
				types_quadrants: [],
				types_vias: [],
				military_cards: [],
				membership_entities: [],
				study_levels: [],
				study_status: [],
				companies_areas: [],
				companies_sectors: [],
			}
		};
	},
	created(){
		var self = this;
		self.loadOptions();
	},
	methods: {
		loadOptions(){
			var self = this;
			MV.api.readList('/identifications_types', {}, (a)=>{ self.options.identifications_types = a; });
			MV.api.readList('/status_marital', {}, (a)=>{ self.options.status_marital = a; });
			MV.api.readList('/geo_types_quadrants', {}, (a)=>{ self.options.types_quadrants = a; });
			MV.api.readList('/geo_types_vias', {}, (a)=>{ self.options.types_vias = a; });
			MV.api.readList('/driving_licenses', {}, (a)=>{ self.options.driving_licenses = a; });
			MV.api.readList('/employees_status', {}, (a)=>{ self.options.employees_status = a; });
			MV.api.readList('/military_cards', {}, (a)=>{ self.options.military_cards = a; });
			MV.api.readList('/membership_entities', {}, (a)=>{ self.options.membership_entities = a; });
			MV.api.readList('/study_levels', {}, (a)=>{ self.options.study_levels = a; });
			MV.api.readList('/study_status', {}, (a)=>{ self.options.study_status = a; });
			MV.api.readList('/companies_areas', {}, (a)=>{ self.options.companies_areas = a; });
			MV.api.readList('/companies_sectors', {}, (a)=>{ self.options.companies_sectors = a; });
			
			MV.api.readList('/geo_countries', {}, (a)=>{ self.options.countries = a; });
			MV.api.readList('/geo_departments', {}, (a)=>{ self.options.departments = a; });
			MV.api.readList('/geo_citys', {}, (a)=>{ self.options.citys = a; });
		},
	}
}).$mount('#employees-app');
</script>
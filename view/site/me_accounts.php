<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
		<div id="dialog-form" title="Actualización de datos" class="dialog">
			<br />
			<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" v-if="forms.account_edit !== null">
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="economic_activity">Act. Economica <span class="required">*</span></label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<select v-model="forms.account_edit.economic_activity" required="required" class="form-control col-md-7 col-xs-12">
							<option value="">Seleccione una opcion...</option>
							<option v-for="(option, option_i) in options.economic_activities" :value="option.id">{{ option.name }}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="identification_type">Tipo de Doc. <span class="required">*</span></label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<select v-model="forms.account_edit.identification_type" required="required" class="form-control col-md-7 col-xs-12">
							<option value="">Seleccione una opcion...</option>
							<option v-for="(option, option_i) in options.identifications_types" :value="option.id">{{ option.name }}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="identification_number">Nro. Doc <span class="required">*</span></label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input v-model="forms.account_edit.identification_number" type="text" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
					</div>
				</div>
				<div class="form-group">
					<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name / Initial</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="middle-name">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div id="gender" class="btn-group" data-toggle="buttons">
							<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
								<input type="radio" name="gender" value="male"> &nbsp; Male &nbsp;
							</label>
							<label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
							  <input type="radio" name="gender" value="female"> Female
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span></label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input id="birthday" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
					</div>
				</div>
				<div class="ln_solid"></div>
			</form>
		</div>
		
		<div class="col-md-12">
			<div class="x_panel">
				<div class="x_content">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 text-center">
							<ul class="pagination pagination-split">
								<!-- // <li><a href="#">A</a></li> -->
							</ul>
						</div>
						<div class="clearfix"></div>
				  
				  
						<div class="col-md-4 col-sm-4 col-xs-12 profile_details" v-for="(accountInfo, i) in records">
							<div class="well profile_view">
								<div class="col-sm-12">
									<h4 class="brief"><i><b>Nivel de Acceso</b>: {{ accountInfo.permissions !== null ? accountInfo.permissions.name : 'Solo lectura' }}</i></h4>
									<div class="left col-xs-12">
										<h3>{{ accountInfo.account.names }} {{ accountInfo.account.surname }}</h3>
										<p><strong>Tipo de Cuenta.: </strong> {{ accountInfo.account.type.name }}</p>
										<p><strong>Act. Econom.: </strong> {{ accountInfo.account.economic_activity.name }}</p>
										<ul class="list-unstyled">
											<li><i class="fa fa-building"></i> Direccion Princ.: {{ accountInfo.account.address.minsize }}</li>
											<li><i class="fa fa-phone"></i> Teléfono: {{ accountInfo.account.phone }}</li>
											<li><i class="fa fa-mobile"></i> Móvil: {{ accountInfo.account.mobile }}</li>
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
											<button type="button" class="btn btn-success btn-xs">
												<i class="fa fa-users"></i>
											</button>
											<button type="button" class="btn btn-default btn-xs" @click="openEditAccount(accountInfo)">
												<i class="fa fa-edit"> </i> Act. Datos
											</button>
										</template>
										
										<template v-if="accountInfo.isAdmin === true || accountInfo.isManager === true">
											<button type="button" class="btn btn-primary btn-xs">
												<i class="fa fa-dashboard"> </i> Consola
											</button>
											<button type="button" class="btn btn-default btn-xs">
												<i class="fa fa-list"> </i> Lotes
											</button>
										</template>
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

<script>
  
var Home = Vue.extend({
	template: '#home',
	data(){
		return {
			options: {
				economic_activities: [],
				identifications_types: [],
			},
			records: [],
			dialogEdit: null,
			forms: {
				account_edit: null
			},
		};
	},
	mounted: function () {
		var self = this;
		self.loadOptions();
		
		self.dialogEdit = $( "#dialog-form" ).dialog({
		  autoOpen: false,
		  height: 'auto',
		  width: 350,
		  modal: true,
		  buttons: {
			"Actualizar": function(a){
				
			},
			"Cerrar": function() {
			  self.dialogEdit.dialog( "close" );
			}
		  },
		  close: function() {
			self.forms.account_edit = null;
		  },
		  open: function(event){
			  console.log('open');
			  console.log(self.forms.account_edit);
		  }
		});
	},
	computed: {
	},
	methods: {
		loadOptions(data){
			var self = this;
			MV.api.readList('/economic_activities', {}, (a) => {
				self.options.economic_activities = a;
			});
			MV.api.readList('/identifications_types', {}, (a) => {
				self.options.identifications_types = a;
			});
			self.load();
		},
		openEditAccount(data){
			var self = this;
			try {
				if(self.isAdminInAccount(data.permissions) == true){
					// self.forms.account_edit = data.account;
					self.forms.account_edit = {
						id: data.account.id,
						economic_activity: data.account.economic_activity.id,
						identification_type: data.account.identification_type.id,
						identification_number: data.account.identification_number,
						names: data.account.names,
						surname: data.account.surname,
						email: data.account.email,
						phone: data.account.phone,
						mobile: data.account.mobile,
						birthday: data.account.birthday,
					};
					
					self.dialogEdit.dialog( "open" );
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
			
			MV.api.readList('/accounts_users', {
				filter: [
					'user,eq,<?= $this->user->id; ?>'
				],
				join: [
					'accounts,identifications_types',
					'accounts,accounts_types',
					'accounts,addresses',
					'accounts,economic_activities',
					'accounts,users',
					'accounts,identifications_types',
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

app = new Vue({
	router: router,
	mounted(){
		var self = this;
	},
	data: function () {
		return {
		};
	},
	methods: {
	}
}).$mount('#me-accounts');
</script>
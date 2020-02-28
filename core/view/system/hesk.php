<div id="api-hesk">
	<div class="page-title">
		<div class="title_left">
			<h3>Projects <small>Listing design</small></h3>
		</div>
	</div>
	<div class="clearfix"></div>
	<div>
		<router-view :key="$route.fullPath" ></router-view>
	</div>
</div>
	
<template id="home-hesk">
	<div>
		<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Projects</h2>
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
						<template v-if="settings !== null">
							{{ settings }}
							<hr>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Titulo del sitio <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" v-model="settings.site_title" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
		  
						</template>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

	  

<!--// 
<div class="page-title">
  <div class="title_left">
	<h3>Projects <small>Listing design</small></h3>
  </div>

  <div class="title_right">
	<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
	  <div class="input-group">
		<input type="text" class="form-control" placeholder="Search for...">
		<span class="input-group-btn">
		  <button class="btn btn-default" type="button">Go!</button>
		</span>
	  </div>
	</div>
  </div>
</div>

<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12">
	<div class="x_panel">
	  <div class="x_title">
		<h2>Projects</h2>
		<ul class="nav navbar-right panel_toolbox">
		  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		  </li>
		  <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
			<ul class="dropdown-menu" role="menu">
			  <li><a href="#">Settings 1</a>
			  </li>
			  <li><a href="#">Settings 2</a>
			  </li>
			</ul>
		  </li>
		  <li><a class="close-link"><i class="fa fa-close"></i></a>
		  </li>
		</ul>
		<div class="clearfix"></div>
	  </div>
	  <div class="x_content">

		<p>Simple table with project listing with progress and editing options</p>

		<table class="table table-striped projects">
		  <thead>
			<tr>
			  <th style="width: 1%">#</th>
			  <th style="width: 20%">Project Name</th>
			  <th>Team Members</th>
			  <th>Project Progress</th>
			  <th>Status</th>
			  <th style="width: 20%">#Edit</th>
			</tr>
		  </thead>
		  <tbody>
			<tr>
			  <td>#</td>
			  <td>
				<a>Pesamakini Backend UI</a>
				<br />
				<small>Created 01.01.2015</small>
			  </td>
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
			  <td class="project_progress">
				<div class="progress progress_sm">
				  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="57"></div>
				</div>
				<small>57% Complete</small>
			  </td>
			  <td>
				<button type="button" class="btn btn-success btn-xs">Success</button>
			  </td>
			  <td>
				<a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
				<a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
				<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
			  </td>
			</tr>
			<tr>
			  <td>#</td>
			  <td>
				<a>Pesamakini Backend UI</a>
				<br />
				<small>Created 01.01.2015</small>
			  </td>
			  <td>
				<ul class="list-inline">
				  <li>
					<img src="/public/assets/images/user.png" class="avatar" alt="Avatar">
				  </li>
				  <li>
					<img src="/public/assets/images/user.png" class="avatar" alt="Avatar">
				  </li>
				</ul>
			  </td>
			  <td class="project_progress">
				<div class="progress progress_sm">
				  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="47"></div>
				</div>
				<small>47% Complete</small>
			  </td>
			  <td>
				<button type="button" class="btn btn-success btn-xs">Success</button>
			  </td>
			  <td>
				<a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
				<a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
				<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
			  </td>
			</tr>
			<tr>
			  <td>#</td>
			  <td>
				<a>Pesamakini Backend UI</a>
				<br />
				<small>Created 01.01.2015</small>
			  </td>
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
				</ul>
			  </td>
			  <td class="project_progress">
				<div class="progress progress_sm">
				  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="77"></div>
				</div>
				<small>77% Complete</small>
			  </td>
			  <td>
				<button type="button" class="btn btn-success btn-xs">Success</button>
			  </td>
			  <td>
				<a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
				<a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
				<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
			  </td>
			</tr>
			<tr>
			  <td>#</td>
			  <td>
				<a>Pesamakini Backend UI</a>
				<br />
				<small>Created 01.01.2015</small>
			  </td>
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
			  <td class="project_progress">
				<div class="progress progress_sm">
				  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
				</div>
				<small>60% Complete</small>
			  </td>
			  <td>
				<button type="button" class="btn btn-success btn-xs">Success</button>
			  </td>
			  <td>
				<a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
				<a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
				<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
			  </td>
			</tr>
			<tr>
			  <td>#</td>
			  <td>
				<a>Pesamakini Backend UI</a>
				<br />
				<small>Created 01.01.2015</small>
			  </td>
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
				</ul>
			  </td>
			  <td class="project_progress">
				<div class="progress progress_sm">
				  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="12"></div>
				</div>
				<small>12% Complete</small>
			  </td>
			  <td>
				<button type="button" class="btn btn-success btn-xs">Success</button>
			  </td>
			  <td>
				<a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
				<a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
				<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
			  </td>
			</tr>
			<tr>
			  <td>#</td>
			  <td>
				<a>Pesamakini Backend UI</a>
				<br />
				<small>Created 01.01.2015</small>
			  </td>
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
			  <td class="project_progress">
				<div class="progress progress_sm">
				  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="35"></div>
				</div>
				<small>35% Complete</small>
			  </td>
			  <td>
				<button type="button" class="btn btn-success btn-xs">Success</button>
			  </td>
			  <td>
				<a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
				<a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
				<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
			  </td>
			</tr>
			<tr>
			  <td>#</td>
			  <td>
				<a>Pesamakini Backend UI</a>
				<br />
				<small>Created 01.01.2015</small>
			  </td>
			  <td>
				<ul class="list-inline">
				  <li>
					<img src="/public/assets/images/user.png" class="avatar" alt="Avatar">
				  </li>
				  <li>
					<img src="/public/assets/images/user.png" class="avatar" alt="Avatar">
				  </li>
				</ul>
			  </td>
			  <td class="project_progress">
				<div class="progress progress_sm">
				  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="87"></div>
				</div>
				<small>87% Complete</small>
			  </td>
			  <td>
				<button type="button" class="btn btn-success btn-xs">Success</button>
			  </td>
			  <td>
				<a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
				<a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
				<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
			  </td>
			</tr>
			<tr>
			  <td>#</td>
			  <td>
				<a>Pesamakini Backend UI</a>
				<br />
				<small>Created 01.01.2015</small>
			  </td>
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
				</ul>
			  </td>
			  <td class="project_progress">
				<div class="progress progress_sm">
				  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="77"></div>
				</div>
				<small>77% Complete</small>
			  </td>
			  <td>
				<button type="button" class="btn btn-success btn-xs">Success</button>
			  </td>
			  <td>
				<a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
				<a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
				<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
			  </td>
			</tr>
			<tr>
			  <td>#</td>
			  <td>
				<a>Pesamakini Backend UI</a>
				<br />
				<small>Created 01.01.2015</small>
			  </td>
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
			  <td class="project_progress">
				<div class="progress progress_sm">
				  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="77"></div>
				</div>
				<small>77% Complete</small>
			  </td>
			  <td>
				<button type="button" class="btn btn-success btn-xs">Success</button>
			  </td>
			  <td>
				<a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
				<a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
				<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
			  </td>
			</tr>
		  </tbody>
		</table>
		
	  </div>
	</div>
  </div>
</div>
-->

<script>

const apiTickets = axios.create({
	baseURL: '/core/integrations/hesk/api/index.php/v1',
	// baseURL: '/ayudaysoporte/api/index.php/v1',
	withCredentials: true
});
apiTickets.defaults.headers['X-Auth-Token'] = '38e99d9117ccc6ff937160bf9a2d4b39';

var HELP = {};
HELP.ui = {
	readList(urlIn=null, paramsIn=null, callback=null){
		urlIn = urlIn == null ? '/' : urlIn;
		callback = callback !== null ? callback : function(e){};
		paramsIn = paramsIn !== null ? paramsIn : {};
		
		apiTickets.get(urlIn, { params: paramsIn })
		.then(function (c){ callback(c); })
		.catch(function (e) {
			console.log(e.response.headers);
			// callback(e);
			console.error(e);
			console.log(e);
			callback({
				'error': true,
				'response': e.response
			})
		});
	},
};


/*
	Ejemplo de uso: 
	--------------------
	HELP.ui.readList('/api/index.php/v1/tickets', {
		trackingId: 'XSN-HWB-3EX8',
		email: 'andrea.higuita@monteverdeltda.com'
	}, (r) => {
		console.log(r);
	});
	--------------------
	HELP.ui.readList('/staff/tickets/id', {}, (r) => {
		console.log(r);
	});
	HELP.ui.readList('/settings', {}, (r) => {
		console.log(r);
	});
	
*/
var HomeDesk = Vue.extend({
	template: '#home-hesk',
	data: function () {
		return {
			settings: null,
		};
	},
	mounted(){
		var self = this;
		self.loadSettings()
	},
	methods: {
		loadSettings(){
			var self = this;
			apiTickets.get('/settings', {})
			.then(function (c){
				if(c.status == 200){
					self.settings = c.data
					console.log(self.settings);
				} else {
					console.log('error cargando los settings');
				}
			})
			.catch(function (e) {
				console.error(e);
				console.log(e);
				console.log(e.response);
			});
		},
	}
});

var router = new VueRouter({
	linkActiveClass: 'active',
	routes:[
		{ path: '/', component: HomeDesk, name: 'Home' },
	]
});


app = new Vue({
	router: router,
	data: function () {
		return {
			statuses: null
		};
	},
	mounted(){
		var self = this;
		self.loadStatuses();
	},
	methods: {
		loadStatuses(){
			var self = this;
			apiTickets.get('/statuses', {})
			.then(function (c){
				if(c.status == 200){
					self.statuses = c.data
					//console.log('statuses', self.statuses);
				} else {
					console.log('error cargando los settings');
				}
			})
			.catch(function (e) {
				console.error(e);
				console.log(e);
				console.log(e.response);
			});
		},
	}
}).$mount('#api-hesk');
</script>
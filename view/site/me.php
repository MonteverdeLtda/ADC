<style>
@import url(https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,400,700);
h1, h2, h3, h4, h5, h6{
    font-family: 'Open Sans Condensed', sans-serif, sans-serif;
}

.btn{
    border-radius:0;
        font-family: 'Open Sans Condensed', sans-serif, sans-serif;
        margin-bottom:15px;

    }
    
.primary-bg{
    background-color:#F34336;
    color:#fff;
    }
    
.primary-bg:hover, .primary-bg:focus{
    background-color:#F22C1E;
    color:#fff;
    }
.secondary-bg{
    background-color:#20BFA9;
    color:#fff;
    }
    
.secondary-bg:hover, secondary-bg:focus{
    background-color:#1CA996;
    color:#fff;
    }
/* About
============================================== */

.about {
  background: url(/public/assets/build/images/square_bg.png) no-repeat top center;
  background-size: cover;
  background-color: rgba(255, 255, 255, 0.2);
  text-align: center;
  padding: 100px 0;
  min-height:100%;
  /*border-top:1px solid #ddd;
  border-bottom:1px solid #ddd;*/
}
.about .fig-profile {
  max-width: 200px;
  max-height: 200px;
  margin: 0 auto 0;
  position: relative;
  overflow: hidden !important;
  border: 12px solid #fff;
  border-radius: 50%;
  margin-bottom: 30px;
}
.about .fig-profile:hover figcaption {
  opacity: 1;
  webkit-transition: all 0.3s ease-out;
  -moz-transition: all 0.3s ease-out;
  -o-transition: all 0.3s ease-out;
  transition: all 0.3s ease-out;
  background-color: #20BFA9;
}
.about .fig-profile figcaption {
  position: absolute;
  top: 0;
  width: 100%;
  border-radius: 50%;
  text-align: center;
  vertical-align: center;
  line-height: 180px;
  opacity: 0;
  font-family: 'Open Sans Condensed', sans-serif;
  height: 100%;
  webkit-transition: all 0.3s ease-out;
  -moz-transition: all 0.3s ease-out;
  -o-transition: all 0.3s ease-out;
  transition: all 0.3s ease-out;
  color: #fff;
  font-size: 24px;
}
.about .name {
  font-size: 48px;
  text-transform: uppercase;
  margin: 20px 0 0 0;
}

.about .caption{
    font-size:16px;
    }
.about .position {
  margin: 0;
}
.about .location {
  margin: 5px 0 20px 0;
}
.about .slogan {
  margin-bottom: 40px;
  margin-top: 40px;
  font-weight: 700;
}
.about p {
  font-size: 16px;
}
.flag {
  width: 39px;
  margin: 0 auto;
}
.flag .blue {
  background-color: #002B7F;
  width: 13px;
  height: 26px;
  float: right;
}
.flag .yellow {
  background-color: #FCD116;
  width: 13px;
  height: 26px;
  float: right;
}
.flag .red {
  background-color: #CE1126;
  width: 13px;
  height: 26px;
  float: right;
}

/* Title Divider
============================================ */
.title-divider {
  margin: 0 auto;
  max-width: 400px;
  margin-bottom: 20px;
  overflow: hidden;
  padding: 10px 0;
}
.hr-divider {
  border-bottom: 1px solid #ddd;
  position: relative;
  float: left;
  bottom: -4px;
}
.icon-separator {
  float: left;
  text-align: center;
  margin-top: -7px;
  font-size: 18px;
  color: #F34336;
  padding: 0;
}
.heading-divider {
  margin-bottom: 40px;
  margin-top: 30px;
  display: flex;
}
.heading-divider .title {
  flex-grow: 0;
  -webkit-flex-grow: 0;
  margin: 0 5px 0 0;
  line-height: 1px;
}
.heading-divider .line-separator {
  border-bottom: 1px solid #ddd;
  border-top: 1px solid #ddd;
  flex-grow: 1;
  -webkit-flex-grow: 1;
  height: 6px;
  position: relative;
}
</style>

<div id="profile-app">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<router-view :key="$route.fullPath" ></router-view>
			<!-- //
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>User Report <small>Activity report</small></h2>
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
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
							<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
								<li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Activity</a></li>
								<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Projects Worked on</a></li>
								<li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a></li>
							</ul>
							<div id="myTabContent" class="tab-content">
								<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
									<ul class="messages">
										<li>
											<img src="/public/assets/images/img.jpg" class="avatar" alt="Avatar">
											<div class="message_date">
												<h3 class="date text-info">24</h3>
												<p class="month">May</p>
											</div>
											<div class="message_wrapper">
												<h4 class="heading">Desmond Davison</h4>
												<blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
												<br />
												<p class="url">
													<span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
													<a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
												</p>
											</div>
										</li>
									</ul>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
									<table class="data table table-striped no-margin">
										<thead>
											<tr>
												<th>#</th>
												<th>Project Name</th>
												<th>Client Company</th>
												<th class="hidden-phone">Hours Spent</th>
												<th>Contribution</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td>New Company Takeover Review</td>
												<td>Deveint Inc</td>
												<td class="hidden-phone">18</td>
												<td class="vertical-align-mid">
													<div class="progress">
														<div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								
								<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
									<p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
									photo booth letterpress, commodo enim craft beer mlkshk </p>
									<hr />
									<div class="table table-responsive">
										<?= $this->user; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>User Report <small>Activity report</small></h2>
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
					<div class="x_content table-responsive">
						<?= $this->user; ?>
					</div>
				</div>
			</div>
			-->
		</div>
	</div>
</div>
<div class="clearfix"></div>

<template id="home">
	<div>
		<section id="about" class="section-content about">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<figure data-toggle="modal" data-target=".bs-change-my-avatar-modal-lg" class="fig-profile wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
							<img v-if="$root.profile.avatar.data !== undefined" class="img-responsive img-circle img-profile" title="Roland Maruntelu" alt="Roland Maruntelu" :src="'data:image/png;base64, ' + $root.profile.avatar.data">
							<figcaption>Hello !</figcaption>
						</figure>
						<div class="flag">
							<span class="red"></span>
							<span class="blue"></span>
							<span class="yellow"></span>
						</div>
						<div class="clearfix"></div>

						<h2 class="name"><b>{{ $root.profile.names }}</b> {{ $root.profile.surname }}</</h2>
						<h3 class="position">@{{ $root.profile.username }}</h3>
						<h4 class="text-center location">{{ $root.profile.email }}</h4>
						<ul class="list-unstyled user_data">
							<!-- 
								<li><i class="fa fa-user user-profile-icon"></i> <?= "{$this->user->names} {$this->user->surname}"; ?></li>
								<li><i class="fa fa-map-marker user-profile-icon"></i> <?= $this->user->address; ?></li>
								<li><i class="fa fa-briefcase user-profile-icon"></i> Software Engineer </li>
							-->
							<li><i class="fa fa-phone user-profile-icon"></i> <?= "{$this->user->phone}"; ?></li>
							<li><i class="fa fa-mobile user-profile-icon"></i> <?= "{$this->user->mobile}"; ?></li>
						</ul>
						
						<div class="title-divider">
							<span class="hr-divider col-xs-5"></span>
							<span class="icon-separator col-xs-2"><i class="fa fa-star"></i></span>
							<span class="hr-divider col-xs-5"></span>
						</div>

					</div>
					
					<div class="col-md-8 col-md-offset-2 text-center">
					<!--<p class="caption">I'm Roland Maruntelu, webdesigner & wordpress theme developer at <a href="http://rolyart.ro">rolyart.ro.</a>I have a passion for creating challenging, clean and beautiful websit e/ wordpress themes.</p>-->
					
					<h2 class="slogan">
						"La ciencia no es sino una perversión de sí misma, a menos que tenga como objetivo final el mejoramiento de la humanidad" 
						<br />Nikola Tesla - Никола Тесла
					</h2>
					<a data-toggle="modal" data-target=".bs-my-profile-editor-fast-info-basic-modal-lg" class="btn btn-default secondary-bg btn-lg">
						Modificar Mis Datos
					</a>
					<a href="#" class="btn btn-default page-scroll primary-bg btn-lg" data-toggle="modal" data-target=".bs-my-profile-editor-fast-access-modal-lg">
						Cambiar datos de acceso
					</a>
					</div>
				</div>
			</div>
		</section>
	</div>
</template>

<script>
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

function FormException(error, aviso){
	this.name = error;
	this.message = aviso;
};

var Home = Vue.extend({
	template: '#home',
	data(){
		return {
		};
	},
	mounted: function () {
		var self = this;
		// self.load();
	},
	computed: {
		filters(){
			var self = this;
			return [1,2,3];
		}
	},
	methods: {
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
		self.load();
	},
	data: function () {
		return {
			loading: true,
			profile: {
				"id": 0,
				"username": "",
				"password": "",
				"identification_type": {
					"id": 0,
					"name": "",
					"code": ""
				},
				"identification_number": "",
				"names": "",
				"surname": "",
				"phone": "",
				"mobile": "",
				"address": "",
				"department": {
					"id": 0,
					"name": "",
					"code": ""
				},
				"city": {
					"id": 0,
					"name": "",
					"department": 0
				},
				"email": "",
				"avatar": {
					"id": 0,
					"name": "",
					"description": "",
					"size": 0,
					"data": "",
					"type": "",
					"created": "",
					"updated": ""
				},
				"permissions": 0,
				"registered": "",
				"updated": "",
				"last_connection": ""
			},
			total: 0,
			limit: 20,
			page: 1,
		};
	},
	methods: {
		load(){
			var self = this;
			self.loading = true;
			window.scrollTo(0, 0);
			
			api.get('/records/users/' + <?= $this->user->id; ?>, {
				params: {
					join: [
						'identifications_types',
						'geo_departments',
						'geo_citys',
						'pictures',
						// 'permissions',
					]
				}
			}).then(function (response) {
				if(response.status == 200){
					self.loading = false;
					self.profile = response.data;
					console.log('profile', self.profile);
				}
			}).catch(function (error) {
				console.log('error Home::methods::load()');
				console.log(error.response);
				self.loading = false;
			});
		},
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
}).$mount('#profile-app');
</script>
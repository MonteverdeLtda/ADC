
<div id="app-groups_microroutes">
	<div class="page-title">
		<div class="title_left">
			<!-- // <h3><?= $title; ?> <small><?= $subtitle; ?></small></h3> -->
		</div>
		<div class="title_right">
		</div>
	</div>
	<div class="clearfix"></div>
	
	<div class="row">
		<div class="col-md-4 col-sm-6 col-xs-12" v-for="(group, group_i) in aa_groups">
			<div class="x_panel">
				<div class="x_title">
					<h2>{{ group.name }} <small>Max m2 {{ group.max_area_for_day }}</small></h2>
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
					Add content to the page ...
				</div>
			</div>
		</div>
	</div>
</div>

<script>
app = new Vue({
	data: function () {
		return {
			aa_groups: [],
		};
	},
	mounted(){
		var self = this;
		
		self.load();
	},
	methods: {
		load(){
			var self = this;
			console.log('iniciando load()');
			
			MV.api.readList('/aa_groups', {
				join: [
					'aa_groups_microroutes,aa_microroutes,aa_zones',
					'notifications_groups,notifications_groups_users,users',
					'aa_groups_managers,users',
				],
			}, (a) => {
				self.aa_groups = a;
				console.log('Result: load()', a);
			});
		},
	}
}).$mount('#app-groups_microroutes');
</script>
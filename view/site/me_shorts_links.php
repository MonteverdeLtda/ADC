<div class="clearfix"></div>
<div class="row" id="me-shorts-links">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2><?= $title; ?> <small></small></h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li><a @click="createShortLink" style="cursor:pointer;"><i class="fa fa-plus"></i></a></li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<a v-for="(record, record_i) in records" type="button" class="btn btn-round btn-default" target="_blank" :href="'/shortlink/?h=' + record.hash">{{ record.name }}</a>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>

<script>
// short_links_users

var app = new Vue({
	mounted(){
		var self = this;
		self.load();
	},
	data() {
		return {
			records_orig: [],
			records: [],
		}; 
	},
	methods: {
		createShortLink(){
			var self = this;
			console.log('createShortLink');
			
			$content = $("<div></div>");
			$form = $("<form></form>");
			
			
			$formItemOne = $("<div></div>").attr('class','form-group col-xs-12')
				.append(
					$('<label></label>')
						.attr('class',"control-label col-md-3 col-sm-3 col-xs-12")
						.attr('for', 'first-name')
						.append('Nombre / Titulo')
						.append(
							$('<span></span>')
								.attr('class','required').append('*')
						)
				)
				.append(
					$('<div></div>')
						.attr('class',"col-md-6 col-sm-6 col-xs-12")
						.append(
							$('<input />')
								.attr('class','form-control col-md-7 col-xs-12')
								.attr('type','text')
								.attr('id',"title_new_shortlink_modal")
								.attr('required',"required")
								.attr('required','required')
						)
				);
			
			
			$formItemTwo = $("<div></div>").attr('class','form-group col-xs-12')
				.append(
					$('<label></label>')
						.attr('class',"control-label col-md-3 col-sm-3 col-xs-12")
						.attr('for', 'first-name')
						.append('Enlace')
						.append(
							$('<span></span>')
								.attr('class','required').append('*')
						)
				)
				.append(
					$('<div></div>')
						.attr('class',"col-md-6 col-sm-6 col-xs-12")
						.append(
							$('<input />')
								.attr('class','form-control col-md-7 col-xs-12')
								.attr('type','url')
								.attr('id',"url_new_shortlink_modal")
								.attr('required',"required")
						)
				);
			
			
			$form.append($formItemOne);
			$form.append($formItemTwo);
			$content.append($form);
			
			var dialog = bootbox.dialog({
				message: $content.html(),
				closeButton: true,
				buttons: {
					close: {
						label: 'Cerrar',
						className: 'btn-default',
						callback: function(){
							console.log('Custom cancel clicked');
						},
					},
					noclose: {
						label: 'Añadir',
						className: 'btn-success',
						callback: function(){
							console.log('Custom cancel clicked');
							
							title = $("#title_new_shortlink_modal").val();
							url = $("#url_new_shortlink_modal").val();
							
							console.log(title, url);
							urlValid = self.validURL(url);
							console.log('urlValid', urlValid);
							if(urlValid == true && title.length > 3){
								MV.api.create('/short_links', {
									name: title,
									hash: self.makeid(8),
									link: url,
									created_by: '<?= $this->user->id; ?>',
								}, (x) => {
									if(x >0){
										console.log(x);
										new PNotify({
											"title": "Éxito!",
											"text": "Enlace creado..",
											"styling":"bootstrap3",
											"type":"success",
											"icon":true,
											"animation":"zoom",
											"hide":true
										});
										
										MV.api.create('/short_links_users', {
											short_link: x,
											user: '<?= $this->user->id; ?>',
										}, (z) => {
											if(z >0){
												console.log(z);
											}
											self.load();
										});
										
										dialog.modal('hide');
									}
								});
								
							} else {
								new PNotify({
									"title": "Ups!",
									"text": "Verifique los campos del formulario.",
									"styling":"bootstrap3",
									"type":"error",
									"icon":true,
									"animation":"zoom",
									"hide":true
								});
							};
							
							return false;
						},
					},
				},
			});
						
			// do something in the background
			// dialog.modal('hide');
		},
		makeid(length){
			var result           = '';
			var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			var charactersLength = characters.length;
			for ( var i = 0; i < length; i++ ) {
				result += characters.charAt(Math.floor(Math.random() * charactersLength));
			}
			return result;
		},
		load(){
			var self = this;
			MV.api.readList('/short_links_users', {
				join: [
					'short_links',
				],
			}, (a) => {
				self.records_orig = a;
				self.records = a.map(b => b.short_link);
			});
		},
		validURL(str) {
			var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
				'((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
				'((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
				'(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
				'(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
				'(\\#[-a-z\\d_]*)?$','i'); // fragment locator
			return !!pattern.test(str);
		}
	}
}).$mount('#me-shorts-links');
</script>
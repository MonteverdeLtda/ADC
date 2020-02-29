<div id="api-hesk">
	<div class="clearfix"></div>
	<div>
		<router-view :key="$route.fullPath" ></router-view>
	</div>
</div>
	
<style scope="home-hesk">
.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.inbox_chat { height: 550px; overflow-y: scroll;}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #d8e9cf none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 60%;
}

 .sent_msg p {
  background: #6ba74c none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
  background: #6ba74c none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  max-height: calc(75vh);
  overflow-y: auto;
}
</style>

<template id="home-hesk">
	<div>
		<div class="row" v-if="$root.settings !== null">
			<div class="col-md-12" v-if="record == null">
				<div class="x_panel">
					<div class="x_title">
						<h2>Ver Ticket <small v-if="$root.settings !== null"> {{ $root.settings.hesk_title }} </small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form v-on:submit="submitFormSearch" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="javascript:return false;">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ticket ID: <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input v-model="filter.ticket_id" type="text" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button type="submit" class="btn btn-success">Ver ticket</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			
			<div v-if="record !== null">
				<div class="col-md-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>{{ record.subject }} <font :color="$root.statuses.find(a => a.id == record.statusId).textColor"> {{ (record.closedDate !== null ? 'Cerrado' : 'Abierto') }} - {{ $root.statuses.find(a => a.id == record.statusId).localizedNames['Español'] }} </font>  </small></h2>
							<ul class="nav navbar-right panel_toolbox">
								
								<li><a @click="record = null;" class="close-link"><i class="fa fa-close"></i></a></li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div class="msg_history">
								<div class="outgoing_msg">
									<div class="sent_msg">
										<b>{{ record.name }}:</b> 
										<p v-html="record.message"></p>
									<span class="time_date"> {{ record.dateCreated }}</span> </div>
								</div>
								
								<template v-for="(replie, replie_i) in record.replies">
									<div :class="replie.staffId !== null ? 'incoming_msg' : 'outgoing_msg'">
										<div :class="replie.staffId !== null ? 'received_msg' : 'sent_msg'">
											<div :class="replie.staffId !== null ? 'received_withd_msg' : ''">
												<b>{{ replie.replierName }}:</b> 
												<template v-if="replie.usesHtml == true">
													<p v-html="replie.message"></p>
												</template>
												<template v-else>
													<p>{{ replie.message }}</p>
												</template>
												<span class="time_date"> 
													{{ replie.dateCreated }} 
													<i class="fa fa-check" v-if="replie.isRead == true"></i>
												</span>
											</div>
										</div>
									</div>
								</template>
							</div>
							<div class="type_msg">
								<div class="input_msg_write">
									<form action="javascript:return false;" v-on:submit="submitFormSend">
										<input v-model="messageText" type="text" class="write_msg" placeholder="Enviar mensaje..." />
										<button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
									</form>
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
var HELP = {};
HELP.ui = {
	read(urlIn=null, paramsIn=null, callback=null){
		urlIn = urlIn == null ? '/' : urlIn;
		callback = callback !== null ? callback : (e) => {};
		paramsIn = paramsIn !== null ? paramsIn : {};
		
		apiTickets.get(urlIn, { params: paramsIn })
		.then(function (c){ callback({
				'error': false,
				'data': c.data
			});
		})
		.catch(function (e) {
			console.log(e.response.headers);
			// callback(e);
			console.error(e);
			console.log(e);
			callback({
				'error': true,
				'data': e.response
			})
		});
	},
};

HELP.tickets = {
	search(paramsIn=null, callback=null){
		callback = callback !== null ? callback : (e) => {};
		paramsIn = paramsIn !== null ? paramsIn : {};
		
		apiTickets.get('/tickets', { params: paramsIn })
		.then((a) => {
			if(a.data !== null){
				callback({
					'error': false,
					'success': true,
					'data': a.data
				});
			} else {
				callback({
					'error': false,
					'success': false,
					'data': a.data
				});
			}
		})
		.catch((e) => {
			console.log(e.response.headers);
			// callback(e);
			console.error(e);
			console.log(e);
			callback({
				'error': true,
				'data': e.response
			})
		});
	},
};

var HomeDesk = Vue.extend({
	template: '#home-hesk',
	data: function () {
		return {
			filter: {
				ticket_id: 'Z6E-NQL-21SR'
			},
			messageText: '',
			record: null
		};
	},
	mounted(){
		var self = this;
	},
	methods: {
		submitFormSend(){
			var self = this;
			if(self.messageText.length > 3){
				apiTickets.post('/tickets/' + self.record.id + '/replies', {
					email: ('<?= $this->user->email; ?>'.length > 5) ? '<?= $this->user->email; ?>' : (Array.isArray(self.record.email) == true ? self.record.email[0] : self.record.email),
					email: '<?= $this->user->email; ?>',
					trackingId: self.record.trackingId,
					message: self.messageText,
					html: true,
					ip: "<?= $_SERVER['SERVER_ADDR']; ?>",
				})
				.then((a) => {
					console.log(a);
					if(a.status == 201){
						new PNotify({
							"title": '¡Éxito!',
							"text": 'Mensaje enviado.',
							"styling": 'bootstrap3',
							"type": 'success',
							"icon": true,
							"animation": 'zoom',
							"hide": true
						});
						
						self.messageText = '';
						self.submitFormSearch();
					}
				})
				.catch((e) => {
					console.log(e.response);
					// callback(e);
					console.error(e);
					console.log(e);
				});
			};
		},
		submitFormSearch(){
			var self = this;
			self.record = null;
			/*
			HELP.ui.read('/tickets', {
				trackingId: self.filter.ticket_id // Example: Z6E-NQL-21SR
			}, (a) => {
				console.log(a);
			});*/
			
			HELP.tickets.search({
				trackingId: self.filter.ticket_id,
			}, (r) => {
				console.log(r);
				if (r.error !== true) {
					if (r.success == true) {
						console.log(r.data.replies)
						self.record = r.data;
						new PNotify({
							"title": '¡Éxito!',
							"text": 'Ticket encontrado.',
							"styling": 'bootstrap3',
							"type": 'success',
							"icon": true,
							"animation": 'zoom',
							"hide": true
						});
					} 
					else {
						new PNotify({
							"title": '¡Ups!',
							"text": 'Ticket no encontrado, verifique los datos e intente de nuevo.',
							"styling": 'bootstrap3',
							"type": 'warning',
							"icon": true,
							"animation": 'zoom',
							"hide": true
						});
					}
				}
				else {
					new PNotify({
						"title": '¡Ups!',
						"text": 'Ocurrio un error conectando al portal de ayuda y soporte',
						"styling": 'bootstrap3',
						"type": 'error',
						"icon": true,
						"animation": 'zoom',
						"hide": true
					});
				}
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
			statuses: null,
			settings: null,
		};
	},
	mounted(){
		var self = this;
		self.loadStatuses();
		self.loadSettings();
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
		loadStatuses(){
			var self = this;
			apiTickets.get('/statuses', {})
			.then(function (c){
				if(c.status == 200){
					self.statuses = c.data
					console.log('statuses', self.statuses);
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
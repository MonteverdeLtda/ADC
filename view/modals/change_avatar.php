<div class="modal fade bs-change-my-avatar-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel">Subir avatar</h4>
			</div>
			<div class="modal-body">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="input-group">
						<span class="input-group-btn">
							<span class="btn btn-default btn-file-avatar">
								Subir… <input type="file" accept="image/png, image/jpeg, image/gif" id="imgInp-avatar">
							</span>
						</span>
						<input id='urlname-avatar'type="text" class="form-control" readonly>
						<input @change="validateForm" v-model="record.picture" type="hidden" id="picture" required="required" class="form-control col-md-7 col-xs-12">
					</div>
					<div class="clearfix"></div>
					<img id='img-upload-avatar'/>
					<div class="clearfix"></div>
					<button id="clear" class="btn btn-default">Quitar</button>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>

<style>
.btn-file-avatar {
    position: relative;
    overflow: hidden;
}
.btn-file-avatar input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

#img-upload-avatar{
    width: 100%;
}
</style>

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
$(document).ready( function() {
	$(document).on('change', '.btn-file-avatar :file', function() {
		var input = $(this), label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
	});

	$('.btn-file-avatar :file').on('fileselect', function(event, label) {
		var input = $(this).parents('.input-group').find(':text'), log = label;
		if (input.length){ input.val(log); } 
		else { if(log) alert(log); }
	});
	
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {				
				pict = {
					name: input.files[0].name,
					size: input.files[0].size,
					data: e.target.result.split('base64,')[1],
					type: input.files[0].type,
				};
				api.post('/records/pictures', pict)
				.then(function (d){
					if(d.data > 0){
						api.put('/records/users/' + <?= $this->user->id; ?>, {
							id: <?= $this->user->id; ?>,
							avatar: d.data
						})
						.then(function (e){
							if(e.data > 0){
								/* $('#img-upload-avatar').attr('src', e.target.result); */
								location.reload();
							}
						})
						.catch(function (e) {
							console.log(e);
							alert('Hubo un error actualizando la imagen en el perfil.');
							$('#img-upload-avatar').attr('src','');
							$('#urlname-avatar').val('');
						});
					}
				})
				.catch(function (e) {
					alert('Hubo un error subiendo la imagen.');
					$('#img-upload-avatar').attr('src','');
					$('#urlname-avatar').val('');
				});
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#imgInp-avatar").change(function(){
		readURL(this);
	});
	
	$("#clear").click(function(){
		$('#img-upload-avatar').attr('src','');
		$('#urlname-avatar').val('');
		self.record.picture = 0;
	});
});
</script>

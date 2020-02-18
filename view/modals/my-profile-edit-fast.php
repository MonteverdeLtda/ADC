<?php 
	$formInfoBasic = $this->user->formInfoBasic();
	$formAccess = $this->user->formAccess();
	
?>

<div class="modal fade bs-my-profile-editor-fast-info-basic-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel">Modificar perfil</h4>
			</div>
			<div class="modal-body">
				<?= $formInfoBasic; ?>
			</div>
			<!-- // 
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
			-->
		</div>
	</div>
</div>

<div class="modal fade bs-my-profile-editor-fast-access-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel">Modificar Datos de Acceso</h4>
			</div>
			<div class="modal-body">
				<?= $formAccess; ?>
				<hr>
			</div>
		</div>
	</div>
</div>
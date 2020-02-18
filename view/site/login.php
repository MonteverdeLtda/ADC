<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

?>

<div>
	<a class="hiddenanchor" id="signup"></a>
	<a class="hiddenanchor" id="signin"></a>
	<div class="login_wrapper">
		<div class="animate form login_form">
			<section class="login_content">
				<h1><?= $title; ?></h1>
				<p>Al crear la cuenta en nuestro sitio confirmas haber leído la política de privacidad y aceptar los Términos y condiciones*</p>
				<?= $model->formulario; ?>
				<div class="clearfix"></div>
				<div class="separator">
					<p class="change_link">
						nuevo en el sitio?
						<a href="#signup" class="to_register"> Crear una cuenta </a>
					</p>
					<div class="clearfix"></div>
					<br />
					<div>
						<!-- // <h1><i class="fa fa-paw"></i> C&CMS </h1> -->
						<!-- // <p><?= ControladorBase::PowerBy(); ?>. Privacy and Terms</p> -->
					</div>
				</div>
			</section>
		</div>
		
		<div id="register" class="animate form registration_form">
			<section class="login_content">
				<h1>Crear Cuenta</h1>
				<p>Al pulsar en el botón confirmas haber leído la política de privacidad y aceptas los términos y condiciones.</p>
				<?= $register->formulario; ?>
					<div class="clearfix"></div>
					<div class="separator">
						<p class="change_link">
							¿Ya tienes cuenta?
							<a href="#signin" class="to_register"> Ingresar </a>
						</p>
						<div class="clearfix"></div>
						<br />
						<div>
							<!-- // <h1><i class="fa fa-paw"></i> C&CMS </h1> -->
							<!-- // <p><?= ControladorBase::PowerBy(); ?>. Privacy and Terms</p> -->
						</div>
					</div>
			</section>
        </div>
	</div>
</div>
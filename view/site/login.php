<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/ 
?>
<style>
.register {
    /*background: -webkit-linear-gradient(left,  #1143a6, #00c6ff);*/
	background: -webkit-linear-gradient(left, #6ba74c, #d8e9cf);
    /*margin-top: 3%;
    padding: 3%;
	margin: 0;*/
    padding: 3%;
    height: calc(200vh);
}
.register-right {
	
    background: #f8f9fa;
    border-top-left-radius: 25% 40%;
    border-bottom-left-radius: 25% 40%;
	display: flex;
}

.register-left img {
    margin-top: 15%;
    margin-bottom: 5%;
    width: 25%;
    -webkit-animation: mover 2s infinite alternate;
    animation: mover 1s infinite alternate;
}

.login {
	overload: hidden;
}
.login_content {
	text-shadow: none;
}
</style>
<div class="register">
	<div>
		<a class="hiddenanchor" id="signup"></a>
		<a class="hiddenanchor" id="signin"></a>
		<div class="login_wrapper">
			<div class="animate form login_form">
				<section class="login_content">
					<div class="col-md-12">
						<img src="/public/assets/logo-w-monteverde-280x145.png" alt="" />
						<h3>Bienvenido(a)</h3>
						<p>
							Panel Clientes en donde usted puede acceder a información de Monteverde LTDA. o Fundacion Monteverde, sólo debe ingresar su RUT sin puntos Ej:. 12345678-K y su contraseña de acceso , si ha olvidado su contraseña dirijáse al menú inferior click en "Recuperar Contraseña", si no se ha registrado aún click en Registrarse."
						</p>
					</div>
					<!-- // <p>*</p>-->
					<?= $model->formulario; ?>
					<div class="clearfix"></div>
					<div class="separator">
						<p class="change_link"> 
							nuevo en el sitio? <a href="#signup" class="to_register"> Crear una cuenta </a>
							<br> <a href="#" class="to_register"> Recuperar contraseña </a>
						</p>
						<div class="clearfix"></div>
						<br />
						<div>
							<!-- // <h1><i class="fa fa-paw"></i> C&CMS </h1> -->
							<p><?= ControladorBase::PowerBy(); ?>. </p> 
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
								<!-- // <h1><i class="fa fa-paw"></i> C&CMS </h1>
								<!-- // <p><?= ControladorBase::PowerBy(); ?>. Privacy and Terms</p> -->
							</div>
						</div>
				</section>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

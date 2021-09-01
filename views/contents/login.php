
<div class="page-brand-info">
	<div class="w-100 ml-5">
		<div class="brand"> 
			<img class="brand-img" src="<?php echo SERVER_URL ?>assets/images/logo-blanco.png" alt="..."> 
		</div>
		<p class="font-size-20"><?php echo NOMBRE_PROYECTO; ?></p>
	</div>
</div>
<div class="loginColumns flex-container center text-center ">
	<div class="mx-auto">
		<h1 class="logo-name">Inicio de Sesión</h1>
	</div>
	<h3 class="mx-auto">Bienvenido</h3>
	<form action="Home/login/"  method="post" class="Form_login top15 w-100">
		<div class="form-group">
			<input required="" placeholder="Username" name="user" id="user" class="form-control" type="text">
		</div>
		<div class="form-group">
			<input required="" placeholder="Password" name="password" id="password" class="form-control" type="password">
		</div>
		<button class="btn aqua block full-width bottom15" id="login" type="submit">Iniciar Sesión</button>
		<a href="<?php echo SERVER_URL ?>forgotPassword/""><small>Olvidó su contraseña?</small></a>
		<div class="message"></div>
	</form>
	<p class=" copyR"> <small>Artias-Soft &copy; <?php echo date('Y'); ?></small> </p>
</div>


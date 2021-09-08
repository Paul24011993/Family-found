
<div class="container d-flex align-items-center justify-content-center h-100 ">
    <div class="row align-items-center">
        <div class="col-md-12">
            <div class="tab-content">
                <div class="widgets-container">
                    <h2 class="font-bold text-center">Ingrese su nueva clave</h2>
                    <p> Su contraseña debe cumplir con los siguientes parámetros: </p>
                    <ul class="params_checkout">
                        <li> <h6 class="m-0">Mínimo 8 caracteres</h6> </li>
                        <li> <h6 class="m-0">Una letra mayúscula</h6> </li>
                        <li> <h6 class="m-0">Una letra minúscula</h6> </li>
                        <li> <h6 class="m-0">Un caracter numérico</h6> </li>
                        <li> <h6 class="m-0">Un caracter especial (!@#$&*)</h6> </li>
                    </ul>
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="" class="Form_change_password top15" autocomplete="off">                                    
                            <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <div class="input-group mb-5">
                                        <input class="form-control m-t-xxs" name="password" id="password" placeholder="Contraseña" type="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="repeat_password">Repita su Contraseña</label>
                                    <div class="input-group mb-5">
                                        <input class="form-control m-t-xxs" name="repeat_password" id="repeat_password" placeholder="Repita su Contraseña" type="password">
                                    </div>
                                </div>
                                
                                <button class="btn aqua block bottom15 has-spinner" type="submit">Enviar</button>
                                <a href="<?php echo SERVER_URL ?>" class="btn aqua btn-outline pull-right ">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 login-copyright"> <strong>Copyright</strong> Artias Soft Company &copy; <?php echo date('Y'); ?> </div>
        </div>
    </div>
</div>

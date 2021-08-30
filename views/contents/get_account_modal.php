<?php

if ( ! defined( 'SERVER_API' ) ) {
	define( 'SERVER_API', 'http://desarrollo.nacion-digital.com/panel/serverFamilyFoud/' );
}


 //define('SERVER_API', 'http://desarrollo.nacion-digital.com/panel/serverFamilyFoud/');
	//obtener los socios.
	$jsondata_accounts_banks = file_get_contents(SERVER_API . 'BankAccounts/get_data_accounts_banks/'.$_REQUEST['id']);
	$datosdata_accounts_banks = json_decode($jsondata_accounts_banks );
	$data_accounts_banks = $datosdata_accounts_banks->data;
    //var_dump($data_accounts_banks);
    //CARGAR TIPO DE ENTIDADES BANCARIAS
	$json_type_bank = file_get_contents(SERVER_API . 'BankAccounts/get_type_banks/');
	$data_type_bank = json_decode($json_type_bank );
	$type_bank = $data_type_bank->data;

    //CARGAR TIPO DE CUENTAS BANCARIAS
	$json_type_accounts = file_get_contents(SERVER_API . 'BankAccounts/get_type_accounts/');
	$data_type_accounts = json_decode($json_type_accounts );
	$type_accounts = $data_type_accounts->data;

?>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="../assets/js/send_ajax.js"></script>
		<!-- Load main function ajax  -->
		<script src="../assets/js/main_function_ajax.js"></script>
        <script src="../assets/js/vendor/select2.min.js"></script>
        <script src="../assets/js/sweetalert2.min.js"></script>

<script>
    (function($) {
	$('.select2').select2();
})(jQuery);
</script>

<div class="wrapper-content ">
    <div class="row">
        <div class="row">
            <form action="BankAccounts/updateAccount/" method="POST" data-form="update" class="FormularioAjax form-horizontal" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo $data_accounts_banks->CUE_ID; ?>" name="CUE_ID">
                <div class="col-lg-12 top20 bottom20" id="content_form_account">
                    <div class="widgets-container">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Institución Financiera</label>
                            <div class="col-sm-10">
                                <select class="form-control bottom15 select2" name="bank" id="bank" required>
                                    <option value="<?php echo $data_accounts_banks->BAN_ID ?>" selected><?php echo $data_accounts_banks->BAN_DESCRIPCION ?></option>
                                    <?php foreach($type_bank as $type): 
                                        //CARGAR BANCOS
                                        $json_bank = file_get_contents(SERVER_API . 'BankAccounts/get_banks/'.$type->TIF_ID);
                                        $data_bank = json_decode($json_bank );
                                        $banks = $data_bank->data;
                                        ?>
                                        <optgroup label="<?php echo $type->TIF_DESCRIPCION ?>">
                                            <?php foreach($banks as $bank): ?>
                                                <option value="<?php echo $bank->BAN_ID ?>"><?php echo $bank->BAN_DESCRIPCION ?></option>
                                                <?php endforeach; ?>
                                            </optgroup>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tipo de Cuenta</label>
                            <div class="col-sm-10">
                                <select class="form-control bottom15" name="typeAccount" id="typeAccount" required>
                                    <option value="<?php echo $data_accounts_banks->TIP_ID ?>" selected><?php echo $data_accounts_banks->TIP_DESCRIPCION ?></option>
                                    <option value="0" >Seleccione</option>
                                    <?php foreach($type_accounts as $type_account): ?>
                                    <option value="<?php echo $type_account->TIP_ID ?>"><?php echo $type_account->TIP_DESCRIPCION ?></option>
                                        <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Número de Cuenta</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="numberAccount" id="numberAccount" value="<?php echo $data_accounts_banks->CUE_NUMERO_CUENTA ?>" required>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Estado</label>
                            <div class="col-sm-10">
                                <select class="form-control bottom15" name="StatusAccount" id="StatusAccount" required>
                                    <option value="<?php echo $data_accounts_banks->CUE_ID ?>" selected><?php echo ($data_accounts_banks->CUE_ESTADO == 1)? 'AUTORIZADO' : 'NO AUTORIZADO' ?></option>
                                    <?php if($data_accounts_banks->CUE_ESTADO == 1): ?>
                                        <option value="0">NO AUTORIZADO</option>
                                    <?php else: ?>
                                        <option value="1">Autorizado</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button class="btn aqua" type="submit">Continuar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="RespuestaAjax"></div>
    </div>
</div>	


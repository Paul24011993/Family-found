$('document').ready(function (e) {

	resourceAddress.hash();
	let path = webAddress.resourcePath;
	let path_separated = path.split('/');

	$("#id_permissions").val(path_separated[3]);

	//Load data table profiles
	load_profiles_update();

	// check all_add
	check_permissions(['all_add', 'all_mod', 'all_del', 'all_ver', 'all_exp'], ['ck', 'ck1', 'ck2', 'ck3', 'ck4'])

	let checkbox = $('input[type=checkbox]');

	$(checkbox).each(function (index) {
		if ($(this).val() == 'add_Grupos_de_Socios' || $(this).val() == 'mod_Grupos_de_Socios' || $(this).val() == 'del_Grupos_de_Socios' || $(this).val() == 'exp_Grupos_de_Socios'){
			//console.log($(this).val());
		$(this).attr('disabled', true);
	}
	});

});

// Cargar desde la base de datos el menu y submenu del perfil seleccionado
function load_profiles_update() {
	var id_permissions,
		element = $('#id_permissions');
	if (element != null) {
		id_permissions = element.val();
	}
	else {
		id_permissions = 0;
	}

	var request = new XMLHttpRequest();
	request.open("GET", SERVER_API + 'Profiles/get_main_menu/', false);
	request.send(null);
	var json = JSON.parse(request.responseText);


	var request2 = new XMLHttpRequest();
	request2.open("GET", SERVER_API + 'Profiles/updateProfile/' + id_permissions + '/', false);
	request2.send(null);
	var json2 = JSON.parse(request2.responseText);
	
	var data_server_profile = json2.permissions.PER_DESCRIPCION;
	//console.log(json2);

	var authorisationList = new Array();
	var checked_add = '';
	var checked_mod = '';
	var checked_del = '';
	var checked_ver = '';
	var checked_exp = '';

	$.each(json.data.data.menu, function (i, auth) {

		authorisationList = 
		`<tr class="border_main_menu">
			<td colspan="6" data-toggle="collapse" data-target=".demo${auth.MEN_ID}">
				<span class="${auth.MEN_ICONO}"></span> 
				<b>${auth.MEN_DESCRIPCION}</b>
			</td>
		</tr>`;

		$.each(auth.submenu, function (j, mangoServ) {

			if (element != null) {

				var sub_id = mangoServ.SUB_DESCRIPCION;
				var res1 = sub_id.replace(" ", "_");
				var res = res1.replace(" ", "_");

				// Verificar si existe el permiso enla base de datos
				if (data_server_profile.indexOf('add_' + res) !== -1) {
					checked_add = 'checked';

				} else {
					// Only proforms and certificated
					$('.table').on('draw.dt', function () {
						$('.add_' + res).addClass('d-none');
					});
					//***********************************

					$('.add_' + res).remove();
					checked_add = '';
				}

				if (data_server_profile.indexOf('mod_' + res) !== -1) {
					checked_mod = 'checked';
				} else {
					$('.table').on('draw.dt', function () {
						$('.mod_' + res).addClass('d-none');
					});
					checked_mod = '';
				}

				if (data_server_profile.indexOf('del_' + res) !== -1) {
					checked_del = 'checked';
				} else {
					$('.table').on('draw.dt', function () {
						$('.del_' + res).addClass('d-none');
					})
					checked_del = '';
				}

				if (data_server_profile.indexOf('ver_' + res) !== -1) {
					checked_ver = 'checked';
				} else {
					$('.table').on('draw.dt', function () {
						$('.ver_' + res).addClass('d-none');
					})
					checked_ver = '';
				}

				if (data_server_profile.indexOf('exp_' + res) !== -1) {
					checked_exp = 'checked';
				} else {
					$('.table').on('draw.dt', function () {
						$('.exp_' + res).addClass('d-none');
					})
					checked_exp = '';
				}

				authorisationList += '<tr>' +
					'<td class="hiddenRow">' +
					'<div class="collapse ml-5 demo' + auth.MEN_ID + ' in"><i>' + mangoServ.SUB_DESCRIPCION + '</i></div>' +
					'</td>' +
					'<td class="hiddenRow text-center">' +
					'<div class="collapse demo' + auth.MEN_ID + ' in"><input ' + checked_add + ' type="checkbox" name="permisos[]" value="add_' + res + '" class="ck"></div>' +
					'</td>' +
					'<td class="hiddenRow text-center">' +
					'<div class="collapse demo' + auth.MEN_ID + ' in"><input ' + checked_mod + ' type="checkbox" name="permisos[]" value="mod_' + res + '" class="ck1"></div>' +
					'</td>' +
					'<td class="hiddenRow text-center">' +
					'<div class="collapse demo' + auth.MEN_ID + ' in"><input ' + checked_del + ' type="checkbox" name="permisos[]" value="del_' + res + '" class="ck2"></div>' +
					'</td>' +
					'<td class="hiddenRow text-center">' +
					'<div class="collapse demo' + auth.MEN_ID + ' in"><input ' + checked_ver + ' type="checkbox" name="permisos[]" value="ver_' + res + '" class="ck3"></div>' +
					'</td>' +
					'<td class="hiddenRow text-center">' +
					'<div class="collapse demo' + auth.MEN_ID + ' in"><input ' + checked_exp + ' type="checkbox" name="permisos[]" value="exp_' + res + '" class="ck4"></div>' +
					'</td>' +
					'</tr>';
			}
		});

		$(authorisationList).appendTo('#menu_profiles_update'); //.append(mangoServiceList);
	});
}

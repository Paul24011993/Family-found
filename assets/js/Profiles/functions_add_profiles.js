$('document').ready(function (e) {

	// check all_add
	check_permissions(['all_add', 'all_mod', 'all_del', 'all_ver', 'all_exp'], ['ck', 'ck1', 'ck2', 'ck3', 'ck4'])

	let checkbox = $('input[type=checkbox]');

	$(checkbox).each(function (index) {
		if ($(this).val() == 'add_Grupos_de_Socios' || $(this).val() == 'mod_Grupos_de_Socios' || $(this).val() == 'del_Grupos_de_Socios' || $(this).val() == 'exp_Grupos_de_Socios') {
			//console.log($(this).val());
			$(this).attr('disabled', true);
		}
	});

	// Cargar el menu y submenu para crear perfiles
		$.ajax({
			url: SERVER_API + 'Profiles/get_main_menu/',
			type: 'GET',
			success: function (response) {
				let jsons = JSON.parse(response)
				let template = '';
				//console.log(response);
				jsons.data.data.menu.forEach(json => {
					template += `<tr class="border_main_menu">
									<td colspan="6" data-toggle="collapse" data-target=".demo${json.MEN_ID}">
										<span class="${json.MEN_ICONO }"></span> 
										<b class="cursor-p">${json.MEN_DESCRIPCION }</b>
									</td>
								</tr>`;
					json.submenu.forEach(submenus => {
						var sub_id = submenus.SUB_DESCRIPCION;
						var res1 = sub_id.replace(" ", "_");
						var res = res1.replace(" ", "_");
						template += 
						`<tr>
							<td class="hiddenRow">
								<div class="collapse in ml-5 demo${json.MEN_ID}">
									<i>${submenus.SUB_DESCRIPCION}</i>
									</div>
								</td>
							<td class="hiddenRow text-center">
								<div class="collapse in demo${json.MEN_ID}">
									<input type="checkbox" name="permisos[]" value="add_${res}" class="ck">
								</div>
							</td>
							<td class="hiddenRow text-center">
								<div class="collapse in demo${json.MEN_ID}">
									<input type="checkbox" name="permisos[]" value="mod_${res}" class="ck1">
								</div>
							</td>
							<td class="hiddenRow text-center">
								<div class="collapse in demo${json.MEN_ID}">
									<input type="checkbox" name="permisos[]" value="del_${res}" class="ck2">
								</div>
							</td>
							<td class="hiddenRow text-center">
								<div class="collapse in demo${json.MEN_ID}">
									<input type="checkbox" name="permisos[]" value="ver_${res}" class="ck3">
								</div>
							</td>
							<td class="hiddenRow text-center">
								<div class="collapse in demo${json.MEN_ID}">
									<input type="checkbox" name="permisos[]" value="exp_${res}" class="ck4">
								</div>
							</td>
						</tr>`;
					})
				});
				$(template).appendTo('#menu_profiles'); //.append(mangoServiceList);
			}
		});
});

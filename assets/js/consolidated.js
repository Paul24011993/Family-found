$('document').ready(function() {
	
	//Load data table consolidated
	get_list_consolidated();
	
});

//*****lubricants *******/

var get_list_consolidated = function(){
	var tableConsolidated = $('#dt_data_consolidated').DataTable({
		//"destroy" : true,
		"ajax": SERVER_API + "Consolidateds/",
		"deferRender": true,
		"columns": [
	
			{ "data": "PROF_ORDEN"},
			{ "data": "PROF_FECHA_EMISION" },
			{ "data": "PROF_FECHA_SALIDA" },
			{ "data": "PROF_NUMERO_DOCUMENTO" },
			{ "data": "PROF_ORDEN_INTERNO" },
			{ "data": "PROF_CONDUCTOR" },
			{ "data": "PROF_DISCO" },
			{ "data": "PROF_PLACA" },
			{ "data": "MAR_DESCRIPCION" },
			{ "data": "PROF_KILOMETRAJE" },
			{ "data": "DETA_CANTIDAD" },
			{ "data": "DETALLE" },
			{ "data": "PRECIO_REPUESTOS" },
			{ "data": "PRECIO_LUBRICANTES" },
			{ "data": "PRECIO_MANO_OBRA" },
			{ "data": "IVA" },
			{ "data": "TOTAL" }
			
		],
		"language": idioma_espanol,
		dom: "<'row'<'form-inline' <'col-sm-offset-5 exp_Consolidados'B>>>"
		+"<'row' <'form-inline' <'col-sm-6 col-md-6 col-lg-6 text-left'l >"
		+" <'col-sm-6 col-md-6 col-lg-6'f>>>"
		+"<rt>"
		+"<'row'<'form-inline'"
		+"<'col-sm-12 col-md-12 col-lg-12'p>>>",//'Bfrtip',
		buttons: [{
			text: 'copy',
			extend: "copy",
			className: 'btn dark btn-outline'
			}, {
			text: 'csv',
			extend: "csv",
			className: 'btn aqua btn-outline'
			}, {
			text: 'excel',
			extend: "excelHtml5",
			className: 'btn aqua btn-outline'
			}, {
			text: 'pdf',
			extend: "pdf",
			className: 'btn yellow  btn-outline'
			}, {
			text: 'print',
			extend: "print",
			className: 'btn purple  btn-outline'
		}]
	});
	id_eliminar_lubricant("#dt_data_lubricants tbody", tableConsolidated);
	
}

//***** end lubricants *******/

var idioma_espanol = {
    "sProcessing":     "Procesando...",
	"sLengthMenu":     "Mostrar _MENU_ registros",
	"sZeroRecords":    "No se encontraron resultados",
	"sEmptyTable":     "Ningún dato disponible en esta tabla =(",
	"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
	"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	"sInfoPostFix":    "",
	"sSearch":         "Buscar:",
	"sUrl":            "",
	"sInfoThousands":  ",",
	"sLoadingRecords": "Cargando...",
	"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
	},
	"oAria": {
		"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		"sSortDescending": ": Activar para ordenar la columna de manera descendente"
	},
	"buttons": {
		"copy": "Copiar",
		"colvis": "Visibilidad"
	}
};

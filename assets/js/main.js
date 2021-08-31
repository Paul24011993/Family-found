(function($) {
    "use strict";
    // window scroll function

    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    // scroll top click function
    $('.scrollup').on('click', function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    // left  sidebar close function
    $('.library-menu').on('click', function(e) {
        $(this).toggleClass("active");
        $('body').toggleClass('page-sidebar-closed');
        e.preventDefault();
    });

    $('.nav-link').on('click', function() {
	console.log('si aqui es');
        if ($(this).parent("li").hasClass('open')) {
            $(this).parent("li").removeClass('open');
        } else {
            $('.nav-item').removeClass('open');
            $(this).parents("li").addClass('open');
        }
    });

    $('.menu-toggler.sidebar-toggler').on('click', function() {
        $('body').toggleClass('page-sidebar-closed');
    });

    // apply slimScroll 
    if ($('#business_efect').height()){
        $('body').addClass('profile2-page page-sidebar-closed page-sidebar-fixed  pace-done');
    }
    
    var scrollH = $(window).height();
    $('#right-sidebar .tab-content').slimScroll({
        height: scrollH - 45
    });
    $('.page-sidebar-fixed .page-sidebar-menu').slimScroll({
        height: scrollH - 45
    });
   // console.log(scrollH - 45);

    // sidebar search click
    $('.sidebar-search .submit, .sidebar-search .remove').on('click', function() {
        if ($('body').hasClass('page-sidebar-closed')) {
            $('.sidebar-search').toggleClass('open');
        }
    });

    // ibox tools close button 
    $('.ibox-tools .close-link').on('click', function() {
        $(this).parents(".ibox").hide();
    });

    // apply tooltip
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();

    // header expanded on click
    $(".search-form .input-group .form-control").focus(function() {
            $(".page-header.navbar .search-form.search-form-expanded").addClass("open");
        })
        .focusout(function() {
            $(".page-header.navbar .search-form.search-form-expanded").removeClass("open");
        });

    //buscador del menu
    $('#card_result').hide();
    $('#search').keyup(function (params) {
        var value = $.trim($("#search").val());
        if (value.length === 0) {
            $('#card_result').hide();
        }
        if ($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: SERVER_API + 'Profiles/search_items_menu/',
                type: 'POST',
                data: { search },
                success: function (response) {

                    let items = JSON.parse(response);
                    let template = '';
                    items.data.forEach(item_data => {
                        //console.log(item_data);
                        template += `<li class="nav-item style_search_menu">
									<a class="nav-link" href="${SERVER_URL + item_data.SUB_LINK}">
										<span class="title">${item_data.SUB_DESCRIPCION}</span>
									</a>
								</li>`
                    });
                    $('#result-search').html(template);
                    $('#card_result').show();
                }
            })
        }
    })

    //cargar el menu
    $.ajax({
        url: SERVER_API + 'Home/get_main_menu/',
        type: 'GET',
        success: function (response) {
            let jsons = JSON.parse(response).data.menu;
            let template = '';
            //console.log(jsons);
            jsons.forEach(json => {
                template += `<li class="nav-item">
								<a class="nav-link nav-toggle" href="javascript:;">
									<i class="${json.MEN_ICONO}"></i>
									<span class="title">${json.MEN_DESCRIPCION}</span>
									<span class="arrow"></span>
								</a>
								<ul class="sub-menu" id="myTab">`
                    json.submenu.forEach(submenus => {
                        template += `<li class="nav-item">
                                        <a class="nav-link" href="${SERVER_URL + submenus.SUB_LINK}">${submenus.SUB_DESCRIPCION}</a>
                                    </li>`
                    })
                    template += `</ul>
							</li>`
            });

            $(template).appendTo('.page-sidebar-menu');

            // left sidebar togal
            $('.nav-link').on('click', function () {
                if ($(this).parent("li").hasClass('open')) {
                    $(this).parent("li").removeClass('open');
                } else {
                    $('.nav-item').removeClass('open');
                    $(this).parents("li").addClass('open');
                }
            });

            // add class active and open in menu sidebar 
            $('#item-home, .page-logo a').on('click', function (e) {
                $(this).parent("li").removeClass('open active');
                sessionStorage.setItem('activeTab', '');
            });

            $('li.nav-item ul.sub-menu li a').on('click', function (e) {
                $('#accordion li').removeClass('active');
                sessionStorage.setItem('activeTab', $(e.target).attr('href'));
            });

            var activeTab = sessionStorage.getItem('activeTab');

            if (activeTab) {
                $('#accordion li').removeClass('active');
                $('#myTab a[href="' + activeTab + '"]').parent().addClass('active');
                $('#myTab a[href="' + activeTab + '"]').parent().parent().parent().addClass('open active');
            }

        }
    });

    //validaciones en campos del formulario
    $(".only_letters").lettersOnly();
    $(".only-number").numbersOnly();
    $(".alpha_numeric").alphaNumericOnly();


})(jQuery);

// window resize
$(window).resize(function() {
    var scrollH = $(window).height();

    $('#right-sidebar .tab-content').slimScroll({
        height: scrollH - 45
    });
    $('.page-sidebar-fixed .page-sidebar-menu').slimScroll({
        height: scrollH - 45
    });

});

function encode_b64(str) {
    return btoa(btoa(btoa(str)));
}

function decode_b64(str) {
    return atob(atob(atob(str)));
}

function capitalizarPalabras(val) {
    return val.toLowerCase()
        .trim()
        .split(' ')
        .map(v => v[0].toUpperCase() + v.substr(1))
        .join(' ');
}

var idioma_espanol = {
    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla =(",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad"
    }
};

//obtener la ruta completa de la pagina actual
var webAddress = {};
var param_values = {};
var protocol = '';
var resourceAddress = {

    fullAddress: function () {
        var addressBar = window.location.href;
        if (addressBar != '' && addressBar != 'undefined') {
            webAddress['href'] = addressBar;
        }
    },
    protocol_identifier: function () {
        resourceAddress.fullAddress();

        protocol = window.location.protocol.replace(':', '');
        if (protocol != '' && protocol != 'undefined') {
            webAddress['protocol'] = protocol;
        }
    },
    domain: function () {
        resourceAddress.protocol_identifier();

        var domain = window.location.hostname;
        if (domain != '' && domain != 'undefined' && typeOfVar(domain) === 'string') {
            webAddress['domain'] = domain;
            var port = window.location.port;
            if ((port == '' || port == 'undefined') && typeOfVar(port) === 'string') {
                if (protocol == 'http') port = '80';
                if (protocol == 'https') port = '443';
            }
            webAddress['port'] = port;
        }
    },
    pathname: function () {
        resourceAddress.domain();

        var resourcePath = window.location.pathname;
        if (resourcePath != '' && resourcePath != 'undefined') {
            webAddress['resourcePath'] = resourcePath;
        }
    },
    params: function () {
        resourceAddress.pathname();

        var v_args = location.search.substring(1).split("&");

        if (v_args != '' && v_args != 'undefined')
            for (var i = 0; i < v_args.length; i++) {
                var pair = v_args[i].split("=");

                if (typeOfVar(pair) === 'array') {
                    param_values[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
                }
            }
        webAddress['params'] = param_values;
    },
    hash: function () {
        resourceAddress.params();

        var fragment = window.location.hash.substring(1);
        if (fragment != '' && fragment != 'undefined')
            webAddress['hash'] = fragment;
    }
};

function typeOfVar(obj) {
    return {}.toString.call(obj).split(' ')[1].slice(0, -1).toLowerCase();
}



function unserialize(serialize) {
    let obj = {};
    serialize = serialize.split('&');
    for (let i = 0; i < serialize.length; i++) {
        thisItem = serialize[i].split('=');
        obj[decodeURIComponent(thisItem[0])] = decodeURIComponent(thisItem[1]);
    };
    return obj;
};

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}

function view_all_permissions(permissions, get_function) {
    let id_profile = getCookie('id_profile');

    if (id_profile == "" || id_profile == null) {
        alert('Error con la petición');
    }

    $('.' + permissions).hide();
    $('.page-heading').hide();
    $('.wrapper-content').hide();
    
    $.ajax({
        url: SERVER_API + "Users/get_permissions_view/" + id_profile,
        beforeSend: function (objeto) {
            $(".page-content").append("<div id='loader' ><img src='" + SERVER_URL + "assets/images/ajax-loader.gif'></div>");
            $(".page-content").addClass("height_align");
        },
        success: function (data) {
            var data_server = $.parseJSON(data),
                per_description = data_server.permissions.PER_DESCRIPCION;
            console.log(per_description);

            //retorna -1 si el elemento no esta presente.
            if (per_description.indexOf(permissions[0]) == -1) {
                $('.' + permissions[0]).remove();
            } else {
                $('.' + permissions[0]).show();
            }

            if (per_description.indexOf(permissions[1]) == -1) {
                $('.' + permissions[1]).remove();
            } else {
                $('.' + permissions[1]).show();
            }

            if (per_description.indexOf(permissions[2]) == -1) {
                $('.' + permissions[2]).remove();
            } else {
                $('.' + permissions[2]).show();
            }

            if (per_description.indexOf(permissions[3]) == -1) {
                console.log('.' + permissions[3]);
                $('.' + permissions[3]).remove();
            } else {
                $('.' + permissions[3]).show();
            }

            if (per_description.indexOf(permissions[4]) == -1) {
                console.log('.' + permissions[4]);
                $('.' + permissions[4]).remove();
            } else {
                $('.' + permissions[4]).show();
            }

                if (per_description.indexOf(permissions[0]) == -1 && per_description.indexOf(permissions[1]) == -1) {
                        let permissions_html = `
                            <div class="middle-box text-center">
                                <h1 class="head">403</h1>
                                <h3 class="font-bold">Acceso denegado</h3>
                                <div class="error-desc">
                                    No tiene permisos para visualizar esta informacion si necesita accesos, por favor comuniquese con el administrador.
                                </div>
                            </div>`;

                        $('.page-content').html(permissions_html).fadeIn("slow");
                } else {
                    $(".page-content").removeClass("height_align");
                    $("#loader").html("");
                    $('.page-heading').show();
                    $('.wrapper-content').show();
                    get_function;
            }
        },
        error: function (response) {
            alert('error con la petición' + response);
        }
    })
}

function check_permissions(input_check, class_check){
    // check all_add
    $.each(input_check, function (index, value) {
        $('#' + input_check[index]).change(function () {
            var checkboxes = $('.' + class_check[index]);
            if ($(this).is(':checked')) {
                checkboxes.prop('checked', true);
            } else {
                checkboxes.prop('checked', false);
            }
        });
    });
}


// cargar datos en un select2 con ajax
function load_select_2(identifier, patch){
    $(identifier).select2({
        placeholder: 'SELECCIONE',
        ajax: {
            url: SERVER_API + patch,
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term // search term
                };
            },
            processResults: function (response) {
                console.log(response);
                return {
                    results: response
                };
            },
            cache: true
        }
    });
}

//Reiniciar un select2
function reset_select(id_selector) {
    $(id_selector).val('');
    $(id_selector).trigger('change');
}




window.onload = function () {

    var chart = new OrgChart(document.getElementById("main"), {
        template: "ula",
        layout: OrgChart.treeRightOffset,
        align: OrgChart.ORIENTATION,
        toolbar: {
            layout: true,
            zoom: true,
            fit: true,
            expandAll: true
        },
        nodeBinding: {
            field_0: "Title",
            field_1: "first_names",
            img_0: "Photo"
        },
        nodeMenu: {
            details: { text: "Details" },
            edit: { text: "Edit" },
            add: { text: "Add" },
            remove: { text: "Remove" }
        }
    });
    chart.on('init', function (sender) {
        sender.editUI.show(1);
    });

    chart.load(nodes);
};

$('document').ready(function (e) {

    view_all_permissions(['ver_Grupos_de_Socios', 'add_Grupos_de_Socios'], null);
    
    $.ajax({
        url: SERVER_API + 'Partners/groupPartners/',
        async: false,
        success: function (data) {
            members = $.parseJSON(data)
            //console.log(members);
            
            nodes = members;
        }
    })
});
   




/*


$('document').ready(function (e) {
    






    var members;
    $.ajax({
        url: SERVER_API + 'Partners/groupPartners/',
        async: false,
        success: function (data) {
            members = $.parseJSON(data)
            console.log(members);
        }
    })
    //SOC_ID,SOC_PATROCINADOR,SOC_NOMBRES
    for (var i = 0; i < members.data.length; i++) {
        var member = members.data[i];
        let nombre = capitalizarPalabras(member.SOC_NOMBRES.toLowerCase());
        let apellidos = member.SOC_APELLIDOS.toLowerCase();
        let imagen = member.SOC_IMAGEN;
        if (i == 0) {
            $("#mainContainer").append("<li title='" + nombre + "' id=" + member.SOC_ID + ">" + nombre + ' ' + apellidos + "</li>")
        } else {
            if ($('#pr_' + member.SOC_PATROCINADOR).length <= 0) {
                $('#' + member.SOC_PATROCINADOR).append("<ul id='pr_" + member.SOC_PATROCINADOR + "'><li title='" + nombre + "' id=" + member.SOC_ID + ">" + nombre + ' ' + capitalizarPalabras(apellidos) + "</li></ul>")
            } else {
                $('#pr_' + member.SOC_PATROCINADOR).append("<li title='" + nombre + "' id=" + member.SOC_ID + ">" + nombre + ' ' + capitalizarPalabras(apellidos) + "</li>")
            }
        }
    }


    var nodeTemplate = function (data) {
        //<span class="office">${data.office}</span>
        //<div class="content">${data.title}</div>
        return `
        <div class="title">${capitalizarPalabras(data.name)}</div>
      `;
    };

    var oc = $('#main').orgchart({
        'data': $('#mainContainer'),
        //'data': SERVER_API + 'Partners/groupPartners/',
        'nodeTemplate': nodeTemplate,
        'exportButton': true,
        'exportFilename': 'MyOrgChart',
        'verticalLevel': 3,
        'visibleLevel': 4,
        'pan': true,
        'chartClass': true,
        //'draggable':true,
        //'zoom': true,
        //'visibleLevel': 2,
        'nodeID': 'id',
        //'nodeTitle': 'name',
        //'nodeContent': 'title',
        'createNode': function ($node, data) {
            //console.log(data);
            $node.on('click', function (event) {
                //  console.log(data.name.split(' ').pop());
                //alert(data.name + data.title + data.id);
            });
            var secondMenuIcon = $('<i>', {
                'class': 'oci oci-info-circle second-menu-icon',
                click: function () {
                    $(this).siblings('.second-menu').toggle();
                    //alert('data ' + nodeID);
                }
            });
            var secondMenu = '<div class="second-menu"><img class="avatar" src="assets/images/uploads/' + data.img + '"></div>';
            //var secondMenu = '<div class="second-menu"><img class="avatar" src="https://dabeng.github.io/OrgChart/img/avatar/8.jpg"></div>';
            $node.append(secondMenuIcon).append(secondMenu);

        }
    });

    oc.$chartContainer.on('touchmove', function (event) {
        event.preventDefault();
    });


});*/
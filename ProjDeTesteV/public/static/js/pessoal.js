function pessoal() {
    var options = document.querySelectorAll("#menu li");
    for (var i = 0; i < options.length; i++)
        options[i].addEventListener("click", menuClick);
    var controls = document.querySelectorAll(".controls i");
    for (var x = 0; x < controls.length; x++)
        controls[x].addEventListener("click", parentSubmit);
    urlPage();
    cDialog();
    acords();
}

options = {
    "Conta":"conta",
    "Quotas":"quotas",
    "Eventos que participou":"eventos",
    "Noticias que gostou":"noticias",
    "Socios": 'socios',
    "Noticias": 'noticias',
    "Eventos Ativos": 'eventos'
}

function menuClick() {
    var url = location.origin + location.pathname;
    window.history.replaceState({}, document.title, url);
    var id = options[this.innerText];
    mainMenu(id)
}

function parentSubmit() {
    this.parentNode.submit();
}

function urlPage() {
    if (location.hash !== "") {
        var id = location.hash.replace('#', '');
        mainMenu(id)
    }
}

function mainMenu(id){
    document.getElementById(id).style.display = "block";
    //console.log("Id: "+id);
    for (var i in options) {
        if (options[i] !== id) {
            try {
                document.getElementById(options[i]).style.display = "none";
            }catch (e){
                console.log(e);
            }
        }
    }
}

function cDialog(){
    dialog = $( "#clonar-form" ).dialog({
        autoOpen: false,
        height: 200,
        width: 350,
        modal: true,
        buttons: {
            "Clonar": function () {
                $('#clonar').submit()
            },
            "Cancel": function() {
                dialog.dialog( "close" );
            }
        },
        closeOnEscape: true,
        draggable: false,
        hide: { effect: "fade", duration: 400 },
        show: { effect: "fade", duration: 800 }
    });
    $( ".clonar-btn" ).button().on( "click", function() {
        dialog.dialog( "open" );
        var id = $(this).parent().parent().attr('id');
        $("#eventoId").val(id);
    });
}

function acords(){
    $("#acordion-socios, #acordion-eventos").accordion({
        collapsible: true,
        icons:{
            header: "ui-icon-circle-arrow-e",
            activeHeader: "ui-icon-circle-arrow-s"
        }
    });
}
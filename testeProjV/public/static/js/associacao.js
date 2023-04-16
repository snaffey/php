function associacao() {
    galeria(false, true);
    menuLateral();
}
var i = 0;
function galeria(back=false, first=false){
    var url = location.pathname.split('/').filter(value => value !== "" && value !== " ");
    var root = url[0];
    var id = url[url.length - 1];
    var ftPath = location.origin+'/'+root+'/associacao/fotos/'+id;
    var homePath = location.origin+'/'+root;
    var error404Path =  homePath+'/404/';
    var error500Path =  homePath+'/500/';
    $.ajax({
        url: ftPath,
        contentType: "application/json",
        success: function(json){
            json = JSON.parse(json)
            var caminhos = json.caminhos;
            if (!first)
                if (back)
                    i--;
                else
                    i++;
            if (caminhos != undefined) {
                if (i >= caminhos.length)
                    i = 0;
                else if (i < 0)
                    i = caminhos.length - 1
                document.getElementById('img-assoc').src = caminhos[i];
            }
        }
    });
}

function menuLateral(){
    var links = document.getElementsByClassName('link')
    for(var i = 0; i <= links.length; i++)
        addClass(i)


    function addClass(id){
        setTimeout(function(){
            if(id > 0)
                if (links[id-1] !== undefined)
                    links[id-1].classList.remove('hover')
            if (links[id] !== undefined)
                links[id].classList.add('hover')
        }, id*750)
    }
}

function confirma(url) {
    var conf = confirm('Deseja mesmo apagar?');
    if (conf)
        location.href = url;
}

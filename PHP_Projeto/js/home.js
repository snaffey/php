window.onload = function () {
    // Get the element with id="details"
    document.getElementById('details').onclick = function () {
        var ajax;

        try {
            ajax = new XMLHttpRequest();
        } catch (e) {
            try {
                ajax = new ActiveXObject('Msxml2.XMLHTTP');
            } catch (e) {
                try {
                    ajax = new ActiveXObject('Microsoft.XMLHTTP');
                } catch (e) {
                    return false;
                }
            }
        }
        var resposta_conteudo = document.getElementById('conteudo');
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                try {
                    resposta_conteudo.innerHTML = ajax.responseText;
                } catch (e) {
                    alert(e.toString());
                }
            } //end if state
        }; // end onreadystatechange
        try {
            ajax.open('POST', './controlDetails.php', true);
        } catch (e) {
            alert(e.toString());
        }
        try {
            var id = $('#imovelId').text();
            ajax.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            ajax.send('id=' + id);
            //ajax.send("nome=sergio&idade=23");
        } catch (e) {
            alert(e.toString());
        }
    }; // end click
}; // end onloadad

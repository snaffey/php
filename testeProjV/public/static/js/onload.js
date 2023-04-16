window.onload = function () {
    /*
    * Tem de ser chamada primeiro porque a clearUrl limpa o url
    * apagando o hash
    * */
    //pessoal.js
    if (typeof pessoal == "function"){
        pessoal();
    }

    // main.js
    if (typeof main == "function") {
        main();
    }

    //associacao.js
    if (typeof associacao == "function"){
        associacao();
    }
}
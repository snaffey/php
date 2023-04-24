function main(){
    clearUrl();
    lang();
    langPut();
}
function clearUrl() {
    var url = location.origin + location.pathname;
    window.history.replaceState({}, document.title, url);
}

function lang(){
    var lang = document.getElementById('lang');
    lang.onchange=function () {
        console.log((this.checked === true)?'en':'pt')
        document.cookie = "lang="+((this.checked === true)?'en':'pt')+";path=/";
    }
}

function langPut(){
    var lang = getCookie('lang');
    document.getElementById('lang').checked = lang === 'en';
}


/*
* Tirada da net
* https://stackoverflow.com/questions/5968196/how-do-i-check-if-a-cookie-exists
* */
function getCookie( name ) {
    var dc,
        prefix,
        begin,
        end;

    dc = document.cookie;
    prefix = name + "=";
    begin = dc.indexOf("; " + prefix);
    end = dc.length; // default to end of the string

    // found, and not in first position
    if (begin !== -1) {
        // exclude the "; "
        begin += 2;
    } else {
        //see if cookie is in first position
        begin = dc.indexOf(prefix);
        // not found at all or found as a portion of another cookie name
        if (begin === -1 || begin !== 0 ) return null;
    }

    // if we find a ";" somewhere after the prefix position then "end" is that position,
    // otherwise it defaults to the end of the string
    if (dc.indexOf(";", begin) !== -1) {
        end = dc.indexOf(";", begin);
    }

    return decodeURI(dc.substring(begin + prefix.length, end) ).replace(/\"/g, '');
}

function fParentSubmit(obj) {
    obj.parentNode.submit();
}
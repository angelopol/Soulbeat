function setCookie(cname,cvalue,exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
  
function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
        c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
        }
    }
    return "";
}

async function UpdateAllCurrencys() {
    let DolarApi = await fetch('https://ve.dolarapi.com/v1/dolares/oficial').then(response => response.json());
    if(DolarApi.promedio != undefined){
        let currencys = document.querySelectorAll('.currency');
        let CookieSelection = getCookie('currency');
        if (CookieSelection == '') CookieSelection = '$';
        currencys.forEach(currency => {
            let CurrentSymbol = currency.getAttribute('SymbolId');
            CurrentSymbol = document.getElementById(CurrentSymbol);
            CurrentId = currency.getAttribute('CurrentId');
            CurrentId = document.getElementById(CurrentId);
            if(CurrentSymbol != null){
                if(CurrentSymbol.textContent == '$' && CookieSelection == 'Bs'){
                    currency.innerHTML = Math.round(DolarApi.promedio * currency.textContent);
                    CurrentSymbol.textContent = 'Bs';
                }
                if(CurrentSymbol.textContent == 'Bs' && CookieSelection == '$'){
                    currency.innerHTML = Math.round(currency.textContent / DolarApi.promedio);
                    CurrentSymbol.textContent = '$';
                }
                if(CurrentId != null){
                    CurrentId.innerHTML = CurrentSymbol.textContent;
                }
            }
        });
    }
}
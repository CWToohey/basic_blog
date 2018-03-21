function showMenu() {
    var menu = document.getElementById('menu');
    console.log("1: "+ menu.className+ " type: "+typeof(menu.className)+" len: "+menu.className.length);
    console.log(menu);
    if(menu.className == "showDiv") menu.className = "hideDiv"; else menu.className = "showDiv";
    console.log("2: "+menu.className);
}
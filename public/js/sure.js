function areYouSure() {
    var certain = prompt("Are you sure?", "N/Y");
    if(certain == null) return false;
    certain = certain.toUpperCase();
    return certain[0] == "Y";
}

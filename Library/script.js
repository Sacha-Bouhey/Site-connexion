function checkPasswordMatch() {
    var password = document.getElementsByName("password")[0].value;
    var passwordConf = document.getElementsByName("password_conf")[0].value;

    var notMatchingElement = document.getElementById("notmatching");

    if (password !== passwordConf) {
        notMatchingElement.innerHTML = "Passwords don't match";
        return false;
    } else {
        return true;
    }
}

function modifpage() {
    document.getElementById('profile').hidden = true;
    document.getElementById('modif').hidden = false;
}
function modifpagereverse() {
    document.getElementById('profile').hidden = false;
    document.getElementById('modif').hidden = true;
}
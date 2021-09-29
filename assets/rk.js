$(document).ready(function() {
    $('#PembacaForm').hide();
    $('input[type=radio][name=options]').change(function() {
        if (this.value == 'user') {
            $('#clientForm').show()
            $('#PembacaForm').hide()
        } else if (this.value == 'pembaca') {
            $('#clientForm').hide()
            $('#PembacaForm').show()
        }
    });
})

function Toggle() {
    var temp = document.getElementById("password");
    if (temp.type === "password") {
        temp.type = "text";
    } else {
        temp.type = "password";
    }
}
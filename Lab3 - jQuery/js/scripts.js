$(document).ready(function() {
    //get the key from php and store it
    var nonce;
    $.getJSON('keygen.php', function(data) {
        nonce = data.nonce;
        $('#key').val(nonce);
    });

    $('#loginButton').click(function(){
        var sha1 = new Hashes.SHA1;
        $.ajax({
            url: 'server.php',
            type: 'post',
            data: JSON.stringify({
                user: $('#username').val(),
                pass: sha1.hex(
                        sha1.hex($('#password').val()) +
                        $('#key').val()).toLowerCase(),
                key: $('#key').val()
            }),
            contentType: 'application/json; charset=utf-8',
            success: function(data) {
                if(data.code == 'OK') {
                    alert("Zalogowano poprawnie :)");
                }
                else{
                    alert("Niepoprawne dane :(")
                }
            }
        });

        //clear the password field
        $('#pass').val('');
        //get the next key
        $.getJSON('keygen.php', function(data) {
            nonce = data.nonce;
            $('#key').val(nonce);
        });
    });
});

$(document).ready(function(){

    $('.signupselector').hide();

    $('#signup-header').click(function(){
        event.preventDefault();
        $('.signupselector').show();
        $('.loginselector').hide();
        $('#signup-header').removeClass('selected');
        $('#login-header').addClass('selected');
    });

    $('#login-header').click(function(){
        event.preventDefault();
        $('.signupselector').hide();
        $('#signup-header').addClass('selected');
        $('#login-header').removeClass('selected');
        $('.loginselector').show();
    });

    $('button#login').click(function(){
        var username = $('form#signup').find('.loginselector input[type="username"]').val();
        var password = $('form#signup').find('.loginselector input[type="password"]').val();
        $.ajax({
            url: "handlers/login_handler.php",
            data:{  type:'login',
                    username:username,
                    password:password
                },
            type:'POST',
            dataType:'json',
            success: function(result){
                if(result.success == 1) {
                    window.location.href = '/project/project_homepage.php';
                }
                else if (result.success == 0) {
                    $('.error').show();
                }
                else {

                }
            }
        });
    });

    $('button#sign').click(function(){
        var username = $('form#signup').find('.signupselector input[type="username"]').val();
        var password = $('form#signup').find('.signupselector input[type="password"]').val();
        var firstname = $('form#signup').find('.signupselector input[type="firstname"]').val();
        var lastname = $('form#signup').find('.signupselector input[type="lastname"]').val();
        $.ajax({
            url: "handlers/login_handler.php",
            data:{  type:'signup',
                    username:username,
                    password:password,
                    firstname:firstname,
                    lastname:lastname
                },
            type:'POST',
            dataType:'json',
            success: function(result){
                if(result.success == 1) {
                        window.location.href = '/auctionsw/project_homepage.php';
                }
                else {

                }
            }
        });
    });

});

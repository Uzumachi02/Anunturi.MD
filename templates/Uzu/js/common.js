$(document).ready(function () {
    console.log('Ok');

    setActive();


    $('#login').click(function () {
        console.log('login');
        $('#spider').load('/templates/Uzu/login.php');
        return false;

    });

    $('#register').click(function () {
        console.log('login');
        $('#spider').load('/templates/Uzu/registration.php');
        return false;

    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $('#logout').click(function () {
        //console.log('logout');
        $.ajax({
            url: '/user/logout',
            success: function (res) {
                res =JSON.parse(res);

                if (Notice (res)) {
                    setTimeout(function () {
                        $(location).attr('href','/');
                    }, 2000);
                }
            }
        });
        return false;
    });

});

function setActive() {
    var url = location.pathname;
console.log('oeads');
    switch (url) {
        case '/':
            $('#home_page').addClass('active');
            break;
        case '/anunt/add':
            $('#add_page').addClass('active');
            break;
        case '/profile/view':
            $('#profile_page').addClass('active');
            break;
    }
}

function Notice (res) {
    var not = $('#notice');
    not.removeClass('notice-successe notice-error');
    not.hide();

    if (res[0] == 0) {
        not.addClass('notice-successe');
    } else {
        not.addClass('notice-error');
    }

    not.text(res[1]).show(100);
    setTimeout(function () {
        $('#notice').hide(100);
    }, 4000);

    if (res[0] == 0) {
        return true;
    }

    return false;
}


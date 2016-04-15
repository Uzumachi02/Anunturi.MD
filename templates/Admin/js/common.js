$(document).ready(function () {

    setActive();

    $('#remove_ajax').click(function () {

        if (confirm('Sinteti siguri ca doriti sa stergeti?')) {

            $.ajax({
                url: $(this).attr('href'),
                success: function (res) {
                    res = JSON.parse(res);

                    if (Notice(res)) {
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        }

        return false;
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

    switch (url) {
        case '/adminpanel':
            $('#stats').addClass('active');
            break;
        case '/adminpanel/anunts':
            $('#anunt').addClass('active');
            break;
        case '/adminpanel/users':
            $('#user').addClass('active');
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
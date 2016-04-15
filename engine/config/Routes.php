<?php
return array(

    '/anunt/([0-9]+)' => 'anunt/view/$1',
    '/anunt/edit/([0-9]+)' => 'anunt/edit/$1',
    '/anunt/save/([0-9]+)' => 'anunt/saveEditAjax/$1',
    '/anunt/remove/([0-9]+)' => 'anunt/removeAjax/$1',
    '/anunt/add' => 'anunt/add',
    '/findnews' => 'anunt/find',

    '/user/register' => 'user/registerAjax',
    '/user/login' => 'user/loginAjax',
    '/user/logout' => 'user/logoutAjax',

    '/profile/view/*' => 'profile/view/$1',
    '/profile/edit/*' => 'profile/edit/$1',
    '/profile/save/*' => 'profile/saveEditAjax/$1',
    '/profile/remove/([0-9]+)' => 'profile/removeAjax/$1',

    '/adminpanel/users' => 'admin/users',
    '/adminpanel/anunts' => 'admin/anunts',
    '/adminpanel' => 'admin/index',


    '/' => 'site/index',
    //'' => 'site/error',
);
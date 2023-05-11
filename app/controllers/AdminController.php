<?php

class AdminController extends Controller
{
    function adminAsistencia($f3)
    {

        // if (\Base::instance()->exists('POST.titulo')) {
        // }

        if ($f3->get('SESSION.user_id')) {

            $f3->set('tituloPagina', 'Panel de administración');
            echo \Template::instance()->render('../templates/layout/header-agenda.htm');
            echo \Template::instance()->render('Admin/admin.htm');
            echo \Template::instance()->render('../templates/layout/footer.htm');
        } else {
            $f3->reroute('/');
        }
    }
}

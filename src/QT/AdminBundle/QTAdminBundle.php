<?php

namespace QT\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class QTAdminBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle'; //QT extension du FOSUserBundle
    }
}

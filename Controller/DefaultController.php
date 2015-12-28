<?php

namespace Elpiafo\SwitchUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ElpiafoSwitchUserBundle:Default:index.html.twig');
    }
}

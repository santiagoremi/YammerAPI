<?php

namespace bluenove\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use bluenove\PlatformBundle\Entity\test2;
use bluenove\PlatformBundle\Repository\test2Repository;
use bluenove\PlatformBundle\Entity\test;
use bluenove\PlatformBundle\Repository\testRepository;
use bluenove\PlatformBundle\Entity\Users;
use bluenove\PlatformBundle\Repository\UsersRepository;

class DefaultController extends Controller {

    /**
     * Home
     *
     * @Route("/", name="home")
     */
    public function indexAction() {
        return $this->render('PlatformBundle:Default:index.html.twig');
    }
    

}

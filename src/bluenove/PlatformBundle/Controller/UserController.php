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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use bluenove\PlatformBundle\Entity\test2;
use bluenove\PlatformBundle\Repository\test2Repository;
use bluenove\PlatformBundle\Entity\test;
use bluenove\PlatformBundle\Repository\testRepository;
use bluenove\PlatformBundle\Entity\Users;
use bluenove\PlatformBundle\Repository\UsersRepository;

class UserController extends Controller {

    /**
     * 
     *
     * @Route("/show_users", name="display_users")
     */
    public function displayUsersAction() {

        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("PlatformBundle:Users")->findall();
        return $this->render('PlatformBundle:Default:users.html.twig', array('users' => $users));
    }

    /**
     * twig
     *
     * @Route("/users", name="load_users")
     * @Method ("POST")
     */
    public function loadUsersAction(Request $request) {

        $data = json_decode($request->getContent(), true);
        if ($data) {

            $em = $this->getDoctrine()->getManager();


            foreach ($data as $object) {

                $user = new Users();

                $users = $em->getRepository("PlatformBundle:Users")->findby(array('userId' => $object['id']));
                if ($users == NULL) {
                    $user->setUserId($object['id']);
                    $user->setName($object['full_name']);
                    $user->setEmail($object['email']);

                    if ($object['contact']['phone_numbers']) {
                        $phone_number = null;
                        foreach ($object['contact']['phone_numbers'] as $numbers) {
                            for ($index = 0; $index < count($numbers['number']); $index++) {
                                $phone_number .= $numbers['number'][$index];
                            }
                        }
                        $user->setPhoneNumbers($phone_number);
                    }

                    $user->setDepartement($object['department']);
                    $user->setJobTitle($object['job_title']);
                    $user->setNetworkName($object['network_name']);
                    $date = new \DateTime($object['activated_at']);
                    $user->setDateInscription($date);
                    $aDate = new \DateTime('0000-00-00 00:00:00');
                    $user->setDateLastPubli($aDate);



                    $em->persist($user);
                    $em->flush();
                }
            }

            return new Response(var_dump($data));
        }
    }

    /**
     * twig
     *
     * @Route("/users/{group_id}", name="load_users_by_groupes")
     * @Method ("POST")
     */
    public function loadUsersByGroupesAction(Request $request) {
        $data = json_decode($request->getContent(), true);
        $group_id = $request->get('group_id');

        if ($data) {

            $em = $this->getDoctrine()->getManager();
            $groupe = $em->getRepository("PlatformBundle:Groupe")->findby(array('idGroupe' => $group_id));

            $users = $em->getRepository("PlatformBundle:Users")->findall();
            foreach ($users as $user) {
                $user->setAppG(0);
                $em->persist($user);
            }

            if ($groupe) {

                $users_in_groupe = $groupe[0]->getUsers();
                $users_array = $users_in_groupe->toArray();

                if ($users_array != NULL) {

                    foreach ($users_array as $user_array) {
                        $user_array->setAppG(1);
                        $em->persist($user_array);
                    }

                    foreach ($data as $object) {
                        $user1 = $em->getRepository("PlatformBundle:Users")->findby(array('userId' => $object["id"]));
                        $test = $user1[0]->getAppG();

                        If ($test == 0) {
                            $groupe[0]->addUser($user1[0]);
                            $em->persist($groupe[0]);
                        }
                    }
                } else {

                    foreach ($data as $object) {
                        $user2 = $em->getRepository("PlatformBundle:Users")->findby(array('userId' => $object["id"]));
                        $groupe[0]->addUser($user2[0]);
                        $em->persist($groupe[0]);
                    }
                }
            }
            $em->flush();
            return new Response(var_dump($data));
        }
    }

    /**
     * 
     *
     * @Route("/summaryuserbydate", name="display_user_by_date")
     * @Template("PlatformBundle:Default:summaryUserByDate.html.twig")
     */
    public function displayUserByDateAction() {

        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("PlatformBundle:Users")->findall();


        return array(
            'users' => $users
        );
    }

    /**
     * twig
     *
     * @Route("users/usersbydate", name="user_by_date")
     *  @Method ("POST")
     */
    public function summaryUserByDateAction(Request $request) {

        $data = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();

//        $test = new test();
//        $test->setObject($data);
//        $em->persist($test);
//        $em->flush();


        if ($data) {
            $em = $this->getDoctrine()->getManager();
            $date_debut = new \DateTime($data[0] . "00:00:01");
            $date_fin = new \DateTime($data[1] . "23:59:59");
            $date = new \DateTime('0000-00-00 00:00:00');

            $users = $em->getRepository("PlatformBundle:Users")->findall();



            foreach ($users as $user) {
                $user->setNbTempLikes(0);
                $user->setNbTempPost(0);
                $user->setNbTempCom(0);
                $user->setDateLastPubliTemp($date);



                $messages = $em->getRepository("PlatformBundle:Messages")->findby(array('Users' => $user));
                if ($messages) {
                    foreach ($messages as $message) {
                        if ($message->getDateReception() >= $date_debut && $message->getDateReception() <= $date_fin) {

                            $user->setNbTempPost($user->getNbTempPost() + 1);

                            if ($message->getDateReception() > $user->getDateLastPubliTemp()) {
                                $user->setDateLastPubliTemp($message->getDateReception());
                            }

                            $likes = $em->getRepository("PlatformBundle:Likes")->findby(array('Messages' => $message));
                            foreach ($likes as $like) {
                                if ($like) {
                                    $user->setNbTempLikes($user->getNbTempLikes() + 1);
                                }
                            }
                        }
                    }
                }

                $commentaires = $em->getRepository("PlatformBundle:Commentaires")->findby(array('Users' => $user));
                if ($commentaires) {
                    foreach ($commentaires as $commentaire) {
                        if ($commentaire->getDateReception() >= $date_debut && $commentaire->getDateReception() <= $date_fin) {

                            $user->setNbTempCom($user->getNbTempCom() + 1);

                            if ($commentaire->getDateReception() > $user->getDateLastPubliTemp()) {
                                $user->setDateLastPubliTemp($commentaire->getDateReception());
                            }


                            $likes = $em->getRepository("PlatformBundle:Likes")->findby(array('Commentaires' => $commentaire));
                            foreach ($likes as $like) {
                                if ($like) {
                                    $user->setNbTempLikes($user->getNbTempLikes() + 1);
                                }
                            }
                        }
                    }
                }

                $em->persist($user);
                $em->flush();
            }
            return new Response(var_dump($data));
        }
    }

}

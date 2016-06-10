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
use bluenove\PlatformBundle\Entity\Groupe;
use bluenove\PlatformBundle\Entity\test;
use bluenove\PlatformBundle\Repository\GroupeRepository;

class GroupeController extends Controller {

    /**
     * 
     *
     * @Route("/show_groupes", name="display_groupes")
     * @Template("PlatformBundle:Default:groupes.html.twig")

     */
    public function displayGroupesAction() {

        $em = $this->getDoctrine()->getManager();
        $groupes = $em->getRepository("PlatformBundle:Groupe")->findall();
        $messages = $em->getRepository("PlatformBundle:Messages")->findall();
        $users = $em->getRepository("PlatformBundle:Users")->findall();
        $commentaires = $em->getRepository("PlatformBundle:Commentaires")->findall();

        foreach ($users as $user) {
            $user->setNbTempLikes(0);
            $user->setNbTempPost(0);
            $user->setNbTempCom(0);
            $em->persist($user);
            $em->flush();
        }
        $j = 0;
        $tab1 = [];
        $tab2 = [];

        foreach ($groupes as $groupe) {
            $tab1[$j] = $groupe->getIdGroupe();
            $tab2[$j] = $groupe->getIdLastMessage();
            $j++;
        }
        $groupes_id_json = json_encode($tab1);
        $new_message_id = json_encode($tab2);

        $i = 0;
        $tab = [];

        foreach ($messages as $message) {
            $tab[$i] = $message->getMessagesId();
            $i++;
        }
        foreach ($commentaires as $commentaire) {
            $tab[$i] = $commentaire->getIdCommentaire();
            $i++;
        }

        $message_id = json_encode($tab);
        return array(
            'new_message_id' => $new_message_id,
            'groupes_id_json' => $groupes_id_json,
            'messages' => $message_id,
            'groupes' => $groupes
        );
    }

    /**
     * 
     *
     * @Route("/summarygroupebydate/{groupe_id}", name="display_groupe_by_date")
     * @Template("PlatformBundle:Default:summaryByDate.html.twig")
     */
    public function displayGroupeByDateAction($groupe_id) {

        $em = $this->getDoctrine()->getManager();

        $groupe = $em->getRepository("PlatformBundle:Groupe")->findby(array('idGroupe' => $groupe_id));
        $users_in_groupe = $groupe[0]->getUsers();
        $users_array = $users_in_groupe->toArray();

        return array(
            'users' => $users_array,
            'groupe' => $groupe[0],
        );
    }

    /**
     * twig
     *
     * @Route("/groupes", name="load_groupes")
     * @Method ("POST")
     */
    public function loadGroupesAction(Request $request) {

        $data = json_decode($request->getContent(), true);
        if ($data) {

            $em = $this->getDoctrine()->getManager();

            foreach ($data as $object) {

                $groupes = $em->getRepository("PlatformBundle:Groupe")->findby(array('idGroupe' => $object["id"]));

                if ($groupes == NULL) {

                    $groupe = new Groupe();
                    $groupe->setIdGroupe($object['id']);
                    $groupe->setName($object['full_name']);
                    $groupe->setPrivacy($object['privacy']);
                    $groupe->setMembers($object['stats']['members']);
                    $groupe->setNbMembers($object['stats']['members']);
                    $aDate = new \DateTime('0000-00-00 00:00:00');
                    $groupe->setDateLastPubli($aDate);

                    $em->persist($groupe);
                    $em->flush();
                }
            }
            return new Response(var_dump($data));
        }
    }

    /**
     * twig
     *
     * @Route("/summarygroup/{groupe_id}", name="summary_groupe")
     * @Template("PlatformBundle:Default:summary.html.twig")
     */
    public function summaryGroupeAction($groupe_id) {

        $em = $this->getDoctrine()->getManager();

        $groupe = $em->getRepository("PlatformBundle:Groupe")->findby(array('idGroupe' => $groupe_id));
        $users_in_groupe = $groupe[0]->getUsers();
        $users_array = $users_in_groupe->toArray();
        $date = new \DateTime('0000-00-00 00:00:00');
        
        $test = $em->getRepository("PlatformBundle:test")->findall();
//        $test = new test();
//        $test->setObject($users_in_groupe);
//        $em->persist($test);
//        $em->flush();


        foreach ($users_array as $user_array) {
            $user_array->setNbTempLikes(0);
            $user_array->setNbTempPost(0);
            $user_array->setNbTempCom(0);
            $user_array->setDateLastPubliTemp($date);

            $likes = $em->getRepository("PlatformBundle:Likes")->findby(array('Users' => $user_array, 'Groupe' => $groupe[0]));
            foreach ($likes as $like) {
                if ($like) {
                    $user_array->setNbTempLikes($user_array->getNbTempLikes() + 1);
                }
            }

            $messages = $em->getRepository("PlatformBundle:Messages")->findby(array('Users' => $user_array, 'Groupe' => $groupe[0]));
            foreach ($messages as $message) {
                if ($message) {
                    $user_array->setNbTempPost($user_array->getNbTempPost() + 1);
                    if ($message->getDateReception() > $user_array->getDateLastPubliTemp()) {
                        $user_array->setDateLastPubliTemp($message->getDateReception());
                    }
                }
            }

            $commentaires = $em->getRepository("PlatformBundle:Commentaires")->findby(array('Users' => $user_array, 'Groupe' => $groupe[0]));
            foreach ($commentaires as $commentaire) {
                if ($commentaire) {
                    $user_array->setNbTempCom($user_array->getNbTempCom() + 1);

                    if ($commentaire->getDateReception() > $user_array->getDateLastPubliTemp()) {
                        $user_array->setDateLastPubliTemp($commentaire->getDateReception());
                    }
                }
            }

            $em->persist($user_array);
            $em->flush();
        }
        return array(
            'users' => $users_array,
            'groupe' => $groupe[0],
            'test' => $test,
        );
    }

    /**
     * twig
     *
     * @Route("/summarygroupbydate/{groupe_id}", name="summary_groupe_by_date")
     *  @Method ("POST")
     */
    public function summaryGroupByDateAction(Request $request) {

        $data = json_decode($request->getContent(), true);
        $groupe_id = $request->get('groupe_id');

        if ($data) {
            $em = $this->getDoctrine()->getManager();
            $date_debut = new \DateTime($data[0] . "00:00:01");
            $date_fin = new \DateTime($data[1] . "23:59:59");
            $date = new \DateTime('0000-00-00 00:00:00');

            $groupe = $em->getRepository("PlatformBundle:Groupe")->findby(array('idGroupe' => $groupe_id));
            $users_in_groupe = $groupe[0]->getUsers();
            $users_array = $users_in_groupe->toArray();


            foreach ($users_array as $user_array) {
                $user_array->setNbTempLikes(0);
                $user_array->setNbTempPost(0);
                $user_array->setNbTempCom(0);
                $user_array->setDateLastPubliTemp($date);

                $em->persist($user_array);
                $em->flush();

                $messages = $em->getRepository("PlatformBundle:Messages")->findby(array('Users' => $user_array, 'Groupe' => $groupe[0]));
                foreach ($messages as $message) {
                    if ($message->getDateReception() >= $date_debut && $message->getDateReception() <= $date_fin) {

                        $user_array->setNbTempPost($user_array->getNbTempPost() + 1);

                        if ($message->getDateReception() > $user_array->getDateLastPubliTemp()) {
                            $user_array->setDateLastPubliTemp($message->getDateReception());
                        }

                        $likes = $em->getRepository("PlatformBundle:Likes")->findby(array('Messages' => $message, 'Groupe' => $groupe[0]));
                        foreach ($likes as $like) {
                            if ($like) {
                                $user_array->setNbTempLikes($user_array->getNbTempLikes() + 1);
                            }
                        }
                    }
                }

                $commentaires = $em->getRepository("PlatformBundle:Commentaires")->findby(array('Users' => $user_array, 'Groupe' => $groupe[0]));
                foreach ($commentaires as $commentaire) {
                    if ($commentaire->getDateReception() >= $date_debut && $commentaire->getDateReception() <= $date_fin) {

                        $user_array->setNbTempCom($user_array->getNbTempCom() + 1);

                        if ($commentaire->getDateReception() > $user_array->getDateLastPubliTemp()) {
                            $user_array->setDateLastPubliTemp($commentaire->getDateReception());
                        }


                        $likes = $em->getRepository("PlatformBundle:Likes")->findby(array('Commentaires' => $commentaire, 'Groupe' => $groupe[0]));
                        foreach ($likes as $like) {
                            if ($like) {
                                $user_array->setNbTempLikes($user_array->getNbTempLikes() + 1);
                            }
                        }
                    }
                }

                $em->persist($user_array);
                $em->flush();
            }
            return $this->redirect($this->generateUrl('display_groupe_by_date', array('groupe_id' => $groupe_id)));
        }
    }

}

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
use bluenove\PlatformBundle\Entity\test;
use bluenove\PlatformBundle\Repository\testRepository;
use bluenove\PlatformBundle\Entity\Groupe;
use bluenove\PlatformBundle\Repository\GroupeRepository;
use bluenove\PlatformBundle\Entity\Messages;
use bluenove\PlatformBundle\Repository\MessagesRepository;
use bluenove\PlatformBundle\Entity\Commentaires;
use bluenove\PlatformBundle\Repository\CommentairesRepository;

class MessageController extends Controller {

    /**
     * 
     *
     * @Route("/show_messages", name="display_messages")
     * @Template("PlatformBundle:Default:messages.html.twig")
     */
    public function displayMessagesAction() {

        $em = $this->getDoctrine()->getManager();
        $messages = $em->getRepository("PlatformBundle:Messages")->findall();
//        $test = $em->getRepository("PlatformBundle:test")->findall();
        $Commentaires = $em->getRepository("PlatformBundle:Commentaires")->findall();

        foreach ($messages as $message) {
            $message->setNbCom(0);
            $message->setNbLikes(0);

            $likes = $em->getRepository("PlatformBundle:Likes")->findby(array('Messages' => $message));

            if ($likes) {
                foreach ($likes as $like) {
                    $nblike = $message->getNbLikes();
                    $message->setNbLikes($nblike + 1);
                }
            }

            $em->persist($message);
            $em->flush();
        }

        foreach ($Commentaires as $commentaire) {

            $message = $em->getRepository("PlatformBundle:Messages")->findby(array('messagesId' => $commentaire->getIdMessages()));
            if ($message) {
                $nbcom = $message[0]->getNbCom();
                $message[0]->setNbCom($nbcom + 1);
                $em->persist($message[0]);
                $em->flush();
            }
        }



        return array(
            'messages' => $messages,
//            'test' => $test
        );
    }

    /**
     * 
     *
     * @Route("/show_comment/{message_id}", name="display_comments_by_message")
     * @Template("PlatformBundle:Default:comments.html.twig")
     */
    public function displayCommentsByMessageAction($message_id) {

        $em = $this->getDoctrine()->getManager();
        $commentaires = $em->getRepository("PlatformBundle:Commentaires")->findby(array('idMessages' => $message_id));

        if ($commentaires) {
            foreach ($commentaires as $commentaire) {
                $commentaire->setNbLikes(0);

                $likes = $em->getRepository("PlatformBundle:Likes")->findby(array('Commentaires' => $commentaire));

                if ($likes) {
                    foreach ($likes as $like) {
                        $nblike = $commentaire->getNbLikes();
                        $commentaire->setNbLikes($nblike + 1);
                    }
                }

                $em->persist($commentaire);
            }
            $em->flush();
        }
        return array(
            'commentaires' => $commentaires,
//            'test' => $test
        );
    }

    /**
     * 
     *
     * @Route("/show_messages/{groupId}", name="display_messages_by_groupe")
     * @Template("PlatformBundle:Default:messages.html.twig")
     */
    public function displayMessagesByGroupeAction($groupId) {

        $em = $this->getDoctrine()->getManager();

        $groupe = $em->getRepository("PlatformBundle:Groupe")->findby(array('idGroupe' => $groupId));

        $messages = $em->getRepository("PlatformBundle:Messages")->findby(array('Groupe' => $groupe));
//        $test = $em->getRepository("PlatformBundle:test")->findall();
        $Commentaires = $em->getRepository("PlatformBundle:Commentaires")->findby(array('Groupe' => $groupe));

        foreach ($messages as $message) {
            $message->setNbCom(0);
            $message->setNbLikes(0);

            $likes = $em->getRepository("PlatformBundle:Likes")->findby(array('Messages' => $message));

            if ($likes) {
                foreach ($likes as $like) {
                    $nblike = $message->getNbLikes();
                    $message->setNbLikes($nblike + 1);
                }
            }

            $em->persist($message);
            $em->flush();
        }

        foreach ($Commentaires as $commentaire) {

            $message = $em->getRepository("PlatformBundle:Messages")->findby(array('messagesId' => $commentaire->getIdMessages()));
            if ($message) {
                $nbcom = $message[0]->getNbCom();
                $message[0]->setNbCom($nbcom + 1);
                $em->persist($message[0]);
                $em->flush();
            }
        }



        return array(
            'messages' => $messages,
//            'test' => $test
        );
    }

    /**
     * 
     *
     * @Route("/show_mandc_by_user_by_group/{userId}/{groupId}/", name="display_messages_and_comments_by_users_by_group")
     * @Template("PlatformBundle:Default:messagesandcommentsbyuser.html.twig")
     */
    public function displayMessagesAndCommentsByUserByGroupAction($userId, $groupId) {

        $em = $this->getDoctrine()->getManager();
        $tab = [];

        $groupe = $em->getRepository("PlatformBundle:Groupe")->findby(array('idGroupe' => $groupId));
        $user = $em->getRepository("PlatformBundle:Users")->findby(array('userId' => $userId));
        $messages = $em->getRepository("PlatformBundle:Messages")->findby(array('Groupe' => $groupe, 'Users' => $user));
//        $test = $em->getRepository("PlatformBundle:test")->findall();
        $Commentaires = $em->getRepository("PlatformBundle:Commentaires")->findby(array('Groupe' => $groupe, 'Users' => $user));

        if ($messages) {
            foreach ($messages as $message) {
                $message->setNbCom(0);
                $message->setNbLikes(0);

                $likes = $em->getRepository("PlatformBundle:Likes")->findby(array('Messages' => $message));

                if ($likes) {
                    foreach ($likes as $like) {
                        $nblike = $message->getNbLikes();
                        $message->setNbLikes($nblike + 1);
                    }
                }
                array_push($tab, $message);
                $em->persist($message);
            }
            $em->flush();
        }

        if ($Commentaires) {
            foreach ($Commentaires as $commentaire) {
                $commentaire->setNbLikes(0);

                $likes = $em->getRepository("PlatformBundle:Likes")->findby(array('Commentaires' => $commentaire));

                if ($likes) {
                    foreach ($likes as $like) {
                        $nblike = $commentaire->getNbLikes();
                        $commentaire->setNbLikes($nblike + 1);
                    }
                }
                array_push($tab, $commentaire);
                $em->persist($commentaire);

//                $message = $em->getRepository("PlatformBundle:Messages")->findby(array('messagesId' => $commentaire->getIdMessages()));
//                if ($message) {
//                    $nbcom = $message[0]->getNbCom();
//                    $message[0]->setNbCom($nbcom + 1);
//                    array_push($tab, $commentaire);
//                    $em->persist($message[0]);
//                    $em->flush();
//                }
            }
            $em->flush();
        }


        return array(
            'tabs' => $tab,
//            'test' => $test
        );
    }

    /**
     * 
     *
     * @Route("/show_mandc_by_user/{userId}/{groupId}/", name="display_messages_and_comments_by_users")
     * @Template("PlatformBundle:Default:messagesandcommentsbyuser.html.twig")
     */
    public function displayMessagesAndCommentsByUserAction($userId) {

        $em = $this->getDoctrine()->getManager();
        $tab = [];

//        $groupe = $em->getRepository("PlatformBundle:Groupe")->findby(array('idGroupe' => $groupId));
        $user = $em->getRepository("PlatformBundle:Users")->findby(array('userId' => $userId));
        $messages = $em->getRepository("PlatformBundle:Messages")->findby(array('Users' => $user));
//        $test = $em->getRepository("PlatformBundle:test")->findall();
        $Commentaires = $em->getRepository("PlatformBundle:Commentaires")->findby(array('Users' => $user));

        if ($messages) {
            foreach ($messages as $message) {
                $message->setNbCom(0);
                $message->setNbLikes(0);

                $likes = $em->getRepository("PlatformBundle:Likes")->findby(array('Messages' => $message));

                if ($likes) {
                    foreach ($likes as $like) {
                        $nblike = $message->getNbLikes();
                        $message->setNbLikes($nblike + 1);
                    }
                }
                array_push($tab, $message);
                $em->persist($message);
            }
            $em->flush();
        }

        if ($Commentaires) {
            foreach ($Commentaires as $commentaire) {
                $commentaire->setNbLikes(0);

                $likes = $em->getRepository("PlatformBundle:Likes")->findby(array('Commentaires' => $commentaire));

                if ($likes) {
                    foreach ($likes as $like) {
                        $nblike = $commentaire->getNbLikes();
                        $commentaire->setNbLikes($nblike + 1);
                    }
                }
                array_push($tab, $commentaire);
                $em->persist($commentaire);
//                $message = $em->getRepository("PlatformBundle:Messages")->findby(array('messagesId' => $commentaire->getIdMessages()));
//                if ($message) {
//                    $nbcom = $message[0]->getNbCom();
//                    $message[0]->setNbCom($nbcom + 1);
//                    $em->persist($message[0]);
//                    $em->flush();
//                }
            }
            $em->flush();
        }


        return array(
            'tabs' => $tab,
//            'test' => $test
        );
    }

    /**
     * twig
     *
     * @Route("/messages", name="load_messages")
     * @Method ("POST")
     */
    public function loadMessagesaction(Request $request) {

        $data = json_decode($request->getContent(), true);

        if ($data) {

            $em = $this->getDoctrine()->getManager();

            foreach ($data as $object) {

                $messages = $em->getRepository("PlatformBundle:Messages")->findby(array('messagesId' => $object['id']));
                $commentaires = $em->getRepository("PlatformBundle:Commentaires")->findby(array('idCommentaire' => $object['id']));


                if (($messages == NULL) && ($commentaires == NULL)) {

                    if ($object["replied_to_id"] == NULL) {

                        $message = new Messages();

                        $groupe = $em->getRepository("PlatformBundle:Groupe")->findby(array('idGroupe' => $object["group_created_id"]));
                        $user = $em->getRepository("PlatformBundle:Users")->findby(array('userId' => $object["sender_id"]));

                        if ($user) {
                            $message->setGroupe($groupe[0]);
                            $message->setUsers($user[0]);
                            $message->setMessagesId($object["id"]);
                            $message->setBody($object["content_excerpt"]);
                            $date = new \DateTime($object["created_at"]);
                            $message->setDateReception($date);
                            $message->setLink($object["web_url"]);

                            $post_groupe = $groupe[0]->getNbPost();
                            $groupe[0]->setNbPost($post_groupe + 1);

                            $post_user = $user[0]->getNbPost();
                            $user[0]->setNbPost($post_user + 1);

                            $publi_user = $user[0]->getNbPubli();
                            $user[0]->setNbPubli($publi_user + 1);


                            $last_publi_user = $user[0]->getDateLastPubli();
                            $last_publi_groupe = $groupe[0]->getDateLastPubli();

                            if ($date > $last_publi_user) {
                                $user[0]->setDateLastPubli($date);
                            }
                            if ($date > $last_publi_groupe) {
                                $groupe[0]->setDateLastPubli($date);
                                $groupe[0]->setidLastMessage($object["id"]);
                            }

                            $em->persist($message);
                            $em->flush();
                        } else {
                            $test = new test();
                            $test->setObject($object["sender_id"]);
                            $em->persist($test);
                            $em->flush();
                        }
                    } else {
                        $commentaire = new Commentaires();

                        $groupe = $em->getRepository("PlatformBundle:Groupe")->findby(array('idGroupe' => $object["group_id"]));
                        $user = $em->getRepository("PlatformBundle:Users")->findby(array('userId' => $object["sender_id"]));
                        if ($user) {
                            $commentaire->setGroupe($groupe[0]);
                            $commentaire->setUsers($user[0]);
                            $commentaire->setIdCommentaire($object["id"]);
                            $commentaire->setIdMessages($object["thread_id"]);
                            $date = new \DateTime($object["created_at"]);
                            $commentaire->setDateReception($date);

                            $commentaire->setBody($object["content_excerpt"]);


                            $com_groupe = $groupe[0]->getNbCom();
                            $groupe[0]->setNbCom($com_groupe + 1);

                            $com_user = $user[0]->getNbCom();
                            $user[0]->setNbCom($com_user + 1);

                            $publi_user = $user[0]->getNbPubli();
                            $user[0]->setNbPubli($publi_user + 1);

                            $last_publi_user = $user[0]->getDateLastPubli();
                            $last_publi_groupe = $groupe[0]->getDateLastPubli();

                            if ($date > $last_publi_user) {
                                $user[0]->setDateLastPubli($date);
                            }
                            if ($date > $last_publi_groupe) {
                                $groupe[0]->setDateLastPubli($date);
                                $groupe[0]->setidLastMessage($object["id"]);
                            }

                            $em->persist($commentaire);
                            $em->persist($user[0]);
                            $em->flush();
                        } else {
                            $test = new test();
                            $test->setObject($object["sender_id"]);
                            $em->persist($test);
                            $em->flush();
                        }
                    }
                }
            }
            return new Response(var_dump($data));
        }
    }

}

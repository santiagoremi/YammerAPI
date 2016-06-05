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
use bluenove\PlatformBundle\Entity\Likes;
use bluenove\PlatformBundle\Repository\LikesRepository;

class LikesController extends Controller {
//    /**
//     * 
//     *
//     * @Route("/show_likes", name="display_likes")
//     * @Template("PlatformBundle:Default:likes.html.twig")
//     */
//    public function displayLikesAction() {
//
//        $em = $this->getDoctrine()->getManager();
//        $messages = $em->getRepository("PlatformBundle:Messages")->findall();
//        $test = $em->getRepository("PlatformBundle:test")->findall();
//
//
//        return array(
//            'messages' => $messages,
//            'test' => $test
//        );
//    }

    /**
     * twig
     *
     * @Route("/likes", name="load_likes")
     * @Method ("POST")
     */
    public function loadLikesaction(Request $request) {

        $data = json_decode($request->getContent(), true);
        $message_id = $request->get('messages_id');

        if ($data) {

            $em = $this->getDoctrine()->getManager();


            foreach ($data as $object) {

                $message = $em->getRepository("PlatformBundle:Messages")->findby(array('messagesId' => $message_id));
                $commentaire = $em->getRepository("PlatformBundle:Commentaires")->findby(array('idCommentaire' => $message_id));
                $user = $em->getRepository("PlatformBundle:Users")->findby(array('name' => $object["full_name"]));

                if ($message) {
                    $likes = $em->getRepository("PlatformBundle:Likes")->findby(array('Messages' => $message[0], 'Users' => $user[0]));
                } else {
                    $likes = $em->getRepository("PlatformBundle:Likes")->findby(array('Commentaires' => $commentaire[0], 'Users' => $user[0]));
                }

                if ($likes == NULL) {

                    $like = new Likes();
                    $like->setUsers($user[0]);
                    if ($message) {
                        $like->setMessages($message[0]);
                        $groupe = $message[0]->getGroupe();
                    } else {
                        $like->setCommentaires($commentaire[0]);
                        $groupe = $commentaire[0]->getGroupe();
                    }


                    $like->setGroupe($groupe);

                    $groupe_like = $groupe->getNblikes();
                    $groupe->setNbLikes($groupe_like + 1);
                    $user_likes = $user[0]->getNblikes();
                    $user[0]->setNbLikes($user_likes + 1);


                    $em->persist($like);
                    $em->flush();
                }
            }
            return new Response(var_dump($message_id));
        }
        return new Response(var_dump($message_id));
    }

}

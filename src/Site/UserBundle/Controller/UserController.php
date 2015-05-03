<?php

namespace Site\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use AppBundle\Controller\AppController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Site\UserBundle\Entity\User;

use Site\UserBundle\Form\LoginType;
use Site\UserBundle\Form\RegisterType;

/**
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->has('id')) return $this->redirect($this->generateUrl('app_app_index'));

        $form = $this->createForm(new LoginType());

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $data = $form->getData();
                $user = $em->getRepository('UserBundle:User')->findOneBy(array('username' => $data['username'], 'password' => \sha1($data['password'])));
                if ($user) {
                    if ($user->getEnable()) {
                        if (!$user->getBan()) {
                            $user->setDateLastLogin(new \DateTime());
                            $em->merge($user);
                            $em->flush();
                            $session->set('id', $user->getId());
                            return $this->redirect($this->generateUrl('app_app_index'));
                        } else {
                            $session->getFlashBag()->add('error', 'Vous êtes banni !');
                        }
                    } else {
                        $session->getFlashBag()->add('error', 'Votre compte n\'est pas activé, merci de vérifier vos emails !');
                    }
                } else {
                    $session->getFlashBag()->add('error', 'Nom d\'utilisateur et/ou mot de passe incorrect !');
                }
            }
        }

        return array('form' => $form->createView());
    }

    /**
     * @Route("/register")
     * @Template()
     */
    public function registerAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->has('id')) return $this->redirect($this->generateUrl('app_app_index'));

        $user = new User();
        $form = $this->createForm(new RegisterType(), $user);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $usernameAlreadyExist = $em->getRepository('UserBundle:User')->findOneByUsername($data->getUsername());
                if (!$usernameAlreadyExist) {
                    $user->setPassword(\sha1($data->getPassword()));
                    $em->persist($user);
                    $em->flush();

                    // EMAIL
                    // $content = $this->renderView('UserBundle:Mail:register.html.twig', array('user' => $user, 'link' => $link));
                    // AppController::email('Confirmation de votre inscription', $content, $user);

                    $session->getFlashBag()->add('success', 'Vous venez de vous enregistrer avec succès !<br> Merci pour votre confiance');
                    $session->getFlashBag()->add('info', 'Vous venez de reçevoir un email pour confirmer votre compte et ainsi vous connecter');
                    return $this->redirect($this->generateUrl('app_app_index'));
                } else {
                    $session->getFlashBag()->add('error', 'Ce pseudo est déjà pris !');
                }
            }
        }

        return array('form' => $form->createView());
    }

    /**
     * @Route("/profile/{id}")
     * @Template()
     */
    public function profileAction(User $user)
    {
        return array('user' => $user);
    }

    /**
     * @Route("/logout")
     */
    public function logoutAction(Request $request)
    {
        $session = $request->getSession();
        $session->clear();

        return $this->redirect($this->generateUrl('app_app_index'));
    }
}

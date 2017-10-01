<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class AccountController
 * @package AppBundle\Controller
 *
 * @Route("account")
 */
class AccountController extends Controller
{
    /**
     * @Route("/edit", name="app_account_edit")
     * @Route("/edit/password", name="app_account_password")
     * @Route("/edit/users", name="app_account_users")
     * @Route("/create-user", name="app_account_add")
     * @param Request $request
     * @return RedirectResponse|null|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request)
    {

//        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof User) {
            return $this->redirectToRoute('fos_user_security_logout');
        }

        /** @var $userManager UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');

        $numberPage = 1;
        $arrShow = array(10, 20, 50, 100);  // CHOIX DU NOMBRE D AFFICHAGE PAR PAGE
        $limitPage = ($request->get('show') !== null && in_array($request->get('show'), $arrShow)) ? $request->get('show') : 10;


        $em = $this->getDoctrine()->getManager();
        $results = $em->getRepository('AppBundle:User')->findBy(
            array('creator' => $user),
            array('id' => 'DESC')
        );

        $users = $this->get('knp_paginator')->paginate(
            $results,
            $request->query->getInt('page', $numberPage),
            $limitPage
        );

        $form = $this->createForm(UserType::class, $user);
        $form->remove('plainPassword');
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $userManager->updateUser($user);
                $this->addFlash(
                    'success',
                    'Your changes were saved!'
                );
                return $this->redirectToRoute('app_account_edit', array(), 301);
            } else {
                $this->addFlash(
                    'success',
                    'Veuillez corriger les champs non valide'
                );
            }
        }
        /********  EditPassword ************/
        /** @var $formFactory FactoryInterface */
        $formFactoryPassword = $this->get('fos_user.change_password.form.factory');
        $formPassword = $formFactoryPassword->createForm();
        $form->setData($user);
        $formPassword->handleRequest($request);

        if ($formPassword->isSubmitted()) {
            if ($formPassword->isValid()) {
                $userManager->updateUser($user);
                $this->addFlash(
                    'success',
                    'Your changes were saved!'
                );
                return $this->redirectToRoute('app_account_password', array(), 301);

            } else {
                $this->addFlash(
                    'success',
                    'Veuillez corriger les champs non valide'
                );
            }
        }

        /********  Add USER ************/
        $userAdd = $userManager->createUser();
        //$userAdd = new User();
        $userAdd->setEnabled(true);
        $userAdd->setCreator($user);

        $formFactoryRegistration = $this->get('fos_user.registration.form.factory');
        $formAdd = $formFactoryRegistration->createForm();
        $formAdd->setData($userAdd);

        $formAdd->handleRequest($request);
        if ($formAdd->isSubmitted()) {

            if ($formAdd->isValid()) {
                $userManager->updateUser($userAdd);
                $this->addFlash(
                    'success',
                    'Your User were created!'
                );
                return $this->redirectToRoute('app_account_users', array(), 301);
            } else {
                $this->addFlash(
                    'success',
                    'Veuillez corriger les champs non valide'
                );
            }
        }
        return $this->render('AppBundle:Account:edit.profile.html.twig', array(// ...
            'form' => $form->createView(),
            'formPassword' => $formPassword->createView(),
            'formAdd' => $formAdd->createView(),
            'users' => $users,

        ));
    }

    /**
     * @Route("/password",name="app_account_password")
     * @param Request $request
     * @return RedirectResponse|null|\Symfony\Component\HttpFoundation\Response
     */
    public function editPasswordAction(Request $request)
    {

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.change_password.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }
        return $this->render('AppBundle:Account:edit.password.html.twig', array(// ...
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/check-username-or-email", name="app_user_check_username_or_email" ,options = {"expose"=true})
     * @param Request $request
     * @return Response
     */
    public function checkEmailValidAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
//            $em = $this->getDoctrine()->getManager();
            $usernameOrEmail = $request->get("user");
            $userManager = $this->container->get('fos_user.user_manager');
            $user = $userManager->findUserByUsernameOrEmail($usernameOrEmail);

            return new Response (json_encode(array('type' => "success",
                "response" => ($user === null) ? false : true,
                "message" => "OK")), 200,
                ['Content-Type' => 'application/json']
            );
        }

        return new Response (json_encode(array('type' => "error", response => false, "message" => "Error: isXmlHttpRequest")), 200,
            ['Content-Type' => 'application/json']
        );

    }


    /**
     * @Route("/remove", name="app_account_remove",  options = {"expose"=true})
     * @param Request $request
     * @return Response
     */
    public
    function removeAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $id = $request->get('id');
            if (!empty($id)) {
                /** @var User $user */
                $user = $em->getRepository('AppBundle:User')->find($id);

                if ($user === null) {
                    return new Response(json_encode(array(
                            "result" => "error",
                            "message" => "L'utilisateur n'a pas été trouvé.")
                    ), 200, ['Content-Type' => 'application/json']);
                }
                $message = "L'utilisateur (<b>" . $user->getLastName() . " " . $user->getFirstName() . "</b>) a été supprimé(e).";
                $em->remove($user);
                //$em->flush();
                return new Response(json_encode(array(
                        "result" => "success",
                        "message" => $message)
                ), 200, ['Content-Type' => 'application/json']);
            }
            $message = "ID User is empty ";

        } else {
            $message = "Error: isXmlHttpRequest";
        }
        return new response (json_encode(array('result' => 'error', "message" => $message)), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/enable", name="app_account_state",  options = {"expose"=true})
     * @param Request $request
     * @return Response
     */
    public
    function enableAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $id = $request->get('id');
            $enable = $request->get('enable') == "false" ? false : true;
            if (!empty($id) && $enable !== null) {
                /** @var User $user */
                $user = $em->getRepository('AppBundle:User')->find($id);

                if ($user === null) {
                    return new Response(json_encode(array(
                            "result" => "error",
                            "message" => "L'utilisateur n'a pas été trouvé.")
                    ), 200, ['Content-Type' => 'application/json']);
                }
                $user->setEnabled($enable);

                $message = "Le compte  (<b>" . $user->getUsername() . "</b>) a été  ";
                $message .= $user->isEnabled() === true ? "activé." : "désactivé.";

                $em->flush();
                return new Response(json_encode(array(
                        "result" => "success",
                        'enable' => $user->isEnabled(),
                        "message" => $message)
                ), 200, ['Content-Type' => 'application/json']);
            }
            $message = "ID User ou enable is empty ";

        } else {
            $message = "Error: isXmlHttpRequest";
        }
        return new response (json_encode(array('result' => 'error', "message" => $message)), 200, ['Content-Type' => 'application/json']);
    }


}

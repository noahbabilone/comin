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
     * @param Request $request
     * @return RedirectResponse|null|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request)
    {
        $em = $this->ge

//        $user = $this->get('security.token_storage')->getToken()->getUser();

        $user = $this->getUser();
//        dump($user) or die;

        if (!is_object($user) || !$user instanceof User) {
            //throw new AccessDeniedException('This user does not have access to this section.');
            return $this->redirectToRoute('fos_user_security_logout');
        }

        //$form = $this->createForm(UserType::class, $user);
        //$form->handleRequest($request);

        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');


        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }
//        /** @var $formFactory FactoryInterface */
//        $formFactory = $this->get('fos_user.profile.form.factory');
//
//        $form = $formFactory->createForm();
//        $form->setData($user);

        $form = $this->createForm(UserType::class, $user);
        $form->remove('plainPassword');
        $form->handleRequest($request);

//        dump($form->createView()) or die;
        if ($form->isSubmitted() && $form->isValid()) {
//            dump($form, $user);
//            die("Edit info");

            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);
            $this->addFlash(
                'success',
                'Your changes were saved!'
            );
            return $this->redirectToRoute('app_account_edit', array('q' => 'edit'), 301);
            
            /* $event = new FormEvent($form, $request);
             $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);
             dump($event->getResponse()); die;
             if (null === $response = $event->getResponse()) {
                 $url = $this->generateUrl('app_account_edit');
                 $response = new RedirectResponse($url);
                 return $response;
             }
             $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
             return $response;*/
        }


        // EditPassword
        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.change_password.form.factory');

        $formPassword = $formFactory->createForm();
        $form->setData($user);

        $formPassword->handleRequest($request);

        if ($formPassword->isSubmitted() && $formPassword->isValid()) {
            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);

            return $this->redirectToRoute('app_account_edit', array('q' => '_password'), 301);

            /* $event = new FormEvent($formPassword, $request);
             $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_SUCCESS, $event);
             if (null === $response = $event->getResponse()) {
                 $url = $this->generateUrl('app_account_edit');
                 $response = new RedirectResponse($url);
                 return $response;
             }
             $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
             return $response;*/
        }


        return $this->render('AppBundle:Account:edit.profile.html.twig', array(// ...
            'form' => $form->createView(),
            'formPassword' => $formPassword->createView(),

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
//dump( $form->createView()) or die;
        return $this->render('AppBundle:Account:edit.password.html.twig', array(// ...
            'form' => $form->createView(),

        ));
    }

    /**
     * @Route("/add")
     */
    public function addAction()
    {
        return $this->render('AppBundle:Account:add.html.twig', array());
    }

    /**
     * @Route("/list")
     */
    public function listAction()
    {
        return $this->render('AppBundle:Account:list.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/remove")
     */
    public function removeAction()
    {
        return $this->render('AppBundle:Account:remove.html.twig', array(// ...
        ));
    }

}

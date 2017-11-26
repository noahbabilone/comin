<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Restaurant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Restaurant controller.
 *
 * @Route("restaurant")
 */
class RestaurantController extends Controller
{
    /**
     * Lists all restaurant entities.
     *
     * @Route("/all", name="restaurant_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $date = new \DateTime("now");
        $date->setTimezone(new \DateTimeZone("Europe/Paris"));

        $restaurants = $em->getRepository('AppBundle:Restaurant')->findAll();

        return $this->render('AppBundle:Restaurant:index.html.twig', array(
            'restaurants' => $restaurants,
            'date' => $date,
        ));
    }

    /**
     * Creates a new restaurant entity.
     *
     * @Route("/new", name="restaurant_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $restaurant = new Restaurant();
        $form = $this->createForm('AppBundle\Form\RestaurantType', $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($restaurant);
            $em->flush();
            if ($restaurant->getId()) {
                if (null !== $form->get("imageLogo")->getData() && null !== $restaurant->getSlug()) {
                    $logo = $this->get('app.upload_service')->upload($form->get("imageLogo")->getData(), 'restaurant', $restaurant->getId(), $restaurant->getSlug());
                    $restaurant->setLogo($logo);
                }

//                /** @var Image $image */
                foreach ($restaurant->getImages() as $key => $image) {
                    if ($image->getFile()) {
                        $image->setName($restaurant->getName());
                        $path = $this->get('app.upload_service')->upload($image->getFile(), 'restaurant', $restaurant->getId());
                        $image->setPath($path);
                        $image->setPosition($key);
                        if ($key % 10 == 0)
                            $em->flush();
                    }
                }
                $em->flush();
            }

            return $this->redirectToRoute('restaurant_index');
//            return $this->redirectToRoute('restaurant_show', array('id' => $restaurant->getId()));
        }

        if ($request->server->get('HTTP_HOST') == $this->getParameter('domaine_name')) {
            $gApiKey = $this->getParameter('google_api_key_dns');
        } else {
            $gApiKey = $this->getParameter('google_api_key');
        }

        return $this->render('AppBundle:Restaurant:new.html.twig', array(
            'restaurant' => $restaurant,
            'gApiKey' => $gApiKey,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a restaurant entity.
     *
     * @Route("/{id}", name="restaurant_show")
     * @Method("GET")
     */
    public function showAction(Restaurant $restaurant)
    {
        $deleteForm = $this->createDeleteForm($restaurant);

        return $this->render('AppBundle:Restaurant:show.html.twig', array(
            'restaurant' => $restaurant,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing restaurant entity.
     *
     * @Route("/{slug}/edit", name="restaurant_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $slug)
    {
//        $deleteForm = $this->createDeleteForm($restaurant);
        $em = $this->getDoctrine()->getManager();
        $restaurant = $em->getRepository('AppBundle:Restaurant')->findOneBySlug($slug);
        if (!$restaurant instanceof Restaurant) {
            $this->setFlash('custom-alerts alert alert-danger fade in', '<i class="fa fa-warning"></i>  n\'a pu être trouvée!');

            $this->addFlash(
                'error',
                'Restaurant not found!'
            );
            return $this->redirectToRoute('restaurant_index');
        }

        $editForm = $this->createForm('AppBundle\Form\RestaurantType', $restaurant);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            dump($restaurant) or die;
            $em->flush($restaurant);

            return $this->redirectToRoute('restaurant_edit', array('id' => $restaurant->getId()));
        }

        return $this->render('AppBundle:Restaurant:edit.html.twig', array(
            'restaurant' => $restaurant,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a restaurant entity.
     *
     * @Route("/{id}", name="restaurant_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Restaurant $restaurant)
    {
        $form = $this->createDeleteForm($restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($restaurant);
            $em->flush();
        }

        return $this->redirectToRoute('restaurant_index');
    }

    /**
     * Creates a form to delete a restaurant entity.
     *
     * @param Restaurant $restaurant The restaurant entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Restaurant $restaurant)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('restaurant_delete', array('id' => $restaurant->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}

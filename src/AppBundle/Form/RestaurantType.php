<?php

namespace AppBundle\Form;

use AppBundle\Entity\City;
use AppBundle\Entity\Department;
use AppBundle\Entity\Region;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestaurantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                    'label' => 'Resturant*',
                    'required' => true,
                    'attr' => array(
                        'class' => '',
                        'placeholder' => 'Nom de l\'établissement',
                    ),
                )
            )
            ->add('manager', TextType::class, array(
                    'label' => 'Nom / Prenom',
                    'required' => false,
                    'attr' => array(
                        'class' => '',
                        'placeholder' => 'Jean Dupont',
                    ),
                )
            )
            ->add('managerPhone', TextType::class, array(
                    'label' => 'Téléphone',
                    'required' => false,
                    'attr' => array(
                        'class' => '',
                        'placeholder' => '01 02 03 04 05',
                    ),
                )
            )
            ->add('managerMail', TextType::class, array(
                    'label' => 'E-Mail',
                    'required' => false,
                    'attr' => array(
                        'class' => '',
                        'placeholder' => 'nom@domaine.com',
                    ),
                )
            )
            ->add('speciality', TextType::class, array(
                    'label' => 'Spécialité*',
                    'required' => true,
                    'attr' => array(
                        'class' => '',
                        'placeholder' => 'Pizza, Halal, Sandwiches-scalades ...',
                    ),
                )
            )
            ->add('onTheSpot', ChoiceType::class, array(
                    'label' => 'À emporter',
                    'required' => true,
                    'choices' => [
                        'Oui' => true,
                        'Non' => false,
                    ],
                    'data' => true,
                    'attr' => array(
                        'class' => 'bs-select',
                        'placeholder' => 'Restaurant',
                    ),
                )
            )
            ->add('onTheSpotOrderMin', NumberType::class, array(
                    'label' => 'Minimum de commande',
                    'required' => false,
                    'data' => 0,
                    'attr' => array(
                        'placeholder' => '0.00',
                    ),
                )
            )
            ->add('onTheSpotDurationMin', NumberType::class, array(
                    'label' => 'Min',
                    'required' => false,
//                    'data' => 10,
                    'attr' => array(
                        'placeholder' => 'Min',
                    ),
                )
            )->add('onTheSpotDurationMax', NumberType::class, array(
                    'label' => 'Max',
                    'required' => false,
//                    'data' => 10,
                    'attr' => array(
                        'placeholder' => 'Max',
                    ),
                )
            )
            ->add('openingHours', CollectionType::class, array(
                    'label' => "Heure d'ouverture",
                    'required' => false,
                    'entry_type' => OpeningHoursType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'delete_empty' => true,
                    'attr' => array(
                        'class' => "form-opening-hours"
                    )
                )
            )
            ->add('deliveryDistance', NumberType::class, array(
                    'label' => 'Distance de livraison (Km)',
                    'required' => false,
                    'attr' => array(
                        'class' => '',
                        'placeholder' => '10',
                    ),
                )
            )
//            ->add('delivery', DeliveryType::class, array(
//                    'label' => 'Distance de livraison (km',
//                    'required' => false,
//                    'mapped' => false,
//                    'attr' => array(
//                        'class' => '',
//                        'placeholder' => 'delivery',
//                    ),
//                )
//            )   
         
            ->add('deliveries', CollectionType::class, array(
                    'label' => "Delivery",
                    'required' => false,
                    'entry_type' => DeliveryType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'delete_empty' => true,
                    'attr' => array(
                        'class' => "form-delivery"
                    )
                )
            )->add('exceptionalClosure', CollectionType::class, array(
                    'label' => "Fermeture Exceptionnelle",
                    'required' => false,
                    'entry_type' => ExceptionalClosureType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'delete_empty' => true,
                    'attr' => array(
                        'class' => "form-exceptional-closure"
                    )
                )
            )
            ->add('imageLogo', FileType::class, array(
                    'label' => "Logo (200*200)",
                    'required' => false,
                    'mapped' => false,
                    'attr' => array(
                        'class' => "form-logo"
                    )
                )
            )->add('images', CollectionType::class, array(
                    'label' => "Fermeture Exceptionnelle",
                    'required' => false,
                    'entry_type' => ImageType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'delete_empty' => true,
                    'attr' => array(
                        'class' => "form-images"
                    )
                )
            )
            ->add('phone', TextType::class, array(
                    'label' => 'Téléphone*',
                    'required' => true,
                    'attr' => array(
                        'class' => '',
                        'placeholder' => '01 02 03 04 05',
                    ),
                )
            )->add('website', TextType::class, array(
                    'label' => 'URL Site Web',
                    'required' => false,
                    'attr' => array(
                        'class' => '',
                        'placeholder' => 'www.my-restaurant.com',
                    ),
                )
            )
            ->add('bankCard', CheckboxType::class, array(
                    'label' => ' ',
                    'required' => false,
                    'attr' => array(
                        'class' => 'btn-switch',
                        'data-size' => "mini",
                        'data-on' => "<i class='fa fa-check'></i> Carte bancaire",
                        'data-off' => "<i class='fa fa-remove'></i> Carte bancaire",
                        'data-onstyle' => "success",
                        'data-offstyle' => "default",
                        'data-toggle' => "toggle",
                        'data-width' => "150",
                    ),
                )
            )->add('paypal', CheckboxType::class, array(
                    'label' => ' ',
                    'required' => false,
                    'attr' => array(
                        'class' => 'btn-switch',
                        'data-size' => "mini",
                        'data-on' => "<i class='fa fa-check'></i> Paypal",
                        'data-off' => "<i class='fa fa-remove'></i> Paypal",
                        'data-onstyle' => "success",
                        'data-offstyle' => "default",
                        'data-toggle' => "toggle",
                        'data-width' => "120",
                    ),
                )
            )->add('cash', CheckboxType::class, array(
                    'label' => ' ',
                    'required' => false,
                    'attr' => array(
                        'class' => 'btn-switch',
                        'data-size' => "mini",
                        'data-on' => "<i class='fa fa-check'></i> Espèces",
                        'data-off' => "<i class='fa fa-remove'></i> Espèces",
                        'data-onstyle' => "success",
                        'data-offstyle' => "default",
                        'data-toggle' => "toggle",
                        'data-width' => "120",
                    ),
                )
            )->add('ticketRestaurant', CheckboxType::class, array(
                    'label' => ' ',
                    'required' => false,
                    'attr' => array(
                        'class' => 'btn-switch',
                        'data-size' => "mini",
                        'data-on' => "<i class='fa fa-check'></i> Titre restaurant",
                        'data-off' => "<i class='fa fa-remove'></i> Titre restaurant",
                        'data-onstyle' => "success",
                        'data-offstyle' => "default",
                        'data-toggle' => "toggle",
                        'data-width' => "150",
                    ),
                )
            )
            ->add('description', CKEditorType::class, array(
                    'label' => 'Description*',
                    'required' => true,
                    'attr' => array(
                        'class' => 'form-control form_information_content',
                        'placeholder' => 'Contenu',
                        'autocomplete' => 'off',
                        'rows' => '4'
                    ),
                    'config' => array(
                        'toolbar' => array(
                            array(
                                'name' => 'basicstyles',
                                'items' => array('Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat'),
                            ),
                            array(
                                'name' => 'paragraph',
                                'items' => array('NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'),
                            ),


                            array(
                                'name' => 'styles',
                                'items' => array('Styles', 'Format'),
                            ),

                        ),
                        'uiColor' => '#ffffff',
                        'language' => 'fr',
                        'startup_outline_blocks' => true,
                    )
                )
            )
            ->add('address', TextType::class, array(
                    'label' => 'Adresse*',
                    'required' => true,
                    'attr' => array(
                        'class' => 'input_address',
                        'placeholder' => '1 Rue Marchande',
                    ),
                )
            )
            ->add('region', EntityType::class, [
                    'class' => 'AppBundle\Entity\Region',
                    'label' => 'Region',
                    'placeholder' => 'Sélectionnez votre région',
                    'mapped' => false,
                    'required' => false,
                    'attr' => [
                        'class' => 'bs-select',
                        'data-live-search' => true,
                        'data-size' => "7",

                    ]
                ]
            );

        $builder->get('region')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
//                dump($event->getForm(), $event->getData());
                $form = $event->getForm();
//                dump($form->getParent());
                $this->addDepartmentField($form->getParent(), $form->getData());
            }
        );

//EDITION
        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) {

                $data = $event->getData();
                $form = $event->getForm();

                /** @var City $city */
                $city = $data->getCity();
                if ($city) {
                    /** @var Department $department */
                    $department = $city->getDepartment();
                    /** @var Region $region */
                    $region = $department->getRegion();

                    $this->addDepartmentField($form, $region);
                    $this->addCityField($form, $department);
                    // On set les données
                    $form->get('region')->setData($region);
                    $form->get('department')->setData($department);
//                    $form->get('street')->setData($address->getStreet());
//                    $form->get('content')->setData($address->getContent());

                } else {
                    $this->addDepartmentField($form, null);
                    $this->addCityField($form, null);
                    $this->addCommunesDeliveredField($form, null);
                }
            }
        );
    }


    private
    function addDepartmentField(FormInterface $form, Region $region = null)
    {

        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'department',
            EntityType::class,
            null,
            [
                'label' => 'Département',
                'class' => 'AppBundle\Entity\Department',
                'placeholder' => $region ? 'Sélectionnez votre département' : 'Sélectionnez votre région',
                'mapped' => false,
                'required' => false,
                'auto_initialize' => false,
                'choices' => $region ? $region->getDepartments() : [],
                'disabled' => $region ? false : true,
                'attr' => [
                    'class' => 'bs-department bs-select',
                    'data-live-search' => true,
                    'data-size' => "7",

                ]
            ]
        );
        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $this->addCityField($form->getParent(), $form->getData());
                $this->addCommunesDeliveredField($form->getParent(), $form->getData());
            }
        );
        $form->add($builder->getForm());
    }

    private function addCityField(FormInterface $form, Department $department = null)
    {
        $form->add('city', EntityType::class, [
            'label' => 'Ville*',
            'class' => 'AppBundle\Entity\City',
            'mapped' => true,
            'required' => false,
            'auto_initialize' => false,
            'placeholder' => $department ? 'Sélectionnez votre ville' : 'Sélectionnez votre département',
            'choices' => $department ? $department->getCity() : [],
            'disabled' => $department ? false : true,

            'attr' => [
                'class' => 'bs-city bs-select input_city',
                'data-live-search' => true,
                'data-size' => "7",
//                'data-container'=>"body",
            ]
        ]);
    }

    private function addCommunesDeliveredField(FormInterface $form, Department $department = null)
    {
        $form->add('communesDelivered', EntityType::class, [
            'label' => 'Communes livrées*',
            'class' => 'AppBundle\Entity\City',
            'required' => false,
            'mapped' => false,

            'auto_initialize' => false,
//            'multiple' => true,
            'placeholder' => $department ? 'Sélectionnez des villes' : 'Sélectionnez votre département',
            'choices' => $department ? $department->getCity() : [],
            'disabled' => $department ? false : true,
            'attr' => [
                'class' => 'bs-communesDelivered bs-select',
                'data-live-search' => true,
                'data-size' => "7",

            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Restaurant'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_restaurant';
    }


}

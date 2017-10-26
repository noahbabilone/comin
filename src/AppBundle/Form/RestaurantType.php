<?php

namespace AppBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
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
                    'label' => 'Resturant',
                    'required' => true,
                    'attr' => array(
                        'class' => '',
                        'placeholder' => 'Nom de l\'établissement',
                    ),
                )
            )
            ->add('speciality', TextType::class, array(
                    'label' => 'Spécialité',
                    'required' => true,
                    'attr' => array(
                        'class' => '',
                        'placeholder' => 'Spécialité de la maison',
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
                    'required' => true,
                    'data' => 0,
                    'attr' => array(
                        'placeholder' => '0.00',
                    ),
                )
            )
            ->add('onTheSpotDurationMin', NumberType::class, array(
                    'label' => 'Min',
                    'required' => true,
//                    'data' => 10,
                    'attr' => array(
                        'placeholder' => 'Min',
                    ),
                )
            )->add('onTheSpotDurationMax', NumberType::class, array(
                    'label' => 'Max',
                    'required' => true,
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
            ->add('communesDelivered', TextType::class, array(
                    'label' => 'Communes livrées',
                    'required' => false,
                    'attr' => array(
                        'class' => '',
                        'placeholder' => 'Villes, ect.',
                    ),
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
            ->add('delivery', DeliveryType::class, array(
                    'label' => 'Distance de livraison (km',
                    'required' => false,
                    'mapped' => false,
                    'attr' => array(
                        'class' => '',
                        'placeholder' => 'rite',
                    ),
                )
            )
            ->add('exceptionalClosure', CollectionType::class, array(
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
            ->add('rite', TextType::class, array(
                    'label' => 'Rite',
                    'required' => false,
                    'attr' => array(
                        'class' => '',
                        'placeholder' => 'rite',
                    ),
                )
            )
            ->add('phone', TextType::class, array(
                    'label' => 'Téléphone',
                    'required' => false,
                    'attr' => array(
                        'class' => '',
                        'placeholder' => '01 02 03 04 05',
                    ),
                )
            )->add('fax', TextType::class, array(
                    'label' => 'Fax',
                    'required' => false,
                    'attr' => array(
                        'class' => '',
                        'placeholder' => '01 02 03 04 05',
                    ),
                )
            )
            ->add('bankCard', CheckboxType::class, array(
                    'label' => ' ',
                    'required' => false,
                    'required' => false,
//                    'mapped' => false,
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
            ) ->add('paypal', CheckboxType::class, array(
                    'label' => ' ',
                    'required' => false,
                    'required' => false,
//                    'mapped' => false,
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
                    'required' => false,
//                    'mapped' => false,
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
                    'required' => false,
//                    'mapped' => false,
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
                    'label' => 'Description',
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
            ->add('address', AddressType::class, array(
                    'label' => 'Adresse',
                    'required' => false,
                    'attr' => array(
                        'class' => '',
                        'placeholder' => 'rite',
                    ),
                )
            );


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

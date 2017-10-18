<?php

namespace AppBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
                    'label' => 'Sur Place',
                    'required' => true,
                    'choices' => [
                        'Non' => 0,
                        'Oui' => 1,
                        'Les deux' => 2,
                    ],
                    'data' => 1,
                    'attr' => array(
                        'class' => 'bs-select',
                        'placeholder' => 'Restaurant',
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
            ->add('rite', TextType::class, array(
                    'label' => 'Rite',
                    'required' => false,
                    'attr' => array(
                        'class' => '',
                        'placeholder' => 'rite',
                    ),
                )
            )
            ->add('bankCard', CheckboxType::class, array(
                    'label' => 'Carte Bancaire',
                    'required' => false,
                    'attr' => array(
                        'class' => '',
                    ),
                )
            )->add('paypal', CheckboxType::class, array(
                    'label' => 'Paypal',
                    'required' => false,
                    'attr' => array(
                        'class' => 'mt-checkbox mt-checkbox-outline',
                    ),
                )
            )->add('cash', CheckboxType::class, array(
                    'label' => 'Espèce',
                    'required' => false,
                    'attr' => array(
                        'class' => '',
                    ),
                )
            )->add('ticketRestaurant', CheckboxType::class, array(
                    'label' => 'Titre Restaurant',
                    'required' => false,
                    'attr' => array(
                        'class' => '',
                        'placeholder' => 'rite',
                    ),
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
            //            ->add('visible')
//            ->add('evaluation')
//            ->add('offer')
//            ->add('menu')
//            ->add('card')
        ;
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

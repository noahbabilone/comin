<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeliveryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('active', ChoiceType::class, array(
//                    'label' => "Livraison",
//                    'required' => true,
//                    'choices' => [
//                        'Oui' => true,
//                        'Non' => false,
//                    ],
//                    'data' => true,
//                    'attr' => array(
//                        'class' => 'bs-select',
//                    ),
//                )
//            )
            ->add('city', TextType::class, array(
                    'label' => 'Ville',
                    'required' => true,
                    'attr' => [
                        'class' => 'input_delivery_city',
                        'placeholder' => 'Ville',
                    ],
                )
            )
            ->add('noonOrderMin', NumberType::class, [
                    'label' => 'Min de commande Midi',
                    'required' => true,
                    'data' => 0,
                    'attr' => [
                        'class' => 'input_noon_order_min',
                        'placeholder' => '12,00',
                    ],
                ]
            )
            ->add('nightOrderMin', NumberType::class, [
                    'label' => 'Min de commande Soir',
                    'required' => true,
                    'data' => 0,
                    'attr' => [
                        'class' => 'input_night_order_min',
                        'placeholder' => '12,00',
                    ],
                ]
            )
            ->add('price', NumberType::class, [
                    'label' => 'Frais de livraison',
                    'required' => true,
                    'data' => 0,
                    'attr' => [
                        'class' => 'input_price',
                        'placeholder' => '0.00',
                    ],
                ]

            )
            ->add('durationMin', NumberType::class, array(
                    'label' => 'Délai Min',
                    'required' => true,
                    'attr' => [
                        'class' => 'input_duration_min',
                        'placeholder' => 'Min',
                    ],
                )
            )
            ->add('durationMax', NumberType::class, [
                    'label' => 'Délai Max',
                    'required' => true,
                    'attr' => [
                        'class' => 'input_duration_max',
                        'placeholder' => 'Max',
                    ],
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Delivery'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_delivery';
    }


}

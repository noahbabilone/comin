<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExceptionalClosureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('day')
            ->remove('morningStartTime')
            ->remove('morningEndTime')
            ->remove('eveningStartTime')
            ->remove('eveningEndTime')
            ->add('exceptionalClosure', DateTimeType::class, array(
                    'label' => 'Date de fermeture',
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
//                    'data' => new \DateTime('01/06/1957 00:00'),
                    'required' => false,
                    'attr' => array(
                        'class' => 'datepicker',
                        'data-provide' => 'datepicker',
                        'data-date-format' => 'dd/mm/yyyy',
                        'placeholder' => 'jour/mois/année',
                    ),
                )
            )
            ->add('noOpeningStartTime', DateTimeType::class, array(
                    'label' => 'De',
                    'widget' => 'single_text',
                    'format' => 'HH:mm',
                    'data' => new \DateTime('01/06/1957 00:00'),
                    'required' => false,
                    'attr' => array(
                        'class' => 'timepicker',
                        'data-provide' => 'timepicker',
                        'data-date-format' => 'HH:ii',
                        'placeholder' => 'H:mn',
                    ),
                )
            )
            ->add('noOpeningEndTime', DateTimeType::class, array(
                    'label' => 'À',
                    'widget' => 'single_text',
                    'format' => 'HH:mm',
                    'data' => new \DateTime('01/06/1957 00:00'),
                    'required' => false,
                    'attr' => array(
                        'class' => 'timepicker',
                        'data-provide' => 'timepicker eveningEndTime',
                        'data-date-format' => 'HH:ii',
                        'placeholder' => 'H:mn',
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
            'data_class' => 'AppBundle\Entity\OpeningHours'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_exceptionalclosure';
    }

    public function getParent()
    {
        return OpeningHoursType::class;
    }


}

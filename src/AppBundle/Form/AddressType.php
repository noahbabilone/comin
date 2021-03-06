<?php

namespace AppBundle\Form;

use AppBundle\Entity\Department;
use AppBundle\Entity\Region;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('street', TextType::class, array(
                    'label' => 'Rue',
                    'required' => true,
                    'attr' => array(
                        'class' => 'input_street',
                        'placeholder' => '11',
                    ),
                )
            )
            ->add('content', TextType::class, array(
                    'label' => 'Adresse',
                    'required' => true,
                    'attr' => array(
                        'class' => 'input_address',
                        'placeholder' => 'Charles De Gaulle',
                    ),
                )
            )
            ->add('region', EntityType::class, [
                    'class' => 'AppBundle:Region',
                    'placeholder' => 'Sélectionnez votre région',
                    'mapped' => false,
                    'required' => false,
                    'attr' => [
                        'class' => 'bs-select'
                    ]
                ]
            );


      /*  $builder->get('region')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
//                dump($event->getForm(), $event->getData());
                $form = $event->getForm();
                $this->addDepartmentField($form->getParent(), $form->getData());
            }
        );*/

        //EDITION
//        $builder->addEventListener(
//            FormEvents::POST_SET_DATA,
//            function (FormEvent $event) {
//                $data = $event->getData();
//                /* @var $city City */
//                $city = $data->getCity();
//                $form = $event->getForm();
////                dump($form) or die;
//                if ($city) {
//                    /** @var Department $department */
//                    $department = $city->getDepartment();
//                    /** @var Region $region */
//                    $region = $department->getRegion();
//
//                    $this->addDepartmentField($form, $region);
//                    $this->addCityField($form, $department);
//                    // On set les données
//                    $form->get('region')->setData($region);
//                    $form->get('department')->setData($department);
//                } else {
//                    // On crée les 2 champs en les laissant vide (champs utilisé pour le JavaScript)
//                    $this->addDepartmentField($form, null);
//                    $this->addCityField($form, null);
//                }
//            }
//        );
    }

//    private function addDepartmentField(FormInterface $form, ?Region $region)
//    {
//        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
//            'department',
//            EntityType::class,
//            null,
//            [
//                'class' => 'AppBundle\Entity\Department',
//                'placeholder' => $region ? 'Sélectionnez votre département' : 'Sélectionnez votre région',
//                'mapped' => false,
//                'required' => false,
//                'auto_initialize' => false,
//                'choices' => $region ? $region->getDepartments() : []
//            ]
//        );
//        $builder->addEventListener(
//            FormEvents::POST_SUBMIT,
//            function (FormEvent $event) {
//                $form = $event->getForm();
//                $this->addCityField($form->getParent(), $form->getData());
//            }
//        );
//        $form->add($builder->getForm());
//    }
//
//    private function addCityField(FormInterface $form, ?Department $department)
//    {
//        $form->add('city', EntityType::class, [
//            'class' => 'AppBundle\Entity\City',
//            'placeholder' => $department ? 'Sélectionnez votre ville' : 'Sélectionnez votre département',
//            'choices' => $department ? $department->getCity() : []
//        ]);
//    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Address'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_address';
    }


}

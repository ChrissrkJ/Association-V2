<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use AppBundle\Entity\UserCategory;



class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname',TextType::class, array(
          'label' => 'Prénom'
        ))
        ->add('lastname',TextType::class, array(
          'label' => 'Nom'
        ))
        ->add('address',TextType::class, array(
          'label' => 'Adresse'
        ))
        ->add('city',TextType::class, array(
          'label' => 'Ville'
        ))
        ->add('cp',TextType::class, array(
          'label' => 'Code postal'
        ))
        ->add('phoneNumber',TextType::class, array(
          'label' => 'Téléphone'
        ))
        ->add('resume',TextareaType::class, array(
          'label'=> 'Un petit mot sur vous : '
        ))
        ->add('userCategory', EntityType::class, array(
          'class'=> UserCategory::class,
          'choice_label'=>'name',
          'label'=> 'Je suis : '
        ));

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}

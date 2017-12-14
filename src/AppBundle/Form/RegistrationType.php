<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class RegistrationType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options)
   {
       $builder->add('firstname', TextType::class, array(
         'label' => 'Prénom'
       ))
       ->add('lastname', TextType::class, array(
         'label' => 'Nom'
       ))
       ->add('phoneNumber', TextType::class, array(
         'label' => "Téléphone "
       ));
   }

   public function getParent()
   {
       return 'FOS\UserBundle\Form\Type\RegistrationFormType';

   }

   public function getBlockPrefix()
   {
       return 'app_admin_registration';
   }
}

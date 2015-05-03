<?php

namespace Site\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LoginType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array('label' => 'Pseudo', 'attr' => array('class' => 'form-control')))
            ->add('password', 'password', array('label' => 'Mot de passe', 'attr' => array('class' => 'form-control')))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'userbundle_login';
    }
}

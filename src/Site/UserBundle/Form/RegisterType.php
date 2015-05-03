<?php

namespace Site\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array('label' => 'Pseudo', 'attr' => array('class' => 'form-control')))
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Les mots de passe doivent correspondre',
                'options' => array('required' => true),
                'first_options'  => array('label' => 'Mot de passe', 'attr' => array('class' => 'form-control')),
                'second_options' => array('label' => 'Mot de passe (validation)', 'attr' => array('class' => 'form-control')),
            ))
            ->add('email', 'repeated', array(
                'type' => 'email',
                'invalid_message' => 'Les emails doivent correspondre',
                'options' => array('required' => true),
                'first_options'  => array('label' => 'Email', 'attr' => array('class' => 'form-control')),
                'second_options' => array('label' => 'Email (validation)', 'attr' => array('class' => 'form-control')),
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'userbundle_register';
    }
}

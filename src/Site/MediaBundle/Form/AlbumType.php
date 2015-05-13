<?php

namespace Site\MediaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text', array('label' => 'Nom : '))
            ->add('annee', 'entity', array(
                        'class' => 'Site\MediaBundle\Entity\Date',                     
                        'property' => 'annee',
                        'label'=>'Année : ',
                ));
    }

    public function getName()
    {
        return 'albumtype';
    }
}

?>

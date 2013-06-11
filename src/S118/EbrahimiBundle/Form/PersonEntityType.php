<?php

namespace S118\EbrahimiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonEntityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fn')
            ->add('ln')
            ->add('city')
            ->add('street')
            ->add('alley')
            ->add('type','choice', array('choices' => array('1' => 'حقیقی', '0' => 'حقوقی')))
            ->add('file');
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'S118\EbrahimiBundle\Entity\PersonEntity'
        ));
    }

    public function getName()
    {
        return 's118_ebrahimibundle_personentitytype';
    }
}

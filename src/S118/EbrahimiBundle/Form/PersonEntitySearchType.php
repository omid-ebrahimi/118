<?php

namespace S118\EbrahimiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonEntitySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fn','text', array('required'=>false))
            ->add('ln','text', array('required'=>false))
            ->add('city','text', array('required'=>false))
            ->add('street','text', array('required'=>false))
            ->add('alley','text', array('required'=>false))
            ->add('ptype','choice', array('choices' => array('1' => 'حقیقی', '0' => 'حقوقی'),'required'=>false))
            ->add('phtype','choice', array('choices' => array('1' => 'موبایل', '0' => 'تلفن'),'required'=>false))
            ->add('status','choice', array('choices' => array('1' => 'فعال', '0' => 'غیرفعال'),'required'=>false))
            ->add('number','text', array('required'=>false))
        ;
    }

    public function getName()
    {
        return 's118_ebrahimibundle_personentitysearchtype';
    }
}

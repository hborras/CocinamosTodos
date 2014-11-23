<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('slug')
            ->add('description')

            ->add('category', 'entity', array(
                'class'         => 'AppBundle\\Entity\\Category',
                'empty_value'   => '',
                'query_builder' => function (EntityRepository $repository) {
                    return $repository->createQueryBuilder('c')
                        ->addOrderBy('c.name', 'ASC');
                },
                'required'=>false,
            ))
            ->add('quantityOfPeople')
            ->add('vegan')
            ->add('calories')
            ->add('score')
            ->add('visible', null, array('required' => false))
            ->add('save','submit',array('label' => 'Save Changes'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Recipe',
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'cocinamostodos_backendbundle_recipetype';
    }
}

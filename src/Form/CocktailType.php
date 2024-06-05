<?php

namespace App\Form;

use App\Entity\Cocktail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CocktailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname',null, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Jean...'
                ]
            ])
            ->add('lastname',null, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'ValJean...'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cocktail::class,
        ]);
    }
}

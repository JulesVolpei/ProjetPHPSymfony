<?php

namespace App\From;

use App\Repository\BarreRechercheRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;

class SearchTypeForm extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('query', TextType::class, [
            'attr' => [
                'placeholder'=> 'Recherche de Fruit.'
            ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => BarreRechercheRepository::class,
            'method' => 'GET',
            'csrf_protection'=> 'false'
        ]);
    }
}
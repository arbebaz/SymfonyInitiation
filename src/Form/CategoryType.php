<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextareaType::class, [
                "label" => "nom de la categorie", // par default label a pour valeur le nom de la propriete, on peut le passer a false
                "required" => false, //par default true, 
                "attr" => [ // tableau des attributs 
                    "placeholder" => "saisir le nom de la categorie ", 
                    "class" => "border border-primary"
                    
                    ]
            ])

            ->add('Ajouter', SubmitType::class);
     }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }

    
   
}

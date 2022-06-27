<?php

namespace App\Form;

use App\Entity\Trick;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextareaType::class,
                [
                    'label' => 'Title',
                    'required' => false
                ]
            )
            ->add(
                'description',
                TextareaType::class,
                [
                    'label' => 'Description',
                    'required' => false
                ]
            )
            ->add(
                'category',
                EntityType::class,
                [
                    'label' => 'Category',
                    'class' => Category::class,
                    'choice_label' => 'name'
                ]
            )
            ->add(
                'mainImage',
                FileType::class,
                [
                    'label' => 'Upload files',
                    'required' => false
                ]
            )
            ->add(
                'image',
                CollectionType::class,
                [
                    'label' => false,
                    'entry_type' => ImageCollectionType::class,
                    'entry_options' => false,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(
                [
                    'data_class' => Trick::class,
                ]
            );
    }
}
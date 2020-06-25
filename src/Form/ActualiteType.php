<?php

namespace App\Form;

use App\Entity\Actualite;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;


class ActualiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title')
        ->add('content', CKEditorType::class, [
            'config'=> [
                'uiColor' => '#e2e2e2',
                'toolbar'=> 'full',
                'required' => true 
            ]
        ])
        ->add('url_video')
        ->add('imageFile', VichFileType::class, [
            'required' => false,
            
        ])

        ->add('date_pub',DateType::class, [
    // renders it as a single text box
            'widget' => 'single_text',
        ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Actualite::class,
        ]);
    }
}

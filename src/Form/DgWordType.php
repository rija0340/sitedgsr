<?php

namespace App\Form;

use App\Entity\DG;
use App\Entity\DgWord;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DgWordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('dg')
        ->add('word', CKEditorType::class, [
            'config'=> [
                'uiColor' => '#e2e2e2',
                'toolbar'=> 'full',
                'required' => true 
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DgWord::class,
        ]);
    }
}

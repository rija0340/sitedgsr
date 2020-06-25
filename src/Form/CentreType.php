<?php

namespace App\Form;

use App\Entity\Centre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CentreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('type',ChoiceType::class, [
            'choices' => $this->getChoices(),
        ])
        ->add('annexe')
        ->add('adresse')
        ->add('grade_cc')
        ->add('nom_cc')
        ->add('num_cc')
        ->add('ville')
        
        ->add('imageFile', FileType::class, [
            'required' => false
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Centre::class,
        ]);
    }

    private function getChoices(){

        $choices = Centre::TYPE;
        $output = [];
        foreach ($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;
    }
}

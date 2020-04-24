<?php

namespace App\Form;

use App\Entity\News;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',null, ['label'=>'Titre de la news'])
            ->add('content',null, ['label'=>'Contenu de la news'])
            ->add('creator', null, ['label'=>'Auteur de la news'] )
            ->add('imageFile', FileType::class, ['required'=> false])
            ->add('isFirst', null, ['label'=>'Mettre cette news en avant ? (Elle apparaîtra dans le gros bloc dans le module des news, cocher cette case écrasera la précédente news mise en avant)'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => News::class,
        ]);
    }
}

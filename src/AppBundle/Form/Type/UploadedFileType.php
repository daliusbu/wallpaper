<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.11.16
 * Time: 20.46
 */

namespace AppBundle\Form\Type;


use AppBundle\File\SymfonyUploadedFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UploadedFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, [
                'multiple'=>false,
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>SymfonyUploadedFile::class
        ]);
    }


}
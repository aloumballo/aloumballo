<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            /*  ->add('roles') */
            /*  ->add('password') */
            ->add('nomComplet')
            ->add('adresse')
            ->add('sexe')

            ->add('classe', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'libelle',
                'mapped' => false
            ]);
        /*  ->add('matricule'); */
        /*  ->add('demande'); */
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
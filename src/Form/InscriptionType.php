<?php

namespace App\Form;

use App\Entity\AC;
use App\Entity\AnneeScolaire;
use App\Entity\Classe;
use App\Entity\Inscrire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('etatInscription')
            ->add('annescolaire', EntityType::class, [
                'class' => AnneeScolaire::class,
                'choice_label' => 'libelleAnnee'
            ])
            ->add('ac', EntityType::class, [
                'class' => AC::class,
                'choice_label' => 'nomComplet'
            ])
            ->add('classe', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'libelle'
            ])
            ->add('etudiant', EtudiantType::class, []);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscrire::class,
        ]);
    }
}
<?php

namespace App\Form;

use App\Entity\Envoi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class EnvoiFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('depart', ChoiceType::class, [
                'choices'  => [
                    'Villeneuve-la-garenne' => 'Villeneuve-la-garenne',
                ],
            ])
            ->add('nom_e', TextType::class)
            ->add('prenom_e', TextType::class)
            ->add('tel_e', TelType::class)
            ->add('identite', ChoiceType::class, [
                'choices'  => [
                    'Passeport' => 'Passeport',
                    "Carte d'identité" => "Carte d'identité",
                ],
            ])
            ->add('id_e', TextType::class)
            ->add('image_id')
            ->add('nom_d', TextType::class)
            ->add('prenom_d', TextType::class)
            ->add('tel_d', TelType::class)
            ->add('id_d', TextType::class)
            ->add('n_colis', IntegerType::class)
            ->add('paye', ChoiceType::class, [
                'choices'  => [
                    'Oui' => true,
                    'Non' => false,
                ],
            ])
            ->add('mode_paiement', ChoiceType::class, [
                'choices'  => [
                    'Espèce' => 'Espèce',
                    'CB' => 'CB',
                ],
            ])
            ->add('poids_t', NumberType::class)
            ->add('type', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Envoi::class,
        ]);
    }
}

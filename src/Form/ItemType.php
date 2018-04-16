<?php
/**
 * Item Type
 */
namespace App\Form;

use App\Entity\Item;
use App\Util\CSSClass;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ItemType
 * @package App\Form
 */
class ItemType extends AbstractType
{
    /**
     * Builds a form allowing users to create an item up or edit information.
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name", TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => CSSClass::input(),
                    'placeholder' => 'Name of Pizza'
                ]
            ])
            ->add('style', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => CSSClass::input(),
                    'placeholder' => 'Eg. Deep Dish'
                ]
            ])
            ->add('price', IntegerType::class, [
                'label' => false,
                'attr' => [
                    'min' => 1,
                    'class' => CSSClass::input(),
                    'placeholder' => 'Price'
                ]
            ])
            ->add('description', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => CSSClass::input(),
                    'placeholder' => 'Your Description'
                ]
            ])
            ->add('visibility',ChoiceType::class, [
                'choices' => [
                    'Private' => false,
                    'Public' => true
                ],
                'label' => false,
                'attr' => [
                    'class' => CSSClass::input()
                ]
            ])
        ;
    }

    /**
     * Default Parameters
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Item::class,
        ]);
    }
}

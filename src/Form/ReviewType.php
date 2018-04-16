<?php
/**
 * Review Type
 */
namespace App\Form;

use App\Entity\Review;
use App\Util\CSSClass;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ReviewType
 * @package App\Form
 */
class ReviewType extends AbstractType
{
    /**
     * Builds a form allowing users to create or edit reviews.
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => CSSClass::input(),
                    'placeholder' => 'Your Brief Opinion'
                ]
            ])
            ->add('rating', IntegerType::class, [
                'label' => false,
                'attr' => [
                    'step' => .5,
                    'min' => 1,
                    'max' => 5,
                    'class' => CSSClass::input(),
                    'placeholder' => 'Rating'
                ]
            ])
            ->add('restaurant', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => CSSClass::input(),
                    'placeholder' => 'Restaurant of Purchase'
                ]
            ])
            ->add('location', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => CSSClass::input(),
                    'placeholder' => 'Eg. Dublin, New York, Gotham'
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
            'data_class' => Review::class,
        ]);
    }
}

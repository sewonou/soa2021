<?php

namespace App\Form;

use App\Entity\Categorization;
use App\Entity\Country;
use App\Entity\Hotel;
use App\Entity\Participant;
use App\Entity\Room;
use App\Entity\Transportation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', TextType::class, [
                'required' => false,
            ])
            ->add('firstName', TextType::class, [
                'required' => false,
            ])
            ->add('gender', ChoiceType::class, [
                'choices'  => array(
                    'Homme' => 'homme',
                    'Femme' => 'femme',
                    'Ne sais pas' => '',
                ),
                'expanded' => true,
                'multiple' => false
            ])
            ->add('imageFile', FileType::class, [
                'required' => false,
            ])
            ->add('address', TextType::class, [
                'required' => false,
            ])
            ->add('contact', TextType::class, [
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'required' => false,
            ])
            ->add('entryAt', DateTimeType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('releaseAt', DateTimeType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('grandCommandery', TextType::class, [
                'required' => false,
            ])
            ->add('localCommandery', TextType::class, [
                'required' => false,
            ])
            ->add('hasPayed', CheckboxType::class, [
                'required' => false,
            ])
            ->add('isConfirm', CheckboxType::class, [
                'required' => false,
            ])
            ->add('transportation', EntityType::class, [
                'class' => Transportation::class,
                'choice_label' => 'nameFr',
            ])
            ->add('hotel', EntityType::class, [
                'mapped' => false,
                'class' => Hotel::class,
                'choice_label' => 'title',
                'required' => false,

            ])
            ->add('categorization', EntityType::class, [
                'class'=> Categorization::class,
                'choice_label' => 'nameFr',
                'required' => false,
            ])
            ->add('country', EntityType::class, [
                'class' => Country::class,
                'choice_label' => 'nameFr',
                'required' => false,
            ])
        ;
        $builder->get('hotel')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event){
                $form = $event->getForm();
                $this->addRoomField($form->getParent(), $form->getData());
            }
        );
        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event){
                $data = $event->getData();
                dump($data);
                $room = $data->getRoom();
                $form = $event->getForm();
                /**
                 * @var $room Room
                 */
                if($room){
                    $hotel = $room->getHotel();
                    $this->addRoomField($form, $hotel);

                    $form->get('room')->setData($room);
                    $form->get('hotel')->setData($hotel);
                }else{
                    $this->addRoomField($form, null);
                }
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
    private function addRoomField(FormInterface $form, ?Hotel $hotel)
    {
        $form->add(
            'room',
            EntityType::class,
            [
                'label' => "",
                'class' => Room::class,
                'choice_label' => 'titleFr',
                'placeholder' => "Choisir la chambre",
                'choices' => $hotel ? $hotel->getRooms() : [],
            ]
        );
    }
}

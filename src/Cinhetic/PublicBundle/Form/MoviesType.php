<?php

namespace Cinhetic\PublicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class MoviesType
 * @package Cinhetic\PublicBundle\Form
 */
class MoviesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array('label' => "Titre"))
            ->add('typeFilm',  'choice', array(
                'label' => "Type de film",
                'choices'   => array(
                    'Long-Metrage' => 'Long Metrage',
                    'Moyen-Metrage' => 'Moyen Metrage',
                    'Court-Metrage' => 'Court Metrage'
                ),
                'required'  => true,
            ))
            ->add('synopsis', null, array('attr' => array("class" => "ckeditor")))
            ->add('description', null, array('attr' => array("class" => "ckeditor")))
            ->add('trailer', null, array('attr' => array("cols" => 80, "rows" => 7)))
            ->add('languages', "language")
            ->add('distributeur', 'choice', array(
                'label' => "Maison de production",
                'choices'   => array(
                    'Warner Bros' => 'Warner Bros',
                    'Paramont' => 'Paramont',
                    'HBO' => 'HBO',
                    'TwentiethCenturyFox' => 'TwentiethCenturyFox',
                    'UniversalPicturesGroup' => 'UniversalPicturesGroup',
                    'ColumbiaPictures' => 'ColumbiaPictures',
                    'WaltDisney' => 'WaltDisney',
                    'MarvelEntertainment ' => 'MarvelEntertainment',
                    'Lucasfilm ' => 'Lucasfilm'
                ),
                'required'  => true,
            ))
            ->add('bo', 'choice', array(
                'label' => "Bande Original",
                'choices'   => array('VO' => 'VO', 'VOST' => 'VOST','VOFR' => 'VOFR'),
                'required'  => true,
            ))
            ->add('annee')
            ->add('budget')
            ->add('duree')
            ->add('dateRelease', null, array('label' => "Date de sortie"))
            ->add('notePresse','choice', array(
                'choices'   => array(
                    '1' => 'Naz',
                    '2' => 'Moyen',
                    "3" => "Passable",
                    "4" => "Bon film",
                    '5' => "Excellent réalisateur"),
                'required'  => false,
            ))
            ->add('visible')
            ->add('cover')
            ->add('category', null, array('label' => "Catégorie associée"))
            ->add('actors', null, array('label' => "Acteurs qui ont joué dans ce film"))
            ->add('cinemas', null, array('label' => "Cinéma qui le diffusent"))
            ->add('directors', null, array('label' => "Réalisateur"))
            ->add('moviesRelated', null, array('label' => "Film associé"))
            ->add('tags', null, array('label' => "Tags associé"))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cinhetic\PublicBundle\Entity\Movies'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }
}

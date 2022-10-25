<?php

namespace App\Form;

use App\Entity\League;
use App\Entity\Matchday;
use App\Entity\Meet;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Form\Enum\MeetName;

class MeetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $meetsName = array (
                    'Mecz 1' => 'Mecz 1',
                    'Mecz 2' => 'Mecz 2',
                    'Mecz 3' => 'Mecz 3',
                    'Mecz 4' => 'Mecz 4',
                    'Mecz 5' => 'Mecz 5',
                    'Mecz 6' => 'Mecz 6',
                    'Mecz 7' => 'Mecz 7',
                    'Mecz 8' => 'Mecz 8',
                    'Mecz 9' => 'Mecz 9',
                    'Mecz 10' => 'Mecz 10',
                    
                    'Mecz 11' => 'Mecz 11',
                    'Mecz 12' => 'Mecz 12',
                    'Mecz 13' => 'Mecz 13',
                    'Mecz 14' => 'Mecz 14',
                    'Mecz 15' => 'Mecz 15',
                    'Mecz 16' => 'Mecz 16',
                    'Mecz 17' => 'Mecz 17',
                    'Mecz 18' => 'Mecz 18',
                    'Mecz 19' => 'Mecz 19',
                    'Mecz 20' => 'Mecz 20',
                    
                    'Mecz 21' => 'Mecz 21',
                    'Mecz 22' => 'Mecz 22',
                    'Mecz 23' => 'Mecz 23',
                    'Mecz 24' => 'Mecz 24',
                    'Mecz 25' => 'Mecz 25',
                    'Mecz 26' => 'Mecz 26',
                    'Mecz 27' => 'Mecz 27',
                    'Mecz 28' => 'Mecz 28',
                    'Mecz 29' => 'Mecz 29',
                    'Mecz 30' => 'Mecz 30',
            
                    'Mecz 31' => 'Mecz 31',
                    'Mecz 32' => 'Mecz 32',
                    'Mecz 33' => 'Mecz 33',
                    'Mecz 34' => 'Mecz 34',
                    'Mecz 35' => 'Mecz 35',
                    'Mecz 36' => 'Mecz 36',
                    'Mecz 37' => 'Mecz 37',
                    'Mecz 38' => 'Mecz 38',
                    'Mecz 39' => 'Mecz 39',
                    'Mecz 40' => 'Mecz 40',
            
                    'Mecz 41' => 'Mecz 41',
                    'Mecz 42' => 'Mecz 42',
                    'Mecz 43' => 'Mecz 43',
                    'Mecz 44' => 'Mecz 44',
                    'Mecz 45' => 'Mecz 45',
                    'Mecz 46' => 'Mecz 46',
                    'Mecz 47' => 'Mecz 47',
                    'Mecz 48' => 'Mecz 48',
                    'Mecz 49' => 'Mecz 49',
                    'Mecz 50' => 'Mecz 50',
            
                    'Mecz 51' => 'Mecz 51',
                    'Mecz 52' => 'Mecz 52',
                    'Mecz 53' => 'Mecz 53',
                    'Mecz 54' => 'Mecz 54',
                    'Mecz 55' => 'Mecz 55',
                    'Mecz 56' => 'Mecz 56',
                    'Mecz 57' => 'Mecz 57',
                    'Mecz 58' => 'Mecz 58',
                    'Mecz 59' => 'Mecz 59',
                    'Mecz 60' => 'Mecz 60',
            
                    'Mecz 61' => 'Mecz 61',
                    'Mecz 62' => 'Mecz 62',
                    'Mecz 63' => 'Mecz 63',
                    'Mecz 64' => 'Mecz 64',
                    'Mecz 65' => 'Mecz 65',
                    'Mecz 66' => 'Mecz 66',
                    'Mecz 67' => 'Mecz 67',
                    'Mecz 68' => 'Mecz 68',
                    'Mecz 69' => 'Mecz 69',
                    'Mecz 70' => 'Mecz 70',
                    
                    'Mecz 71' => 'Mecz 71',
                    'Mecz 72' => 'Mecz 72',
                    'Mecz 73' => 'Mecz 73',
                    'Mecz 74' => 'Mecz 74',
                    'Mecz 75' => 'Mecz 75',
                    'Mecz 76' => 'Mecz 76',
                    'Mecz 77' => 'Mecz 77',
                    'Mecz 78' => 'Mecz 78',
                    'Mecz 79' => 'Mecz 79',
                    'Mecz 80' => 'Mecz 80',
            
                    'Mecz 81' => 'Mecz 81',
                    'Mecz 82' => 'Mecz 82',
                    'Mecz 83' => 'Mecz 83',
                    'Mecz 84' => 'Mecz 84',
                    'Mecz 85' => 'Mecz 85',
                    'Mecz 86' => 'Mecz 86',
                    'Mecz 87' => 'Mecz 87',
                    'Mecz 88' => 'Mecz 88',
                    'Mecz 89' => 'Mecz 89',
                    'Mecz 90' => 'Mecz 90',
            
                    'Mecz 91' => 'Mecz 91',
                    'Mecz 92' => 'Mecz 92',
                    'Mecz 93' => 'Mecz 93',
                    'Mecz 94' => 'Mecz 94',
                    'Mecz 95' => 'Mecz 95',
                    'Mecz 96' => 'Mecz 96',
                    'Mecz 97' => 'Mecz 97',
                    'Mecz 98' => 'Mecz 98',
                    'Mecz 99' => 'Mecz 99',
                    'Mecz 100' => 'Mecz 100',
            
                    'Mecz 101' => 'Mecz 101',
                    'Mecz 102' => 'Mecz 102',
                    'Mecz 103' => 'Mecz 103',
                    'Mecz 104' => 'Mecz 104',
                    'Mecz 105' => 'Mecz 105',
                    'Mecz 106' => 'Mecz 106',
                    'Mecz 107' => 'Mecz 107',
                    'Mecz 108' => 'Mecz 108',
                    'Mecz 109' => 'Mecz 109',
                    'Mecz 110' => 'Mecz 110',
            
                    'Mecz 111' => 'Mecz 111',
                    'Mecz 112' => 'Mecz 112',
                    'Mecz 113' => 'Mecz 113',
                    'Mecz 114' => 'Mecz 114',
                    'Mecz 115' => 'Mecz 115',
                    'Mecz 116' => 'Mecz 116',
                    'Mecz 117' => 'Mecz 117',
                    'Mecz 118' => 'Mecz 118',
                    'Mecz 119' => 'Mecz 119',
                    'Mecz 120' => 'Mecz 120',
            
                    'Mecz 121' => 'Mecz 121',
                    'Mecz 122' => 'Mecz 122',
                    'Mecz 123' => 'Mecz 123',
                    'Mecz 124' => 'Mecz 124',
                    'Mecz 125' => 'Mecz 125',
                    'Mecz 126' => 'Mecz 126',
                    'Mecz 127' => 'Mecz 127',
                    'Mecz 128' => 'Mecz 128',
                    'Mecz 129' => 'Mecz 129',
                    'Mecz 130' => 'Mecz 130',
            
                    'Mecz 131' => 'Mecz 131',
                    'Mecz 132' => 'Mecz 132',
                    'Mecz 133' => 'Mecz 133',
                    'Mecz 134' => 'Mecz 134',
                    'Mecz 135' => 'Mecz 135',
                    'Mecz 136' => 'Mecz 136',
                    'Mecz 137' => 'Mecz 137',
                    'Mecz 138' => 'Mecz 138',
                    'Mecz 139' => 'Mecz 139',
                    'Mecz 140' => 'Mecz 140',
            
                    'Mecz 141' => 'Mecz 141',
                    'Mecz 142' => 'Mecz 142',
                    'Mecz 143' => 'Mecz 143',
                    'Mecz 144' => 'Mecz 144',
                    'Mecz 145' => 'Mecz 145',
                    'Mecz 146' => 'Mecz 146',
                    'Mecz 147' => 'Mecz 147',
                    'Mecz 148' => 'Mecz 148',
                    'Mecz 149' => 'Mecz 149',
                    'Mecz 150' => 'Mecz 150'
            
        );
        
        $builder
            ->add('name' , null, ['label' => 'Nazwa'])
            ->add('name' , ChoiceType::class, [
                'choices' => $meetsName
            ])
            ->add('hostGoals' , null, ['label' => 'Bramki gospodarz'])
            ->add('guestGoals' , null, ['label' => 'Bramki gość'])
            ->add('term' , null, ['label' => 'Termin meczu'])
            ->add('position' , ChoiceType::class, [
                'choices' => [
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6',
                        '7' => '7',
                        '8' => '8',
                        '9' => '9',
                        '10' => '10'
                    ]
                ]) 
            ->add('hostTeam' , null, ['label' => 'Gospodarz'])
            ->add('hostTeam', EntityType::class, [
                    'class' => Team::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('t')
                            ->innerJoin('t.league', 'l')
                            ->orderBy('l.id', 'ASC');
                    },
                    'label' => 'Gospodarz',
                ])
            ->add('guestTeam', EntityType::class, [
                    'class' => Team::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('t')
                            ->innerJoin('t.league', 'l')
                            ->orderBy('l.id', 'ASC');
                    },
                    'label' => 'Gość',
                ])
            ->add('matchday', EntityType::class, [
                'class' => Matchday::class,
                'label' => 'Kolejka'
            ])
            ->add('league', EntityType::class, [
                'class' => League::class,
                'label' => 'Liga'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Meet::class,
        ]);
    }
}

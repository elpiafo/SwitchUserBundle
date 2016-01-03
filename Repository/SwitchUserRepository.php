<?php

namespace Elpiafo\SwitchUserBundle\Repository;

class SwitchUserRepository extends \Doctrine\ORM\EntityRepository
{

    public function isAllowed($grantor, $granted)
    {
        $datetime = date('Y-m-d H:i:s');
        $params = array(
            'grantor'   => $grantor,
            'granted'   => $granted,
            'startDate' => $datetime,
            'endDate'   => $datetime
        );
        $qb = $this->createQueryBuilder('s')
            ->addSelect('s')
            ->where('s.active = 1')
            ->andWhere('s.startDate <= :startDate OR s.startDate IS NULL')
            ->andWhere('s.endDate >= :endDate OR s.endDate IS NULL')
            ->andWhere('s.grantor = :grantor')
            ->andWhere('s.granted = :granted')
            ->setMaxResults(1)
            ->setParameters($params)
        ;
        return $qb->getQuery()->getResult();
    }

    public function getGrantedFromUser($grantor)
    {
        $qb = $this->createQueryBuilder('s')
            ->addSelect('s')
            ->andWhere('s.grantor = :grantor')
            ->setParameter('grantor', $grantor);
        return $qb->getQuery()->getResult();
    }

    public function getGrantorFromUser($granted)
    {
        $qb = $this->createQueryBuilder('s')
            ->addSelect('s')
            ->andWhere('s.granted = :granted')
            ->setParameter('granted', $granted);
        return $qb->getQuery()->getResult();
    }

    public function getAllAllowed()
    {
        $datetime = date('Y-m-d H:i:s');
        $params = array(
            'startDate' => $datetime,
            'endDate'   => $datetime,
        );
        $qb = $this->createQueryBuilder('s')
            ->addSelect('s')
            ->where('s.active = 1')
            ->andWhere('s.startDate <= :startDate OR s.startDate IS NULL')
            ->andWhere('s.endDate >= :endDate OR s.endDate IS NULL')
            ->setParameters($params)
        ;
        return $qb->getQuery()->getResult();
    }

    public function getCollisions($grantor, $granted, $startDate, $endDate)
    {
        $params = array(
            'grantor'   => $grantor,
            'granted'   => $granted,
            'startDate' => $startDate,
            'endDate'   => $endDate,
        );
        $qb = $this->createQueryBuilder('s');
        $qb->addSelect('s')
            ->where('s.grantor = :grantor')
            ->andWhere('s.granted = :granted')
            ->andWhere(
                $qb->expr()->orX(
                    $qb->expr()->andX(
                        $qb->expr()->orX('s.startDate < :startDate', 's.startDate < :endDate'),
                        $qb->expr()->orX('s.endDate > :startDate', 's.endDate > :endDate')
                    ),

                    $qb->expr()->andX($qb->expr()->isNull('s.startDate'), 's.endDate > :startDate'),
                    $qb->expr()->andX($qb->expr()->isNull('s.endDate'), 's.startDate < :endDate'),
                    $qb->expr()->andX($qb->expr()->isNull('s.startDate'), $qb->expr()->isNull('s.endDate')),

                    $qb->expr()->andX($qb->expr()->isNull(':startDate'), $qb->expr()->orX($qb->expr()->isNull('s.startDate'), 's.startDate < :endDate')),
                    $qb->expr()->andX($qb->expr()->isNull(':endDate'), $qb->expr()->orX($qb->expr()->isNull('s.endDate'), 's.endDate > :startDate')),
                    $qb->expr()->andX($qb->expr()->isNull(':startDate'), $qb->expr()->isNull(':endDate'))
                )
            )
            ->setParameters($params);
        return $qb->getQuery()->getResult();
    }
}

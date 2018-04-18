<?php namespace App\Repositories;

interface DonRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    public function getDSDon($order, $direction, $offset, $limit,$input);
}
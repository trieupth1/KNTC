<?php namespace App\Repositories;

interface DonviRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    public function getDonVi($nameDV);
}
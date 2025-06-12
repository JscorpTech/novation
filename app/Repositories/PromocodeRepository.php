<?php

namespace App\Repositories;

use App\Models\Promocode;

class PromocodeRepository
{
    /**
     * @var Promocode
     */
    protected Promocode $promocode;

    /**
     * Promocode constructor.
     *
     * @param Promocode $promocode
     */
    public function __construct(Promocode $promocode)
    {
        $this->promocode = $promocode;
    }

    /**
     * Get all promocode.
     *
     * @return Promocode $promocode
     */
    public function all()
    {
        return $this->promocode->get();
    }

    /**
     * Get promocode by id
     *
     * @param $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->promocode->find($id);
    }

    public function getByCode($code)
    {
        return $this->promocode->where('code', $code)->first();
    }

    /**
     * Save Promocode
     *
     * @param $data
     * @return Promocode
     */
    public function save(array $data)
    {
        return Promocode::create($data);
    }

    /**
     * Update Promocode
     *
     * @param $data
     * @return Promocode
     */
    public function update(array $data, int $id)
    {
        $promocode = $this->promocode->find($id);
        $promocode->update($data);
        return $promocode;
    }

    /**
     * Delete Promocode
     *
     * @param $data
     * @return Promocode
     */
    public function delete(int $id)
    {
        $promocode = $this->promocode->find($id);
        $promocode->delete();
        return $promocode;
    }
}

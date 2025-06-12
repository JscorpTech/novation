<?php

namespace App\Services;

use App\Models\Promocode;
use App\Repositories\PromocodeRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class PromocodeService
{
    /**
     * @var PromocodeRepository $promocodeRepository
     */
    protected $promocodeRepository;

    /**
     * DummyClass constructor.
     *
     * @param PromocodeRepository $promocodeRepository
     */
    public function __construct(PromocodeRepository $promocodeRepository)
    {
        $this->promocodeRepository = $promocodeRepository;
    }

    /**
     * Get all promocodeRepository.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->promocodeRepository->all();
    }

    /**
     * Get promocodeRepository by id.
     *
     * @param $id
     * @return String
     */
    public function getById(int $id)
    {
        return $this->promocodeRepository->getById($id);
    }
    public function getByCode($code) {
        return $this->promocodeRepository->getByCode($code);
    }
    /**
     * Validate promocodeRepository data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function save(array $data)
    {
        return $this->promocodeRepository->save($data);
    }

    /**
     * Update promocodeRepository data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function update(array $data, int $id)
    {
        DB::beginTransaction();
        try {
            $promocodeRepository = $this->promocodeRepository->update($data, $id);
            DB::commit();
            return $promocodeRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to update post data');
        }
    }

    /**
     * Delete promocodeRepository by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById(int $id)
    {
        DB::beginTransaction();
        try {
            $promocodeRepository = $this->promocodeRepository->delete($id);
            DB::commit();
            return $promocodeRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to delete post data');
        }
    }
}

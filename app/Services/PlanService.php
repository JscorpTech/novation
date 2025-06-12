<?php

namespace App\Services;

use App\Models\Plan;
use App\Repositories\PlanRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class PlanService
{
    /**
     * @var PlanRepository $planRepository
     */
    protected $planRepository;

    /**
     * DummyClass constructor.
     *
     * @param PlanRepository $planRepository
     */
    public function __construct(PlanRepository $planRepository)
    {
        $this->planRepository = $planRepository;
    }

    /**
     * Get all planRepository.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->planRepository->all();
    }

    /**
     * Get planRepository by id.
     *
     * @param $id
     * @return Plan
     */
    public function getById(int $id): Plan
    {
        return $this->planRepository->getById($id);
    }

    /**
     * Validate planRepository data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function save(array $data)
    {
        return $this->planRepository->save($data);
    }

    /**
     * Update planRepository data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function update(array $data, int $id)
    {
        DB::beginTransaction();
        try {
            $planRepository = $this->planRepository->update($data, $id);
            DB::commit();
            return $planRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to update post data');
        }
    }

    /**
     * Delete planRepository by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById(int $id)
    {
        DB::beginTransaction();
        try {
            $planRepository = $this->planRepository->delete($id);
            DB::commit();
            return $planRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to delete post data');
        }
    }
}

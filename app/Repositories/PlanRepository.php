<?php
namespace App\Repositories;

use App\Models\Plan;

class PlanRepository
{
	 /**
     * @var Plan
     */
    protected Plan $plan;

    /**
     * Plan constructor.
     *
     * @param Plan $plan
     */
    public function __construct(Plan $plan)
    {
        $this->plan = $plan;
    }

    /**
     * Get all plan.
     *
     * @return Plan $plan
     */
    public function all()
    {
        return $this->plan->get();
    }

     /**
     * Get plan by id
     *
     * @param $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->plan->find($id);
    }

    /**
     * Save Plan
     *
     * @param $data
     * @return Plan
     */
     public function save(array $data)
    {
        return Plan::create($data);
    }

     /**
     * Update Plan
     *
     * @param $data
     * @return Plan
     */
    public function update(array $data, int $id)
    {
        $plan = $this->plan->find($id);
        $plan->update($data);
        return $plan;
    }

    /**
     * Delete Plan
     *
     * @param $data
     * @return Plan
     */
   	 public function delete(int $id)
    {
        $plan = $this->plan->find($id);
        $plan->delete();
        return $plan;
    }
}

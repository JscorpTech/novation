<?php

namespace App\Services;

use App\Enums\SubscribeStatusEnum;
use App\Models\Subscribe;
use App\Repositories\CardRepository;
use App\Repositories\SubscribeRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class SubscribeService
{
    /**
     * @var SubscribeRepository $subscribeRepository
     */
    protected $subscribeRepository;

    /**
     * @var CardService $cardService
     */
    protected $cardService;

    /**
     * @var PlanService $planService
     */
    protected $planService;

    /**
     * DummyClass constructor.
     *
     * @param SubscribeRepository $subscribeRepository
     */
    public function __construct(SubscribeRepository $subscribeRepository, CardService $cardService, PlanService $planService)
    {
        $this->subscribeRepository = $subscribeRepository;
        $this->cardService = $cardService;
        $this->planService = $planService;
    }

    /**
     * Get all subscribeRepository.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->subscribeRepository->all();
    }
    public function getMyAll($user_id)
    {
        return $this->subscribeRepository->allMy($user_id);
    }

    /**
     * Get subscribeRepository by id.
     *
     * @param $id
     * @return String
     */
    public function getById(int $id)
    {
        return $this->subscribeRepository->getById($id);
    }
    public function getMyById(int $id, $user_id)
    {
        return $this->subscribeRepository->getMyById($id, $user_id);
    }

    public function isSubscribed($plan_id, $user_id)
    {
        $subscribe = Subscribe::query()->where(['plan_id' => $plan_id, 'user_id' => $user_id, 'status' => SubscribeStatusEnum::ACTIVE])->first();
        if (!$subscribe || $subscribe->quantity <= 0) {
            return true;
        }
        return false;
    }

    /**
     * Validate subscribeRepository data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function save(array $data)
    {
        return $this->subscribeRepository->save($data);
    }

    public function subscribe($data, $user_id)
    {
        $card = $this->cardService->getMeCard($data['card_id'], $user_id);
        if ($card->user_id != $user_id) {
            return throw new InvalidArgumentException('Unable to subscribe to card');
        }
        $plan = $this->planService->getById($data['plan_id'], $user_id);
        $data['user_id'] = $user_id;
        $data['status'] = "active";
        $data['quantity'] = $plan->duration;
        return $this->subscribeRepository->save($data);
    }

    /**
     * Update subscribeRepository data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function update(array $data, int $id)
    {
        DB::beginTransaction();
        try {
            $subscribeRepository = $this->subscribeRepository->update($data, $id);
            DB::commit();
            return $subscribeRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to update post data');
        }
    }

    public function updateMy(array $data, int $id, $user_id)
    {
        DB::beginTransaction();
        try {
            $subscribeRepository = $this->subscribeRepository->updateMy($data, $id, $user_id);
            DB::commit();
            return $subscribeRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to update post data');
        }
    }

    /**
     * Delete subscribeRepository by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById(int $id)
    {
        DB::beginTransaction();
        try {
            $subscribeRepository = $this->subscribeRepository->delete($id);
            DB::commit();
            return $subscribeRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to delete post data');
        }
    }
    public function deleteMyById(int $id, $user_id)
    {
        DB::beginTransaction();
        try {
            $subscribeRepository = $this->subscribeRepository->deleteMy($id, $user_id);
            DB::commit();
            return $subscribeRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to delete post data');
        }
    }
}

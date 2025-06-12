<?php

namespace App\Services;

use App\Models\Card;
use App\Repositories\CardRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class CardService
{
    /**
     * @var CardRepository $cardRepository
     */
    protected $cardRepository;

    /**
     * DummyClass constructor.
     *
     * @param CardRepository $cardRepository
     */
    public function __construct(CardRepository $cardRepository)
    {
        $this->cardRepository = $cardRepository;
    }

    /**
     * Get all cardRepository.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->cardRepository->all();
    }

    public function getMeCards($user_id)
    {
        return $this->cardRepository->getMeCards($user_id);
    }

    public function getMeCard($id, $user_id)
    {
        return $this->cardRepository->getMeCard($id, $user_id);
    }

    /**
     * Get cardRepository by id.
     *
     * @param $id
     * @return String
     */
    public function getById(int $id)
    {
        return $this->cardRepository->getById($id);
    }

    /**
     * Validate cardRepository data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function save(array $data)
    {
        return $this->cardRepository->save($data);
    }

    /**
     * Update cardRepository data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function update(array $data, int $id)
    {
        DB::beginTransaction();
        try {
            $cardRepository = $this->cardRepository->update($data, $id);
            DB::commit();
            return $cardRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to update post data');
        }
    }

    public function updateMeCard(array $data, int $id, $user_id)
    {
        DB::beginTransaction();
        try {
            $cardRepository = $this->cardRepository->updateMeCard($data, $id, $user_id);
            DB::commit();
            return $cardRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to update post data');
        }
    }

    /**
     * Delete cardRepository by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById(int $id)
    {
        DB::beginTransaction();
        try {
            $cardRepository = $this->cardRepository->delete($id);
            DB::commit();
            return $cardRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to delete post data');
        }
    }
    public function deleteByIdMeCard(int $id, $user_id)
    {
        DB::beginTransaction();
        try {
            $cardRepository = $this->cardRepository->deleteMeCard($id, $user_id);
            DB::commit();
            return $cardRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to delete post data');
        }
    }
}

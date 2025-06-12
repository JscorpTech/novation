<?php

namespace App\Repositories;

use App\Models\Card;

class CardRepository
{
    /**
     * @var Card
     */
    protected Card $card;

    /**
     * Card constructor.
     *
     * @param Card $card
     */
    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    /**
     * Get all card.
     *
     * @return Card $card
     */
    public function all()
    {
        return $this->card->get();
    }
    public function getMeCards($user_id)
    {
        return $this->card->where(["user_id" => $user_id])->get();
    }

    public function getMeCard($id, $user_id)
    {
        return $this->card->where(["user_id" => $user_id, "id" => $id])->first();
    }

    /**
     * Get card by id
     *
     * @param $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->card->find($id);
    }

    /**
     * Save Card
     *
     * @param $data
     * @return Card
     */
    public function save(array $data)
    {
        return Card::create($data);
    }

    /**
     * Update Card
     *
     * @param $data
     * @return Card
     */
    public function update(array $data, int $id)
    {
        $card = $this->card->find($id);
        $card->update($data);
        return $card;
    }

    public function updateMeCard(array $data, int $id, $user_id)
    {
        $card = $this->card->where(['id' => $id, "user_id" => $user_id]);
        $card->update($data);
        return $card;
    }

    /**
     * Delete Card
     *
     * @param $data
     * @return Card
     */
    public function delete(int $id)
    {
        $card = $this->card->find($id);
        $card->delete();
        return $card;
    }

    public function deleteMeCard(int $id, $user_id)
    {
        $card = $this->card->where(['id' => $id, "user_id" => $user_id]);
        $card->delete();
        return $card;
    }
}

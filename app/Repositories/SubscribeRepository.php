<?php

namespace App\Repositories;

use App\Models\Subscribe;

class SubscribeRepository
{
    /**
     * @var Subscribe
     */
    protected Subscribe $subscribe;

    /**
     * Subscribe constructor.
     *
     * @param Subscribe $subscribe
     */
    public function __construct(Subscribe $subscribe)
    {
        $this->subscribe = $subscribe;
    }

    /**
     * Get all subscribe.
     *
     * @return Subscribe $subscribe
     */
    public function all()
    {
        return $this->subscribe->get();
    }

    public function allMy($user_id)
    {
        return $this->subscribe->where(['user_id' => $user_id])->get();
    }

    /**
     * Get subscribe by id
     *
     * @param $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->subscribe->find($id);
    }

    public function getMyById(int $id, $user_id)
    {
        return $this->subscribe->where(['id' => $id, "user_id" => $user_id])->first();
    }

    /**
     * Save Subscribe
     *
     * @param $data
     * @return Subscribe
     */
    public function save(array $data)
    {
        return Subscribe::create($data);
    }

    /**
     * Update Subscribe
     *
     * @param $data
     * @return Subscribe
     */
    public function update(array $data, int $id)
    {
        $subscribe = $this->subscribe->find($id);
        $subscribe->update($data);
        return $subscribe;
    }
    public function updateMy(array $data, int $id, $user_id)
    {
        $subscribe = $this->subscribe->where(['id' => $id, "user_id" => $user_id]);
        $subscribe->update($data);
        return $subscribe;
    }

    /**
     * Delete Subscribe
     *
     * @param $data
     * @return Subscribe
     */
    public function delete(int $id)
    {
        $subscribe = $this->subscribe->find($id);
        $subscribe->delete();
        return $subscribe;
    }
    public function deleteMy(int $id, $user_id)
    {
        $subscribe = $this->subscribe->where(['id' => $id, "user_id" => $user_id]);
        $subscribe->delete();
        return $subscribe;
    }
}

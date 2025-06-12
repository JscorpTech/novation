<?php

namespace App\Services;

use App\Enums\OrderPaymentStatusEnum;
use App\Enums\SubscribeStatusEnum;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Subscribe;
use App\Repositories\OrderRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class OrderService
{
    /**
     * @var OrderRepository $orderRepository
     */
    protected $orderRepository;
    protected $subscribeService;

    /**
     * DummyClass constructor.
     *
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository, SubscribeService $subscribeService)
    {
        $this->orderRepository = $orderRepository;
        $this->subscribeService = $subscribeService;
    }

    public function checkout($user_id)
    {
        $carts = Cart::where('user_id', $user_id);
        DB::beginTransaction();
        try {
            if ($carts->count() == 0) {
                throw new InvalidArgumentException('Cart is empty');
            }

            $order = $this->save([
                "user_id" => $user_id,
                "status" => OrderPaymentStatusEnum::PENDING
            ]);

            $orderItemsData = [];
            $bundleIds = [];

            $original_price = 0;
            $price = 0;
            foreach ($carts->get() as $cart) {
                if ($this->subscribeService->isSubscribed($cart->plan_id, $user_id)) {
                    throw new InvalidArgumentException('Unable to subscribe to plan');
                }
                $orderItemsData[] = [
                    "order_id" => $order->id,
                    "bundle_id" => $cart->bundle_id,
                    "price" => $cart->price,
                    "original_price" => $cart->original_price,
                    "discount" => $cart->discount,
                    "plan_id" => $cart->plan_id,
                    "promocode_id" => $cart->promocode_id,
                ];
                $bundleIds[] = $cart->bundle_id;
                $original_price += $cart->original_price;
                $price += $cart->price;
            }
            OrderItem::insert($orderItemsData);

            $order->price = $price;
            $order->original_price = $original_price;
            $order->save();
            $carts->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw $e;
        }

        return $order;
    }

    public function payment_verify($id)
    {
        $order = $this->getById($id);
        if ($order->status != OrderPaymentStatusEnum::PENDING->value) {
            throw new InvalidArgumentException('Order is not pending');
        }
        foreach ($order->items as $item) {
            $plan = $item->plan;
            $subscribe = Subscribe::query()->where(['plan_id' => $plan->id, 'user_id' => $order->user_id])->first();
            if ($this->subscribeService->isSubscribed($plan->id, $order->user_id)) {
                throw new InvalidArgumentException('Unable to subscribe to plan');
            }
            $subscribe->quantity -= 1;
            $subscribe->save();
        }
        $order->status = OrderPaymentStatusEnum::PAID;
        $order->save();
        return $order;
    }

    /**
     * Get all orderRepository.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->orderRepository->all();
    }

    /**
     * Get orderRepository by id.
     *
     * @param $id
     * @return Order
     */
    public function getById(int $id)
    {
        return $this->orderRepository->getById($id);
    }

    /**
     * Validate orderRepository data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return Order
     */
    public function save(array $data)
    {
        return $this->orderRepository->save($data);
    }

    /**
     * Update orderRepository data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function update(array $data, int $id)
    {
        DB::beginTransaction();
        try {
            $orderRepository = $this->orderRepository->update($data, $id);
            DB::commit();
            return $orderRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to update post data');
        }
    }

    /**
     * Delete orderRepository by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById(int $id)
    {
        DB::beginTransaction();
        try {
            $orderRepository = $this->orderRepository->delete($id);
            DB::commit();
            return $orderRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to delete post data');
        }
    }
}

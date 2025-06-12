<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Cart;
use App\Models\Subscribe;
use App\Repositories\CartRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class CartService
{
    /**
     * @var CartRepository $cartRepository
     */
    protected $cartRepository;
    protected $bundleService;
    protected $bundleItemService;
    protected $productService;
    protected $promocodeService;
    protected $planService;

    /**
     * DummyClass constructor.
     *
     * @param CartRepository $cartRepository
     */
    public function __construct(CartRepository $cartRepository, ProductBundleService $bundleService, ProductBundleItemService $bundleItemService, ProductService $productService, PromocodeService $promocodeService, PlanService $planService)
    {
        $this->cartRepository = $cartRepository;
        $this->bundleService = $bundleService;
        $this->bundleItemService = $bundleItemService;
        $this->productService = $productService;
        $this->promocodeService = $promocodeService;
        $this->planService = $planService;
    }

    /**
     * Get all cartRepository.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->cartRepository->all();
    }

    public function paginate()
    {
        return $this->cartRepository->paginate();
    }

    /**
     * Get cartRepository by id.
     *
     * @param $id
     * @return String
     */
    public function getById(int $id)
    {
        return $this->cartRepository->getById($id);
    }

    /**
     * Validate cartRepository data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function save(array $data, $user_id)
    {
        DB::beginTransaction();
        try {
            $bundle = $this->bundleService->save([
                "user_id" => $user_id
            ]);
            $count = 0;
            foreach ($data['products'] as $item) {
                $count += $item['count'];
                $this->bundleItemService->save([
                    "product_id" => $item['id'],
                    "bundle_id" => $bundle->id,
                    "count" => $item['count'],
                    "price" => $this->productService->getById($item['id'])->price,
                ]);
            }
            if ($count != 4) {
                throw new InvalidArgumentException('Product count must be 4');
            }
            $discount = 0;
            if (isset($data['promocode']) && $data['promocode'] != null) {
                $promocode = $this->promocodeService->getByCode($data['promocode']);
                if ($promocode) {
                    if ($promocode->quantity == 0) {
                        throw new InvalidArgumentException('Promocode is expired');
                    }
                    if ($promocode->quantity != -1) {
                        $promocode->quantity -= 1;
                        $promocode->save();
                    }
                    $data['promocode_id'] = $promocode->id;
                    $discount += $promocode->discount;
                } else {
                    throw new InvalidArgumentException('Promocode not found');
                }
            }
            if (isset($data['plan_id'])) {
                $plan = $this->planService->getById($data['plan_id']);
                if (Subscribe::query()->where(['plan_id' => $plan->id, "user_id" => $user_id])->count() <= 0) {
                    throw new InvalidArgumentException('This plan is not available for you');
                }
                $discount += $plan->discount;
                $data['plan_id'] = $plan->id;
            }
            $data['user_id'] = $user_id;
            $data['bundle_id'] = $bundle->id;
            $data['discount'] = $discount;
            $cart = $this->cartRepository->save($data);
            DB::commit();
            return $cart;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw $e;
        }
    }

    /**
     * Update cartRepository data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function update(array $data, int $id)
    {
        DB::beginTransaction();
        try {
            $cartRepository = $this->cartRepository->update($data, $id);
            DB::commit();
            return $cartRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to update post data');
        }
    }

    /**
     * Delete cartRepository by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById(int $id)
    {
        DB::beginTransaction();
        try {
            $cartRepository = $this->cartRepository->delete($id);
            DB::commit();
            return $cartRepository;
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            throw new InvalidArgumentException('Unable to delete post data');
        }
    }
}

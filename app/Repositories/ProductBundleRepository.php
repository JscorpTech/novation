<?php
namespace App\Repositories;

use App\Models\ProductBundle;

class ProductBundleRepository
{
	 /**
     * @var ProductBundle
     */
    protected ProductBundle $productBundle;

    /**
     * ProductBundle constructor.
     *
     * @param ProductBundle $productBundle
     */
    public function __construct(ProductBundle $productBundle)
    {
        $this->productBundle = $productBundle;
    }

    /**
     * Get all productBundle.
     *
     * @return ProductBundle $productBundle
     */
    public function all()
    {
        return $this->productBundle->get();
    }

     /**
     * Get productBundle by id
     *
     * @param $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->productBundle->find($id);
    }

    /**
     * Save ProductBundle
     *
     * @param $data
     * @return ProductBundle
     */
     public function save(array $data)
    {
        return ProductBundle::create($data);
    }

     /**
     * Update ProductBundle
     *
     * @param $data
     * @return ProductBundle
     */
    public function update(array $data, int $id)
    {
        $productBundle = $this->productBundle->find($id);
        $productBundle->update($data);
        return $productBundle;
    }

    /**
     * Delete ProductBundle
     *
     * @param $data
     * @return ProductBundle
     */
   	 public function delete(int $id)
    {
        $productBundle = $this->productBundle->find($id);
        $productBundle->delete();
        return $productBundle;
    }
}

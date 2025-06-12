<?php
namespace App\Repositories;

use App\Models\ProductBundleItem;

class ProductBundleItemRepository
{
	 /**
     * @var ProductBundleItem
     */
    protected ProductBundleItem $productBundleItem;

    /**
     * ProductBundleItem constructor.
     *
     * @param ProductBundleItem $productBundleItem
     */
    public function __construct(ProductBundleItem $productBundleItem)
    {
        $this->productBundleItem = $productBundleItem;
    }

    /**
     * Get all productBundleItem.
     *
     * @return ProductBundleItem $productBundleItem
     */
    public function all()
    {
        return $this->productBundleItem->get();
    }

     /**
     * Get productBundleItem by id
     *
     * @param $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->productBundleItem->find($id);
    }

    /**
     * Save ProductBundleItem
     *
     * @param $data
     * @return ProductBundleItem
     */
     public function save(array $data)
    {
        return ProductBundleItem::create($data);
    }

     /**
     * Update ProductBundleItem
     *
     * @param $data
     * @return ProductBundleItem
     */
    public function update(array $data, int $id)
    {
        $productBundleItem = $this->productBundleItem->find($id);
        $productBundleItem->update($data);
        return $productBundleItem;
    }

    /**
     * Delete ProductBundleItem
     *
     * @param $data
     * @return ProductBundleItem
     */
   	 public function delete(int $id)
    {
        $productBundleItem = $this->productBundleItem->find($id);
        $productBundleItem->delete();
        return $productBundleItem;
    }
}

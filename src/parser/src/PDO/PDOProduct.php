<?php

namespace Parser\PDO;

use DateTime;
use PDO;
use Parser\Exception\ProductNotCreatedException;

class PDOProduct
{
    const BASE_IMAGE_PATH = '/var/www/shop/image/catalog/parsed/';
    const PROJECT_IMAGE_PATH = 'catalog/parsed/';

    /** @var PDO */
    private $pdo;

    public function __construct()
    {
        $this->pdo = PDOSingleton::getInstance();
        $this->pdo->query("SET NAMES 'utf8'");
        $this->pdo->query("SET CHARACTER SET utf8;");
        $this->pdo->query("SET character_set_connection=utf8;");
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }

    public function getStringDate()
    {
        $date = new DateTime();
        return $date->format('Y-m-d H:m:s');
    }

    public function createProduct($productModel, $sku='without sku', $price=0, $status=1)
    {
        $datetime = $this->getStringDate();

        $sql = "INSERT INTO shop_product (model,date_available,sku,upc,ean,jan,isbn,mpn,location,stock_status_id,manufacturer_id,tax_class_id,date_added,date_modified,price,status)
                VALUES (?,?,?,0,0,0,0,0,0,0,0,0,?,?,?,?)";
        $stmt = $this->getPDO()->prepare($sql);
        if (!$stmt->execute([$productModel, $datetime, $sku, $datetime, $datetime, $price, $status])) {
            throw new ProductNotCreatedException("Product: {$productModel}, not created");
        }
    }

    public function findLastCreatedProductId()
    {
        $sql = "SELECT product_id FROM shop_product ORDER BY product_id DESC LIMIT 1";
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetch()['product_id'];
    }

    public function createProductToCategory($categoryId, $productId=null)
    {
        if ($productId === null) {
            $productId = $this->findLastCreatedProductId();
        }

        $sql = "INSERT INTO shop_product_to_category (product_id,category_id) VALUES (?,?)";
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->execute([$productId, $categoryId]);
    }

    public function createProductToStore($storeId=0, $productId=null)
    {
        if ($productId === null) {
            $productId = $this->findLastCreatedProductId();
        }

        $sql = "INSERT INTO shop_product_to_store (product_id,store_id) VALUES (?,?)";
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->execute([$productId, $storeId]);
    }

    public function createProductDescription($productName, $productDescription, $tag, $metaTitle, $metaDescription, $metaKeyword, $metaH1, $productId=null, $language=1)
    {
        if ($productId === null) {
            $productId = $this->findLastCreatedProductId();
        }

        $sql = "INSERT INTO shop_product_description (product_id,language_id,`name`,description,tag,meta_title,meta_description,meta_keyword,meta_h1)
                VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->execute([$productId, $language, $productName, $productDescription, $tag, $metaTitle, $metaDescription, $metaKeyword, $metaH1]);
    }

    public function parseAndUpdateProductImage($imgUrl, $counter=1, $productId=null)
    {
        if ($productId === null) {
            $productId = $this->findLastCreatedProductId();
        }

        $imageName = "{$productId}_{$counter}.jpg";

        $fileContents = file_get_contents($imgUrl);
        file_put_contents(self::BASE_IMAGE_PATH.$imageName, $fileContents);
        chmod(self::BASE_IMAGE_PATH.$imageName, 0777);

        $dbImagePath = self::PROJECT_IMAGE_PATH.$imageName;
        $sql = "UPDATE shop_product SET image = '{$dbImagePath}' WHERE product_id = ?";
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->execute([$productId]);
    }
}
<?php

namespace Parser\PDO;

use Parser\Exception\CategoryNotCreatedException;
use DateTime;
use PDO;

class PDOCategory
{
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

    public function findCategoryIdByName($name)
    {
        $sqlFindCategoryByName = "SELECT category_id FROM shop_category_description WHERE `name` = ?";
        $stmtFindCategoryIdByName = $this->getPDO()->prepare($sqlFindCategoryByName);
        $stmtFindCategoryIdByName->execute([$name]);
        $categoryId = $stmtFindCategoryIdByName->fetch();

        if (!$categoryId) {
            return null;
        }

        return (int)$categoryId['category_id'];
    }

    public function createCategory($categoryTitle, $parentId=0, $top=1, $column=1, $sortOrder=5, $status=1)
    {
        $sqlCreateCategory = "INSERT INTO shop_category (parent_id,top,`column`,sort_order,`status`,date_added,date_modified)
                              VALUES(?,?,?,?,?,?,?)";
        $stmtCreateCategory = $this->getPDO()->prepare($sqlCreateCategory);

        $dateFormat = $this->getStringDate();
        if(!$stmtCreateCategory->execute([$parentId, $top, $column, $sortOrder, $status, $dateFormat, $dateFormat])) {
            throw new CategoryNotCreatedException("Category: {$categoryTitle}, not created");
        }
    }

    public function findLastCreatedCategoryId()
    {
        $sqlFindCategoryId = "SELECT category_id FROM shop_category ORDER BY category_id DESC LIMIT 1";
        $stmtFindCategoryId = $this->getPDO()->prepare($sqlFindCategoryId);
        $stmtFindCategoryId->execute();
        return (int)$stmtFindCategoryId->fetch()['category_id'];
    }

    public function createCategoryDescription($categoryName, $categoryId=null, $language=2)
    {
        if ($categoryId === null) {
            $categoryId = $this->findLastCreatedCategoryId();
        }

        $sqlCreateCategoryDesc = "INSERT INTO shop_category_description (category_id,language_id,`name`,description,meta_title,meta_description,meta_keyword)
                                  VALUES (?,?,?,?,?,?,?)";
        $stmtCreateCategoryDesc = $this->getPDO()->prepare($sqlCreateCategoryDesc);
        $stmtCreateCategoryDesc = $stmtCreateCategoryDesc
            ->execute([$categoryId, $language, $categoryName, $categoryName, $categoryName, $categoryName, $categoryName]);
    }

    public function createCategoryToStore($categoryId=null, $storeId=0)
    {
        if ($categoryId === null) {
            $categoryId = $this->findLastCreatedCategoryId();
        }

        $sqlCreateCategoryToStore = "INSERT INTO shop_category_to_store (category_id,store_id) VALUES (?,?)";
        $stmtCreateCategoryToStore = $this->getPDO()->prepare($sqlCreateCategoryToStore);
        $stmtCreateCategoryToStore->execute([$categoryId, $storeId]);
    }

    public function createCategoryToProduct($productId, $categoryId=null)
    {
        if ($categoryId === null) {
            $categoryId = $this->findLastCreatedCategoryId();
        }

        $sqlCreateProductToCategory = "INSERT INTO shop_product_to_category (product_id,category_id) VALUES (?,?)";
        $stmtCreateProductToCategory = $this->getPDO()->prepare($sqlCreateProductToCategory);
        $stmtCreateProductToCategory->execute([$productId, $categoryId]);
    }
}
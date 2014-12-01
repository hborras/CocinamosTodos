<?php
/**
 * Created by PhpStorm.
 * User: plagueis
 * Date: 30/11/14
 * Time: 14:04
 */

namespace AppBundle\Entity;

interface CategoryManagerInterface {

    /**
     * @return mixed
     */
    public function createCategory();

    /**
     * @param Category $category
     * @return mixed
     */
    public function deleteCategory(Category $category);

    public function updateCategory(Category $category);

    public function getClass();

    public function saveCategory(Category $category);

    public function findCategories($root);

    public function findCategoryBySlug($slug);


} 
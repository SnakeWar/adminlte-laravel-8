<?php


namespace App\Http\Views;

use App\Models\CategoriesProduct;

class CategoryViewComposer
{
    private $model;

    public function __construct(CategoriesProduct $model)
    {
        $this->model = $model;
    }

    public function compose($view)
    {
        $categories = $this->model->all();
        //dd($categories);
        return $view->with('categories',  $categories);
    }
}

<?php

namespace App\Admin\Controllers;

use App\Categories;
use App\Category_detail;
use App\Product;
use App\ProductDetail;
use App\User;
use Carbon\Carbon;


use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class AdminProductController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Product::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('product_name');
            $grid->column('product_price');
            $grid->column('product_description');
            $grid->column('product_qty');
            $grid->column('product_img');
            $grid->column('sold_qty');
            $grid->column('category_id');
            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Product::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->select('category_id')->options(Categories::all()->pluck('category_name', 'id'));

            $form->text('product_name','Product Name: ');
            $form->text('product_description','Product Description: ');

            $form->number('product_price','Price: ');
            $form->number('product_qty','Quantity: ');
            $form->number('product_sold','Total Product Sold: ');

            $form->image('product_img');

            $form->display('created_at', 'Created At');
            $form->datetime('updated_at', 'Updated At')->default(now('Asia/Jakarta'));

//            ->default(now('	Asia/Jakarta')
        });

    }

}

<?php

namespace App\Admin\Controllers;

use App\Models\Config;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ConfigController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title;

    public function __construct()
    {

        $this->title =__('Config', [], app()->getLocale());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Config());

        $grid->column('id', __('Id'));
        $grid->column('name_cn', __('Name cn'));
        $grid->column('name_en', __('Name en'));
        $grid->column('address_cn', __('Address cn'));
        $grid->column('address_en', __('Address en'));
        $grid->column('email', __('Email'));
        $grid->column('tel', __('Tel'));
        $grid->column('copyright', __('Copyright'));
        $grid->column('icp', __('Icp'));
        $grid->column('created_at', __('Created at'))->hide();
        $grid->column('updated_at', __('Updated at'))->hide();

        //禁用创建按钮
        $grid->disableCreateButton();

        $grid->actions(function ($actions) {
            $actions->disableView();
            //  $actions->disableEdit();
            $actions->disableDelete();
        });

        $grid->tools(function ($tools) {
            // 禁用批量删除按钮
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Config::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name_cn', __('Name cn'));
        $show->field('name_en', __('Name en'));
        $show->field('address_cn', __('Address cn'));
        $show->field('address_en', __('Address en'));
        $show->field('email', __('Email'));
        $show->field('tel', __('Tel'));
        $show->field('copyright', __('Copyright'));
        $show->field('icp', __('Icp'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Config());

        $form->text('name_cn', __('Name cn'));
        $form->text('name_en', __('Name en'));
        $form->text('address_cn', __('Address cn'));
        $form->text('address_en', __('Address en'));
        $form->email('email', __('Email'));
        $form->text('tel', __('Tel'));
        $form->textarea('copyright', __('Copyright'));
        $form->text('icp', __('Icp'));

        return $form;
    }
}

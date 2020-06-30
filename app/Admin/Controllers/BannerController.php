<?php

namespace App\Admin\Controllers;

use App\Models\Banner;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BannerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Banner';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Banner());

        $grid->column('id', __('Id'));
        $grid->column('image', __('Image'))->image();
        $states = [
            'on'  => ['value' => 1, 'text' => __('Cn'), 'color' => 'success'],
            'off' => ['value' => 0, 'text' => __('En'), 'color' => 'danger'],
        ];
        $grid->column('language', __('Language'))->switch($states);
        $grid->column('sort_order', __('Sort order'))->sortable()->editable()->help('按数字大小正序排序');
        $grid->column('created_at', __('Created at'))->hide();
        $grid->column('updated_at', __('Updated at'))->hide();

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
        $show = new Show(Banner::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('image', __('Image'));
        $show->field('language', __('Language'));
        $show->field('sort_order', __('Sort order'));
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
        $form = new Form(new Banner());

        $form->image('image', __('Image'))->rules('required|image');
        $states = [
            'on'  => ['value' => 1, 'text' => __('Cn'), 'color' => 'success'],
            'off' => ['value' => 0, 'text' => __('En'), 'color' => 'danger'],
        ];
        $form->switch('language', __('Language'))->states($states)->default(1);
        $form->number('sort_order', __('Sort order'))->default(99);

        return $form;
    }
}

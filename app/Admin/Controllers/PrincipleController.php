<?php

namespace App\Admin\Controllers;

use App\Models\Principle;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PrincipleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Principle';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Principle());

        $grid->column('id', __('Id'));
        $grid->column('images', __('Images'))->carousel();
        $grid->column('description', __('Description'));
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
        $show = new Show(Principle::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('images', __('Images'));
        $show->field('description', __('Description'));
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
        $form = new Form(new Principle());

        $form->multipleImage('images', __('Images'))->rules('required|image')->removable()->sortable();

        $form->textarea('description', __('Description'));
        $states = [
            'on'  => ['value' => 1, 'text' => __('Cn'), 'color' => 'success'],
            'off' => ['value' => 0, 'text' => __('En'), 'color' => 'danger'],
        ];
        $form->switch('language', __('Language'))->states($states)->default(1);
        $form->number('sort_order', __('Sort order'))->default(99);

        return $form;
    }
}

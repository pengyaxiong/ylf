<?php

namespace App\Admin\Controllers;

use App\Models\Team;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TeamController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Team';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Team());

        $grid->column('id', __('Id'));
        $grid->column('image', __('Image'))->image();
        $grid->column('name', __('Name'));
        $grid->column('department', __('Department'));
        $grid->column('description', __('Description'))->hide();
        $states = [
            'on'  => ['value' => 1, 'text' => 'cn', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'en', 'color' => 'danger'],
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
        $show = new Show(Team::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('image', __('Image'));
        $show->field('name', __('Name'));
        $show->field('department', __('Department'));
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
        $form = new Form(new Team());

        $form->image('image', __('Image'))->rules('required|image');
        $form->text('name', __('Name'))->rules('required');
        $form->text('department', __('Department'))->rules('required');
        $form->textarea('description', __('Description'))->rules('required');
        $states = [
            'on' => ['value' => 1, 'text' => 'cn', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'en', 'color' => 'danger'],
        ];
        $form->switch('language', __('Language'))->states($states)->default(1);
        $form->number('sort_order', __('Sort order'))->default(99);

        return $form;
    }
}

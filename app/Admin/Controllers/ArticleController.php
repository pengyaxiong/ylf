<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title;

    public function __construct()
    {

        $this->title =__('Article', [], app()->getLocale());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article());

        $grid->column('id', __('Id'));
        $grid->column('category.name', __('Category id'))->link(route('admin.categories.index'));
        $grid->column('image', __('Image'))->image();
        $grid->column('title', __('Title'));
        $grid->column('author', __('Author'));
        $grid->column('time', __('Time'));
        $grid->column('contact', __('Contact'))->hide();
        $grid->column('description', __('Description'))->hide();
        $grid->column('sort_order', __('Sort order'))->sortable()->editable()->help('按数字大小正序排序');
        $grid->column('created_at', __('Created at'))->hide();
        $grid->column('updated_at', __('Updated at'))->hide();

        $grid->filter(function ($filter) {
            $filter->like('title', __('Title'));

            $categories = Category::all()->toArray();
            $select_array = array_column($categories, 'name', 'id');

            $filter->equal('category_id', __('Category id'))->select($select_array);

            $filter->between('created_at', __('Created at'))->date();

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
        $show = new Show(Article::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('category_id', __('Category id'));
        $show->field('image', __('Image'));
        $show->field('title', __('Title'));
        $show->field('author', __('Author'));
        $show->field('time', __('Time'));
        $show->field('contact', __('Contact'));
        $show->field('description', __('Description'));
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
        $form = new Form(new Article());

        $categories = Category::all()->toArray();
        $select_array = array_column($categories, 'name', 'id');
        //创建select
        $form->select('category_id', '分类')->options($select_array);

        $form->image('image', __('Image'))->rules('required|image');
        $form->text('title', __('Title'))->rules('required');
        $form->text('author', __('Author'))->rules('required');
        $form->datetime('time', __('Time'))->default(date('Y-m-d H:i:s'));
        $form->textarea('description', __('Description'))->rules('required');
        $form->ueditor('contact', __('Contact'));
        $form->number('sort_order', __('Sort order'))->default(99);

        return $form;
    }
}

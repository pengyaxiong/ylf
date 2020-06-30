<?php

namespace App\Admin\Controllers;

use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Hash;
class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('email', __('Email'));
        $grid->column('openid', __('Openid'));
        $grid->column('nickname', __('Nickname'));
        $grid->column('headimgurl', __('Headimgurl'));
        $states = [
            'on'  => ['value' => 1, 'text' => __('Advanced'), 'color' => 'success'],
            'off' => ['value' => 0, 'text' => __('General'), 'color' => 'danger'],
        ];
        $grid->column('grade', __('Grade'))->switch($states);

        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        //禁用创建按钮
      //  $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            // $actions->disableView();
            $actions->disableEdit();
            $actions->disableDelete();
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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('email', __('Email'));
        $show->field('openid', __('Openid'));
        $show->field('nickname', __('Nickname'));
        $show->field('sex', __('Sex'));
        $show->field('language', __('Language'));
        $show->field('grade', __('Grade'));
        $show->field('city', __('City'));
        $show->field('province', __('Province'));
        $show->field('headimgurl', __('Headimgurl'));
        $show->field('country', __('Country'));
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
        $form = new Form(new User());

        $form->email('email', __('Email'))->creationRules(['required', "unique:users"]);
        $form->password('password', __('Password'))->rules('required|min:6');
        $form->text('openid', __('Openid'));
        $form->text('nickname', __('Nickname'));
        $form->text('sex', __('Sex'));
        $form->text('language', __('Language'));
        $form->text('city', __('City'));
        $form->text('province', __('Province'));
        $form->text('headimgurl', __('Headimgurl'));
        $form->text('country', __('Country'));
        $states = [
            'on'  => ['value' => 1, 'text' => __('Advanced'), 'color' => 'success'],
            'off' => ['value' => 0, 'text' => __('General'), 'color' => 'danger'],
        ];
        $form->switch('grade', __('Grade'))->states($states)->default(1);

        //保存前回调
        $form->saving(function (Form $form) {
            $form->password=Hash::make($form->password);
        });


        return $form;
    }
}

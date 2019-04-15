<?php

namespace App\Admin\Controllers;

use App\Model\Good;
use App\Model\GoodType;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class GoodController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('商品管理')
            ->description('列表')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('商品管理')
            ->description('详情')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('商品管理')
            ->description('编辑')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('商品管理')
            ->description('创建')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Good);

        $grid->id('Id');
        $grid->goodtype('分类')->name();
        $grid->name('名称');
        $grid->img('图片')->image('', 100, 100);
        $grid->images('多图')->image('', 100, 100);
        $grid->state('状态')->switch(Good::STATE_SWITCH);
        $grid->created_at('创建时间');

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
        $show = new Show(Good::findOrFail($id));

        $show->id('Id');
        $show->goodtype('分类')->name();
        $show->name('名称');
        $show->img('图片')->image('', 100, 100);
        $show->images('多图')->image('', 100, 100);
        $show->brief('简介');
        $show->details('详情')->unescape();
        $show->state('状态')->as(function ($val){
            return Good::STATE_MAP[$val];
        });
        $show->created_at('创建时间');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Good);
        $form->select('type','分类')->options(GoodType::all()->pluck('name','id'));
        $form->text('name', '名称');
        $form->image('img', '图片');
        $form->multipleImage('images', '多图')->removable();
        $form->switch('state', '状态')->states(Good::STATE_SWITCH)->default(Good::STATE_ON);
        $form->textarea('brief', '简介'); 
        $form->UEditor('details', '详情');


        return $form;
    }
}

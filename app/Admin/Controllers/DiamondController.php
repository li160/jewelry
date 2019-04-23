<?php

namespace App\Admin\Controllers;

use App\Model\Diamond;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class DiamondController extends Controller
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
            ->header('钻石管理')
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
            ->header('钻石管理')
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
            ->header('钻石管理')
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
            ->header('钻石管理')
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
        $grid = new Grid(new Diamond());
        $grid->model()->orderBy('weight','desc');
        $grid->id('Id');
        $grid->type('分类')->display(function ($val){
            return Diamond::TYPE_MAP[$val];
        });
        $grid->img('图片')->image('', 100, 100);
        $grid->name('名称');
        $grid->price('价格');
        $grid->weight('权重')->editable();
        $grid->state('状态')->switch(Diamond::STATE_SWITCH);
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
        $show = new Show(Diamond::findOrFail($id));

        $show->id('Id');
        $show->type('分类')->display(function ($val){
            return Diamond::TYPE_MAP[$val];
        });
        $show->img('图片')->image('', 100, 100);
        $show->name('名称');
        $show->price('价格');
        $show->weight('权重');
        $show->state('状态')->as(function ($val){
            return Diamond::STATE_MAP[$val];
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
        $form = new Form(new Diamond);
        $form->radio('type','分类')->options(Diamond::TYPE_MAP)->default(Diamond::TYPE_BARE);
        $form->text('name', '名称');
        $form->image('img', '图片')->uniqueName()->move('diamond')->removable();
        $form->number('price', '单价')->default(0);
        $form->switch('state', '状态')->states(Diamond::STATE_SWITCH)->default(Diamond::STATE_ON);

        return $form;
    }
}

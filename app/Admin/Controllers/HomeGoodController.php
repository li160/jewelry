<?php

namespace App\Admin\Controllers;

use App\Model\HomeGood;
use App\Model\HomeType;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class HomeGoodController extends Controller
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
        $grid = new Grid(new HomeGood());
        $grid->model()->orderBy('weight','desc');
        $grid->id('Id');
        $grid->type()->name('分类');
        $grid->name('名称');
        $grid->img('图片')->image('', 100, 100);
        $grid->number('货号');
        $grid->heft('钻重');
        $grid->colour( '颜色');
        $grid->precision('精度');
        $grid->cut('切工');
        $grid->polishing('抛光');
        $grid->symmetric('对称');
        $grid->fluorescence( '荧光');
        $grid->price('价格')->editable();
        $grid->weight('权重')->editable();
        $grid->width('布局')->editable('select',HomeGood::WIDTH_MAP);
        $grid->state('状态')->switch(HomeGood::STATE_SWITCH);
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
        $show = new Show(HomeGood::findOrFail($id));

        $show->id('Id');
        $show->type()->name('分类');
        $show->name('名称');
        $show->img('图片')->image('', 100, 100);
        $show->price('价格');
        $show->weight('权重');
        $show->width('布局')->as(function ($val){
            return HomeGood::WIDTH_MAP[$val];
        });
        $show->state('状态')->as(function ($val){
            return HomeGood::STATE_MAP[$val];
        });
        $show->details('详情')->unescape();
        $show->number('货号');
        $show->heft('钻重');
        $show->colour( '颜色');
        $show->precision('精度');
        $show->cut('切工');
        $show->polishing('抛光');
        $show->symmetric('对称');
        $show->fluorescence( '荧光');
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
        $form = new Form(new HomeGood);
        $form->tab('基本信息',function ($form){
            $form->select('type_id','分类')->options(HomeType::orderBy('weight','desc')->select()->pluck('name','id'));
            $form->text('name', '名称');
            $form->image('img', '图片')->uniqueName()->move('home')->removable();
            $form->number('price', '单价')->default(0);
            $form->radio('width', '布局')->options(HomeGood::WIDTH_MAP)->default(HomeGood::WIDTH_ONR);
            $form->switch('state', '状态')->states(HomeGood::STATE_SWITCH)->default(HomeGood::STATE_ON);
            $form->number('weight', '权重')->default(0)->max(99);
            $form->editor('details', '详情');
        })->tab('产品参数',function ($form){
            $form->text('number', '货号');
            $form->text('heft', '钻重');
            $form->text('colour', '颜色');
            $form->text('precision', '精度');
            $form->text('cut', '切工');
            $form->text('polishing', '抛光');
            $form->text('symmetric', '对称');
            $form->text('fluorescence', '荧光');
        });



        return $form;
    }
}

<?php
/**
 * WangEditor.php
 *
 * @author FengQJ <99756834@qq.com>
 * @date   : 2018/12/8 9:49
 */

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;


class WangEditor extends Field
{
    protected $view = 'admin.wang-editor';

    protected static $css = [
        '/vendor/wangEditor-3.1.1/release/wangEditor.min.css',
    ];

    protected static $js = [
        '/vendor/wangEditor-3.1.1/release/wangEditor.min.js',
    ];

    public function render()
    {
        $name = $this->formatName($this->column);
      
        $this->script = <<<EOT

var E = window.wangEditor
var editor = new E('#{$this->id}');
editor.customConfig.zIndex = 0
editor.customConfig.uploadImgHeaders = {
    'X-CSRF-TOKEN': $('input[name="_token"]').val()
}
editor.customConfig.uploadFileName = 'pic[]'
editor.customConfig.uploadImgMaxSize = 3 * 1024 * 1024
editor.customConfig.uploadImgServer = '/admin/uploads/upload'
editor.customConfig.onchange = function (html) {
    $('input[name=\'$name\']').val(html);
}
editor.create()

EOT;
        return parent::render();
    }
}
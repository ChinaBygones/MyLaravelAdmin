<?php

use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;
use Dcat\Admin\Grid\Filter;
use Dcat\Admin\Show;

/**
 * Dcat-admin - admin builder based on Laravel.
 * @author jqh <https://github.com/jqhph>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 *
 * extend custom field:
 * Dcat\Admin\Form::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Column::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Filter::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */
Admin::fonts([]);
$name = admin_setting('admin_name');
$logo = admin_setting('logo');
if (file_exists('storage/' . $logo)) {
    $logo = '<img src="/storage/' . $logo . '" width="35">&nbsp;' . $name;
    $mini = '<img src="/storage/' . $logo . '" >';
} else {
    $logo = config('admin.logo');
    $mini = config('admin.logo-mini');
}
config([
    'admin.name' => $name,
    'admin.logo' => $logo,
]);
// 注册前端组件别名
Admin::asset()->alias('@wang-editor', [
    // 为了方便演示效果，这里直接加载CDN链接，实际开发中可以下载到服务器加载
    'js' => ['https://cdn.jsdelivr.net/npm/wangeditor@4.7.1/dist/wangEditor.min.js'],
]);

Form::extend('editor', \App\Admin\Extensions\Form\WangEditor::class);

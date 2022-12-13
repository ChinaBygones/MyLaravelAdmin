<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;

class Setting extends Form
{
    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return mixed
     */
    public function handle(array $input)
    {
        admin_setting($input);
        return $this
				->response()
				->success('Processed successfully.')
				->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->confirm('您确定要提交设置吗', '部分设置提交之后需要重新刷新一下浏览器才能生效');
        $this->text('admin_name', '网站名称')->default(admin_setting('admin_name', ''));
        $this->url('web_url', '网站地址')->default(admin_setting('web_url', env('APP_URL')))->help('正确填写网址，并且必须以 / 结尾，否则会导致LOGO尤法显示');
        $this->image('logo', '网站LOGO')->accept('jpg,png,gif,jpeg')->maxSize(512)->required()->autoUpload()->help('大小不要超过512K');
//        $this->radio('horizontal menu', '菜单位置')->options([0 => '侧栏', 1 => '顶栏'])->default(admin_setting('horizontal menu', 0));
//        $this->radio('styletype', '网站风格')->options([1 => '旧版', 2 => '大字版'])->default(admin_setting('style type', 2));
//        $this->radio('sidebar style', '侧栏颜色')->options(['light' => '白色', 'dark' => '黑色', 'primary' => '彩色'])->default(admin_setting('sidebar_style', 'dark'));
//        $this->radio('logintheme', '登录页样式')->options(['bigpicture' => '大图', 'simple' => '简单']);
//        $this->image('logobg', '登陆页背景图')->accept('jpgpng,gif,jpeg')->maxSize(1024)->autoUpload()->help('大小不要超过512K，仅在登录页为大图模式下生效');
    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        return [
            'logo' => admin_setting('logo'),
//            'color' => admin_setting('color', 'green'),
//            'body_class' => admin_setting('body_class', 'sidebar-separate'),
//            'sidebar_style' => admin_setting('sidebar_style', 'light'),
//            'bodyclass' => admin_setting('body class', 'sidebar-separate'),
//            'logintheme' => admin_setting('logintheme', 'bigpicture'),
//            'logobg' => admin_setting('logobg'),
//            'horizontal menu' => admin_setting('horizontal menu', 'false'),
//            'style type' => admin_setting('style type', 1),
        ];
    }
}

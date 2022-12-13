<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\Setting;
use App\Http\Controllers\Controller;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Widgets\Card;

class SettingsController extends Controller
{
    public function index(Content $content)
    {
        return $content->title('网站设置')->body(new Card(new Setting()));
    }
}

<?php

namespace App\Http\Controllers\Api;


use app\common\library\Sms;
use App\Http\Controllers\ApiController;
use App\Services\Api\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use think\Validate;


class UserController extends ApiController
{
    protected $request;
    protected $userService;

    public function __construct(UserService $userService,Request $request)
    {
        $this->userService = $userService;
        $this->request = $request;
    }

    /**
     * 会员登录
     *
     * @ApiMethod (POST)
     * @param string $account  账号
     * @param string $password 密码
     */
    public function login()
    {
        $account = $this->request->get('account');
        $password = $this->request->get('password');
        if (!$account || !$password) {
            return $this->error('参数不正确');
        }
        $ret = $this->userService->login($account, $password);
        if ($ret) {
            $data = ['userinfo' => $this->userService->getUserinfo()];
            return $this->success(__('Logged in successful'), $data);
        } else {
            return $this->error($this->userService->getError());
        }
    }

    /**
     * 注册会员
     *
     * @ApiMethod (POST)
     * @param string $username 用户名
     * @param string $password 密码
     * @param string $email    邮箱
     * @param string $mobile   手机号
     * @param string $code     验证码
     */
    public function register()
    {
        $username = $this->request->get('username');
        $password = $this->request->get('password');
        $email = $this->request->get('email');
        $mobile = $this->request->get('mobile');
        if (!$username || !$password) {
            return $this->error('参数不正确');
        }
        if (!$email) {
            return $this->error('邮箱不正确');
        }
        if (!$mobile) {
            return $this->error('手机号不正确');
        }
        $ret = $this->userService->register($username, $password, $email, $mobile, []);
        if ($ret) {
            $data = ['userinfo' => $this->userService->getUserinfo()];
            return $this->success(__('Sign up successful'), $data);
        } else {
            return  $this->error($this->userService->getError());
        }
    }
}

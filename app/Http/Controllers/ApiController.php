<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiController extends Controller
{
    /**
     * request 实例
     * @var
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 操作成功返回的数据
     * @param string $msg    提示信息
     * @param mixed  $data   要返回的数据
     * @param int    $code   错误码，默认为1
     * @param array  $header 发送的 Header 信息
     */
    protected function success($msg = '', $data = null, $code = 1, array $header = [])
    {
        return $this->result($msg, $data, $code, $header);
    }

    /**
     * 操作失败返回的数据
     * @param string $msg    提示信息
     * @param mixed  $data   要返回的数据
     * @param int    $code   错误码，默认为0
     * @param array  $header 发送的 Header 信息
     */
    protected function error($msg = '', $data = null, $code = 0, array $header = [])
    {
        return $this->result($msg, $data, $code, $header);
    }

    /**
     * 返回封装后的 API 数据到客户端
     * @access protected
     * @param mixed  $msg    提示信息
     * @param mixed  $data   要返回的数据
     * @param int    $code   错误码，默认为0
     * @param array  $header 发送的 Header 信息
     * @return void
     * @throws
     */
    protected function result($msg, $data = null, $code = 0, array $header = [])
    {
        $result = [
            'code' => $code,
            'msg'  => $msg,
            'time' => $this->request->server('REQUEST_TIME'),
            'data' => $data,
        ];
        if (isset($header['statuscode'])) {
            $code = $header['statuscode'];
            unset($header['statuscode']);
        } else {
            //未设置状态码,根据code值判断
            $code = $code >= 1000 || $code < 200 ? 200 : $code;
        }

        return response()->json($result, $code,$header);
    }
}

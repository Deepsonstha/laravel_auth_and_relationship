<?php

function responseError($msg, $code = '')
{
    return response([
        'status' => 'error',
        'code' => $code,
        'message' => $msg,
    ], $code != '' ? $code : 400);
}

function responseSuccess($data = [], $msg = '', $code = '')
{
    return response()->json([
        'status' => 'success',
        'message' => $msg,
        'data' => $data,
    ], $code != '' ? $code : 200);
}

function responseSuccessMsg($msg = "", $code = "")
{
    return response([
        'status' => 'success',
        'message' => $msg,
    ], $code != '' ? $code : 200);
}

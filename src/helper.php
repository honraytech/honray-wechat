<?php

use think\wechat\WechatAuth;
use think\Request;

/**
 * [get_wechat_token 获取微信token和openid]
 * @linchuangbin
 * @DateTime  2017-01-05T17:22:06+0800
 * @param     [string]       $appid     [微信配置]
 * @param     [string]       $appsecret [微信配置]
 * @param     [string]       $url       [回调url]
 */
function get_wechat_token($appid, $appsecret, $url)
{
    if(empty($openid) || empty($appsecret) || empty($url)) {
        return 'openid或appsecret或$url 为空';
    }

    $auth = new WechatAuth($config['appid'], $config['appsecret']);
    $code = Request::instance()->param('code');

    if ($code) {
        $ret = $auth->getAccessToken('code',$code);
        $url = $url.'?openid='.$ret['openid'].'&token='.$ret['access_token'];
        redirect($url);
    }

    $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $url = $auth->getRequestCodeURL($url,'snsapi_base','snsapi_userinfo');
    redirect($url);
}

/**
 * [get_wechat_userInfo 获取微信授权用户基本信息]
 * @linchuangbin
 * @DateTime  2017-01-05T17:28:11+0800
 * @param     [string]                   $appid     [微信配置]
 * @param     [string]                   $appsecret [微信配置]
 * @param     [string]                   $token     [token]
 * @return    [array]                               [用户信息]
 */
function get_wechat_userInfo($appid, $appsecret, $token)
{
    if(empty($openid) || empty($appsecret) || empty($token)) {
        return 'openid或appsecret或$token 为空';
    }
    $auth = new WechatAuth($appid, $appsecret);
    $userInfo = $auth->getUserInfo($token);

    return $userInfo;
}

?>
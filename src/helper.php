<?php
use think\wechat\WechatAuth;
use think\wechat\Jssdk;
use think\wechat\WechatOrderPush;
use think\wechat\WechatPicture;

/**
 * [getWechatUrl 获取微信授权跳转url]
 * @linchuangbin
 * @DateTime  2017-01-05T17:22:06+0800
 * @param     [string]       $appid     [微信配置]
 * @param     [string]       $appsecret [微信配置]
 * @param     [string]       $url       [回调url]
 * @param     [string]       $type      [授权方式]
 * @return    [string]                  [跳转url]
 */

function getWechatUrl($appId, $appSecret, $url, $type = 'snsapi_userinfo')
{
    $auth = new WechatAuth($appId, $appSecret);
    $url = $auth->getRequestCodeURL($url, 'snsapi_base', $type);
    return $url;
}

/**
 * [getWechatToken 通过code换取网页授权access_token]
 * @linchuangbin
 * @DateTime  2017-01-05T17:22:06+0800
 * @param     [string]       $appid     [微信配置]
 * @param     [string]       $appsecret [微信配置]
 * @param     [string]       $code      [通过授权获取的code参数]
 * @return    [array]                   [token，openid等信息]
 */
function getWechatToken($appId, $appSecret, $code)
{
    $auth = new WechatAuth($appId, $appSecret);
    $ret = $auth->getAccessToken('code', $code);
    return $ret;
}


/**
 * [getWechatUserInfo 获取微信授权用户基本信息]
 * @linchuangbin
 * @DateTime  2017-01-05T17:28:11+0800
 * @param     [string]                   $appid     [微信配置]
 * @param     [string]                   $appsecret [微信配置]
 * @param     [string]                   $token     [token]
 * @param     [string]                   $openid    [用户openid]
 * @return    [array]                               [用户信息]
 */
function getWechatUserInfo($appId, $appSecret, $token, $openid)
{
    $auth = new WechatAuth($appId, $appSecret, $token);
    $userInfo = $auth->getUserInfo($openid);

    return $userInfo;
}

/**
 * [getWechatSignPackage 获取jssdk配置]
 * @linchuangbin
 * @DateTime  2017-01-05T21:07:21+0800
 * @param     [type]                   $appId     [微信配置]
 * @param     [type]                   $appSecret [微信配置]
 * @return    [array]                             [配置数组]
 */
function getWechatSignPackage($appId, $appSecret)
{
    $jssdk = new Jssdk($appId,$appSecret);
    $signPackage = $jssdk->GetSignPackage();

    return $signPackage;
}

/**
 * [wechatOderPush 微信模板消息推送]
 * @linchuangbin
 * @DateTime  2017-01-06T11:22:40+0800
 * @param     [string]                   $appId       [微信配置]
 * @param     [string]                   $appSecret   [微信配置]
 * @param     [string]                   $openid      [用户openid]
 * @param     [string]                   $template_id [模板id]
 * @param     [string]                   $data        [需要发送的消息]
 * @param     [string]                   $topcolor    [模板标题颜色]
 * @param     [string]                   $url         [模板跳转的url]
 * @return    [bool]                                  [返回信息]
 *   
 *    $data = array(
 *        'first'  =>  array('value'=>urlencode("您好,您已购买成功"),'color'=>"#743A3A"),
 *        'name'   =>  array('value'=>urlencode("商品信息:微时代电影票"),'color'=>'#EEEEEE'),
 *        'remark' =>  array('value'=>urlencode('永久有效!密码为:1231313'),'color'=>'#FFFFFF'),
 *    )
 **/
function wechatOderPush($appId, $appSecret, $openid, $template_id, $data, $topcolor = '#7B68EE', $url = '')
{
    $push =  new WechatOrderPush($appId, $appSecret);
    return $push->doSend($openid, $template_id, $data, $topcolor, $url);
}

/**
 * [getWechatPicture 获取微信服务器图片]
 * @linchuangbin
 * @DateTime  2017-01-06T11:22:40+0800
 * @param     [string]                   $appId       [微信配置]
 * @param     [string]                   $appSecret   [微信配置]
 * @param     [string]                   $media_id    [要获取的素材的media_id]
 * @return    [string]                                [返回路径]
 */

function getWechatPicture($appId, $appSecret, $media_id)
{
    $picture = new WechatPicture($appId, $appSecret);
    return $picture->getPicture($media_id);
}

?>
# honray-wechat
thinkphp5 微信开发工具类库

## 安装


> composer require honray/tp5-wechat

 * getWechatUrl($appId, $appSecret, $url, $type = 'snsapi_userinfo')
 * [get_wechat_url 获取微信授权跳转url]
 * @linchuangbin
 * @DateTime  2017-01-05T17:22:06+0800
 * @param     [string]       $appid     [微信配置]
 * @param     [string]       $appsecret [微信配置]
 * @param     [string]       $url       [回调url]
 * @param     [string]       $type      [授权方式]
 * @return    [string]                  [跳转url]

 * getWechatToken($appId, $appSecret, $code)
 * [get_wechat_token 通过code换取网页授权access_token]
 * @linchuangbin
 * @DateTime  2017-01-05T17:22:06+0800
 * @param     [string]       $appid     [微信配置]
 * @param     [string]       $appsecret [微信配置]
 * @param     [string]       $code      [通过授权获取的code参数]
 * @return    [array]                   [token，openid等信息]

 * getWechatUserInfo($appId, $appSecret, $token, $openid)
 * [get_wechat_userInfo 获取微信授权用户基本信息]
 * @linchuangbin
 * @DateTime  2017-01-05T17:28:11+0800
 * @param     [string]                   $appid     [微信配置]
 * @param     [string]                   $appsecret [微信配置]
 * @param     [string]                   $token     [token]
 * @param     [string]                   $openid    [用户openid]
 * @return    [array]                               [用户信息]


 * getWechatSignPackage($appId, $appSecret)
 * [get_wechat_signPackage 获取jssdk配置]
 * @linchuangbin
 * @DateTime  2017-01-05T21:07:21+0800
 * @param     [type]                   $appId     [微信配置]
 * @param     [type]                   $appSecret [微信配置]
 * @return    [array]                             [配置数组]

 * wechatOderPush($appId, $appSecret, $openid, $template_id, $data, $topcolor = '#7B68EE', $url = '')
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
 
 * getWechatPicture($appId, $appSecret, $media_id)
 * [getWechatPicture 获取微信服务器图片]
 * @linchuangbin
 * @DateTime  2017-01-06T11:22:40+0800
 * @param     [string]                   $appId       [微信配置]
 * @param     [string]                   $appSecret   [微信配置]
 * @param     [string]                   $media_id    [要获取的素材的media_id]
 * @return    [string]                                [返回路径]

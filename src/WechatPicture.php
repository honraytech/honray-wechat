<?php

namespace think\wechat;

class WechatPicture {
	
	protected $appid;
	protected $secrect;
	protected $accessToken;
	
    function  __construct($appid, $secrect){
        $this->appid = $appid;
        $this->secrect = $secrect;
        $this->accessToken = $this->getToken($appid, $secrect);
    }
		
    /**
     * @param $appid
     * @param $appsecret
     * @return mixed
     * 获取token
     */
    protected function getToken($appid, $appsecret) {
        if (cache($appid)) {
            $access_token = cache($appid);
        } else {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $appid . "&secret=" . $appsecret;
            $token = $this->request_get($url);
            $token = json_decode(stripslashes($token));
            $arr = json_decode(json_encode($token), true);
            $access_token = $arr['access_token'];
            cache($appid, $access_token, 7200);
        }
        return $access_token;
    }

    /*
     * 发送post请求
     * @param string $url
     * @param string $param
     * @return bool|mixed
     */
    function request_post($url = '', $param = '') {
        if (empty($url) || empty($param)) {
            return false;
        }
        $postUrl = $url;
        $curlPost = $param;
        $ch = curl_init(); //初始化curl
        curl_setopt($ch, CURLOPT_URL, $postUrl); //抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0); //设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1); //post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch); //运行curl
        curl_close($ch);
        return $data;   
    }

    /*
     * 发送get请求
     * @param string $url
     * @return bool|mixed
     */
    function request_get($url = ''){
        if (empty($url)) {
            return false;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
	}
	 
    
	public function getPicture($MEDIA_ID) {
		$url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=".$this->accessToken."&media_id=".$MEDIA_ID;
		
		$ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);    
        curl_setopt($ch, CURLOPT_NOBODY, 0);    //对body进行输出。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $package = curl_exec($ch);
        $httpinfo = curl_getinfo($ch);
       
        curl_close($ch);
        $media = array_merge(array('mediaBody' => $package), $httpinfo);
        
        //求出文件格式
        preg_match('/\w\/(\w+)/i', $media["content_type"], $extmatches);
        $fileExt = $extmatches[1];
        $filename = md5(date('YmdHis').rand(100,999)).".{$fileExt}";
				
        if(is_dir('./uploads/picture/')){
            @mkdir('./uploads/picture/');
            @chmod('./uploads/picture/', 0777);
        }

        $dirname = './uploads/picture/';

        file_put_contents($dirname.$filename,$media['mediaBody']);
        return 'uploads/picture/'.$filename;
    }	  
}	
	 
	
    
	 
	 
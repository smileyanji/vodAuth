<?php
class Authentication
{

    /**
     * @var string accesskey ID
     */
    private static $accesskeyId;

    /**
     * @var string accesskey 비번
     */
    private static $accesskeySecret;

    /**
     * @var string API서버 도메인
     */
    private static $apiDomain;

    /**
     * @var string Token 요청주소
     */
    public static $authenticationtUrl;

    /**
     * @var string 스토리지 검색 주소
     */
    public static $storagesUrl;

    /**
     * @var string
     */
    public static $catagoryUrl;

    /**
     * @var string
     */
    public static $videoUrl;

    /**
     * @var string 스토리지키
     */
    public $storageKey;

    /**
     * @var boolean 토큰 유효기간 초과할때 다시 토큰을 요청했는지
     */
    private $countOvertime;

    /**
     * @var string Token
     */
    public $token;

    /**
     * __construct
     * @param $setting array
     *
     */
    function __construct ( $setting )
    {
        self::$accesskeyId = $setting['accesskeyId'] ;
	self::$accesskeySecret = $setting['accesskeySecret'] ;
	$domain = $setting['apiDomain'] ;
	if ( ! preg_match ( "/\/$/" , $domain ) )
            $domain .= '/' ;

	self::$apiDomain = $domain . $setting['version'] . '/' ;
	$this ->storageKey = $setting['storageKey'] ;
	self::$authenticationtUrl = self::$apiDomain . 'authorization'. '/' ;
	self::$storagesUrl = self::$apiDomain . 'storages' . '/' ;
	self::$catagoryUrl = self::$apiDomain . 'catagories' . '/' ;
	self::$videoUrl = self::$apiDomain . 'videos'. '/' ;
	$this -> countOvertime = FALSE ;
    }


    /**
     * curl 방식으로 api 서버를 접근하기
     * @param string $url api주소
     * @param array $headers 헤더정보
     * @param string $action HTTP ACTION ( GET , POST , PUT , DELETE )
     * @return object return정보
     */
    public static function curl ( $url , $headers , $action , $postData = array () )
    {
	$curl = curl_init () ;
	curl_setopt ( $curl , CURLOPT_URL , $url ) ;
	curl_setopt ( $curl , CURLOPT_HTTPHEADER , $headers ) ;
	curl_setopt ( $curl , CURLOPT_RETURNTRANSFER , true ) ;
	curl_setopt ( $curl , CURLOPT_BINARYTRANSFER , true ) ;
	curl_setopt ( $curl , CURLOPT_REFERER , $_SERVER['SERVER_NAME'] ) ; //client 서버 도메인
	if ( $action == 'POST' )
	{
            curl_setopt ( $curl , CURLOPT_POST , 1 ) ;
            curl_setopt ( $curl , CURLOPT_POSTFIELDS , http_build_query($postData) ) ;
	}
	else
            curl_setopt ( $curl , CURLOPT_CUSTOMREQUEST , $action ) ;
	$re = curl_exec ( $curl ) ;
	curl_close ( $curl ) ;
	return $re ;
    }


    /**
     * getToken
     * @param
     *
     */
    function getToken() 
    {
   	$headers[] = 'AccesskeyID:' . self::$accesskeyId ;
	$headers[] = 'AccesskeySecret:'.self::$accesskeySecret  ;
    	$headers[] = 'RemoteAddr:' . $_SERVER['REMOTE_ADDR'] ;
    	$reqToken = self::curl ( self::$authenticationtUrl , $headers , 'GET' ) ;
    	if ( ! empty ( $reqToken ) )
	{
            $reqToken = json_decode ( $reqToken ) ;
            if ( isset ( $reqToken -> Token ) )
            {
		$this -> token = $reqToken -> Token ;
		return $reqToken -> Token ;
            }
            else
		echo "<script>alert('인증 토큰 생성시 오류발생했습니다.');</script>" ;
        }
	else
            echo "<script>alert('인증 토큰 생성시 오류발생했습니다.');</script>" ;
    }


    /**
     * storageList
     * @param string $token
     * @return
     */
    function storageList ( $token= '' )
    {
    	$_token = $token ? $token : ($this -> token ? $this -> token : NULL ) ;
    	if ( ! $_token )
            return 'No token' ;

	$headers[] = 'Authorization:' . $_token ;
	$re = self::curl ( self::$storagesUrl , $headers , 'GET' ) ;
	return $this -> returnMsg ( $re , __FUNCTION__ ) ; // $re -> totalStorage
    }


    /**
     * storageDetail
     * @param string $storageKey
     * @param string $token
     * @return
     *
     */
    function storageDetail ( $storageKey = '' , $token = '' )
    {
	$_token = $token ? $token : ($this -> token ? $this -> token : NULL ) ;
	if ( ! $_token )
            return 'No token' ;

	$key = $storageKey ? $storageKey : ($this -> storageKey ? $this -> storageKey : NULL ) ;
	if ( ! $key )
            return 'No storage key' ;

	$headers[] = 'Authorization:' . $_token ;
	$re = self::curl ( self::$storagesUrl . $key , $headers , 'GET' ) ;
	return $this -> returnMsg ( $re , __FUNCTION__ ) ;
    }


    /**
     * totalStorage
     * @param string $storageKey
     * @param string $token
     * @return
     */
    function totalStorage ( $storageKey = '' , $token = '' )
    {
	$_token = $token ? $token : ($this -> token ? $this -> token : NULL ) ;
	if ( ! $_token )
            return 'No token' ;

	$key = $storageKey ? $storageKey : ($this -> storageKey ? $this -> storageKey : NULL ) ;
	if ( ! $key )
            return 'No storage key' ;

	$headers[] = 'Authorization:' . $_token ;
	$re = self::curl ( self::$storagesUrl . $key . '?action=total' , $headers , 'GET' ) ;
	return $this -> returnMsg ( $re , __FUNCTION__ ) ;
    }


    /**
     * restStorage
     * @param string $storageKey
     * @param string $token
     * @return
     */
    function restStorage ( $storageKey = '' , $token = '' )
    {
        $_token = $token ? $token : ($this -> token ? $this -> token : NULL ) ;
        if ( ! $_token )
            return 'No token' ;

        $key = $storageKey ? $storageKey : ($this -> storageKey ? $this -> storageKey : NULL ) ;
        if ( ! $key )
            return 'No storage key' ;

        $headers[] = 'Authorization:' . $_token ;
        $re = self::curl ( self::$storagesUrl . $key . '?action=rest' , $headers , 'GET' ) ;
        return $this -> returnMsg ( $re , __FUNCTION__ ) ;
    }

    /**
     * storageSelectAction
     * @param string $storageKey
     * @param string $token
     * @return
     */
    function usedStorage ( $storageKey = '' , $token = '' )
    {
	$_token = $token ? $token : ($this -> token ? $this -> token : NULL ) ;
	if ( ! $_token )
            return 'No token' ;

	$key = $storageKey ? $storageKey : ($this -> storageKey ? $this -> storageKey : NULL ) ;
	if ( ! $key )
            return 'No storage key' ;

	$headers[] = 'Authorization:' . $_token ;
	$re = self::curl ( self::$storagesUrl . $key . '?action=used' , $headers , 'GET' ) ;
	return $this -> returnMsg ( $re , __FUNCTION__ ) ;
    }


    /**
     * @catagoryCreate
     * @param string $catagoryName
     * @param string $token
     * @return
     *
     */
    function catagoryCreate ( $catagoryName , $token = ''  )
    {
        $_token = $token ? $token : ($this -> token ? $this -> token : NULL ) ;
        if ( ! $_token )
            return 'No token' ;

        if ( ! $catagoryName )
            return 'No catagoryName' ;

        $headers[] = 'Authorization:' . $_token ;
        $postData = array () ;
        $postData['catagoryName'] = $catagoryName ;
        $re = self::curl ( self::$catagoryUrl , $headers , 'POST' , $postData ) ;
        return $this -> returnMsg ( $re , __FUNCTION__ , $catagoryName ) ;
    }


    /**
     * @catagoryCreate
     * @param string $token
     * @return
     *
     */
    function catagorySelect ( $token = '' )
    {
        $_token = $token ? $token : ($this -> token ? $this -> token : NULL ) ;
        if ( ! $_token )
            return 'No token' ;

        $headers[] = 'Authorization:' . $_token ;
        $re = self::curl ( self::$catagoryUrl , $headers , 'GET' ) ;
        return $this -> returnMsg ( $re , __FUNCTION__ ) ;
    }


    /**
     * @videoList
     * @param Integer $catagoryIdx
     * @param string $token
     * @return
     */
    function videoList ( $catagoryIdx = '' , $token = '' )
    {
        $_token = $token ? $token : ($this -> token ? $this -> token : NULL ) ;
        if ( ! $_token )
            return 'No token' ;

        if ( !is_numeric( $catagoryIdx ) && ( $catagoryIdx != null ) )
             return 'lncorrect data type for catagoryIdx' ;

        $headers[] = 'Authorization:' . $_token ;
        $re = self::curl ( self::$videoUrl . '?catagoryIdx=' . $catagoryIdx  , $headers , 'GET' ) ;
        return $this -> returnMsg ( $re , __FUNCTION__ , $catagoryIdx ) ;
    }


    /**
     *videoDetail
     *@param string $toekn
     *@param string $videoKey
     *
     */
    function videoDetail ( $videoKey , $token = '' )
    {
        $_token = $token ? $token : ($this -> token ? $this -> token : NULL ) ;
        if ( ! $_token )
            return 'No token' ;

        if ( ! $videoKey )
            return 'No vidoe key' ;

        $key = $videoKey ;
        $headers[] = 'Authorization:' . $_token ;
        $re = self::curl ( self::$videoUrl . $key , $headers , 'GET' ) ;
        return $this -> returnMsg ( $re , __FUNCTION__  ) ;
    }


    /**
     * videoDelete
     * @param string token
     * @param string $videoKey
     *
     */
    function videoDelete ( $videoKey = '' , $token = '' )
    {
        $_token = $token ? $token : ($this -> token ? $this -> token : NULL ) ;
        if ( ! $_token )
             return 'No token' ;

        if ( ! $videoKey )
            return 'No vidoe key' ;

        $key = $videoKey ;
        $headers[] = 'Authorization:' . $_token ;
        $re = self::curl ( self::$videoUrl . $key , $headers , 'DELETE' ) ;
        return $this -> returnMsg ( $re , __FUNCTION__  ) ;
    }


    /**
     * videoUpdate
     * @param string $token
     * @param string $videoKey
     * @param string $title
     * @param string $memo
     * @param string $pc	//待定
     * @param string $mobile	//待定
     *
     */
    function videoUpdate ( $memo , $mobile='' , $pc='' , $title , $videoKey = '' , $token = '' )
    {
        $_token = $token ? $token : ($this -> token ? $this -> token : NULL ) ;
        if ( ! $_token )
            return 'No token' ;

        if ( ! $videoKey )
            return 'No vidoe key' ;

        $key = $videoKey ;
        $headers[] = 'Authorization:' . $_token ;
        $re = self::curl ( self::$videoUrl . $key .'?title=' . $title . '&memo=' . $memo . '&pc='.$pc.'&mobile='.$mobile , $headers , 'PUT' ) ;
        return $this -> returnMsg ( $re , __FUNCTION__ , $title , $memo ) ;
    }


    /**
     * 결과 처리
     * @param array 결과정보
     * @param string $functionName 호출function 이름
     * @param string $param1 파라미터
     * @param string $param2 파라미터
     * @return array 티코드 된 결과정보
     */
    public function returnMsg ( $response , $functionName , $param1 = '' , $param2 = '' )
    {
	if ( ! $response )
            return FALSE ;
        
	$response = json_decode ( $response ) ;
	if ( ! isset ( $response -> Result ) )
            return FALSE ;
        
	if ( $this -> overtime ( $response -> Result ) )
	{
            $param = array () ;
            if ( $param1 )
		array_push ( $param , $param1 ) ;
		if ( $param2 )
                    array_push ( $param , $param2 ) ;
           /**
             * 세 토큰로 다시 function 호출하기
             */
            return $this -> countOvertime ? NULL : call_user_func_array ( array ( $this , $functionName ) , $param ) ;
	}
	return $response ;
    }

    /**
     *  토큰 유효시간 초과할때 다시요청 ( 한번만 )
     * @param string $msg API return 메시지
     * @return bool TRUE:다시요청 완료 ; FALSE:거절 ( 이미 다시요청했음 )
     */
    public function overtime ( $msg )
    {
	if ( $msg == 'InvalidToken.Expired' )
	{
            $reqToken = json_decode ( $this -> getToken () ) ;
            $this -> countOvertime = TRUE ;
            return TRUE ;
	}
	else
	{
            $this -> countOvertime = FALSE ;
            return FALSE ;
	}
    }
}
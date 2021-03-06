# VOD Auth

SDK for iwinv vod auth API.  
SDK를 사용하면 편리하고 안전하게 API 연결을 할수있다.

## Setting

`setting.php` 파일은 기본설정파일이다.

*  VOD 인증(단독형) 서비스의 도메인 setting.php 의 `apiDomain`로 설정한다.
* API 버전을 `setting.php`의`version`로 설정한다.

* 아래 그림과 같이 **콘솔**에서 `사용자명` 메뉴 -> `설정&관리` -> `AccessKey 관리` 에서 accesskey를 생성하며  
**accesskey ID** 과 **secret**를 `setting.php`의`accesskeyId`,`accesskeySecret` 로 설정한다.

<p align="center">
  <img src="./img/img1.jpg" alt="accesskey 설정방법" width="810">
</p>

<p align="center">
  <img src="./img/img2.jpg" alt="accesskey 설정방법" width="810">
</p>

* 아래 그림과 같이 **콘솔**에서 `사용자명` 메뉴 -> `설정&관리` -> `스토리지 설정`창에서 **storageKey**를 `setting.php`의`storageKey`로 설정한다.

<p align="center">
  <img src="./img/img3.jpg" alt="storageKey 설정방법" width="810">
</p>

## Authentication.class.php

**Class**에서 아래와 같이 **Method**를 포함하여 호출해서 사용할수 있다.

* `getToken ()` -> Token 신청. ( `setting.php` 설정필요 ) 
* `storageList ( $token= '' )` -> 스토리지 목록 검색.
* `storageDetail ( $storageKey = '' , $token = '' )` -> 스토리지 상세 검색.
* `storageTotal ( $token = '' , $storageKey = '' )` -> 스토리지 총용량 검색.
* `storageRest ( $token = '' , $storageKey = '' )` -> 스토리지 남은용량 검색.
* `storageUsed ( $token = '' , $storageKey = '' )` -> 스토리지 사용용량 검색.
* `videoList ( $catagoryIdx = '' , $token = '' )` -> 동영상 리스트 검색.
* `videoDetail ( $videoKey , $token = '' )` -> 동영상 상세 검색.
* `videoDelete ( $videoKey = '' , $token = '' )` -> 동영상 삭제 .
* `videoUpdate ( $memo , $mobile='' , $pc='' , $title , $videoKey = '' , $token = '' )` -> 동영상 정보 수정.

**Token** 는 `getToken ()` 로 생성하며 같은 **Object**에서 저장하고있어서  
아래와같이 `$storages1`;`$storages2`;`$storages3` 내용이 같다.
```
$AUTH = new Authentication ( $_API );
$token = $AUTH -> getToken ();
$storages1 = $AUTH -> storagesList ( $AUTH -> token );
$storages2 = $AUTH -> storagesList ( $token );
$storages3 = $AUTH -> storagesList ();
```

## 버전관리

최신버전은 `v1` 이다.
`setting.php`의 `version`로 설정한다.

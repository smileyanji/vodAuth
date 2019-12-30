<?php
/*
 * ===========================================================================
 * API 기준 정보 설정
 * ===========================================================================
 *
 * API서버로 접근 내용을 메소드로 구성해서 include해서 사용하면 됩니다.
 *
 * ---------------------------------------------------------------------------
 * 작성자: 리성림 <chenglin@smileserv.com>
 * 작성일: 2019년 11월 13일
 * ===========================================================================
 */
$_API = array
	(
	/**
	 * apiDomain
	 * API서버 도메인
	 * 'http://' or 'https://' 부터 시작합니다.
	 */
	'apiDomain' => 'Input your api domain here!' ,
	/**
	 * accesskeyId
	 * accesskey ID
	 */
	'accesskeyId' => 'Input your api accesskey ID here!' ,
	/**
	 * accesskeySecret
	 * accesskey 비번
	 */
	'accesskeySecret' => 'Input your api accesskey secret here!' ,
	/**
	 * storageKey
	 * 스토리지키
	 */
	'storageKey' => array(
                    'Input your api storag name here!'=>'Input your api storag key here!',
                    'Input your api storag name here!'=>'Input your api storag key here!',
                    'Input your api storag name here!'=>'Input your api storag key here!',
                    ),
	/**
	 * version
	 * api 버전
	 */
	'version'=>'Input your api version here!',
	) ;

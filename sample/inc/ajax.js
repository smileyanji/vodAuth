$ ( document ).ready ( function () {
var str = window.location.href ,
    start = str.indexOf ( 'sample/' ) + 7 ,
    homeHref = str.slice ( 0 , start ) ;
$ ( '.homeUrl' ).attr ( "href" , homeHref ) ;
$ ( 'select[name="storage"]' ).change ( function () {
    var storagekey = $ ( this ).val () ;
    if ( storagekey == '')
    {
       return false;
    }
    $.post ( '../service.php' , {
            'storagekey' : storagekey ,
            'type' : 'storage_detail',
    } , function ( result ){
    if ( typeof ( result.Result ) != "undefined" )
    {
        if ( result.Result.includes ( 'success' ) )
        {
            var Result = result.Result ,
                obj = $ ( '.storage' ).find ( 'td' ) ,
                i = 0 ;
                $('.storage').prev().remove();
                for ( var o in result.Storage )
                {
                    obj.eq ( i ).html ( result.Storage[o] )
                    i++ ;
                }
        }
        else
            alert ( result.Message )
    }
    else
        alert ( result ) ;
    } , 'json' )
} )
$ ( 'input[name="catagory"]' ).click ( function () {
    var catagoryName = $ ( 'input[name="catagoryname"]' ).val () ;
    $.post ( '../service.php' , {
            'catagoryName' : catagoryName ,
            'type' : 'catagory_create',
    },function ( result ){
        //console.log ( result ) ;
        if ( typeof ( result.Result ) != 'undefined' )
        {
            if ( result.Result.includes ( 'success' ) )
            {
                alert ( result.Result + '    CatagoryIdx:' + result.CatagoryIdx ) ;
                window.location.reload () ;
            }
            else
                alert ( result.Message ) ;
        }
        else
        {
            alert ( result ) ;
        }
    } , "json" )
} )
} )
$(function(){
    activateSidebarLi();
    
})

//
function activateSidebarLi()
{
    var url = window.location.href.split('?');

    var split_url = url[0].split('/');
    
    if( split_url[3] ) {
        $('.sidebar-menu li').removeClass('active');
        $('.sidebar-menu li a[href="/' + split_url[3] + '"]').closest('li').addClass('active');
    }
}


// Read a page's GET URL variables and return them as an associative array.
function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
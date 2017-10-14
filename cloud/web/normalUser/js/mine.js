$(document).ready(function(){
	//disbaling some functions for Internet Explorer
	if($.browser.msie)
	{
		$('#is-ajax').prop('checked',false);
		$('#for-is-ajax').hide();
		$('#toggle-fullscreen').hide();
		$('.login-box').find('.input-large').removeClass('span10');

	}

	//highlight current / active link
	$('ul.main-menu li a').each(function(){
		if($($(this))[0].href==String(window.location))
			$(this).parent().addClass('active');
	});

	//establish history variables
	var
		History = window.History, // Note: We are using a capital H instead of a lower h
		State = History.getState(),
		$log = $('#log');

	//bind to State Change
	History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
		var State = History.getState(); // Note: We are using History.getState() instead of event.state
		$.ajax({
			url:State.url,
			success:function(msg)
            {
				$('#content').html($(msg).find('#content').html());
				$('#loading').remove();
				$('#content').fadeIn();
				var newTitle = $(msg).filter('title').text();
				$('title').text(newTitle);
				docReady();
			}
		});
	});

	//ajaxify menus
	$('a.ajax-link').click(function(e){
		if($.browser.msie) e.which=1;
		if(e.which!=1 || !$('#is-ajax').prop('checked') || $(this).parent().hasClass('active')) return;
		e.preventDefault();
		if($('.btn-navbar').is(':visible'))
		{
			$('.btn-navbar').click();
		}
		$('#loading').remove();
		$('#content').fadeOut().parent().append('<div id="loading" class="center">Loading...<div class="center"></div></div>');
		var $clink=$(this);
		History.pushState(null, null, $clink.attr('href'));
		$('ul.main-menu li.active').removeClass('active');
		$clink.parent('li').addClass('active');
	});
	//For my Consumer Dashboard menus
  $('a.myMenus').click(function(e){
		e.preventDefault();
		var $url = $(this).attr("href");


		$this = $(this);

		$('#content').fadeOut().parent().append('<div id="loading" class="center text-center pull-center"><i class="fa fa-refresh fa-spin fa-3x stat-elem"></i><div class="center"></div></div>');
		$.ajax({
				// the URL for the request
				url: $url,
				// whether this is a POST or GET request
				type: "GET",
				// the type of data we expect back
				dataType : "html",
				// code to run if the request succeeds;
				// the response is passed to the function
				success: function( html ) {
						$('#content').html(html);
						$('ul#dashMenu li.active').removeClass('active');
						$this.parent('li').addClass('active');
				//$( "<h1/>" ).text( json.title ).appendTo( "body" );
				//$( "<div class=\"content\"/>").html( json.html ).appendTo( "body" );
				},
				// code to run if the request fails; the raw request and
				// status codes are passed to the function
				error: function( xhr, status, errorThrown ) {
				alert( "Sorry, there was a problem! " + errorThrown );
				//console.log( "Error: " + errorThrown );
				//console.log( "Status: " + status );
				//console.dir( xhr );
				},
				// code to run regardless of success or failure
				complete: function( xhr, status ) {
				$('#loading').remove();
						$('#content').fadeIn();
				}
		});
	});

  $('a.myAjax').click(function(e){
		if($.browser.msie) e.which=1;
		if(e.which!=1 || !$('#is-ajax').prop('checked') || $(this).parent().hasClass('active')) return;
		e.preventDefault();
		if($('.btn-navbar').is(':visible'))
		{
			$('.btn-navbar').click();
		}
		$('#loading').remove();
		$('#content').fadeOut().parent().append('<div id="loading" class="center">Loading...<div class="center"></div></div>');
		var $clink=$(this);
		History.pushState(null, null, $clink.attr('href'));
		('ul.meni li.active').removeClass('active');
		$clink.parent('li').addClass('active');
	});
  //for task Pane
  $('ul#taskPane li a').click(function(e){
    e.preventDefault();

    var $url = $(this).attr("href");


    $this = $(this);
    $('#mCont').fadeOut().parent().append('<div id="loading" class="center">Loading...<div class="center"></div></div>');
    //$('#mCont').load($url);
    $.ajax({
        // the URL for the request
        url: $url,
        // whether this is a POST or GET request
        type: "GET",
        // the type of data we expect back
        dataType : "html",
        // code to run if the request succeeds;
        // the response is passed to the function
        success: function( html ) {
            $('#mCont').html(html);
            $('ul#taskPane li a.active').removeClass('active');
            $this.parent('li').addClass('active');
        //$( "<h1/>" ).text( json.title ).appendTo( "body" );
        //$( "<div class=\"content\"/>").html( json.html ).appendTo( "body" );
        },
        // code to run if the request fails; the raw request and
        // status codes are passed to the function
        error: function( xhr, status, errorThrown ) {
        alert( "Sorry, there was a problem! " + errorThrown );
        //console.log( "Error: " + errorThrown );
        //console.log( "Status: " + status );
        //console.dir( xhr );
        },
        // code to run regardless of success or failure
        complete: function( xhr, status ) {
        $('#loading').remove();
            $('#mCont').fadeIn();
        }
      });
    });



	//other things to do on document ready, seperated for ajax calls
	docReady();
});


function docReady(){
	//prevent # links from moving to top
	$('a[href="#"][data-top!=true]').click(function(e){
		e.preventDefault();
	});

	$('.btn-close').click(function(e){
		e.preventDefault();
		$(this).parent().parent().parent().fadeOut();
	});
	$('.btn-minimize').click(function(e){
		e.preventDefault();
		var $target = $(this).parent().parent().next('.box-content');
		if($target.is(':visible')) $('i',$(this)).removeClass('icon-chevron-up').addClass('icon-chevron-down');
		else 					   $('i',$(this)).removeClass('icon-chevron-down').addClass('icon-chevron-up');
		$target.slideToggle();
	});
	$('.btn-setting').click(function(e){
		e.preventDefault();
		$('#myModal').modal('show');
	});

}

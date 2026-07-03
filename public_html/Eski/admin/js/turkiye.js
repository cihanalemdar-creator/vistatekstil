	var iscountyselected = false;
	var previouscountyselected = "blank";
	var start = true;
	var past = null;
	var content_dir = "details";
	var mapMonitor = $('#sehir');
	
	$(function(){
	
	var r = Raphael('map',1050,620),
	attributes = {
	    "fill": "#2f4050",
//	    "fill": "rgba(0, 0, 0, 0.186)",
	    "stroke": "#ffffff",
	    "stroke-opacity": "1",
	    "stroke-linejoin": "round",
	    "stroke-miterlimit": "4",
	    "stroke-width": "0",
	    "stroke-dasharray": "none"
        },
	arr = new Array();
	for (var county in paths) {
		var obj = r.path(paths[county].path);
		obj.attr(attributes);
		//obj.data("fill", "#999900");
		arr[obj.id] = county;
		
		var color = $('#map-color-'+paths[county].county).html();
		/*
		obj.animate({
		    fill: '#'+color
		}, 200);
		*/
		if(arr[obj.id] != 'blank') 
		{	
			obj.data('selected', 'notSelected');
			
		
		
//			obj.node.id = arr[obj.id]+'veli';
			obj.node.id = paths[arr[obj.id]].county;
			
			obj.attr(attributes).attr( { title: paths[arr[obj.id]].name } );
			obj.attr(attributes).attr( { fill: "rgba(47, 64, 80, 20)" } );
			
			
			

			obj
			.hover(function(){
				$('#coatOfArms').addClass(arr[this.id]+'large sprite-largecrests');
				
				$('#countyInfo').text(paths[arr[this.id]].name);
				
				$('#searchResults').stop(true,true);
				
							
			}, function(){	
				$('#coatOfArms').removeClass();			
				if(paths[arr[this.id]].value == 'notSelected')
					{
					$('.'+paths[arr[this.id]].name)
							.slideUp('slow', function() { 
								$(this).remove(); 
							});
				}
			});
			$("svg a").qtip({
			
					content: {
						attr: 'title'
					},
					show: 'mouseover',
					hide: 'mouseout',
					position: {
						target: 'leave'
					},
					style: {
						classes: 'ui-tooltip-tipsy ui-tooltip-shadow',
						tip: false
					}
			});
			
			obj.click(function(){
				
				ga('send', 'event', 'Anasayfa', 'Harita', paths[arr[this.id]].name);
				
				var cityId = paths[arr[this.id]].county;
				window.location = 'kategori-arama?city='+cityId;
				
				
				if(paths[arr[this.id]].value == 'notSelected')
				{
						this.animate({
						    fill: '#464646'
					}, 0);
						
					paths[previouscountyselected].value = "notSelected";
					paths[arr[this.id]].value = "isSelected";
					
					previouscountyselected = paths[arr[this.id]].name;
					
					$('<div/>', {
							title: arr[this.id],
							'class': arr[this.id]+'small sprite-smallcrests'
						}).appendTo('#selectedCounties').qtip(countyCrest);
												
					$("#countymenu").val(paths[arr[this.id]].county); 
					
					
						
					if (!start && past != this)
					{
					    past.animate({ fill: '#464646' }, 0);
					}
					past = this;
					start = false;					
				}
	
					
				else if(paths[arr[this.id]].value == 'isSelected')
					{
						this.animate({
						    fill: '#464646'
						}, 0);
						
						paths[arr[this.id]].value = "notSelected"; 
						
						$("." + previouscountyselected+'small').remove();
						
						
					}	
				
				});

			var countyCrest = 	{
					content: {
						attr: 'title'
					},
					position: {
						target: 'mouse'
					},
					style: {
						classes: 'ui-tooltip-tipsy ui-tooltip-shadow',
						tip: true
					}
			};
			
			function hoverin(e){
				$('#sehir').show();
				if(paths[arr[this.id]].value == 'notSelected')
					this.animate({
					    fill: "rgba(70, 70, 70, 100)"
					}, 0);
			}

			function hoverout(e){
				var color = $('#map-color-'+paths[arr[this.id]].county).html();
				if(paths[arr[this.id]].value == 'notSelected')
					this.animate({
					    fill: "rgba(47, 64, 80, 20)"
					}, 0);
			}
			
			obj.mouseout(hoverout);
				
			obj.mouseover(hoverin);

			$('#countyInfo').hide();
			
			$('#spinner').hide();
				
		}
		
	}
	
	
	$('#map').mousemove(function( event ) {
		mapMonitor.css({
			left: event.pageX-220,
			top: event.pageY-250
		});
	});
	
	$('#map').mouseleave(function( event ) {
		$('#sehir').hide();
	});
	
	
});
	
	$( document ).ready(function() {
	    $('#map svg').css('left',"");
	});
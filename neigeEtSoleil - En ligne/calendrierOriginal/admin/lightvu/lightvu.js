/* 
 * lightvu.js 1.0.0. Lightvu ... a better lightbox clone
 * 
 * Copyright 2010 RapidWeaverThemes.com
 * 
 * This file is part of Lightvu.
 * 
 * Lightvu is free to use: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 * 
 * Lightvu is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * 
 * Date: 2010-05-25 12:08:29 -0500 (Wed, 25 May 2010)
 *
 */

//variable class which is used to detect the reference link
var rwtvu = ".lightvu";
//for generate gallary effects
var galleff;
//add event listener which when body loads and make a clean shot
window.addEvent('domready',function(){
	var allref = $n$n(rwtvu);	
	i=0; //allref will contain all the reference to link class
	allref.each(function(m){
		//alert(m);
		var mydata = m.get('href');
		if(mydata.indexOf(".jpg") > 0 || mydata.indexOf(".gif") > 0 || mydata.indexOf(".png") > 0)
		{
			var img = new Element('img');
			img.src = mydata;
			img.setStyle('display','none');
			img.inject(document.body);
		}
		m.set('id',i);
		m.set('gall',i+1);
		i++;
	}) 
	galleff = i;
	var preheight=1, prewidth=1,preleft=window.getSize().x.toInt()/2;
	var pretop=window.getSize().y.toInt()/2;
	i = 0;//now associate a click event to all the references
	$n$n(rwtvu).addEvent('click',function(m)
	{
		//$n('mydata box').fade('.5');
		m = new Event(m).stop();//alert(this.get('href'));
		var mydata;
		mydata = this.get('href');
		//alert(mydata);
	var nextenabledisable=0,previousenabledisable=0;
	//alert(this.get('id'));
	if(this.get('id').toInt()<galleff-1)
	{
		if(document.getElementById(this.get('id').toInt()).rel != "" && document.getElementById(this.get('id').toInt()+1).rel != "")
			if(document.getElementById(this.get('id').toInt()).rel == document.getElementById(this.get('id').toInt()+1).rel)
			{
				nextenabledisable=1;
			}
	}
	if(this.get('id').toInt()!=0)
	{
		if(document.getElementById(this.get('id').toInt()).rel != "" && document.getElementById(this.get('id').toInt()-0).rel != "")
		{
			if(document.getElementById(this.get('id').toInt()).rel == document.getElementById(this.get('id').toInt()-1).rel)
			{
					previousenabledisable=1;
			}
		}
	}
	var mypreid = this.get('id');//alert(mypreid);
	mywidth = 0;
	myheight = 0;
	var mytitle = "";
	if(this.get('sze')!= null)
	{
		var winhw;
		winhw = window.getSize().x.toInt();
		//alert(winhw);
		var tmp = this.get('sze').split(" ");
		mywidth = tmp[0];
		if(mywidth.indexOf("%") > 0)
		{
			mywidth = mywidth.replace("%","");
			mywidth = (winhw * mywidth)/100; 
		}
		myheight = tmp[1];
		winhw = window.getSize().y.toInt();
		if(myheight.indexOf("%") > 0)
		{
			myheight = myheight.replace("%","");
			myheight = (winhw * myheight)/100; 
		}
	}
	if(this.get('mytitle') != null)
	{
		mytitle = this.get('mytitle');
	}	
	if( mywidth == 0 )
	{ 
		mywidth = 640; 
	}
	if( myheight == 0 )
	{ 
		myheight = 480; 
	}//if data passed is image data then create new image and set its attribute
	//alert(mydata);
	if(mydata.indexOf(".jpg") >0 || mydata.indexOf(".gif") >0 || mydata.indexOf(".png") >0)
	{
		img = new Image();
		img.src = mydata;
		mywidth = img.width;
		myheight = img.height;
	}
	wid = window.getSize().x.toInt();
	hei = window.getSize().y.toInt();
	scroller = window.getScrollTop();
	var screenmid = (wid) / 2; 
	var screenmid1 = (hei) / 2;
	var endleft = (wid-mywidth) / 2;
	var endtop = ((hei - myheight) / 2) + scroller;
	//for the loading image
	var outterdiv = new Element('div', {
		'styles':{ 
			width: '1px', height: '1px', position:'absolute', border:'14px solid #ffffff', padding:'0', background:'#000000 url(images/loading.gif) no-repeat center center', left:screenmid, top:screenmid1, cursor:'arrow', display:'block', 'z-index':'200001' 
		}, 'id': 'mydatabox' 
	})
	//overlay effect
	overlay = new Element('div',{ 
		'styles':{ 
			background:'#363661', width:'100%', height:'100%', 'z-index':'100001', opacity:'0.8', position:'absolute', top: window.getScrollTop(), left: 0 
		}, 'id':'overlay' 
	})
	if(Browser.Engine.name == 'trident' && Browser.Engine.version == 4)
	{
		var backhidden = window.getHeight();
		$n(overlay).setStyle('height',backhidden);
	}
	var closebar = new Element('div',{ 
		'styles':{ 
			width:'100%', height:'40px', border:'0', 'border-bottom-width': 0,'border-left-width': 0,'border-right-width': 0, right:'0', left:'0', position:'absolute', bottom:'-14px', 'z-index':'100', background:'#fff' 
		}, 'id':'closebar' 
	})	
	var closeme = new Element('div',{ 
		'styles':{ 
			width:'80px', height:'40px', right:'-54px', position:'absolute', bottom:'-27px', 'z-index':'100', background:' url(images/closelabel.png) no-repeat center center', 'cursor':'pointer' 
		}, 'id':'closeme' 
	})
	closeme.addEvent('click',function(m)
	{ 
		overlay.dispose(); 
		$n(outterdiv).getChildren().dispose(); 
		closedatabox.start({ 
			'width':[mywidth,1], 'height':[myheight,1], 'left': [endleft,screenmid], 'top':  [endtop, screenmid1+scroller] 
		})
	})	
	if(Browser.Engine.name != 'trident')
	{ 
		window.addEvent('keyup',function(m)
		{ 
			if(m.key == 'esc')
			{ 
				overlay.dispose(); 
				$n(outterdiv).getChildren().dispose(); 
				closedatabox.start({ 
					'width':[mywidth,1], 'height':[myheight,1], 'left': [endleft,screenmid], 'top':  [endtop, screenmid1+scroller] 
				})
			}
		}
	)
	}
	else
	{ 
		document.addEvent('keyup',function(m)	
		{ 
			if(m.key == 'esc')
			{ 
				overlay.dispose(); 
				$n(outterdiv).getChildren().dispose(); 
				closedatabox.start({ 
					'width':[mywidth,1], 'height':[myheight,1], 'left': [endleft,screenmid], 'top':  [endtop, screenmid1+scroller] 
				})
			}
		})
	} 
	overlay.inject(document.body); 
	outterdiv.injectInside(document.body); 
	closebar.injectInside(outterdiv); 
	closeme.injectInside(outterdiv); 
	var closedatabox = new Fx.Morph($n('mydatabox'), { duration: 100, wait:'link', onComplete:function(){ 
		preheight=1, prewidth=1,preleft=window.getSize().x.toInt()/2;
		pretop=window.getSize().y.toInt()/2;
		outterdiv.dispose(); //new Fx.Reveal($n('myElement'), {duration: 500, mode: 'horizontal'}); 
	}}); 
	var opendatabox = new Fx.Morph($n('mydatabox'), {duration: 1000, wait:'link', onComplete:function(){ 
		var myFx = new Fx.Tween($n('mydatabox'), { duration: 1000, wait:'link', onComplete:function(){ 
			$n(outterdiv).setStyle('background','#ffffff'); //background color of image (when using transparent images) 
			if($n('prev') != null)
			{ 
				$n('prev').setStyle('display','block'); 
			} 
			if($n('next') != null)
			{ 
				$n('next').setStyle('display','block'); 
			}	
			if(mydata.indexOf(".jpg") >0 || mydata.indexOf(".gif") >0 || mydata.indexOf(".png") >0)
			{ 
				var img = new Element('img'); 
				img.src = mydata; mywidth = img.width; myheight = img.height; $n(img).inject(outterdiv); 
			}
			else if(mydata.indexOf('.flv') <0 && mydata.indexOf('.mp3') <0 && mydata.indexOf(".pdf") <0 && mydata.indexOf(".swf") <0 && mydata.indexOf(".jpg") <0 && mydata.indexOf(".gif") <0 && mydata.indexOf(".png") <0 && mydata.indexOf("AJAX") <0)
			{ 
				var myexthtml = new Element('div',{ 
					'styles':{
						'display':'block', 'overflow':'hidden', 'padding':'0', 'height':myheight-30, 'width':mywidth-10 
					}
				}) 																																																																																																																																																													
   				myexthtml.inject(outterdiv).setStyle('background','#000000');
				myexthtml.set('id','htmlframe'); 
				var newcontframe = new IFrame(); 
				newcontframe.setStyle('overflow','auto'); 
				newcontframe.set('frameborder','0'); 
				newcontframe.setStyle('width',mywidth-10); 
				newcontframe.setStyle('height',myheight-30); 
				newcontframe.src = mydata; 
				newcontframe.inject(myexthtml).setStyle('background','#000000'); 
			} //pdf Injection Nothing Just simple Iframe Use //caution some browser may not display correct Iframe or antivirus auume it virus
			else if(mydata.indexOf(".pdf") > 0)
			{ 
				var div = new Element('div',{ 
					'styles':{ 
						padding:'1px', height: myheight-32, width:mywidth-7 
					}
			})	
			div.inject(outterdiv); 
			var pdfdata = new IFrame(); //alert(mydata);
			pdfdata.src = mydata; 
			pdfdata.setStyle('width',mywidth-7); 
			pdfdata.setStyle('height',myheight-32); 
			pdfdata.inject(div);
		}
		else if(mydata.indexOf(".swf") > 0)
		{ 
			var div = new Element('div',{ 
				'styles':{ 
					padding:'0px', height: myheight-27, width:mywidth-0 
				}, id: 'swf' 
			}) 
			div.inject(outterdiv).setStyle('background','#000000');
			var obj = new Swiff(mydata, { id: 'video', width: mywidth-0, height: myheight-27, container: div })
		}
		else if(mydata.indexOf(".flv") > 0)
		{ 
			var div = new Element('div',{ 
				'styles':{ 
					padding:'7px', height: myheight-40, width:mywidth-15 
				}
			})
			div.inject(outterdiv); 
			var f =flowplayer(div, "files/flowplayer.swf", { buffering : true, autoplay: true, clip: mydata, wmode: 'transparent', id: 'player' });	//alert("hi i am here");
		}
		else if(mydata.indexOf(".mp4")>0)
		{ 
			var div = new Element('div',{ 
				'styles':{ 
					padding:'7px', height: myheight-40, width:mywidth-15 
				}
			})
			div.inject(outterdiv); 
			var f =flowplayer(div, "files/flowplayer.swf", { buffering : true, autoplay: true, clip: mydata, wmode: 'transparent', plugins: {myContent: {url: 'flowplayer.pseudostreaming.swf'}}, id: 'player' });	//alert("hi i am here");
		}
		else if(mydata.indexOf(".mp3") > 0){	
			//alert("I am here");
			var div = new Element('div',{
				'styles':{
					padding:'3px',height: myheight-33, width:mywidth-6, 'z-index':'1', id:'mp3work'
				}
			})
			div.inject(outterdiv).setStyle('background','#000000'); 
			 var f =flowplayer(div, "files/flowplayer.swf", { buffering : true, autoplay: true, clip: mydata, wmode: 'transparent', plugins: { 
 	   		 	myContent: { url: 'files/flowplayer.content.swf', bottom: 0, width: mywidth-15, left:0, borderRadius: 10, html: mytitle, onClick: function() { 
						this.hide(); 
					} 
				 }
				},
				 playlist:[{url:mydata,autoPlay:true}]
	    		});
			}
		else if(mydata.indexOf("AJAX") == 0)
		{ 
			mydata = mydata.replace("AJAX",""); 
			var div = new Element('div',{
				'styles':{
					padding:'8px', overflow:'auto' 
				}
			})			
			var ajaxdata = $n(mydata).get('html'); 
			div.set('html',ajaxdata); 
			div.inject(outterdiv).setStyle('background','#ffffff');
		} 
		if(mytitle != "")
		{ 
			var title = new Element('div',{ 
				'styles':{ 
					'height':'26px', 'position':'absolute', 'bottom':'-14px', 'left':'10px', 'z-index':'100', 'display':'block', 'padding':'10px', 
				}
			}) 
			title.set('html',mytitle); 
			title.inject(outterdiv); 
			title.set('id','maindesc'); 
		}
	}}); 
	myFx.start('background-color', '#000000', '#ffffff'); 	}}); 
	$n(overlay).addEvent('click',function(m){ overlay.dispose(); $n(outterdiv).getChildren().dispose(); closedatabox.start({ 'width':[mywidth,1], 'height':[myheight,1], 'left': [endleft,screenmid], 'top':  [endtop, screenmid1+scroller]})})
	if(nextenabledisable==1)
	{ 
			var middle = (myheight - 40) / 2; 
			var nextbutton = new Element('a',{ 
				'styles':{ 
					width:'40px', height:'40px', background:'url(images/next.png) no-repeat center center', position:'absolute', right:'-34px', bottom: middle, 'display':'none', 'cursor':'pointer' 
				}, id:'next' 
			})
			nextbutton.addEvent('click',function(m)
			{ 
				if(Browser.Engine.trident)
				{ //($n('video'));
					if($n('video') != null)
					{ 
						$n('video').stop();
					} 
					if($n('swf') != null)
					{
						$n('swf').dispose();
					}
				} 
				$n('overlay').dispose();										
			 	$n('mydatabox').dispose(); 
				var mynextelement = mypreid.toInt(); 
				mynextelement+=1; 
				mynextelement = mynextelement.toString(); 
				$n(mynextelement).fireEvent('click',this); 
			}) 
			nextbutton.inject(outterdiv);
	} 
	if(previousenabledisable==1)
	{
			var middle = (myheight - 40) / 2; 
			var prebutton = new Element('a',{
				'styles':{
					width:'40px', height:'40px', background:'url(images/prev.png) no-repeat center center', position:'absolute', left:'-34px', bottom:middle, 'display':'none','cursor':'pointer'
				}, id:'prev'
			})
			prebutton.addEvent('click',function(m){
				//to close movie in all which continue play movie after close them
				if(Browser.Engine.trident)
				{
					if($n('video') != null)
					{
						$n('video').stop();
					}
					if($n('swf') != null)
					{
						$n('swf').dispose();
					}
				}
				$n('overlay').dispose(); 
				$n('mydatabox').dispose(); 
				var mynextelement = mypreid.toInt(); 
				mynextelement-=1; 
				mynextelement = mynextelement.toString(); 
				$n(mynextelement).fireEvent('click',this); 
			}) 
			prebutton.inject(outterdiv);
	}
	opendatabox.start({'width':[prewidth,mywidth], 'height':[preheight,myheight], 'left': [preleft,endleft], 'top':  [pretop+scroller, endtop]
	})
	preheight = myheight;
	prewidth = mywidth;
	preleft = endleft;
	pretop = endtop;
	//alert (preheight + "     " + myheight + "      " + prewidth + "      " + mywidth);
});
})
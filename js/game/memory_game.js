(function($) {  
    $.fn.memory = function(passedOptions) {
      var options = {
        count: 0,
        found: 0,
        finish_count : null,
        boxopened : null,
        imgopened: null,
        timer : [0, 0, 0, 0, 0, 0, 0, 1]
      };
      
      if (passedOptions) {
        jQuery.extend(options, passedOptions);
      };
      this.each(function(){        
        
        function init() {         
          info('start memory game');          
          
          setTimer();
          //startTimer();
          //endTimer();
          //sendResult();          
          setOptions();
          setBoxSize();
          
          imageHide();
          shuffle();
          addEvent();        
          playSound('start');
        }
        function setBoxSize(){
        	info(options.finish_count);
        	if (options.finish_count==50){
        		var box_size = 30;
        	}
        	else if (options.finish_count==32){
        		var box_size = 43;
        	}
        	else if (options.finish_count==18){
        		var box_size = 63;
        	}
        	else if (options.finish_count==8){
        		var box_size = 105;
        	}
        	$("#boxcard div").css('width', box_size);
        	$("#boxcard div").css('height', box_size);
        	$("#boxcard div img").css('width', box_size);
        	$("#boxcard div img").css('height', box_size);
        	
        	
        }
        function playSound(fileName){
        	$("#sound").jmp3({
        		autoplay:true,
        		filename:fileName+'.mp3'
        	});
        }
        function setTimer(){
          options.timer[5]=new Date(1970, 1, 1, 0, 0, 0, 0).valueOf();
          options.timer[6]=document.getElementById('disp');
          disp();          
        }
        function disp() {
          if (options.timer[2]) options.timer[1]=(new Date()).valueOf();
          options.timer[6].value=format(options.timer[3]+options.timer[1]-options.timer[0]);
        }
        function format(ms) {            
            var d=new Date(ms+options.timer[5]).toString()
                .replace(/.*([0-9][0-9]:[0-9][0-9]:[0-9][0-9]).*/, '$1');
            var x=String(ms%1000);
            while (x.length<3) x='0'+x;
            d+='.'+x;
            return d;
        }
        function startTimer() {            
          options.timer[options.timer[2]]=(new Date()).valueOf();
          options.timer[2]=1-options.timer[2];          
          options.timer[4]=setInterval(disp, 43);
          
        }
        function resetTimer(){
        	
    		if (options.timer[2]) endTimer();
    		options.timer[4]=options.timer[3]=options.timer[2]=options.timer[1]=options.timer[0]=0;
    		disp();
    		//document.getElementById('lap').innerHTML='';
    		options.timer[7]=1;
        	
        }
        function endTimer(){
          options.timer[options.timer[2]]=(new Date()).valueOf();
          options.timer[2]=1-options.timer[2];
          if (0==options.timer[2]) {
            clearInterval(options.timer[4]);
            options.timer[3]+=options.timer[1]-options.timer[0];
            $("#game_time").val(format(options.timer[3]));
            $("#game_real_time").val(options.timer[3]);
            options.timer[4]=options.timer[1]=options.timer[0]=0;
            disp();
          }
        }
        
        function imageHide(){          
          $("#boxcard img").hide();
          $("#boxcard img").removeClass("opacity");
        }
        function addEvent(){
          $("#boxcard div").click(openCard);
          $("#reset").click(resetGame);
        }
        function openCard(){          
          id = $(this).attr("id");
          if (options.count==0) startTimer();
          playSound('select');
          if ($("#"+id+" img").is(":hidden")){
            $("#boxcard div").unbind("click", openCard);
            $("#"+id+" img").slideDown('fast');
            if (!options.imgopened) {
              options.boxopened = id;
              options.imgopened = $("#"+id+" img").attr("src");
              setTimeout(function() {
                  $("#boxcard div").bind("click", openCard);
              }, 300);
            }
            else{
              currentopened = $("#"+id+" img").attr("src");
              if (options.imgopened != currentopened) {
                setTimeout(function() {
                  $("#"+id+" img").slideUp('fast');
                  $("#"+options.boxopened+" img").slideUp('fast');
                  options.boxopened = null;
                  options.imgopened = null;
                }, 400);
              } else {
                $("#"+id+" img").addClass("opacity");
                $("#"+options.boxopened+" img").addClass("opacity");
                options.found++;
                options.boxopened = null;
                options.imgopened = null;
              }
              setTimeout(function() {
                $("#boxcard div").bind("click", openCard)
              }, 400);
            }
            options.count++;
            $("#count").html("" + options.count);            
            if (options.found == options.finish_count) {
            	playSound('sound');
            	sendResult();
              /*msg = '<span id="msg">Congrats ! You Found All Sushi With </span>';
              $("span.link").prepend(msg);
              endTimer();*/
            }
          }
        }
        function sendResult(){
        	
        	endTimer();
          //info(4);
        	var game_id = $("#game_id").val();
			var game_time = $("#game_time").val();				
			var game_real_time = $("#game_real_time").val();
			
			$("#result_form input[name|=game_time]").val(game_time);
			$("#result_form input[name|=game_real_time]").val(game_real_time);
			$("#result_form input[name|=count]").val(options.count);
            $('#result_form').submit();
          
        }
        function resetGame() {
        	//console.info(1);
		  shuffle();
		  imageHide();          
		  options.count = 0;          
		  options.boxopened = null;
		  options.imgopened = null;
		  options.found = 0;
		  $("#msg").remove();
		  $("#count").html("" + options.count);
		  resetTimer();
		  return false;
        }
        function setOptions(){
          var children = $("#boxcard").children();
          options.finish_count = children.length / 2;          
        }
        function shuffle() {
          var children = $("#boxcard").children();
          var child = $("#boxcard div:first-child");        
          var array_img = new Array();        
          for (i=0; i<children.length; i++) {
            array_img[i] = $("#"+child.attr("id")+" img").attr("src");
            child = child.next();
          }        
          var child = $("#boxcard div:first-child");        
          for (z=0; z<children.length; z++) {
            randIndex = randomFromTo(0, array_img.length - 1);        
            // set new image
            $("#"+child.attr("id")+" img").attr("src", array_img[randIndex]);
            array_img.splice(randIndex, 1);        
            child = child.next();
          }
        }
        function randomFromTo(from, to){
          return Math.floor(Math.random() * (to - from + 1) + from);
        }

        function info(obj,info){
          if (window.console && window.console.log){
            console.info('Debug info : '+obj);
            if(info)console.info(obj);
          }
        }
        init();
      });
      
    };  
})(jQuery);  
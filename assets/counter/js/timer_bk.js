function _timer(callback)
{
	var time = 0;
	var mode = 1;
	var status = 0;
	var timer_id;
	var place = 'div.timer';
	
	this.start = function(interval)
	{
		$(place).css('color', 'red');
		interval = (typeof(interval) !== 'undefined') ? interval : 1000;

		if(status == 0)
		{
			status = 1;
			timer_id = setInterval(function()
			{
				switch(mode)
				{
					default:
					if(time)
					{
						time--;
						generateTime();
						if(typeof(callback) === 'function') callback(time);
					}
					break;
					
					case 1:
					if(time < 86400)
					{
						time++;
						generateTime();
						if(typeof(callback) === 'function') callback(time);
					}
					break;
				}
			}, interval);
		}
	}
	this.stop =  function()
	{
		$(place).css('color', '#ccc');
		if(status == 1)
		{
			status = 0;
			clearInterval(timer_id);
		}
	}
	this.reset =  function(sec)
	{
		sec = (typeof(sec) !== 'undefined') ? sec : 0;
		time = sec;
		generateTime(time);
	}
	this.mode = function(tmode)
	{
		mode = tmode;
	}
	this.place = function(tplace)
	{
		place = tplace;
	}
	this.getTime = function()
	{
		return time;
	}
	this.getMode = function()
	{
		return mode;
	}
	this.getStatus
	{
		return status;
	}
	function generateTime()
	{
		var second = time % 60;
		var minute = Math.floor(time / 60) % 60;
		var hour = Math.floor(time / 3600) % 60;
		
		second = (second < 10) ? '0'+second : second;
		minute = (minute < 10) ? '0'+minute : minute;
		hour = (hour < 10) ? '0'+hour : hour;
		
		jQuery(place + ' span.second').html(second);
		jQuery(place + ' span.minute').html(minute);
		jQuery(place + ' span.hour').html(hour);
	}
}
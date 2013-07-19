<html>
  <head>
    <title>P&aacute;gina de teste dos timers!</title>
    <!--script type="text/javascript" src="@js/ajax.js">
    </script-->
    <script type="text/javascript" id="s1" src="@js/timer_functions.js">
    </script>
    <script type="text/javascript" id="s2">

	function Get_Current_Time()
	{
		var today = new Date();
		var hours   = today.getHours();
		var minutes = today.getMinutes();
		var seconds = today.getSeconds();
		// Add a zero in front of numbers if they are less then 10
		//		minutes = checkTime( minutes );
		//		seconds = checkTime( seconds );
		
		return hours + ":" + minutes + ":" + seconds ;
	}
	
	function Write_Time()
	{
		document.writeln( Get_Current_Time() ) ;
	}
	
	function start_code()
	{
	
		//		alert( Get_Current_Time() );
	
	
		//		Do_Tick_Action = function () { Write_Time() };
		curr_time = Get_Current_Time();
		Set_Do_Tick_Action( "alert( curr_time );" );
		Disable_Do_Tick_Action();
		
		Timer_Init( 0, 1, true, "" );
		Start_Timer( 0 );
	
		Timer_Init( 1, 10, true, "Write_Time()" );
		Start_Timer( 1 );
	}
	
    </script>

  </head>
  
  <body onload="start_code()">
  </body>
</html>
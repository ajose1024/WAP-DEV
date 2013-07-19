<html>
  <head>
    <title>P&aacute;gina de teste dos timers!</title>
    <!--script type="text/javascript" src="@js/ajax.js">
    </script-->
    <script type="text/javascript" id="s1" src="@js/timer_functions.js">
    </script>
    <script type="text/javascript" id="s2">

        var repeat_stat = new Array( nr_timers ) ;
        
        var counter = 0 ;
        
        for ( i=0 ; i++ ; i <= nr_timers )
        {
            repeat_stat[ i ] = false ;
        }

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
	
	function Get_Time()
	{
		return Get_Current_Time()  ;
	}
	
        function write_Get_Time( timer_nr )
        {
            element_name = 'date_' + timer_nr ;
            document.getElementById( element_name ).innerHTML =  "Timer " + timer_nr + ": " + Get_Time() ;
        }
        
	function start_code()
	{
	
//		alert( Get_Current_Time() );
	
	
//		Do_Tick_Action = function () { Write_Time() };
		curr_time = Get_Current_Time();
//		Set_Do_Tick_Action( "alert( curr_time );" );
//		Disable_Do_Tick_Action();
		
//		Timer_Init( 0, 1, true, "" );
//		Start_Timer( 0 );
	
//		Timer_Init( 1, 10, true, "Write_Time()" );
//		Start_Timer( 1 );

            do_output( 0 ) ;
            do_output( 1 ) ;
            
            do_output_refresh() ;
            
            Set_Timer_Delay( 1000 ) ;
            
	}

        function do_output_refresh()
        {
            do_output( 0 ) ;
            do_output( 1 ) ;
            
            local_tHandle = setTimeout( function() { window.do_output_refresh() }, 
			          100 ) ;
            counter++ ;
        }

        function do_Start_Timer( timer_nr, timer_action )
        {
            Set_Do_Tick_Action( timer_action );
            Start_Timer( timer_nr ) ;
        }
        
        
        function do_Stop_Timer( timer_nr )
        {
            Disable_Do_Tick_Action( ) ;
            Stop_Timer( timer_nr ) ;
        }


        function do_action( timer_nr, inner_data )
        {
            element_name = 'data_' + timer_nr ;
            document.getElementById( element_name ).innerHTML = inner_data ;
        }
        
        function do_init( timer_nr, inner_data )
        {
            element_name = 'init_' + timer_nr ;
            if ( inner_data == true )
            {
                document.getElementById( element_name ).innerHTML = "<b><i>INITIATED</i></b>" ;                
            }
            else
            {
                document.getElementById( element_name ).innerHTML = "<b>INIT</b>" ;
            }
        }


        function do_start( timer_nr, inner_data )
        {
            element_name = 'start_' + timer_nr ;
            if ( inner_data == true )
            {
                document.getElementById( element_name ).innerHTML = "<b><i>STARTED</i></b>" ;                
            }
            else
            {
                document.getElementById( element_name ).innerHTML = "<b>START</b>" ;
            }
        }


        function do_stop( timer_nr, inner_data )
        {
            element_name = 'stop_' + timer_nr ;
            if ( inner_data == true )
            {
                document.getElementById( element_name ).innerHTML = "<b><i>STOPED</i></b>" ;                
            }
            else
            {
                document.getElementById( element_name ).innerHTML = "<b>STOP</b>" ;
            }
        }


        function do_repeat( timer_nr, inner_data )
        {
            element_name = 'repeat_' + timer_nr ;
            if ( inner_data == true )
            {
                document.getElementById( element_name ).innerHTML = "<b><i>DON'T REPEAT</i></b>" ;                
            }
            else
            {
                document.getElementById( element_name ).innerHTML = "<b><i>REPEAT</i></b>" ;
            }
        }


        function do_output( timer_nr )
        {
            element_name = 'output_' + timer_nr ;
            document.getElementById( element_name ).innerHTML = "Time secs: " + time_secs[timer_nr] + " || " +
                                                                "Time count: " + time_count[timer_nr] + " || " +
                                                                "Timer delay: " + timer_delay + " || " + 
                                                                "tHandle: " + tHandle[timer_nr] + " || " +
                                                                "Timer Running: " + timer_running[timer_nr] + " || " +
                                                                "Timer Repeat: " + timer_repeat[timer_nr] + " || " +
                                                                "Timer Callback: " + timer_callback[timer_nr]  + " || " +
                                                                "Repeat Status: " + repeat_stat[timer_nr] + " || " +
                                                                "Tick Action: " + Do_Tick_Action + " || " +
                                                                "Counter: " + counter
        }
        

        function init_timer( timer_nr, time_val, repeat, callback )
        {
            Timer_Init( timer_nr, time_val, repeat, callback ) ;
        }

        
        function Toogle_Repeat( timer_nr )
        {
            if ( repeat_stat[timer_nr] == true )
            {
                repeat_stat[timer_nr] = false ;
            }
            else
            {
                repeat_stat[timer_nr] = true ;
            }
            do_repeat( timer_nr, repeat_stat[timer_nr] ) ;
        }

    </script>

  </head>
  
  <body onload="start_code()">
      <div id="body_wrapper">
          <table width="100%">
              <tr width="100%">
                  <td width="15%" id="data_0">------------</td>
                  <td width="15%" id="date_0">++++++++++++</td>
                  <td width="5%">&nbsp;</td>
                  <td width="10%"><span>TIME:</span><input id="name_0" value="10" name="time_0"></td>
                  <td width="10%" onclick="init_timer( 0, document.getElementById('name_0').value, repeat_stat[0], 'do_action( 0, Get_Current_Time() )', false ); do_init(0,true); do_start(0,false); do_stop(0,false); do_output(0);" id="init_0"><b>INIT</b></td>
                  <td width="5%">&nbsp;</td>
                  <td width="10%" onclick="do_Start_Timer( 0, function() { write_Get_Time( 0 ) ; } ); do_start(0,true); do_stop(0,false); do_init(0,false); do_output(0);" id="start_0"><b>START</b></td>
                  <td width="5%">&nbsp;</td>
                  <td width="10%"onclick="do_Stop_Timer( 0 ); do_stop(0,true); do_start(0,false); do_init(0,false); do_output(0);" id="stop_0"><b>STOP</b></td>
                  <td width="5%">&nbsp;</td>
                  <td width="10%"onclick="Toogle_Repeat( 0 ); do_output( 0 );" id="repeat_0"><i>REPEAT</i></td>
              </tr>
              <tr width="100%">
                 <td colspan="11" id="output_0">........</td> 
              </tr>
              <tr width="100%">
                  <td width="15%" id="data_1">------------</td>
                  <td width="15%" id="date_1">++++++++++++</td>
                  <td width="5%">&nbsp;</td>
                  <td width="10%"><span>TIME:</span><input id="name_1" value="1" name="time_1"></td>
                  <td width="10%" onclick="init_timer( 1, document.getElementById('name_1').value, repeat_stat[1], 'do_action( 1, Get_Current_Time() )', false ); do_init(1,true); do_start(1,false); do_stop(1,false); do_output(1);" id="init_1"><b>INIT</b></td>
                  <td width="5%">&nbsp;</td>
                  <td width="10%" onclick="do_Start_Timer( 1, function() { write_Get_Time( 1 ) ; } ); do_start(1,true); do_stop(1,false); do_init(1,false); do_output(1);" id="start_1"><b>START</b></td>
                  <td width="5%">&nbsp;</td>
                  <td width="10%"onclick="do_Stop_Timer( 1 ); do_stop(1,true); do_start(1,false); do_init(1,false); do_output(1);" id="stop_1"><b>STOP</b></td>
                  <td width="5%">&nbsp;</td>
                  <td width="10%"onclick="Toogle_Repeat( 1 ); do_output( 1 );" id="repeat_1"><i>REPEAT</i></td>
              </tr>
              <tr width="100%">
                 <td colspan="11" id="output_1">........</td> 
              </tr>
          </table>
      </div>
  </body>
</html>
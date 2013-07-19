// Group 2 Entertainment site
//
// vers. 0.1 - 20081120.2331
//
// http://uol-site.datanet-pt.net/@js/event_handlers.js



// This module implements 16 independent timers that whenever "timeout" call a passed funciton


      //////////////////////////
      // Variable declaration //
      //////////////////////////

        var nr_timers = 16 ;

        var Do_Tick_Action = null ;

        var time_secs = new Array(nr_timers) ;
        var time_count = new Array(nr_timers) ;
        var tHandle = new Array(nr_timers) ;
        var timer_running = new Array(nr_timers) ;
        var timer_repeat = new Array(nr_timers) ;
        var timer_callback = new Array(nr_timers) ;

        var timer_delay = 1000 ;		// Value in miliseconds
 

      ////////////////////
      // Initialization //
      ////////////////////

        for(var i = 0 ; i <= nr_timers ; i++ )
        {
          time_secs[i] = 0 ;
          tHandle[i] = null ;
          timer_running[i] = false ;
          timer_repeat[i] = false ;
          timer_callback[i] = "" ;
        }



      //////////////////////////
      // Functions definition //
      //////////////////////////

        function Timer_Init(Timer_Nr, NumberOfSecs, Repeat)
        {
          time_secs[Timer_Nr] = NumberOfSecs ;
          time_count[Timer_Nr] = time_secs[Timer_Nr] ;
          timer_repeat[Timer_Nr] = Repeat ;
          Stop_Timer(Timer_Nr) ;
          Start_Timer(Timer_Nr) ;
        }


        function Stop_Timer(Timer_Nr)
        {
          if ( timer_running[Timer_Nr] == true )
          {
            clearTimeout( tHandle[Timer_Nr] ) ;
            tHandle[Timer_Nr] = null ;
          }
          timer_running[Timer_Nr] = false ;
        }


        function Start_Timer(Timer_Nr)
        {
          if ( timer_running[0] == false )
          {
            tHandle[0] = self.setTimeout("Tick_Timers()", timer_delay) ;
            timer_running[0] = true ;
          }
          tHandle[Timer_Nr] = self.setTimeout(timer_callback[Timer_Nr], timer_delay) ;
          timer_running[Timer_Nr] = true ;
        }


        function Tick_Timers()
        {
          for( var i = 1 ; i <= nr_timers ; i++ )
          {
            if( time_count[i] == 0 )
            {
              if( timer_repeat[i] == false )
              {
                Stop_Timer(i) ;
              }
              else
              time_count[i] == time_secs[i] ;
 
              tHandle[i] = self.setTimeout(timer_callback[i], timer_delay) ;

            }
            else
            {
              time_secs[i] = time_secs[i] - 1 ;
            }

            eval(Do_Tick_Action) ;

            timer_running[i] = true ;

          }

          tHandle[0] = self.setTimeout("Tick_Timers()", timer_delay) ;

        }



      ///////////////////////////
      // Give greating message //
      ///////////////////////////



      /////////////////////////////////////////////////
      // Output the result XHTML page to the browser //
      /////////////////////////////////////////////////



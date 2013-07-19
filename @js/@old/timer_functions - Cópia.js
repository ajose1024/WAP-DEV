// This module implements 16 independent timers that whenever "timeout" call a passed function


	//////////////////////////
	// Variable declaration //
	//////////////////////////

        var nr_timers = 16 ;

        var Do_Tick_Action = function () { window.status("Ticking..."); } ;

        var time_secs = new Array(nr_timers) ;
        var time_count = new Array(nr_timers) ;
        var tHandle = new Array(nr_timers) ;
        var timer_running = new Array(nr_timers) ;
        var timer_repeat = new Array(nr_timers) ;
        var timer_callback = new Array(nr_timers) ;

        var timer_delay = 1000 ;		// Value in miliseconds
 

	eval("Do_Tick_Action");

	////////////////////
	// Initialization //
	////////////////////

	// Aqui é feita a inicialização das variáveis utilizadas no modulo
	// De início nenhum dos timers tem acção nem está activo.

        for(var i = 0 ; i <= nr_timers ; i++ )
        {
          time_secs[i] = 0 ;
          tHandle[i] = null ;
          timer_running[i] = false ;
          timer_repeat[i] = false ;
          timer_callback[i] = null ;
        }



	//////////////////////////
	// Functions definition //
	//////////////////////////

	// Função:  Timer_Init( Timer_nr, NumberOfSecs, Repeat , Timer_Callback )
	//
	// Esta função inicializa o timer seleccionado, para disparar ao fim
	// de NumberOfSecs, com a indicação de se se o mesmo repete automa-
	// ticamente ou não, de acordo com o seguinte:
	//
	//	Repeat = FALSE --> O timer não repete
	//	Repeat = TRUE  --> O timer é rearmado quando o tempo se esgotar
	//
	// O parâmetro Timer_Callback tem a função de callback a ser chamada
	// quando o timer esgotar seu tempo, quer seja re-armado ou não

        function Timer_Init(Timer_Nr, NumberOfSecs, Repeat, Timer_Callback )
        {
          time_secs[Timer_Nr] = NumberOfSecs ;
          time_count[Timer_Nr] = time_secs[Timer_Nr] ;
          timer_repeat[Timer_Nr] = Repeat ;
	  timer_callback[Timer_Nr] = Timer_Callback;
          Stop_Timer(Timer_Nr) ;
          Start_Timer(Timer_Nr) ;
        }


	// Função:  Stop_Timer( Timer_nr )
	//
	// Se o timer seleccionado for o timer 0, o timer de activação
	// da função Tick_Timers() é desactivado e todo o sistema de
	// timers fica totalmente desactivado
	//
	// Se o timer seleccionado estiver activo, o mesmo é desactivado.
	// Neste caso, o 'timeout' que deveria ocorrer quando o tempo a
	// ser contado expira nunca ocorrera, ou seja, o timer seleccionado
	// é terminado IMEDIATAMENTE

        function Stop_Timer(Timer_Nr)
        {
          if ( timer_running[Timer_Nr] == true )
          {
            clearTimeout( tHandle[Timer_Nr] ) ;
            tHandle[Timer_Nr] = null ;
          }
          timer_running[Timer_Nr] = false ;
        }


	// Função:  Start_Timer( Timer_nr )
	//
	// Se o timer seleccionado for o timer 0, o timer de controlo da
	// função Tick_Timers() é armado, com um delay de 'timer_delay'
	//
	// Se qualquer outro timer for selecionado, o timer de controlo
	// respectivo é armado para iniciar o processamento desse timer.

        function Start_Timer(Timer_Nr)
        {
	  // Garante que o Timer_Nr é válido
	  // 
	  if ( Timer_Nr == 0 )
	  {
	    // Se for o timer[0], então inicia todo o sistema de timers
	    if ( timer_running[0] == false )
            {
              tHandle[0] = setTimeout("Tick_Timers()", timer_delay) ;
              timer_running[0] = true ;
            }
	  }
	  else
	  {
	    // Se for o timer[n], então inicia esse timer
            tHandle[Timer_Nr] = setTimeout(timer_callback[Timer_Nr], timer_delay) ;
            timer_running[Timer_Nr] = true ;
	  }
        }


	// Função:  Tick_Timers()
	//
	// Esta função é a função que é chamada periodicamente para processar
	// todos os timers activos

        function Tick_Timers()
        {
          for( var i = 1 ; i <= nr_timers ; i++ )
          {
            if( time_count[i] <= 0 )
            {
              if( timer_repeat[i] == false )
              {
                Stop_Timer(i) ;
              }
              else
	      {
                time_count[i] = time_secs[i] ;
		tHandle[i] = setTimeout(timer_callback[i], 
					    ( timer_delay * time_secs(i) )
					    ) ;
	      }
            }
            else
            {
              time_secs[i] = time_secs[i] - 1 ;
            }

            eval(self.Do_Tick_Action) ;

            timer_running[i] = true ;

          }

          tHandle[0] = self.setTimeout("self.Tick_Timers()", timer_delay) ;

        }


// This module implements 16 independent timers that whenever "timeout" call a passed funciton


	//////////////////////////
	// Variable declaration //
	//////////////////////////

	var nrx = 0 ;

document.writeln("Timer Functions (DEBUG version)<br/>");
document.writeln("<hr/>");
document.writeln("Declarando as variaveis:<br/>");

        var nr_timers = 16 ;
document.writeln("nr_timers = " + nr_timers + "<br/>");

        var Do_Tick_Action = function () { window.status("Ticking..."); } ;
//        var Do_Tick_Action = "alert(\"Ticking...\")";
document.writeln("Do_Tick_Action = " + Do_Tick_Action + "<br/>");

	var Do_Tick_Action_flag = false ;
document.writeln("Do_Tick_Action_flag = " + Do_Tick_Action_flag + "<br/>");

        var time_secs = new Array(nr_timers) ;
document.writeln("time_secs = " + time_secs + "<br/>");

        var time_count = new Array(nr_timers) ;
document.writeln("time_count = " + time_count + "<br/>");

        var tHandle = new Array(nr_timers) ;
document.writeln("tHandle = " + tHandle + "<br/>");

        var timer_running = new Array(nr_timers) ;
document.writeln("timer_running = " + timer_running + "<br/>");

        var timer_repeat = new Array(nr_timers) ;
document.writeln("timer_repeat = " + timer_repeat + "<br/>");

        var timer_callback = new Array(nr_timers) ;
document.writeln("timer_callback = " + timer_callback + "<br/>");

        var timer_delay = 1000 ;		// Value in miliseconds
document.writeln("timer_delay = " + timer_delay + "<br/>");

 
document.writeln("<hr/>");
document.writeln("Executando: 'eval(\"Do_Tick_Action\");'<br/>");

	eval(Do_Tick_Action);

	////////////////////
	// Initialization //
	////////////////////

	// Aqui é feita a inicialização das variáveis utilizadas no modulo
	// De início nenhum dos timers tem acção nem está activo.

document.writeln("<hr/>");
document.writeln("Inicializando as variaveis:<br/>");

        for(var i = 0 ; i <= nr_timers ; i++ )
        {
          time_secs[i] = 0 ;
	  time_count[i] = 0 ;
          tHandle[i] = null ;
          timer_running[i] = false ;
          timer_repeat[i] = false ;
          timer_callback[i] = null ;
        }

document.writeln("<hr/>");
document.writeln("Variaveis inicializadas:<br/>");

document.writeln("time_secs = " + time_secs + "<br/>");
document.writeln("time_count = " + time_count + "<br/>");
document.writeln("tHandle = " + tHandle + "<br/>");
document.writeln("timer_running = " + timer_running + "<br/>");
document.writeln("timer_repeat = " + timer_repeat + "<br/>");
document.writeln("timer_callback = " + timer_callback + "<br/>");



	//////////////////////////
	// Functions definition //
	//////////////////////////

document.writeln("<hr/>");
document.writeln("Defini&ccedil;&atilde;o da fun&ccedil;&atilde;o Set_Do_Tick_Action:<br/>");

	// Função:  Set_Do_Tick_Action( Do_Tick_Action )
	//
	// Esta função define a variavel 'Do_Tick_Action' com o código em
	// JavaScript que lhe é passado, a qual, se não for uma string vazia
	// é executado na função 'Tick_Timers()' de cada vez que a mesma é
	// chamada, desde que a variavel 'Enable_Do_Tick_Action' seja TRUE.

	function Set_Do_Tick_Action( Do_Tick_Action_code )
	{
		if( Do_Tick_Action_code.length > 0 )
		{
			Do_Tick_Action = Do_Tick_Action_code ;
		}
		else
		{
			Do_Tick_Action = "" ;
		}
	}


document.writeln("<hr/>");
document.writeln("Defini&ccedil;&atilde;o da fun&ccedil;&atilde;o Enable_Do_Tick_Action:<br/>");

	// Função:  Enable_Do_Tick_Action()
	//
	// Esta função coloca TRUE na variavel 'Enable_Do_Tick_Action' o que
	// permite que o código na variavel 'Do_Tick_Action' seja executado
	// cada vez que a função 'Tick_Timers()' for chamada.

	function Enable_Do_Tick_Action()
	{
		Do_Tick_Action_flag = true ;
	}


document.writeln("<hr/>");
document.writeln("Defini&ccedil;&atilde;o da fun&ccedil;&atilde;o Disable_Do_Tick_Action:<br/>");

	// Função:  Disable_Do_Tick_Action()
	//
	// Esta função coloca FALSE na variavel 'Enable_Do_Tick_Action' o que
	// inibe que o código na variavel 'Do_Tick_Action' seja executado
	// cada vez que a função 'Tick_Timers()' for chamada

	function Disable_Do_Tick_Action()
	{
		Do_Tick_Action_flag = false ;
	}


document.writeln("<hr/>");
document.writeln("Defini&ccedil;&atilde;o da fun&ccedil;&atilde;o Timer_Init:<br/>");

	// Função:  Timer_Init( Timer_nr, NumberOfSecs, Repeat , Timer_Callback )
	//
	// Esta função inicializa o timer seleccionado, para disparar ao fim
	// de NumberOfSecs, com a indicação de se o mesmo repete automatica-
	// mente ou não, de acordo com o seguinte:
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

document.writeln("<hr/>");
document.writeln("Defini&ccedil;&atilde;o da fun&ccedil;&atilde;o Stop_Timer:<br/>");

        function Stop_Timer(Timer_Nr)
        {
          if ( timer_running[Timer_Nr] == true )
          {
            window.clearTimeout( tHandle[Timer_Nr] ) ;
            tHandle[Timer_Nr] = -1 ;
          }
	  else
	  {
	    tHandle[Timer_Nr] = -2 ;
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

document.writeln("<hr/>");
document.writeln("Defini&ccedil;&atilde;o da fun&ccedil;&atilde;o Start_Timer:<br/>");

        function Start_Timer(Timer_Nr)
        {
	  // Garante que o Timer_Nr é válido
	  // (neste can 
	  if ( Timer_Nr == 0 )
	  {
	    // Se for o timer[0], então inicia todo o sistema de timers
	    if ( timer_running[0] == false )
            {
	      time_secs[0] = 1 ;
              tHandle[0] = window.setTimeout( "tick_Timers()", timer_delay ) ;
              timer_running[0] = true ;
            }
	    else
	    {
	      window.clearTimeout( tHandle[0] );
	      tHandle[0] = 0 ;
	      timer_running[0] = false ;
	    }
	  }
	  else
	  {
	    if ( timer_running[Timer_Nr] == false )
	    {
	      // Se for o timer[n], então inicia esse timer
              tHandle[Timer_Nr] = window.setTimeout(timer_callback[Timer_Nr], timer_delay) ;
              timer_running[Timer_Nr] = true ;
	    }
	    else
	    {
	      window.clearTimeout( tHandle[Timer_Nr] );
	      tHandle[Timer_Nr] = 0 ;
	      timer_running[0] = false ;
	    }
	  }
        }


	// Função:  Tick_Timers()
	//
	// Esta função é a função que é chamada periodicamente para processar
	// todos os timers activos

document.writeln("<hr/>");
document.writeln("Defini&ccedil;&atilde;o da fun&ccedil;&atilde;o Tick_Timers:<br/>");

        function tick_Timers()
        {
document.writeln("<hr/>");
document.writeln("Starting function Tick_Timers()...<br/>");
document.writeln("nrx = " + nrx + "<br/>" );
document.writeln("timer_delay = " + timer_delay + "<br/>");
document.writeln("time_secs = " + time_secs + "<br/>");
          for( var i = 1 ; i <= nr_timers ; i++ )
          {
document.writeln("loop variable = " + i + "<br/>");
            if( time_count[i] <= 0 )
            {
              if( timer_repeat[i] == false )
              {
                Stop_Timer(i) ;
              }
              else
	      {
                time_count[i] = time_secs[i] ;
document.writeln("Rearming the general timer... <br/>");
		tHandle[i] = window.setTimeout(timer_callback[i], 
					    ( timer_delay * time_secs[i] )
					    ) ;
document.writeln("tHandle = " + tHandle + "<br/>");
	      }
            }
            else
            {
              time_count[i] = time_count[i] - 1 ;
              timer_running[i] = true ;
            }
          }

 document.writeln("Rearm timer for tick_Timers()...<br/>");

          var t = window.setTimeout("tick_Timers", 1000 ) ;

 document.writeln("tHandle = " + t + "<br/>");

 document.writeln("Timer for tick_Timers re-armed!<br/>");

		var today = new Date();
		var hours   = today.getHours();
		var minutes = today.getMinutes();
		var seconds = today.getSeconds();
		// Add a zero in front of numbers if they are less then 10
		//		minutes = checkTime( minutes );
		//		seconds = checkTime( seconds );
		
		prompt( hours + ":" + minutes + ":" + seconds ) ;


	  if( Do_Tick_Action_flag == true )
	  {
document.writeln("Executando a fun&ccedil;&atilde;o \"Do_Tick_Action\"...<br/>");
document.writeln("Do_Tick_Action = " + Do_Tick_Action + "<br/>");
	    eval(Do_Tick_Action);
document.writeln("Fun&ccedil;&atilde;o \"Do_Tick_Action\" executada.<br/>");
	  }

document.writeln("Ending function Tick_Timers().<br/>");
        }


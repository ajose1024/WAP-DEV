// This module implements 16 independent timers that whenever "timeout" call a passed function


	/////////////////////////////
	// Declaração de variáveis //
	/////////////////////////////
        
        ////////////////////////////////////////
        // Variáveis modificáveis do exterior //
        ////////////////////////////////////////

        // Número de timers
        var nr_timers = 16 ;

        // Tempo em milisegundos da unidade base de tempo
        var timer_delay = 1000 ;


        //////////////////////////////////
        // Variáveis internas do módulo //
        //////////////////////////////////

        // Tempo em segundos de cada timer, enquanto activo
        var time_secs = new Array(nr_timers) ;
        // Contador de tempo, enquanto o timer está activo (conta decrescentemente
        // de time_secs até 0
        var time_count = new Array(nr_timers) ;
        // HANDLE de cada timer, enquanto activo
        var tHandle = new Array(nr_timers) ;
        // Flag que indica se o timer está activo ou não
        var timer_running = new Array(nr_timers) ;
        // Flag que indica se o timer é "one-shot" ou se é "repeating"
        var timer_repeat = new Array(nr_timers) ;
        // Função de "callback" a ser chamada, cada vez que o tempo termina
        var timer_callback = new Array(nr_timers) ;

        // Acção por defeito da função tick_timers()
        var Do_Tick_Action = function() {} ;

 
        // Variável que contem o código da função que chama a 
//	var Do_Tick_Action_function = window.Do_Tick_Action ;


	////////////////////
	// Initialization //
	////////////////////

	// Aqui é feita a inicialização das variáveis utilizadas no modulo
	// De início nenhum dos timers tem acção nem está activo.

        for ( i = 0 ; i <= nr_timers ; i++ )
        {
          time_secs[i] = 0 ;
          time_count[i] = 0 ;
          tHandle[i] = null ;
          timer_running[i] = false ;
          timer_repeat[i] = false ;
          timer_callback[i] = "" ;
        }



	//////////////////////////
	// Functions definition //
	//////////////////////////
        
        // Função:  Set_Timer_Delay( new_time_delay)
        //
        // Esta função re-define o valor do Timer_Delay (em milisegundos)
        
        function Set_Timer_Delay( new_timer_delay )
        {
            timer_delay = new_timer_delay ;
        }
        
        
        // Função:  Set_Do_Tick_Action( Tick_Action )
        //
        // Esta função define a função Do_Tick_Action()
        
        function Set_Do_Tick_Action ( Tick_Action )
        {
            Do_Tick_Action = Tick_Action ;
        }


        // Função:  Disable_Do_Tick_Action( )
        //
        // Estas função limpa a acção Tick_Action
        
        function Disable_Do_Tick_Action ( )
        {
            Do_Tick_Action = function() {} ;
        }


	// Função:  Stop_Timer( timer_nr )
	//
	// Se o timer seleccionado for o timer 0, o timer de activação
	// da função Tick_Timers() é desactivado e todo o sistema de
	// timers fica totalmente desactivado
	//
	// Se o timer seleccionado estiver activo, o mesmo é desactivado.
	// Neste caso, o 'timeout' que deveria ocorrer quando o tempo a
	// ser contado expira nunca ocorrera, ou seja, o timer seleccionado
	// é terminado IMEDIATAMENTE
        //
        // Se o número do timer for diferente de 0 ou um timer válido, a
        // função retorna FALSE. Caso contrário, retorna TRUE.

        function Stop_Timer( timer_nr )
        {
            if ( timer_nr >= 0 && timer_nr <= nr_timers )
            {
                // Se for o timer[n], então para esse timer
                if ( timer_running[ timer_nr ] === true )
                {
                    clearTimeout( tHandle[ timer_nr ] ) ;
                    tHandle[ timer_nr ] = null ;
                }
                timer_running[ timer_nr ] = false ;

                return true ;
            }
            else
            {
                return false ;
            }
        }


	// Função:  Start_Timer( Timer_nr )
	//
	// Se o timer seleccionado for o timer 0, o timer de controlo da
	// função Tick_Timers() é armado, com um delay de 'timer_delay'
	//
	// Se qualquer outro timer for selecionado, o timer de controlo
	// respectivo é armado para iniciar o processamento desse timer.
        //
        // Se o número do timer for diferente de 0 ou um timer válido, a
        // função retorna FALSE. Caso contrário, retorna TRUE.

        function Start_Timer( timer_nr )
        {
            // Se o Timer_Nr for o Timer 0, o sistema de timers é activado
            if ( timer_nr === 0 )
            {
                // Se for o timer[0], então inicia todo o sistema de timers
                if ( timer_running[timer_nr] === false )
                {
                    tHandle[timer_nr] = setTimeout( window.Tick_Timers ,
                                                    timer_delay
                                                  ) ;
                    timer_running[timer_nr] = true ;
                }
                return true ;
            }
            else
            {
                if ( timer_nr >= 1 && timer_nr <= nr_timers )
                {
                    // Se for o timer[n], então inicia esse timer
                    tHandle[timer_nr] = setTimeout( window.timer_callback[timer_nr],
                                                    timer_delay * time_secs[timer_nr]
                                                  ) ;
                    timer_running[timer_nr] = true ;

                    return true ;
                }
                else
                {
                    return false ;
                }
            }
        }


	// Função:  Timer_Init( Timer_nr, NumberOfSecs, Repeat , Timer_Callback, AutoStart )
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
        //
        // O parâmetro AutoStart define se o timer inicia imediatamente quando
        // é inicializado ou se é necessário o chamar a função Start_Timer para o iniciar.
        // 
        // Se o número do timer for diferente de 0 ou um timer válido, a
        // função retorna FALSE. Caso contrário, retorna TRUE.

        function Timer_Init( timer_nr, NumberOfSecs, Repeat, Timer_Callback , AutoStart )
        {
            if ( timer_nr >= 0 && timer_nr <= nr_timers )
            {
                time_secs[timer_nr] = ( NumberOfSecs - 1 ) ;
                time_count[timer_nr] = time_secs[timer_nr] ;
                timer_repeat[timer_nr] = Repeat ;
                timer_callback[timer_nr] = Timer_Callback ;

                Stop_Timer(timer_nr) ;

                if ( AutoStart === true )
                {
                    Start_Timer(timer_nr) ;
                }

                return true ;
            }
            else
            {
                return false ;
            }
        }


	// Função:  Tick_Timers()
	//
	// Esta função é a função que é chamada periodicamente para processar
	// todos os timers activos

        function Tick_Timers()
        {
            for ( i = 0 ; i <= nr_timers ; i++ )
            {
                if( timer_running[i] === true )
                {
                    if( time_count[i] <= 0 )
                    {
                        if( timer_repeat[i] === false )
                        {
                            Stop_Timer( i ) ;
                            timer_running[i] = false ;
                        }
                        else
                        {
                            time_count[i] = time_secs[i] ;

                            if( i === 0 )
                            {
                                tHandle[0] = setTimeout( window.timer_callback[i],
                                                         timer_delay * time_secs[i]
                                                       ) ;
                            }
                            else
                            {
                                tHandle[i] = setTimeout( window.timer_callback[i], 
                                                         timer_delay * time_secs[i]
                                                       ) ;
                            }
                        }
                        time_count[i] = time_secs[i] ;
                    }
                    else
                    {
                        time_count[i] = time_count[i] - 1 ;
                    }
                }
                else
                {
                    timer_running[i] = false ;
                }
            }

            window.Do_Tick_Action() ;

//            f = function() { window.Do_Tick_Action ; } ;
//            f() ;

            tHandle[0] = setTimeout( window.Tick_Timers ,
                                     timer_delay
                                   ) ;

        }


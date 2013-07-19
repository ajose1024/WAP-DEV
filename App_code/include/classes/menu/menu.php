<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Admin
 */

interface Interface_menu {

    // Este membro da classe permite defenir o nivel do menu a que
    // vamos aceder
    public function Set_Menu_Level($menu_level);


    // Este membro da classe permite saber a que nivel do menu estamos
    // currentemente a aceder
    public function Get_Menu_Level();


    // Este membro da classe permite defenir o user_ID do menu a que
    // vamos aceder
    public function Set_user_ID($user_ID);


    // Este membro da classe permite saber o user_ID do menu estamos
    // currentemente a aceder
    public function Get_user_ID();


    // Este membro da classe permite definir o array $ext_attr de atributos
    // extendidos a ser utilizado para a renderização em HTML dos items do
    // menu
    public function Set_ext_attr($ext_attr);
    
    
    // Este membro da classe permite ir buscar o array de atributos extendidos
    // a ser correntemente utilizado para a renderização em HTML dos items do
    // menu
    public function Get_ext_attr();


    // Este membro da classe permite saber o número de items do menu
    // a que estamos a aceder
    public function get_nr_items();


    // Este membro da classe permite ir buscar o HTML correspondente ao elemento
    // seleccionado do menu seleccionado em $menu_level
    public function get_menu_item_html( $item_nr );


    // Este metodo da classe permite ir buscar os dados referentes a um elemento
    // do menu na tabela app_menu da base de dados, retornando um array com
    // esses dados.
    public function get_menu_item( $item_nr );


    // Este membro da classe permite armazenar os dados referentes a um elemento do
    // menu na tabela app_menu da base de dados ou modifica-los, caso já exista esse
    // elemento.
    public function set_menu_item();


}



class menu implements Interface_menu {

    // Esta variavel guarda o nivel do menu a que estamos a aceder.
    private $menu_level;


    // Esta variavel guarda o user_ID do menu a que estamos a aceder.
    private $user_ID;


    // Esta variavel guarda o array de stributos extendidos a ser utilizado.
    private $ext_attr;


    // Esta variavel guarda o número  de items do menu a que estamos a
    // aceder
    private $nr_items;
    

    // Esta variavel guarda o numero do item do menu a que estamos a
    // aceder numa dada iteração
    private $item_nr;


    // Este array contem todos os elementos do menu do nivel a que
    // estamos a aceder, após acedermos ao membro Get_Menu_Level desta
    // classe
    private $menu_data = array();


    // Este membro da classe permite defenir o nivel do menu a que
    // vamos aceder
    public function Set_Menu_Level($menu_level)
    {
        $this->menu_level = $menu_level;
    }


    // Este membro da classe permite saber a que nivel do menu estamos
    // currentemente a aceder
    public function Get_Menu_Level()
    {
        return $this->menu_level;
    }


    // Este membro da classe permite defenir o user_ID do menu a que
    // vamos aceder
    public function Set_user_ID($user_ID)
    {
        $this->user_ID = $user_ID;
    }


    // Este membro da classe permite saber o user_ID do menu estamos
    // currentemente a aceder
    public function Get_user_ID()
    {
        return $this->user_ID;
    }


    // Este membro da classe permite definir o array $ext_attr de atributos
    // extendidos a ser utilizado para a renderização em HTML dos items do
    // menu
    public function Set_ext_attr($ext_attr)
    {
        $this->ext_attr = $ext_attr ;
    }


    // Este membro da classe permite ir buscar o array de atributos extendidos
    // a ser correntemente utilizado para a renderização em HTML dos items do
    // menu
    public function Get_ext_attr()
    {
        return  $this->ext_attr ;
    }


    // Este membro da classe permite saber o número de items do menu
    // a que estamos a aceder
    public function get_nr_items()
    {
        // Para o fazer temos de aceder a base de dados app_DB, na tabela
        // app_menu e fazer:
        //
        //  SELECT * FROM app_menu WHERE menu_level = < $this->Get_Menu_Level >
	    //	AND  user_ID = < $this->Get_user_ID >
        //
        // Depois vamos utilizar os dados do select para deixar preenchido o
        // array $menu_data[] e retornamos o seguinte:
	    //
	    //	return = 0	-->	O menu não tem items
	    //	return = n	-->	O menu tem n items
	    //	return = -1	-->	Não foi possivel aceder a base de dados


        // Abrir a base de dados app_DB
        $app_DB_open_result_array = app_DB_open( 0 );

        // Testar se foi possivel abrir a base de dados ou não
        if( $app_DB_open_result_array['status'] != 0 )
        {
            // Não foi possivel abrir a base de dados!!!
            return  -1 ;
    	}
        else
        {
            // $ADODB_conn_obj  tem o objecto de ligação a base de dados
            $ADODB_conn_obj = $app_DB_open_result_array['conn_obj'];
        }

        // Instancializa a classe 'app_menu' em $app_menu_obj
        $app_menu_obj = new app_menu;

        // Faz a query sobre a tabela 'app_menu' da base de dados para:
        //  $menu_level = $this->menu_level
        //  $user_ID    = $this->user_ID
        $query_result = $app_menu_obj->query( $ADODB_conn_obj,
                                              $this->menu_level,
                                              $this->user_ID
                                            );

        // Fecha o acesso à base de dados 'app_DB'
        app_DB_close($ADODB_conn_obj);

        // Guarda o numero de items do menu na variavel da classe
        // $this->nr_items
        $this->nr_items = $query_result['num_items'] ;

        // Guarda o array com os dados na variavel da classe $this->menu_data
        $this->menu_data = $query_result ;

        // Retorna o número de items do menu
        return ( $this->nr_items );

    }


    // Este membro da classe permite ir buscar o HTML correspondente ao elemento
    // seleccionado do menu seleccionado em $menu_level
    public function get_menu_item_html( $item_nr )
    {
        // Garantir que o valor passado $item_nr se encontra dentro do limite
        // ( 0 .. $this->nr_items-1)
        $item_nr = ( $item_nr - 1 ) % $this->nr_items ;

        // Vai buscar os elementos do item seleccionado
        $menu_item_data = $this->menu_data[ $item_nr ] ;

        // Instancializa o objecto para criar o HTML para cada tipo de elemento
        // do menu
        $menu_item_HTML_obj = new Item_Type;

        // Obtem o tipo do elemento do menu seleccionado
        $menu_item_type = $this->menu_data[$item_nr]['item_type'] ;

        // Chama o metodo apropriado do objecto $menu_item_HTML_obj
        switch($menu_item_type):
            // No caso do tipo ser 1 (item do menu em TEXTO)
            case 1:
                return  $menu_item_HTML_obj->type_TEXT(
                                                    $this->menu_data[$item_nr],
                                                    $this->ext_attr
                                                      );
                break;

            // No caso do tipo ser 2 (item do menu em IMAGEM)
            case 2:
                return  $menu_item_HTML_obj->type_IMG(
                                                    $this->menu_data[$item_nr],
                                                    $this->ext_attr
                                                     );
                break;

            // No caso do tipo ser 3 (item do menu em IMAGEM ROLLOVER)
            case 3:
                return  $menu_item_HTML_obj->type_IMG_ROLLOVER(
                                                    $this->menu_data[$item_nr],
                                                    $this->ext_attr
                                                              );
                break;

            // No caso do tipo ser 4 (item do menu é um SPACER)
            case 4:
                return  $menu_item_HTML_obj->type_SPACER(
                                                    $this->menu_data[$item_nr],
                                                    $this->ext_attr
                                                        );
                break;

            // No caso do tipo ser 5 (item do menu é um TEXT SEPARATOR)
            case 5:
                return  $menu_item_HTML_obj->type_TEXT_SEPARATOR(
                                                    $this->menu_data[$item_nr],
                                                    $this->ext_attr
                                                                );
                break;

            // No caso do tipo ser 6 (item do menu é um IMAGE_SEPARATOR)
            case 6:
                return  $menu_item_HTML_obj->type_IMG_SEPARATOR(
                                                    $this->menu_data[$item_nr],
                                                    $this->ext_attr
                                                               );
                break;

            // Caso o mesmo não ser nenhum dos tipos definidos
            default:
                return '' ;

        endswitch;
     }


    // Este metodo da classe permite ir buscar os dados referentes a um elemento
    // do menu na tabela app_menu da base de dados, retornando um array com
    // esses dados.

    public function get_menu_item( $item_nr )
    {
        // Garantir que o valor passado $item_nr se encontra dentro do limite
        // ( 0 .. $this->nr_items-1)
        $item_nr = ( $item_nr - 1 ) % $this->nr_items ;

        // Vai buscar os elementos do item seleccionado
        $menu_item_data = $this->menu_data[ $item_nr ] ;

        // Retorna o array comos dados correspon dentes ao elemento do menu
        // seleccionado
        return  $this->menu_data[$item_nr] ;
    }


    // Este membro da classe permite armazenar os dados referentes a um elemento do
    // menu na tabela app_menu da base de dados ou modifica-los, caso já exista esse
    // elemento.
    public function set_menu_item()
    {
	// Este metodo da classe permite inserir ou actualizar os dados do item de um
	// menu, na tabela app_menu da base de dados.
	//
	// Recebe um array com os elementos referentes ao item do menu a ser actualizado.
    }


}

?>

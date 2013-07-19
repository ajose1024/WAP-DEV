<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menu
 *
 * @author Admin
 */

class Menu {

    // Esta variavel guarda o nivel do menu a que estamos a aceder.
    private $menu_level;

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

    // Este membro da classe permite saber o número de items do menu
    // a que estamos a aceder
    public function get_nr_items()
    {
        // Para o fazer temos de aceder a base de dados app_DB, na tabela
        // app_menu e fazer:
        //
        //  SELECT * FROM app_menu WHERE menu_level = < $this->Get_Menu_Level >
        //
        // Depois vamos utilizar os dados do select para deixar preenchido o
        // array $menu_data[] e reornamos o seguinte:
	//
	//	return = 0	-->	O menu não tem items
	//	return = n	-->	O menu tem n items
	//	return = -1	-->	Não foi possivel aceder a base de dados

    }

    // Este membro da classe permite ir buscar o HTML correspondente ao elemento
    // corrente do menu seleccionado em $menu_level
    public function get_menu_item_html()
    {
	// Este metodo da classe é chamado repetidamente para ir buscar os elementos
	// do menu, retornando o código HTML do item do menu ou uma string vazia,
	// caso não haja mais elementos.
    }


    // Este metodo da classe permite ir buscar os dados referentes a um elemento do
    // menu na tabela app_menu da base de dados.
    public function Get_menu_item()
    {
	// Este metodo da classe permite ir buscar os dados do item de um menu, guardados
	// na tabela app_menu da base de dados.
	//
	// Retorna um array com os elementos referentes ao item do menu a ser actualizado.
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

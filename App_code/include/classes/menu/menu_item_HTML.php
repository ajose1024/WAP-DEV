<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Admin
 */
interface Interface_Item_Type {

    // Esta Classe tem membros de acordo com os difrentes tipos de items existentes
    // no menu.
    // Este metodo retorna o numero de items diferentes existentes no menu.
    public function Get_Nr_Types();


    // Este metodo retorna o codigo HTML para o menu_item quando este for um
    // elemento de texto claro.
    public function type_TEXT ( $menu_item_data, $element_attr );


    // Este metodo retorna o codigo HTML para o menu_item quando é um elemento de
    // imagem simples.
    public function type_IMG ( $menu_item_data, $element_attr );


    // Este metodo retorna o codigo HTML para o menu_item quando é um elemento de
    // imagem rollover (assume que as funçoes JavaScrip se encontram presentes
    // na pagina!)
    public function type_IMG_ROLLOVER ( $menu_item_data, $element_attr );


    // Este metodo retorna o codigo HTML para o menu_item quando for um elemento
    // em branco.
    public function type_SPACER ( $menu_item_data, $element_attr );


    // Este metodo retorna o codigo HTML para o menu_item quando for um elemento
    // separador de texto.
    public function type_TEXT_SEPARATOR ( $menu_item_data, $element_attr );


    // Este metodo retorna o codigo HTML para o menu_item quando a imagem for um
    // elemento separador.
    public function type_IMG_SEPARATOR ( $menu_item_data, $element_attr );


}



Class Item_Type implements Interface_Item_Type
{

    // Array que guarda os dados de uma row da tabela 'app_menu'
    //
    //  id              = Inteiro (selecciona o record para o update)
    //  menu_level      = String com o 'menu_level'
    //  new_menu_level  = String com o novo 'menu_level' ou string vazia
    //  item_type       = Inteiro:
    //      1 = Este item do menu é um elemento apenas em texto.
    //      2 = Este item do menu é uma imagem standard.
    //      3 = Este item do menu é um rollover de imagem que muda no
    //              evento 'onmouseover'
    //      4 = Este menu é um espaço em branco.
    //      5 = Este menu é um seprador (em texto).
    //      6 = Este menu é um separador (em imagem).
    //  item_link       = String com o link para onde o menu salta
    //  item_data_1     = String com dados (depende do tipo de item)
    //  item_data_2     = String com dados (depende do tipo de item)
    //  item_class      = String com o nome da classe para a CSS
    //  item_alt        = String com o texto de ALT
    //  item_width      = Inteiro com a largura em pixels do elemento
    //  item_height     = Inteiro com a altura em pixels do elemento
    //  item_active     = Flag:
    //      0 = O item do menu existe, mas não tem link activo
    //      1 = O item do menu existe e tem link activo
    //  item_hidden     = Flag:
    //      0 = O item do menu existe e é visivel
    //      1 = O item do menu existe mas não é visivel (não e desenhado)
    //  user_ID = Este campo tem o user_ID para que o menu é valido ou
    //            -1 no caso de não haver menus diferenciados

    private $priv_menu_data = array (   'ID' => '',
                                        'menu_level' => '',
                                        'new_menu_level' => '',
                                        'item_type' => '',
                                        'item_link' => '',
                                        'item_data_1' => '',
                                        'item_data_2' => '',
                                        'item_class' => '',
                                        'item_alt' => '',
                                        'item_width' => '',
                                        'item_height' => '',
                                        'item_active' => '',
                                        'item_hidden' => '',
                                        'user_ID' => ''
                                    );


    // Array que guarda os dados dos attributos opcionais do elemento
    //
    // Os elementos definidos são:
    //      attr_nr     = Número de elementos existentes no array
    //      a_tag_name  = Valor para o atributo 'name' do tag <a>, se definido
    //      a_tag_id    = Valor para o atributo 'id' do tag <a>, se definido
    //      p_tag_id    = Valor para o atributo 'id' do tag <p>, se definido
    
    private $priv_element_attr = array ( 'attr_nr' => '3',
                                         'a_tag_name' => '' ,
                                         'a_tag_id' => '' ,
                                         'p_tag_id' => ''
                                       );


    // Este membro da classe é privado à classe e recebe o array de atributos
    // o nome do elemento e o nome do attributo, retornando a string correspon-
    // dente se o mesmo estiver definido no array de atributos
    
    private function get_attr($priv_element_attr,$element_name,$attr_name)
    {
        $ret_string = '';

        // Se o segundo parâmetro não é um array, então retorna uma string vazia
        if ( ! is_array ( $priv_element_attr) )
        {
            return '';
        }

        if( array_key_exists( $element_name . '_tag_' . $attr_name,
                              $priv_element_attr
                            )
          )
        {
            // Se o elemento existir no array, vai ver se tem conteudo ou não
            // Se tiver conteudo, constroi a string para ser retornada.
            // Caso contrário, retorna uma string vazia.
            if( $priv_element_attr[ $element_name . '_tag_' . $attr_name ] != '' )
            {
                $ret_string = $attr_name .
                              "='" .
                              $priv_element_attr[ $element_name . '_tag_' . $attr_name ] .
                              "' ";
            }
        }
        return $ret_string;
    }


    // Este membro da classe é privado à classe e recebe o array de dados da
    // linha da tabela app_menu, o nome da coluna na tabela app_menu e o nome do
    // atributo, retornando a string correspondente se o mesmo tiver um valor
    // diferente de string vazia

    private function get_attr_str($priv_menu_data, $item_name, $attr_name )
    {
        $ret_string = '';

        // Se o segundo parâmetro não é um array, então retorna uma string vazia
        if ( ! is_array ( $priv_menu_data) )
        {
            return '';
        }

        if( array_key_exists( $item_name, $priv_menu_data ) )
        {
            // Se o elemento existir no array, vai ver se tem conteudo ou não
            // Se tiver conteudo, constroi a string para ser retornada.
            // Caso contrário, retorna uma string vazia.
            if( $priv_menu_data[ $item_name ] != '' )
            {
                $ret_string = $attr_name .
                              "='" .
                              $priv_menu_data[ $item_name ] .
                              "' ";
            }
        return $ret_string;
        }
    }


    // Este membro da classe é privado à classe e recebe o array de dados da
    // linha da tabela app_menu, o nome da coluna na tabela app_menu e o nome do
    // atributo, retornando a string correspondente se o mesmo tiver um valor
    // diferente de string vazia

    private function get_attr_num($priv_menu_data, $item_name, $attr_name )
    {
        $ret_string = '';

        // Se o segundo parâmetro não é um array, então retorna uma string vazia
        if ( ! is_array ( $priv_menu_data) )
        {
            return '';
        }

        if( array_key_exists( $item_name, $priv_menu_data ) )
        {
            // Se o elemento existir no array, vai ver se tem conteudo ou não
            // Se tiver conteudo, constroi a string para ser retornada.
            // Caso contrário, retorna uma string vazia.
            if( $priv_menu_data[ $item_name ] != 0 )
            {
                $ret_string = $attr_name .
                              "='" .
                              $priv_menu_data[ $item_name ] .
                              "' ";
            }
        return $ret_string;
        }
    }


    // Esta Classe tem membros de acordo com os difrentes tipos de items existentes
    // no menu.
    // Este metodo retorna o numero de items diferentes existentes no menu.
    public function Get_Nr_Types()
    {
        // Este metodo retorna o numero items diferentes existentes no menu.
        // Os tipos definidos sao:
        // ----------------------
        //  1 = Este item do menu é um elemento apenas em texto.
        //  2 = Este item do menu é uma imagem standard.
        //  3 = Este item do menu é um rollover de imagem que muda no envento
        //      'onmouseover'
        //  4 = Este menu é um espaço em branco.
        //  5 = Este menu é um seprador (em texto).
        //  6 = Este menu é um separador (em imagem).

        return 6;

    }


    // Este metodo retorna o codigo HTML para o menu_item quando este for um
    // elemento de texto claro.
    public function type_TEXT ( $menu_item_data, $element_attr )
    {
        // Este metodo recebe um array com os elementos do menu_item e retorna a
        // string com o codigo HTML.
        //
        // Recebe tambem um outro array, que é opcional, com os valores dos
        // atributos a incluir, se existirem.
        //
        // Exemplo do HTML:
        //
        //  <a href='item_link' style='item_class' target='item_data_2'
        //      name=<'a_name'> id=<'a_id'>
        //      <p id=<'p_id'> style='item_class'>'item_data_1</p>
        //  </a>
        //
        // O elemento <a>...</a> é apenas retornado se o campo 'item_active' for
        // diferente de 0.
        //
        // Se o campo 'item_hidden' for diferente de 0, a string retornada é vazia

    	$menu_item = '';

        if ( $menu_item_data['item_hidden'] == 0 )
        {
            // Se o valor do campo 'item_hidden' é FALSE (=0) então retorna
            // a string com o HTML correspondente ao tipo de item do menu.
            //
            // Caso contrário, retorna uma string vazia.


            // Cria o elemento '<p>...'</p>' com os dados apropriados
            
/*            $menu_item = "<p " .
                         $this->get_attr($element_attr,'p','id') .
                         $this->get_attr_str($menu_item_data,'item_class','style') .
                         '>' .
                         $menu_item_data['item_data_1'] .
                         '</p>'
*/
             $menu_item = "" .
//                         $this->get_attr($element_attr,'p','id') .
//                         $this->get_attr_str($menu_item_data,'item_class','style') .
//                         '>' .
                         $menu_item_data['item_data_1']
//                         '</p>'
            ;

            if ( $menu_item_data['item_active'] == 1 )
            {
                // Neste caso, vamos construir o elemento <a>...</a> à volta
                // do que ja temos, pois o item do menu tem link
                
                // Para o elemento <a...> temos:
                $menu_item = "<a " .
                             "href='" . $menu_item_data['item_link'] . "' " .
                             $this->get_attr_str($menu_item_data,'item_class','style') .
                             $this->get_attr_str($menu_item_data,'item_data_2','target') .
                             $this->get_attr($element_attr,'a','name') .
                             $this->get_attr($element_attr,'a','id') .
                             ">" .
                             $menu_item ;

                // Para o elemento </a> temos:
                $menu_item = $menu_item . "</a>";
            }
        }
    	return  $menu_item;
    }


    // Este metodo retorna o codigo HTML para o menu_item quando é um elemento de
    // imagem simples.
    public function type_IMG ( $menu_item_data, $element_attr )
    {
        // Este metodo recebe um array com os elementos do menu_item e retorna a
        // string com o codigo HTML.
        //
        // Recebe tambem um outro array, que é opcional, com os valores dos
        // atributos a incluir, se existirem.
        //
        // Exemplo do HTML:
        //
        //  <a href='item_link' style='item_class' target='item_data_2'
        //      name=<'a_name'> id=<'a_id'>
        //      <img id=<'p_id'> style='item_class' src='item_data_1' />
        //  </a>
        //
        // O elemento <a>...</a> é apenas retornado se o campo 'item_active' for
        // diferente de 0.
        //
        // Se o campo 'item_hidden' for diferente de 0, a string retornada é vazia

    	$menu_item = '';

        if ( $menu_item_data['item_hidden'] == 0 )
        {
            // Se o valor do campo 'item_hidden' é FALSE (=0) então retorna
            // a string com o HTML correspondente ao tipo de item do menu.
            //
            // Caso contrário, retorna uma string vazia.


            // Cria o elemento '<img ... />' com os dados apropriados se o
            // campo $menu_item_data['item_data_1'] tiver conteudo

            if ( $menu_item_data['item_data_1'] != '' )
            {
                $menu_item = "<img " .
                             $this->get_attr($element_attr,'img','id') .
                             $this->get_attr($element_attr,'img','name') .
                             $this->get_attr($element_attr,'img','class') .
                             $this->get_attr($element_attr,'img','border') .
                             $this->get_attr_str($menu_item_data,'item_data_1','src') .
                             $this->get_attr_str($menu_item_data,'item_alt','alt') .
                             $this->get_attr_str($menu_item_data,'item_class','style') .
                             $this->get_attr_num($menu_item_data,'item_height','height') .
                             $this->get_attr_num($menu_item_data,'item_width','width') .
                             $menu_item_data['item_data_1'] .
                             '/>'
                ;
            }
            else
            {

            }

            if ( $menu_item_data['item_active'] == 1 )
            {
                // Neste caso, vamos construir o elemento <a>...</a> à volta
                // do que ja temos, pois o item do menu tem link

                // Para o elemento <a...> temos:
                $menu_item = "<a " .
                             "href='" . $menu_item_data['item_link'] . "' " .
                             $this->get_attr_str($menu_item_data,'item_class','style') .
                             $this->get_attr_str($menu_item_data,'item_data_2','target') .
                             $this->get_attr($element_attr,'a','name') .
                             $this->get_attr($element_attr,'a','id') .
                             ">" .
                             $menu_item ;

                // Para o elemento </a> temos:
                $menu_item = $menu_item . "</a>";
            }
        }
    	return  $menu_item;

    }


    // Este metodo retorna o codigo HTML para o menu_item quando é um elemento de
    // imagem rollover (assume que as funçoes JavaScrip se encontram presentes
    // na pagina!)
    public function type_IMG_ROLLOVER ( $menu_item_data, $element_attr )
    {
    // Este metodo recebe um array com os elementos do menu_item e retorna a
    // string com o codigo HTML.

        $menu_item = '';


        return  $menu_item;

    }

    // Este metodo retorna o codigo HTML para o menu_item quando for um elemento
    // em branco.
    public function type_SPACER ( $menu_item_data, $element_attr )
    {
    // Este metodo recebe um array com os elementos do menu_item e retorna a string
    // com o codigo HTML.

    	$menu_item = '';

        $menu_item = '&nbsp;';

    	return  $menu_item;

    }

    // Este metodo retorna o codigo HTML para o menu_item quando for um elemento
    // separador de texto.
    public function type_TEXT_SEPARATOR ( $menu_item_data, $element_attr )
    {
    // Este metodo recebe um array com os elementos do menu_item e retorna a string
    // com o codigo HTML.

        $menu_item = '';


    	return  $menu_item;

    }

    // Este metodo retorna o codigo HTML para o menu_item quando a imagem for um
    // elemento separador.
    public function type_IMG_SEPARATOR ( $menu_item_data, $element_attr )
    {
    // Este metodo recebe um array com os elementos do menu_item e retorna a string
    // com o codigo HTML.

        $menu_item = '';


    	return  $menu_item;

    }

}

?>

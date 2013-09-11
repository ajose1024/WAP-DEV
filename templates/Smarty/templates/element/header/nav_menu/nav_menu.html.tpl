{* -------------------------- *}
{* nav_menu template fragment *}
{* -------------------------- *}
{*                                                                            *}
{* Template Vars:                                                             *}
{* --------------                                                             *}
{* date               --> This variable holds the current date                *}
{*                                                                            *}
{* nav_menu_href_1    --> Item-1 link address                                 *}
{* nav_menu_target_1  --> Item-1 link target                                  *}
{* nav_menu_class_1   --> Item-1 link class                                   *}
{* nav_menu_data_1    --> Item-1 content                                      *}
{* nav_menu_href_2    --> Item-2 link address                                 *}
{* nav_menu_target_2  --> Item-2 link target                                  *}
{* nav_menu_class_2   --> Item-2 link class                                   *}
{* nav_menu_data_2    --> Item-2 content                                      *}
{* nav_menu_href_3    --> Item-3 link address                                 *}
{* nav_menu_target_3  --> Item-3 link target                                  *}
{* nav_menu_class_3   --> Item-3 link class                                   *}
{* nav_menu_data_3    --> Item-3 content                                      *}
{* nav_menu_href_4    --> Item-4 link address                                 *}
{* nav_menu_target_4  --> Item-4 link target                                  *}
{* nav_menu_class_4   --> Item-4 link class                                   *}
{* nav_menu_data_4    --> Item-4 content                                      *}
{* nav_menu_href_5    --> Item-5 link address                                 *}
{* nav_menu_target_5  --> Item-5 link target                                  *}
{* nav_menu_class_5   --> Item-5 link class                                   *}
{* nav_menu_data_5    --> Item-5 content                                      *}
{* nav_menu_href_6    --> Item-6 link address                                 *}
{* nav_menu_target_6  --> Item-6 link target                                  *}
{* nav_menu_class_6   --> Item-6 link class                                   *}
{* nav_menu_data_6    --> Item-6 content                                      *}
{* nav_menu_href_7    --> Item-7 link address                                 *}
{* nav_menu_target_7  --> Item-7 link target                                  *}
{* nav_menu_class_7   --> Item-7 link class                                   *}
{* nav_menu_data_7    --> Item-7 content                                      *}
{* nav_menu_href_8    --> Item-8 link address                                 *}
{* nav_menu_target_8  --> Item-8 link target                                  *}
{* nav_menu_class_8   --> Item-8 link class                                   *}
{* nav_menu_data_8    --> Item-8 content                                      *}
{* nav_menu_href_9    --> Item-9 link address                                 *}
{* nav_menu_target_9  --> Item-9 link target                                  *}
{* nav_menu_class_9   --> Item-9 link class                                   *}
{* nav_menu_data_9    --> Item-9 content                                      *}
{* nav_menu_href_10   --> Item-10 link address                                *}
{* nav_menu_target_10 --> Item-10 link target                                 *}
{* nav_menu_class_10  --> Item-10 link class                                  *}
{* nav_menu_data_10   --> Item-10 content                                     *}
{*                                                                            *}
<div id="nav_menu" >
    <ul id="nav_bar">
        {if $date}
            <li><em>{$date}</em></li>
        {/if}
        {if $nav_menu_href_1}
            <li><a href="{$nav_menu_href_1}" target="{$nav_menu_target_1}" class="{$nav_menu_class_1}"<!--current-->{$nav_menu_data_1}<!--A Metalstone--></a></li>
        {/if}
        {if $nav_menu_href_2}
            <li><a href="{$nav_menu_href_2}" target="{$nav_menu_target_2}" class="{$nav_menu_class_2}">{$nav_menu_data_2}<!--O que fazemos--></a></li>
        {/if}
        {if $nav_menu_href_3}
            <li><a href="{$nav_menu_href_3}" target="{$nav_menu_target_3}" class="{$nav_menu_class_3}">{$nav_menu_data_3}<!--Clientes--></a></li>
        {/if}
        {if $nav_menu_href_4}
            <li><a href="{$nav_menu_href_4}" target="{$nav_menu_target_4}" class="{$nav_menu_class_4}">{$nav_menu_data_4}<!--Portf&oacute;lio--></a></li>
        {/if}
        {if $nav_menu_href_5}
            <li><a href="{$nav_menu_href_5}" target="{$nav_menu_target_5}" class="{$nav_menu_class_5}">{$nav_menu_data_5}<!--Parceiros--></a></li>
        {/if}
        {if $nav_menu_href_6}
            <li><a href="{$nav_menu_href_6}" target="{$nav_menu_target_6}" class="{$nav_menu_class_6}">{$nav_menu_data_6}<!--Links--></a></li>
        {/if}
        {if $nav_menu_href_7}
            <li><a href="{$nav_menu_href_7}" target="{$nav_menu_target_7}" class="{$nav_menu_class_7}">{$nav_menu_data_7}<!--Onde estamos--></a></li>
        {/if}
        {if $nav_menu_href_8}
            <li><a href="{$nav_menu_href_8}" target="{$nav_menu_target_8}" class="{$nav_menu_class_8}">{$nav_menu_data_8}<!----></a></li>
        {/if}
        {if $nav_menu_href_9}
            <li><a href="{$nav_menu_href_9}" target="{$nav_menu_target_9}" class="{$nav_menu_class_9}">{$nav_menu_data_9}<!----></a></li>
        {/if}
        {if $nav_menu_href_10}
            <li><a href="{$nav_menu_href_10}" target="{$nav_menu_target_10}" class="{$nav_menu_class_10}">{$nav_menu_data_10}<!----></a></li>
        {/if}
    </ul>
</div>
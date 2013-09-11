{* ---------------------- *}
{* body template fragment *}
{* ---------------------- *}
{*                                                                            *}
{* Template Vars:                                                             *}
{* --------------                                                             *}
{* body_1_class     --> This variable holds the DIV element class             *}
{* body_1_style     --> This variable holds the DIV element style             *}
{*                                                                            *}
{* body_1_href_1    --> This variable holds the 1st link HREF address         *}
{* body_1_class_1   --> This variable holds the 1st link class                *}
{* body_1_style_1   --> This variable holds the 1st link style                *}
{* body_1_target_1  --> This variable holds the 1st link target               *}
{*                                                                            *}
{* body_1_img_src   --> This variable holds the image SRC address             *}
{* body_1_img_class --> This variable holds the image class                   *}
{* body_1_img_style --> This variable holds the image style                   *}
{*                                                                            *}
{* body_1_href_2    --> This variable holds the 2nd link HREF address         *}
{* body_1_class_2   --> This variable holds the 2nd link class                *}
{* body_1_style_2   --> This variable holds the 2nd link style                *}
{* body_1_target_2  --> This variable holds the 2nd link target               *}
{*                                                                            *}
{* body_1_text      --> This variable holds the 2nd link text                 *}
{*                                                                            *}
<div id="body_1_main" class="{$body_1_class}" style="{$body_1_style}">
    <a href="{$body_1_href_1}" class="{$body_1_class_1}" style="{$body_1_style_1}" target="{$body_1_target_1}">
        <img src="{$body_1_img_src}" class="{$body_1_img_class}" style="{$body_1_img_style}" />
    </a>
    <a href="{$body_1_href_2}" class="{$body_1_class_2}" style="{$body_1_style_2}" target="{$body_1_target_2}">{$body_1_text_1}</a>
</div>
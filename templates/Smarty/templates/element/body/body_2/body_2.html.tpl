{* ---------------------- *}
{* body template fragment *}
{* ---------------------- *}
{*                                                                            *}
{* Template Vars:                                                             *}
{* --------------                                                             *}
{* body_2_class     --> This variable holds the DIV element class             *}
{* body_2_style     --> This variable holds the DIV element style             *}
{*                                                                            *}
{* body_2_href_1    --> This variable holds the 1st link HREF address         *}
{* body_2_class_1   --> This variable holds the 1st link class                *}
{* body_2_style_1   --> This variable holds the 1st link style                *}
{* body_2_target_1  --> This variable holds the 1st link target               *}
{*                                                                            *}
{* body_2_img_src   --> This variable holds the image SRC address             *}
{* body_2_img_class --> This variable holds the image class                   *}
{* body_2_img_style --> This variable holds the image style                   *}
{*                                                                            *}
{* body_2_href_2    --> This variable holds the 2nd link HREF address         *}
{* body_2_class_2   --> This variable holds the 2nd link class                *}
{* body_2_style_2   --> This variable holds the 2nd link style                *}
{* body_2_target_2  --> This variable holds the 2nd link target               *}
{*                                                                            *}
{* body_2_text      --> This variable holds the 2nd link text                 *}
{*                                                                            *}
<div id="body_2_main" class="{$body_2_class}" style="{$body_2_style}">
    <a href="{$body_2_href_1}" class="{$body_2_class_1}" style="{$body_2_style_1}" target="{$body_2_target_1}">
        <img src="{$body_2_img_src}" class="{$body_2_img_class}" style="{$body_2_img_style}" />
    </a>
    <a href="{$body_2_href_2}" class="{$body_2_class_2}" style="{$body_2_style_2}" target="{$body_2_target_2}">{$body_2_text_1}</a>
</div>
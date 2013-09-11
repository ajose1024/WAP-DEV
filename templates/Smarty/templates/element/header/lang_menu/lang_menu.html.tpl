{* --------------------------- *}
{* lang_menu template fragment *}
{* --------------------------- *}
{*                                                                            *}
{* Template Vars:                                                             *}
{* --------------                                                             *}
{* lang_pt_pt_link      --> This variable holds the PT-pt lang link address   *}
{* lang_pt_pt_target    --> This variable holds the PT-pt lang link target    *}
{* lang_pt_pt_style     --> This variable holds the PT-pt lang link style     *}
{* lang_pt_pt_class     --> This variable holds the PT-pt lang link class     *}
{*                                                                            *}
{* lang_pt_pt_img_style --> This variable holds the PT-pt lang image style    *}
{* lang_pt_pt_img_class --> This variable holds the PT-pt lang image class    *}
{*                                                                            *}
{* lang_en_us_link      --> This variable holds the EN-us lang link address   *}
{* lang_en_us_target    --> This variable holds the EN-us lang link target    *}
{* lang_en_us_style     --> This variable holds the EN-us lang link style     *}
{* lang_en_us_class     --> This variable holds the EN-us lang link class     *}
{*                                                                            *}
{* lang_en_us_img_style --> This variable holds the EN-us lang image style    *}
{* lang_en_us_img_class --> This variable holds the EN-us lang image class    *}
{*                                                                            *}
{* lang_pt_br_link      --> This variable holds the PT-br lang link address   *}
{* lang_pt_br_target    --> This variable holds the PT-br lang link target    *}
{* lang_pt_br_style     --> This variable holds the PT-br lang link style     *}
{* lang_pt_br_class     --> This variable holds the PT-br lang link class     *}
{*                                                                            *}
{* lang_pt_br_img_style --> This variable holds the PT-br lang image style    *}
{* lang_pt_br_img_class --> This variable holds the PT-br lang image class    *}
{*                                                                            *}
<div id="lang_pt-pt" style="display: inline-block;">
    <a href="{$lang_pt_pt_link}"{if $lang_pt_pt_target} target="{$lang_pt_pt_target}"{/if}{if $lang_pt_pt_style} style="{$lang_pt_pt_style}"{/if}{if $lang_pt_pt_class} class="{$lang_pt_pt_class}"{/if}>
        <img src="/@pics/lang_flags/pt.png" id="Portugues"{if $lang_pt_pt_img_style} style="{$lang_pt_pt_img_style}"{/if}{if $lang_pt_pt_img_class} class="{$lang_pt_pt_img_class}"{/if} />
    </a>
</div>
<div id="lang_en-us" style="display: inline-block;">
    <a href="{$lang_en_us_link}"{if $lang_en_us_target} target="{$lang_en_us_target}"{/if}{if $lang_en_us_style} style="{$lang_en_us_style}"{/if}{if $lang_en_us_class} class="{$lang_en_us_class}"{/if}>
        <img src="/@pics/lang_flags/us.png" id="English"{if $lang_en_us_img_style} style="{$lang_en_us_img_style}"{/if}{if $lang_en_us_img_class} class="{$lang_en_us_img_class}"{/if} />
    </a>
</div>
<div id="lang_pt-br" style="display: inline-block;">
    <a href="{$lang_pt_br_link}"{if $lang_pt_br_target} target="{$lang_pt_br_target}"{/if}{if $lang_pt_br_style} style="{$lang_pt_br_style}"{/if}{if $lang_pt_br_class} class="{$lang_pt_br_class}"{/if}>
        <img src="/@pics/lang_flags/br.png" id="Brasileiro"{if $lang_pt_br_img_style} style="{$lang_pt_br_img_style}"{/if}{if $lang_pt_br_img_class} class="{$lang_pt_br_img_class}"{/if} />
    </a>
</div>

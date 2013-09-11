{* ------------------------ *}
{* header template fragment *}
{* ------------------------ *}
{*                                                                            *}
{* Template Vars:                                                             *}
{* -------------                                                              *}
{* $header_style     --> This variable holds the optional local element style *}
{* $header_class     --> This variable holds the optional local element class *}
{*                                                                            *}
{* $logo_style       --> This variable holds the optional local element style *}
{* $logo_class       --> This variable holds the optional local element class *}
{* $logo_data        --> This variable holds the logo inner_HTML              *}
{*                                                                            *}
{* $banner_style     --> This variable holds the optional local element style *}
{* $banner_class     --> This variable holds the optional local element class *}
{* $banner_data      --> This variable holds the logo inner_HTML              *}
{*                                                                            *}
{* $lang_menu_style  --> This variable holds the optional local element style *}
{* $lang_menu_class  --> This variable holds the optional local element class *}
{* $lang_menu_data   --> This variable holds the logo inner_HTML              *}
{*                                                                            *}
{* $soc_menu_style   --> This variable holds the optional local element style *}
{* $soc_menu_class   --> This variable holds the optional local element class *}
{* $soc_menu_data    --> This variable holds the social_menu inner_HTML       *}
{*                                                                            *}
{* $nav_menu_style   --> This variable holds the optional local element style *}
{* $nav_nemu_style   --> This variable holds the optional local element class *}
{* $nav_menu_data    --> This variable holds the nav_menu_data inner_HTML     *}
{*                                                                            *}
<div id="header" {if $header_style}style="{$header_style}" {/if}{if $header_class}class="{$header_class}{/if}">
    <div id="logo" {if $logo_style}style="{$logo_style}" {/if}{if $logo_class}class="{$logo_class}{/if}">
        {$logo_data}
    </div>
    <div id="banner" {if $banner_style}style="{$banner_style}" {/if}{if $banner_class}class="{$banner_class}"{/if}>
        {$banner_data}
    </div>
    <div id="lang_menu" {if $lang_menu_style}style="{$lang_menu_style}" {/if}{if $lang_menu_class}class="{$lang_menu_class}"{/if}>
        {$lang_menu_data}
    </div>
    <div id="social_menu" {if $soc_menu_style}style="{$soc_menu_style}" {/if}{if $soc_menu_class}class="{$soc_menu_class}"{/if}>
        {$social_menu_data}
    </div>
    <div id="nav_menu" {if $nav_menu_style}style="{$nav_menu_style}" {/if}{if $nav_menu_class}class="{$nav_menu_class}"{/if}>
        {$nav_menu_data}
    </div>
</div>
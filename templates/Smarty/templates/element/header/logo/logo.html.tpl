{* ---------------------- *}
{* logo template fragment *}
{* ---------------------- *}
{*                                                                            *}
{* Template Vars:                                                             *}
{* --------------                                                             *}
{* logo_link_href   --> This variable holds the logo link address             *}
{* logo_link_style  --> This variable holds the logo local style              *}
{* logo_link_class  --> This variable holds the logo local class              *}
{* logo_link_target --> This variable holds the target for the logo link      *}
{*                                                                            *}
{* logo_img_style   --> This variable holds the logo image local style        *}
{* logo_img_class   --> This variable holds the logo image local class        *}
{*                                                                            *}
<a id="logo" href="{$logo_link_href}"{if $logo_link_style} style="{$logo_link_style}"{/if}{if $logo_link_class} class="{$logo_link_class}"{/if}{if $logo_link_target} target="{$logo_link_target}"{/if}>
    <img src="/@pics/logos/Metalstone_Logo.svg"{if $logo_img_style} style="{$logo_img_style}"{/if}{if $logo_img_class} class="{$logo_img_class}"{/if} />
</a>
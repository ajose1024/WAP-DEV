{* ------------------------ *}
{* banner template fragment *}
{* ------------------------ *}
{*                                                                            *}
{* Template Vars:                                                             *}
{* --------------                                                             *}
{* banner_display   --> This variable decides wether the banner is visible    *}
{*                                                                            *}
{* banner_href      --> This variable holds the banner link address           *}
{* banner_target    --> This variable holds the target for the banner link    *}
{* banner_style     --> This variable holds the style for the banner link     *}
{* banner_class     --> This variable holds the class for the banner link     *}
{*                                                                            *}
{* banner_img_src   --> This variable holds the content for the banner image  *}
{* banner_img_style --> This variable holds the style for the banner image    *}
{* banner_img_class --> This variable holds the class for the banner image    *}
{*                                                                            *}
{if $banner_display}
    <a id="banner" href="{$banner_link_href}"{if $banner_link_target} target="{$banner_link_target}"{/if}{if $banner_link_style} style="{$banner_link_style}"{/if}{if $banner_link_class} class="{$banner_link_class}"{/if}>
        {if $banner_img_src}
            <img src="{$banner_img_src}"{if $banner_img_style} style="{$banner_img_style}"{/if}{if $banner_img_class} class="{$banner_img_class}"{/if} />
        {/if}
    </a>
{/if}
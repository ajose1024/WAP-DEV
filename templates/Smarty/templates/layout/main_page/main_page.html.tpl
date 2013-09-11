{* ------------------------- *}
{* main_page template layout *}
{* ------------------------- *}
{*                                                                            *}
{* Template Vars:                                                             *}
{* -------------                                                              *}
{* $page_title   --> This variable holds the CDATA text of the page title     *}
{* $meta_data    --> This variable holds the HTML fragment with the <meta>    *}
{*                   tags                                                     *}
{* $link_data    --> This variable holds the HTML fragment with the <link>    *}
{*                   tags                                                     *}
{* $style_data   --> This variable holds the HTML <style>...</style>          *}
{*                   containers or the <link ...> tags relating CSS           *}
{*                   information                                              *}
{* $scripts      --> This variable holds the <script>...</script> containers  *}
{*                                                                            *}
{* $header_data  --> This variable holds the HTML fragment corresponding to   *}
{*                   the page header section                                  *}
{* $display_data --> This variable holds the HTML fragment corresponding to   *}
{*                   the page main screen display area                        *}
{* $body_data    --> This variable holds the HTML fragment corresponding to   *}
{*                   the page main section                                    *}
{* $footer_data  --> This variable holds the HTML fragment corresponding to   *}
{*                   the page footer section                                  *}
{*                                                                            *}
<html>
    <head>
        <title>{$page_title}</title>
{if $meta_data}        {$meta_data}{/if}
{if $link_data}        {$link_data}{/if}
{if $style_data}        {$style_data}{/if}
{if $scripts}        {$scripts}{/if}
    </head>
    
    <body>
{if $header_data}        {$header_data}{/if}
{if $display_data}        {$display_data}{/if}
{if $body_data}        {$body_data}{/if}
{if $footer_data}        {$footer_data}{/if}
    </body>
</html>
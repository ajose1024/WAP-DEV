{* ------------------------- *}
{* main_page template layout *}
{* ------------------------- *}
{*                                                                            *}
{* Template Vars:                                                             *}
{* -------------                                                              *}
{* $page_title --> This variable holds the CDATA text of the page title       *}
{* $meta_data  --> This variable holds the HTML fragment with the <meta> tags *}
{* $link_data  --> This variable holds the HTML fragment with the <link> tags *}
{* $style_data --> This variable holds the HTML <style>...</style> containers *}
{*                 or the <link ...> tags relating CSS information            *}
{* $scripts    --> This variable holds the <script>...</script> containers    *}
{*                                                                            *}
{* $header     --> This variable holds the HTML fragment corresponding to the *}
{*                 page header section                                        *}
{* $body       --> This variable holds the HTML fragment corresponding to the *}
{*                 page main section                                          *}
{* $footer     --> This variable holds the HTML fragment corresponding to the *}
{*                 page footer section                                        *}
{*                                                                            *}
<html>
    <head>
        <title>{$page_title}</title>
        {$meta_data}
        {$link_data}
        {$style_data}
        {$scripts}
    </head>
    
    <body>
        {$header}
        {$body}
        {$footer}
    </body>
</html>
{* ------------------------- *}
{* display template fragment *}
{* ------------------------- *}
{*                                                                            *}
{* Template Vars:                                                             *}
{* --------------                                                             *}
{* display_style   --> This variable holds the local style                    *}
{* display_class   --> This variable holds the local style                    *}
{* display_content --> This variable holds innerHTML of the display element   *}
{*                                                                            *}
<div id="display" class="{$display_class}" style="{$display_style}">
    {$display_content}
</div>
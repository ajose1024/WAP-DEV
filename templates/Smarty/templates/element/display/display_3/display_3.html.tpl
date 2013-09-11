{* ------------------------- *}
{* display template fragment *}
{* ------------------------- *}
{*                                                                            *}
{* Template Vars:                                                             *}
{* --------------                                                             *}
{* display_whole_class   --> This variable holds the whole element class      *}
{* display_whole_style   --> This variable holds the whole element style      *}
{* display_whole_content --> This variable holds innerHTML of the whole       *}
{*                           display element                                  *}
{*                                                                            *}
<table width="100%">
    <tr>
        <td width="100%">
            <div id="display_all" class="{$display_whole_class}" style="{$display_whole_style}">
                {$display_whole_content}
            </div>
        </td>
    </tr>
</table>

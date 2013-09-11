{* ------------------------- *}
{* display template fragment *}
{* ------------------------- *}
{*                                                                            *}
{* Template Vars:                                                             *}
{* --------------                                                             *}
{* display_left_class    --> This variable holds the left element class       *}
{* display_left_style    --> This variable holds the left element style       *}
{* display_left_content  --> This variable holds innerHTML of the left        *}
{*                           display element                                  *}
{* display_right_class   --> This variable holds the right element style      *}
{* display_right_style   --> This variable holds the right element style      *}
{* display_right_content --> This variable holds innerHTML of the right       *}
{*                           display element                                  *}
{*                                                                            *}
<table width="100%">
    <tr>
        <td width="67%">
            <div id="display_left" class="{$display_left_class}" style="{$display_left_style}">
                {$display_left_content}
            </div>
        </td>
        <td width="33%">
            <div id="display_right" class="{$display_right_class}" style="{$display_right_style}">
                {$display_left_content}
            </div>
        </td>
    </tr>
</table>

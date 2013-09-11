{* ----------------------------- *}
{* social_menu template fragment *}
{* ----------------------------- *}
{*                                                                            *}
{* Template Vars:                                                             *}
{* --------------                                                             *}
{* soc_menu_display   --> This variable determines if the whole social menu   *}
{*                        is displayed or not                                 *}
{* soc_menu_style     --> This variable holds the local element style         *}
{* soc_menu_class     --> This variable holds the local element class         *}
{*                                                                            *}
{* linkedin_href      --> This variable holds the LinkedIn link               *}
{* linkedin_style     --> This variable holds the LinkedIn local style        *}
{* linkedin_class     --> This variable holds the LinkedIn local class        *}
{* linkedin_target    --> This variable holds the LinkedIn local target       *}
{* linkedin_img_style --> This variable holds the LinkedIn logo local style   *}
{* linkedin_img_class --> This variable holds the LinkedIn logo local class   *}
{*                                                                            *}
{* facebook_href      --> This variable holds the FaceBook link               *}
{* facebook_style     --> This variable holds the FaceBook local style        *}
{* facebook_class     --> This variable holds the FaceBook local class        *}
{* facebook_target    --> This variable holds the FaceBook local target       *}
{* facebook_img_style --> This variable holds the FaceBook logo local style   *}
{* facebook_img_class --> This variable holds the FaceBook logo local class   *}
{*                                                                            *}
{* twitter_href       --> This variable holds the Twitter link                *}
{* twitter_style      --> This variable holds the Twitter local style         *}
{* twitter_class      --> This variable holds the Twitter local class         *}
{* twitter_target     --> This variable holds the Twitter local target        *}
{* twitter_img_style  --> This variable holds the Twitter logo local style    *}
{* twitter_img_class  --> This variable holds the Twitter logo local class    *}
{*                                                                            *}
{* g_plus_href        --> This variable holds the Google+ link                *}
{* g_plus_style       --> This variable holds the Google+ local style         *}
{* g_plus_class       --> This variable holds the Googçe+ local class         *}
{* g_plus_target      --> This variable holds the Googçe+ local target        *}
{* g_plus_img_style   --> This variable holds the Google+ logo local style    *}
{* g_plus_img_class   --> This variable holds the Google+ logo local class    *}
{*                                                                            *}
{* youtube_href       --> This variable holds the YouTube link                *}
{* youtube_style      --> This variable holds the YouTube local style         *}
{* youtube_class      --> This variable holds the YouTube local class         *}
{* youtube_target     --> This variable holds the YouTube local target        *}
{* youtube_img_style  --> This variable holds the YouTube logo local style    *}
{* youtube_img_class  --> This variable holds the YouTube logo local class    *}
{*                                                                            *}
{if $soc_menu_display}
    <div id="social_menu"{if $soc_menu_style} style="{$soc_menu_style}"{/if}{if $soc_menu_class} class="{$soc_menu_class}"{/if}>
        {if $linkedin_href}
            <a id="linkedin" href="{$linkedin_href}"{if $linkedin_style} style="{$linkedin_style}"{/if}{if $linkedin_class} class="{$linkedin_class}"{/if}{if $linkedin_target} target="{$linkedin_target}"{/if}><img src="/@pics/social/LinkedIn_logo.png"{if $linkedin_img_style} style="{$linkedin_img_style}"{/if}{if $linkedin_img_class} class="{$linkedin_img_class}"{/if} /></a>
        {/if}
        {if $facebook_href}
            <a id="facebook" href="{$facebook_href}"{if $facebook_style} style="{$facebook_style}"{/if}{if $facebook_class} class="{$facebook_class}"{/if}{if $facebook_target} target="{$facebook_target}"{/if}><img src="/@pics/social/FaceBook_logo.png"{if $facebook_img_style} style="{$facebook_img_style}"{/if}{if $facebook_img_class} class="{$facebook_img_class}"{/if} /></a>
        {/if}
        {if $twitter_href}
            <a id="twitter" href="{$twitter_href}"{if $twitter_style} style="{$twitter_style}"{/if}{if $twitter_class} class="{$twitter_class}"{/if}{if $twitter_target} target="{$twitter_target}"{/if}><img src="/@pics/social/Twitter_logo.png"{if $twitter_img_style} style="{$twitter_img_style}"{/if}{if $twitter_img_class} class="{$twitter_img_class}"{/if} /></a>
        {/if}
        {if $g_plus_href}
            <a id="google_plus" href="{$g_plus_href}"{if $g_plus_style} style="{$g_plus_style}"{/if}{if $g_plus_class} class="{$g_plus_class}"{/if}{if $g_plus_target} target="{$g_plus_target}"{/if}><img src="/@pics/social/GooglePlus_logo.png"{if $g_plus_img_style} style="{$g_plus_img_style}"{/if}{if $g_plus_img_class} class="{$g_plus_img_class}"{/if} /></a>
        {/if}
        {if $youtube_href}
            <a id="youtube" href="{$youtube_href}"{if $youtube_style} style="{$youtube_style}"{/if}{if $youtube_class} class="{$youtube_class}"{/if}{if $youtube_target} target="{$youtube_target}"{/if}><img src="/@pics/social/YouTube_logo.png"{if $youtube_img_style} style="{$youtube_img_style}"{/if}{if $youtube_img_class} class="{$youtube_img_class}"{/if} /></a>
        {/if}
    </div>
{/if}
<!doctype html >
<!--[if IE 8]>
<html class="ie8" lang="en"> <![endif]-->
<!--[if IE 9]>
<html class="ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en-US" prefix="og: http://ogp.me/ns#"> <!--<![endif]-->
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/wp-content/uploads/2017/11/v_5_telif-300x300.png">

    <link rel='dns-prefetch' href='http://fonts.googleapis.com/'/>
    <link rel='dns-prefetch' href='http://s.w.org/'/>
    @yield('css')

    <?php
    if ($_SERVER["REMOTE_ADDR"] == "127.0.0.1") {
        $local = True;
    } else {
        $local = False;
    }
    ?>
    @if($local==false)
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109514763-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', 'UA-109514763-1');
        </script>
    @endif

    <script type="text/javascript">
        window._wpemojiSettings = {
            "baseUrl": "https:\/\/s.w.org\/images\/core\/emoji\/11.2.0\/72x72\/",
            "ext": ".png",
            "svgUrl": "https:\/\/s.w.org\/images\/core\/emoji\/11.2.0\/svg\/",
            "svgExt": ".svg",
        };
        !function (a, b, c) {
            function d(a, b) {
                var c = String.fromCharCode;
                l.clearRect(0, 0, k.width, k.height), l.fillText(c.apply(this, a), 0, 0);
                var d = k.toDataURL();
                l.clearRect(0, 0, k.width, k.height), l.fillText(c.apply(this, b), 0, 0);
                var e = k.toDataURL();
                return d === e
            }

            function e(a) {
                var b;
                if (!l || !l.fillText) return !1;
                switch (l.textBaseline = "top", l.font = "600 32px Arial", a) {
                    case"flag":
                        return !(b = d([55356, 56826, 55356, 56819], [55356, 56826, 8203, 55356, 56819])) && (b = d([55356, 57332, 56128, 56423, 56128, 56418, 56128, 56421, 56128, 56430, 56128, 56423, 56128, 56447], [55356, 57332, 8203, 56128, 56423, 8203, 56128, 56418, 8203, 56128, 56421, 8203, 56128, 56430, 8203, 56128, 56423, 8203, 56128, 56447]), !b);
                    case"emoji":
                        return b = d([55358, 56760, 9792, 65039], [55358, 56760, 8203, 9792, 65039]), !b
                }
                return !1
            }

            function f(a) {
                var c = b.createElement("script");
                c.src = a, c.defer = c.type = "text/javascript", b.getElementsByTagName("head")[0].appendChild(c)
            }

            var g, h, i, j, k = b.createElement("canvas"), l = k.getContext && k.getContext("2d");
            for (j = Array("flag", "emoji"), c.supports = {
                everything: !0,
                everythingExceptFlag: !0
            }, i = 0; i < j.length; i++) c.supports[j[i]] = e(j[i]), c.supports.everything = c.supports.everything && c.supports[j[i]], "flag" !== j[i] && (c.supports.everythingExceptFlag = c.supports.everythingExceptFlag && c.supports[j[i]]);
            c.supports.everythingExceptFlag = c.supports.everythingExceptFlag && !c.supports.flag, c.DOMReady = !1, c.readyCallback = function () {
                c.DOMReady = !0
            }, c.supports.everything || (h = function () {
                c.readyCallback()
            }, b.addEventListener ? (b.addEventListener("DOMContentLoaded", h, !1), a.addEventListener("load", h, !1)) : (a.attachEvent("onload", h), b.attachEvent("onreadystatechange", function () {
                "complete" === b.readyState && c.readyCallback()
            })), g = c.source || {}, g.concatemoji ? f(g.concatemoji) : g.wpemoji && g.twemoji && (f(g.twemoji), f(g.wpemoji)))
        }(window, document, window._wpemojiSettings);
    </script>
    <style type="text/css">
        img.wp-smiley,
        img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 .07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
    </style>
    <link rel='stylesheet' id='wp-block-library-css'
          href='/wp-includes/css/dist/block-library/style.min3c21.css?ver=5.1.1' type='text/css' media='all'/>
    <link rel='stylesheet' id='rs-plugin-settings-css'
          href='/wp-content/plugins/revslider/public/assets/css/settings035f.css?ver=5.4.6.2' type='text/css'
          media='all'/>
    <style id='rs-plugin-settings-inline-css' type='text/css'>
        #rs-demo-id {
        }
    </style>
    <link crossorigin="anonymous" rel='stylesheet' id='google-fonts-style-css'
          href='https://fonts.googleapis.com/css?family=Playfair+Display%3A400%7CLato%3A400%7COpen+Sans%3A300italic%2C400%2C400italic%2C600%2C600italic%2C700%7CRoboto%3A300%2C400%2C400italic%2C500%2C500italic%2C700%2C900&amp;ver=8.1.2'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='js_composer_front-css'
          href='/wp-content/plugins/js_composer/assets/css/js_composer.min7263.css?ver=5.4.4' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='td-theme-css' href='/wp-content/themes/Newspaper/style3752.css?ver=8.1.2' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='td-theme-demo-style-css'
          href='/wp-content/themes/Newspaper/includes/demos/fashion/demo_style3752.css?ver=8.1.2' type='text/css'
          media='all'/>
    <script type='text/javascript' src='/wp-includes/js/jquery/jqueryb8ff.js?ver=1.12.4'></script>
    <script type='text/javascript' src='/wp-includes/js/jquery/jquery-migrate.min330a.js?ver=1.4.1'></script>
    <script type='text/javascript'
            src='/wp-content/plugins/revslider/public/assets/js/jquery.themepunch.tools.min035f.js?ver=5.4.6.2'></script>
    <script type='text/javascript'
            src='/wp-content/plugins/revslider/public/assets/js/jquery.themepunch.revolution.min035f.js?ver=5.4.6.2'></script>
    <link rel='https://api.w.org/' href='/wp-json/'/>
    <link rel="EditURI" type="application/rsd+xml" title="RSD" href="xmlrpc0db0.php?rsd"/>
    <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="/wp-includes/wlwmanifest.xml"/>
    <meta name="generator" content="WordPress 5.1.1"/>
    <link rel='shortlink' href='index.html'/>
    <link rel="alternate" type="application/json+oembed"
          href="/wp-json/oembed/1.0/embedc378.json?url=https%3A%2F%2Fiseser.com%2F"/>
    <link rel="alternate" type="text/xml+oembed"
          href="/wp-json/oembed/1.0/embedab09?url=https%3A%2F%2Fiseser.com%2F&amp;format=xml"/>
    <style type="text/css">
        .qtranxs_flag_en {
            background-image: url(/wp-content/plugins/qtranslate-x/flags/gb.png);
            background-repeat: no-repeat;
        }
    </style>
    <link hreflang="en" href="en/" rel="alternate"/>
    <link hreflang="x-default" href="index.html" rel="alternate"/>
    <meta name="generator" content="qTranslate-X 3.4.6.8"/>
    <style id="tdw-css-placeholder"></style>
    <script>
        window.tdwGlobal = {
            "adminUrl": "https:\/\/iseser.com\/wp-admin\/",
            "wpRestNonce": "1d26b939a6",
            "wpRestUrl": "https:\/\/iseser.com\/wp-json\/",
            "permalinkStructure": "\/%postname%\/"
        };
    </script>
    <!--[if lt IE 9]>
    <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <meta name="generator" content="Powered by WPBakery Page Builder - drag and drop page builder for WordPress."/>
    <!--[if lte IE 9]>
    <link rel="stylesheet" type="text/css"
          href="https://iseser.com/wp-content/plugins/js_composer/assets/css/vc_lte_ie9.min.css" media="screen">
    <![endif]-->

    <script>


        var tdBlocksArray = []; //here we store all the items for the current page

        //td_block class - each ajax block uses a object of this class for requests
        function tdBlock() {
            this.id = '';
            this.block_type = 1; //block type id (1-234 etc)
            this.atts = '';
            this.td_column_number = '';
            this.td_current_page = 1; //
            this.post_count = 0; //from wp
            this.found_posts = 0; //from wp
            this.max_num_pages = 0; //from wp
            this.td_filter_value = ''; //current live filter value
            this.is_ajax_running = false;
            this.td_user_action = ''; // load more or infinite loader (used by the animation)
            this.header_color = '';
            this.ajax_pagination_infinite_stop = ''; //show load more at page x
        }


        // td_js_generator - mini detector
        (function () {
            var htmlTag = document.getElementsByTagName("html")[0];

            if (navigator.userAgent.indexOf("MSIE 10.0") > -1) {
                htmlTag.className += ' ie10';
            }

            if (!!navigator.userAgent.match(/Trident.*rv\:11\./)) {
                htmlTag.className += ' ie11';
            }

            if (/(iPad|iPhone|iPod)/g.test(navigator.userAgent)) {
                htmlTag.className += ' td-md-is-ios';
            }

            var user_agent = navigator.userAgent.toLowerCase();
            if (user_agent.indexOf("android") > -1) {
                htmlTag.className += ' td-md-is-android';
            }

            if (-1 !== navigator.userAgent.indexOf('Mac OS X')) {
                htmlTag.className += ' td-md-is-os-x';
            }

            if (/chrom(e|ium)/.test(navigator.userAgent.toLowerCase())) {
                htmlTag.className += ' td-md-is-chrome';
            }

            if (-1 !== navigator.userAgent.indexOf('Firefox')) {
                htmlTag.className += ' td-md-is-firefox';
            }

            if (-1 !== navigator.userAgent.indexOf('Safari') && -1 === navigator.userAgent.indexOf('Chrome')) {
                htmlTag.className += ' td-md-is-safari';
            }

            if (-1 !== navigator.userAgent.indexOf('IEMobile')) {
                htmlTag.className += ' td-md-is-iemobile';
            }

        })();


        var tdLocalCache = {};

        (function () {
            "use strict";

            tdLocalCache = {
                data: {},
                remove: function (resource_id) {
                    delete tdLocalCache.data[resource_id];
                },
                exist: function (resource_id) {
                    return tdLocalCache.data.hasOwnProperty(resource_id) && tdLocalCache.data[resource_id] !== null;
                },
                get: function (resource_id) {
                    return tdLocalCache.data[resource_id];
                },
                set: function (resource_id, cachedData) {
                    tdLocalCache.remove(resource_id);
                    tdLocalCache.data[resource_id] = cachedData;
                }
            };
        })();


        var td_viewport_interval_list = [{"limitBottom": 767, "sidebarWidth": 228}, {
            "limitBottom": 1018,
            "sidebarWidth": 300
        }, {"limitBottom": 1140, "sidebarWidth": 324}];
        var td_animation_stack_effect = "type0";
        var tds_animation_stack = true;
        var td_animation_stack_specific_selectors = ".entry-thumb, img";
        var td_animation_stack_general_selectors = ".td-animation-stack img, .td-animation-stack .entry-thumb, .post img";
        var td_ajax_url = "index.html\/\/iseser.com\/wp-admin\/admin-ajax.php?td_theme_name=Newspaper&v=8.1.2";
        var td_get_template_directory_uri = "index.html\/\/iseser.com\/wp-content\/themes\/Newspaper";
        var tds_snap_menu = "snap";
        var tds_logo_on_sticky = "";
        var tds_header_style = "10";
        var td_please_wait = "Please wait...";
        var td_email_user_pass_incorrect = "User or password incorrect!";
        var td_email_user_incorrect = "Email or username incorrect!";
        var td_email_incorrect = "Email incorrect!";
        var tds_more_articles_on_post_enable = "";
        var tds_more_articles_on_post_time_to_wait = "";
        var tds_more_articles_on_post_pages_distance_from_top = 0;
        var tds_theme_color_site_wide = "#207887";
        var tds_smart_sidebar = "enabled";
        var tdThemeName = "Newspaper";
        var td_magnific_popup_translation_tPrev = "Previous (Left arrow key)";
        var td_magnific_popup_translation_tNext = "Next (Right arrow key)";
        var td_magnific_popup_translation_tCounter = "%curr% of %total%";
        var td_magnific_popup_translation_ajax_tError = "The content from %url% could not be loaded.";
        var td_magnific_popup_translation_image_tError = "The image #%curr% could not be loaded.";
        var tdDateNamesI18n = {
            "month_names": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            "month_names_short": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            "day_names": ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            "day_names_short": ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"]
        };
        var td_ad_background_click_link = "";
        var td_ad_background_click_target = "";
    </script>


    <style>

        .td-header-wrap .black-menu .sf-menu > .current-menu-item > a,
        .td-header-wrap .black-menu .sf-menu > .current-menu-ancestor > a,
        .td-header-wrap .black-menu .sf-menu > .current-category-ancestor > a,
        .td-header-wrap .black-menu .sf-menu > li > a:hover,
        .td-header-wrap .black-menu .sf-menu > .sfHover > a,
        .td-header-style-12 .td-header-menu-wrap-full,
        .sf-menu > .current-menu-item > a:after,
        .sf-menu > .current-menu-ancestor > a:after,
        .sf-menu > .current-category-ancestor > a:after,
        .sf-menu > li:hover > a:after,
        .sf-menu > .sfHover > a:after,
        .td-header-style-12 .td-affix,
        .header-search-wrap .td-drop-down-search:after,
        .header-search-wrap .td-drop-down-search .btn:hover,
        input[type=submit]:hover,
        .td-read-more a,
        .td-post-category:hover,
        .td-grid-style-1.td-hover-1 .td-big-grid-post:hover .td-post-category,
        .td-grid-style-5.td-hover-1 .td-big-grid-post:hover .td-post-category,
        .td_top_authors .td-active .td-author-post-count,
        .td_top_authors .td-active .td-author-comments-count,
        .td_top_authors .td_mod_wrap:hover .td-author-post-count,
        .td_top_authors .td_mod_wrap:hover .td-author-comments-count,
        .td-404-sub-sub-title a:hover,
        .td-search-form-widget .wpb_button:hover,
        .td-rating-bar-wrap div,
        .td_category_template_3 .td-current-sub-category,
        .dropcap,
        .td_wrapper_video_playlist .td_video_controls_playlist_wrapper,
        .wpb_default,
        .wpb_default:hover,
        .td-left-smart-list:hover,
        .td-right-smart-list:hover,
        .woocommerce-checkout .woocommerce input.button:hover,
        .woocommerce-page .woocommerce a.button:hover,
        .woocommerce-account div.woocommerce .button:hover,
        #bbpress-forums button:hover,
        .bbp_widget_login .button:hover,
        .td-footer-wrapper .td-post-category,
        .td-footer-wrapper .widget_product_search input[type="submit"]:hover,
        .woocommerce .product a.button:hover,
        .woocommerce .product #respond input#submit:hover,
        .woocommerce .checkout input#place_order:hover,
        .woocommerce .woocommerce.widget .button:hover,
        .single-product .product .summary .cart .button:hover,
        .woocommerce-cart .woocommerce table.cart .button:hover,
        .woocommerce-cart .woocommerce .shipping-calculator-form .button:hover,
        .td-next-prev-wrap a:hover,
        .td-load-more-wrap a:hover,
        .td-post-small-box a:hover,
        .page-nav .current,
        .page-nav:first-child > div,
        .td_category_template_8 .td-category-header .td-category a.td-current-sub-category,
        .td_category_template_4 .td-category-siblings .td-category a:hover,
        #bbpress-forums .bbp-pagination .current,
        #bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a,
        .td-theme-slider:hover .slide-meta-cat a,
        a.vc_btn-black:hover,
        .td-trending-now-wrapper:hover .td-trending-now-title,
        .td-scroll-up,
        .td-smart-list-button:hover,
        .td-weather-information:before,
        .td-weather-week:before,
        .td_block_exchange .td-exchange-header:before,
        .td_block_big_grid_9.td-grid-style-1 .td-post-category,
        .td_block_big_grid_9.td-grid-style-5 .td-post-category,
        .td-grid-style-6.td-hover-1 .td-module-thumb:after,
        .td-pulldown-syle-2 .td-subcat-dropdown ul:after,
        .td_block_template_9 .td-block-title:after,
        .td_block_template_15 .td-block-title:before {
            background-color: #207887;
        }

        .global-block-template-4 .td-related-title .td-cur-simple-item:before {
            border-color: #207887 transparent transparent transparent !important;
        }

        .woocommerce .woocommerce-message .button:hover,
        .woocommerce .woocommerce-error .button:hover,
        .woocommerce .woocommerce-info .button:hover,
        .global-block-template-4 .td-related-title .td-cur-simple-item,
        .global-block-template-3 .td-related-title .td-cur-simple-item,
        .global-block-template-9 .td-related-title:after {
            background-color: #207887 !important;
        }

        .woocommerce .product .onsale,
        .woocommerce.widget .ui-slider .ui-slider-handle {
            background: none #207887;
        }

        .woocommerce.widget.widget_layered_nav_filters ul li a {
            background: none repeat scroll 0 0 #207887 !important;
        }

        a,
        cite a:hover,
        .td_mega_menu_sub_cats .cur-sub-cat,
        .td-mega-span h3 a:hover,
        .td_mod_mega_menu:hover .entry-title a,
        .header-search-wrap .result-msg a:hover,
        .top-header-menu li a:hover,
        .top-header-menu .current-menu-item > a,
        .top-header-menu .current-menu-ancestor > a,
        .top-header-menu .current-category-ancestor > a,
        .td-social-icon-wrap > a:hover,
        .td-header-sp-top-widget .td-social-icon-wrap a:hover,
        .td-page-content blockquote p,
        .td-post-content blockquote p,
        .mce-content-body blockquote p,
        .comment-content blockquote p,
        .wpb_text_column blockquote p,
        .td_block_text_with_title blockquote p,
        .td_module_wrap:hover .entry-title a,
        .td-subcat-filter .td-subcat-list a:hover,
        .td-subcat-filter .td-subcat-dropdown a:hover,
        .td_quote_on_blocks,
        .dropcap2,
        .dropcap3,
        .td_top_authors .td-active .td-authors-name a,
        .td_top_authors .td_mod_wrap:hover .td-authors-name a,
        .td-post-next-prev-content a:hover,
        .author-box-wrap .td-author-social a:hover,
        .td-author-name a:hover,
        .td-author-url a:hover,
        .td_mod_related_posts:hover h3 > a,
        .td-post-template-11 .td-related-title .td-related-left:hover,
        .td-post-template-11 .td-related-title .td-related-right:hover,
        .td-post-template-11 .td-related-title .td-cur-simple-item,
        .td-post-template-11 .td_block_related_posts .td-next-prev-wrap a:hover,
        .comment-reply-link:hover,
        .logged-in-as a:hover,
        #cancel-comment-reply-link:hover,
        .td-search-query,
        .td-category-header .td-pulldown-category-filter-link:hover,
        .td-category-siblings .td-subcat-dropdown a:hover,
        .td-category-siblings .td-subcat-dropdown a.td-current-sub-category,
        .widget a:hover,
        .td_wp_recentcomments a:hover,
        .archive .widget_archive .current,
        .archive .widget_archive .current a,
        .widget_calendar tfoot a:hover,
        .woocommerce a.added_to_cart:hover,
        .woocommerce-account .woocommerce-MyAccount-navigation a:hover,
        #bbpress-forums li.bbp-header .bbp-reply-content span a:hover,
        #bbpress-forums .bbp-forum-freshness a:hover,
        #bbpress-forums .bbp-topic-freshness a:hover,
        #bbpress-forums .bbp-forums-list li a:hover,
        #bbpress-forums .bbp-forum-title:hover,
        #bbpress-forums .bbp-topic-permalink:hover,
        #bbpress-forums .bbp-topic-started-by a:hover,
        #bbpress-forums .bbp-topic-started-in a:hover,
        #bbpress-forums .bbp-body .super-sticky li.bbp-topic-title .bbp-topic-permalink,
        #bbpress-forums .bbp-body .sticky li.bbp-topic-title .bbp-topic-permalink,
        .widget_display_replies .bbp-author-name,
        .widget_display_topics .bbp-author-name,
        .footer-text-wrap .footer-email-wrap a,
        .td-subfooter-menu li a:hover,
        .footer-social-wrap a:hover,
        a.vc_btn-black:hover,
        .td-smart-list-dropdown-wrap .td-smart-list-button:hover,
        .td_module_17 .td-read-more a:hover,
        .td_module_18 .td-read-more a:hover,
        .td_module_19 .td-post-author-name a:hover,
        .td-instagram-user a,
        .td-pulldown-syle-2 .td-subcat-dropdown:hover .td-subcat-more span,
        .td-pulldown-syle-2 .td-subcat-dropdown:hover .td-subcat-more i,
        .td-pulldown-syle-3 .td-subcat-dropdown:hover .td-subcat-more span,
        .td-pulldown-syle-3 .td-subcat-dropdown:hover .td-subcat-more i,
        .td-block-title-wrap .td-wrapper-pulldown-filter .td-pulldown-filter-display-option:hover,
        .td-block-title-wrap .td-wrapper-pulldown-filter .td-pulldown-filter-display-option:hover i,
        .td-block-title-wrap .td-wrapper-pulldown-filter .td-pulldown-filter-link:hover,
        .td-block-title-wrap .td-wrapper-pulldown-filter .td-pulldown-filter-item .td-cur-simple-item,
        .global-block-template-2 .td-related-title .td-cur-simple-item,
        .global-block-template-5 .td-related-title .td-cur-simple-item,
        .global-block-template-6 .td-related-title .td-cur-simple-item,
        .global-block-template-7 .td-related-title .td-cur-simple-item,
        .global-block-template-8 .td-related-title .td-cur-simple-item,
        .global-block-template-9 .td-related-title .td-cur-simple-item,
        .global-block-template-10 .td-related-title .td-cur-simple-item,
        .global-block-template-11 .td-related-title .td-cur-simple-item,
        .global-block-template-12 .td-related-title .td-cur-simple-item,
        .global-block-template-13 .td-related-title .td-cur-simple-item,
        .global-block-template-14 .td-related-title .td-cur-simple-item,
        .global-block-template-15 .td-related-title .td-cur-simple-item,
        .global-block-template-16 .td-related-title .td-cur-simple-item,
        .global-block-template-17 .td-related-title .td-cur-simple-item,
        .td-theme-wrap .sf-menu ul .td-menu-item > a:hover,
        .td-theme-wrap .sf-menu ul .sfHover > a,
        .td-theme-wrap .sf-menu ul .current-menu-ancestor > a,
        .td-theme-wrap .sf-menu ul .current-category-ancestor > a,
        .td-theme-wrap .sf-menu ul .current-menu-item > a,
        .td_outlined_btn {
            color: #207887;
        }

        a.vc_btn-black.vc_btn_square_outlined:hover,
        a.vc_btn-black.vc_btn_outlined:hover,
        .td-mega-menu-page .wpb_content_element ul li a:hover,
        .td-theme-wrap .td-aj-search-results .td_module_wrap:hover .entry-title a,
        .td-theme-wrap .header-search-wrap .result-msg a:hover {
            color: #207887 !important;
        }

        .td-next-prev-wrap a:hover,
        .td-load-more-wrap a:hover,
        .td-post-small-box a:hover,
        .page-nav .current,
        .page-nav:first-child > div,
        .td_category_template_8 .td-category-header .td-category a.td-current-sub-category,
        .td_category_template_4 .td-category-siblings .td-category a:hover,
        #bbpress-forums .bbp-pagination .current,
        .post .td_quote_box,
        .page .td_quote_box,
        a.vc_btn-black:hover,
        .td_block_template_5 .td-block-title > *,
        .td_outlined_btn {
            border-color: #207887;
        }

        .td_wrapper_video_playlist .td_video_currently_playing:after {
            border-color: #207887 !important;
        }

        .header-search-wrap .td-drop-down-search:before {
            border-color: transparent transparent #207887 transparent;
        }

        .block-title > span,
        .block-title > a,
        .block-title > label,
        .widgettitle,
        .widgettitle:after,
        .td-trending-now-title,
        .td-trending-now-wrapper:hover .td-trending-now-title,
        .wpb_tabs li.ui-tabs-active a,
        .wpb_tabs li:hover a,
        .vc_tta-container .vc_tta-color-grey.vc_tta-tabs-position-top.vc_tta-style-classic .vc_tta-tabs-container .vc_tta-tab.vc_active > a,
        .vc_tta-container .vc_tta-color-grey.vc_tta-tabs-position-top.vc_tta-style-classic .vc_tta-tabs-container .vc_tta-tab:hover > a,
        .td_block_template_1 .td-related-title .td-cur-simple-item,
        .woocommerce .product .products h2:not(.woocommerce-loop-product__title),
        .td-subcat-filter .td-subcat-dropdown:hover .td-subcat-more,
        .td_3D_btn,
        .td_shadow_btn,
        .td_default_btn,
        .td_round_btn,
        .td_outlined_btn:hover {
            background-color: #207887;
        }

        .woocommerce div.product .woocommerce-tabs ul.tabs li.active {
            background-color: #207887 !important;
        }

        .block-title,
        .td_block_template_1 .td-related-title,
        .wpb_tabs .wpb_tabs_nav,
        .vc_tta-container .vc_tta-color-grey.vc_tta-tabs-position-top.vc_tta-style-classic .vc_tta-tabs-container,
        .woocommerce div.product .woocommerce-tabs ul.tabs:before {
            border-color: #207887;
        }

        .td_block_wrap .td-subcat-item a.td-cur-simple-item {
            color: #207887;
        }


        .td-grid-style-4 .entry-title {
            background-color: rgba(28, 135, 51, 0.7);
        }


        .td-theme-wrap .block-title > span,
        .td-theme-wrap .block-title > span > a,
        .td-theme-wrap .widget_rss .block-title .rsswidget,
        .td-theme-wrap .block-title > a,
        .widgettitle,
        .widgettitle > a,
        .td-trending-now-title,
        .wpb_tabs li.ui-tabs-active a,
        .wpb_tabs li:hover a,
        .vc_tta-container .vc_tta-color-grey.vc_tta-tabs-position-top.vc_tta-style-classic .vc_tta-tabs-container .vc_tta-tab.vc_active > a,
        .vc_tta-container .vc_tta-color-grey.vc_tta-tabs-position-top.vc_tta-style-classic .vc_tta-tabs-container .vc_tta-tab:hover > a,
        .td-related-title .td-cur-simple-item,
        .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
        .woocommerce .product .products h2:not(.woocommerce-loop-product__title),
        .td-theme-wrap .td_block_template_2 .td-block-title > *,
        .td-theme-wrap .td_block_template_3 .td-block-title > *,
        .td-theme-wrap .td_block_template_4 .td-block-title > *,
        .td-theme-wrap .td_block_template_5 .td-block-title > *,
        .td-theme-wrap .td_block_template_6 .td-block-title > *,
        .td-theme-wrap .td_block_template_6 .td-block-title:before,
        .td-theme-wrap .td_block_template_7 .td-block-title > *,
        .td-theme-wrap .td_block_template_8 .td-block-title > *,
        .td-theme-wrap .td_block_template_9 .td-block-title > *,
        .td-theme-wrap .td_block_template_10 .td-block-title > *,
        .td-theme-wrap .td_block_template_11 .td-block-title > *,
        .td-theme-wrap .td_block_template_12 .td-block-title > *,
        .td-theme-wrap .td_block_template_13 .td-block-title > span,
        .td-theme-wrap .td_block_template_13 .td-block-title > a,
        .td-theme-wrap .td_block_template_14 .td-block-title > *,
        .td-theme-wrap .td_block_template_14 .td-block-title-wrap .td-wrapper-pulldown-filter .td-pulldown-filter-display-option,
        .td-theme-wrap .td_block_template_14 .td-block-title-wrap .td-wrapper-pulldown-filter .td-pulldown-filter-display-option i,
        .td-theme-wrap .td_block_template_14 .td-block-title-wrap .td-wrapper-pulldown-filter .td-pulldown-filter-display-option:hover,
        .td-theme-wrap .td_block_template_14 .td-block-title-wrap .td-wrapper-pulldown-filter .td-pulldown-filter-display-option:hover i,
        .td-theme-wrap .td_block_template_15 .td-block-title > *,
        .td-theme-wrap .td_block_template_15 .td-block-title-wrap .td-wrapper-pulldown-filter,
        .td-theme-wrap .td_block_template_15 .td-block-title-wrap .td-wrapper-pulldown-filter i,
        .td-theme-wrap .td_block_template_16 .td-block-title > *,
        .td-theme-wrap .td_block_template_17 .td-block-title > * {
            color: #ffffff;
        }


        .td-header-wrap .td-header-top-menu-full,
        .td-header-wrap .top-header-menu .sub-menu {
            background-color: #207887;
        }

        .td-header-style-8 .td-header-top-menu-full {
            background-color: transparent;
        }

        .td-header-style-8 .td-header-top-menu-full .td-header-top-menu {
            background-color: #207887;
            padding-left: 15px;
            padding-right: 15px;
        }

        .td-header-wrap .td-header-top-menu-full .td-header-top-menu,
        .td-header-wrap .td-header-top-menu-full {
            border-bottom: none;
        }


        .td-header-top-menu,
        .td-header-top-menu a,
        .td-header-wrap .td-header-top-menu-full .td-header-top-menu,
        .td-header-wrap .td-header-top-menu-full a,
        .td-header-style-8 .td-header-top-menu,
        .td-header-style-8 .td-header-top-menu a {
            color: #ffffff;
        }


        .top-header-menu .current-menu-item > a,
        .top-header-menu .current-menu-ancestor > a,
        .top-header-menu .current-category-ancestor > a,
        .top-header-menu li a:hover {
            color: #ffc6c6;
        }


        .td-header-wrap .td-header-sp-top-widget .td-icon-font {
            color: #ffffff;
        }


        .td-header-wrap .td-header-sp-top-widget i.td-icon-font:hover {
            color: #dbabab;
        }


        .td-menu-background:before,
        .td-search-background:before {
            background: rgba(0, 0, 0, 0.8);
            background: -moz-linear-gradient(top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.8) 100%);
            background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0.8)), color-stop(100%, rgba(0, 0, 0, 0.8)));
            background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.8) 100%);
            background: -o-linear-gradient(top, rgba(0, 0, 0, 0.8) 0%, @mobileu_gradient_two_mob 100%);
            background: -ms-linear-gradient(top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.8) 100%);
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.8) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='rgba(0,0,0,0.8)', endColorstr='rgba(0,0,0,0.8)', GradientType=0);
        }


        .td-mobile-content .current-menu-item > a,
        .td-mobile-content .current-menu-ancestor > a,
        .td-mobile-content .current-category-ancestor > a,
        #td-mobile-nav .td-menu-login-section a:hover,
        #td-mobile-nav .td-register-section a:hover,
        #td-mobile-nav .td-menu-socials-wrap a:hover i,
        .td-search-close a:hover i {
            color: #c44c4c;
        }


        #td-mobile-nav .td-register-section .td-login-button,
        .td-search-wrap-mob .result-msg a {
            background-color: #c44c4c;
        }


        #td-mobile-nav .td-register-section .td-login-button,
        .td-search-wrap-mob .result-msg a {
            color: #ffffff;
        }


        .mfp-content .td-login-button:active,
        .mfp-content .td-login-button:hover {
            background-color: #d67373;
        }

        .white-popup-block:after {
            background: rgba(0, 0, 0, 0.8);
            background: -moz-linear-gradient(45deg, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.8) 100%);
            background: -webkit-gradient(left bottom, right top, color-stop(0%, rgba(0, 0, 0, 0.8)), color-stop(100%, rgba(0, 0, 0, 0.8)));
            background: -webkit-linear-gradient(45deg, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.8) 100%);
            background: -o-linear-gradient(45deg, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.8) 100%);
            background: -ms-linear-gradient(45deg, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.8) 100%);
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.8) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='rgba(0,0,0,0.8)', endColorstr='rgba(0,0,0,0.8)', GradientType=0);
        }


        .td-footer-wrapper::before {
            background-position: center center;
        }


        ul.sf-menu > .td-menu-item > a {
            font-family: Lato;
            font-weight: normal;

        }

        .sf-menu ul .td-menu-item a {
            font-family: Lato;
            font-weight: normal;

        }

        .td_mod_mega_menu .item-details a {
            font-weight: normal;

        }

        .td_mega_menu_sub_cats .block-mega-child-cats a {
            font-family: Lato;
            font-weight: normal;

        }

        .td_module_1 .td-module-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td_module_2 .td-module-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td_module_3 .td-module-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td_module_4 .td-module-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td_module_5 .td-module-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td_module_7 .td-module-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td_module_8 .td-module-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td_module_9 .td-module-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td_module_10 .td-module-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td_module_11 .td-module-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td_module_12 .td-module-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td_module_13 .td-module-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td_module_14 .td-module-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td_module_15 .entry-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td_module_16 .td-module-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td_module_mx1 .td-module-title a {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td_module_mx3 .td-module-title a {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td_module_mx7 .td-module-title a {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td_module_mx8 .td-module-title a {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td_block_trending_now .entry-title a {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td-theme-slider.iosSlider-col-1 .td-module-title a {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td-theme-slider.iosSlider-col-2 .td-module-title a {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td-theme-slider.iosSlider-col-3 .td-module-title a {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td-big-grid-post.td-big-thumb .td-big-grid-meta,
        .td-big-thumb .td-big-grid-meta .entry-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td-big-grid-post.td-medium-thumb .td-big-grid-meta,
        .td-medium-thumb .td-big-grid-meta .entry-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td-big-grid-post.td-small-thumb .td-big-grid-meta,
        .td-small-thumb .td-big-grid-meta .entry-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td-big-grid-post.td-tiny-thumb .td-big-grid-meta,
        .td-tiny-thumb .td-big-grid-meta .entry-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .homepage-post .td-post-template-8 .td-post-header .entry-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }


        .td-post-template-default .td-post-header .entry-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td-post-template-1 .td-post-header .entry-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td-post-template-2 .td-post-header .entry-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td-post-template-3 .td-post-header .entry-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td-post-template-4 .td-post-header .entry-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td-post-template-5 .td-post-header .entry-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td-post-template-6 .td-post-header .entry-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td-post-template-7 .td-post-header .entry-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td-post-template-8 .td-post-header .entry-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td-post-template-9 .td-post-header .entry-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td-post-template-10 .td-post-header .entry-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .td-post-template-11 .td-post-header .entry-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        .post blockquote p,
        .page blockquote p,
        .td-post-text-content blockquote p {
            font-family: "Playfair Display";

        }

        .post .td_quote_box p,
        .page .td_quote_box p {
            font-family: "Playfair Display";
            font-size: 16px;
            line-height: 24px;
            font-weight: bold;

        }

        .post .td_pull_quote p,
        .page .td_pull_quote p {
            font-family: "Playfair Display";

        }

        .td-post-content h1 {
            font-family: "Playfair Display";

        }

        .td-post-content h2 {
            font-family: "Playfair Display";

        }

        .td-page-title,
        .woocommerce-page .page-title,
        .td-category-title-holder .td-page-title {
            font-family: "Playfair Display";
            font-weight: bold;

        }

        #td-outer-wrap span.dropcap {
            font-family: "Playfair Display";

        }
        .td-main-content-wrap {
            min-height: 50vh;
        }
    </style>
    <script type="text/javascript">function setREVStartSize(e) {
            try {
                var i = jQuery(window).width(), t = 9999, r = 0, n = 0, l = 0, f = 0, s = 0, h = 0;
                if (e.responsiveLevels && (jQuery.each(e.responsiveLevels, function (e, f) {
                    f > i && (t = r = f, l = e), i > f && f > r && (r = f, n = e)
                }), t > r && (l = n)), f = e.gridheight[l] || e.gridheight[0] || e.gridheight, s = e.gridwidth[l] || e.gridwidth[0] || e.gridwidth, h = i / s, h = h > 1 ? 1 : h, f = Math.round(h * f), "fullscreen" == e.sliderLayout) {
                    var u = (e.c.width(), jQuery(window).height());
                    if (void 0 != e.fullScreenOffsetContainer) {
                        var c = e.fullScreenOffsetContainer.split(",");
                        if (c) jQuery.each(c, function (e, i) {
                            u = jQuery(i).length > 0 ? u - jQuery(i).outerHeight(!0) : u
                        }), e.fullScreenOffset.split("%").length > 1 && void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 ? u -= jQuery(window).height() * parseInt(e.fullScreenOffset, 0) / 100 : void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 && (u -= parseInt(e.fullScreenOffset, 0))
                    }
                    f = u
                } else void 0 != e.minHeight && f < e.minHeight && (f = e.minHeight);
                e.c.closest(".rev_slider_wrapper").css({height: f})
            } catch (d) {
                console.log("Failure at Presize of Slider:" + d)
            }
        };</script>
    <noscript>
        <style type="text/css"> .wpb_animate_when_almost_visible {
                opacity: 1;
            }</style>
    </noscript>


</head>
<body class="page-template-default global-block-template-1 td-fashion wpb-js-composer js-comp-ver-5.4.4 vc_responsive td-animation-stack-type0 td-full-layout"
      itemscope="itemscope" itemtype="https://schema.org/WebPage">

<div class="td-scroll-up"><i class="td-icon-menu-up"></i></div>
<div class="td-menu-background"></div>
<div id="td-mobile-nav">
    <div class="td-mobile-container">

        <div class="td-menu-socials-wrap">

            <div class="td-menu-socials">
<span class="td-social-icon-wrap">
<a target="_blank" href="https://www.facebook.com/isesercom/" title="Facebook">
<i class="td-icon-font td-icon-facebook"></i>
</a>
</span>
            </div>

            <div class="td-mobile-close">
                <a href="#"><i class="td-icon-close-mobile"></i></a>
            </div>
        </div>


        <div class="td-mobile-content">
            <div class="menu-td-demo-header-menu-container">
                <ul id="menu-td-demo-header-menu" class="td-mobile-main-menu">
                    <li id="menu-item-279"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-278 current_page_item menu-item-first menu-item-279">
                        <a href="/">HOME</a></li>
                    <li id="menu-item-398"
                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-398">
                        <a href="#">COMMITEES<i class="td-icon-menu-right td-element-after"></i></a>
                        <ul class="sub-menu">
                            <li id="menu-item-773"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-773"><a
                                        href="/honorary-committee/">HONORARY COMMITTEE</a></li>
                            <li id="menu-item-377"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-377"><a
                                        href="/organization-committee/">ORGANIZATION COMMITTEE</a></li>
                            <li id="menu-item-380"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-380"><a
                                        href="/science-commission/">SCIENTIFIC BOARD</a></li>
                            <li id="menu-item-704"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-704"><a
                                        href="/adviser-commission/">ADVISORY BOARD</a></li>
                        </ul>
                    </li>
                    <li id="menu-item-423"
                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-423">
                        <a href="#">GENERAL INFORMATION<i class="td-icon-menu-right td-element-after"></i></a>
                        <ul class="sub-menu">
                            <li id="menu-item-428"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-428"><a
                                        href="/invitation/">INVITATION</a></li>
                            <li id="menu-item-435"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-435"><a
                                        href="/threads/">TOPICS</a></li>
                            <li id="menu-item-438"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-438"><a
                                        href="/important-dates/">IMPORTANT DATES</a></li>
                            <li id="menu-item-371"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-371"><a
                                        href="/documents/">DOCUMENTS</a></li>
                            <li id="menu-item-898"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-898"><a
                                        href="/user/">USER AREA</a></li>
                        </ul>
                    </li>
                    <li id="menu-item-374"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-374"><a
                                href="/conference-fee/">CONFERENCE FEE</a></li>
                    <li id="menu-item-366"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-366"><a
                                href="/sponsors/">SPONSORS</a></li>
                    <li id="menu-item-368"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-368"><a
                                href="/contact/">CONTACT</a></li>

                    <li id="menu-item-368"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-368"><a
                                href="/user/">USER ACTIONS</a></li>

                </ul>
            </div>
        </div>
    </div>

</div>
<div id="td-outer-wrap" class="td-theme-wrap">
    <div class="td-header-wrap td-header-style-10">
        <div class="td-header-top-menu-full td-container-wrap ">
            <div class="td-container td-header-row td-header-top-menu">
                <div class="top-bar-style-1">
                    <div class="td-header-sp-top-menu">
                        <div class="td-weather-top-widget" id="td_top_weather_uid">

                            <div class="td-weather-header">
                                <div class="td-weather-city">Manisa, TR</div>
                            </div>
                        </div>
                        <div class="td_data_time">
                            <div>

                                <?php
                                echo date("D, M d, Y")
                                ?>
                            </div>
                        </div>
                        <div class="menu-top-container">
                            <ul id="menu-td-demo-top-menu" class="top-header-menu">
                                <li id="menu-item-468"
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-first td-menu-item td-normal-menu menu-item-468">
                                    <a href="#">OLD SYMPOSIUM</a>
                                    <ul class="sub-menu">
                                        <li id="menu-item-832"
                                            class="menu-item menu-item-type-post_type menu-item-object-page td-menu-item td-normal-menu menu-item-832">
                                            <a href="/documents/2019/">2019</a></li>
                                        <li id="menu-item-832"
                                            class="menu-item menu-item-type-post_type menu-item-object-page td-menu-item td-normal-menu menu-item-832">
                                            <a href="/documents/2018/">2018</a></li>
                                        <li id="menu-item-496"
                                            class="menu-item menu-item-type-post_type menu-item-object-page td-menu-item td-normal-menu menu-item-496">
                                            <a href="/documents/2017/">2017</a></li>
                                        <li id="menu-item-497"
                                            class="menu-item menu-item-type-post_type menu-item-object-page td-menu-item td-normal-menu menu-item-497">
                                            <a href="/documents/2016/">2016</a></li>
                                    </ul>
                                </li>
                                <li id="menu-item-900"
                                    class="menu-item menu-item-type-custom menu-item-object-custom td-menu-item td-normal-menu menu-item-900">
                                    <a href="/user/">USER AREA</a></li>
                                <li id="menu-item-442"
                                    class="menu-item menu-item-type-post_type menu-item-object-page td-menu-item td-normal-menu menu-item-442">
                                    <a href="/contact/">CONTACT</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="td-header-sp-top-widget">
<span class="td-social-icon-wrap">
<a target="_blank" href="https://www.facebook.com/isesercom/" title="Facebook">
<i class="td-icon-font td-icon-facebook"></i>
</a>
</span>
                    </div>
                </div>

            </div>
        </div>
        <div class="td-banner-wrap-full td-logo-wrap-full td-logo-mobile-loaded td-container-wrap ">
            <div class="td-header-sp-logo">
                <h1 class="td-logo"><a class="td-main-logo" href="/">
                        <img src="/wp-content/uploads/2017/11/v6_telifsiz-300x72.png" alt=""/>
                        <span class="td-visual-hidden">ISESER</span>
                    </a>
                </h1></div>
        </div>
        <div class="td-header-menu-wrap-full td-container-wrap ">
            <div class="td-header-menu-wrap td-header-gradient">
                <div class="td-container td-header-row td-header-main-menu">
                    <div id="td-header-menu" role="navigation">
                        <div id="td-top-mobile-toggle"><a href="#"><i class="td-icon-font td-icon-mobile"></i></a>
                        </div>
                        <div class="td-main-menu-logo td-logo-in-header">
                            <a class="td-mobile-logo td-sticky-disable" href="/">
                                <img src="/wp-content/uploads/2017/11/v6_telifsiz-300x72.png" alt=""/>
                            </a>
                            <a class="td-header-logo td-sticky-disable" href="/">
                                <img src="/wp-content/uploads/2017/11/v6_telifsiz-300x72.png" alt=""/>
                            </a>
                        </div>
                        <div class="menu-td-demo-header-menu-container">
                            <ul id="menu-td-demo-header-menu-1" class="sf-menu">
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-278 current_page_item menu-item-first td-menu-item td-normal-menu menu-item-279">
                                    <a href="/">HOME</a></li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children td-menu-item td-normal-menu menu-item-398">
                                    <a href="#">COMMITEES</a>
                                    <ul class="sub-menu">
                                        <li class="menu-item menu-item-type-post_type menu-item-object-page td-menu-item td-normal-menu menu-item-773">
                                            <a href="/honorary-committee/">HONORARY COMMITTEE</a></li>
                                        <li class="menu-item menu-item-type-post_type menu-item-object-page td-menu-item td-normal-menu menu-item-377">
                                            <a href="/organization-committee/">ORGANIZATION COMMITTEE</a>
                                        </li>
                                        <li class="menu-item menu-item-type-post_type menu-item-object-page td-menu-item td-normal-menu menu-item-380">
                                            <a href="/science-commission/">SCIENTIFIC BOARD</a></li>
                                        <li class="menu-item menu-item-type-post_type menu-item-object-page td-menu-item td-normal-menu menu-item-704">
                                            <a href="/adviser-commission/">ADVISORY BOARD</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children td-menu-item td-normal-menu menu-item-423">
                                    <a href="#">GENERAL INFORMATION</a>
                                    <ul class="sub-menu">
                                        <li class="menu-item menu-item-type-post_type menu-item-object-page td-menu-item td-normal-menu menu-item-428">
                                            <a href="/invitation/">INVITATION</a></li>
                                        <li class="menu-item menu-item-type-post_type menu-item-object-page td-menu-item td-normal-menu menu-item-435">
                                            <a href="/threads/">TOPICS</a></li>
                                        <li class="menu-item menu-item-type-post_type menu-item-object-page td-menu-item td-normal-menu menu-item-438">
                                            <a href="/important-dates/">IMPORTANT DATES</a></li>
                                        <li class="menu-item menu-item-type-post_type menu-item-object-page td-menu-item td-normal-menu menu-item-371">
                                            <a href="/documents/">DOCUMENTS</a></li>
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom td-menu-item td-normal-menu menu-item-898">
                                            <a href="/user/">USER AREA</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page td-menu-item td-normal-menu menu-item-374">
                                    <a href="/conference-fee/">CONFERENCE FEE</a></li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page td-menu-item td-normal-menu menu-item-366">
                                    <a href="/sponsors/">SPONSORS</a></li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page td-menu-item td-normal-menu menu-item-368">
                                    <a href="/contact/">CONTACT</a></li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page td-menu-item td-normal-menu menu-item-368">
                                    <a href="/user/">USER AREA</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="header-search-wrap">
                        <div class="dropdown header-search">
                            <div class="td-drop-down-search" aria-labelledby="td-header-search-button">
                                <form method="get" class="td-search-form" action="https://iseser.com/">
                                    <div role="search" class="td-head-form-search-wrap">
                                        <input id="td-header-search" type="text" value="" name="s"
                                               autocomplete="off"/><input class="wpb_button wpb_btn-inverse btn"
                                                                          type="submit" id="td-header-search-top"
                                                                          value="Search"/>
                                    </div>
                                </form>
                                <div id="td-aj-search"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="td-banner-wrap-full td-banner-bg td-container-wrap ">
            <div class="td-container-header td-header-row td-header-header">
                <div class="td-header-sp-recs">
                    <div class="td-header-rec-wrap">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('content')


    <div class="td-footer-wrapper td-container-wrap ">

        <div class="td-container">
            <div class="td-pb-row">
                <div class="td-pb-span3">
                    <aside><a href="/"><img class="td-retina-data"
                                            src="/wp-content/uploads/2017/11/v_5_telif-300x300.png"
                                            data-retina="https://iseser.com/wp-content/uploads/2017/11/v_5_telif-300x300.png"
                                            alt="iseser" title="iseser"
                                            width=""/></a>
                    </aside>
                </div>
                <div class="td-pb-span9">
                    <aside class="footer-text-wrap">
                        <div class="block-title"><span>ABOUT US</span></div>
                        International Symposium for Environmental Science and Engineering Research (ISESER2020)
                        <br>
                        ISESER2020 which will be held on 29-31 May 2020 in, Manisa.
                        <div class="footer-email-wrap">Contact us: <a
                                    href="tel:iseser@iseser.com"><span>iseser@iseser.com</span></a><br>
                            <a href="tel:+903322238630">Şükrü Dursun (office)</a>: +903322238630

                        </div>
                    </aside>
                </div>

            </div>
        </div>
    </div>

    <div class="td-sub-footer-container td-container-wrap ">
        <div class="td-container">
            <div class="td-pb-row">
                <div class="td-pb-span td-sub-footer-menu">
                    <div class="menu-td-demo-footer-menu-container">
                        <ul id="menu-td-demo-footer-menu" class="td-subfooter-menu">
                            <li id="menu-item-444"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-278 current_page_item menu-item-first td-menu-item td-normal-menu menu-item-444">
                                <a href="/" aria-current="page">HOME</a></li>
                            <li id="menu-item-445"
                                class="menu-item menu-item-type-post_type menu-item-object-page td-menu-item td-normal-menu menu-item-445">
                                <a href="/sponsors/">SPONSORS</a></li>
                            <li id="menu-item-901"
                                class="menu-item menu-item-type-custom menu-item-object-custom td-menu-item td-normal-menu menu-item-901">
                                <a href="/user/">USER AREA</a></li>
                            <li id="menu-item-443"
                                class="menu-item menu-item-type-post_type menu-item-object-page td-menu-item td-normal-menu menu-item-443">
                                <a href="/contact/">CONTACT</a></li>
                        </ul>
                    </div>
                </div>
                <div class="td-pb-span td-sub-footer-copy">
                    &copy; Made with ❤ <a target="_blank" href="https://sub.fyi/">Sub.fyi</a>.
                </div>
            </div>
        </div>
    </div>


    @yield('contentend')

    @yield('js')


</div>

<script type='text/javascript' src='../wp-content/themes/Newspaper/js/tagdiv_theme.min3752.js?ver=8.1.2'></script>
<script type='text/javascript' src='../wp-includes/js/comment-reply.min3c21.js?ver=5.1.1'></script>
<script type='text/javascript' src='../wp-includes/js/wp-embed.min3c21.js?ver=5.1.1'></script>

<script>


    jQuery().ready(function () {
        tdWeather.addItem({
            "block_uid": "td_top_weather_uid",
            "location": "Manisa, TR",
            "api_location": "Manisa",
            "api_language": "en",
            "api_key": "eb777ef82a0399808e9a46f285f2b289",
            "today_icon": "clear-sky-n",
            "today_icon_text": "clear sky",
            "today_temp": [12.0999999999999996447286321199499070644378662109375, 53.89999999999999857891452847979962825775146484375],
            "today_humidity": 46,
            "today_wind_speed": [3.600000000000000088817841970012523233890533447265625, 2.20000000000000017763568394002504646778106689453125],
            "today_min": [12, 53.60000000000000142108547152020037174224853515625],
            "today_max": [12.199999999999999289457264239899814128875732421875, 54],
            "today_clouds": 0,
            "current_unit": 0,
            "forecast": [{
                "timestamp": 1553029200,
                "day_name": "Tue",
                "day_temp": [3, 37],
                "owm_day_index": 0
            }, {
                "timestamp": 1553040000,
                "day_name": "Wed",
                "day_temp": [15, 58],
                "owm_day_index": 1
            }, {
                "timestamp": 1553126400,
                "day_name": "Thu",
                "day_temp": [15, 58],
                "owm_day_index": 9
            }, {
                "timestamp": 1553212800,
                "day_name": "Fri",
                "day_temp": [12, 54],
                "owm_day_index": 17
            }, {
                "timestamp": 1553299200,
                "day_name": "Sat",
                "day_temp": [13, 56],
                "owm_day_index": 25
            }, {"timestamp": 1553385600, "day_name": "Sun", "day_temp": [-1, 31], "owm_day_index": 33}]
        });
    });


    (function () {
        var html_jquery_obj = jQuery('html');

        if (html_jquery_obj.length && (html_jquery_obj.is('.ie8') || html_jquery_obj.is('.ie9'))) {

            var path = '../wp-content/themes/Newspaper/style.css';

            jQuery.get(path, function (data) {

                var str_split_separator = '#td_css_split_separator';
                var arr_splits = data.split(str_split_separator);
                var arr_length = arr_splits.length;

                if (arr_length > 1) {

                    var dir_path = '../wp-content/themes/Newspaper/';
                    var splited_css = '';

                    for (var i = 0; i < arr_length; i++) {
                        if (i > 0) {
                            arr_splits[i] = str_split_separator + ' ' + arr_splits[i];
                        }
                        //jQuery('head').append('<style>' + arr_splits[i] + '</style>');

                        var formated_str = arr_splits[i].replace(/\surl\(\'(?!data\:)/gi, function regex_function(str) {
                            return ' url(\'' + dir_path + '/' + str.replace(/url\(\'/gi, '').replace(/^\s+|\s+$/gm, '');
                        });

                        splited_css += "<style>" + formated_str + "</style>";
                    }

                    var td_theme_css = jQuery('link#td-theme-css');

                    if (td_theme_css.length) {
                        td_theme_css.after(splited_css);
                    }
                }
            });
        }
    })();


</script>
<div id="tdw-css-writer" style="display: none" class="tdw-drag-dialog tdc-window-sidebar">
    <header>
        <a title="Editor" class="tdw-tab tdc-tab-active" href="#" data-tab-content="tdw-tab-editor">Edit with Live
            CSS</a>
        <div class="tdw-less-info" title="This will be red when errors are detected in your CSS and LESS"></div>
    </header>
    <div class="tdw-content">
        <div class="tdw-tabs-content tdw-tab-editor tdc-tab-content-active">
            <script>

                (function (jQuery, undefined) {

                    jQuery(window).ready(function () {

                        if ('undefined' !== typeof tdcAdminIFrameUI) {
                            var $liveIframe = tdcAdminIFrameUI.getLiveIframe();

                            if ($liveIframe.length) {
                                $liveIframe.load(function () {
                                    $liveIframe.contents().find('body').append('<textarea class="tdw-css-writer-editor" style="display: none"></textarea>');
                                });
                            }
                        }

                    });

                })(jQuery);

            </script>
            <textarea class="tdw-css-writer-editor td_live_css_uid_1_5c91423940fec"></textarea>
            <div id="td_live_css_uid_1_5c91423940fec" class="td-code-editor"></div>
            <script>
                jQuery(window).load(function () {

                    if ('undefined' !== typeof tdLiveCssInject) {

                        tdLiveCssInject.init();


                        var editor_textarea = jQuery('.td_live_css_uid_1_5c91423940fec');
                        var languageTools = ace.require("ace/ext/language_tools");
                        var tdcCompleter = {
                            getCompletions: function (editor, session, pos, prefix, callback) {
                                if (prefix.length === 0) {
                                    callback(null, []);
                                    return
                                }

                                if ('undefined' !== typeof tdcAdminIFrameUI) {

                                    var data = {
                                        error: undefined,
                                        getShortcode: ''
                                    };

                                    tdcIFrameData.getShortcodeFromData(data);

                                    if (!_.isUndefined(data.error)) {
                                        tdcDebug.log(data.error);
                                    }

                                    if (!_.isUndefined(data.getShortcode)) {

                                        var regex = /el_class=\"([A-Za-z0-9_-]*\s*)+\"/g,
                                            results = data.getShortcode.match(regex);

                                        var elClasses = {};

                                        for (var i = 0; i < results.length; i++) {
                                            var currentClasses = results[i]
                                                .replace('el_class="', '')
                                                .replace('"', '')
                                                .split(' ');

                                            for (var j = 0; j < currentClasses.length; j++) {
                                                if (_.isUndefined(elClasses[currentClasses[j]])) {
                                                    elClasses[currentClasses[j]] = '';
                                                }
                                            }
                                        }

                                        var arrElClasses = [];

                                        for (var prop in elClasses) {
                                            arrElClasses.push(prop);
                                        }

                                        callback(null, arrElClasses.map(function (item) {
                                            return {
                                                name: item,
                                                value: item,
                                                meta: 'in_page'
                                            }
                                        }));
                                    }
                                }
                            }
                        };
                        languageTools.addCompleter(tdcCompleter);

                        window.editor = ace.edit("td_live_css_uid_1_5c91423940fec");

                        // 'change' handler is written as function because it's called by tdc_on_add_css_live_components (of wp_footer hook)
                        // We did it to reattach the existing compiled css to the new content received from server.
                        window.editorChangeHandler = function () {
                            //tdwState.lessWasEdited = true;

                            window.onbeforeunload = function () {
                                if (tdwState.lessWasEdited) {
                                    return "You have attempted to leave this page. Are you sure?";
                                }
                                return false;
                            };

                            var editorValue = editor.getSession().getValue();

                            editor_textarea.val(editorValue);

                            if ('undefined' !== typeof tdcAdminIFrameUI) {
                                tdcAdminIFrameUI.getLiveIframe().contents().find('.tdw-css-writer-editor:first').val(editorValue);

                                // Mark the content as modified
                                // This is important for showing info when composer closes
                                tdcMain.setContentModified();
                            }

                            tdLiveCssInject.less();
                        };

                        editor.getSession().setValue(editor_textarea.val());
                        editor.getSession().on('change', editorChangeHandler);

                        editor.setTheme("ace/theme/textmate");
                        editor.setShowPrintMargin(false);
                        editor.getSession().setMode("ace/mode/less");
                        editor.setOptions({
                            enableBasicAutocompletion: true,
                            enableSnippets: true,
                            enableLiveAutocompletion: false
                        });

                    }

                });
            </script>
        </div>
    </div>
</div>


<script type="application/ld+json" data-type="WebSite">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "iseser.com",
        "url": "https://iseser.com/",
        "image": "https://iseser.com/wp-content/uploads/2017/11/v6_telifsiz-300x72.png",
        "sameAs": [
            "https://www.facebook.com/isesercom/",
            "https://iseser.com/",
        ]
    }

</script>
<script type="application/ld+json" data-type="Organization">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "url": "https://iseser.com/",
        "logo":  "https://iseser.com/wp-content/uploads/2017/11/v6_telifsiz-300x72.png",
        "name": "iseser.com",
        "contactPoint": [
            {
                "@type": "ContactPoint",
                "telephone": "+90 554 867 56 60",
                "email":"iseser@iseser.com",
                "contactType": "customer"
            }
        ]
    }

</script>
</body>
</html>

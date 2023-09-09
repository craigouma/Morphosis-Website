jQuery(document).ready(function($) {
    
    /* #Global: Primary Font
    ================================================== */
    wp.customize('uxbarn_sc_global_styles[primary_font]', function(value) {
        value.bind(function(newval) {
            if(newval != '-1') {
                $('#menu-wrapper, #full-scrn-slider .caption-title, #content-container h1,#content-container h2,#content-container h3,#content-container h4,#content-container h5,#content-container h6,#page-404 h1, #intro-title,#content-container #intro-title.blog-single, .uxb-port-element-item-hover-info, #blog-list-wrapper .blog-meta li, .commenter-name a').css('font-family', getCleanValueForGoogleFonts(newval));
            } else {
                $('#menu-wrapper, #full-scrn-slider .caption-title, #content-container h1,#content-container h2,#content-container h3,#content-container h4,#content-container h5,#content-container h6,#page-404 h1, #intro-title,#content-container #intro-title.blog-single, .uxb-port-element-item-hover-info, #blog-list-wrapper .blog-meta li, .commenter-name a').css('font-family', '');
            }
        } );
    } );
    
    /* #Global: Secondary Font
    ================================================== */
    wp.customize('uxbarn_sc_global_styles[secondary_font]', function(value) {
        value.bind(function(newval) {
            if(newval != '-1') {
                $('body, #tagline, #inner-content-container .columns, #content-container .uxb-team-position, #blog-list-wrapper .blog-title, #sidebar-wrapper .widget-item h4').css('font-family', getCleanValueForGoogleFonts(newval));
            } else {
                $('body, #tagline, #inner-content-container .columns, #content-container .uxb-team-position, #blog-list-wrapper .blog-title, #sidebar-wrapper .widget-item h4').css('font-family', '');
            }
        } );
    } );
    
    /* #Global: Site Bg color
    ================================================== */
    wp.customize('uxbarn_sc_global_styles[background_color]', function(value) {
        value.bind(function(newval) {
            $('body').css('background-color', newval);
        } );
    } );
    
    
    
    /* #Side Panel: Title and tagline
    ================================================== */
    wp.customize('uxbarn_sc_panel_styles[site_title_color]', function(value) {
        value.bind(function(newval) {
            $('#logo-wrapper h1').css('color', newval);
        } );
    } );
    wp.customize('uxbarn_sc_panel_styles[site_tagline_color]', function(value) {
        value.bind(function(newval) {
            $('#tagline').css('color', newval);
        } );
    } );
    
    /* #Side Panel: Bg color
    ================================================== */
    wp.customize('uxbarn_sc_panel_background_styles[background_color]', function(value) {
        value.bind(function(newval) {
            $('#side-container').css({
                'background-color': 'rgb(' + hexToR(newval) + ',' + hexToG(newval) + ',' + hexToB(newval) + ')',
                'background-color': 'rgba(' + hexToR(newval) + ',' + hexToG(newval) + ',' + hexToB(newval) + ',' + wp.customize('uxbarn_sc_panel_styles_background_opacity').get() + ')',
            });
        } );
    } );
    
    wp.customize('uxbarn_sc_panel_styles_background_opacity', function(value) {
        value.bind(function(newval) {
            var selectedColor = wp.customize('uxbarn_sc_panel_background_styles[background_color]').get();
            $('#side-container').css({
                'background-color': 'rgb(' + hexToR(selectedColor) + ',' + hexToG(selectedColor) + ',' + hexToB(selectedColor) + ')',
                'background-color': 'rgba(' + hexToR(selectedColor) + ',' + hexToG(selectedColor) + ',' + hexToB(selectedColor) + ',' + newval + ')',
            });
        } );
    } );
    
    /* #Side Panel: Bg image and attributes
    ================================================== */
    wp.customize('uxbarn_sc_panel_background_styles[background_image]', function(value) {
        value.bind(function(newval) {
            $('#side-container').css('background-image', 'url(' + newval + ')');
        } );
    } );
    wp.customize('uxbarn_sc_panel_background_styles[background_repeat]', function(value) {
        value.bind(function(newval) {
            $('#side-container').css('background-repeat', newval);
        } );
    } );
    wp.customize('uxbarn_sc_panel_background_styles[background_position]', function(value) {
        value.bind(function(newval) {
            $('#side-container').css('background-position', newval);
        } );
    } );
    
    
    
    /* #Page Intro: Colors
    ================================================== */
    wp.customize('uxbarn_sc_page_intro_styles[title_color]', function(value) {
        value.bind(function(newval) {
            $('#intro-title, #content-container #intro-title.blog-single').css('color', newval);
        } );
    } );
    wp.customize('uxbarn_sc_page_intro_styles[body_color]', function(value) {
        value.bind(function(newval) {
            $('#intro-body').css('color', newval);
        } );
    } );
    
    
    
    /* #Content Area: Bg color
    ================================================== */
    wp.customize('uxbarn_sc_content_background_styles[background_color]', function(value) {
        value.bind(function(newval) {
            $('#content-container').css({
                'background-color': 'rgb(' + hexToR(newval) + ',' + hexToG(newval) + ',' + hexToB(newval) + ')',
                'background-color': 'rgba(' + hexToR(newval) + ',' + hexToG(newval) + ',' + hexToB(newval) + ',' + wp.customize('uxbarn_sc_content_background_styles_opacity').get() + ')',
            });
        } );
    } );
    
    wp.customize('uxbarn_sc_content_background_styles_opacity', function(value) {
        value.bind(function(newval) {
            var selectedColor = wp.customize('uxbarn_sc_content_background_styles[background_color]').get();
            $('#content-container').css({
                'background-color': 'rgb(' + hexToR(selectedColor) + ',' + hexToG(selectedColor) + ',' + hexToB(selectedColor) + ')',
                'background-color': 'rgba(' + hexToR(selectedColor) + ',' + hexToG(selectedColor) + ',' + hexToB(selectedColor) + ',' + newval + ')',
            });
        } );
    } );
    
    /* #Content Area: Bg image and attributes
    ================================================== */
    wp.customize('uxbarn_sc_content_background_styles[background_image]', function(value) {
        value.bind(function(newval) {
            $('#content-container').css('background-image', 'url(' + newval + ')');
        } );
    } );
    wp.customize('uxbarn_sc_content_background_styles[background_repeat]', function(value) {
        value.bind(function(newval) {
            $('#content-container').css('background-repeat', newval);
        } );
    } );
    wp.customize('uxbarn_sc_content_background_styles[background_position]', function(value) {
        value.bind(function(newval) {
            $('#content-container').css('background-position', newval);
        } );
    } );
    
    
    
    
    /* #Sidebar: colors
    ================================================== */
    wp.customize('uxbarn_sc_sidebar_body_styles[heading_color]', function(value) {
        value.bind(function(newval) {
            $('#sidebar-wrapper .widget-item h4').css('color', newval);
        } );
    } );
    
    
    
    
    
    
    
    /* #Utilities
    ================================================== */
    function getCleanValueForGoogleFonts(input) {
        // Clean value only if it's Google Fonts
        if(input.indexOf('[#GF#]') != -1) {
            input = input.replace('[#GF#]', '').split(':');//.replace(/[^a-zA-Z\s]/gi, '');
            input = '\'' + input[0] + '\', sans-serif';
        }
        
        return input;
    }
    

    function hexToR(h) {return parseInt((cutHex(h)).substring(0,2),16);}
    function hexToG(h) {return parseInt((cutHex(h)).substring(2,4),16);}
    function hexToB(h) {return parseInt((cutHex(h)).substring(4,6),16);}
    function cutHex(h) {return (h.charAt(0)=="#") ? h.substring(1,7):h;}
    
    function dump(obj) {
        var out = '';
        for (var i in obj) {
            out += i + ": " + obj[i] + "\n";
        }
    
        console.log(out);
    
        // or, if you wanted to avoid alerts...
    
        /*var pre = document.createElement('pre');
        pre.innerHTML = out;
        document.body.appendChild(pre)*/
    }
    
});
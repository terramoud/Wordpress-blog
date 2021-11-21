jQuery(document).ready(function() {

  jQuery('.wp-block-code, .scroll').attr('data-slideout-ignore', '');;
  /**
   *  columns of equal height
   */
  var blocksHeight = {
    sidebarLeft: false,
    content: false
  };

  blocksHeight.getHeight = function () { 
    blocksHeight.sidebarLeft = jQuery(".sidebar-right").outerHeight();
    blocksHeight.content = jQuery(".content").outerHeight();
  };

  blocksHeight.counter = function (slh, ch) {

    if (slh >= ch) {
      jQuery(".sidebar-right").outerHeight(slh);
      jQuery(".content").outerHeight(slh);
    } 

    if (ch >= slh) {
      jQuery(".sidebar-right").outerHeight(ch);
      jQuery(".content").outerHeight(ch);
    } 

  };
  /*end columns of equal height*/

  /**
   *  displaying counts posts number for sidebar by with ajax
   */
  var ajaxCountPostArray = {
    'size0px': false,
    'size320px': false,
    'size531px': false,
    'size768px': false,
    'size992px': false,
    'size1200px': false,
  };

  ajaxCountPostArray.postDisplaySetting = function (sizeArgument) {
    for (var key in ajaxCountPostArray) {
      if (key === 'postDisplaySetting') break;
      if (key === sizeArgument) continue;
      ajaxCountPostArray[key] = false;
    }
  }

  ajaxCountPostArray.goAjax = function (countPosts) {
    var numberPosts = jQuery(".content_post-block").length;
    if (jQuery(".content").attr('data-content') == "article") countPosts = 6;
    if (jQuery(".content").attr('data-content') == "copyright") countPosts = 2;
    if ( numberPosts > 0 && window.innerWidth >= 1200 ) {
      switch (numberPosts) {
        case 1:
        case 2:
          countPosts = 1;
          break;
        case 3:
        case 4:
          countPosts = 2;
          break;
        case 5:
        case 6:
          countPosts = 3;
          break;
        case 7:
        case 8:
          countPosts = 5;
          break;
        case 9:
        case 10:
          countPosts = 6;
          break;
      }
    } 
    if ( numberPosts > 0 && window.innerWidth >= 992 && window.innerWidth < 1200 ) {
      switch (numberPosts) {
        case 1:
          countPosts = 1;
          break;
        case 2:
          countPosts = 2;
          break;
        case 3:
          countPosts = 3;
          break;
        case 4:
          countPosts = 4;
          break;
        case 5:
          countPosts = 5;
          break;
        case 6:
          countPosts = 7;
          break;
        case 7:
          countPosts = 8;
          break;
        case 8:
          countPosts = 9;
          break;
        case 9:
          countPosts = 11;
          break;
        case 10:
          countPosts = 12;
          break;
      }
    }
    $.ajax({
      url: wp_data.ajax_url,
      type: 'POST',
      data: 'action=postDisplaySetting&countPost=' + countPosts, // можно также передать в виде объекта
      beforeSend: function( xhr ) {
        jQuery('.sidebar-right_post-block').remove();
        jQuery('.cssload-container').css('display', 'block'); 
      },
      success: function( data ) {
        jQuery('.cssload-container').css('display', 'none');
        $('#sidebar-right_header').after(data);
        jQuery(".content, .sidebar-right").css('height', 'auto');

        if ( window.innerWidth >= 992 ) {
          blocksHeight.getHeight();
          blocksHeight.counter(blocksHeight.sidebarLeft, blocksHeight.content); 
        } 

        if (window.innerWidth >= 531 && window.innerWidth < 768) jQuery(".sidebar-right").css('height', '160px');

        if (window.innerWidth >= 321 && window.innerWidth < 531) jQuery(".sidebar-right").css('height', '36rem');   

        if (window.innerWidth <= 320) jQuery(".sidebar-right").css('height', '32rem');   
      }
    });
  }
  
  /*end displaying counts posts number for sidebar by with ajax*/

  /**
   * Installing natural size image, clicking on the image with adding horizontal scroll
   */
  var forIeDisplayProperty = jQuery(this).parent().css('display');

  function largerImage() {
    jQuery('.article img').click(function(event) {
      event.preventDefault();
      if (jQuery(this).parent().hasClass('scroll')) {
        if (jQuery(this).hasClass('has_been_clicked')) {
          jQuery(this).removeClass('has_been_clicked')
          jQuery(this).css({
            'max-width': '100%',
            'width': 'inherit',
            'border-radius': '0.2rem'
          });
          jQuery(this).parent().css('overflow-x', 'unset');
          if (jQuery(this).parent().hasClass('is-resized')) jQuery(this).parent().css('display', forIeDisplayProperty);
          jQuery(".content, .sidebar-right").css('height', 'auto');
          blocksHeight.getHeight();
          blocksHeight.counter(blocksHeight.sidebarLeft, blocksHeight.content);
        } else {
          jQuery(this).addClass('has_been_clicked');
          if (jQuery(this).attr('sizes')) {
            var imgNaturalWidth = jQuery(this).attr('sizes').match( /\d{1,4}px/ );
            jQuery(this).css({
              'max-width': imgNaturalWidth[0],
              'width': imgNaturalWidth[0],
              'padding': 0,
              'border-radius': 0
            });
            
            jQuery(this).parent().css({
              'overflow-x': 'scroll',
              'display': 'block'
            });
          } else {
            jQuery(this).css({
              'max-width': this.naturalWidth + 'px',
              'padding': 0,
              'border-radius': 0
            });
            
            jQuery(this).parent().css({
              'overflow-x': 'scroll',
              'display': 'block'
            });
          }
          jQuery(".content, .sidebar-right").css('height', 'auto');
          blocksHeight.getHeight();
          blocksHeight.counter(blocksHeight.sidebarLeft, blocksHeight.content);
        }
      }
    });
  }

  /**
   * jQuery UI navigation menu
   */
  function navigationMenu() {
    jQuery( function() {
      jQuery( "#menu" ).menu({
        position: { my: "left-143 top+48", at: "right top" },
        classes: { "ui-menu": "ui-menu2" }
      });
      jQuery("#menu").removeClass('ui-menu2').removeClass('ui-widget').removeClass('ui-widget-content');
      jQuery("#menu a, #menu ul").removeClass('ui-menu-item-wrapper').removeClass('ui-widget-content');
      jQuery('.ui-icon-caret-1-e').remove();
    });
  };

  /**
   * Slideout.js
   */
  var slideout = new Slideout({
    'panel': document.getElementById('panel'),
    'menu': document.getElementById('menu_xs'),
    'padding': 256,
    'tolerance': 70
  });
    // Toggle button
  document.querySelector('.toggle-button').addEventListener('click', function() {
    slideout.toggle();
  });

  /**
   * setting the style, in depencing at screen width
   */ 
  function responsiveMode(){

    if (window.innerWidth >= 992) {
      jQuery(".sidebar-right, .content").css('height', 'auto');
      blocksHeight.getHeight();
      blocksHeight.counter(blocksHeight.sidebarLeft, blocksHeight.content);
      /**
       * Slideout.js
       */
      jQuery("#panel").attr('data-slideout-ignore', '');
      slideout.close();
      /**
       *jQuery UI menu
       */
      navigationMenu()
    }

    if (window.innerWidth >= 768 && window.innerWidth < 992) {
      jQuery(".content").css('height', 'auto');
      jQuery(".sidebar-right").css('height', 'auto');
      /**
       * Slideout.js
       */
      jQuery("#panel").attr('data-slideout-ignore', '');
      slideout.close();
      /**
       * alternatived method to close slideout.js
       */
      if (slideout.isOpen()) {
        document.querySelector('.toggle-button').addEventListener("click", function(event) {}, false);
        var event = new Event("click"); 
        document.querySelector('.toggle-button').dispatchEvent(event);
      };
      /**
       *jQuery UI menu
       */
      navigationMenu();
    }

    if (window.innerWidth >= 768) {
      if ( jQuery('.nav-links').children().first().hasClass("current") ) jQuery('.nav-links').prepend(prevPage);
      if ( jQuery('.nav-links').children().last().hasClass("current") ) jQuery('.nav-links').append(nextPage);
      /*remove form search for mobile mode ( mobile mode -> screen width < 768 pixels )*/
      jQuery('#mobileSearch').remove();
      if (jQuery('#desktopSearch').length < 1) jQuery('.online').before(desktopSearch);
    }

    if (window.innerWidth < 768) {
      jQuery("#panel").removeAttr('data-slideout-ignore');
      if ( jQuery('.nav-links').children().first().hasClass("current") ) jQuery('.nav-links').prepend(prevPage);
      if ( jQuery('.nav-links').children().last().hasClass("current") ) jQuery('.nav-links').append(nextPage);
      /*remove form search for decktop mode ( decktop mode -> screen width >= 768 pixels )*/
      jQuery('#desktopSearch').remove();   
      if (jQuery('#mobileSearch').length < 1) jQuery('.menu-section:first').prepend(mobileSearch);
    }
    
    if (window.innerWidth >= 531 && window.innerWidth < 768) {
      jQuery(".content").css('height', 'auto');
      jQuery(".sidebar-right").css('height', '160px');
    }

    if (window.innerWidth >= 321 && window.innerWidth < 531) {
      jQuery(".content").css('height', 'auto');
      jQuery(".sidebar-right").css('height', '36rem');   
    }

    if (window.innerWidth <= 320) {
      jQuery(".content").css('height', 'auto');
      jQuery(".sidebar-right").css('height', '32rem'); 
    }
  };
  /*end setting the style, in depencing at screen width*/

  var desktopSearch = jQuery('#desktopSearch');
  var mobileSearch = jQuery('#mobileSearch');
  /**
   * Setting the href attribute for links to the previous and next post
   */
  jQuery('#prev').attr('href', jQuery('.prev_page a[rel="prev"]').attr('href'));
  jQuery('#next').attr('href', jQuery('.next_page a[rel="next"]').attr('href'));
  /**
   * Create button for links to the previous/next page
   */
  var prevPage = '<a class="prev page-numbers">' + 
                    '<span class="fa-stack fa-lg">' + 
                      '<i class="fa fa-circle fa-stack-2x fa-4x navigation-circle"></i>' + 
                      '<i class="fa fa-angle-double-left fa-stack-1x navigation-angle"></i>' + 
                    '</span>' + 
                    '<b> ' + wp_data.prevPageText + '</b>' + 
                  '</a>';
  var nextPage = '<a class="next page-numbers">' +
                    '<b>' + wp_data.nextPageText + ' </b>' + 
                    '<span class="fa-stack fa-lg">' + 
                      '<i class="fa fa-circle fa-stack-2x fa-4x navigation-circle"></i>' + 
                      '<i class="fa fa-angle-double-right fa-stack-1x navigation-angle"></i>' + 
                    '</span>' + 
                  '</a>';
  
  if (jQuery(".content").attr('data-content') == "copyright") ajaxCountPostArray.goAjax();

  if (window.innerWidth >= 1200) {
    ajaxCountPostArray.size1200px = true;
    if (jQuery(".content_post-block").length < 10) ajaxCountPostArray.goAjax();
  }

  if (window.innerWidth >= 768 && window.innerWidth < 992) ajaxCountPostArray.size768px = true;
  
  if (window.innerWidth >= 992 && window.innerWidth < 1200) {
    ajaxCountPostArray.postDisplaySetting('size992px');
    if (ajaxCountPostArray.size992px === false) {
      ajaxCountPostArray.size992px = true;
      ajaxCountPostArray.goAjax(12);
    }
  }  

  responsiveMode();
  largerImage();

  jQuery(window).bind('resize', function(event) {
    responsiveMode();
    /**
     *displaying counts posts number for sidebar by with ajax
     */
    if (window.innerWidth >= 1200 ) {
      ajaxCountPostArray.postDisplaySetting('size1200px');
      if (ajaxCountPostArray.size1200px === false) {
        ajaxCountPostArray.size1200px = true;
        ajaxCountPostArray.goAjax(6);
      }
    }

    if (window.innerWidth >= 992 && window.innerWidth < 1200) {
      ajaxCountPostArray.postDisplaySetting('size992px');
      if (ajaxCountPostArray.size992px === false) {
        ajaxCountPostArray.size992px = true;
        ajaxCountPostArray.goAjax(12);
      }
    }

    if ( window.innerWidth < 992 ) {
      ajaxCountPostArray.postDisplaySetting('size768px');
      if (ajaxCountPostArray.size768px === false) {
        ajaxCountPostArray.size768px = true;
        ajaxCountPostArray.goAjax(6);
      }
    }
    /*end displaying counts posts number for sidebar by with ajax*/
  });

});

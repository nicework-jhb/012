/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function ($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function () {

      },
      finalize: function () {
        var initPhotoSwipeFromDOM = function(gallerySelector) {

          // parse slide data (url, title, size ...) from DOM elements
          // (children of gallerySelector)
          var parseThumbnailElements = function(el) {
            var thumbElements = el.childNodes,
                numNodes = thumbElements.length,
                items = [],
                figureEl,
                linkEl,
                size,
                item;

            for(var i = 0; i < numNodes; i++) {

              figureEl = thumbElements[i]; // <figure> element

              // include only element nodes
              if(figureEl.nodeType !== 1) {
                continue;
              }

              linkEl = figureEl.children[0]; // <a> element

              size = linkEl.getAttribute('data-size').split('x');


              // create slide object
              item = {
                src: linkEl.getAttribute('href'),
                w: parseInt(size[0], 10),
                h: parseInt(size[1], 10)
              };



              if(figureEl.children.length > 1) {
                // <figcaption> content
                item.title = figureEl.children[1].innerHTML || '';
              }

              if(linkEl.children.length > 0) {
                // <img> thumbnail element, retrieving thumbnail url
                item.msrc = linkEl.children[0].getAttribute('src');
              }

              item.el = figureEl; // save link to element for getThumbBoundsFn
              items.push(item);
            }

            return items;
          };

          // find nearest parent element
          var closest = function closest(el, fn) {
            return el && ( fn(el) ? el : closest(el.parentNode, fn) );
          };

          // triggers when user clicks on thumbnail
          var onThumbnailsClick = function(e) {
            e = e || window.event;
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var eTarget = e.target || e.srcElement;

            // find root element of slide
            var clickedListItem = closest(eTarget, function(el) {
              return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
            });

            if(!clickedListItem) {
              return;
            }

            // find index of clicked item by looping through all child nodes
            // alternatively, you may define index via data- attribute
            var clickedGallery = clickedListItem.parentNode,
                childNodes = clickedListItem.parentNode.childNodes,
                numChildNodes = childNodes.length,
                nodeIndex = 0,
                index;

            for (var i = 0; i < numChildNodes; i++) {
              if(childNodes[i].nodeType !== 1) {
                continue;
              }

              if(childNodes[i] === clickedListItem) {
                index = nodeIndex;
                break;
              }
              nodeIndex++;
            }



            if(index >= 0) {
              // open PhotoSwipe if valid index found
              openPhotoSwipe( index, clickedGallery );
            }
            return false;
          };

          // parse picture index and gallery index from URL (#&pid=1&gid=2)
          var photoswipeParseHash = function() {
            var hash = window.location.hash.substring(1),
                params = {};

            if(hash.length < 5) {
              return params;
            }

            var vars = hash.split('&');
            for (var i = 0; i < vars.length; i++) {
              if(!vars[i]) {
                continue;
              }
              var pair = vars[i].split('=');
              if(pair.length < 2) {
                continue;
              }
              params[pair[0]] = pair[1];
            }

            if(params.gid) {
              params.gid = parseInt(params.gid, 10);
            }

            return params;
          };

          var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
            var pswpElement = document.querySelectorAll('.pswp')[0],
                gallery,
                options,
                items;

            items = parseThumbnailElements(galleryElement);

            // define options (if needed)
            options = {

              // define gallery index (for URL)
              galleryUID: galleryElement.getAttribute('data-pswp-uid'),

              getThumbBoundsFn: function(index) {
                // See Options -> getThumbBoundsFn section of documentation for more info
                var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                    pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                    rect = thumbnail.getBoundingClientRect();

                return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
              }

            };

            // PhotoSwipe opened from URL
            if(fromURL) {
              if(options.galleryPIDs) {
                // parse real index when custom PIDs are used
                // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                for(var j = 0; j < items.length; j++) {
                  if(items[j].pid === index) {
                    options.index = j;
                    break;
                  }
                }
              } else {
                // in URL indexes start from 1
                options.index = parseInt(index, 10) - 1;
              }
            } else {
              options.index = parseInt(index, 10);
            }

            // exit if index not found
            if( isNaN(options.index) ) {
              return;
            }

            if(disableAnimation) {
              options.showAnimationDuration = 0;
            }

            // Pass data to PhotoSwipe and initialize it
            gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
            gallery.init();
          };

          // loop through all gallery elements and bind events
          var galleryElements = document.querySelectorAll( gallerySelector );

          for(var i = 0, l = galleryElements.length; i < l; i++) {
            galleryElements[i].setAttribute('data-pswp-uid', i+1);
            galleryElements[i].onclick = onThumbnailsClick;
          }

          // Parse URL and open gallery if it contains #&pid=3&gid=1
          var hashData = photoswipeParseHash();
          if(hashData.pid && hashData.gid) {
            openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
          }
        };

        // execute above function
        initPhotoSwipeFromDOM('.ps-gallery');

        // JavaScript to be fired on all pages
        $('.ps-gallery figure').each(function() {
          var psFigure = $(this);
          var img = new Image();
          $(img).bind('load', function(e) {
            psFigure.find('a').attr('data-size', this.width + 'x' +this.height);
          });

          img.src = $(this).children('a').attr('href');
        });

        $('.ps-gallery').slick({
          infinite: false,
          slidesToShow: 3,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 2
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1
              }
            }
          ]
        });

        $('.slick-friends').slick({
          infinite: false,
          slidesToShow: 3,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 2
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1
              }
            }
          ]
        });
      }
    },
    // Home page
    'home': {
      init: function () {
        // JavaScript to be fired on the home page
      },
      finalize: function () {
        // JavaScript to be fired on the home page, after the init JS
        $backstretchArray = [];
        $('.backstretch-image-scrape').each(function () {
          $backstretchArray.push($(this).attr('src'));
        });

        $.backstretch($backstretchArray, {duration: 5000, fade: 1000});
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function () {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function (func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function () {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function (i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.


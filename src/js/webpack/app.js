// import smoothState from 'smoothstate';
import lazysizes from 'lazysizes';
import Flickity from 'flickity';
import throttle from 'lodash.throttle';
import moment from 'moment';
import tz from 'moment-timezone';

const App = {
  $body: null,
  $container: null,
  header: null,
  siteTitle: null,
  boardSlider: null,
  initialize: () => {
    // App.$body = $('body');
    // App.smoothState('#main');
    App.header = document.querySelector("header")
    App.siteTitle = document.querySelector("#site-title")
    App.menu = document.getElementById("menu")
    App.interact.init();
    setTimeout(function() {
      document.getElementById("loader").style.display = "none"
    }, 300);

  },
  interact: {
    init: () => {
      App.interact.linkTargets()
      App.interact.eventTargets()
      App.interact.embedKirby()
      App.interact.loadSliders()
      App.interact.timeClock()
      App.interact.loadBoard()
      App.interact.postStickyPosition()
    },
    eventTargets: () => {
      App.header.addEventListener('mouseenter', function() {
        App.boardSlider.next()
      });
      App.siteTitle.addEventListener('mouseenter', App.interact.menuOn);
      App.siteTitle.addEventListener('mouseleave', App.interact.menuOff);
      App.menu.addEventListener('mouseenter', App.interact.menuOn);
      App.menu.addEventListener('mouseleave', App.interact.menuOff);
    },
    menuOn: (e) => {
      App.menu.classList.add("is-visible")
    },
    menuOff: (e) => {
      App.menu.classList.remove("is-visible")
    },
    linkTargets: () => {
      document.querySelectorAll("a").forEach(function(element, index) {
        if (element.host !== window.location.host) {
          element.setAttribute('target', '_blank');
        } else {
          element.setAttribute('target', '_self');
        }
      });
    },
    embedKirby: () => {
      var pluginEmbedLoadLazyVideo = function() {
        var e = this.parentNode,
          d = e.children[0];
        d.src = d.dataset.src, e.removeChild(this)
      };
      for (var d = document.getElementsByClassName("embed__thumb"), t = 0; t < d.length; t++) d[t].addEventListener("click", pluginEmbedLoadLazyVideo, !1)
    },
    postStickyPosition: () => {
      let postHeader = document.querySelector("#post-header h1")
      let stickyPost = document.getElementById("post-sticky")
      if (!postHeader || !stickyPost) return;

      function checkPostPosition() {
        if (postHeader.offsetTop + postHeader.clientHeight - App.header.clientHeight < window.scrollY) {
          if (!stickyPost.classList.contains('is-visible')) stickyPost.classList.add('is-visible')
        } else {
          if (stickyPost.classList.contains('is-visible')) stickyPost.classList.remove('is-visible')
        }
      }

      window.addEventListener('scroll', throttle(checkPostPosition, 128), false);
    },
    loadSliders: () => {
      const initFlickity = (element) => {
        var slider = new Flickity(element, {
          cellSelector: '.slide',
          imagesLoaded: true,
          lazyLoad: 1,
          setGallerySize: true,
          adaptiveHeight: true,
          percentPosition: true,
          accessibility: true,
          wrapAround: true,
          prevNextButtons: !Modernizr.touchevents,
          pageDots: false,
          draggable: Modernizr.touchevents,
          dragThreshold: 30
        });
        slider.slidesCount = slider.slides.length;
        if (slider.slidesCount < 1) return; // Stop if no slides
        slider.on('select', function() {
          // $('#slide-number').html((slider.selectedIndex + 1) + '/' + slider.slidesCount);
          if (this.selectedElement) {
            this.element.parentNode.querySelector(".caption").innerHTML = this.selectedElement.getAttribute("data-caption");
          }
          var adjCellElems = this.getAdjacentCellElements(1);
          for (var i = 0; i < adjCellElems.length; i++) {
            var adjCellImgs = adjCellElems[i].querySelectorAll('.lazy:not(.lazyloaded):not(.lazyload)')
            for (var j = 0; j < adjCellImgs.length; j++) {
              adjCellImgs[j].classList.add('lazyload')
            }
          }
        });
        slider.on('staticClick', function(event, pointer, cellElement, cellIndex) {
          if (!cellElement || cellElement.getAttribute('data-media') == "video" && !slider.element.classList.contains('nav-hover')) {
            return;
          } else {
            this.next();
          }
        });
        if (slider.selectedElement) {
          slider.element.parentNode.querySelector(".caption").innerHTML = slider.selectedElement.getAttribute("data-caption");
        }
      }
      var flickitys = [];
      var elements = document.querySelectorAll('.slider');
      if (elements.length > 0) {
        for (var i = 0; i < elements.length; i++) {
          initFlickity(elements[i]);
        }
      }
    },
    loadBoard: () => {
      var board = document.getElementById("menu--board");
      const initBoard = (element) => {
        App.boardSlider = new Flickity(board, {
          cellSelector: '.slide',
          accessibility: false,
          setGallerySize: false,
          wrapAround: true,
          prevNextButtons: false,
          pageDots: false,
          draggable: false,
        // autoPlay: 4000
        });
      }
      initBoard(board);
    },
    timeClock: () => {
      const timeLa = document.querySelector("#menu--la-time .time");
      const timeLaConvention = document.querySelector("#menu--la-time .time-convention");

      const timeFr = document.querySelector("#menu--fr-time .time");
      const timeFrConvention = document.querySelector("#menu--fr-time .time-convention");

      const displayTime = () => {
        var now = moment();

        var timeInLa = now.tz('America/Los_Angeles')
        timeLa.innerHTML = timeInLa.format('hh:mm:ss')
        timeLaConvention.innerHTML = timeInLa.format('a')

        var timeInFr = now.tz('Europe/Paris')
        timeFr.innerHTML = timeInFr.format('hh:mm:ss')
        timeFrConvention.innerHTML = timeInFr.format('a')
      }

      setInterval(displayTime, 1000)
    }
  },
  smoothState: (container) => {
    var options = {
        debug: true,
        scroll: false,
        anchors: '[data-target]',
        loadingClass: false,
        prefetch: true,
        cacheLength: 4,
        onAction: ($currentTarget, $container) => {
          // lastTarget = target;
          let target = $currentTarget.data('target');
          console.log(target);
        // if (target === "back") app.goBack();
        // console.log(lastTarget);
        },
        onBefore: (request, $container) => {
        },
        onStart: {
          duration: 0, // Duration of our animation
          render: function($container) {
            App.$body.addClass('is-loading');
          }
        },
        onReady: {
          duration: 0,
          render: function($container, $newContent) {
            // Inject the new content
            $(window).scrollTop(0);
            App.$body.attr("page-type", $newContent.find("#page-content").attr("page-type"));
            $container.html($newContent);
          }
        },
        onAfter: function($container, $newContent) {
          App.interact.init();
          setTimeout(function() {
            App.$body.removeClass('is-loading');
            // Clear cache for random content
            smoothState.clear();
          }, 200);
        }
      },
      smoothState = $(container).smoothState(options).data('smoothState');
  }
}

document.addEventListener("DOMContentLoaded", App.initialize);
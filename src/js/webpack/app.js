/* jshint esversion: 6 */

// import smoothState from 'smoothstate';
import lazysizes from 'lazysizes';
import optimumx from 'lazysizes';
require('../../../node_modules/lazysizes/plugins/object-fit/ls.object-fit.js');
import Flickity from 'flickity';
import InfiniteScroll from 'infinite-scroll';
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
    console.log('Code by Tristan Bagot', 'www.tristanbagot.com')
    App.header = document.querySelector("header")
    App.siteTitle = document.querySelector("#site-title")
    App.menu = document.getElementById("menu")
    App.sizeSet();
    App.interact.init();
    setTimeout(function() {
      document.getElementById("loader").style.display = "none"
    }, 0);

  },
  sizeSet: () => {
    App.width = (window.innerWidth || document.documentElement.clientWidth);
    App.height = (window.innerHeight || document.documentElement.clientHeight);
    if (App.width <= 1024)
      App.isMobile = true;
    if (App.isMobile) {
      if (App.width >= 1024) {
        // location.reload();
        App.isMobile = false;
      }
    }
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
      App.interact.infiniteScroll()
    },
    eventTargets: () => {
      App.header.addEventListener('mouseenter', function() {
        App.boardSlider.next()
      });
      App.header.addEventListener('mouseenter', App.interact.menuOn);
      App.header.addEventListener('mouseleave', App.interact.menuOff);
      App.menu.addEventListener('mouseenter', App.interact.menuOn);
      App.menu.addEventListener('mouseleave', App.interact.menuOff);
    },
    infiniteScroll: () => {
      const container = document.getElementById('posts');
      const pagination = document.getElementById('pagination');

      if (container && pagination) {
        App.infScroll = new InfiniteScroll(container, {
          path: '#pagination .next',
          append: '.post-item',
          history: false,
          hideNav: "#pagination",
          scrollThreshold: 1000,
          // status: '.ajax-loading',
          debug: false
        });
      } else {
        App.infScroll = null;
      }
    },
    menuOn: (e) => {
      App.menu.classList.add("is-visible")
      document.body.classList.add("menu-visible")
    },
    menuOff: (e) => {
      App.menu.classList.remove("is-visible")
      document.body.classList.remove("menu-visible")
    },
    linkTargets: () => {
      const links = document.querySelectorAll("a");
      for (var i = 0; i < links.length; i++) {
        const element = links[i];
        if (element.host !== window.location.host) {
          element.setAttribute('target', '_blank');
        } else {
          element.setAttribute('target', '_self');
        }
      }
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
          setGallerySize: App.isMobile ? true : false,
          adaptiveHeight: App.isMobile ? true : false,
          percentPosition: true,
          accessibility: true,
          wrapAround: true,
          prevNextButtons: !Modernizr.touchevents,
          pageDots: false,
          draggable: '>1',
          dragThreshold: 60
        });
        slider.slidesCount = slider.slides.length;
        if (slider.slidesCount < 1) return; // Stop if no slides
        slider.on('change', function() {
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
          if (!cellElement || !Modernizr.touchevents || cellElement.getAttribute('data-media') == "video") {
            return;
          } else {
            this.next();
          }
        });
        let prevNextButtons = slider.element.querySelectorAll(".flickity-prev-next-button");
        for (var i = 0; i < prevNextButtons.length; i++) {
          const el = prevNextButtons[i];
          let cursor = document.createElement('div');
          cursor.className = "cursor";
          el.appendChild(cursor);
          el.addEventListener('mousemove', () => {
            if (!Modernizr.touchevents) {
              let rect = el.getBoundingClientRect();
              cursor.style.top = event.pageY - rect.top - window.scrollY + "px";
              cursor.style.left = event.pageX - rect.left - window.scrollX + "px";
            }
          });
        }
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
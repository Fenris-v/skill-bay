<<<<<<< HEAD
(self["webpackChunk"] = self["webpackChunk"] || []).push([["/assets/js/app"],{

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! ./bootstrap */ "./resources/js/bootstrap.js");

/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

window.$ = window.jQuery = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

__webpack_require__(/*! countdown */ "./node_modules/countdown/countdown.js");

__webpack_require__(/*! jquery-form */ "./node_modules/jquery-form/dist/jquery.form.min.js");

__webpack_require__(/*! jquery.maskedinput */ "./node_modules/jquery.maskedinput/gruntfile.js");

__webpack_require__(/*! ion-rangeslider */ "./node_modules/ion-rangeslider/js/ion.rangeSlider.js");

__webpack_require__(/*! slick-carousel */ "./node_modules/slick-carousel/slick/slick.js");

__webpack_require__(/*! ./scripts */ "./resources/js/scripts.js");

/***/ }),

/***/ "./resources/js/scripts.js":
/*!*********************************!*\
  !*** ./resources/js/scripts.js ***!
  \*********************************/
/***/ (() => {

"use strict";


(function ($) {
  var px = ''; //'rt--'

  /**
   * Функция для вывода набора jQuery по селектору, к селектору добавляются
   * префиксы
   *
   * @param {string} selector Принимает селектор для формирования набора
   * @return {jQuery} Возвращает новый jQuery набор по выбранным селекторам
   */

  function $x(selector) {
    return $(x(selector));
  }
  /**
   * Функция для автоматического добавления префиксов к селекторы
   *
   * @param {string} selector Принимает селектор для формирования набора
   * @return {string} Возвращает новый jQuery набор по выбранным селекторам
   */


  function x(selector) {
    var arraySelectors = selector.split('.'),
        firstNotClass = !!arraySelectors[0];
    selector = '';

    for (var i = 0; i < arraySelectors.length; i++) {
      if (!i) {
        if (firstNotClass) selector += arraySelectors[i];
        continue;
      }

      selector += '.' + px + arraySelectors[i];
    }

    return selector;
  } // Прелоадер


  $(function () {
    var menu = function menu() {
      var $menuMain = $('.menu_main');
      $menuMain.css('position', 'absolute');
      var menuHeight = $('.menu_main').outerHeight();
      $menuMain.css('position', 'static');
      var $body = $('body');

      function refresh() {
        if (window.innerWidth < 991) {
          // $('.menuModal').each(function(){
          //     var $this = $(this);
          //     setTimeout(function(){
          //         if ($this.attr('height') > 0) {
          //             $this.css('height', 0);
          //         }
          //     }, 100);
          // });
          $('.menuModal').css('height', 0);
          $menuMain.css('position', 'absolute');
          menuHeight = $('.menu_main').outerHeight();
          $menuMain.css('position', 'static');
        } else {
          menuHeight = $('.menu_main').outerHeight();
          $('.menuModal').removeClass("menuModal_OPEN").css('height', '');
          $body.removeClass("Site_menuOPEN");
          $('.menuTrigger').removeClass("menuTrigger_OPEN");
        }
      }

      return {
        init: function init() {
          if (window.innerWidth < 991) {
            $(".menuModal").css('height', menuHeight); // Меню для мобильных

            $(".menuTrigger").each(function () {
              $($(this).attr('href')).css('height', 0);
            });
          }

          $(".menuTrigger").click(function (e) {
            var $this = $(this),
                href = $this.attr("href");

            if ($this.hasClass("menuTrigger_OPEN")) {
              $body.removeClass("Site_menuOPEN");
              $(href).removeClass("menuModal_OPEN").css('height', 0);
              $this.removeClass("menuTrigger_OPEN");
            } else {
              $body.addClass("Site_menuOPEN");
              $(href).addClass("menuModal_OPEN").css('height', menuHeight);
              $this.addClass("menuTrigger_OPEN");
            }

            e.preventDefault();
          });
          $(window).on('resize', refresh);
        }
      };
    };

    menu().init();

    var search = function search() {
      var $searchLink = $('.Header-searchLink');
      return {
        init: function init() {
          $searchLink.each(function () {
            var $this = $(this);
            $this.on('click', function () {
              var $thisClick = $(this);
              $thisClick.next('.Header-search').toggleClass('Header-search_open');
            });
          });
        }
      };
    };

    search().init();

    var form = function form() {
      var $selectList = $('.selectList');
      var $input = $('.form-input, .form-textarea');
      var $form = $('.form');
      var $select = $('.form-select');
      return {
        init: function init() {
          $selectList.each(function () {
            var $this = $(this),
                $radio = $this.find('input[type="radio"]');

            function changeTitle($block, $element) {
              $block.find('.selectList-title').text($element.closest('.selectList-item').find('.selectList-text').text());
            }

            changeTitle($this, $radio.filter('[checked="checked"]'));
            $radio.on('change', function () {
              changeTitle($this, $(this));
            });
          });
          $(document).on('click', function (e) {
            var $this = $(e.target);

            if (!$this.hasClass('selectList-header')) {
              $this = $(e.target).closest('.selectList-header');
            }

            if ($this.length) {
              e.preventDefault();
              $this.closest('.selectList').toggleClass('selectList_OPEN');
            } else {
              $('.selectList').removeClass('selectList_OPEN');
            }
          }); // Валидация полей

          $input.on('blur', function () {
            var $this = $(this),
                validate = $this.data('validate'),
                message = '',
                error = false;
            validate = validate.split(' ');
            validate.forEach(function (v) {
              switch (v) {
                case 'require':
                  if (!$this.val()) {
                    message = 'Это поле обязательно для заполнения. ';
                    error = true;
                  }

                  break;

                case 'pay':
                  var val = $this.val().replace(' ', '');
                  val = val + '';

                  if (parseFloat(val) % 2 !== 0) {
                    message += 'Номер должен быть четным. ';
                    error = true;
                  }

                  break;
              }

              if (error) {
                if ($this.hasClass('form-input')) {
                  $this.addClass('form-input_error');
                }

                if ($this.hasClass('form-textarea')) {
                  $this.addClass('form-textarea_error');
                }

                if (!$this.next('.form-error').length) {
                  $this.after('<div class="form-error">' + message + '</div>');
                }

                $this.data('errorinput', true);
              } else {
                $this.next('.form-error').remove();
                $this.removeClass('form-input_error');
                $this.removeClass('form-textarea_error');
                $this.data('errorinput', false);
              }

              message = '';
            });
          });
          $form.on('submit', function (e) {
            var $this = $(this),
                $validate = $this.find('[data-validate]');
            $validate.each(function () {
              var $this = $(this);
              $this.trigger('blur');

              if ($this.data('errorinput')) {
                e.preventDefault();
              }
            });
          });
          $select.wrap('<div class="form-selectWrap"></div>');
          $('[data-mask]').each(function () {
            var $this = $(this);
            $this.mask($this.data('mask'), {
              placeholder: 'x'
            });
          });
        }
      };
    };

    form().init();

    var modal = function modal() {
      var $trigger = $('.trigger'),
          $body = $('body'),
          $modal = $('.modal');
      var template = {
        img: function img(_img) {
          return '<div class="modal">' + '<div class="modal-window">' + '<a href="#" class="modal-close fa fa-close"></a>' + '<img src="' + _img + '" />' + '</div>' + '</div>';
        }
      };
      return {
        refresh: function refresh() {},
        init: function init() {
          function modalClick(e) {
            var $target = $(e.target),
                $this = $(this);

            if ($target.hasClass('modal-close')) {
              $target = $this;
            }

            if ($this.is($target)) {
              e.preventDefault();
              $body.removeClass("Site_modalOPEN");
              $this.removeClass("modal_OPEN");
              $('[href="' + $this.attr('id') + '"]').removeClass("trigger_OPEN");
            }
          }

          $trigger.click(function (e) {
            e.preventDefault();
            var $this = $(this),
                href = $this.attr("href"),
                $href = $(href);

            if (!$(href).length) {
              var $img = $(template.img($this.data('src')));
              $img.attr('id', href.replace('#', ''));
              $body.append($img);
              $href = $(href);
              $modal = $modal.add($href);
              $href.click(modalClick);
            }

            $href.addClass("modal_OPEN");
            $body.addClass("Site_modalOPEN");
            $this.addClass("trigger_OPEN");
          });
          $modal.click(modalClick);
        }
      };
    };

    modal().init();

    var range = function range() {
      return {
        init: function init() {
          var $range = $('.range'),
              $line = $range.find('.range-line');
          $line.ionRangeSlider({
            onStart: function onStart(data) {
              $('.rangePrice').text('$' + data.from + ' - $' + data.to);
            },
            onChange: function onChange(data) {
              $('.rangePrice').text('$' + data.from + ' - $' + data.to);
            }
          });
        }
      };
    };

    range().init();

    var table = function table() {
      return {
        init: function init() {}
      };
    };

    table().init(); //END

    var PanelAdd = function PanelAdd() {
      return {
        init: function init() {}
      };
    };

    PanelAdd().init();

    var ControlPanel = function ControlPanel() {
      return {
        init: function init() {}
      };
    };

    ControlPanel().init();

    var Slider = function Slider() {
      var $block = $('.Slider').not('.Slider_carousel'),
          $container = $block.children('.Slider-box'),
          $carousel = $('.Slider_carousel'),
          $containerCar = $carousel.children('.Slider-box');
      return {
        init: function init() {
          $container.each(function () {
            var $this = $(this);
            var $navigate = $this.closest($block).find('.Slider-navigate');
            $this.slick({
              dots: true,
              arrows: true,
              autoplay: true,
              appendArrows: $navigate,
              appendDots: $navigate,
              autoplaySpeed: 3000
            });
          });
          $containerCar.each(function () {
            var $this = $(this);
            var $navigate = $this.closest($carousel).find('.Slider-navigate');

            if ($this.hasClass('Cards_hz')) {
              $this.slick({
                appendArrows: $navigate,
                appendDots: $navigate,
                dots: true,
                arrows: true,
                slidesToShow: 3,
                slidesToScroll: 2,
                responsive: [{
                  breakpoint: 1600,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                  }
                }, {
                  breakpoint: 900,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                }]
              });
            } else {
              $this.slick({
                appendArrows: $navigate,
                appendDots: $navigate,
                dots: true,
                arrows: true,
                slidesToShow: 4,
                slidesToScroll: 2,
                responsive: [{
                  breakpoint: 1600,
                  settings: {
                    slidesToShow: 3,
                    slidesToScroll: 2
                  }
                }, {
                  breakpoint: 1230,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                  }
                }, {
                  breakpoint: 570,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                }]
              });
            }
          });
        }
      };
    };

    Slider().init();

    var CartBlock = function CartBlock() {
      return {
        init: function init() {}
      };
    };

    CartBlock().init();

    var CategoriesButton = function CategoriesButton() {
      return {
        init: function init() {
          $(document).on('click', function (e) {
            var $this = $(e.target);

            if ($this.is('a.CategoriesButton-arrow') && $this.closest('.CategoriesButton-link').length) {
              e.preventDefault();

              if ($this.next('.CategoriesButton-submenu').is(':visible')) {
                $('.CategoriesButton .CategoriesButton-submenu').hide(0);
              } else {
                $('.CategoriesButton .CategoriesButton-submenu').hide(0);
                $this.next('.CategoriesButton-submenu').show(0);
              }
            } else {
              if (!$this.hasClass('CategoriesButton-title')) {
                $this = $(e.target).closest('.CategoriesButton-title');
              }

              if ($this.length) {
                e.preventDefault();
                $this.closest('.CategoriesButton').toggleClass('CategoriesButton_OPEN');
              } else {
                $('.CategoriesButton').removeClass('CategoriesButton_OPEN');
                $('.CategoriesButton .CategoriesButton-submenu').hide(0);
              }
            }
          });
        }
      };
    };

    CategoriesButton().init();

    var Middle = function Middle() {
      return {
        init: function init() {}
      };
    };

    Middle().init();

    var Section = function Section() {
      return {
        init: function init() {}
      };
    };

    Section().init();

    var BannersHome = function BannersHome() {
      return {
        init: function init() {}
      };
    };

    BannersHome().init();

    var Card = function Card() {
      return {
        init: function init() {}
      };
    };

    Card().init();

    var CountDown = function CountDown() {
      var $blocks = $('.CountDown');

      function getTimeRemaining(endtime) {
        endtime = endtime.split(' ');
        var date = endtime[0].split('.');
        var time = endtime[1].split(':');
        var t = new Date(date[2], date[1] - 1, date[0] - 1, time[0], time[1]) - new Date();
        var seconds = Math.floor(t / 1000 % 60);
        var minutes = Math.floor(t / 1000 / 60 % 60);
        var hours = Math.floor(t / (1000 * 60 * 60) % 24);
        var days = Math.floor(t / (1000 * 60 * 60 * 24));
        return {
          'total': t,
          'days': days,
          'hours': hours,
          'minutes': minutes,
          'seconds': seconds
        };
      }

      function initializeClock(clock, endtime) {
        function updateClock() {
          var t = getTimeRemaining(endtime);
          clock.find('.CountDown-days').text(t.days);
          clock.find('.CountDown-hours').text(t.hours);
          clock.find('.CountDown-minutes').text(t.minutes);
          clock.find('.CountDown-secs').text(t.seconds);

          if (t.total <= 0) {
            clearInterval(timeinterval);
          }
        }

        updateClock();
        var timeinterval = setInterval(updateClock, 1000);
      }

      return {
        init: function init() {
          $blocks.each(function () {
            var $this = $(this);
            initializeClock($this, $this.data('date'));
          });
        }
      };
    };

    CountDown().init();

    var Rating = function Rating() {
      return {
        init: function init() {
          $('.Rating_input:not(.Rating_inputClick)').on('click', function () {
            $(this).addClass('Rating_inputClick');
          });
        }
      };
    };

    Rating().init();

    var Choice = function Choice() {
      return {
        init: function init() {}
      };
    };

    Choice().init();

    var Map = function Map() {
      return {
        init: function init() {}
      };
    };

    Map().init();

    var Pagination = function Pagination() {
      return {
        init: function init() {}
      };
    };

    Pagination().init();

    var Sort = function Sort() {
      return {
        init: function init() {}
      };
    };

    Sort().init();

    var Compare = function Compare() {
      var $compare = $('.Compare');
      var $products = $compare.find('.Compare-products');
      var $checkDifferent = $('.Compare-checkDifferent input');
      return {
        init: function init() {
          $products.on('scroll', function () {
            var $this = $(this);
            $products.each(function () {
              $(this)[0].scrollLeft = $this[0].scrollLeft;
            });
          });
          $checkDifferent.on('change', function () {
            var $this = $(this),
                $rowsHide = $this.closest($compare).find('.Compare-row_hide');

            if ($this.prop('checked')) {
              $rowsHide.hide(0);
            } else {
              $rowsHide.show(0);
            }
          });
          $checkDifferent.trigger('change');
        }
      };
    };

    Compare().init();

    var Sort = function Sort() {
      return {
        init: function init() {}
      };
    };

    Sort().init();

    var NavigateProfile = function NavigateProfile() {
      return {
        init: function init() {}
      };
    };

    NavigateProfile().init();

    var Profile = function Profile() {
      var $avatar = $('.Profile-avatar');
      return {
        init: function init() {
          var $avatarfile = $avatar.find('.Profile-file');

          function readURL(input) {
            if (input.files && input.files[0]) {
              var file = input.files[0],
                  ext = 'неизвестно';
              ext = file.name.split('.').pop();

              if (ext === 'png' || ext === 'jpg' || ext === 'gif') {
                var reader = new FileReader();

                reader.onload = function (e) {
                  $(input).closest($avatar).find('.Profile-img img').attr('src', e.target.result);
                };

                reader.readAsDataURL(file);
                return true;
              }

              return false;
            }
          }

          $avatarfile.change(function () {
            var $thisAvatar = $(this).closest($avatar);

            if (readURL(this)) {
              $thisAvatar.removeClass('Profile-avatar_noimg');
              $thisAvatar.next('.form-error').remove();
              $thisAvatar.find('input[type="file"]').data('errorinput', false);
            } else {
              if (!$thisAvatar.next('.form-error').length) {
                $thisAvatar.find('input[type="file"]').data('errorinput', true);
                $thisAvatar.after('<div class="form-error">Для загрузки допустимы лишь картинки с расширением png, jpg, gif</div>');
              }
            }

            ;
          });
        }
      };
    };

    Profile().init();

    var Cart = function Cart() {
      return {
        init: function init() {}
      };
    };

    Cart().init();

    var Amount = function Amount() {
      var $amount = $('.Amount');
      var $add = $('.Amount-add');
      var $input = $('.Amount-input');
      var $remove = $('.Amount-remove');
      return {
        init: function init() {
          $add.on('click', function (e) {
            e.preventDefault();
            var $inputThis = $(this).siblings($input).filter($input);
            var value = parseFloat($inputThis.val());
            $inputThis.val(value + 1);
          });
          $remove.on('click', function (e) {
            e.preventDefault();
            var $inputThis = $(this).siblings($input).filter($input);
            var value = parseFloat($inputThis.val());
            $inputThis.val(value > 0 ? value - 1 : 0);
          });
        }
      };
    };

    Amount().init();

    var Order = function Order() {
      var $next = $('.Order-next'),
          $blocks = $('.Order-block'),
          $navigate = $('.Order-navigate');
      return {
        init: function init() {
          $next.add($navigate.find('.menu-link')).on('click', function (e) {
            e.preventDefault();
            var $this = $(this),
                href = $this.attr('href'),
                error = false,
                $validate = $this.closest($blocks).find('[data-validate]');

            if ($(e.target).is('.Order-next')) {
              $validate.each(function () {
                var $this = $(this);
                $this.trigger('blur');

                if ($this.data('errorinput')) {
                  error = true;
                }
              });
            }

            if (error === false && ($(e.target).is('.Order-next') || $blocks.index($(href)) < $blocks.index($blocks.filter('.Order-block_OPEN')))) {
              $blocks.removeClass('Order-block_OPEN');
              $(href).addClass('Order-block_OPEN');
              $navigate.find('.menu-item').removeClass('menu-item_ACTIVE');
              $navigate.find('.menu-link[href="' + href + '"]').closest('.menu-item').addClass('menu-item_ACTIVE');
            }
          });
        }
      };
    };

    Order().init();

    var Account = function Account() {
      return {
        init: function init() {}
      };
    };

    Account().init();

    var Payment = function Payment() {
      return {
        init: function init() {
          $('.Payment-generate').on('click', function (e) {
            var $this = $(this),
                $bill = $this.closest('.Payment').find('.Payment-bill'),
                billNumber = '';
            e.preventDefault();

            do {
              billNumber = Math.random() + '';
              billNumber = billNumber.slice(-9, -1);
            } while (parseFloat(billNumber) % 2 !== 0);

            billNumber = billNumber.slice(0, 4) + ' ' + billNumber.slice(4, 8);
            $bill.val(billNumber);
          });
          $('.Payment-pay .btn').on('click', function (e) {
            var $this = $(this),
                $validate = $this.closest('.form').find('[data-validate]');
            $validate.each(function () {
              var $this = $(this);
              $this.trigger('blur');

              if ($this.data('errorinput')) {
                e.preventDefault();
              }
            });
          });
        }
      };
    };

    Payment().init();

    var Tabs = function Tabs() {
      var $tabs = $('.Tabs');
      var $tabsLink = $('.Tabs-link');
      var $tabsBlock = $('.Tabs-block');
      return {
        init: function init() {
          // var $steps = $('.Tabs_steps');
          // var $step = $steps.find($tabsLink).not($steps.find($tabs).find($tabsLink));
          // var $blocks = $steps.find($tabsBlock).not($steps.find($tabs).find($tabsBlock));
          // $blocks.hide(0);
          // var href = $step.eq(0).attr('href');
          // var $active = $(href);
          // var $links= $step.add($step.siblings($tabsLink));
          // $links.removeClass('Tabs-link_ACTIVE');
          // $step.eq(0).addClass('Tabs-link_ACTIVE');
          // $active.show(0);
          $tabsLink.on('click', function (e) {
            var $this = $(this);
            var href = $this.attr('href');

            if (href[0] === "#") {
              e.preventDefault();
              var $parent = $this.closest($tabs);

              if ($parent.hasClass('Tabs_steps')) {} else {
                var $blocks = $parent.find($tabsBlock).not($parent.find($tabs).find($tabsBlock));
                var $links = $this.add($this.siblings($tabsLink));
                var $active = $(href);
                $links.removeClass('Tabs-link_ACTIVE');
                $this.addClass('Tabs-link_ACTIVE');
                $blocks.hide(0);
                $active.show(0);
              }
            }
          });
          $('.TabsLink').on('click', function (e) {
            var $this = $(this);
            var href = $this.attr('href');
            var $active = $(href);
            var $parent = $active.closest($tabs);

            if ($parent.hasClass('Tabs_steps')) {} else {
              var $blocks = $parent.find($tabsBlock).not($parent.find($tabs).find($tabsBlock));
              var $link = $('.Tabs-link[href="' + href + '"]');
              var $links = $link.add($link.siblings($tabsLink));
              $links.removeClass('Tabs-link_ACTIVE');
              $link.addClass('Tabs-link_ACTIVE');
              $blocks.hide(0);
              $active.show(0);
            }
          });
          $tabsLink.filter('.Tabs-link_ACTIVE').trigger('click');
        }
      };
    };

    Tabs().init(); // setTimeout(function(){
    //     $('body').css('opacity', '1');
    // }, 100);

    var ProductCard = function ProductCard() {
      var $picts = $('.ProductCard-pict');
      var $photo = $('.ProductCard-photo');
      return {
        init: function init() {
          $picts.on('click', function (e) {
            e.preventDefault();
            var $this = $(this);
            var href = $this.attr('href');
            $photo.empty();
            $photo.append('<img src="' + href + '" />');
            $picts.removeClass('ProductCard-pict_ACTIVE');
            $this.addClass('ProductCard-pict_ACTIVE');
          });
        }
      };
    };

    ProductCard().init();

    var Comments = function Comments() {
      return {
        init: function init() {
          $('[data-action="comments-show"]').on('click', function (e) {
            e.preventDefault();
            var $this = $(this),
                text = $this.data('text-alt'),
                $comments = $this.prev('.Comments').find('.Comments-wrap_toggle');
            $this.data('text-alt', $this.text());
            $this.text(text);
            $comments.toggleClass('Comments-wrap_HIDE');
            $('.fixScrollBlock').trigger('render.airStickyBlock');
          });
        }
      };
    };

    Comments().init();

    var Product = function Product() {
      return {
        init: function init() {}
      };
    };

    Product().init();

    var ProgressPayment = function ProgressPayment() {
      return {
        init: function init() {}
      };
    };

    ProgressPayment().init();

    var Categories = function Categories() {
      return {
        init: function init() {
          if ($(window).width() < 990) {
            var $more = $('.Categories-more'),
                $trigger = $('.Categories-trigger');
            $trigger.on('click', function (e) {
              e.preventDefault();
              var $this = $(this),
                  text = $this.data('text-alt'),
                  $block = $this.prev($more);
              $this.data('text-alt', $this.text());
              $this.text(text);
              $this.toggleClass('Categories-trigger_OPEN');
              $block.toggle(0);
            });
          }
        }
      };
    };

    Categories().init(); //ENDion.js
    //END

    var ProductReviews = function ProductReviews() {
      return {
        init: function init() {
          $('#reviewsLoadMore').on('click', function () {
            var _this = this;

            var currentPage = +$('[data-reviews-page]').attr('data-reviews-page'),
                lastPage = +$('[data-reviews-lastpage]').attr('data-reviews-lastpage'),
                nextPage = currentPage + 1,
                loadUrl = $(this).data('load-url') + "?page=".concat(nextPage),
                originalText = $(this).text();
            $(this).text('Идет загрузка...');
            $(this).addClass('reviewsLoading');
            $.get(loadUrl, function (data) {
              if (!data) {
                $(_this).remove();
                return;
              }

              $('.Comments-list').append(data);
              $(_this).text(originalText);
              $(_this).removeClass('reviewsLoading');
              $('[data-reviews-page]').attr('data-reviews-page', nextPage);

              if (lastPage === nextPage) {
                $(_this).remove();
              }
            });
          });
        }
      };
    };

    ProductReviews().init();
  });
})(jQuery);

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ "use strict";
/******/ 
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["/assets/js/vendor"], () => (__webpack_exec__("./resources/js/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
=======
(self.webpackChunk=self.webpackChunk||[]).push([[449],{80:(e,t,i)=>{i(689)},689:(e,t,i)=>{window.$=window.jQuery=i(755),i(268),i(569),i(892),i(334),i(154),i(963)},963:()=>{"use strict";var e;(e=jQuery)((function(){var t,i,n,a,s,r,o,l,c,d,u,f,h,g,m,v,p,C,k,_,w,b,T,P,x;(function(){var t=e(".menu_main");t.css("position","absolute");var i=e(".menu_main").outerHeight();t.css("position","static");var n=e("body");function a(){window.innerWidth<991?(e(".menuModal").css("height",0),t.css("position","absolute"),i=e(".menu_main").outerHeight(),t.css("position","static")):(i=e(".menu_main").outerHeight(),e(".menuModal").removeClass("menuModal_OPEN").css("height",""),n.removeClass("Site_menuOPEN"),e(".menuTrigger").removeClass("menuTrigger_OPEN"))}return{init:function(){window.innerWidth<991&&(e(".menuModal").css("height",i),e(".menuTrigger").each((function(){e(e(this).attr("href")).css("height",0)}))),e(".menuTrigger").click((function(t){var a=e(this),s=a.attr("href");a.hasClass("menuTrigger_OPEN")?(n.removeClass("Site_menuOPEN"),e(s).removeClass("menuModal_OPEN").css("height",0),a.removeClass("menuTrigger_OPEN")):(n.addClass("Site_menuOPEN"),e(s).addClass("menuModal_OPEN").css("height",i),a.addClass("menuTrigger_OPEN")),t.preventDefault()})),e(window).on("resize",a)}}})().init(),(t=e(".Header-searchLink"),{init:function(){t.each((function(){e(this).on("click",(function(){e(this).next(".Header-search").toggleClass("Header-search_open")}))}))}}).init(),(i=e(".selectList"),n=e(".form-input, .form-textarea"),a=e(".form"),s=e(".form-select"),{init:function(){i.each((function(){var t=e(this),i=t.find('input[type="radio"]');function n(e,t){e.find(".selectList-title").text(t.closest(".selectList-item").find(".selectList-text").text())}n(t,i.filter('[checked="checked"]')),i.on("change",(function(){n(t,e(this))}))})),e(document).on("click",(function(t){var i=e(t.target);i.hasClass("selectList-header")||(i=e(t.target).closest(".selectList-header")),i.length?(t.preventDefault(),i.closest(".selectList").toggleClass("selectList_OPEN")):e(".selectList").removeClass("selectList_OPEN")})),n.on("blur",(function(){var t=e(this),i=t.data("validate"),n="",a=!1;(i=i.split(" ")).forEach((function(e){switch(e){case"require":t.val()||(n="Это поле обязательно для заполнения. ",a=!0);break;case"pay":var i=t.val().replace(" ","");i+="",parseFloat(i)%2!=0&&(n+="Номер должен быть четным. ",a=!0)}a?(t.hasClass("form-input")&&t.addClass("form-input_error"),t.hasClass("form-textarea")&&t.addClass("form-textarea_error"),t.next(".form-error").length||t.after('<div class="form-error">'+n+"</div>"),t.data("errorinput",!0)):(t.next(".form-error").remove(),t.removeClass("form-input_error"),t.removeClass("form-textarea_error"),t.data("errorinput",!1)),n=""}))})),a.on("submit",(function(t){e(this).find("[data-validate]").each((function(){var i=e(this);i.trigger("blur"),i.data("errorinput")&&t.preventDefault()}))})),s.wrap('<div class="form-selectWrap"></div>'),e("[data-mask]").each((function(){var t=e(this);t.mask(t.data("mask"),{placeholder:"x"})}))}}).init(),(r=e(".trigger"),o=e("body"),l=e(".modal"),c=function(e){return'<div class="modal"><div class="modal-window"><a href="#" class="modal-close fa fa-close"></a><img src="'+e+'" /></div></div>'},{refresh:function(){},init:function(){function t(t){var i=e(t.target),n=e(this);i.hasClass("modal-close")&&(i=n),n.is(i)&&(t.preventDefault(),o.removeClass("Site_modalOPEN"),n.removeClass("modal_OPEN"),e('[href="'+n.attr("id")+'"]').removeClass("trigger_OPEN"))}r.click((function(i){i.preventDefault();var n=e(this),a=n.attr("href"),s=e(a);if(!e(a).length){var r=e(c(n.data("src")));r.attr("id",a.replace("#","")),o.append(r),s=e(a),l=l.add(s),s.click(t)}s.addClass("modal_OPEN"),o.addClass("Site_modalOPEN"),n.addClass("trigger_OPEN")})),l.click(t)}}).init(),e(".range").find(".range-line").ionRangeSlider({onStart:function(t){e(".rangePrice").text("$"+t.from+" - $"+t.to)},onChange:function(t){e(".rangePrice").text("$"+t.from+" - $"+t.to)}}),(d=e(".Slider").not(".Slider_carousel"),u=d.children(".Slider-box"),f=e(".Slider_carousel"),h=f.children(".Slider-box"),{init:function(){u.each((function(){var t=e(this),i=t.closest(d).find(".Slider-navigate");t.slick({dots:!0,arrows:!0,autoplay:!0,appendArrows:i,appendDots:i,autoplaySpeed:3e3})})),h.each((function(){var t=e(this),i=t.closest(f).find(".Slider-navigate");t.hasClass("Cards_hz")?t.slick({appendArrows:i,appendDots:i,dots:!0,arrows:!0,slidesToShow:3,slidesToScroll:2,responsive:[{breakpoint:1600,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:900,settings:{slidesToShow:1,slidesToScroll:1}}]}):t.slick({appendArrows:i,appendDots:i,dots:!0,arrows:!0,slidesToShow:4,slidesToScroll:2,responsive:[{breakpoint:1600,settings:{slidesToShow:3,slidesToScroll:2}},{breakpoint:1230,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:570,settings:{slidesToShow:1,slidesToScroll:1}}]})}))}}).init(),e(document).on("click",(function(t){var i=e(t.target);i.is("a.CategoriesButton-arrow")&&i.closest(".CategoriesButton-link").length?(t.preventDefault(),i.next(".CategoriesButton-submenu").is(":visible")?e(".CategoriesButton .CategoriesButton-submenu").hide(0):(e(".CategoriesButton .CategoriesButton-submenu").hide(0),i.next(".CategoriesButton-submenu").show(0))):(i.hasClass("CategoriesButton-title")||(i=e(t.target).closest(".CategoriesButton-title")),i.length?(t.preventDefault(),i.closest(".CategoriesButton").toggleClass("CategoriesButton_OPEN")):(e(".CategoriesButton").removeClass("CategoriesButton_OPEN"),e(".CategoriesButton .CategoriesButton-submenu").hide(0)))})),function(){var t=e(".CountDown");function i(e,t){function i(){var i=function(e){var t=(e=e.split(" "))[0].split("."),i=e[1].split(":"),n=new Date(t[2],t[1]-1,t[0]-1,i[0],i[1])-new Date,a=Math.floor(n/1e3%60),s=Math.floor(n/1e3/60%60),r=Math.floor(n/36e5%24);return{total:n,days:Math.floor(n/864e5),hours:r,minutes:s,seconds:a}}(t);e.find(".CountDown-days").text(i.days),e.find(".CountDown-hours").text(i.hours),e.find(".CountDown-minutes").text(i.minutes),e.find(".CountDown-secs").text(i.seconds),i.total<=0&&clearInterval(n)}i();var n=setInterval(i,1e3)}return{init:function(){t.each((function(){var t=e(this);i(t,t.data("date"))}))}}}().init(),e(".Rating_input:not(.Rating_inputClick)").on("click",(function(){e(this).addClass("Rating_inputClick")})),(g=e(".Compare"),m=g.find(".Compare-products"),v=e(".Compare-checkDifferent input"),{init:function(){m.on("scroll",(function(){var t=e(this);m.each((function(){e(this)[0].scrollLeft=t[0].scrollLeft}))})),v.on("change",(function(){var t=e(this),i=t.closest(g).find(".Compare-row_hide");t.prop("checked")?i.hide(0):i.show(0)})),v.trigger("change")}}).init(),(p=e(".Profile-avatar"),{init:function(){p.find(".Profile-file").change((function(){var t=e(this).closest(p);!function(t){if(t.files&&t.files[0]){var i,n=t.files[0];if("png"===(i=n.name.split(".").pop())||"jpg"===i||"gif"===i){var a=new FileReader;return a.onload=function(i){e(t).closest(p).find(".Profile-img img").attr("src",i.target.result)},a.readAsDataURL(n),!0}return!1}}(this)?t.next(".form-error").length||(t.find('input[type="file"]').data("errorinput",!0),t.after('<div class="form-error">Для загрузки допустимы лишь картинки с расширением png, jpg, gif</div>')):(t.removeClass("Profile-avatar_noimg"),t.next(".form-error").remove(),t.find('input[type="file"]').data("errorinput",!1))}))}}).init(),function(){e(".Amount");var t=e(".Amount-add"),i=e(".Amount-input"),n=e(".Amount-remove");return{init:function(){t.on("click",(function(t){t.preventDefault();var n=e(this).siblings(i).filter(i),a=parseFloat(n.val());n.val(a+1)})),n.on("click",(function(t){t.preventDefault();var n=e(this).siblings(i).filter(i),a=parseFloat(n.val());n.val(a>0?a-1:0)}))}}}().init(),(C=e(".Order-next"),k=e(".Order-block"),_=e(".Order-navigate"),{init:function(){C.add(_.find(".menu-link")).on("click",(function(t){t.preventDefault();var i=e(this),n=i.attr("href"),a=!1,s=i.closest(k).find("[data-validate]");e(t.target).is(".Order-next")&&s.each((function(){var t=e(this);t.trigger("blur"),t.data("errorinput")&&(a=!0)})),!1===a&&(e(t.target).is(".Order-next")||k.index(e(n))<k.index(k.filter(".Order-block_OPEN")))&&(k.removeClass("Order-block_OPEN"),e(n).addClass("Order-block_OPEN"),_.find(".menu-item").removeClass("menu-item_ACTIVE"),_.find('.menu-link[href="'+n+'"]').closest(".menu-item").addClass("menu-item_ACTIVE"))}))}}).init(),e(".Payment-generate").on("click",(function(t){var i=e(this).closest(".Payment").find(".Payment-bill"),n="";t.preventDefault();do{n=(n=Math.random()+"").slice(-9,-1)}while(parseFloat(n)%2!=0);n=n.slice(0,4)+" "+n.slice(4,8),i.val(n)})),e(".Payment-pay .btn").on("click",(function(t){e(this).closest(".form").find("[data-validate]").each((function(){var i=e(this);i.trigger("blur"),i.data("errorinput")&&t.preventDefault()}))})),(w=e(".Tabs"),b=e(".Tabs-link"),T=e(".Tabs-block"),{init:function(){b.on("click",(function(t){var i=e(this),n=i.attr("href");if("#"===n[0]){t.preventDefault();var a=i.closest(w);if(a.hasClass("Tabs_steps"));else{var s=a.find(T).not(a.find(w).find(T)),r=i.add(i.siblings(b)),o=e(n);r.removeClass("Tabs-link_ACTIVE"),i.addClass("Tabs-link_ACTIVE"),s.hide(0),o.show(0)}}})),e(".TabsLink").on("click",(function(t){var i=e(this).attr("href"),n=e(i),a=n.closest(w);if(a.hasClass("Tabs_steps"));else{var s=a.find(T).not(a.find(w).find(T)),r=e('.Tabs-link[href="'+i+'"]');r.add(r.siblings(b)).removeClass("Tabs-link_ACTIVE"),r.addClass("Tabs-link_ACTIVE"),s.hide(0),n.show(0)}})),w.each((function(){e(this).find(b).eq(0).trigger("click")}))}}).init(),(P=e(".ProductCard-pict"),x=e(".ProductCard-photo"),{init:function(){P.on("click",(function(t){t.preventDefault();var i=e(this),n=i.attr("href");x.empty(),x.append('<img src="'+n+'" />'),P.removeClass("ProductCard-pict_ACTIVE"),i.addClass("ProductCard-pict_ACTIVE")}))}}).init(),e('[data-action="comments-show"]').on("click",(function(t){t.preventDefault();var i=e(this),n=i.data("text-alt"),a=i.prev(".Comments").find(".Comments-wrap_toggle");i.data("text-alt",i.text()),i.text(n),a.toggleClass("Comments-wrap_HIDE"),e(".fixScrollBlock").trigger("render.airStickyBlock")})),function(){if(e(window).width()<990){var t=e(".Categories-more");e(".Categories-trigger").on("click",(function(i){i.preventDefault();var n=e(this),a=n.data("text-alt"),s=n.prev(t);n.data("text-alt",n.text()),n.text(a),n.toggleClass("Categories-trigger_OPEN"),s.toggle(0)}))}}()}))},230:()=>{}},e=>{"use strict";var t=t=>e(e.s=t);e.O(0,[430,931],(()=>(t(80),t(230))));e.O()}]);
>>>>>>> release_ver3

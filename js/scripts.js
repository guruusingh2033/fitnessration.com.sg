function orderNow() {
    var wrapperEl = $('<div id="welcome-back-wrapper" />').append($('#orderTmpl').html()).appendTo(document.body);
    wrapperEl.find('.close').click(function() {
        wrapperEl.remove();
    });
}
function showPopup(opts) {
  if (opts.showClose == undefined) opts.showClose = true;
  var el = $($('#popupTemplate').html());
  function close() {
    el.remove();
  }
  if (opts.showClose) {
    el.find('.popup__close').click(function() {
      close();
      return false;
    });    
  }
  else {
    el.find('.popup__close').remove();
  }
  el.addClass(opts.type);
  if (opts.type == 'basic-popup-with-title') {
    el.find('.popup__title').html(opts.title);
  }
  el.find('.popup__content').append($(opts.content));
  if (opts.class) {
    el.find('.popup__content').addClass(opts.class);
  }
  if (opts.id) {
    el.find('.popup__content').attr('id', opts.id);
  }
  $('body').append(el);
  if (opts.init) {
    opts.init({el:el, clientEl:el.find('.popup__content'), close:close});
  }


  return {el:el, clientEl:el.find('.popup__content'), close:close};
}

$(document).ready(function(){

    /* scroll to first content section when click arrow */

    var scroll = $('a.scroll').first();
    var headerheight = $('header').height();
    var landingsection = $('header + section');
    var targetsection;

    if (landingsection.length) {
        targetsection = $('main > section').eq(0);
    }
    else {
        targetsection = $('main > section').eq(1);
    }


    scroll.on("click", function(event) {
        event.preventDefault();

        if(targetsection.length) {
            $("html, body").animate({
                scrollTop: targetsection.offset().top - headerheight
            }, 1000);
        }
    });


    /* toggle lean/heavy tabs and him/her tabs */

    // var leantab = $('.tabs h3[data-tab-title="lean"]');
    // var heavytab = $('.tabs h3[data-tab-title="heavy"]');
    // var leancontent = $('div[data-tab-content="lean"]');
    // var heavycontent = $('div[data-tab-content="heavy"]');
    // var hertab = $('.tabs h3.her');
    // var himtab = $('.tabs h3.him');

    // function toggleTabHeadings(activeHeading) {
    //     activeHeading.addClass('active');
    //     activeHeading.siblings('.active').removeClass('active');
    // }

    // function toggleTabContent(activeContent) {
    //     activeContent.siblings('.tabcontent').addClass('hidden');
    //     activeContent.removeClass('hidden');
    // }

    // leantab.click(function() {
    //     if ( !$(this).hasClass('active') ) {
    //         toggleTabHeadings($(this));
    //         toggleTabContent(leancontent);
    //     }
    // });

    // heavytab.click(function() {
    //     if ( !$(this).hasClass('active') ) {
    //         toggleTabHeadings($(this));
    //         toggleTabContent(heavycontent);
    //     }
    // });

    // hertab.click(function() {
    //     if ( !$(this).hasClass('active') ) {
    //         toggleTabHeadings($(this));
    //     }
    // });

    // himtab.click(function() {
    //     if ( !$(this).hasClass('active') ) {
    //         toggleTabHeadings($(this));
    //     }
    // });

    /* filter sections by select dropdown */

    $('select').change(function() {
        var selectedVal = $(this).val();
        var categories = $('.filter-container').children('section');
        if (selectedVal == 'all') {
            categories.each(function() {
                $(this).show();
            });
            return;
        }
        categories.each(function() {
            if ( $(this).attr('data-category') == selectedVal ) {
                $(this).show();
            }
            else {
                $(this).hide();
            }
        });
    });


    /* select elements custom styling */
    // from http://jsfiddle.net/BB3JK/47/
    // modified to hide currently selected item from list

    $('select').each(function () {

        var $this = $(this),
            numberOfOptions = $(this).children('option').length;

        $this.addClass('s-hidden');

        $this.wrap('<div class="select"></div>');

        $this.after('<div class="styledSelect"></div>');

        var $styledSelect = $this.next('div.styledSelect');

        $styledSelect.text($this.children('option').eq(0).text());

        var $list = $('<ul />', {
            'class': 'options'
        }).insertAfter($styledSelect);

        for (var i = 0; i < numberOfOptions; i++) {
            $('<li />', {
                text: $this.children('option').eq(i).text(),
                rel: $this.children('option').eq(i).val()
            }).appendTo($list);
        }

        var $listItems = $list.children('li');
        var $listItemIndices = [];
        var $prevSelectedLi,
            $prevSelectedIndex;

        $listItems.each(function() {
            $listItemIndices[$(this).text()] = $(this).index();
        });

        $listItems.eq(0).appendTo($list).hide();
        $prevSelectedLi = $listItems.eq(0);

        $styledSelect.click(function (e) {
            e.stopPropagation();
            $('div.styledSelect.active').each(function () {
                $(this).removeClass('active').next('ul.options').hide();
            });
            $(this).toggleClass('active').next('ul.options').toggle();
        });

        $listItems.click(function (e) {
            e.stopPropagation();
            $styledSelect.text($(this).text()).removeClass('active');
            $this.val($(this).attr('rel'));
            $list.hide();
            if ($prevSelectedLi) {
                $prevSelectedIndex = $listItemIndices[$prevSelectedLi.text()];

                if ($prevSelectedIndex !== 0) {
                    $prevSelectedLi.insertAfter($listItems.eq($prevSelectedIndex - 1)).show();
                }
                else {
                    $prevSelectedLi.prependTo($list).show();
                }
            }
            $(this).appendTo($list).hide();
            $prevSelectedLi = $(this);

            $('select').trigger('change');
        });

        $(document).click(function () {
            $styledSelect.removeClass('active');
            $list.hide();
        });
    });


    /* accordions open/close on click */

    function playAccordion(clickedAccordion, otherAccordions) {
        if ( clickedAccordion.hasClass('active') ) {
            clickedAccordion.removeClass('active');
        }
        else {
            $(otherAccordions + '.active').removeClass('active');
            clickedAccordion.addClass('active');
        }
    }

    $('.accordion').click(function() {
        playAccordion( $(this), '.accordion' );
    });


    // Team page read more accordions
    $('.teampage .content').children('p').click(function() {
        playAccordion( $(this), '.teampage .content p' );
    });

});
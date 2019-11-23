(function($) {
  $.fn.extend({
    customResponsiveTab: function(options) {
      var options = $.extend(options);
      var opt = options,
        accord = 'accordion';

      $(this).bind('tabactivate', function(e, currentTab) {
        if (typeof options.activate === 'function') {
          options.activate.call(currentTab, e)
        }
      });

      this.each(function() {
        var cusTab = $(this);
        //console.log(cusTab);
        var cusTabList = cusTab.find('ul.tab-list');
        cusTab.find('ul.tab-list li').addClass('tab-item');
        cusTab.css("display","block");

        cusTab.find('.tabs-container > div').addClass('tab-content');
        var $tabItemh2;
        cusTab.find('.tab-content').before("<h2 class='tab-accordion' role='tab'><span class='arrow'></span></h2>");

        var itemCount = 0;
        cusTab.find('.tab-accordion').each(function() {
          //console.log(itemCount);
          $tabItemh2 = $(this);
          var innertext = cusTab.find('.tab-item:eq(' + itemCount + ')').html();
          cusTab.find('.tab-accordion:eq(' + itemCount + ')').append(innertext);
          $tabItemh2.attr('data-tab', 'tab_item-' + (itemCount));
          itemCount++;
          //console.log(itemCount);
        });

        var count = 0,
          $tabContent;
          //console.log(count);
        cusTab.find('.tab-item').each(function() {
          //console.log(count);
          $tabItem = $(this);
          $tabItem.attr('data-tab', 'tab_item-' + (count));
          $tabItem.attr('role', 'tab');
          //console.log(count);
          if (options.closed !== true && !(options.closed === 'accordion' && !cusTabList.is(':visible')) && !(options.closed === 'tabs' && cusTabList.is(':visible'))) {
            cusTab.find('.tab-item').first().addClass('tab-active');
            //console.log(count);
            cusTab.find('.tab-accordion').first().addClass('tab-active');
            cusTab.find('.tab-content').first().addClass('tab-content-active').attr('style', 'display:block');
          }

          var tabcount = 0;
          //console.log(tabcount);
          cusTab.find('.tab-content').each(function() {
            $tabContent = $(this);
            $tabContent.attr('data-tab', 'tab_item-' + (tabcount));
            tabcount++;
            //console.log(tabcount);
          });
          count++;
          //console.log(tabcount);
          //console.log(count);
        });

        cusTab.find("[role=tab]").each(function() {
          var $currentTab = $(this);
          $currentTab.click(function() {
            var $dataTab = $currentTab.attr('data-tab');
            //console.log($dataTab);
            if ($currentTab.hasClass('tab-accordion') && $currentTab.hasClass('tab-active')) {
              cusTab.find('.tab-content-active').slideUp('', function() { $(this).addClass('tab-accordion-closed'); });
              $currentTab.removeClass('tab-active');
              return false;
            }
            if (!$currentTab.hasClass('tab-active') && $currentTab.hasClass('tab-accordion')) {
              cusTab.find('.tab-active').removeClass('tab-active');
              cusTab.find('.tab-content-active').slideUp().removeClass('tab-content-active tab-accordion-closed');
              //console.log($dataTab);
              cusTab.find("[data-tab=" + $dataTab + "]").addClass('tab-active');

              cusTab.find('.tab-content[data-tab = ' + $dataTab + ']').slideDown().addClass('tab-content-active');
              //console.log($dataTab);
            } else {
              cusTab.find('.tab-active').removeClass('tab-active');
              cusTab.find('.tab-content-active').removeAttr('style').removeClass('tab-content-active').removeClass('tab-accordion-closed');
              cusTab.find("[data-tab=" + $dataTab + "]").addClass('tab-active');
              cusTab.find('.tab-content[data-tab = ' + $dataTab + ']').addClass('tab-content-active').attr('style', 'display:block');
            }
            $currentTab.trigger('tabactivate', $currentTab);
          });       

          $(window).resize(function() {
            cusTab.find('.tab-accordion-closed').removeAttr('style');
          });
        });
      });
    }
  });
})(jQuery);
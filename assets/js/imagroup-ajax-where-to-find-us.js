jQuery(document).ready(function ($) {

  'use strict';

  if (typeof IMAGroup_ajax_calls_vars !== 'undefined') {
    var ajaxURL = IMAGroup_ajax_calls_vars.admin_url + 'admin-ajax.php';

    function where_to_find_us() {
      console.log('%cAJAX: where_to_find_us', window.consoleStyling.DarkSlateGray);
      var $form = jQuery('form[name="where-to-find-us"]');

      jQuery.ajax({
        type: 'post',
        url: ajaxURL,
        dataType: 'json',
        data: $form.serialize(),
        success: function (response) {
          jQuery('.find-us-result').html(response.data);
        },
        error: function (xhr, status, error) {
          alert('An error has occurred. Please try again later.');
        }
      });
    }

    jQuery('form[name="where-to-find-us"] select[name="state"]').on('change', function () {
      console.log('%cwhere-to-find-us . state change', window.consoleStyling.DarkSlateGray);
      where_to_find_us();
    });

    jQuery('form[name="where-to-find-us"] input[name="zip"]').keyup(function (e) {
      if (e.key === "Enter") {
        e.preventDefault();
        e.stopPropagation();
      }
      else {
        console.log('%cwhere-to-find-us . zip change', window.consoleStyling.DarkSlateGray);
        where_to_find_us();
      }
    });

    jQuery('form[name="where-to-find-us"]').on('submit', function (r) {
      r.preventDefault();
      r.stopPropagation();
    })
  }
});
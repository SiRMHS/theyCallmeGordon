// Minimal JS placeholder + toast copy-to-clipboard
(function ($) {
  $(function () {
    console.log("Pharmacy Store theme active");

    // Utility: convert Western digits to Persian digits for display
    function toPersianDigits(str) {
      var map = {
        0: "۰",
        1: "۱",
        2: "۲",
        3: "۳",
        4: "۴",
        5: "۵",
        6: "۶",
        7: "۷",
        8: "۸",
        9: "۹",
      };
      return String(str)
        .split("")
        .map(function (c) {
          return map[c] || c;
        })
        .join("");
    }

    // Show a simple toast notification
    function pharmacyStoreShowToast(message, timeout) {
      timeout = timeout || 3000;
      var $container = $("#pharmacy-toast-container");
      if (!$container.length) {
        $container = $(
          '<div id="pharmacy-toast-container" aria-live="polite" aria-atomic="true"></div>'
        )
          .css({
            position: "fixed",
            right: "16px",
            bottom: "16px",
            zIndex: 99999,
          })
          .appendTo(document.body);
      }

      var $toast = $('<div class="pharmacy-toast"></div>').text(message).css({
        background: "#f0878b",
        color: "#fff",
        padding: "8px 12px",
        borderRadius: "6px",
        marginTop: "8px",
        boxShadow: "0 6px 18px rgba(0,0,0,0.12)",
        opacity: 0,
        transition: "opacity 220ms ease",
      });

      $container.append($toast);
      setTimeout(function () {
        $toast.css("opacity", 1);
      }, 20);
      setTimeout(function () {
        $toast.css("opacity", 0);
        setTimeout(function () {
          $toast.remove();
        }, 250);
      }, timeout);
    }

    // Click handler for copy buttons
    $(document).on("click", ".pharmacy-fest-copy-btn", function (e) {
      e.preventDefault();
      var code = $(this).attr("data-copy") || "";
      if (!code) return;

      if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard
          .writeText(code)
          .then(function () {
            pharmacyStoreShowToast("کد تخفیف کپی شد: " + toPersianDigits(code));
          })
          .catch(function () {
            pharmacyStoreShowToast("کپی انجام نشد");
          });
      } else {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(code).select();
        try {
          var ok = document.execCommand("copy");
          if (ok) {
            pharmacyStoreShowToast("کد تخفیف کپی شد: " + toPersianDigits(code));
          } else {
            pharmacyStoreShowToast("کپی انجام نشد");
          }
        } catch (err) {
          pharmacyStoreShowToast("کپی انجام نشد");
        }
        $temp.remove();
      }
    });
  });
})(jQuery);

function getURLVar(key) {
  var value = [];

  var query = String(document.location).split("?");

  if (query[1]) {
    var part = query[1].split("&");

    for (i = 0; i < part.length; i++) {
      var data = part[i].split("=");

      if (data[0] && data[1]) {
        value[data[0]] = data[1];
      }
    }

    if (value[key]) {
      return value[key];
    } else {
      return "";
    }
  }
}

$(document).ready(function () {
  if ($('header').length) {
    var stickyOffset = $('header').offset().top;

    $(window).scroll(function(){
      var sticky = $('header'),
          scroll = $(window).scrollTop();
    
      if (scroll >= stickyOffset && $(window).width() <= 1200) sticky.addClass('fixed');
      else sticky.removeClass('fixed');
    }); 
  }


  $('.dropdown .dropdown-name').on('click',function(){

    $(this).parent().find('.dropdown-list').slideToggle();
    $(this).find('.dropdown-name__img').toggleClass('rotate');

   
});

$('.dropdown-list .dropdown-name__img').on('click',function(){

  $(this).toggleClass('rotate');
  $(this).next().slideToggle();

 
});
  // Sidenav
  $("#sidenav").show();

  // Comaparsion table
  function toggleComparisonTbl() {
    var pos = $(this).index() + 2;
    $(".comparison-tbl tr").find("td:not(:eq(0))").hide();
    $(".comparison-tbl td:nth-child(" + pos + ")").css("display", "table-cell");
    $(".comparison-tbl tr").find("th:not(:eq(0))").hide();
    $(".comparison-tbl-tabs li").removeClass("active");
    $(this).addClass("active");
  }

  $(".comparison-tbl-tabs").on("click", "li", toggleComparisonTbl);

  // Initialize the media query
  var mediaQuery = window.matchMedia("(min-width: 900px)");

  // Add a listen event
  mediaQuery.addEventListener("change", updateSep);

  // Function to do something with the media query
  function updateSep(mediaQuery) {
    if (mediaQuery.matches) {
      $(".sep").attr("colspan", 3);
    } else {
      $(".sep").attr("colspan", 1);
    }
  }
  // On load

  updateSep(mediaQuery);

  var pos = 2;
  $(".comparison-tbl tr").find("td:not(:eq(0))").hide();
  $(".comparison-tbl td:nth-child(" + pos + ")").css("display", "table-cell");
  $(".comparison-tbl tr").find("th:not(:eq(0))").hide();
  $(".comparison-tbl-tabs li").removeClass("active");
  $(".comparison-tbl-tabs li:first").addClass("active");

  $.ajaxSetup({
    // Disable caching of AJAX responses
    cache: false,
  });

  $("#cart .dropdown-menu").click(function (e) {
    e.stopPropagation();
  });

  $(".modal-tab-toggle").click(function (e) {
    var tab = e.target.hash;
    $('#signinModal .nav-tabs a[href="' + tab + '"]').tab("show");
  });
  $("#signup-form").on("submit", function (e) {
    var form_reponse = $(this).find(".form-response"),
      form = $(this);
    $.post("/index.php?route=account/register", $(this).serialize()).done(
      function (response) {
        form_reponse.html("").addClass("hidden");
        var f_alert = "";
        if (response.error) {
          f_alert = '<div class="alert alert-danger" role="alert">';
          $.each(response.error, function (i, v) {
            f_alert += v + "<br>";
          });
          f_alert += "</div>";
          form_reponse.append(f_alert).removeClass("hidden");
        } else if (response.success) {
          window.location.replace(response.redirect);
        }
        //console.log(response);
      }
    );
    e.preventDefault();
  });

  $("#signin-form").on("submit", function (e) {
    var form_reponse = $(this).find(".form-response"),
      form = $(this);
    $.post("/index.php?route=account/login", $(this).serialize()).done(
      function (response) {
        form_reponse.html("").addClass("hidden");
        var f_alert = "";
        if (response.error) {
          f_alert = '<div class="alert alert-danger" role="alert">';
          $.each(response.error, function (i, v) {
            f_alert += v + "<br>";
          });
          f_alert += "</div>";
          form_reponse.append(f_alert).removeClass("hidden");
        } else if (response.success) {
          window.location.replace(response.redirect);
        }
        //console.log(response);
      }
    );
    e.preventDefault();
  });

  // function placeErrorModal(data, textStatus, xhr) {
  // 	if (data.error) {

  // 	}
  // 	console.log(data);
  // 	console.log(textStatus);
  // 	console.log(xhr);
  // }
  // Highlight any found errors
  $(".text-danger").each(function () {
    var element = $(this).parent().parent();

    if (element.hasClass("form-group")) {
      element.addClass("has-error");
    }
  });

  // Currency
  $("#form-currency .currency-select").on("click", function (e) {
    e.preventDefault();

    $("#form-currency input[name='code']").val($(this).attr("name"));

    $("#form-currency").submit();
  });

  // Language
  $("#form-language .language-select").on("click", function (e) {
    e.preventDefault();

    $("#form-language input[name='code']").val($(this).attr("name"));

    $("#form-language").submit();
  });

  /* Search */
  var sBtn = "#search button.btn-search",
    $sDiv = $("#search"),
    $closeS = ".close_search";

    $(document).on("click", $closeS, function(e){
      $('.navbar-form').removeClass('opened');
    });
  $(document).on("click", sBtn, function (e) {
    
    if ( $(this).closest('#search').hasClass("opened") ) {
      var url = $("base").attr("href") + "index.php?route=product/search";
      var value = $(this).closest('#search').find('input[name="search"]').val();
      if (value) {
        url += "&search=" + encodeURIComponent(value);
      }
      location = url;
    } else {
      $(this).closest('#search').addClass("opened");
      $(this).closest('#search').find('input').focus();
    }
    e.preventDefault();
  });

  $("#search.opened input[name='search']").on("keydown", function (e) {
    if (e.keyCode == 13) {
      $("#search.opened input[name='search']")
        .parent()
        .find("button")
        .trigger("click");
    }
  });
 
  // Menu
  $("#menu .dropdown-menu").each(function () {
    var menu = $("#menu").offset();
    var dropdown = $(this).parent().offset();

    var i =
      dropdown.left +
      $(this).outerWidth() -
      (menu.left + $("#menu").outerWidth());

    if (i > 0) {
      $(this).css("margin-left", "-" + (i + 10) + "px");
    }
  });

  // Product List
  $("#list-view").click(function () {
    $("#content .product-grid > .clearfix").remove();

    $("#content .row > .product-grid").attr(
      "class",
      "product-layout product-list col-xs-12"
    );
    $("#grid-view").removeClass("active");
    $("#list-view").addClass("active");

    localStorage.setItem("display", "list");
  });

  // Product Grid
  $("#grid-view").click(function () {
    // What a shame bootstrap does not take into account dynamically loaded columns
    var cols = $("#column-right, #column-left").length;

    if (cols == 2) {
      $("#content .product-list").attr(
        "class",
        "product-layout product-grid col-lg-6 col-md-6 col-sm-12 col-xs-12"
      );
    } else if (cols == 1) {
      $("#content .product-list").attr(
        "class",
        "product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12"
      );
    } else {
      $("#content .product-list").attr(
        "class",
        "product-layout product-grid col-lg-3 col-md-3 col-sm-6 col-xs-12"
      );
    }

    $("#list-view").removeClass("active");
    $("#grid-view").addClass("active");

    localStorage.setItem("display", "grid");
  });

  if (localStorage.getItem("display") == "list") {
    $("#list-view").trigger("click");
    $("#list-view").addClass("active");
  } else {
    $("#grid-view").trigger("click");
    $("#grid-view").addClass("active");
  }

  // Checkout
  $(document).on(
    "keydown",
    "#collapse-checkout-option input[name='email'], #collapse-checkout-option input[name='password']",
    function (e) {
      if (e.keyCode == 13) {
        $("#collapse-checkout-option #button-login").trigger("click");
      }
    }
  );

  // tooltips on hover
  $("[data-toggle='tooltip']").tooltip({ container: "body" });

  // Makes tooltips work on ajax generated content
  $(document).ajaxStop(function () {
    $("[data-toggle='tooltip']").tooltip({ container: "body" });
  });
});

// Cart add remove functions
var cart = {
  add: function (product_id, quantity) {
    $.ajax({
      url: "index.php?route=checkout/cart/add",
      type: "post",
      data:
        "product_id=" +
        product_id +
        "&quantity=" +
        (typeof quantity != "undefined" ? quantity : 1),
      dataType: "json",
      beforeSend: function () {
        $("#cart > button").button("loading");
      },
      complete: function () {
        $("#cart > button").button("reset");
        S;
      },
      success: function (json) {
        $(".alert-dismissible, .text-danger").remove();

        if (json["redirect"]) {
          //console.log(json);
          location = json["redirect"];
        }

        if (json["success"]) {
          $("#content")
            .parent()
            .before(
              '<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' +
                json["success"] +
                ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>'
            );

          // Need to set timeout otherwise it wont update the total
          setTimeout(function () {
            let total = parseInt(json["total"]);
            $("#cart-total").html(total);
          }, 100);

          $("html, body").animate({ scrollTop: 0 }, "slow");

          $("#mini-cart").load(
            "index.php?route=common/cart/info #mini-cart .products1, .mobile-down,.dropdown-header"
          );
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(
          thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText
        );
      },
    });
  },
  update: function (key, quantity) {
    $.ajax({
      url: "index.php?route=checkout/cart/edit",
      type: "post",
      data: "key=" + key + "&quantity=" + (typeof quantity != "undefined" ? quantity : 1),
      dataType: "json",
      beforeSend: function () {
        $("#cart > button").button("loading");
      },
      complete: function () {
        $("#cart > button").button("reset");
      },
      success: function (json) {
        // Need to set timeout otherwise it wont update the total
        setTimeout(function () {
          let total = parseInt(json["total"]);
          $("#cart-total").html(total);

          console.log(json);
        }, 100);

        if (
          getURLVar("route") == "checkout/cart" ||
          getURLVar("route") == "checkout/checkout"
        ) {
          location = "index.php?route=checkout/cart";
        } else {
          $("#mini-cart").load(
            "index.php?route=common/cart/info #mini-cart .products1, .mobile-down,.dropdown-header"
          );

        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(
          thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText
        );
      },
    });
  },
  remove: function (key, e) {
    console.log(e);
    $.ajax({
      url: "index.php?route=checkout/cart/remove",
      type: "post",
      data: "key=" + key,
      dataType: "json",
      beforeSend: function () {
        $("#cart > button").button("loading");
      },
      complete: function () {
        $("#cart > button").button("reset");
      },
      success: function (json) {
        // Need to set timeout otherwise it wont update the total
        setTimeout(function () {
          let total = parseInt(json["total"]);
          $("#cart-total").html(total);
        }, 100);

        if (
          getURLVar("route") == "checkout/cart" ||
          getURLVar("route") == "checkout/checkout"
        ) {
          location = "index.php?route=checkout/cart";
        } else {
          $("#mini-cart").load(
            "index.php?route=common/cart/info #mini-cart .products1, .mobile-down,.dropdown-header"
          );
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(
          thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText
        );
      },
    });
    e.preventDefault();
  },
};

var voucher = {
  add: function () {},
  remove: function (key) {
    $.ajax({
      url: "index.php?route=checkout/cart/remove",
      type: "post",
      data: "key=" + key,
      dataType: "json",
      beforeSend: function () {
        $("#cart > button").button("loading");
      },
      complete: function () {
        $("#cart > button").button("reset");
      },
      success: function (json) {
        // Need to set timeout otherwise it wont update the total
        setTimeout(function () {
          $("#cart > button").html(
            '<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' +
              json["total"] +
              "</span>"
          );
        }, 100);

        if (
          getURLVar("route") == "checkout/cart" ||
          getURLVar("route") == "checkout/checkout"
        ) {
          location = "index.php?route=checkout/cart";
        } else {
          $("#mini-cart").load(
            "index.php?route=common/cart/info #mini-cart > li"
          );
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(
          thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText
        );
      },
    });
  },
};

var wishlist = {
  add: function (product_id) {
    $.ajax({
      url: "index.php?route=account/wishlist/add",
      type: "post",
      data: "product_id=" + product_id,
      dataType: "json",
      success: function (json) {
        $(".alert-dismissible").remove();

        if (json["redirect"]) {
          location = json["redirect"];
        }

        if (json["success"]) {
          $("#content")
            .parent()
            .before(
              '<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' +
                json["success"] +
                ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>'
            );
        }

        $("#wishlist-total span").html(json["total"]);
        $("#wishlist-total").attr("title", json["total"]);

        $("html, body").animate({ scrollTop: 0 }, "slow");
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(
          thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText
        );
      },
    });
  },
  remove: function () {},
};

var compare = {
  add: function (product_id) {
    $.ajax({
      url: "index.php?route=product/compare/add",
      type: "post",
      data: "product_id=" + product_id,
      dataType: "json",
      success: function (json) {
        $(".alert-dismissible").remove();

        if (json["success"]) {
          $("#content")
            .parent()
            .before(
              '<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' +
                json["success"] +
                ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>'
            );

          $("#compare-total").html(json["total"]);

          $("html, body").animate({ scrollTop: 0 }, "slow");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(
          thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText
        );
      },
    });
  },
  remove: function () {},
};

/* Agree to Terms */
$(document).delegate(".agree", "click", function (e) {
  e.preventDefault();

  $("#modal-agree").remove();

  var element = this;

  $.ajax({
    url: $(element).attr("href"),
    type: "get",
    dataType: "html",
    success: function (data) {
      html = '<div id="modal-agree" class="modal">';
      html += '  <div class="modal-dialog">';
      html += '    <div class="modal-content">';
      html += '      <div class="modal-header">';
      html +=
        '        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
      html += '        <h4 class="modal-title">' + $(element).text() + "</h4>";
      html += "      </div>";
      html += '      <div class="modal-body">' + data + "</div>";
      html += "    </div>";
      html += "  </div>";
      html += "</div>";

      $("body").append(html);

      $("#modal-agree").modal("show");
    },
  });
});
// Autocomplete */
(function ($) {
  $.fn.autocomplete = function (option) {
    return this.each(function () {
      this.timer = null;
      this.items = new Array();

      $.extend(this, option);

      $(this).attr("autocomplete", "off");

      // Focus
      $(this).on("focus", function () {
        this.request();
      });

      // Blur
      $(this).on("blur", function () {
        setTimeout(
          function (object) {
            object.hide();
          },
          200,
          this
        );
      });

      // Keydown
      $(this).on("keydown", function (event) {
        switch (event.keyCode) {
          case 27: // escape
            this.hide();
            break;
          default:
            this.request();
            break;
        }
      });

      // Click
      this.click = function (event) {
        event.preventDefault();

        value = $(event.target).parent().attr("data-value");

        if (value && this.items[value]) {
          this.select(this.items[value]);
        }
      };

      // Show
      this.show = function () {
        var pos = $(this).position();

        $(this)
          .siblings("ul.dropdown-menu")
          .css({
            top: pos.top + $(this).outerHeight(),
            left: pos.left,
          });

        $(this).siblings("ul.dropdown-menu").show();
      };

      // Hide
      this.hide = function () {
        $(this).siblings("ul.dropdown-menu").hide();
      };

      // Request
      this.request = function () {
        clearTimeout(this.timer);

        this.timer = setTimeout(
          function (object) {
            object.source($(object).val(), $.proxy(object.response, object));
          },
          200,
          this
        );
      };

      // Response
      this.response = function (json) {
        html = "";

        if (json.length) {
          for (i = 0; i < json.length; i++) {
            this.items[json[i]["value"]] = json[i];
          }

          for (i = 0; i < json.length; i++) {
            if (!json[i]["category"]) {
              html +=
                '<li data-value="' +
                json[i]["value"] +
                '"><a href="#">' +
                json[i]["label"] +
                "</a></li>";
            }
          }

          // Get all the ones with a categories
          var category = new Array();

          for (i = 0; i < json.length; i++) {
            if (json[i]["category"]) {
              if (!category[json[i]["category"]]) {
                category[json[i]["category"]] = new Array();
                category[json[i]["category"]]["name"] = json[i]["category"];
                category[json[i]["category"]]["item"] = new Array();
              }

              category[json[i]["category"]]["item"].push(json[i]);
            }
          }

          for (i in category) {
            html +=
              '<li class="dropdown-header">' + category[i]["name"] + "</li>";

            for (j = 0; j < category[i]["item"].length; j++) {
              html +=
                '<li data-value="' +
                category[i]["item"][j]["value"] +
                '"><a href="#">&nbsp;&nbsp;&nbsp;' +
                category[i]["item"][j]["label"] +
                "</a></li>";
            }
          }
        }

        if (html) {
          this.show();
        } else {
          this.hide();
        }

        $(this).siblings("ul.dropdown-menu").html(html);
      };

      $(this).after('<ul class="dropdown-menu"></ul>');
      $(this)
        .siblings("ul.dropdown-menu")
        .delegate("a", "click", $.proxy(this.click, this));
    });
  };

  /* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
  function openNav() {
    const itemMain = document.getElementById("main");
    const itemSideBar = document.getElementById("sidenav");

    itemSideBar.classList.toggle("active");
    // itemSideBar.style.width = "305px";
    // itemSideBar.style.zIndex = "9999";
    // itemSideBar.style.background = "white";
    // itemMain.style.background = "#00000030";
    // itemMain.style.opacity = "0.3";
    setTimeout(() => {
        $('.menu-bag').addClass('active');
    }, 300);
    document.getElementById("onweb_chatimage_div").style.display = "none";
  }

  /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
  function closeNav() {
    const itemMain = document.getElementById("main");
    const itemSideBar = document.getElementById("sidenav");
   
      $('.menu-bag').removeClass('active');

    itemSideBar.classList.toggle("active");
    // itemSideBar.style.width = "0px";
    // itemSideBar.style.zIndex = "9999";
    // itemSideBar.style.background = "unset";
    // itemMain.style.background = "unset";
    // itemMain.style.opacity = "unset";

    document.getElementById("onweb_chatimage_div").style.display = "block";
  }
  const arrow1 = $("#arrowProduct");
  const item1 = $("#products");
  const list1 = $("#listProducts");

  let isProductOpen = false;

  item1.on("click", () => {
    if (isProductOpen) {
      isProductOpen = false;
      list1.slideDown();
      arrow1.css("transform", "rotate(180deg)");
    } else {
      isProductOpen = true;
      list1.slideUp();
      arrow1.css("transform", "rotate(0deg)");
    }
  });

  // // Function for categories
  // const arrow = $("#arrow");
  // const list = $("#categoryList");
  // let isMenuOpen = false;

  // $("#categoryNav").on("click", () => {
  //   if (isMenuOpen) {
  //     isMenuOpen = false;
  //     list.slideDown();
  //     arrow.css("transform", "rotate(180deg)");
  //   } else {
  //     isMenuOpen = true;
  //     list.slideUp();
  //     arrow.css("transform", "rotate(0deg)");
  //   }
  // });
  $(document).on("click", "#open-side-nav", function (e) {
    e.preventDefault();
    openNav();
  });
  $(document).on("click", "#close-side-nav", function (e) {
    e.preventDefault();
    closeNav();
  });
})(window.jQuery);
function closeCart() {
  $('#cart').toggleClass('open')
}

$('.menu-top__search').on('click', () => {
  $('.mobile_search').css('display', 'block');
  $('.menu-overflow').css('overflow-x', 'unset');
  $('.navbar-left').css('display', 'block')
});
$('#close-mobile-search').on('click', () => {
  $('.mobile_search').css('display', 'none');
  $('.menu-overflow').css('overflow-x', 'auto');
  $('.navbar-left').css('display', 'block')
});
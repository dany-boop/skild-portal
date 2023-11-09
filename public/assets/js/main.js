//PRELOADER
$(window).on("load", function () {
  $(".preloader").fadeOut(function () {
    $("body").css("overflow", "hidden");
  });
});

//CHANGE NAV COLOR
$(window).scroll(function () {
  var scroll = $(window).scrollTop();

  //>=, not <=
  if (scroll >= 200) {
    //clearHeader, not clearheader - caps H
    if(!$(".overlay-menu").hasClass("overlay-open")){
      $(".super-navs").addClass("scrolled");
      $(".modal-div-section").addClass("scrolled");
      $('.header-section').addClass("fade-in");
      $('.back-to-top').css("display", "flex");
    }
  } else {
    $(".super-navs").removeClass("scrolled");
    $(".modal-div-section").removeClass("scrolled");
    $('.header-section').removeClass("fade-in");
    $('.back-to-top').css("display", "none");
  }
}); //missing );

//Scroll to selected section
$(document).ready(function () {
  $(".to-top").on("click", function (event) {
    if (this.hash !== "") {
      event.preventDefault();
      var hash = this.hash;
      $("html, body").animate(
      {
        scrollTop: $(hash).offset().top,
      },
      1200,
      function () {
        window.location.hash = hash;
      }
      );
    }
  });
});

/* MENU PUSH TOP */
/* Open Menu */
$(".open-close-btn").on("click touchstart", function (e) {
  // prevent default anchor click
  e.preventDefault();
  $("#hamburgericon").toggleClass("hamburger-open");
  $(".overlay-menu").toggleClass("overlay-open");
  $(".super-navs").removeClass("fade-in");
  $(".super-navs").removeClass("scrolled");
});

$(".eye").on("click touchstart", function (e) {
  // prevent default anchor click
  e.preventDefault();
  $("#eye").toggleClass("open");
  $(".socmed-top").toggleClass("open");
});

/* SHOW OR HIDE FORMS */
$(document).ready(function () {
  $(".tab-link").click(function () {
    var tab_id = $(this).attr("data-tab");

    $(".tab-link").removeClass("current");
    $(".contact-form").removeClass("current");

    $(this).addClass("current");
    $("#" + tab_id).addClass("current");
  });
});

/* PARALLAX EFFECT */
//if ($('#body').length > 0) {
//	$(window).scroll(function () {
//		var scroll = $(window).scrollTop();
//		var marginbottom = $(body).css('background-position');
//		if (window.pageYOffset > 50) {
//			$(body).css({
//				'background-position': '-35% '+((27.5 - (scroll/100))*100/100)+'%'
//			});
//		}
//	});
//}

//if ($('#body').length > 0) {
//
//	maxwidth = $(window).width();
//
//	console.log(maxwidth);
//
//	$(window).scroll(function () {
//		var scroll = $(window).scrollTop();
//		var marginNow = $('.text-box-hero').css('margin-top');
//
//		if (maxwidth < 480) {
//
//		if (window.pageYOffset > 25) {
//			$('.text-box-hero').css({
//				'margin-top': 256 - (scroll/2)+'px'
//			});
//		}
//
//		} else {
//
//			if (window.pageYOffset > 25) {
//				$('.text-box-hero').css({
//					'margin-top': 24 - (scroll/2)+'px'
//				});
//			}
//		}
//	});
//}

if ($("#left-top-img").length > 0) {
  maxwidth = $(window).width();

  console.log(maxwidth);

  $(window).scroll(function () {
    var scroll = $(window).scrollTop();
    var marginNow = $("#left-top-img").css("margin-top");

    if (maxwidth < 480) {
      if (window.pageYOffset > 25) {
        $("#left-top-img").css({
          "margin-top": 128 - scroll / 3 + "px",
        });
      }
    } else {
      if (window.pageYOffset > 25) {
        $("#left-top-img").css({
          "margin-top": 128 - scroll / 3 + "px",
        });
      }
    }
  });
}

var rafId = null;
var delay = 200;
var lTime = 0;

function scroll() {
  var scrollTop = $(window).scrollTop();
  var height = $(window).height();
  var visibleTop = scrollTop + height;
  $(".reveal").each(function () {
    var $t = $(this);
    if ($t.hasClass("reveal_visible")) {
      return;
    }
    var top = $t.offset().top;
    if (top <= visibleTop) {
      if (top + $t.height() < scrollTop) {
        $t.removeClass("reveal_pending").addClass("reveal_visible");
      } else {
        $t.addClass("reveal_pending");
        if (!rafId) requestAnimationFrame(reveal);
      }
    }
  });
}

function reveal() {
  rafId = null;
  var now = performance.now();

  if (now - lTime > delay) {
    lTime = now;
    var $ts = $(".reveal_pending");
    $($ts.get(0)).removeClass("reveal_pending").addClass("reveal_visible");
  }
  if ($(".reveal_pending").length >= 1) rafId = requestAnimationFrame(reveal);
}

$(scroll);
$(window).scroll(scroll);

/* Masonry Gallery */
//if ($('.masonry').length > 0) {
//	$('.masonry').masonry({
//		itemSelector: '.masonry-item',
//		percentPosition: true
//	});
//}

/* POP */
$(document).ready(function () {
  //multiple popups
  if ($(".products").length > 0) {
    $(".products").each(function () {
      $(this).magnificPopup({
        delegate: "a",
        removalDelay: 500, //delay removal by X to allow out-animation
        callbacks: {
          beforeOpen: function () {
            this.st.mainClass = this.st.el.attr("data-effect");
          },
        },
        midClick: true, // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
      });
    });
  }
});

$(document).ready(function () {
  if ($(".image-square").length > 0) {
    $(".img-square-box").height($(".img-square-box").width());
  }
});

function closeForm() {
  $.magnificPopup.close();
}

// Modals

function getAll(selector) {
  var parent =
  arguments.length > 1 && arguments[1] !== undefined
  ? arguments[1]
  : document;
  return Array.prototype.slice.call(parent.querySelectorAll(selector), 0);
}

var rootEl = document.documentElement;
var $modals = getAll(".modal");
var $modalButtons = getAll(".modal-button");
var $modalCloses = getAll(
  ".modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button"
  );

if ($modalButtons.length > 0) {
  $modalButtons.forEach(function ($el) {
    $el.addEventListener("click", function () {
      var target = $el.dataset.target;
      closeModals();
      openModal(target);
    });
  });
}

if ($modalCloses.length > 0) {
  $modalCloses.forEach(function ($el) {
    $el.addEventListener("click", function () {
      closeModals();
    });
  });
}

function openModal(target) {
  var $target = document.getElementById(target);
  rootEl.classList.add("is-clipped");
  $target.classList.add("is-active");
}

function closeModals() {
  rootEl.classList.remove("is-clipped");
  $modals.forEach(function ($el) {
    $el.classList.remove("is-active");
  });
}

document.addEventListener("keydown", function (event) {
  var e = event || window.event;

  if (e.keyCode === 27) {
    closeModals();
    closeDropdowns();
  }
});

//DOMContentLoaded - it fires when initial HTML document has been completely loaded
document.addEventListener("DOMContentLoaded", function () {
  // querySelector - it returns the element within the document that matches the specified selector
  var dropdown = document.querySelector(".dropdown");

  //addEventListener - attaches an event handler to the specified element.
  if (dropdown) {
    dropdown.addEventListener("click", function (event) {
      //event.stopPropagation() - it stops the bubbling of an event to parent elements, by preventing parent event handlers from being executed
      event.stopPropagation();

      //classList.toggle - it toggles between adding and removing a class name from an element
      dropdown.classList.toggle("is-active");
    });
  }
});

//SMOOTH SCROLL
// Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function (event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, "") ==
      this.pathname.replace(/^\//, "") &&
      location.hostname == this.hostname
      ) {
      // Figure out element to scroll to
    var target = $(this.hash);
    target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $("html, body").animate(
        {
          scrollTop: target.offset().top,
        },
        1000,
        function () {
            // Callback after animation
            // Must change focus!
            var $target = $(target);
            $target.focus();
            if ($target.is(":focus")) {
              // Checking if the target was focused
              return false;
            } else {
              $target.attr("tabindex", "-1"); // Adding tabindex for elements not focusable
              $target.focus(); // Set focus again
            }
          }
          );
      }
    }
  });

  function openTalents(evt, talentName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tab-talents-content");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tab-talents-links");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(talentName).style.display = "block";
    evt.currentTarget.className += " active";
  }




/** @format */

!(function (e) {
  "use strict";
  e("[data-bg-img]").each(function () {
    e(this).css("background-image", "url(" + e(this).data("bg-img") + ")");
  }),
    e("[data-bg-color]").each(function () {
      e(this).css("background-color", e(this).data("bg-color"));
    }),
    e("[data-height]").each(function () {
      e(this).css("height", e(this).data("height"));
    }),
    e("[data-padding-bottom]").each(function () {
      e(this).css("padding-bottom", e(this).data("padding-bottom"));
    });
  var t = e(".off-canvas-wrapper");
  e(".btn-menu").on("click", function () {
    t.addClass("active"), e("body").addClass("fix");
  }),
    e(".close-action > .btn-close, .off-canvas-overlay").on(
      "click",
      function () {
        t.removeClass("active"), e("body").removeClass("fix");
      }
    ),
    e(".main-menu").slicknav({
      appendTo: ".res-mobile-menu",
      closeOnClick: !0,
      removeClasses: !0,
      closedSymbol: '<i class="icon-arrows-plus"></i>',
      openedSymbol: '<i class="icon-arrows-minus"></i>',
    }),
    e(document).ready(function () {
      new Swiper(".service-slider-container", {
        slidesPerView: 3,
        speed: 1e3,
        loop: !0,
        spaceBetween: 30,
        autoplay: !1,
        breakpoints: {
          1200: { slidesPerView: 3, spaceBetween: 84 },
          992: { slidesPerView: 3, spaceBetween: 30 },
          768: { slidesPerView: 2, spaceBetween: 50 },
          576: { slidesPerView: 2, spaceBetween: 30 },
          0: { slidesPerView: 1 },
        },
      }),
        new Swiper(".team-slider-container", {
          slidesPerView: 3,
          speed: 1e3,
          loop: !0,
          spaceBetween: 30,
          autoplay: !1,
          pagination: { el: ".swiper-pagination", clickable: !0 },
          breakpoints: {
            1200: { slidesPerView: 3 },
            991: { slidesPerView: 2 },
            767: { slidesPerView: 2 },
            560: { slidesPerView: 2 },
            0: { slidesPerView: 1 },
          },
        }),
        new Swiper(".case-slider-container", {
          slidesPerView: 2,
          speed: 1e3,
          loop: !0,
          spaceBetween: 30,
          autoplay: !1,
          pagination: { el: ".swiper-pagination", clickable: !0 },
          breakpoints: {
            1200: { slidesPerView: 2 },
            991: { slidesPerView: 2 },
            767: { slidesPerView: 2 },
            576: { slidesPerView: 2 },
            0: { slidesPerView: 1 },
          },
        }),
        new Swiper(".testimonial-slider-container", {
          slidesPerView: 1,
          speed: 1e3,
          loop: !0,
          spaceBetween: 0,
          effect: "fade",
          fadeEffect: { crossFade: !0 },
          autoplay: { delay: 2500, disableOnInteraction: !0 },
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
        }),
        new Swiper(".department-gallery", {
          slidesPerView: 1,
          speed: 1e3,
          loop: !0,
          spaceBetween: 10,
          autoplay: { delay: 2500, disableOnInteraction: !0 },
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
        }),
        new Swiper(".brand-logo-slider-container", {
          slidesPerView: 5,
          loop: !0,
          speed: 1e3,
          spaceBetween: 30,
          autoplay: !1,
          breakpoints: {
            1200: { slidesPerView: 5, spaceBetween: 100 },
            992: { slidesPerView: 4, spaceBetween: 90 },
            768: { slidesPerView: 3, spaceBetween: 110 },
            576: { slidesPerView: 3, spaceBetween: 60 },
            380: { slidesPerView: 3, spaceBetween: 30 },
            0: { slidesPerView: 2, spaceBetween: 30 },
          },
        });
    }),
    e(".lightbox-image").fancybox(),
    e(".play-video-popup").fancybox(),
    e(window).on("scroll", function () {
      e(this).scrollTop() > 250
        ? e(".scroll-to-top").fadeIn()
        : e(".scroll-to-top").fadeOut(),
        e(".sticky-header").length &&
          (e(this).scrollTop() >= 80
            ? e(".sticky-header").addClass("sticky")
            : e(".sticky-header").removeClass("sticky"));
    }),
    jQuery(document).ready(function (e) {
      var t = e("#contact-form"),
        s = e(".form-message");
      e(t).submit(function (n) {
        n.preventDefault();
        var i = t.serialize();
        e.ajax({ type: "POST", url: t.attr("action"), data: i })
          .done(function (t) {
            e(s).removeClass("alert alert-danger"),
              e(s).addClass("alert alert-success fade show"),
              s.html(
                "<button type='button' class='btn-close' data-bs-dismiss='alert'>&times;</button>"
              ),
              s.append(t),
              e("#contact-form input,#contact-form textarea").val("");
          })
          .fail(function (t) {
            e(s).removeClass("alert alert-success"),
              e(s).addClass("alert alert-danger fade show"),
              "" !== t.responseText
                ? (s.html(
                    "<button type='button' class='btn-close' data-bs-dismiss='alert'>&times;</button>"
                  ),
                  s.append(t.responseText))
                : e(s).text(
                    "Oops! An error occurred and your message could not be sent."
                  );
          });
      });
    }),
    e("#datepicker").datepicker(),
    e(".scroll-to-top").on("click", function () {
      return e("html, body").animate({ scrollTop: 0 }, 800), !1;
    });
  let s = e(".reveal-footer").outerHeight(),
    n = e(window).width(),
    i = e(window).outerHeight();
  n > 991 &&
    i > s &&
    e(".site-wrapper-reveal").css({ "margin-bottom": s + "px" }),
    e(window).on("load", function () {
      AOS.init(), e("body").addClass("preloader-deactive");
    }),
    e(window).on("scroll", function () {}),
    e(window).on("resize", function () {});
})(window.jQuery);
const counters = document.querySelectorAll(".counter");
function startCounter(e, t) {
  let s = 0,
    n = () => {
      (s += t / 100),
        (e.innerText = Math.floor(s)),
        s < t ? requestAnimationFrame(n) : (e.innerText = t);
    };
  n();
}
function isInViewport(e) {
  let t = e.getBoundingClientRect();
  return (
    t.top >= 0 &&
    t.left >= 0 &&
    t.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
    t.right <= (window.innerWidth || document.documentElement.clientWidth)
  );
}
function checkCounters() {
  counters.forEach((e) => {
    let t = parseInt(e.getAttribute("data-target"));
    isInViewport(e) && "0" === e.innerText && startCounter(e, t);
  });
}
function toggleField(e) {
  var t = document.getElementById("additionalField");
  "option2" === e ? (t.style.display = "block") : (t.style.display = "none");
}
function updateValue(e, t) {
  var s = document.getElementById(e);
  document.getElementById(t).textContent = s.value;
}
function updateMemberValue(e, t, s) {
  let n = document.getElementById(e),
    i = document.getElementById(t),
    a = document.getElementById(s),
    o = parseInt(n.value);
  if (a) a.remove();
  if (1 === o || 2 === o || 3 === o || 4 === o) {
    let l = document.createElement("input");
    l.type = "text";
    l.className = "form-control mt-2";
    l.placeholder =
      1 === o || 2 === o
        ? "Reason(s) for dissatisfaction"
        : "Please suggest how we can improve this area.";
    l.id = s;
    i.textContent = o;
    i.parentElement.appendChild(l);
  } else {
    i.textContent = o;
  }
}

function updateHrValue(input, output, addition) {
  let n = document.getElementById(input),
    i = document.getElementById(output),
    a = document.getElementById(addition),
    o = parseInt(n.value);
  if ((a && a.remove(), 1 === o || 2 === o || 3 === o || 4 === o || 5 === o)) {
    let l = document.createElement("input");
    (l.type = "text"),
      (l.className = "form-control mt-2"),
      (l.placeholder =
        1 === o || 2 === o
          ? "Reason(s) for dissatisfaction"
          : 5 === o
          ? "Please clarify the reason(s) behind your dissatisfaction."
          : "Please suggest how we can improve this area."),
      (l.id = addition),
      (i.textContent = o),
      i.parentElement.appendChild(l);
  } else i.textContent = o;
}


window.addEventListener("scroll", checkCounters), checkCounters();




function updateMemberValueAr(e, t, s) {
  let n = document.getElementById(e),
    i = document.getElementById(t),
    a = document.getElementById(s),
    o = parseInt(n.value);
  if (a) a.remove();
  if (1 === o || 2 === o || 3 === o || 4 === o) {
    let l = document.createElement("input");
    l.setAttribute('required' ,true);
    l.type = "text";
    l.className = "form-control mt-2";
    l.placeholder =
      1 === o || 2 === o
        ? "يرجى توضيح السبب (الأسباب) وراء عدم رضاك."
        : "يرجى اقتراح كيف يمكننا تحسين هذه المنطقة";
    l.id = s;
    i.textContent = o;
    i.parentElement.appendChild(l);
  } else {
    i.textContent = o;
  }
}

function updateHrValueAr(input, output, addition) {
  let n = document.getElementById(input),
    i = document.getElementById(output),
    a = document.getElementById(addition),
    o = parseInt(n.value);
  if ((a && a.remove(), 1 === o || 2 === o || 3 === o || 4 === o || 5 === o)) {
    let l = document.createElement("input");
    l.setAttribute("required", true);
    (l.type = "text"),
      (l.className = "form-control mt-2"),
      (l.placeholder =
        1 === o || 2 === o
          ? "يرجى توضيح السبب (الأسباب) وراء عدم رضاك."
          : 5 === o
          ? "يرجى تحديد سبب إعجابك بهذه المنطقة."
          :"يرجى اقتراح كيف يمكننا تحسين هذه المنطقة"),
      (l.id = addition),
      (i.textContent = o),
      i.parentElement.appendChild(l);
  } else i.textContent = o;
}

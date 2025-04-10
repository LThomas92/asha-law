$ = jQuery.noConflict(); 
let windowSize = false;
let windowHeight = $(window).height();
let gutenbergScrollAnims = false;
let blockTriggerHeight = $(window).height() * 0.33;

$( document ).ready(function() {
    if ( jQuery(".gutenberg-styles > *").length &&
    !(window.location.hash != "" && jQuery(window.location.hash).length)
  ) {
    gutenbergScrollAnims = true;
    jQuery(".gutenberg-styles > *").each(function () {
      let offset = jQuery(this).get(0).getBoundingClientRect().top;
      jQuery(this).data("offset", offset);
      jQuery(this).addClass("to-reveal");
    });
  
    let numRevealed = 0;
    jQuery(".gutenberg-styles .to-reveal").each(function () {
      if (
        jQuery(window).scrollTop() + windowHeight - blockTriggerHeight >=
        jQuery(this).data("offset")
      ) {
        numRevealed++;
        const thisRef = $(this);
        setTimeout(function () {
          thisRef.removeClass("to-reveal");
          thisRef.addClass("revealed");
        }, 700 + numRevealed * 600);
      }
    });
  }
  });
  
  $(window).scroll(() => {
  let scrolled = $(window).scrollTop();
  // gutenberg scroll anims
  if (gutenbergScrollAnims) {
    $(".gutenberg-styles .to-reveal").each(function () {
      if (
        scrolled + windowHeight - blockTriggerHeight >=
        $(this).data("offset")
      ) {
        $(this).removeClass("to-reveal");
        $(this).addClass("revealed");
      }
    });
  }
  });
  
  $(window).resize(() => {
  if (
    jQuery(".gutenberg-styles > *").length &&
    !(window.location.hash != "" && jQuery(window.location.hash).length)
  ) {
    gutenbergScrollAnims = true;
    jQuery(".gutenberg-styles > *").each(function () {
      let offset = jQuery(this).get(0).getBoundingClientRect().top;
      jQuery(this).data("offset", offset);
      jQuery(this).addClass("to-reveal");
    });
  
    let numRevealed = 0;
    jQuery(".gutenberg-styles .to-reveal").each(function () {
      if (
        jQuery(window).scrollTop() + (windowHeight - blockTriggerHeight) >=
        jQuery(this).data("offset")
      ) {
        numRevealed++;
        const thisRef = $(this);
        setTimeout(function () {
          thisRef.removeClass("to-reveal");
          thisRef.addClass("revealed");
        }, 700 + numRevealed * 600);
      }
    });
  }

  });
// jQuery.noConflict();
jQuery(document).ready(function () {
  jQuery("#announcments .slick-wrapper").slick({
    autoplay: true,
    autoplaySpeed: 10000,
  });
});

jQuery(document).ready(function () {
  jQuery("#slider").slick({
    autoplay: true,
    arrows: false,
    mobileFirst: true,
    autoplaySpeed: 10000,
  });
});

//Clicking the X on the alert will close the alert section. it will also set a cookie with the name "alert"
jQuery(".closeAlert").click(function () {
  jQuery(".alerts").css("display", "none");
  setcookie("alert");
});
//function used to read cookies in browser
function getCookie(cName) {
  const name = cName + "=";
  const cDecoded = decodeURIComponent(document.cookie); //to be careful
  const cArr = cDecoded.split("; ");
  let res;
  cArr.forEach((val) => {
    if (val.indexOf(name) === 0) res = val.substring(name.length);
  });
  return res;
}
//if a cookie named "alert" exists the alert box will automatically close
if (getCookie("alert")) {
  // Re-direct to this page
  jQuery(".alerts").css("display", "none");
}

/*
=============================================================================================================
Set cookie that expires at the end of the day
=============================================================================================================
*/
function setcookie(cname, cvalue) {
  var now = new Date();
  var expire = new Date();

  expire.setFullYear(now.getFullYear());
  expire.setMonth(now.getMonth());
  expire.setDate(now.getDate() + 1);
  expire.setHours(0);
  expire.setMinutes(0);
  expire.setSeconds(0);

  var expires = "expires=" + expire.toString();
  document.cookie = cname + "=" + cvalue + "; " + expires + "; path=/";
}

/*
==================================================================================================
make video on home page autoplay despite browser controls
==================================================================================================
*/
var autoPlayVideo = document.getElementById("heroVideo");
autoPlayVideo.oncanplaythrough = function () {
  autoPlayVideo.muted = true;
  autoPlayVideo.play();
  autoPlayVideo.pause();
  autoPlayVideo.play();
};

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
document.addEventListener("DOMContentLoaded", function () {
  var autoPlayVideo = document.getElementById("heroVideo");
  if (autoPlayVideo) {
    autoPlayVideo.oncanplaythrough = function () {
      autoPlayVideo.muted = true;
      autoPlayVideo.play();
      autoPlayVideo.pause();
      autoPlayVideo.play();
    };
  } else {
    console.error("Element with ID 'heroVideo' not found.");
  }
});
/*
=============================================================================================================
Collapsible Content
=============================================================================================================
*/ document.addEventListener("DOMContentLoaded", function () {
  function toggleCollapsible(button) {
    var content = button.nextElementSibling;
    if (!content) {
      return;
    }
    if (content.style.display === "none" || content.style.display === "") {
      content.style.display = "block";
      button.classList.add("exposed");
    } else {
      content.style.display = "none";
      button.classList.remove("exposed");
    }
  }

  function setupCollapsible(buttons) {
    buttons.forEach(function (button) {
      button.addEventListener("click", function (event) {
        event.stopPropagation(); // Prevent parent collapsible areas from toggling
        toggleCollapsible(button);
      });
    });
  }

  function initializeCollapsibles() {
    var buttons = document.querySelectorAll(".collapsible-button");
    setupCollapsible(buttons);

    // Handle nested collapsible areas
    document
      .querySelectorAll(".collapsible-content")
      .forEach(function (content) {
        var nestedButtons = content.querySelectorAll(
          ".nested-collapsible-button"
        );
        setupCollapsible(nestedButtons);
      });
  }

  initializeCollapsibles();
});

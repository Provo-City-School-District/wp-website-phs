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
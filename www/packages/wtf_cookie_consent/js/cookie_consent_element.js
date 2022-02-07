$(document).ready(function () {  

  $('#showCookieConsent').on('click', function(e){
    $('.cc-window').css({
      'display': 'block',
      'opacity': '1'
    }).addClass('cc-open');
  });

  function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

  function checkCookies () {
    var cookieConsent = getCookie("cookieconsent_status");

    if($('#cookieConsentText').length) {
      if (cookieConsent === "deny") {
        $('#cookieConsentText').text("Evästeet pois käytöstä");
      }
      if (cookieConsent === "allow") {
        $('#cookieConsentText').text("Evästeet käytössä");
      }
    }
  }
  checkCookies();

  $('body').on('click', '.cc-btn', function() {
    $('.cc-window').css({
      'display': 'none',
      'opacity': '0'
    }).removeClass('cc-open');
    $('#cc-revoke-cookies').removeClass('cc-close-popup');
  });

  $('body').on('click', '#cc-show-info', function() {
    $('#cc-additional-info').toggle();
  });

  $('body').on('click', '#cc-revoke-cookies', function() {
    if($('#cc-revoke-cookies').hasClass('cc-close-popup')) {
      $('.cc-window').css({
        'display': 'none',
        'opacity': '0'
      }).removeClass('cc-open');
      $('#cc-revoke-cookies').removeClass('cc-close-popup');
    } else {
      $('.cc-window').css({
        'display': 'block',
        'opacity': '1'
      }).addClass('cc-open');
      $('#cc-revoke-cookies').addClass('cc-close-popup');
    }
  });
});

function onConsent() {
  analyticsScriptsHead();
  marketingScriptsHead();
  analyticsScriptsFooter();
  marketingScriptsFooter();
}

function consentOut() {
  deleteAllCookies();
  document.cookie = "cookieconsent_status=deny; expires=Thu, 31 Dec 2199 23:59:59 UTC;path=/";
  //if (!alert("Kaikki sivuston ei-välttämättömät evästeet poistetaan käytöstä. Sivu latautuu uudestaan.")) {
      window.location.reload();
  //}
}

function consentIn() {
  document.cookie = "cookieconsent_status=allow; expires=Thu, 31 Dec 2199 23:59:59 UTC;path=/";
  //if (!alert("Kaikkien sivustolla käytettävien evästeiden käyttö sallitaan. Sivu latautuu uudestaan.")) {
      window.location.reload();
  //}
}

// TESTAUSTA VARTEN setCookie
function setCookie(name,value,days) {
  var expires = "";
  if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days*24*60*60*1000));
      expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function get_cookie(name){
  return document.cookie.split(';').some(c => {
      return c.trim().startsWith(name + '=');
  });
}

var isSubdomain = function(url) {
    var regex = new RegExp(/^([a-z]+\:\/{2})?([\w-]+\.[\w-]+\.\w+)$/);
    return !!url.match(regex); // make sure it returns boolean
}

function deleteAllCookies() {
  var cookies = document.cookie.split("; ");

  for (var i = 0; i < cookies.length; i++) {
      var cookie = cookies[i];
      var eqPos = cookie.indexOf("=");
      var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
      var path = "/"
      var domain = window.location.hostname;

      if(isSubdomain(domain)) {
        var domain = domain.replace(/^[^.]+\./g, "");
      }

      if(get_cookie(name)) {
        document.cookie = name + "=" +
          ((path) ? ";path="+path:"")+
          ((domain)?";domain=."+domain:"") +
          ";expires=Thu, 01 Jan 1970 00:00:01 GMT";
      }
  }
  window.localStorage.clear()
}
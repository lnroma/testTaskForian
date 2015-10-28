/**
 * Created by roman on 24.10.15.
 */
$(document).ready(function() {
var start_pos=$('#stick_menu').offset().top;
 $(window).scroll(function(){
  if ($(window).scrollTop()>start_pos) {
      if ($('#stick_menu').hasClass()==false) $('#stick_menu').addClass('to_top');
  }  else {
      $('#stick_menu').removeClass('to_top');
  }
 });
});

function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  window.location = encodeURI('/callback/id/'+profile.getId()+'/name/'+profile.getName()+'/email/'+profile.getEmail());
}

function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
        console.log('User signed out.');
    });
}

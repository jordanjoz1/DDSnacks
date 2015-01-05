@extends('layouts.default')
@section('content')
  <script type="text/javascript">
  (function() {
    var po = document.createElement('script');
    po.type = 'text/javascript'; po.async = true;
    po.src = 'https://plus.google.com/js/client:plusone.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(po, s);
  })();
  </script>
  
        <!-- PAGE TITLE =============================================== -->
        <div class="page-header">
            <h2>DD Snacks</h2>
        </div>
        

      <div id="gConnect">
      <h3 id="info-text">Login with your <strong>@doubledutch.me</strong> account</h3>
    <span class="g-signin"
        data-scope="email"
        data-clientId="{{ $CLIENT_ID }}"
        data-accesstype="offline"
        data-callback="onSignInCallback"
        data-theme="dark"
        data-cookiepolicy="single_host_origin">
    </span>
   <div class="footer" data-ng-hide="loading"><a href="mailto:jordan@doubledutch.me?Subject=DD%20Snacks%20feedback">Send feedback</a></div>
<script type="text/javascript">
var helper = (function() {
  var authResult = undefined;

  return {
    /**
     * Hides the sign-in button and connects the server-side app after
     * the user successfully signs in.
     *
     * @param {Object} authResult An Object which contains the access token and
     *   other authentication information.
     */
    onSignInCallback: function(authResult) {
      if (authResult['access_token']) {
        this.authResult = authResult;
        helper.connectServer();
      } else if (authResult['error']) {
        // There was an error, which means the user is not signed in.
        // As an example, you can troubleshoot by writing to the console:
        console.log('There was an error: ' + authResult['error']);
      }
      console.log('authResult', authResult);
    },
    /**
     * Calls the server endpoint to connect the app for the user. The client
     * sends the one-time authorization code to the server and the server
     * exchanges the code for its own tokens to use for offline API access.
     * For more information, see:
     *   https://developers.google.com/+/web/signin/server-side-flow
     */
    connectServer: function() {
      console.log(this.authResult.code);
      $.ajax({
        type: 'POST',
        url: '/login?state={{ $STATE }}',
        contentType: 'application/octet-stream; charset=utf-8',
        success: function(result) {
        console.log(result);
            if (result.error == false) {
              window.location.replace("http://ddsnacks.com");
              }
              else {
                $('#info-text').html(result.message).css('color', 'LightSalmon');
                gapi.auth.signOut();
              }
        },
        processData: false,
        data: this.authResult.code
      });
    },
  };
})();

/**
 * Calls the helper method that handles the authentication flow.
 *
 * @param {Object} authResult An Object which contains the access token and
 *   other authentication information.
 */
function onSignInCallback(authResult) {
  helper.onSignInCallback(authResult);
}
</script>


@stop


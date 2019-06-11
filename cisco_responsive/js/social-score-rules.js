var NTPT_IMGSRC_CUSTOM;
var linktext_content = 'blog';
//NTPT_PGEXTRA = 'status=LoggedIn';
//NTPT_IMGSRC_CUSTOM = "//cisco-tags.cisco.com/tag/auth/ntpagetag.gif"; // setting auth sensor path
NTPT_PGEXTRA = 'status=Anonymous';
NTPT_IMGSRC_CUSTOM = "//cisco-tags.cisco.com/tag/ntpagetag.gif"; //setting non-auth sensor path

/*window.FB = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

window.fbAsyncInit=function() {
                FB.Event.subscribe('edge.create', page_FB_like_callback);
}*/
function social_scoring_tracker(link_text) {
                  var d= trackEvent._RCV("CP_GUTC");
                  trackEvent.event('link',{element_type:'link',linktext:link_text,lpos:'social', lid:'social_likes',link:window.location, action:'linkClick',vid:d});
                  s_ut.linkTrackVars="prop4,prop5,prop6,prop8,eVar47,visitorID,events";
                  s_ut.linkTrackEvents="event28";
                  s_ut.events="event28";
                  s_ut.prop4='social_like';
                  s_ut.prop5='social';
                  s_ut.prop6='D=pageName';
                  s_ut.prop8='social_likes';
                  s_ut.eVar47='social_like';
                  s_ut.visitorID=d;
                  s_ut.tl(this, 'o', 'social_like');
}

function page_FB_like_callback(href) {
    social_scoring_tracker('facebook like');
    console.log("hiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii");
}
function page_tweet_callback(ev) {
    social_scoring_tracker('tweet ' + linktext_content);
    console.log('HIIIIIIIIIIIIIIIIIII');
}
var G_callback_completed = false;
function G_callback(jsonResult) {
    if(jsonResult.type == 'confirm' && G_callback_completed == false) {
        social_scoring_tracker('G+1 ' + linktext_content);
        G_callback_completed = true;
    }
}

window.twttr = (function (d,s,id) {
                              var t, js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
                              js.src="https://platform.twitter.com/widgets.js";
                              fjs.parentNode.insertBefore(js, fjs);
                              return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
                          }(document, "script", "twitter-wjs"));

twttr.ready(function (twttr) {
    twttr.events.bind(
        'tweet',
        page_tweet_callback
    );
});


cdc.util.addMetricsRule("#social_widget #social_panel li a", {ev : "link", linktext : "Follow Us", bar : "xxx", foo : "xxx"});
cdc.util.addMetricsRule(".subscribe_rss", {ev : "link", linktext : "Add RSS feed", bar : "xxx", foo : "xxx"});
cdc.util.addMetricsRule(".commentLikeButton.commentlike", {ev : "link", linktext : "Like Comment", bar : "xxx", foo : "xxx"});

jQuery(document).ready(function(e) {
    jQuery( "#subscribe_box #subscribe_form .subscribe_button" ).on( "click", function() {
                  cdc_event_tracker("Subscribe RSS Feed");
                });
    jQuery("#commentform #submit" ).on( "click", function() {
                  cdc_event_tracker("Comment on Blog");
                });
});

function cdc_event_tracker(link_text) {
                  var d= trackEvent._RCV("CP_GUTC");
                  trackEvent.event('link',{element_type:'link',linktext:link_text,link:window.location, action:'linkClick',vid:d, bar : "xxx", foo : "xxx"});
}

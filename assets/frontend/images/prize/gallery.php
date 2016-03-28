<?php $this->load->view('header');?>

<div class="headimage owntopheadimage">
    <img class="img-responsive" src="<?php echo site_url(); ?>assets/frontend/images/headimages/gallery_headimage.jpg">
</div>
<br />
<br />
<div class="container">
	<form action="#" method="post">
		<div class="row">
			<div class="col-md-4 col-md-offset-8">
			    <input type="text" name="inputSearch" class="form-control ownsearch" id="inputSearch" placeholder="Search">
			</div>
		</div>
	</form>
	<div class="row">
		<?php if(count($gallery_data) > 0) {
			$no = "";
	        $no += $pages_no;
	        $no++;
	        foreach($gallery_data as $item) {
	    ?>
			<div class="col-sm-4 own-photo-box">
				<div class="own-photo-box-border">
					<div class="own-photo-box-content">
						<img class="img-responsive" src="<?php echo $item['picture_url']; ?>" alt="">
						<div class="thumbs-details">
							<span><img src="<?php echo $item['picture_url_thumb']; ?>" class="img-circle"></span>
							<span><?php echo $item['memb_name']; ?></span>
							<span class="pull-right owncolor">
	  							<a class="own-vote" style="color:#bbbbbb;" href="#" data-toggle="modal" data-target="#basicModal" data-id="<?php echo $item['memb_id']; ?>"><span class="glyphicon glyphicon-heart"></span></a> <strong><?php echo $item['memb_count']; ?></strong>
	  			  			</span>
						</div>
					</div>
				</div>
				<br />
				<p class="owncomment"><?php echo $item['memb_shareexperience']; ?></p>
			</div>
		<?php
			}
		}
		?>
	</div>

	<?php if(!empty($pagexx) AND $pagexx != 'latest') : ?>
		<div class="row">
			<div class="pagination" style="float:right;">
		        <?php echo $this->pagination->create_links(); ?>
		    </div>
	    </div>
	<?php endif; ?>

</div>
<br />
<br />
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        	<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h3 class="modal-title" id="myModalLabel" style="text-align:center;">Vote</h3>
		    </div>
            <div class="modal-body">
            	<form role="form" method="POST" action="<?php echo site_url();?>gallery/vote">
				    <?php if(!$connected_twitter): ?>
				    	<div class="form-group" style="text-align:center;" id="fb-form-group">
						    <div id="fb-root"></div>
						    <div id="fblike" style="display:none;" class="fb-like" data-href="http://www.facebook.com/telkomspeedy" data-width="300" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>
						    <div id="fblogin" style="display:none;">
						    	<a href="javascript:void(0)" onclick="fb_login();"><img src="<?php echo site_url(); ?>assets/frontend/images/fb_connect_button.png"/></a>
						    </div>
						</div>
						<div class="form-group" style="text-align:center;">or</div>
						<div class="form-group" style="text-align:center;" id="tw-form-group">
					    	<a href="<?php echo site_url();?>gallery/twitterlogin"><img src="<?php echo site_url(); ?>assets/frontend/images/twitter_connect_button.png"/></a>
					  	</div>
				    <?php else: ?>
				    	<div class="form-group" style="text-align:center;" id="tw-form-group">
					    	<a href="https://twitter.com/telkomspeedy" class="twitter-follow-button" data-show-count="false" data-lang="en" data-size="large">Follow @telkomspeedy</a>
					  	</div>
				    <?php endif; ?>

				    <?php if(!empty($twitter_following)): ?>
				    	<div class="form-group" style="text-align:center;">
					    	<input type="submit" class="btn btn-primary" style="width:222px;" value="VOTE" id="btsubmit">
					    </div>
				    <?php else: ?>
				    	<div style="text-align:center;">
					    	<input type="submit" class="btn btn-primary" style="width:222px;" value="VOTE" disabled="disabled" id="btsubmit">
					    </div>
				    <?php endif; ?>

				    <?php if(!$connected_twitter): ?>
					<input type="hidden" name="using_fb" id="using_fb" value="1" />
					<?php else: ?>
					<input type="hidden" name="using_tw" id="using_tw" value="1" />
					<?php endif; ?>

				    <input type="hidden" id="idphotos" name="idphotos" value="" />
					<input type="hidden" name="fb_username" id="fb_username" value="<?php echo (!empty($fb_username) ? $fb_username : ''); ?>" />
					<input type="hidden" name="fb_name" id="fb_name" value="<?php echo (!empty($fb_name) ? $fb_name : ''); ?>" />
					<input type="hidden" name="fb_id" id="fb_id" value="<?php echo (!empty($fb_id) ? $fb_id : ''); ?>" />
					<input type="hidden" name="fb_email" id="fb_email" value="<?php echo (!empty($fb_email) ? $fb_email : ''); ?>" />
					<input type="hidden" name="tw_userid" id="tw_userid" value="<?php echo (!empty($twitter_id) ? $twitter_id : ''); ?>" />
					<input type="hidden" name="fb_like" id="fb_like" value="<?php echo (!empty($fb_like) ? $fb_like : ''); ?>" />
					<input type="hidden" name="tw_following" id="tw_following" value="<?php echo (!empty($twitter_following) ? $twitter_following : ''); ?>" />
				</form>
            </div>
    	</div>
  	</div>
</div>

<?php if($this->session->flashdata('msg')) : ?>
	<script>
		$(document).ready(function() {
			jAlert("<?php echo $this->session->flashdata('msg'); ?>", "Success")
		});
	</script>
<?php endif; ?>

<?php $this->load->view('footer');?>

<script>

$(document).on("click", ".own-vote", function () {
     var idphotos = $(this).data('id');
     $("#idphotos").val( idphotos );
});

      window.fbAsyncInit = function() {
        FB.init({
          appId      : '1423245747932677',
          cookie   : true,
          status     : true,
          xfbml      : true
        });

    FB.Event.subscribe('edge.create', page_like_callback);
    FB.Event.subscribe('edge.remove', page_unlike_callback);

    FB.getLoginStatus(function(response) {
      var page_id = "37399482876";
      if (response.status === 'connected') {
        var user_id = response.authResponse.userID;
        var fql_query = "SELECT uid FROM page_fan WHERE page_id = "+page_id+"and uid="+user_id;
        FB.Data.query(fql_query).wait(function(rows) {
          if (rows.length == 1 && rows[0].uid == user_id) {
            document.getElementById("fb_like").value = '1';
          } else {
            document.getElementById("fb_like").value = '';
          }
          getUserInfo();
          checkjoinbutton();
        });
        $('#fblogin').hide();
        $('#fblike').show();

        $('.form-group').hide();
        $('#fb-form-group').show();
      } else {
        $('#fblogin').show();
        $('#fblike').hide();
      }
    });

  };

  var fb_login = function() {
      FB.login(function(response) {
        if (response.status === 'connected') {
        window.location = "http://www.telkomunitas.com/wifi.idCornerChallenge/gallery";
      } else {
        $('#fblogin').show();
        $('#fblike').hide();
      }
    }, {scope: 'user_likes,email'});
  };

  var checkjoinbutton = function() {
    $('#btsubmit').attr('disabled', true);
    if($('#fb_like').val() != '' || $('#tw_following').val() != '') {
      $('#btsubmit').attr('disabled', false);
    }
  }

  function getUserInfo() {
    FB.api('/me', function(response) {         
      document.getElementById("fb_username").value = response.username;
      document.getElementById("fb_name").value = response.name;
      document.getElementById("fb_id").value = response.id;
      document.getElementById("fb_email").value = response.email;
    });
  }

// callback that logs arguments
var page_like_callback = function(url, html_element) {
  document.getElementById("fb_like").value = '1';
  getUserInfo();
  checkjoinbutton();
};

var page_unlike_callback = function(url, html_element) {
  document.getElementById("fb_username").value = '';
  document.getElementById("fb_name").value = '';
  document.getElementById("fb_id").value = '';
  document.getElementById("fb_email").value = '';
  document.getElementById("fb_like").value = '';
  checkjoinbutton();
};

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/all.js";
         //js.src = "//connect.facebook.net/en_US/all/debug.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));


window.twttr = (function (d,s,id) {
  var t, js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
  js.src="https://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
  return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
}(document, "script", "twitter-wjs"));
 
// Define our custom event handlers
function clickEventToAnalytics (intentEvent) {
  if (!intentEvent) return;
  //console.log(intentEvent.data);
  var label = intentEvent.region;
}
 
function followIntentToAnalytics (intentEvent) {
  if (!intentEvent) return;
  //console.log(intentEvent.data);
  document.getElementById("tw_following").value = '1';
  checkjoinbutton();
}

function unfollowIntentToAnalytics (intentEvent) {
  if (!intentEvent) return;
  //console.log(intentEvent.data);
  document.getElementById("tw_following").value = '';
  checkjoinbutton();
}
 
// Wait for the asynchronous resources to load
twttr.ready(function (twttr) {
  twttr.events.bind('click', clickEventToAnalytics);
  twttr.events.bind('follow', followIntentToAnalytics);
  twttr.events.bind('unfollow', unfollowIntentToAnalytics);
});

</script>
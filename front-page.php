<?php
if ( 'posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
} else {
/**
 * The front-page template file.
 *
 * @package IPACS
 */
	//get_header('no-container'); 
	get_header(); 
?>

<!--div cclass="body-shadow">
<div class="body-content"-->

<div class="pre-container-1">
<div class="container">
<div class="flex-c page-blocks-row">
<?php dynamic_sidebar( 'frontpage-sidebar-1' ); ?>
</div>
</div>
</div>

<!--div class="pre-container-1">
<div class="container">
<div class="flex-c">
    <div class="page-block flex-i">
	<h2><aa href="/">Areas of Interest</aa></h2>
	<p>
		<ul>
			<li>nonlinear dynamics and control;</li>
			<li>quantum information and control;</li>
			<li>control of oscillations, chaos and bifurcations;</li>
			<li>control in thermodynamics;</li>
			<li>modeling and identification of physical systems;</li>
			<li>complexity and self-organization;</li>
			<li>analysis and control of complex networks;</li>
			<li>synchronization;</li>
			<li>control of plasma, beams, lasers, mechanical systems, nano- and femto- technologies;</li>
			<li>other related applications in science and technology.</li>
		</ul>
	</p>
	<p>
		<br>
		<a class="read-more" href="/about/">Read More About IPACS</a>
	</p>
    </div>
    <div class="page-block flex-i">
	<h2><a href="/cap/">CAP Journal</a></h2>
	<p>
		<img src="http://physcon.ru/wp-content/uploads/2016/03/cap_cover_2012_1_s.png" />
	</p>
	<p>
		<a href="http://coms.physcon.ru/conf/12/" class="bbutton bbtn bbtn-success read-more ggreen">Submit a paper <sup sstyle="color: red;">*</sup></a>
	</p>
	<p>
		<sup sstyle="color: red;">*</sup> See <a href="http://physcon.ru/cap/">Journal Details</a> first please.
	</p>
    </div>
    <div class="page-block flex-i">
	<h2><a href="/events/">Events</a></h2>
		<?php echo do_shortcode("[ecs-list-events order=desc past='yes' limit=3 venue='true' excerpt='false']"); ?>
	<p>
		See more <a href="http://physcon.ru/events/list/">Upcoming</a> or <a href="http://physcon.ru/events/list/?tribe_event_display=past">Past</a> events.
	</p>
    </div>
    <div class="page-block flex-i">
	<h2><a href="http://lib.physcon.ru">Library</a></h2>
	<p>
		<form action="http://lib.physcon.ru/search" class="lib-search-form">
			<input type=text name=q placeholder="Search (by Key Phrase or Author Name)" /><button class="read-more"><i class="fa fa-search"></i></button>
		</form>
	</p>
    </div>
    <div class="page-block flex-i">
	<h2><a href="/membership/">Membership</a></h2>
	<p>
		You could become a member of the IPACS as soon as your submitted paper is accepted to the <a href="/cap/">CAP Journal</a> (two positive reviews must be received).
	</p>
	<p>
		<a href="/membership/" class="button read-more">Read More</a>
	</p>
    </div>
    <div class="page-block flex-i contacts">
	<h2>IPACS Contacts</h2>
	<p>
<b>Address of the IPACS secretariat:</b>
<br>
Prof. A. L. Fradkov, Institute for Problems of Mechanical Engineering,
61 Bolshoy ave. V.O., 199178, St. Petersburg, RUSSIA
<br>
<br>
<span title="Phone"><i class="fa fa-phone"></i> <span>+7 (812) 321-4766</span></span>
<br>
<span title="Fax"><i class="fa fa-fax"></i> <span>+7 (812) 321-4771</span></span>
<br>
<span title="Email"><i class="fa fa-envelope"></i> <span><a href="mailto:ipacs@physcon.ru">ipacs@physcon.ru</a></span></span>
<br>
<span title="Site"><i class="fa fa-external-link"></i> <span><a href="http://physcon.ru/">http://physcon.ru/</a></span></span>
	</p>
    </div>
</div>
</div>
</div-->

<div class="pre-container-2">
<div class="container">
<!--div class="page-block">
	<h2><?php _e( 'Recent News','flaton'); ?></h2>
</div-->
	<div class="rrecent-posts-container flex-c page-blocks-row">
		<?php ipacs_recent_posts(); ?>
	</div>
</div>
</div>


<!--/div>
</div-->


<?php
		//get_footer('no-container'); 
		get_footer(); 
}
?>

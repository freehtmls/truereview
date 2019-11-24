( function( $ ) {

	// Document ready
	$( function() {

		/**
		 * Responsive video
		 */
		$( '.hentry, .widget' ).fitVids();

		/**
		 * Mobile menu
		 */
		$( '#menu-primary-items' ).slicknav( {
			label: "",
			prependTo: '.main-navigation',
			allowParentLinks: true
		} );

		/**
		 * Mobile menu
		 */
		$( '#menu-secondary-items' ).slicknav( {
			label: "",
			prependTo: '.menu-secondary-container',
			allowParentLinks: true
		} );

		/**
		 * Breaking News
		 */
		$( '.breaking-news' ).flexslider( {
			controlNav: false,
			directionNav: false,
			slideshowSpeed: 4000,
			pauseOnHover: true
		} );

		/**
		 * Masonry layout
		 */
		var $container = $( '.list-layout-masonry-style .page-entry' );

		var $layout = $container.masonry( {
			itemSelector: '.hentry',
			percentPosition: true
		} );

		$layout.imagesLoaded().progress( function() {
			$layout.masonry( 'layout' );
		} );

		/**
		 * Featured Posts
		 */
		$( '.featured-posts' ).flexslider( {
			controlNav: false,
			slideshowSpeed: 4000,
			pauseOnHover: true
		} );

		/**
		 * Image scroll animations
		 */
		$img = $( '.site-content img, .site-footer img' );
		$img.addClass( 'hide-img' );
		$img.one( 'inview', function() {
			$( this ).addClass( 'show-img' );
		} );

		/**
		 * Coupon
		 */
		var clipboard = new Clipboard( '.coupon-code' );

		clipboard.on( 'success', function( e ) {
			console.info( 'Action:', e.action );
			console.info( 'Text:', e.text );
			console.info( 'Trigger:', e.trigger );

			e.clearSelection();
		} );

		clipboard.on( 'error', function( e ) {
			console.error( 'Action:', e.action );
			console.error( 'Trigger:', e.trigger );
		} );

	} );

}( jQuery ) );

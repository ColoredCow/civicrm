jQuery( function ( $ ) {
	/**
	 * Object to handle source tracking.
	 */
	var sourceTracking = {
		init: function() {
			this.read_source = this.read_source.bind( this );

			$( document ).ready( this.read_source );
		},

		/**
		 * Read source
		 */
		 read_source: function () {
			alert('read the source from the URL and do stuff.');
		},
	}

	sourceTracking.init();
} );

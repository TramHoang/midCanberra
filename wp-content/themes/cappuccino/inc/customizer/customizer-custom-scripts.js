( function( api ) {

	// Extends our custom "cappuccino" section.
	api.sectionConstructor['cappuccino'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );

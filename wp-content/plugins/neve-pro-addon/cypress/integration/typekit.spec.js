describe( 'TypeKit Module', function() {

	it( 'Sets up in the options page', function() {
		cy.login( '/wp-admin/themes.php?page=neve-welcome' );
		cy.server().
				route( 'POST',
						`${Cypress.config().baseUrl}/wp-json/neve_pro/v1/save_options?req=Save+Options` ).
				as( 'saveOptions' );
		cy.server().
				route( 'POST',
						`${Cypress.config().baseUrl}/wp-json/neve_pro/v1/save_module_settings?module_id=typekit_fonts` ).
				as( 'saveModuleOptions' );
		cy.get( '.tab' ).contains( 'Neve Pro Addon' ).click();
		cy.get( '.typekit_fonts' ).as( 'moduleTile' );

		// Enable the module if it isn't enabled.
		cy.get( '@moduleTile' ).find( '.vue-js-switch' ).then( ($toggle) => {
			if ( !$toggle.hasClass( 'toggled' ) ) {
				$toggle.click();
				cy.wait( '@saveOptions' ).then( (req) => {
					expect( req.response.body.success ).to.be.true;
					expect( req.status ).to.equal( 200 );
				} );
			}
		} );

		cy.get( '#neve_pro_typekit_id' ).
				should( 'exist' ).
				and( 'be.visible' ).clear().
				type( Cypress.config().tkCode );

		cy.get( '@moduleTile' ).find( '.button-primary' ).click();
		cy.wait( '@saveModuleOptions' ).then( (req) => {
			expect( req.response.body.success ).to.be.true;
			expect( req.status ).to.equal( 200 );
		} );
		cy.get( '@moduleTile' ).find( '.module-refresh' ).click();
		cy.wait( '@saveModuleOptions' ).then( (req) => {
			expect( req.response.body.success ).to.be.true;
			expect( req.status ).to.equal( 200 );
		} );
	} );

	it( 'Shows up in customizer', function() {
		cy.login( '/wp-admin/customize.php' );

		cy.get( '#accordion-panel-neve_typography' ).click();
		cy.get( '#accordion-section-neve_typography_general' ).click();

		cy.get( '#customize-control-neve_body_font_family' ).as( 'control' );
		cy.get( '@control' ).find( '.font-family-selector-toggle' ).click();
		cy.get( '@control' ).
				find( '.font-group-header' ).
				contains( 'Typekit' ).
				should( 'exist' );
	} );

} );

describe( 'Header Booster', function() {

	it( 'Sticky Header', function() {

		cy.login( '/wp-admin/customize.php' );

		goToCustomizerSection();

		cy.get(
				'.hfg--cb-body > .hfg--panel-desktop > .hfg--cp-rows > .hfg--row-main' ).
				should( 'be.visible' ).
				trigger( 'mouseover' );

		cy.get(
				'.hfg--cb-body > .hfg--panel-desktop > .hfg--cp-rows > .hfg--row-main > .hfg--cb-row-settings' ).
				should( 'be.visible' ).
				click();

		cy.get(
				'#customize-control-hfg_header_layout_main_sticky label' ).
				click( { force: true } );

		saveCustomizer();

		cy.scrollTo( 0, 500 );
		cy.get( '.header-main[data-show-on="desktop"]' ).
				should( 'be.visible' );
		cy.get( '#header-grid' ).
				should( 'have.class', 'is-stuck' );
	} );
} );

/**
 * Alias Rest Routes
 */
function aliasRestRoutes() {
	let home = Cypress.config().baseUrl;
	cy.server().
			route( 'POST', home + '/wp-admin/admin-ajax.php' ).
			as( 'customizerSave' );
}

/**
 * Go to Header customizer section.
 */
function goToCustomizerSection() {
	aliasRestRoutes();
	cy.get( '#accordion-panel-hfg_header' ).should( 'be.visible' ).click();
}

/**
 * Publish customizer changes.
 */
function saveCustomizer() {
	cy.get( '#save' ).click();
	cy.wait( '@customizerSave' ).then( (req) => {
		expect( req.response.body.success ).to.be.true;
		expect( req.status ).to.equal( 200 );
		cy.wait( 2000 );
	} );
	cy.visit( '/' );
}

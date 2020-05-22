describe( 'Blog Booster', function() {

	it( 'Custom Meta Separator', function() {

		cy.login();

		navigateToBlogOptions();

		cy.get( '#_customize-input-neve_metadata_separator' ).clear().type( '\\003E' );

		saveCustomizer();

		cy.visit('/');

		cy.get('article > .article-content-col > .content > .nv-meta-list > .author ').each(function (el) {
			cy.get(el).then($els => {
				// get Window reference from element
				const win = $els[0].ownerDocument.defaultView
				// use getComputedStyle to read the pseudo selector
				const before = win.getComputedStyle($els[0], 'after')
				// read the value of the `content` CSS property
				const contentValue = before.getPropertyValue('content')
				// the returned value will have double quotes around it, but this is correct
				expect(contentValue).to.eq('">"');
			})
		})

	});

	it( 'Estimated Reading Time', function() {

		cy.login();

		navigateToBlogOptions();

		cy.get( '#customize-control-neve_post_meta_ordering' )
			.find('li.order-component')
			.each(function (el) {
				cy.get(el).invoke('attr', 'data-id').then(function () {
					cy.get(el).invoke('attr', 'class').then((val) => {
						if (!val.includes('enabled')) {
							cy.get(el).find('.toggle-display').click();
						}
					})
				});
			});

		saveCustomizer();

		cy.visit('/');

		cy.get('article .nv-meta-list ').each(function (el) {
			cy.get(el).find('.reading-time').should('be.visible');
		})
	});

	it( 'Custom author avatar size', function() {

		cy.login();

		navigateToBlogOptions();

		cy.get('#_customize-input-neve_author_avatar').invoke('attr', 'checked').then((val) => {
			if (val !== 'checked') {
				cy.get('#_customize-input-neve_author_avatar').check();
			}
		});

		cy.get('#customize-control-neve_author_avatar_size input.responsive-number--input[data-query=desktop]')
			.invoke( 'val', 50 )
			.trigger( 'change' );

		saveCustomizer();

		cy.visit('/');

		cy.get('article').each(function (el) {
			cy.get(el).find('.meta.author').find('.photo')
				.should('be.visible')
				.and('have.css', 'width', '50px')
				.and('have.css', 'width', '50px');
		});

	});

	it( 'Reset author avatar size', function() {

		cy.login();

		navigateToBlogOptions();

		cy.get('#customize-control-neve_author_avatar_size .reset-number-input' ).click();

		saveCustomizer();

		cy.visit('/');

		cy.get('article').each(function (el) {
			cy.get(el).find('.meta.author').find('.photo')
				.should('be.visible')
				.and('have.css', 'width', '20px')
				.and('have.css', 'width', '20px');
		});

	});

	it( 'Custom read more button', function() {

		cy.login();

		navigateToBlogOptions();

		cy.get('#_customize-input-neve_read_more_text').clear().type( 'My custom button' );

		cy.get('#_customize-input-neve_read_more_style').select( 'secondary_button' );

		saveCustomizer();

		cy.visit('/');

		cy.get('article .read-more-wrapper' ).each(function (el) {
			cy.get(el).find( '.button-secondary' )
				.should( 'be.visible' )
				.contains('My custom button' );
		})

	});

	it( 'Single post extra meta options', function () {

		cy.login();

		navigateToSingleOptions();

		cy.get('#customize-control-neve_layout_single_post_elements_order')
			.find('li.order-component')
			.each(function (el) {
				cy.get(el).invoke('attr', 'data-id').then(function () {
					cy.get(el).invoke('attr', 'class').then((val) => {
						if (!val.includes('enabled')) {
							cy.get(el).find('.toggle-display').click();
						}
					})
				});
			});

		saveCustomizer();

		cy.visit('/template-comments/');

		cy.get('.nv-post-navigation').should('be.visible');
		cy.get('.nv-author-biography').should('be.visible');
		cy.get('.nv-related-posts').should('be.visible');
		cy.get('.nv-post-share').should('be.visible');

	});

	it( 'Related posts', function () {

		cy.login();

		navigateToSingleOptions();

		cy.get('#_customize-input-neve_related_posts_title').clear().type( 'My custom related posts title' );

		cy.get( '#_customize-input-neve_related_posts_number' ).clear().type(2);

		saveCustomizer();

		cy.visit('/template-comments/');

		cy.get( '.nv-related-posts .section-title h2' ).should('be.visible').contains('My custom related posts title' );

		cy.get( '.nv-related-posts .posts-wrapper' ).find('.related-post').should('have.length', 2);

	});

	it( 'New sharing icon', function () {

		cy.login();

		navigateToSingleOptions();

		cy.get( '#customize-control-neve_sharing_heading .accordion-expand-button' ).click();

		cy.get( '#customize-control-neve_sharing_icons .button.nv-repeater--add-new' ).click();

		cy.get( '#customize-control-neve_sharing_icons .nv-repeater--items-wrap' ).children().last().click();

		cy.get( '#customize-control-neve_sharing_icons .nv-repeater--item.expanded' )
			.find( '.nv-repeater-text-field' )
			.type( 'Pinterest' );

		cy.get( '#customize-control-neve_sharing_icons .nv-repeater--item.expanded' )
			.find('.nv--select-field select')
			.select( 'pinterest' );

		saveCustomizer();

		cy.visit('/template-comments/');

		cy.get( '.nv-post-share' ).find('.social-pinterest').should( 'be.visible' );
	});

	it( 'Show/hide comments', function () {

		cy.login();

		navigateToSingleOptions();

		cy.get( '#customize-control-neve_comments_heading .accordion-expand-button' ).click();

		cy.get( '#_customize-input-neve_comment_section_style' ).select( 'toggle' );

		saveCustomizer();

		cy.visit('/template-comments/');

		cy.get( '.comments-area' ).find( 'button#toggle-comment-area' ).should( 'be.visible' );
		cy.get( '.comments-area' ).find( '#comment-area-wrapper' ).should( 'have.class', 'nv-comments-hidden' );

		cy.get( '.comments-area' ).find( 'button#toggle-comment-area' ).click();
		cy.get( '.comments-area' ).find( '#comment-area-wrapper' ).should( 'not.have.class', 'nv-comments-hidden' );

	});

});

/**
 * Navigate to the Blog/Archive customizer panel.
 */
function navigateToBlogOptions() {
	cy.visit('/wp-admin/customize.php');
	cy.get('#accordion-panel-neve_layout').click();
	cy.get('#accordion-section-neve_blog_archive_layout').click();
}

/**
 * Navigate to the Single Post customizer panel.
 */
function navigateToSingleOptions() {
	cy.visit('/wp-admin/customize.php');
	cy.get('#accordion-panel-neve_layout').click();
	cy.get('#accordion-section-neve_single_post_layout').click();
}

/**
 * Publish customizer changes.
 */
function saveCustomizer() {
	let home = Cypress.config().baseUrl;
	cy.server().route('POST', home + '/wp-admin/admin-ajax.php').as('customizerSave');
	cy.get('#save').click({force: true});
	cy.wait('@customizerSave').then((req) => {
		expect(req.response.body.success).to.be.true;
		expect(req.status).to.equal(200);
	});
}
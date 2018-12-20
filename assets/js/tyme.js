/**
* Tyme Primary Category
* @author  Tyler Bailey <tylerb.media@gmail.com>
*/

(function($) {
	'use strict';

	// Set Primary template
	var setPrimary = wp.template('tyme-set-admin-views');
	// Unset Primary template
	var removePrimary = wp.template('tyme-unset-admin-views');

	/**
	* Wrapper for the Primary Category UI
	*/
	var tymeWrapper = (function() {
		// Function variables
		var taxEl, templateData, firstParent, topParent;

		// Get the taxonomy type from element data attribute
		function taxonomyData(el) {
			return {
				taxonomy: $(el).data('tax')
			};
		}

		// Set the hidden input value to the selected term ID
		function setPrimaryVal(el, val = false) {
			taxEl = $(firstParent).find('input[type=checkbox]');
			taxEl.prop('checked', true);
			taxEl.attr('checked', true);

			val = (val ? $(taxEl).val() : 0);
			$('[name="tyme_primary_' + $(el).data('tax') + '"]').val(val);
		}

		// Adjust the UI based on if element is primary or not
		function setPrimaryDisplay(el, isPrimary = false) {

			// Remove the existing UI element
			firstParent.removeChild(el);
			// Get the template data
			templateData = taxonomyData(el);

			// Get the current HTML (no primary UI at this time)
			var parentHTML = $(firstParent).html();

			// If the element is NOT primary
			if(!isPrimary) {
				// Display the "unset" UI (selecting primary)
				$(firstParent).html(parentHTML + setPrimary(templateData));
			} else {
				// Display the 'set' UI (removing primary)
				$(firstParent).html(parentHTML + removePrimary(templateData));
			}
		}

		return {
			// Initialize the Tyme Primary Category UI
			initTymeDisplay : function(taxonomy) {

				firstParent = $('#' + taxonomy.taxonomy + 'checklist')[0];

				if(firstParent !== null) {
					var nodeChildren = $(firstParent).find('li');

					if(nodeChildren.length > 0) {

						// Generate the template data for display
						templateData = {
							taxonomy: taxonomy.taxonomy
						};

						// Loop through each <li> element in the taxonomy list
						for(var i = 0; i < nodeChildren.length; i++) {

							// Get the list element value (taxonomy term ID)
							var child = $(nodeChildren[i]);
							var childVal = child.find('input[type=checkbox]').val();
							var templateMarkup;

							// If the element (checkbox) is primary, display the unset option
							if(childVal == taxonomy.primary) {
								templateMarkup = removePrimary(templateData);
							} else {
								// Else display the set option
								templateMarkup = setPrimary(templateData);
							}

							// Render the UI based on primary state
							var curMarkup = child.html();
							child.html(curMarkup + templateMarkup);
						}
					}

					// Add a hidden input to the bottom of the category list
					// This is where the primary term ID will live to be submitted
					var primaryCatInput = '<input type="hidden" name="tyme_primary_' + taxonomy.taxonomy + '" value="' + taxonomy.primary + '" />';
					$(firstParent).parent('div').append(primaryCatInput);
				}
			},

			// Set primary term for post
			setPrimary : function(el) {
				firstParent = $(el).parent('li')[0];

				// Generate the template data for display
				templateData = taxonomyData(el);

				// Get current primary term
				var currentPrimary = $(firstParent).parent('ul').find('.tyme-unset-primary');

				// If there IS a current primary term
				if( currentPrimary.length > 0 ) {
					topParent = currentPrimary.parent('li');

					// Remove the current primary UI AFTER targeting the parent <li>
					currentPrimary.remove();

					// Add the primary UI (Unset) to the new primary term
					var topParentHTML = topParent.html();
					topParent.html(topParentHTML + setPrimary(templateData));
				}

				setPrimaryDisplay(el, true);
				setPrimaryVal(el, true);
			},

			// Remove a posts primary term (by clicking unset)
			removePrimary : function(el) {
				firstParent = $(el).parent('li')[0];

				// Set the correct display (no 'Unset' UI)
				setPrimaryDisplay(el);
				// Set the correct value (0 if no primary selected)
				setPrimaryVal(el);
			}
		};
	})();

	// Listen for 'Set Primary' / 'Unset Primary' click events
	$('.categorydiv').on('click', 'a.tyme-category', function(e) {
		e.preventDefault();
		var el = $(this)[0];

		// If 'Set Primary' was clicked, run the setPrimary function
		if($(this).hasClass('tyme-set-primary')) {
			tymeWrapper.setPrimary(el);
		} else if($(this).hasClass('tyme-unset-primary')) {
			// Else 'Unset' was clicked, so remove the clicked primary
			tymeWrapper.removePrimary(el);
		}
	});

	// Make sure there are taxonomies in the tymeVars object
	if(tymeVars.taxonomies.length > 0) {
		// Add the Tyme Primary Category UI to the existing WP metabox
		for(var i = 0; i < tymeVars.taxonomies.length; i++) {
			tymeWrapper.initTymeDisplay(tymeVars.taxonomies[i]);
		}
	}

})(jQuery);

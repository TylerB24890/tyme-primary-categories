/**
 * Modify the core Taxonomy Gutenberg element to include Tyme Primary Categories
 */

var el = wp.element.createElement;

function tymePrimarySelect( OriginalComponent ) {

  var taxonomies = tymeVars.taxonomies;
  var primaryData = [];

  taxonomies.forEach(function(tax) {
    var primary = {};

    if( tax.primary.length > 0 ) {
      primary = {'taxonomy': tax.taxonomy, 'primary': tax.primary};
      primaryData.push(primary);
    }
  });

  return function( props ) {

    if( props.slug === primaryData[0].taxonomy ) {
      return el(
        'div',
        {},
        "This is the " + props.slug + " selector. It is not currently complete, but your primary term ID for this taxonomy is: " + primaryData[0].primary
      );
    } else {
      return el(
        OriginalComponent,
        props
      );
    }
  }
};

wp.hooks.addFilter(
  'editor.PostTaxonomyType',
  'tyme-primary-categories',
  tymePrimarySelect
);

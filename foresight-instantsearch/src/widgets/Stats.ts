import { stats } from 'instantsearch.js/es/widgets';

export const statsWidget = stats({
  container: '[data-widget="stats"]',
  templates: {
	text: `
	{{#nbHits}}
	 {{#hasNoResults}} No results{{/hasNoResults}}
	  {{#hasOneResult}} 1 result found in {{processingTimeMS}}ms{{/hasOneResult}}
	  {{#hasManyResults}}{{#helpers.formatNumber}}{{nbHits}}{{/helpers.formatNumber}} results found in {{processingTimeMS}}ms{{/hasManyResults}}
	{{/nbHits}}
  `,
}
});

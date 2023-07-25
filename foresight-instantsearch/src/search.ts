import algoliasearch from 'algoliasearch/lite';
import instantsearch from 'instantsearch.js';

import {
	impactArea,
	sdg,
	region,
	approach,
	agrifoodSystem,
	productType,
	clearFilters,
	clearFiltersEmptyResults,
	clearFiltersMobile,
	configuration,
	hitsPerPage,
	pagination,
	yearSlider,
	post,
	resultsNumberMobile,
	saveFiltersMobile,
	searchBox,
	sortBy,
	statsWidget,
} from './widgets';

const searchClient = algoliasearch(
	process.env.ALGOLIA_APPLICATION_ID,
	process.env.ALGOLIA_SEARCH_KEY
);

const search = instantsearch({
	searchClient,
	indexName: process.env.ALGOLIA_INDEX,
	routing: true,
	insights: true,
});

search.addWidgets([
	impactArea,
	sdg,
	region,
	approach,
	agrifoodSystem,
	productType,
	clearFilters,
	clearFiltersEmptyResults,
	clearFiltersMobile,
	configuration,
	hitsPerPage,
	pagination,
	yearSlider,
	post,
	resultsNumberMobile,
	saveFiltersMobile,
	searchBox,
	sortBy,
	statsWidget,
]);

search.on('render', function() {
	const overlayRender = document.querySelector('#overlayRender');
	overlayRender.setAttribute('style', 'display:none;');
});

export default search;

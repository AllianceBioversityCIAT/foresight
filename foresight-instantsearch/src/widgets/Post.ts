import { hits } from 'instantsearch.js/es/widgets';

export const post = hits({
  container: '[data-widget="hits"]',
  templates: {
    item:
      `
	<article class="hit">

	  <div class="hit-info-container">
	    <p class="hit-category">{{tags.region.lvl0}}</p>
	    {{#DOI}}
		  <div class="flex gap-2 items-center">
		  	<svg width="16" height="16" viewBox="0 0 21 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g clip-path="url(#clip0_215_1333)">
				<path d="M21 15.75V2.25C21 1.00734 19.9922 0 18.75 0H4.5C2.01469 0 0 2.01469 0 4.5V19.5C0 21.9853 2.01469 24 4.5 24H19.5C20.3283 24 21 23.3283 21 22.5422C21 21.9928 20.6903 21.5334 20.25 21.2719V17.4581C20.7094 17.0063 21 16.4156 21 15.75ZM6.70781 6H15.7078C16.1625 6 16.5 6.3375 16.5 6.75C16.5 7.1625 16.1625 7.5 15.75 7.5H6.70781C6.3375 7.5 6 7.1625 6 6.75C6 6.3375 6.3375 6 6.70781 6ZM6.70781 9H15.7078C16.1625 9 16.5 9.3375 16.5 9.75C16.5 10.1625 16.1625 10.5 15.75 10.5H6.70781C6.3375 10.5 6 10.1625 6 9.75C6 9.3375 6.3375 9 6.70781 9ZM18 21H4.5C3.67172 21 3 20.3283 3 19.5C3 18.6717 3.67172 18 4.5 18H18V21Z" fill="black"/>
				</g>
				<defs>
				<clipPath id="clip0_215_1333">
				<rect width="21" height="24" fill="white"/>
				</clipPath>
				</defs>
			</svg>
		  	<h5>{{year}}</h5>
		  </div>
	      <h5>
	        <a href="{{DOI}}" target="_blank">{{#helpers.highlight}}{ "attribute": "post_title" }{{/helpers.highlight}}</a>
	      </h5>
	    {{/DOI}}
	    {{^DOI}}
			<div class="flex gap-2 items-center">
				<svg width="16" height="16" viewBox="0 0 21 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<g clip-path="url(#clip0_215_1333)">
					<path d="M21 15.75V2.25C21 1.00734 19.9922 0 18.75 0H4.5C2.01469 0 0 2.01469 0 4.5V19.5C0 21.9853 2.01469 24 4.5 24H19.5C20.3283 24 21 23.3283 21 22.5422C21 21.9928 20.6903 21.5334 20.25 21.2719V17.4581C20.7094 17.0063 21 16.4156 21 15.75ZM6.70781 6H15.7078C16.1625 6 16.5 6.3375 16.5 6.75C16.5 7.1625 16.1625 7.5 15.75 7.5H6.70781C6.3375 7.5 6 7.1625 6 6.75C6 6.3375 6.3375 6 6.70781 6ZM6.70781 9H15.7078C16.1625 9 16.5 9.3375 16.5 9.75C16.5 10.1625 16.1625 10.5 15.75 10.5H6.70781C6.3375 10.5 6 10.1625 6 9.75C6 9.3375 6.3375 9 6.70781 9ZM18 21H4.5C3.67172 21 3 20.3283 3 19.5C3 18.6717 3.67172 18 4.5 18H18V21Z" fill="black"/>
					</g>
					<defs>
					<clipPath id="clip0_215_1333">
					<rect width="21" height="24" fill="white"/>
					</clipPath>
					</defs>
				</svg>
				<h5>{{year}}</h5>
			</div>
			<h5>
	        	<a href="{{url}}" target="_blank">{{#helpers.highlight}}{ "attribute": "post_title" }{{/helpers.highlight}}</a>
	      	</h5>
	    {{/DOI}}
	    <p class="mt-5">{{#helpers.snippet}}{ "attribute": "post_content" }{{/helpers.snippet}}</p>
	    <footer>
		<details class="accordion description relative [&_svg]:open:-rotate-180">
		<summary data-open="Show less" data-close="Show more" class="absolute bottom-0 left-0 -mb-8 flex cursor-pointer list-none items-center justify-end gap-2">
		  <div>
			<svg class="rotate-0 transform text-black-100 transition-all duration-300" fill="none" height="20" width="20" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
			  <polyline points="6 9 12 15 18 9"></polyline>
			</svg>
		  </div>
		</summary>
	      <div class="content">
	        <div class="metadata author">
	          <span class="label">Author/Creator:</span>
	          <ul>
	            {{#authors}}
	              <li><a href="?` +
      process.env.ALGOLIA_INDEX +
      `[query]=%22{{lastName}}%22 %22{{firstName}}%22">{{lastName}}, {{firstName}}</a></li>
	            {{/authors}}
	          </ul>
	        </div>
	        <div class="metadata published">
	          <span class="label">Published:</span>
	          <p>{{publication_title}}</p>
	        </div>
	        <div class="metadata language">
	          <span class="label">Language:</span>
	          <p>{{language}}</p>
	        </div>
	        <div class="metadata tags">
	        {{#tags.post_tag.length}}
	        <span class="label">Tags:</span>
	          {{#tags.post_tag}}
	          <span class="keyword"><a href="?` +
      process.env.ALGOLIA_INDEX +
      `[query]=%22{{.}}%22">{{.}}</a></span>
	          {{/tags.post_tag}}<br>
	        {{/tags.post_tag.length}}
	        {{#tags.impact-area.length}}
	        <span class="label">Impact Areas:</span>
	          {{#tags.impact-area}}
	          <span class="keyword"><a onClick="applyFilter('` +
      process.env.ALGOLIA_INDEX +
      `','refinementList', 'tags.impact-area', '{{.}}')">{{.}}</a></span>
	          {{/tags.impact-area}}<br>
	        {{/tags.impact-area.length}}
	        {{#tags.approach.length}}
	        <span class="label">Approach:</span>
	          {{#tags.approach}}
	          <span class="keyword"><a onClick="applyFilter('` +
      process.env.ALGOLIA_INDEX +
      `', 'refinementList', 'tags.approach', '{{.}}')">{{.}}</a></span>
	          {{/tags.approach}}<br>
	        {{/tags.approach.length}}
	        {{#tags.agrifood-system.length}}
	        <span class="label">Agrifood Systems:</span>
	          {{#tags.agrifood-system}}
	          <span class="keyword"><a onClick="applyFilter('` +
      process.env.ALGOLIA_INDEX +
      `', 'refinementList', 'tags.agrifood-system','{{.}}')">{{.}}</a></span>
	          {{/tags.agrifood-system}}<br>
	        {{/tags.agrifood-system.length}}

	        {{#tags.product-type.lvl0.length}}
	        <span class="label">Product Types:</span>
	          {{#tags.product-type.lvl0}}
	          <span class="keyword"><a onClick="applyFilter('` +
      process.env.ALGOLIA_INDEX +
      `', 'hierarchicalMenu', 'tags.product-type.lvl0','{{.}}')">{{.}}</a></span>
	          {{/tags.product-type.lvl0}}<br>
	        {{/tags.product-type.lvl0.length}}

	        {{#tags.region.lvl0.length}}
	          <span class="label">Regions:</span>
	        {{/tags.region.lvl0.length}}
	        {{^tags.region.lvl0.length}}
	            {{#tags.region.lvl1.length}}
	              <span class="label">Regions:</span>
	            {{/tags.region.lvl1.length}}
	        {{/tags.region.lvl0.length}}

	        {{#tags.region.lvl0}}
	        <span class="keyword"><a onClick="applyFilter('` +
      process.env.ALGOLIA_INDEX +
      `', 'hierarchicalMenu', 'tags.region.lvl0','{{.}}')">{{.}}</a></span>
	        {{/tags.region.lvl0}}

	        {{#countries}}
	        <span class="keyword"><a onClick="applyFilter('` +
      process.env.ALGOLIA_INDEX +
      `', 'hierarchicalMenu', 'tags.region.lvl0','{{1}}')">{{0}}</a></span>
	        {{/countries}}<br>

	        {{#tags.sdg.length}}
	        <p class="sdg-icons">
	          {{#sdg_icon}}
	            <a class="tooltip" onClick="applyFilter('` +
      process.env.ALGOLIA_INDEX +
      `', 'refinementList', 'tags.sdg','{{1}}')">
	              <img src="` +
      process.env.SDG_PATH_URL +
      `{{0}}.jpg" alt="{{1}}" width="48" height="48">
	              <span class="tooltiptext">{{1}}</span>
	            </a>
	          {{/sdg_icon}}
	        </p>
	        {{/tags.sdg.length}}
	        </div>
	      </div>
		  </details>
	    </footer>
	  </div>
	</article>
	`,
    empty(searchResults) {
      const hasRefinements = searchResults.getRefinements().length > 0;
      const description = hasRefinements
        ? 'Try to reset your applied filters.'
        : 'Please try another query.';

      return `
	  <div class="hits-empty-state">
	    <svg
	      xmlns="http://www.w3.org/2000/svg"
	      xmlns:xlink="http://www.w3.org/1999/xlink"
	      width="138"
	      height="138"
	      class="hits-empty-state-image"
	    >
	      <defs>
	        <linearGradient id="c" x1="50%" x2="50%" y1="100%" y2="0%">
	          <stop offset="0%" stop-color="#F5F5FA" />
	          <stop offset="100%" stop-color="#FFF" />
	        </linearGradient>
	        <path
	          id="b"
	          d="M68.71 114.25a45.54 45.54 0 1 1 0-91.08 45.54 45.54 0 0 1 0 91.08z"
	        />
	        <filter
	          id="a"
	          width="140.6%"
	          height="140.6%"
	          x="-20.3%"
	          y="-15.9%"
	          filterUnits="objectBoundingBox"
	        >
	          <feOffset dy="4" in="SourceAlpha" result="shadowOffsetOuter1" />
	          <feGaussianBlur
	            in="shadowOffsetOuter1"
	            result="shadowBlurOuter1"
	            stdDeviation="5.5"
	          />
	          <feColorMatrix
	            in="shadowBlurOuter1"
	            result="shadowMatrixOuter1"
	            values="0 0 0 0 0.145098039 0 0 0 0 0.17254902 0 0 0 0 0.380392157 0 0 0 0.15 0"
	          />
	          <feOffset dy="2" in="SourceAlpha" result="shadowOffsetOuter2" />
	          <feGaussianBlur
	            in="shadowOffsetOuter2"
	            result="shadowBlurOuter2"
	            stdDeviation="1.5"
	          />
	          <feColorMatrix
	            in="shadowBlurOuter2"
	            result="shadowMatrixOuter2"
	            values="0 0 0 0 0.364705882 0 0 0 0 0.392156863 0 0 0 0 0.580392157 0 0 0 0.2 0"
	          />
	          <feMerge>
	            <feMergeNode in="shadowMatrixOuter1" />
	            <feMergeNode in="shadowMatrixOuter2" />
	          </feMerge>
	        </filter>
	      </defs>
	      <g fill="none" fill-rule="evenodd">
	        <circle
	          cx="68.85"
	          cy="68.85"
	          r="68.85"
	          fill="#5468FF"
	          opacity=".07"
	        />
	        <circle
	          cx="68.85"
	          cy="68.85"
	          r="52.95"
	          fill="#5468FF"
	          opacity=".08"
	        />
	        <use fill="#000" filter="url(#a)" xlink:href="#b" />
	        <use fill="url(#c)" xlink:href="#b" />
	        <path
	          d="M76.01 75.44c5-5 5.03-13.06.07-18.01a12.73 12.73 0 0 0-18 .07c-5 4.99-5.03 13.05-.07 18a12.73 12.73 0 0 0 18-.06zm2.5 2.5a16.28 16.28 0 0 1-23.02.09A16.29 16.29 0 0 1 55.57 55a16.28 16.28 0 0 1 23.03-.1 16.28 16.28 0 0 1-.08 23.04zm1.08-1.08l-2.15 2.16 8.6 8.6 2.16-2.15-8.6-8.6z"
	          fill="#5369FF"
	        />
	      </g>
	    </svg>

	    <p class="hits-empty-state-title">
	      Sorry, we can't find any matches to your query!
	    </p>
	    <p class="hits-empty-state-description">
	      ${description}
	    </p>
	  </div>
	`;
    },
  },
});

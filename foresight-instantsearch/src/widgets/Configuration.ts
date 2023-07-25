import { configure } from 'instantsearch.js/es/widgets';

export const configuration = configure({
  attributesToSnippet: ['post_content:100'],
  snippetEllipsisText: '...',
  removeWordsIfNoResults: 'allOptional',
});

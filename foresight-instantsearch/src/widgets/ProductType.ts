import { panel, hierarchicalMenu } from 'instantsearch.js/es/widgets';
import { collapseButtonText } from '../templates/panel';

const productTypeHierarchicalMenu = panel({
  templates: {
    header: 'Product Type',
    collapseButtonText,
  },
  collapsed: () => false,
})(hierarchicalMenu);

export const productType = productTypeHierarchicalMenu({
  container: '[data-widget="product-type"]',
  attributes: ['tags.product-type.lvl0', 'tags.product-type.lvl1'],
  showParentLevel: true,
  operator: 'and',
  limit: 5,
  showMore: true,
  sortBy: ['count:desc', 'name:asc'],
});

import { panel, hierarchicalMenu } from 'instantsearch.js/es/widgets';
import { collapseButtonText } from '../templates/panel';

const regionHierarchicalMenu = panel({
  templates: {
    header: 'Regions',
    collapseButtonText,
  },
  collapsed: () => false,
})(hierarchicalMenu);

export const region = regionHierarchicalMenu({
  container: '[data-widget="region"]',
  attributes: ['tags.region.lvl0', 'tags.region.lvl1'],
  showParentLevel: true,
  operator: 'and',
  limit: 10,
  showMore: true,
  sortBy: ['count:desc', 'name:asc'],
});

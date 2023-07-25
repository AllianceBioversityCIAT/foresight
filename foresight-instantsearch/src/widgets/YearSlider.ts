import { panel, rangeSlider } from 'instantsearch.js/es/widgets';
import { collapseButtonText } from '../templates/panel';

const yearRangeSlider = panel({
  templates: {
    header: 'Publish Year',
    collapseButtonText,
  },
  collapsed: () => false,
})(rangeSlider);

export const yearSlider = yearRangeSlider({
  container: '[data-widget="year-range"]',
  attribute: 'year',
});

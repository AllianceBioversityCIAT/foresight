import { sortBy as sortByWidget } from 'instantsearch.js/es/widgets';

const items = [
  {
    label: 'Order by Featured',
    value: process.env.ALGOLIA_INDEX,
  },
  {
    label: 'Order by Year Asc',
    value: process.env.ALGOLIA_INDEX_ORDER_BY_YEAR_ASC,
  },
  {
    label: 'Order by Year Desc',
    value: process.env.ALGOLIA_INDEX_ORDER_BY_YEAR_DESC,
  },
];

export const sortBy = sortByWidget({
  container: '[data-widget="sort-by"]',
  items,
});

export function getFallbackSortByRoutingValue(
  sortByValue: string
): string | undefined {
  if (items.map((item) => item.value).indexOf(sortByValue) !== -1) {
    return sortByValue;
  }

  return undefined;
}

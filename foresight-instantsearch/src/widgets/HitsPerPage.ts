import { hitsPerPage as hitsPerPageWidget } from 'instantsearch.js/es/widgets';

const items = [
  {
    label: '10 items per page',
    value: 10,
    default: true,
  },
  {
    label: '20 items per page',
    value: 20,
  },
  {
    label: '30 items per page',
    value: 30,
  },
];

export const hitsPerPage = hitsPerPageWidget({
  container: '[data-widget="hits-per-page"]',
  items,
});

export function getFallbackHitsPerPageRoutingValue(
  hitsPerPageValue: string
): string | undefined {
  if (
    items.map((item) => item.value).indexOf(Number(hitsPerPageValue)) !== -1
  ) {
    return hitsPerPageValue;
  }

  return undefined;
}

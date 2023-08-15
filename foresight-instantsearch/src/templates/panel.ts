export const collapseButtonText = ({ collapsed }: { collapsed: boolean }) =>
  collapsed
    ? `
<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M3.1105 10.2864L7.42683 5.97004L11.7432 10.2864L12.9044 9.12513L7.42683 3.64755L1.94925 9.12513L3.1105 10.2864Z" fill="white"/>
</svg>
  `
    : `
<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M11.7432 3.64771L7.42684 7.96404L3.1105 3.6477L1.94926 4.80895L7.42684 10.2865L12.9044 4.80895L11.7432 3.64771Z" fill="white"/>
</svg>
  `;

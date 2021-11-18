function addTableRow(x, y, dist) {
    const row = `
        <tr>
        <td>${x}</td>
        <td>${y}</td>
        <td>${dist}</td>
        </tr>`;
    out.insertAdjacentHTML('beforeend', row);
}

function addDot(x, y) {

    const svgns = 'http://www.w3.org/2000/svg';
    const dot = document.createElementNS(svgns, 'circle');

    dot.setAttributeNS(null, 'cx', x);
    dot.setAttributeNS(null, 'cy', y);
    dot.setAttributeNS(null, 'r', 3);
    svg.appendChild(dot);
}

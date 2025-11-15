"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const needle = {
    name: 'Silker Needle',
    damage: 15,
    range: 3,
};
const output02 = document.getElementById('output02');
if (output02) {
    output02.innerHTML = `
    <li><strong>Weapon:</strong> ${needle.name}</li>
    <li><strong>Damage:</strong> ${needle.damage}</li>
    <li><strong>Range:</strong> ${needle.range}</li>   
    `;
}
//# sourceMappingURL=02-interfaces.js.map
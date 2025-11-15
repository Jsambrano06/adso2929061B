"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
function calculateAttack(baseDamage, multiplier) {
    return baseDamage * multiplier;
}
const attack = calculateAttack(15, 3);
const output03 = document.getElementById('output03');
if (output03) {
    output03.innerHTML = `
    <li><strong>Base damage:</strong> 15 </li>
    <li><strong>Multiplier:</strong> 3X</li>
    <li><strong>Totatl attack:</strong> ${attack}</li>
    `;
}
//# sourceMappingURL=03-functions.js.map
"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
// basic types:string, number, boolean
const characterName = "Hornet";
const health = 100;
const canDoubleJump = true;
const tools = ["Tacks", "Curveclaw", "Cogly"];
const personalData = ["Hornet", 100];
const dynamicVariable = "This can be anything";
//display in browser
const output = document.getElementById('output');
if (output) {
    output.innerHTML = `
        <li><strong>Character:</strong> ${characterName}</li>
        <li><strong>Health:</strong> ${health}</li>
        <li><strong>Can Double Jump:</strong> ${canDoubleJump}</li>
        <li><strong>Tools:</strong> ${tools}</li>
        <li><strong>Data:</strong> ${personalData}</li>
        <li><strong>Dinamic:</strong> ${dynamicVariable}</li>
    `;
}
//# sourceMappingURL=01-basic-types.js.map
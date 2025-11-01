// basic types:string, number, boolean
const characterName:    string           = "Hornet";
const health:           number           = 100;
const canDoubleJump:    boolean          = true;
const tools:            string[]         = ["Tacks", "Curveclaw", "Cogly"];
const personalData:     [string, number] = ["Hornet", 100];
const dynamicVariable:  any              = "This can be anything";

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
"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
class Inventoru {
    items = [];
    addItem(item) {
        this.items.push(item);
    }
    getItems() {
        return this.items;
    }
}
const charmInventory = new Inventoru();
charmInventory.addItem('Mothwing Cloak');
charmInventory.addItem('Crystal Heart');
const output05 = document.getElementById('output05');
if (output05) {
    output05.innerHTML = `
    <li><strong>Charms collected:</strong></li>
    <ul>${charmInventory.getItems().map(c => `<li>${c}</li>`).join('')}</ul>
    `;
}
//# sourceMappingURL=05-generics.js.map
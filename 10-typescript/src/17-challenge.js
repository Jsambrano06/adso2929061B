"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
// TIPOS BÁSICOS
let souls = 0;
let autoActive = false;
let intervalId = 0;
// ENUM
var Action;
(function (Action) {
    Action["ADD"] = "add";
    Action["REMOVE"] = "remove";
    Action["AUTO"] = "auto";
    Action["STOP"] = "stop";
    Action["RESET"] = "reset";
})(Action || (Action = {}));
// CLASE
class SoulsGame {
    // Constructor
    constructor() {
        this.updateButtons();
    }
    // Método para añadir
    addSoul() {
        souls++;
        this.updateDisplay();
        this.log("+1 soul added");
    }
    // Método para remover
    removeSoul() {
        if (souls > 0) {
            souls--;
            this.updateDisplay();
            this.log("-1 soul removed");
        }
        else {
            this.log("No souls to remove!");
        }
    }
    // Método para auto
    toggleAuto() {
        if (!autoActive) {
            // Iniciar auto
            autoActive = true;
            intervalId = setInterval(() => {
                this.addSoul();
            }, 1000);
            this.log("Auto collect started");
        }
        else {
            // Detener auto
            autoActive = false;
            clearInterval(intervalId);
            this.log("Auto collect stopped");
        }
        this.updateButtons();
    }
    // Método para reset
    reset() {
        souls = 0;
        autoActive = false;
        clearInterval(intervalId);
        this.updateDisplay();
        this.updateButtons();
        this.log("Reset to 0");
    }
    // Actualizar display
    updateDisplay() {
        const counter = document.getElementById('counter');
        if (counter) {
            counter.textContent = souls.toString();
            if (souls >= 100) {
                counter.style.color = '#FFD700';
            }
            else if (souls >= 50) {
                counter.style.color = '#4CAF50';
            }
            else {
                counter.style.color = '#FF6B6B';
            }
        }
    }
    // Actualizar botones
    updateButtons() {
        const autoBtn = document.querySelector('button[data-action="auto"]');
        const stopBtn = document.querySelector('button[data-action="stop"]');
        if (autoBtn) {
            autoBtn.textContent = autoActive ? 'Auto ON' : 'Auto Collect';
            autoBtn.style.background = autoActive ? '#FF9800' : '#4CAF50';
        }
        if (stopBtn) {
            stopBtn.style.display = autoActive ? 'inline-block' : 'none';
        }
    }
    // Log
    log(message) {
        const logDiv = document.getElementById('log');
        if (logDiv) {
            const time = new Date().toLocaleTimeString();
            const p = document.createElement('p');
            p.textContent = `[${time}] ${message}`;
            logDiv.appendChild(p);
            // Mantener solo 5 mensajes
            if (logDiv.children.length > 5) {
                logDiv.removeChild(logDiv.firstChild);
            }
        }
    }
}
// INICIALIZAR
window.onload = () => {
    const game = new SoulsGame(); // Esto llama automáticamente al constructor
    // Botones
    const addBtn = document.querySelector('button[data-action="add"]');
    const removeBtn = document.querySelector('button[data-action="remove"]');
    const autoBtn = document.querySelector('button[data-action="auto"]');
    const stopBtn = document.querySelector('button[data-action="stop"]');
    const resetBtn = document.querySelector('button[data-action="reset"]');
    if (addBtn) {
        addBtn.addEventListener('click', () => game.addSoul());
    }
    if (removeBtn) {
        removeBtn.addEventListener('click', () => game.removeSoul());
    }
    if (autoBtn) {
        autoBtn.addEventListener('click', () => game.toggleAuto());
    }
    if (stopBtn) {
        stopBtn.addEventListener('click', () => game.toggleAuto());
    }
    if (resetBtn) {
        resetBtn.addEventListener('click', () => game.reset());
    }
    // Primer mensaje
    const logDiv = document.getElementById('log');
    if (logDiv) {
        logDiv.innerHTML = '<p>Game started. Click buttons to collect souls!</p>';
    }
};
//# sourceMappingURL=17-challenge.js.map
"use strict";
// ========================================
// 17-CHALLENGE.TS - EJERCICIO INTEGRADOR
// ========================================
// Este ejercicio combina: tipos básicos, interfaces, funciones, 
// clases, genéricos, enums, y más conceptos de TypeScript
// 1. ENUMS - Estados del juego
var GameStatus;
(function (GameStatus) {
    GameStatus["EXPLORING"] = "Exploring";
    GameStatus["COMBAT"] = "In Combat";
    GameStatus["RESTING"] = "Resting";
    GameStatus["DEFEATED"] = "Defeated";
})(GameStatus || (GameStatus = {}));
var ElementType;
(function (ElementType) {
    ElementType["PHYSICAL"] = "Physical";
    ElementType["SOUL"] = "Soul";
    ElementType["VOID"] = "Void";
})(ElementType || (ElementType = {}));
// 3. CLASE BASE CON GENÉRICOS - Inventario
class Inventory {
    constructor(maxCapacity = 20) {
        this.items = [];
        this.maxCapacity = maxCapacity;
    }
    addItem(item) {
        if (this.items.length >= this.maxCapacity) {
            return false;
        }
        this.items.push(item);
        return true;
    }
    removeItem(itemName) {
        const index = this.items.findIndex(item => item.name === itemName);
        if (index !== -1) {
            return this.items.splice(index, 1)[0];
        }
        return undefined;
    }
    getItems() {
        return [...this.items];
    }
    getTotalValue() {
        return this.items.reduce((sum, item) => sum + item.value, 0);
    }
}
// 4. CLASES - Personajes del juego
class GameCharacter {
    constructor(name, stats) {
        this.name = name;
        this.stats = stats;
        this.status = GameStatus.EXPLORING;
        this.inventory = new Inventory(15);
        this.soul = 33;
        this.maxSoul = 99;
    }
    takeDamage(damage, element = ElementType.PHYSICAL) {
        const reduction = element === ElementType.PHYSICAL ? this.stats.defense : 0;
        const finalDamage = Math.max(damage - reduction, 0);
        this.stats.health -= finalDamage;
        if (this.stats.health <= 0) {
            this.stats.health = 0;
            this.status = GameStatus.DEFEATED;
        }
        return finalDamage;
    }
    heal(amount) {
        this.stats.health = Math.min(this.stats.health + amount, this.stats.maxHealth);
        this.soul -= 33;
    }
    gainSoul(amount) {
        this.soul = Math.min(this.soul + amount, this.maxSoul);
    }
    getHealthPercentage() {
        return Math.round((this.stats.health / this.stats.maxHealth) * 100);
    }
    isAlive() {
        return this.stats.health > 0;
    }
}
class Knight extends GameCharacter {
    constructor(name) {
        super(name, {
            health: 100,
            maxHealth: 100,
            damage: 15,
            defense: 5
        });
        this.abilities = this.initializeAbilities();
    }
    initializeAbilities() {
        return [
            {
                name: "Vengeful Spirit",
                soulCost: 33,
                element: ElementType.SOUL,
                execute: () => "Fires a spirit blast dealing 15 damage!"
            },
            {
                name: "Desolate Dive",
                soulCost: 33,
                element: ElementType.SOUL,
                execute: () => "Slams down with soul energy dealing 20 damage!"
            }
        ];
    }
    useAbility(abilityName) {
        const ability = this.abilities.find(a => a.name === abilityName);
        if (!ability)
            return null;
        if (this.soul < ability.soulCost)
            return "Not enough SOUL!";
        this.soul -= ability.soulCost;
        return ability.execute();
    }
    attack(target) {
        const damage = this.stats.damage;
        this.gainSoul(11);
        return target.takeDamage(damage, ElementType.PHYSICAL);
    }
}
class GameEnemy extends GameCharacter {
    constructor(name, stats, aggressionLevel = 50) {
        super(name, stats);
        this.aggressionLevel = aggressionLevel;
    }
    attack(target) {
        const damage = this.stats.damage + Math.floor(Math.random() * 5);
        return target.takeDamage(damage, ElementType.PHYSICAL);
    }
    getAggressionLevel() {
        return this.aggressionLevel;
    }
}
// 5. FUNCIONES - Utilidades del juego
function calculateCriticalHit(baseDamage, critChance = 0.15) {
    const isCrit = Math.random() < critChance;
    return isCrit ? baseDamage * 2 : baseDamage;
}
function createItem(name, description, value) {
    return { name, description, value };
}
function simulateCombat(player, enemy) {
    let log = `⚔️ Combat started: ${player.name} vs ${enemy.name}\n\n`;
    let round = 1;
    while (player.isAlive() && enemy.isAlive()) {
        log += `--- Round ${round} ---\n`;
        // Turno del jugador
        const playerDamage = player.attack(enemy);
        log += `${player.name} attacks for ${playerDamage} damage! (Enemy HP: ${enemy.stats.health}/${enemy.stats.maxHealth})\n`;
        if (!enemy.isAlive()) {
            log += `\n🎉 Victory! ${enemy.name} defeated!\n`;
            break;
        }
        // Turno del enemigo
        const enemyDamage = enemy.attack(player);
        log += `${enemy.name} attacks for ${enemyDamage} damage! (Player HP: ${player.stats.health}/${player.stats.maxHealth})\n`;
        if (!player.isAlive()) {
            log += `\n💀 Defeat! ${player.name} was defeated...\n`;
            break;
        }
        // Curación del jugador si tiene suficiente SOUL
        if (player.soul >= 33 && player.stats.health < player.stats.maxHealth * 0.5) {
            player.heal(33);
            log += `${player.name} uses Focus to heal! (HP: ${player.stats.health}/${player.stats.maxHealth}, SOUL: ${player.soul})\n`;
        }
        log += `\n`;
        round++;
        if (round > 20) {
            log += "Combat timeout - Draw!\n";
            break;
        }
    }
    return log;
}
// ========================================
// EJECUCIÓN DEL EJERCICIO
// ========================================
// Crear el caballero
const knight = new Knight("The Knight");
// Agregar items al inventario
knight.inventory.addItem(createItem("Wanderer's Journal", "A traveler's notes", 200));
knight.inventory.addItem(createItem("Hallownest Seal", "An ancient seal", 450));
knight.inventory.addItem(createItem("King's Idol", "A precious idol", 300));
knight.inventory.addItem(createItem("Pale Ore", "Rare forging material", 0));
// Crear enemigos
const mossCharger = new GameEnemy("Moss Charger", {
    health: 50,
    maxHealth: 50,
    damage: 10,
    defense: 2
}, 70);
const vengeFly = new GameEnemy("Vengefly", {
    health: 30,
    maxHealth: 30,
    damage: 8,
    defense: 0
}, 85);
// Simular combate
const combatLog1 = simulateCombat(knight, mossCharger);
// Resetear stats del knight para segundo combate
knight.stats.health = knight.stats.maxHealth;
knight.soul = 33;
knight.status = GameStatus.EXPLORING;
const combatLog2 = simulateCombat(knight, vengeFly);
// Usar habilidad
const abilityResult = knight.useAbility("Vengeful Spirit");
// ========================================
// MOSTRAR RESULTADOS EN EL NAVEGADOR
// ========================================
const output17 = document.getElementById('output17');
if (output17) {
    output17.innerHTML = `
        <div style="font-family: 'Courier New', monospace; background: #1a1a1a; color: #e0e0e0; padding: 20px; border-radius: 8px;">
            <h2 style="color: #00d9ff; border-bottom: 2px solid #00d9ff; padding-bottom: 10px;">
                🎮 HOLLOW KNIGHT - TypeScript Challenge
            </h2>
            
            <div style="margin: 20px 0; padding: 15px; background: #2a2a2a; border-left: 4px solid #ff6b6b;">
                <h3 style="color: #ff6b6b; margin-top: 0;">👤 Character Info</h3>
                <ul style="list-style: none; padding: 0;">
                    <li><strong>Name:</strong> ${knight.name}</li>
                    <li><strong>Health:</strong> ${knight.stats.health}/${knight.stats.maxHealth} (${knight.getHealthPercentage()}%)</li>
                    <li><strong>Soul:</strong> ${knight.soul}/${knight.maxSoul}</li>
                    <li><strong>Damage:</strong> ${knight.stats.damage}</li>
                    <li><strong>Defense:</strong> ${knight.stats.defense}</li>
                    <li><strong>Status:</strong> ${knight.status}</li>
                </ul>
            </div>

            <div style="margin: 20px 0; padding: 15px; background: #2a2a2a; border-left: 4px solid #ffd700;">
                <h3 style="color: #ffd700; margin-top: 0;">🎒 Inventory (${knight.inventory.getItems().length} items)</h3>
                <ul style="list-style: none; padding: 0;">
                    ${knight.inventory.getItems().map(item => `<li style="margin: 5px 0;">• <strong>${item.name}</strong> - ${item.description} ${item.value > 0 ? `(${item.value} Geo)` : ''}</li>`).join('')}
                    <li style="margin-top: 10px; color: #ffd700;"><strong>Total Value:</strong> ${knight.inventory.getTotalValue()} Geo</li>
                </ul>
            </div>

            <div style="margin: 20px 0; padding: 15px; background: #2a2a2a; border-left: 4px solid #9b59b6;">
                <h3 style="color: #9b59b6; margin-top: 0;">⚔️ Combat Log #1</h3>
                <pre style="background: #1a1a1a; padding: 10px; border-radius: 4px; overflow-x: auto; color: #e0e0e0;">${combatLog1}</pre>
            </div>

            <div style="margin: 20px 0; padding: 15px; background: #2a2a2a; border-left: 4px solid #9b59b6;">
                <h3 style="color: #9b59b6; margin-top: 0;">⚔️ Combat Log #2</h3>
                <pre style="background: #1a1a1a; padding: 10px; border-radius: 4px; overflow-x: auto; color: #e0e0e0;">${combatLog2}</pre>
            </div>

            <div style="margin: 20px 0; padding: 15px; background: #2a2a2a; border-left: 4px solid #00d9ff;">
                <h3 style="color: #00d9ff; margin-top: 0;">✨ Ability Test</h3>
                <p><strong>Using Vengeful Spirit:</strong> ${abilityResult || 'Success!'}</p>
                <p><strong>Remaining SOUL:</strong> ${knight.soul}</p>
            </div>

            <div style="margin: 20px 0; padding: 15px; background: #2a2a2a; border-left: 4px solid #2ecc71;">
                <h3 style="color: #2ecc71; margin-top: 0;">📚 Concepts Used</h3>
                <ul style="columns: 2; -webkit-columns: 2; -moz-columns: 2;">
                    <li>✅ Basic Types</li>
                    <li>✅ Interfaces</li>
                    <li>✅ Functions</li>
                    <li>✅ Classes</li>
                    <li>✅ Generics</li>
                    <li>✅ Enums</li>
                    <li>✅ Inheritance</li>
                    <li>✅ Access Modifiers</li>
                    <li>✅ Type Guards</li>
                    <li>✅ Union Types</li>
                    <li>✅ Array Methods</li>
                    <li>✅ Optional Parameters</li>
                </ul>
            </div>
        </div>
    `;
}

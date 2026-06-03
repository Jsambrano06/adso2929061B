import { useState } from "react";
import BtnBack from "../components/BtnBack";

function Example5Events() {
  const [chosenPokemon, setChosenPokemon] = useState(null);
  const [hoveredPokemon, setHoveredPokemon] = useState(null);
  const [inputRange, setInputRange] = useState(50);

  const handleChoice = (name) => {
    setChosenPokemon(name);
  };

  const handleMouseEnter = (name) => {
    setHoveredPokemon(name);
  };

  const handleMouseLeave = () => {
    setHoveredPokemon(null);
  };

  const handleInput = (e) => {
    setInputRange(e.target.value);
  };

  const eventContainer = {
    padding: "20px",
    borderRadius: "12px",
    background: "#f4f4f4",
    marginTop: "20px",
    color: "black",
  };

  const titleH3 = {
    marginTop: "30px",
    color: "black",
  };

  const btnsClick = {
    display: "flex",
    gap: "20px",
    flexWrap: "wrap",
  };

  const buttonStyle = {
    padding: "15px",
    border: "none",
    borderRadius: "12px",
    cursor: "pointer",
    color: "black",
    fontSize: "18px",
    fontWeight: "bold",
    background: "#ffffff",
  };

  const hoverStyle = {
    padding: "15px",
    border: "none",
    borderRadius: "12px",
    cursor: "pointer",
    display: "flex",
    flexDirection: "column",
    alignItems: "center",
    gap: "10px",
    color: "black",
    fontSize: "18px",
    fontWeight: "bold",
    background: "#ffffff",
  };

  const chosenPokemonStyle = {
    marginTop: "20px",
    padding: "15px",
    textAlign: "center",
    borderRadius: "10px",
    background: "#e8e8e8",
    color: "black",
    fontWeight: "bold",
    fontSize: "20px",
  };

  const rangeStyle = {
    width: "100%",
  };

  const outPut = {
    textAlign: "center",
    fontSize: "40px",
    fontWeight: "bold",
    marginTop: "10px",
    color: "black",
  };

  return (
    <div className="container">
      <BtnBack />

      <h2 style={{ color: "black" }}>Example 5: Event Handling</h2>

      <p style={{ color: "black" }}>
        Respond to user interactions (click, hover, input, submit).
      </p>

      <div style={eventContainer}>
        <h3 style={titleH3}>Click Event:</h3>

        <div style={btnsClick}>
          <button onClick={() => handleChoice("Bulbasaur")} style={buttonStyle}>
            🌱 Bulbasaur
          </button>

          <button
            onClick={() => handleChoice("Charmander")}
            style={buttonStyle}
          >
            🔥 Charmander
          </button>

          <button onClick={() => handleChoice("Squirtle")} style={buttonStyle}>
            💧 Squirtle
          </button>
        </div>

        <div style={chosenPokemonStyle}>
          {chosenPokemon
            ? `You chose ${chosenPokemon}!`
            : "Please choose a pokemon!"}
        </div>

        <h3 style={titleH3}>MouseEnter / MouseLeave:</h3>

        <div style={btnsClick}>
          <button
            onMouseEnter={() => handleMouseEnter("Pikachu")}
            onMouseLeave={handleMouseLeave}
            style={hoverStyle}
          >
            Hover Here
            <img
              width="170"
              src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png"
              alt="Pikachu"
            />
          </button>

          <button
            onMouseEnter={() => handleMouseEnter("Eevee")}
            onMouseLeave={handleMouseLeave}
            style={hoverStyle}
          >
            Hover Here Too
            <img
              width="170"
              src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/133.png"
              alt="Eevee"
            />
          </button>
        </div>

        {hoveredPokemon && (
          <div style={chosenPokemonStyle}>
            You are viewing: {hoveredPokemon}
          </div>
        )}

        <h3 style={titleH3}>Input Event:</h3>

        <input
          type="range"
          min="0"
          max="100"
          value={inputRange}
          onInput={handleInput}
          style={rangeStyle}
        />

        <span
          style={{
            display: "block",
            textAlign: "center",
            marginTop: "10px",
            color: "black",
            fontSize: "20px",
          }}
        >
          Power:
        </span>

        <div style={outPut}>{inputRange}</div>
      </div>
    </div>
  );
}

export default Example5Events;

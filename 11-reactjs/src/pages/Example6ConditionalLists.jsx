import { useState } from "react";
import BtnBack from "../components/BtnBack";

function Example6ConditionalLists() {
  const [pcBox, setPcBox] = useState([
    {
      id: 1,
      name: "Pidgey",
      level: 3,
      type: "Normal/Flying",
      image:
        "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/16.png",
    },

    {
      id: 2,
      name: "Rattata",
      level: 2,
      type: "Normal",
      image:
        "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/19.png",
    },

    {
      id: 3,
      name: "Zubat",
      level: 4,
      type: "Poison/Flying",
      image:
        "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/41.png",
    },

    {
      id: 4,
      name: "Geodude",
      level: 5,
      type: "Rock/Ground",
      image:
        "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/74.png",
    },
  ]);

  const [typeFilter, setTypeFilter] = useState("all");
  const [showOnlyHighLevel, setShowOnlyHighLevel] = useState(false);

  const releasePokemon = (id) => {
    setPcBox(pcBox.filter((pokemon) => pokemon.id !== id));
  };

  const addPokemon = () => {
    const newPokemon = [
      {
        name: "Caterpie",
        level: 2,
        type: "Bug",
        image:
          "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/10.png",
      },

      {
        name: "Weedle",
        level: 2,
        type: "Bug/Poison",
        image:
          "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/13.png",
      },

      {
        name: "Pidgeotto",
        level: 8,
        type: "Normal/Flying",
        image:
          "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/17.png",
      },
    ];

    const random = newPokemon[Math.floor(Math.random() * newPokemon.length)];

    setPcBox([
      ...pcBox,

      {
        ...random,
        id: Date.now(),
      },
    ]);
  };

  const filteredPokemon = pcBox.filter((pokemon) => {
    if (
      typeFilter !== "all" &&
      !pokemon.type.toLowerCase().includes(typeFilter)
    ) {
      return false;
    }

    if (showOnlyHighLevel && pokemon.level < 4) {
      return false;
    }

    return true;
  });

  return (
    <div className="container">
      <BtnBack />

      <h2>Example 6: Conditional Rendering</h2>

      <p>Show or hide UI elements based on state.</p>

      <h3>Filters:</h3>

      <div style={filtersContainer}>
        <select
          value={typeFilter}
          onChange={(e) => setTypeFilter(e.target.value)}
        >
          <option value="all">All Types</option>

          <option value="normal">Normal</option>

          <option value="flying">Flying</option>

          <option value="poison">Poison</option>

          <option value="bug">Bug</option>
        </select>

        <label>
          <input
            type="checkbox"
            checked={showOnlyHighLevel}
            onChange={(e) => setShowOnlyHighLevel(e.target.checked)}
          />
          Show only level 4+
        </label>

        <button style={buttonStyle} onClick={addPokemon}>
          Random Pokemon
        </button>
      </div>

      <p>
        <strong>
          Showing {filteredPokemon.length}
          of {pcBox.length}
          Pokémon
        </strong>
      </p>

      {filteredPokemon.length === 0 ? (
        <div style={emptyBox}>
          <h2>No Pokémon found</h2>

          <p>Try changing filters</p>
        </div>
      ) : (
        <div style={cardsContainer}>
          {filteredPokemon.map((pokemon) => (
            <div key={pokemon.id} style={boxPk}>
              <img src={pokemon.image} alt={pokemon.name} style={pokemonImg} />

              <h3 style={{ color: "black" }}>{pokemon.name}</h3>

              <p style={{ color: "black" }}>Level: {pokemon.level}</p>

              <p style={{ color: "black" }}>{pokemon.type}</p>

              <button
                style={releaseButton}
                onClick={() => releasePokemon(pokemon.id)}
              >
                Release
              </button>
            </div>
          ))}
        </div>
      )}
    </div>
  );
}

export default Example6ConditionalLists;

const filtersContainer = {
  display: "flex",
  gap: "20px",
  flexWrap: "wrap",
  alignItems: "center",
  marginBottom: "20px",
};

const cardsContainer = {
  display: "grid",
  gridTemplateColumns: "repeat(3,1fr)",
  gap: "20px",
  marginTop: "20px",
};

const buttonStyle = {
  padding: "10px 18px",
  border: "none",
  borderRadius: "10px",
  background: "#74c8f4",
  cursor: "pointer",
  color: "white",
};

const boxPk = {
  padding: "25px",
  background: "white",
  borderRadius: "15px",
  display: "flex",
  flexDirection: "column",
  alignItems: "center",
  justifyContent: "center",
  gap: "12px",
  boxShadow: "0 3px 10px rgba(0,0,0,.15)",
  color: "black",
  textAlign: "center",
  minHeight: "320px",
};

const pokemonImg = {
  width: "170px",
  height: "170px",
  objectFit: "contain",
};

const releaseButton = {
  padding: "10px 18px",
  border: "none",
  background: "#ff6868",
  color: "white",
  borderRadius: "8px",
  cursor: "pointer",
  fontSize: "16px",
};

const emptyBox = {
  padding: "30px",
  background: "white",
  borderRadius: "15px",
  textAlign: "center",
  color: "black",
};

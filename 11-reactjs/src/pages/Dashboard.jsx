import { useEffect, useState, useMemo } from "react";
import { useNavigate } from "react-router-dom";
import { Search, Plus } from "lucide-react";
import MobileLayout from "../components/MobileLayout";
import Header from "../components/Header";
import PetCard from "../components/PetCard";
import { useAuth } from "../context/AuthContext";
import { petService } from "../services/petService";

function Dashboard() {
  const navigate = useNavigate();
  const { user } = useAuth();
  const [pets, setPets] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");
  const [search, setSearch] = useState("");

  const loadPets = async () => {
    setLoading(true);
    setError("");
    try {
      const data = await petService.list();
      setPets(data);
    } catch {
      setError("No se pudieron cargar las mascotas");
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    loadPets();
  }, []);

  const filteredPets = useMemo(() => {
    if (!search.trim()) return pets;
    const q = search.toLowerCase();
    return pets.filter(
      (p) =>
        p.name?.toLowerCase().includes(q) ||
        p.bread?.toLowerCase().includes(q) ||
        p.kind?.toLowerCase().includes(q)
    );
  }, [pets, search]);

  const firstName = user?.name?.split(" ")[0] || "User";

  return (
    <MobileLayout>
      <Header title="PetManager" showSearch />

      <h2 className="pm-title" style={{ fontSize: 24 }}>
        Welcome Back, {firstName}!
      </h2>
      <p className="pm-subtitle">Your pets are looking great today.</p>

      <div className="pm-search">
        <Search className="pm-search__icon" size={18} />
        <input
          type="search"
          className="pm-search__input"
          placeholder="Search your pets..."
          value={search}
          onChange={(e) => setSearch(e.target.value)}
        />
      </div>

      <div className="pm-summary-row">
        <div className="pm-summary-card pm-summary-card--accent">
          <div className="pm-summary-card__label">UPCOMING</div>
          <div className="pm-summary-card__value">2 Visits</div>
          <div className="pm-summary-card__note">Datos de ejemplo — pendiente API</div>
        </div>
        <div className="pm-summary-card pm-summary-card--neutral">
          <div className="pm-summary-card__label" style={{ color: "var(--text-secondary)" }}>
            MEDS DUE
          </div>
          <div className="pm-summary-card__value">3:00 PM</div>
          <div className="pm-summary-card__note">Datos de ejemplo — pendiente API</div>
        </div>
      </div>

      <div className="pm-section-header">
        <h3 className="pm-section-title">Your Family</h3>
        <button type="button" className="pm-section-header__link">
          View All
        </button>
      </div>

      {loading && (
        <div className="pm-loading">
          <div className="pm-spinner" />
        </div>
      )}

      {error && <div className="pm-error-banner">{error}</div>}

      {!loading && !error && filteredPets.length === 0 && (
        <div className="pm-empty">
          {search ? "No se encontraron mascotas" : "Aún no tienes mascotas. ¡Agrega la primera!"}
        </div>
      )}

      {!loading &&
        filteredPets.map((pet) => (
          <PetCard key={pet.id} pet={pet} onDeleted={(id) => setPets((prev) => prev.filter((p) => p.id !== id))} />
        ))}

      <button
        type="button"
        className="pm-fab"
        onClick={() => navigate("/pets/add")}
        aria-label="Agregar mascota"
      >
        <Plus size={24} />
      </button>
    </MobileLayout>
  );
}

export default Dashboard;

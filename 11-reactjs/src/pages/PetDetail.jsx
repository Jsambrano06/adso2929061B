import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import { PawPrint, Scale, Calendar, Tag, MapPin } from "lucide-react";
import MobileLayout from "../components/MobileLayout";
import Header from "../components/Header";
import { petService } from "../services/petService";

function PetDetail() {
  const { id } = useParams();
  const [pet, setPet] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");

  useEffect(() => {
    const load = async () => {
      setLoading(true);
      try {
        const data = await petService.getById(id);
        setPet(data);
      } catch {
        setError("No se pudo cargar la mascota");
      } finally {
        setLoading(false);
      }
    };
    load();
  }, [id]);

  if (loading) {
    return (
      <MobileLayout>
        <Header title="PetManager" showBack showSearch />
        <div className="pm-loading">
          <div className="pm-spinner" />
        </div>
      </MobileLayout>
    );
  }

  if (error || !pet) {
    return (
      <MobileLayout>
        <Header title="PetManager" showBack showSearch />
        <div className="pm-error-banner">{error || "Mascota no encontrada"}</div>
      </MobileLayout>
    );
  }

  const stats = [
    { label: "Type", value: pet.kind || "—", icon: PawPrint },
    { label: "Weight", value: pet.weight != null ? `${pet.weight} kg` : "—", icon: Scale },
    { label: "Age", value: pet.age != null ? `${pet.age} Years` : "—", icon: Calendar },
    { label: "Breed", value: pet.bread || "—", icon: Tag },
  ];

  return (
    <MobileLayout>
      <Header title="PetManager" showBack showSearch />

      {pet.image ? (
        <img src={pet.image} alt={pet.name} className="pm-pet-hero" />
      ) : (
        <div className="pm-pet-hero pm-pet-hero--placeholder">
          <PawPrint size={48} />
        </div>
      )}

      <span className="pm-pet-badge">ID: PM-{String(pet.id).padStart(4, "0")}</span>
      <h2 className="pm-pet-name">{pet.name}</h2>

      <div className="pm-stats-grid">
        {stats.map(({ label, value, icon: Icon }) => (
          <div key={label} className="pm-stat-card">
            <div className="pm-stat-card__icon">
              <Icon size={18} />
            </div>
            <div className="pm-stat-card__label">{label}</div>
            <div className="pm-stat-card__value">{value}</div>
          </div>
        ))}
      </div>

      {pet.location && (
        <div className="pm-detail-section">
          <h3 className="pm-detail-section__title">
            <MapPin size={18} color="var(--accent-primary)" />
            Location
          </h3>
          <p className="pm-detail-section__text">{pet.location}</p>
        </div>
      )}

      {pet.description && (
        <div className="pm-detail-section">
          <h3 className="pm-detail-section__title">Description</h3>
          <p className="pm-detail-section__text">{pet.description}</p>
        </div>
      )}
    </MobileLayout>
  );
}

export default PetDetail;

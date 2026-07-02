import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { MoreVertical, PawPrint, Trash2, X } from "lucide-react";
import { petService } from "../services/petService";

function formatAge(age) {
  if (!age && age !== 0) return "";
  return `${age} yr${age === 1 ? "" : "s"}`;
}

function PetCard({ pet, onDeleted }) {
  const navigate = useNavigate();
  const [menuOpen, setMenuOpen] = useState(false);
  const [deleting, setDeleting] = useState(false);
  const [confirmOpen, setConfirmOpen] = useState(false);

  const handleDelete = async (e) => {
    e.stopPropagation();
    setConfirmOpen(true);
  };

  const confirmDelete = async () => {
    setDeleting(true);
    try {
      await petService.remove(pet.id);
      onDeleted?.(pet.id);
      setConfirmOpen(false);
    } catch (err) {
      alert(err?.response?.data?.message || "Error al eliminar la mascota");
    } finally {
      setDeleting(false);
      setMenuOpen(false);
    }
  };

  return (
    <div
      className="pm-pet-card"
      onClick={() => navigate(`/pets/${pet.id}`)}
      role="button"
      tabIndex={0}
      onKeyDown={(e) => e.key === "Enter" && navigate(`/pets/${pet.id}`)}
    >
      {pet.image ? (
        <img src={pet.image} alt={pet.name} className="pm-pet-card__avatar" />
      ) : (
        <div className="pm-pet-card__avatar pm-pet-card__avatar--placeholder">
          <PawPrint size={24} />
        </div>
      )}
      <div className="pm-pet-card__info">
        <div className="pm-pet-card__name">{pet.name}</div>
        <div className="pm-pet-card__meta">
          {pet.bread || pet.kind}
          {pet.age != null && ` • ${formatAge(pet.age)}`}
        </div>
      </div>
      <div
        className="pm-pet-card__menu-wrap"
        onClick={(e) => e.stopPropagation()}
      >
        <button
          type="button"
          className="pm-pet-card__menu-btn"
          onClick={() => setMenuOpen(!menuOpen)}
          disabled={deleting}
          aria-label="Opciones"
        >
          <MoreVertical size={18} />
        </button>
        {menuOpen && (
          <div className="pm-pet-card__dropdown">
            <button
              type="button"
              onClick={() => navigate(`/pets/${pet.id}/edit`)}
            >
              Editar
            </button>
            <button type="button" className="danger" onClick={handleDelete}>
              Eliminar
            </button>
          </div>
        )}
      </div>

      {confirmOpen && (
        <div
          className="pm-confirm-overlay"
          onClick={() => setConfirmOpen(false)}
        >
          <div
            className="pm-confirm-dialog"
            onClick={(e) => e.stopPropagation()}
          >
            <button
              type="button"
              className="pm-confirm-dialog__close"
              onClick={() => setConfirmOpen(false)}
            >
              <X size={16} />
            </button>
            <div className="pm-confirm-dialog__icon">
              <Trash2 size={20} />
            </div>
            <h3>¿Eliminar mascota?</h3>
            <p>
              Esta acción eliminará a <strong>{pet.name}</strong> de la lista.
            </p>
            <div className="pm-confirm-dialog__actions">
              <button
                type="button"
                className="pm-btn pm-btn--secondary"
                onClick={() => setConfirmOpen(false)}
              >
                Cancelar
              </button>
              <button
                type="button"
                className="pm-btn pm-btn--primary"
                onClick={confirmDelete}
                disabled={deleting}
              >
                {deleting ? "Eliminando..." : "Sí, eliminar"}
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}

export default PetCard;

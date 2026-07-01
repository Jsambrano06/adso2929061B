import { useEffect, useState, useRef } from "react";
import { useNavigate, useParams } from "react-router-dom";
import { Camera, Pencil, MapPin } from "lucide-react";
import MobileLayout from "../components/MobileLayout";
import Header from "../components/Header";
import { petService } from "../services/petService";
import { fileToBase64 } from "../utils/imageHelper";

const PET_TYPES = ["Perro", "Gato", "Ave", "Conejo", "Otro"];

function EditPet() {
  const { id } = useParams();
  const navigate = useNavigate();
  const fileRef = useRef(null);
  const [form, setForm] = useState({
    name: "",
    kind: "Perro",
    breed: "",
    weight: "",
    age: "",
    location: "",
    description: "",
  });
  const [imagePreview, setImagePreview] = useState(null);
  const [errors, setErrors] = useState({});
  const [apiError, setApiError] = useState("");
  const [loading, setLoading] = useState(false);
  const [fetching, setFetching] = useState(true);

  useEffect(() => {
    const load = async () => {
      try {
        const pet = await petService.getById(id);
        setForm({
          name: pet.name || "",
          kind: pet.kind || "Perro",
          breed: pet.breed || "",
          weight: pet.weight ?? "",
          age: pet.age ?? "",
          location: pet.location || "",
          description: pet.description || "",
        });
        if (pet.image) setImagePreview(pet.image);
      } catch {
        setApiError("No se pudo cargar la mascota");
      } finally {
        setFetching(false);
      }
    };
    load();
  }, [id]);

  const update = (field, value) => setForm((prev) => ({ ...prev, [field]: value }));

  const handleImage = async (e) => {
    const file = e.target.files?.[0];
    if (!file) return;
    const base64 = await fileToBase64(file);
    setImagePreview(base64);
  };

  const validate = () => {
    const errs = {};
    if (!form.name.trim()) errs.name = "El nombre es obligatorio";
    setErrors(errs);
    return Object.keys(errs).length === 0;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!validate()) return;
    setLoading(true);
    setApiError("");
    try {
      const payload = {
        name: form.name.trim(),
        kind: form.kind,
        breed: form.breed.trim() || "",
        weight: form.weight !== "" ? parseFloat(form.weight) : 0,
        age: form.age !== "" ? parseInt(form.age, 10) : 0,
        location: form.location.trim() || "",
        description: form.description.trim() || "",
        ...(imagePreview && { image: imagePreview }),
      };
      await petService.update(id, payload);
      navigate(`/pets/${id}`);
    } catch (err) {
      const apiErrors = err.response?.data?.errors;
      if (apiErrors) {
        const mapped = {};
        Object.keys(apiErrors).forEach((k) => {
          mapped[k] = apiErrors[k][0];
        });
        setErrors(mapped);
      } else {
        setApiError(err.response?.data?.message || "Error al actualizar");
      }
    } finally {
      setLoading(false);
    }
  };

  if (fetching) {
    return (
      <MobileLayout>
        <Header title="Editar Mascota" showBack />
        <div className="pm-loading">
          <div className="pm-spinner" />
        </div>
      </MobileLayout>
    );
  }

  return (
    <MobileLayout>
      <Header title="Editar Mascota" showBack />

      <form onSubmit={handleSubmit}>
        <div className="pm-photo-upload">
          <div className="pm-photo-upload__circle" onClick={() => fileRef.current?.click()}>
            {imagePreview ? (
              <img src={imagePreview} alt="Preview" />
            ) : (
              <Camera size={36} color="var(--accent-primary)" />
            )}
            <span className="pm-photo-upload__edit">
              <Camera size={14} />
            </span>
          </div>
          <input ref={fileRef} type="file" accept="image/*" onChange={handleImage} />
        </div>

        <h2 className="pm-section-title">Información Básica</h2>
        <p className="pm-subtitle" style={{ marginBottom: 24 }}>
          Actualiza los detalles del perfil de tu mascota.
        </p>

        {apiError && <div className="pm-error-banner">{apiError}</div>}

        <div className="pm-form-group">
          <label className="pm-label">Nombre de la mascota</label>
          <div className="pm-input-wrap">
            <input
              className="pm-input pm-input--with-icon"
              value={form.name}
              onChange={(e) => update("name", e.target.value)}
            />
            <Pencil className="pm-input-icon" size={16} />
          </div>
          {errors.name && <p className="pm-error">{errors.name}</p>}
        </div>

        <div className="pm-form-row">
          <div className="pm-form-group">
            <label className="pm-label">Tipo</label>
            <select
              className="pm-input pm-select"
              value={form.kind}
              onChange={(e) => update("kind", e.target.value)}
            >
              {PET_TYPES.map((t) => (
                <option key={t} value={t}>
                  {t}
                </option>
              ))}
            </select>
          </div>
          <div className="pm-form-group">
            <label className="pm-label">Raza</label>
            <input
              className="pm-input"
              value={form.breed}
              onChange={(e) => update("breed", e.target.value)}
            />
          </div>
        </div>

        <div className="pm-form-row">
          <div className="pm-form-group">
            <label className="pm-label">Peso (kg)</label>
            <input
              type="number"
              step="0.1"
              className="pm-input"
              value={form.weight}
              onChange={(e) => update("weight", e.target.value)}
            />
          </div>
          <div className="pm-form-group">
            <label className="pm-label">Edad (años)</label>
            <input
              type="number"
              className="pm-input"
              value={form.age}
              onChange={(e) => update("age", e.target.value)}
            />
          </div>
        </div>

        <div className="pm-form-group">
          <label className="pm-label">Ubicación</label>
          <div className="pm-input-wrap">
            <MapPin className="pm-input-icon pm-input-icon--left" size={18} />
            <input
              className="pm-input pm-input--with-left-icon"
              placeholder="Ciudad, País"
              value={form.location}
              onChange={(e) => update("location", e.target.value)}
            />
          </div>
        </div>

        <div className="pm-form-group">
          <label className="pm-label">Descripción</label>
          <textarea
            className="pm-input"
            placeholder="Escribe algo sobre la mascota..."
            value={form.description}
            onChange={(e) => update("description", e.target.value)}
            rows={3}
          />
        </div>

        <div className="pm-btn-row">
          <button type="button" className="pm-btn pm-btn--secondary" onClick={() => navigate(`/pets/${id}`)}>
            Cancelar
          </button>
          <button type="submit" className="pm-btn pm-btn--primary" disabled={loading}>
            {loading ? "Guardando..." : "Guardar cambios"}
          </button>
        </div>
      </form>
    </MobileLayout>
  );
}

export default EditPet;

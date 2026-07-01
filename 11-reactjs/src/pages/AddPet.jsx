import { useState, useRef } from "react";
import { useNavigate } from "react-router-dom";
import { Camera, Pencil, MapPin } from "lucide-react";
import MobileLayout from "../components/MobileLayout";
import Header from "../components/Header";
import { petService } from "../services/petService";
import { fileToBase64 } from "../utils/imageHelper";

const PET_TYPES = ["Perro", "Gato", "Ave", "Conejo", "Otro"];

function AddPet() {
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
    if (!form.kind) errs.kind = "El tipo es obligatorio";
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
      const pet = await petService.create(payload);
      navigate(`/pets/${pet.id}`);
    } catch (err) {
      const apiErrors = err.response?.data?.errors;
      if (apiErrors) {
        const mapped = {};
        Object.keys(apiErrors).forEach((k) => {
          mapped[k] = apiErrors[k][0];
        });
        setErrors(mapped);
      } else {
        setApiError(err.response?.data?.message || "Error al crear la mascota");
      }
    } finally {
      setLoading(false);
    }
  };

  return (
    <MobileLayout>
      <Header title="Agregar Mascota" showBack showSearch />

      <form onSubmit={handleSubmit}>
        <div className="pm-photo-upload">
          <div className="pm-photo-upload__circle" onClick={() => fileRef.current?.click()}>
            {imagePreview ? (
              <img src={imagePreview} alt="Preview" />
            ) : (
              <Camera size={36} color="var(--accent-primary)" />
            )}
            <span className="pm-photo-upload__edit">
              <Pencil size={14} />
            </span>
          </div>
          <span className="pm-photo-upload__label">Subir Foto</span>
          <input ref={fileRef} type="file" accept="image/*" onChange={handleImage} />
        </div>

        {apiError && <div className="pm-error-banner">{apiError}</div>}

        <div className="pm-section-label">Información Básica</div>

        <div className="pm-form-group">
          <label className="pm-label">Nombre</label>
          <input
            className="pm-input pm-input--alt"
            placeholder="Ej: Max"
            value={form.name}
            onChange={(e) => update("name", e.target.value)}
          />
          {errors.name && <p className="pm-error">{errors.name}</p>}
        </div>

        <div className="pm-form-row">
          <div className="pm-form-group">
            <label className="pm-label">Tipo</label>
            <select
              className="pm-input pm-input--alt pm-select"
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
              className="pm-input pm-input--alt"
              placeholder="Ej: Beagle"
              value={form.breed}
              onChange={(e) => update("breed", e.target.value)}
            />
          </div>
        </div>

        <div className="pm-section-label" style={{ marginTop: 8 }}>
          Estadísticas Físicas
        </div>

        <div className="pm-form-row">
          <div className="pm-form-group">
            <label className="pm-label">Peso (kg)</label>
            <input
              type="number"
              step="0.1"
              className="pm-input pm-input--alt"
              placeholder="0.0"
              value={form.weight}
              onChange={(e) => update("weight", e.target.value)}
            />
          </div>
          <div className="pm-form-group">
            <label className="pm-label">Edad (años)</label>
            <input
              type="number"
              className="pm-input pm-input--alt"
              placeholder="0"
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
              className="pm-input pm-input--alt pm-input--with-left-icon"
              placeholder="Ciudad, País"
              value={form.location}
              onChange={(e) => update("location", e.target.value)}
            />
          </div>
        </div>

        <div className="pm-form-group">
          <label className="pm-label">Descripción</label>
          <textarea
            className="pm-input pm-input--alt"
            placeholder="Escribe algo sobre la mascota..."
            value={form.description}
            onChange={(e) => update("description", e.target.value)}
            rows={3}
          />
        </div>

        <button type="submit" className="pm-btn pm-btn--primary" disabled={loading} style={{ marginTop: 8 }}>
          {loading ? "Guardando..." : "Agregar Mascota"}
        </button>
        <button
          type="button"
          className="pm-btn pm-btn--secondary"
          style={{ marginTop: 12 }}
          onClick={() => navigate("/dashboard")}
        >
          Cancelar
        </button>
      </form>
    </MobileLayout>
  );
}

export default AddPet;

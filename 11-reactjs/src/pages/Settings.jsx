import { useNavigate } from "react-router-dom";
import { LogOut, Moon, Sun } from "lucide-react";
import MobileLayout from "../components/MobileLayout";
import Header from "../components/Header";
import { useAuth } from "../context/AuthContext";
import { useTheme } from "../context/ThemeContext";

function Settings() {
  const navigate = useNavigate();
  const { user, logout } = useAuth();
  const { theme, toggleTheme } = useTheme();

  const handleLogout = async () => {
    await logout();
    navigate("/login");
  };

  const initial = user?.name?.charAt(0)?.toUpperCase() || "U";

  return (
    <MobileLayout>
      <Header title="Settings" showBack />

      <div className="pm-user-info">
        <div className="pm-user-info__avatar">{initial}</div>
        <div>
          <div className="pm-user-info__name">{user?.name || "Usuario"}</div>
          <div className="pm-user-info__email">{user?.email || ""}</div>
        </div>
      </div>

      <div className="pm-settings-card">
        <div className="pm-settings-row">
          <div>
            <div className="pm-settings-row__label">
              {theme === "dark" ? <Moon size={16} style={{ display: "inline", marginRight: 8 }} /> : <Sun size={16} style={{ display: "inline", marginRight: 8 }} />}
              Modo {theme === "dark" ? "oscuro" : "claro"}
            </div>
            <div className="pm-settings-row__desc">Cambiar entre tema oscuro y claro</div>
          </div>
          <button
            type="button"
            className={`pm-toggle ${theme === "light" ? "pm-toggle--on" : ""}`}
            onClick={toggleTheme}
            aria-label="Cambiar tema"
          >
            <span className="pm-toggle__knob" />
          </button>
        </div>
      </div>

      <div className="pm-settings-card">
        <button
          type="button"
          className="pm-settings-row"
          style={{ width: "100%", background: "none", border: "none", cursor: "pointer", color: "#f87171" }}
          onClick={handleLogout}
        >
          <div className="pm-settings-row__label" style={{ display: "flex", alignItems: "center", gap: 8 }}>
            <LogOut size={18} />
            Cerrar sesión
          </div>
        </button>
      </div>
    </MobileLayout>
  );
}

export default Settings;

import { useState } from "react";
import { useNavigate, Navigate } from "react-router-dom";
import { PawPrint, Eye, EyeOff, ArrowRight } from "lucide-react";
import { useAuth } from "../context/AuthContext";

function Login() {
  const navigate = useNavigate();
  const { login, isAuthenticated } = useAuth();
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [showPassword, setShowPassword] = useState(false);
  const [remember, setRemember] = useState(false);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");

  if (isAuthenticated) {
    return <Navigate to="/dashboard" replace />;
  }

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError("");
    if (!email || !password) {
      setError("Email y contraseña son obligatorios");
      return;
    }
    setLoading(true);
    try {
      await login(email, password);
      if (!remember) {
        // token stays in localStorage; remember is visual only per Figma
      }
      navigate("/dashboard");
    } catch (err) {
      const msg =
        err.response?.data?.message ||
        err.response?.data?.errors?.email?.[0] ||
        "Credenciales inválidas";
      setError(msg);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="pm-app">
      <div className="pm-container">
        <div className="pm-login">
          <div className="pm-logo">
            <PawPrint className="pm-logo__icon" size={28} />
            <span className="pm-logo__text">PetManager</span>
          </div>

          <h1 className="pm-title" style={{ textAlign: "center", marginTop: 32 }}>
            Welcome back
          </h1>
          <p className="pm-subtitle" style={{ textAlign: "center", marginBottom: 32 }}>
            Manage your pet&apos;s wellness with precision and care.
          </p>

          {error && <div className="pm-error-banner">{error}</div>}

          <form onSubmit={handleSubmit}>
            <div className="pm-form-group">
              <label className="pm-label" htmlFor="email">
                Email Address
              </label>
              <input
                id="email"
                type="email"
                className="pm-input"
                placeholder="name@example.com"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                autoComplete="email"
              />
            </div>

            <div className="pm-form-group">
              <label className="pm-label" htmlFor="password">
                Password
              </label>
              <div className="pm-input-wrap">
                <input
                  id="password"
                  type={showPassword ? "text" : "password"}
                  className="pm-input pm-input--with-icon"
                  placeholder="••••••••"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  autoComplete="current-password"
                />
                <button
                  type="button"
                  className="pm-input-icon"
                  onClick={() => setShowPassword(!showPassword)}
                  aria-label={showPassword ? "Ocultar contraseña" : "Mostrar contraseña"}
                >
                  {showPassword ? <EyeOff size={18} /> : <Eye size={18} />}
                </button>
              </div>
            </div>

            <div className="pm-checkbox-row">
              <label className="pm-checkbox-label">
                <input
                  type="checkbox"
                  checked={remember}
                  onChange={(e) => setRemember(e.target.checked)}
                />
                Remember me
              </label>
              <button type="button" className="pm-link">
                Forgot password?
              </button>
            </div>

            <button type="submit" className="pm-btn pm-btn--primary" disabled={loading}>
              {loading ? "Signing in..." : "Sign In"}
              {!loading && <ArrowRight size={18} />}
            </button>
          </form>

          <div className="pm-divider">OR CONTINUE WITH</div>

          <div className="pm-social-row">
            <button type="button" className="pm-social-btn">
              <svg width="18" height="18" viewBox="0 0 24 24">
                <path
                  fill="currentColor"
                  d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"
                />
                <path
                  fill="currentColor"
                  d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                />
                <path
                  fill="currentColor"
                  d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                />
                <path
                  fill="currentColor"
                  d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                />
              </svg>
              Google
            </button>
            <button type="button" className="pm-social-btn">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z" />
              </svg>
              Apple
            </button>
          </div>

          <div className="pm-login__footer">
            Don&apos;t have an account? <button type="button" className="pm-link">Create one</button>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Login;

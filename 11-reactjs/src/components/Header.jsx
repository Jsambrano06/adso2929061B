import { useNavigate } from "react-router-dom";
import { ArrowLeft, Search } from "lucide-react";

function Header({ title, showBack = false, showSearch = false, titleAlign = "center" }) {
  const navigate = useNavigate();

  return (
    <header className="pm-header">
      {showBack ? (
        <button type="button" className="pm-header__back" onClick={() => navigate(-1)} aria-label="Volver">
          <ArrowLeft size={22} />
        </button>
      ) : (
        <div className="pm-header__spacer" />
      )}
      <h1 className={`pm-header__title ${titleAlign === "left" ? "pm-header__title--left" : ""}`}>
        {title}
      </h1>
      {showSearch ? (
        <button type="button" className="pm-header__action" aria-label="Buscar">
          <Search size={20} />
        </button>
      ) : (
        <div className="pm-header__spacer" />
      )}
    </header>
  );
}

export default Header;

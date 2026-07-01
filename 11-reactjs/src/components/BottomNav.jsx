import { useLocation, useNavigate } from "react-router-dom";
import { LayoutDashboard, Plus, Settings } from "lucide-react";

const NAV_ITEMS = [
  { path: "/dashboard", label: "Dashboard", icon: LayoutDashboard },
  { path: "/pets/add", label: "Add Pet", icon: Plus },
  { path: "/settings", label: "Settings", icon: Settings },
];

function BottomNav() {
  const location = useLocation();
  const navigate = useNavigate();

  const isActive = (path) => {
    if (path === "/dashboard") {
      return location.pathname === "/dashboard" || /^\/pets\/\d+$/.test(location.pathname);
    }
    if (path === "/pets/add") {
      return location.pathname === "/pets/add" || location.pathname.includes("/edit");
    }
    return location.pathname === path;
  };

  return (
    <nav className="pm-bottom-nav">
      {NAV_ITEMS.map(({ path, label, icon: Icon }) => (
        <button
          key={path}
          type="button"
          className={`pm-bottom-nav__item ${isActive(path) ? "pm-bottom-nav__item--active" : ""}`}
          onClick={() => navigate(path)}
        >
          <Icon size={20} />
          <span>{label}</span>
        </button>
      ))}
    </nav>
  );
}

export default BottomNav;

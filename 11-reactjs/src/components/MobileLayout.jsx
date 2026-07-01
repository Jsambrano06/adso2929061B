import BottomNav from "./BottomNav";

function MobileLayout({ children, showNav = true }) {
  return (
    <div className="pm-app">
      <div className="pm-container">
        <div className={`pm-page ${!showNav ? "pm-page--no-nav" : ""}`}>{children}</div>
        {showNav && <BottomNav />}
      </div>
    </div>
  );
}

export default MobileLayout;
